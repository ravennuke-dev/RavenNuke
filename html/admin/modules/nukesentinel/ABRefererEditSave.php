<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(!@get_magic_quotes_gpc()) { $referer = addslashes($referer); }
$testnum1 = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` WHERE `referer`='".$referer."' AND `rid`!='".$rid."'"));
if($testnum1 > 0) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITREFERERERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_EDITREFERERERROR);
  mastermenu();
  CarryMenu();
  referermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_REFEREREXISTS.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} elseif($referer == "") {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITREFERERERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_EDITREFERERERROR);
  mastermenu();
  CarryMenu();
  referermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_REFEREREMPTY.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} else {
  $getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` WHERE `rid`='".$rid."' LIMIT 0,1"));
  $db->sql_query("UPDATE `".$prefix."_nsnst_referers` SET `referer`='".$referer."' WHERE `rid`='".$rid."'");
  $list_referer = explode("\r\n", $ab_config['list_referer']);
  $list_referer = str_replace($getIPs['referer'], $referer, $list_referer);
  rsort($list_referer);
  $endlist = count($list_referer)-1;
  if(empty($list_referer[$endlist])) { array_pop($list_referer); }
  sort($list_referer);
  $list_referer = implode("\r\n", $list_referer);
  absave_config("list_referer", $list_referer);
  header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");
}

?>