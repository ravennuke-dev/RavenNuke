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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_CONFIG;

include('header.php');

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_CONFIG);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWPROJECTSTATUS . ':</span></td>'."\n";
echo '<td><select name="new_project_status">'."\n";

$status = $db->sql_query('SELECT status_id, status_name FROM ' . $prefix . '_nsnpj_projects_status ORDER BY status_weight');
while(list($status_id, $status_name) = $db->sql_fetchrow($status)) {
	if($pj_config['new_project_status'] == $status_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $status_id . '" ' . $sel . '>' . $status_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWPROJECTPRIORITY . ':</span></td>'."\n";
echo '<td><select name="new_project_priority">'."\n";

$priority = $db->sql_query('SELECT priority_id, priority_name FROM ' . $prefix . '_nsnpj_projects_priorities ORDER BY priority_weight');
while(list($priority_id, $priority_name) = $db->sql_fetchrow($priority)) {
	if($pj_config['new_project_priority'] == $priority_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $priority_id . '"' . $sel . '>' . $priority_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _PJ_DATEFORMAT . ':</span></td>'."\n";
echo '<td><input type="text" name="project_date_format" value="' . $pj_config['project_date_format'] . '" size="30" /><br />(' . _PJ_DATENOTE . ')</td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWPROJECTPOSITION . ':</span></td>'."\n";
echo '<td><select name="new_project_position">'."\n";

$position = $db->sql_query('SELECT position_id, position_name FROM ' . $prefix . '_nsnpj_members_positions ORDER BY position_weight');
while(list($position_id, $position_name) = $db->sql_fetchrow($position)) {
	if($pj_config['new_project_position'] == $position_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $position_id . '" ' . $sel . '>' . $position_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _PJ_CONFIGUPDATE . '" />'."\n";
echo '<input type="hidden" name="op" value="PJProjectConfigUpdate" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";

CloseTable();

pj_copy();

include('footer.php');

?>