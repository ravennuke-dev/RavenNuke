<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$priority_id = intval($priority_id);
if($priority_id < 1) { header("Location: ".$admin_file.".php?op=PJTaskPriorityList"); }
$priority = pjtaskpriority_info($priority_id);
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_tasks_priorities` WHERE `priority_id`='$priority_id'");
$db->sql_query("UPDATE `".$prefix."_nsnpj_tasks` SET `priority_id`='$swap_priority_id' WHERE `priority_id`='$priority_id'");
$priorityresult = $db->sql_query("SELECT `priority_id`, `priority_weight` FROM `".$prefix."_nsnpj_tasks_priorities` WHERE `priority_weight`>='".$priority['priority_weight']."'");
while(list($p_id, $weight) = $db->sql_fetchrow($priorityresult)) {
  $new_weight = $weight - 1;
  $db->sql_query("UPDATE `".$prefix."_nsnpj_tasks_priorities` SET `priority_weight`='$new_weight' WHERE `priority_id`='$p_id'");
}
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks_priorities`");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks`");
header("Location: ".$admin_file.".php?op=PJTaskPriorityList");

?>