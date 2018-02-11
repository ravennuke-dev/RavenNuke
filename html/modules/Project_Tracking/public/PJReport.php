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
	$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTVIEW;

	include('header.php');

	title(_PJ_TITLE . ': ' . _PJ_REPORTVIEW);

	$project = pjproject_info($report['project_id']);
	$reportstatus = pjreportstatus_info($report['status_id']);
	$reporttype = pjreporttype_info($report['type_id']);

	if($reportstatus['status_name'] == '') {
		$reportstatus['status_name'] = _PJ_NA;
	}

	if($reporttype['type_name'] == '') {
		$reporttype['type_name'] = _PJ_NA;
	}

	OpenTable();

	echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="4" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_PROJECTNAME , '</span></td></tr>',"\n";

	$pjimage = pjimage('project.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap"><a href="modules.php?name=' , $module_name , '&amp;op=PJProject&amp;project_id=' , $project['project_id'] , '">' , $project['project_name'] , '</a></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="2" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REPORTINFO , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_TYPE , '</span></td></tr>',"\n";

	$pjimage = pjimage('report.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td><td width="100%" nowrap="nowrap">' , $report['report_name'] , '</td>',"\n";
	echo '<td align="center" nowrap="nowrap">' , $reportstatus['status_name'] , '</td>',"\n";
	echo '<td align="center" nowrap="nowrap">' , $reporttype['type_name'] , '</td></tr>',"\n";

	if($report['report_description'] != '') {
		$pjimage = pjimage('description.png', $module_name);

		echo '<tr><td align="center" valign="top"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
		echo '<td colspan="3" width="100%">' , nl2br($report['report_description']) , '</td></tr>',"\n";
	}

	$pjimage = pjimage('reporter.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_REPORTEDBY , ': <span class="thick"><a href="mailto:' , pjencode_email($report['submitter_email']) , '">' , $report['submitter_name'] , '</a></span></td></tr>',"\n";

	if($report['date_submitted'] != '0') {
		$submit_date = date($pj_config['report_date_format'], $report['date_submitted']);
	} else {
		$submit_date = _PJ_NA;
	}

	$pjimage = pjimage('date.png', $module_name);

	echo '<tr><td align="center"><img src="' . $pjimage . '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_SUBMITTED , ': <span class="thick">' , $submit_date , '</span></td></tr>',"\n";

	if($report['date_modified'] != '0') {
		$modify_date = date($pj_config['report_date_format'], $report['date_modified']);
	} else {
		$modify_date = _PJ_NA;
	}

	$pjimage = pjimage('date.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_MODIFIED , ': <span class="thick">' , $modify_date , '</span></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="3" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REPORTMEMBERS , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_POSITION , '</span></td></tr>',"\n";

	$memberresult = $db->sql_query('SELECT member_id, position_id FROM ' . $prefix . '_nsnpj_reports_members WHERE report_id=' . $report_id . ' ORDER BY member_id');
	$member_total = $db->sql_numrows($memberresult);

	if($member_total != 0) {
		while(list($member_id, $position_id) = $db->sql_fetchrow($memberresult)) {
			$pjimage = pjimage('member.png', $module_name);
			$member = pjmember_info($member_id);
			$position = pjmemberposition_info($position_id);
			echo '<tr><td><img src="' . $pjimage . '" alt="" title="" /></td><td colspan="2" width="100%"><a href="mailto:' , pjencode_email($member['member_email']) , '">' , $member['member_name'] , '</a></td>',"\n";

			if($position['position_name'] == '') {
				$position['position_name'] = '----------';
			}

			echo '<td align="center" nowrap="nowrap">' , $position['position_name'] , '</td></tr>',"\n";
		}
	} else {
		echo '<tr><td align="center" colspan="4" width="100%" nowrap="nowrap">' , _PJ_NOREPORTMEMBERS , '</td></tr>',"\n";
	}

	if(is_admin($admin)) {
		echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="4" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_ADMINFUNCTIONS , '</span></td></tr>',"\n";

		$pjimage = pjimage('options.png', $module_name);

		echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
		echo '<td colspan="3" width="100%" nowrap="nowrap"><a href="' , $admin_file , '.php?op=PJReportEdit&amp;report_id=' , $report_id , '">' , _PJ_REPORTEDIT , '</a>';
		echo ' <a href="' , $admin_file , '.php?op=PJReportRemove&amp;report_id=' , $report_id , '">' , _PJ_DELETEREPORT , '</a>';
		echo ' <a href="' , $admin_file , '.php?op=PJReportImport&amp;report_id=' , $report_id , '">' , _PJ_IMPORTTOTASK , '</a>';
		echo ' <a href="' , $admin_file , '.php?op=PJReportPrint&amp;report_id=' , $report_id , '">' , _PJ_REPORTPRINT , '</a></td></tr>',"\n";
	}

	echo '</table>',"\n";

	CloseTable();

	echo '<br />',"\n";

	$commentresult = $db->sql_query('SELECT comment_id FROM ' . $prefix . '_nsnpj_reports_comments WHERE report_id=' . $report_id . ' ORDER BY date_commented asc');
	$comment_total = $db->sql_numrows($commentresult);

	OpenTable();

	echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_COMMENTS , '</span> <span class="thick">(</span> <a href="modules.php?name=' , $module_name , '&amp;op=PJReportCommentSubmit&amp;report_id=' , $report_id , '">' , _PJ_COMMENTADD , '</a> <span class="thick">)</span></td></tr>',"\n";

	if($comment_total > 0) {
		while(list($comment_id) = $db->sql_fetchrow($commentresult)) {
			$comment = pjreportcomment_info($comment_id);
			$comment_date = date($pj_config['report_date_format'], $comment['date_commented']);

			echo '<tr><td bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick"><a href="mailto:' , pjencode_email($comment['commenter_email']) , '">' , $comment['commenter_name'] , '</a> @ ' , $comment_date , '</span>';

			if(is_admin($admin)) {
				echo ' - (<a href="' , $admin_file , '.php?op=PJReportCommentEdit&amp;comment_id=' , $comment['comment_id'] , '">' , _PJ_EDIT , '</a>, <a href="' , $admin_file , '.php?op=PJReportCommentRemove&amp;comment_id=' , $comment['comment_id'] , '">' , _PJ_DELETE , '</a>)';
			}

			echo '</td></tr>',"\n";
			echo '<tr><td>' , nl2br($comment['comment_description']) , '</td></tr>',"\n";
		}
	} else {
		echo '<tr><td align="center" nowrap="nowrap">' , _PJ_NOREPORTCOMMENTS , '</td></tr>',"\n";
	}

	echo '</table>',"\n";

	CloseTable();

	include('footer.php');

} else {
	header('Location: modules.php?name=' , $module_name);
}

?>