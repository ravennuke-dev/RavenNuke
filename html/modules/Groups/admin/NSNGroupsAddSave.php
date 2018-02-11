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
$glimit = intval($glimit);
$gname = addslashes(check_html($gname));
$gpublic = intval($gpublic);
$mname = addslashes(check_html($mname));

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

//PHPBB Group Creation
$db->sql_query('INSERT INTO `' . $prefix . '_bbgroups` VALUES (NULL, \'2\', \'' . $gname . '\', \'' . $gdesc . '\', \'' . $muid . '\', \'0\')');
$phpBB = $db->sql_nextid();
$db->sql_query('INSERT INTO `' . $prefix . '_bbuser_group` VALUES (\'' . $phpBB . '\', \'' . $muid . '\', \'0\')');

//Get PHPBB Group ID to attach to RN Group
list($phpBB) = $db->sql_fetchrow($db->sql_query('SELECT `group_id` FROM `' . $prefix . '_bbgroups` WHERE `group_name`=\'' . $gname . '\''));

//Create RN Group
$db->sql_query('INSERT INTO `' . $prefix . '_nsngr_groups` VALUES (NULL, \'' . $gname . '\', \'' . $gdesc . '\' , \'' . $gpublic . '\', \'' . $glimit . '\', \'' . $phpBB . '\', \'' . $muid . '\')');
$gid = $db->sql_nextid();
$stime = time();
$db->sql_query('INSERT INTO `' . $prefix . '_nsngr_users` VALUES (\'' . $gid . '\', \'' . $muid . '\', \'0\', \'0\', \'' . $stime . '\', \'0\')');

Header('Location: ' . $admin_file . '.php?op=NSNGroupsView');

?>