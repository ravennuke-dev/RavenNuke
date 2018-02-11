<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// displayEvent.php - This file is part of GCalendar
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
// displayEvent.php - routine for displaying an event
///////////////////////////////////////////////////////////////////////

function displayEvent($event, $config, $captionHref = '', $showStartDate = false, $backTo = '') {
	global $db, $prefix;

	$categoryTable = $prefix . GCAL_CAT_TABLE;
	$eventTable	 = $prefix . GCAL_EVENT_TABLE;

	$event = intval($event);

	$sql = <<<END_SQL
SELECT e.title, e.no_time, e.start_time, e.end_time, e.location,
	e.repeat_type, e.details, e.interval_val, e.no_end_date, e.start_date,
	e.end_date, e.weekly_days, e.monthly_by_day, e.submitted_by, c.name, c.id as cat_id,
	e.rsvp
FROM $eventTable AS e, $categoryTable AS c
WHERE e.id = $event AND e.category = c.id
END_SQL;

	$result = $db->sql_query($sql);
	if ($db->sql_numrows($result) > 0) {
		$row = $db->sql_fetchrow($result);
		$title = $row['title'];
		$noTime = intval($row['no_time']);
		$startTime = $row['start_time'];
		$endTime = $row['end_time'];
		$location = $row['location'];
		$repeat = $row['repeat_type'];
		$details = $row['details'];
		$interval = intval($row['interval_val']);
		$noEndDate = intval($row['no_end_date']);
		$startDate = $row['start_date'];
		$endDate = $row['end_date'];
		$weeklyDays = explode(',', $row['weekly_days']);
		$monthlyByDay = intval($row['monthly_by_day']);
		$userLink = getUserInfoLink($row['submitted_by']);
		$catId 	= intval($row['cat_id']);
		$rsvp = $row['rsvp'];
		$category = '<span class="gcal-cat-' . $catId . '">' . $row['name'] . '</span>';

		if ($details == '') {
			$details = '&nbsp;';
		}
		if ($location == '') {
			$location = '&nbsp; ';
		}

		if ($config['auto_link']) {
			$location = gcalAutoLink($location);
			$details  = gcalAutoLink(str_replace('<br />', "\n<br />\n", $details));
		}

		echo '<br />';
		echo '<div id="gcalid-' . $event . '">';
		if ($noTime) {
			echo _VIEW_DAY_NO_TIME;
		} else {
			$time24 = $config['time_in_24'];
			echo formatTime($startTime, $time24) . ' - ' . formatTime($endTime, $time24);
		}
		echo '<hr /><br />' . "\n";

		$notes = gcalComputeEventNotes($startDate, $repeat, $interval, $noEndDate, $endDate, $weeklyDays, $monthlyByDay,
			$config['long_date_format']);

		$rsvpTd = '';
		if ($rsvp == 'on' || $rsvp == 'email') {
			$rsvpTd = gcalComputeEventRsvp($event, $backTo, $rsvpCount);
		}

		echo '<div class="text-center"><table class="gcal-event" border="1" width="80%" cellpadding="3" cellspacing="0">' . "\n";
		if ($captionHref != '') {
			echo '<caption><a href="' . $captionHref . '">' . _VIEW_DAY_EVENT_NUM . $event . '</a></caption>' . "\n";
		}
		echo '<tr><th width="2%" align="right">' . _VIEW_DAY_TITLE . '</th><td align="left">' . $title . '</td></tr>' . "\n";

		if ($showStartDate) {
			echo '<tr><th width="2%" align="right">' . _VIEW_DAY_START_DATE . '</th><td align="left">' .
				formatDate($startDate, $config['long_date_format']) . '</td></tr>' . "\n";
		}

		echo '<tr><th width="2%" align="right">' . _VIEW_DAY_CATEGORY . '</th><td align="left">' . $category . '</td></tr>' . "\n";
		echo '<tr><th width="2%" align="right">' . _VIEW_DAY_LOCATION . '</th><td align="left">' . $location . '</td></tr>' . "\n";
		echo '<tr><th width="2%" align="right">' . _VIEW_DAY_DESC . '</th><td align="left">' . $details . '</td></tr>' . "\n";
		if (!empty($notes)) {
			echo '<tr><th width="2%" align="right">' . _VIEW_DAY_NOTES . '</th><td align="left">' . $notes . '</td></tr>' . "\n";
		}
		echo '<tr><th width="2%" align="right">' . _VIEW_DAY_SUBMITTER . '</th><td align="left">' . $userLink . '</td></tr>' . "\n";
		if (!empty($rsvpTd)) {
			echo '<tr><th width="2%" align="right">' . _VIEW_DAY_RSVP . '<br /><div align="center">' . $rsvpCount . '</div>' .
				'</th><td align="left">' . $rsvpTd . '</td></tr>' . "\n";
		}
		echo '</table></div><br /></div>' . "\n";
	}
}

///////////////////////////////////////////////////////////////////////

function gcalComputeEventNotes($startDate, $repeat, $interval, $noEndDate, $endDate, $weeklyDays, $monthlyByDay, $dateFormat) {
	$notes = '';
	if ($repeat != 'none') {
		$notes .= _VIEW_DAY_EVENT_REPEATS . $interval . ' ';
		switch ($repeat) {
			case 'daily':
				$notes .= _VIEW_DAY_DAYS . '.';
				break;

			case 'weekly':
				$notes .= _VIEW_DAY_WEEKS;
				$nDays = count($weeklyDays);
				if ($nDays > 0) {
					$notes .= _VIEW_DAY_ON;
					$n = 0;
					foreach ($weeklyDays as $wday) {
						$notes .= dayName($wday);
						++$n;
						if ($n != $nDays) {
							$notes .= ', ';
						} else {
							$notes .= '.';
						}
					}
				} else {
					$notes .= '.';
				}
				break;

			case 'monthly':
				$notes .= _VIEW_DAY_MONTHS;
				if ($monthlyByDay) {
					nthWeekday($startDate, $n, $weekday, false);
					$notes .= ' ' . _VIEW_DAY_EVERY . ' ' . arity($n) . " $weekday.";
				} else {
					$notes .= '.';
				}
				break;

			case 'yearly':
				$notes .= _VIEW_DAY_YEARS . '.';
				break;

			default:
				break;
		}
	}

	if (!$noEndDate) {
		if ($notes != '') {
			$notes .= ' ';
		}

		$notes .= _VIEW_DAY_ENDS_ON . formatDate($endDate, $dateFormat) . '.';
	}

	return $notes;
}

///////////////////////////////////////////////////////////////////////

function gcalComputeEventRsvp($event, $backTo, &$rsvpCount) {
	global $user, $prefix, $db, $user_prefix;

	$s = '';
	$sql = 'SELECT r.user_id, u.username FROM ' . $prefix . GCAL_RSVP_TABLE . ' as r, ' .
		$user_prefix . '_users as u WHERE r.event_id = \'' . $event . '\' AND r.user_id = u.user_id ' .
		'ORDER BY u.username';
	$result = $db->sql_query($sql);
	$ids = array();
	$rsvpCount = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$ids[intval($row['user_id'])] = $row['username'];
		$s .= getUserInfoLink($row['username']) . ' ';
		++$rsvpCount;
	}

	// build a list of people who have RSVP'ed

	if (!empty($s)) {
		$s .= '<br /><br />';
	}

	// RSVP form

	if (is_user($user)) {
		$formAction = GCAL_MOD_LINK . '&amp;file=rsvp';
		$s .= '<form action="' . $formAction . '" method="post">';
		$s .= '<input type="hidden" name="eventId" value="' . $event . '" />';
		$s .= '<input type="hidden" name="backTo" value="' . $backTo . '" />';

		$userInfo = gcalGetUserInfo();
		if (!array_key_exists($userInfo['id'], $ids)) {
			$s .= '<input type="hidden" name="action" value="rsvp" />';
			$s .= '<input type="submit" value="' . _GCAL_RSVP_EVENT . '" />';
		} else {
			$s .= '<input type="hidden" name="action" value="cancel" />';
			$s .= '<input type="submit" value="' . _GCAL_CANCEL_RSVP_EVENT . '" />';
		}
		$s .= '</form>';
	}
	return $s;
}

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

function gcalMakeLink($matches) {
	if (preg_match('/^\s/', $matches[0])) {
		$pad = ' ';
		$match = $matches[1];
	} else {
		$pad = '';
		$match = $matches[0];
	}

	// This bit of code attempts to compensate for people ending a link with
	// some punctuation (e.g. a period at the end of a sentence):

	$punctMatches = array();
	$period = '';
	if (preg_match('/([.,;:!?])$/', $match, $punctMatches)) {
		$period = $punctMatches[1];
		$match = substr($match, 0, strlen($match) - 1);
	}

	$match = str_replace('&', '&amp;', $match);  // HTML compliance
	$href = $match;

	if ($href[0] == 'w') {
		$href = 'http://' . $href;
	}

	// Insert soft-hyphens so long links won't stretch containers. Unfortunately, the
	// &shy; char isn't supported by Firefox. But apparently this zero width
	// space character is widely supported. It seemed to work on IE7, Firefox 2.0, and Opera 9.
	// Unfortunately it does display under IE6. :(

	$shy = '&#8203;';
	$shyMatch = preg_replace('#(\.|/|=)#', '$1' . $shy, $match);

	return $pad . '<a href="' . $href . '">' . $shyMatch . '</a>' . $period;
}

//
// turns links that start with http:// or www. into real links by
// embedding the text in <a></a> tags. The link must be the first
// thing in the string or be surrounded by white spaces.
//
function gcalAutoLink($text) {
	$text = preg_replace_callback(
		'#\s((?:http://|www\.)[^\s]+)|^(?:http://|www\.)[^\s]+#',
		'gcalMakeLink',
		$text);

	return $text;
}

?>