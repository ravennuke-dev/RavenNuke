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

$date = time();
$task_name = htmlentities($task_name, ENT_QUOTES);
$task_description = htmlentities($task_description, ENT_QUOTES);
$start_date = $task_start_year . '-' . $task_start_month . '-' . $task_start_day;

if($start_date == '0000-00-00') {
	$start_date = 0;
} else {
	$start_date = strtotime($start_date);
}

$finish_date = $task_finish_year . '-' . $task_finish_month . '-' . $task_finish_day;

if($finish_date == '0000-00-00') {
	$finish_date = 0;
} else {
	$finish_date = strtotime($finish_date);
}

$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_tasks VALUES (NULL, "' . $project_id . '", "' . $task_name . '", "' . $task_description . '", "' . $priority_id . '", "' . $status_id . '", "' . $task_percent . '", "' . $date . '", "' . $start_date . '", "' . $finish_date . '")');
$taskresult = $db->sql_query('SELECT task_id FROM ' . $prefix . '_nsnpj_tasks WHERE date_created="' . $date . '"');
list($task_id) = $db->sql_fetchrow($taskresult);

if (!isset($member_ids)) {
	$member_ids = array();
}

if(implode('', $member_ids) > '') {
	while(list($null, $member_id) = each($member_ids)) {
		$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks_members WHERE task_id="' . $task_id . '" AND member_id="' . $member_id . '"'));
		if($numrows == 0) {
			$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_tasks_members VALUES ("' . $task_id . '", "' . $member_id . '", "' . $pj_config['new_task_position'] . '")');
		}
	}
}

header('Location: modules.php?name=' . $module_name . '&op=PJReport&report_id=' . $report_id);

?>