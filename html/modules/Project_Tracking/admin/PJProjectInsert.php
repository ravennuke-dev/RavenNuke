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
$project_name = htmlentities($project_name, ENT_QUOTES);
$project_description = htmlentities($project_description, ENT_QUOTES);
$project_site = str_replace('http://', '', strtolower($project_site));
$project_site = 'http://'.htmlentities($project_site, ENT_QUOTES);

if($project_site == 'http://') {
	$project_site = '';
}

$priority_id = intval($priority_id);
$status_id = intval($status_id);
$project_percent = intval($project_percent);
$featured = intval($featured);
$start_date = $project_start_year . '-' . $project_start_month . '-' . $project_start_day;

if($start_date == '0000-00-00') {
	$start_date = 0;
} else {
	$start_date = strtotime($start_date);
}

$finish_date = $project_finish_year . '-' . $project_finish_month . '-' . $project_finish_day;

if($finish_date == '0000-00-00') {
	$finish_date = 0;
} else {
	$finish_date = strtotime($finish_date);
}

$result = $db->sql_query('SELECT weight FROM ' . $prefix . '_nsnpj_projects ORDER BY weight DESC');
if(!$result) {
	$weight = 1;
} else {
	list($lweight) = $db->sql_fetchrow($result);
	$weight = $lweight + 1;
}

$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_projects VALUES (NULL, "' . $project_name . '", "' . $project_description . '", "' . $project_site . '", "' . $priority_id . '", "' . $status_id . '", "' . $project_percent . '", "' . $weight . '", "' . $featured . '", "' . $allowreports . '", "' . $allowrequests . '", "' . $date . '", "' . $start_date . '", "' . $finish_date . '")');
$projectresult = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects WHERE date_created="' . $date . '"');
list($project_id) = $db->sql_fetchrow($projectresult);

if (!isset($member_ids)) {
	$member_ids = array();
}

if(implode('', $member_ids) > '') {
	while(list($null, $member_id) = each($member_ids)) {
		$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects_members WHERE project_id="' . $project_id . '" AND member_id="' . $member_id . '"'));
		if($numrows == 0) {
			$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_projects_members VALUES ("' . $project_id . '", "' . $member_id . '", "' . $pj_config['new_project_position'] . '")');
		}
	}
}

header('Location: ' . $admin_file . '.php?op=PJProjectList&project_id=' . $project_id);

?>