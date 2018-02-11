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

global $prefix, $db;
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
}
$content = '';
$n = 1;
$sql = 'SELECT id, title FROM ' . $prefix . '_reviews ORDER BY id DESC LIMIT 0,10';
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);
	if ($numrows == 0) {
		$content = _BLOCKPROBLEM2;
	} else {
		$content .= '<div class="' . $ListClass . ' block-reviews"><ul class="rn-ul">
		';
	while (list($id, $title) = $db->sql_fetchrow($result)) {
		if ($n > 1 AND $n % 2){$column = ' li-odd';} else if ($n > 1) {$column = ' li-even';} else {$column = ' li-first';}
		$id = intval($id); // montego:0000763 - even this line is unnecessary because this field is ALWAYS an integer coming off the db!
	//	$title = stripslashes($title); // montego:0000763 - check_html was already done prior to adding to the DB and will end up stripping slashes again!
		$content .= '<li class="' . $column . '"><a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id=' . $id . '" title="' . $title . '">' . $title . '</a></li>
		';
		++$n;
	}
    $content .= '</ul></div>';
    // make sure content does not float outside the block  
    $content .= '<div class="block-spacer">&nbsp;</div>';
}
?>
