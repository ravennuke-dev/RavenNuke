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

$new_project_position = intval($new_project_position);
$new_project_priority = intval($new_project_priority);
$new_project_status = intval($new_project_status);

pjsave_config('new_project_position', $new_project_position);
pjsave_config('new_project_priority', $new_project_priority);
pjsave_config('new_project_status', $new_project_status);
pjsave_config('project_date_format', $project_date_format);

header('Location: ' . $admin_file . '.php?op=PJProjectConfig');

?>