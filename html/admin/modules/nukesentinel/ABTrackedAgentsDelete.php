<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$tid = intval($tid);
$deleterow = $db->sql_fetchrow($db->sql_query("SELECT `user_agent` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='".$deleterow['user_agent']."'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=ABTrackedAgentsList&min=$min&column=$column&direction=$direction");

?>