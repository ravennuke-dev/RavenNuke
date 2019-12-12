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
if (!file_exists('includes/nukesentinel.php')) {
	if (stripos_clone($_SERVER['QUERY_STRING'], '%25')) header('Location: index.php');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- ' . _RECOMMEND;
if (empty($sid)) {Header('Location: index.php');}
if (!is_user($user)) {
	Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
	die();
}
switch ($op) {
	case 'SendStory':
		csrf_check();
		SendStory($sid, $yname, $ymail, $fname, $fmail);
		break;
	case 'FriendSend':
		FriendSend($sid);
		break;
}
die();
//Only functions below this line
function FriendSend($sid) {
	global $user, $cookie, $prefix, $db, $user_prefix, $module_name;
	$sid = intval($sid);
	if (!isset($sid)) exit();
	include_once 'header.php';
	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
	$title = $row['title'];
	title(_FRIEND);
	OpenTable();
	echo '<div style="text-align:center;"><p class="content"><strong>' . _FRIEND . '</strong></p></div><br /><br />'
		. _YOUSENDSTORY . ' <strong>' . $title . '</strong> ' . _TOAFRIEND . '<br /><br />'
		. '<form action="modules.php?name=' . $module_name . '&amp;file=friend" method="post">'
		. '<input type="hidden" name="sid" value="' . $sid . '" />';
	if (is_user($user)) {
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, username, user_email FROM ' . $user_prefix . '_users WHERE user_id = \'' . intval($cookie[0]) . '\''));
		if (empty($row['name'])) {
			$yn = $row2['username'];
		} else {
			$yn = $row2['name'];
		}
		$ye = $row2['user_email'];
	}
	echo '<strong>' . _FYOURNAME . ' </strong> ' . $yn . ' <input type="hidden" name="yname" value="' . $yn . '" /><br /><br />'
		. '<strong>' . _FYOUREMAIL . ' </strong> ' . $ye . ' <input type="hidden" name="ymail" value="' . $ye . '" /><br /><br /><br />'
		. '<strong>' . _FFRIENDNAME . ' </strong> <input type="text" name="fname" /><br /><br />'
		. '<strong>' . _FFRIENDEMAIL . ' </strong> <input type="text" name="fmail" /><br /><br />';
	/*****[BEGIN]******************************************
	[ Base:    GFX Code                           v1.0.0 ]
	******************************************************/
	global $modGFXChk;
	echo security_code($modGFXChk[$module_name], 'stacked');
	/*****[END]********************************************
	[ Base:    GFX Code                           v1.0.0 ]
	******************************************************/
	echo '<input type="hidden" name="op" value="SendStory" />'
		. '<input type="submit" value="' . _SEND . '" />'
		. '</form>';
	CloseTable();
	include_once 'footer.php';
}
function SendStory($sid, $yname, $ymail, $fname, $fmail) {
	global $sitename, $nukeurl, $prefix, $db, $module_name;
	/*****[BEGIN]******************************************
	[ Base:    GFX Code                           v1.0.0 ]
	******************************************************/
	global $modGFXChk;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check'];
	else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once 'header.php';
		OpenTable();
		echo '<div style="text-align:center;"><p class="option thick italic">' . _SECCODEINCOR . '</p><br /><br />';
		echo '[ <a href="javascript:history.go(-2)">' . _GOBACK2 . '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	/*****[END]********************************************
	[ Base:    GFX Code                           v1.0.0 ]
	******************************************************/
	$fname = stripslashes(removecrlf($fname));
	$fmail = validateEmailFormat(stripslashes(removecrlf($fmail)));
	$yname = stripslashes(removecrlf($yname));
	$ymail = validateEmailFormat(stripslashes(removecrlf($ymail)));
	// Begin - Added by Raven 1/14/2007
	if (!($fmail AND $ymail)) {
		include_once 'header.php';
		OpenTable();
		echo '<div style="text-align:center;"><strong>' . _ERRORINVEMAIL . '</strong><br /><br />';
		echo _GOBACK . '<br /></div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	// End - Added by Raven 1/14/2007
	$sid = intval($sid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT title, time, topic FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
	$title = $row['title'];
	$time = $row['time'];
	$topic = $row['topic'];
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT topictext FROM ' . $prefix . '_topics WHERE topicid=\'' . $topic . '\''));
	$topictext = $row2['topictext'];
	$subject = _INTERESTING . ' ' . $sitename;
	 $message = _HELLO . " $fname:\n\n" . _YOURFRIEND . ' ' . $yname . ' ' . _CONSIDERED . "\n\n\n$title\n(" . _FDATE . " $time)\n" . _FTOPIC . " $topictext\n\n" . _URL . ": $nukeurl".'/modules.php?name=' . $module_name . '&file=article&sid=' . $sid . "\n\n" . _YOUCANREAD . " $sitename\n$nukeurl";
	// TegoNuke Mailer added by montego for 2.20.00
	$mailsuccess = false;
	if (defined('TNML_IS_ACTIVE')) {
		$to = array(array($fmail, $fname));
		$mailsuccess = tnml_fMailer($to, $subject, $message, $ymail, $yname);
	} else {
		  $mailsuccess = mail($fmail, $subject, $message, 'From: ' . $yname . ' <' . "$ymail>\r\n" . 'X-Mailer: PHP/ ' . phpversion());
	}
	include_once 'header.php';
	OpenTable();
	if ($mailsuccess) {
		update_points(6);
		echo '<div style="text-align:center;">' . _FSTORY . ' <strong>' . $title . '</strong> ' . _HASSENT . ' ' . $fname . '... ' . _THANKS . '</div>';
		echo '<div style="text-align:center;"><br />' . _GOBACK . '</div><br />';
	} else {
		echo '<div style="text-align:center;"><strong>' . _HASSENTERROR . '</strong><br /><br />';
		echo _GOBACK . '</div><br />';
	}
	CloseTable();
	include_once 'footer.php';
	// end of TegoNuke Mailer add

}
?>