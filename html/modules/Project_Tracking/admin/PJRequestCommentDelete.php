<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$comment_id = intval($comment_id);
$db->sql_query("DELETE FROM `".$prefix."_nsnpj_requests_comments` WHERE `comment_id`='$comment_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnpj_requests_comments`");
header("Location: modules.php?name=".$module_name."&op=PJRequest&request_id=$request_id");

?>