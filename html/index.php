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
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

require_once 'mainfile.php';

global $admin_file, $db, $prefix, $ThemeSel;

if (isset($op) && ($op == 'ad_click') && isset($bid)) {
	$bid = intval($bid);
	$sql = 'SELECT `clickurl` FROM `' . $prefix . '_banner` WHERE `bid`=\'' . $bid . '\'';
	$result = $db->sql_query($sql);
	list($clickurl) = $db->sql_fetchrow($result, SQL_NUM);
	if ($result) $db->sql_freeresult($result);
	$result = $db->sql_query('UPDATE `' . $prefix . '_banner` SET `clicks`=clicks+1 WHERE `bid`=\'' . $bid . '\'');
	update_points(21);
	Header('Location: ' . $clickurl);
	die();
}

define('MODULE_FILE', true);
define('HOME_FILE', true);
$_SERVER['PHP_SELF'] = 'modules.php';

$result = $db->sql_query('SELECT `main_module` FROM `' . $prefix . '_main`');
if ($result) {
	$row = $db->sql_fetchrow($result, SQL_ASSOC);
	if (isset($row['main_module'])) {
		$name = $row['main_module'];
	} else {
		$name = '';
	}
} else {
	$name = '';
}

include_once 'includes/RWS_WhoIsWhere/wiw.inc.php';

if (!isset($file)) {
	$file = 'index';
} else {
	$file = trim($file);
}

if (stripos_clone($file, '..')) {
	include_once 'header.php';
	include_once 'footer.php';
} else {
	if (file_exists('themes/' . $ThemeSel . '/modules/' . $name . '/' . $file . '.php')) {
		$modpath = 'themes/' . $ThemeSel . '/';
	} else {
		$modpath = '';
	}
	$modpath .= 'modules/' . $name . '/' . $file . '.php';
	if (file_exists($modpath)) {
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
		$result = $db->sql_query('SELECT * FROM `' . $prefix . '_modules` WHERE `title`=\'' . $name . '\'');
		$row = $db->sql_fetchrow($result, SQL_ASSOC);
		$mod_active = $row['active'];
		$view = $row['view'];
		$groups = $row['groups'];
		$mod_group = $row['mod_group'];
		if ($result) $db->sql_freeresult($result);
			$canView = ($view == 0) || ($view == 1 && isset($user) && ($mod_group <= 0 || is_group($user, $name))) || (isset($admin) && is_admin($admin))
						|| ($view == 3 && paid()) || ($view >= 4 && in_groups($groups));
		if ($canView) {
				include_once $modpath;
		} else {
			define('INDEX_FILE', true);
			include_once 'header.php';
			include_once 'footer.php';
		}
	} else {
		define('INDEX_FILE', true);
		include_once 'header.php';
		/* Why do we need to load a module on the home page?
		OpenTable();
		if (is_admin($admin)) {
			echo '<div class="text-center"><span class="thick">' . _HOMEPROBLEM . '</span><br /><br />[ <a href="' . $admin_file . '.php?op=modules">' . _ADDAHOME . '</a> ]</div>';
		} else {
			echo '<div class="text-center">' . _HOMEPROBLEMUSER . '</div>';
		}
		CloseTable();*/
		include_once 'footer.php';
	}
}

?>