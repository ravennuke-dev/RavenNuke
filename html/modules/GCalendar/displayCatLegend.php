<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// displayCatLegend.php - This file is part of GCalendar
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
// This file contains the function(s) needed to display the category
// legend for the monthly and daily views.
//
///////////////////////////////////////////////////////////////////////

function displayCatLegend($catMap) {
	global $module_name;

	if (count($catMap) <= 0) {
		return;
	}

	echo '<div class="text-center"><script type="text/javascript">var gcalCatMap = new Object();' . "\n";
	foreach ($catMap as $id => $events) {
		$index = 'gcal-cat-' . $id;
		echo 'gcalCatMap[\'' . $index . '\'] = [';
		$i = 0;
		foreach ($events as $evId) {
			if ($i > 0) {
				echo ', ';
			}
			echo $evId;
			++$i;
		}
		echo '];' . "\n";
	}
	echo '</script>';
	echo '<script type="text/javascript" src="modules/' . $module_name . '/displayCatLegend.js"></script>';

	echo '<table border="0" cellspacing="0" cellpadding="3" class="gcal-cat-legend">';
	echo '<caption align="top">' . _CAT_TABLE_LEGEND . '</caption>';

	$categories = getCategories();
	$nCols = 5;
	$i = 0;
	foreach ($categories as $id => $catName) {
		if (isset($catMap[$id])) {
			$chkName = 'gcal-cat-' . $id;

			if (($i % $nCols) == 0) {
				echo ($i == 0) ? '<tr>' : '</tr><tr>';
			}

			echo '<td><input type="checkbox" name="' . $chkName . '" id="' . $chkName . '" value="' . $id .
				'" checked="checked" onclick="gcalCatClick(this.name, this.checked)" />';
			echo '<span class="gcal-cat-' . $id . '">' . $catName . '</span></td>';

			++$i;
		}
	}
	if ($i > 0) {
		echo '</tr>';
	}
	echo '</table><br />';
		
	if (count($catMap) > 1) {
		echo '<a href="javascript:gcalCatSetAll(true);">' . _SHOW_ALL . 
			'</a> | <a href="javascript:gcalCatSetAll(false);">' . _SHOW_NONE . '</a>';
	}

	echo '</div>';
}

?>