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

$report_id = intval($report_id);
$report = pjreport_info($report_id);

$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports WHERE report_id="' . $report_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports');
$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_comments WHERE report_id="' . $report_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_comments');
$db->sql_query('DELETE FROM ' . $prefix . '_nsnpj_reports_members WHERE report_id="' . $report_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_members');

header('Location: modules.php?name=' . $module_name . '&op=PJProject&project_id=' . $report['project_id']);

?>