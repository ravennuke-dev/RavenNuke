<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

$chng_uid = intval($chng_uid);
$gid = intval($gid);
if (!is_numeric($newmin)) $newmin = 00;
if (!is_numeric($newhour)) $newhour = 00;
if (!is_numeric($newday)) $newday = 00;
if (!is_numeric($newmonth)) $newmonth = 00;
if (!is_numeric($newyear)) $newyear = 0000;

$datenew = $newyear . '-' . $newmonth . '-' . $newday . ' ' . $newhour . ':' . $newmin . ':00';
if ($datenew == '0000-00-00 00:00:00') {
	$newdate = '0';
} else {
	$newdate = strtotime($datenew);
}

$db->sql_query('UPDATE `' . $prefix . '_nsngr_users` SET `edate`=\'' . $newdate . '\', `notice`=\'0\' WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $chng_uid . '\'');

Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . $gid);

?>