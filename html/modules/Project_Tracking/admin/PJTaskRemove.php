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

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_TASKS . ': ' . _PJ_DELETETASK;
include 'header.php';
$task = pjtask_info($task_id);
pjadmin_menu(_PJ_TASKS . ': ' . _PJ_DELETETASK);
echo '<br />' , "\n";
OpenTable();
echo '<form method="post" action="' , $admin_file , '.php">' , "\n"
	, '<table align="center" border="0" cellpadding="2" cellspacing="2">' , "\n"
	, '<tr><td align="center"><span class="thick">' , _PJ_TASKCONFIRMDELETE , '</span></td></tr>' , "\n"
	, '<tr><td align="center"><span class="thick italic">' , $task['task_name'] , ':</span></td></tr>' , "\n"
	, '<tr><td align="center"><span class="italic">' , $task['task_description'] , '</span></td></tr>' , "\n"
	, '<tr><td align="center">' , "\n"
	, '<input type="hidden" name="op" value="PJTaskDelete" />' , "\n"
	, '<input type="hidden" name="task_id" value="' , $task_id , '" />' , "\n"
	, '<input type="submit" value="' , _PJ_DELETETASK , '" />' , "\n"
	, '</td></tr>' , "\n"
	, '</table>' , "\n"
	, '</form>' , "\n";
CloseTable();
pj_copy();
include 'footer.php';

?>