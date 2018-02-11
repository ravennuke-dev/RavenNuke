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

$chng_uid = intval($chng_uid);
$gid = intval($gid);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSUPDATE;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();

list($uname, $uemail) = $db->sql_fetchrow($db->sql_query('SELECT username, user_email FROM ' . $user_prefix . '_users WHERE user_id="' . $chng_uid . '"'));
list($edate) = $db->sql_fetchrow($db->sql_query('SELECT edate FROM ' . $prefix . '_nsngr_users WHERE uid="' . $chng_uid . '" AND gid="' . $gid . '"'));

if ($edate > 0) {
	$fday = date('j', $edate);
	$fmon = date('n', $edate);
	$fyear = date('Y', $edate);
	$fhour = date('G', $edate);
	$fmin = date('i', $edate);
} else {
	$fday = '00';
	$fmon = '00';
	$fyear = '0000';
	$fhour = '00';
	$fmin = '00';
}

echo '<form action="' . $admin_file . '.php" method="post">';
echo '<input type="hidden" name="op" value="NSNGroupsUsersUpdateSave" />';
echo '<input type="hidden" name="gid" value="' . $gid . '" />';
echo '<input type="hidden" name="chng_uid" value="' . $chng_uid . '" />';
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _GR_USRNAME . ':</td><td bgcolor="' . $bgcolor1 . '"><span class="thick">' . $uname . '&nbsp;</span></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _GR_USRMAIL . ':</td><td bgcolor="' . $bgcolor1 . '"><span class="thick">' . $uemail . '&nbsp;</span></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _GR_EXPIRES . ':</td><td bgcolor="' . $bgcolor1 . '"><select name="newmonth">' . '<option value="00">--</option>';

for ($i = 1;$i <= 12;$i++) {
	if ($i == $fmon) {
		$sel = ' selected="selected "';
	} else {
		$sel = '';
	}
	if ($i < 10) {
		$r = '0' . $i;
	} else {
		$r = $i;
	}
	echo '<option value="' . $r . '"' . $sel . '>' . $i . '</option>';
}

echo '</select><span class="thick">/</span><select name="newday">' . '<option value="00">--</option>';

for ($i = 1;$i <= 31;$i++) {
	if ($i == $fday) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	if ($i < 10) {
		$r = '0' . $i;
	} else {
		$r = $i;
	}
	echo '<option value="' . $r . '"' . $sel . '>' . $i . '</option>';
}

echo '</select><span class="thick">/</span><select name="newyear">' . '<option value="0000">----</option>';

for ($i = date('Y');$i <= date('Y') +5;$i++) {
	if ($i == $fyear) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	if ($i < 10) {
		$r = '0' . $i;
	} else {
		$r = $i;
	}
	echo '<option value="' . $r . '"' . $sel . '>' . $i . '</option>';
}

echo '</select> <select name="newhour">' . '<option value="00">--</option>';

for ($i = 0;$i <= 23;$i++) {
	if ($i == $fhour AND $fhour > 0) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	if ($i < 10) {
		$r = '0' . $i;
	} else {
		$r = $i;
	}
	echo '<option value="' . $r . '"' . $sel . '>' . $i . '</option>';
}

echo '</select><span class="thick">:</span><select name="newmin">' . '<option value="00">--</option>';

for ($i = 0;$i <= 59;$i++) {
	if ($i == $fmin AND $fmin > 0) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	if ($i < 10) {
		$r = '0' . $i;
	} else {
		$r = $i;
	}
	echo '<option value="' . $r . '"' . $sel . '>' . $i . '</option>';
}

echo '</select><span class="thick">:00</span><br />' . _GR_EXPIRENOTE . '</td></tr>';
echo '<tr><td align="center" bgcolor="' . $bgcolor1 . '" colspan="2"><input type="submit" value="' . _GR_UPDATE . ' &quot;' . $uname . '&quot;" /></td></tr>';
echo '</table>';
echo '</form>';
echo '<br /><div class="text-center">' . _GOBACK . '</div>';
CloseTable();

include_once ('footer.php');

?>