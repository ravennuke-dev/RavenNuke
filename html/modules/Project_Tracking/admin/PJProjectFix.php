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

$result = $db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_projects ORDER BY project_id ASC');
$weight = 0;
while($row = $db->sql_fetchrow($result)) {
	$xid = intval($row['project_id']);
	$weight++;
	$db->sql_query('UPDATE ' . $prefix . '_nsnpj_projects SET weight="' . $weight . '" WHERE project_id="' . $xid . '"');
}

header('Location: ' . $admin_file . '.php?op=PJProjectList');

?>