<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_CLEARTRACKED;
include("header.php");
OpenTable();
OpenMenu(_AB_CLEARTRACKED);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABTrackedClearSave" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
echo '<tr><td align="center" class="content">'._AB_CLEARTRACKEDS.'<br />'."\n";
echo '<input type="submit" value="'._AB_CLEARTRACKED.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>