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
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if (!defined('BLOCK_FILE')) {
	Header('Location: ../index.php');
	die();
}

global $cookie, $prefix, $multilingual, $currentlang, $db, $user, $userinfo;

$content = '';
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
}
if ($multilingual == 1) {
	$querylang = 'AND alanguage=\'' . $currentlang . '\'';
} else {
	$querylang = '';
}

$today = getdate();
$day = $today['mday'];
if ($day < 10) {
	$day = '0' . $day;
}
$month = $today['mon'];
if ($month < 10) {
	$month = '0' . $month;
}
$year = $today['year'];
$tdate = $year . '-' . $month . '-' . $day;
$sql = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE (time LIKE \'%' . $tdate . '%\') ' . $querylang . ' ORDER BY counter DESC LIMIT 0,1';
$query = $db->sql_query($sql);
$numrows = $db->sql_numrows($query);
if ($numrows == 0 AND $multilingual == 1) {
	$sql = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE (time LIKE \'%' . $tdate . '%\') ORDER BY counter DESC LIMIT 0,1';
	$query = $db->sql_query($sql);
}
list($sid, $title) = $db->sql_fetchrow($query);
$fsid = intval($sid);
$ftitle = check_html($title, 'nohtml');
if ((!$fsid) AND (!$ftitle)) {
	$content .= '<div class="text-center">' . _NOBIGSTORY . '</div>';
} else {
	$content .= '<div class="' . $ListClass . ' block-big_story_of_today"><ul class="rn-list">';
	$content .= '<li class="rn-list"><div class="small-caps">' . _BIGSTORY . '</div>';
	$content .= '<ul class="rn-ul"><li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $fsid . '">' . $ftitle . '</a></li></ul></li></ul></div>';
	// make sure content does not float outside the block  
	$content .= '<div class="block-spacer">&nbsp;</div>';
}
?>