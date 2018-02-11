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

if(!defined('NSNPJ_PUBLIC')) {
	die('Illegal Access Detected!!!');
}

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_TASKMAP;

include('header.php');

title(_PJ_TITLE . ': ' . _PJ_TASKMAP);

$projectresult = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects ORDER BY weight');
while(list($project_id) = $db->sql_fetchrow($projectresult)) {
	$project = pjprojectpercent_info($project_id);
	$projectstatus = pjprojectstatus_info($project['status_id']);
	$projectpriority = pjprojectpriority_info($project['priority_id']);
	$membersresult = $db->sql_query('SELECT member_id FROM ' . $prefix . '_nsnpj_projects_members WHERE project_id="' . $project_id . '" ORDER BY member_id');
	$member_total = $db->sql_numrows($membersresult);

	OpenTable();

	echo '<table align="center" width="100%" border="1" cellspacing="0" cellpadding="2">',"\n";
	echo '<tr>',"\n";
	echo '<td width="100%" bgcolor="' , $bgcolor2 , '" colspan="2"><span class="thick">' , _PJ_PROJECT , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_SITE , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PRIORITY , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PROGRESSBAR , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_MEMBERS , '</span></td>',"\n";
	echo '</tr>',"\n";

	$pjimage = pjimage('project.png', $module_name);
	$project_title = $project['project_name'];

	if($project['featured'] > 0) {
		$project_title = '<span class="thick">' . $project_title . '</span>';
	}

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJProject&amp;project_id=' , $project_id , '">' , $project_title , '</a></td>',"\n";

	if($project['project_site'] > '') {
		$pjimage = pjimage('demo.png', $module_name);
		$demo = ' <a href="' . $project['project_site'] . '" target="_blank"><img src="' . $pjimage . '" border="0" alt="' . $project['project_name'] . ' ' . _PJ_SITE . '" title="' . $project['project_name'] . ' ' . _PJ_SITE . '" /></a>';
	} else {
		$demo = '&nbsp;';
	}

	echo '<td align="center">' , $demo , '</td>',"\n";

	if($projectstatus['status_name'] == '') {
		$projectstatus['status_name'] = _PJ_NA;
	}

	echo '<td align="center" nowrap="nowrap">' , $projectstatus['status_name'] , '</td>',"\n";

	if($projectpriority['priority_name'] == '') {
		$projectpriority['priority_name'] = _PJ_NA;
	}

	echo '<td align="center" nowrap="nowrap">' , $projectpriority['priority_name'] , '</td>',"\n";

	$wbprogress = pjprogress($project['project_percent']);

	echo '<td align="center" nowrap="nowrap">' , $wbprogress , '</td>',"\n";
	echo '<td align="center" nowrap="nowrap">' , $member_total , '</td></tr>',"\n";
	echo '<tr><td width="100%" bgcolor="' , $bgcolor2 , '" colspan="7"><span class="thick">' , _PJ_PROJECTTASKS , '</span></td></tr>',"\n";

	$taskresult = $db->sql_query('SELECT task_id, task_name, task_percent, priority_id, status_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id=' . $project_id . ' ORDER BY task_name');
	$task_total = $db->sql_numrows($taskresult);

	if($task_total != 0) {
		while(list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
			$membersresult = $db->sql_query('SELECT member_id FROM ' . $prefix . '_nsnpj_tasks_members WHERE task_id="' . $task_id . '" ORDER BY member_id');
			$member_total = $db->sql_numrows($membersresult);
			$taskstatus = pjtaskstatus_info($status_id);
			$taskpriority = pjtaskpriority_info($priority_id);
			$pjimage = pjimage('task.png', $module_name);

			echo '<tr><td><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
			echo '<td colspan="2" width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJTask&amp;task_id=' , $task_id , '">' , $task_name , '</a></td>',"\n";

			if($taskstatus['status_name'] == '') {
				$taskstatus['status_name'] = _PJ_NA;
			}

			echo '<td align="center" nowrap="nowrap">' , $taskstatus['status_name'] , '</td>',"\n";

			if($taskpriority['priority_name'] == '') {
				$taskpriority['priority_name'] = _PJ_NA;
			}

			echo '<td align="center" nowrap="nowrap">' , $taskpriority['priority_name'] , '</td>',"\n";

			$wbprogress = pjprogress($task_percent);

			echo '<td align="center" nowrap="nowrap">' , $wbprogress , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $member_total , '</td></tr>',"\n";
		}
	} else {
		echo '<tr>',"\n";
		echo '<td width="100%" colspan=:"7" align="center" nowrap="nowrap">' , _PJ_NOTASKS , '</td>',"\n";
		echo '</tr>',"\n";
	}

	echo '</table>',"\n";

	CloseTable();

	echo '<br />',"\n";
}

include('footer.php');

?>