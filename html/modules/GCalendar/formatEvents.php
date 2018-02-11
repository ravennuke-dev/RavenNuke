<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// formatEvents.php - This file is part of GCalendar
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
// formatEvents.php - responsible for formatting events on the monthy and
// weekly calendar views.
//
///////////////////////////////////////////////////////////////////////

function formatEvents($year, $month, $day, $events, $printable, &$catMap) {
	static $id = 0;

	if (is_array($events)) {
		$result = '';
		for ($i = 0; $i < count($events); ++$i) {
			$cat = $events[$i]['category'];

			$result .= '<span id="gcalid-' . $id . '">' . _VIEW_MONTH_BULLET . 
				'<a href="' . viewDayHref($year, $month, $day, $events[$i]['id'], $printable) . '">' .
				'<span class="gcal-cat-' . $cat . '">' .
				$events[$i]['title'] . '</span></a></span><br />' . "\n";

			$catMap[$cat][] = $id;
			++$id;
		}
		$result .= '<br />';
		return $result;
	}
	return '';
}

?>