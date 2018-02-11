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

isset($_POST['language']) ? $language = basename(strip_tags($_POST['language'])) : $language = 'english';
if (!defined('INCLUDE_PATH')) define('INCLUDE_PATH', '../../');
require INCLUDE_PATH . 'config.php';
include INCLUDE_PATH . 'language/lang-' . $language . '.php';

global $db, $prefix, $user_prefix;

define('_RWS_WIW_TABLE_SESSION', $prefix . '_session');
define('_RWS_WIW_TABLE_USERS', $user_prefix . '_users');
define('_RWS_WIW_TABLE_HEAP', $prefix . '_wiw_m');
define('_RWS_WIW_TABLE_CONFIG', $prefix . '_config');
define('_RWS_WIW_TABLE_MODULES', $prefix . '_modules');

$db = new mysqli($dbhost, $dbuname, $dbpass) or die('<br />' . _RWS_WIW_UNABLECONNECTSERVER . _RWS_WIW_MYSQLSAID . ': ' . mysqli_error());
$db->select_db($dbname) or die('<br />' . _RWS_WIW_UNABLECONNECTDB . _RWS_WIW_MYSQLSAID . ': ' . mysqli_error());

$sql = 'SELECT * FROM ' . _RWS_WIW_TABLE_SESSION;
$result = $db->query($sql) or die('<br />' . _RWS_WIW_MYSQLSAID . ': ' . mysqli_error());
if ($result && $result->num_rows > 0) {
	$registered = array();
	$guest = array();
	while ($row = $result->fetch_row()) {
		if (!$row[3]) {
			$registered[] = $row[0];
		} else {
			$guest[] = $row[0];
		}
	}
}

echo '<span class="thick underline">' . _RWS_WIW_GUESTSONLINE . '</span><br />' . count($guest) . ' ' . _RWS_WIW_GUESTS;
echo '<br /><br />';
$reg = '';
$wol = '';
$regCount = count($registered);
$notHiddenCount = 0;
for ($i=0;$i<$regCount;$i++) {
	if ($i==0) {
		$comma = '';
		$lb = '';
	} else {
		$lb='<br />';
		$comma = ',';
	}
	$result = $db->query('SELECT user_allow_viewonline HIDE FROM ' . _RWS_WIW_TABLE_USERS . ' WHERE username=\'' . $db->real_escape_string($registered[$i]) . '\';');
	$row = $result->fetch_row();
	if (!$row[0]) continue;
	$cmd = $db->query('SELECT mn FROM ' . _RWS_WIW_TABLE_HEAP . ' WHERE who=\'' . $db->real_escape_string($registered[$i]) . '\'');
	$data = $cmd->fetch_row();
	if (is_null($data[0])) $data[0] = _RWS_WIW_HOME;
	$reg .= $lb.'<span class="thick">' . $registered[$i] . '</span><br />&nbsp;&nbsp;' . str_replace('_',' ',$data[0]);
	$wol .= $comma . "'" . $registered[$i] . "'";
	$notHiddenCount++;
}

if (!empty($reg)) {
	$delSql = 'DELETE FROM ' . _RWS_WIW_TABLE_HEAP . ' WHERE who NOT IN (' . $wol . ')';
	$db->query($delSql);
	if (substr($reg,0,2)==', ') $reg = substr($reg,2);
	$reg = '<span class="thick underline">' . $notHiddenCount . ' ' . _RWS_WIW_USERSONLINE . '</span><br />' . $reg;
	echo $reg;
	echo '<br /><br />';
}

isset($_POST['refreshRate']) ? $refreshRate = intval($_POST['refreshRate'])/1000 : $refreshRate = '60';
echo '<div class="text-center">('.$refreshRate.' '._RWS_WIW_REFRESH.')</div>';

?>