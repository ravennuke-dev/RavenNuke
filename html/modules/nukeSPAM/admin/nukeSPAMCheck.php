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
if (empty($check_username)) $check_username = '';
if (empty($check_email)) $check_email = '';
if (empty($check_ip)) $check_ip = '';
OpenTable();
echo '<form action="'.$admin_file.'.php?op=nukeSPAMCheck" method="post">', PHP_EOL
	,'<table class="form" align="center">', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td class="form">', _SPAM_USERNAME, ':</td>', PHP_EOL
	,'<td class="form"><input type="text" size="35" class="form" name="check_username" value="', $check_username, '" /></td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td class="form">' . _SPAM_EMAIL . ':</td>', PHP_EOL
	,'<td class="form"><input type="text" size="35" class="form" name="check_email" value="', $check_email, '" /></td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td class="form">' . _SPAM_IP . ':</td>', PHP_EOL
	,'<td class="form"><input type="text" size="35" class="form" name="check_ip" value="', $check_ip, '" /></td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td align="right" colspan="2"><input class="form" type="submit" name="submit" value="Check" /></td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</table>', PHP_EOL
	,'</form>', PHP_EOL;
CloseTable();
if (!empty($check_username) or !empty($check_email) or !empty($check_ip)) {
	define('_OVERRIDE_DEBUG_ON', '1');
	include_once NUKE_MODULES_DIR . 'nukeSPAM/nukeSPAM.php';
	$error = nukeSPAM($check_username, $check_email, $check_ip);
	echo '<br /><br /><strong>Results: ';
	if (empty($error)) echo _SPAM_NO_ISSUES;
	else echo $error['constant'] . $error['constant_ext1'] . $error['jsadress'];
	echo '</strong>';
}

?>