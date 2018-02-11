<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_DELETETYPE;
$type_id = intval($type_id);
if($type_id < 1) { header("Location: ".$admin_file.".php?op=PJRequestTypeList"); }
include("header.php");
$typeresult = $db->sql_query("SELECT `type_name` FROM `".$prefix."_nsnpj_requests_types` WHERE `type_id`='$type_id'");
list($type_name) = $db->sql_fetchrow($typeresult);
pjadmin_menu(_PJ_REQUESTS.": "._PJ_DELETETYPE);
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr><td align='center'><span class='thick'>"._PJ_SWAPREQUESTTYPE."</span></td></tr>";
echo "<tr><td align='center'>$type_name -> <select name='swap_type_id'>";
echo "<option value='-1'>"._PJ_NA."</option>\n";
$typelist = $db->sql_query("SELECT `type_id`, `type_name` FROM `".$prefix."_nsnpj_requests_types` WHERE `type_id` != '$type_id' AND `type_id` > 0 ORDER BY `type_weight`");
while(list($t_type_id, $t_type_name) = $db->sql_fetchrow($typelist)){
    echo "<option value='$t_type_id'>$t_type_id - $t_type_name</option>";
}
echo "</select></td></tr>";
echo "<tr><td align='center'>\n";
echo "<input type='hidden' name='op' value='PJRequestTypeDelete' />";
echo "<input type='hidden' name='type_id' value='$type_id' />";
echo "<input type='submit' value='"._PJ_DELETETYPE."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>