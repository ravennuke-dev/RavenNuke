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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_MEMBERS . ': ' . _PJ_EDITMEMBER;

include('header.php');

$member = pjmember_info($member_id);

pjadmin_menu(_PJ_MEMBERS . ': ' . _PJ_EDITMEMBER);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_MEMBERNAME . ':</td>'."\n";
echo '<td><input type="text" name="member_name" size="30" value="' . $member['member_name'] . '" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_MEMBEREMAIL . ':</td>'."\n";
echo '<td><input type="text" name="member_email" size="30" value="' . $member['member_email'] . '" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _PJ_UPDATEMEMBER . '" />'."\n";
echo '<input type="hidden" name="op" value="PJMemberUpdate" />'."\n";
echo '<input type="hidden" name="member_id" value="' . $member_id . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>