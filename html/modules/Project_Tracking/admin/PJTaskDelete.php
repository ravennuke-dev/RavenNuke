<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$task_id = intval($task_id);
$task = pjtask_info($task_id);
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_tasks` WHERE `task_id`='$task_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks`");
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_tasks_members` WHERE `task_id`='$task_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks_members`");
header("Location: modules.php?name=".$module_name."&op=PJProject&project_id=".$task['project_id']);

?>