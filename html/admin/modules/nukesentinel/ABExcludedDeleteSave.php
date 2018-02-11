<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$db->sql_query("DELETE FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_excluded_ranges`");
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&sip=$sip");

?>