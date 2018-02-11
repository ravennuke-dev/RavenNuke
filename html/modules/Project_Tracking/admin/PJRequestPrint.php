<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
include_once("includes/counter.php");
$request = pjrequest_info($request_id);
$Theme_Sel = get_theme();
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
echo "<head>\n";
echo "<title>"._PJ_REQUESTVIEW.": ".$request['request_name']."</title>\n";
echo "</head>\n";
echo "<body>\n";
require_once("themes/$Theme_Sel/theme.php");
echo '<div style="text-align:center;"><h3>' , _PJ_REQUESTVIEW , ': ' , $request['request_name'] , '</h3></div>' , "\n";
echo "<br />\n";
$project = pjproject_info($request['project_id']);
$requeststatus = pjrequeststatus_info($request['status_id']);
$requesttype = pjrequesttype_info($request['type_id']);
if($requeststatus['status_name'] == ""){ $requeststatus['status_name'] = _PJ_NA; }
if($requesttype['type_name'] == ""){ $requesttype['type_name'] = _PJ_NA; }
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='4' width='100%' nowrap='nowrap'><span class='thick'>"._PJ_PROJECTNAME."</span></td></tr>\n";
$pjimage = pjimage("project.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage' alt='' title='' /></td>\n";
echo "<td colspan='3' width='100%' nowrap='nowrap'>".$project['project_name']." (".$request['project_id'].")</td></tr>\n";
echo "<tr><td colspan='2' width='100%' nowrap='nowrap'><span class='thick'>"._PJ_REQUESTINFO."</span></td>\n";
echo "<td align='center'><span class='thick'>"._PJ_STATUS."</span></td>\n";
echo "<td align='center'><span class='thick'>"._PJ_TYPE."</span></td></tr>\n";
$pjimage = pjimage("request.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage' alt='' title='' /></td><td width='100%' nowrap='nowrap'>".$request['request_name']."</td>\n";
echo "<td align='center' nowrap='nowrap'>".$requeststatus['status_name']."</td>\n";
echo "<td align='center' nowrap='nowrap'>".$requesttype['type_name']."</td></tr>\n";
if($request['request_description'] != ""){
  $pjimage = pjimage("description.png", $module_name);
  echo "<tr><td align='center' valign='top'><img src='$pjimage' alt='' title='' /></td>\n";
  echo "<td colspan='3' width='100%'>".nl2br($request['request_description'])."</td></tr>";
}
$pjimage = pjimage("requester.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage' alt='' title='' /></td>\n";
echo "<td colspan='3' width='100%' nowrap='nowrap'>"._PJ_REQUESTEDBY.": <span class='thick'>".$request['submitter_email']."</span></td></tr>\n";
if($request['date_submitted'] != '0'){
  $submit_date = date($pj_config['request_date_format'], $request['date_submitted']);
  $pjimage = pjimage("date.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage' alt='' title='' /></td>\n";
  echo "<td colspan='3' width='100%' nowrap='nowrap'>"._PJ_SUBMITTED.": <span class='thick'>$submit_date</span></td></tr>\n";
}
if($request['date_modified'] != '0'){
  $modify_date = date($pj_config['request_date_format'], $request['date_modified']);    
  $pjimage = pjimage("date.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage' alt='' title='' /></td>\n";
  echo "<td colspan='3' width='100%' nowrap='nowrap'>"._PJ_MODIFIED.": <span class='thick'>$modify_date</span></td></tr>\n";
}
$memberresult = $db->sql_query("SELECT `member_id` FROM `".$prefix."_nsnpj_requests_members` WHERE `request_id`='$request_id' ORDER BY `member_id`");
$member_total = $db->sql_numrows($memberresult);
echo "<tr><td colspan='4' width='100%' nowrap='nowrap'><span class='thick'>"._PJ_REQUESTMEMBERS."</span></td></tr>\n";
if($member_total != 0){
  while(list($member_id) = $db->sql_fetchrow($memberresult)) {
    $pjimage = pjimage("member.png", $module_name);
    $member = pjmember_info($member_id);
    echo "<tr><td><img src='$pjimage' alt='' title='' /></td><td colspan='3' width='100%'>".$member['member_name']." (".$member['member_email'].")</td></tr>\n";
  }
} else {
  echo "<tr><td align='center' colspan='4' width='100%' nowrap='nowrap'>"._PJ_NOREQUESTMEMBERS."</td></tr>\n";
}
echo "</table>\n";
echo "<br />\n";
$commentresult = $db->sql_query("SELECT `comment_id` FROM `".$prefix."_nsnpj_requests_comments` WHERE `request_id`='$request_id' ORDER BY `date_commented` asc");
$comment_total = $db->sql_numrows($commentresult);
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td width='100%' nowrap='nowrap'><span class='thick'>"._PJ_COMMENTS."</span></td></tr>\n";
if($comment_total > 0){
  while(list($comment_id) = $db->sql_fetchrow($commentresult)) {
    $comment = pjrequestcomment_info($comment_id);
    $comment_date = date($pj_config['request_date_format'], $comment['date_commented']);    
    echo "<tr><td nowrap='nowrap'><span class='thick'>".$comment['commenter_email']." @ $comment_date</span>";
    echo "</td></tr>\n";
    echo "<tr><td>".nl2br($comment['comment_description'])."</td></tr>\n";
  }
} else {
  echo "<tr><td align='center' nowrap='nowrap'>"._PJ_NOREQUESTCOMMENTS."</td></tr>\n";
}
echo "</table>\n";
echo "</body>\n";
echo "</html>\n";

?>