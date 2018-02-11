<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) {
	die('Illegal Access Detected!!!');
}

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_REQUESTS . ': ' . _PJ_DELETEREQUEST;
include 'header.php';
$request = pjrequest_info($request_id);
pjadmin_menu(_PJ_REQUESTS . ': ' . _PJ_DELETEREQUEST);
echo '<br />';
OpenTable();
echo '<form method="post" action="' , $admin_file , '.php">'
	, '<table align="center" border="0" cellpadding="2" cellspacing="2">'
	, '<tr><td align="center"><span class="thick">' , _PJ_REQUESTCONFIRMDELETE , '</span></td></tr>'
	, '<tr><td align="center"><span class="thick italic">' , $request['request_name'] , ':</span></td></tr>'
	, '<tr><td align="center"><span class="italic">' , $request['request_description'] , '</span></td></tr>'
	, '<tr><td align="center">' , "\n"
	, '<input type="hidden" name="op" value="PJRequestDelete" />'
	, '<input type="hidden" name="request_id" value="' , $request_id , '" />'
	, '<input type="hidden" name="project_id" value="' , $request['project_id'] , '" />'
	, '<input type="submit" value="' , _PJ_DELETEREQUEST , '" />' , "\n"
	, '</td></tr>' , "\n"
	, '</table>'
	, '</form>';
CloseTable();
pj_copy();
include 'footer.php';

?>