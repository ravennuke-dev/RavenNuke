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

$project_id = intval($project_id);
$project = pjproject_info($project_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_projects WHERE project_id="' . $project_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects');
$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_projects_members WHERE project_id="' . $project_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects_members');

$taskresult = $db->sql_query('SELECT task_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id="' . $project_id . '"');
while(list($task_id) = $db->sql_fetchrow($taskresult)) {
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_tasks WHERE task_id="' . $task_id . '"');
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_tasks_members WHERE task_id="' . $task_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_tasks');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_tasks_members');

$reportresult = $db->sql_query('SELECT report_id FROM ' . $prefix . '_nsnpj_reports WHERE project_id="' . $project_id . '"');
while(list($report_id) = $db->sql_fetchrow($reportresult)) {
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports WHERE report_id="' . $report_id . '"');
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_members WHERE report_id="' . $report_id . '"');
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_comments WHERE report_id="' . $report_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_members');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_comments');

$requestresult = $db->sql_query('SELECT request_id FROM ' . $prefix . '_nsnpj_requests WHERE project_id="' . $project_id . '"');
while(list($request_id) = $db->sql_fetchrow($requestresult)) {
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_requests WHERE request_id="' . $request_id . '"');
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_requests_members WHERE request_id="' . $request_id . '"');
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_requests_comments WHERE request_id="' . $request_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_requests');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_requests_members');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_requests_comments');

$projectresult = $db->sql_query('SELECT project_id, weight FROM ' . $prefix . '_nsnpj_projects WHERE weight>="' . $project['weight'] . '"');
while(list($p_project_id, $weight) = $db->sql_fetchrow($projectresult)) {
	$new_weight = $weight - 1;
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects SET weight="' . $new_weight . '" WHERE project_id="' . $p_project_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects');

header('Location: ' . $admin_file . '.php?op=PJProjectList');

?>