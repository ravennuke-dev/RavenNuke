<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// class.checkboxes.php - This file is part of GCalendar
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
// PHP 4 class representing an array of HTML checkbox objects
//
///////////////////////////////////////////////////////////////////////

class Checkboxes {
	var $name;
	var $items;
	var $horizontal;

	// $name - name of the checkbox input array
	// $items - array of arrays; for each checkbox provide an array that contains the following:
	//	 'value' - value of the checkbox when checked; if not set this defaults to 1
	//	 'label' - text label that will appear beside the checkbox
	//	 'checked' - the value for this key will be true/false if it should be initially checked; if
	//		 not set it will be assumed false
	//	 Each key in the $items array will be used as the key in the posted array
	//	 E.g. $items = array('opt1' => array('value' => 'on', 'label' => 'Option 1', 'checked' => true),
	//								'opt2' => array('value' => 'on', 'label' => 'Option 2', 'checked' => false))
	//
	// $horizontal - when true, boxes are arranged horizontally; false => vertically

	function __construct($name, $items = array(), $horizontal = true) {
		$this->name = $name;
		$this->items = $items;
		$this->horizontal = $horizontal;
	}

	function addItem($key, $label, $checked = false, $value = 1) {
		$this->items[$key] = array('label' => $label, 'checked' => (bool) $checked, 'value' => $value);
	}

	function display() {
		echo $this->html();
	}

	function html() {
		$s = '';
		foreach ($this->items as $key => $item) {
			$s .= $this->htmlFor($key);
			$s .= $this->horizontal ? '&nbsp;' : '<br />';
		}
		return $s;
	}

	// Returns the HTML for the checkbox with the key $key. This is useful if the caller
	// wants to arrange the checkboxes himself (say in a table, for example).

	function htmlFor($key) {
		$id = 'id="' . $this->name . '_' . $key . '"';

		$s = '<input name="' . $this->name . '[' . $key . ']" ' . $id . ' type="checkbox" ' .
			'value ="' . (isset($this->items[$key]['value']) ? $this->items[$key]['value'] : 1) . '"' .
			($this->items[$key]['checked'] ? ' checked="checked"' : '') . ' />' . 
			$this->items[$key]['label'];

		return $s;
	}
}

?>