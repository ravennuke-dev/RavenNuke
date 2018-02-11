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

!isset($gid) ? $gid = 0 :$gid = intval($gid);
!isset($min) ? $min = 0 : $min = intval($min);
!isset($max) ? $max = $min+$grconfig['perpage'] : $max = intval($max);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSVIEW;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
$totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_groups`'));
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
echo '<div class="text-center"><table border="0" cellpadding="2" cellspacing="2" bgcolor="' . $bgcolor2 . '">';
echo '<tr bgcolor="' . $bgcolor2 . '">';
echo '<td align="center" width="200"><span class="thick">' . _GR_GRPNAME . '</span></td>';
echo '<td align="center" width="70"><span class="thick">' . _GR_NUMUSERS . '</span></td>';
echo '<td align="center" width="70"><span class="thick">' . _GR_TYPE . '</span></td>';
echo '<td align="center" width="70"><span class="thick">' . _GR_LIMIT . '</span></td>';
echo '<td align="center" width="100"><span class="thick">' . _FUNCTIONS . '</span></td>';
echo '</tr>';

$result = $db->sql_query('SELECT `gid`, `gname`, `gpublic`, `glimit` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname` LIMIT ' . $min . ',' . $grconfig['perpage']);
if ($db->sql_numrows($result) > 0) {
	while (list($gid, $gname, $gpublic, $glimit) = $db->sql_fetchrow($result)) {
		echo '<tr bgcolor="' . $bgcolor1 . '" onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'" onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'">';
		echo '<td align="center"><a href="' . $admin_file . '.php?op=NSNGroupsUsersView&amp;gid=' . $gid . '">' . $gname . '</a> (' . $gid . ')</td>';
		$numusers = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\''));
		echo '<td align="center">' . $numusers . '</td>';
		if ($gpublic == 1) {
			$grtype = _GR_PUBLIC;
		} else {
			$grtype = _GR_PRIVATE;
		}
		echo '<td align="center">' . $grtype . '</td>';
		if ($glimit == 0) {
			$grlimit = _GR_NOLIMIT;
		} else {
			$grlimit = $glimit;
		}
		echo '<td align="center">' . $grlimit . '</td>';
		echo '<td align="center">';
		echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersAdd&amp;gid=' . $gid . '"><img src="images/groups/add.png" height="16" width="16" border="0" alt="' . _GR_ADDUSR . '" title="' . _GR_ADDUSR . '" /></a>';
		echo '<a href="' . $admin_file . '.php?op=NSNGroupsEdit&amp;gid=' . $gid . '"><img src="images/groups/edit.png" height="16" width="16" border="0" alt="' . _GR_EDIT . '" title="' . _GR_EDIT . '" /></a>';
		echo '<a href="' . $admin_file . '.php?op=NSNGroupsDelete&amp;gid=' . $gid . '"><img src="images/groups/delete.png" height="16" width="16" border="0" alt="' . _GR_DELETE . '" title="' . _GR_DELETE . '" /></a>';
		echo '<a href="' . $admin_file . '.php?op=NSNGroupsEmpty&amp;gid=' . $gid . '"><img src="images/groups/empty.png" height="16" width="16" border="0" alt="' . _GR_EMPTY . '" title="' . _GR_EMPTY . '" /></a>';
		echo '</td>';
		echo '</tr>';
	}
} else {
	echo '<tr bgcolor="' . $bgcolor1 . '"><td align="center" colspan="5">' . _GR_NOGROUPS . '</td></tr>';
}

echo '</table></div>';
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
CloseTable();

include_once ('footer.php');

?>