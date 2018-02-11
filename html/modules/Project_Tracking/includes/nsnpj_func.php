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

if(!defined('MODULE_FILE') && !defined('BLOCK_FILE') && !defined('ADMIN_FILE')) {
	die('Illegal Access Detected!!!');
}

global $admin_file, $nuke_config;

if(!isset($admin_file)) {
	$admin_file = 'admin';
}

define('NSNPJ_FUNC', true);

$module_name = basename(dirname(dirname(__FILE__)));

get_lang($module_name);

if(!isset($lang)) {
	$lang = $nuke_config['language'];
}

function pjget_configs() {
	global $prefix, $db;

	$config = array();
	$configresult = $db->sql_query('SELECT config_name, config_value FROM ' . $prefix . '_nsnpj_config');
	while(list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		$config[$config_name] = $config_value;
	}

	return $config;
}

// Load Config data
$pj_config = pjget_configs();

function pjadmin_menu($pjtitle='') {
	global $pj_config, $bgcolor1, $bgcolor2, $admin_file;

	OpenTable();

	if(!empty($pjtitle)) {
		$pjtitle = ': ' . $pjtitle;
	} else {
		$pjtitle = ': ' . _PJ_ADMIN;
	}

	echo '<div class="text-center title thick">' , _PJ_TITLE , ' ' , $pjtitle , '</div><br />',"\n";
	echo '<table border="1" align="center" width="100%" cellpadding="2" cellspacing="0">',"\n";
	echo '<tr bgcolor="' , $bgcolor2 , '">',"\n";
	echo '<td align="center" valign="top" width="20%">&nbsp;<span class="thick underline">' , _PJ_PROJECTS , '</span>&nbsp;</td>',"\n";
	echo '<td align="center" valign="top" width="20%">&nbsp;<span class="thick underline">' , _PJ_TASKS , '</span>&nbsp;</td>',"\n";
	echo '<td align="center" valign="top" width="20%">&nbsp;<span class="thick underline">' , _PJ_REPORTS , '</span>&nbsp;</td>',"\n";
	echo '<td align="center" valign="top" width="20%">&nbsp;<span class="thick underline">' , _PJ_REQUESTS , '</span>&nbsp;</td>',"\n";
	echo '<td align="center" valign="top" width="20%">&nbsp;<span class="thick underline">' , _PJ_MEMBERS , '</span>&nbsp;</td>',"\n";
	echo '</tr>',"\n";
	echo '<tr>',"\n";
	echo '<td align="center" valign="top" width="20%" rowspan="3">',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJProjectConfig">' , _PJ_CONFIG , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJProjectList">' , _PJ_PROJECTLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJProjectPriorityList">' , _PJ_PRIORITYLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJProjectStatusList">' , _PJ_STATUSLIST , '</a>&nbsp;<br />',"\n";
	echo '</td>',"\n";
	echo '<td align="center" valign="top" width="20%" rowspan="3">',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJTaskConfig">' , _PJ_CONFIG , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJTaskList">' , _PJ_TASKLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJTaskPriorityList">' , _PJ_PRIORITYLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJTaskStatusList">' , _PJ_STATUSLIST , '</a>&nbsp;<br />',"\n";
	echo '</td>',"\n";
	echo '<td align="center" valign="top" width="20%" rowspan="3">';
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJReportConfig">' , _PJ_CONFIG , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJReportList">' , _PJ_REPORTLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJReportStatusList">' , _PJ_STATUSLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJReportTypeList">' , _PJ_TYPELIST , '</a>&nbsp;<br />',"\n";
	echo '</td>',"\n";
	echo '<td align="center" valign="top" width="20%" rowspan="3">';
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJRequestConfig">' , _PJ_CONFIG , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJRequestList">' , _PJ_REQUESTLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJRequestStatusList">' , _PJ_STATUSLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJRequestTypeList">' , _PJ_TYPELIST , '</a>&nbsp;<br />',"\n";
	echo '</td>',"\n";
	echo '<td align="center" valign="top" width="20%">';
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJMemberList">' , _PJ_MEMBERLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;<a href="' , $admin_file , '.php?op=PJMemberPositionList">' , _PJ_POSITIONLIST , '</a>&nbsp;<br />',"\n";
	echo '&nbsp;&nbsp;<br />',"\n";
	echo '</td>',"\n";
	echo '</tr>',"\n";
	echo '</table>',"\n";

	CloseTable();
}

function pjimage($imgfile, $module_name) {
	$ThemeSel = get_theme();

	if(file_exists('themes/' . $ThemeSel . '/images/' . $module_name . '/' . $imgfile)) {
		$pjimage = 'themes/' . $ThemeSel . '/images/' . $module_name . '/' . $imgfile;
	} else {
		$pjimage = 'modules/' . $module_name . '/images/' . $imgfile;
	}

	return($pjimage);
}

function pjprogress($percent) {
	global $module_name;

	$pjimage = pjimage('bar_left.png', $module_name);
	$wbprogress  = '<img src="' . $pjimage . '" width="1" height="7" alt="" title="" />';

	if($percent == 0) {
		$pjimage = pjimage('bar_center_red.png', $module_name);
		$wbprogress .= '<img src="' . $pjimage . '" width="100" height="7" alt="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
	} else {
		if($percent > 100) {
			$progress = 100;
		} else {
			$progress = $percent;
		}
    
		$pjimage = pjimage('bar_center_grn.png', $module_name);
		$wbprogress .= '<img src="' . $pjimage . '" width="' . $progress . '" height="7" alt="' . $progress . _PJ_PERCENT . ' '._PJ_COMPLETED . '" title="' . $progress . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
		
		if($progress < 100) {
			$incomplete = 100 - $progress;
			$pjimage = pjimage('bar_center_red.png', $module_name);
			$wbprogress .= '<img src="' . $pjimage . '" width="' . $incomplete . '" height="7" alt="' . $progress . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="' . $progress . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
		}
	}

	$pjimage = pjimage('bar_right.png', $module_name);
	$wbprogress .= '<img src="' . $pjimage . '" width="1" height="7" alt="" title="" />';

	return($wbprogress);
}

function pjmember_info($member_id) {
	global $prefix, $db;

	$member_id = intval($member_id);
	$member = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_members WHERE member_id="' . $member_id . '"'));

	return $member;
}

function pjmemberposition_info($position_id) {
	global $prefix, $db;

	$position_id = intval($position_id);
	$position = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_members_positions WHERE position_id="' . $position_id . '"'));

	return $position;
}

function pjproject_info($project_id) {
	global $prefix, $db;

	$project_id = intval($project_id);
	$project = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects WHERE project_id="' . $project_id . '"'));

	return $project;
}

function pjprojectpriority_info($priority_id) {
	global $prefix, $db;

	$priority_id = intval($priority_id);
	$priority = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects_priorities WHERE priority_id="' . $priority_id . '"'));

	return $priority;
}

function pjprojectstatus_info($status_id) {
	global $prefix, $db;

	$status_id = intval($status_id);
	$status = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects_status WHERE status_id="' . $status_id . '"'));

	return $status;
}

function pjtask_info($task_id) {
	global $prefix, $db;

	$task_id = intval($task_id);
	$task = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks WHERE task_id="' . $task_id . '"'));

	return $task;
}

function pjtaskpriority_info($priority_id) {
	global $prefix, $db;

	$priority_id = intval($priority_id);
	$priority = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks_priorities WHERE priority_id="' . $priority_id . '"'));

	return $priority;
}

function pjtaskstatus_info($status_id) {
	global $prefix, $db;

	$status_id = intval($status_id);
	$status = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks_status WHERE status_id="' . $status_id . '"'));

	return $status;
}

function pjprojectpercent_info($project_id) {
	global $prefix, $db;

	$project_id = intval($project_id);
	$project = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects WHERE project_id="' . $project_id . '"'));
	$percentresult = $db->sql_query('SELECT task_percent, priority_id FROM ' . $prefix . '_nsnpj_tasks WHERE project_id="' . $project_id . '"');
	$percentnumber = $db->sql_numrows($percentresult);

	if($project['project_percent'] == 0 AND $percentnumber > 0) {
		$percentoverall = $percentfactor = 0;
		while(list($task_percent, $priority_id) = $db->sql_fetchrow($percentresult)) {
			$taskpriority = pjtaskpriority_info($priority_id);
			if($taskpriority['priority_weight'] > 0) {
				$percentoverall = $percentoverall + ($task_percent * $taskpriority['priority_weight']);
				$percentfactor = $percentfactor + $taskpriority['priority_weight'];
			}
		}

		if($percentnumber > 0 AND $percentfactor > 0) {
			$percenttotal = $percentoverall / $percentfactor;
			$project['project_percent'] = number_format($percenttotal, 0, '.', ',');
		}
	}

	return $project;
}

function pjencode_email($email_address) {
	$encoded = bin2hex($email_address);
	$encoded = chunk_split($encoded, 2, '%');
	$encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);

	return $encoded;
}

function pjsave_config($config_name, $config_value){
	global $prefix, $db;

	$resultnum = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_config WHERE config_name="' . $config_name . '"'));
	if($resultnum < 1) {
		$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_config (config_name, config_value) VALUES ("' . $config_name . '", "' . $config_value . '")');
	} else {
		$db->sql_query('UPDATE ' . $prefix . '_nsnpj_config SET config_value="' . $config_value . '" WHERE config_name="' . $config_name . '"');
	}

	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_config');
}

function pjunhtmlentities($string) {
	$trans_tbl = get_html_translation_table(HTML_ENTITIES);
	$trans_tbl = array_flip($trans_tbl);

	return strtr($string, $trans_tbl);
}

function pjreport_info($report_id) {
	global $prefix, $db;

	$report_id = intval($report_id);
	$report = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports WHERE report_id="' . $report_id . '"'));

	return $report;
}

function pjreportcomment_info($comment_id) {
	global $prefix, $db;

	$comment_id = intval($comment_id);
	$reportcomment = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_comments WHERE comment_id="' . $comment_id . '"'));

	return $reportcomment;
}

function pjreportstatus_info($status_id) {
	global $prefix, $db;

	$status_id = intval($status_id);
	$reportstatus = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_status WHERE status_id="' . $status_id . '"'));

	return $reportstatus;
}

function pjreporttype_info($type_id) {
	global $prefix, $db;

	$type_id = intval($type_id);
	$reporttype = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_types WHERE type_id="' . $type_id . '"'));

	return $reporttype;
}

function pjrequest_info($request_id) {
	global $prefix, $db;

	$request_id = intval($request_id);
	$request = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests WHERE request_id="' . $request_id . '"'));

	return $request;
}

function pjrequestcomment_info($comment_id) {
	global $prefix, $db;

	$comment_id = intval($comment_id);
	$requestcomment = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests_comments WHERE comment_id="' . $comment_id . '"'));

	return $requestcomment;
}

function pjrequeststatus_info($status_id) {
	global $prefix, $db;

	$status_id = intval($status_id);
	$requeststatus = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests_status WHERE status_id="' . $status_id . '"'));

	return $requeststatus;
}

function pjrequesttype_info($type_id) {
	global $prefix, $db;

	$type_id = intval($type_id);
	$requesttype = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests_types WHERE type_id="' . $type_id . '"'));

	return $requesttype;
}

function pj_copy() {
	global $module_name;

	$cpname = str_replace('_', ' ', $module_name);
	echo '<script type="text/javascript">'."\n";
	echo '<!--'."\n";
	echo 'function nsnpjwindow() {'."\n";
	echo 'window.open ("modules/' . $module_name . '/copyright.php", "Copyright", "toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,height=300,width=420,screenX=100,left=100,screenY=100,top=100")'."\n";
	echo '}'."\n";
	echo '//-->'."\n";
	echo '</script>'."\n\n";
	echo '<div align="right"><a href="javascript:nsnpjwindow()">' . $cpname . ' &copy;</a></div>'."\n";
}

?>