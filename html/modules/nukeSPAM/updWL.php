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
/*
	value - that contains text used entered in the table cell while editing
	id - id of the record that is deleted (id is placed in TR tag that surrounds the cell that has been edited)
	columnId 			 - position of the column of the cell that has been edited (hidden columns are counted also)
	columnPosition - position of the column of the cell that has been edited (hidden columns are not counted)
	rowId - id of the row containing cell the cell that has been edited 
	
Server-side page should return value that is updated if cell is successfully updated on the server-side or an error message. 
*/
$wlid = intval($_POST['id']);
if (method_exists($db, 'sql_escape_string')) {
	$value = $db->sql_escape_string($_POST['value']);
} else {
	$value = addslashes($_POST['value']);
}
$columnPosition = intval($_POST['columnPosition']);
$update = '1=1';
if ($columnPosition == 0) $update = 'wltype = \'' . $value . '\'';
if ($columnPosition == 1) $update = 'wlvalue = \'' . $value . '\'';
$sql = 'UPDATE ' . $prefix . '_spam_whitelist SET ' . $update . ' WHERE wlid = \'' . $wlid . '\'';
$db->sql_query($sql);
echo $value;
?>