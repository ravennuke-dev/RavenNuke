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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSEMPTY;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />' . "\n";
OpenTable();

list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

echo '<div class="text-center">' . "\n";
echo '<form action="' . $admin_file . '.php" method="post">' . "\n";
echo '<input type="hidden" name="op" value="NSNGroupsEmptyConf" />' . "\n";
echo '<input type="hidden" name="gid" value="' . $gid . '" />' . "\n";
echo _GR_EMPGROUP . ' #' . $gid . ' (' . $gname . ')?<br /><br />' . "\n";
echo '<input type="submit" value="' . _GR_EMPTY . ' &quot;' . $gname . '&quot;" /><br /><br />' . "\n";
echo '</form>' . "\n";
echo _GOBACK . '</div>' . "\n";
CloseTable();

include_once ('footer.php');

?>