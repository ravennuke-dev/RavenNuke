<?php
/***************************************************************************/
/* PHP-NUKE: Web Portal System									*/
/* ========================================================================*/
/* 														*/
/* Copyright (c) 2002 by Francisco Burzi								*/
/* http://phpnuke.org											*/
/*														*/
/* This program is free software. You can redistribute it and/or modify			*/
/* it under the terms of the GNU General Public License as published by			*/
/* the Free Software Foundation; either version 2 of the License.				*/
/***************************************************************************/
/*	Additional security & Abstraction layer conversion 					*/
/*			2003 chatserv									*/
/*	http://www.nukefixes.com -- http://www.nukeresources.com				*/
/***************************************************************************/
/***************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and 			*/
/* XHTML compliance fixes by Raven and Montego.						*/
/***************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
global $admin, $db, $prefix;
if (isset($sid)) {
	$sid = intval($sid);
} else {
	$sid = '';
}
if (isset($pollID)) {
	$pollID = intval($pollID);
} else {
	$pollID = '';
}
if (isset($tid)) {
	$tid = intval($tid);
} else {
	$tid = '';
}
if (isset($pid)) {
	$pid = intval($pid);
} else {
	$pid = '';
}
/*
 * Get the comment configuration options for use throughout this script.  Going to get the options from the userinfo array
 * instead of passing it around everywhere in the querystring.
 */
$mode = $order = $thold = '';
if (isset($user)) {
	cookiedecode($user);
	if (is_user($user)) {
		getusrinfo($user);
		$mode = strtolower($userinfo['umode']);
		$order = (int)$userinfo['uorder'];
		$thold = (int)$userinfo['thold'];
	}
}
if (empty($mode) || ($mode != 'thread' && $mode != 'nested' && $mode != 'flat' && $mode != 'nocomments')) {
	$mode = 'nested';
}
if (empty($order)) {
	$order = 0;
}
if (empty($thold)) {
	$thold = -1;
}
// End of comment configuration option cleansing
if (!isset($xanonpost)) {
	$xanonpost = 0;
}
if (!isset($anonpost)) {
	$anonpost = 0;
}
if (!isset($op)) {
	$op = '';
}
if (!isset($host_name)) $host_name = '';
// Determine if Admin and if so what level
$adminsuper = is_mod_admin('admin');
$auth_admin = is_mod_admin($module_name);
if ($adminsuper || $auth_admin) $thold = -1;

switch ($op) {
	case 'Reply':
		reply($pid, $pollID, $mode, $order, $thold);
		break;
	case _PREVIEW:
		csrf_check();
		replyPreview($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
		break;
	case _OK:
		csrf_check();
		CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype);
		break;
	case 'moderate':
		csrf_check();
		require_once 'mainfile.php';
		global $admin, $module_name, $user, $userinfo;
		if (($admintest == 1 && is_admin($admin)) || ($admintest == 2 && $moderate == 1 && is_admin($admin)) || ($moderate == 2 && is_user($user))) {
			while (list($tdw, $emp) = each($_POST)) {
				if (stripos_clone($tdw, 'dkn')) {
					$emp = explode(':', $emp);
					if ($emp[1] != 0) {
						$tdw = str_replace('dkn', '', $tdw);
						$emp[0] = intval($emp[0]);
						$emp[1] = intval($emp[1]);
						$tdw = intval($tdw);
						$q = 'UPDATE ' . $prefix . '_pollcomments SET';
						if (($emp[1] == 9) && ($emp[0] >= 0)) { // Overrated
							$q .= ' score=score-1 where tid=\'' . $tdw . '\'';
						} elseif (($emp[1] == 10) && ($emp[0] <= 4)) { // Underrated
							$q .= ' score=score+1 where tid=\'' . $tdw . '\'';
						} elseif (($emp[1] > 4) && ($emp[0] <= 4)) {
							$q .= ' score=score+1, reason=\'' . $emp[1] . '\' where tid=\'' . $tdw . '\'';
						} elseif (($emp[1] < 5) && ($emp[0] > -1)) {
							$q .= ' score=score-1, reason=\'' . $emp[1] . '\' where tid=\'' . $tdw . '\'';
						} elseif (($emp[0] == -1) || ($emp[0] == 5)) {
							$q .= ' reason=\'' . $emp[1] . '\' where tid=\'' . $tdw . '\'';
						}
						if (strlen($q) > 20) $db->sql_query($q);
					}
				}
			}
		}
		Header('Location: modules.php?name=' . $module_name . '&op=results&pollID=' . $pollID);
		break;
	case 'showreply':
		DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
		break;
	default:
		if (!empty($tid) && empty($pid)) {
			singlecomment($tid, $pollID, $mode, $order, $thold);
		} else {
			if (empty($pid)) $pid = 0;
			if (empty($tid)) $tid = 0;
			DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
		}
		break;
}
//Only functions below this line
function format_url($comment) {
	global $nukeurl;
	unset($location);
	$comment = $comment;
	$links = array();
	$hrefs = array();
	$pos = 0;
	while (!(($pos = strpos($comment, '<', $pos)) === false)) {
		$pos++;
		$endpos = strpos($comment, '>', $pos);
		$tag = substr($comment, $pos, $endpos-$pos);
		$tag = trim($tag);
		if (isset($location)) {
			if (!strcasecmp(strtok($tag, ' ') , '/A')) {
				$link = substr($comment, $linkpos, $pos-1-$linkpos);
				$links[] = $link;
				$hrefs[] = $location;
				unset($location);
			}
			$pos = $endpos+1;
		} else {
			if (!strcasecmp(strtok($tag, ' ') , 'A')) {
				if (preg_match("/HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"/i", $tag, $regs));
				else if (preg_match("/HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)/i", $tag, $regs));
				else $regs[1] = '';
				if ($regs[1]) {
					$location = $regs[1];
				}
				$pos = $endpos+1;
				$linkpos = $pos;
			} else {
				$pos = $endpos+1;
			}
		}
	}
	for ($i = 0;$i < sizeof($links);$i++) {
		if (!stripos_clone($hrefs[$i], 'http://')) {
			$hrefs[$i] = $nukeurl;
		} elseif (!stripos_clone($hrefs[$i], 'mailto://')) {
			$href = explode('/', $hrefs[$i]);
			$href = ' [' . $href[2] . ']';
			$comment = str_replace('>' . $links[$i] . '</a>', ' title="' . $hrefs[$i] . '"> ' . $links[$i] . '</a>' . $href, $comment);
		}
	}
	return ($comment);
}
function modone() {
	global $admin, $adminsuper, $auth_admin, $moderate, $module_name, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">';
	}
}
function modtwo($tid, $score, $reason) {
	global $admin, $adminsuper, $auth_admin, $moderate, $reasons, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo ' | <select name="dkn' . $tid . '">';
		for ($i = 0;$i < sizeof($reasons);$i++) {
			echo '<option value="' . $score . ':' . $i . '">' . $reasons[$i] . '</option>';
		}
		echo '</select>';
	}
}
function modthree($pollID, $mode, $order, $thold = 0) {
	global $admin, $adminsuper, $auth_admin, $moderate, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo '<div class="text-center"><input type="hidden" name="pollID" value="' . $pollID . '" />'
			. '<input type="hidden" name="op" value="moderate" />';
		if ($adminsuper == 1) {
			echo '<input type="hidden" name="admintest" value="1" />';
		} elseif ($auth_admin == 1) {
			echo '<input type="hidden" name="admintest" value="2" />';
		} else {
			echo '<input type="hidden" name="admintest" value="0" />';
		}
		echo '<input type="image" src="images/menu/moderate.gif" /></div></form>';
	}
}
function navbar($pollID, $title, $thold, $mode, $order) {
	global $admin, $anonpost, $bgcolor1, $bgcolor2, $cookie, $db, $module_name, $pollcomm, $prefix, $textcolor1, $textcolor2, $userinfo, $user;
	$pollID = intval($pollID);
	$query = $db->sql_query('SELECT pollID FROM ' . $prefix . '_pollcomments where pollID=\'' . $pollID . '\'');
	if (!$query) $count = 0;
	else $count = $db->sql_numrows($query);
	$row = $db->sql_fetchrow($db->sql_query('SELECT pollTitle from ' . $prefix . '_poll_desc where pollID=\'' . $pollID . '\''));
	$title = stripslashes(check_html($row['pollTitle'], 'nohtml'));
	cookiedecode($user);
	getusrinfo($user);
	echo "\n\n", '<!-- COMMENTS NAVIGATION BAR START -->', "\n\n";
	// Header box
	OpenTable();
	echo '<table width="99%" border="0" cellspacing="1" cellpadding="2">';
	if ($title) {
		echo '<tr><td bgcolor="' . $bgcolor2 . '" align="center"><span style="color: ' . $textcolor1 . ';">"' . $title . '" | ';
		if (is_user($user)) {
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">' . _CONFIGURE . '</a>';
		} else {
			echo '<a href="modules.php?name=Your_Account">' . _LOGINCREATE . '</a>';
		}
		if (($count == 1)) {
			echo ' | <span class="thick">' . $count . '</span> ' . _COMMENT . '</span></td></tr>';
		} else {
			echo ' | <span class="thick">' . $count . '</span> ' . _COMMENTS . '</span></td></tr>';
		}
	}
	if (($pollcomm) AND ($mode != 'nocomments')) {
		if ($anonpost == 1 OR (isset($admin) AND is_admin($admin)) OR is_user($user)) {
			echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center" width="100%">';
			echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">'
				. '<input type="hidden" name="pollID" value="' . $pollID . '" />'
				. '<input type="hidden" name="op" value="Reply" />'
				. '<input type="submit" value="' . _REPLYMAIN . '" /></form></td></tr>';
		}
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '" align="center"><span class="tiny">' . _COMMENTSWARNING . '</span></td></tr></table>'
		. "\n\n" . '<!-- COMMENTS NAVIGATION BAR END -->' . "\n\n";
	CloseTable();
	// No Anonomous Posting Box
	if ($anonpost == 0 AND !is_user($user)) {
		OpenTable();
		echo '<div class="text-center"><p>' . _NOANONCOMMENTS . '</p></div>';
		CloseTable();
	}
}
function DisplayKids($tid, $mode, $order = 0, $thold = 0, $level = 0, $dummy = 0, $tblwidth = 99) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $commentlimit, $cookie, $datetime, $db, $module_name, $prefix, $reasons, $textcolor2, $user, $user_prefix, $userinfo;
	$comments = 0;
	static $indentAmt = 0; //Used to help get to XHTML compliance on the nested unordered lists
	if ($level == 0) $indentAmt = 0;
	cookiedecode($user);
	getusrinfo($user);
	$hadUlTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$hadListTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$tid = intval($tid);
	$result = $db->sql_query('SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from ' . $prefix . '_pollcomments where pid = \'' . $tid . '\' order by date, tid');
	if ($mode == 'nested') {
		/* without the tblwidth variable, the tables run of the screen with netscape */
		/* in nested mode in long threads so the text can't be read. */
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if ($level > 0) {
					$indentAmt = $level+1;
				} else {
					$indentAmt = 1;
				}
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_name)) $r_name = $anonymous;
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				echo '<table id="t' . $r_tid . '" width="90%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="', $indentAmt*25, '"></td><td>';
				formatTimestamp($r_date);
				echo '<p><span class="thick">', $r_subject, '</span> <span style="color:', $textcolor2, ';">';
				if ($userinfo['noscore'] == 0) {
					echo '(', _SCORE, ' ', $r_score;
					if ($r_reason > 0) {
						echo ', ', $reasons[$r_reason];
					}
					echo ')';
				}
				echo '<br />' . _BY . ' ';
				if ($r_email) {
					echo '<a href="mailto:', $r_email, '">', $r_name, '</a></span> <span class="thick">(' . $r_email . ')</span> ';
				} else {
					echo $r_name, '</span> ';
				}
				echo _ON, ' ', $datetime;
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
					$r_uid = intval($row2['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $r_name . '">' . _USERINFO . '</a> ';
					if (is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>) ';
					} else {
						echo ')';
					}
				}
				$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
				$url = stripslashes($row_url['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="' . $url . '" target="new">' . $url . '</a> ';
				}
				echo '</p></td></tr><tr><td width="', $indentAmt*25, '"></td><td>';
				if ((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $r_pollID . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></span>';
				elseif (strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $r_pollID . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></span>';
				else echo $r_comment . '<br /><br />';
				if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
					echo '<p style="color: ' . $textcolor2 . ';"> [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $r_tid . '&amp;pollID=' . $r_pollID . '">' . _REPLY . '</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				if (is_admin($admin)) {
					echo ' | <a href="' . $admin_file . '.php?op=RemovePollComment&amp;tid=' . $r_tid . '&amp;pollID=' . $r_pollID . '">' . _DELETE . '</a> ]</p>';
				} elseif ($anonpost != 0 || is_user($user)) {
					echo ' ]</p>';
				}
				echo '</td></tr></table>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
			}
		}
	} elseif ($mode == 'flat') {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_name)) $r_name = $anonymous;
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				echo '<hr /><table id="t' . $r_tid . '" width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td>';
				formatTimestamp($r_date);
				echo '<p><span class="thick">', $r_subject, '</span> <span style="color: ' , $textcolor2 , ';">';
				if ($userinfo['noscore'] == 0) {
					echo '(', _SCORE, ' ', $r_score;
					if ($r_reason > 0) {
						echo ', ', $reasons[$r_reason];
					}
					echo ')';
				}
				echo '<br />' . _BY . ' ';
				if ($r_email) {
					echo '<a href="mailto:', $r_email, '">', $r_name, '</a></span> <span class="thick">(' . $r_email . ')</span> ';
				} else {
					echo $r_name, '</span]]> ';
				}
				echo _ON, ' ', $datetime;
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
					$r_uid = intval($row2['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $r_name . '">' . _USERINFO . '</a> ';
					if (is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>) ';
					} else {
						echo ')';
					}
				}
				$row_url2 = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
				$url = stripslashes($row_url2['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="' . $url . '" target="_blank">' . $url . '</a> ';
				}
				echo '</p></td></tr><tr><td>';
				if ((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $r_pollID . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></span>';
				elseif (strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $r_pollID . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></span>';
				else echo $r_comment;
				echo '</td></tr></table><p style="color: ' . $textcolor2 . ';">';
				if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
					echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $r_tid . '&amp;pollID=' . $r_pollID . '">' . _REPLY . '</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				if (is_admin($admin)) {
					echo ' | <a href="' . $admin_file . '.php?op=RemovePollComment&amp;tid=' . $r_tid . '&amp;pollID=' . $r_pollID . '">' . _DELETE . '</a> ]</p>';
				} elseif ($anonpost != 0 || is_user($user)) {
					echo ' ]</p>';
				}
				DisplayKids($r_tid, $mode, $order, $thold);
			}
		}
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if (isset($level) && !$comments) {
					if ($indentAmt > 0) {
						echo '<li style="list-style:none">';
						$hadListTag = true;
					}
					echo '<ul>';
					$indentAmt++;
					$hadUlTag = true;
				}
				$comments++;
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_name)) $r_name = $anonymous;
				if (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				formatTimestamp($r_date);
				echo '<li><span style="color: ' . $textcolor2 . ';"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=showreply&amp;tid=' . $r_tid . '&amp;pollID=' . $r_pollID . '&amp;pid=' . $r_pid . '#' . $r_tid . '">' . $r_subject . '</a> ' . _BY . ' ' . $r_name . ' ' . _ON . ' ' . $datetime . '</span></li>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
			}
		}
	}
	if ($hadUlTag) echo '</ul>';
	if ($hadListTag && $indentAmt > 1) {
		echo '</li>';
		$indentAmt--;
	}
}
function DisplayTopic($pollID, $pid = 0, $tid = 0, $mode = 'thread', $order = 0, $thold = 0, $level = 0, $nokids = 0) {
	global $acomm, $admin, $admin_file, $anonpost, $anonymous, $articlecomm, $bgcolor1, $bgcolor2, $bgcolor3, $commentlimit, $cookie, $datetime, $db, $foot1, $foot2, $foot3, $foot4, $hr, $module_name, $nukeurl, $prefix, $reasons, $textcolor2, $title, $user, $user_prefix, $userinfo;
	include_once 'header.php';
	$count_times = 0;
	cookiedecode($user);
	getusrinfo($user);
	$q = 'SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason FROM ' . $prefix . '_pollcomments WHERE pollID=\'' . $pollID . '\' AND pid=\'' . $pid . '\'';
	if (!empty($thold)) {
		$q .= ' and score>=\'' . $thold . '\'';
	} else {
		$q .= ' and score>=\'0\'';
	}
	if ($order == 1) $q .= ' ORDER BY date DESC';
	if ($order == 2) $q .= ' ORDER BY score DESC';
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	echo '<div class="content">';
	navbar($pollID, $title, $thold, $mode, $order);
	modone();
	while ($count_times < $num_tid) {
		OpenTable();
		$row_q = $db->sql_fetchrow($something);
		$tid = intval($row_q['tid']);
		$pid = intval($row_q['pid']);
		$pollID = intval($row_q['pollID']);
		$date = $row_q['date'];
		$c_name = stripslashes($row_q['name']);
		$email = stripslashes($row_q['email']);
		$host_name = $row_q['host_name'];
		$subject = stripslashes(check_html($row_q['subject'], 'nohtml'));
		$comment = stripslashes($row_q['comment']);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		if (empty($c_name)) {
			$c_name = $anonymous;
		}
		if (empty($subject)) {
			$subject = '[' . _NOSUBJECT . ']';
		}
		echo '<table id="t' . $tid . '" width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="500">';
		formatTimestamp($date);
		echo '<p><span class="thick">', $subject, '</span> <span style="color: ' , $textcolor2 , ';">';
		if ($userinfo['noscore'] == 0) {
			echo '(', _SCORE, ' ', $score;
			if ($reason > 0) {
				echo ', ', $reasons[$reason];
			}
			echo ')';
		}
		echo '<br />' . _BY . ' ';
		if ($email) {
			echo '<a href="mailto:', $email, '">', $c_name, '</a></span> <span class="thick">(' . $email . ')</span> ';
		} else {
			echo $c_name, '</span> ';
		}
		echo _ON, ' ', $datetime;
		$journal = '';
		if (is_active('Journal')) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT jid FROM ' . $prefix . '_journal WHERE aid=\'' . $c_name . '\' AND status=\'yes\' ORDER BY pdate,jid DESC limit 0,1'));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = ' | <a href="modules.php?name=Journal&amp;file=display&amp;jid=' . $jid . '">' . _JOURNAL . '</a>';
			} else {
				$journal = '';
			}
		}
		if ($c_name != $anonymous) {
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $c_name . '\''));
			$r_uid = intval($row2['user_id']);
			echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $c_name . '">' . _USERINFO . '</a> ';
			if (is_active('Private_Messages')) {
				echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>';
			}
			echo $journal . ') ';
		}
		$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $c_name . '\''));
		$url = stripslashes($row_url['user_website']);
		if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
			echo '<a href="' . $url . '" target="new">' . $url . '</a> ';
		}
		if (is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT host_name from ' . $prefix . '_pollcomments where tid=\'' . $tid . '\''));
			$host_name = $row3['host_name'];
			echo '<br /><span class="thick">(IP: ' . $host_name . ')</span>';
		}
		echo '</p></td></tr><tr><td>';
		if ((isset($userinfo['commentmax'])) AND (strlen($comment) > $userinfo['commentmax'])) echo substr($comment, 0, $userinfo['commentmax']) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $pollID . '&amp;tid=' . $tid . '">' . _READREST . '</a></span>';
		elseif (strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit) . '<br /><br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $pollID . '&amp;tid=' . $tid . '">' . _READREST . '</a></span>';
		else echo $comment;
		echo '</td></tr></table><br /><br />';
		if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
			echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $tid . '&amp;pollID=' . $pollID . '">' . _REPLY . '</a>';
		}
		if ($pid != 0) {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT pid from ' . $prefix . '_pollcomments where tid=\'' . $pid . '\''));
			$erin = intval($row4['pid']);
			echo ' | <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;pollID=' . $pollID . '&amp;pid=' . $erin . '">' . _PARENT . '</a>';
		}
		modtwo($tid, $score, $reason);
		if (is_admin($admin)) {
			echo ' | <a href="' . $admin_file . '.php?op=RemovePollComment&amp;tid=' . $tid . '&amp;pollID=' . $pollID . '">' . _DELETE . '</a> ]';
		} elseif ($anonpost != 0 || is_user($user)) {
			echo ' ]';
		}
		echo '<br /><br />';
		DisplayKids($tid, $mode, $order, $thold, $level);
		if ($hr) echo '<hr noshade="noshade" size="1" />';
		$count_times+=1;
		CloseTable();
	}
	modthree($pollID, $mode, $order, $thold);
	echo '</div>';
	include_once 'footer.php';
}
function singlecomment($tid, $pollID, $mode, $order, $thold) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $cookie, $db, $datetime, $module_name, $prefix, $reasons, $textcolor2, $user, $userinfo;
	include_once 'header.php';
	cookiedecode($user);
	getusrinfo($user);
	$tid = intval($tid);
	$pollID = intval($pollID);
	$row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason from ' . $prefix . '_pollcomments where tid=\'' . $tid . '\' and pollID=\'' . $pollID . '\''));
	$date = $row['date'];
	$name = stripslashes($row['name']);
	$email = stripslashes($row['email']);
	$subject = stripslashes(check_html($row['subject'], 'nohtml'));
	$comment = stripslashes($row['comment']);
	$score = intval($row['score']);
	$reason = intval($row['reason']);
	$titlebar = '<span class="thick">' . $subject . '</span>';
	if (empty($name)) $name = $anonymous;
	if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
	title($subject);
	OpenTable();
	echo '<div class="content">';
	modone();
	echo '<table width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="500">';
	formatTimestamp($date);
	echo '<p><span class="thick">', $subject, '</span> <span style="color: ' , $textcolor2 , ';">';
	if ($userinfo['noscore'] == 0) {
		echo '(', _SCORE, ' ', $score;
		if ($reason > 0) {
			echo ', ', $reasons[$reason];
		}
		echo ')';
	}
	echo '<br />' . _BY . ' ';
	if ($email) {
		echo '<a href="mailto:', $email, '">', $name, '</a></span> <span class="thick">(' . $email . ')</span> ';
	} else {
		echo $name, '</span> ';
	}
	echo _ON, ' ', $datetime;
	echo '</p></td></tr><tr><td>' . $comment . '</td></tr></table><br /><br />';
	if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
		echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid='
			. $tid . '&amp;pollID=' . $pollID . '">' . _REPLY . '</a> | <a href="modules.php?name='
			. $module_name . '&amp;op=results&amp;pollID=' . $pollID . '">' . _ROOT . '</a>';
	}
	modtwo($tid, $score, $reason);
	echo ' ]';
	modthree($pollID, $mode, $order, $thold);
	echo '</div>';
	CloseTable();
	include_once 'footer.php';
}
function reply($pid, $pollID, $mode, $order, $thold) {
	include_once 'header.php';
	global $AllowableHTML, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $cookie, $datetime, $db, $modGFXChk, $module_name, $prefix, $reasons, $user, $userinfo;
	cookiedecode($user);
	getusrinfo($user);
	echo '<div class="content">';
	if ($anonpost == 0 AND !is_user($user)) {
		title(_SURVEYCOM);
		OpenTable();
		echo '<div class="text-center"><p>' . _NOANONCOMMENTS . '</p><p>' . _GOBACK . '</p></div>';
		CloseTable();
	} else {
		if ($pid != 0) {
			list($date, $name, $email, $subject, $comment, $score, $reason) = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason FROM ' . $prefix . '_pollcomments WHERE tid=\'' . $pid . '\''));
			$score = intval($score);
			$reason = intval($reason);
			if (!validateEmailFormat($email)) {
				$email = '';
			}
		} else {
			list($subject) = $db->sql_fetchrow($db->sql_query('select pollTitle FROM ' . $prefix . '_poll_desc where pollID=\'' . $pollID . '\''));
		}
		$titlebar = '<span class="thick">' . $subject . '</span>';
		if (empty($name)) $name = $anonymous;
		if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
		if (!isset($date)) {
			$date = time();
		}
		formatTimestamp($date);
		title(_SURVEYCOM);
		OpenTable();
		echo '<div class="text-center"><p class="thick">' . $subject . '</p></div>';
		if (empty($comment)) {
			echo '<div class="text-center"><p class="italic">' . _DIRECTCOM . '</p></div>';
		} else {
			$score = isset($row['score']) ? intval($row['score']) : 0;
			$reason = isset($row['reason']) ? intval($row['reason']) : 0;
			if ($userinfo['noscore'] == 0) {
				echo '(', _SCORE, ' ', $score;
				if ($reason > 0) {
					echo ', ', $reasons[$reason];
				}
				echo ')';
			}
			if (!empty($email)) {
				echo '<br />' . _BY . ' <a href="mailto:' . $email . '">' . $name . '</a> <span class="thick">(' . $email . ')</span> ' . _ON . ' ' . $datetime;
			} else {
				echo '<br />' . _BY . ' ' . $name . ' ' . _ON . ' ' . $datetime;
			}
			echo '<br /><br />' . $comment . '<br /><br />';
		}
		CloseTable();
		if (!isset($pid) || !isset($pollID)) {
			echo 'Something is not right. This message is just to keep things from messing up down the road';
			exit();
		}
		if ($pid == 0) {
			list($subject) = $db->sql_fetchrow($db->sql_query('select pollTitle from ' . $prefix . '_poll_desc where pollID=\'' . $pollID . '\''));
		} else {
			list($subject) = $db->sql_fetchrow($db->sql_query('select subject from ' . $prefix . '_pollcomments where tid=\'' . $pid . '\''));
		}
		echo '<br />';
		OpenTable();
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">';
		echo '<p><span class="thick">' . _YOURNAME . ':</span> ';
		if (is_user($user)) {
			cookiedecode($user);
			echo '<a href="modules.php?name=Your_Account">' . $cookie[1] . '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]';
		} else {
			echo $anonymous;
			$xanonpost = 1;
		}
		echo '</p><p><span class="thick">' . _SUBJECT . ':</span><br />';
		if (!stripos_clone($subject, 'Re:')) $subject = 'Re: ' . substr($subject, 0, 81);
		echo '<input type="text" name="subject" size="50" maxlength="85" value="' . $subject . '" /></p>';
		echo '<p><span class="thick">' . _UCOMMENT . ':</span><br />'
			. '<textarea cols="50" rows="10" name="comment"></textarea></p>'
			. '<p>' . _ALLOWEDHTML . '<br />';
		while (list($key,) = each($AllowableHTML)) echo ' &lt;' . $key . '&gt;';
		echo '</p>';
		if (is_user($user) AND ($anonpost == 1)) {
			echo '<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br />';
		}
		echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
		echo '<input type="hidden" name="pid" value="' . $pid . '" />'
			. '<input type="hidden" name="pollID" value="' . $pollID . '" />'
			. '<br /><input type="submit" name="op" value="' . _PREVIEW . '" />&nbsp;'
			. '<input type="submit" name="op" value="' . _OK . '" />&nbsp;'
			. '<select name="posttype">'
			. '<option value="exttrans">' . _EXTRANS . '</option>'
			. '<option value="html">' . _HTMLFORMATED . '</option>'
			. '<option value="plaintext" selected="selected">' . _PLAINTEXT . '</option>'
			. '</select>'
			. '</form>';
		CloseTable();
	}
	echo '</div>';
	include_once 'footer.php';
}
function replyPreview($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
	include_once 'header.php';
	global $AllowableHTML, $anonymous, $anonpost, $cookie, $modGFXChk, $module_name, $user, $userinfo;
	cookiedecode($user);
	getusrinfo($user);
	if (!isset($mode) OR empty($mode)) {
		if (isset($userinfo['umode'])) {
			$mode = $userinfo['umode'];
		} else {
			$mode = 'thread';
		}
	}
	if (!isset($order) OR empty($order)) {
		if (isset($userinfo['uorder'])) {
			$order = $userinfo['uorder'];
		} else {
			$order = 0;
		}
	}
	if (!isset($thold) OR empty($thold)) {
		if (isset($userinfo['thold'])) {
			$thold = $userinfo['thold'];
		} else {
			$thold = 0;
		}
	}
	$subject = stripslashes(check_html($subject, 'nohtml'));
	$comment = stripslashes(check_html($comment));
	$pid = intval($pid);
	$pollID = intval($pollID);
	if (!isset($pid) || !isset($pollID)) {
		die(_NOTRIGHT);
	}
	echo '<div class="content">';
	title(_SURVEYCOMPRE);
	OpenTable();
	echo '<p><span class="thick">' . $subject . '</span><br />';
	echo _BY . ' ';
	if (is_user($user)) {
		echo $cookie[1];
	} else {
		echo $anonymous;
	}
	echo ' ' . _ONN . '</p>';
	if ($posttype == 'exttrans') {
		echo nl2br(htmlspecialchars($comment, ENT_QUOTES, _CHARSET));
	} elseif ($posttype == 'plaintext') {
		echo nl2br($comment);
	} else {
		echo $comment;
	}
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">'
		. '<p><span class="thick">' . _YOURNAME . ':</span> ';
	if (is_user($user)) {
		echo '<a href="modules.php?name=Your_Account">' . $cookie[1] . '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]';
	} else {
		echo $anonymous;
	}
	echo '</p><p><span class="thick">' . _SUBJECT . ':</span><br />'
		. '<input type="text" name="subject" size="50" maxlength="85" value="' . $subject . '" /></p>'
		. '<p><span class="thick">' . _UCOMMENT . ':</span><br />'
		. '<textarea cols="50" rows="10" name="comment">' . htmlentities($comment, ENT_QUOTES) . '</textarea></p>';
	echo '<p>' . _ALLOWEDHTML . '<br />';
	while (list($key,) = each($AllowableHTML)) echo ' &lt;' . $key . '&gt;';
	echo '</p>';
	if (($xanonpost) AND ($anonpost == 1)) {
		echo '<input type="checkbox" name="xanonpost" checked="checked" /> ' . _POSTANON . '<br />';
	} elseif ((is_user($user)) AND ($anonpost == 1)) {
		echo '<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br />';
	}
	echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
	echo '<input type="hidden" name="pid" value="' . $pid . '" />'
		. '<input type="hidden" name="pollID" value="' . $pollID . '" />'
		. '<input type="hidden" name="mode" value="' . $mode . '" />'
		. '<input type="hidden" name="order" value="' . $order . '" />'
		. '<input type="hidden" name="thold" value="' . $thold . '" />'
		. '<br /><input type="submit" name="op" value="' . _PREVIEW . '" />&nbsp;'
		. '<input type="submit" name="op" value="' . _OK . '" />&nbsp;'
		. '<select name="posttype"><option value="exttrans"';
	if ($posttype == 'exttrans') echo ' selected="selected"';
	echo '>' . _EXTRANS . '</option><option value="html"';
	if ($posttype == 'html') echo ' selected="selected"';
	echo '>' . _HTMLFORMATED . '</option><option value="plaintext"';
	if (($posttype != 'exttrans') && ($posttype != 'html')) echo ' selected="selected"';
	echo '>' . _PLAINTEXT . '</option></select></form>';
	CloseTable();
	echo '</div>';
	include_once 'footer.php';
}
function CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype) {
	global $anonpost, $cookie, $db, $EditedMessage, $modGFXChk, $module_name, $prefix, $pollcomm, $user, $userinfo;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check'];
	else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once 'header.php';
		OpenTable();
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	cookiedecode($user);
	getusrinfo($user);
	if (!isset($mode) OR empty($mode)) {
		if (isset($userinfo['umode'])) {
			$mode = $userinfo['umode'];
		} else {
			$mode = 'thread';
		}
	}
	if (!isset($order) OR empty($order)) {
		if (isset($userinfo['uorder'])) {
			$order = $userinfo['uorder'];
		} else {
			$order = 0;
		}
	}
	if (!isset($thold) OR empty($thold)) {
		if (isset($userinfo['thold'])) {
			$thold = $userinfo['thold'];
		} else {
			$thold = 0;
		}
	}
	$subject = FixQuotes(filter_text($subject, 'nohtml'));
	$comment = format_url($comment);
	if ($posttype == 'exttrans') {
		$comment = FixQuotes(nl2br(htmlspecialchars(check_words($comment))));
	} elseif ($posttype == 'plaintext') {
		$comment = FixQuotes(nl2br(filter_text($comment)));
	} else {
		$comment = FixQuotes(filter_text($comment));
	}
	if (is_user($user)) {
		getusrinfo($user);
	}
	if ((is_user($user)) && (!$xanonpost)) {
		$name = $userinfo['username'];
		$email = $userinfo['femail'];
		$url = $userinfo['user_website'];
		$score = 1;
	} else {
		$name = '';
		$email = '';
		$url = '';
		$score = 0;
	}
	if (empty($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if (!validIP($ip)) $ip = '';
	$pollID = intval($pollID);
	$result = $db->sql_query('select count(*) from ' . $prefix . '_poll_desc where pollID=\'' . $pollID . '\'');
	$fake = $db->sql_numrows($result);
	if ($fake == 1) {
		if ((($anonpost == 0) AND (is_user($user))) OR ($anonpost == 1)) {
			$db->sql_query('insert into ' . $prefix . '_pollcomments values (NULL, \'' . $pid . '\', \'' . $pollID . '\', now(), \'' . $name . '\', \'' . $email . '\', \'' . $url . '\', \'' . $ip . '\', \'' . $subject . '\', \'' . $comment . '\', \'' . $score . '\', \'0\')');
			update_points(9);
		} else {
			die(_NICETRY);
		}
	} else {
		include_once 'header.php';
		echo _ANNOYINGMSG;
		include_once 'footer.php';
		die();
	}
	Header('Location: modules.php?name=' . $module_name . '&op=results&pollID=' . $pollID);
}
?>