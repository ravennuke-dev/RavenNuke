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

$db->sql_query('UPDATE ' . $prefix . '_nsnpj_members SET member_name="' . $member_name . '", member_email="' . $member_email . '" WHERE member_id="' . $member_id . '"');
$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsnpj_members');

header('Location: ' . $admin_file . '.php?op=PJMemberList');

?>