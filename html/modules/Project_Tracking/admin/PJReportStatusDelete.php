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

$status_id = intval($status_id);

if($status_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJRequestStatusList');
}

$status = pjreportstatus_info($status_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_status WHERE status_id="' . $status_id . '"');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports SET status_id="' . $swap_status_id . '" WHERE status_id="' . $status_id . '"');

$statusresult = $db->sql_query('SELECT status_id, status_weight FROM ' . $prefix . '_nsnpj_reports_status WHERE status_weight>="' . $status['status_weight'] . '"');
while(list($p_id, $weight) = $db->sql_fetchrow($statusresult)) {
	$new_weight = $weight - 1;
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports_status SET status_weight="' . $new_weight . '" WHERE status_id="' . $p_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_status');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports');

header('Location: ' . $admin_file . '.php?op=PJReportStatusList');

?>