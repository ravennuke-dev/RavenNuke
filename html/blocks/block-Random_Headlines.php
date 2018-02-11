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
global $prefix, $multilingual, $currentlang, $db, $tipath, $cookie;

if ($multilingual == 1) {
	$querylang = 'AND alanguage=\'' . $currentlang . '\'';
} else {
	$querylang = '';
}

if (!isset($side)) { $side = ''; }

if ($side == 'c' || $side == 'd' || $side == 't') {
	$centermode = TRUE;
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$centermode = FALSE;
	$ListClass = 'ul-box';
}

$sql = 'SELECT topicid FROM ' . $prefix . '_topics';
$query = $db->sql_query($sql);
$numrows = $db->sql_numrows($query);
$topic_array = ''; // Fix notice issue - montego

if ($numrows > 1) {
	while (list($topicid) = $db->sql_fetchrow($query)) {
		$topicid = intval($topicid);
		$topic_array .= $topicid . '-';
	}
	$r_topic = explode('-', $topic_array);
	mt_srand((double)microtime() *1000000);
	$numrows = $numrows-1;
	$topic = mt_rand(0, $numrows);
	$topic = $r_topic[$topic];
} else {
	$topic = 1;
}

$sql2 = 'SELECT topicimage, topictext FROM ' . $prefix . '_topics WHERE topicid=\'' . $topic . '\'';
$query2 = $db->sql_query($sql2);
list($topicimage, $topictext) = $db->sql_fetchrow($query2);
$ThemeSel = get_theme();

if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/topics/' . $topicimage)) {
	$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
} else {
	$t_image = $tipath . $topicimage;
}

if ($centermode){
	$content = '<div class="' . $ListClass . ' block-random_headlines"><div class="text-center padtop-box"><a href="modules.php?name=News&amp;new_topic=' . $topic . '"><img src="' . $t_image . '" class="centered" alt="' . $topictext . '" title="' . $topictext . '" /></a></div><div class="padded-box thick text-center"><a href="modules.php?name=News&amp;new_topic=' . $topic . '">' . $topictext . '</a></div>';
} else {
	$content = '<div class="text-center padtop-box"><a href="modules.php?name=News&amp;new_topic=' . $topic . '"><img src="' . $t_image . '" class="centered" alt="' . $topictext . '" title="' . $topictext . '" /></a></div><div class="padded-box thick text-center"><a href="modules.php?name=News&amp;new_topic=' . $topic . '">' . $topictext . '</a></div><div class="' . $ListClass . ' block-random_headlines">';
}

$sql3 = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE topic=\'' . $topic . '\' ' . $querylang . ' ORDER BY sid DESC LIMIT 0,9';
$result3 = $db->sql_query($sql3);
$numrows = $db->sql_numrows($result3);

if (($numrows > 0 AND $numrows < 9) AND ($multilingual == 1)){
	$adjustment = 9 - $numrows;
} else {
	$adjustment = 0;
}

if ($numrows == 0 AND $multilingual == 1) {
	$sql3 = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE topic=\'' . $topic . '\' AND alanguage=\'\' ORDER BY sid DESC LIMIT 0,9';
	$result3 = $db->sql_query($sql3);
	$numrows = $db->sql_numrows($result3);
}

if ($numrows > 0) {
	$content .= '<ul class="rn-ul">
	';
	while (list($sid, $title) = $db->sql_fetchrow($result3)) {
		$content .= '<li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a></li>
		';
	}
	if ($adjustment > 0){
		$sql4 = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE topic=\'' . $topic . '\' AND alanguage=\'\' ORDER BY sid DESC LIMIT 0,' . $adjustment;
		$result4 = $db->sql_query($sql4);
		while (list($sid, $title) = $db->sql_fetchrow($result4)) {
			$content .= '<li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a></li>
			';
		}
	}
	$content .= '</ul>';
}
// make sure content does not float outside the block
$content .= '</div><div class="block-spacer">&nbsp;</div>';

?>