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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_STATUSADD;

include('header.php');

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_STATUSADD);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_STATUSNAME . ':</td>'."\n";
echo '<td><input type="text" name="status_name" size="30" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center">'."\n";
echo '<input type="hidden" name="op" value="PJProjectStatusInsert" />'."\n";
echo '<input type="submit" value="' . _PJ_STATUSADD . '" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>