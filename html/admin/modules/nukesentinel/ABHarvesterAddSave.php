<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(!@get_magic_quotes_gpc()) { $harvester = addslashes($harvester); }
$testnum1 = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_harvesters` WHERE `harvester`='$harvester'"));
if($testnum1 > 0) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDHARVESTERERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_ADDHARVESTERERROR);
  mastermenu();
  CarryMenu();
  harvestermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_HARVESTEREXISTS.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} elseif($harvester == "") {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITHARVESTERERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_EDITHARVESTERERROR);
  mastermenu();
  CarryMenu();
  harvestermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_HARVESTEREMPTY.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} else {
  $db->sql_query("INSERT INTO `".$prefix."_nsnst_harvesters` (`harvester`) VALUES ('$harvester')");
  $db->sql_query("ALTER TABLE `".$prefix."_nsnst_harvesters` ORDER BY `harvester`");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_harvesters`");
  $list_harvester = $ab_config['list_harvester']."\r\n".$harvester;
  $list_harvester = explode("\r\n", $list_harvester);
  rsort($list_harvester);
  $endlist = count($list_harvester)-1;
  if(empty($list_harvester[$endlist])) { array_pop($list_harvester); }
  sort($list_harvester);
  $list_harvester = implode("\r\n", $list_harvester);
  absave_config("list_harvester", $list_harvester);
  if($another == 1) {
    header("Location: ".$admin_file.".php?op=ABHarvesterAdd");
  }else {
    header("Location: ".$admin_file.".php?op=ABHarvesterList");
  }
}

?>