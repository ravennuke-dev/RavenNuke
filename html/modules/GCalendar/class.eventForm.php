<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// class.eventForm.php - This file is part of GCalendar
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
// This is a PHP class for displaying the form to allow users and
// admins to edit event info.
//
///////////////////////////////////////////////////////////////////////

define('NO_REPEAT', 0);
define('DAILY_REPEAT', 1);
define('WEEKLY_REPEAT', 2);
define('MONTHLY_REPEAT', 3);
define('YEARLY_REPEAT', 4);

define('MONTHLY_BY_DATE', 0);
define('MONTHLY_BY_DAY', 1);

class EventForm {
	var $action = '';
	var $title = '';
	var $submiText = '';
	var $config = array();
	var $eventId = 'new';
	var $evTitle = '';
	var $evLocation = '';
	var $startDate;
	var $noTime = true;
	var $startTime = '12:00:00';
	var $endTime = '12:00:00';
	var $details = '';
	var $category = 1;
	var $repeat = NO_REPEAT;
	var $interval = 1;
	var $noEndDate = true;
	var $endDate;
	var $weekdays = array();
	var $monthlyByDate = MONTHLY_BY_DATE;
	var $errors = array();
	var $adminFeatures = false;
	var $approved = false;
	var $submitter = '?';
	var $instructions = _FORM_INSTRUCTIONS;
	var $showDelete = false;
	var $rsvp = 'off';
	var $branchDate = '0000-00-00';
	var $insertId = 0;

	function __construct($action, $title, $submitText, $config, $startDate = '') {
		$this->action = $action;
		$this->title = $title;
		$this->submitText = $submitText;
		$this->config = $config;
		$this->startDate = validDate($startDate) ? $startDate : date('Y-m-d');
		$this->endDate = date('Y-m-d');
	}

	function display($displayErrors = false) {
		global $module_name;

		// PHP cannot recognize constants within heredoc blocks; so make some variables:

		$lTitle = _FORM_TITLE;
		$lLocation = _FORM_LOCATION;
		$lDate = _FORM_DATE;
		$lDetails = _FORM_DETAILS;
		$lTime = _FORM_TIME;
		$lNoTime = _FORM_NO_TIME;
		$lCategory = _FORM_CATEGORY;
		$lRepeat = _FORM_REPEAT;
		$lEvery = _FORM_EVERY;
		$lEndOn = _FORM_END_ON;
		$lNoEnd = _FORM_NO_END;
		$lRepeatOn = _FORM_REPEAT_ON;
		$lRepeatBy = _FORM_REPEAT_BY;
		$lDays = _FORM_DAYS;
		$lWeeks = _FORM_WEEKS;
		$lMonths = _FORM_MONTHS;
		$lYears = _FORM_YEARS;
		$lByDayEx = _FORM_BY_DAY_EX;
		$lByDateEx = _FORM_BY_DATE_EX;
		$lDelEventConfirm = _FORM_DEL_EVENT_CONFIRM;

		$startDateVal = $this->startDate;
		if ($this->isRepeating() && $this->hasBranchDate()) {
			$startDateVal = $this->branchDate;
		}
		$startDate = dateCombos('y', 'm', 'd', $startDateVal, $this->config);

		$noTimeChecked = $this->noTime ? 'checked="checked"' : '';
		$timeChecked = $this->noTime ? '' : 'checked="checked"';

		$timeRange = _FORM_START_TIME . ' ' . 
			timeCombos('sh', 'sm', 'smer', $this->startTime, $this->noTime, $this->config['time_in_24']) . 
			'&nbsp;&nbsp;' .  _FORM_END_TIME . ' ' . 
			timeCombos('eh', 'em', 'emer', $this->endTime, $this->noTime, $this->config['time_in_24']);

		$catCombo = categoryCombo('cat', $this->category);

		$repeatCombo = new Combo('repeat', 
										 array(_REPEAT_NONE, _REPEAT_DAY, _REPEAT_WEEK, _REPEAT_MONTH, _REPEAT_YEAR), 
										 $this->repeat);
		$repeatCombo->setOnChange('repeatChange(this.value)');
		$repeatComboCode = $repeatCombo->html();

		$endCombos = dateCombos('edy', 'edm', 'edd', $this->endDate, $this->config, $this->noEndDate);

		$weekDays = '';
		for ($i = 0; $i < 7; ++$i) {
			$check = in_array($i, $this->weekdays) ? ' checked="checked"' : '';
			$weekDays .= '<input type="checkbox" name="weekdays[]" value="' . "$i\" $check />" . dayAbbrev($i) . ' ';
		}

		$repeatMonthlyCombo = new Combo('monthlyby', 
													array(MONTHLY_BY_DATE => _FORM_REPEAT_BY_DATE, 
															MONTHLY_BY_DAY  => _FORM_REPEAT_BY_DAY),
													$this->monthlyByDate
												 );
		$repeatMonthlyCombo->setOnChange('monthlyByChange(this.value)');
		$repeatMonthlyCode = $repeatMonthlyCombo->html();

		$visible = 'visibility:visible;';
		$hidden  = 'visibility:hidden;';
		$endDateVisible = $this->repeat == NO_REPEAT ? $hidden : $visible;
		$weeklyVisible  = $this->repeat == WEEKLY_REPEAT ? $visible : $hidden;
		$monthlyVisible = $this->repeat == MONTHLY_REPEAT ? $visible : $hidden;
		$repeatVisible  = $this->repeat == NO_REPEAT ? 'display:none' : 'display:inline';

		$noEndChecked = $this->noEndDate ? 'checked="checked"' : '';
		$endDateChecked = $this->noEndDate ? '' : 'checked="checked"';

		$initialEvery = '';
		switch ($this->repeat) {
			case DAILY_REPEAT:
				$initialEvery = $lDays;
				break;

			case WEEKLY_REPEAT:
				$initialEvery = $lWeeks;
				break;

			case MONTHLY_REPEAT:
				$initialEvery = $lMonths;
				break;

			case YEARLY_REPEAT:
				$initialEvery = $lYears;
				break;
		}

		$titleClass = 'normal-label';
		$startDateClass = 'normal-label';
		$timeClass = 'normal-label';
		$catClass = 'normal-label';
		$repeatClass = 'normal-label';
		$intervalClass = 'normal-label';
		$endDateClass = 'normal-label';
		$locationClass = 'normal-label';
		$detailsClass = 'normal-label';

		if ($displayErrors) {
			if (array_key_exists('title', $this->errors)) {
				$titleClass = 'error-label';
			}
			if (array_key_exists('startDate', $this->errors)) {
				$startDateClass = 'error-label';
			}
			if (array_key_exists('time', $this->errors)) {
				$timeClass = 'error-label';
			}
			if (array_key_exists('category', $this->errors)) {
				$catClass = 'error-label';
			}
			if (array_key_exists('repeat', $this->errors)) {
				$repeatClass = 'error-label';
			}
			if (array_key_exists('interval', $this->errors)) {
				$intervalClass = 'error-label';
			}
			if (array_key_exists('endDate', $this->errors)) {
				$endDateClass = 'error-label';
			}
			if (array_key_exists('location', $this->errors)) {
				$locationClass = 'error-label';
			}
			if (array_key_exists('details', $this->errors)) {
				$detailsClass = 'error-label';
			}
		}

		$repeatStuff = <<<END_REPEAT_STUFF
<div id="gcalDivRepeat" style="$repeatVisible">
<table border="0" cellpadding="2" cellspacing="2">
<tr id="gcalEveryRow" style="$endDateVisible">
	<td><span class="$intervalClass">$lEvery</span></td>
	<td><input type="text" name="interval" size="3" maxlength="3" value="$this->interval" />
		<span id="gcalEveryUnits">$initialEvery</span></td>
</tr>
<tr id="gcalEndOnRow1" style="$endDateVisible">
	<td><span class="$endDateClass">$lEndOn</span></td>
	<td><input type="radio" name="noend" value="1" $noEndChecked onclick="endOnClick(true)" />$lNoEnd</td>
</tr>
<tr id="gcalEndOnRow2" style="$endDateVisible">
	<td></td>
	<td><input type="radio" name="noend" value="0" $endDateChecked onclick="endOnClick(false)" />$endCombos</td>
</tr>
<tr id="gcalWeeklyRow" style="$weeklyVisible">
	<td><span class="normal-label">$lRepeatOn</span></td>
	<td>$weekDays</td>
</tr>
<tr id="gcalRepeatByRow" style="$monthlyVisible">
	<td><span class="normal-label">$lRepeatBy</span></td>
	<td>$repeatMonthlyCode <span id="gcalRepeatByEx">$lByDateEx</span></td>
</tr>
</table>
</div>
END_REPEAT_STUFF;

		$javaScript = <<<END_JAVASCRIPT
<script type="text/javascript" language="JavaScript">
	var hasInnerText = (document.getElementsByTagName('body')[0].innerText != undefined) ? true : false;
	var lDays = '$lDays';
	var lWeeks = '$lWeeks';
	var lMonths = '$lMonths';
	var lYears = '$lYears';
	var lByDateEx = '$lByDateEx';
	var lByDayEx = '$lByDayEx';
	var lDelEventConfirm = '$lDelEventConfirm';
</script>
<script type="text/javascript" language="JavaScript" src="modules/$module_name/eventForm.js"></script>
END_JAVASCRIPT;

		if (!empty($this->instructions)) {
			echo '<br /><div class="text-center">' . $this->instructions . '</div><br /><br />' . "\n";
		}

		if ($displayErrors && count($this->errors) > 0) {
			echo '<div class="gcal-error">' . _ERR_PLEASE_FIX . '<br />' . "\n";
			displayList($this->errors);
			echo '</div>';
		}

		$submitBox = '';
		$approveBox = '';
		if ($this->adminFeatures) {
			$submitBox = '<tr><td><label for="submitter" class="normal-label">' . _FORM_SUBMITTER . '</label></td>' .
				'<td><input type="text" id="submitter" name="submitter" size="25" maxlength="25" value="' . 
				$this->submitter . '" /></td></tr>';

			$isChecked = $this->approved ? 'checked="checked" ' : '';
			$approveBox = '<tr><td><label for="approved" class="normal-label">' . _FORM_APPROVE . '</label></td>';
			$approveBox .= '<td><input type="checkbox" id="approved" name="approved" value="yes" ' . 
				$isChecked . '/></td></tr>';
		}

		$delButton = '';
		if ($this->showDelete && $this->eventId != 'new') {
			$delButton = '&nbsp;&nbsp;<input type="submit" name="delete" value="' . _FORM_DELETE_LABEL . 
				'" onclick="document.gcalPressed = this.name" />';
		}

		$cancelButton = '&nbsp;&nbsp;<input type="button" name="cancel" value="' . _FORM_CANCEL_LABEL . 
			'" onclick="history.back();" />';

		if ($this->config['wysiwyg'] && function_exists('wysiwyg_textarea_html')) {
			$user = $this->adminFeatures ? 'PHPNukeAdmin' : 'NukeUser';
			$wysiwyg = wysiwyg_textarea_html('description', $this->details, $user, '80', '12');

			// At this time, cannot provide an ID attribute to the WYSIWYG editor; so have to gen up a fake hidden
			// input element with the ID for the label

			$detailsArea = '<td><label for="description2" class="' . $detailsClass . '">' . $lDetails . '</label></td>' .
				'<td width="100%"><input type="hidden" name="description2" id="description2" value="" />' . $wysiwyg . '</td>';
		} else {
			$detailsArea = '<td><label for="description" class="' . $detailsClass . '">' . $lDetails . '</label></td>' .
				'<td><textarea id="description" name="description" rows="10" cols="80">' . $this->details . 
					'</textarea></td>';
		}

		$rsvpStuff = '';
		if ($this->config['rsvp'] == 'on' || $this->config['rsvp'] == 'email') {
			$rsvpStuff = '<tr><td><label for="rsvp" class="normal-label">' . _FORM_RSVP_LABEL . '</label></td><td>' .
				$this->rsvpCode() . '</td></tr>';
		}

		$branchStuff = '';
		if ($this->isRepeating()) {
			if ($this->hasBranchDate()) {
				$branchOpts = new RadioButtons('branch');
				$branchOpts->addButton('this', _GCAL_REPEAT_THIS_ONLY);
				$branchOpts->addButton('thisAndFuture', _GCAL_REPEAT_THIS_FUTURE);
				$branchOpts->addButton('allKeepStart', _GCAL_REPEAT_ALL_SAME_START .
					formatDate($this->startDate, $this->config['reg_date_format']));
				$branchOpts->addButton('allNewStart', _GCAL_REPEAT_ALL_NEW_START);
				$branchOpts->mash('this');
				$branchOpts->horizontal(false);
				$branchStuff = _GCAL_REPEAT_OPTIONS . '<br />';
				$branchStuff .= $branchOpts->html();
			} else {
				$branchStuff = _GCAL_REPEAT_NO_BRANCH_DATE . '<br />';
			}
		}

		echo <<<END_FORM
<form action="$this->action" method="post" name="submitForm" class="gcal-event-form" 
	onsubmit="return gcalEventSubmit();">
$javaScript
<fieldset>
	<legend>$this->title</legend>
	<table border="0">
		<tr>
			<td><label for="title" class="$titleClass">$lTitle</label></td>
			<td><input type="text" id="title" name="title" size="64" maxlength="255" value="$this->evTitle" /></td>
		</tr>
		<tr>
			<td><label for="location" class="$locationClass">$lLocation</label></td>
			<td><input type="text" id="location" name="location" size="64" maxlength="255" value="$this->evLocation" /></td>
		</tr>
		<tr>
			<td><label for="m" class="$startDateClass">$lDate</label></td>
			<td>$startDate</td>
		</tr>
		<tr>
			<td><label for="notime" class="$timeClass">$lTime</label></td>
			<td>
				<table border="0" cellpadding="2" cellspacing="2">
					<tr><td><input type="radio" id="notime" name="notime" value="1" $noTimeChecked onclick="timeClick(true)" />
						$lNoTime</td></tr>
					<tr><td><input type="radio" name="notime" value="0" $timeChecked onclick="timeClick(false)" />
						$timeRange</td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><label for="cat" class="$catClass">$lCategory</label></td>
			<td>$catCombo</td>
		</tr>
		<tr>
			$detailsArea
		</tr>
		<tr>
			<td><label for="repeat" class="$repeatClass">$lRepeat</label></td>
			<td>$repeatComboCode</td>
		</tr>
		<tr>
			<td></td>
			<td>$repeatStuff</td>
		</tr>
		$rsvpStuff
		$submitBox
		$approveBox
		<tr><td></td><td><br />$branchStuff<br /></td></tr>
		<tr>
			<td><input type="hidden" name="eventId" value="$this->eventId" /></td>
			<td><input type="submit" name="ok" value="$this->submitText" onclick="document.gcalPressed = this.name"/>
				$delButton $cancelButton</td>
		</tr>
	</table>
</fieldset>
</form>
END_FORM;
	}

	function setTitle($title) {
		$this->evTitle = trim($title);

		if ($this->evTitle == '') {
			$this->errors['title'] = _ERR_NO_TITLE;
		}
	}

	function setLocation($loc) {
		$this->evLocation = trim($loc);

		if ($this->evLocation == '' && $this->config['location_required']) {
			$this->errors['location'] = _ERR_NO_LOCATION;
		}
	}

	function setStartDate($to) {
		if (validDate($to)) {
			$this->startDate = $to;
		} else {
			$this->errors['startDate'] = _ERR_START_DATE . ": ($to)";
		}
	}

	function getStartDate() {
		return $this->startDate;
	}

	function setStartTime($time) {
		if (validTime($time)) {
			$this->noTime = false;
			$this->startTime = $time;
		} else {
			$this->errors['time'] = _ERR_TIME . ": ($time)";
		}
	}

	function setEndTime($time) {
		if (validTime($time)) {
			$this->noTime = false;
			$this->endTime = $time;
		} else {
			$this->errors['time'] = _ERR_TIME . ": ($time)";
		}
	}

	function setCategory($to) {
		$cats = getCategories();
		$to = intval($to);
		if (array_key_exists($to, $cats)) {
			$this->category = $to;
		} else {
			$this->errors['category'] = _ERR_CATEGORY . ": ($to)";
		}
	}

	function getCategory() {
		return $this->category;
	}

	function setDescription($to) {
		$this->details = trim($to);

		if ($this->details == '' && $this->config['details_required']) {
			$this->errors['details'] = _ERR_NO_DETAILS;
		}
	}

	function setRepeat($to) {
		$to = intval($to);
		if ($to >= NO_REPEAT && $to <= YEARLY_REPEAT) {
			$this->repeat = $to;
		} else {
			$this->errors['repeat'] = _ERR_REPEAT . ": ($to)";
		}
	}

	function setInterval($to) {
		$to = intval($to);
		if ($to > 0) {
			$this->interval = $to;
		} else {
			$this->errors['interval'] = _ERR_INTERVAL . ": ($to)";
		}
	}

	function setEndDate($to) {
		$this->noEndDate = false;
		if (validDate($to)) {
			$this->endDate = $to;
		} else {
			$this->endDate = date('Y-m-d');
			$this->errors['endDate'] = _ERR_END_DATE . ": ($to)";
		}
	}

	function setWeeklyRepeat($to) {
		if (is_array($to)) {
			$mask = array(0, 1, 2, 3, 4, 5, 6);
			$this->weekdays = array_intersect($to, $mask);
		}
	}

	function setMonthlyRepeat($to) {
		$to = intval($to);
		if ($to == MONTHLY_BY_DATE || $to == MONTHLY_BY_DAY) {
			$this->monthlyByDate = $to;
		}
	}

	function setApproved($to) {
		$this->approved = (bool) $to;
	}

	function errorCount() {
		return count($this->errors);
	}

	function getErrors() {
		return $this->errors;
	}

	function post($id) { // processes a POSTing of the form
		$this->eventId = $id == 'new' ? $id : intval($id);

		if (@get_magic_quotes_gpc()) {
			$_POST = stripslashesDeep($_POST);
		}

		// construct filter object; admins don't get their text filtered, everyone else does:

		$filter = $this->adminFeatures ? new GCInputFilter(array(), array(), 1, 1, 0)
			: new GCInputFilter($this->config['allowed_tags'], $this->config['allowed_attrs']);
		$filter->setCharset(_CHARSET);

		$this->setTitle(gcalSpecialChars($filter->process($_POST['title'])));
		$this->setLocation(gcalSpecialChars($filter->process($_POST['location'])));
		$this->setStartDate(toSqlDate($_POST['y'], $_POST['m'], $_POST['d']));

		if (isset($_POST['sh']) && isset($_POST['sm']) && isset($_POST['smer'])) {
			$this->setStartTime(toSqlTime($_POST['sh'], $_POST['sm'], $_POST['smer']));
		}
		
		if (isset($_POST['eh']) && isset($_POST['em']) && isset($_POST['emer'])) {
			$this->setEndTime(toSqlTime($_POST['eh'], $_POST['em'], $_POST['emer']));
		}

		$this->setCategory(intval($_POST['cat']));

		if (!$this->adminFeatures && $this->config['wysiwyg'] && function_exists('wysiwyg_textarea_html')) {
			// assume RavenNuke or equivalent; use their check_html function for their
			// allowable HTML rules for the fancy WYSIWYG editor:

			$this->setDescription(check_html($_POST['description']));
		} else {
			$this->setDescription(gcalSpecialChars($filter->process($_POST['description'])));
		}

		$this->setRepeat(intval($_POST['repeat']));
		if ($this->isRepeating()) {
			$this->setInterval($_POST['interval']);
			if (isset($_POST['edy']) && isset($_POST['edm']) && isset($_POST['edd'])) {
				$this->setEndDate(toSqlDate($_POST['edy'], $_POST['edm'], $_POST['edd']));
			}
		}

		if ($this->repeat == WEEKLY_REPEAT && validDate($this->startDate)) {
			$weekdays = array();
			if (is_array($_POST['weekdays'])) {
				$weekdays = array_filter($_POST['weekdays'], 'weekdayFilter');
			}

			// ensure that the start date weekday is part of the weekdays set

			$info = getdate(strtotime($this->startDate));
			$wday = $info['wday'];
			if (!in_array($wday, $weekdays)) {
				$weekdays []= $wday;
				sort($weekdays);
			}

			$this->setWeeklyRepeat($weekdays);
		}

		if ($this->repeat == MONTHLY_REPEAT && isset($_POST['monthlyby'])) {
			$this->setMonthlyRepeat(intval($_POST['monthlyby']));
		}

		if ($this->adminFeatures && isset($_POST['approved'])) {
			$this->approved = $_POST['approved'] == 'yes';
		}

		if ($this->adminFeatures) {
			$this->submitter = $filter->process($_POST['submitter']);
		} else {
			$this->submitter = getUserName();
		}

		if (isset($_POST['rsvp'])) {
			$this->setRsvp($_POST['rsvp']);
		}
	}

	function load($id) {
		global $prefix, $db;

		$eventTable = $prefix . GCAL_EVENT_TABLE;
		$id = intval($id);
		$sql = 'SELECT * FROM ' . $eventTable . ' WHERE id = ' . $id;
		$result = $db->sql_query($sql);
		if ($db->sql_numrows($result) == 0) {
			return false;
		}
		$row = $db->sql_fetchrow($result);

		$repeatMap = array('none' => NO_REPEAT, 'daily' => DAILY_REPEAT, 'weekly' => WEEKLY_REPEAT,
								 'monthly' => MONTHLY_REPEAT, 'yearly' => YEARLY_REPEAT);

		$this->eventId = $id;
		$this->evTitle = gcalSpecialChars($row['title']);
		$this->evLocation = gcalSpecialChars($row['location']);
		$this->startDate = $row['start_date'];
		$this->noTime = $row['no_time'];
		$this->startTime = $row['start_time'];
		$this->endTime = $row['end_time'];
		$this->category = $row['category'];
		$this->repeat = $repeatMap[$row['repeat_type']];
		$this->interval = $row['interval_val'];
		$this->noEndDate = $row['no_end_date'];
		$this->endDate = $row['end_date'];
		$this->weekdays = explode(',', $row['weekly_days']);
		$this->monthlyByDate = $row['monthly_by_day'];
		$this->submitter = $row['submitted_by'];
		$this->approved = (bool) $row['approved'];
		$this->rsvp = $row['rsvp'];

		if ($this->config['wysiwyg'] && function_exists('wysiwyg_textarea_html')) {
			$this->details = $row['details'];
		} else {
			$this->details = gcalSpecialChars(str_replace('<br />', "\n", $row['details']));
		}

		return true;
	}

	function enableAdmin($adminAdd = false) { // $adminAdd should be true for Admin add; false for edit
		$this->adminFeatures = true;
		$this->setInstructions('');
		$this->enableDelete();
		if ($adminAdd) {
			//$this->approved	= true;
			$this->submitter  = _ADMIN_NAME;
		}
	}

	function save() {
		if ($this->errorCount() > 0) {
			echo 'Cannot save with errors present<br /><br />';
			return;
		}

		global $prefix, $db;
		$eventTable = $prefix . GCAL_EVENT_TABLE;

		$repeatMap = array(NO_REPEAT => 'none', DAILY_REPEAT => 'daily', WEEKLY_REPEAT => 'weekly',
								 MONTHLY_REPEAT => 'monthly', YEARLY_REPEAT => 'yearly');

		$filter = new GCInputFilter();
		$filter->setCharset(_CHARSET);
		$title = $filter->safeSQL($this->evTitle);
		$location = $filter->safeSQL($this->evLocation);
		$submitter = $filter->safeSQL($this->submitter);

		if ($this->config['wysiwyg']) {
			$filter->nl2br(false);
		}
		$details = $filter->safeSQL($this->details);

		$noTime = $this->noTime ? 1 : 0;
		$repeat = $repeatMap[$this->repeat];
		$noEndDate = $this->noEndDate ? 1 : 0;
		$weekdays = implode(',', $this->weekdays);

		if ($this->eventId == 'new') {
			// insert new item into the event table

			if ($this->adminFeatures) {
				$approved = $this->approved ? 1 : 0;
			} else {
				$approved = ($this->config['req_approval'] && 
					!gcalNeedsNoApproval($this->config['groups_no_approval'])) ? 0 : 1;
			}

			$sql = 'INSERT INTO ' . $eventTable . ' VALUES (NULL, ' .
				"'$title', $noTime, '$this->startTime', '$this->endTime', '$location', $this->category, " .
				"'$repeat', '$details', $this->interval, $noEndDate, '$this->startDate', '$this->endDate', " .
				"'$weekdays', $this->monthlyByDate, '$submitter', $approved, '$this->rsvp')";
		} else {
			// update existing row in the event table

			$approved = $this->approved ? 1 : 0;

			$sql = 'UPDATE ' . $eventTable . ' SET ' .
				"title = '$title', " .
				"no_time = $noTime, " .
				"start_time = '$this->startTime', " .
				"end_time = '$this->endTime', " .
				"location = '$location', " .
				"category = $this->category, " .
				"repeat_type = '$repeat', " .
				"details = '$details', " .
				"interval_val = $this->interval, " .
				"no_end_date = $noEndDate, " .
				"start_date = '$this->startDate', " .
				"end_date = '$this->endDate', " .
				"weekly_days = '$weekdays', " .
				"monthly_by_day = $this->monthlyByDate, " .
				"submitted_by = '$submitter', " .
				"approved = $approved, " .
				"rsvp = '$this->rsvp' " .
				'WHERE id = ' . $this->eventId;
		}

		$result = $db->sql_query($sql);
		$this->insertId = $db->sql_nextid();
		return $result;
	}

	function setInstructions($to) {
		$this->instructions = $to;
	}

	function enableDelete() {
		$this->showDelete = true;
	}

	function setRsvp($to) {
		switch ($to) {
			case 'off':
			case 'on':
			case 'email':
				$this->rsvp = $to;
				break;

			default:
				$this->rsvp = 'off';
				break;
		}
	}

	function rsvpCode() {
		if ($this->config['rsvp'] == 'off') {
			return '';
		}
		$items = array('off' => _FORM_RSVP_OFF, 'on' => _FORM_RSVP_ON);
		if ($this->config['rsvp'] == 'email') {
			$items['email'] = _FORM_RSVP_EMAIL;
		}
		$combo = new Combo('rsvp', $items, $this->rsvp);
		return $combo->html();
	}

	function setBranchDate($to) {
		$this->branchDate = $to;
	}

	function hasBranchDate() {
		return $this->branchDate != '0000-00-00';
	}

	function isRepeating() {
		return $this->repeat != NO_REPEAT;
	}

	function markNew() {
		$this->eventId = 'new';
	}

	function noRepeat() {
		$this->repeat = NO_REPEAT;
		$this->noEndDate = true;
		$this->endDate = '0000-00-00';
	}

	function getInsertId() {
		return $this->insertId;
	}
}

?>