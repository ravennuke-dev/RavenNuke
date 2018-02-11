<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnpj_requests_types` WHERE `type_weight`>'0' ORDER BY `type_id` ASC");
$weight = 0;
while($row = $db->sql_fetchrow($result)) {
  $xid = intval($row['type_id']);
  $weight++;
  $db->sql_query("UPDATE `".$prefix."_nsnpj_requests_types` SET `type_weight`='$weight' WHERE `type_id`='$xid'");
}
header("Location: ".$admin_file.".php?op=PJRequestTypeList");

?>