<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// rsvp.php - This file is part of GCalendar
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
// rsvp.php - This file handles RSVP'ing events
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

require_once 'gcal.inc.php';
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name);
require_once 'modules/' . $module_name . '/gcal.inc.php';
require_once 'modules/' . $module_name . '/common.inc.php';

///////////////////////////////////////////////////////////////////////

$eventId = isset($_POST['eventId']) ? intval($_POST['eventId']) : -1;
$action  = isset($_POST['action']) ? $_POST['action'] : '';

if ($action != 'rsvp' && $action != 'cancel') {
	$action = '';
}

csrf_check();

$userInfo = gcalGetUserInfo();
$uid = $userInfo['id'];
$config = getConfig();

if ($config['rsvp'] == 'off' || $uid == -1 || $eventId == -1 || $action == '') {
	header('Location: ' . GCAL_MOD_LINK);
	die();
}

$sql = 'SELECT count(*) FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = \'' . $eventId . '\'';
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$eventExists = intval($row[0]) == 1;

$sql = 'SELECT count(*) FROM ' . $prefix . GCAL_RSVP_TABLE . ' WHERE event_id = \'' . $eventId .
	'\' AND user_id = \'' . $uid . '\'';
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$rsvpExists = intval($row[0]) > 0;

$success = false;
if ($action == 'rsvp' && $eventExists && !$rsvpExists) {
	$sql = 'INSERT INTO ' . $prefix . GCAL_RSVP_TABLE . ' VALUES (NULL, \'' . $eventId . '\', \'' . $uid . '\')';
	$result = $db->sql_query($sql);
	$success = true;
} else if ($action == 'cancel' && $eventExists && $rsvpExists) {
	$sql = 'DELETE FROM ' . $prefix . GCAL_RSVP_TABLE . ' WHERE event_id = \'' . $eventId .
	'\' AND user_id = \'' . $uid . '\'';
	$result = $db->sql_query($sql);
	$success = true;
}

if (preg_match('/^\d{4}-\d{2}-\d{2}-\d+$/', $_POST['backTo'])) {
	list($y, $m, $d, $e) = explode('-', $_POST['backTo']);
	$y = intval($y);
	$m = intval($m);
	$d = intval($d);
	$e = intval($e);
} else {
	list($y, $m, $d) = explode('-', $_POST['backTo']);
	$y = intval($y);
	$m = intval($m);
	$d = intval($d);
	$e = '';
}

$eventLink = str_replace('&amp;', '&', viewDayHref($y, $m, $d, $e));

$sql = 'SELECT submitted_by, rsvp FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = \'' . $eventId . '\'';
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$submitter = $row['submitted_by'];
$eventRsvp = $row['rsvp'];

if ($success && $config['rsvp'] == 'email' && $eventRsvp == 'email') {
	// because of possible collation differences we can't do something like this:
	//$sql = 'SELECT u.user_email FROM ' . $user_prefix . '_users as u, ' . $prefix . GCAL_EVENT_TABLE .
	//	' as e WHERE u.username = e.submitted_by AND e.id = \'' . $eventId . '\'';

	$sql = 'SELECT user_email, name FROM ' . $user_prefix . '_users WHERE username = \'' . $submitter . '\'';
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)) {
		$to = trim($row['user_email']);
		if (!empty($to)) {
			$name = trim($row['name']);
			$name = empty($name) ? $submitter : $name;
			$from = $config['email_from'];
			$subj = $config['rsvp_email_subject'];
			$fullEventLink = $nukeurl . '/' . $eventLink;
			$msg = _GCAL_RSVP_GREETING . $name . _GCAL_RSVP_END_GREETING . "\n" .
				_GCAL_RSVP_MESSAGE . "\n" .
				_GCAL_RSVP_USER . $userInfo['username'] . "\n" .
				_GCAL_RSVP_ACTION . ($action == 'rsvp' ? _GCAL_RSVP_RSVP : _GCAL_RSVP_CANCEL) . "\n" .
				_GCAL_RSVP_EVENT_LINK . $fullEventLink . "\n\n";

			gcalEmail($to, $from, $subj, $msg);
		}
	}
}

header('Location: ' . $eventLink);
die();

?>