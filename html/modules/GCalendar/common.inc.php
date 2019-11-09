<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// common.inc.php - This file is part of GCalendar
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
// This file contains commonly used routines for GCalendar
//
///////////////////////////////////////////////////////////////////////

function monthName($month) {
	static $names = array(1 => _MONTH1_NAME, 2  => _MONTH2_NAME,	3 => _MONTH3_NAME,	4 => _MONTH4_NAME,
							5 => _MONTH5_NAME, 6  => _MONTH6_NAME,	7 => _MONTH7_NAME,	8 => _MONTH8_NAME,
							9 => _MONTH9_NAME, 10 => _MONTH10_NAME, 11 => _MONTH11_NAME, 12 => _MONTH12_NAME);

	return $names[intval($month)];
}

///////////////////////////////////////////////////////////////////////

function dayName($day) {
	static $names = array(0 => _DAY0_NAME, 1 => _DAY1_NAME, 2 => _DAY2_NAME, 3 => _DAY3_NAME,
							4 => _DAY4_NAME, 5 => _DAY5_NAME, 6 => _DAY6_NAME);

	return $names[intval($day)];
}

///////////////////////////////////////////////////////////////////////

function dayAbbrev($day) {
	static $names = array(0 => _DAY0_ABBREV, 1 => _DAY1_ABBREV, 2 => _DAY2_ABBREV, 3 => _DAY3_ABBREV,
							4 => _DAY4_ABBREV, 5 => _DAY5_ABBREV, 6 => _DAY6_ABBREV);

	return $names[intval($day)];
}

///////////////////////////////////////////////////////////////////////

function dayLetter($day) {
	static $names = array(0 => _DAY0_LETTER, 1 => _DAY1_LETTER, 2 => _DAY2_LETTER, 3 => _DAY3_LETTER,
							4 => _DAY4_LETTER, 5 => _DAY5_LETTER, 6 => _DAY6_LETTER);

	return $names[intval($day)];
}

///////////////////////////////////////////////////////////////////////
//
// For a given date in SQL format (YYYY-MM-DD) compute what its ordinal number
// of the weekday it was; e.g. 2006-11-03 produces $n == 1 and $weekday == 'Friday'.
// If $gnu is true, $weekday is in English so it can be used in strtotime(), else
// it is looked up using dayName().
//
function nthWeekday($forDate, &$n, &$weekday, $gnu = true) {
	// The GNU date input formats as used by strtotime require English daynames,
	// so we can't rely on the locale or the language file constants. Define out
	// own here:

	static $gnuDayNames = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
									4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');

	// find the day of the week on the date

	$ts = strtotime($forDate);
	$info = getdate($ts);
	$weekday = $gnu ? $gnuDayNames[$info['wday']] : dayName($info['wday']);

	// now, for the start month, count backwards by 1 week until we
	// move into the previous month; that will tell us what nth
	// weekday of the month that day was

	$month = $info['mon'];
	$m = $month;
	$n = 0;
	while ($m == $month) {
		$ts = strtotime('-1 week', $ts);
		$info = getdate($ts);
		$m = $info['mon'];
		++$n;
	}
}

///////////////////////////////////////////////////////////////////////

function monthCombo($name, $selMonth, $disabled = false) {
	$items = array();
	for ($i = 1; $i <= 12; ++$i) {
		$items[$i] = monthName($i);
	}
	$combo = new Combo($name, $items, $selMonth);
	$combo->enable(!$disabled);
	return $combo->html();
}

///////////////////////////////////////////////////////////////////////

function timeCombos($hName, $mName, $merName, $time, $disabled = false, $time24 = false) {
	$h	= 12;
	$m	= 0;
	$mer = 1;

	$result = validTime($time);
	if (count($result) == 2) {
		$h = intval($result[0]);
		if (!$time24) {
			if ($h == 0) {
				$h = 12;
				$mer = 0;
			} else if ($h >= 12 && $h <= 23) {
				$h = $h == 12 ? 12 : $h - 12;
				$mer = 1;
			} else if ($h < 12) {
				$mer = 0;
			}
		}

		$m = intval($result[1]);
	}

	$hours = array();
	if ($time24) {
		for ($i = 0; $i <= 23; ++$i) {
			$hours[$i] = sprintf('%02d', $i);
		}
	} else {
		for ($i = 1; $i <= 12; ++$i) {
			$hours[$i] = sprintf('%02d', $i);
		}
	}

	$mins = array();
	for ($i = 0; $i <= 55; $i += 5) {
		$mins[$i] = sprintf('%02d', $i);
	}

	$hoursCombo = new Combo($hName, $hours, $h);
	$hoursCombo->enable(!$disabled);

	$minsCombo = new Combo($mName, $mins, 5 * $m / 5);
	$minsCombo->enable(!$disabled);

	if ($time24) {
		$merHtml = '<input type="hidden" name="' . $merName . '" value="24" />';
	} else {
		$merCombo = new Combo($merName, array(0 => _TIME_AM, 1 => _TIME_PM), $mer);
		$merCombo->enable(!$disabled);
		$merHtml = ' ' . $merCombo->html();
	}

	return $hoursCombo->html() . ' ' . _TIME_SEP . ' ' .
		$minsCombo->html() .
		$merHtml;
}

///////////////////////////////////////////////////////////////////////

function dateCombos($yName, $mName, $dName, $date, $config, $disabled = false) {
	$result = validDate($date);
	if (is_array($result) && count($result) == 3) {
		$y = $result[0];
		$m = $result[1];
		$d = $result[2];
	} else {
		$y = date('Y');
		$m = date('m');
		$d = date('d');
	}
	$yearCombo = new NumericCombo($yName, intval($config['min_year']), intval($config['max_year']), $y);
	$yearCombo->enable(!$disabled);

	$monthCombo = monthCombo($mName, $m, $disabled);

	$dayCombo = new NumericCombo($dName, 1, 31, $d);
	$dayCombo->enable(!$disabled);

	// try to guess what order the user wants these combos based on their reg_date_format option

	if (false === ($mPos = strpos($config['reg_date_format'], '%m'))) {
		$mPos = strpos($config['reg_date_format'], '%B');
	}

	$dPos = strpos($config['reg_date_format'], '%d');

	if (false === ($yPos = strpos($config['reg_date_format'], '%Y'))) {
		$yPos = strpos($config['reg_date_format'], '%C');
	}

	if (false === $mPos || false === $dPos || false === $yPos) {
		// can't figure out so just default to a common US setting:
		return $monthCombo . $dayCombo->html() . $yearCombo->html();
	}

	$order = array();
	$order[$mPos] = $monthCombo;
	$order[$dPos] = $dayCombo->html();
	$order[$yPos] = $yearCombo->html();
	ksort($order);
	return implode('', $order);
}

///////////////////////////////////////////////////////////////////////

function getCategories() {
	global $db, $prefix;

	$categoryTable = $prefix . GCAL_CAT_TABLE;
	$result = $db->sql_query('SELECT id, name FROM ' . $categoryTable . ' ORDER BY name');
	$items = array();
	while ($row = $db->sql_fetchrow($result)) {
		$items[intval($row['id'])] = $row['name'];
	}
	return $items;
}

///////////////////////////////////////////////////////////////////////

function categoryCombo($name, $sel) {
	global $admin, $user, $db, $prefix;

	if (is_admin($admin)) {
		$items = getCategories();
	} else {
		$catTable = $prefix . GCAL_CAT_TABLE;
		$catGroupTable = $prefix . GCAL_CAT_GROUP_TABLE;
		$items = array();

		if (is_user($user)) {
			$groups = gcalGetUserGroups();
			$groups[] = -1;
			$groups = implode(',', $groups);

			$sql = 'SELECT c.id, c.name FROM ' . $catTable . ' AS c, ' . $catGroupTable .
				' AS cg WHERE c.id = cg.cat_id AND cg.group_id IN (' . $groups . ') ORDER BY c.name';
		} else {
			$sql = 'SELECT c.id, c.name FROM ' . $catTable . ' AS c, ' . $catGroupTable .
				' AS cg WHERE c.id = cg.cat_id AND cg.group_id = -1 ORDER BY c.name';
		}

		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$items[intval($row['id'])] = $row['name'];
		}
	}

	if (count($items) > 0) {
		$combo = new Combo($name, $items, $sel);
		return $combo->html();
	}

	return _FORM_NO_CATEGORIES;
}

///////////////////////////////////////////////////////////////////////

function getConfig() {
	global $db, $prefix;

	$configTable = $prefix . GCAL_CONF_TABLE;
	$result = $db->sql_query('SELECT * FROM ' . $configTable);
	if (!$result || $db->sql_numrows($result) < 1) {
		exit('database problem, no config table');
	}
	$config = $db->sql_fetchrow($result);
	$config['allowed_tags']  = explode(',', $config['allowed_tags']);
	$config['allowed_attrs'] = explode(',', $config['allowed_attrs']);
	$config['weekends'] = explode(',', $config['weekends']);
	$config['groups_submit'] = explode(',', $config['groups_submit']);
	$config['groups_no_approval'] = explode(',', $config['groups_no_approval']);
	return $config;
}

///////////////////////////////////////////////////////////////////////

function viewDayHref($year, $month, $day, $event = '', $printable = false) {
	$href = GCAL_MOD_LINK . '&amp;file=viewday&amp;y=' . $year . '&amp;m=' . $month . '&amp;d=' . $day;
	if (isset($event) && !empty($event)) {
		$href .= '&amp;e=' . $event;
	}
	if ($printable) {
		$href .= '&amp;printable=1';
	}
	return $href;
}

///////////////////////////////////////////////////////////////////////

function viewMonthHref($year, $month, $printable = false) {
	$href = GCAL_MOD_LINK . '&amp;y=' . $year . '&amp;m=' . $month;
	if ($printable) {
		$href .= '&amp;printable=1';
	}
	return $href;
}

///////////////////////////////////////////////////////////////////////

function viewWeekHref($year, $month, $day, $printable = false) {
	$href = GCAL_MOD_LINK . '&amp;file=viewweek&amp;y=' . $year . '&amp;m=' . $month . '&amp;d=' . $day;
	if ($printable) {
		$href .= '&amp;printable=1';
	}
	return $href;
}

///////////////////////////////////////////////////////////////////////

function submitHref($year, $month, $day = 0) {
	$href = GCAL_MOD_LINK . "&amp;file=submit&amp;y=$year&amp;m=$month";
	if ($day > 0) {
		$href .= "&amp;d=$day";
	}
	return $href;
}

///////////////////////////////////////////////////////////////////////

function printTitle($titleImg, $title) {
	if ($titleImg != '') {
		echo '<div class="text-center"><img src="' . $titleImg . '" alt="' . _CAL_IMAGE_ALT . '" border="0" /></div><br/>';
	}
	echo '<div class="text-center"><span class="title">' . $title . '</span></div>' . "\n";
}

///////////////////////////////////////////////////////////////////////

function gcalGetUserGroups() {
	static $groups;

	if (isset($groups) && is_array($groups)) {
		return $groups;
	}

	$groups = array();
	global $user;
	if (is_user($user)) {
		global $db, $prefix;

		$userInfo = gcalGetUserInfo();
		$uid = $userInfo['id'];

		$sql = 'SELECT `gid` FROM ' . $prefix . '_nsngr_users WHERE `uid` = ' . $uid . ' ORDER BY `gid`';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$groups[] = intval($row['gid']);
		}
	}
	return $groups;
}

///////////////////////////////////////////////////////////////////////

function gcalNeedsNoApproval($noApprovalGroups) {
	global $user, $admin;

	if (is_admin($admin)) {
		return true;
	}

	if (is_user($user)) {
		static $result;
		if (isset($result)) {
			return $result;
		}

		$result = count(array_intersect(gcalGetUserGroups(), $noApprovalGroups)) > 0;
		return $result;
	}
	return false;
}

///////////////////////////////////////////////////////////////////////

function gcalCanSubmit($submitOption, $submitGroups = array()) {
	global $user, $admin;

	if (is_admin($admin)) {
		return true;
	}

	switch ($submitOption) {
		case 'off':
			return false;

		case 'anyone':
			return true;

		case 'members':
			return is_user($user);

		case 'groups':
			return count(array_intersect(gcalGetUserGroups(), $submitGroups)) > 0;

		default:
			return false;
	}
}

///////////////////////////////////////////////////////////////////////

function printHeader($curYear, $curMon, $curDay, $config, $year, $month, $printable = false, $day = 0, $event = '', $week = false) {
	global $admin, $admin_file;

	$gotoToday = '<a href="' . viewDayHref($curYear, $curMon, $curDay, '', $printable) . '">' .
		formatDate(toSqlDate($curYear, $curMon, $curDay), $config['reg_date_format']) . '</a>';

	printTitle($config['image'], $config['title']);

	echo '<form action="' . GCAL_MOD_LINK . '" method="post">' . "\n";
	echo '<table border="0" width="100%"><tr>' . "\n";
	echo '<td align="left" valign="middle" width="31%"><span class="thick">' . _HEADER_TODAYS_DATE . '</span> ' . $gotoToday . "</td>\n";
	echo '<td align="center" valign="middle" width="38%"><span class="thick">' . _HEADER_MONTH . '</span> ';

	echo monthCombo('m', $month);
	echo '<span class="thick">' . _HEADER_YEAR . '</span> ';

	$yearCombo = new NumericCombo('y', $config['min_year'], $config['max_year'], $year);
	$yearCombo->display();

	echo '<input type="submit" value="' . _HEADER_GOTO_MONTH . '" /></td>' . "\n";

	$submitLink = '';
	if (gcalCanSubmit($config['user_submit'], $config['groups_submit'])) {
		$submitLink = '<a href="' . submitHref($year, $month, $day) . '">' . _HEADER_SUBMIT_INFO . '</a><br/>';
	}

	$printLink = '<a href="';
	if ($week) {
		$printLink .= viewWeekHref($year, $month, $day, true);
	} else if ($day == 0) {
		$printLink .= viewMonthHref($year, $month, true);
	} else {
		$printLink .= viewDayHref($year, $month, $day, $event, true);
	}
	$printLink .= '">' . _HEADER_PRINTABLE . '</a><br />';

	$adminLink = '';
	if (is_admin($admin)) {
		$adminLink = '<a href="' . $admin_file . '.php?op=gcalendar">' . _HEADER_GOTO_ADMIN . '</a>';
	}

	echo '<td align="right" valign="middle" width="31%">' . $submitLink . $printLink . $adminLink . "</td>\n";
	echo '</tr></table>';

	if ($printable) {
		echo '<input type="hidden" name="printable" value="1" />';
	}
	echo '</form><br/>' . "\n";
}

///////////////////////////////////////////////////////////////////////

// returns $n with a suffix to indicate its -arity. This routine is probably
// very language specific and may need to be customized for languages other
// than English:

function arity($n) {
	global $language;
	if (strcasecmp($language, 'english') == 0) {
		$n = intval($n);
		switch ($n) {
			case 1:
				return '1st';

			case 2:
				return '2nd';

			case 3:
				return '3rd';

			default:
				return "{$n}th";
		}
	}
	return $n;
}

///////////////////////////////////////////////////////////////////////

function formatDate($theDate, $format) {
	$info = getdate(strtotime($theDate));

	$year  = intval(substr($theDate, 0, 4));
	$month = intval(substr($theDate, 5, 2));
	$day	= substr($theDate, 8, 2);

	// strftime() like conversions as per http://us2.php.net/manual/en/function.strftime.php
	// We support only these:
	// %A - full weekday name
	// %Y - full 4 digit year
	// %C - century number (the year divided by 100 and truncated to an integer, range 00 to 99)
	// %B - full month name
	// %m - month as a decimal number (range 01 to 12)
	// %d - day of the month as a decimal number (range 01 to 31)

	$search = array('%A', '%Y', '%C', '%B', '%m', '%d');
	$replace = array();

	$replace[] = dayName($info['wday']);			// %A
	$replace[] = $year;								  // %Y
	$replace[] = sprintf('%02d', $year % 100);	// %C
	$replace[] = monthName($month);				  // %B
	$replace[] = sprintf('%02d', $month);		  // %m
	$replace[] = $day;									// %d

	return str_replace($search, $replace, $format);
}

///////////////////////////////////////////////////////////////////////

function formatTime($theTime, $time24 = false) {
	return strftime($time24 ? _TIME_FORMAT24 : _TIME_FORMAT12, strtotime($theTime));
}

///////////////////////////////////////////////////////////////////////

// Validates a SQL style date string (YYYY-MM-DD) and makes sure the date
// is valid. If it is valid, returns an array with year, month, day at
// subscripts 0, 1, and 2. If not valid returns false.
//
function validDate($s) {
	$result = array();
	if (1 == preg_match('/^(\d{4})-(\d\d)-(\d\d)$/', $s, $result)) {
		array_shift($result);
		return checkdate($result[1], $result[2], $result[0]) ? $result : false;
	}
	return false;
}

///////////////////////////////////////////////////////////////////////

// Validates a SQL style time string (HH:MM:SS) and makes sure it is valid.
// If it is valid, returns an array with hours at subscript 0, and minutes
// and subscript 1. If not valid, false is returned.
// (Note that we don't work with seconds here, so they must always be 0).
//
function validTime($t) {
	$result = array();
	if (1 == preg_match('/^(\d\d):(\d\d):00$/', $t, $result)) {
		array_shift($result);
		$h = intval($result[0]);
		$m = intval($result[1]);
		$validHours = $h >= 0 && $h <= 23;
		$validMins  = $m >= 0 && $m <= 59;

		return $validHours && $validMins ? $result : false;
	}
	return false;
}

///////////////////////////////////////////////////////////////////////

function displayList($items, $ordered = true) {
	if ($ordered) {
		echo '<ol>';
	} else {
		echo '<ul>';
	}

	foreach ($items as $item) {
		echo '<li>' . $item . '</li>';
	}

	if ($ordered) {
		echo '</ol>';
	} else {
		echo '</ul>';
	}
}

///////////////////////////////////////////////////////////////////////

function toSqlDate($y, $m, $d) {
	return sprintf('%04d-%02d-%02d', $y, $m, $d);
}

///////////////////////////////////////////////////////////////////////
//
// if $mer is 24, then the time should be treated as a 24 hour time;
// if $mer is 0, then it is 12 hour AM
// otherwise, it is 12 hour PM
//
function toSqlTime($h, $m, $mer) {
	$m = max(0, min(59, intval($m)));
	$mer = intval($mer);
	if ($mer == 24) {
		$h = max(0, min(23, intval($h)));
	} else {
		$h = max(1, min(12, intval($h)));

		if ($mer) { // PM
			$h = ($h == 12) ? $h : $h + 12;
		} else if ($h == 12) {
			$h = 0;
		}
	}

	return sprintf('%02d:%02d:00', $h, $m);
}

///////////////////////////////////////////////////////////////////////

function weekdayFilter($val) {
	$val = intval($val);
	return $val >= 0 && $val <= 6;
}

///////////////////////////////////////////////////////////////////////

function stripslashesDeep(&$value) {
	if (is_array($value)) {
		$value = array_map('stripslashesDeep', $value);
	} else if (!empty($value) && is_string($value)) {
		$value = stripslashes($value);
	}
	return $value;
}

///////////////////////////////////////////////////////////////////////

function getUserName() {
	global $admin, $user, $anonymous;

	if (is_user($user)) {
		if (is_array($user)) {
			return $user[1];
		}

		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$user2 = explode(':', $user2);

		return $user2[1];
	} else if (is_admin($admin)) {
		return _ADMIN_NAME;
	}

	return $anonymous;
}

///////////////////////////////////////////////////////////////////////

function getUserInfoLink($user) {
	global $anonymous;

	if ($user == $anonymous || $user == _ADMIN_NAME || $user == '' || !isset($user)) {
		return $user;
	}

	if (file_exists('modules/Your_Account/index.php')) {
		return '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $user . '">' . $user . '</a>';
	}

	//
	// Add support for other user modules here...
	//

	return $user;
}

///////////////////////////////////////////////////////////////////////

function gcalEmail($to, $from, $subject, $msg) {
	$hdrs = 'From: ' . $from . "\r\n" .
			  'X-Mailer: PHP/' . phpversion();

	// RavenNuke 2.20.0 support: TegoNuke Mailer added by montego
	if (TNML_IS_ACTIVE) {
		tnml_fMailer($to, $subject, $msg, $from);
	} else {
		mail($to, $subject, $msg, $hdrs);
	}
}

///////////////////////////////////////////////////////////////////////

// I'm not sure about Nuke's removecrlf(), it only has 1 char in the replace
// string, so I'm writing my own:

function gcalStripCrLf($s) {
	return strtr($s, "\r\n", '  ');
}

///////////////////////////////////////////////////////////////////////

// Based on code from _Web Database Applications with PHP and MySQL_
// by Williams and Lane

function gcalValidEmail($s) {
	$s = trim($s);
	return strlen($s) >= 7 && strlen($s) <= 30 &&
		preg_match('/^[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*' .
				'@[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*$/i', $s);
}

///////////////////////////////////////////////////////////////////////

function gcalCanEditEvent($eventId, $config) {
	global $admin, $user, $db, $prefix, $cookie;

	// Admins can edit events in user space; the event creator can too if that option
	// is turned on.

	$canEdit = is_admin($admin);
	if (!$canEdit && $config['user_update']) {
		if (is_user($user)) {
			$sql = 'SELECT submitted_by, approved FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = ' . $eventId;
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result)) {
				$canEdit = $cookie[1] == $row['submitted_by'] && intval($row['approved']);
			}
		}
	}
	return $canEdit;
}

///////////////////////////////////////////////////////////////////////

function gcalSpecialChars($s) {
	return htmlspecialchars($s, ENT_QUOTES, _CHARSET);
}

///////////////////////////////////////////////////////////////////////

function gcalGetUserInfo() {
	global $user, $cookie, $anonymous;

	if (is_user($user)) {
		return array('id' => intval($cookie[0]), 'username' => $cookie[1]);
	}
	return array('id' => -1, 'username' => $anonymous);
}

///////////////////////////////////////////////////////////////////////

function gcalDeleteEvents($events) {
	global $prefix, $db;

	if (is_array($events) && count($events) > 1) {
		$first = intval(array_shift($events));
		$where1 = ' WHERE id = ' . $first;
		$where2 = ' WHERE event_id = ' . $first;
		foreach ($events as $event) {
			$where1 .= ' OR id = ' . intval($event);
			$where2 .= ' OR event_id = ' . intval($event);
		}
		$sql = 'DELETE FROM ' . $prefix . GCAL_EVENT_TABLE . $where1;
		$result1 = $db->sql_query($sql);

		$sql = 'DELETE FROM ' . $prefix . GCAL_RSVP_TABLE . $where2;
		$result2 = $db->sql_query($sql);

		$sql = 'DELETE FROM ' . $prefix . GCAL_EXCEPT_TABLE . ' WHERE event_id = ' . intval($event);
		$result3 = $db->sql_query($sql);

		return $result1 && $result2 && $result3;
	} else {
		$eventId = is_array($events) ? intval($events[0]) : intval($events);

		$sql = 'DELETE FROM ' . $prefix . GCAL_EVENT_TABLE . ' WHERE id = ' . $eventId;
		$result1 = $db->sql_query($sql);

		$sql = 'DELETE FROM ' . $prefix . GCAL_RSVP_TABLE . ' WHERE event_id = ' . $eventId;
		$result2 = $db->sql_query($sql);

		$sql = 'DELETE FROM ' . $prefix . GCAL_EXCEPT_TABLE . ' WHERE event_id = ' . $eventId;
		$result3 = $db->sql_query($sql);

		return $result1 && $result2 && $result3;
	}
}

///////////////////////////////////////////////////////////////////////
//
// gets the appropriate FROM and WHERE clauses for category permissions based upon user/admin/group
// status; used by getMonthlyEvents() and getEvents()
//
function gcalGetCategorySql(&$from, &$where) {
	global $admin, $user, $prefix;

	if (is_admin($admin)) {
		$from = '';
		$where = '';
	} else if (is_user($user)) {
		$from = ', ' . $prefix . GCAL_CAT_GROUP_TABLE . ' AS cg';

		$groups = gcalGetUserGroups();
		$groups[] = -1;
		$groups = implode(',', $groups);

		$where = 'AND (`category` = cg.cat_id AND cg.group_id IN (' . $groups . '))';
	} else { // can see categories assigned to no groups
		$from = ', ' . $prefix . GCAL_CAT_GROUP_TABLE . ' AS cg';
		$where = 'AND (`category` = cg.cat_id AND cg.group_id = -1)';
	}
}

?>