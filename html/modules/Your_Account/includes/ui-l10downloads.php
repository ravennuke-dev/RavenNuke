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

if (is_active('Downloads')) {
	// Last 10 Download Links Approved
	$result = $db->sql_query('SELECT `lid`, `title` FROM `' . $prefix . '_nsngd_downloads` WHERE `submitter`=\'' . addslashes($usrinfo['username']) . '\' ORDER BY `date` DESC LIMIT 0,10');
	if (($db->sql_numrows($result) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' , $usrinfo['username'] , '\'s ' , _LAST10DOWNLOAD , ':</strong><ul>';
		while (list($lid, $title) = $db->sql_fetchrow($result)) {
			echo '<li><a href="modules.php?name=Downloads&amp;op=getit&amp;lid=' . $lid . '">' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</a></li>';
		}
		echo '</ul>';
		CloseTable();
	}
}

?>