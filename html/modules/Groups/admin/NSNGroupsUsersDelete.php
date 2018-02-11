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
$chng_uid = intval($chng_uid);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSDELETE;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();

list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

echo '<div class="text-center">' . _GR_DELUSER . ' ' . $chng_uid . ' ' . _GR_FROM . ' #' . $gid . ' (' . $gname . ')?</div><br />';
echo '<div class="text-center">[ <a class="rn_csrf" href="' . $admin_file . '.php?op=NSNGroupsUsersDeleteConf&amp;gid=' . $gid . '&amp;uid=' . $chng_uid . '">' . _GR_YES . '</a> | <a href="' . $admin_file . '.php?op=NSNGroupsView&amp;gid=' . $gid . '">' . _GR_NO . '</a> ]</div>';
CloseTable();

include_once ('footer.php');

?>