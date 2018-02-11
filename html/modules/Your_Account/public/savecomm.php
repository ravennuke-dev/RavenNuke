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
$check = $cookie[1];
$check2 = $cookie[2];
$result = $db->sql_query('SELECT user_id, user_password FROM ' . $user_prefix . '_users WHERE username=\'' . $check . '\'');
$row = $db->sql_fetchrow($result);
$vuid = intval($row['user_id']);
$ccpass = $row['user_password'];
if (($user_id == $vuid) AND ($check2 == $ccpass)) {
	if(isset($noscore) && $noscore == true) $noscore = 1; else $noscore = 0;
	if (!in_array($umode, array('thread', 'flat', 'nested', 'nocomments'))) $umode = 'thread';
	if ((int)$uorder > 2 || (int)$uorder < 0) $uorder = 0;
	if ((int)$thold > 5 || (int)$thold < -1) $thold = 0;
	$commentmax = intval($commentmax);
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET umode=\'' . $umode . '\', uorder=\'' . $uorder . '\', thold=\'' . $thold . '\', noscore=\'' . $noscore . '\', commentmax=\'' . $commentmax . '\' WHERE user_id=\'' . $user_id . '\'');
	getusrinfo($user);
	// montego - fixed following line to set the cookie values based upon what was just updated as due to the use of
	// static variables within the getusrinfo() function, not sure these will get updated!
	yacookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $umode, $uorder, $thold, $noscore, $userinfo['ublockon'], $userinfo['theme'], $commentmax);
	Header('Location: modules.php?name=' . $module_name);
}
?>