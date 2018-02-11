<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_protected_ranges`");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_protected_ranges`");
header("Location: ".$admin_file.".php?op=ABProtectedMenu");

?>