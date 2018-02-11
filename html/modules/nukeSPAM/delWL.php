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
if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
global $admin, $db;
if (!is_admin($admin)) die('');

if (method_exists($db, 'sql_escape_string')) {
	$wlid = intval($db->sql_escape_string($_POST['id']));
} else {
	$wlid = intval(addslashes($_POST['id']));
}
$sql = 'DELETE FROM ' . $prefix . '_spam_whitelist WHERE wlid = \'' . $wlid . '\'';
$db->sql_query($sql);
?>