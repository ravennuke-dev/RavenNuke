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
	die ();
}
/********************************************************/
/* COPPA Pluggin sixonetonoffun http://www.netflake.com */
/* Minimal basic COPPA Compliance mod for RNYA         */
/********************************************************/
if (isset($_POST['coppa_yes']) AND $ya_config['coppa'] == 1) {
	$coppa = intval($_POST['coppa_yes']);
	if ($coppa != 1) {
		include_once 'header.php';
		title(_USERAPPLOGIN);
		OpenTable();
		echo '<div style="height: 50px; text-align: center;"><img src="modules/' . $module_name . '/images/warning.png" align="left" width="40" height="40" alt="" />' . _YACOPPA2 . '</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div align="center"><span class="title">' . _YACOPPA1 . '</span><br />';
		echo '<span style="color:#FF3333;">' . _YACOPPA4 . '<br />' . _YACOPPAFAX . '</span></div>';
		CloseTable();
		include_once 'footer.php';
	}
}
$sel1 = ' checked="checked"';
$sel2 = '';
include_once 'header.php';
title(_USERAPPLOGIN);
OpenTable();
echo '<div style="height: 50px; text-align: center;"><img src="modules/' . $module_name . '/images/warning.png" align="left" width="40" height="40" alt="" />' . _YACOPPA2 . '</div>';
CloseTable();
echo '<br />';
OpenTable();
OpenTable();
echo '<p align="center" class="title">' . _YACOPPA1 . '</p>';
echo '<div class="content" align="center">' . _YACOPPA3 . '</div>';
CloseTable();
echo '<form name="coppa1" action="modules.php?name=' . $module_name . '&amp;op=new_user" method="post">';
echo '<p align="center">' . _YES . '&nbsp;<input type="radio" name="coppa_yes" value="1"' . $sel2 . ' />&nbsp;';
echo _NO . '&nbsp;<input type="radio" name="coppa_yes" value="0"' . $sel1 . ' /></p>';
echo '<p align="center"><input type="submit" value="' . _YA_CONTINUE . '" />';
echo '</p></form>';
CloseTable();
include_once 'footer.php';
?>