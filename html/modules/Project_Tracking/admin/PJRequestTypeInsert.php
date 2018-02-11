<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$type_name = htmlentities($type_name, ENT_QUOTES);
$result = $db->sql_query("SELECT `type_weight` FROM `".$prefix."_nsnpj_requests_types` ORDER BY `type_weight` DESC");
list($lweight) = $db->sql_fetchrow($result);
$weight = $lweight + 1;
if($weight < 1) { $weight = 1; }
$db->sql_query("INSERT INTO `".$prefix."_nsnpj_requests_types` VALUES (NULL, '$type_name', '$weight')");
header("Location: ".$admin_file.".php?op=PJRequestTypeList");

?>