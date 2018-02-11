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

$type_id = intval($type_id);

if($type_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJRequestTypeList');
}

$type = pjreporttype_info($type_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_types WHERE type_id="' . $type_id . '"');
$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports SET type_id="' . $swap_type_id . '" WHERE type_id="' . $type_id . '"');

$typeresult = $db->sql_query('SELECT type_id, type_weight FROM ' . $prefix . '_nsnpj_reports_types WHERE type_weight>="' . $type['type_weight'] . '"');
while(list($p_id, $weight) = $db->sql_fetchrow($typeresult)) {
	$new_weight = $weight - 1;
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports_types SET type_weight="' . $new_weight . '" WHERE type_id="' . $p_id . '"');
}

$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_types');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports');

header('Location: ' . $admin_file . '.php?op=PJReportTypeList');

?>