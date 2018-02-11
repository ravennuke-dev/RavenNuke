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

list($phpBB, $muid) = $db->sql_fetchrow($db->sql_query('SELECT `phpBB`, `muid` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

$muid = intval($muid);
$phpBB = intval($phpBB);

$db->sql_query('DELETE FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\' AND `uid`!=\'' . $muid . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_users`');

//PHPBB Group Update
$db->sql_query('DELETE FROM `' . $prefix . '_bbuser_group` WHERE `group_id`=\'' . $phpBB . '\' AND `user_id`!=\'' . $muid . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbuser_group`');

Header('Location: ' . $admin_file . '.php?op=NSNGroupsView');

?>