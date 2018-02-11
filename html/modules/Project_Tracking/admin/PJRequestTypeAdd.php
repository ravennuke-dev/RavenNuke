<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_TYPEADD;
include("header.php");
pjadmin_menu(_PJ_REQUESTS.": "._PJ_TYPEADD);
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_TYPE.":</td>";
echo "<td><input type='text' name='type_name' size='30' /></td></tr>";
echo "<tr><td colspan='2' align='center'>\n";
echo "<input type='hidden' name='op' value='PJRequestTypeInsert' />\n";
echo "<input type='submit' value='"._PJ_TYPEADD."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>