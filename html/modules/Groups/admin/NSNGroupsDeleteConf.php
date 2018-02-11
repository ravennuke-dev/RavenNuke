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

list($phpBB) = $db->sql_fetchrow($db->sql_query('SELECT phpBB FROM ' . $prefix . '_nsngr_groups WHERE gid=\'' . $gid . '\''));

$db->sql_query('DELETE FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_groups`');
$db->sql_query('DELETE FROM `' . $prefix . '_bbgroups` WHERE `group_id`=\'' . $phpBB . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbgroups`');
$db->sql_query('DELETE FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_users`');
$db->sql_query('DELETE FROM `' . $prefix . '_bbuser_group` WHERE `group_id`=\'' . $phpBB . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbuser_group`');

Header('Location: ' . $admin_file . '.php?op=NSNGroupsView');

?>