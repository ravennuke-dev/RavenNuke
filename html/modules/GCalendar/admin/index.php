<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// admin index.php - This file is part of GCalendar
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
// modules/GCalendar/admin/index.php: Admin functions for GCalendar.
///////////////////////////////////////////////////////////////////////

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

global $prefix, $db, $admin_file, $currentlang;

$module_name = basename(dirname(dirname(__FILE__)));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name, true);

$radminsuper = $auth_user = is_mod_admin($module_name);

if ($radminsuper == 1 || $auth_user == 1) {
	require_once 'modules/' . $module_name . '/gcal.inc.php';
	require_once 'modules/' . $module_name . '/class.combo.php';
	require_once 'modules/' . $module_name . '/common.inc.php';
	require_once 'modules/' . $module_name . '/gcInputFilter.php';
	require_once 'modules/' . $module_name . '/class.eventForm.php';
	require_once 'modules/' . $module_name . '/admin/class.adminEventTable.php';
	require_once 'modules/' . $module_name . '/displayEvent.php';
	require_once 'modules/' . $module_name . '/class.checkboxes.php';

	function dayCombo($name, $selDay, $disabled = false) {
		$items = array();
		for ($i = 0; $i < 7; ++$i) {
			$items[$i] = dayName($i);
		}
		$combo = new Combo($name, $items, $selDay);
		$combo->enable(!$disabled);
		return $combo->html();
	}

	////////////////////////////////////////////////////////////////////

	function gcalAdminMenu($nolink = '') {
		global $admin_file, $db, $prefix;

		// get a count of pending events
		$eventTable = $prefix . GCAL_EVENT_TABLE;
		$sql = 'SELECT COUNT(*) FROM ' . $eventTable . ' WHERE approved = 0';
		$result = $db->sql_query($sql);
		$pending = '(?)';
		if ($result && $row = $db->sql_fetchrow($result)) {
			$pending = '(' . $row[0] . ')';
		}

		$titles = array('approve'  => _ADMIN_APPROVE,
						'add' => _ADMIN_ADD_EVENT,
						'edit' => _ADMIN_EDIT_EVENTS,
						'cat' => _ADMIN_EDIT_CAT,
						'config' => _ADMIN_EDIT_CONFIG,
						'groups' => _ADMIN_GROUPS,
						'about' => _GCAL_ADMIN_ABOUT);

		$ops = array('gcalendar', 'gcal_add', 'gcal_edit', 'gcal_cat', 'gcal_config', 'gcal_groups', 'gcal_about');
		$last = count($titles) - 1;

		echo '<div class="text-center">';
		$i = 0;
		foreach($titles as $key => $title) {
			if ($key == 'approve') {
				$item = $title . ' ' . $pending;
			} else {
				$item = $title;
			}

			if ($key != $nolink) {
				$item = "<a href=\"$admin_file.php?op={$ops[$i]}\">" . $item . '</a>';
			}

			echo $item;

			if ($i != $last) {
				echo ' | ';
			}
			++$i;
		}

		echo '</div><br /><br />';

		// purge old events form

		$formAction = $admin_file . '.php?op=gcal_purge';
		$purgeText = _PURGE_BUTTON_TEXT;
		$purgeConfirm = _PURGE_CONFIRM_HELP;

      echo <<<END_PURGE_FORM
<div class="text-center">
<form action="$formAction" method="post" name="gcalPurgeForm" onsubmit="return gcalPurgeConfirm();">
<script type="text/javascript" language="Javascript">
//<![CDATA[
   function gcalPurgeConfirm()
   {
      return confirm('$purgeConfirm');
   }
//]]>
</script>
<input type="submit" name="purge" value="$purgeText" />
</form>
</div>
<br />
END_PURGE_FORM;
		echo '<div class="text-center"><a href="' . GCAL_MOD_LINK . '">' . _ADMIN_GOTO_MODULE . '</a></div><br />';

		CloseTable();
		OpenTable();

		if (array_key_exists($nolink, $titles)) {
			echo '<div class="text-center"><div class="title">' . $titles[$nolink] . '</div></div><br /><br />';
		}
	}

	////////////////////////////////////////////////////////////////////

	function confirmDeleteEvent($id) {
		global $admin_file;

		gcalAdminMenu();
		$id = intval($id);
		echo '<div class="text-center"><div class="title">' . sprintf(_ADMIN_CONFIRM_DEL, $id) . '</div></div><br /><br />';

		$yesLink = '<a class="rn_csrf" href="' . $admin_file . '.php?op=gcal_del_conf&amp;id=' . $id . '">' . _CONF_YES . '</a>';
		$noLink  = '<a href="javascript:history.back()">' . _CONF_NO . '</a>';

		echo '<div class="text-center">[ ' . $yesLink . ' ] &nbsp;&nbsp;&nbsp; [ ' . $noLink . ' ]</div><br /><br />';
	}

	////////////////////////////////////////////////////////////////////

	function deleteEvent($id) {
		gcalAdminMenu();

		$id = intval($id);
		$result = gcalDeleteEvents($id);
		if ($result) {
			echo '<br /><div class="text-center">' . _ADMIN_DELETE_OK . $id . '</div>';
		} else {
			echo '<br /><div class="text-center thick">' . _ADMIN_DELETE_ERR . $id . '</div>';
		}
		echo '<br /><br />';
	}

	function deleteSelectedEvents() {
		global $admin_file;

		$errMsg = '';
		$events = $_POST['select'];
		if (is_array($events) && count($events) > 0) {
			$events = array_keys($events);
			$result = gcalDeleteEvents($events);
			if (!$result) {
				$errMsg = _EVENTS_DEL_ERR;
			}
		} else {
			$errMsg = _NONE_SELECTED;
		}

		$backTo = isset($_POST['backto']) ? $_POST['backto'] : 'gcalendar';
		$backTo = ($backTo == 'gcalendar' || $backTo == 'gcal_edit') ? $backTo : 'gcalendar';
		$noLink = ($backTo == 'gcalendar') ? 'approve' : 'edit';
		gcalAdminMenu($noLink);

		if ($errMsg != '') {
			echo '<br /><div class="text-center">' . $errMsg . '</div><br /><br />';
		}

		$table = new AdminEventTable(($noLink == 'approve') ? 'start_date' : 'id',
											  $noLink == 'approve',
											  $admin_file . '.php?op=' . $backTo,
											  $backTo,
											  getConfig());
		$table->display();
	}

	////////////////////////////////////////////////////////////////////

	function editCatForm() {
		global $admin_file;

		$currCats = _CURRENT_CATS;
		$categories = getCategories();
		$catList = new Combo('cat', $categories);
		$catList->size(min(20, count($categories)));
		$catList->setOnChange('gcalCategoryChange()');

		$catTitles = array();
		foreach ($categories as $id => $name) {
			$catTitles[$id] = _CATEGORY_ID . ' ' . $id;
		}

		$catList->setTitles($catTitles);
		$catListCode = $catList->html();

		$modDelAction = $admin_file . '.php?op=gcal_mod_cat';
		$modVal = current($categories);
		$modifyButton = _MODIFY_BUTTON;
		$addButton = _ADD_BUTTON;
		$delButton = _DELETE_BUTTON;
		$confirmDel = _CONFIRM_DELETE_CAT;
		$noText = _NO_ADD_TEXT;

		$lCategoryId = _CATEGORY_ID;
		$lCategories = _VIEW_DAY_CATEGORY;

		echo <<<END_CAT_FORM
<div class="text-center">
<form name="gcalCatForm" action="$modDelAction" method="post" onsubmit="return gcalCatSubmit();">
<script type="text/javascript" language="Javascript">
//<![CDATA[
	function gcalCategoryChange()
	{
		document.gcalCatForm.modifyVal.value =
			document.gcalCatForm.cat.options[document.gcalCatForm.cat.selectedIndex].text;
	}
	function gcalCatSubmit()
	{
		if (document.gcalPressed == 'delete')
		{
			var q = '$confirmDel';
			return confirm(q);
		}

		var s1 = document.gcalCatForm.addVal.value;
		var s2 = document.gcalCatForm.modifyVal.value;
		s1 = s1.replace(/\s/g, "");
		s2 = s2.replace(/\s/g, "");

		if ((document.gcalPressed == 'add' && s1.length == 0) ||
			 (document.gcalPressed == 'modify' && s2.length == 0))
		{
			alert('$noText');
			return false;
		}
		return true;
	}
//]]>
</script>
<table border="0" cellpadding="3" cellspacing="3">
<tr><th align="center">$currCats</th></tr>
<tr><td align="center">$catListCode</td></tr>
</table><br /><br />
<table border="0" cellpadding="3" cellspacing="3">
<tr>
	<td align="right"><input type="submit" name="modify" value="$modifyButton"
		onclick="document.gcalPressed = this.name" /></td>
	<td align="left"><input type="text" name="modifyVal" size="32" maxlength="128" value="$modVal" /></td>
</tr>
<tr>
	<td align="right"><input type="submit" name="add" value="$addButton" onclick="document.gcalPressed = this.name" /></td>
	<td align="left"><input type="text" name="addVal" size="32" maxlength="128" value="" /></td>
</tr>
<tr>
	<td align="center" colspan="2">
		<input type="submit" name="delete" value="$delButton" onclick="document.gcalPressed = this.name" /></td>
</tr>
</table>
</form>
</div>
<br />
<div class="text-center">
<table border="1" cellpadding="3" cellspacing="0">
<tr><th>$lCategories</th><th>$lCategoryId</th></tr>
END_CAT_FORM;

		foreach($categories as $id => $name) {
			echo '<tr><td>' . $name . '</td><td align="center">' . $id . '</td></tr>';
		}

		echo '</table></div><br />';
	}

	////////////////////////////////////////////////////////////////////

	function modifyCategories() {
		global $prefix, $db;
		$cat = intval($_POST['cat']);

		$catTable = $prefix . GCAL_CAT_TABLE;
		$catGroupTable = $prefix . GCAL_CAT_GROUP_TABLE;

		if (array_key_exists('delete', $_POST)) {
			$sql = 'DELETE FROM ' . $catTable . ' WHERE `id` = ' . $cat;
			$result = $db->sql_query($sql);
			$sql = 'DELETE FROM ' . $catGroupTable . ' WHERE `cat_id` = ' . $cat;
			$result = $db->sql_query($sql);
		} else if (array_key_exists('modify', $_POST)) {
			$filter = new GCInputFilter();
			$filter->setCharset(_CHARSET);
			$name = $filter->process($_POST['modifyVal']);
			$name = $filter->safeSQL($name);
			$sql = "UPDATE $catTable SET `name` = '$name' WHERE `id` = $cat";
			$result = $db->sql_query($sql);
		} else if (array_key_exists('add', $_POST)) {
			$filter = new GCInputFilter();
			$filter->setCharset(_CHARSET);
			$name = $filter->process($_POST['addVal']);
			$name = $filter->safeSQL($name);
			$sql = "INSERT INTO $catTable VALUES (NULL, '$name')";
			$result = $db->sql_query($sql);
			$catId = $db->sql_nextid();
			$sql = "INSERT INTO $catGroupTable VALUES (NULL, '$catId', -1)";
			$result = $db->sql_query($sql);
		}
	}

	////////////////////////////////////////////////////////////////////

	function purgeEvents() {
		global $prefix, $db;
		$eventTable = $prefix . GCAL_EVENT_TABLE;

		echo '<div class="text-center"><div class="title">' . _ADMIN_PURGE_RESULTS . '</div></div><br /><br />';

		$sql = "SELECT id FROM $eventTable WHERE approved != 0 AND (" .
			"(repeat_type = 'none' AND start_date < NOW()) OR " .
			"(repeat_type != 'none' AND no_end_date = 0 AND end_date < NOW()))";

		$result = $db->sql_query($sql);
		if ($db->sql_numrows($result) > 0) {
			$events = array();
			while ($row = $db->sql_fetchrow($result)) {
				$events[] = intval($row['id']);
			}
			$success = gcalDeleteEvents($events);
		} else {
			$success = true;
		}

		echo '<div class="text-center">' . ($success ? _ADMIN_DB_OK : _ADMIN_DB_ERR) . '</div><br /><br />';
	}

	////////////////////////////////////////////////////////////////////

	function editConfigForm() {
		global $admin_file;
		$config = getConfig();
		$title = gcalSpecialChars($config['title']);
		$image = gcalSpecialChars($config['image']);
		$minYear  = intval($config['min_year']);
		$maxYear  = intval($config['max_year']);
		$reqAppChk = intval($config['req_approval']) > 0 ? 'checked="checked"' : '';
		$userUpdateChk = intval($config['user_update']) > 0 ? 'checked="checked"' : '';
		$tags = gcalSpecialChars(implode(',', $config['allowed_tags']));
		$attrs = gcalSpecialChars(implode(',', $config['allowed_attrs']));
		$time24 = intval($config['time_in_24']);
		$time12Chk = $time24 == 0 ? 'checked="checked"' : '';
		$time24Chk = $time24 != 0 ? 'checked="checked"' : '';
		$shortDateFmt = gcalSpecialChars($config['short_date_format']);
		$regDateFmt = gcalSpecialChars($config['reg_date_format']);
		$longDateFmt = gcalSpecialChars($config['long_date_format']);
		$autoLinkChk = intval($config['auto_link']) > 0 ? 'checked="checked"' : '';
		$wysiwygChk = intval($config['wysiwyg']) > 0 ? 'checked="checked"' : '';
		$locReqChk = intval($config['location_required']) > 0 ? 'checked="checked"' : '';
		$detailsReqChk = intval($config['details_required']) > 0 ? 'checked="checked"' : '';
		$catLegendChk = intval($config['show_cat_legend']) > 0 ? 'checked="checked"' : '';
		$emailChk = intval($config['email_notify']) > 0 ? 'checked="checked"' : '';
		$emailTo = gcalSpecialChars($config['email_to']);
		$emailFrom = gcalSpecialChars($config['email_from']);
		$emailSubject = gcalSpecialChars($config['email_subject']);
		$emailMsg = gcalSpecialChars($config['email_msg']);
		$rsvpSubject = gcalSpecialChars($config['rsvp_email_subject']);

		$submitOptions = array('off' => _SUBMIT_OFF, 'members' => _SUBMIT_MEMBERS, 'anyone' => _SUBMIT_ANYONE,
			'groups' => _SUBMIT_GROUPS);
		$userSubmitCombo = new Combo('userSubmit', $submitOptions, $config['user_submit']);
		$userSubmitCode = $userSubmitCombo->html();

		$rsvpOptions = array('off' => _RSVP_OFF, 'on' => _RSVP_ON, 'email' => _RSVP_ON_EMAIL);
		$rsvpCombo = new Combo('rsvp', $rsvpOptions, $config['rsvp']);
		$rsvpCode = $rsvpCombo->html();

		$fdotwCode = dayCombo('fdotw', $config['first_day_of_week']);

		$weekends = new Checkboxes('weekends');
		for ($i = 0; $i < 7; ++$i) {
			$weekends->addItem($i, dayAbbrev($i), in_array($i, $config['weekends']));
		}
		$weekendsCode = $weekends->html();


		$formAction = $admin_file . '.php?op=gcal_save_config';
		$formTitle = _ADMIN_CONFIG_FORM_TITLE;
		$lTitle = _ADMIN_CONFIG_TITLE;
		$lImage = _ADMIN_CONFIG_IMAGE;
		$lImageTip = _ADMIN_CONFIG_IMAGE_TIP;
		$lMinYear = _ADMIN_CONFIG_MIN_YEAR;
		$lMaxYear = _ADMIN_CONFIG_MAX_YEAR;
		$lYearTip = _ADMIN_CONFIG_YEAR_TIP;
		$lUserSubmit = _ADMIN_CONFIG_USER_SUBMIT;
		$lUserSubmitTip = _ADMIN_CONFIG_USER_SUBMIT_TIP;
		$lReqApp = _ADMIN_CONFIG_REQ_APP;
		$lUserUpdate = _ADMIN_CONFIG_USER_UPDATE;
		$lTimeFormat = _ADMIN_CONFIG_TIME_FORMAT;
		$lTime12Example = formatTime('15:00:00', false);
		$lTime24Example = formatTime('15:00:00', true);
		$lUpdate = _ADMIN_CONFIG_UPDATE;
		$lTagsTip = _ADMIN_CONFIG_TAGS_TIP;
		$lTags = _ADMIN_CONFIG_TAGS;
		$lAttrsTip = _ADMIN_CONFIG_ATTRS_TIP;
		$lAttrs = _ADMIN_CONFIG_ATTRS;
		$lShortDateFmt = _ADMIN_CONFIG_SHORT_DATE_FORMAT;
		$lRegDateFmt = _ADMIN_CONFIG_REG_DATE_FORMAT;
		$lLongDateFmt = _ADMIN_CONFIG_LONG_DATE_FORMAT;
		$lDateFormatEx = _ADMIN_CONFIG_DATE_FORMAT_EX;
		$lFirstDayWeek = _ADMIN_CONFIG_FIRST_DAY_WEEK;
		$lWeekends = _ADMIN_CONFIG_WEEKENDS;
		$lAutoLink = _ADMIN_CONFIG_AUTO_LINK;
		$lWysiwyg = _ADMIN_CONFIG_WYSIWYG;
		$lLocationReq = _ADMIN_CONFIG_LOC_REQ;
		$lDetailsReq = _ADMIN_CONFIG_DETAILS_REQ;
		$lCatLegend = _ADMIN_CONFIG_CAT_LEGEND;
		$lRsvp = _ADMIN_CONFIG_RSVP;
		$lEmailNotify = _ADMIN_CONFIG_EMAIL_NOTIFY;
		$lEmailTo = _ADMIN_CONFIG_EMAIL_TO;
		$lEmailToTip = _ADMIN_CONFIG_EMAIL_TO_TIP;
		$lEmailFrom = _ADMIN_CONFIG_EMAIL_FROM;
		$lEmailSubject = _ADMIN_CONFIG_EMAIL_SUBJECT;
		$lEmailMsg = _ADMIN_CONFIG_EMAIL_MSG;
		$lRsvpSubject = _ADMIN_CONFIG_RSVP_SUBJECT;

		echo <<<END_FORM
<form action="$formAction" method="post" name="submitForm" class="gcal-event-form">
<fieldset>
	<legend>$formTitle</legend>
	<table border="0">
		<tr>
			<td align="right"><label for="title" class="normal-label">$lTitle</label></td>
			<td><input type="text" id="title" name="title" size="64" maxlength="128" value="$title" /></td>
		</tr>
		<tr>
			<td align="right"><label for="image" class="normal-label" title="$lImageTip">$lImage</label></td>
			<td><input type="text" id="image" name="image" size="64" maxlength="255" value="$image" title="$lImageTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="minYear" class="normal-label" title="$lYearTip">$lMinYear</label></td>
			<td><input type="text" id="minYear" name="minYear" size="4" maxlength="4" value="$minYear" title="$lYearTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="maxYear" class="normal-label" title="$lYearTip">$lMaxYear</label></td>
			<td><input type="text" id="maxYear" name="maxYear" size="4" maxlength="4" value="$maxYear" title="$lYearTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="userSubmit" class="normal-label" title="$lUserSubmitTip">$lUserSubmit</label></td>
			<td>$userSubmitCode</td>
		</tr>
		<tr>
			<td align="right"><label for="reqApproval" class="normal-label">$lReqApp</label></td>
			<td><input type="checkbox" id="reqApproval" name="reqApproval" $reqAppChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="userUpdate" class="normal-label">$lUserUpdate</label></td>
			<td><input type="checkbox" id="userUpdate" name="userUpdate" $userUpdateChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="timeFormat" class="normal-label">$lTimeFormat</label></td>
			<td><input type="radio" id="timeFormat" name="timeFormat" value="0" $time12Chk />$lTime12Example
				 <input type="radio" name="timeFormat" value="1" $time24Chk />$lTime24Example</td>
		</tr>
		<tr>
			<td align="right"><label for="shortDateFmt" class="normal-label">$lShortDateFmt</label></td>
			<td><input type="text" id="shortDateFmt" name="shortDateFmt" size="16" maxlength="16" value="$shortDateFmt" />
					$lDateFormatEx</td>
		</tr>
		<tr>
			<td align="right"><label for="regDateFmt" class="normal-label">$lRegDateFmt</label></td>
			<td><input type="text" id="regDateFmt" name="regDateFmt" size="16" maxlength="16" value="$regDateFmt" />
					$lDateFormatEx</td>
		</tr>
		<tr>
			<td align="right"><label for="longDateFmt" class="normal-label">$lLongDateFmt</label></td>
			<td><input type="text" id="longDateFmt" name="longDateFmt" size="16" maxlength="16" value="$longDateFmt" />
					$lDateFormatEx</td>
		</tr>
		<tr>
			<td align="right"><label for="fdotw" class="normal-label">$lFirstDayWeek</label></td>
			<td>$fdotwCode</td>
		</tr>
		<tr>
			<td align="right"><label for="weekends_0" class="normal-label">Weekend Days:</label></td>
			<td>$weekendsCode</td>
		</tr>
		<tr>
			<td align="right"><label for="tags" class="normal-label" title="$lTagsTip">$lTags</label></td>
			<td><input type="text" id="tags" name="tags" size="64" maxlength="255" value="$tags" title="$lTagsTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="attrs" class="normal-label" title="$lAttrsTip">$lAttrs</label></td>
			<td><input type="text" id="attrs" name="attrs" size="64" maxlength="255" value="$attrs" title="$lAttrsTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="autoLink" class="normal-label">$lAutoLink</label></td>
			<td><input type="checkbox" id="autoLink" name="autoLink" $autoLinkChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="wysiwyg" class="normal-label">$lWysiwyg</label></td>
			<td><input type="checkbox" id="wysiwyg" name="wysiwyg" $wysiwygChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="locReq" class="normal-label">$lLocationReq</label></td>
			<td><input type="checkbox" id="locReq" name="locReq" $locReqChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="detailsReq" class="normal-label">$lDetailsReq</label></td>
			<td><input type="checkbox" id="detailsReq" name="detailsReq" $detailsReqChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="catLegend" class="normal-label">$lCatLegend</label></td>
			<td><input type="checkbox" id="catLegend" name="catLegend" $catLegendChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="rsvp" class="normal-label">$lRsvp</label></td>
			<td>$rsvpCode</td>
		</tr>
		<tr>
			<td align="right"><label for="rsvpSubject" class="normal-label">$lRsvpSubject</label></td>
			<td><input type="text" id="rsvpSubject" name="rsvpSubject" size="64" maxlength="255" value="$rsvpSubject" /></td>
		</tr>
		<tr>
			<td align="right"><label for="emailNotify" class="normal-label">$lEmailNotify</label></td>
			<td><input type="checkbox" id="emailNotify" name="emailNotify" $emailChk /></td>
		</tr>
		<tr>
			<td align="right"><label for="emailTo" class="normal-label" title="$lEmailToTip">$lEmailTo</label></td>
			<td><input type="text" id="emailTo" name="emailTo" size="64" maxlength="255" value="$emailTo" title="$lEmailToTip" /></td>
		</tr>
		<tr>
			<td align="right"><label for="emailFrom" class="normal-label">$lEmailFrom</label></td>
			<td><input type="text" id="emailFrom" name="emailFrom" size="64" maxlength="255" value="$emailFrom" /></td>
		</tr>
		<tr>
			<td align="right"><label for="emailSubject" class="normal-label">$lEmailSubject</label></td>
			<td><input type="text" id="emailSubject" name="emailSubject" size="64" maxlength="255" value="$emailSubject" /></td>
		</tr>
		<tr>
			<td align="right"><label for="emailMsg" class="normal-label">$lEmailMsg</label></td>
			<td><textarea id="emailMsg" name="emailMsg" rows="4" cols="64">$emailMsg</textarea></td>
		</tr>
	</table><br />
	<div class="text-center"><input type="submit" name="ok" value="$lUpdate" /></div>
</fieldset>
</form>
END_FORM;
	}

	////////////////////////////////////////////////////////////////////

	function saveConfig() {
		global $prefix, $db;

		$configTable = $prefix . GCAL_CONF_TABLE;

		$filter = new GCInputFilter();
		$filter->setCharset(_CHARSET);
		$title = $filter->safeSQL($filter->process($_POST['title']));
		$image = $filter->safeSQL($filter->process($_POST['image']));
		$tags = $filter->safeSQL($filter->process($_POST['tags']));
		$attrs = $filter->safeSQL($filter->process($_POST['attrs']));
		$shortDateFmt = $filter->safeSQL($filter->process($_POST['shortDateFmt']));
		$regDateFmt = $filter->safeSQL($filter->process($_POST['regDateFmt']));
		$longDateFmt = $filter->safeSQL($filter->process($_POST['longDateFmt']));
		$rsvpSubject = $filter->safeSQL($filter->process($_POST['rsvpSubject']));
		$emailTo = $filter->safeSQL($filter->process($_POST['emailTo']));
		$emailFrom = $filter->safeSQL($filter->process($_POST['emailFrom']));
		$emailSubject = $filter->safeSQL($filter->process($_POST['emailSubject']));

		$filter->nl2br(false);
		$emailMsg = $filter->safeSQL($filter->process($_POST['emailMsg']));

		$tags  = str_replace(' ', '', $tags);
		$attrs = str_replace(' ', '', $attrs);

		$minYear = intval($_POST['minYear']);
		$minYear = max(1902, min(2037, $minYear));
		$maxYear = intval($_POST['maxYear']);
		$maxYear = max(1902, min(2037, $maxYear));
		$minYear = min($minYear, $maxYear);

		$userSubmit = $_POST['userSubmit'];
		switch ($userSubmit) {
			case 'none':
			case 'members':
			case 'anyone':
			case 'groups':
				break;

			default:
				$userSubmit = 'none';
				break;
		}

		$rsvp = $_POST['rsvp'];
		switch ($rsvp) {
			case 'off':
			case 'on':
			case 'email':
				break;

			default:
				$rsvp = 'off';
				break;
		}

		$reqApproval = isset($_POST['reqApproval']) && $_POST['reqApproval'] == 'on' ? 1 : 0;
		$userUpdate  = isset($_POST['userUpdate']) && $_POST['userUpdate'] == 'on' ? 1 : 0;
		$autoLink = isset($_POST['autoLink']) && $_POST['autoLink'] == 'on' ? 1 : 0;
		$wysiwyg = isset($_POST['wysiwyg']) && $_POST['wysiwyg'] == 'on' ? 1 : 0;
		$locReq = isset($_POST['locReq']) && $_POST['locReq'] == 'on' ? 1 : 0;
		$detailsReq = isset($_POST['detailsReq']) && $_POST['detailsReq'] == 'on' ? 1 : 0;
		$emailNotify = isset($_POST['emailNotify']) && $_POST['emailNotify'] == 'on' ? 1 : 0;
		$catLegend = isset($_POST['catLegend']) && $_POST['catLegend'] == 'on' ? 1 : 0;

		$time24 = intval($_POST['timeFormat']) == 0 ? 0 : 1;
		$fdotw = intval($_POST['fdotw']);

		$weekends = array();
		if (is_array($_POST['weekends'])) {
			$weekends = array_map('intval', array_keys($_POST['weekends']));
		}
		$weekends = implode(',', $weekends);

		$sql = 'UPDATE ' . $configTable . ' SET' .
			" title = '$title'," .
			" image = '$image'," .
			" min_year = '$minYear'," .
			" max_year = '$maxYear'," .
			" user_submit = '$userSubmit'," .
			" req_approval = '$reqApproval'," .
			" allowed_tags = '$tags'," .
			" allowed_attrs = '$attrs'," .
			" time_in_24 = '$time24'," .
			" short_date_format = '$shortDateFmt'," .
			" reg_date_format = '$regDateFmt'," .
			" long_date_format = '$longDateFmt'," .
			" first_day_of_week = '$fdotw'," .
			" auto_link = '$autoLink'," .
			" location_required = '$locReq'," .
			" details_required = '$detailsReq'," .
			" email_notify = '$emailNotify'," .
			" email_to = '$emailTo'," .
			" email_from = '$emailFrom'," .
			" email_subject = '$emailSubject'," .
			" email_msg = '$emailMsg'," .
			" show_cat_legend = '$catLegend'," .
			" wysiwyg = '$wysiwyg'," .
			" user_update = '$userUpdate'," .
			" weekends = '$weekends'," .
			" rsvp = '$rsvp'," .
			" rsvp_email_subject = '$rsvpSubject'" .
			' WHERE id = 1 LIMIT 1';

		$result = $db->sql_query($sql);
		if (!$result) {
			echo '<div class="text-center thick">' . _ADMIN_DB_ERR . '</div><br /><br />';
		}
	}

	////////////////////////////////////////////////////////////////////

	function gcalDisplayRsvpEdit($id) {
		global $db, $prefix, $user_prefix;
		$usersTable = $user_prefix . '_users';
		$rsvpTable  = $prefix . GCAL_RSVP_TABLE;

		$sql = 'SELECT r.id, u.username FROM ' . $usersTable . ' AS u, ' . $rsvpTable . ' AS r WHERE r.event_id = \'' .
			$id . '\' AND r.user_id = u.user_id ORDER BY u.username';
		$result = $db->sql_query($sql);

		$users = array();
		while ($row = $db->sql_fetchrow($result)) {
			$users[$row['id']] = $row['username'];
		}
		if (count($users) > 0) {
			global $admin_file;
			$formAction = $admin_file . '.php?op=gcal_del_rsvp';
			echo '<div class="text-center"><form action="' . $formAction . '" method="post" onsubmit="return gcalRsvpDelConfirm();">';
			$delRsvpConfirm = _GCAL_DEL_RSVP_CONFIRM;
			echo <<<END_RSVP_DEL_CONFIRM
<script type="text/javascript" language="Javascript">
//<![CDATA[
function gcalRsvpDelConfirm()
{
	return confirm('$delRsvpConfirm');
}
//]]>
</script>
END_RSVP_DEL_CONFIRM;

			$userList = new Combo('rsvps[]', $users);
			$userList->size(min(50, count($users)));
			$userList->multiple();
			$userList->display();
			echo '<br /><br /><input type="submit" value="' . _GCAL_DEL_RSVP . '" />';
			echo '<input type="hidden" name="id" value="' . $id . '" />';
			echo '</form></div>';
		} else {
			echo '<div class="text-center">' . _GCAL_EMPTY_RSVP_LIST . '</div>';
		}
		echo '<br /><br />';
	}

	////////////////////////////////////////////////////////////////////

	function gcalDeleteRsvp($rsvps) {
		global $db, $prefix;
		$rsvpTable  = $prefix . GCAL_RSVP_TABLE;

		if (is_array($rsvps)) {
			$rsvps = array_map('intval', $rsvps);
			$where = ' WHERE id = ' . implode(' OR id = ', $rsvps);
			$sql = 'DELETE FROM ' . $prefix . GCAL_RSVP_TABLE . $where;
			$db->sql_query($sql);
		}
	}

	////////////////////////////////////////////////////////////////////

	function gcalAbout($config) {
		global $module_name;

		$img = 'modules/' . $module_name . '/admin/images/project-support.jpg';
		$url = 'http://sourceforge.net/donate/index.php?group_id=186846';

		echo '<div class="text-center"><span class="title">GCalendar ' . $config['version'] . '</span><br /><br />';
		echo _GCAL_ADMIN_ABOUT_TEXT . '<br /><br />';
		echo _GCAL_ADMIN_ABOUT_TEXT2 . '<br /><br />';
		echo _GCAL_ADMIN_ABOUT_TEXT3 . '<br /><br />';
		echo _GCAL_ADMIN_ABOUT_TEXT4 . '<br /><br />';
		echo '<a href="' . $url . '">';
		echo '<img src="' . $img . '" alt="' . _GCAL_ADMIN_DONATE . '" title="' . _GCAL_ADMIN_DONATE . '" border="0" />';
		echo '</a></div><br /><br />';
	}

	////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////

	include('header.php');
	GraphicAdmin();
	OpenTable();

	$config = getConfig();
	echo '<div class="text-center"><div class="title">' . _ADMIN_TITLE . ' ' . $config['version'] . '</div></div><br /><br />';

	switch ($op) {
		case 'gcalendar':
			gcalAdminMenu('approve');
			$sortBy = isset($sortBy) ? $sortBy : 'start_date';
			$table = new AdminEventTable($sortBy, true, $admin_file . '.php?op=gcalendar', 'gcalendar', $config);
			$table->display();
			break;

		case 'gcal_about':
			gcalAdminMenu('about');
			gcalAbout($config);
			break;

		case 'gcal_add':
			gcalAdminMenu('add');
			$submitUrl = $admin_file . '.php?op=gcal_adding_event';
			$eventForm = new EventForm($submitUrl, _ADMIN_FORM_ADD_TITLE, _ADMIN_ADD_LABEL, $config);
			$eventForm->enableAdmin(true);
			$eventForm->display();
			break;

		case 'gcal_config':
			gcalAdminMenu('config');
			editConfigForm();
			break;

		case 'gcal_groups':
			gcalAdminMenu('groups');
			require_once 'modules/' . $module_name . '/admin/groups.php';
			gcalAdminGroups($config);
			break;

		case 'gcal_cat':
			gcalAdminMenu('cat');
			editCatForm();
			break;

		case 'gcal_edit':
			gcalAdminMenu('edit');
			$sortBy = isset($sortBy) ? $sortBy : 'id';
			$table = new AdminEventTable($sortBy, false, $admin_file . '.php?op=gcal_edit', 'gcal_edit', $config);
			$table->enableRsvp();
			$table->display();
			break;

		case 'gcal_edit_event':
			gcalAdminMenu();
			echo '<div class="text-center"><div class="title">' . _ADMIN_EDIT_EVENT . $id . '</div></div><br /><br />';
			$submitUrl = $admin_file . '.php?op=gcal_update_event';
			if (isset($_GET['bt'])) {
				$submitUrl .= '&amp;bt=' . $_GET['bt'];
			}

			$eventForm = new EventForm($submitUrl, _ADMIN_FORM_EDIT_TITLE, _ADMIN_SUBMIT_LABEL, $config);
			$eventForm->load($id);
			$eventForm->enableAdmin();
			$eventForm->display();
			break;

		case 'gcal_edit_rsvp':
			gcalAdminMenu();
			$id = intval($_GET['id']);
			echo '<div class="text-center"><div class="title">' . _GCAL_ADMIN_EDIT_RSVP . $id . '</div></div><br /><br />';
			gcalDisplayRsvpEdit($id);
			break;

		case 'gcal_del_rsvp':
			csrf_check();
			gcalAdminMenu();
			$id = intval($_POST['id']);
			echo '<div class="text-center"><div class="title">' . _GCAL_ADMIN_EDIT_RSVP . $id . '</div></div><br /><br />';
			if (isset($_POST['rsvps'])) {
				gcalDeleteRsvp($_POST['rsvps']);
			}
			gcalDisplayRsvpEdit($id);
			break;

		case 'gcal_del_event':
			csrf_check();
			confirmDeleteEvent($id);
			break;

		case 'gcal_del_conf':
			csrf_check();
			deleteEvent($id);
			break;

		case 'gcal_update_event':
			csrf_check();
			$id = intval($_POST['eventId']);
			if (array_key_exists('delete', $_POST)) {
				deleteEvent($id);
			} else { // update the event
				$submitUrl = $admin_file . '.php?op=gcal_update_event';
				if (isset($_GET['bt'])) {
				$submitUrl .= '&amp;bt=' . $_GET['bt'];
				}
				$eventForm = new EventForm($submitUrl, _ADMIN_FORM_EDIT_TITLE, _ADMIN_SUBMIT_LABEL, $config);
				$eventForm->enableAdmin();
				$eventForm->post($id);
				if ($eventForm->errorCount() > 0) {
					gcalAdminMenu();
					echo '<div class="text-center"><div class="title">' . _ADMIN_EDIT_EVENT . $id . '</div></div><br /><br />';
					$eventForm->display(true);
				} else {
					$success = $eventForm->save();
					$backTo = isset($_GET['bt']) ? $_GET['bt'] : 'gcalendar';
					$backTo = ($backTo == 'gcalendar' || $backTo == 'gcal_edit') ? $backTo : 'gcalendar';
					$noLink = ($backTo == 'gcalendar') ? 'approve' : 'edit';
					gcalAdminMenu($noLink);
					if (!$success) {
						echo '<div class="text-center">' . _ADMIN_UPDATE_ERR . $id . '</div><br /><br />';
					}
					$table = new AdminEventTable(($noLink == 'approve') ? 'start_date' : 'id',
												$noLink == 'approve',
												$admin_file . '.php?op=' . $backTo,
												$backTo,
												$config);
					$table->display();
				}
			}
			break;

		case 'gcal_adding_event':
			csrf_check();
			$submitUrl = $admin_file . '.php?op=gcal_adding_event';
			$eventForm = new EventForm($submitUrl, _ADMIN_FORM_ADD_TITLE, _ADMIN_ADD_LABEL, $config);
			$eventForm->enableAdmin(true);
			$eventForm->post('new');
			if ($eventForm->errorCount() > 0) {
				gcalAdminMenu('add');
				$eventForm->display(true);
			} else {
				gcalAdminMenu();
				echo '<div class="text-center"><div class="title">' . _ADMIN_ADD_EVENT . '</div></div><br /><br />';
				$success = $eventForm->save();
				echo '<div class="text-center">' . ($success ? _ADMIN_ADD_OK : _ADMIN_ADD_ERR) . '</div><br /><br />';
			}
			break;

		case 'gcal_del_select':
			csrf_check();
			deleteSelectedEvents();
			break;

		case 'gcal_mod_cat':
			csrf_check();
			gcalAdminMenu('cat');
			modifyCategories();
			editCatForm();
			break;

		case 'gcal_purge':
			csrf_check();
			gcalAdminMenu();
			purgeEvents();
			break;

		case 'gcal_save_config':
			csrf_check();
			gcalAdminMenu('config');
			saveConfig();
			editConfigForm();
			break;

		case 'gcal_view_event':
			$id = intval($id);
			gcalAdminMenu();
			echo '<div class="text-center"><div class="title">' . _ADMIN_VIEW_EVENT . $id . '</div><br /><br />';
			displayEvent($id, $config, '', true);
			echo '<br /><br />';
			$editLink = $admin_file . '.php?op=gcal_edit_event&amp;id=' . $id;
			if (isset($_GET['bt'])) {
				$editLink .= '&amp;bt=' . $_GET['bt'];
			}
			echo '<a href="' . $editLink . '">' . _ADMIN_EDIT_EVENT_LINK . '</a><br /><br />';
			echo ':: <a href="javascript:history.back()">' . _GCAL_GO_BACK . '</a> ::</div><br />';
			break;
	}

	CloseTable();
	include('footer.php');
} else { // not authorized for admin access
	include('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center thick">' . _ADMIN_DENIED . '</div>';
	CloseTable();
	include('footer.php');
}

?>