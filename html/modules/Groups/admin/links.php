<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/

global $admin_file;

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

adminmenu($admin_file . '.php?op=NSNGroups', _GR_ADMGRP, 'groups.png');

?>