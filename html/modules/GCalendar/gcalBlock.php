<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// gcalBlock.php - This file is part of GCalendar
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
// GCalBlock is a class used in the default blocks that come with GCalendar.
//
///////////////////////////////////////////////////////////////////////

// helper function
function gcalBuildTitleTip($events) {
	$title = '';
	foreach ($events as $event) {
		if ($title != '') {
			$title .= '&nbsp;' . "\n";
		}
		$title .= '&bull;&nbsp;' . gcalSpecialChars($event['title']);
	}
	return $title;
}

class GCalBlock {
	var $year;
	var $month;
	var $day;
	var $config;
	var $blockConfig;
	var $currEvents;

	// constructor:
	// $year - block year
	// $month - block month
	// $day - block day (today)
	// $config - GCalendar's configuration from a getConfig() call
	// $blockConfig - associative array of block options:
	// 'maxTitle'	 - maximum length of title for block (includes ...)
	// 'eventPrefix' - This gets prefixed onto events, customize as you wish
	// 'maxEvents'	- maximum # of events listed in block
	// 'lookahead'	- how many months (including current one) to look for events
	// 'twoColumn'	- true for 2 column event display (date - title) or false for date and
	//					  title on separate lines
	// 'excludeCats' - an array of category numbers to exclude from the block
	//
	function __construct($year, $month, $day, $config, $blockConfig) {
		$this->year = $year;
		$this->month = $month;
		$this->day = $day;
		$this->config = $config;
		$this->blockConfig = $blockConfig;
		$this->currEvents = $this->_getFilteredEvents($year, $month);
	}

	// returns a string of HTML for the block calendar:
	function calendar() {
		$fdotw = $this->config['first_day_of_week'];

		// get number of days in the month

		$firstTs = mktime(0, 0, 0, $this->month, 1, $this->year);	// the 1st as a timestamp
		$nDays = date('t', $firstTs);

		// find out what day of the week the first is on

		$firstInfo = getdate($firstTs);
		$first = $firstInfo['wday'];
		$monthName = monthName($firstInfo['mon']);

		$padDays = ($first >= $fdotw) ? $first - $fdotw : 7 - ($fdotw - $first);
		$nRows = ceil(($nDays + $padDays) / 7);

		$nextMonth = $this->month == 12 ? 1 : $this->month + 1;
		$prevMonth = $this->month == 1 ? 12 : $this->month - 1;
		$nextYear  = $nextMonth == 1 ? $this->year + 1 : $this->year;
		$prevYear  = $prevMonth == 12 ? $this->year - 1 : $this->year;

		$prevMonthLink = '';
		if ($prevYear >= $this->config['min_year']) {
			$prevMonthLink = '<a href="' . viewMonthHref($prevYear, $prevMonth) . '">&lt;&lt;&nbsp;</a>';
		}
		$nextMonthLink = '';
		if ($nextYear <= $this->config['max_year']) {
			$nextMonthLink = '<a href="' . viewMonthHref($nextYear, $nextMonth) . '">&nbsp;&gt;&gt;</a>';
		}
		$monthLink = '<a href="' . viewMonthHref($this->year, $this->month) . '">' . $monthName . ' ' . $this->year . '</a>';

		$content = '<table border="0" cellpadding="0" cellspacing="0"><tr>' .
			'<td width="10%" align="left">' . $prevMonthLink .  '</td>' .
			'<td width="80%" align="center">' . $monthLink . '</td>' .
			'<td width="10%" align="right">' . $nextMonthLink . '</td>' .
			'</tr></table><br />';

		$dayMap = array();
		for ($i = 0; $i < 7; ++$i) {
			$dayMap[$i] = ($fdotw + $i) % 7;
		}

		$content .= '<table class="gcal-block-cal">' . "\n";
		$content .= '<tr>';
		for ($j = 0; $j < 7; ++$j) {
			$content .= '<th><span class="thick">' . dayLetter($dayMap[$j]) . "</span></th>\n";
		}
		$content .= '</tr>' . "\n";

		$nCell = -$padDays;
		$day = 1;
		for ($i = 0; $i < $nRows; ++$i) {
			$content .= '<tr>';

			for ($j = 0; $j < 7; ++$j) {
				if ($nCell < 0 || $nCell >= $nDays) {
					$content .= '<td class="no-day">&nbsp;</td>' . "\n";
				} else {
					if (array_key_exists($day, $this->currEvents)) {
						$class = ($day == $this->day) ? 'today' : 'day';
						$tip = gcalBuildTitleTip($this->currEvents[$day]);
						$td = '<a class="' . $class . '" href="' . viewDayHref($this->year, $this->month, $day) .
							'" title="' . $tip . '">' . $day . '</a>';
						$class = ($day == $this->day) ? 'today-event' : 'day-event';
					} else {
						$td = $day;
						$class = ($day == $this->day) ? 'today-no-event' : 'day-no-event';
					}

					$content .= '<td class="' . $class . '">' . $td . '</td>';
					++$day;
				}
				++$nCell;
			}
			$content .= '</tr>';
		}
		$content .= "</table>\n";

		if (isset($this->blockConfig['force_center']) && $this->blockConfig['force_center'] && !empty($content)) {
			$content = '<div class="text-center">' . $content . '</div>';
		}

		return $content;
	}

	// returns a string of HTML for the upcoming events table:
	function upcomingEvents() {
		$content = '';

		// determine how many upcoming events we can display from the current month

		$currEvents = $this->currEvents;
		reset($currEvents);
		while (($key = key($currEvents)) && $key < $this->day) {
			unset($currEvents[$key]);  // unset() apparently resets the array 
		}

		$events = array();
		$this->_buildEvents($this->year, $this->month, $currEvents, $events);

		// now add months from the future until we hit our limits in look ahead and events

		$numMonths = 1;
		$m = $this->month;
		$y = $this->year;
		$lookahead = $this->blockConfig['lookahead'];
		$maxEvents = $this->blockConfig['maxEvents'];

		while ($numMonths < $lookahead && count($events) < $maxEvents) {
			$m = $m == 12 ? 1 : $m + 1;
			$y = $m == 1 ? $y + 1 : $y;

			$this->_buildEvents($y, $m, $this->_getFilteredEvents($y, $m), $events);
			++$numMonths;
		}

		if (count($events) > 0) {
			$content .= '<table class="gcal-block-events">';
			$lastDate = '';
			foreach($events as $row) {
				$date  = $row[0];
				$title = $row[1];

				if ($this->blockConfig['twoColumn']) {
					$content .= '<tr><td>' . $date . '</td><td>' . $title . '</td></tr>';
				} else {
					if ($lastDate != $date) {
						$content .= '<tr><td class="text-center">' . $date . '</td></tr>';
					}

					$content .= '<tr><td>' . $title . '</td></tr>';
				}
				$lastDate = $date;
				$content .= "\n";
			}
			$content .= '</table>';
		}

		if (isset($this->blockConfig['force_center']) && $this->blockConfig['force_center'] && !empty($content)) {
			$content = '<div class="text-center">' . $content . '</div>';
		}

		return $content;
	}

	// private function
	function _buildEvents($year, $month, $monthEvents, &$events) {
		$maxTitle = $this->blockConfig['maxTitle'] - 3;

		$left = max(0, $this->blockConfig['maxEvents'] - count($events));
		$n = 0;
		foreach ($monthEvents as $day => $dayEvents) {
			foreach ($dayEvents as $info) {
				if ($n >= $left) {
					break;
				}
				$date  = formatDate(toSqlDate($year, $month, $day), $this->config['short_date_format']);
				$date  = '<a href="' . viewDayHref($year, $month, $day) . '">' . $date . '</a>';
				$title = $info['title'];

				if (strlen($title) >= $maxTitle) {
					$title = substr($title, 0, $maxTitle);
					$title .= '...';
				}

				$title = $this->blockConfig['eventPrefix'] . 
					'<a href="' . viewDayHref($year, $month, $day, $info['id']) . '">' . $title . '</a>';
				$events[]= array($date, $title);
				++$n;
			}
		}
	}

	function _getFilteredEvents($year, $month) {
		$events = getMonthlyEvents($year, $month);
		$filteredEvents = array();
		if (isset($this->blockConfig['excludeCats']) && count($this->blockConfig['excludeCats']) > 0) {
			foreach ($events as $day => $eventList) {
				foreach ($eventList as $n => $event) {
					if (!in_array($event['category'], $this->blockConfig['excludeCats'])) {
						$filteredEvents[$day][$n] = $event;
					}
				}
			}
			return $filteredEvents;
		}
		return $events;
	}
}

?>