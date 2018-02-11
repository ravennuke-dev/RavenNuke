<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// edit.php - This file is part of GCalendar
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
// edit.php - responsible for editing events in the user area
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name);

require_once 'modules/' . $module_name . '/gcal.inc.php';
require_once 'modules/' . $module_name . '/class.combo.php';
require_once 'modules/' . $module_name . '/common.inc.php';
require_once 'modules/' . $module_name . '/class.eventForm.php';
require_once 'modules/' . $module_name . '/class.radio.php';
require_once 'modules/' . $module_name . '/gcInputFilter.php';
require_once 'modules/' . $module_name . '/getDailyEvents.php';

///////////////////////////////////////////////////////////////////////

$eventId = intval($eventId);
$config = getConfig();

$isAdmin = is_admin($admin);
$canEdit = $isAdmin || gcalCanEditEvent($eventId, $config);

if (!$canEdit) {
	header('Location: ' . GCAL_MOD_LINK);
	die();
}

// determine operation to perform

$op = '';
if (array_key_exists('delete', $_POST)) {
	csrf_check();
	$op = 'delete';
} else if (array_key_exists('ok', $_POST)) {
	csrf_check();
	$op = 'update';
}

// obtain and validate key arguments

$year = intval($y);
$month = intval($m);
$day = intval($d);

if ($year == 0 || $month == 0 || $day == 0 || $eventId == 0) {
	header('Location: ' . GCAL_MOD_LINK);
	die();
}

// the event must exist in the database; we already validated this if the user is
// a normal user, now check for admins:

if ($isAdmin) {
	$sql = 'SELECT count(*) FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = ' . $eventId;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	if ($row[0] == 0) {
		header('Location: ' . GCAL_MOD_LINK);
		die();
	}
}

// perform requested action

switch ($op) {
	case 'update':
		gcalUserPostEvent($year, $month, $day, $eventId, $isAdmin, $config);
		break;

	case 'delete':
		gcalUserDeleteEvent($year, $month, $day, $eventId);
		break;

	default:
		gcalUserEditEvent($year, $month, $day, $eventId, $isAdmin, $config);
		break;
}

///////////////////////////////////////////////////////////////////////

function gcalUserEditEvent($year, $month, $day, $eventId, $isAdmin, $config) {
	include 'header.php';
	OpenTable();
	printTitle($config['image'], $config['title']);
	echo '<br />';

	$submitUrl = GCAL_MOD_LINK . '&amp;file=edit&amp;y=' . $year . 
		'&amp;m=' . $month . '&amp;d=' . $day;
	$eventForm = new EventForm($submitUrl, _UPDATE_EVENT, _UPDATE_EVENT, $config);
	$eventForm->enableDelete();
	$eventForm->setInstructions('');
	if ($isAdmin) {
		$eventForm->enableAdmin();
	}
	$eventForm->load($eventId);

	if ($eventForm->isRepeating()) {
		$daysEvents = getEvents($year, $month, $day);
		if (in_array(array('id' => $eventId, 'category' => $eventForm->getCategory()), $daysEvents)) {
			$eventForm->setBranchDate(toSqlDate($year, $month, $day));
		}
	}

	$eventForm->display();

	CloseTable();
	include 'footer.php';
}

///////////////////////////////////////////////////////////////////////

function gcalGotoViewDay($year, $month, $day, $eventId = '') {
	$loc = GCAL_MOD_LINK . '&file=viewday&y=' . $year . '&m=' . $month . '&d=' . $day;
	if ($eventId != '') {
		$loc .= '&e=' . $eventId;
	}
	header('Location: ' . $loc);
	die();
}

///////////////////////////////////////////////////////////////////////

function gcalUserPostEvent($year, $month, $day, $eventId, $isAdmin, $config) {
	global $db, $prefix;

	$submitUrl = GCAL_MOD_LINK . '&amp;file=edit&amp;y=' . $year . 
		'&amp;m=' . $month . '&amp;d=' . $day;
	$eventForm = new EventForm($submitUrl, _UPDATE_EVENT, _UPDATE_EVENT, $config);
	$eventForm->enableDelete();
	$eventForm->setInstructions('');
	if ($isAdmin) {
		$eventForm->enableAdmin();
	} else {
		$eventForm->setApproved(true);
	}
	$eventForm->post($eventId);
	if ($eventForm->errorCount() > 0) {
		include 'header.php';
		OpenTable();
		printTitle($config['image'], $config['title']);
		echo '<br />';
		$eventForm->display(true);
		CloseTable();
		include 'footer.php';
		die();
	}

	// no errors, is this a repeating event?

	$repeatType = 'none';
	$startDate = '0000-00-00';
	$interval = 0;
	$sql = 'SELECT repeat_type, start_date, interval_val, weekly_days, monthly_by_day FROM ' .
		$prefix . GCAL_EVENT_TABLE . ' WHERE id = \'' . $eventId . '\'';
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)) {
		$repeatType = $row['repeat_type'];
		$startDate = $row['start_date'];
		$interval = intval($row['interval_val']);
		$weeklyDays = explode(',', $row['weekly_days']);
		$byDay = intval($row['monthly_by_day']) ? true : false;
	}

	if ($repeatType == 'none') {
		$eventForm->save();
		gcalGotoViewDay($year, $month, $day, $eventId);
	} else { // update repeating event
		$branch = isset($_POST['branch']) ? $_POST['branch'] : 'allNewStart';

		// if the user picks 'this and all future events' but has also selected the original start date,
		// turn this into a 'update all events'
		if ($branch == 'thisAndFuture' && $startDate == $eventForm->getStartDate()) {
			$branch = 'allKeepStart';
		}

		switch ($branch) {
			case 'this':
				$eventForm->markNew();
				$eventForm->noRepeat();
				$eventForm->save();
				gcalAddRepeatException($eventId, $eventForm->getStartDate());
				list($y, $m, $d) = explode('-', $eventForm->getStartDate());
				gcalGotoViewDay($y, $m, $d, $eventForm->getInsertId());
				break;

			case 'thisAndFuture':
				gcalEndBefore($eventId, $eventForm->getStartDate(), $startDate, $repeatType, $interval, $weeklyDays, $byDay);
				$eventForm->markNew();
				$eventForm->save();
				list($y, $m, $d) = explode('-', $eventForm->getStartDate());
				gcalGotoViewDay($y, $m, $d, $eventForm->getInsertId());
				break;

			case 'allKeepStart':
				$eventForm->setStartDate($startDate);
				$eventForm->save();
				list($y, $m, $d) = explode('-', $startDate);
				gcalGotoViewDay($y, $m, $d, $eventId);
				break;

			default:
				gcalDelRepeatException($eventId);
				$eventForm->save();
				gcalGotoViewDay($year, $month, $day, $eventId);
				break;
		}
	}

}

///////////////////////////////////////////////////////////////////////

function gcalUserDeleteEvent($year, $month, $day, $eventId) {
	global $db, $prefix;

	// is this a repeating event?

	$repeatType = 'none';
	$startDate = '0000-00-00';
	$interval = 0;
	$sql = 'SELECT repeat_type, start_date, interval_val, weekly_days, monthly_by_day FROM ' .
		$prefix . GCAL_EVENT_TABLE . ' WHERE id = \'' . $eventId . '\'';
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)) {
		$repeatType = $row['repeat_type'];
		$startDate = $row['start_date'];
		$interval = intval($row['interval_val']);
		$weeklyDays = explode(',', $row['weekly_days']);
		$byDay = intval($row['monthly_by_day']) ? true : false;
	}

	if ($repeatType == 'none') {
		gcalDeleteEvents($eventId);
	} else {
		$branch = isset($_POST['branch']) ? $_POST['branch'] : 'allNewStart';
		$branchDate = toSqlDate($year, $month, $day);

		switch ($branch) {
			case 'this':
				gcalAddRepeatException($eventId, $branchDate);
				break;

			case 'thisAndFuture':
				if ($startDate == $branchDate) { // user really wants them all gone
					gcalDeleteEvents($eventId);
				} else { // just end current date early
					gcalEndBefore($eventId, $branchDate, $startDate, $repeatType, $interval, $weeklyDays, $byDay);
				}
				break;

			default: // either "all" case
				gcalDeleteEvents($eventId);
				break;
		}
	}
	gcalGotoViewDay($year, $month, $day);
}

///////////////////////////////////////////////////////////////////////

function gcalAddRepeatException($eventId, $exceptDate) {
	global $db, $prefix;
	$sql = 'INSERT INTO ' . $prefix . GCAL_EXCEPT_TABLE . ' VALUES (NULL, \'' .
		$eventId . '\', \'' . $exceptDate . '\')';
	$db->sql_query($sql);
}

///////////////////////////////////////////////////////////////////////

function gcalDelRepeatException($eventId) {
	global $db, $prefix;
	$sql = 'DELETE FROM ' . $prefix . GCAL_EXCEPT_TABLE . ' WHERE event_id = \'' .
		$eventId . '\'';
	$db->sql_query($sql);
}

///////////////////////////////////////////////////////////////////////

function gcalEndBefore($eventId, $beforeDate, $startDate, $repeatType, $interval, $weeklyDays, $byDay) {
	global $db, $prefix;

	// set end date to $beforeDate minus 1 day

	$endDateTs = strtotime($beforeDate . ' -1 day');
	$endInfo = getdate($endDateTs);
	$endDate = toSqlDate($endInfo['year'], $endInfo['mon'], $endInfo['mday']);

	$action = ' SET end_date = \'' . $endDate . '\'';

	// Now let's do something nice (but tricky) for the user; let's detect if the event can
	// now become a non-repeating event. Calculate the date of the first repeat for this event.
	// If it is greater than the new end date we can mark this event as non-repeating.

	$nonRepeating = false;

	switch ($repeatType) {
		case 'daily':
			$secondTs = strtotime($startDate . ' +' . $interval . ' days');
			$nonRepeating = $secondTs > $endDateTs;
			break;

		case 'weekly':
			$startInfo = getdate(strtotime($startDate));
			$wday = $startInfo['wday'];
			$i = array_search($wday, $weeklyDays);
			if (is_null($i) || $i === false) {
				return;  // something is messed up
			}
			$j = ($i == count($weeklyDays) - 1) ? 0 : $i + 1;
			$nday = $weeklyDays[$j];
			$delta = ($nday == $wday) ? 7 : ($j > $i ? $nday - $wday : 7 - $nday + $wday);
			$n = $delta + 7 * ($interval - 1);
			$secondTs = strtotime($startDate . ' +' . $n . ' days');
			$nonRepeating = $secondTs > $endDateTs;
			break;

		case 'monthly':
			if ($byDay) {
				nthWeekday($startDate, $n, $weekday);
				list($y, $m, $d) = explode('-', $startDate);
				$i = $interval;
				$valid = false;
				while (!$valid) {
					$ts = strtotime(toSqlDate($y, $m, 1) . ' +' . $i . ' months');
					$d1 = getdate($ts);
					$ts = strtotime("$n $weekday", $ts - 120); // -120 is for a difference in PHP4 and PHP5
					$d2 = getdate($ts);
					$valid = $d1['mon'] == $d2['mon'] && $d1['year'] == $d2['year'];
					$i += $interval;
				}
				$nonRepeating = $ts > $endDateTs;
			} else { // by date
				list($y, $m, $d) = explode('-', $startDate);
				$n = $interval;
				$valid = false;
				while (!$valid) {
					$s = toSqlDate($y, $m, 1) . ' +' . $n . ' months';
					$ts = strtotime($s);
					$y1 = strftime('%Y', $ts);
					$m1 = strftime('%m', $ts);
					$valid = checkdate($m1, $d, $y1);
					$n += $interval;
				}
				$secondTs = mktime(0, 0, 0, $m1, $d, $y1);
				$nonRepeating = $secondTs > $endDateTs;
			}
			break;

		case 'yearly':
			list($y, $m, $d) = explode('-', $startDate);
			$valid = false;
			while (!$valid) {
				$y += $interval;
				$valid = checkdate($m, $d, $y);
			}
			$secondTs = mktime(0, 0, 0, $m, $d, $y);
			$nonRepeating = $secondTs > $endDateTs;
			break;

		default:
			return; // something is messed up
	}

	if ($nonRepeating) { // turn it into a non-repeating event also
		$action .= ', repeat_type = \'none\', no_end_date = \'1\'';
	}
	$sql = 'UPDATE ' . $prefix . GCAL_EVENT_TABLE . $action . ' WHERE id = \'' . $eventId . '\'';
	$db->sql_query($sql);
}

?>