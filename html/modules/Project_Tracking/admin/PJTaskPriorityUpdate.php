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
$priority_name = htmlentities($priority_name, ENT_QUOTES);
$db->sql_query("UPDATE `".$prefix."_nsnpj_tasks_priorities` SET `priority_name`='$priority_name' WHERE `priority_id`='$priority_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks_priorities`");
header("Location: ".$admin_file.".php?op=PJTaskPriorityList");

?>