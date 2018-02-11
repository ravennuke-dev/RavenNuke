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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_PROJECTLIST;

include('header.php');

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_PROJECTLIST);
echo '<br />'."\n";

$projectresult = $db->sql_query('SELECT project_id, project_name, weight, featured, status_id, priority_id FROM ' . $prefix . '_nsnpj_projects ORDER BY weight');
$project_total = $db->sql_numrows($projectresult);

OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="3" width="100%" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><span class="thick">' . _PJ_PROJECTOPTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('options.png', $module_name);
echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="2" width="100%" nowrap="nowrap"><a href="' . $admin_file . '.php?op=PJProjectAdd">' . _PJ_PROJECTADD . '</a></td></tr>'."\n";

$pjimage = pjimage('stats.png', $module_name);
echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="3" width="100%" nowrap="nowrap">' . _PJ_TOTALPROJECTS . ': <span class="thick">' . $project_total . '</span></td></tr>'."\n";
echo '</table>'."\n";
echo '<br />'."\n";
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%"><span class="thick">' . _PJ_PROJECTS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_WEIGHT . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_STATUS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_PRIORITY . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_TASKS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_REPORTS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_REQUESTS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

if($project_total != 0) {
	while(list($project_id, $project_name, $weight, $featured, $status_id, $priority_id) = $db->sql_fetchrow($projectresult)) {
		$tasksresult = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks WHERE project_id="' . $project_id . '"');
		$tasks = $db->sql_numrows($tasksresult);

		$reportsresult = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports WHERE project_id="' . $project_id . '"');
		$reports = $db->sql_numrows($reportsresult);

		$requestsresult = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests WHERE project_id="' . $project_id . '"');
		$requests = $db->sql_numrows($requestsresult);

		$projectstatus = pjprojectstatus_info($status_id);
		$projectpriority = pjprojectpriority_info($priority_id);

		if($featured > 0) {
			$pjimage = pjimage('project_featured.png', $module_name);
		} else {
			$pjimage = pjimage('project.png', $module_name);
		}

		echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td width="100%">' . $project_name . '</td>'."\n";

		$weight1 = $weight - 1;
		$weight3 = $weight + 1;
		$res = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects WHERE weight="' . $weight1 . '"');
		list($pid1) = $db->sql_fetchrow($res);
		$con1 = $pid1;

		$res2 = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects WHERE weight="' . $weight3 . '"');
		list($pid2) = $db->sql_fetchrow($res2);
		$con2 = $pid2;

		echo '<td align="center" nowrap="nowrap">';

		if($con1) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJProjectOrder&amp;weight=' . $weight . '&amp;pid=' . $project_id . '&amp;weightrep=' . $weight1 . '&amp;pidrep=' . $con1 . '"><img src="modules/' . $module_name . '/images/weight_up.png" border="0" hspace="3" alt="' . _PJUP . '" title="' . _PJ_UP . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_up_no.png" border="0" hspace="3" alt="" title="" />';
		}

		if($con2) {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=PJProjectOrder&amp;weight=' . $weight . '&amp;pid=' . $project_id . '&amp;weightrep=' . $weight3 . '&amp;pidrep=' . $con2 . '"><img src="modules/' . $module_name . '/images/weight_dn.png" border="0" hspace="3" alt="' . _PJDOWN . '" title="' . _PJ_DOWN . '" /></a>';
		} else {
			echo '<img src="modules/' . $module_name . '/images/weight_dn_no.png" border="0" hspace="3" alt="" title="" />';
		}

		echo '</td>'."\n";

		if($projectstatus['status_name'] == '') {
			$projectstatus['status_name'] = _PJ_NA;
		}

		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectStatusList">' . $projectstatus['status_name'] . '</a></td>'."\n";

		if($projectpriority['priority_name'] == '') {
			$projectpriority['priority_name'] = _PJ_NA;
		}

		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectPriorityList">' . $projectpriority['priority_name'] . '</a></td>'."\n";
		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectTasks&amp;project_id=' . $project_id . '">' . $tasks . '</a></td>'."\n";
		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectReports&amp;project_id=' . $project_id . '">' . $reports . '</a></td>'."\n";
		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectRequests&amp;project_id=' . $project_id . '">' . $requests . '</a></td>'."\n";
		echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJProjectEdit&amp;project_id=' . $project_id . '">' . _PJ_EDIT . '</a>';
		echo ' | <a href="' . $admin_file . '.php?op=PJProjectRemove&amp;project_id=' . $project_id . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
	}

	echo '<tr><td align="center" colspan="9"><a class="rn_csrf" href="' . $admin_file . '.php?op=PJProjectFix">' . _PJ_FIXWEIGHT . '</a></td></tr>'."\n";
} else {
	echo '<tr><td width="100%" colspan="9" align="center">' . _PJ_NOPROJECTS . '</td></tr>'."\n";
}

echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>