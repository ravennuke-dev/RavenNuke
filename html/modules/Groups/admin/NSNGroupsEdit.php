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

$gid = intval($gid);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSEDIT;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />' . "\n";
OpenTable();

$sel1 = $sel2 = '';

$result = $db->sql_query('SELECT g.`gpublic`, g.`muid`, g.`gname`, g.`gdesc`, g.`glimit`, u.`username` FROM `' . $prefix . '_nsngr_groups` g, `' . $user_prefix . '_users` u WHERE g.`gid`=\'' . $gid . '\' AND u.`user_id` = g.`muid`');
list($public, $muid, $name, $desc, $limit, $username) = $db->sql_fetchrow($result);

if ($public == 0) {
	$sel1 = ' selected="selected"';
} else {
	$sel2 = ' selected="selected"';
}

echo '<form method="post" action="' . $admin_file . '.php">' . "\n";
echo '<input type="hidden" name="op" value="NSNGroupsEditSave" />' . "\n";
echo '<input type="hidden" name="gid" value="' . $gid . '" />' . "\n";
echo '<input type="hidden" name="old_muid" value="' . $muid . '" />' . "\n";
echo '<table align="center" border="0" cellpadding="0" cellspacing="2">' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _GR_GROUP . ':</span></td>';
echo '<td><input type="text" name="gname" size="40" maxlength="32" value="' . htmlentities($name, ENT_QUOTES) . '" /></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _GR_BBMODERATOR . ':</span></td>';
echo '<td><input type="text" name="mname" size="30" maxlength="25" value="' . $username . '" /></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_DESCRIPTION . ':</span></td>';
echo '<td><textarea name="gdesc" ' . $textrowcol . '>' . htmlentities($desc, ENT_QUOTES) . '</textarea></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_PUBLIC . ':</span></td>';
echo '<td><select name="gpublic"><option value="0"' . $sel1 . '>' . _NO . '</option>';
echo '<option value="1"' . $sel2 . '>' . _YES . '</option></select><br />' . _GR_PUBLICNOTE . '</td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_LIMIT . ':</span></td>';
echo '<td><input type="text" name="glimit" size="4" maxlength="4" value="' . $limit . '" /><br />' . _GR_LIMITNOTE . '</td></tr>' . "\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _GR_EDITGRP . '" /></td></tr>' . "\n";
echo '</table>' . "\n";
echo '</form>' . "\n";
CloseTable();

include_once ('footer.php');

?>