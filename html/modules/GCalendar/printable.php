<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// printable.php - This file is part of GCalendar
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
// printable.php - Contains functions to support printable calendar
// views.
// 
///////////////////////////////////////////////////////////////////////

function printableHeader() {
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' .
		'<html><head><title></title>' .
		'<style type="text/css">' .
		'body { color: black; background-color: white; }' .
		'td.weekend { color: black; background-color: #cccccc; }' .
		'a:link		{text-decoration: none; color: black; }' .
		'a:visited	{text-decoration: none; color: black; }' .
		'a:hover	  {text-decoration: underline; color: black; }' .
		'a:active	 {text-decoration: underline; color: black; }' .
		'a.day-link { font-size: 20px; color: black; }' .
		'</style><body>';
}

function printableFooter() {
	echo '<br /><br /><div style="text-align:center;">:: <a href="javascript:history.back()">' . _GCAL_GO_BACK . '</a> ::</div>';
	echo '</body></html>';
}

?>