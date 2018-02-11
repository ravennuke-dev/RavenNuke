<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$priority_name = htmlentities($priority_name, ENT_QUOTES);
$result = $db->sql_query("SELECT `priority_weight` FROM `".$prefix."_nsnpj_tasks_priorities` ORDER BY `priority_weight` DESC");
list($lweight) = $db->sql_fetchrow($result);
$weight = $lweight + 1;
if($weight < 1) { $weight = 1; }
$db->sql_query("INSERT INTO `".$prefix."_nsnpj_tasks_priorities` VALUES (NULL, '$priority_name', '$weight')");
header("Location: ".$admin_file.".php?op=PJTaskPriorityList");

?>