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

$type_name = htmlentities($type_name, ENT_QUOTES);

$db->sql_query('UPDATE ' . $prefix . '_nsnpj_reports_types SET type_name="' . $type_name . '"  WHERE type_id="' . $type_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_reports_types');

header('Location: ' . $admin_file . '.php?op=PJReportTypeList');

?>