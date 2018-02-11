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

if(!defined('BLOCK_FILE')) {
	Header('Location: ../index.php');
	die();
}

global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;

//No way of autodetecting this short of a database entry
$module_name = 'Project_Tracking';

if (file_exists('modules/' . $module_name . '/includes/nsnpj_func.php')) {
	include_once('modules/' . $module_name . '/includes/nsnpj_func.php');

	$content = '<table style="margin-left:auto; margin-right:auto; border:1px; border-style:solid; width:100%;" cellpadding="2" cellspacing="0">' . "\n"
		. '<tr>' . "\n"
		. '<td style="width:100%; background-color:' . $bgcolor2 . '; text-align:center;" colspan="2" class="thick">' . _PJ_PROJECTNAME . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_SITE . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_TASKS . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_REPORTS . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_REQUESTS . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_STATUS . '</td>' . "\n"
		. '<td style="margin-left:auto; margin-right:auto; background-color:' . $bgcolor2 . '; white-space:nowrap;" class="thick">' . _PJ_PROGRESSBAR . '</td>' . "\n"
		. '</tr>' . "\n";

	$projectresult = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects WHERE featured ="1" ORDER BY weight');
	while(list($project_id) = $db->sql_fetchrow($projectresult)) {
		$project = pjprojectpercent_info($project_id);
		$projectstatus = pjprojectstatus_info($project['status_id']);
		$pjimage = pjimage('project.png', $module_name);
		$content .= '<tr>' . "\n"
			. '<td style="margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">'
			. '<img src="' . $pjimage . '" alt="' . $project['project_name'] . '" title="" /></td>' . "\n"
			. '<td style="width:100%; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">'
			. '<a href="modules.php?name=' . $module_name . '&amp;op=PJProject&amp;project_id=' . $project_id . '">' . $project['project_name'] . '</a></td>' . "\n";

		if($project['project_site'] > '') {
			$pjimage = pjimage('demo.png', $module_name);
			$demo = ' <a href="' . $project['project_site'] . '" target="_blank" title="' . $project['project_name'] . '">'
			. '<img src="' . $pjimage . '" alt="' . $project['project_name'] . '"  /></a>';
		} else {
			$demo = '&nbsp;';
		}

		$content .= '<td style="margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">' . $demo . '</td>' . "\n";
		$numtasks = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks WHERE project_id=' . $project_id));

		if(!$numtasks) {
			$numtasks = 0;
		}

		$content .= '<td style="text-align:center; margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">' . $numtasks . '</td>' . "\n";

		if($project['allowreports'] > 0) {
			$numreports = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports WHERE project_id=' . $project_id));

			if(!$numreports) {
				$numreports = 0;
			}

			$content .= '<td style="text-align:center; margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">' . $numreports . '</td>' . "\n";
		} else {
			$content .= '<td style="margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">----</td>' . "\n";
		}

		if($project['allowrequests'] > 0) {
			$numrequests = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id));

			if(!$numrequests) {
				$numrequests = 0;
			}

			$content .= '<td style="text-align:center; margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">' . $numrequests . '</td>' . "\n";
		} else {
			$content .= '<td style="margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">----</td>' . "\n";
		}

		if($projectstatus['status_name'] == "") {
			$projectstatus['status_name'] = _PJ_NA;
		}

		$content .= '<td style="margin-left:auto; margin-right:auto; border:0.2px; border-style:solid; border-color:' . $textcolor1 . ';">' . $projectstatus['status_name'] . '</td>' . "\n";
		$pjimage = pjimage('bar_left.png', $module_name);
		$content .= '<td style="border:0.2px; border-style:solid; border-color:' . $textcolor1 . '; white-space:nowrap;"><img src="' . $pjimage . '" height="7" width="1" alt="" title="" />';

		if($project['project_percent'] == 0){
			$pjimage = pjimage('bar_center_red.png', $module_name);
			$content .= '<img src="' . $pjimage . '" height="7" width="100" alt="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
		} else {

			if($project['project_percent'] > 100) {
				$project_percent = 100;
			} else {
				$project_percent = $project['project_percent'];
			}

			$pjimage = pjimage('bar_center_grn.png', $module_name);
			$content .= '<img src="' . $pjimage . '" height="7" width="' . $project_percent . '" alt="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';

			if($project_percent < 100){
				$percent_incomplete = 100 - $project_percent;
				$pjimage = pjimage('bar_center_red.png', $module_name);
				$content .= '<img src="' . $pjimage . '" height="7" width="' . $percent_incomplete . '" alt="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
			}
		}

		$pjimage = pjimage('bar_right.png', $module_name);
		$content .= '<img src="' . $pjimage . '" height="7" width="1" alt="" title="" /></td>' . "\n";
		$content .= '</tr>' . "\n";
	}

	$content .=  '</table>'."\n";
} else {
	$content = 'The module ' . $module_name . 'could not be found.';
}

?>