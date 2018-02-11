<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_IP2CDELETE;
include("header.php");
OpenTable();
OpenMenu(_AB_IP2CDELETE);
mastermenu();
CarryMenu();
ip2cmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
if (!isset($sip)) $sip = ''; // 0001801: Compliance issues reported by vanquish: NukeSentinel 
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABIP2CountryDeleteSave" />'."\n";
echo '<input type="hidden" name="ip_lo" value="'.$ip_lo.'" />'."\n";
echo '<input type="hidden" name="ip_hi" value="'.$ip_hi.'" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<input type="hidden" name="showcountry" value="'.$showcountry.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center">'._AB_IP2CDELETES.' '.long2ip($ip_lo).' to '.long2ip($ip_hi).'?</td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_IP2CDELETE.'" /></td></tr>'."\n";
echo '<tr><td align="center">'._GOBACK.'</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>