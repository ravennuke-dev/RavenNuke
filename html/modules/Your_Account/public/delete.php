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
$check = $cookie[1];
$result = $db->sql_query('SELECT user_id, username, user_password FROM ' . $user_prefix . '_users WHERE username=\'' . $check . '\'');
list($uid, $uname, $pass) = $db->sql_fetchrow($result);
OpenTable();
echo '<p class="option" align="center">' . _SUREDELETE . '<br /><a href="modules.php?name=' . $module_name
	. '&amp;op=deleteconfirm&amp;uid=' . $uid . '&amp;code=' . $pass . '"><span class="thick">' . _YES . '</span></a> ' . _OR
	. ' <a href="modules.php?name=' . $module_name . '"><span class="thick">' . _NO . '</span></a></p>';
CloseTable();
include_once 'footer.php';
?>