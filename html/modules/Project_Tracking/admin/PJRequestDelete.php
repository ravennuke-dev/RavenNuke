<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$request_id = intval($request_id);
$request = pjrequest_info($request_id);
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests` WHERE `request_id`='$request_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests`");
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests_comments` WHERE `request_id`='$request_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_comments`");
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests_members` WHERE `request_id`='$request_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_members`");
header("Location: modules.php?name=".$module_name."&op=PJProject&project_id=".$request['project_id']);

?>