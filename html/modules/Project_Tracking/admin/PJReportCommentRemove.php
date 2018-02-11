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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_DELETECOMMENT;

include('header.php');

$reportcomment = pjreportcomment_info($comment_id);

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_DELETECOMMENT);
echo '<br />'."\n";

OpenTable();
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<input type="hidden" name="op" value="PJReportCommentDelete" />'."\n";
echo '<input type="hidden" name="comment_id" value="' . $comment_id . '" />'."\n";
echo '<input type="hidden" name="report_id" value="' . $reportcomment['report_id'] . '" />'."\n";
echo '<tr><td align="center" colspan="2"><span class="thick">' . _PJ_CONFIRMCOMMENTDELETE . '</span></td></tr>'."\n";
echo '<tr><td align="center" valign="top"><span class="thick">' . _PJ_COMMENT . ' #' . $comment_id . '</span></td><td>' . $reportcomment['comment_description'] . '</td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _PJ_DELETECOMMENT . '" /></td></tr>'."\n";
echo '</form>'."\n";
echo '</table>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>