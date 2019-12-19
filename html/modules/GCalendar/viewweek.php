<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// viewweek.php - This file is part of GCalendar
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
// viewweek.php - responsible for displaying a weekly view
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
require_once 'modules/' . $module_name . '/printable.php';
require_once 'modules/' . $module_name . '/displayCatLegend.php';
require_once 'modules/' . $module_name . '/getMonthlyEvents.php';
require_once 'modules/' . $module_name . '/formatEvents.php';

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

// returns an array of (id, category) pairs
//
function getWeekEvents($year, $month, $day, $nDays) {
	// array_intersect_key() would be perfect for this function, 
	// but that only exists in PHP 5 :( 
	// So the code here is a bit more complicated than I would like...

	// build a mask of days in this week

	$days1 = array();
	$n = $day;
	for ($i = 0; $i < 7; ++$i) {
		$days1[] = $n;
		if ($n == $nDays) {
			$n = 1;
			break;
		}
		++$n;
	}

	$days2 = array();
	for ($i = 0; $i < 7 - count($days1); ++$i) {
		$days2[] = $n;
		++$n;
	}

	$events1 = getMonthlyEvents($year, $month);
	$events2 = array();

	if ($day + 6 > $nDays) { // straddling months
		$month2 = ($month == 12) ? 1 : $month + 1;
		$year2  = ($month == 12) ? $year + 1 : $year;

		$events2 = getMonthlyEvents($year2, $month2);
	}


	$weekEvents = array();
	foreach ($days1 as $n) {
		if (array_key_exists($n, $events1)) {
			$weekEvents[$n] = $events1[$n];
		}
	}
	foreach ($days2 as $n) {
		if (array_key_exists($n, $events2)) {
			$weekEvents[$n] = $events2[$n];
		}
	}

	return $weekEvents;
}

///////////////////////////////////////////////////////////////////////

function viewWeek($year, $month, $day, $printable) {
	list($curYear, $curMonth, $curDay) = explode(',', date('Y,n,j'));

	$config = getConfig();
	$title		= $config['title'];
	$titleImg	= $config['image'];
	$minYear	 = intval($config['min_year']);
	$maxYear	 = intval($config['max_year']);
		
	$year  = intval($year);
	$month = intval($month);
	$day	= intval($day);

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

	$events = getWeekEvents($year, $month, $day, $nDays);

	// print out header line

	printHeader($curYear, $curMonth, $curDay, $config, $year, $month, $printable, $day, '', true);

	$targetTs  = mktime(0, 0, 0, $month, $day, $year);
	$target	 = getdate($targetTs);
	$lastWeek  = getdate(strtotime('-7 day', $targetTs));
	$nextWeek  = getdate(strtotime('+7 day', $targetTs));

	$lastWeekLink = '<a href="' . 
		viewWeekHref($lastWeek['year'], $lastWeek['mon'], $lastWeek['mday'], $printable) . '">' .
		'&lt;&lt; ' .
		formatDate(toSqlDate($lastWeek['year'], $lastWeek['mon'], $lastWeek['mday']), $config['reg_date_format']) .
		'</a>';

	$nextWeekLink  = '<a href="' .
		viewWeekHref($nextWeek['year'], $nextWeek['mon'], $nextWeek['mday'], $printable) . '">' .
		formatDate(toSqlDate($nextWeek['year'], $nextWeek['mon'], $nextWeek['mday']), $config['reg_date_format']) . 
		' &gt;&gt;</a>';

	$targetTitle = formatDate(toSqlDate($target['year'], $target['mon'], $target['mday']), $config['long_date_format']);
	$targetTitle = _VIEW_WEEK_EVENTS_FOR . '<br />' . $targetTitle;

	echo '<table border="0" width="100%"><tr>' . "\n";
	echo '<td align="left" valign="middle" width="31%">' . $lastWeekLink . "</td>\n";
	echo '<td align="center" valign="middle" width="38%"><span class="thick">' . $targetTitle . '</span></td>';
	echo '<td align="right" valign="middle" width="31%">' . $nextWeekLink . '</td></tr></table><br />';

	// draw week

	$dayNum  = $target['wday'];

	echo '<table border="1" width="100%" cellpadding="2" cellspacing="0" class="gcal-month">' . "\n";
	echo '<tr>';
	for ($j = 0; $j < 7; ++$j) {
		echo '<th width="14%" height="20" valign="middle" align="center"><span class="thick">' . dayName($dayNum) . "</span></th>\n";
		$dayNum = ($dayNum + 1) % 7;
	}
	echo "</tr>\n<tr>";

	$y = $year;
	$m = $month;
	$d = $day;
	$dayNum  = $target['wday'];
	$catMap = array(); // category to ID map for filtering of events via Javascript
	for ($i = 0; $i < 7; ++$i) {
		$dayLink = '<a href="' . viewDayHref($y, $m, $d, '', $printable) . '" class="day-link">' . $d .
			'</a>';
		$dayContent = isset($events[$d]) ? formatEvents($y, $m, $d, $events[$d], $printable, $catMap) : '';
		$today = ($curDay == $d && $curMonth == $m && $curYear == $y);
		$class = 'day';
		if ($today) {
			$class = 'today';
		} else if (in_array($dayNum, $config['weekends'])) {
			$class = 'weekend';
		}
		echo '<td height="40" valign="top" class="' . $class . '">' . $dayLink . "<br />$dayContent</td>\n";

		if ($d == $nDays) {
			$d = 1;
			if ($m == 12) {
				$m = 1;
				++$year;
			} else {
				++$m;
			}
		} else {
			++$d;
		}
		$dayNum = ($dayNum + 1) % 7;
	}
	echo '</tr></table><br />';

	if ($config['show_cat_legend']) {
		displayCatLegend($catMap);
		echo '<br />';
	}

	// go to current week logic

	$fdotw = $config['first_day_of_week'];
	$gnuDays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	$fdotwName = $gnuDays[$fdotw];

	$todayTs = mktime(0, 0, 0, $curMonth, $curDay, $curYear);
	$todayInfo = getdate($todayTs);
	$lastInfo = getdate(strtotime('last ' . $fdotwName, $todayTs));

	$thisWeek = ($year == $curYear && $month == $curMonth && $day == $curDay && $fdotw == $todayInfo['wday']) ||
		($year == $lastInfo['year'] && $month == $lastInfo['mon'] && $day == $lastInfo['mday'] && 
		 $fdotw != $todayInfo['wday']);

	if (!$thisWeek) {
		if ($todayInfo['wday'] == $fdotw) {
			$thisWeekY = $curYear;
			$thisWeekM = $curMonth;
			$thisWeekD = $curDay;
		} else {
			$thisWeekY = $lastInfo['year'];
			$thisWeekM = $lastInfo['mon'];
			$thisWeekD = $lastInfo['mday'];
		}

		$gotoThisWeek = '<a href="' . viewWeekHref($thisWeekY, $thisWeekM, $thisWeekD, $printable) . '">' .
			_VIEW_WEEK_GOTO_THIS_WEEK . '</a>';
		echo '<br /><div class="text-center">' . $gotoThisWeek . '</div><br />' . "\n";
	}
}

///////////////////////////////////////////////////////////////////////

if (isset($_POST['weekSelect'])) {
	list($year, $month, $day) = explode('-', $_POST['weekSelect']);
	$printable = isset($_POST['printable']);
} else {
	list($curYear, $curMonth, $curDay) = explode(',', date('Y,n,j'));
	$year = (isset($_GET['y'])) ? intval($_GET['y']) : $curYear;
	$month = (isset($_GET['m'])) ? intval($_GET['m']) : $curMonth;
	$day = (isset($_GET['d'])) ? intval($_GET['d']) : $curDay;
	$printable = isset($_GET['printable']);
}

if ($printable) {
	printableHeader();
} else {
	include 'header.php';
	OpenTable();
}

viewWeek($year, $month, $day, $printable);

if ($printable) {
	printableFooter();
} else {
	CloseTable();
	include 'footer.php';
}

///////////////////////////////////////////////////////////////////////

?>