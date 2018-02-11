<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2013, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}
// set some vars up front for notice errors
if (!isset($articlecomm)) $articlecomm = '';
require_once('modules/Your_Account/includes/constants.php');
if (!defined('RNYA')) {
	header('Location: ../../index.php');
	die();
}
$module_name = basename(dirname(__FILE__));
if (is_user($user)) {
	require_once('mainfile.php');
	get_lang($module_name);
	include_once('modules/' . $module_name . '/includes/functions.php');
	global $prefix, $db, $user_prefix, $ya_config, $thmcount;
	if (!isset($ya_config)) $ya_config = ya_get_configs();
	function menuimg($gfile) {
		$ThemeSel = get_theme();
		if (file_exists('themes/' . $ThemeSel . '/images/menu/' . $gfile . '.gif')) {
			$menuimg = 'themes/' . $ThemeSel . '/images/menu/' . $gfile . '.gif';
		} elseif (file_exists('themes/' . $ThemeSel . '/images/menu/' . $gfile . '.png')) {
			$menuimg = 'themes/' . $ThemeSel . '/images/menu/' . $gfile . '.png';
		} else {
			$menuimg = 'modules/Your_Account/images/' . $gfile . '.png';
		}
		return ($menuimg);
	}
	// Set TD widths
	$tds = 3;
	$handle = opendir('themes');
	while ($file = readdir($handle)) {
		if ((!preg_match('/[.]/', $file))) {
			$thmcount++;
		}
	}
	closedir($handle);
	if (is_active('Private_Messages')) {
		$tds++;
	}
	if (is_active('Journal')) {
		$tds++;
	}
	if (($thmcount > 1) AND ($ya_config['allowusertheme'] == 1)) {
		$tds++;
	}
	if ($articlecomm == 1) {
		$tds++;
	}
	if ($ya_config['allowuserdelete'] == 1) {
		$tds++;
	}
	$tdwidth = (int)((100 / $tds));
	// END Set TD widths
	function nav($main_up = 0) {
		global $module_name, $admin, $ya_config, $thmcount, $tdwidth, $articlecomm;
		echo '<table border="0" width="100%" align="center"><tr>';
		// uncomment to link to your donations page or change the url to your subscriptions url : Guardian )
		//$menuimg = menuimg('donate.gif');
		//echo '<td width="'.$tdwidth.'%" valign="top" align="center" class="content">';
		//echo '<a href="modules.php?name=Donations"><img src="'.$menuimg.'" border="0" alt="Donate" title="Subscribe"></a><br />';
		//echo '<a href="modules.php?name=Donations">Donate</a>';
		//echo '</td>';
		$menuimg = menuimg('info');
		echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
		echo '<a href="modules.php?name=Your_Account&amp;op=edituser"><img src="' . $menuimg . '" border="0" alt="' . _CHANGEYOURINFO . '" title="' . _CHANGEYOURINFO . '" /></a><br />';
		echo '<a href="modules.php?name=Your_Account&amp;op=edituser">' . _ACCTCHANGE . '</a>';
		echo '</td>';
		$menuimg = menuimg('home');
		echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
		echo '<a href="modules.php?name=Your_Account&amp;op=edithome"><img src="' . $menuimg . '" border="0" alt="' . _CHANGEHOME . '" title="' . _CHANGEHOME . '" /></a><br />';
		echo '<a href="modules.php?name=Your_Account&amp;op=edithome">' . _ACCTHOME . '</a>';
		echo '</td>';
		if ($articlecomm == 1) {
			$menuimg = menuimg('comments');
			echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm"><img src="' . $menuimg . '" border="0" alt="' . _CONFIGCOMMENTS . '" title="' . _CONFIGCOMMENTS . '" /></a><br />';
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">' . _ACCTCOMMENTS . '</a>';
			echo '</td>';
		}
		if (is_active('Private_Messages')) {
			$menuimg = menuimg('messages');
			echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
			echo '<a href="modules.php?name=Private_Messages"><img src="' . $menuimg . '" border="0" alt="' . _PRIVATEMESSAGES . '" title="' . _PRIVATEMESSAGES . '" /></a><br />';
			echo '<a href="modules.php?name=Private_Messages">' . _MESSAGES . '</a>';
			echo '</td>';
		}
		if (is_active('Journal')) {
			$menuimg = menuimg('journal');
			echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
			echo '<a href="modules.php?name=Journal&amp;file=edit"><img src="' . $menuimg . '" border="0" alt="' . _JOURNAL . '" title="' . _JOURNAL . '" /></a><br />';
			echo '<a href="modules.php?name=Journal&amp;file=edit">' . _ACCTJOURNAL . '</a>';
			echo '</td>';
		}
		if (($thmcount > 1) AND ($ya_config['allowusertheme'] == 1)) {
			$menuimg = menuimg('themes');
			echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
			echo '<a href="modules.php?name=Your_Account&amp;op=chgtheme"><img src="' . $menuimg . '" border="0" alt="' . _SELECTTHETHEME . '" title="' . _SELECTTHETHEME . '" /></a><br />';
			echo '<a href="modules.php?name=Your_Account&amp;op=chgtheme">' . _ACCTTHEME . '</a>';
			echo '</td>';
		}
		if ($ya_config['allowuserdelete'] == 1) {
			$menuimg = menuimg('delete');
			echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
			echo '<a href="modules.php?name=Your_Account&amp;op=delete"><img src="' . $menuimg . '" border="0" alt="' . _DELETEACCT . '" height="48" width="48" /></a><br />';
			echo '<a href="modules.php?name=Your_Account&amp;op=delete">' . _DELETEACCT . '</a>';
			echo '</td>';
		}
		$menuimg = menuimg('exit');
		echo '<td width="' . $tdwidth . '%" valign="top" align="center" class="content">';
		echo '<a href="modules.php?name=Your_Account&amp;op=logout"><img src="' . $menuimg . '" border="0" alt="' . _LOGOUTEXIT . '" title="' . _LOGOUTEXIT . '" /></a><br />';
		echo '<a href="modules.php?name=Your_Account&amp;op=logout">' . _ACCTEXIT . '</a>';
		echo '</td>';
		echo '</tr></table>';
		if ($main_up != 1) {
			echo '<br /><div class="text-center">[ <a href="modules.php?name=Your_Account">' . _RETURNACCOUNT . '</a> ]</div>';
		}
	}
}
?>