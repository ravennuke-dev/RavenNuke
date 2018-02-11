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

$priority_id = intval($priority_id);

if($priority_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJProjectPriorityList');
}

$priority_name = htmlentities($priority_name, ENT_QUOTES);
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects_priorities SET priority_name="' . $priority_name . '" WHERE priority_id="' . $priority_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects_priorities');

header('Location: ' . $admin_file . '.php?op=PJProjectPriorityList');

?>