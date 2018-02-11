<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=PJTaskStatusList"); }
$status_name = htmlentities($status_name, ENT_QUOTES);
$db->sql_query("UPDATE `".$prefix."_nsnpj_tasks_status` SET `status_name`='$status_name' WHERE `status_id`='$status_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_tasks_status`");
header("Location: ".$admin_file.".php?op=PJTaskStatusList");

?>