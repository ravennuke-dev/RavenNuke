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

if (!isset($delete_member_ids)) {
	$delete_member_ids = 0;
}

for($i = 0; $i < count($delete_member_ids); $i++) {
	$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_projects_members WHERE member_id="' . $delete_member_ids[$i] . '" AND project_id="' . $project_id . '"');
}

if (!isset($member_ids)) {
	$member_ids = 0;
}

for($i = 0; $i < count($member_ids); $i++) {
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects_members SET position_id="' . $position_ids[$i] . '" WHERE project_id="' . $project_id . '" AND member_id="' . $member_ids[$i] . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects_members');

header('Location: ' . $admin_file . '.php?op=PJProjectEdit&project_id=' . $project_id);

?>