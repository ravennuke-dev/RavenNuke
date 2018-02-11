<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_TASKS.": "._PJ_EDITTASK;
include("header.php");
$task = pjtask_info($task_id);
pjadmin_menu(_PJ_TASKS.": "._PJ_EDITTASK);
echo "<br />\n";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_PROJECT.":</td>\n";
echo "<td><select name='project_id'>\n";
$projectlist = $db->sql_query("SELECT `project_id`, `project_name` FROM `".$prefix."_nsnpj_projects` ORDER BY `project_name`");
while(list($s_project_id, $s_project_name) = $db->sql_fetchrow($projectlist)){
  if($s_project_id == $task['project_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$s_project_id' $sel>$s_project_name</option>\n";
}
echo "</select></td></tr>\n";        
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_TASKNAME.":</td>\n";
echo "<td><input type='text' name='task_name' size='30' value=\"".$task['task_name']."\" /></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._PJ_TASKDESCRIPTION.":</td>\n";
echo "<td><textarea name='task_description' cols='60' rows='10'>".$task['task_description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'>\n";
$prioritylist = $db->sql_query("SELECT `priority_id`, `priority_name` FROM `".$prefix."_nsnpj_tasks_priorities` ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
  if($s_priority_id == $task['priority_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$s_priority_id' $sel>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='task_percent' size='4' value='".$task['task_percent']."' />%</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
$statuslist = $db->sql_query("SELECT `status_id`, `status_name` FROM `".$prefix."_nsnpj_tasks_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
  if($s_status_id == $task['status_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
if($task['date_started'] > 0) {
  $sday = date("j",$task['date_started']);
  $smon = date("n",$task['date_started']);
  $syear = date("Y",$task['date_started']);
} else {
  $sday = "00";
  $smon = "00";
  $syear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_STARTDATE.":</td>\n";
echo "<td><select name='task_start_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  if($i == $smon){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='task_start_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  if($i == $sday){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type='text' name='task_start_year' value='$syear' size='4' maxlength='4' /></td></tr>\n";
if($task['date_finished'] > 0) {
  $fday = date("j",$task['date_finished']);
  $fmon = date("n",$task['date_finished']);
  $fyear = date("Y",$task['date_finished']);
} else {
  $fday = "00";
  $fmon = "00";
  $fyear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_FINISHDATE.":</td>\n";
echo "<td><select name='task_finish_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  if($i == $fmon){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='task_finish_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  if($i == $fday){ $sel = "selected='selected'"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type='text' name='task_finish_year' value='$fyear' size='4' maxlength='4' /></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._PJ_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple='multiple'>\n";
echo "<option value='-1'></option>\n";
$memberlistresult = $db->sql_query("SELECT `member_id`, `member_name` FROM `".$prefix."_nsnpj_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
  $memberexresult = $db->sql_query("SELECT `member_id` FROM `".$prefix."_nsnpj_tasks_members` WHERE `member_id`='$member_id' AND `task_id`='$task_id'");
  $numrows = $db->sql_numrows($memberexresult);
  if($numrows < 1){
    echo "<option value='$member_id'>$member_name</option>\n";
  }
}
echo "</select></td></tr>\n";
echo "<tr><td align='center' colspan='2'>\n";
echo "<input type='hidden' name='op' value='PJTaskUpdate' />\n";
echo "<input type='hidden' name='task_id' value='$task_id' />\n";
echo "<input type='submit' value='"._PJ_UPDATETASK."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td align='left' bgcolor='$bgcolor2' width='100%' colspan='2'><span class='thick'>"._PJ_TASKMEMBERS."</span></td>";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_POSITION."</span></td>";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_DELETE."</span></td></tr>";
$membersresult = $db->sql_query("SELECT `member_id`, `position_id` FROM `".$prefix."_nsnpj_tasks_members` WHERE `task_id`='$task_id'");
$numrows = $db->sql_numrows($membersresult);
if($numrows > 0){
  while(list($member_id, $position_id) = $db->sql_fetchrow($membersresult)){
    $member = pjmember_info($member_id);
    $position = pjmemberposition_info($position_id);
    echo "<tr>";
    $pjimage = pjimage("member.png", $module_name);
    echo "<td><img src='$pjimage' alt='' title='' /></td><td width='100%'>".$member['member_name']."</td>";
    echo "<td><input type='hidden' name='member_ids[]' value='$member_id' /><select name='position_ids[]'>";
    $positionlistresult = $db->sql_query("SELECT `position_id`, `position_name` FROM `".$prefix."_nsnpj_members_positions` ORDER BY `position_weight`");
    while(list($l_position_id, $l_position_name) = $db->sql_fetchrow($positionlistresult)) {
      if($l_position_id == $position_id){ $sel = "selected='selected'"; } else { $sel = ""; }
      echo "<option value='$l_position_id' $sel>$l_position_name</option>\n";
    }
    echo "</select></td>";
    echo "<td align='center' nowrap='nowrap'><input name='delete_member_ids[]' type='checkbox' value='$member_id' /></td>";
    echo "</tr>";
  }
  echo "<tr><td colspan='4' width='100%' align='right' bgcolor='$bgcolor2'>\n";
  echo "<input type='hidden' name='op' value='PJTaskMembers' />\n";
  echo "<input type='hidden' name='task_id' value='$task_id' />\n";
  echo "<input type='submit' value='"._PJ_UPDATE."' />\n";
  echo "<input type='submit' value='"._PJ_DELETE."' />\n";
  echo "</td></tr>\n";
} else {
  echo "<tr><td colspan='4' width='100%' align='center'>"._PJ_NOTASKMEMBERS."</td></tr>\n";
}
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>