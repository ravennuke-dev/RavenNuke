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
	$wltype = $db->sql_escape_string($_POST['wltype']);
	$wlvalue = $db->sql_escape_string($_POST['wlvalue']) ;
} else {
	$wltype = addslashes($_POST['wltype']);
	$wlvalue = addslashes($_POST['wlvalue']) ;
}
$sql = 'INSERT INTO ' . $prefix . '_spam_whitelist (wlid, wltype, wlvalue) VALUES(null, \''.$wltype.'\', \''. $wlvalue.'\')';
$db->sql_query($sql);
?>