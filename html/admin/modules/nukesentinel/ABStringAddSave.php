<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(!@get_magic_quotes_gpc()) { $string = addslashes($string); }
$testnum1 = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_strings` WHERE `string`='$string'"));
if($testnum1 > 0) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDSTRINGERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_ADDSTRINGERROR);
  mastermenu();
  CarryMenu();
  stringmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_STRINGEXISTS.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} elseif($string == "") {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITSTRINGERROR;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_EDITSTRINGERROR);
  mastermenu();
  CarryMenu();
  stringmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<div class="text-center"><strong>'._AB_STRINGEMPTY.'</strong><br />'."\n";
  echo '<strong>'._GOBACK.'</strong></div><br />'."\n";
  CloseTable();
  include("footer.php");
} else {
  $db->sql_query("INSERT INTO `".$prefix."_nsnst_strings` (`string`) VALUES ('$string')");
  $db->sql_query("ALTER TABLE `".$prefix."_nsnst_strings` ORDER BY `string`");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_strings`");
  $list_string = $ab_config['list_string']."\r\n".$string;
  $list_string = explode("\r\n", $list_string);
  rsort($list_string);
  $endlist = count($list_string)-1;
  if(empty($list_string[$endlist])) { array_pop($list_string); }
  sort($list_string);
  $list_string = implode("\r\n", $list_string);
  absave_config("list_string", $list_string);
  $another = isset($another) ? 0 : '';
  if($another == 1) {
    header("Location: ".$admin_file.".php?op=ABStringAdd");
  }else {
    header("Location: ".$admin_file.".php?op=ABStringList");
  }
}

?>