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
if(!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
if(!isset($module_file)) $module_file='modules';
$module_name = basename(dirname(__FILE__));
seoGetLang($module_name);
global $admin_file;
if (is_admin($admin)) {
	$index = 0;
	// Set to FALSE to hide right blocks
	/*if (!defined('INDEX_FILE')) define('INDEX_FILE', false); 
	if (defined('INDEX_FILE') AND INDEX_FILE===true) $index = 1;*/
	include_once('header.php');
	OpenTable();
	echo '<div class="text-center">' , PHP_EOL
	   , '<a href="'.$admin_file.'.php?op=nukeSPAMConfig">'._SPAM_CONFIG.'</a> &bull; '
	   , '<a href="'.$admin_file.'.php?op=nukeSPAMWL">'._SPAM_WL.'</a> &bull; '
	   , '<a href="'.$admin_file.'.php?op=nukeSPAMCheck">'._SPAM_CHECK.'</a> &bull; '
	   , '<a href="'.$admin_file.'.php">'._SPAM_SITEADMIN.'</a>'
	   , '</div><br />' , PHP_EOL;
	echo'
	<table class="display responsive" id="nukeSPAMLog" width="100%">
		<thead>
			<tr>
				<th>'._SPAM_ADDED.'</th>
				<th>'._SPAM_TYPE.'</th>
				<th>'._SPAM_USERNAME.'</th>
				<th>'._SPAM_EMAIL.'</th>
				<th>'._SPAM_IP.'</th>
				<th>'._SPAM_MATCHED.'</th>
				<th>'._SPAM_COUNT.'</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>'._SPAM_ADDED.'</th>
				<th>'._SPAM_TYPE.'</th>
				<th>'._SPAM_USERNAME.'</th>
				<th>'._SPAM_EMAIL.'</th>
				<th>'._SPAM_IP.'</th>
				<th>'._SPAM_MATCHED.'</th>
				<th>'._SPAM_COUNT.'</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="7" class="dataTables_empty">'._SPAM_LOADING.'</td>
			</tr>
		</tbody>
	</table>
	';
	echo '<div align="right" class="nukeseo"><a href="http://nukeSEO.com" title="nukeSPAM(tm) (c) nukeSEO.com">&copy;</a></div>';
	CloseTable();
	include('footer.php');
} else {
	include_once 'header.php';
	OpenTable();
	echo '<div class="text-center">' . _RESTRICTEDAREA . '<br />' . _GOBACK . '</div>';
	CloseTable();
	include_once 'footer.php'; 
}