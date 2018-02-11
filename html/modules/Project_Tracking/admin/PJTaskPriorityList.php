<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_TASKS.": "._PJ_PRIORITYLIST;
include("header.php");
pjadmin_menu(_PJ_TASKS.": "._PJ_PRIORITYLIST);
echo "<br />\n";
$priorityresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnpj_tasks_priorities` WHERE `priority_weight` > 0 ORDER BY `priority_weight`");
$priority_total = $db->sql_numrows($priorityresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2' nowrap='nowrap'><span class='thick'>"._PJ_PRIORITYOPTIONS."</span></td></tr>\n";
$pjimage = pjimage("options.png", $module_name);
echo "<tr><td><img src='$pjimage' alt='' title='' /></td><td colspan='2' width='100%' nowrap='nowrap'><a href='".$admin_file.".php?op=PJTaskPriorityAdd'>"._PJ_PRIORITYADD."</a></td></tr>\n";
$pjimage = pjimage("stats.png", $module_name);
echo "<tr><td><img src='$pjimage' alt='' title='' /></td><td colspan='2' width='100%' nowrap='nowrap'>"._PJ_TOTALTASKPRIORITIES.": <span class='thick'>$priority_total</span></td></tr>\n";
echo "</table>\n";
//CloseTable();
echo "<br />\n";
//OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><span class='thick'>"._PJ_PRIORITIES."</span></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_WEIGHT."</span></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_FUNCTIONS."</span></td></tr>\n";
if($priority_total != 0){
  while($priority_row = $db->sql_fetchrow($priorityresult)) {
    $pjimage = pjimage("priority.png", $module_name);
    echo "<tr><td><img src='$pjimage' alt='' title='' /></td><td width='100%'>".$priority_row['priority_name']."</td>\n";
    $weight1 = $priority_row['priority_weight'] - 1;
    $weight3 = $priority_row['priority_weight'] + 1;
    list($pid1) = $db->sql_fetchrow($db->sql_query("SELECT `priority_id` FROM `".$prefix."_nsnpj_projects_priorities` WHERE `priority_weight`='$weight1'"));
    list($pid2) = $db->sql_fetchrow($db->sql_query("SELECT `priority_id` FROM `".$prefix."_nsnpj_projects_priorities` WHERE `priority_weight`='$weight3'"));
    echo "<td align='center' nowrap='nowrap'>";
    if($pid1 AND $pid1 > 0) {
      echo "<a class='rn_csrf' href='".$admin_file.".php?op=PJProjectPriorityOrder&amp;weight=".$priority_row['priority_weight']."&amp;pid=".$priority_row['priority_id']."&amp;weightrep=$weight1&amp;pidrep=$pid1'><img src='modules/".$module_name."/images/weight_up.png' border='0' hspace='3' alt='"._PJ_UP."' title='"._PJ_UP."' /></a>";
    } else {
      echo "<img src='modules/".$module_name."/images/weight_up_no.png' border='0' hspace='3' alt='' title='' />";
    }
    if($pid2) {
      echo "<a class='rn_csrf' href='".$admin_file.".php?op=PJProjectPriorityOrder&amp;weight=".$priority_row['priority_weight']."&amp;pid=".$priority_row['priority_id']."&amp;weightrep=$weight3&amp;pidrep=$pid2'><img src='modules/".$module_name."/images/weight_dn.png' border='0' hspace='3' alt='"._PJDOWN."' title='"._PJ_DOWN."' /></a>";
    } else {
      echo "<img src='modules/".$module_name."/images/weight_dn_no.png' border='0' hspace='3' alt='' title='' />";
    }
    echo"</td>\n";
    echo "<td align='center' nowrap='nowrap'>[ <a href='".$admin_file.".php?op=PJTaskPriorityEdit&amp;priority_id=".$priority_row['priority_id']."'>"._PJ_EDIT."</a>";
    echo " | <a href='".$admin_file.".php?op=PJTaskPriorityRemove&amp;priority_id=".$priority_row['priority_id']."'>"._PJ_DELETE."</a> ]</td></tr>\n";
  }
  echo "<tr><td align='center' colspan='4'><a class='rn_csrf' href='".$admin_file.".php?op=PJTaskPriorityFix'>"._PJ_FIXWEIGHT."</a></td></tr>\n";
} else {
  echo "<tr><td width='100%' colspan='4' align='center'>"._PJ_NOTASKPRIORITY."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
pj_copy();
include("footer.php");

?>