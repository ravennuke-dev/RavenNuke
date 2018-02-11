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

$gdesc = addslashes(check_html(html_entity_decode($gdesc, ENT_QUOTES, _CHARSET)));
$gid = intval($gid);
$glimit = intval($glimit);
$gname = addslashes(check_html($gname));
$gpublic = intval($gpublic);
$mname = addslashes(check_html($mname));
$old_muid = intval($old_muid);

if ($gname == '' || $mname == '') {
	include_once 'header.php';
	OpenTable();
	echo '<div class="text-center"><span class="thick">' , _GR_MISSINGDATA , '</span></div><br />' , "\n"
		, '<div class="text-center">' , _GOBACK , '</div>' , "\n";
	CloseTable();
	include_once 'footer.php';
	exit();
}

list($muid) = $db->sql_fetchrow($db->sql_query('SELECT `user_id` FROM `' . $user_prefix . '_users` WHERE `username`=\'' . $mname . '\''));
if(!($muid)) {
	include 'header.php';
	OpenTable();
	echo '<div class="text-center"><span class="thick">' , _GR_INVLALIDUSERNAME , '</span></div><br>' , "\n"
		, '<div class="text-center">' , _GOBACK , '</div>' , "\n";
	CloseTable();
	include 'footer.php';
	exit();
}

list($phpBB) = $db->sql_fetchrow($db->sql_query('SELECT `phpBB` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

$db->sql_query('UPDATE `' . $prefix . '_nsngr_groups` SET `gname`=\'' . $gname . '\', `gdesc`=\'' . $gdesc . '\', `gpublic`=\'' . $gpublic . '\', `glimit`=\'' . $glimit . '\', `muid`=\'' . $muid . '\' WHERE `gid`=\'' . $gid . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_groups`');

if ($muid <> $old_muid) {
	$db->sql_query('DELETE FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $old_muid . '\'');
	$gidnum = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $muid . '\''));

	$stime = time();

	if (!$gidnum || $gidnum == 0) {
		$db->sql_query('INSERT INTO `' . $prefix . '_nsngr_users` VALUES (\'' . $gid . '\', \'' . $muid . '\', \'0\', \'0\', \'' . $stime . '\', \'0\')');
	}

	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_users`');
}

//PHPBB Group Update
$db->sql_query('UPDATE `' . $prefix . '_bbgroups` SET `group_name`=\'' . $gname . '\', `group_description`=\'' . $gdesc . '\', `group_moderator`=\'' . $muid . '\' WHERE `group_id`=\'' . $phpBB . '\'');
$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbgroups`');

if ($muid <> $old_muid) {
	$db->sql_query('DELETE FROM `' . $prefix . '_bbuser_group` WHERE `group_id`=\'' . $phpBB . '\' AND `user_id`=\'' . $old_muid . '\'');
	$phpnum = $db->sql_numrows($db->sql_query('SELECT `user_id` FROM `' . $prefix . '_bbuser_group` WHERE `group_id`=\'' . $phpBB . '\' AND `user_id`=\'' . $muid . '\''));

	if (!$phpnum || $phpnum == 0) {
		$db->sql_query('INSERT INTO `' . $prefix . '_bbuser_group` VALUES (\'' . $phpBB . '\', \'' . $muid . '\', \'0\')');
	}

	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbuser_group`');
}

Header('Location: ' . $admin_file . '.php?op=NSNGroupsView');

?>