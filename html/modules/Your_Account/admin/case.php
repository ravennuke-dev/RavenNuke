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
switch($op) {
    case 'mod_users':
    case 'modifyUser':
    case 'yaActivateUser':
    case 'yaActivateUserConf':
    case 'yaAddUser':
    case 'yaAddUserConf':
    case 'yaAdmin':
    case 'yaApproveUser':
    case 'yaApproveUserConf':
    case 'yaCredits':
    case 'yaCustomFields':
    case 'yaDeleteUser':
    case 'yaDeleteUserConf':
    case 'yaDelField':
    case 'yaDelFieldConf':
    case 'yaDenyUser':
    case 'yaDenyUserConf':
    case 'yaDetailsUser':
    case 'yaDetailTemp':
    case 'yaListPending':
    case 'yaListUsers':
    case 'yaModifyTemp':
    case 'yaModifyTempConf':
    case 'yaModifyUserConf':
    case 'yaRemoveUser':
    case 'yaRemoveUserConf':
    case 'yaResendMail':
    case 'yaResendMailConf':
    case 'yaRestoreUser':
    case 'yaRestoreUserConf':
    case 'yaSaveFields':
    case 'yaSearchUser':
    case 'yaSuspendUser':
    case 'yaSuspendUserConf':
    case 'yaUsers':
    case 'yaUsersConfig':
    case 'yaUsersConfigSave':
    include_once('modules/'.$module_name.'/admin/index.php');
    break;
}
?>