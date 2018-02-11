<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_TASKS.": "._PJ_DELETEPRIORITY;
$priority_id = intval($priority_id);
if($priority_id < 1) { header("Location: ".$admin_file.".php?op=PJTaskPriorityList"); }
include("header.php");
$priority = pjtaskpriority_info($priority_id);
pjadmin_menu(_PJ_TASKS.": "._PJ_DELETEPRIORITY);
echo "<br />\n";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td align='center'><span class='thick'>"._PJ_SWAPTASKPRIORITY."</span></td></tr>\n";
echo "<tr><td align='center'>".$priority['priority_name']." -> <select name='swap_priority_id'>\n";
echo "<option value='-1'>"._PJ_NA."</option>\n";
$prioritylist = $db->sql_query("SELECT `priority_id`, `priority_name` FROM `".$prefix."_nsnpj_tasks_priorities` WHERE `priority_id` != '$priority_id' AND `priority_id` > 0 ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
  echo "<option value='$s_priority_id'>".$s_priority_name."</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'>\n";
echo "<input type='hidden' name='op' value='PJTaskPriorityDelete' />\n";
echo "<input type='hidden' name='priority_id' value='$priority_id' />\n";
echo "<input type='submit' value='"._PJ_DELETEPRIORITY."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>