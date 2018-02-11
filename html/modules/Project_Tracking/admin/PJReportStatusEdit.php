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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_STATUSEDIT;

$status_id = intval($status_id);

if($status_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJRequestStatusList');
}

include('header.php');

$status = pjreportstatus_info($status_id);

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_STATUSEDIT);
echo '<br />';

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_STATUS . ':</td>'."\n";
echo '<td><input type="text" name="status_name" size="30" value="' . $status['status_name'] . '" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center">'."\n";
echo '<input type="hidden" name="op" value="PJReportStatusUpdate" />'."\n";
echo '<input type="hidden" name="status_id" value="' . $status_id . '" />'."\n";
echo '<input type="submit" value="' . _PJ_STATUSUPDATE . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>