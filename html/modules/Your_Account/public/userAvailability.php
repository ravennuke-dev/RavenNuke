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
if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
require_once 'modules/Your_Account/includes/constants.php';
include_once 'modules/Your_Account/includes/functions.php';
if (!isset($ya_config)) $ya_config = ya_get_configs();
get_lang('Your_Account');
$ya_username = trim(strtolower($_REQUEST['ya_username']));
if ($ya_username == '') echo 'false';
else echo ya_userCheckB($ya_username);
?>