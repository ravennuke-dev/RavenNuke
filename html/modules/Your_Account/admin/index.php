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
/*	CNB Your Account http://www.phpnuke.org.br
/*	NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('ADMIN_FILE')) {
	header('Location: ../../../index.php');
	die ();
}

global $prefix, $db, $admin_file; 

$radminsuper = is_mod_admin('admin');
$radminuser = is_mod_admin($module_name);

if ($radminsuper == 1 || $radminuser == 1) { 
	require_once('modules/Your_Account/includes/constants.php');
	define('YA_ADMIN', true);
	if(!isset($op)) $op = '';
	include_once('modules/'.$module_name.'/includes/functions.php'); 
	if (!isset($ya_config)) $ya_config = ya_get_configs();

	get_lang($module_name);

	switch($op) { 
		default:
			$pagetitle = ': '._USERADMIN;
			include('header.php');
			title(_USERADMIN);
			amain();
			include('footer.php');
			break;
		case 'yaCredits':
			include('modules/'.$module_name.'/admin/credits.php');
			break;
		case 'yaCustomFields':
			include('modules/'.$module_name.'/admin/addfield.php');
			break;
		case 'yaSaveFields':
			csrf_check();
			include('modules/'.$module_name.'/admin/saveaddfield.php');
			break;
		case 'yaDelField':
			include('modules/'.$module_name.'/admin/delfield.php');
			break;
		case 'yaDelFieldConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/delfieldconf.php');
			break;
		case 'yaUsersConfig':
			include('modules/'.$module_name.'/admin/userconfig.php');
			break;
		case 'yaUsersConfigSave':
			csrf_check();
			include('modules/'.$module_name.'/admin/userconfigsave.php');
			break;
		case 'yaUsers':
		case 'yaListPending':
			include('modules/'.$module_name.'/admin/users.php');
			break;
		case 'yaAddUser':
			include('modules/'.$module_name.'/admin/adduser.php');
			break;
		case 'yaAddUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/adduserconf.php');
			break;
		case 'yaSearchUser':
			include('modules/'.$module_name.'/admin/searchuser.php');
			break;
		case 'yaListUsers':
			include('modules/'.$module_name.'/admin/listusers.php');
			break;
		case 'approveUser':
			include('modules/'.$module_name.'/admin/approveuser.php');
			break;
		case 'yaApproveUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/approveuserconf.php');
			break;
		case 'yaActivateUser':
			include('modules/'.$module_name.'/admin/activateuser.php');
			break;
		case 'yaActivateUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/activateuserconf.php');
			break;
#		case 'yaAutoSuspend':
#			include('modules/'.$module_name.'/admin/autosuspend.php');
#			break;
#		case 'CookieConfig':
#			include('modules/'.$module_name.'/admin/menucookies.php');
#			break;
#		case 'CookieConfigSave':
#			include('modules/'.$module_name.'/admin/menucookiessave.php');
#			break;
		case 'yaDeleteUser':
			include('modules/'.$module_name.'/admin/deleteuser.php');
			break;
		case 'yaDeleteUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/deleteuserconf.php');
			break;
		case 'yaDenyUser':
			include('modules/'.$module_name.'/admin/denyuser.php');
			break;
		case 'yaDenyUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/denyuserconf.php');
			break;
		case 'yaDetailTemp':
			include('modules/'.$module_name.'/admin/detailstemp.php');
			break;
		case 'yaDetailsUser':
			include('modules/'.$module_name.'/admin/detailsuser.php');
			break;
		case 'yaModifyTemp':
			include('modules/'.$module_name.'/admin/modifytemp.php');
			break;
		case 'yaModifyTempConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/modifytempconf.php');
			break;
		case 'modifyUser':
			include('modules/'.$module_name.'/admin/modifyuser.php');
			break;
		case 'yaModifyUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/modifyuserconf.php');
			break;
#		case 'yaPromoteUser':
#			include('modules/'.$module_name.'/admin/promoteuser.php');
#			break;
#		case 'yaPromoteUserConf':
#			include('modules/'.$module_name.'/admin/promoteuserconf.php');
#			break;
		case 'yaRemoveUser':
			include('modules/'.$module_name.'/admin/removeuser.php');
			break;
		case 'yaRemoveUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/removeuserconf.php');
			break;
		case 'yaResendMail':
			include('modules/'.$module_name.'/admin/resendmail.php');
			break;
		case 'yaResendMailConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/resendmailconf.php');
			break;
		case 'yaRestoreUser':
			include('modules/'.$module_name.'/admin/restoreuser.php');
			break;
		case 'yaRestoreUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/restoreuserconf.php');
			break;
		case 'yaSuspendUser':
			include('modules/'.$module_name.'/admin/suspenduser.php');
			break;
		case 'yaSuspendUserConf':
			csrf_check();
			include('modules/'.$module_name.'/admin/suspenduserconf.php');
			break;
	}
} else { 
	echo 'Access Denied'; 
} 

?>