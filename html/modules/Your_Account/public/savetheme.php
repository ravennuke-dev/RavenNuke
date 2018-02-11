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
$user_id = intval($user_id);
$theme = check_html($theme, 'nohtml');
$check = $cookie[1];
$check2 = $cookie[2];
$result = $db->sql_query('SELECT user_id, user_password FROM ' . $user_prefix . '_users WHERE username=\'' . $check . '\'');
$row = $db->sql_fetchrow($result);
$vuid = intval($row['user_id']);
$ccpass = $row['user_password'];
if (($user_id == $vuid) AND ($check2 == $ccpass)) {
	// montego - following line commented out as $theme_id is not set in chgtheme.php - old code?
	//$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_style=\'' . $theme_id . '\' WHERE user_id=\'' . $user_id . '\'');
	$theme = ((!preg_match('/[.]/', $theme) && file_exists('themes/' . $theme . '/theme.php'))) ? $theme : ''; // RN0001003
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET theme=\'' . $theme . '\' WHERE user_id=\'' . $user_id . '\'');
	getusrinfo($user);
	yacookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $userinfo['umode'], $userinfo['uorder'], $userinfo['thold'], $userinfo['noscore'], $userinfo['ublockon'], $userinfo['theme'], $userinfo['commentmax']);
	Header('Location: modules.php?name=' . $module_name . '&theme=' . $theme);
}
?>