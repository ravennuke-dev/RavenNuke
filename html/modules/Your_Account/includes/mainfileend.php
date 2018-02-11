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
	header('Location: ../../../index.php');
	exit('Access Denied');
}

if (isset($user)) {
	$uinfo = getusrinfo($user);
	$ulevel = $uinfo['user_level'];
	$uactive = $uinfo['user_active'];
	if (($ulevel < 1) OR ($uactive < 1)) {
		unset($user);
		unset($cookie);
		$sql = 'DELETE FROM `' . $prefix . '_bbsessions` WHERE `session_user_id`="' . $uinfo['user_id'] . '"';
		$db->sql_query($sql);
	}
}
if ((isset($_GET['name']) && $_GET['name'] == 'Forums') && (isset($_GET['file']) && $_GET['file'] == 'profile') && (isset($_GET['mode']) && $_GET['mode'] == 'register')) Header('Location: modules.php?name=Your_Account&op=new_user');
if (isset($user) && is_user($user)) {
	$lv = time();
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET lastsitevisit=\'' . $lv . '\' WHERE user_id=\'' . $uinfo['user_id'] . '\'');
	list($sessiontime) = $db->sql_fetchrow($db->sql_query('SELECT time FROM ' . $prefix . '_session WHERE uname=\'' . $uinfo['username'] . '\''));
	// modified by menelaos dot hetnet dot nl to reduce amount of sql-queries
	$config = array();
	/*
	 * TODO: montego - cycling through all the config values is wasteful as only two are even used.
	 * We should tighten this up - and consider removing the whole cookie-test feature.
	 */
	$configresult = $db->sql_query('SELECT config_name, config_value FROM ' . $user_prefix . '_users_config');
	while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		$config[$config_name] = $config_value;
	}
	$ya_config = $config;
	require_once NUKE_MODULES_DIR . 'Your_Account/includes/constants.php';
	$cookieinactivity = $ya_config['cookieinactivity'];
	$cookiepath = $ya_config['cookiepath'];
	// modified by menelaos dot hetnet dot nl to reduce amount of sql-queries
	// If user hasn't accepted updated TOS, display it until it has been accepted

	if (!isset($op)) { $op = ''; }  // mantis #0001317

	if ($ya_config['tos'] == 1 AND $op != 'tos' AND $op != 'logout' AND $ya_config['tosall'] == 1 AND $uinfo['agreedtos'] != 1) {
		if (!isset($_POST['tos_yes']) or $_POST['tos_yes'] != 1) {
			$break = explode('/', $_SERVER['SCRIPT_NAME']);
			$qS = $_SERVER['QUERY_STRING'];
			$redirect = $break[count($break) - 1];
			if ($qS > '') $redirect = rawurlencode(htmlentities($redirect . '?' . $qS));
			header('Location: modules.php?name=Your_Account&op=tos&redirect=' . $redirect);
			die();
		}
	}
	if (($cookieinactivity != '-') AND (($sessiontime + $cookieinactivity < $lv))) {
		cookiedecode($user);
		$r_uid = $uinfo['user_id'];
		$r_username = $uinfo['username'];
		setcookie('user');
		if (trim($cookiepath) != '') setcookie('user', '', '', $ya_config['cookiepath']);
		$db->sql_query('DELETE FROM ' . $prefix . '_session WHERE uname=\'' . $r_username . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_session');
		$db->sql_query('DELETE FROM ' . $prefix . '_bbsessions WHERE session_user_id=\'' . $r_uid . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbsessions');
		unset($user);
		unset($cookie);
		header('Location: modules.php?name=Your_Account');
		die();
	};
	// WARNING THIS SECTION OF CODE CAN SLOW SITE LOAD TIME DOWN!!!!!!!!!!!!!
	// IF YOU DO NOT WANT TO USE THIS CODE YOU DO NOT HAVE TO.
	// THIS FUCTION IS IN USER ADMIN AND CAN BE TRIGGERED ONLY
	// WHEN THE ADMIN WANTS IT RUN.
	if (($ya_config['autosuspend'] > 0) AND ($ya_config['autosuspendmain'] == 1)) {
		$st = time() - $ya_config['autosuspend'];
		$susresult = $db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE lastsitevisit <=' . $st . ' AND user_level > 0');
		while (list($sus_uid) = $db->sql_fetchrow($susresult)) {
			$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_level=\'0\', user_active=\'0\' WHERE user_id=\'' . $sus_uid . '\'');
		}
	}
} else {
	$configresult = $db->sql_query('SELECT config_value FROM ' . $user_prefix . '_users_config WHERE config_name = \'cookiepath\'');
	list($config_value) = $db->sql_fetchrow($configresult);
	setcookie('RNYA_test1', 'value1');
	setcookie('RNYA_test2', 'value2', time() + 3600);
	setcookie('RNYA_test3', 'value3', time() + 3600, '/');
	setcookie('RNYA_test4', 'value4', time() + 3600, $config_value);
}
?>
