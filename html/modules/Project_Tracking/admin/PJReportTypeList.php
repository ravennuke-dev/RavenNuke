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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_TYPELIST;

include('header.php');

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_TYPELIST);
echo '<br />'."\n";

$typeresult = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_types WHERE type_weight > 0 ORDER BY type_weight');
$type_total = $db->sql_numrows($typeresult);

OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="3" width="100%" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><span class="thick">' . _PJ_TYPEOPTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('options.png', $module_name);
echo '<tr><td><img src="' . $pjimage . '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap"><a href="' . $admin_file . '.php?op=PJReportTypeAdd">' . _PJ_TYPEADD . '</a></td></tr>'."\n";

$pjimage = pjimage('stats.png', $module_name);
echo '<tr><td><img src="' . $pjimage . '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap">' . _PJ_TOTALTYPES . ': <span class="thick">' . $type_total . '</span></td></tr>'."\n";
echo '</table>'."\n";
echo '<br />'."\n";
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%"><span class="thick">' . _PJ_TYPELIST . '</span></td>';
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_WEIGHT . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

if($type_total != 0) {
	while($type_row = $db->sql_fetchrow($typeresult)) {
		$pjimage = pjimage('type.png', $module_name);
		echo '<tr><td><img src="' . $pjimage . '" alt="" title="" /></td><td width="100%">' . $type_row['type_name'] . '</td>'."\n";

		$weight1 = $type_row['type_weight'] - 1;
		$weight3 = $type_row['type_weight'] + 1;

		list($pid1) = $db->sql_fetchrow($db->sql_query('SELECT type_id FROM ' . $prefix . '_nsnpj_reports_types WHERE type_weight="' . $weight1 . '"'));
		list($pid2) = $db->sql_fetchrow($db->sql_query('SELECT type_id FROM ' . $prefix . '_nsnpj_reports_types WHERE type_weight="' . $weight3 . '"'));

		echo '<td align="center" nowrap="nowrap">';

		if($pid1 AND $pid1 > 0) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJReportTypeOrder&amp;weight=' . $type_row['type_weight'] . '&amp;pid=' . $type_row['type_id'] . '&amp;weightrep=' . $weight1 . '&amp;pidrep=' . $pid1 . '"><img src="modules/' . $module_name . '/images/weight_up.png" border="0" hspace="3" alt="' . _PJ_UP . '" title="' . _PJ_UP . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_up_no.png" border="0" hspace="3" alt="" title="" />';
		}

		if($pid2) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJReportTypeOrder&amp;weight=' . $type_row['type_weight'] . '&amp;pid=' . $type_row['type_id'] . '&amp;weightrep=' . $weight3 . '&amp;pidrep=' . $pid2 . '"><img src="modules/' . $module_name . '/images/weight_dn.png" border="0" hspace="3" alt="' . _PJDOWN . '" title="' . _PJ_DOWN . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_dn_no.png" border="0" hspace="3" alt="" title="" />';
		}

		echo '</td>'."\n";
		echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJReportTypeEdit&amp;type_id=' . $type_row['type_id'] . '">' . _PJ_EDIT . '</a>';
		echo ' | <a href="' . $admin_file . '.php?op=PJReportTypeRemove&amp;type_id=' . $type_row['type_id'] . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
	}

	echo '<tr><td align="center" colspan="4"><a class="rn_csrf" href="' . $admin_file . '.php?op=PJReportTypeFix">' . _PJ_FIXWEIGHT . '</a></td></tr>'."\n";
} else {
	echo '<tr><td width="100%" colspan="3" align="center">' . _PJ_NOREPORTTYPES . '</td></tr>'."\n";
}

echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>