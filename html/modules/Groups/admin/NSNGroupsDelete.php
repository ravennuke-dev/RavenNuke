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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSDELETE;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();

list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

echo '<div align="center"><form action="' . $admin_file . '.php" method="post">' . "\n";
echo '<input type="hidden" name="op" value="NSNGroupsDeleteConf" />' . "\n";
echo '<input type="hidden" name="gid" value="' . $gid . '" />' . "\n";
echo _GR_DELGROUP . ' #' . $gid . ' (' . $gname . ')?<br /><br />' . "\n";
echo '<input type="submit" value="' . _GR_DELETE . ' &quot;' . $gname . '&quot;" /><br /><br />' . "\n";
echo '</form>' . "\n";
echo _GOBACK . '</div>' . "\n";
CloseTable();

include_once ('footer.php');

?>