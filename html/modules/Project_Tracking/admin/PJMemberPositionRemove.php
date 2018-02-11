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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_MEMBERS . ': ' . _PJ_DELETEPOSITION;

$position_id = intval($position_id);

if($position_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJMemberPositionList');
}

include('header.php');

$position = pjmemberposition_info($position_id);

pjadmin_menu(_PJ_MEMBERS . ': ' . _PJ_DELETEPOSITION);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><span class="thick">' . _PJ_SWAPPOSITION . '</span></td></tr>'."\n";
echo '<tr><td align="center">' . $position['position_name'] . ' -> <select name="swap_position_id">'."\n";
echo '<option value="-1">' . _PJ_NA . '</option>'."\n";

$positionlist = $db->sql_query('SELECT position_id, position_name FROM ' . $prefix . '_nsnpj_members_positions WHERE position_id != "' . $position_id . '" AND position_id > 0 ORDER BY position_weight');
while(list($s_position_id, $s_position_name) = $db->sql_fetchrow($positionlist)) {
	echo '<option value="' . $s_position_id . '">' . $s_position_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="' . _PJ_DELETEPOSITION . '" />'."\n";
echo '<input type="hidden" name="op" value="PJMemberPositionDelete" />'."\n";
echo '<input type="hidden" name="position_id" value="' . $position_id . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>