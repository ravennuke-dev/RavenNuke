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
if (is_user($user)) {
	Header('Location: modules.php?name=' . $module_name . '&op=userinfo&username=' . $cookie[1]);
} else {
	include_once 'header.php';
	// removed by menelaos dot hetnet dot nl
	//title(_USERREGLOGIN);
	Show_YA_menu();
	if ($ya_config['servermail'] == 1) {
		OpenTable();
		echo '<form action="modules.php?name=' . $module_name . '" method="post">';
		echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr>';
		echo '<td colspan="2"><img src="modules/' . $module_name . '/images/warning.png" alt="" align="left" width="40" height="40" />';
		echo '<span class="content"><strong>' . _PASSWORDLOST . '</strong> ' . _NOPROBLEM . '</span></td></tr><tr><td width="100%">';
		echo '<table border="0">';
		echo '<tr><td align="right">' . _NICKNAME . ':</td><td><input type="text" name="username" size="15" maxlength="25" /></td></tr>';
		echo '<tr><td colspan="2" align="center"><strong>--' . _OR . '--</strong></td></tr>';
		echo '<tr><td align="right">' . _EMAIL . ':</td><td><input type="text" name="user_email" size="15" maxlength="50" /></td></tr>';
		echo '<tr><td>' . _CONFIRMATIONCODE . ':</td><td><input type="text" name="code" size="11" maxlength="10" /></td></tr></table><br />';
		echo '</td><td valign="top">';
		echo '<input type="hidden" name="op" value="mailpasswd" />';
		echo '<input type="submit" value="' . _SENDPASSWORD . '" /><br />';
		echo '</td></tr></table></form>';
		CloseTable();
	} else {
		title(_SERVERNOMAIL);
	}
	include_once 'footer.php';
}
?>