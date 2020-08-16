<?php
/****************************************************************/
/* PHP-NUKE: Web Portal System							*/
/* ===========================							*/
/*												*/
/* Copyright (c) 2002 by Francisco Burzi						*/
/* http://phpnuke.org									*/
/*												*/
/* =====================								*/
/* Base on Reviews Addon								*/
/* Copyright (c) 2000 by Jeff Lambert (jeffx@ican.net)			*/
/* http://www.qchc.com									*/
/* More scripts on http://www.jeffx.qchc.com					*/
/*												*/
/* This program is free software. You can redistribute it and/or modify	*/
/* it under the terms of the GNU General Public License as published by	*/
/* the Free Software Foundation; either version 2 of the License.		*/
/****************************************************************/
/*		 Additional security & Abstraction layer conversion		*/
/*						   2003 chatserv				*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com		*/
/****************************************************************/

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

if (stristr($_SERVER['QUERY_STRING'], '%25')) header('Location: index.php');
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if (!isset($rop)) { $rop = ''; }
if (!isset($page)) { $page = ''; }
if (!isset($field)) { $field = ''; }
if (!isset($order)) { $order = ''; }
if (!isset($date)) { $date = ''; }
if (!isset($hits)) { $hits = ''; }
if (!isset($id)) { $id = ''; }
if (!isset($xanonpost)) { $xanonpost = ''; }
if (!isset($title)) { $title = ''; }

if (strlen($rop) == 1 AND ctype_alnum($rop)) {
	$order = strtoupper($order);
	if ($order != '' && $order != 'DESC' && $order != 'ASC') $order = '';
	reviews($rop, $field, $order);
} else {
	switch ($rop) {
		default:
			reviews_index();
			break;
		case 'showcontent':
			showcontent($id, $page);
			break;
		case 'write_review':
			write_review();
			break;
		case 'preview_review':
			csrf_check();
			preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
			break;
		case 'send_review':
			csrf_check();
			send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
			break;
		case 'del_review':
			csrf_check();
			del_review($id_del);
			break;
		case 'mod_review':
			mod_review($id);
			break;
		case 'postcomment':
			postcomment($id, $title);
			break;
		case 'savecomment':
			csrf_check();
			savecomment($xanonpost, $uname, $id, $score, $comments);
			break;
		case 'del_comment':
			csrf_check();
			del_comment($cid, $id);
			break;
	}
}

die();

function alpha() {
	global $module_name;
	$alphabet = array ('A','B','C','D','E','F','G','H','I','J','K','L','M',
		'N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
	$num = count($alphabet) - 1;
	echo '[ ';
	$counter = 0;
	foreach ($alphabet as $ltr) {
		echo '<a href="modules.php?name=' . $module_name . '&amp;rop=' . $ltr . '">' . $ltr . '</a>';
		if ($counter == round($num/2)) {
			echo ' ]' . "\n" . '<br />' . "\n" . '[ ';
		} elseif ($counter != $num) {
			echo '&nbsp;|&nbsp;' . "\n";
		}
		$counter++;
	}
	echo ' ]<br /><br />' . "\n";
	echo '[ <a href="modules.php?name=' . $module_name . '&amp;rop=write_review">' . _WRITEREVIEW . '</a> ]<br /><br />' . "\n\n";
}

function display_score($score) {
	$image = '<img src="images/blue.gif" alt="" />';
	$halfimage = '<img src="images/bluehalf.gif" alt="" />';
	$full = '<img src="images/star.gif" alt="" />';
	echo $score . '&nbsp;&nbsp;';
	if ($score == 10) {
		for ($i = 0;$i < 5;$i++) {
			echo $full;
		}
	} else if ($score%2) {
		$score -= 1;
		$score /= 2;
		for ($i = 0;$i < $score;$i++) {
			echo $image;
		}
		echo $halfimage;
	} else {
		$score /= 2;
		for ($i = 0;$i < $score;$i++) {
			echo $image;
		}
	}
}

function write_review() {
	global $language, $admin, $sitename, $user, $cookie, $prefix, $user_prefix, $currentlang, $multilingual, $db, $module_name;
	include_once('header.php');
	OpenTable();
	echo '
		<span class="thick">' . _WRITEREVIEWFOR . ' ' . $sitename . '</span><br /><br />
		<span class="italic">' . _ENTERINFO . '</span><br /><br />
		<form method="post" action="modules.php?name=' . $module_name . '">
		<span class="thick">' . _PRODUCTTITLE . ':</span><br />
		<input type="text" name="title" size="50" maxlength="150" /><br />
		<span class="italic">' . _NAMEPRODUCT . '</span><br />';
	if ($multilingual == 1) {
		echo '<br /><span style="font-weight: bold;">' . _LANGUAGE . ':</span>'
			. lang_select_list('rlanguage', $currentlang, false)
			. '<br /><br />';
	} else {
		echo '<input type="hidden" name="rlanguage" value="' . $language . '" /><br /><br />';
	}
	echo '<span class="thick">' . _REVIEW . ':</span><br />';
	wysiwyg_textarea('text', '', 'NukeUser', 60, 18);
	echo '<br />';
	if (is_admin($admin)) {
		echo '<span class="content">' . _PAGEBREAK . '</span><br />';
	}
	echo '
		<span class="italic">' . _CHECKREVIEW . '</span><br /><br />
		<span class="thick">' . _YOURNAME . ':</span><br />';
	if (is_user($user)) {
		$result = $db->sql_query('SELECT username, user_email FROM ' . $user_prefix . '_users WHERE user_id = \'' . intval($cookie[0]) . '\'');
		list($rname, $email) = $db->sql_fetchrow($result);
		$rname = check_html($rname, 'nohtml');
		$email = check_html($email, 'nohtml');
	} else {
		$rname = '';
		$email = '';
	}
	echo '<input type="text" name="reviewer" size="41" maxlength="40" value="' . $rname . '" /><br />
		<span class="italic">' . _FULLNAMEREQ . '</span><br /><br />
		<span class="thick">' . _REMAIL . ':</span><br />
		<input type="text" name="email" size="40" maxlength="80" value="' . $email . '" /><br />
		<span class="italic">' . _REMAILREQ . '</span><br /><br />
		<span class="thick">' . _SCORE . '</span><br />
		<select name="score">
		<option value="10">10</option>
		<option value="9">9</option>
		<option value="8">8</option>
		<option value="7">7</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1</option>
		</select>
		<span class="italic">' . _SELECTSCORE . '</span><br /><br />
		<span class="thick">' . _RELATEDLINK . ':</span><br />
		<input type="text" name="url" size="40" maxlength="100" value="http://" /><br />
		<span class="italic">' . _PRODUCTSITE . '</span><br /><br />
		<span class="thick">' . _LINKTITLE . ':</span><br />
		<input type="text" name="url_title" size="40" maxlength="50" /><br />
		<span class="italic">' . _LINKTITLEREQ . '</span><br /><br />
		';
	if (is_admin($admin)) {
		echo '<span class="thick">' . _RIMAGEFILE . ':</span><br />
			<input type="text" name="cover" size="40" maxlength="100" /><br />
			<span class="italic">' . _RIMAGEFILEREQ . '</span><br /><br />
			';
	} else echo '<input type="hidden" name="cover" value="" /><br />';
	echo '<span class="italic">' . _CHECKINFO . '</span><br /><br />
		<input type="hidden" name="rop" value="preview_review" />
		<input type="submit" value="' . _PREVIEW . '" /> <input type="button" onclick="history.go(-1)" value="' . _CANCEL . '" /></form>
		';
	CloseTable();
	include_once('footer.php');
}

function preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
	global $admin, $multilingual, $module_name;
	if (stristr($text, '<!--pagebreak-->')) {
		$text = str_ireplace('<!--pagebreak-->', '&lt;!--pagebreak--&gt;', $text);
	}
	$title = check_html($title, 'nohtml');
	$text = check_html($text, '');
	$reviewer = check_html($reviewer, 'nohtml');
	$url_title = check_html($url_title, 'nohtml');
	$email = check_html($email, 'nohtml');
	$score = intval($score);
	$cover = check_html($cover, 'nohtml');
	$url = check_html($url, 'nohtml');
	$hits = intval($hits);
	$id = intval($id);
	include_once('header.php');
	OpenTable();
	echo '<form method="post" action="modules.php?name=' . $module_name . '">';
	if (empty($title)) {
		$error = 1;
		echo _INVALIDTITLE . '<br />';
	}
	if (empty($text)) {
		$error = 1;
		echo _INVALIDTEXT . '<br />';
	}
	if (($score < 1) || ($score > 10)) {
		$error = 1;
		echo _INVALIDSCORE . '<br />';
	}
	if (($hits < 0) && ($id != 0)) {
		$error = 1;
		echo _INVALIDHITS . '<br />';
	}
	if (empty($reviewer) || empty($email)) {
		$error = 1;
		echo _CHECKNAME . '<br />';
	} elseif (!empty($reviewer) && !empty($email)) if (!(preg_match('/^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$/i', $email))) {
		$error = 1;
		/* regex checks for a valid email! works nicely for me! */
		echo _INVALIDEMAIL . '<br />';
	}
	if (($url_title != '' && $url == '') || ($url_title == '' && $url != '')) {
		$error = 1;
		echo _INVALIDLINK . '<br />';
	} else if (($url != '') && (!(preg_match('/(^http[s]*:[\/]+)(.*)/i', $url)))) {
		$url = 'http://' . $url;
	}
	/* If the user ommited the http, this nifty regex will add it */
	if (isset($error) AND ($error == 1)) echo '<br />' . _GOBACK;
	else {
		if (empty($date)) $date = date('Y-m-d', time());
		$year2 = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);
		$fdate = date('F jS Y', mktime(0, 0, 0, $month, $day, $year2));
		echo '<p class="title"><span class="italic">' . $title . '</span></p><div>';
		if (!empty($cover)) echo '<img src="images/reviews/' . urlencode($cover) . '" border="1" alt="" />';
		echo $text;
		echo '</div><p><span class="thick">' . _ADDED . '</span> ' . $fdate . '<br />';
		if ($multilingual == 1) {
			echo '<span class="thick">' . _LANGUAGE . '</span> ' . $rlanguage . '<br />';
		}
		echo '<span class="thick">' . _REVIEWER . '</span> <a href="mailto:' . $email . '">' . $reviewer . '</a><br />';
		echo '<span class="thick">' . _SCORE . '</span> ';
		display_score($score);
		if (!empty($url)) echo '<br /><span class="thick">' . _RELATEDLINK . ':</span> <a href="' . $url . '" target="_blank">' . $url_title . '</a>';
		if ($id != 0) {
			echo '<br /><span class="thick">' . _REVIEWID . ':</span> ' . $id . '<br />';
			echo '<span class="thick">' . _HITS . ':</span> ' . $hits . '<br />';
		}
		echo '</p>';
		echo '<p><span class="italic"><span class="thick">' . _LOOKSRIGHT . '</span></span></p>';
		echo '<input type="hidden" name="id" value="' . $id . '" />
			<input type="hidden" name="hits" value="' . $hits . '" />
			<input type="hidden" name="rop" value="send_review" />
			<input type="hidden" name="date" value="' . $date . '" />
			<input type="hidden" name="title" value="' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '" />
			<input type="hidden" name="text" value="' . htmlspecialchars($text, ENT_QUOTES, _CHARSET) . '" />
			<input type="hidden" name="reviewer" value="' . htmlspecialchars($reviewer, ENT_QUOTES, _CHARSET) . '" />
			<input type="hidden" name="email" value="' . $email . '" />
			<input type="hidden" name="score" value="' . $score . '" />
			<input type="hidden" name="url" value="' . htmlspecialchars($url, ENT_QUOTES, _CHARSET) . '" />
			<input type="hidden" name="url_title" value="' . htmlspecialchars($url_title, ENT_QUOTES, _CHARSET) . '" />
			<input type="hidden" name="cover" value="' . htmlspecialchars($cover, ENT_QUOTES, _CHARSET) . '" />
			';
		echo '<input type="hidden" name="rlanguage" value="' . $rlanguage . '" />';
		/*****[BEGIN]******************************************
		[ Base:	GFX Code						   v1.0.0 ]
		******************************************************/
		global $modGFXChk;
		echo security_code($modGFXChk[$module_name], 'stacked') . '<br />';
		/*****[END]********************************************
		[ Base:	GFX Code						   v1.0.0 ]
		******************************************************/
		echo '<input type="submit" value="' . _YES . '" /> <input type="button" onclick="history.go(-1)" value="' . _NO . '" />';
		$id = intval($id);
		if ($id != 0) $word = _RMODIFIED;
		else $word = _RADDED;
		if (is_admin($admin)) echo '<p><span class="thick">' . _NOTE . '</span> ' . _ADMINLOGGED . ' ' . $word . '</p>';
	}
	echo '</form>';
	CloseTable();
	include_once('footer.php');
}

function send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
	global $admin, $EditedMessage, $prefix, $db, $module_name;
	include_once('header.php');
	/*****[BEGIN]******************************************
	[ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	global $modGFXChk;
	$gfx_check = (isset($_POST['gfx_check'])) ? $_POST['gfx_check'] : '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	/*****[END]********************************************
	[ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	if (stristr($text, '<!--pagebreak-->')) {
		$text = str_ireplace('<!--pagebreak-->', '&lt;!--pagebreak--&gt;;', $text);
	}
	/*
	 * Unfortunately, because check_html() will leave any "&" signs in its entity form of "&amp;"
	 * I am not sure what to do with this...  I will have to do an entity decode coming out of the db.
	 */
	$id = intval($id);
	$title = addslashes(check_html($title, 'nohtml'));
	$text = addslashes(check_html($text, ''));
	$reviewer = check_html($reviewer, 'nohtml');
	$url_title = addslashes(check_html($url_title, 'nohtml'));
	$email = addslashes(check_html($email, 'nohtml'));
	$score = intval($score);
	$cover = addslashes(check_html($cover, 'nohtml'));
	$url = addslashes(check_html($url, 'nohtml'));
	$url_title = addslashes(check_html($url_title, 'nohtml'));
	$hits = intval($hits);
	if (stristr($text, '&lt;!--pagebreak--&gt;')) {
		$text = str_ireplace('&lt;!--pagebreak--&gt;', '<!--pagebreak-->', $text);
	}
	OpenTable();
	echo '<br /><div class="text-center">' . _RTHANKS;
	$id = intval($id);
	if ($id != 0) echo ' ' . _MODIFICATION;
	else echo ', ' . $reviewer;
	echo '!<br />';
	if ($score < 0 OR $score > 10) {
		$score = 0;
	}
	$reviewer = addslashes($reviewer);
	if ((is_admin($admin)) && ($id == 0)) {
		$db->sql_query('INSERT INTO ' . $prefix . '_reviews VALUES ' . '(NULL, \'' . $date . '\', \'' . $title . '\', \'' . $text . '\', \'' . $reviewer . '\', \'' . $email . '\', \'' . $score . '\', \'' . $cover . '\', \'' . $url . '\', \'' . $url_title . '\', \'1\', \'' . $rlanguage . '\')');
		echo _ISAVAILABLE;
	} elseif ((is_admin($admin)) && ($id != 0)) {
		$db->sql_query('UPDATE ' . $prefix . '_reviews SET ' . 'date=\'' . $date . '\', title=\'' . $title . '\', text=\'' . $text . '\', reviewer=\'' . $reviewer . '\', email=\'' . $email . '\', score=\'' . $score . '\', cover=\'' . $cover . '\', url=\'' . $url . '\', url_title=\'' . $url_title . '\', hits=\'' . $hits . '\', rlanguage=\'' . $rlanguage . '\' where id = \'' . $id . '\'');
		echo _ISAVAILABLE;
	} else {
		$db->sql_query('INSERT INTO ' . $prefix . '_reviews_add VALUES ' . '(NULL, \'' . $date . '\', \'' . $title . '\', \'' . $text . '\', \'' . $reviewer . '\', \'' . $email . '\', \'' . $score . '\', \'' . $url . '\', \'' . $url_title . '\', \'' . $rlanguage . '\')');
		echo _EDITORWILLLOOK;
	}
	echo '<br /><br />[ <a href="modules.php?name=' . $module_name . '">' . _RBACK . '</a> ]<br /></div>';
	CloseTable();
	include_once('footer.php');
}

function reviews_index() {
	global $bgcolor3, $bgcolor2, $prefix, $multilingual, $currentlang, $db, $module_name;
	include_once('header.php');
	if ($multilingual == 1) {
		$querylang = 'WHERE rlanguage=\'' . $currentlang . '\'';
	} else {
		$querylang = '';
	}
	OpenTable();
	echo '<table border="0" width="95%" cellpadding="2" cellspacing="4" align="center">
		<tr><td colspan="2" class="text-center"><span class="title">' . _RWELCOME . '</span><br /><br /><br />';
	$result = $db->sql_query('select title, description from ' . $prefix . '_reviews_main');
	list($title, $description) = $db->sql_fetchrow($result);
	echo '<span class="thick">' . $title . '</span><br /><br />' . $description . '';
	echo '<br /><br /><br />';
	alpha();
	echo '</td></tr>';
	echo '<tr><td width="50%" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _10MOSTPOP . '</span></td>';
	echo '<td width="50%" bgcolor="' . $bgcolor2 . '"><span class="thick">' . _10MOSTREC . '</span></td></tr>';
	$result_pop = $db->sql_query('SELECT id, title, hits FROM ' . $prefix . '_reviews ' . $querylang . ' ORDER BY hits DESC LIMIT 10');
	$result_rec = $db->sql_query('SELECT id, title, date, hits FROM ' . $prefix . '_reviews ' . $querylang . ' ORDER BY date DESC LIMIT 10');
	$y = 1;
	for ($x = 0;$x < 10;$x++) {
		$myrow = $db->sql_fetchrow($result_pop);
		if (isset($myrow['id'])) {
			$id = intval($myrow['id']);
			$title = $myrow['title'];
			$hits = intval($myrow['hits']);
			echo '<tr><td width="50%" bgcolor="' . $bgcolor3 . '">' . $y . ') <a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '">' . $title . '</a></td>';
		}
		$myrow2 = $db->sql_fetchrow($result_rec);
		if (isset($myrow2['id'])) {
			$id = intval($myrow2['id']);
			$title = $myrow2['title'];
			$hits = intval($myrow2['hits']);
			echo '<td width="50%" bgcolor="' . $bgcolor3 . '">' . $y . ') <a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '">' . $title . '</a></td></tr>';
		}
		$y++;
	}
	echo '<tr><td colspan="2"><br /></td></tr>';
	$result2 = $db->sql_query('SELECT * FROM ' . $prefix . '_reviews ' . $querylang);
	$numresults = $db->sql_numrows($result2);
	echo '<tr><td colspan="2" class="text-center"><br />' . _THEREARE . ' ' . $numresults . ' ' . _REVIEWSINDB . '</td></tr></table>';
	CloseTable();
	include_once('footer.php');
}

function reviews($letter, $field, $order) {
	global $bgcolor4, $sitename, $prefix, $multilingual, $currentlang, $db, $module_name;
	include_once('header.php');
	$letter = substr($letter, 0, 1);
	if ($multilingual == 1) {
		$querylang = 'AND rlanguage=\'' . $currentlang . '\'';
	} else {
		$querylang = '';
	}
	OpenTable();
	echo '<div class="text-center"><span class="thick">' . $sitename . ' ' . _REVIEWS . '</span><br />';
	echo '<span class="italic">' . _REVIEWSLETTER . ' ' . $letter . '</span><br /><br /></div>';
	switch ($field) {
		default:
			$result = $db->sql_query('SELECT id, title, hits, reviewer, score, email FROM ' . $prefix . '_reviews WHERE UPPER(title) LIKE \'' . $letter . '%\' ' . $querylang . ' ORDER by title ' . $order);
			break;
		case 'reviewer':
			$result = $db->sql_query('SELECT id, title, hits, reviewer, score, email FROM ' . $prefix . '_reviews WHERE UPPER(title) LIKE \'' . $letter . '%\' ' . $querylang . ' ORDER by reviewer ' . $order);
			break;
		case 'score':
			$result = $db->sql_query('SELECT id, title, hits, reviewer, score, email FROM ' . $prefix . '_reviews WHERE UPPER(title) LIKE \'' . $letter . '%\' ' . $querylang . ' ORDER by score ' . $order);
			break;
		case 'hits':
			$result = $db->sql_query('SELECT id, title, hits, reviewer, score, email FROM ' . $prefix . '_reviews WHERE UPPER(title) LIKE \'' . $letter . '%\' ' . $querylang . ' ORDER by hits ' . $order);
			break;
	}
	$numresults = $db->sql_numrows($result);
	if ($numresults == 0) {
		echo '<div class="text-center italic thick">' . _NOREVIEWS . ' ' . $letter . '<br /><br /></div>';
	} elseif ($numresults > 0) {
		echo '<table border="0" width="100%" cellpadding="2" cellspacing="4">
			<tr>
			<td width="50%" bgcolor="' . $bgcolor4 . '" align="left">
			<a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=title&amp;order=asc" title="' . _SORTASC . '"><img src="images/up.gif" border="0" width="15" height="9" alt="' . _SORTASC . '" /></a><span class="thick"> ' . _PRODUCTTITLE . ' </span><a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=title&amp;order=DESC" title="' . _SORTDESC . '"><img src="images/down.gif" border="0" width="15" height="9" alt="' . _SORTDESC . '" /></a>
			</td>
			<td width="18%" bgcolor="' . $bgcolor4 . '" align="center">
			<a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=reviewer&amp;order=asc" title="' . _SORTASC . '"><img src="images/up.gif" border="0" width="15" height="9" alt="' . _SORTASC . '" /></a><span class="thick"> ' . _REVIEWER . ' </span><a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=reviewer&amp;order=desc" title="' . _SORTDESC . '"><img src="images/down.gif" border="0" width="15" height="9" alt="' . _SORTDESC . '" /></a>
			</td>
			<td width="18%" bgcolor="' . $bgcolor4 . '" align="center">
			<a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=score&amp;order=asc" title="' . _SORTASC . '"><img src="images/up.gif" border="0" width="15" height="9" alt="' . _SORTASC . '" /></a><span class="thick"> ' . _SCORE . ' </span><a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=score&amp;order=DESC" title="' . _SORTDESC . '"><img src="images/down.gif" border="0" width="15" height="9" alt="' . _SORTDESC . '" /></a>
			</td>
			<td width="14%" bgcolor="' . $bgcolor4 . '" align="center">
			<a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=hits&amp;order=asc" title="' . _SORTASC . '"><img src="images/up.gif" border="0" width="15" height="9" alt="' . _SORTASC . '" /></a><span class="thick"> ' . _HITS . ' </span><a href="modules.php?name=' . $module_name . '&amp;rop=' . $letter . '&amp;field=hits&amp;order=DESC" title="' . _SORTDESC . '"><img src="images/down.gif" border="0" width="15" height="9" alt="' . _SORTDESC . '" /></a>
			</td>
			</tr>';
		while ($myrow = $db->sql_fetchrow($result)) {
			$title = $myrow['title'];
			$id = intval($myrow['id']);
			$reviewer = $myrow['reviewer'];
			$email = $myrow['email'];
			$score = intval($myrow['score']);
			$hits = intval($myrow['hits']);
			echo '<tr>
				<td width="50%" bgcolor="' . $bgcolor4 . '"><a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '">' . $title . '</a></td>
				<td width="18%" bgcolor="' . $bgcolor4 . '"';
			if (!empty($reviewer)) {
				echo ' class="text-center">' , $reviewer;
			} else {
				echo '">';
			}
			echo '</td><td width="18%" bgcolor="' . $bgcolor4 . '" align="center">';
			display_score($score);
			echo '</td><td width="14%" bgcolor="' . $bgcolor4 . '" align="center">' . $hits . '</td>
				</tr>';
		}
		echo '</table>';
		echo '<br />' . $numresults . ' ' . _TOTALREVIEWS . '<br /><br />';
	}
	echo '<div class="text-center">[ <a href="modules.php?name=' . $module_name . '">' . _RETURN2MAIN . '</a> ]</div>';
	CloseTable();
	include_once('footer.php');
}

function postcomment($id, $title) {
	global $user, $cookie, $AllowableHTML, $anonymous, $module_name, $anonpost;
	if (!is_user($user) && $anonpost == 0) {
		include_once('header.php');
		title($module_name);
		OpenTable();
		echo '<div class="text-center"><p><span class="thick">' . _RESTRICTEDAREA . '</span></p><p>' . _MODULEUSERS . '</p></div>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	include_once('header.php');
	cookiedecode($user);
	$id = intval($id);
	$result = $db->sql_query('SELECT title FROM ' . $prefix . '_reviews WHERE id=\'' . $id . '\'');
	list($title) = $db->sql_fetchrow($result);
	$title = check_html($title, 'nohtml');
	OpenTable();
	echo '<div class="text-center"><span class="option">' . _REVIEWCOMMENT . '</span> ' . $title . '<br /><br /></div>'
		. '<form action="modules.php?name=' . $module_name . '" method="post">';
	if (!is_user($user)) {
		echo '<span class="thick">' . _YOURNICK . '</span> ' . $anonymous . ' [ ' . _RCREATEACCOUNT . ' ]<br /><br />';
		$uname = $anonymous;
	} else {
		$uname = $cookie[1];
		echo '<span class="thick">' . _YOURNICK . '</span> ' . $cookie[1] . '<br />
			<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br /><br />
			<input type="hidden" name="uname" value="' . $uname . '" />
			<input type="hidden" name="id" value="' . $id . '" />
			<span class="thick">' . _SELECTSCORE . '</span>
			<select name="score">
			<option value="10">10</option>
			<option value="9">9</option>
			<option value="8">8</option>
			<option value="7">7</option>
			<option value="6">6</option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
			</select><br /><br />
			<span class="thick">' . _YOURCOMMENT . '</span><br />
			<textarea name="comments" rows="10" cols="70"></textarea><br />
			' . _ALLOWEDHTML . '<br />';
		while (list($key,) = each($AllowableHTML)) {
			echo ' &lt;' . $key . '&gt;';
		}
		/*****[BEGIN]******************************************
		[ Base:	GFX Code						   v1.0.0 ]
		******************************************************/
		global $modGFXChk;
		echo '<br /><br />' . security_code($modGFXChk[$module_name], 'stacked');
		/*****[END]********************************************
		[ Base:	GFX Code						   v1.0.0 ]
		******************************************************/
		echo '<br /><br />
			<input type="hidden" name="rop" value="savecomment" />
			<input type="submit" value="Submit" />
			</form>';
	}
	CloseTable();
	include_once 'footer.php';
}

function savecomment($xanonpost, $uname, $id, $score, $comments) {
	global $anonymous, $user, $cookie, $prefix, $db, $module_name, $user_prefix, $anonpost;
	/*****[BEGIN]******************************************
	[ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	global $modGFXChk;
	$gfx_check = (isset($_POST['gfx_check'])) ? $_POST['gfx_check'] : '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	/*****[END]********************************************
	[ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	if (!is_user($user) && $anonpost == 0) {
		include_once('header.php');
		title($module_name);
		OpenTable();
		echo '<div class="text-center"><span class="thick">' . _RESTRICTEDAREA . '</span><br /><br />' . _MODULEUSERS . '</div>';
		CloseTable();
		include_once('footer.php');
	}
	if ($xanonpost) {
		$uname = $anonymous;
	}
	echo $comments . '<br />';
	$comments = addslashes(check_html($comments, ''));
	$id = intval($id);
	$score = intval($score);
	$db->sql_query('INSERT INTO ' . $prefix . '_reviews_comments VALUES ' . '(NULL, \'' . $id . '\', \'' . $uname . '\', now(), \'' . $comments . '\', \'' . $score . '\')');
	update_points(12);
	Header('Location: modules.php?name=' . $module_name . '&rop=showcontent&id=' . $id);
}

function r_comments($id, $title) {
	global $admin, $prefix, $db, $module_name, $anonymous;
	$id = intval($id);
	$result = $db->sql_query('SELECT cid, userid, date, comments, score FROM ' . $prefix . '_reviews_comments WHERE rid=\'' . $id . '\' ORDER BY date DESC');
	while ($row = $db->sql_fetchrow($result)) {
		$cid = intval($row['cid']);
		$uname = $row['userid'];
		$date = $row['date'];
		$comments = $row['comments'];
		$score = intval($row['score']);
		OpenTable();
		echo '<p><span class="thick">' . $title . '</span><br />';
		if ($uname == $anonymous) {
			echo _POSTEDBY . ' ' . $uname . ' ' . _ON . ' ' . $date . '<br />';
		} else {
			echo _POSTEDBY . ' <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $uname . '">' . $uname . '</a> ' . _ON . ' ' . $date . '<br />';
		}
		echo _MYSCORE . ' ';
		display_score($score);
		if (is_admin($admin)) {
			echo '<br /><span class="thick">' . _ADMIN . '</span> [ <a class="rn_csrf" href="modules.php?name=' . $module_name . '&amp;rop=del_comment&amp;cid=' . $cid . '&amp;id=' . $id . '">' . _DELETE . '</a> ]</p><hr noshade="noshade" size="1" /><br />';
		} else {
			echo '</p><hr noshade="noshade" size="1" /><br />';
		}
		$comments = check_words($comments);
		echo $comments;
		CloseTable();
		echo '<br />';
	}
}

function showcontent($id, $page) {
	global $admin, $uimages, $prefix, $db, $module_name;
	$id = intval($id);
	$page = intval($page);
	include_once('header.php');
	OpenTable();
	if (($page == 1) OR (empty($page))) {
		$db->sql_query('UPDATE ' . $prefix . '_reviews SET hits=hits+1 WHERE id=\'' . $id . '\'');
	}
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_reviews WHERE id=\'' . $id . '\'');
	$myrow = $db->sql_fetchrow($result);
	$date = $myrow['date'];
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	$fdate = date('F jS Y', mktime(0, 0, 0, $month, $day, $year));
	$title = $myrow['title'];
	$text = $myrow['text'];
	$cover = $myrow['cover'];
	$reviewer = $myrow['reviewer'];
	$email = $myrow['email'];
	$hits = intval($myrow['hits']);
	$url = $myrow['url'];
	$url_title = $myrow['url_title'];
	$score = intval($myrow['score']);
	$rlanguage = $myrow['rlanguage'];
	$contentpages = explode('<!--pagebreak-->', $text);
	$pageno = count($contentpages);
	if ($page == '' || $page < 1) $page = 1;
	if ($page > $pageno) $page = $pageno;
	$arrayelement = (int)$page;
	$arrayelement--;
	echo '<p class="title"><span class="italic">' . $title . '</span></p>';
	echo '<div align="left">';
	if (!empty($cover)) echo '<img src="images/reviews/' . $cover . '" align="right" border="1" vspace="2" alt="" />';
	echo $contentpages[$arrayelement] . '</div><p>';
	if (is_admin($admin)) echo '<span class="thick">' . _ADMIN . '</span> [ <a href="modules.php?name=' . $module_name . '&amp;rop=mod_review&amp;id=' . $id . '">' . _EDIT . '</a> | <a class="rn_csrf" href="modules.php?name=' . $module_name . '&amp;rop=del_review&amp;id_del=' . $id . '">' . _DELETE . '</a> ]<br />';
	echo '<span class="thick">' . _ADDED . '</span> ' . $fdate . '<br />';
	if (!empty($reviewer)) echo '<span class="thick">' . _REVIEWER . '</span> <a href="mailto:' . $email . '">' . $reviewer . '</a><br />';
	if (!empty($score)) echo '<span class="thick">' . _SCORE . '</span> ';
	display_score($score);
	if (!empty($url)) echo '<br /><span class="thick">' . _RELATEDLINK . ':</span> <a href="' . $url . '" target="_blank">' . $url_title . '</a>';
	echo '<br /><span class="thick">' . _HITS . ':</span> ' . $hits;
	echo '<br /><span class="thick">' . _LANGUAGE . ':</span> ' . $rlanguage . '</p>';
	if ($pageno > 1) {
		echo '<br /><span class="thick">' . _PAGE . ':</span> ' . $page . '/' . $pageno . '<br />';
	}
	$next_page = '';
	if ($page < $pageno) {
		$next_pagenumber = $page + 1;
		if ($page != 1) {
			$next_page .= '<img src="images/blackpixel.gif" width="10" height="2" border="0" alt="" /> &nbsp;&nbsp; ';
		}
		$next_page .= '<a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '&amp;page=' . $next_pagenumber . '">' . _NEXT . ' (' . $next_pagenumber . '/' . $pageno . ')</a> <a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '&amp;page=' . $next_pagenumber . '"><img src="images/right.gif" border="0" alt="' . _NEXT . '" /></a>';
	}
	if ($page <= 1) {
		$previous_page = '';
	} else {
		$previous_pagenumber = $page - 1;
		$previous_page = '<a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '&amp;page=' . $previous_pagenumber . '"><img src="images/left.gif" border="0" alt="' . _PREVIOUS . '" /></a> <a href="modules.php?name=' . $module_name . '&amp;rop=showcontent&amp;id=' . $id . '&amp;page=' . $previous_pagenumber . '">' . _PREVIOUS . ' (' . $previous_pagenumber . '/' . $pageno . ')</a>';
	}
	echo '<div class="text-center">'
		. $previous_page . ' &nbsp;&nbsp; ' . $next_page . '<br /><br />'
		. '[ <a href="modules.php?name=' . $module_name . '">' . _RBACK . '</a> | '
		. '<a href="modules.php?name=' . $module_name . '&amp;rop=postcomment&amp;id=' . $id . '">' . _REPLYMAIN . '</a> ]</div>';
	CloseTable();
	if (($page == 1) OR (empty($page))) {
		echo '<br />';
		r_comments($id, $title);
	}
	include_once('footer.php');
}

function mod_review($id) {
	global $admin, $prefix, $db, $module_name, $advanced_editor, $multilingual, $language;
	$id = intval($id);
	include_once('header.php');
	OpenTable();
	if (($id == 0) || (!is_admin($admin))) echo 'This function must be passed argument id, or you are not admin.';
	elseif (($id != 0) && (is_admin($admin))) {
		$result = $db->sql_query('SELECT * FROM ' . $prefix . '_reviews WHERE id = \'' . $id . '\'');
		while ($myrow = $db->sql_fetchrow($result)) {
			$date = $myrow['date'];
			$title = $myrow['title'];
			$text = $myrow['text'];
			$cover = $myrow['cover'];
			$reviewer = $myrow['reviewer'];
			$email = $myrow['email'];
			$hits = intval($myrow['hits']);
			$url = $myrow['url'];
			$url_title = $myrow['url_title'];
			$score = intval($myrow['score']);
			$rlanguage = $myrow['rlanguage'];
		}
		echo '<div class="text-center thick"><p>' , _REVIEWMOD , '</p></div>';
		echo '<form method="post" action="modules.php?name=' . $module_name . '&amp;rop=preview_review"><input type="hidden" name="id" value="' . $id . '" />';
		echo '<table border="0" width="100%">
			<tr>
			<td width="12%"><span class="thick">' . _RDATE . '</span></td>
			<td><input type="text" name="date" size="15" value="' . $date . '" maxlength="10" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _RTITLE . '</span></td>
			<td><input type="text" name="title" size="50" maxlength="150" value="' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '" /></td>
			</tr>
			<tr>';
		if ($multilingual == 1) {
			echo '<td width="12%"><span style="font-weight: bold;">' . _LANGUAGE . ':</span></td>'
				. '<td>' . lang_select_list('rlanguage', $rlanguage, false)
				. '</td></tr>';
		} else {
			echo '<td width="12%"><input type="hidden" name="rlanguage" value="' . $language . '" /></td>'
				. '</td></tr>';
		}
		echo '<tr>
			<td width="12%"><span class="thick">' . _RTEXT . '</span></td>
			<td><div>';
		if (!isset($advanced_editor) || $advanced_editor == 0) $text = htmlentities($text, ENT_QUOTES); //montego - Necessary to pass XHTML compliance when not using the editor
		wysiwyg_textarea('text', $text, 'NukeUser', 60, 23);
		echo '</div></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _REVIEWER . '</span></td>
			<td><input type="text" name="reviewer" size="41" maxlength="40" value="' . htmlspecialchars($reviewer, ENT_QUOTES, _CHARSET) . '" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _REVEMAIL . '</span></td>
			<td><input type="text" name="email" value="' . $email . '" size="30" maxlength="80" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _SCORE . '</span></td>
			<td><input type="text" name="score" value="' . $score . '" size="3" maxlength="2" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _RLINK . '</span></td>
			<td><input type="text" name="url" value="' . htmlspecialchars($url, ENT_QUOTES, _CHARSET) . '" size="30" maxlength="100" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _RLINKTITLE . '</span></td>
			<td><input type="text" name="url_title" value="' . htmlspecialchars($url_title, ENT_QUOTES, _CHARSET) . '" size="30" maxlength="50" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _COVERIMAGE . '</span></td>
			<td><input type="text" name="cover" value="' . htmlspecialchars($cover, ENT_QUOTES, _CHARSET) . '" size="30" maxlength="100" /></td>
			</tr>
			<tr>
			<td width="12%"><span class="thick">' . _HITS . ':</span></td>
			<td><input type="text" name="hits" value="' . $hits . '" size="5" maxlength="5" /></td>
			</tr>
			</table>';
		echo '<input type="hidden" name="rop" value="preview_review" /><input type="submit" value="' . _PREMODS . '" />&nbsp;&nbsp;<input type="button" onclick="history.go(-1)" value="' . _CANCEL . '" /></form>';
	}
	CloseTable();
	include_once('footer.php');
}

function del_review($id_del) {
	global $admin, $prefix, $db, $module_name;
	$id_del = intval($id_del);
	if (is_admin($admin)) {
		$db->sql_query('DELETE FROM ' . $prefix . '_reviews WHERE id = \'' . $id_del . '\'');
		$db->sql_query('DELETE FROM ' . $prefix . '_reviews_comments WHERE rid=\'' . $id_del . '\'');
		Header('Location: modules.php?name=' . $module_name);
		die();
	} else {
		echo 'ACCESS DENIED';
	}
}

function del_comment($cid, $id) {
	global $admin, $prefix, $db, $module_name;
	$id = intval($id);
	$cid = intval($cid);
	if (is_admin($admin)) {
		$db->sql_query('DELETE FROM ' . $prefix . '_reviews_comments WHERE cid=' . $cid);
		Header('Location: modules.php?name=' . $module_name . '&rop=showcontent&id=' . $id);
		die();
	} else {
		echo 'ACCESS DENIED';
	}
}

?>