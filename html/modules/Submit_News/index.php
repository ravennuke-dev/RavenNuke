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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
#########################################################################

if ( !defined('MODULE_FILE') ) {
	die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$story = isset($_POST['story']) ? $_POST['story'] : '';
$storyext = isset($_POST['storyext']) ? $_POST['storyext'] : '';
$tags = isset($_POST['tags']) ? $_POST['tags'] : '';
$topic = isset($_POST['topic']) ? $_POST['topic'] : '';
$alanguage = isset($_POST['alanguage']) ? $_POST['alanguage'] : '';

$op = isset($_POST['op']) ?  $_POST['op'] : '';
switch($op) {
	case _PREVIEW:
		csrf_check();
		PreviewStory($subject, $story, $storyext, $tags, $topic, $alanguage);
		break;

	case _OK:
		csrf_check();
		SubmitStory($subject, $story, $storyext, $tags, $topic, $alanguage);
		break;

	default:
		defaultDisplay();
		break;
}
die();

/**
* Only functions below this line
*/

function defaultDisplay() {
	global $advanced_editor, $AllowableHTML, $anonymous, $db, $language, $module_name, $multilingual, $prefix, $user, $anonpost;

	if ($anonpost == 0 && !is_user($user)) {
		header('Location: index.php');
		exit;
	}

	include_once 'header.php';

	OpenTable();
	echo '<div class="text-center"><p class="title thick">' , _SUBMITNEWS , '</p>'
		, '<p class="content italic">' , _SUBMITADVICE , '</p></div>';
	CloseTable();

	OpenTable();
	if (is_user($user)) {
		$userinfo = getusrinfo($user);
	} else {
		$userinfo = array();
	}

	echo '<div class="content"><form action="modules.php?name=' , $module_name , '" method="post">'
		, '<p><span class="thick">' , _YOURNAME , ':</span> ';

	if ($userinfo) {
		echo '<a href="modules.php?name=Your_Account">' , htmlentities($userinfo['username'], ENT_QUOTES, _CHARSET) , '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' , _LOGOUT , '</a> ]';
	} else {
		echo $anonymous , ' [ <a href="modules.php?name=Your_Account">' , _NEWUSER , '</a> ]';
	}

	echo '</p><p>'
		, '<span class="thick">' , _SUBTITLE , ':</span> '
		, '(' , _BEDESCRIPTIVE , ')<br />'
		, '<input type="text" name="subject" size="50" maxlength="80" /><br />(' , _BADTITLES , ')'
		, '</p><p>'
		, '<span class="thick">' , _TOPIC , ':</span> <select name="topic">'
		, '<option value="" selected="selected">' , _SELECTTOPIC , '</option>';

	$result = $db->sql_query('SELECT `topicid`, `topictext` FROM `' . $prefix . '_topics` ORDER BY `topictext`');
	while (list($topicid, $topics) = $db->sql_fetchrow($result, SQL_NUM)) {
		echo '<option value="' , $topicid , '">' , htmlentities($topics, ENT_QUOTES, _CHARSET) , '</option>';
	}
	echo '</select></p>';

	if ($multilingual == 1) {
		echo '<p><span class="thick">' , _LANGUAGE , '</span><br />'
			, lang_select_list('alanguage', $language) , '</p>';
	} else {
		echo '<input type="hidden" name="alanguage" value="' , $language , '" />';
	}

	echo '<div><span class="thick">' , _STORYTEXT , ':</span> (' , _HTMLISFINE , ')<br />';
	wysiwyg_textarea('story', '', 'NukeUser', '50', '12');
	echo '</div><div><span class="thick">' , _EXTENDEDTEXT , ':</span><br />';
	wysiwyg_textarea('storyext', '', 'NukeUser', '50', '12');
	echo '</div><p>' , _AREYOUSURE , '</p><p>'
		, '<br />' , _TAGSCLOUD , ': <input type="text" name="tags" size="40" maxlength="255" /><span>(' , _SEPARATEDBYCOMMAS , ')</span><br /><br />';

	if (!isset($advanced_editor) || $advanced_editor == 0) {
		echo _ALLOWEDHTML , '<br />';
		while (list($key) = each($AllowableHTML)) {
			echo ' &lt;' , $key , '&gt;';
		}
	}

	echo '</p><p><input type="submit" name="op" value="' , _PREVIEW , '" />&nbsp;&nbsp;'
		, '<br />(' , _SUBPREVIEW , ')</p></form></div>';
	CloseTable();

	include_once 'footer.php';
}

function PreviewStory($subject, $story, $storyext, $tags, $topic, $alanguage) {
	global $advanced_editor, $AllowableHTML, $anonymous, $bgcolor1, $bgcolor2, $language, $modGFXChk, $module_name, $multilingual, $user, $anonpost;

	if ($anonpost == 0 && !is_user($user)) {
		header('Location: index.php');
		exit;
	}

	include_once 'header.php';

	/**
	* Until we repalce KSES we are stuck doing this decodoing of special characters
	*/
	$subject = htmlentities(htmlspecialchars_decode(check_html($subject, 'nohtml'), ENT_QUOTES), ENT_QUOTES, _CHARSET);
	$story = check_html($story);
	$storyext = check_html($storyext);
	$tags = htmlentities(htmlspecialchars_decode(check_html($tags, 'nohtml'), ENT_QUOTES), ENT_QUOTES, _CHARSET);
	$topic = (int) $topic;

	title(_NEWSUBPREVIEW);
	OpenTable();
	echo '<div class="text-center italic">' , _STORYLOOK , '</div>'
		, '<table width="70%" bgcolor="' , $bgcolor2 , '" cellpadding="0" cellspacing="1" border="0" class="centered"><tr><td>'
		, '<table width="100%" bgcolor="' , $bgcolor1 , '" cellpadding="8" cellspacing="1" border="0"><tr><td>';
	if (empty($topic)) {
		$topicimage='AllTopics.gif';
		$warning = '<div class="text-center"><p><span class="thick">'._SELECTTOPIC.'</span></p></div>';
	} else {
		$warning = '';
		list($topicimage) = $db->sql_fetchrow($db->sql_query('SELECT `topicimage` FROM `' . $prefix . '_topics` WHERE `topicid`=\'' . $topic . '\''), SQL_NUM);
	}
	echo '<img src="images/topics/' , $topicimage , '" border="0" align="right" alt="" />';
	$story2 = $story . '<br /><br />' . $storyext;
	themepreview($subject, $story2);
	echo $warning
		, '</td></tr></table></td></tr></table>'
		, '<div class="text-center"><p class="tiny">' , _CHECKSTORY , '</p></div>';
	CloseTable();

	OpenTable();
	echo '<div class="content"><form action="modules.php?name=' , $module_name , '" method="post">'
		, '<p><span class="thick">' , _YOURNAME , ':</span> ';
	if (is_user($user)) {
		$userinfo = getusrinfo($user);
		echo '<a href="modules.php?name=Your_Account">' , htmlentities($userinfo['username'], ENT_QUOTES, _CHARSET) , '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' , _LOGOUT , '</a> ]';
	} else {
		echo $anonymous;
	}

	echo '</p><p><span class="thick">' , _SUBTITLE , ':</span><br />'
		, '<input type="text" name="subject" size="50" maxlength="80" value="' , $subject , '" />'
		, '</p><p><span class="thick">' , _TOPIC , ': </span><select name="topic">';
	$sel = ($topic == 0) ? ' selected="selected"' : '';
	echo '<option value=""' . $sel . '>' , _SELECTTOPIC , '</option>';
	$result = $db->sql_query('SELECT `topicid`, `topictext` FROM `' . $prefix . '_topics` ORDER BY `topictext`');
	while (list($topicid, $topics) = $db->sql_fetchrow($result, SQL_NUM)) {
		$sel = ($topicid == $topic) ? ' selected="selected"' : '';
		echo '<option value="' , $topicid , '"' , $sel , '>' , $topics , '</option>';
	}
	echo '</select></p>';

	if ($multilingual == 1) {
		echo '<p><span class="thick">' , _LANGUAGE , '</span><br />'
			, lang_select_list('alanguage', $alanguage) , '</p>';
	} else {
		echo '<input type="hidden" name="alanguage" value="' , $language , '" />';
	}
	echo '<div><span class="thick">' , _STORYTEXT , ':</span> (' , _HTMLISFINE , ')<br />';
	if (!isset($advanced_editor) || $advanced_editor == 0) {
		$story = htmlspecialchars($story, ENT_QUOTES, _CHARSET);
		$storyext = htmlspecialchars($storyext, ENT_QUOTES, _CHARSET);
	}
	wysiwyg_textarea('story', $story, 'NukeUser', '50', '12');
	echo '</div><div><span class="thick">' , _EXTENDEDTEXT , ':</span><br />';
	wysiwyg_textarea('storyext', $storyext, 'NukeUser', '50', '12');
	echo '</div><p>' , _AREYOUSURE , '</p>'
		, '<br />' , _TAGSCLOUD , ': <input type="text" name="tags" value="' , $tags , '" size="40" maxlength="255" /><span>(' , _SEPARATEDBYCOMMAS , ')</span><br /><br />';
	if (!isset($advanced_editor) || $advanced_editor == 0) {
		echo '<p>' , _ALLOWEDHTML , '<br />';
		while (list($key,) = each($AllowableHTML)) {
			echo ' &lt;' , $key , '&gt;';
		}
		echo '</p>';
	}

	echo security_code($modGFXChk[$module_name], 'stacked')
		, '<br /><input type="submit" name="op" value="' , _PREVIEW , '" />&nbsp;&nbsp;'
		, '<input type="submit" name="op" value="' , _OK , '" />'
		, '</form></div>';
	CloseTable();

	include_once 'footer.php';
}

function SubmitStory($subject, $story, $storyext, $tags, $topic, $alanguage) {
	global $advanced_editor, $AllowableHTML, $anonymous, $bgcolor1, $bgcolor2, $language, $modGFXChk, $module_name, $multilingual, $nuke_config, $user;

	include_once 'header.php';

	OpenTable();
	$gfx_check = isset($_POST['gfx_check']) ? $_POST['gfx_check'] : '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-2)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}

	if (is_user($user)) {
		$userinfo = getusrinfo($user);
		$uid = $userinfo['user_id'];
		$name = $userinfo['username'];
	} else {
		$uid = 1;
		$name = $anonymous;
	}

	/**
	* Until we repalce KSES we are stuck doing this decodoing of special characters
	*/
	$subject =  $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'), ENT_QUOTES));
	$story =  $db->sql_escape_string(check_html($story, ''));
	$storyext =  $db->sql_escape_string(check_html($storyext, ''));
	$name = $db->sql_escape_string($name);
	$topic =  (int) $topic;
	$alanguage = $db->sql_escape_string($alanguage);

	$result = $db->sql_query('INSERT INTO `' . $prefix . '_queue` VALUES (NULL, \'' . $uid . '\', \'' . $name . '\', \'' . $subject . '\', \'' . $story . '\', \'' . $storyext
					 . '\', now(), \'' . $topic . '\', \'' . $alanguage . '\')');
	if(!$result) {
		echo '<p>' , _ERROR , '</p>';
		CloseTable();
		include_once 'footer.php';
		die();
	}

	$sql_id = $db->sql_query('SELECT `qid` FROM `' . $prefix . '_queue` WHERE `uname`="' . $name . '" AND `subject`="' . $subject . '" AND `topic`="' . $topic . '"');
	list($qid) = $db->sql_fetchrow($sql_id, SQL_NUM);
	if (!empty($tags)) {
		$tags = explode(',', $tags);
		foreach ($tags as $tag) {
			$tag =  $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml'), ENT_QUOTES));
			$db->sql_query('INSERT INTO `' . $prefix . '_tags_temp` (tag, cid, whr) VALUES ("' . trim($tag) . '", "' . $qid . '", "6")');
		}
	}

	if($nuke_config['notify']) {
		$notify_message = $notify_message . "\n\n\n" . '========================================================' . "\n" . $subject . "\n\n\n" . $story . "\n\n" . $storyext . "\n\n" . $name;
		$mailsuccess = false;
		if (defined('TNML_IS_ACTIVE') and validate_mail($nuke_config['notify_from']) !== false) {
			$mailsuccess = tnml_fMailer($nuke_config['notify_email'], $nuke_config['notify_subject'], $notify_message, $nuke_config['notify_from'], $nuke_config['sitename']);
		} else {
			$mailsuccess = mail($nuke_config['notify_email'], $nuke_config['notify_subject'], $notify_message, 'From: ' . $nuke_config['sitename'] . ' <' . $nuke_config['notify_from'] . '>' . "\n" . 'X-Mailer: PHP/' . phpversion());
		}
	}

	$waiting = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_queue`'));
	echo '<div class="text-center"><p class="title">' , _SUBSENT , '</p></div>'
		, '<div class="content text-center"><p class="thick">' , _THANKSSUB , '</p>'
		, '<p>' , _SUBTEXT , '</p>'
		, '<p>' , _WEHAVESUB , ' ' , $waiting , ' ' , _WAITING , '</p></div>';
	CloseTable();

	include_once 'footer.php';
}

?>