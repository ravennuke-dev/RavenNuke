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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSEMAIL;
include_once ('header.php');

global $sitename, $adminmail;
$aname = $sitename;
$amail = $adminmail;

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
echo '<div class="text-center"><form method="post" action="' . $admin_file . '.php">';
echo '<span class="thick">' . _GR_TYPE . ':</span> <select name="etype">';
echo '<option value="0">' . _GR_TEXT . '</option>' . '<option value="1">' . _GR_HTML . '</option>';
echo '</select><br /><br />';
echo '<span class="thick">' . _GR_FROMA . ':</span> ' . $aname . '<br /><br />';
echo '<span class="thick">' . _GR_TO . ':</span> <select name="gid[]" multiple="multiple">';
echo '<option value="0">' . _GR_ALLGR . '</option>';

$result = $db->sql_query('SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while (list($gid, $gname) = $db->sql_fetchrow($result)) {
	echo '<option value="' . $gid . '">' . $gname . '</option>';
}

echo '</select><br /><br />';
echo '<span class="thick">' . _GR_SUB . ':</span> <input type="text" name="gsubject" size="50" /><br /><br />';
echo '<span class="thick">' . _GR_MES . ':</span><br /><textarea name="gcontent" ' . $textrowcol . '></textarea><br /><br />';
echo '<input type="hidden" name="aname" value="' . $aname . '" />';
echo '<input type="hidden" name="amail" value="' . $amail . '" />';
echo '<input type="hidden" name="op" value="NSNGroupsUsersEmailSend" />';
echo '<input type="submit" value="' . _GR_SEND . '" />';
echo '</form></div>';
CloseTable();

include_once ('footer.php');

?>