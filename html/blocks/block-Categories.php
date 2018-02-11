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

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $cat, $language, $prefix, $multilingual, $currentlang, $db, $name;

if(!isset($name)) $name = '';

if ($multilingual == 1) {
	$querylang = 'AND (`alanguage`=\'' . $currentlang . '\' OR `alanguage`=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
	$querylang = '';
}

if (!isset($side)) $side = '';
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
} else {
	$ListClass = 'ul-box';
}

$sql = 'SELECT `catid`, `title` FROM `' . $prefix . '_stories_cat` ORDER BY `title`';
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);
if ($numrows == 0) {
	$content = _BLOCKPROBLEM2;
} else {
	$boxstuff = '<div class="' . $ListClass . ' block-categories"><ul class="rn-ul">';
	$n = 1;
	$a = 0;
	while (list($catid, $title) = $db->sql_fetchrow($result)) {
		$catid = intval($catid);
		$title = stripslashes($title);
		$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_stories` WHERE `catid`=' . $catid . ' ' . $querylang . ' LIMIT 1'));
		$column = 'li-first';
		if ($numrows > 0) {
			if ($cat == 0 && !$a && $name == 'News') {
				$boxstuff .= '<li class="' . $column . '"><span class="thick" title="' . _ALLCATEGORIES . '">' . _ALLCATEGORIES . '</span></li>';
				$a = 1;
				++$n;
			} elseif (($cat != 0 && !$a) || ($name != 'News' && !$a)) {
				$boxstuff .= '<li class="' . $column . '"><a href="modules.php?name=News" title="' . _ALLCATEGORIES . '">' . _ALLCATEGORIES . '</a></li>';
				$a = 1;
				++$n;
			}
			if ($n > 1 && $n % 2) {
				$column = 'li-odd';
			} else if ($n > 1) {
				$column = 'li-even';
			} else {
				$column = 'li-first';
			}
			if ($cat == $catid && $name == 'News') {
				$boxstuff .= '<li class="' . $column . '"><span class="thick" title="' . $title . '">' . $title . '</span></li>';
				++$n;
			} else {
				$boxstuff .= '<li class="' . $column . '"><a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '" title="' . $title . '">' . $title . '</a></li>';
				++$n;
			}
		}
	}
	$boxstuff .= '</ul></div>';
	// make sure content does not float outside the block
	$boxstuff .= '<div class="block-spacer">&nbsp;</div>';
}

if ($n > 1) {
	$content = $boxstuff;
} else {
	$content = _BLOCKPROBLEM2;
}
?>