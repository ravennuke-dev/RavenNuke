<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// getMonthlyEvents.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
// 
// getMonthlyEvents() returns a datastructure of events for the given month.
// For each day of the month that has events, the corresponding key
// will be set. Each value is an array of arrays consisting of 
// 'id', 'title', and 'category' info. E.g. Say a month as 2 events (203 and 303) on
// the 11th, and some more events on the 20th:
//
// Array(11 => Array(0 => Array('id' => 203, 'title' => 'Some Event', 'category' => 2),
//						 1 => Array('id' => 333, 'title' => 'Another Event', 'category' => 5)), 
//		 20 => Array(etc))
// 
///////////////////////////////////////////////////////////////////////

function getMonthlyEvents($year, $month) {
	global $db, $prefix;
	$eventTable  = $prefix . GCAL_EVENT_TABLE;
	$exceptTable = $prefix . GCAL_EXCEPT_TABLE;

	$month = intval($month);
	$year = intval($year);
	$events = array();

	// first get any exceptions to repeating events for this month

	$sql = 'SELECT `event_id`, DAY(`date`) AS day FROM ' . $exceptTable . 
		' WHERE MONTH(`date`) = \'' . $month . '\' AND YEAR(`date`) = \'' . $year . '\'';
	$result = $db->sql_query($sql);
	$exceptions = array();
	while ($row = $db->sql_fetchrow($result)) {
		$exceptions[intval($row['event_id'])][] = intval($row['day']);
	}

	// now work on getting events for this month

	$theFirst = toSqlDate($year, $month, 1); // the first of the month in YYYY-MM-01 format for SQL
	$theFirstTs = mktime(0, 0, 0, $month, 1, $year); // the first as a UNIX timestamp
	$firstInfo = getdate($theFirstTs); // date info for the first
	$nDays = date('t', $theFirstTs); // how many days this month

	// The MySQL function LAST_DAY() isn't available until 4.1.1; use PHP to figure it out instead.
	// Also, the DIV operator doesn't work in MySQL 4.0.x; use FLOOR() instead...

	$lastDay = toSqlDate($year, $month, $nDays);

	// Get SQL related to categories and who can see them:
	gcalGetCategorySql($catFrom, $catWhere);

	$sql = <<<END_SQL
SELECT TO_DAYS('$theFirst'), TO_DAYS(start_date),
	ev.id, title, start_date, repeat_type, interval_val, weekly_days,
	monthly_by_day, no_end_date, end_date, category FROM $eventTable AS ev $catFrom WHERE 
approved != 0 AND (
(start_date >= '$theFirst' AND start_date <= '$lastDay')
OR 
(start_date <= '$lastDay' AND (no_end_date = 1 OR end_date > '$theFirst')) 
AND (
(repeat_type = 'daily' AND
	((TO_DAYS('$theFirst') - TO_DAYS(start_date)) % interval_val = 0 OR
	 interval_val - (TO_DAYS('$theFirst') - TO_DAYS(start_date)) % interval_val <=
			(TO_DAYS('$lastDay') - TO_DAYS('$theFirst')) + 1)
)
OR 
(repeat_type = 'weekly' AND
	((FLOOR(TO_DAYS('$theFirst') / 7) - FLOOR(TO_DAYS(start_date) / 7)) % interval_val = 0 OR
	 interval_val - (FLOOR(TO_DAYS('$theFirst') / 7) - FLOOR(TO_DAYS(start_date) / 7)) % interval_val <= 
			(FLOOR(TO_DAYS('$lastDay') / 7) - FLOOR(TO_DAYS('$theFirst') / 7)) + 1)
) 
OR 
(repeat_type = 'monthly' AND 
	((interval_val = 0 AND MONTH(start_date) = $month) OR 
	 (($month - MONTH(start_date)) % interval_val = 0))
)
OR 
(repeat_type = 'yearly' AND 
	MONTH(start_date) = $month AND 
	((interval_val = 0 AND YEAR(start_date) = $year) OR 
		((($year - YEAR(start_date)) % interval_val) = 0))
))) $catWhere
END_SQL;

	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$toDays1st = intval($row[0]);
		$toDaysStrt = intval($row[1]);
		$eventId = intval($row['id']);
		$title = $row['title'];
		$start = $row['start_date'];
		$repeat = $row['repeat_type'];
		$interval = intval($row['interval_val']);
		$noEndDate = intval($row['no_end_date']);
		$end = $row['end_date'];
		$category = intval($row['category']);

		$startTs = strtotime($start);
		$startInfo = getdate($startTs);
		$startDay = $startInfo['mday'];
		$endTs = strtotime($end);

		switch ($repeat) {
			case 'none':
				if (!isset($exceptions[$eventId]) || !in_array($startDay, $exceptions[$eventId])) {
					$events[$startDay][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
				}
				break;

			case 'daily':
				$days = $toDays1st;
				for ($n = 1; $n <= $nDays; ++$n) {
					$ts = mktime(0, 0, 0, $month, $n, $year);
					if ($ts >= $startTs && ($noEndDate || $ts <= $endTs) && (($days - $toDaysStrt) % $interval == 0)) {
						if (!isset($exceptions[$eventId]) || !in_array($n, $exceptions[$eventId])) {
							$events[$n][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
						}
					}
					++$days;
				}
				break;

			case 'weekly':
				$dayMask = explode(',', $row['weekly_days']);
				$wday = $firstInfo['wday'];

				$dayNum = $toDays1st;
				$startWeekNum = intval($toDaysStrt / 7);
				for ($n = 1; $n <= $nDays; ++$n) {
					$rightWeek = ((intval($dayNum / 7) - $startWeekNum) % $interval) == 0;
					if ($rightWeek && in_array($wday, $dayMask)) {
						$ts = mktime(0, 0, 0, $month, $n, $year);
						if ($ts >= $startTs && ($noEndDate || $ts <= $endTs) && (!isset($exceptions[$eventId]) || !in_array($n, $exceptions[$eventId]))) {
							$events[$n][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
						}
					}
					$wday = ($wday + 1) % 7;
					++$dayNum;
				}
				break;

			case 'monthly':
				$byDay = intval($row['monthly_by_day']);
				if ($byDay) { // e.g. the 3rd Tuesday of the month
					// for the start date, find what nth weekday it is:

					nthWeekday($start, $n, $weekday);

					// now compute the date for the nth weekday for this month

					// PHP4 and PHP5 differ on what they return if the day of the week of the first
					// is the same as the target day. This correction below works for both:

					$offsetTs = $firstInfo['weekday'] == $weekday ? $theFirstTs - 120 : $theFirstTs;

					$ts = strtotime("$n $weekday", $offsetTs);
					$d = getdate($ts);

					if ($ts >= $startTs && ($noEndDate || $ts <= $endTs) && $d['mon'] == $month && $d['year'] == $year) {
						if (!isset($exceptions[$eventId]) || !in_array($d['mday'], $exceptions[$eventId])) {
							$events[$d['mday']][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
						}
					}
				} else { // it's by date (e.g. the 18th of every month) 
					$ts = mktime(0, 0, 0, $month, $startDay, $year);
					if ($ts >= $startTs && ($noEndDate || $ts <= $endTs)) {
						if (!isset($exceptions[$eventId]) || !in_array($startDay, $exceptions[$eventId])) {
							$events[$startDay][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
						}
					}
				}
				break;

			case 'yearly':
				$ts = mktime(0, 0, 0, $month, $startDay, $year);
				if ($ts >= $startTs && ($noEndDate || $ts <= $endTs)) {
					if (!isset($exceptions[$eventId]) || !in_array($startDay, $exceptions[$eventId])) {
						$events[$startDay][] = array('id' => $eventId, 'title' => $title, 'category' => $category);
					}
				}
				break;

			default:
				break;
		}
	}

	ksort($events);
	return $events;
}

?>