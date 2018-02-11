<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

$orig_author_name = 'Francisco Burzi';
$orig_author_email = '';
$orig_author_homepage = 'http://phpnuke.org';
$curr_author_name = 'Gaylen Fraley (aka Raven)';
$curr_author_email = 'raven@ravenphpscripts.com';
$curr_author_homepage = 'http://www.ravenphpscripts.com';
$license = 'GNU/GPL';
$download_location = 'http://www.ravenphpscripts.com';
$module_version = '2.0';
$module_description = 'All topics are shown in this module with some useful information. This topics module is an edited version of the PHP-Nuke 6.5 topics module. Edits were made by VJ Demsky and Gaylen Fraley (Raven).  It appears that VJ Demsky\'s support site is no longer available.  Ravenphpscripts will continue to support this in the RavenNuke&trade; distros.';

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
	global $orig_author_name, $orig_author_email, $orig_author_homepage, $curr_author_name, $curr_author_email, $curr_author_homepage,$license, $download_location, $module_version, $module_description;
	if ($orig_author_name == '') { $orig_author_name = 'N/A'; }
	if ($orig_author_email == '') { $orig_author_email = 'N/A'; }
	if ($orig_author_homepage  == '') { $orig_author_homepage = 'N/A'; }
	if ($license == '') { $license = 'N/A'; }
	if ($download_location == '') { $download_location = 'N/A'; }
	if ($module_version == '') { $module_version = 'N/A'; }
	if ($module_description == '') { $module_description = 'N/A'; }
	$module_name = basename(dirname(__FILE__));
	$module_name = ucfirst(str_replace('_', ' ', $module_name));

	$download = '';
	if ($download_location != '') {
		$download = '<a href="' . $download_location . '" target="_blank">Module\'s Download</a> | ';
	}

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" '
		, '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
		, '<html xmlns="http://www.w3.org/1999/xhtml">'
		, '<head><title>' , $module_name , ': Copyright Information</title></head>'
		, '<body bgcolor="#F6F6EB" link="#363636" alink="#363636" vlink="#363636">'
		, '<div style="text-align:center;">'
		, '<span style="font-size:x-small; color:#363636; font-family:Verdana, Helvetica;">'
		, '<span style="font-weight:bold;">Module Copyright &copy; Information</span><br />'
		,  $module_name , ' for <a href="http://www.ravenphpscripts.com" target="_blank">RavenNuke(tm)</a><br /><br />'
		, '</span>'
		, '</div>'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' , $module_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Version:</span> ' , $module_version , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Description:</span> ' , $module_description , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' , $license , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' , $orig_author_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Email:</span> ' , $orig_author_email , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Original Author\'s HomePage:</span> ' , $orig_author_homepage , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Current Author\'s Name:</span> ' , $curr_author_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Current Author\'s Email:</span> ' , $curr_author_email , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Current Author\'s HomePage:</span>'
		, ' <a href="' , $curr_author_homepage , '" target="_blank">http://www.ravenphpscripts.com</a><br /><br />'
		, '<div style="text-align:center;">'
		, '<span style="font-size:x-small; color:#363636; font-family:Verdana, Helvetica;">'
		, '[ <a href="' , $curr_author_homepage , '" target="_blank">Author\'s HomePage</a> | '
		, $download
		, '<a href="javascript:void(0)" onclick="javascript:self.close()">Close</a> ]'
		, '</span>'
		, '</div>'
		, '</body>'
		, '</html>';

}

show_copyright();

?>