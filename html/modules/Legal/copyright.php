<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/************************************************************************/
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/************************************************************************/

$author_name = 'RavenNuke(tm)';
$license = 'GNU/GPL';
$author_homepage = 'http://www.ravenphpscripts.com';
$module_name = basename(dirname(__FILE__));
$module_version = '1.0.0';
$module_description = 'Legal Documents was completely re-coded by montego'
	. ' for the RavenNuke(tm) system to allow for any number of documents'
	. ' to be added as well as translatable without having to use language'
	. ' definitions.';

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
	global $author_name, $author_email, $author_homepage, $license, $download_location, $module_name, $module_version, $module_description;
	if ($author_name == '') { $author_name = 'N/A'; }
	if ($author_email == '') { $author_email = 'N/A'; }
	if ($author_homepage == '') { $author_homepage = 'N/A'; }
	if ($license == '') { $license = 'N/A'; }
	if ($download_location == '') { $download_location = 'N/A'; }
	if ($module_version == '') { $module_version = 'N/A'; }
	if ($module_description == '') { $module_description = 'N/A'; }
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
echo '<head>'."\n";
echo '<title>'.$module_name.': Copyright Information</title>'."\n";
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
	echo '<body bgcolor="#FFFFFF" link="#363636" alink="#363636" vlink="#363636">'
		.'<div style="text-align:center;"><span style="font-weight:bold;">Module Copyright &copy; Information</span><br />'
		.$module_name.' Module for <a href="http://www.ravenphpscripts.com" target="new">RavenNuke(tm)</a><br /><br /></div>'
		.'<img src="../../images/arrow.gif" alt="" border="0" />&nbsp;<span style="font-weight:bold;">Module&#39;s Name:</span> '.$module_name.'<br />'
		.'<img src="../../images/arrow.gif" alt="" border="0" />&nbsp;<span style="font-weight:bold;">Module&#39;s Version:</span> '.$module_version.'<br />'
		.'<img src="../../images/arrow.gif" alt="" border="0" />&nbsp;<span style="font-weight:bold;">Module&#39;s Description:</span> '.$module_description.'<br />'
		.'<img src="../../images/arrow.gif" alt="" border="0" />&nbsp;<span style="font-weight:bold;">License:</span> '.$license.'<br />'
		.'<img src="../../images/arrow.gif" alt="" border="0" />&nbsp;<span style="font-weight:bold;">Author&#39;s Name:</span> '.$author_name.'<br /><br />'
		.'<div style="text-align:center;">[ <a href="'.$author_homepage.'" target="new">Author&#39;s HomePage</a> | <a href="javascript:void(0)" onclick="javascript:self.close()">Close</a> ]</div>'
		.'</body>'
		.'</html>';
}

show_copyright();

?>