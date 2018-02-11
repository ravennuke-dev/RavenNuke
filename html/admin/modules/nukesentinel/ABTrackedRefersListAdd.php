<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$tid = intval($tid);
$deleterow = $db->sql_fetchrow($db->sql_query("SELECT `refered_from` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$pagetitle = _AB_NUKESENTINEL.": "._AB_ADDREFERER;
include("header.php");
OpenTable();
OpenMenu(_AB_ADDREFERER);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABTrackedRefersListAddSave" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_REFERER.'</strong>:</td>'."\n";
echo '<td><input type="text" name="referer" size="50" maxlength="256" value="'.strtolower($deleterow['refered_from']).'" /><br />'._AB_MAXLENGTH256.'</td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>