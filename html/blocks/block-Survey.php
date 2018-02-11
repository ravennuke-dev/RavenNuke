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

global $prefix, $multilingual, $currentlang, $db, $boxTitle, $content, $pollcomm;

if ($multilingual == 1) {
	$querylang = 'WHERE planguage=\''.$currentlang.'\' AND artid=\'0\'';
} else {
	$querylang = 'WHERE artid=\'0\'';
}

list($pollID) = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc '.$querylang.' ORDER BY pollID DESC LIMIT 1'));
$pollID = intval($pollID);
if ($multilingual == 1 AND ($pollID == 0 || empty($pollID))) {
	list($pollID) = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc WHERE artid=\'0\' ORDER BY pollID DESC LIMIT 1'));
	$pollID = intval($pollID);
}
if ($pollID == 0 || empty($pollID)) {
	$content = _BLOCKPROBLEM2;
} else {
	if (!isset($url)) {
		$url = 'modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID;
	}
	$content = '<form action="modules.php?name=Surveys" method="post">';
	$content .= '<input type="hidden" name="pollID" value="'.$pollID.'" />';
	$content .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
	list($pollTitle, $voters) = $db->sql_fetchrow($db->sql_query('SELECT pollTitle, voters FROM '.$prefix.'_poll_desc WHERE pollID=\''.$pollID.'\''));
	$pollTitle = check_html($pollTitle, 'nohtml');
	$voters = intval($voters);
	$boxTitle = _SURVEY;
	$content .= '<span class="content"><strong>'.$pollTitle.'</strong></span><br /><br />';
	$content .= '<table border="0" width="100%">';
	for($i = 1; $i <= 12; $i++) {
		$sql = 'SELECT pollID, optionText, optionCount, voteID FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'';
		$query = $db->sql_query($sql);
		list($pollID, $optionText, $optionCount, $voteID) = $db->sql_fetchrow($query);
		$pollID = intval($pollID);
		$voteID = intval($voteID);
		$optionCount = intval($optionCount);
		if (!empty($optionText)) {
			$content .= '<tr><td valign="top"><input type="radio" name="voteID" value="'.$i.'" /></td><td width="100%"><span class="content">'.$optionText.'</span></td></tr>';
		}
	}
	$content .= '</table><br /><div class="text-center"><span class="content"><input type="submit" value="'._VOTE.'" /></span><br />';
	$sum = 0;
	for($i = 0; $i < 12; $i++) {
		$sql = 'SELECT optionCount FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'';
		$query = $db->sql_query($sql);
		list($optionCount) = $db->sql_fetchrow($query);
		$optionCount = intval($optionCount);
		$sum = (int)$sum+$optionCount;
	}
	$content .= '<br /><span class="content"><a href="modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID.'"><strong>'
		._RESULTS.'</strong></a><br /><a href="modules.php?name=Surveys"><strong>'._POLLS.'</strong></a><br />';

	if ($pollcomm) {
		$sql = 'SELECT * FROM '.$prefix.'_pollcomments WHERE pollID=\''.$pollID.'\'';
		$query = $db->sql_query($sql);
		$numcom = $db->sql_numrows($query);
		$content .= '<br />'._VOTES.': <strong>'.intval($sum).'</strong> <br /> '._PCOMMENTS.' <strong>'.intval($numcom).'</strong>';
	} else {
		$content .= '<br />'._VOTES.' <strong>'.intval($sum).'</strong>';
	}
	$content .= '</span></div></form>';
}

?>