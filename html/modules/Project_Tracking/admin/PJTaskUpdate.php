<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$task_name = htmlentities($task_name, ENT_QUOTES);
$task_description = htmlentities($task_description, ENT_QUOTES);
$priority_id = intval($priority_id);
$status_id = intval($status_id);
$task_percent = intval($task_percent);
$project_id = intval($project_id);
$task_id = intval($task_id);
$start_date = "$task_start_year-$task_start_month-$task_start_day";
if($start_date == "0000-00-00") { $start_date = 0; } else { $start_date = strtotime($start_date); }
$finish_date = "$task_finish_year-$task_finish_month-$task_finish_day";
if($finish_date == "0000-00-00") { $finish_date = 0; } else { $finish_date = strtotime($finish_date); }
$db->sql_query("UPDATE `".$prefix."_nsnpj_tasks` SET `project_id`='$project_id', `task_name`='$task_name', `task_description`='$task_description', `priority_id`='$priority_id', `status_id`='$status_id', `task_percent`='$task_percent', `date_started`='$start_date', `date_finished`='$finish_date' WHERE `task_id`='$task_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks`");
if (!isset($member_ids)) $member_ids = array();
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnpj_tasks_members` WHERE `task_id`='$task_id' AND `member_id`='$member_id'"));
    if($numrows == 0) {
      $db->sql_query("INSERT INTO `".$prefix."_nsnpj_tasks_members` VALUES ('$task_id', '$member_id', '0')");        
    }
  }
}
header("Location: ".$admin_file.".php?op=PJTaskEdit&task_id=$task_id");

?>