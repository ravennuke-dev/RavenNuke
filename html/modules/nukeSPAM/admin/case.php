<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 */
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
	case 'nukeSPAM':
	case 'nukeSPAMConfig':
	case 'nukeSPAMCheck':
	case 'nukeSPAMSaveConfig':
	case 'nukeSPAMWL':
		include_once('modules/'.$module_name.'/admin/index.php');
		break;
}
?>
