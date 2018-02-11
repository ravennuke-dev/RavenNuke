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
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}

global $admin, $user, $sitekey, $gfx_chk, $admin_file, $ya_config;
include_once 'modules/Your_Account/includes/functions.php';
if (!isset($ya_config)) $ya_config = ya_get_configs();

$content='<div class="text-center">';
if (!is_user($user)) {
	$content .= '<form action="modules.php?name=Your_Account" method="post">';
	$content .= _NICKNAME . '<br />';
	$content .= '<input type="text" name="username" size="10" maxlength="25" /><br />';
	$content .= _PASSWORD . '<br />';
	$content .= '<input type="password" name="user_password" size="10" maxlength="20" /><br />';
	$content .= security_code(array(2,4,5,7), 'stacked');
	$content .= '<br />';
	$content .= '<input type="hidden" name="op" value="login" alt="login" />';
	$content .= '<input id="login_submit" type="submit" alt="login" value="' . _LOGIN . '" /></form>';
	$content .= _ASREGISTERED;
} else {
	$content .= '[ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]';
}
if (is_admin($admin) AND is_user($user)) {
	$content .= '<br />' . _ADMIN . '<br />[ <a href="' . $admin_file . '.php?op=logout">' . _LOGOUT . '</a> ]';
}
$content .= '</div>';
?>