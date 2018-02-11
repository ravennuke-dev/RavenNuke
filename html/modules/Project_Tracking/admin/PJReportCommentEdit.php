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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_COMMENTEDIT;

include('header.php');

$reportcomment = pjreportcomment_info($comment_id);

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_COMMENTEDIT);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<input type="hidden" name="op" value="PJReportCommentUpdate" />'."\n";
echo '<input type="hidden" name="comment_id" value="' . $comment_id . '" />'."\n";
echo '<input type="hidden" name="report_id" value="' . $reportcomment['report_id'] . '" />'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_USERNAME . ':</td>'."\n";
echo '<td><input type="text" name="commenter_name" size="30" value="' . $reportcomment['commenter_name'] . '" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_EMAILADDRESS . ':</td>'."\n";
echo '<td><input type="text" name="commenter_email" size="30" value="' . $reportcomment['commenter_email'] . '" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _PJ_COMMENT . ':</td>'."\n";
echo '<td><textarea name="comment_description" cols="60" rows="10">' . $reportcomment['comment_description'] . '</textarea></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _PJ_COMMENTUPDATE . '" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>