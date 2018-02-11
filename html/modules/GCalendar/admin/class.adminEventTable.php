<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// class.adminEventTable.php - This file is part of GCalendar
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
// This class displays the admin event table.
// 
///////////////////////////////////////////////////////////////////////

class AdminEventTable {
	var $sortBy = 'id';
	var $approveMode = true;
	var $url;
	var $colTitles = array('id' => _EVENT_ID, 'start_date' => _EVENT_START_DATE, 'title' => _EVENT_TITLE, 
		'submitted_by' => _EVENT_SUBMITTER, _EVENT_ACTIONS, _EVENT_SELECT);
	var $linkable = array(true, true, true, true, false, false);
	var $backTo = '';
	var $showRsvp = false;
	var $config = array();

	function __construct($sortBy, $approveMode, $url, $backTo, $config) {
		switch ($sortBy) {
			case 'id':
			case 'start_date':
			case 'title':
			case 'submitted_by':
				$this->sortBy = $sortBy;
				break;

			default:
				$this->sortBy = 'id';
				break;
		}

		$this->approveMode = (bool) $approveMode;
		$this->url = $url;
		$this->backTo = $backTo;
		$this->config = $config;
	}

	function enableRsvp() {
		$this->showRsvp = true;
	}

	function display() {
		global $prefix, $db, $admin_file;

		$eventTable = $prefix . GCAL_EVENT_TABLE;
		$approveVal = $this->approveMode ? 0 : 1;

		$sql  = 'SELECT id, title, start_date, submitted_by FROM ' . $eventTable . 
		  ' WHERE approved = ' . $approveVal . ' ORDER BY ' . $this->sortBy;

		$result = $db->sql_query($sql);
		if ($db->sql_numrows($result) > 0) {
			$viewImg = '<img src="images/view.gif" border="0" alt="' . _VIEW_TITLE . '" title="' . _VIEW_TITLE . '" />';
			$editImg = '<img src="images/edit.gif" border="0" alt="' . _EDIT_TITLE . '" title="' . _EDIT_TITLE . '" />';
			$rsvpImg = '<img src="images/friend.gif" border="0" alt="' . _GCAL_RSVP_ADMIN_TITLE . '" title="' . 
				_GCAL_RSVP_ADMIN_TITLE . '" />';

			$viewAction = $admin_file . '.php?op=gcal_view_event&amp;bt=' . $this->backTo . '&amp;id=';
			$editAction = $admin_file . '.php?op=gcal_edit_event&amp;bt=' . $this->backTo . '&amp;id=';
			$rsvpAction = $admin_file . '.php?op=gcal_edit_rsvp&amp;id=';
			$formAction = $admin_file . '.php?op=gcal_del_select';

			$selectLinks = ' <a href="javascript:gcalSelectEvents(true)">' . _SELECT_ALL . 
				'</a> | <a href="javascript:gcalSelectEvents(false)">' . _SELECT_NONE . '</a><br /><br />';

			$hasRsvp = array();
			if ($this->showRsvp) {
				$sql = 'SELECT event_id FROM ' . $prefix . GCAL_RSVP_TABLE;
				$r = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($r)) {
					$hasRsvp[] = intval($row['event_id']);
				}
			}

			echo '<div class="text-center">';
			echo '<form action="' . $formAction . '" method="post" name="gcalAdminEventTable" ' .
				'onsubmit="return gcalDeleteSubmit()">';
			$this->javascript();
			echo $selectLinks;
			echo '<table border="2" cellpadding="6" cellspacing="1">';
			echo '<tr>';
			$i = 0;
			foreach ($this->colTitles as $key => $title) {
				$col = $title;
				if ($this->sortBy != $key && $this->linkable[$i]) {
					$col = '<a href="' . $this->url . '&amp;sortBy=' . $key . '" title="' . _SORT_BY_TITLE . '">' .
						$col . '</a>';
				}
				echo '<th>' . $col . '</th>';
				++$i;
			}
			echo '</tr>' . "\n";

			while ($row = $db->sql_fetchrow($result)) {
				$rsvp = '';
				if (in_array($row['id'], $hasRsvp)) {
					$rsvp = '&nbsp;<a href="' . $rsvpAction . $row['id'] . '">' . $rsvpImg . '</a>';
				}

				echo '<tr><td>' . $row['id'] . '</td>' .
					'<td>' . formatDate($row['start_date'], $this->config['reg_date_format']) . '</td>' .
					'<td>' . $row['title'] . '</td>' .
					'<td>' . getUserInfoLink($row['submitted_by']) . '</td>' .
					'<td class="text-center">' . "<a href=\"$viewAction{$row['id']}\">$viewImg</a>&nbsp;" .
						"<a href=\"$editAction{$row['id']}\">$editImg</a>$rsvp</td>" .
					'<td class="text-center"><input type="checkbox" name="select[' . $row['id'] . ']" value="1" /></td>' .
					'</tr>';
			}
			echo '</table><br />';
			echo $selectLinks;
			echo '<input type="hidden" name="backto" value="' . $this->backTo . '" />';
			echo '<input type="submit" name="delselect" value="' . _DEL_SELECTED . '" />';
			echo '</form></div>';
		} else {
			echo '<div class="text-center">' . ($this->approveMode ? _NO_PENDING_EVENTS : _NO_EVENTS) . '</div>';
		}
		
		echo '<br /><br />';
	}

	function javascript() {
		$noneSelected = _NONE_SELECTED;
		$confirmText  = _CONFIRM_DELETE;
		echo <<<END_SCRIPT
<script language="Javascript" type="text/javascript">
//<![CDATA[
	function gcalSelectEvents(status)
	{
		for (i = 0; i < document.gcalAdminEventTable.length; ++i)
		{
			if (document.gcalAdminEventTable.elements[i].type == 'checkbox')
			{
				document.gcalAdminEventTable.elements[i].checked = status;
			}
		}
	}
	function gcalDeleteSubmit()
	{
		count = 0;
		for (i = 0; i < document.gcalAdminEventTable.length; ++i)
		{
			if (document.gcalAdminEventTable.elements[i].type == 'checkbox' &&
				 document.gcalAdminEventTable.elements[i].checked)
			{
				++count;
			}
		}
		if (count == 0)
		{
			alert('$noneSelected');
			return false;
		}
		return confirm('$confirmText');
	}
//]]>
</script>
END_SCRIPT;
	}
}

?>