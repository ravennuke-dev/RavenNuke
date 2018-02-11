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

if (!empty($_POST['gid']) || is_numeric($_POST['gid'])) {
	$gid = intval($_POST['gid']);
} else {
	Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . intval($_POST['gid']));
}
if (!empty($_POST['new_gid']) || is_numeric($_POST['new_gid'])) {
	$new_gid = intval($_POST['new_gid']);
} else {
	Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . $gid);
}

list($phpBB_old) = $db->sql_fetchrow($db->sql_query('SELECT `phpBB` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));
list($phpBB_new) = $db->sql_fetchrow($db->sql_query('SELECT `phpBB` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $new_gid . '\''));
if (!is_ingroup($uid, $new_gid)) {
	$db->sql_query('UPDATE `' . $prefix . '_nsngr_users` SET `gid`=\'' . $new_gid . '\' WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $uid . '\'');
	//PHPBB Update Group
	$db->sql_query('UPDATE `' . $prefix . '_bbuser_group` SET `group_id`=\'' . $phpBB_new . '\' WHERE `group_id`=\'' . $phpBB_old . '\' AND `user_id`=\'' . $uid . '\'');
}

Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView&gid=' . $new_gid);

?>