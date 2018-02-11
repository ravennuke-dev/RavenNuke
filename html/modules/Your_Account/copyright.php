<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2013, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
$module_name = basename(dirname(__FILE__));
$mod_name = 'RN Your Account';
$author_email = '';
$author_homepage = 'http://www.ravenphpscripts.com';
$author_name = '<a href="http://rnwiki.ravennuke.com/wiki/RavenNuke2:Credits" target="_blank">RavenNuke Team</a>';
$license = 'GNU/GPL Copyright &copy; 2008-2013';
$download_location = '';
$module_version = '2.3.0';
$release_date = 'Aug 2008';
$module_description = '';
$mod_cost = '';
function show_copyright() {
	global $db, $ya_config, $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
	if (empty($mod_name)) {
		$mod_name = str_replace('_', ' ', $module_name);
	}
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
	echo '<html>';
	echo '<head>';
	echo '<title>' . $mod_name . ': Copyright Information</title>';
	echo '<style type="text/css">/*<![CDATA[*/';
	echo 'body {font-family:Verdana, Arial, Helvetica;font-size:10px;color:#363636;}';
	echo 'td {font-family:Verdana, Arial, Helvetica, geneva, sans-serif;font-size:10px;color:#000000;}';
	echo '/*]]>*/</style>';
	echo '</head>';
	echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000" style="margin:0;">';
	echo '<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>';
	echo '<td width="100%" align="center">';
	echo '<span style="font-weight:bold;">Module Copyright &copy; Information</span><br />';
	echo $mod_name . ' module for <a href="http://www.ravennuke.com" target="_blank">RavenNuke&trade;</a>';
	echo '</td></tr></table>';
	echo '<div style="text-align:center;">';
	echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;';
	echo '<a href="credits.html" title="Click To View The RN Your Account Credits Page" target="_blank">';
	echo '<span style="color:#E66C2C;font-weight:bold;">View RN Your Account Credits &amp; Contacts</span></a>&nbsp;';
	echo '<img src="images/arrow2.png" border="0" alt="" />';
	echo '</div>';
	echo '<hr />';
	echo '<table align="center" border="0" cellspacing="0" cellpadding="2" width="100%">';
	if ($mod_name != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module&#39;s Name:</span></td><td>' . $mod_name . '</td></tr>';
	}
	if ($module_version != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module&#39;s Version:</span></td><td>' . $module_version . '</td></tr>';
	}
	if ($release_date != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Release Date:</span></td><td>' . $release_date . '</td></tr>';
	}
	if ($mod_cost != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module&#39;s Cost:</span></td><td>' . $mod_cost . '</td></tr>';
	}
	if ($license != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span></td><td>' . $license . '</td></tr>';
	}
	if ($author_name != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author&#39;s Name:</span></td><td>' . $author_name . '</td></tr>';
	}
	if ($author_email != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author&#39;s Email:</span></td><td>' . $author_email . '</td></tr>';
	}
	if ($module_description != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module&#39;s Description:</span></td><td>' . $module_description . '</td></tr>';
	}
	if ($download_location != '') {
		echo '<tr><td nowrap="nowrap"><img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module&#39;s Download:</span></td><td><a href="' . $download_location . '" target="_blank">Download</a></td></tr>';
	}
	echo '</table>';
	echo '<hr />';
	echo '<div style="text-align:center;">[ <a href="javascript:void(0)" onclick=\'javascript:self.close()\'>Close Window</a> ]</div>';
	echo '</body>';
	echo '</html>';
}
show_copyright();
?>