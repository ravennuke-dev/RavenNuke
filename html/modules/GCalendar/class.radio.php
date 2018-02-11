<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// class.radio.php - This file is part of GCalendar
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
// PHP 4 class representing a related set of HTML radio button objects
//
///////////////////////////////////////////////////////////////////////

class RadioButtons {
	var $name;
	var $items;
	var $horizontal;
	var $mashed = '';

	// $name - name of the radio buttons
	// $items - an array of arrays where the key is the button value, and the array has elements
	//		 'label' : button label
	//		 'enabled' : true or false to enable/disable the button; if not set, enabled is assumed
	//	 E.g. $items = array(4 => array('label' => 'Red'), 5 => array('label' => 'Blue', 'enabled' => false));
	// $horizontal - when true, the buttons are arranged horizontally; false => vertically

	function __construct($name, $items = array(), $horizontal = true) {
		$this->name		 = $name;
		$this->items		= $items;
		$this->horizontal = $horizontal;
		$this->mashed	  = count($items) > 0 ? key($this->items) : '';
	}

	// To set which button will be initially mashed down. If this function is not called, it is assumed
	// the first item in the items array will be mashed. $key is the items array key.

	function mash($key) {
		$this->mashed = $key;
	}

	function horizontal($to) {
		$this->horizontal = $to;
	}

	function addButton($value, $label, $enabled = true) {
		$this->items[$value] = array('label' => $label, 'enabled' => $enabled);
		if ($this->mashed == '') {
			$this->mashed = key($this->items);
		}
	}

	function display() {
		echo $this->html();
	}

	function html() {
		$s = '';
		$first = true;
		foreach ($this->items as $value => $attrs) {
			$checked = '';
			if ($this->mashed == $value) {
				$checked = 'checked="checked" ';
			}
			$disabled = '';
			if (isset($attrs['enabled']) && !$attrs['enabled']) {
				$disabled = 'disabled="disabled" ';
			}

			$s .= '<input name="' . $this->name . '" type="radio" value="' . $value . '"' .
				$checked . $disabled . ' />' . $attrs['label'];
			$s .= $this->horizontal ? '&nbsp;' : '<br />';
		}
		return $s;
	}
}

?>