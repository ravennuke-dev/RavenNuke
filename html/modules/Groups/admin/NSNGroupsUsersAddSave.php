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

$j = count($add_uid);
for ($i = 0;$i < $j;$i++) {
	$add_uid[$i] = intval($add_uid[$i]);
}

$gid = intval($gid);
$min = intval($min);
if (!is_numeric($newmin)) $newmin = 00;
if (!is_numeric($newhour)) $newhour = 00;
if (!is_numeric($newday)) $newday = 00;
if (!is_numeric($newmonth)) $newmonth = 00;
if (!is_numeric($newyear)) $newyear = 0000;

$xdate = time();
$datenew = $newyear . '-' . $newmonth . '-' . $newday . ' ' . $newhour . ':' . $newmin . ':00';

if ($datenew == '0000-00-00 00:00:00') {
	$ydate = '0';
} else {
	$ydate = strtotime($datenew);
}

for ($i = 0;$i < $j;$i++) {
	if (!is_ingroup($add_uid[$i], $gid)) {
		list($phpBB) = $db->sql_fetchrow($db->sql_query('SELECT phpBB FROM ' . $prefix . '_nsngr_groups WHERE gid="' . $gid . '"'));
		list($u_name) = $db->sql_fetchrow($db->sql_query('SELECT username FROM ' . $user_prefix . '_users WHERE user_id="' . $add_uid[$i] . '"'));
		$db->sql_query('INSERT INTO ' . $prefix . '_nsngr_users (gid, uid, sdate, edate) VALUES ("' . $gid . '", "' . $add_uid[$i] . '", "' . $xdate . '", "' . $ydate . '")');

		//PHPBB Update Group Users
		$db->sql_query('INSERT INTO ' . $prefix . '_bbuser_group (group_id, user_id, user_pending) VALUES ("' . $phpBB . '", "' . $add_uid[$i] . '", "0")');
	}
}

Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersAdd&gid=' . $gid . '&min=' . $min);

?>