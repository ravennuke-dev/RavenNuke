<?php

/***********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net) 			*/
/* http://www.nukescripts.net 						*/
/* Copyright © 2000-2005 by NukeScripts Network 			*/
/***********************************************************/
/*"Iñtërnâtiônàlizætiøn"							*/
/* Project Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright © 2013 by RavenNuke™		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

$module_name = basename(dirname(__FILE__));
$author_email = '<a href="mailto:matt@phpnuke-clan.org">Palbin</a>';
$author_name = '<a href="http://www.ravenphpscripts.com" target="new">RavenNuke(tm)</a>';
$download_location = 'http://www.ravenphpscripts.com/modules.php?name=Downloads';
$license = 'Copyright &copy; 2013 RavenNuke™';
$module_description = 'Advanced Project Management System.  Based on NukeProject™.  Made XHTML compliant and fixed several bugs and other issues';
$module_version = '';
$release_date = '';

header('Content-type: text/html; charset=utf-8');

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',"\n";
echo '<html xmlns="http://www.w3.org/1999/xhtml">',"\n";
echo '<head>',"\n";
echo '<title>' , $module_name , ': Copyright Information</title>',"\n";
echo '<style type="text/css">',"\n";
echo '<!--',"\n";
echo 'body{',"\n";
echo 'FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;',"\n";
echo '}',"\n";
echo '-->',"\n";
echo '</style>',"\n";
echo '</head>',"\n";
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">',"\n";
echo '<div style="text-align:center;"><span style="font-weight:bold;">Module Copyright &copy; Information</span><br />';
echo $module_name , ' module</div><hr />',"\n";
echo '<img src="images/arrow.png" border="0" title="" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' , $module_name , '<br />',"\n";

if($author_email != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Author\'s Email:</span> ' , $author_email , '<br />',"\n";
}

if($author_name != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' , $author_name , '<br />',"\n";
}

if($download_location != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Download:</span> <a href="' , $download_location , '" target="new">Download</a><br />',"\n";
}

if($license != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">License:</span> ' , $license , '<br />',"\n";
}

if($module_description != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Description:</span> ' , $module_description , '<br />',"\n";
}

if($module_version != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Version:</span> ' , $module_version , '<br />',"\n";
}

if($release_date != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Release Date:</span> ' , $release_date , '<br />',"\n";
}

echo '<hr />',"\n";

$mod_name = 'NukeProject™';
$author_email = '<a href="http://www.nukescripts.net/modules.php?name=Feedback" target="new">NukeScripts Network</a>';
$author_name = '<a href="http://www.nukescripts.net" target="new">NukeScripts Network</a>';
$download_location = 'http://www.nukescripts.net/modules.php?name=Downloads';
$license = 'Copyright &copy; 2000-2005 NukeScripts Network';
$module_description = 'Advanced Project Management System.';
$module_version = '';
$release_date = '';

echo '<img src="images/arrow.png" border="0" title="" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' , $module_name , '<br />',"\n";

if($author_email != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Author\'s Email:</span> ' , $author_email , '<br />',"\n";
}

if($author_name != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' , $author_name , '<br />',"\n";
}

if($download_location != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Download:</span> <a href="' , $download_location , '" target="new">Download</a><br />',"\n";
}

if($license != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">License:</span> ' , $license , '<br />',"\n";
}

if($module_description != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Description:</span> ' , $module_description , '<br />',"\n";
}

if($module_version != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Module\'s Version:</span> ' , $module_version , '<br />',"\n";
}

if($release_date != '') {
	echo '<img src="images/arrow.png" border="0" alt="" title="" />&nbsp;<span style="font-weight:bold;">Release Date:</span> ' , $release_date , '<br />',"\n";
}

echo '<hr />',"\n";
echo '<div style="text-align:center;">[ <a href="#" onclick="javascript:self.close()">Close Window</a> ]</div>',"\n";
echo '</body>',"\n";
echo '</html>';

?>