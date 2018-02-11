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
$type = pjrequesttype_info($type_id);
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests_types` WHERE `type_id`='$type_id'");
$db->sql_query("UPDATE `".$prefix."_nsnpj_requests` SET `type_id`='$swap_type_id' WHERE `type_id`='$type_id'");
$typeresult = $db->sql_query("SELECT `type_id`, `type_weight` FROM `".$prefix."_nsnpj_requests_types` WHERE `type_weight`>='".$type['type_weight']."'");
while(list($p_id, $weight) = $db->sql_fetchrow($typeresult)) {
    $new_weight = $weight - 1;
    $db->sql_query("UPDATE `".$prefix."_nsnpj_requests_types` SET `type_weight`='$new_weight' WHERE `type_id`='$p_id'");
}
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_types`");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests`");
header("Location: ".$admin_file.".php?op=PJRequestTypeList");

?>