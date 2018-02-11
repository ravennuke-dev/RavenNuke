<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// getDailyEvents.php - This file is part of GCalendar
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

// returns an array of (id, category) pairs

function getEvents($year, $month, $day) {
	global $db, $prefix;
	$eventTable = $prefix . GCAL_EVENT_TABLE;
	$exceptTable = $prefix . GCAL_EXCEPT_TABLE;

	$year = intval($year);
	$month = intval($month);
	$day = intval($day);
	$events = array();

	$theDay = toSqlDate($year, $month, $day);	// the day of the month in YYYY-MM-DD format for SQL

	// first get any exceptions to repeating events for this date

	$sql = 'SELECT `event_id` FROM ' . $exceptTable .  ' WHERE `date` = \'' . $theDay . '\'';
	$result = $db->sql_query($sql);
	$exceptions = array();
	while ($row = $db->sql_fetchrow($result)) {
		$exceptions[] = intval($row['event_id']);
	}

	// now work on getting events for this date

	$theDayTs = mktime(0, 0, 0, $month, $day, $year); // the day as a UNIX timestamp
	$theDayInfo = getdate($theDayTs); // day info 

	// The DIV operator doesn't work in MySQL 4.0.x; use FLOOR() instead...

	// Get SQL related to categories and who can see them:
	gcalGetCategorySql($catFrom, $catWhere);

	$sql = <<<END_SQL
SELECT ev.id, start_date, repeat_type, weekly_days, monthly_by_day, category
	FROM $eventTable AS ev $catFrom WHERE approved != 0 AND ((start_date = '$theDay')
OR 
(start_date <= '$theDay' AND (no_end_date = 1 OR end_date >= '$theDay')) 
AND (
(repeat_type = 'daily' AND
	((TO_DAYS('$theDay') - TO_DAYS(start_date)) % interval_val = 0)
)
OR 
(repeat_type = 'weekly' AND
	((FLOOR(TO_DAYS('$theDay') / 7) - FLOOR(TO_DAYS(start_date) / 7)) % interval_val = 0)
) 
OR 
(repeat_type = 'monthly' AND 
	(monthly_by_day = 1 OR DAYOFMONTH(start_date) = $day) AND
	((interval_val = 0 AND MONTH(start_date) = $month) OR 
	 (($month - MONTH(start_date)) % interval_val = 0))
)
OR 
(repeat_type = 'yearly' AND 
	MONTH(start_date) = $month AND DAYOFMONTH(start_date) = $day AND
	((interval_val = 0 AND YEAR(start_date) = $year) OR 
		((($year - YEAR(start_date)) % interval_val) = 0))
))) $catWhere
ORDER BY no_time DESC, start_time, id
END_SQL;

	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$eventId = intval($row['id']);

		if (in_array($eventId, $exceptions)) {
			continue;
		}

		$repeat = $row['repeat_type'];
		$start = $row['start_date'];
		$category = intval($row['category']);

		switch ($repeat) {
			case 'none':
			case 'daily':
			case 'yearly':
				$events[] = array('id' => $eventId, 'category' => $category);
				break;

			case 'weekly':
				$dayMask = explode(',', $row['weekly_days']);
				if (in_array($theDayInfo['wday'], $dayMask)) {
					$events[] = array('id' => $eventId, 'category' => $category);
				}
				break;

			case 'monthly':
				$byDay = intval($row['monthly_by_day']);
				if ($byDay) { // e.g. the 3rd Tuesday of the month
					nthWeekday($start, $n1, $wday1);
					nthWeekday($theDay, $n2, $wday2);

					if ($n1 == $n2 && $wday1 == $wday2) {
						$events[] = array('id' => $eventId, 'category' => $category);
					}
				} else { // it's by date (e.g. the 18th of every month)
					$events[] = array('id' => $eventId, 'category' => $category);
				}
				break;

			default:
				break;
		}
	}

	return $events;
}
?>