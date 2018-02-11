<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) {
	die("Illegal Access Detected!!!");
}

if (!isset($delete_member_ids)) {
	$delete_member_ids = 0;
}

for($i = 0; $i < count($delete_member_ids); $i++){
  $db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests_members` WHERE `member_id`='".$delete_member_ids[$i]."' AND `request_id`='$request_id'");
}

if (!isset($member_ids)) {
	$member_ids = 0;
}

for($i = 0; $i < count($member_ids); $i++){
  $db->sql_query("UPDATE `".$prefix."_nsnpj_requests_members` SET `position_id`='".$position_ids[$i]."' WHERE `request_id`='$request_id' AND `member_id`='".$member_ids[$i]."'");
}

$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_members`");

header("Location: ".$admin_file.".php?op=PJRequestEdit&request_id=$request_id");

?>