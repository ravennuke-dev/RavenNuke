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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_TASKLIST;

include('header.php');

$projectresult = $db->sql_query('SELECT project_name, project_description, status_id, priority_id FROM ' . $prefix . '_nsnpj_projects WHERE project_id="' . $project_id . '"');
list($project_name, $project_description, $status_id, $priority_id) = $db->sql_fetchrow($projectresult);

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_TASKLIST);
echo '<br />'."\n";

$taskresult = $db->sql_query('SELECT task_id, task_name, priority_id, status_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id="' . $project_id . '" ORDER BY task_name');
$task_total = $db->sql_numrows($taskresult);

OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%" nowrap="nowrap"><span class="thick">' . _PJ_PROJECT . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_STATUS . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_PRIORITY . '</span></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('project.png', $module_name);
echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td>'."\n";
echo '<td width="100%"><a href="' . $admin_file . '.php?op=PJProjectList">' . _PJ_PROJECTS . '</a> / <span class="thick">' . $project_name . '</span></td>'."\n";

$projectstatus = pjprojectstatus_info($status_id);
if($projectstatus['status_name'] == '') {
	$projectstatus['status_name'] = _PJ_NA;
}

echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectStatusList">' . $projectstatus['status_name'] . '</a></td>'."\n";

$projectpriority = pjprojectpriority_info($priority_id);
if($projectpriority['priority_name'] == '') {
	$projectpriority['priority_name'] = _PJ_NA;
}

echo '<td align="center"><a href="' . $admin_file . '.php?op=PJProjectPriorityList">' . $projectpriority['priority_name'] . '</a></td>'."\n";
echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJProjectEdit&amp;project_id=' . $project_id . '">' . _PJ_EDIT . '</a> |';
echo ' <a href="' . $admin_file . '.php?op=PJProjectRemove&amp;project_id=' . $project_id . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
echo '<tr><td colspan="5" width="100%" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><span class="thick">' . _PJ_PROJECTOPTIONS . '</span></td></tr>'."\n";

$pjimage = pjimage('options.png', $module_name);
echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="4" width="100%" nowrap="nowrap"><a href="' . $admin_file . '.php?op=PJTaskAdd&amp;project_id=' . $project_id . '">' . _PJ_TASKADD . '</a></td></tr>'."\n";

$pjimage = pjimage('stats.png', $module_name);
echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td colspan="4" width="100%" nowrap="nowrap">' . _PJ_TOTALTASKS . ': <span class="thick">' . $task_total . '</span></td></tr>'."\n";
echo '</table>'."\n";
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">'."\n";
echo '<tr><td colspan="2" bgcolor="' . $bgcolor2 . '" width="100%"><span class="thick">' . _PJ_PROJECTTASKS . '</span></a></td>'."\n";
echo '<td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_STATUS . '</span></td><td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_PRIORITY . '</span></td><td align="center" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_FUNCTIONS . '</span></td></tr>'."\n";

if($task_total != 0) {
	while(list($task_id, $task_name, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
		$pjimage = pjimage('task.png', $module_name);
		echo '<tr><td><img src="' . $pjimage. '" alt="" title="" /></td><td width="100%">' . $task_name . '</td>'."\n";

		$taskstatus = pjtaskstatus_info($status_id);
		if($taskstatus['status_name'] == '') {
			$taskstatus['status_name'] = _PJ_NA;
		}

		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJTaskStatusList">' . $taskstatus['status_name'] . '</a></td>'."\n";

		$taskpriority = pjtaskpriority_info($priority_id);
		if($taskpriority['priority_name'] == '') {
			$taskpriority['priority_name'] = _PJ_NA;
		}

		echo '<td align="center"><a href="' . $admin_file . '.php?op=PJTaskPriorityList">' . $taskpriority['priority_name'] . '</a></td>'."\n";
		echo '<td align="center" nowrap="nowrap">[ <a href="' . $admin_file . '.php?op=PJTaskEdit&amp;task_id=' . $task_id . '">' . _PJ_EDIT . '</a>';
		echo ' | <a href="' . $admin_file . '.php?op=PJTaskRemove&amp;task_id=' . $task_id . '">' . _PJ_DELETE . '</a> ]</td></tr>'."\n";
	}
} else {
	echo '<tr><td width="100%" colspan="4" align="center">' . _PJ_NOPROJECTTASKS . '</td></tr>'."\n";
}

echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>