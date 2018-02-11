<?php

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = 'NSN Groups';
$author_email = '';
$author_homepage = 'http://www.nukescripts.net';
$author_name = '<a href="'.$author_homepage.'">NukeScripts Network</a>';
$license = 'All Modifications - Copyright &copy; 2000-2005 NukeScripts Network';
$download_location = '';
$module_version = '';
$release_date = '';
$module_description = '';
$mod_cost = '';
if($mod_name == '') { $mod_name = str_replace('_', ' ', $module_name); }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
echo '<head>'."\n";
echo '<title>'.$mod_name.': Copyright Information</title>'."\n";
echo '<style type="text/css">'."\n";
echo '<!--'."\n";
echo 'body{'."\n";
echo 'FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;'."\n";
echo 'SCROLLBAR-3DLIGHT-COLOR:#000000;'."\n";
echo 'SCROLLBAR-ARROW-COLOR:#e7e7e7;'."\n";
echo 'SCROLLBAR-FACE-COLOR:#414141;'."\n";
echo 'SCROLLBAR-DARKSHADOW-COLOR:#000000;'."\n";
echo 'SCROLLBAR-HIGHLIGHT-COLOR:#9d9d9d;'."\n";
echo 'SCROLLBAR-SHADOW-COLOR:#9d9d9d;'."\n";
echo 'SCROLLBAR-TRACK-COLOR:#e7e7e7;'."\n";
echo '}'."\n";
echo '-->'."\n";
echo '</style>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<div class="text-center"><span style="font-weight:bold;">Module Copyright &copy; Information</span><br />';
echo $mod_name.' module</div>'."\n".'<hr />'."\n";
echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name: </span>'.$mod_name.'<br />'."\n";
if($module_version != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Version: </span>'.$module_version.'<br />'."\n"; }
if($release_date != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Release Date: </span>'.$release_date.'<br />'."\n"; }
if($mod_cost != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Cost: </span>'.$mod_cost.'<br />'."\n"; }
if($license != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License: </span>'.$license.'<br />'."\n"; }
if($author_name != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name: </span>'.$author_name.'<br />'."\n"; }
if($author_email != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Email: </span>'.$author_email.'<br />'."\n"; }
if($module_description != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Description: </span>'.$module_description.'<br />'."\n"; }
if($download_location != "") { echo '<img src="images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Download: </span><a href="'.$download_location.'" target="new">Download</a><br />'."\n"; }
echo '<hr />'."\n";
echo '<div class="text-center">[<a href="#" onclick="javascript:self.close()">Close Window</a>]</div>'."\n";
echo '</body>'."\n";
echo '</html>';

?>
