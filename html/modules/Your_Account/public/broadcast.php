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
getusrinfo($user);
if (!isset($who)) $who = '';
if ((is_user($user)) AND (strtolower($who) == strtolower($cookie[1])) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	$who = $cookie[1];
	include_once 'header.php';
	title(_BROADCAST);
	OpenTable();
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_public_messages WHERE who=\'' . $who . '\''));
	$the_message = addslashes(check_html($the_message, 'nohtml')); // RN0001003
	if (!empty($the_message) AND $numrows == 0) {
		$the_time = time();
		$who = htmlspecialchars(stripslashes($who), ENT_QUOTES, _CHARSET);
		$db->sql_query('INSERT INTO ' . $prefix . '_public_messages VALUES (NULL, \'' . $the_message . '\', \'' . $the_time . '\', \'' . $who . '\')');
		update_points(20);
		echo '<div class="text-center">' . _BROADCASTSENT . '<br /><br />[ <a href="modules.php?name=' . $module_name . '">' . _RETURNPAGE . '</a> ]</div>';
	} else {
		echo '<div class="text-center">' . _BROADCASTNOTSENT . '<br /><br />[ <a href="modules.php?name=' . $module_name . '">' . _RETURNPAGE . '</a> ]</div>';
	}
	CloseTable();
	include_once 'footer.php';
}
?>