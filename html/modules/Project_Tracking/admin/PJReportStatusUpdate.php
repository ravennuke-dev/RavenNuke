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

$status_name = htmlentities($status_name, ENT_QUOTES);

$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports_status SET status_name="' . $status_name . '" WHERE status_id="' . $status_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_status');

header('Location: ' . $admin_file . '.php?op=PJReportStatusList');

?>