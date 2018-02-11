<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_REQUESTEDIT;
include("header.php");
$request = pjrequest_info($request_id);
pjadmin_menu(_PJ_REQUESTS.": "._PJ_REQUESTEDIT);
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_PROJECT.":</td>";
echo "<td><select name='project_id'>\n";
$projectlist = $db->sql_query("SELECT `project_id`, `project_name` FROM `".$prefix."_nsnpj_projects` ORDER BY `project_name`");
while(list($p_project_id, $p_project_name) = $db->sql_fetchrow($projectlist)){
    if($p_project_id == $request['project_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
    echo "<option value='$p_project_id' $sel>$p_project_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_TYPE.":</td>";
echo "<td><select name='type_id'>";
$typelist = $db->sql_query("SELECT `type_id`, `type_name` FROM `".$prefix."_nsnpj_requests_types` ORDER BY `type_weight`");
while(list($t_type_id, $t_type_name) = $db->sql_fetchrow($typelist)){
    if($t_type_id == $request['type_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
    echo "<option value='$t_type_id' $sel>$t_type_name</option>\n";
}
echo "</select></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_STATUS.":</td>";
echo "<td><select name='status_id'>";
$statuslist = $db->sql_query("SELECT `status_id`, `status_name` FROM `".$prefix."_nsnpj_requests_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    if($s_status_id == $request['status_id']){ $sel = "selected='selected'"; } else { $sel = ""; }
    echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_USERNAME.":</td>";
echo "<td><input type='text' name='submitter_name' size='30' value=\"".$request['submitter_name']."\" /></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_EMAILADDRESS.":</td>";
echo "<td><input type='text' name='submitter_email' size='30' value=\"".$request['submitter_email']."\" /></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_SUMMARY.":</td>";
echo "<td><input type='text' name='request_name' size='30' value=\"".$request['request_name']."\" /></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._PJ_DESCRIPTION.":</td>";
echo "<td><textarea name='request_description' cols='60' rows='10'>".$request['request_description']."</textarea></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._PJ_ASSIGNMEMBERS.":</td>";
echo "<td><select name='member_ids[]' size='10' multiple='multiple'>\n";
echo "<option value='-1'></option>\n";
$memberlistresult = $db->sql_query("SELECT `member_id`, `member_name` FROM `".$prefix."_nsnpj_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    $memberexresult = $db->sql_query("SELECT `member_id` FROM `".$prefix."_nsnpj_requests_members` WHERE `member_id`='$member_id' AND `request_id`='$request_id'");
    $numrows = $db->sql_numrows($memberexresult);
    if($numrows < 1){ echo "<option value='$member_id'>$member_name</option>\n"; }
}
echo "</select></td></tr>";
echo "<tr><td colspan='2' align='center'>\n";
echo "<input type='hidden' name='op' value='PJRequestUpdate' />\n";
echo "<input type='hidden' name='request_id' value='$request_id' />\n";
echo "<input type='submit' value='"._PJ_REQUESTUPDATE."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td align='left' bgcolor='$bgcolor2' width='100%' colspan='2'><span class='thick'>"._PJ_REQUESTMEMBERS."</span></td>";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_POSITION."</span></td>";
echo "<td align='center' bgcolor='$bgcolor2'><span class='thick'>"._PJ_DELETE."</span></td></tr>";
$membersresult = $db->sql_query("SELECT `member_id`, `position_id` FROM `".$prefix."_nsnpj_requests_members` WHERE `request_id`='$request_id'");
$numrows = $db->sql_numrows($membersresult);
if($numrows > 0){
    while(list($member_id, $position_id) = $db->sql_fetchrow($membersresult)){
        $member = pjmember_info($member_id);
        $position = pjmemberposition_info($position_id);
        echo "<tr>";
        $pjimage = pjimage("member.png", $module_name);
        echo "<td><img src='$pjimage' alt='' title='' /></td><td width='100%'>".$member['member_name']."</td>";
        echo "<td><input type='hidden' name='member_ids[]' VALUE='$member_id'><select name='position_ids[]' />";
        $positionlistresult = $db->sql_query("SELECT `position_id`, `position_name` FROM `".$prefix."_nsnpj_members_positions` ORDER BY `position_weight`");
        while(list($l_position_id, $l_position_name) = $db->sql_fetchrow($positionlistresult)) {
            if($l_position_id == $position_id){ $sel = "selected='selected'"; } else { $sel = ""; }
            echo "<option value='$l_position_id' $sel>$l_position_name</option>\n";
        }
        echo "</select></td>";
        echo "<td align='center' nowrap='nowrap'><input name='delete_member_ids[]' type='checkbox' value='$member_id' /></td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4' width='100%' align=right bgcolor='$bgcolor2'>\n";
	echo "<input type='hidden' name='op' value='PJRequestMembers' />\n";
	echo "<input type='hidden' name='request_id' value='$request_id' />\n";
	echo "<input type='submit' value='"._PJ_UPDATE."' />\n";
    echo "<input type='submit' value='"._PJ_DELETE."' />\n";
	echo "</td></tr>\n";
} else {
    echo "<tr><td colspan='4' width='100%' align='center'>"._PJ_NOREQUESTMEMBERS."</td></tr>\n";
}

echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>