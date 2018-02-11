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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSEXPIRE;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();

list($uname) = $db->sql_fetchrow($db->sql_query('SELECT `username` FROM `' . $user_prefix . '_users` WHERE `user_id`=\'' . $chng_uid . '\''));
list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

echo '<div align="center">';
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<input type="hidden" name="op" value="NSNGroupsUsersExpireDone" />';
echo '<input type="hidden" name="gid" value="' . $gid . '" />';
echo '<input type="hidden" name="uid" value="' . $chng_uid . '" />';
echo _GR_EXPUSER . ' #' . $chng_uid . ' (' . $uname . ') ' . _GR_FROM . ' ' . $gname . '?<br /><br />';
echo '<input type="submit" value="' . _GR_EXPIRE . ' &quot;' . $uname . '&quot;" /><br /><br />';
echo '</form>';
echo _GOBACK . '</div>';
CloseTable();

include_once ('footer.php');
?>