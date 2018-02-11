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

$gid = intval($gid);

if (isset($exp_uid) && is_array($exp_uid)) {
	$j = count($exp_uid);
	for ($i = 0;$i < $j;$i++) {
		$exp_uid[$i] = intval($exp_uid[$i]);
	}
} else {
	$j = 0;
}

$newDate = time() -86400;

for ($i = 0;$i < $j;$i++) {
	$db->sql_query('UPDATE `' . $prefix . '_nsngr_users` SET `edate`=\'' . $newDate . '\' WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $exp_uid[$i] . '\'');
	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_users`');
}

Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . $gid);

?>