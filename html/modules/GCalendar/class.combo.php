<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// class.combo.php - This file is part of GCalendar
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
// PHP 4 classes for working with SELECT HTML form elements (aka
// "combo boxes").
//
///////////////////////////////////////////////////////////////////////

class Combo {
	var $items;
	var $selKey;
	var $selKeys = array();
	var $enabled = true;
	var $onChange = '';
	var $attrs = array();
	var $titles = array();

	function __construct($name, $items, $selKey = '') {
		$this->attrs['name'] = $name;
		$this->attrs['id']	= preg_replace('/^(\w+)\[\d*\]$/', '$1', $name);
		$this->items			= $items;

		if ($selKey != '') {
			$this->selKey = $selKey;
		} else { // pick first key in items array 
			$this->selKey = count($this->items) > 0 ? key($this->items) : '';
		}
	}

	function select($key) {
		if (is_array($key)) {
			$this->selKeys = $key;
		} else {
			$this->selKey = $key;
		}
	}

	function enable($to = true) {
		$this->enabled = $to;
	}

	function setOnChange($to) {
		$this->attrs['onchange'] = $to;
	}

	function size($to) {
		$this->attrs['size'] = intval($to);
	}

	function multiple() {
		$this->attrs['multiple'] = 'multiple';
	}

	function html() {
		$dis = $this->enabled ? '' : ' disabled="disabled"';
		$s = '<select' . $dis;

		foreach ($this->attrs as $attr => $value) {
			$s .= ' ' . $attr . '="' . $value . '"';
		}

		$s .= ">\n";

		$isMultiple = isset($this->attrs['multiple']);

		foreach ($this->items as $key => $value) {
			if ($isMultiple) {
				$sel = in_array($key, $this->selKeys) ? 'selected="selected"' : '';
			} else {
				$sel = $this->selKey == $key ? 'selected="selected"' : '';
			}
			$title = isset($this->titles[$key]) ? ' title="' . $this->titles[$key] . '"' : '';

			$s .= "<option value=\"$key\" $sel$title>$value</option>\n";
		}
		$s .= '</select>' . "\n";
		return $s;
	}

	function display() {
		echo $this->html();
	}

	function setTitles($titles) {
		$this->titles = $titles;
	}
}

///////////////////////////////////////////////////////////////////////

class NumericCombo extends Combo {
	function __construct($name, $min, $max, $selKey = '', $step = 1) {
		$items = array();
		for ($i = $min; $i <= $max; $i += $step) {
			$items[$i] = $i;
		}
		parent::__construct($name, $items, $selKey);
	}
}

?>