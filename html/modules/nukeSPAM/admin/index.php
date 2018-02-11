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

// Install necessary tables, default configuration
if ( !function_exists('seoCheckInstall') ) {
	function seoCheckInstall() {
		// table creation is MySQL-specific
		global $prefix, $sitename;
		define('nukeSPAM_version', '1.0.0');
		// Create seo_config table
		$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` LIMIT 0';
		$createSQL = array();
		$createSQL[] = 'CREATE TABLE `'.$prefix.'_seo_config` (
			`config_type` varchar(150) NOT NULL,
			`config_name` varchar(150) NOT NULL,
			`config_value` text NOT NULL,
			PRIMARY KEY  (`config_type`,`config_name`)
			) ENGINE=MyISAM;';
		seoCheckCreateTable($existSQL, $createSQL);

		#$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` INTO @x where config_type = \'nukeSPAM\' LIMIT 0';
		$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` where config_type = \'nukeSPAM\' LIMIT 0 INTO @x'; 
		$createSQL = array();
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'baseMatch', '');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'debug', '0');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'logToDB', '0');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'logToTextFile', '0');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'theme', 'smoothness');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'use_reg', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'usefSpamList', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useStopForumSpam', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useBotScout', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useDNSBL', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useDroneACH', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useHTTPBLACH', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useSpamACH', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useZeusACH', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useAHBL', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useBLDE', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useProjectHoneyPot', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useSorbs', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useSpamHaus', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useSpamCop', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useDroneBL', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useTornevall', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useEFNet', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useTor', '1');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'keyfSpamList', '');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'keyStopForumSpam', '');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'keyBotScout', '');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'keyProjectHoneyPot', '');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'version_check', '0');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'version_newest', '" . nukeSPAM_version . "');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'version_number', '" . nukeSPAM_version . "');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'version_url', 'http://nukeSEO.com/modules.php?name=Downloads');";
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'version_notes', '');";
		seoCheckCreateTable($existSQL, $createSQL);

		$getValueSQL = 'SELECT config_value as value FROM `'.$prefix.'_seo_config` where config_type=\'nukeSPAM\' and config_name = \'version_number\'';
		$updateSQL = array();
		$updateSQL[] = "UPDATE `".$prefix."_seo_config` SET config_value = '".nukeSPAM_version."' where config_type='nukeSPAM' and config_name = 'version_number';";
		seoCheckUpdateTable($getValueSQL, '".nukeSPAM_version."', $updateSQL);

		// Create nukeSPAM log table
		$existSQL = 'SELECT 1 FROM `' . $prefix . '_spam_log` LIMIT 0';
		$createSQL = array();
		$createSQL[] = 'CREATE TABLE `' . $prefix . '_spam_log` (
			`slid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`request` CHAR(6) NOT NULL ,
			`username` VARCHAR(255) NOT NULL ,
			`email` VARCHAR(255) NOT NULL ,
			`ip` INT UNSIGNED NOT NULL ,
			`matched` VARCHAR(255) NOT NULL ,
			`added` INT( 11 ) NOT NULL ,
			`count` INT UNSIGNED NOT NULL
			) ENGINE=MyISAM;';
		seoCheckCreateTable($existSQL, $createSQL);

		// Create nukeSPAM whitelist table
		$existSQL = 'SELECT 1 FROM `'.$prefix.'_spam_whitelist` LIMIT 0';
		$createSQL = array();
		$createSQL[] = 'CREATE TABLE `'.$prefix.'_spam_whitelist` (
			`wlid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`wltype` CHAR( 1 ) NOT NULL ,
			`wlvalue` VARCHAR( 255 ) NOT NULL ,
			INDEX (  `wltype` ,  `wlvalue`  )
			) ENGINE=MyISAM;';
		seoCheckCreateTable($existSQL, $createSQL);

		// Add blocklist.de database
		#$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` INTO @x where config_type = \'nukeSPAM\' and config_name = \'useBLDE\' LIMIT 0';
		$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` where config_type = \'nukeSPAM\' and config_name = \'useBLDE\' LIMIT 0 INTO @x';
		$createSQL = array();
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'useBLDE', '1');";
		seoCheckCreateTable($existSQL, $createSQL);

		// Add jQuery UI Theme
		#$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` INTO @x where config_type = \'nukeSPAM\' and config_name = \'theme\' LIMIT 0';
		$existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` where config_type = \'nukeSPAM\' and config_name = \'theme\' LIMIT 0 INTO @x';
		$createSQL = array();
		$createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('nukeSPAM', 'theme', 'smoothness');";
		seoCheckCreateTable($existSQL, $createSQL);
	}
}

global $admin_file, $admin, $db, $prefix;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
	Header('Location: ../../../'.$admin_file.'.php');
	die();
}

$module_name = basename(dirname(dirname(__FILE__)));
if (function_exists('is_mod_admin')) {
	$modAdmin = is_mod_admin($module_name);
} else {
	$modAdmin = is_admin($admin);
}
if ($modAdmin) {

	// Module Definition
	seoCheckInstall();
	// Header stuff:

	#$pagetitle = ' - '._SPAM_ADMIN;
	addJSToHead('includes/jquery/jquery.js', 'file');
	addJSToHead('includes/jquery/jquery.cookie.js', 'file');
	include('header.php');
	$checktime = strtotime(date('Y-m-d', TIME()));
	$seoModule = 'nukeSPAM';
	$seoConfig = seoGetConfigs($seoModule);
	OpenTable();
	echo '<div class="text-center"><h2>nukeSPAM&trade;</h2></div>', PHP_EOL
		,'<table width="100%" border="0">', PHP_EOL
		,'<tr>', PHP_EOL
		,'<td>', seoHelp('_SPAM_CONFIG'), ' <a href="', $admin_file, '.php?op=nukeSPAMConfig">', _SPAM_CONFIG, '</a></td>', PHP_EOL
		,'<td>', seoHelp('_SPAM_WL'), ' <a href="', $admin_file, '.php?op=nukeSPAMWL">', _SPAM_WL, '</a></td>', PHP_EOL
		,'<td>', seoHelp('_SPAM_CHECK'), ' <a href="'.$admin_file, '.php?op=nukeSPAMCheck">', _SPAM_CHECK, '</a></td>', PHP_EOL
		,'<td><a href="modules.php?name=nukeSPAM">SPAM Log</a></td>', PHP_EOL
		,'<td>', seoHelp('_SPAM_SITEADMIN'), ' <a href="', $admin_file, '.php">', _SPAM_SITEADMIN, '</a></td>', PHP_EOL
		,'</tr>', PHP_EOL
		,'</table>', PHP_EOL;
	CloseTable();
	OpenTable();

	switch ($_REQUEST['op']) {
		case 'nukeSPAM':
		case 'nukeSPAMConfig':
			include_once('modules/' . $module_name . '/admin/nukeSPAMConfig.php');
			break;
		case 'nukeSPAMCheck':
			include('modules/' . $module_name . '/admin/nukeSPAMCheck.php');
			break;
		case 'nukeSPAMSaveConfig':
			csrf_check();
			include_once('modules/' . $module_name . '/admin/nukeSPAMConfig.php');
			break;
		case 'nukeSPAMWL':
			include_once('modules/' . $module_name . '/admin/nukeSPAMWL.php');
			break;
	}
} else {
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">', _ERROR, '</span><br /><br />', $module_name, '</div>', PHP_EOL;
}

CloseTable();
include_once 'footer.php';

?>