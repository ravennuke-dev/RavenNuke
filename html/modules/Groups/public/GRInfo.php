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

title(_GR_GROUPINFO);
OpenTable();
echo '<div class="text-center"><table border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor1.'">'."\n";

$result = $db->sql_query('SELECT `gid`, `gname`, `gdesc`, `glimit` FROM `'.$prefix.'_nsngr_groups` WHERE `gpublic`>"0" AND `gid`=\''.$gid.'\'');
$numusers = $db->sql_numrows($result);
if($numusers > 0) {
	while(list($gid, $gname, $gdesc, $glimit) = $db->sql_fetchrow($result)) {
		echo '<tr><td align="left" bgcolor="'.$bgcolor2.'"><span class="thick">'._GR_GRPNAME.':</span></td><td  align="left">'.$gname.' ';

		if(($glimit == 0 OR $numusers < $glimit) AND !in_group($gid) AND is_user($user)) {
			echo '<a href="modules.php?name='.$module_name.'&amp;op=GRJoin&amp;gid='.$gid.'"><img src="modules/'.$module_name.'/images/join.png" height="16" width="36" border="0" alt="'._GR_JOIN.'" title="'._GR_JOIN.'" /></a>'."\n";
		}

		echo '</td></tr>'."\n";

		$numusers = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `'.$prefix.'_nsngr_users` WHERE `gid`=\''.$gid.'\''));

		echo '<tr><td align="left" bgcolor="'.$bgcolor2.'"><span class="thick">'._GR_NUMUSERS.':</span></td><td align="left">'.$numusers.'</td></tr>'."\n";

		if($glimit == 0) {
			$gmlimit = _GR_NOLIMIT;
		} elseif($glimit <= $numusers) {
			$gmlimit = _GR_FILLED;
		} else {
			$gmlimit = $glimit;
		}

		echo '<tr><td align="left" bgcolor="'.$bgcolor2.'"><span class="thick">'._GR_LIMIT.':</span></td><td align="left">'.$gmlimit.'</td></tr>'."\n";
		echo '<tr><td align="left" bgcolor="'.$bgcolor2.'" valign="top"><span class="thick">'._GR_DESCRIPTION.':</span></td><td align="left">'.nl2br($gdesc).'</td>'."\n";
		echo '</tr>'."\n";
	}
} else {
	echo '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="2">'._GR_NOPUBLICGROUP.'</td></tr>'."\n";
}

echo '</table></div><br />'."\n";
echo '<div class="text-center">'._GOBACK.'</div>'."\n";

CloseTable();

include_once ('footer.php');

?>