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
if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}
$module_name = basename(dirname(dirname(__FILE__)));
get_lang($module_name); 

// menelaos: dynamically insert the version number in the admin config panel image Copyright (c) 2004 :-)
include_once('modules/'.$module_name.'/includes/functions.php');
adminmenu($admin_file.'.php?op=yaAdmin', _EDITUSERS, 'users.png'); 

?>