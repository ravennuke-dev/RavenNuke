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
$uid = intval($uid);

$newDate = time() -86400;

$db->sql_query('UPDATE `' . $prefix . '_nsngr_users` SET `edate`=\'' . $newDate . '\' WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $uid . '\'');

Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . $gid);

?>