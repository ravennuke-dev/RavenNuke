<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_DELETECOMMENT;
include("header.php");
$requestcomment = pjrequestcomment_info($comment_id);
pjadmin_menu(_PJ_REQUESTS.": "._PJ_DELETECOMMENT);
echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='PJRequestCommentDelete' />";
echo "<input type='hidden' name='comment_id' value='$comment_id' />";
echo "<input type='hidden' name='request_id' value='".$requestcomment['request_id']."' />";
echo "<tr><td align='center' colspan='2'><span class='thick'>"._PJ_CONFIRMCOMMENTDELETE."</span></td></tr>";
echo "<tr><td align='center' valign='top'><span class='thick'>"._PJ_COMMENT." #$comment_id</span></td><td>".$requestcomment['comment_description']."</td></tr>";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._PJ_DELETECOMMENT."' /></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include("footer.php");

?>