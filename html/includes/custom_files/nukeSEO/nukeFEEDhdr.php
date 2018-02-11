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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../../index.php');
	exit('Access Denied');
}

global $op;
# Load link rel=alternates (XML feeds, etc.)
if(!defined('ADMIN_FILE')) include_once('modules/Feeds/linkAlternateFeeds.php');
if(defined('ADMIN_FILE')) include_once('includes/nukeSEO/seoHelpCSS.php');
if(defined('ADMIN_FILE') and ($op=='nfConfigMod' or $op=='nfSaveConfig' or $op=='nfDisableMod' or $op=='nfEnableMod')) include_once('includes/nukeSEO/colorsphere.php');
# Load JavaScript, other scripts required in HEAD tag
if(defined('ADMIN_FILE')) {
	include_once('includes/nukeSEO/forms/dhtmlxCombo.php');
    include_once('includes/boxover/boxover.php');
}

?>
