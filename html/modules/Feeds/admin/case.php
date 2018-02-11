<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
    Header('Location: ../../../'.$admin_file.'.php');
    die();
}

$module_name = basename(substr(__FILE__, 0, -15));
@require_once('includes/nukeSEO/nukeSEOfunctions.php');
seoGetLang($module_name);

switch($op) {
	case 'nukeFEED':
	case 'nfEditFeed':
	case 'nfSaveFeed':
  case 'nfEditFeedSave':
	case 'nfDeleteFeed':
  case 'nfDeleteConfirm':
	case 'nfConfigMod':
	case 'nfSaveConfig':
	case 'nfDisableMod':
	case 'nfEnableMod':
  case 'nfDelSubscript':
	case 'nfEditSubscript':
	case 'nfSaveSubscript':
		include("modules/$module_name/admin/index.php");
		break;
}

?>
