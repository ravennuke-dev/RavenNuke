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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_MEMBERS . ': ' . _PJ_DELETEMEMBER;

include('header.php');

$member = pjmember_info($member_id);

pjadmin_menu(_PJ_MEMBERS . ': ' . _PJ_DELETEMEMBER);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><span class="thick">' . _PJ_SWAPMEMBER . '</span></td></tr>'."\n";
echo '<tr><td align="center">' . $member['member_name'] . ' -> <select name="swap_member_id">'."\n";
echo '<option value="0">---------</option>'."\n";

$memberlist = $db->sql_query('SELECT member_id, member_name FROM ' . $prefix . '_nsnpj_members WHERE member_id != "' . $member_id . '" ORDER BY member_name');
while(list($s_member_id, $s_member_name) = $db->sql_fetchrow($memberlist)) {
	echo '<option value="' . $s_member_id . '">' . $s_member_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td align="center">'."\n";
echo '<input type="hidden" name="member_id" value="'. $member_id . '" />'."\n";
echo '<input type="hidden" name="op" value="PJMemberDelete" />'."\n";
echo '<input type="submit" value="' . _PJ_DELETEMEMBER . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>