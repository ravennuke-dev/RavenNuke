<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 *
 */
if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
	seoGetLang('nukeSPAM');
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables - used by includes/dtAjaxSource.php
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'FROM_UNIXTIME(added)', 'request', 'username', 'email', 'INET_NTOA(ip)', 'matched', 'count' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "slid";
	
	/* DB table to use */
	$sTable = $prefix.'_spam_log';
	/* Whitelist */
	if (!isset($src)) $src='';
	if ($src == 'WL') {
		$aColumns = array( 'wlid', 'wltype', 'wlvalue' );
		$sIndexColumn = "wlid";
		$sTable = $prefix."_spam_whitelist";
	}
	define('DT_AJAXSOURCE', true);
	include_once('includes/dtAjaxSource.php');
?>