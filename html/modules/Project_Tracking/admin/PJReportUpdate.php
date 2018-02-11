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
$report_name = htmlentities($report_name, ENT_QUOTES);
$report_description = htmlentities($report_description, ENT_QUOTES);
$submitter_name = htmlentities($submitter_name, ENT_QUOTES);

$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports SET project_id="' . $project_id . '", type_id="' . $type_id . '", report_name="' . $report_name . '", report_description="' . $report_description . '", submitter_name="' . $submitter_name . '", submitter_email="' . $submitter_email . '", status_id="' . $status_id . '", date_modified="' . $date . '" WHERE report_id="' . $report_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports');

if (!isset($member_ids)) {
	$member_ids = array();
}

if(implode('', $member_ids) > '') {
	while(list($null, $member_id) = each($member_ids)) {
		$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports_members WHERE report_id="' . $report_id . '" AND member_id="' . $member_id . '"'));
		if($numrows == 0) {
			$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_reports_members VALUES ("' . $report_id . '", "' . $member_id . '", "' . $pj_config['new_report_position'] . '")');
		}
	}
}

list($submitter_email, $submitter_name) = $db->sql_fetchrow($db->sql_query('SELECT submitter_email, submitter_name FROM ' . $prefix . '_nsnpj_reports WHERE report_id="' . $report_id . '"'));

$admin_email = $adminmail;
$subject = _PJ_NEWREPORTUPDATEDS;
$message = _PJ_NEWREPORTUPDATED . ":\r\n" . $nukeurl . '/modules.php?name=' . $module_name . '&op=PJReport&report_id=' . $report_id;
$from  = 'From: ' . $admin_email . "\r\n";
$from .= 'Reply-To: ' . $admin_email . "\r\n";
$from .= 'Return-Path: ' . $admin_email . "\r\n";

if($pj_config['notify_report_admin'] == 1) {
	if (TNML_IS_ACTIVE) {
		tnml_fMailer($admin_email, $subject, $message, $submitter_email, $submitter_name);
	} else {
		mail($admin_email, $subject, $message, $from);
	}
}

if($pj_config['notify_report_submitter'] == 1) {
	if (TNML_IS_ACTIVE) {
		tnml_fMailer($submitter_email, $subject, $message, $admin_email);
	} else {
		mail($submitter_email, $subject, $message, $from);
	}
}

header('Location: ' . $admin_file . '.php?op=PJReportEdit&report_id=' . $report_id);

?>