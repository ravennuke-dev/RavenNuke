<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_COMMENTEDIT;
include("header.php");
$requestcomment = pjrequestcomment_info($comment_id);
pjadmin_menu(_PJ_REQUESTS.": "._PJ_COMMENTEDIT);
echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='PJRequestCommentUpdate' />";
echo "<input type='hidden' name='comment_id' value='$comment_id' />";
echo "<input type='hidden' name='request_id' value='".$requestcomment['request_id']."' />";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_USERNAME.":</td>";
echo "<td><input type='text' name='commenter_name' size='30' value=\"".$requestcomment['commenter_name']."\" /></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._PJ_EMAILADDRESS.":</td>";
echo "<td><input type='text' name='commenter_email' size='30' value=\"".$requestcomment['commenter_email']."\" /></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._PJ_COMMENT.":</td>";
echo "<td><textarea name='comment_description' cols='60' rows='10'>".$requestcomment['comment_description']."</textarea></td></tr>";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._PJ_COMMENTUPDATE."' /></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include("footer.php");

?>