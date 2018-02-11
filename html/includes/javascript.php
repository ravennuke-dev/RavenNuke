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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

##################################################
# Include for some common javascripts functions  #
##################################################
addJSToHead('includes/rn.js', 'file');
/*
 * JS with variables or dynamic
 */
if ($userpage == 1) {
	$inlineJS = '<script type="text/javascript">'."\n";
	$inlineJS .= '<!--'."\n";
	$inlineJS .= 'function showimage() {'."\n";
	$inlineJS .= 'if (!document.images)'."\n";
	$inlineJS .= 'return'."\n";
	$inlineJS .= 'document.images.avatar.src='."\n";
	$inlineJS .= "'$nukeurl".'/modules/Forums/images/avatars/gallery/\' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= '//-->'."\n";
	$inlineJS .= '</script>'."\n\n";
	addJSToHead($inlineJS, 'inline');
}

global $name;

if (defined('MODULE_FILE') AND file_exists('modules/'.$name.'/copyright.php')) {
	$inlineJS = '<script type="text/javascript">'."\n";
	$inlineJS .= '<!--'."\n";
	$inlineJS .= 'function openwindow(){'."\n";
	$inlineJS .= '	window.open (\'modules/'.$name.'/copyright.php\',\'Copyright\',\'toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\');'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= '//-->'."\n";
	$inlineJS .= '</script>'."\n\n";
	addJSToHead($inlineJS, 'inline');
}

?>