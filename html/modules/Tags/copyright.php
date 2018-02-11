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

$author_name = 'lgnuke.org';
$author_email = 'info@lgnuke.org';
$author_homepage = 'http://www.lgnuke.org';
$license = 'GNU/GPL';
$download_location = 'http://www.lgnuke.org';
$module_version = '1.0';
$module_description = 'Tags Cloud per Php-Nuke';
$rnauthor_name = 'trickedoutnews.com';
$rndownload_location = 'http://www.trickedoutnews.com';
function show_copyright() {
	global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $rnauthor_name, $rndownload_location;
	if ($author_name == '') { $author_name = 'N/A'; }
	if ($author_email == '') { $author_email = 'N/A'; }
	if ($author_homepage == '') { $author_homepage = 'N/A'; }
	if ($license == '') { $license = 'N/A'; }
	if ($download_location == '') { $download_location = 'N/A'; }
	if ($module_version == '') { $module_version = 'N/A'; }
	if ($module_description == '') { $module_description = 'N/A'; }
	$module_name = basename(dirname(__FILE__));
	$module_name = ucfirst(str_replace('_', ' ', $module_name));

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" '
		, '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
		, '<html xmlns="http://www.w3.org/1999/xhtml">'
		, '<head><title>' , $module_name , ': Copyright Information</title></head>'
		, '<body bgcolor="#F6F6EB" link="#363636" alink="#363636" vlink="#363636">'
		, '<div style="text-align:center;">'
		, '<span style="font-size:x-small; color:#363636; font-family:Verdana, Helvetica;">'
		, '<span style="font-weight:bold;">Module Copyright &copy; Information</span><br />'
		,  $module_description , ' for <a href="http://www.ravenphpscripts.com" target="_blank">RavenNuke(tm)</a><br /><br />'
		, '</span>'
		, '</div>'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' , $module_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Version:</span> ' , $module_version , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Description:</span> ' , $module_description , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' , $license , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' , $author_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">RavenNuke Author\'s Name:</span> ' , $rnauthor_name , '<br />'
		, '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Email:</span> ' , $author_email , '<br /><br />'
		, '<div style="text-align:center;">'
		, '<span style="font-size:x-small; color:#363636; font-family:Verdana, Helvetica;">'
		, '[ <a href="' , $author_homepage , '" target="new">Author\'s HomePage</a> | <a href="' , $download_location , '" target="new">Module\'s Download</a>'
		, ' | <a href="' , $rndownload_location , '" target="new">RavenNuke Module\'s Download</a> | <a href="javascript:void(0)" onclick="javascript:self.close()">Close</a> ]'
		, '</span>'
		, '</div>'
		, '</body>'
		, '</html>';
}

show_copyright();

?>