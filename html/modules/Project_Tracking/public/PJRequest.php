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

$request_id = intval($request_id);
$request = pjrequest_info($request_id);
$project = pjproject_info($request['project_id']);

if($project['allowrequests'] > 0) {
	$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REQUESTVIEW;

	include('header.php');

	title(_PJ_TITLE . ': ' , _PJ_REQUESTVIEW);

	$project = pjproject_info($request['project_id']);
	$requeststatus = pjrequeststatus_info($request['status_id']);
	$requesttype = pjrequesttype_info($request['type_id']);

	if($requeststatus['status_name'] == '') {
		$requeststatus['status_name'] = _PJ_NA;
	}

	if($requesttype['type_name'] == '') {
		$requesttype['type_name'] = _PJ_NA;
	}

	OpenTable();

	echo '<table width="100%" border="1" cellspacing="0" cellpadding="2">',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="4" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_PROJECTNAME , '</span></td></tr>',"\n";

	$pjimage = pjimage('project.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap"><a href="modules.php?name=' , $module_name , '&amp;op=PJProject&amp;project_id=' , $project['project_id'] , '">' , $project['project_name'] , '</a></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="2" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REQUESTINFO , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_STATUS , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_TYPE , '</span></td></tr>',"\n";

	$pjimage = pjimage('request.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td><td width="100%" nowrap="nowrap">' , $request['request_name'] , '</td>',"\n";
	echo '<td align="center" nowrap="nowrap">' , $requeststatus['status_name'] , '</td>',"\n";
	echo '<td align="center" nowrap="nowrap">' , $requesttype['type_name'] , '</td></tr>',"\n";

	if($request['request_description'] != '') {
		$pjimage = pjimage('description.png', $module_name);

		echo '<tr><td align="center" valign="top"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
		echo '<td colspan="3" width="100%">' , nl2br($request['request_description']) , '</td></tr>',"\n";
	}

	$pjimage = pjimage('requester.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_REQUESTEDBY , ': <span class="thick"><a href="mailto:' , pjencode_email($request['submitter_email']) , '">' , $request['submitter_name'] , '</a></span></td></tr>',"\n";

	if($request['date_submitted'] != '0') {
		$submit_date = date($pj_config['request_date_format'], $request['date_submitted']);
	} else {
		$submit_date = _PJ_NA;
	}

	$pjimage = pjimage('date.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_SUBMITTED , ': <span class="thick">' , $submit_date , '</span></td></tr>',"\n";

	if($request['date_modified'] != '0') {
		$modify_date = date($pj_config['request_date_format'], $request['date_modified']);
	} else {
		$modify_date =  _PJ_NA;
	}

	$pjimage = pjimage('date.png', $module_name);

	echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
	echo '<td colspan="3" width="100%" nowrap="nowrap">' , _PJ_MODIFIED , ': <span class="thick">' , $modify_date , '</span></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="3" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_REQUESTMEMBERS , '</span></td>',"\n";
	echo '<td bgcolor="' , $bgcolor2 , '" align="center"><span class="thick">' , _PJ_POSITION , '</span></td></tr>',"\n";

	$memberresult = $db->sql_query('SELECT member_id, position_id FROM ' . $prefix . '_nsnpj_requests_members WHERE request_id=' . $request_id . ' ORDER BY member_id');
	$member_total = $db->sql_numrows($memberresult);

	if($member_total != 0) {
		while(list($member_id, $position_id) = $db->sql_fetchrow($memberresult)) {
			$pjimage = pjimage('member.png', $module_name);
			$member = pjmember_info($member_id);
			$position = pjmemberposition_info($position_id);

			echo '<tr><td><img src="' , $pjimage , '" alt="" title="" /></td><td colspan="2" width="100%"><a href="mailto:' , pjencode_email($member['member_email']) , '">' , $member['member_name'] , '</a></td>',"\n";

			if($position['position_name'] == '') {
				$position['position_name'] = '----------';
			}

			echo '<td align="center" nowrap="nowrap">' , $position['position_name'] , '</td></tr>',"\n";
		}
	} else {
		echo '<tr><td align="center" colspan="4" width="100%" nowrap="nowrap">' , _PJ_NOREQUESTMEMBERS , '</td></tr>',"\n";
	}

	if(is_admin($admin)) {
		echo '<tr><td bgcolor="' , $bgcolor2 , '" colspan="4" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_ADMINFUNCTIONS , '</span></td></tr>',"\n";

		$pjimage = pjimage('options.png', $module_name);

		echo '<tr><td align="center"><img src="' , $pjimage , '" alt="" title="" /></td>',"\n";
		echo '<td colspan="3" width="100%" nowrap="nowrap"><a href="' , $admin_file , '.php?op=PJRequestEdit&amp;request_id=' , $request_id , '">' , _PJ_REQUESTEDIT , '</a>';
		echo ', <a href="' , $admin_file , '.php?op=PJRequestRemove&amp;request_id=' , $request_id , '">' , _PJ_DELETEREQUEST . '</a>';
		echo ', <a href="' , $admin_file , '.php?op=PJRequestImport&amp;request_id=' , $request_id , '">' , _PJ_IMPORTTOTASK . '</a>';
		echo ', <a href="' , $admin_file , '.php?op=PJRequestPrint&amp;request_id=' , $request_id , '">' , _PJ_REQUESTPRINT . '</a></td></tr>',"\n";
	}

	echo '</table>',"\n";

	CloseTable();

	echo '<br />',"\n";

	$commentresult = $db->sql_query('SELECT comment_id FROM ' . $prefix . '_nsnpj_requests_comments WHERE request_id=' . $request_id . ' ORDER BY date_commented asc');
	$comment_total = $db->sql_numrows($commentresult);

	OpenTable();

	echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" width="100%" nowrap="nowrap"><span class="thick">' , _PJ_COMMENTS , '</span> <span class="thick">(</span> <a href="modules.php?name=' , $module_name , '&amp;op=PJRequestCommentSubmit&amp;request_id=' , $request_id , '">' , _PJ_COMMENTADD , '</a> <span class="thick">)</span></td></tr>',"\n";

	if($comment_total > 0) {
		while(list($comment_id) = $db->sql_fetchrow($commentresult)) {
			$comment = pjrequestcomment_info($comment_id);
			$comment_date = date($pj_config['request_date_format'], $comment['date_commented']);

			echo '<tr><td bgcolor="' , $bgcolor2 , '" nowrap="nowrap"><span class="thick"><a href="mailto:' , pjencode_email($comment['commenter_email']) , '">' , $comment['commenter_name'] , '</a> @ ' , $comment_date , '</span>';

			if(is_admin($admin)) {
				echo ' - (<a href="' , $admin_file , '.php?op=PJRequestCommentEdit&amp;comment_id=' , $comment['comment_id'] , '">' , _PJ_EDIT , '</a>, <a href="' , $admin_file , '.php?op=PJRequestCommentRemove&amp;comment_id=' , $comment['comment_id'] , '">' , _PJ_DELETE , '</a>)';
			}

			echo '</td></tr>',"\n";
			echo '<tr><td>' , nl2br($comment['comment_description']) , '</td></tr>',"\n";
		}
	} else {
		echo '<tr><td align="center" nowrap="nowrap">' , _PJ_NOREQUESTCOMMENTS , '</td></tr>',"\n";
	}

	echo '</table>',"\n";

	CloseTable();

	include('footer.php');
} else {
	header('Location: modules.php?name=' . $module_name);
}

?>