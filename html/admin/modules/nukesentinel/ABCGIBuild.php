<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(is_god()) {
  if($ab_config['staccess_path'] > "") {
    $stwrite = "";
    $adminresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `password_crypt`>'' ORDER BY `aid`");
    while($adminrow = $db->sql_fetchrow($adminresult)) {
      $stwrite .= $adminrow['login'].":".$adminrow['password_crypt']."\n";
      $doit = fopen($ab_config['staccess_path'], "w");
      fwrite($doit, $stwrite);
      fclose($doit);
    }
  }
  header("Location: ".$admin_file.".php?op=ABAuthList");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>