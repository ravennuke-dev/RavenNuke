<?php

/***********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net) 			*/
/* http://www.nukescripts.net 						*/
/* Copyright © 2000-2005 by NukeScripts Network 			*/
/***********************************************************/
/*"Iñtërnâtiônàlizætiøn"							*/
/* Project Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright © 2013 by RavenNuke™		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

$new_task_position = intval($new_task_position);
$new_task_priority = intval($new_task_priority);
$new_task_status = intval($new_task_status);

pjsave_config('new_task_position', $new_task_position);
pjsave_config('new_task_priority', $new_task_priority);
pjsave_config('new_task_status', $new_task_status);
pjsave_config('task_date_format', $task_date_format);

header('Location: ' . $admin_file . '.php?op=PJTaskConfig');

?>