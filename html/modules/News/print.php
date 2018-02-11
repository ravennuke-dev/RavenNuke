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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

if ( !defined('MODULE_FILE') ) {
	die('You can\'t access this file directly...');
}

require_once 'mainfile.php';

global $datetime, $db, $module_name, $nukeurl, $prefix, $sitename;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$ThemeSel = get_theme();
$printlogo = 'themes/' . $ThemeSel . '/images/logo.gif';
if (file_exists($printlogo)) {
$printheader = '<img src="themes/' . $ThemeSel . '/images/logo.gif" border="0" alt="' . $sitename . '" />';
}else{
$printheader = $sitename;
}
if(!isset($_REQUEST['sid'])) {
	exit();
} else {
	$sid = intval($_REQUEST['sid']);
}

list($title, $time, $hometext, $bodytext, $topic, $notes) = $db->sql_fetchrow($db->sql_query('SELECT `title`, `time`, `hometext`, `bodytext`, `topic`, `notes` FROM `' . $prefix . '_stories` WHERE `sid`=\'' . $sid . '\''), SQL_NUM);
list($topictext) = $db->sql_fetchrow($db->sql_query('SELECT `topictext` FROM `' . $prefix . '_topics` WHERE `topicid`=\'' . $topic . '\''), SQL_NUM);

formatTimestamp($time);
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' , "\n" , ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' , "\n"
	, '<html xmlns="http://www.w3.org/1999/xhtml">' , "\n"
	, '<head><title>' , $sitename , ' - ' , $title , '</title>'
	, '<meta http-equiv="Content-Type" content="text/html; charset=' , _CHARSET , '" />'
	, '<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />' , "\n" , '</head>'
	, '<body bgcolor="#ffffff" text="#000000">'
	, '<table border="0" align="center"><tr><td>'
	, '<table border="0" width="640" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td>'
	, '<table border="0" width="640" cellpadding="20" cellspacing="1" bgcolor="#ffffff"><tr><td>'
	, '<div style="text-align:center; margin:0 auto; width:100%;">'
	, $printheader , '<br /><br />'
	, '<span class="content" style="font-weight:bold;">'
	, $title , '</span><br />'
	, '<span class="tiny"><span style="font-weight:bold;">' , _PDATE , '</span> ' , $datetime , '<br /><span style="font-weight:bold;">' , _PTOPIC , '</span> ' , $topictext , '</span><br /><br />'
	, '</div>'
	, '<div class="content">'
	, $hometext , '<br /><br />'
	, $bodytext , '<br /><br />'
	, $notes , '<br /><br />'
	, '</div>'
	, '</td></tr></table></td></tr></table>'
	, '<br /><br /><div style="text-align:center; margin:0 auto; width:100%;">'
	, '<span class="content">'
	, _COMESFROM , ' ' , $sitename , '<br />'
	, '<a href="' , $nukeurl , '">' , $nukeurl , '</a><br /><br />'
	, _THEURL , '<br />'
	, '<a href="' , $nukeurl , '/modules.php?name=' , $module_name , '&amp;file=article&amp;sid=' , $sid , '">' , $nukeurl , '/modules.php?name=' , $module_name , '&amp;file=article&amp;sid=' , $sid , '</a>'
	, '</span></div>'
	, '</td></tr></table>'
	, '</body>'
	, '</html>';
die();

?>
