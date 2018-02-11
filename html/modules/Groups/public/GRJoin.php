<?php

/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/

if (!defined('MODULE_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

$gid = intval($gid);

include_once ('header.php');

$result = $db->sql_query('SELECT `glimit`, `gpublic`, `phpBB` FROM `'.$prefix.'_nsngr_groups` WHERE `gid`=\''.$gid.'\'');
list($glimit, $gpublic, $phpBB) = $db->sql_fetchrow($result);
$numusers = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `'.$prefix.'_nsngr_users` WHERE `gid`=\''.$gid.'\''));

cookiedecode($user);
$uid = $cookie[0];

title(_GR_GROUPJOIN);
OpenTable();
if(is_ingroup($uid,$gid)) {
	echo '<div class="text-center thick">'._GR_INGROUP.'</div><br />'."\n";
	echo '<div class="text-center">'._GOBACK.'</div>'."\n";
} elseif($gpublic == 0) {
	echo '<div class="text-center thick">'._GR_NOTPUBLIC.'</div><br />'."\n";
	echo '<div class="text-center">'._GOBACK.'</div>'."\n";
} elseif($glimit <= $numusers AND $glimit != 0) {
	echo '<div class="text-center thick">'._GR_GROUPFILLED.'</div><br />'."\n";
	echo '<div class="text-center">'._GOBACK.'</div>'."\n";
} elseif($uid > 0) {
	$xdate = time();
	$db->sql_query('INSERT INTO `'.$prefix.'_nsngr_users` (`gid`, `uid`, `sdate`) VALUES (\''.$gid.'\', \''.$uid.'\', \''.$xdate.'\')');
	$db->sql_query('INSERT INTO `'.$prefix.'_bbuser_group` (`group_id`, `user_id`) VALUES (\''.$phpBB.'\', \''.$uid.'\')');
	echo '<div class="text-center thick">'._GR_ADDGROUP.'</div><br />'."\n";
	echo '<div class="text-center">'._GOBACK.'</div>'."\n";
} else {
	echo '<div class="text-center thick">'._GR_MUSTBEUSER.'</div><br />'."\n";
	echo '<div class="text-center">'._GOBACK.'</div>'."\n";
}
CloseTable();

include_once ('footer.php');

?>