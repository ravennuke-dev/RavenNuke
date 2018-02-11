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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_PROJECTADD;

include('header.php');

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_PROJECTADD);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_PROJECTNAME . ':</td>'."\n";
echo '<td><input type="text" name="project_name" size="30" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_PROJECTSITE . ':</td>'."\n";
echo '<td><input type="text" name="project_site" size="30" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _PJ_PROJECTDESCRIPTION . ':</td>'."\n";
echo '<td><textarea name="project_description" cols="60" rows="10"></textarea></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_FEATUREDBLOCK . ':</td>'."\n";
echo '<td><select name="featured"><option value="0" selected="selected">' . _PJ_NO . '</option>'."\n";
echo '<option value="1">' . _PJ_YES . '</option></select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_ACTIVATEREPORTS . ':</td>'."\n";
echo '<td><select name="allowreports"><option value="0" selected="selected">' . _PJ_NO . '</option>'."\n";
echo '<option value="1">' . _PJ_YES . '</option></select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_ACTIVATEREQUESTS . ':</td>'."\n";
echo '<td><select name="allowrequests"><option value="0">' . _PJ_NO . '</option>'."\n";
echo '<option value="1">' . _PJ_YES . '</option></select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_PRIORITY . ':</td>'."\n";
echo '<td><select name="priority_id">'."\n";

$prioritylist = $db->sql_query('SELECT priority_id, priority_name FROM ' . $prefix . '_nsnpj_projects_priorities ORDER BY priority_weight');
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)) {
	echo '<option value="' . $s_priority_id . '">' . $s_priority_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_STATUSPERCENT . ':</td>'."\n";
echo '<td><input type="text" name="project_percent" size="4" />% ' . _PJ_STATUSPERCENT_CALCULATE . '</td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_STATUS . ':</td>'."\n";
echo '<td><select name="status_id">'."\n";

$statuslist = $db->sql_query('SELECT status_id, status_name FROM ' . $prefix . '_nsnpj_projects_status ORDER BY status_weight');
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)) {
	echo '<option value="' . $s_status_id . '">' . $s_status_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_STARTDATE . ':</td>'."\n";
echo '<td><select name="project_start_month">'."\n";
echo '<option value="00">--</option>'."\n";

for($i = 1; $i <= 12; $i++) {
	if($i == date("m")) {
		$sel = 'selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $i . '" ' . $sel . '>' . $i . '</option>'."\n";
}

echo '</select><select name="project_start_day">'."\n";
echo '<option value="00">--</option>'."\n";

for($i = 1; $i <= 31; $i++) {
	if($i == date('d')) {
		$sel = 'selected="selected"';
	} else {
		$sel = '';
	}

	echo '<option value="' . $i . '" ' . $sel . '>' . $i . '</option>'."\n";
}

echo '</select><input type="text" name="project_start_year" value="' . date('Y') . '" size="4" maxlength="4" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _PJ_FINISHDATE . ':</td>'."\n";
echo '<td><select name="project_finish_month">'."\n";
echo '<option value="00">--</option>'."\n";

for($i = 1; $i <= 12; $i++) {
	echo '<option value="' . $i . '">' . $i . '</option>'."\n";
}

echo '</select><select name="project_finish_day">'."\n";
echo '<option value="00">--</option>'."\n";

for($i = 1; $i <= 31; $i++) {
	echo '<option value="' . $i . '">' . $i . '</option>'."\n";
}

echo '</select><input type="text" name="project_finish_year" value="0000" size="4" maxlength="4" /></td></tr>'."\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _PJ_ASSIGNMEMBERS . ':</td>'."\n";
echo '<td><select name="member_ids[]" size="10" multiple="multiple">'."\n";
echo '<option value="-1"></option>'."\n";

$memberlistresult = $db->sql_query('SELECT member_id, member_name FROM ' . $prefix . '_nsnpj_members ORDER BY member_name');
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
	echo '<option value="' . $member_id . '">' . $member_name . '</option>'."\n";
}

echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _PJ_PROJECTADD . '" />'."\n";
echo '<input type="hidden" name="op" value="PJProjectInsert" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";

CloseTable();

pj_copy();

include('footer.php');

?>