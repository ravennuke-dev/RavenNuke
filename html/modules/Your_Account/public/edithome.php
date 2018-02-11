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
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once 'header.php';
	title(_HOMECONFIG);
	OpenTable();
	nav();
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	if ($user_news == 1) {
		echo '<strong>' . _NEWSINHOME . '</strong> ' . _MAX127 . ' ';
		echo '<input type="text" name="storynum" size="4" maxlength="3" value="' . $userinfo['storynum'] . '" />';
		echo '<br /><br />';
	} else {
		echo '<input type="hidden" name="storynum" value="' . $storyhome . '" />';
	}
	if ($userinfo['ublockon'] == 1) {
		$sel = ' checked="checked"';
	} else {
		$sel = '';
	}
	if ($broadcast_msg == 1) {
		if ($userinfo['broadcast'] == 1) {
			$sel1 = ' checked="checked"';
			$sel2 = '';
		} elseif ($userinfo['broadcast'] == 0) {
			$sel1 = '';
			$sel2 = ' checked="checked"';
		}
		echo '<strong>' . _MESSAGEACTIVATE . '</strong><input type="radio" name="broadcast" value="1"' . $sel1 . ' /> ' . _YES . ' &nbsp;&nbsp;<input type="radio" name="broadcast" value="0"' . $sel2 . ' />' . _NO . '<br /><br />';
	} else {
		echo '<input type="hidden" name="broadcast" value="1" />';
	}
	echo '<input type="checkbox" name="ublockon"' . $sel . ' />';
	echo '<strong>' . _ACTIVATEPERSONAL . '</strong>';
	echo '<br />' . _CHECKTHISOPTION;
	echo '<br />' . _YOUCANUSEHTML . '<br />';
	echo '<textarea cols="55" rows="5" name="ublock">' . htmlspecialchars($userinfo['ublock'], ENT_QUOTES, _CHARSET) . '</textarea>';
	echo '<br /><br />';
	echo '<input type="hidden" name="username" value="' . $userinfo['username'] . '" />';
	echo '<input type="hidden" name="user_id" value="' . $userinfo['user_id'] . '" />';
	echo '<input type="hidden" name="op" value="savehome" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" />';
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
} else {
	mmain($user);
}
?>