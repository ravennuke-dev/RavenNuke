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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REPORTS . ': ' . _PJ_CONFIG;

include('header.php');

pjadmin_menu(_PJ_REPORTS . ': ' . _PJ_CONFIG);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_ADMINEMAIL . ':</span></td>'."\n";
echo '<td><input type="text" name="admin_report_email" value="' . $pj_config['admin_report_email'] . '" size="30" /></td></tr>'."\n";

if($pj_config['notify_report_admin'] == 1) {
	$notify_a = ' selected="selected"'; $notify_b = '';
} else {
	$notify_a = ''; $notify_b = ' selected="selected"';
}

echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NOTIFYADMIN . ':</span></td>'."\n";
echo '<td><select name="notify_report_admin"><option value="1"' . $notify_a . '>' . _PJ_YES . '</option>'."\n";
echo '<option value="0"' . $notify_b . '>' . _PJ_NO . '</option></select></td></tr>'."\n";

if($pj_config['notify_report_submitter'] == 1) {
	$notify_a = ' selected="selected"'; $notify_b = '';
} else {
$notify_a = ''; $notify_b = ' selected="selected"';
}

echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NOTIFYSUBMITTER . ':</span></td>'."\n";
echo '<td><select name="notify_report_submitter"><option value="1"' . $notify_a . '>' . _PJ_YES . '</option>'."\n";
echo '<option value="0"' . $notify_b . '>' . _PJ_NO . '</option></select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWREPORTSTATUS . ':</span></td>'."\n";
echo '<td><select name="new_report_status">'."\n";

$status = $db->sql_query('SELECT status_id, status_name FROM ' . $prefix . '_nsnpj_reports_status ORDER BY status_weight');
while(list($status_id, $status_name) = $db->sql_fetchrow($status)) {
	if($pj_config['new_report_status'] == $status_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $status_id . '"' . $sel . '>' . $status_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWREPORTTYPE . ':</span></td>'."\n";
echo '<td><select name="new_report_type">'."\n";

$type = $db->sql_query('SELECT type_id, type_name FROM ' . $prefix . '_nsnpj_reports_types ORDER BY type_weight');
while(list($type_id, $type_name) = $db->sql_fetchrow($type)) {
	if($pj_config['new_report_type'] == $type_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $type_id . '"' . $sel . '>' . $type_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _PJ_DATEFORMAT . ':</span></td>'."\n";
echo '<td><input type="text" name="report_date_format" value="' . $pj_config['report_date_format'] . '" size="30" /><br />(' . _PJ_DATENOTE . ')</td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _PJ_NEWREPORTPOSITION . ':</span></td>'."\n";
echo '<td><select name="new_report_position">'."\n";

$position = $db->sql_query('SELECT position_id, position_name FROM ' . $prefix . '_nsnpj_members_positions ORDER BY position_name');
while(list($position_id, $position_name) = $db->sql_fetchrow($position)) {
	if($pj_config['new_report_position'] == $position_id) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $position_id . '"' . $sel . '>' . $position_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center">'."\n";
echo '<input type="hidden" name="op" value="PJReportConfigUpdate" />'."\n";
echo '<input type="submit" value="' . _PJ_CONFIGUPDATE . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>