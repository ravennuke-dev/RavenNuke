<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_VIEWTEMPLATE;
include("header.php");
OpenTable();
OpenMenu(_AB_VIEWTEMPLATE);
mastermenu();
CarryMenu();
templatemenu();
CloseMenu();
CloseTable();
include("footer.php");

?>