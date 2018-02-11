<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// viewday.php - This file is part of GCalendar
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
// viewday.php - responsible for displaying a day's events or a single
// event.
//
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
require_once 'modules/' . $module_name . '/gcInputFilter.php';
require_once 'modules/' . $module_name . '/printable.php';
require_once 'modules/' . $module_name . '/displayEvent.php';
require_once 'modules/' . $module_name . '/displayCatLegend.php';
require_once 'modules/' . $module_name . '/getDailyEvents.php';

///////////////////////////////////////////////////////////////////////

function editEventLink($year, $month, $day, $event, $config) {
	if (gcalCanEditEvent($event, $config)) {
		// look for an edit.gif graphic
		$img = '';
		$themeSrc = './themes/' . get_theme() . '/images/edit.gif';
		$defaultSrc = './images/edit.gif';
		if (file_exists($themeSrc)) {
			$img = $themeSrc;
		} else if (file_exists($defaultSrc)) {
			$img = $defaultSrc;
		}

		if ($img != '') {
			$img = '<img src="' . $img . '" alt="' . _UPDATE_EVENT . '" title="' . _UPDATE_EVENT . '" border="0" />' .
				'&nbsp;';
		}

		$href = GCAL_MOD_LINK . '&amp;file=edit&amp;y=' . $year .
			'&amp;m=' . $month . '&amp;d=' . $day . '&amp;eventId=' . $event;
		$link = '<a href="' . $href . '">' . _UPDATE_EVENT . '</a>';
		echo '<div class="text-center">' . $img . $link . '</div>';
	}
}

///////////////////////////////////////////////////////////////////////

function sendToFriendLink($year, $month, $day, $event) {
	global $user;
	if (is_user($user)) {
		// look for a friend.gif graphic
		$img = '';
		$themeSrc = './themes/' . get_theme() . '/images/friend.gif';
		$defaultSrc = './images/friend.gif';
		if (file_exists($themeSrc)) {
			$img = $themeSrc;
		} else if (file_exists($defaultSrc)) {
			$img = $defaultSrc;
		}

		if ($img != '') {
			$img = '<img src="' . $img . '" alt="' . _SEND_TO_FRIEND . '" title="' . _SEND_TO_FRIEND . '" border="0" />' .
				'&nbsp;';
		}
		$href = GCAL_MOD_LINK . '&amp;file=friend&amp;y=' . $year . 
			'&amp;m=' . $month . '&amp;d=' . $day . '&amp;e=' . $event;
		$link = $img . '<a href="' . $href . '">' . _SEND_TO_FRIEND . '</a>';
		echo '<br /><div class="text-center">' . $link . '</div>';
	}
}

///////////////////////////////////////////////////////////////////////

function viewDay($year, $month, $day, $event, $printable) {
	$curYear = date('Y');
	$curMonth = date('n');
	$curDay = date('j');

	$config = getConfig();
	$title = $config['title'];
	$titleImg = $config['image'];
	$minYear = intval($config['min_year']);
	$maxYear = intval($config['max_year']);

	$year = intval($year);
	$month = intval($month);
	$day = intval($day);

	if ($year < $minYear || $year > $maxYear) {
		$year = $curYear;
	}
	if ($month < 1 || $month > 12) {
		$month = $curMonth;
	}

	// get number of days in the month

	$firstTs = mktime(0, 0, 0, $month, 1, $year);	// the 1st as a timestamp
	$nDays = date('t', $firstTs);

	if ($day < 1 || $day > $nDays) {
		$year  = $curYear;
		$month = $curMonth;
		$day	= $curDay;
	}

	$eventInfo = getEvents($year, $month, $day);
	$events = array();
	foreach ($eventInfo as $info) {
		$events[] = $info['id'];
	}
	$catMap = array();
	foreach ($eventInfo as $info) {
		$catMap[$info['category']][] = $info['id'];
	}


	$displaySingleEvent = false;
	if (isset($event) && !empty($event)) {
		$event = intval($event);
		$displaySingleEvent = in_array($event, $events);
	} else {
		$event = '';
	}

	// print out header line

	printHeader($curYear, $curMonth, $curDay, $config, $year, $month, $printable, $day, $event);

	$todayTs = mktime(0, 0, 0, $month, $day, $year);
	$today = getdate($todayTs);
	$yesterday = getdate(strtotime('-1 day', $todayTs));
	$tomorrow = getdate(strtotime('+1 day', $todayTs));

	$yesterdayLink = '';
	if (!$displaySingleEvent) {
		$yesterdayLink = '<a href="' . 
			viewDayHref($yesterday['year'], $yesterday['mon'], $yesterday['mday'], '', $printable) . '">' .
			'&lt;&lt; ' .
			formatDate(toSqlDate($yesterday['year'], $yesterday['mon'], $yesterday['mday']), $config['reg_date_format']) .
			'</a>';
	}

	$tomorrowLink = '';
	if (!$displaySingleEvent) {
		$tomorrowLink  = '<a href="' .
			viewDayHref($tomorrow['year'], $tomorrow['mon'], $tomorrow['mday'], '', $printable) . '">' .
			formatDate(toSqlDate($tomorrow['year'], $tomorrow['mon'], $tomorrow['mday']), $config['reg_date_format']) . 
			' &gt;&gt;</a>';
	}

	$todayTitle = formatDate(toSqlDate($today['year'], $today['mon'], $today['mday']), $config['long_date_format']);

	if (!$displaySingleEvent) {
		$todayTitle = _VIEW_DAY_EVENTS_FOR . '<br />' . $todayTitle;
	} else {
		$todayTitle = _VIEW_DAY_EVENT_DETAIL . $event . '<br />' . $todayTitle;
	}

	echo '<table border="0" width="100%"><tr>' . "\n";
	echo '<td align="left" valign="middle" width="31%">' . $yesterdayLink . "</td>\n";
	echo '<td align="center" valign="middle" width="38%"><span class="thick">' . $todayTitle . '</span></td>';
	echo '<td align="right" valign="middle" width="31%">' . $tomorrowLink . '</td></tr></table><br />';

	$sqlDate = toSqlDate($year, $month, $day);
	if ($displaySingleEvent) {
		$backTo = $sqlDate . '-' . $event;
		displayEvent($event, $config, '', false, $backTo);
		editEventLink($year, $month, $day, $event, $config);
		sendToFriendLink($year, $month, $day, $event);
		echo '<br /><div class="text-center"><a href="' . viewDayHref($year, $month, $day, '', $printable) . '">' . 
			_VIEW_DAY_VIEW_ALL . '</a></div><br />' . "\n";
	} else {
		if (count($events) > 0) {
			foreach ($events as $ev) {
				displayEvent($ev, $config, viewDayHref($year, $month, $day, $ev, $printable), false, $sqlDate);
				editEventLink($year, $month, $day, $ev, $config);
				sendToFriendLink($year, $month, $day, $ev);
			}
			echo '<br />';

			if ($config['show_cat_legend']) {
				displayCatLegend($catMap);
			}
		} else {
			echo '<br /><br /><div class="text-center">' . _VIEW_DAY_NO_EVENTS . '</div><br /><br />';
		}
	}
}

///////////////////////////////////////////////////////////////////////

if (isset($printable)) {
	$printable = true;
	printableHeader();
} else {
	$printable = false;
	include 'header.php';
	OpenTable();
}

$e = isset($e) ? intval($e) : '';

viewDay($y, $m, $d, $e, $printable);

if ($printable) {
	printableFooter();
} else {
	CloseTable();
	include 'footer.php';
}

///////////////////////////////////////////////////////////////////////

?>