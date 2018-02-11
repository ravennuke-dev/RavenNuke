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

$priority = pjprojectpriority_info($priority_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_projects_priorities WHERE priority_id="' . $priority_id . '"');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects SET priority_id="' . $swap_priority_id . '" WHERE priority_id="' . $priority_id . '"');

$priorityresult = $db->sql_query('SELECT priority_id, priority_weight FROM ' . $prefix . '_nsnpj_projects_priorities WHERE priority_weight>="' . $priority['priority_weight'] . '"');
while(list($p_id, $weight) = $db->sql_fetchrow($priorityresult)) {
	$new_weight = $weight - 1;
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects_priorities SET priority_weight="' . $new_weight . '" WHERE priority_id="' . $p_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects_priorities');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects');

header('Location: ' . $admin_file . '.php?op=PJProjectPriorityList');

?>