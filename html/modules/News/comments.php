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
/*
tid = topic id, it is the unique id of the comments table and is auto-incremented.  Every record in the topics
table has one of course
pid = posting id , it is a key in the comments.  Comments which are directly to the article itself get a pid of 0.
Could be considered top level.
comments to other comments get the tid of the comment they are replying to as their pid
Thus when pid = 0 the singlecomment function is called
then displaykids is used to traverse through comments
the thold field is stored in the users table (stands for threshold ... if a user sets it they
will not see comments with a score below that threshold  setting accessed through your account on
a per user basis ... trap ... if you are signed on as admin you will see all comments regardless of user setting
*/
/***************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
global $admin, $db, $prefix;
if (isset($_POST['comment'])) {
	$comment = check_html($_POST['comment'], '');
}
	else {
		$comment = '';
	}
if (isset($_POST['subject'])) {
	$subject= check_html($_POST['subject'], '');
}
	else {
		$subject= '';
	}
if (isset($_POST['sid'])) {
	$sid = intval($_POST['sid']);
}
elseif (isset($_GET['sid'])) {
	$sid = intval($_GET['sid']);
}
else {
	$sid = '';
}
if (isset($_POST['tid'])) {
	$tid = intval($_POST['tid']);
}
elseif  (isset($_GET['tid'])) {
	$tid = intval($_GET['tid']);
}
	else {
	$tid = '';
}
if (isset($_POST['pid'])) {
	$pid = intval($_POST['pid']);
}
elseif (isset($_GET['pid'])) {
	$pid = intval($_GET['pid']);
}
else {
	$pid = '0';
}
if (isset($_POST['op'])) {
	$op = $_POST['op'];
}
elseif (isset($_GET['op'])) {
	$op = $_GET['op'];
}
else {
	$op = '';
}
 /* Get the comment configuration options for use throughout this script.  Going to get the options from the userinfo array
 * instead of passing it around everywhere in the querystring.
 */
$mode = $order = $thold = '';
if (isset($user)) {
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
if (!isset($host_name)) $host_name = '';
// Determine if Admin and if so what level
$admin_comments = addslashes(base64_decode($admin));
$admin_comments = explode(':', $admin_comments);
$aid = addslashes($admin_comments[0]);
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT title, admins FROM ' . $prefix . '_modules WHERE title=\'' . $module_name . '\''));
$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
$admins = explode(',', $row['admins']);
$auth_admin = 0;
if ($row2['radminsuper'] == 1) {
	$adminsuper = 1;
	$thold = -1;
} else {
	$adminsuper = 0;
}
for ($i = 0;$i < sizeof($admins);$i++) {
	if (is_admin($admin) && $row2['name'] == $admins[$i] && $row['admins'] != '') {
		$auth_admin = 1;
		$thold = -1;
	}
}
switch ($op) {
	case 'Reply':
		reply($pid, $sid, $mode, $order, $thold);
		break;
	case _OK:
		csrf_check();
		CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold);
		break;
	case 'moderate':
		csrf_check();
		require_once 'mainfile.php';
		global $admin, $module_name, $user, $userinfo;
		if (isset($_POST['admintest'])) {
			$admintest = intval($_POST['admintest']);
		}
			else {
				$admintest = 0;
			}
		if (($admintest == 1 && is_admin($admin)) || ($admintest == 2 && $moderate == 1 && is_admin($admin)) || ($moderate == 2 && is_user($user))) {
			while (list($tdw, $emp) = each($_POST)) {
				if (stripos_clone($tdw, 'dkn')) {
					$emp = explode(':', $emp);
					if ($emp[1] != 0) {
						$tdw = str_replace('dkn', '', $tdw);
						$emp[0] = intval($emp[0]);
						$emp[1] = intval($emp[1]);
						$tdw = intval($tdw);
						$q = 'UPDATE ' . $prefix . '_comments SET';
						if (($emp[1] == 9) && ($emp[0] >= 0)) { // Overrated
							$q .= ' score=score-1 WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] == 10) && ($emp[0] <= 4)) { // Underrated
							$q .= ' score=score+1 WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] > 4) && ($emp[0] <= 4)) {
							$q .= ' score=score+1, reason=\'' . $emp[1] . '\' WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] < 5) && ($emp[0] > -1)) {
							$q .= ' score=score-1, reason=\'' . $emp[1] . '\' WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[0] == -1) || ($emp[0] == 5)) {
							$q .= ' reason=' . $emp[1] . ' WHERE tid=\'' . $tdw . '\'';
						}
						if (strlen($q) > 20) $db->sql_query($q);
					}
				}
			}
		}
		Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
		break;
	case 'showreply':
		DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
		include_once 'footer.php';
		break;
	default:
		if (!empty($tid) AND ($pid==0)) {
			singlecomment($tid, $sid, $mode, $order, $thold);
		} elseif (!defined('NUKE_FILE') xor ($pid == 0 AND !isset($pid))) {
			Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
		} else {
			if (!isset($pid)) $pid = 0;
			DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
				echo '</td></tr></table>'."\n";  // addresses compliance issue
			if ((($anonpost == 0 AND is_user($user)) OR $anonpost == 1) AND $acomm == 0) {
				echo '<div><a class="qreply" style="background: ' . $bgcolor2 . ';padding: 2px; text-decoration:none;" onclick="Qreply(); return false;" href="#">'._QREPLY.'</a><div id="slidingDiv4" style="width:400px; padding: 4px; display:none;">';
				$title = strip_tags($title);
				echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">';
				echo '<div class="option thick">'._SUBJECT.':</div><br />';
				if (!stripos_clone($subject,'Re:')) $subject = 'Re: '.$title.' '.substr($subject,0,81);
				echo '<input type="text" name="subject" size="40" maxlength="85" value="'.$subject.'" /><br /><br />';
				wysiwyg_textarea("comment", "", "PHPNuke", "20", "8");
				if (is_user($user) AND ($anonpost == 1)) {
					echo '<input type="checkbox" name="xanonpost" /> '._POSTANON.'<br />';
				}
				// Quake - start
				if (!isset($mode) OR empty($mode)) {
					if(isset($userinfo['umode'])) {
						$mode = $userinfo['umode'];
					} else {
						$mode = 'thread';
					}
				}
				if (!isset($order) OR empty($order)) {
					if(isset($userinfo['uorder'])) {
						$order = $userinfo['uorder'];
					} else {
						$order = 0;
					}
				}
				if (!isset($thold) OR empty($thold)) {
					if(isset($userinfo['thold'])) {
						$thold = $userinfo['thold'];
					} else {
						$thold = 0;
					}
				}
				// Quake - end

				/*****[BEGIN]******************************************
				 [ Base:    GFX Code                           v1.0.0 ]
				 ******************************************************/
				global $modGFXChk;
				echo ''.security_code($modGFXChk[$module_name], 'stacked').'<br />';
				/*****[END]********************************************
				 [ Base:    GFX Code                           v1.0.0 ]
				 ******************************************************/

				echo '<input type="hidden" name="pid" value="'.$pid.'" />'
					.'<input type="hidden" name="sid" value="'.$sid.'" />'
					.'<input type="hidden" name="mode" value="'.$mode.'" />'
					.'<input type="hidden" name="order" value="'.$order.'" />'
					.'<input type="hidden" name="thold" value="'.$thold.'" />'
					.'<input type="submit" name="op" value="'._OK.'" />'
					.'<input type="hidden" name="posttype" value="'._HTMLFORMATED.'" />'
					.'</form>'
					.'</div></div>';
			}
		}
		break;
}
//Only functions below this line
function format_url($comment) {
	global $nukeurl;
	unset($location);
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
		echo '<form action="modules.php?name=', $module_name, '&amp;file=comments" method="post">';
	}
}
function modtwo($tid, $score, $reason) {
	global $admin, $adminsuper, $auth_admin, $moderate, $reasons, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo ' | <select name="dkn', $tid, '">';
		for ($i = 0;$i < sizeof($reasons);$i++) {
			echo '<option value="', $score, ':', $i, '">', $reasons[$i], '</option>';
		}
		echo '</select>';
	}
}
function modthree($sid, $mode, $order, $thold = 0) {
	global $admin, $adminsuper, $auth_admin, $moderate, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo '<div class="text-center centered"><input type="hidden" name="sid" value="', $sid, '" />', "\n"
			. '<input type="hidden" name="op" value="moderate" />', "\n";
		if ($adminsuper == 1) {
			echo '<input type="hidden" name="admintest" value="1" />', "\n";
		} elseif ($auth_admin == 1) {
			echo '<input type="hidden" name="admintest" value="2" />', "\n";
		} else {
			echo '<input type="hidden" name="admintest" value="0" />', "\n";
		}
		echo '<input type="image" src="images/menu/moderate.gif" /></div></form>', "\n";
	}
}
function nocomm() {
	OpenTable();
	echo '<div class="text-center title">' . _NOCOMMENTSACT . '</div>';
	CloseTable();
}
function navbar($sid, $title, $thold, $mode, $order) {
	global $admin, $anonpost, $bgcolor1, $bgcolor2, $cookie, $db, $module_name, $pid, $prefix, $textcolor1, $textcolor2, $userinfo, $user;
	$query = $db->sql_query('SELECT * FROM ' . $prefix . '_comments WHERE sid=\'' . $sid . '\'');
	if (!$query) {
		$count = 0;
	} else {
		$count = $db->sql_numrows($query);
	}
	$query = $db->sql_query('SELECT title FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\'');
	list($un_title) = $db->sql_fetchrow($query);
	$un_title = htmlentities($un_title, ENT_QUOTES);
	if (!isset($thold)) {
		$thold = 0;
	}
	echo "\n\n" . '<!-- COMMENTS NAVIGATION BAR START -->' . "\n\n";
	// Header box
	OpenTable();
	echo '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
	if ($title) {
		echo '<tr><td bgcolor="' . $bgcolor2 . '" class="centered text-center"><span style="color:'. $textcolor1 . '">' . $un_title . ' | ';
		if (is_user($user)) {
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">' . _CONFIGURE . '</a>';
		} else {
			echo '<a href="modules.php?name=Your_Account">' . _LOGINCREATE . '</a>';
		}
		if (($count == 1)) {
			echo ' | <span class="thick">' . $count . '</span> ' . _COMMENT;
		} else {
			echo ' | <span class="thick">' . $count . '</span> ' . _COMMENTS;
		}
		if ($count > 0 AND is_active('Search')) {
			echo ' | <a href="modules.php?name=Search&amp;type=comments&amp;sid=' . $sid . '">' . _SEARCHDIS . '</a>';
		}
		echo '</span></td></tr>';
	}
	if ($anonpost == 1 OR (isset($admin) AND is_admin($admin)) OR is_user($user)) {
		echo '<tr><td width="100%"><div class="text-center centered">';
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">'
			. '<input type="hidden" name="pid" value="' . $pid . '" />'
			. '<input type="hidden" name="sid" value="' . $sid . '" />'
			. '<input type="hidden" name="op" value="Reply" />'
			. '<input type="submit" value="' . _REPLYMAIN . '" /></form></div></td></tr>';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '" class="centered text-center"><span class="tiny">' . _COMMENTSWARNING . '</span></td></tr></table>'
		. "\n\n" . '<!-- COMMENTS NAVIGATION BAR END -->' . "\n\n";
	CloseTable();
	// No Anonomous Posting Box
	if ($anonpost == 0 AND !is_user($user)) {
		OpenTable();
		echo '<div class="text-center title"><p>' . _NOANONCOMMENTS . '</p></div>';
		CloseTable();
	}
}
function DisplayKids($tid, $mode, $order = 0, $thold = 0, $level = 0, $dummy = 0, $tblwidth = 99) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $commentlimit, $cookie, $datetime, $db, $module_name, $prefix, $reasons, $textcolor2, $user, $user_prefix, $userinfo;
	$comments = 0;
	static $indentAmt = 0; //Used to help get to XHTML compliance on the nested unordered lists
	if ($level == 0) {
		$indentAmt = 0;
	}
	if (is_user($user)) {
		getusrinfo($user);
	}
	$hadUlTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$hadListTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$result = $db->sql_query('SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM ' . $prefix . '_comments WHERE pid=\'' . $tid . '\' AND score>\'' . $thold . '\' ORDER BY date, tid');
		/* without the tblwidth variable, the tables run of the screen with netscape */
		/* in nested mode in long threads so the text can't be read. */
		// february 2011 combined nested flat and other section added score gt thold into sql
		while ($row = $db->sql_fetchrow($result)) {
				if ($mode == 'nested') {
					if ($level > 0) {
						$indentAmt = $level+1;
					} else {
						$indentAmt = 1;
					}
					echo '<table id="t' . $row['tid'] . '" width="90%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="', $indentAmt*25, '"></td><td>';
				}
				elseif ($mode == 'flat') {
					echo '<hr /><table id="t' . $row['tid'] . '" width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td>';
					}
				if (empty($row['subject'])) {
					$r_subject = '[' . _NOSUBJECT . ']';
				}
				else {
					$r_subject = $row['subject'];
				}
				if (is_user($user)) {
					userdate($row['date']);
				} else {
					formatTimestamp($row['date']);
				}
				if ($mode == 'nested' OR $mode == 'flat') {
					echo '<span class="thick">', $r_subject, '</span> <span style="color:'. $textcolor2 . '">';
					if ($userinfo['noscore'] == 0) {
						echo '(', _SCORE, ' ', $row['score'];
					if ($row['reason'] > 0) {
						echo ', ', $reasons[$row['reason']];
					}
					echo ')';
					}
					echo '<br />' . _BY . ' ';
				if (!empty($row['email'])) {
					echo '<a href="mailto:', $row['email'], '">', $row['name'], '</a></span> <span class="thick">(' . $row['email'] . ')</span> ';
				} else {
					echo $row['name'], '</span> ';
				}
				echo _ON, ' ', $datetime .'<br />';
				if ($row['name'] != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $row['name'] . '\''));
					echo '(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['name'] . '">' . _USERINFO . '</a> ';
					if (is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $row2['user_id'] . '">' . _SENDAMSG . '</a>) ';
					} else {
						echo ')';
					}
				}
				$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $row['name'] . '\''));
				$url = $row_url['user_website'];
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="' . $url . '" target="_blank">' . $url . '</a> ';
				}
				if ($mode == 'nested') {
				echo '</td></tr><tr><td width="', $indentAmt*25, '"></td><td>';
				}
				elseif ($mode == 'flat') {
					echo '</td></tr><tr><td>';
				}
				echo '<br />';
				if ((isset($userinfo['commentmax'])) AND (strlen($row['comment']) > $userinfo['commentmax'])) echo substr($row['comment'], 0, $userinfo['commentmax']) . '<br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $row['sid'] . '&amp;tid=' . $row['tid'] . '">' . _READREST . '</a></span>';
				elseif (strlen($row['comment']) > $commentlimit) echo substr($row['comment'], 0, $commentlimit) . '<br /><span class="thick"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $row['sid'] . '&amp;tid=' . $row['tid'] . '">' . _READREST . '</a></span>';
				else echo $row['comment'] . '<br />';
				if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
						echo '<span style="color:' . $textcolor2 . '"> [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $row['tid'] . '&amp;sid=' . $row['sid'] . '">' . _REPLY . '</a>';
					}
				modtwo($row['tid'], $row['score'], $row['reason']);
				if (is_admin($admin)) {
					echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $row['tid'] . '&amp;sid=' . $row['sid'] . '">' . _DELETE . '</a> ]</span>';
				} elseif ($anonpost != 0 || is_user($user)) {
					echo ' ]</span>';
				}
				if ($mode == 'nested') {
					echo '</td></tr></table><br />';
				DisplayKids($row['tid'], $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
				}
				else {
					echo '</td></tr></table>';
					DisplayKids($row['tid'], $mode, $order, $thold);
				}
			// not nested or flat
			}
			else {  // mode == thread
				if (isset($level) && !$comments) {
						if ($indentAmt > 0) {
							echo '<li style="list-style:none">';
							$hadListTag = true;
						}
						echo '<ul>';
						$indentAmt++;
						$hadUlTag = true;
						$comments++;
					}
				echo '<li><span style="color:' . $textcolor2 . '"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=showreply&amp;tid=' . $row['tid'] . '&amp;sid=' . $row['sid'] . '&amp;pid=' . $row['pid'] . '#' . $row['tid'] . '">' . $r_subject . '</a> ' . _BY . ' ' . $row['name'] . ' ' . _ON . ' ' . $datetime . '</span></li>';
				DisplayKids($row['tid'], $mode, $order, $thold, $level+1, $dummy+1);
			}
		}  // end of the while loop
			if ($hadUlTag) echo '</ul>';
	if ($hadListTag && $indentAmt > 1) {
		echo '</li>';
		$indentAmt--;
	}
}
function DisplayTopic($sid, $pid=0, $tid=0, $mode="thread", $order=0, $thold=0, $level=0, $nokids=0) {
	global $title, $bgcolor1, $bgcolor2, $bgcolor3, $hr, $user, $datetime, $cookie, $admin, $commentlimit, $anonymous, $anonymousname, $reasons, $anonpost, $foot1, $foot2, $foot3, $foot4, $prefix, $acomm, $articlecomm, $db, $module_name, $nukeurl, $admin_file, $userinfo, $user_prefix;
	cookiedecode($user);
	getusrinfo($user);
	include_once('header.php');
	$count_times = 0;
	cookiedecode($user);
	getusrinfo($user);
	$q = 'SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM '.$prefix.'_comments WHERE sid=\''.$sid.'\' and pid=\''.$pid.'\'';
	if(!empty($thold)) {
		$q .= ' AND score >= \''.$thold.'\'';
	} else {
		$q .= ' AND score >= 0';
	}
	if ($order==0) $q .= ' ORDER BY date ASC';
	if ($order==1) $q .= ' ORDER BY date DESC';
	if ($order==2) $q .= ' ORDER BY score DESC';
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	if ($acomm == 1) {
		nocomm();
		return;
	}
	echo '<div class="content">';
	if (($acomm == 0) AND ($articlecomm == 1)) {
		navbar($sid, $title, $thold, $mode, $order);
	}
	modone();
	while ($count_times < $num_tid) {
		// Initial comment box
		OpenTable();
		 $row_q = $db->sql_fetchrow($something);
		$tid = $row_q['tid'];
		$pid = $row_q['pid'];
		$sid = $row_q['sid'];
		$date = $row_q['date'];
		$c_name = $row_q['name'];
		$email = $row_q['email'];
		$host_name = $row_q['host_name'];
		$subject = $row_q['subject'];
		$comment = $row_q['comment'];
		$score = $row_q['score'];
		$reason = $row_q['reason'];
		if (empty($c_name)) {
			$c_name = $anonymous;
		}
		if (empty($subject)) {
			$subject = '[' . _NOSUBJECT . ']';
		}
//        echo '<a name="'.$tid.'"></a>';
					 //Modified for the Tricked Out News Mod. To make the comments look more like forum.
		//echo '<table id="t'.$tid.'" width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="500"><p>';
					 echo '<table id="t'.$tid.'" width="100%" border="0" cellpadding="3" cellspacing="0"><tr bgcolor="'.$bgcolor1.'"><td width="30%"><p>';
		if (is_user($user)) {
			userdate($date);
		} else {
			formatTimestamp($date);
		}

			echo '<span class="thick">'.$subject.'</span> ';
			if($userinfo['noscore'] == 0) {
				echo '('._SCORE.' '.$score;
				if($reason>0) echo ', '.$reasons[$reason];
				echo ')';
			}
			if (!empty($email)) {
			echo '<br />'._BY.' <a href="mailto:'.$email.'">'.$c_name.'</a> <span class="thick">('.$email.')</span> '._ON.' '.$datetime;
		} else {
			echo '<br />'._BY.' '.$c_name.' '._ON.' '.$datetime;
		}
			/* If you are admin you can see the Poster IP address */
			/* with this you can see who is flaming you...*/
			/* start avatar in comments mod Tricked Out News */
			echo "<br />";
		if (($c_name != $anonymous) && ($c_name !=$anonymousname)) {
			$sql2 = 'SELECT `user_id`, `user_avatar` FROM `' . $user_prefix . '_users` WHERE `username`="' . $c_name . '"';
			$result2 = $db->sql_query($sql2);
			$row2 = $db->sql_fetchrow($result2);
			$avatar=$row2['user_avatar'];
			$user_id=intval($row2['user_id']);
			if(!empty($avatar) && !preg_match('/blank.gif/i', $avatar)) {
				if(preg_match('/http:/i', $avatar)) {
					echo '<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$user_id.'"><img src="'.$avatar.'" alt="" /></a>';
				} else {
					echo '<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$user_id.'"><img src="modules/Forums/images/avatars/'.$avatar.'" alt="" /></a>';
				}
			} else {
				echo '&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$user_id.'"><img src="images/news/noimage.gif" width="35" height="35" alt="" /></a>';
			}
		}
		/* end avatar in comments mod */
		$journal = '';
		if (is_active('Journal')) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT jid FROM '.$prefix.'_journal WHERE aid=\''.$c_name.'\' AND status=\'yes\' ORDER BY pdate,jid DESC LIMIT 0,1'));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = ' | <a href="modules.php?name=Journal&amp;file=display&amp;jid='.$jid.'">'._JOURNAL.'</a>';
			} else {
				$journal = '';
			}
		}
		if ($c_name != $anonymous) {
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$c_name.'\''));
			$r_uid = intval($row2['user_id']);
			echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$c_name.'">'._USERINFO.'</a> ';
			if(is_active('Private_Messages')) {
				echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$r_uid.'">'._SENDAMSG.'</a>';
			}
			echo $journal.') ';
		}
		$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$c_name.'\''));
		$url = stripslashes($row_url['user_website']);
		if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) { echo '<a href="'.$url.'" target="new">'.$url.'</a> '; }

		if(is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT host_name FROM '.$prefix.'_comments WHERE tid=\''.$tid.'\''));
			$host_name = $row3['host_name'];
			echo '<br /><span class="thick">(IP: '.$host_name.')</span>';
		}
		echo '</p>';
					 // Added for the Tricked Out News Mod to resemble forum post
					  echo  '</td><td width="1%"><img src="images/news/commentline.gif" alt="" />';
					 echo  '</td><td width="69%">';
		// Quake - start
		$options = '';
		$options .= '&amp;mode='.$mode;
		$options .= '&amp;order='.$order;
		$options .= '&amp;thold='.$thold;
		// Quake - end
		if((isset($userinfo['commentmax'])) AND (strlen($comment) > $userinfo['commentmax'])) echo substr($comment, 0, $userinfo['commentmax']).'<br /><span class="thick"><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></span>';
		elseif(strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit).'<br /><span class="thick"><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$sid.'&tid='.$tid.$options.'">'._READREST.'</a></span>';
		else echo $comment;
		echo '</td></tr></table><hr />';
		if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
			echo ' [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$tid.'&amp;sid='.$sid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
		}
		if ($pid != 0) {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT pid FROM '.$prefix.'_comments WHERE tid=\''.$pid.'\''));
			$erin = intval($row4['pid']);
			echo ' | <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$sid.'&amp;pid='.$erin.$options.'">'._PARENT.'</a>';
		}
		modtwo($tid, $score, $reason);

		if(is_admin($admin)) {
			echo ' | <a href="'.$admin_file.'.php?op=RemoveComment&amp;tid='.$tid.'&amp;sid='.$sid.'">'._DELETE.'</a> ]<br />';
		} elseif ($anonpost != 0 OR is_admin($admin) OR is_user($user)) {
			echo ' ]';
		}
		//echo '<br />';

		DisplayKids($tid, $mode, $order, $thold, $level);
		if($hr) echo '<hr noshade="noshade" size="1" />';
		$count_times += 1;
		CloseTable();
	}
	modthree($sid, $mode, $order, $thold);
	//RN0000242: Fix by Montego on 6/12/2006 as this code forces the footer to not be shown if navigated to top through parent links
	//if ($pid==0) {
	//    return array($sid, $pid, $subject);
	//} else {
//        include_once('footer.php');
	//}
	//End Fix by Montego
	echo '</div>';
}
function singlecomment($tid, $sid, $mode, $order, $thold) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $cookie, $db, $datetime, $module_name, $prefix, $reasons, $textcolor2, $user, $userinfo;
	include_once 'header.php';
	if (isset($user)) {
		if (is_user($user)) {
			getusrinfo($user);
		}
	}
	$row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason FROM ' . $prefix . '_comments WHERE tid=\'' . $tid . '\' AND sid=\'' . $sid . '\''));
	$date = $row['date'];
	$name = $row['name'];
	$email = $row['email'];
	$subject = $row['subject'];
	$comment = $row['comment'];
	$score = $row['score'];
	$reason = $row['reason'];
	$titlebar = '<span class="thick">'.$subject.'</span>';
	if (empty($name)) $name = $anonymous;
	if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
	echo '<div class="text-center">'. $subject . '</div>';
	OpenTable();
	echo '<div class="content">';
	modone();
	echo '<table width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="500">';
	if (is_user($user)) {
		userdate($date);
	} else {
		formatTimestamp($date);
	}
	echo '<p><span class="thick">', $subject, '</span> <span style="color:'. $textcolor2. '">';
	if ($userinfo['noscore'] == 0) {
		echo '(', _SCORE, ' ', $score;
		if ($reason > 0) {
			echo ', ', $reason;
		}
		echo ')';
	}
	echo '<br />' . _BY . ' ';
	if (!empty($email)) {
		echo '<a href="mailto:', $email, '">', $name, '</a></span> <span class="thick">(' . $email . ')</span> ';
	} else {
		echo $name, '</span> ';
	}
	echo _ON, ' ', $datetime;
	echo '</p></td></tr><tr><td>' . $comment . '</td></tr></table>';
	if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
		echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid='
			. $tid . '&amp;sid=' . $sid . '">' . _REPLY . '</a> | <a href="modules.php?name='
			. $module_name . '&amp;file=article&amp;sid=' . $sid . '">' . _ROOT . '</a>';
	}
	modtwo($tid, $score, $reason);
	if (is_admin($admin)) {
		echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $tid . '&amp;sid=' . $sid . '">' . _DELETE . '</a> ]<br />';
	} elseif ($anonpost != 0 || is_user($user)) {
		echo ' ]';
	}
	modthree($sid, $mode, $order, $thold);
	echo '</div>';
	CloseTable();
	include_once 'footer.php';
}
function reply($pid, $sid, $mode, $order, $thold) {
	include_once 'header.php';
	global $AllowableHTML, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $cookie, $datetime, $db, $modGFXChk, $module_name, $prefix, $reasons, $user, $userinfo, $advanced_editor;
		if (isset($user)) {
			if (is_user($user)) {
				getusrinfo($user);
			}
		}
	$comment2 = '';  // stop notice errors where fields are empty
	$temp_comment = '';
	$score = '';
	$reason = '';
	echo '<div class="content">';
	if ($anonpost == 0 AND !is_user($user)) {
			echo '<div class="text-center title">'. _COMMENTREPLY . '</div>';
		OpenTable();
		echo '<div class="text-center">' . _NOANONCOMMENTS . '<br />' . _GOBACK . '<br /></div>';
		CloseTable();
	} else {
		if ($pid != 0) {
			list($date, $name, $email, $subject, $comment, $score, $reason) = $db->sql_fetchrow($db->sql_query('select date, name, email, subject, comment, score, reason from ' . $prefix . '_comments where tid=\'' . $pid . '\''));
		} else {
			list($date, $subject, $temp_comment, $comment2, $name, $notes) = $db->sql_fetchrow($db->sql_query('SELECT time, title, hometext, bodytext, informant, notes FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
		}
		if (empty($comment)) {
			$comment = $temp_comment . '<br /><br />' . $comment2;
		}
		echo '<div class="text-center title">'. _COMMENTREPLY . '</div>';
		OpenTable();
		if (empty($name)) $name = $anonymous;
		if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
		if (is_user($user)) {
			userdate($date);
		} else {
			formatTimestamp($date);
		}
		echo '<span class="thick">' . $subject . '</span> ';
		if (empty($temp_comment)) {
			if ($userinfo['noscore'] == 0) {
				echo '(', _SCORE, ' ', $score;
				if ($reason > 0) {
					echo ', ', $reasons[$reason];
				}
				echo ')';
			}
		}
		if (!empty($email)) {
			echo '<br />' . _BY . ' <a href="mailto:' . $email . '">' . $name . '</a> <span class="thick">(' . $email . ')</span> ' . _ON . ' ' . $datetime;
		} else {
			echo '<br />' . _BY . ' ' . $name . ' ' . _ON . ' ' . $datetime;
		}
		echo '<br /><br />' . $comment . '<br /><br />';
		if ($pid == 0) {
			if (!empty($notes)) {
				echo '<span class="thick">' . _NOTE . '</span> <span class="italic">' . $notes . '</span><br /><br />';
			} else {
				echo '';
			}
		}
		if (!isset($pid) || !isset($sid)) {
			echo _SOMETHINGSNOTRIGHT . '</div>';
			exit();
		}
		if ($pid == 0) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
			$subject = $row3['title'];
		} else {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT subject FROM ' . $prefix . '_comments WHERE tid=\'' . $pid . '\''));
			$subject = $row4['subject'];
		}
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">';
		echo '<span class="option thick">' . _YOURNAME . ':</span> ';
		if (is_user($user)) {
			cookiedecode($user);
			echo '<a href="modules.php?name=Your_Account">' . $cookie[1] . '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]<br /><br />';
		} else {
			echo $anonymous;
			echo ' [ <a href="modules.php?name=Your_Account">' . _NEWUSER . '</a> ]<br /><br />';
		}
		echo '<span class="option thick">' . _SUBJECT . ':</span><br />';
		if (!stripos_clone($subject, 'Re:')) $subject = 'Re: ' . substr($subject, 0, 81);
		echo '<input type="text" name="subject" size="50" maxlength="85" value="' . $subject . '" /><br /><br />';
		echo '<span class="option thick">' . _UCOMMENT . ':</span><br />';
		wysiwyg_textarea('comment', '', 'NukeUser', '50', '12');
		if (!isset($advanced_editor) || $advanced_editor == 0) {
			echo '<p>'. _ALLOWEDHTML . '<br />';
			while (list($key) = each($AllowableHTML)) {
				echo ' &lt;' . $key . '&gt;';
			}
			echo '</p>';
		}
		if (is_user($user) AND ($anonpost == 1)) {
			echo '<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br />';
		}
		echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
		echo '<input type="hidden" name="pid" value="' . $pid . '" />'
			. '<input type="hidden" name="sid" value="' . $sid . '" />'
			. '<input type="submit" name="op" value="' . _OK . '" />'
			. '</form>';
		CloseTable();
	}
	echo '</div>';
	include_once 'footer.php';
}
function CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold) {
	global $anonpost, $articlecomm, $cookie, $db, $EditedMessage, $modGFXChk, $module_name, $prefix, $user, $userinfo;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check'];
	else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once 'header.php';
		OpenTable();
		echo '<div class="text-center title">' . _SECCODEINCOR . '<br /><br />';
		echo '[ <a href="javascript:history.go(-1)">' . _GOBACK2 . '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	if (isset($user)) {
		if (is_user($user)) {
			getusrinfo($user);
		}
	}
	$comment = format_url(trim($comment));
	if (is_user($user) AND !$xanonpost) {
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
	$fakeresult = $db->sql_query('SELECT acomm FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\'');
	$fake = $db->sql_numrows($fakeresult);
	if ($fake == 1 AND $articlecomm == 1) {
		$fakerow = $db->sql_fetchrow($fakeresult);
		$acomm = intval($fakerow['acomm']);

		if ((($anonpost == 0 AND is_user($user)) OR $anonpost == 1) AND $acomm == 0) {
			$subject = $db->sql_escape_string($subject);
			$comment = $db->sql_escape_string($comment);
			$db->sql_query('INSERT INTO ' . $prefix . '_comments VALUES (NULL, \'' . $pid . '\', \'' . $sid . '\', now(), \'' . $name . '\', \'' . $email . '\', \'' . $url . '\', \'' . $ip . '\', \'' . $subject . '\', \'' . $comment . '\', \'' . $score . '\',\'0\')');
			$db->sql_query('UPDATE ' . $prefix . '_stories SET comments=comments+1 WHERE sid=\'' . $sid . '\'');
			update_points(5);
		} else {
			die(_NICETRY);
		}
	} else {
		include_once 'header.php';
		echo _ANNOYINGMSG;
		include_once 'footer.php';
	}
	Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
}
function userdate($time) {
	global $datetime, $timestamp, $userinfo;
	convert_datetime($time);
	$userTimeZone = $userinfo['user_timezone'];
	$userDateFormat = $userinfo['user_dateformat'];
	$serverTimeZone = date('Z') /3600;
	if ($serverTimeZone >= 0) {
		$serverTimeZone = '+' . $serverTimeZone;
	}
	$userTimeZone = ($userTimeZone-$serverTimeZone) *3600;
	if (!is_numeric($userTimeZone)) {
		$userTimeZone = 0;
	}
	$datetime = date($userDateFormat, ($timestamp+$userTimeZone));
	return $datetime;
}
// from MySQL to UNIX timestamp
function convert_datetime($str) {
	global $timestamp;
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;
}
?>
