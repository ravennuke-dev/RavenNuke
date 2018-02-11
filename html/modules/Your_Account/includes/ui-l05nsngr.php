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
	header('Location: ../../../../index.php');
	die();
}
// Group Memberships
if (defined('LOGGEDIN_SAME_USER') && file_exists('./modules/Groups/includes/nsngr_func.php')) {
	$result11 = $db->sql_query('SELECT gid FROM ' . $prefix . '_nsngr_users WHERE uid=\'' . intval($usrinfo['user_id']) . '\' ORDER BY gid');
	if (($db->sql_numrows($result11) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . $usrinfo['username'] . '\'s ' . _MEMBERGROUPS . ':</strong><ul>';
		while (list($gid) = $db->sql_fetchrow($result11)) {
			list($gname) = $db->sql_fetchrow($db->sql_query('SELECT gname FROM ' . $prefix . '_nsngr_groups WHERE gid=\'' . $gid . '\''));
			echo '<li>' . $gname;
			if (is_admin($admin)) {
				echo ' (' . $gid . ')';
			}
			list($edate) = $db->sql_fetchrow($db->sql_query('SELECT edate FROM ' . $prefix . '_nsngr_users WHERE uid=\'' . intval($usrinfo['user_id']) . '\' AND gid=\'' . $gid . '\''));
			if ($edate != 0) {
				echo '&nbsp;&nbsp;- <span class="italic">' . _EXPIRES . ' ' . date('d F Y', $edate) . '</span>';
			} else {
				echo '&nbsp;&nbsp;- <span class="italic">' . _NOTSET . '</span>';
			}
			echo '</li>';
		}
		echo '</ul>';
		CloseTable();
	}
}
?>