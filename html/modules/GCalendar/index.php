<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// index.php - This file is part of GCalendar
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
// index.php is the default module entry point; it displays a monthly
// calendar view.
//
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name);

///////////////////////////////////////////////////////////////////////
require_once 'modules/' . $module_name . '/viewmonth.php';
require_once 'modules/' . $module_name . '/printable.php';

if (isset($printable)) {
	$printable = true;
	printableHeader();
} else {
	$printable = false;
	include 'header.php';
	OpenTable();
}

$y = isset($y) ? $y : 0;
$m = isset($m) ? $m : 0;
viewMonth($y, $m, $printable);

if ($printable) {
	printableFooter();
} else {
	CloseTable();
	include 'footer.php';
}

?>