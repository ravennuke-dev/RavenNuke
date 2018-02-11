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

$report_id = intval($report_id);
$report = pjreport_info($report_id);
$project = pjproject_info($report['project_id']);

if($project['allowreports'] > 0) {
	$date = time();
	$stop = '';
	$commenter_ip = $_SERVER['REMOTE_ADDR'];
	if (!validIP($commenter_ip)) $commenter_ip = '';

	if((!$commenter_name) || ($commenter_name=='')) {
		$stop = '<div class="text-center thick">' . _PJ_ERRORNONAME . '</div><br />'."\n";
	}

	if((!$commenter_email) || ($commenter_email=='')) {
		$stop = '<div class="text-center thick">' . _PJ_ERRORNOEMAIL . '</div><br />'."\n";
	}

  if((!preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i', $commenter_email))) {
	$stop = '<div class="text-center thick">' . _PJ_ERRORINVALIDEMAIL . '</div><br />'."\n";
	}

	if((!$comment_description) || ($comment_description=='')) {
		$stop = '<div class="text-center thick">' . _PJ_ERRORNOCOMMENT . '</div><br />'."\n";
	}

	if($stop == '') {
		$report_id = intval($report_id);
		$commenter_name = htmlentities($commenter_name, ENT_QUOTES);
		$comment_description = htmlentities($comment_description, ENT_QUOTES);

		$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_reports_comments VALUES (NULL, "' . $report_id . '", "' . $commenter_name . '", "' . $commenter_email . '", "' . $commenter_ip . '", "' . $comment_description . '", "' . $date . '")');
		$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports SET date_commented="' . $date . '" WHERE report_id=' . $report_id);
		list($submitter_email, $submitter_name) = $db->sql_fetchrow($db->sql_query('SELECT submitter_email, submitter_name FROM ' . $prefix . '_nsnpj_reports WHERE report_id=' . $report_id));

		$admin_email = $adminmail;
		$subject = _PJ_NEWREPORTCOMMENTS;
		$message = _PJ_NEWREPORTCOMMENT . ":\r\n" . $nukeurl . '/modules.php?name=' . $module_name . '&op=PJReport&report_id=' . $report_id;
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

		header('Location: modules.php?name=' . $module_name . '&op=PJReport&report_id=' . $report_id);
	} else {
		$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_COMMENTADD;

		include('header.php');

		title(_PJ_TITLE . ': ' . _PJ_COMMENTADD);

		OpenTable();

		echo '<div class="text-center"><span class="thick">' , _PJ_ERRORCOMMENT , '</span><br />',"\n"
			, $stop , '<br />',"\n"
			, _PJ_RETURN , '</div>' , "\n";

		CloseTable();

		include('footer.php');
	}
} else {
	header('Location: modules.php?name=' . $module_name);
}

?>