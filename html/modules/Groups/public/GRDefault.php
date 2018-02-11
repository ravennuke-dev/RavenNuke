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

include_once ('header.php');

title(_GR_PUBLICGROUPS);
OpenTable();
echo '<div class="text-center"><table border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'">'."\n";
echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
echo '<td align="center" width="200"><span class="thick">'._GR_GRPNAME.'</span></td>'."\n";
echo '<td align="center" width="100"><span class="thick">'._GR_NUMUSERS.'</span></td>'."\n";
echo '<td align="center" width="100"><span class="thick">'._GR_LIMIT.'</span></td>'."\n";
echo '<td align="center" width="100"><span class="thick">&nbsp;</span></td>'."\n";
echo '</tr>'."\n";

$result = $db->sql_query('SELECT `gid`, `gname`, `glimit` FROM `'.$prefix.'_nsngr_groups` WHERE `gpublic`>0 ORDER BY `gname`');
if($db->sql_numrows($result) > 0) {
	while(list($gid, $gname, $glimit) = $db->sql_fetchrow($result)) {
		$numusers = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `'.$prefix.'_nsngr_users` WHERE `gid`=\''.$gid.'\''));

		echo '<tr bgcolor="'.$bgcolor1.'" onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'">'."\n";
		echo '<td align="center">'.$gname.'</td>'."\n";
		echo '<td align="center">'.$numusers.'</td>'."\n";

		if($glimit == 0) {
			$gmlimit = _GR_NOLIMIT;
		} elseif($glimit <= $numusers) {
			$gmlimit = _GR_FILLED;
		} else {
			$gmlimit = $glimit;
		}

		echo '<td align="center">'.$gmlimit.'</td>'."\n";
		echo '<td align="left">'."\n";
		echo '<a href="modules.php?name='.$module_name.'&amp;op=GRInfo&amp;gid='.$gid.'"><img src="modules/'.$module_name.'/images/info.png" height="16" width="36" border="0" alt="'._GR_INFO.'" title="'._GR_INFO.'" /></a>'."\n";

		if(($glimit == 0 OR $numusers < $glimit) AND !in_group($gid, true) AND is_user($user)) {
			echo '<a href="modules.php?name='.$module_name.'&amp;op=GRJoin&amp;gid='.$gid.'"><img src="modules/'.$module_name.'/images/join.png" height="16" width="36" border="0" alt="'._GR_JOIN.'" title="'._GR_JOIN.'" /></a>'."\n";
		}

		echo '</td>'."\n";
		echo '</tr>'."\n";
	}
} else {
	echo '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="4">'._GR_NOPUBLICGROUPS.'</td></tr>'."\n";
}
echo '</table></div>'."\n";
CloseTable();

include_once ('footer.php');

?>