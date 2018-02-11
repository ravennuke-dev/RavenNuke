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
include_once 'header.php';
$uid = intval($_GET['uid']);
$code = check_html($_GET['code'], 'nohtml');
setcookie('user');
$result = $db->sql_query('SELECT user_email, user_website, username, user_password FROM ' . $user_prefix . '_users WHERE user_id=\'' . $uid . '\'');
list($email, $url, $uname, $pass) = $db->sql_fetchrow($result);
if ($code == $pass) {
	if ($ya_config['senddeletemail'] == 1 && $ya_config['servermail'] == 1) {
		$to = $adminmail;
		$subject = "$sitename - "._MEMDEL;
		$message = "$uname has been deleted from $sitename.\r\n";
		$message .= '-----------------------------------------------------------' . "\r\n";
		$message .= _YA_NOREPLY;
		ya_mail($to, $subject, $message, $email);
	}
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET name=\'' . _MEMDEL . '\', user_email=\'' . md5($email) . '\', user_password=\'\', user_website=\'\', user_sig=\'\', user_regdate=\'Non 0, 0000\', user_level=\'-1\', user_active=\'0\', user_allow_pm=\'0\' WHERE user_id=\'' . $uid . '\'');
	$r_uid = $cookie[0];
	$r_uname = $cookie[1];
	$result = $db->sql_query('DELETE FROM ' . $prefix . '_session where uname=\'' . $r_uname . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_session');
	$result = $db->sql_query('DELETE FROM ' . $prefix . '_bbsessions where session_user_id=\'' . $r_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbsessions');
	echo '<META HTTP-EQUIV="refresh" content="2;URL=' . $nukeurl . '">';
	title(_ACCTDELETE);
} else {
	title(_YOUBAD);
}
include_once 'footer.php';
?>