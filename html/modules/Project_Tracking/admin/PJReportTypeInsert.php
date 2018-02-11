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

$type_name = htmlentities($type_name, ENT_QUOTES);

$result = $db->sql_query('SELECT type_weight FROM ' . $prefix . '_nsnpj_reports_types ORDER BY type_weight DESC');
list($lweight) = $db->sql_fetchrow($result);

$weight = $lweight + 1;
if($weight < 1) {
	$weight = 1;
}

$db->sql_query('INSERT INTO ' . $prefix . '_nsnpj_reports_types VALUES (NULL, "' . $type_name . '", "' . $weight . '")');

header('Location: ' . $admin_file . '.php?op=PJReportTypeList');

?>