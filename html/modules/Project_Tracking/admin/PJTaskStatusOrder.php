<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pidrep = intval($pidrep);
$pid = intval($pid);
$result = $db->sql_query("UPDATE `".$prefix."_nsnpj_tasks_status` SET `status_weight`='$weight' WHERE `status_id`='$pidrep'");
$result2 = $db->sql_query("UPDATE `".$prefix."_nsnpj_tasks_status` SET `status_weight`='$weightrep' WHERE `status_id`='$pid'");
header("Location: ".$admin_file.".php?op=PJTaskStatusList");

?>