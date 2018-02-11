<?php
/**********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*********************************************************************/
/*********************************************************************/
/* WhoIsWhere by Gaylen Fraley (aka Raven) 						*/
/* http://www.ravenwebhosting.com								*/
/* http://www.ravenphpscripts.com								*/
/*********************************************************************/

global $db, $name, $prefix, $user, $userInfo, $user_prefix;

define('_RWS_WIW_TABLE_SESSION', $prefix . '_session');
define('_RWS_WIW_TABLE_USERS', $user_prefix . '_users');
define('_RWS_WIW_TABLE_HEAP', $prefix . '_wiw_m');
define('_RWS_WIW_TABLE_CONFIG', $prefix . '_config');
define('_RWS_WIW_TABLE_MODULES', $prefix . '_modules');

function mysql_table_exists($table) {
	global $db;
	$exists = $db->sql_numrows($db->sql_query('SHOW TABLES LIKE \'' . $table . '\''));
	if ($exists) return true;
	return false;
}

if (!mysql_table_exists(_RWS_WIW_TABLE_HEAP)) {
	/*********************************************************************/
	/* Depending on your version of MySQL, the TYPE can be either MEMORY or 	*/
	/* HEAP.  This next routine first tries TYPE=MEMORY.  If it fails then		*/
	/* it will try again as TYPE=HEAP.								*/
	/*********************************************************************/
	$result = $db->sql_query('CREATE TABLE ' . _RWS_WIW_TABLE_HEAP . ' (who VARCHAR(20), mn VARCHAR(20)) ENGINE=memory');
	if (!$result) {
		$db->sql_query('CREATE TABLE ' . _RWS_WIW_TABLE_HEAP . ' (who VARCHAR(20), mn VARCHAR(20)) ENGINE=heap');
	}
}

if (is_user($user)) {
	$safe = Array();
	$userInfo = getusrinfo($user);
	$safe['who'] = $db->sql_escape_string($userInfo[2]);
	$delSql = 'DELETE FROM ' . _RWS_WIW_TABLE_HEAP . ' WHERE who=\'' . $userInfo[2] . '\'';
	$db->sql_query($delSql);
	$rws = $db->sql_query('SELECT custom_title FROM ' . _RWS_WIW_TABLE_MODULES . ' WHERE title=\'' . $name . '\'');
	$rwsresult = $db->sql_fetchrow($rws);
	$safe['mn'] = $db->sql_escape_string($rwsresult[0]);
	$updSql = 'UPDATE ' . _RWS_WIW_TABLE_HEAP . ' SET mn=\'' . $safe['mn'] . '\' WHERE who=\'' . $safe['who'] . '\'';
	$updRC = $db->sql_query($updSql);
	if ($db->sql_affectedrows() == 0) {
		$db->sql_query('INSERT INTO ' . _RWS_WIW_TABLE_HEAP . " values('" . $safe['who'] . "','" . $safe['mn'] . "')");
	}
}

?>