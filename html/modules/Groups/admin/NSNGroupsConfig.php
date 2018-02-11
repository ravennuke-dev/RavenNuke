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

$pagetitle = ' - ' . _GR_GROUPSCONFIG;

include_once ('header.php');

title(_GR_GROUPSCONFIG);
NSNGroupsAdmin();
echo '<br />' . "\n";
OpenTable();
echo '<form action="' . $admin_file . '.php" method="post">' . "\n";
echo '<input type="hidden" name="file" value="admin" />' . "\n";
echo '<input type="hidden" name="op" value="NSNGroupsConfigSave" />' . "\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _GR_SENDNOTICE . '</td><td><select name="xsend_notice">' . "\n";
echo '<option value="0"';

if ($grconfig['send_notice'] == 0) {
	echo ' selected="selected"';
}

echo '> ' . _GR_NO . ' </option>' . "\n" . '<option value="1"';

if ($grconfig['send_notice'] == 1) {
	echo ' selected="selected"';
}

echo '> ' . _GR_YES . ' </option>' . "\n";
echo '</select></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _GR_PERPAGE . '<br />' . _GR_PERPAGE2 .'</td><td valign="top"><select name="xperpage">' . "\n";
echo '<option value="' . $grconfig['perpage'] . '" selected="selected"> ' . $grconfig['perpage'] . ' </option>' . "\n";

for ($i = 1;$i <= 5;$i++) {
	$j = $i*10;
	echo '<option value="' . $j . '"> ' . $j . ' </option>' . "\n";
}

echo '</select></td></tr>' . "\n";
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _GR_DATEFORMAT . ':</td><td>';
echo '<input size="30" maxlength="60" type="text" name="xdate_format" value="' . $grconfig['date_format'] . '" /><br />' . _GR_DATEFORMATMSG . '</td></tr>' . "\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _GR_SAVECHANGES . '" /></td></tr>' . "\n";
echo '</table>' . "\n";
echo '</form>' . "\n";
CloseTable();

include_once ('footer.php');

?>