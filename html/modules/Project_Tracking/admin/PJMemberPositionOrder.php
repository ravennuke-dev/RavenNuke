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

$pidrep = intval($pidrep);
$pid = intval($pid);

$result = $db->sql_query('UPDATE ' . $prefix . '_nsnpj_members_positions SET position_weight="' . $weight . '" WHERE position_id="' . $pidrep . '"');
$result2 = $db->sql_query('UPDATE ' . $prefix . '_nsnpj_members_positions SET position_weight="' . $weightrep . '" WHERE position_id="' . $pid . '"');

header('Location: ' . $admin_file . '.php?op=PJMemberPositionList');

?>