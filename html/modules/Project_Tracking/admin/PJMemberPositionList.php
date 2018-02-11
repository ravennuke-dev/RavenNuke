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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_MEMBERS . ': ' . _PJ_POSITIONLIST;

include('header.php');

pjadmin_menu(_PJ_MEMBERS . ': ' . _PJ_POSITIONLIST);
echo '<br />'."\n";

$positionresult = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_members_positions WHERE position_weight > 0 ORDER BY position_weight');
$position_total = $db->sql_numrows($positionresult);

OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="3" width="100%" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><span class="thick">' . _PJ_POSITIONOPTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('options.png', $module_name);

echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap"><a href="' . $admin_file . '.php?op=PJMemberPositionAdd">' . _PJ_POSITIONADD . '</a></td></tr>'."\n";

$pjimage = pjimage('stats.png', $module_name);

echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap">' . _PJ_TOTALPOSITIONS . ': <span class="thick">' . $position_total . '</span></td></tr>'."\n";
echo '</table>'."\n";
echo '<br />'."\n";
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%"><span class="thick">' . _PJ_POSITIONS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_WEIGHT . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

if($position_total != 0){
	while($position_row = $db->sql_fetchrow($positionresult)) {
		$pjimage = pjimage('position.png', $module_name);

		echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td width="100%">' . $position_row['position_name'] . '</td>'."\n";

		$weight1 = $position_row['position_weight'] - 1;
		$weight3 = $position_row['position_weight'] + 1;

		list($pid1) = $db->sql_fetchrow($db->sql_query('SELECT position_id FROM ' . $prefix . '_nsnpj_members_positions WHERE position_weight="' . $weight1 . '"'));
		list($pid2) = $db->sql_fetchrow($db->sql_query('SELECT position_id FROM ' . $prefix . '_nsnpj_members_positions WHERE position_weight="' . $weight3 . '"'));

		echo '<td align="center" nowrap="nowrap">'."\n";

		if($pid1 AND $pid1 > 0) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJMemberPositionOrder&amp;weight=' . $position_row['position_weight'] . '&amp;pid=' . $position_row['position_id'] . '&amp;weightrep=' . $weight1 . '&amp;pidrep=' . $pid1 . '"><img src="modules/' . $module_name . '/images/weight_up.png" border="0" hspace="3" alt="' . _PJ_UP . '" title="' . _PJ_UP . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_up_no.png" border="0" hspace="3" alt="" title="" />';
		}

		if($pid2) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJMemberPositionOrder&amp;weight=' . $position_row['position_weight'] . '&amp;pid=' . $position_row['position_id'] . '&amp;weightrep=' . $weight3 . '&amp;pidrep=' . $pid2 . '"><img src="modules/' . $module_name . '/images/weight_dn.png" border="0" hspace="3" alt="' . _PJDOWN . '" title="' . _PJ_DOWN . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_dn_no.png" border="0" hspace="3" alt="" title="" />';
		}

		echo '</td>'."\n";
		echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJMemberPositionEdit&amp;position_id=' . $position_row['position_id'] . '">' . _PJ_EDIT . '</a>';
		echo ' | <a href="' . $admin_file . '.php?op=PJMemberPositionRemove&amp;position_id=' . $position_row['position_id'] . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
	}

	echo '<tr><td align="center" colspan="4"><a class="rn_csrf" href="' . $admin_file . '.php?op=PJMemberPositionFix">' . _PJ_FIXWEIGHT . '</a></td></tr>'."\n";
} else {
	echo '<tr><td width="100%" colspan="3" align="center">' . _PJ_NOPOSITIONS . '</td></tr>'."\n";
}

echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>