<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright � 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_id`='$user_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=$xop&user_id=$user_id&column=$column&direction=$direction&min=$min&showmodule=$showmodule");

?>