<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_TASKS.": "._PJ_EDITSTATUS;
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=PJTaskStatusList"); }
include("header.php");
$status = pjtaskstatus_info($status_id);
pjadmin_menu(_PJ_TASKS.": "._PJ_EDITSTATUS);
echo "<br />\n";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_STATUSNAME.":</td>\n";
echo "<td><input type='text' name='status_name' size='30' value=\"".$status['status_name']."\" /></td></tr>\n";
echo "<tr><td colspan='2' align='center'>\n";
echo "<input type='hidden' name='op' value='PJTaskStatusUpdate' />\n";
echo "<input type='hidden' name='status_id' value='$status_id' />\n";
echo "<input type='submit' value='"._PJ_UPDATETASKSTATUS."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>