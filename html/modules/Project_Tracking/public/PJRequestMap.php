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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REQUESTMAP;

include('header.php');

title(_PJ_TITLE . ': ' , _PJ_REQUESTMAP);

$projectresult = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects ORDER BY weight');
while(list($project_id) = $db->sql_fetchrow($projectresult)) {
	$project = pjproject_info($project_id);
	$projectstatus = pjprojectstatus_info($project['status_id']);
	$projectpriority = pjprojectpriority_info($project['priority_id']);

	if($project['allowrequests'] > 0) {
		$requestresult = $db->sql_query('SELECT request_id, request_name, status_id, type_id FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id . ' ORDER BY request_name');
		$request_total = $db->sql_numrows($requestresult);

		OpenTable();

		echo '<table align="center" border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
		echo '<tr>',"\n";
		echo '<td bgcolor="' , $bgcolor2 , '" colspan="2" width="100%"><span class="thick">' , _PJ_PROJECT , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_SITE , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_PRIORITY , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_REQUESTS , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick">' , _PJ_LASTSUBMISSION , '</span></td>',"\n";
		echo '</tr>',"\n";

		$pjimage = pjimage('project.png', $module_name);
		$project_title = $project['project_name'];

		if($project['featured'] > 0) {
			$project_title = '<span class="thick">' . $project_title . '</span>';
		}

		echo '<tr>',"\n";
		echo '<td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
		echo '<td width="100%"><a href="modules.php?name=' , $module_name , '&amp;op=PJProject&amp;project_id=' , $project_id , '">' , $project_title , '</a></td>',"\n";

		if($project['project_site'] > "") {
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
		echo '<td align="center" nowrap="nowrap">' , $request_total , '</td>',"\n";

		if($request_total > 0) {
			list($last_date) = $db->sql_fetchrow($db->sql_query('SELECT date_submitted FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id . ' ORDER BY date_submitted desc'));
			$last_date = date($pj_config['request_date_format'], $last_date);    
		} else {
			$last_date = _PJ_NA;
		}

		echo '<td align="center" nowrap="nowrap">' , $last_date , '</td>',"\n";
		echo '</tr>',"\n";
		echo '<tr>',"\n";
		echo '<td bgcolor="' , $bgcolor2 , '" colspan="3"><span class="thick">' , _PJ_REQUESTS , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '"><span class="thick">' , _PJ_TYPE , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '"><span class="thick">' , _PJ_COMMENTS , '</span></td>',"\n";
		echo '<td align="center" bgcolor="' , $bgcolor2 , '"><span class="thick">' , _PJ_LASTSUBMISSION , '</span></td>',"\n";
		echo '</tr>',"\n";

		if($request_total != 0) {
			while(list($request_id, $request_name, $status_id, $type_id) = $db->sql_fetchrow($requestresult)) {
				$requestcommentresult = $db->sql_query('SELECT request_id FROM ' . $prefix . '_nsnpj_requests_comments WHERE request_id=' . $request_id);
				$requestcomment_total = $db->sql_numrows($requestcommentresult);
				$requeststatus = pjrequeststatus_info($status_id);
				$requesttype = pjrequesttype_info($type_id);

				if($request_name == '') {
					$request_name = "----------";
				}

				$pjimage = pjimage('request.png', $module_name);

				echo '<tr>',"\n";
				echo '<td><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
				echo '<td width="100%" colspan="2"><a href="modules.php?name=' , $module_name , '&amp;op=PJRequest&amp;request_id=' , $request_id , '">' , $request_name , '</a></td>',"\n";

				if($requeststatus['status_name'] == '') {
					$requeststatus['status_name'] = _PJ_NA;
				}

				echo '<td align="center" nowrap="nowrap">' , $requeststatus['status_name'] , '</td>',"\n";

				if($requesttype['type_name'] == '') {
					$requesttype['type_name'] = _PJ_NA;
				}

				echo '<td align="center" nowrap="nowrap">' , $requesttype['type_name'] , '</td>',"\n";
				echo '<td align="center" nowrap="nowrap">' , $requestcomment_total , '</td>',"\n";

				if($requestcomment_total > 0) {
					list($last_date) = $db->sql_fetchrow($db->sql_query('SELECT date_commented FROM ' . $prefix . '_nsnpj_requests_comments WHERE request_id=' . $request_id . ' ORDER BY date_commented desc'));
					$last_date = date($pj_config['request_date_format'], $last_date);    
				} else {
					$last_date = _PJ_NA;
				}

				echo '<td align="center" nowrap="nowrap">' , $last_date , '</td>',"\n";
				echo '</tr>',"\n";
			}
		} else {
			echo '<tr>',"\n";
			echo '<td align="center" colspan="7" width="100%" nowrap="nowrap">' , _PJ_NOPROJECTREQUESTS , '</td>',"\n";
			echo '</tr>',"\n";
		}

		echo '</table>',"\n";

		CloseTable();

		echo '<br />',"\n";
	}
}

include('footer.php');

?>