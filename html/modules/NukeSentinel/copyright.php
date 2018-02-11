<?php

/********************************************************/
/* NukeScripts(tm) (http://www.nukescripts.net)         */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/********************************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = 'NukeSentinel(tm)';
$author_email = '';
$author_homepage = 'http://www.nukescripts.net';
$author_name = '<a href="'.$author_homepage.'" target="new">NukeScripts(tm)</a>';
$download_location = '';
$license = 'Copyright &#169; 2000-2008 NukeScripts(tm)';
$mod_cost = '';
$module_description = 'Advanced PHP-Nuke site security proudly produced by: NukeScripts(tm), Raven PHPScripts, &amp; NukeResources.';
$module_version = '';
$release_date = '';
if($mod_name == '') { $mod_name = str_replace('_', ' ', $module_name); }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
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
echo '<div style="text-align:center;"><strong>'.$mod_name.': Copyright Information</strong></div>'."\n".'<hr noshade="noshade" size="1" />'."\n";
echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Module Name:</strong> '.$mod_name.'<br />'."\n";
if($module_version != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Module Version:</strong> '.$module_version.'<br />'."\n"; }
if($release_date != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Release Date:</strong> '.$release_date.'<br />'."\n"; }
if($mod_cost != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Module Cost:</strong> '.$mod_cost.'<br />'."\n"; }
if($license != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>License:</strong> '.$license.'<br />'."\n"; }
if($author_name != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Author Name:</strong> '.$author_name.'<br />'."\n"; }
if($author_email != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Author Email:</strong> '.$author_email.'<br />'."\n"; }
if($module_description != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Module Description:</strong> '.$module_description.'<br />'."\n"; }
if($download_location != "") { echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<strong>Module Download:</strong> <a href="'.$download_location.'" target="new">Download</a><br />'."\n"; }
echo '<hr noshade="noshade" size="1" />'."\n";
echo '<div style="text-align:center;">[<a href="#" onclick="javascript:self.close()">Close Window</a>]</div>'."\n";
echo '</body>'."\n";
echo '</html>';

?>