<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header('Location: ../../../' . $admin_file . '.php'); }
  $display_page = abview_template($template);
  $display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . '</div>' . "\n" . '</body>', $display_page);
  die($display_page);

?>