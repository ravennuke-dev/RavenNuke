<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$type_id = intval($type_id);
if($type_id < 1) { header("Location: ".$admin_file.".php?op=PJRequestTypeList"); }
$type_name = htmlentities($type_name, ENT_QUOTES);
$db->sql_query("UPDATE `".$prefix."_nsnpj_requests_types` SET `type_name`='$type_name'  WHERE `type_id`='$type_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_types`");
header("Location: ".$admin_file.".php?op=PJRequestTypeList");

?>