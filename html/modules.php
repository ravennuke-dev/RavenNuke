<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

define('MODULE_FILE', true);
require_once 'mainfile.php';
$module = 1;
if (!isset($name)) $name = '';
$name = addslashes(check_html(trim($name), 'nohtml')); //Fixes SQL Injection
/////////////////
if(!defined('XHR')) include_once 'includes/RWS_WhoIsWhere/wiw.inc.php';
/////////////////
if(!isset($file)) { $file = 'index'; }
if(isset($name)) {
	if(stristr($name, 'http://')) { die('Hi and Bye'); }
	if(stristr($file, 'http://')) { die('Hi and Bye'); }
	$modstring = strtolower($_SERVER['QUERY_STRING']);
	if(stripos_clone($modstring, '&user=') AND ($name == 'Private_Messages' || $name == 'Forums' || $name == 'Members_List')) header('Location: index.php');
	global $nukeuser, $db, $prefix;
	// PHP8: Deprecated: base64_decode(): Passing null to parameter #1 ($string) of type string is deprecated FIX: added ?? ''
	$nukeuser = base64_decode($user ?? '');
	$nukeuser = addslashes($nukeuser);
	$result = $db->sql_query('SELECT * FROM `'.$prefix.'_modules` WHERE `title` = \'' . $name . '\'');
	$row = $db->sql_fetchrow($result);
	$mod_active = intval($row['active']);
	$view = intval($row['view']);
	$groups = $row['groups'];
	$mod_group = intval($row['mod_group']);
	if(($mod_active == 1) OR (isset($admin) AND is_admin($admin))) {
		if(!isset($file)) { $file = 'index'; }
		if(preg_match('/\.\./', $name) || preg_match('/\.\./', $file)) {
			$pagetitle = '- '._SOCOOL;
			include_once 'header.php';
			OpenTable();
			echo '<div class="text-center"><span class="thick">' , _SOCOOL , '</span><br />'
				, _GOBACK , '</div>';
			CloseTable();
			include_once 'footer.php';
			die();
		} else {
			$ThemeSel = get_theme();
			if(file_exists('themes/' . $ThemeSel . '/modules/' . $name . '/' . $file . '.php')) {
				$modpath = 'themes/' . $ThemeSel . '/';
			} else {
				$modpath = '';
			}
			$modpath .= 'modules/' . $name . '/' . $file . '.php';
			if(file_exists($modpath)) {
				// The module's $view describes the accessibility of the module:
				// 0 - All Visitors
				// 1 - Registered Users Only
				// 2 - Administrators Only
				// 3 - Paid Subscribers Only
				// 4 - NSN Groups Only
				// *Note: Admins can see all access levels.
				// *Note for the Users Group/Points system: If a module is set to Registered Users Only, but has a non-zero
				//  mod_group value, then the module is only available to those users who have enough points to be in that
				//  Users Group.

				$canView = ($view == 0) ||                         // all visitors
				($view == 1 && isset($user) &&                     // registered user and
				($mod_group <= 0 || is_group($user, $name))) ||    // (no points needed OR user has points)
				(isset($admin) && is_admin($admin)) ||             // is admin
				($view == 3 && paid()) ||                          // paid subscriber
				($view >= 4 && in_groups($groups));                // NSN Groups user

				if ($canView) {
					include_once($modpath);
				} else {
					$pagetitle = '- ' . _RESTRICTEDAREA;
					include_once 'header.php';
					OpenTable();
					echo '<div class="text-center"><span class="thick">' , _RESTRICTEDAREA , '</span><br />'
						, _GOBACK , '</div>';
					CloseTable();
					include_once 'footer.php';
					die();
				}
			} else {
				$pagetitle = '- ' . _FILENOTFOUND;
				include_once 'header.php';
				OpenTable();
				echo '<div class="text-center"><span class="thick">' , _FILENOTFOUND , '</span><br />'
					, _GOBACK , '</div>';
				CloseTable();
				include_once 'footer.php';
				die ();
			}
		}
	} else {
		$pagetitle = '- ' . _MODULENOTACTIVE;
		include_once 'header.php';
		OpenTable();
		echo '<div class="text-center">' , _MODULENOTACTIVE , '<br />'
			, _GOBACK , '</div>';
		CloseTable();
		include_once 'footer.php';
		die ();
	}
} else {
	$pagetitle = '- ' . _MODULENOTFOUND;
	include_once 'header.php';
	OpenTable();
	echo '<div class="text-center">' , _MODULENOTFOUND , '<br />'
		, _GOBACK , '</div>';
	CloseTable();
	include_once 'footer.php';
	die ();
}

if(!function_exists('stripos_clone')) {
	function stripos_clone($haystack, $needle, $offset=0) {
		return strpos(strtoupper($haystack), strtoupper($needle), $offset);
	}
}

?>