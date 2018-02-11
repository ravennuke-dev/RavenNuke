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
// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)

$author_name = 'Heshy Shayovitz';
$author_user_email = 'software@metopen.com';
$author_homepage = 'http://www.metopen.com/';
$license = 'GNU/GPL';
$download_location = 'http://www.metopen.com/downloads-file-8.html';
$module_version = '1.1';
$module_description = 'MetAuthors Module';
$rws_author_name = 'Gaylen Fraley (aka Raven)';
$rws_author_user_email = 'raven@ravenphpscripts.com';
$rws_author_homepage = 'http://www.ravenphpscripts.com/';
$rws_download_location = 'Coming Soon';
$rws_module_version = '1.1rws';
$rws_module_description = 'RWS W3C Enhanced MetAuthors Module';

/**
* DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
* MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
* FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
* YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
* AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
* YOU'RE NOT THIS MODULE'S AUTHOR.
*/

function show_copyright() {
	global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description;
	global $rws_author_name, $rws_author_user_email, $rws_author_homepage, $rws_download_location, $rws_module_version, $rws_module_description;
	if ($author_name == '') { $author_name = 'N/A'; }
	if ($author_user_email == '') { $author_user_email = 'N/A'; }
	if ($author_homepage == '') { $author_homepage = 'N/A'; }
	if ($license == '') { $license = 'N/A'; }
	if ($download_location == '') { $download_location = 'N/A'; }
	if ($module_version == '') { $module_version = 'N/A'; }
	if ($module_description == '') { $module_description = 'N/A'; }
	$module_name = basename(dirname(__FILE__));
	$module_name = str_replace('_', ' ', $module_name);
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"' , "\n"
		, '  "http://www.w3.org/TR/html4/loose.dtd">' , "\n"
		, '<html>' , "\n"
		, '<head><title>' , $module_name , ': Copyright Information</title></head>' , "\n"
		, '<body style="font-size:10px; color:#000000; font-family:Verdana, Helvetica;" bgcolor="#dedede" link="#000000" alink="#000000" vlink="#000000">' , "\n"
		, '<div style="text-align:center;"><span style="font-weight:bold;">Module Copyright &copy; Information</span><br />'
		, '<br /></div>' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' , $module_name , '<br />' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">Module\'s Version:</span> ' , $rws_module_version , '<br />' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">Module\'s Description:</span> ' , $rws_module_description , '<br />' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">License:</span> ' , $license , '<br /><br />' , "\n"
		, '<span style="font-weight:bold; text-decoration:underline;">Original Version Credits</span><br /><img src="../../images/arrow.gif" alt="" border="0">'
		, '&nbsp;<span style="font-weight:bold;">Orignal Author\'s Name:</span> ' , $author_name , '<br />' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">Original Author\'s Email:</span> ' , $author_user_email , '<br /><br />' , "\n"
		, '<span style="font-weight:bold; text-decoration:underline;">Enhanced Version Credits</span><br /><img src="../../images/arrow.gif" alt="" border="0">'
		, '&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' , $rws_author_name , '<br />' , "\n"
		, '<img src="../../images/arrow.gif" alt="" border="0">&nbsp;<span style="font-weight:bold;">Author\'s Email:</span> ' , $rws_author_user_email , '<br /><br />' , "\n"
		, '<div style="text-align:center;">[ <a href="' , $author_homepage , '" target="new">Original Author\'s HomePage</a> | <a href="' , $rws_author_homepage , '" target="new">Enhancement Author\'s HomePage</a>'
		, ' | <a href="javascript:void(0)" onclick="javascript:self.close()">Close Window</a> ]</div>' , "\n"
		, '</body>' , "\n"
		, '</html>';
}

show_copyright();

?>