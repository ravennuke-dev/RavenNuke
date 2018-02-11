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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_VIEWPROJECT;

include('header.php');

$project_id = intval($project_id);
$project = pjprojectpercent_info($project_id);
$projectstatus = pjprojectstatus_info($project['status_id']);

$memberresult = $db->sql_query('SELECT member_id FROM ' . $prefix . '_nsnpj_projects_members WHERE project_id="' . $project_id . '" ORDER BY member_id');
$member_total = $db->sql_numrows($memberresult);
$project_reports = $db->sql_numrows($db->sql_query('SELECT report_id FROM ' . $prefix . '_nsnpj_reports WHERE project_id=' . $project_id));
$project_requests = $db->sql_numrows($db->sql_query('SELECT request_id FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id));
$project_tasks = $db->sql_numrows($db->sql_query('SELECT task_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id=' . $project_id));

$projectpriority = pjprojectpriority_info($project['priority_id']);

title(_PJ_TITLE . ': ' . _PJ_VIEWPROJECT);

OpenTable();

echo '<table align="center" width="100%" border="1" cellspacing="0" cellpadding="2">',"\n";
echo '<tr><td bgcolor="' , $bgcolor2 , '" width="100%" colspan="2" nowrap="nowrap"><span class="thick">' , _PJ_PROJECTNAME , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PRIORITY , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PROGRESSBAR , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_MEMBERS , '</span></td></tr>',"\n";

if($project['featured'] > 0) {
	$project['project_name'] = '<span class="thick">' . $project['project_name'] . '</span>';
}

$pjimage = pjimage('project.png', $module_name);

echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
echo '<td width="100%" nowrap="nowrap">' , $project['project_name'] , '</td>',"\n";

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

if($project['project_site'] != '') {
	$pjimage = pjimage('demo.png', $module_name);
	echo '<tr><td align="center" valign="top"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td width="100%" colspan="5"><a href="' , $project['project_site'] , '" target="_blank">' , $project['project_site'] , '</a></td></tr>',"\n";
}

if($project['project_description'] != '') {
	$pjimage = pjimage('description.png', $module_name);
	echo '<tr><td align="center" valign="top"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td width="100%" colspan="5">' , nl2br($project['project_description']) , '</td></tr>',"\n";
}

$pjimage = pjimage('stats.png', $module_name);

echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td><td width="100%" colspan="5" nowrap="nowrap">' , _PJ_TASKS . ': <span class="thick">' , $project_tasks , '</span>&nbsp;&nbsp;/&nbsp;&nbsp;' , _PJ_REPORTS , ': <span class="thick">' , $project_reports , '</span>&nbsp;&nbsp;/&nbsp;&nbsp;' , _PJ_REQUESTS , ': <span class="thick">' , $project_requests , '</span></td></tr>';

if($project['date_started'] > 0) {
	$start_date = date($pj_config['project_date_format'], $project['date_started']);
} else {
	$start_date = _PJ_NA;
}

$pjimage = pjimage('date.png', $module_name);

echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
echo '<td width="100%" colspan="5" nowrap="nowrap">' , _PJ_STARTDATE , ': <span class="thick">' , $start_date , '</span></td></tr>',"\n";

if($project['date_finished'] > 0) {
	$finish_date = date($pj_config['project_date_format'], $project['date_finished']);
} else {
	$finish_date = _PJ_NA;
}

$pjimage = pjimage('date.png', $module_name);

echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
echo '<td width="100%" colspan="5" nowrap="nowrap">' , _PJ_FINISHDATE , ': <span class="thick">' , $finish_date , '</span></td></tr>',"\n";
echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="4" nowrap="nowrap"><span class="thick">' , _PJ_PROJECTMEMBERS , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" colspan="2" nowrap="nowrap"><span class="thick">' , _PJ_POSITION , '</span></td></tr>',"\n";

$memberresult = $db->sql_query('SELECT member_id, position_id FROM ' . $prefix . '_nsnpj_projects_members WHERE project_id=' . $project_id . ' ORDER BY member_id');
$member_total = $db->sql_numrows($memberresult);

if($member_total != 0) {
	while(list($member_id, $position_id) = $db->sql_fetchrow($memberresult)) {
		$member = pjmember_info($member_id);
		$position = pjmemberposition_info($position_id);
		$pjimage = pjimage('member.png', $module_name);
		echo '<tr><td><img src="' , $pjimage , '" alt="" title="" /></td><td width="100%" colspan="3"><a href="mailto:' , pjencode_email($member['member_email']) , '">' , $member['member_name'] , '</a></td>',"\n";

		if($position['position_name'] == '') {
			$position['position_name'] = "----------";
		}

		echo '<td align="center" colspan="2" nowrap="nowrap">' , $position['position_name'] , '</td></tr>',"\n";
	}
} else {
	echo '<tr><td colspan="6" nowrap="nowrap" class="text-center">' , _PJ_NOPROJECTMEMBERS , '</td></tr>',"\n";
}

if(is_admin($admin)) {
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="6" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_ADMINFUNCTIONS , '</span></td></tr>',"\n";
	$pjimage = pjimage('options.png', $module_name);
	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="5" width="100%" nowrap="nowrap"><a href="' , $admin_file , '.php?op=PJProjectEdit&amp;project_id=' , $project_id , '">' , _PJ_EDITPROJECT , '</a>';
	echo ', <a href="' , $admin_file , '.php?op=PJProjectRemove&amp;project_id=' , $project_id , '">' , _PJ_DELETEPROJECT , '</a></td></tr>',"\n";
}

echo '</table>',"\n";
echo '<br />',"\n";

if(empty($column1)) {
	$column1 = "task_name";
}

if(empty($direction1)) {
	$direction1 = "asc";
}

echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">',"\n";
echo '<tr>',"\n";
echo '<td colspan="2" bgcolor="' , $bgcolor2 , '" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_TASKS . '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PRIORITY , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PROGRESSBAR , '</span></td>',"\n";
echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_MEMBERS , '</span></td>',"\n";
echo '</tr>',"\n";

$taskresult = $db->sql_query('SELECT task_id, task_name, task_percent, priority_id, status_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id=' . $project_id . ' ORDER BY ' . $column1 . ' ' . $direction1);
$task_total = $db->sql_numrows($taskresult);

if($task_total != 0) {
	while(list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
		$taskstatus = pjtaskstatus_info($status_id);
		$memberresult = $db->sql_query('SELECT member_id FROM ' . $prefix . '_nsnpj_tasks_members WHERE task_id="' . $task_id . '" ORDER BY member_id');
		$member_total = $db->sql_numrows($memberresult);
		$taskpriority = pjtaskpriority_info($priority_id);

		echo '<tr>',"\n";

		$pjimage = pjimage('task.png', $module_name);

		echo '<td><img src="' . $pjimage . '" alt="" title="" /></td>',"\n";
		echo '<td width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJTask&amp;task_id=' , $task_id , '">' , $task_name , '</a></td>',"\n";

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
		echo '<td align="center" nowrap="nowrap">' , $member_total , '</td>',"\n";
		echo '</tr>',"\n";
	}
	echo '<tr>',"\n";
	echo '<td align="right" bgcolor="' , $bgcolor2 , '" width="100%" colspan="6">',"\n";
	echo '<form method="post" action="modules.php">',"\n";
	echo '<input type="hidden" name="name" value="' , $module_name , '"/>',"\n";
	echo '<input type="hidden" name="op" value="PJProject" />',"\n";
	echo '<input type="hidden" name="project_id" value="' , $project_id , '" />',"\n";
	echo '<span class="thick">' , _PJ_SORT , ':</span> <select name="column1">',"\n";

	if($column1 == "task_name") {
		$selcolumn11 = 'selected="selected"';
	} else {
		$selcolumn11 = '';
	}

	echo '<option value="task_name" ' , $selcolumn11 , '>' , _PJ_TASKNAME , '</option>',"\n";

	if($column1 == "status_id") {
		$selcolumn12 = 'selected="selected"';
	} else {
		$selcolumn12 = '';
	}

	echo '<option value="status_id" ' , $selcolumn12 , '>' , _PJ_STATUS , '</option>',"\n";

	if($column1 == "priority_id") {
		$selcolumn13 = 'selected="selected"';
	} else {
		$selcolumn13 = '';
	}

	echo '<option value="priority_id" ' , $selcolumn13 , '>' , _PJ_PRIORITY , '</option>',"\n";
	echo '</select>';
	echo '&nbsp;<select name="direction1">',"\n";

	if($direction1 == "asc") {
		$seldirection11 = 'selected="selected"';
	} else {
		$seldirection11 = '';
	}

	echo '<option value="asc" ' , $seldirection11 , '>' , _PJ_ASC , '</option>',"\n";

	if($direction1 == "desc") {
		$seldirection12 = 'selected="selected"';
	} else {
		$seldirection12 = '';
	}

	echo '<option value="desc" ' , $seldirection12 , '>' , _PJ_DESC . '</option>',"\n";
	echo '</select>';
	echo '&nbsp;<input type="submit" value="' , _PJ_SORT , '" />',"\n";
	echo '</form></td></tr>',"\n";
} else {
	echo '<tr><td width="100%" colspan="6" align="center" nowrap="nowrap">' , _PJ_NOPROJECTTASKS , '</td></tr>',"\n";
}

echo '</table>',"\n";

if($project['allowreports'] > 0) {
	echo '<br />',"\n";

	if(empty($column2)) {
		$column2 = "report_name";
	}

	if(empty($direction2)) {
		$direction2 = "asc";
	}

	echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
	echo '<tr><td colspan="6" nowrap="nowrap"><a href="modules.php?name=' , $module_name , '&amp;op=PJReportSubmit&amp;project_id=' , $project_id , '">' , _PJ_SUBMITAREPORT , '</a></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="2" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REPORTS , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_TYPE , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_SUBMITTED , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_COMMENTS , '</span></td></tr>',"\n";

	$reportresult = $db->sql_query('SELECT report_id FROM ' . $prefix . '_nsnpj_reports WHERE project_id=' . $project_id . ' ORDER BY ' . $column2 . ' ' . $direction2);
	$report_total = $db->sql_numrows($reportresult);

	if($report_total != 0) {
		while(list($report_id) = $db->sql_fetchrow($reportresult)) {
			$report = pjreport_info($report_id);
			$reporttype = pjreporttype_info($report['type_id']);
			$reportstatus = pjreportstatus_info($report['status_id']);

			if($report['report_name'] == '') {
				$report['report_name'] = "----------";
			}

			if($reporttype['type_name'] == '') {
				$reporttype['type_name'] = _PJ_NA;
			}

			if($reportstatus['status_name'] == '') {
				$reportstatus['status_name'] = _PJ_NA;
			}

			$last_date = date($pj_config['report_date_format'], $report['date_submitted']);
			$comments = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_comments WHERE report_id="$report_id"'));
			$pjimage = pjimage('report.png', $module_name);
		
			echo '<tr><td><img src="' . $pjimage . '" alt="" title="" /></td>',"\n";
			echo '<td width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJReport&amp;report_id=' , $report_id , '">' , $report['report_name'] , '</a></td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $reporttype['type_name'] , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $reportstatus['status_name'] , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $last_date , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $comments , '</td></tr>',"\n";
		}
    
		echo '<tr>',"\n";
		echo '<td align="right" bgcolor="' , $bgcolor2 , '" width="100%" colspan="6">',"\n";
		echo '<form method="post" action="modules.php">',"\n";
		echo '<input type="hidden" name="name" value="' , $module_name , '" />',"\n";
		echo '<input type="hidden" name="op" value="PJProject" />',"\n";
		echo '<input type="hidden" name="project_id" value="' , $project_id , '" />',"\n";
		echo '<span class="thick">' , _PJ_SORT , ':</span> <select name="column2">',"\n";

		if($column2 == "report_name") {
			$selcolumn21 = 'selected="selected"';
		} else {
			$selcolumn21 = '';
		}

		echo '<option value="report_name" ' , $selcolumn21 , '>' , _PJ_REPORTNAME , '</option>',"\n";

		if($column2 == "status_id") {
			$selcolumn22 = 'selected="selected"';
		} else {
			$selcolumn22 = '';
		}
    
		echo '<option value="status_id" ' , $selcolumn22 , '>' , _PJ_STATUS , '</option>',"\n";
    
		if($column2 == "type_id") {
			$selcolumn23 = 'selected="selected"';
		} else {
			$selcolumn23 = '';
		}

		echo '<option value="type_id" ' , $selcolumn23 , '>' , _PJ_TYPE , '</option>',"\n";

		if($column2 == "date_submitted") {
			$selcolumn24 = 'selected="selected"';
		} else {
			$selcolumn24 = '';
		}

		echo '<option value="date_submitted" ' , $selcolumn24 , '>' , _PJ_SUBMITTED , '</option>',"\n";

		echo '</select>',"\n";

		echo '<select name="direction2">',"\n";

		if($direction2 == "asc") {
			$seldirection21 = 'selected="selected"';
		} else {
			$seldirection21 = '';
		}

		echo '<option value="asc" ' , $seldirection21 , '>' , _PJ_ASC , '</option>',"\n";

		if($direction2 == "desc") {
			$seldirection22 = 'selected="selected"';
		} else {
			$seldirection22 = '';
		}

		echo '<option value="desc" ' , $seldirection22 , '>' , _PJ_DESC , '</option>',"\n";
		echo '</select>',"\n";
		echo '<input type="submit" value="' , _PJ_SORT , '" />',"\n";
		echo '</form></td></tr>',"\n";
	} else {
		echo '<tr><td align="center" colspan="6" width="100%" nowrap="nowrap">' , _PJ_NOPROJECTREPORTS , '</td></tr>',"\n";
	}

	echo '</table>',"\n";
}

if($project['allowrequests'] > 0) {
	echo '<br />',"\n";

	if(empty($column3)) {
		$column3 = "request_name";
	}

	if(empty($direction3)) {
		$direction3 = "asc";
	}

	echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
	echo '<tr><td colspan="6" nowrap="nowrap"><a href="modules.php?name=' , $module_name , '&amp;op=PJRequestSubmit&amp;project_id=' , $project_id , '">' , _PJ_SUBMITAREQUEST , '</a></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="2" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REQUESTS , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_TYPE , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_SUBMITTED , '</span></td>',"\n";
	echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_COMMENTS , '</span></td></tr>',"\n";

	$requestresult = $db->sql_query('SELECT request_id FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id . ' ORDER BY ' . $column3 . ' ' . $direction3);
	$request_total = $db->sql_numrows($requestresult);

	if($request_total != 0) {
		while(list($request_id) = $db->sql_fetchrow($requestresult)) {
			$request = pjrequest_info($request_id);
			$requesttype = pjrequesttype_info($request['type_id']);
			$requeststatus = pjrequeststatus_info($request['status_id']);

			if($request['request_name'] == '') {
				$request['request_name'] = "----------";
			}

			if($requesttype['type_name'] == '') {
				$requesttype['type_name'] = _PJ_NA;
			}

			if($requeststatus['status_name'] == '') {
				$requeststatus['status_name'] = _PJ_NA;
			}

			$last_date = date($pj_config['request_date_format'], $request['date_submitted']);    
			$comments = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests_comments WHERE request_id=' . $request_id));
			$pjimage = pjimage('request.png', $module_name);

			echo '<tr><td><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
			echo '<td width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJRequest&amp;request_id=' , $request_id , '">' , $request['request_name'] , '</a></td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $requesttype['type_name'] , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $requeststatus['status_name'] , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $last_date , '</td>',"\n";
			echo '<td align="center" nowrap="nowrap">' , $comments , '</td></tr>',"\n";
		}

		echo '<tr>',"\n";
		echo '<td align="right" bgcolor="' , $bgcolor2 , '" width="100%" colspan="6">',"\n";
		echo '<form method="post" action="modules.php">',"\n";
		echo '<input type="hidden" name="name" value="' , $module_name , '" />',"\n";
		echo '<input type="hidden" name="op" value="PJProject" />',"\n";
		echo '<input type="hidden" name="project_id" value="' , $project_id , '" />',"\n";
		echo '<span class="thick">' , _PJ_SORT , ':</span> <select name="column3">',"\n";
		
		if($column3 == "request_name") {
			$selcolumn31 = 'selected="selected"';
		} else {
			$selcolumn31 = '';
		}

		echo '<option value="request_name" ' , $selcolumn31 , '>' , _PJ_REQUESTNAME , '</option>',"\n";

		if($column3 == "status_id") {
			$selcolumn32 = 'selected="selected"';
		} else {
			$selcolumn32 = '';
		}

		echo '<option value="status_id" ' , $selcolumn32 , '>' , _PJ_STATUS , '</option>',"\n";

		if($column3 == "type_id") {
			$selcolumn33 = 'selected="selected"';
		} else {
			$selcolumn33 = '';
		}

		echo '<option value="type_id" ' , $selcolumn33 , '>' , _PJ_TYPE , '</option>',"\n";

		if($column3 == "date_submitted") {
			$selcolumn34 = 'selected="selected"';
		} else {
			$selcolumn34 = '';
		}

		echo '<option value="date_submitted" ' , $selcolumn34 , '>' , _PJ_SUBMITTED , '</option>',"\n";
		echo '</select>',"\n";
		echo '<select name="direction3">',"\n";

		if($direction3 == "asc") {
			$seldirection31 = 'selected="selected"';
		} else {
			$seldirection31 = '';
		}

		echo '<option value="asc" ' , $seldirection31 , '>' , _PJ_ASC , '</option>',"\n";

		if($direction3 == "desc") {
			$seldirection32 = 'selected="selected"';
		} else {
			$seldirection32 = '';
		}

		echo '<option value="desc" ' , $seldirection32 , '>' , _PJ_DESC , '</option>',"\n";
		echo '</select>',"\n";
		echo '<input type="submit" value="' , _PJ_SORT , '" />',"\n";
		echo '</form></td></tr>',"\n";
	} else {
		echo '<tr><td align="center" colspan="6" width="100%" nowrap="nowrap">' , _PJ_NOPROJECTREQUESTS , '</td></tr>',"\n";
	}

	echo '</table>',"\n";
}

CloseTable();

include('footer.php');

?>