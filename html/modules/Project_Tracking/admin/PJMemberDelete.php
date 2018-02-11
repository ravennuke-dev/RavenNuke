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

$member_id = intval($member_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_members WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_members');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects_members SET member_id="' . $swap_member_id . '" WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_projects_members');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_tasks_members SET member_id="' . $swap_member_id . '" WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_tasks_members');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports_members SET member_id="' . $swap_member_id . '" WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_members');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_requests_members SET member_id="' . $swap_member_id . '" WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_requests_members');

header('Location: ' . $admin_file . '.php?op=PJMemberList');

?>