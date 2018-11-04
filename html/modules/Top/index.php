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
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}

global $prefix, $db, $nuke_config;

$top = $nuke_config['top'];
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include_once 'header.php';

if ($multilingual == 1) {
	$queryalang = 'WHERE (`alanguage`="' . $currentlang . '" OR `alanguage`="")'; /* top stories */
	$querya1lang = 'WHERE (`alanguage`="' . $currentlang . '" OR `alanguage`="") AND'; /* top stories */
	$queryslang = 'WHERE `slanguage`="' . $currentlang . '" '; /* top section articles */
	$queryplang = 'WHERE `planguage`="' . $currentlang . '" '; /* top polls */
	$queryrlang = 'WHERE `rlanguage`="' . $currentlang . '" '; /* top reviews */
} else {
	$queryalang = '';
	$querya1lang = 'WHERE';
	$queryslang = '';
	$queryplang = '';
	$queryrlang = '';
}

title(_TOPWELCOME . ' ' . $sitename . '!');
OpenTable();
echo '<div class="content">';

/* Top 10 read stories */
$result = $db->sql_query('SELECT `sid`, `title`, `counter` FROM `' . $prefix . '_stories` ' . $queryalang . ' ORDER BY `counter` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _READSTORIES , '</span><br /><br />';
	$lugar = 1;
	while (list($sid, $title, $counter) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($counter > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=News&amp;file=article&amp;sid=' , $sid , '">' , $title , '</a> - (' , $counter , ' ' , _READS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 most voted stories */
$result = $db->sql_query('SELECT `sid`, `title`, `ratings` FROM `' . $prefix . '_stories` ' . $querya1lang . ' `score`!="0" ORDER BY `ratings` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _MOSTVOTEDSTORIES , '</span><br /><br />';
	$lugar = 1;
	while (list($sid, $title, $ratings) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($ratings > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' . $lugar . ': <a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a> - (' . $ratings . ' ' . _LVOTES . ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 best rated stories */
$result = $db->sql_query('SELECT `sid`, `title`, `score`, `ratings` FROM `' . $prefix . '_stories` ' . $querya1lang . ' `score`!="0" ORDER BY ratings+score DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _BESTRATEDSTORIES , '</span><br /><br />';
	$lugar = 1;
	while (list($sid, $title, $score, $ratings) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($score > 0) {
			$rate = substr($score / $ratings, 0, 4);
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=News&amp;file=article&amp;sid=' , $sid, '">' , $title , '</a> - (' , $rate , ' ' , _POINTS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 commented stories */
if ($articlecomm == 1) {
	$result = $db->sql_query('SELECT `sid`, `title`, `comments` FROM `' . $prefix . '_stories` ' . $queryalang . ' ORDER BY `comments` DESC LIMIT 0,' . $top);
	if ($db->sql_numrows($result) > 0) {
		echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
			, '<span class="option thick">' , $top , ' ' , _COMMENTEDSTORIES , '</span><br /><br />';
		$lugar = 1;
		while (list($sid, $title, $comments) = $db->sql_fetchrow($result, SQL_NUM)) {
			if ($comments > 0) {
				echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=News&amp;file=article&amp;sid=' , $sid , '">' , $title , '</a> - (' , $comments , ' ' , _COMMENTS , ')<br />';
				$lugar++;
			}
		}
		echo '</td></tr></table><br />';
	}
}

/* Top 10 categories */
$result = $db->sql_query('SELECT `catid`, `title`, `counter` FROM `' . $prefix . '_stories_cat` ORDER BY `counter` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _ACTIVECAT , '</span><br /><br />';
	$lugar = 1;
	while (list($catid, $title, $counter) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($counter > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' , $catid , '">' , $title , '</a> - (' , $counter , ' ' , _HITS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 users submitters */
$result = $db->sql_query('SELECT `username`, `counter` FROM `' . $user_prefix . '_users` WHERE `counter` > "0" ORDER BY `counter` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _NEWSSUBMITTERS , '</span><br /><br />';
	$lugar = 1;
	while (list($uname, $counter) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($counter > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' , $uname , '">' , $uname , '</a> - (' , $counter , ' ' , _NEWSSENT , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 Polls */
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_poll_desc` ' . $queryplang);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _VOTEDPOLLS , '</span><br /><br />';
	$lugar = 1;
	$result = $db->sql_query('SELECT `pollID`, `pollTitle`, `timeStamp`, `voters` FROM `' . $prefix . '_poll_desc` ' . $queryplang . ' ORDER BY `voters` DESC LIMIT 0,' . $top);
	$counter = 0;
	while ($row = $db->sql_fetchrow($result, SQL_ASSOC)) {
		$resultArray[$counter] = array($row['pollID'], $row['pollTitle'], $row['timeStamp'], $row['voters']);
		$counter++;
	}
	for ($count = 0; $count < count($resultArray); $count++) {
		$id = $resultArray[$count][0];
		$pollTitle = $resultArray[$count][1];
		$voters = $resultArray[$count][3];
		$sum = '';
		for ($i = 0; $i < 12; $i++) {
			$result = $db->sql_query('SELECT `optionCount` FROM `' . $prefix . '_poll_data` WHERE (`pollID`="' . $id . '") AND (`voteID`="' . $i . '")');
			list($optionCount) = $db->sql_fetchrow($result, SQL_NUM);
			$sum = (int) $sum + $optionCount;
		}
		echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=Surveys&amp;pollID=' , $id , '">' , $pollTitle , '</a> - (' , $sum , ' ' , _LVOTES , ')<br />';
		$lugar++;
		$sum = 0;
	}
	echo '</td></tr></table><br />';
}

/* Top 10 authors */
$result = $db->sql_query('SELECT `aid`, `counter` FROM `' . $prefix . '_authors` ORDER BY `counter` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _MOSTACTIVEAUTHORS , '</span><br /><br />';
	$lugar = 1;
	while (list($aid, $counter) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($counter>0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=Search&amp;query=&amp;author=' , $aid , '">' , $aid , '</a> - (' , $counter , ' ' , _NEWSPUBLISHED , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 reviews */
$result = $db->sql_query('SELECT `id`, `title`, `hits` FROM `' . $prefix . '_reviews` ' . $queryrlang . ' ORDER BY `hits` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _READREVIEWS , '</span><br /><br />';
	$lugar = 1;
	while (list($id, $title, $hits) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($hits > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id=' , $id , '">' , $title , '</a> - (' , $hits , ' ' , _READS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table><br />';
}

/* Top 10 downloads */
$result = $db->sql_query('SELECT `lid`, `cid`, `title`, `hits` FROM `' . $prefix . '_nsngd_downloads` ORDER BY `hits` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _DOWNLOADEDFILES , '</span><br /><br />';
	$lugar = 1;
	while (list($lid, $cid, $title, $hits) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($hits > 0) {
			list($ctitle) = $db->sql_fetchrow($db->sql_query('SELECT `title` FROM `' . $prefix . '_nsngd_categories` WHERE `cid`="' . $cid . '"'));
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;', $lugar , ': <a href="modules.php?name=Downloads&amp;op=getit&amp;lid=' , $lid , '">' , $title , '</a> (' , _CATEGORY , ': ' , $ctitle , ') - (' , $hits , ' ' , _LDOWNLOADS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table>';
}

/* Top 10 Pages in Content */
$result = $db->sql_query('SELECT `pid`, `title`, `counter` FROM `' . $prefix . '_pages` WHERE `active`="1" ORDER BY `counter` DESC LIMIT 0,' . $top);
if ($db->sql_numrows($result) > 0) {
	echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
		, '<span class="option thick">' , $top , ' ' , _MOSTREADPAGES , '</span><br /><br />';
	$lugar = 1;
	while (list($pid, $title, $counter) = $db->sql_fetchrow($result, SQL_NUM)) {
		if($counter > 0) {
			echo '<strong><span class="larger">&middot;</span></strong>&nbsp;' , $lugar , ': <a href="modules.php?name=Content&amp;pa=showpage&amp;pid=' , $pid , '">' , $title , '</a> (' , $counter , ' ' , _READS , ')<br />';
			$lugar++;
		}
	}
	echo '</td></tr></table>';
}
echo '</div>';
CloseTable();
include_once 'footer.php';

?>