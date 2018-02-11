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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_TYPEEDIT;

$type_id = intval($type_id);

if($type_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJRequestTypeList');
}

include('header.php');

$type = pjreporttype_info($type_id);

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_TYPEEDIT);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_TYPE . ':</td>'."\n";
echo '<td><input type="text" name="type_name" value="' . $type['type_name'] . '" size="30" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center">'."\n";
echo '<input type="hidden" name="op" value="PJReportTypeUpdate" />'."\n";
echo '<input type="hidden" name="type_id" value="' . $type_id . '" />'."\n";
echo '<input type="submit" value="' . _PJ_TYPEUPDATE . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>