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
if ($broadcast_msg == 1 && defined('LOGGEDIN_SAME_USER')) {
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><strong>' . _BROADCAST . '</strong><br /><br />' . _BROADCASTTEXT . '<br /><br />';
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	echo '<input type="hidden" name="who" value="' . $username . '" />';
	echo '<input type="hidden" name="op" value="broadcast" />';
	echo '<input type="text" size="60" maxlength="255" name="the_message" />&nbsp;&nbsp;<input type="submit" value="' . _SEND . '" />';
	echo '</form></div>';
	CloseTable();
}
?>