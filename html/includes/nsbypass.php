<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

error_reporting(E_ALL^E_NOTICE);
@ini_set('display_errors', 0);
chdir("../");
@require_once("mainfile.php");
global $nuke_config;
//$nuke_config = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_config` LIMIT 0,1"));
$a_aid = $a_pas = "";
$tid = intval($tid);
if(isset($_COOKIE['admin']) && !empty($_COOKIE['admin'])) {
  $abadmin = st_clean_string(base64_decode($_COOKIE['admin']));
  if (preg_match(REGEX_UNION, $abadmin)) { block_ip($blocker_array[1]); }
  if (preg_match(REGEX_UNION, base64_decode($abadmin))) { block_ip($blocker_array[1]); }
  $abadmin = explode(":", $abadmin);
  $a_aid = addslashes($abadmin[0]);
  $a_pas = addslashes($abadmin[1]);
}
$num = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_authors` WHERE `aid`='$a_aid' AND `pwd`='$a_pas' LIMIT 0,1"));
$tum = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
if($num > 0 AND $tum > 0) {
  $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
  $row['refered_from'] = html_entity_decode($row['refered_from'], ENT_QUOTES, _CHARSET);
  header("Location: ".$row['refered_from']);
} else {
  header("Location: ".$nuke_config['nukeurl']);
}

?>