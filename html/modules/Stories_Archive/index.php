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
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$sa = isset($sa) ? $sa : '';
$min = isset($min) ? intval($min) : 0;
$year = isset($year) ? intval($year) : 0;
$month = isset($month) ? intval($month) : 0;
$month_l = isset($month_l) ? FixQuotes($month_l) : '';
switch ($sa) {
	case 'show_all':
		show_all($min);
		break;
	case 'show_month':
		show_month($year, $month, $month_l);
		break;
	default:
		select_month();
		break;
}
die();
//Only functions below this line
function select_month() {
	global $prefix, $user_prefix, $db, $module_name;
	include_once 'header.php';
	title(_STORIESARCHIVE);
	OpenTable();
	$result = $db->sql_query('SELECT time FROM ' . $prefix . '_stories ORDER BY time DESC');
  // Mantis 1784 - end tag for UI not finished
  if ($db->sql_numrows($result) > 0) {
		echo '<div class="text-center title">' , _SELECTMONTH2VIEW , '<br /><br /></div><br /><br />';
		echo '<ul>';
		$thismonth = '';
		while (list($time) = $db->sql_fetchrow($result)) {
			preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $time, $getdate);
			if ($getdate[2] == '01') {
				$month = _JANUARY;
			} elseif ($getdate[2] == '02') {
				$month = _FEBRUARY;
			} elseif ($getdate[2] == '03') {
				$month = _MARCH;
			} elseif ($getdate[2] == '04') {
				$month = _APRIL;
			} elseif ($getdate[2] == '05') {
				$month = _MAY;
			} elseif ($getdate[2] == '06') {
				$month = _JUNE;
			} elseif ($getdate[2] == '07') {
				$month = _JULY;
			} elseif ($getdate[2] == '08') {
				$month = _AUGUST;
			} elseif ($getdate[2] == '09') {
				$month = _SEPTEMBER;
			} elseif ($getdate[2] == '10') {
				$month = _OCTOBER;
			} elseif ($getdate[2] == '11') {
				$month = _NOVEMBER;
			} elseif ($getdate[2] == '12') {
				$month = _DECEMBER;
			}
			if ($month != $thismonth) {
				$year = $getdate[1];
				echo '<li><a href="modules.php?name=' . $module_name . '&amp;sa=show_month&amp;year=' . $year . '&amp;month=' . $getdate[2] . '&amp;month_l=' . $month . '">' . $month . ', ' . $year . '</a></li>';
				$thismonth = $month;
			}
		}
		echo '</ul>'
			. '<br /><br /><br /><div class="text-center">'
			. '<form action="modules.php?name=Search" method="post">'
			. '<input type="text" name="query" size="30" />&nbsp;'
			. '<input type="submit" value="' . _SEARCH . '" />'
			. '</form><br /><br />'
			. '[ <a href="modules.php?name=' . $module_name . '&amp;sa=show_all">' . _SHOWALLSTORIES . '</a> ]</div>';
  }
	CloseTable();
	include_once 'footer.php';
}
function show_month($year, $month, $month_l) {
	global $userinfo, $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $articlecomm;
	$year = intval($year);
	$month = htmlentities($month);
	$month_l = htmlentities($month_l);
	include_once 'header.php';
	title(_STORIESARCHIVE);
	title($sitename . ': ' . $month_l . ' ' . $year);
	OpenTable();
	echo '<table border="0" width="100%"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="left"><span class="thick">' . _ARTICLES . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _COMMENTS . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _READS . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _USCORE . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _DATE . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _ACTIONS . '</span></td></tr>';
    $result = $db->sql_query('SELECT sid, catid, title, time, comments, counter, topic, alanguage, score, ratings from '.$prefix.'_stories WHERE time >= \''.$year.'-'.$month.'-01 00:00:00\' AND time <= \''.$year.'-'.$month.'-31 23:59:59\' order by sid DESC');
	while ($row = $db->sql_fetchrow($result)) {
		$sid = intval($row['sid']);
		$catid = intval($row['catid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$time = $row['time'];
		$comments = stripslashes($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$alanguage = $row['alanguage'];
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		$time = explode(' ', $time);
		$actions = '<a href="modules.php?name=News&amp;file=print&amp;sid=' . $sid . '"><img src="images/print.gif" border="0" alt="' . _PRINTER . '" title="' . _PRINTER . '" width="16" height="11" /></a>&nbsp;<a href="modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=' . $sid . '"><img src="images/friend.gif" border="0" alt="' . _FRIEND . '" title="' . _FRIEND . '" width="16" height="11" /></a>';
		if ($score != 0) {
			$rated = substr($score/$ratings, 0, 4);
		} else {
			$rated = 0;
		}
		if ($catid == 0) {
			$title = '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a>';
		} elseif ($catid != 0) {
			$row_res = $db->sql_fetchrow($db->sql_query('SELECT title from ' . $prefix . '_stories_cat where catid=\'' . $catid . '\''));
			$cat_title = $row_res['title'];
			$title = '<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '"><span class="italic">' . $cat_title . '</span></a>: <a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a>';
		}
		if ($multilingual == 1) {
			if (empty($alanguage)) {
				$alanguage = $language;
			}
			$alt_language = ucfirst($alanguage);
			$lang_img = '<img src="images/language/flag-' . $alanguage . '.png" border="0" hspace="2" alt="' . $alt_language . '" title="' . $alt_language . '" />';
		} else {
			$lang_img = '<strong><span class="larger"><span class="thick">&middot;</span></span></strong>';
		}
		if ($articlecomm == 0) {
			$comments = 0;
		}
		echo '<tr>'
			. '<td bgcolor="' . $bgcolor1 . '" align="left">' . $lang_img . ' ' . $title . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $comments . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $counter . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $rated . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $time[0] . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $actions . '</td></tr>';
	}
	echo '</table>';
	$result2 = $db->sql_query('SELECT time from ' . $prefix . '_stories order by time DESC');
  // Mantis 1784 - end tag for UI not finished
  if ($db->sql_numrows($result2) > 0) {
		echo '<br /><br /><br /><hr size="1" noshade="noshade" />'
			, '<span class="content thick">' , _SELECTMONTH2VIEW , '</span><br />'
			, '<ul>';
		$thismonth = '';
		while ($row2 = $db->sql_fetchrow($result2)) {
			$time = $row2['time'];
			preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $time, $getdate);
			if ($getdate[2] == '01') {
				$month = _JANUARY;
			} elseif ($getdate[2] == '02') {
				$month = _FEBRUARY;
			} elseif ($getdate[2] == '03') {
				$month = _MARCH;
			} elseif ($getdate[2] == '04') {
				$month = _APRIL;
			} elseif ($getdate[2] == '05') {
				$month = _MAY;
			} elseif ($getdate[2] == '06') {
				$month = _JUNE;
			} elseif ($getdate[2] == '07') {
				$month = _JULY;
			} elseif ($getdate[2] == '08') {
				$month = _AUGUST;
			} elseif ($getdate[2] == '09') {
				$month = _SEPTEMBER;
			} elseif ($getdate[2] == '10') {
				$month = _OCTOBER;
			} elseif ($getdate[2] == '11') {
				$month = _NOVEMBER;
			} elseif ($getdate[2] == '12') {
				$month = _DECEMBER;
			}
			if ($month != $thismonth) {
				$year = $getdate[1];
				echo '<li><a href="modules.php?name=' . $module_name . '&amp;sa=show_month&amp;year=' . $year . '&amp;month=' . $getdate[2] . '&amp;month_l=' . $month . '">' . $month . ', ' . $year . '</a></li>';
				$thismonth = $month;
			}
		}
		echo '</ul><br /><br /><div class="text-center">'
			. '<form action="modules.php?name=Search" method="post">'
			. '<input type="text" name="query" size="30" />&nbsp;'
			. '<input type="submit" value="' . _SEARCH . '" />'
			. '</form>'
			. '[ <a href="modules.php?name=' . $module_name . '">' . _ARCHIVESINDEX . '</a> | <a href="modules.php?name=' . $module_name . '&amp;sa=show_all">' . _SHOWALLSTORIES . '</a> ]</div>';
	}
	CloseTable();
	include_once 'footer.php';
}
function show_all($min) {
	global $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $userinfo;
	if (!isset($min) || intval($min) <= 0) {
		$min = 0;
	} else {
		$min = intval($min);
	}
	$max = 250;
	include_once 'header.php';
	title(_STORIESARCHIVE);
	title($sitename . ': ' . _ALLSTORIESARCH);
	OpenTable();
	echo '<table border="0" width="100%"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="left"><span class="thick">' . _ARTICLES . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _COMMENTS . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _READS . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _USCORE . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _DATE . '</span></td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center"><span class="thick">' . _ACTIONS . '</span></td></tr>';
	$result = $db->sql_query('SELECT sid, catid, title, time, comments, counter, topic, alanguage, score, ratings from ' . $prefix . '_stories order by sid DESC limit ' . $min . ',' . $max);
	$numrows = $db->sql_numrows($db->sql_query('select * from ' . $prefix . '_stories'));
	while ($row = $db->sql_fetchrow($result)) {
		$sid = intval($row['sid']);
		$catid = intval($row['catid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$time = $row['time'];
		$comments = stripslashes($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$alanguage = $row['alanguage'];
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		$time = explode(' ', $time);
		$actions = '<a href="modules.php?name=News&amp;file=print&amp;sid=' . $sid . '"><img src="images/print.gif" border="0" alt="' . _PRINTER . '" title="' . _PRINTER . '" width="15" height="11" /></a>&nbsp;<a href="modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=' . $sid . '"><img src="images/friend.gif" border="0" alt="' . _FRIEND . '" title="' . _FRIEND . '" width="15" height="11" /></a>';
		if ($score != 0) {
			$rated = substr($score/$ratings, 0, 4);
		} else {
			$rated = 0;
		}
		if ($catid == 0) {
			$title = '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a>';
		} elseif ($catid != 0) {
			$row_res = $db->sql_fetchrow($db->sql_query('SELECT title from ' . $prefix . '_stories_cat where catid=\'' . $catid . '\''));
			$cat_title = stripslashes($row_res['title']);
			$title = '<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '"><span class="italic">' . $cat_title . '</span></a>: <a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a>';
		}
		if ($multilingual == 1) {
			if (empty($alanguage)) {
				$alanguage = $language;
			}
			$alt_language = ucfirst($alanguage);
			$lang_img = '<img src="images/language/flag-' . $alanguage . '.png" border="0" hspace="2" alt="' . $alt_language . '" title="' . $alt_language . '" />';
		} else {
			$lang_img = '<strong><span class="larger"><span class="thick">&middot;</span></span></strong>';
		}
		echo '<tr>'
			. '<td bgcolor="' . $bgcolor1 . '" align="left">' . $lang_img . ' ' . $title . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $comments . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $counter . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $rated . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $time[0] . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $actions . '</td></tr>';
	}
	echo '</table>'
		. '<br /><br /><br />';
	$a = 0;
	if (($numrows > $max) AND ($min == 0)) {
		$min = $min+$max;
		$a++;
		echo '<div class="text-center">[ <a href="modules.php?name=' . $module_name . '&amp;sa=show_all&amp;min=' . $min . '">' . _NEXTPAGE . '</a> ]</div><br />';
	}
	if (($numrows > $max) AND ($min < $numrows-$max) AND ($a == 0)) {
		$pmin = $min-$max;
		$min = $min+$max;
		$a++;
		echo '<div class="text-center">[ <a href="modules.php?name=' . $module_name . '&amp;sa=show_all&amp;min=' . $pmin . '">' . _PREVIOUSPAGE . '</a> | <a href="modules.php?name=' . $module_name . '&amp;sa=show_all&amp;min=' . $min . '">' . _NEXTPAGE . '</a> ]</div><br />';
	}
	if (($numrows > $max) AND ($a == 0) AND ($min != 0)) {
		$pmin = $min-$max;
		echo '<div class="text-center">[ <a href="modules.php?name=' . $module_name . '&amp;sa=show_all&amp;min=' . $pmin . '">' . _PREVIOUSPAGE . '</a> ]</div><br />';
	}
	echo '<hr size="1" noshade="noshade" />'
		, '<span class="content thick">' , _SELECTMONTH2VIEW , '</span><br />';
	$result2 = $db->sql_query('SELECT time from ' . $prefix . '_stories order by time DESC');
  // Mantis 1784 - end tag for UI not finished
  if ($db->sql_numrows($result2) > 0) {
		echo '<ul>';
		$thismonth = '';
		while ($row2 = $db->sql_fetchrow($result2)) {
			$time = $row2['time'];
			preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $time, $getdate);
			if ($getdate[2] == '01') {
				$month = _JANUARY;
			} elseif ($getdate[2] == '02') {
				$month = _FEBRUARY;
			} elseif ($getdate[2] == '03') {
				$month = _MARCH;
			} elseif ($getdate[2] == '04') {
				$month = _APRIL;
			} elseif ($getdate[2] == '05') {
				$month = _MAY;
			} elseif ($getdate[2] == '06') {
				$month = _JUNE;
			} elseif ($getdate[2] == '07') {
				$month = _JULY;
			} elseif ($getdate[2] == '08') {
				$month = _AUGUST;
			} elseif ($getdate[2] == '09') {
				$month = _SEPTEMBER;
			} elseif ($getdate[2] == '10') {
				$month = _OCTOBER;
			} elseif ($getdate[2] == '11') {
				$month = _NOVEMBER;
			} elseif ($getdate[2] == '12') {
				$month = _DECEMBER;
			}
			if ($month != $thismonth) {
				$year = $getdate[1];
				echo '<li><a href="modules.php?name=' . $module_name . '&amp;sa=show_month&amp;year=' . $year . '&amp;month=' . $getdate[2] . '&amp;month_l=' . $month . '">' . $month . ', ' . $year . '</a></li>';
				$thismonth = $month;
			}
		}
		echo '</ul><br /><br /><div class="text-center">'
			. '<form action="modules.php?name=Search" method="post">'
			. '<input type="text" name="query" size="30" />&nbsp;'
			. '<input type="submit" value="' . _SEARCH . '" />'
			. '</form>'
			. '[ <a href="modules.php?name=' . $module_name . '">' . _ARCHIVESINDEX . '</a> ]</div>';
	}
	CloseTable();
	include_once 'footer.php';
}
?>