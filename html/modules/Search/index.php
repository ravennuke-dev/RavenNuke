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

if ( !defined('MODULE_FILE') ) {
	header('Location: ../../index.php');
	die ();
}

global $admin, $admin_file, $anonymous, $articlecomm, $currentlang, $db, $module_name, $multilingual, $prefix, $tipath;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$ThemeSel = get_theme();

$author = (isset($_REQUEST['author'])) ? check_html($_REQUEST['author'], 'nohtml') : '';
$category = (isset($_REQUEST['category'])) ? intval($_REQUEST['category']) : 0;
$days = (isset($_REQUEST['days'])) ? intval($_REQUEST['days']) : 0;
$query = (isset($_REQUEST['query'])) ? htmlentities(check_html($_REQUEST['query'], 'nohtml'), ENT_QUOTES) : '';
$sid = (isset($_REQUEST['sid'])) ? intval($_REQUEST['sid']) : 0;
$topic = (isset($_REQUEST['topic'])) ? intval($_REQUEST['topic']) : 0;
$type = (isset($_REQUEST['type'])) ? $_REQUEST['type'] : '';

$offset = 10;
$min = (isset($_REQUEST['min'])) ? intval($_REQUEST['min']) : 0;
$max = (isset($_REQUEST['max'])) ? intval($_REQUEST['max']) : $min + $offset;

if ($multilingual == 1) {
	$queryalang = 'AND (s.alanguage=\'' . $currentlang . '\' OR s.alanguage=\'\')'; /* stories */
	$queryrlang = 'AND rlanguage=\'' . $currentlang . '\' '; /* reviews */
} else {
	$queryalang = $queryrlang = '';
}

$pagetitle = '- ' . _SEARCH;
include_once 'header.php';
if ($topic > 0) {
	list($topicimage, $topictext) = $db->sql_fetchrow($db->sql_query('SELECT `topicimage`, `topictext` FROM `' . $prefix . '_topics` WHERE `topicid`=\'' . $topic . '\''));
	if (file_exists('themes/' . $ThemeSel . '/images/topics/' . $topicimage)) {
		$topicimage = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
	} else {
		$topicimage = $tipath . $topicimage;
	}
	if (file_exists('themes/' . $ThemeSel . '/images/topics/AllTopics.gif')) {
		$alltop = 'themes/' . $ThemeSel . '/images/topics/AllTopics.gif';
	} else {
		$alltop = $tipath . 'AllTopics.gif';
	}
} else {
	$topictext = _ALLTOPICS;
	if (file_exists('themes/' . $ThemeSel . '/images/topics/AllTopics.gif')) {
		$alltop = $topicimage = 'themes/' . $ThemeSel . '/images/topics/AllTopics.gif';
	} else {
		$alltop = $topicimage = $tipath . 'AllTopics.gif';
	}
}

OpenTable();

$instory = '';
if ($type == 'users') {
	$search_type = _SEARCHUSERS;
} elseif ($type == 'reviews') {
	$search_type = _SEARCHREVIEWS;
} elseif ($type == 'comments') {
	list($st_title) = $db->sql_fetchrow($db->sql_query('SELECT `title` FROM `' . $prefix . '_stories` WHERE `sid`=\'' . $sid . '\''));
	if (!empty($sid)) $instory = ' AND sid=\'' . $sid . '\'';
	$search_type = _SEARCHINSTORY . ' ' . htmlentities($st_title, ENT_QUOTES);
} else {
	$search_type = _SEARCHIN . ' ' . $topictext;
}
echo '<div class="title text-center thick">' . $search_type . '</div><br />'
	. '<table><tr><td>';
if (($type == 'users') || ($type == 'reviews')) {
	$image = $alltop;
} else {
	$image = $topicimage;
}
echo '<img class="float-right" src="' . $image . '" alt="' . $topictext . '" />'
	. '<form action="modules.php?name=' . $module_name . '" method="post">'
	. '<input size="25" type="text" name="query" value="' . $query . '" />&nbsp;&nbsp;'
	. '<input type="submit" value="' . _SEARCH . '" /><br /><br />';
if (!empty($sid)) {
	echo '<input type="hidden" name="sid" value="' . $sid . '" />';
}

echo '<!-- Topic Selection -->';
$content = '';
$result = $db->sql_query('SELECT `topicid`, `topictext` FROM `' . $prefix . '_topics` ORDER BY `topictext`');
while($row = $db->sql_fetchrow($result)) {
	if ($row['topicid'] == $topic) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	$content .= '<option' . $sel . ' value="' . $row['topicid'] . '">' . $row['topictext'] . '</option>';
}
echo '<select name="topic">'
	. '<option value="">' . _ALLTOPICS . '</option>'
	. $content
	. '</select>';

/* Category Selection */
$content = '';
$result = $db->sql_query('SELECT `catid`, `title` FROM `' . $prefix . '_stories_cat` ORDER BY `title`');
while ($row = $db->sql_fetchrow($result)) {
	if ($row['catid'] == $category) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	$content .= '<option' . $sel . ' value="' . $row['catid'] . '">' . $row['title'] . '</option>';
}
echo '&nbsp;<select name="category">'
	. '<option value="0">' . _ARTICLES . '</option>'
	. $content
	. '</select>';

/* Authors Selection */
$content = '';
$result = $db->sql_query('SELECT `aid` FROM `' . $prefix . '_authors` ORDER BY `aid`');
while($row = $db->sql_fetchrow($result)) {
	if ($row['aid'] == $author) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	$content .= '<option' . $sel . ' value="' . $row['aid'] . '">' . $row['aid'] . '</option>';
}
echo '&nbsp;<select name="author">'
	. '<option value="">' . _ALLAUTHORS . '</option>'
	. $content
	. '</select>';

/* Date Selection */
echo '&nbsp;<select name="days">';
$field = array(_ALL => 0, '1' . _WEEK => 7, '2' . _WEEKS => 14, '1' . _MONTH => 30, '2' . _MONTHS => 60, '3' . _MONTHS => 90);
foreach ($field as $key => $value) {
	($days == $value) ? $sel = ' selected="selected"' : $sel = '';
	echo '<option' . $sel . ' value="' . $value . '">' . $key . '</option>';
}
echo '</select><br />';

$sel1 = $sel2 = $sel3 = $sel4 = '';
if (($type == 'stories') || (empty($type))) {
	$sel1 = ' checked="checked"';
} elseif ($type == 'comments') {
	$sel2 = ' checked="checked"';
} elseif ($type == 'users') {
	$sel3 = ' checked="checked"';
} elseif ($type == 'reviews') {
	$sel4 = ' checked="checked"';
}
echo _SEARCHON
	. '<input type="radio" name="type" value="stories"' . $sel1 . ' /> ' . _SSTORIES;
if ($articlecomm == 1) {
	echo '<input type="radio" name="type" value="comments"' . $sel2 . ' /> ' . _SCOMMENTS;
}
echo '<input type="radio" name="type" value="users"' . $sel3 . ' /> ' . _SUSERS;
$num_rev = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_reviews`'));
if ($num_rev > 0) {
	echo '<input type="radio" name="type" value="reviews"' . $sel4 . ' /> ' . _REVIEWS;
}
echo '</form></td></tr></table>';

$offplus1 = $offset + 1;
if ($type == 'stories' || !$type) {
	if ($category > 0) {
		$categ = 'AND catid=\'' . $category . '\' ';
	} else {
		$categ = '';
	}
	$sql = 'SELECT s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, a.url, s.comments, s.topic FROM `' . $prefix . '_stories` s, `' . $prefix . '_authors` a '
		. 'WHERE s.aid=a.aid ' . $queryalang . ' ' . $categ;
	if (isset($query)) {
		$sql .= 'AND (s.title LIKE \'%' . addslashes($query) . '%\' OR s.hometext LIKE \'%' . addslashes($query) . '%\' OR s.bodytext LIKE \'%' . addslashes($query) . '%\''
			. ' OR s.notes LIKE \'%' . addslashes($query) . '%\') ';
	}
	if (!empty($author)) {
		$sql .= 'AND s.aid=\'' . addslashes($author) . '\' ';
	}
	if (!empty($topic)) {
		$sql .= 'AND s.topic=\'' . $topic . '\' ';
	}
	if (!empty($days)) {
		$sql .= 'AND TO_DAYS(NOW()) - TO_DAYS(time) <= \'' . $days . '\' ';
	}
	$sql .= ' ORDER BY s.time DESC LIMIT ' . $min . ',' . $offplus1;
	$result = $db->sql_query($sql);
	$nrows = $db->sql_numrows($result);
	$x = 0;
	if (!empty($query)) {
		echo '<br /><hr />'
			. '<div class="text-center thick">' . _SEARCHRESULTS . '</div><br /><br />'
			. '<table>';
		if ($nrows > 0) {
			$match = '';
			while($row = $db->sql_fetchrow($result) and $x < $offset) {
				$datetime = formatTimestamp($row['time']);
				$furl = 'modules.php?name=News&amp;file=article&amp;sid=' . $row['sid'];
				$informant = (!empty($row['informant'])) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . urlencode($row['informant']) . '">' . $row['informant'] . '</a>' : $anonymous;
				$url = (!empty($row['url'])) ? '<a href="' . $row['url'] . '">' . $row['aid'] . '</a>' : $row['aid'];
				list($topictext) = $db->sql_fetchrow($db->sql_query('SELECT `topictext` FROM `' . $prefix . '_topics` WHERE `topicid`=\'' . $row['topic'] . '\''));
				if (!empty($query) && $query != '*') {
					if (preg_match('/' . quotemeta($query) . '/i', $row['title'])) {
						$match = _MATCHTITLE;
					}
					$text = $row['hometext'] . $row['bodytext'];
					if (preg_match('/' . quotemeta($query) . '/i', $text)) {
						if (!empty($match)) {
							$match = _MATCHBOTH;
						} else  {
							$match = _MATCHTEXT;
						}
					}
					if (!empty($match)) $match = $match . '<br />';
				}

				echo '<tr><td><img src="images/folders.gif" alt="" />&nbsp;<span class="option thick"><a href="' . $furl . '">' . htmlentities($row['title'], ENT_QUOTES) . '</a></span><br />'
					. '<div class="content">' . _CONTRIBUTEDBY . ' ' . $informant . '<br />' . _POSTEDBY . ' ' . $url
					. ' ' . _ON . ' ' . $datetime . '<br />' . $match . _TOPIC . ': <a href="modules.php?name=' . $module_name . '&amp;query=&amp;topic=' . urlencode($row['topic']) . '">' . $topictext . '</a> ';
				if ($row['comments'] == 0) {
					echo '(' . _NOCOMMENTS . ')';
				} elseif ($row['comments'] == 1) {
					echo '(' . $row['comments'] . ' ' . _UCOMMENT . ')';
				} elseif ($row['comments'] > 1) {
					echo '(' . $row['comments'] . ' ' . _UCOMMENTS . ')';
				}
				if (is_admin($admin)) {
					echo ' [ <a href="' . $admin_file . '.php?op=EditStory&amp;sid=' . $row['sid'] . '">' . _EDIT . '</a> | <a href="' . $admin_file . '.php?op=RemoveStory&amp;sid=' . $row['sid'] . '">' . _DELETE . '</a> ]';
				}
				echo '</div><br /><br /><br /></td></tr>';
				$x++;
			}

			echo '</table>';
		} else {
			echo '<tr><td><div class="option text-center thick">' . _NOMATCHES . '</div><br /><br />'
				. '</td></tr></table>';
		}

		if (!empty($topic)) {
			$topicid = $row['topic'];
		} else {
			$topicid = 0;
		}
		$prev = $min - $offset;
		if ($prev >= 0) {
			echo '<br /><br /><div class="text-center"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . urldecode($topicid) . '&amp;min=' . $prev . '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '&amp;category=' . $category . '">';
			echo '<span class="thick">' . $min . ' ' . _PREVMATCHES . '</span></a></div>';
		}

		$next = $min + $offset;
		if ($nrows > $offset) {
			echo '<br /><br /><div class="text-center"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topicid . '&amp;min=' . $max . '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '&amp;category=' . $category . '">';
			echo '<span class="thick">' . _NEXTMATCHES . '</span></a></div>';
		}
	}
} elseif ($type=='comments') {
	$result = $db->sql_query('SELECT `tid`, `sid`, `subject`, `date`, `name` FROM `' . $prefix . '_comments` WHERE (subject like \'%' . addslashes($query) . '%\' OR comment like \'%' . addslashes($query) . '%\')'
			. $instory . ' ORDER BY `date` DESC LIMIT ' . $min . ',' . $offplus1);
	$nrows = $db->sql_numrows($result);
	$x = 0;
	if (!empty($query)) {
		echo '<br /><hr />'
			. '<div class="text-center thick">' . _SEARCHRESULTS . '</div><br /><br />'
			. '<table>';
		if ($nrows > 0) {

			while($row = $db->sql_fetchrow($result) and $x < $offset) {
				$row_res = $db->sql_fetchrow($db->sql_query('SELECT `title` FROM `' . $prefix . '_stories` WHERE `sid`=\'' . $row['sid'] . '\''));
				$reply = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_comments` WHERE `pid`=\'' . $row['tid'] . '\''));
				$furl = 'modules.php?name=News&amp;file=article&amp;sid=' . $row['sid'] . '#' . $row['tid'];
				$name = (!empty($row['name'])) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . urlencode($row['name']) . '">' . $row['name'] . '</a>' : $anonymous;
				$datetime = formatTimestamp($row['date']);
				echo '<tr><td><img src="images/folders.gif" alt="" />&nbsp;<span class="option thick"><a href="' . $furl . '">' . $row['subject'] . '</a></span>'
					. '<div class="content">' . _POSTEDBY . ' ' . $name . ' ' . _ON . ' ' . $datetime . '<br />' . _ATTACHART . ': ' . $row_res['title'] . '<br />';
				if ($reply == 1) {
					echo '(' . $reply . ' ' . _SREPLY . ')';
					if (is_admin($admin)) {
						echo ' [ <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $row['tid'] . '&amp;sid=' . $row['sid'] . '">' . _DELETE . '</a> ]';
					}
				} else {
					echo '(' . $reply . ' ' . _SREPLIES . ')';
					if (is_admin($admin)) {
						echo ' [ <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $row['tid'] . '&amp;sid=' . $row['sid'] . '">' . _DELETE . '</a> ]';
					}
				}
				echo '</div><br /><br /><br /></td></tr>';
				$x++;
			}
			echo '</table>';
		} else {
			echo '<tr><td><div class="option text-center thick">' . _NOMATCHES . '</div><br /><br />'
				. '</td></tr></table>';
		}

		$prev = $min - $offset;
		if ($prev >= 0) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic . '&amp;min=' . $prev
				 . '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . $min . ' ' . _PREVMATCHES . '</a></div>';
		}

		$next = $min + $offset;
		if ($x > $offset) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic
				. '&amp;min=' . $max . '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . _NEXTMATCHES . '</a></div>';
		}
	}
} elseif ($type=='reviews') {
	$result = $db->sql_query('SELECT `id`, `title`, `text`, `reviewer`, `score` FROM `' . $prefix . '_reviews` WHERE (title like \'%' . addslashes($query) . '%\' OR text like \'%' . addslashes($query) . '%\') '
			. $queryrlang . ' ORDER BY `date` DESC LIMIT ' . $min . ',' . $offplus1);
	$nrows = $db->sql_numrows($result);
	$x = 0;
	if (!empty($query)) {
		echo '<br /><hr />'
			. '<div class="text-center thick">' . _SEARCHRESULTS . '</div><br /><br />'
			. '<table>';
		if ($nrows > 0) {
			while($row = $db->sql_fetchrow($result) and $x < $offset) {
				$furl = 'modules.php?name=Reviews&amp;rop=showcontent&amp;id=' . $row['id'];
				$pages = count(explode( '<!--pagebreak-->', $row['text'] ));
				echo '<tr><td><img src="images/folders.gif" alt="" />&nbsp;<span class="option thick"><a href="' . $furl . '">' . $row['title'] . '</a></span>'
					. '<div class="content">' . _POSTEDBY . ' ' . $row['reviewer'] . '<br />' . _REVIEWSCORE . ': ' . $row['score'] . '/10<br />';
				if ($pages == 1) {
					echo '(' . $pages . ' ' . _PAGE . ')';
				} else {
					echo '(' . $pages . ' ' . _PAGES . ')';
				}
				if (is_admin($admin)) {
					echo ' [ <a href="modules.php?name=Reviews&amp;op=mod_review&amp;id=' . $row['id'] . '">' . _EDIT . '</a> | '
						. '<a href="modules.php?name=Reviews.php&amp;op=del_review&amp;id_del=' . $row['id'] . '">' . _DELETE . '</a> ]';
				}
				echo '</div><br /><br /><br /></td></tr>';
				$x++;
			}
			echo '</table>';
		} else {
			echo '<tr><td><div class="option text-center thick">' . _NOMATCHES . '</div><br /><br />'
				. '</td></tr></table>';
		}

		$prev = $min - $offset;
		if ($prev >= 0) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic . '&amp;min=' . $prev
				. '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . $min . ' ' . _PREVMATCHES . '</a></div>';
		}

		$next = $min + $offset;
		if ($x > $offset) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic . '&amp;min=' . $max
				. '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . _NEXTMATCHES . '</a></div>';
		}
	}
} elseif ($type == 'users') {
	$result = $db->sql_query('SELECT `user_id`, `username`, `name` FROM `' . $user_prefix . '_users` WHERE (username like \'%' . addslashes($query) . '%\' OR name like \'%' . addslashes($query)
			. '%\' OR bio like \'%' . addslashes($query) . '%\') ORDER BY `username` ASC LIMIT ' . $min . ',' . $offplus1);
	$nrows = $db->sql_numrows($result);
	$x = 0;
	if (!empty($query)) {
		echo '<br /><hr />'
			. '<div class="text-center thick">' . _SEARCHRESULTS . '</div><br /><br />'
			. '<table>';
		if ($nrows > 0) {
			while($row = $db->sql_fetchrow($result) and $x < $offset) {
				$furl = 'modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['username'];
				$name = (!empty($row['name'])) ? $row['name'] : _NONAME;
				echo '<tr><td><img src="images/folders.gif" alt="" />&nbsp;<span class="option thick"><a href="' . $furl . '">' . $row['username'] . '</a></span>'
					. '<span class="content"> (' . $name . ')';
				if (is_admin($admin)) {
					echo ' [ <a href="' . $admin_file . '.php?chng_uid=' . $row['user_id'] . '&amp;op=modifyUser">' . _EDIT . '</a> | <a href="' . $admin_file . '.php?op=delUser&amp;chng_uid=' . $row['user_id'] . '">' . _DELETE . '</a> ]';
				}
				echo '</span></td></tr>';
				$x++;
			}
			echo '</table>';
		} else {
			echo '<tr><td><div class="option text-center thick">' . _NOMATCHES . '</div><br /><br />'
				. '</td></tr></table>';
		}

		$prev = $min - $offset;
		if ($prev >= 0) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic . '&amp;min=' . $prev
				. '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . $min . ' ' . _PREVMATCHES . '</a></div>';
		}

		$next = $min + $offset;
		if ($x > $offset) {
			echo '<br /><br /><div class="text-center thick"><a href="modules.php?name=' . $module_name . '&amp;author=' .  urlencode($author) . '&amp;topic=' . $topic . '&amp;min=' . $max
				. '&amp;query=' . urlencode($query) . '&amp;type=' . $type . '">' . _NEXTMATCHES . '</a></div>';
		}
	}
}

CloseTable();
$mod1 = $mod2 = $mod3 = '';
if (isset($query) && !empty($query)) {
	echo '<br />';
	if (is_active('Downloads')) {
		$encodedQuery = @strtr(base64_encode(addslashes(gzcompress(serialize($query),9))), '+/=', '-_,');
		if (empty($encodedQuery)) $encodedQuery = '';
		$dcnt = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `title` LIKE \'%' . addslashes($query) . '%\' OR `description` LIKE \'%' . addslashes($query) . '%\''));
		$mod1 = '<li> <a href="modules.php?name=Downloads&amp;op=search&amp;query=' . $encodedQuery . '">' . _DOWNLOADS . '</a> (' . $dcnt . ' ' . _SEARCHRESULTS . ')</li>';
	}
	if (is_active('Web_Links')) {
		$lcnt = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_links_links` WHERE `title` LIKE \'%' . addslashes($query) . '%\' OR `description` LIKE \'%' . addslashes($query) . '%\''));
		$mod2 = '<li> <a href="modules.php?name=Web_Links&amp;l_op=search&amp;query=' . urlencode($query) . '">' . _WEBLINKS . '</a> (' . $lcnt . ' ' . _SEARCHRESULTS . ')</li>';
	}
	if (is_active('Encyclopedia')) {
		$ecnt = 0;
		$result = $db->sql_query('SELECT `eid` FROM `' . $prefix . '_encyclopedia` WHERE active="1"');
		while($row = $db->sql_fetchrow($result)) {
			$ecnt2 = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_encyclopedia` WHERE `title` LIKE \'%' . addslashes($query) . '%\' OR `description` LIKE \'%' . addslashes($query) . '%\' AND `eid`=\'' . $row['eid'] . '\''));
			$ecnt3 = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_encyclopedia_text` WHERE `title` LIKE \'%' . addslashes($query) . '%\' OR `text` LIKE \'%' . addslashes($query) . '%\' AND `eid`=\'' . $row['eid'] . '\''));
			$ecnt = $ecnt + $ecnt2 + $ecnt3;
		}
		$mod3 = '<li> <a href="modules.php?name=Encyclopedia&amp;file=search&amp;query=' . urlencode($query) . '">' . _ENCYCLOPEDIA . '</a> (' . $ecnt . ' ' . _SEARCHRESULTS . ')</li>';
	}

	OpenTable();
	echo '<span class="title">' . _FINDMORE . '<br /><br />' . _DIDNOTFIND . '</span><br /><br />' . _SEARCH . ' "<span class="thick">' . $query . '</span>" ' . _IN . ':<br /><br />'
		. '<ul>' . $mod1 . $mod2 . $mod3
		. '<li> <a href="http://www.google.com/search?q=' . urlencode($query) . '" target="new">Google</a></li>'
		. '<li> <a href="http://groups.google.com/groups?q=' . urlencode($query) . '" target="new">Google Groups</a></li>'
		. '</ul>';
	CloseTable();
}
include_once 'footer.php';

?>