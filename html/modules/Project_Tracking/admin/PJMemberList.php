<?php

/***********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net) 			*/
/* http://www.nukescripts.net 						*/
/* Copyright © 2000-2005 by NukeScripts Network 			*/
/***********************************************************/
/*"Iñtërnâtiônàlizætiøn"							*/
/* Project Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright © 2013 by RavenNuke™		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_MEMBERS . ': ' . _PJ_MEMBERLIST;

include('header.php');

pjadmin_menu(_PJ_MEMBERS . ': ' . _PJ_MEMBERLIST);
echo '<br />'."\n";

$memberresult = $db->sql_query('SELECT member_id, member_name FROM ' . $prefix . '_nsnpj_members ORDER BY member_name');
$member_total = $db->sql_numrows($memberresult);

OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="3" width="100%" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><span class="thick">' . _PJ_MEMBEROPTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('options.png', $module_name);

echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap"><a href="' . $admin_file . '.php?op=PJMemberAdd">' . _PJ_MEMBERADD . '</a></td></tr>'."\n";

$pjimage = pjimage('stats.png', $module_name);

echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap">' . _PJ_MEMBERS . ': <span class="thick">' . $member_total . '</span></td></tr>'."\n";
echo '</table>'."\n";
echo '<br />'."\n";
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%"><span class="thick">' . _PJ_MEMBERS . '</span></td><td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

if($member_total != 0){
	while(list($member_id, $member_name) = $db->sql_fetchrow($memberresult)) {
		$pjimage = pjimage('member.png', $module_name);
		echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td width="100%">' . $member_name . '</td>'."\n";
		echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJMemberEdit&amp;member_id=' . $member_id . '">' . _PJ_EDIT . '</a>';
		echo ' | <a href="' . $admin_file . '.php?op=PJMemberRemove&amp;member_id=' . $member_id . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
	}
} else {
	echo '<tr><td width="100%" colspan="3" align="center">' . _PJ_NOMEMBERS. '</td></tr>'."\n";
}

echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>