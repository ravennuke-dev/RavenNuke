<?php
/************************************************************************/
/* Better Topics module                                                 */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/*This file is an edit of the original Topics module from PHP-Nuke 6.5  */
/*I think it looks better and I wanted to release it to everyone        */
/*                                                                      */
/*The edits in the module were made by VJ Demsky and Gaylen Fraley      */
/************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- ' . _ACTIVETOPICS;
include_once 'header.php';
title(_ACTIVETOPICS);
echo '<div class="content">';
OpenTable();
$sql = 'SELECT topicid, topicname, topicimage, topictext FROM ' . $prefix . '_topics ORDER BY topictext';
$result = $db->sql_query($sql);
if ($db->sql_numrows($result) > 0) {
	echo '<div class="text-center"><p class="thick">' . _CLICK2LIST . '</p>'
		. '<form action="modules.php?name=Search" method="post">'
		. '<input type="text" name="query" size="30" />&nbsp;&nbsp;'
		. '<input type="submit" value="' . _SEARCH . '" />'
		. '</form></div>';
	while ($row = $db->sql_fetchrow($result)) {
		$topicid = intval($row['topicid']);
		$topicname = stripslashes($row['topicname']);
		$topicimage = stripslashes($row['topicimage']);
		$topictext = stripslashes(check_html($row['topictext'], 'nohtml'));
		$ThemeSel = get_theme();
		if (file_exists('themes/' . $ThemeSel . '/images/topics/' . $topicimage)) {
			$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
		} else {
			$t_image = $tipath . $topicimage;
		}
		$sql = 'SELECT counter FROM ' . $prefix . '_stories WHERE topic=\'' . $topicid . '\'';
		$res = $db->sql_query($sql);
		$numrows = $db->sql_numrows($res);
		$reads = 0;
		while ($counting = $db->sql_fetchrow($res)) {
			$reads = $reads+$counting['counter'];
		}
		//The following code has modifications for the bettertopics module!
		OpenTable();
		echo '<table border="0" width="100%" align="center" cellpadding="2">'
			. '<tr><td valign="top"><a href="modules.php?name=News&amp;new_topic=' . $topicid . '">'
			. '<img src="' . $t_image . '" border="0" alt="' . $topictext . '" title="' . $topictext . '" />'
			. '</a></td><td valign="top" width="100%">'
			. '<div class="text-center"><p><span class="title"><a href="modules.php?name=News&amp;new_topic=' . $topicid . '">' . $topictext . '</a></span>&nbsp;'
			. '<span class="larger"><strong>&middot;</strong></span>&nbsp;<span class="thick">' . _TOTNEWS . ':</span> ' . $numrows . '&nbsp;'
			. '<span class="larger"><strong>&middot;</strong></span>&nbsp;<span class="thick">' . _TOTREADS . ':</span> ' . $reads . '</p></div>'
			. '</td></tr>'
			. '</table>';
		echo '<table border="0" width="100%" align="center" cellpadding="2">'
			. '<tr><td valign="top" align="left">'
			. '<p class="thick">' . _TOPICS_ARTICLES . '</p><p>';
		$sql = 'SELECT sid, catid, title, informant FROM ' . $prefix . '_stories WHERE topic=\'' . $topicid . '\' ORDER BY sid DESC LIMIT 0,10';
		$result2 = $db->sql_query($sql);
		$num = $db->sql_numrows($result2);
		if ($num != 0) {
			while ($row2 = $db->sql_fetchrow($result2)) {
				$sid = intval($row2['sid']);
				$catid = intval($row2['catid']);
				$title = stripslashes(check_html($row2['title'], 'nohtml'));
				$informant = stripslashes(check_html($row2['informant'], 'nohtml'));
				if ($catid == 0) {
					$cat_link = '';
				} else {
					$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_stories_cat WHERE catid=\'' . $catid . '\''));
					$rtitle = stripslashes(check_html($row3['title'], 'nohtml'));
					$cat_link = '<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '"><span class="thick">' . $rtitle . '</span></a>: ';
				}
				echo '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">'
					. '<img src="modules/' . $module_name . '/images/article.gif" border="0" alt="' . _TOPICS_READTHISART . '" title="' . _TOPICS_READTHISART . '" /></a>'
					. '<a href="modules.php?name=News&amp;file=print&amp;sid=' . $sid . '">'
					. '<img src="modules/' . $module_name . '/images/print.gif" border="0" alt="' . _TOPICS_PRINTERREADY . '" title="' . _TOPICS_PRINTERREADY . '" /></a>'
					. '<a href="modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=' . $sid . '">'
					. '<img src="modules/' . $module_name . '/images/email.gif" border="0" alt="' . _TOPICS_EMAILFRIEND . '" title="' . _TOPICS_EMAILFRIEND . '" /></a>'
					. '&nbsp;&nbsp;' . $cat_link . '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . $title . '</a> (' . $informant . ')<br />';
			}
			if ($num == 10) {
				echo '<span class="larger"><strong>&middot;</strong></span>&nbsp;<a href="modules.php?name=News&amp;new_topic=' . $topicid . '"><span class="thick">' . _MORE . ' --&gt;</span></a>';
			}
		} else {
			echo '<span class="italic">' . _NONEWSYET . '</span>';
		}
		echo '</p></td><td width="50%" valign="top">';
		//This code prints out the preview of the most recent article
		if ($num >= 1) {
			$sql2 = 'SELECT sid, catid, title, hometext, time, informant  FROM ' . $prefix . '_stories WHERE topic=\'' . $topicid . '\' ORDER BY sid DESC LIMIT 0,1';
			$result2 = $db->sql_query($sql2);
			$row2 = $db->sql_fetchrow($result2);
			$s_sid = $row2['sid'];
			$title = $row2['title'];
			$hometext = $row2['hometext'];
			$date = $row2['time'];
			$informant = $row2['informant'];
			echo '<div class="text-center"><p class="thick">' . _TOPICS_MOSTRECENTART . '</p></div>';
			echo '<p><span class="thick"><a href="modules.php?name=News&amp;file=article&amp;sid=' . $s_sid . '">' . $title . '</a></span><br />' . _TOPICS_BY . ' '
				. '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $informant . '">' . $informant . '</a><br />' . $date
				. '</p><div>' . $hometext . '</div>'
				. '<p align="right"><a href="modules.php?name=News&amp;file=article&amp;sid=' . $s_sid . '">' . _TOPICS_READMORE . '</a></p>';
		}
		echo '</td></tr></table>';
		CloseTable();
	}
}
CloseTable();
echo '</div>';
include_once 'footer.php';
?>