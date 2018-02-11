<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// viewmonth.php - This file is part of GCalendar
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
// viewmonth.php - responsible for monthly calendar views
//
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

global $module_name;
require_once 'modules/' . $module_name . '/gcal.inc.php';
require_once 'modules/' . $module_name . '/class.combo.php';
require_once 'modules/' . $module_name . '/common.inc.php';
require_once 'modules/' . $module_name . '/getMonthlyEvents.php';
require_once 'modules/' . $module_name . '/displayCatLegend.php';
require_once 'modules/' . $module_name . '/formatEvents.php';

///////////////////////////////////////////////////////////////////////

function viewMonth($year = 0, $month = 0, $printable = false) {
	list($curYear, $curMonth, $curDay) = explode(',', date('Y,n,j'));

	$config = getConfig();
	$title = $config['title'];
	$titleImg = $config['image'];
	$minYear = intval($config['min_year']);
	$maxYear = intval($config['max_year']);
	$fdotw = intval($config['first_day_of_week']);

	$month = intval($month);
	$year  = intval($year);
	if ($month < 1 or $month > 12) {
		$month = $curMonth;
	}
	if ($year < $minYear or $year > $maxYear) {
		$year = $curYear;
	}

	$nextMonth = $month == 12 ? 1 : $month + 1;
	$prevMonth = $month == 1 ? 12 : $month - 1;

	$nextMonthName = monthName($nextMonth);
	$prevMonthName = monthName($prevMonth);

	$nextYear = $nextMonth == 1 ? $year + 1 : $year;
	$prevYear = $prevMonth == 12 ? $year - 1 : $year;

	// get number of days in the month

	$firstTs = mktime(0, 0, 0, $month, 1, $year); // the 1st as a timestamp
	$nDays = date('t', $firstTs);

	// find out what day of the week the first is on

	$firstInfo = getdate($firstTs);
	$first = $firstInfo['wday'];
	$monthName = monthName($firstInfo['mon']);

	$padDays = ($first >= $fdotw) ? $first - $fdotw : 7 - ($fdotw - $first);
	$nRows = ceil(($nDays + $padDays) / 7);

	$gotoThisMonth = '';
	if ($month != $curMonth) {
		$gotoThisMonth = '<a href="' . viewMonthHref($curYear, $curMonth, $printable) . '">' .
			_VIEW_MONTH_GOTO_THIS_MONTH . '</a>';
	}

	// print out header line

	printHeader($curYear, $curMonth, $curDay, $config, $year, $month, $printable);

	// print out links to previous and current month

	$prevMonthLink = '';
	if ($prevYear >= $minYear) {
		$prevMonthLink = '<a href="' . viewMonthHref($prevYear, $prevMonth, $printable) . '">&lt;&lt; ' . 
			$prevMonthName . '</a>';
	}
	$nextMonthLink = '';
	if ($nextYear <= $maxYear) {
		$nextMonthLink = '<a href="' . viewMonthHref($nextYear, $nextMonth, $printable) . '">' . 
			$nextMonthName . ' &gt;&gt;</a>';
	}

	echo '<table border="0" width="100%"><tr>';
	echo '<td width="31%" align="left">' .  $prevMonthLink . "</td>\n";
	echo '<td width="38%" align="center">' . "<span class=\"title\">$monthName $year</span></td>\n";
	echo '<td width="31%" align="right">' .  $nextMonthLink . "</td>\n";
	echo '</tr></table><br />' . "\n";

	// get the events for this month

	$events = getMonthlyEvents($year, $month);

	// draw the month
	// any table, th, & td attributes are provided as defaults; css should be used to override
	//
	$dayMap = array();
	for ($i = 0; $i < 7; ++$i) {
		$dayMap[$i] = ($fdotw + $i) % 7;
	}

	echo '<table border="1" width="100%" cellpadding="2" cellspacing="0" class="gcal-month">' . "\n";
	echo '<tr>';
	for ($j = 0; $j < 7; ++$j) {
		echo '<th width="14%" height="20" valign="middle" align="center"><span class="thick">' . dayName($dayMap[$j]) . "</span></th>\n";
	}
	echo "</tr>\n";

	$catMap = array(); // category to ID map for filtering of events via Javascript
	$weekStarts = array(); // for weekly views
	$nCell = -$padDays;
	$day = 1;
	for ($i = 0; $i < $nRows; ++$i) {
		echo '<tr>';

		for ($j = 0; $j < 7; ++$j) {
			if ($nCell < 0 || $nCell >= $nDays) {
				echo '<td height="40" class="no-day">&nbsp;</td>' . "\n";
			} else {
				if ($j == 0) { // capture the start of each week
					$weekStarts[] = toSqlDate($year, $month, $day);
				}

				$dayLink = '<a href="' . viewDayHref($year, $month, $day, '', $printable) . '" class="day-link">' . $day .
					'</a>';

				$dayContent = isset($events[$day]) ? formatEvents($year, $month, $day, $events[$day], $printable, $catMap) : '';
				$today = ($curDay == $day && $curMonth == $month && $curYear == $year);

				$class = 'day';
				if ($today) {
					$class = 'today';
				} else if (in_array($dayMap[$j], $config['weekends'])) {
					$class = 'weekend';
				}

				echo '<td height="40" valign="top" class="' . $class . '">' . $dayLink . "<br />$dayContent</td>\n";
				++$day;
			}
			++$nCell;
		}
		echo '</tr>';
	}
	echo '</table><br />';

	displayWeeklyViewForm($weekStarts, $config['long_date_format'], $printable);

	if ($config['show_cat_legend']) {
		displayCatLegend($catMap);
	}

	echo (!empty($gotoThisMonth))?"<br /><div class='text-center'>$gotoThisMonth</div><br />\n":'';
}

function displayWeeklyViewForm($weekStarts, $dateFormat, $printable) {
	$parts = explode('-', $weekStarts[0]);
	if ($parts[2] != '01') {
		$ts = strtotime('-1 week', mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
		$fw = getdate($ts);
		array_unshift($weekStarts, toSqlDate($fw['year'], $fw['mon'], $fw['mday']));
	}

	echo '<form action="' . GCAL_MOD_LINK . '&amp;file=viewweek" method="post">' . "\n";
	echo '<div class="text-center">' . _VIEW_WEEK_OF;

	$items = array();
	foreach ($weekStarts as $date) {
		$items[$date] = formatDate($date, $dateFormat);
	}

	$weekCombo = new Combo('weekSelect', $items);
	$weekCombo->display();

	echo '<input type="submit" value="' . _GO_WEEK_VIEW . '" />';
	if ($printable) {
		echo '<input type="hidden" name="printable" value="' . ($printable ? 1 : 0) . '" />';
	}
	echo '</div></form><br />';
}

?>
