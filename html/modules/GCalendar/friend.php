<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// friend.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
//
// friend.php - responsible for displaying and processing form to
// email an event to a friend.
//
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name);

require_once 'modules/' . $module_name . '/gcal.inc.php';
require_once 'modules/' . $module_name . '/common.inc.php';

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

if (!is_user($user)) {
	header('Location: index.php');
	die();
}

if (!isset($op)) {
	$op = '';
}

switch ($op) {
	case 'send':
		csrf_check();
		sendEventToFriend();
		break;

	case 'sent':
		eventSent();
		break;

	default:
		sendToFriendForm($y, $m, $d, $e);
		break;
}

///////////////////////////////////////////////////////////////////////

function gcalFriendHdr() {
	include 'header.php';
	OpenTable();
	$config = getConfig();
	printTitle($config['image'], $config['title']);
	echo '<br />';
	title(_SEND_TO_FRIEND);
}

function gcalFriendFtr() {
	CloseTable();
	include 'footer.php';
}

///////////////////////////////////////////////////////////////////////

function sendToFriendForm($year, $month, $day, $event) {
	global $cookie, $prefix, $db, $user_prefix;
	$userId = intval($cookie[0]);

	$year = intval($year);
	$month = intval($month);
	$day = intval($day);
	$event = intval($event);

	$sql = 'SELECT name, username, user_email FROM ' . $user_prefix . '_users WHERE user_id = ' . $userId;
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)) {
		$name = trim($row['name']);
		$username = $row['username'];
		$email = $row['user_email'];

		if (empty($name)) {
			$name = $username;
		}

		$sql = 'SELECT title FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = ' . $event;
		$result = $db->sql_query($sql);
		if ($row = $db->sql_fetchrow($result)) {
			$title = $row['title'];

			gcalFriendHdr();
			echo _YOU_WILL_SEND_EVENT . '<span class="thick">' . $title . '</span><br /><br />';
			$action = GCAL_MOD_LINK . '&amp;file=friend';
			echo '<form action="' . $action . '" method="post">';
			echo '<input type="hidden" name="y" value="' . $year . '" />';
			echo '<input type="hidden" name="m" value="' . $month . '" />';
			echo '<input type="hidden" name="d" value="' . $day . '" />';
			echo '<input type="hidden" name="e" value="' . $event . '" />';
			echo '<input type="hidden" name="op" value="send" />';
			echo _YOUR_NAME . '&nbsp;<span class="thick">' . $name .
				'</span><input type="hidden" name="member" value="' . $name . '" /><br /><br />';
			echo _YOUR_EMAIL . '&nbsp;<span class="thick">' . $email .
				'</span><input type="hidden" name="from" value="' . $email . '" /><br /><br />';
			echo _FRIEND_NAME . '&nbsp;<input type="text" name="friend" value="" size="32" /><br /><br />';
			echo _FRIEND_EMAIL . '&nbsp;<input type="text" name="to" value="" size="32" /><br /><br />';
			echo '<input type="submit" name="send" value="' . _SEND_EVENT . '" /><br />';
			echo '</form>';
			echo '<div class="text-center">[ <a href="javascript:history.go(-1);">' . _GCAL_GO_BACK . '</a> ]</div>';
			gcalFriendFtr();
		}
	}
}

///////////////////////////////////////////////////////////////////////

function sendEventToFriend() {
	global $db, $prefix;
	global $sitename, $slogan, $nukeurl;

	$year = intval($_POST['y']);
	$month = intval($_POST['m']);
	$day = intval($_POST['d']);
	$event = intval($_POST['e']);
	$name = gcalStripCrLf(stripslashes($_POST['member']));
	$from = gcalStripCrLf(stripslashes($_POST['from']));
	$friend = gcalStripCrLf(stripslashes($_POST['friend']));
	$to = gcalStripCrLf(stripslashes($_POST['to']));

	if (!gcalValidEmail($from) || !gcalValidEmail($to)) 	{
		gcalFriendHdr();
		echo '<div class="text-center"><span class="thick">' . _INVALID_EMAIL . '</span><br /><br />' .
			'[ <a href="javascript:history.go(-1);">' . _GCAL_GO_BACK . '</a> ]</div><br /><br />';
		gcalFriendFtr();
		return;
	}
	$sql = 'SELECT title FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = ' . $event;
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)) {
		$title = $row['title'];
	}

	$subject = _FRIEND_EMAIL_SUBJECT . $sitename;

	$link = $nukeurl . '/' . viewDayHref($year, $month, $day, $event);
	$link = str_replace('&amp;', '&', $link);

	$msg = _FRIEND_GREETING . $friend . _FRIEND_GREETING_PUNCT . "\n\n";
	$msg .= _FRIEND_YOUR_FRIEND . $name . _FRIEND_WANTED_TO_SEND . "\n\n";
	$msg .= $title . "\n" . $link . "\n\n";
	$msg .= _FRIEND_WAS_SENT_FROM . $sitename . ' - ' . $slogan . "\n\n";
	$msg .= $nukeurl;

	gcalEmail($to, $from, $subject, $msg);

	$newLoc = GCAL_MOD_LINK . '&file=friend&op=sent&y=' . $year .
		'&m=' . $month .
		'&d=' . $day .
		'&e=' . $event;
	header('Location: ' . $newLoc);
}

///////////////////////////////////////////////////////////////////////

function eventSent() {
	$year	 = intval($_GET['y']);
	$month	= intval($_GET['m']);
	$day	  = intval($_GET['d']);
	$event	= intval($_GET['e']);

	$link = viewDayHref($year, $month, $day, $event);

	gcalFriendHdr();
	echo '<div class="text-center">' . _FRIEND_EVENT_SENT . '<br /><br />';
	echo '[ <a href="' . $link . '">' . _GCAL_GO_BACK . '</a> ]</div><br />';
	gcalFriendFtr();
}

///////////////////////////////////////////////////////////////////////
?>