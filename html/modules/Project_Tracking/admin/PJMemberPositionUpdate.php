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

$position_id = intval($position_id);

if($position_id < 1) {
	header('Location: ' . $admin_file . '.php?op=PJMemberPositionList');
}

$position_name = htmlentities($position_name, ENT_QUOTES);

$db->sql_query('UPDATE ' . $prefix . '_nsnpj_members_positions SET position_name="' . $position_name . '" WHERE position_id="' . $position_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_members_positions');

header('Location: ' . $admin_file . '.php?op=PJMemberPositionList');

?>