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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_DELETESTATUS;

$status_id = intval($status_id);

if($status_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJProjectStatusList');
}

include('header.php');

$status = pjprojectstatus_info($status_id);

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_DELETESTATUS);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><span class="thick">' . _PJ_SWAPPROJECTSTATUS . '</span></td></tr>'."\n";
echo '<tr><td align="center">' . $status['status_name'] . ' -> <select name="swap_status_id">'."\n";
echo '<option value="-1">' . _PJ_NA . '</option>'."\n";

$statuslist = $db->sql_query('SELECT status_id, status_name FROM ' . $prefix . '_nsnpj_projects_status WHERE status_id != "' . $status_id . '" AND status_id > 0 ORDER BY status_weight');
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)) {
	echo '<option value="' . $s_status_id . '">' . $s_status_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td align="center">'."\n";
echo '<input type="hidden" name="op" value="PJProjectStatusDelete" />'."\n";
echo '<input type="hidden" name="status_id" value="' . $status_id . '" />'."\n";
echo '<input type="submit" value="' . _PJ_DELETESTATUS . '" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>