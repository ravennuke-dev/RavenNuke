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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSADD;

include_once ('header.php');

$field_r = '\'gname\', \'mname\'';
$field_d = '\'' . _GR_GROUPNAME . '\', \'' . _GR_BBMODERATOR . '\'';
grformcheck($field_r, $field_d);

title($pagetitle);
NSNGroupsAdmin();
echo '<br />' . "\n";
OpenTable();
echo '<form method="post" name="GroupsAdd" action="' . $admin_file . '.php" onsubmit="return formCheck(this);">' . "\n";
echo '<input type="hidden" name="op" value="NSNGroupsAddSave" />' . "\n";
echo '<table align="center" border="0" cellpadding="0" cellspacing="2">' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _GR_GROUPNAME . ':</span></td>';
echo '<td><input type="text" name="gname" size="40" maxlength="32" /></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '"><span class="thick">' . _GR_BBMODERATOR . ':</span><br />' . _GR_BBMODERATOR2 . '</td>';
echo '<td valign="middle"><input type="text" name="mname" size="30" maxlength="25" /></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_DESCRIPTION . ':</span></td>';
echo '<td><textarea name="gdesc" ' . $textrowcol . '></textarea></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_PUBLIC . ':</span></td>';
echo '<td><select name="gpublic"><option value="0">' . _NO . '</option>';
echo '<option value="1">' . _YES . '</option></select><br />' . _GR_PUBLICNOTE . '</td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><span class="thick">' . _GR_LIMIT . ':</span></td>';
echo '<td><input type="text" name="glimit" size="4" maxlength="4" value="0" /><br />' . _GR_LIMITNOTE . '</td></tr>' . "\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _GR_ADDGRP . '" /></td></tr>' . "\n";
echo '</table>' . "\n";
echo '</form>' . "\n";
CloseTable();

include_once ('footer.php');
?>