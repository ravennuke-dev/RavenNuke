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

global $modGFXChk;

$report_id = intval($report_id);
$report = pjreport_info($report_id);
$project = pjproject_info($report['project_id']);

if($project['allowreports'] > 0) {
	$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_COMMENTADD;

	include('header.php');

	$userinfo = getusrinfo($user);

	title(_PJ_TITLE . ': ' . _PJ_COMMENTADD . ' - ' . $report['report_name']);

	OpenTable();

	echo '<form action="modules.php?name=' , $module_name , '" method="post">',"\n";
	echo '<table align="center" border="0" cellpadding="2" cellspacing="2">',"\n";
	echo '<tr><td align="center" colspan="2" class="title">' , _PJ_INPUTNOTE , '</td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '">' , _PJ_USERNAME , ':</td>',"\n";
	echo '<td><input type="text" name="commenter_name" size="30" value="' , $userinfo['username'] , '" /></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '">' , _PJ_EMAILADDRESS , ':</td>',"\n";
	echo '<td><input type="text" name="commenter_email" size="30" value="' , $userinfo['user_email'] , '" /></td></tr>',"\n";
	echo '<tr><td bgcolor="' , $bgcolor2 , '" valign="top">' , _PJ_COMMENT , ':</td>',"\n";
	echo '<td><textarea name="comment_description" cols="60" rows="10"></textarea></td></tr>',"\n";
	echo '<tr><td align="center" colspan="2">';
	echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
	echo '<input type="submit" value="' , _PJ_COMMENTADD , '" />';
	echo '<input type="hidden" name="op" value="PJReportCommentInsert" />',"\n";
	echo '<input type="hidden" name="report_id" value="' , $report_id , '" />',"\n";
	echo '</td></tr>',"\n";
	echo '</table>',"\n";
	echo '</form>',"\n";

	CloseTable();

	include('footer.php');
} else {
	header('Location: modules.php?name=' . $module_name);
}

?>