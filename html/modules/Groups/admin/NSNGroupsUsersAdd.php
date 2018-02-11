<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

!isset($gid) ? $gid = 0 :$gid = intval($gid);
!isset($min) ? $min = 0 : $min = intval($min);
!isset($max) ? $max = $min+$grconfig['perpage'] : $max = intval($max);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSADD;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
if ($gid > 0) {
	$totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $user_prefix . '_users` WHERE `user_level`>\'0\''));
	grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);

	echo '<div class="text-center"><form method="post" action="' . $admin_file . '.php?op=NSNGroupsUsersAddSave">';
	echo '<input type="hidden" name="gid" value="' . $gid . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<table border="0" cellpadding="2" cellspacing="2" bgcolor="' . $bgcolor2 . '">';

	list($grpName) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid . '\''));

	echo '<tr><td align="center" colspan="2" bgcolor="' . $bgcolor2 . '">' . _GR_ADDUSRTO . ' <a href="' . $admin_file . '.php?op=NSNGroupsUsersView&amp;gid=' . $gid . '"><span class="thick">' . $grpName . '</span></a></td></tr>';

	$result3 = $db->sql_query('SELECT `user_id`, `username` FROM `' . $user_prefix . '_users` WHERE `user_level`>\'0\' ORDER BY `username` LIMIT ' . $min . ',' . $grconfig['perpage']);
	while (list($thisUID, $thisUNAME) = $db->sql_fetchrow($result3)) {
		echo '<tr bgcolor="' . $bgcolor1 . '" onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'" onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'">';
		echo '<td>';
		if ($thisUNAME != 'Anonymous') {
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=NSNGroupsMemberships&yauserid=' . $thisUID . '">' . $thisUNAME . '</a>';
		} else {
			echo $thisUNAME;
		}
		echo '</td>';
		if (!is_ingroup($thisUID, $gid)) {
			echo '<td align="center"><input name="add_uid[]" type="checkbox" value="' . $thisUID . '" /></td>';
		} else {
			echo '<td align="center"><input name="add_uid[]" type="checkbox" value="' . $thisUID . '" disabled="disabled" /></td>';
		}
		echo '</tr>';
	}

	echo '<tr><td align="center" colspan="2" nowrap="nowrap">' . _GR_EXPIRES . ': <select name="newmonth">' . '<option value="00">--</option>';

	for ($i = 1;$i <= 12;$i++) {
		if ($i < 10) {
			$r = '0' . $i;
		} else {
			$r = $i;
		}
		echo '<option value="' . $r . '">' . $i . '</option>';
	}

	echo '</select><span class="thick">/</span><select name="newday"><option value="00">--</option>';

	for ($i = 1;$i <= 31;$i++) {
		if ($i < 10) {
			$r = '0' . $i;
		} else {
			$r = $i;
		}
		echo '<option value="' . $r . '">' . $i . '</option>';
	}

	echo '</select><span class="thick">/</span><select name="newyear"><option value="0000">----</option>';

	for ($i = date('Y');$i <= date('Y') +5;$i++) {
		if ($i < 10) {
			$r = '0' . $i;
		} else {
			$r = $i;
		}
		echo '<option value="' . $r . '">' . $i . '</option>';
	}

	echo '</select> <select name="newhour"><option value="00">--</option>';

	for ($i = 0;$i <= 23;$i++) {
		if ($i < 10) {
			$r = '0' . $i;
		} else {
			$r = $i;
		}
		echo '<option value="' . $r . '">' . $i . '</option>';
	}

	echo '</select><span class="thick">:</span><select name="newmin"><option value="00">--</option>';

	for ($i = 0;$i <= 59;$i++) {
		if ($i < 10) {
			$r = '0' . $i;
		} else {
			$r = $i;
		}
		echo '<option value="' . $r . '">' . $i . '</option>';
	}

	echo '</select><span class="thick">:00</span><br />' . _GR_EXPIRENOTE . '</td></tr>';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _GR_ADDUSR . '" /></td></tr>';
	echo '</table>';
	echo '</form></div>';
	grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
} else {
	$field_r = '\'gid\'';
	$field_d = '\'' . _GR_ADDUSRTO . '\'';
	grformcheck($field_r, $field_d);
	echo '<div class="text-center"><form method="post" action="' . $admin_file . '.php?op=NSNGroupsUsersAdd" onsubmit="return formCheck(this);">';
	echo '<table border="0" cellpadding="0" cellspacing="2">';
	echo '<tr>';
	echo '<td align="center">' . _GR_ADDUSRTO . '<br />';
	echo '<select name="gid" size="5">';

	$result3 = $db->sql_query('SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
	while (list($thisGID, $thisGNAME) = $db->sql_fetchrow($result3)) {
		echo '<option value="' . $thisGID . '">' . $thisGNAME . '</option>';
	}

	echo '</select><br /><input type="submit" value="' . _GR_SELECTGRP . '" /></td>';
	echo '</tr>';
	echo '</table>';
	echo '</form></div>';
}
CloseTable();

include_once ('footer.php');

?>