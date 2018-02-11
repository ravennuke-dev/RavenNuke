<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$xblocker_row['list'] = str_replace($xblocker_row['listdelete'], "", $xblocker_row['list']);
$xblocker_row['list'] = str_replace("\r\n\r\n", "\r\n", $xblocker_row['list']);
$block_list = explode("\r\n", $xblocker_row['list']);
rsort($block_list);
$endlist = count($block_list)-1;
if(empty($block_list[$endlist])) { array_pop($block_list); }
sort($block_list);
$xblocker_row['list'] = implode("\r\n", $block_list);
$db->sql_query("UPDATE `".$prefix."_nsnst_blockers` SET `list`='".$xblocker_row['list']."' WHERE `block_name`='".$xblocker_row['block_name']."'");
header("Location: ".$admin_file.".php?op=$xop");

?>