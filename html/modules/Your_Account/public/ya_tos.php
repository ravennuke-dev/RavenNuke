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
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
/********************************************************/
/* TOS Pluggin sixonetonoffun http://www.netflake.com   */
/* Simple Agree to Terms mod for RNYA                  */
/********************************************************/
include_once 'header.php';
title(_USERAPPLOGIN);
$sel1 = ' checked="checked"';
$sel2 = '';
$username = (isset($username)) ? check_html(trim($username) , 'nohtml') : '';
$user_password = (isset($user_password)) ? htmlspecialchars(stripslashes($user_password), ENT_QUOTES, _CHARSET) : '';
$random_num = (isset($random_num)) ? check_html(trim($random_num) , 'nohtml') : '';
$gfx_check = (isset($gfx_check)) ? check_html(trim($gfx_check) , 'nohtml') : '';
$mode = (isset($mode)) ? check_html(trim($mode) , 'nohtml') : 'nested';
$unwatch = (isset($unwatch)) ? check_html(trim($unwatch) , 'nohtml') : '';
$f = (isset($f)) ? intval($f) : '';
$p = (isset($p)) ? intval($p) : '';
$t = (isset($t)) ? intval($t) : '';
$redirect = (isset($redirect)) ? check_html(trim($redirect) , 'nohtml') : '';
$nextop = (isset($nextop)) ? check_html(trim($nextop) , 'nohtml') : '';
// menelaos: shows top table (differently for new users and current members)
OpenTable();
if ($op == 'new_user') {
	echo '<div style="height: 50px; text-align: center;"><img src="modules/' . $module_name . '/images/warning.png" align="left" width="40" height="40" alt="" />' . _YATOSINTRO2 . '</div>';
} elseif ($setinfo['agreedtos'] == '0') {
	echo '<div style="height: 50px; text-align: center;"><img src="modules/' . $module_name . '/images/warning.png" align="left" width="40" height="40" alt="" />' . _YATOSINTRO1 . '</div>';
}
CloseTable();
echo '<br />';
// menelaos: shows bottom table (differently for new users and current members)
OpenTable();
if ($op == 'new_user') {
	echo '<form name="tos1" action="modules.php?name=' . $module_name . '&amp;op=new_user" method="post">';
	echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr align="center"><td colspan="2">';
} elseif ($setinfo['agreedtos'] == '0') {
	echo '<form name="tos1" action="modules.php?name=' . $module_name . '" method="post">';
	echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr align="center"><td colspan="2">';
	// These hidden fields are necessary for new user registration
	if ($op != 'tos') {
		echo '<input type="hidden" name="username" value="' . $username . '" />';
		echo '<input type="hidden" name="user_password" value="' . $user_password . '" />';
		echo '<input type="hidden" name="random_num" value="' . $random_num . '" />';
		echo '<input type="hidden" name="gfx_check" value="' . $gfx_check . '" />';
		echo '<input type="hidden" name="mode" value="' . $mode . '" />';
		echo '<input type="hidden" name="unwatch" value="' . $unwatch . '" />';
		echo '<input type="hidden" name="f" value="' . $f . '" />';
		echo '<input type="hidden" name="t" value="' . $t . '" />';
		echo '<input type="hidden" name="p" value="' . $p . '" />';
	}
	echo '<input type="hidden" name="redirect" value="' . $redirect . '" />';
	echo '<input type="hidden" name="op" value="' . $nextop . '" />';
}
if (isset($_POST['coppa_yes'])) {
	if ($_POST['coppa_yes'] == 1) {
		echo '<input type="hidden" name="coppa_yes" value="1" />';
	}
}
if (isset($_POST['tos_yes']) AND $ya_config['tos'] == 1 and $_POST['tos_yes'] == '0') {
	if (!isset($setinfo['agreedtos'])) $setinfo['agreedtos'] = '';
	if ($setinfo['agreedtos'] == '0') {
		echo '</td><td align="center"><span style="color:red">' . _YATOS5 . '</span>';
	} else {
		echo '</td><td align="center"><span style="color:red">' . _YATOS4 . '</span>';
	}
	echo '<p><input type="submit" value="' . _YA_GOBACK . '" /></p>';
} else {
	/*
	* Go get the TOS text from the Legal module
	*/
	include_once NUKE_CLASSES_DIR . 'class.legal_document.php';
	$ya_objDoc = new Legal_Document();
	$ya_legalFailure = false;
	if (!$ya_objDoc->dbGetDocument((int)$ya_config['legal_did_TOS'], $lgl_langS)) {
		$ya_legalFailure = true;
	} elseif (!$ya_objDoc->CheckText() && $lgl_langS != $language) {
		if (!$ya_objDoc->dbGetDocument((int)$ya_config['legal_did_TOS'], $language)) {
			$ya_legalFailure = true;
		} elseif(!$ya_objDoc->CheckText()) {
			echo $ya_objDoc->html();
			echo '</td></tr></table></form>';
			CloseTable();
			include 'footer.php';
			die();
		}
	}
	if ($ya_legalFailure) {
		setcookie('user');
		if (trim($ya_config['cookiepath']) != '') setcookie('user', 'expired', time() - 604800, $ya_config['cookiepath']); //correct the problem of path change
		$db->sql_query('DELETE FROM ' . $prefix . '_session WHERE uname=\'' . addslashes($username) . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_session');
		$db->sql_query('DELETE FROM ' . $prefix . '_bbsessions WHERE session_user_id=\'' . $r_uid . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbsessions');
		unset($user);
		echo $lgl_lang['LGL_ERRDB_DOCNOTFOUND'];
		echo '</td></tr></table></form>';
		CloseTable();
		include 'footer.php';
		die();
	}
	echo '<table width="100%" cellspacing="0" cellpadding="20" border="1"><tr><td>';
	echo '<p align="center" class="title">' . $sitename . ' - ' . $ya_objDoc->getDocTitle() . '</p>';
	echo $ya_objDoc->html();
	echo '</td></tr></table>';
	echo '</td></tr>';
	echo '<tr align="right"><td width="100%" valign="top">';
	echo _YATOS3 . '<br />';
	echo '</td><td align="left">';
	echo '<input type="radio" name="tos_yes" value="1"' . $sel2 . ' />' . _YES . '<br />';
	echo '<input type="radio" name="tos_yes" value="0"' . $sel1 . ' />' . _NO . '<br />';
	echo '<br /><input type="submit" value="' . _YA_CONTINUE . '" />';
}
echo '</td></tr>';
echo '</table></form>';
CloseTable();
include_once 'footer.php';
?>