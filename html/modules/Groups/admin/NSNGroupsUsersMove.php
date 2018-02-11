<?php
/****************************************************************/
/* NSN Groups 													*/
/* By: NukeScripts Network (webmaster@nukescripts.net)			*/
/* http://www.nukescripts.net									*/
/* Copyright © 2000-2005 by NukeScripts Network					*/
/****************************************************************/
/****************************************************************/
/* Additional code clean-up, performance enhancements, and W3C **/
/* and XHTML compliance fixes by Raven and Montego.				*/
/****************************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

if (!empty($_GET['gid']) || is_numeric($_GET['gid'])) {
	$gid = intval($_GET['gid']);
} else {
	Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView');
}
if (!empty($_GET['chng_uid']) || (is_numeric($_GET['chng_uid']) && $_GET['chng_uid'] > 0)) {
	$chng_uid = intval($_GET['chng_uid']);
} else {
	Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersView');
}

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSMOVE;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
echo '<div align="center">';
echo '<form method="post" action="' . $admin_file . '.php?op=NSNGroupsUsersMoveSave">';
echo '<input type="hidden" name="gid" value="' . $gid . '" />';
echo '<input type="hidden" name="uid" value="' . $chng_uid . '" />';

list($uname) = $db->sql_fetchrow($db->sql_query('SELECT `username` FROM `' . $user_prefix . '_users` WHERE `user_id`=\'' . $chng_uid . '\''));

echo _GR_USRNAME . ': <strong>' . $uname . '</strong><br />';

list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

echo _GR_CURRGROUP . ': <strong>' . $gname . '</strong><br /><br />';
echo _GR_NEWGROUP . ': <select name="new_gid">';

$content = '';
$result3 = $db->sql_query('SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while (list($thisGID, $thisGNAME) = $db->sql_fetchrow($result3)) {
	if ($thisGID != $gid) {
		$content .= '<option value="' . $thisGID . '">' . $thisGNAME . '</option>';
	}
}
if (empty($content)) {
	echo '<option value="-1">--------</option>';
} else {
	echo $content;
}
echo '</select><br /><br />';
echo '<input type="submit" value="' . _GR_MOVEUSR . '" />';
echo '</form></div>';
CloseTable();

include_once ('footer.php');

?>