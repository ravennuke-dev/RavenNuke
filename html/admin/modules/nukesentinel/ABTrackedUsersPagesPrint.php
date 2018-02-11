<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
echo '<head>'."\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_USERTRACKING;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
if(!isset($user_id)) $user_id=0; // 0001801: Compliance issues reported by vanquish: NukeSentinel 
$user_id=intval($user_id);
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='$tid' LIMIT 0,1"));
echo '<div class="text-center"><strong>'.$uname.' ('.$tid.')</strong></div><br />'."\n";
echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="#ffffff">'."\n";
echo '<td><strong>'._AB_PAGEVIEWED.'</strong></td>'."\n";
echo '<td><strong>'._AB_DATE.'</strong></td>'."\n";
echo '</tr>'."\n";
$result = $db->sql_query("SELECT `user_id`, `ip_addr`, `page`, `date` FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_id`='$tid' ORDER BY `date` DESC");
while(list($luserid, $lipaddr, $page, $date_time) = $db->sql_fetchrow($result)){
  $page = wordwrap($page, 50, "\n", true);
  $page = str_replace("&amp;amp;", "&amp;", htmlentities($page, ENT_QUOTES));
  $page = str_replace("\n", "<br />\n", $page);
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td>'.$page.'</td>'."\n";
  echo '<td>'.date("Y-m-d \@ H:i:s",$date_time).'</td>'."\n";
  echo '</tr>'."\n";
}
echo '</table>'."\n";
echo '</body>'."\n";
echo '</html>';

?>