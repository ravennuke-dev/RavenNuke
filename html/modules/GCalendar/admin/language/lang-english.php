<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// admin language/lang-english.php - This file is part of GCalendar
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
// Admin language file; English.
//
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'GCalendar Admin Panel');
define('_ADMIN_DENIED',       'You do not have permission to admin this module.');
define('_ADMIN_APPROVE',      'Approve Pending Events');
define('_ADMIN_ADD_EVENT',    'Add Event');
define('_ADMIN_EDIT_CONFIG',  'Options');
define('_ADMIN_EDIT_CAT',     'Categories');
define('_ADMIN_EDIT_EVENTS',  'Edit Events');

define('_CONF_YES',  'Yes');
define('_CONF_NO',   'No');
define('_NONE_SELECTED',      'No events selected to delete');
define('_CONFIRM_DELETE',     'Really delete selected events?');
define('_EVENTS_DEL_ERR',     'Error deleting Event(s)!');

define('_NO_PENDING_EVENTS',  'No events need approval at this time.');
define('_NO_EVENTS',          'No approved events at this time.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Start Date');
define('_EVENT_TITLE',        'Title');
define('_EVENT_SUBMITTER',    'Submitted By');
define('_EVENT_ACTIONS',      'Actions');
define('_EVENT_SELECT',       'Select');

define('_VIEW_TITLE',         'View Event');
define('_EDIT_TITLE',         'Edit/Approve Event');
define('_DEL_SELECTED',       'Delete Selected Events');
define('_SELECT_ALL',         'Select All');
define('_SELECT_NONE',        'Select None');
define('_SORT_BY_TITLE',      'Click to sort by this column');

define('_ADMIN_FORM_EDIT_TITLE', 'Edit Event: ');
define('_ADMIN_FORM_ADD_TITLE',  'Add Event: ');

define('_ADMIN_SUBMIT_LABEL', 'Update Event');
define('_ADMIN_ADD_LABEL',    'Add Event');

define('_ADMIN_VIEW_EVENT',   'Viewing Event #');
define('_ADMIN_EDIT_EVENT',   'Editing Event #');
define('_ADMIN_UPDATE_EVENT', 'Updating Event #');
define('_ADMIN_CONFIRM_DEL',  'Do you really want to delete event #%d?');
define('_ADMIN_DELETE_OK',    'Successfully deleted event #');
define('_ADMIN_DELETE_ERR',   'Error deleting event #');
define('_ADMIN_UPDATE_ERR',   'Error updating event #');
define('_ADMIN_ADD_OK',       'Successfully added event');
define('_ADMIN_ADD_ERR',      'Error adding event');

define('_CURRENT_CATS',       'Current Category List:');
define('_MODIFY_BUTTON',      'Modify Selected Category:');
define('_DELETE_BUTTON',      'Delete Selected Category');
define('_ADD_BUTTON',         'Add Category:');
define('_CONFIRM_DELETE_CAT', 'Really delete category?');
define('_NO_ADD_TEXT',        'Please specify the category name');

define('_ADMIN_PURGE_RESULTS',   'Purge Expired Events Results');
define('_PURGE_BUTTON_TEXT',  'Purge Expired Events');
define('_PURGE_CONFIRM_HELP',
   'Do you really want to purge expired events? This will delete all approved non-repeating events with start dates' .
   ' in the past and all approved repeating events with end dates in the past.');
define('_ADMIN_DB_OK',     'Success');
define('_ADMIN_DB_ERR',    'Database Error!');

define('_ADMIN_CONFIG_FORM_TITLE',  'Edit Configuration Options: ');
define('_ADMIN_CONFIG_TITLE',       'Title:');
define('_ADMIN_CONFIG_IMAGE',       'Image:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Optional; path to image to be used on calendar views');
define('_ADMIN_CONFIG_MIN_YEAR',    'Min. Year:');
define('_ADMIN_CONFIG_MAX_YEAR',    'Max. Year:');
define('_ADMIN_CONFIG_UPDATE',      'Save Options');
define('_ADMIN_CONFIG_YEAR_TIP',    'Safe Range: typically 1902-2037 for Unix servers; 1970-2037 for Windows servers');
define('_ADMIN_CONFIG_USER_SUBMIT', 'User Submissions:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Controls who can submit events');
define('_ADMIN_CONFIG_REQ_APP',     'Events Require Approval:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Short Date Format:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Regular Date Format:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Long Date Format:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(See the manual)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'First Day of the Week:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Time Format:');
define('_ADMIN_CONFIG_TAGS',        'Allowed HTML Tags:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Enter a comma separated list of HTML tags');
define('_ADMIN_CONFIG_ATTRS',       'Allowed HTML Tag Attributes:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Enter a comma separated list of HTML tag attributes');
define('_ADMIN_CONFIG_AUTO_LINK',   'Enable Auto-Links:');
define('_ADMIN_CONFIG_LOC_REQ',     'Event Location Field Required:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Event Details Field Required:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Email Notification of New Events:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Email To Addresses:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Enter a comma separated list of email addresses');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Email From Address:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Email Subject:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Email Message:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Show Category Legend:');

define('_SUBMIT_OFF',      'Nobody');
define('_SUBMIT_MEMBERS',  'Members Only');
define('_SUBMIT_ANYONE',   'Anyone');

define('_ADMIN_EDIT_EVENT_LINK', 'Edit This Event');

define('_CATEGORY_ID', 'Category ID:');

define('_ADMIN_CONFIG_WYSIWYG', 'Use RavenNuke Editor:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Users Can Update Their Events:');

define('_ADMIN_GOTO_MODULE', 'Go To GCalendar Module');
define('_RSVP_OFF',        'Off');
define('_RSVP_ON',         'On');
define('_RSVP_ON_EMAIL',   'On with email notifications');
define('_ADMIN_CONFIG_RSVP',  'RSVP:');
define('_ADMIN_CONFIG_RSVP_SUBJECT', 'RSVP Email Subject:');
define('_GCAL_RSVP_ADMIN_TITLE', 'Edit RSVP');
define('_GCAL_ADMIN_EDIT_RSVP', 'Edit RSVP Information for Event #');
define('_GCAL_DEL_RSVP', 'Delete Selected Users From RSVP List');
define('_GCAL_EMPTY_RSVP_LIST', 'No one on the RSVP list');
define('_GCAL_DEL_RSVP_CONFIRM', 'Are you sure you want to remove the selected users from the RSVP list?');
define('_GCAL_ADMIN_ABOUT', 'About');
define('_GCAL_ADMIN_ABOUT_TEXT', 'GCalendar is Copyright &copy; 2007 by Brian Neal');
define('_GCAL_ADMIN_ABOUT_TEXT2', 'GCalendar is free software released under the GNU GPL. See the file COPYING ' .
   'in the GCalender distribution archive.');
define('_GCAL_ADMIN_ABOUT_TEXT3',
   'Please read the included manual for instructions, a full list of credits, and licensing information.<br />' .
   'For support, please visit the <a href="http://sourceforge.net/projects/gcalendar-nuke/">GCalendar for PHP-Nuke' .
   ' Support Website</a>.');
define('_GCAL_ADMIN_ABOUT_TEXT4', 'If you find GCalender useful, please consider making a donation!');
define('_GCAL_ADMIN_DONATE', 'Donate to GCalendar');

define('_SUBMIT_GROUPS',   'Groups');
define('_ADMIN_GROUPS',    'Groups');
define('_ADMIN_NO_GROUPS', 'You don\'t have NSN Groups installed or you don\'t have any groups yet.');
define('_ADMIN_GROUP_PERM_LABEL', 'Group Permissions: ');
define('_ADMIN_GROUP_PERM_GROUP', 'Group');
define('_ADMIN_GROUP_PERM_SUBMIT', 'Can Submit Events');
define('_ADMIN_GROUP_PERM_APPROV', 'Events do not require approval');
define('_ADMIN_GROUP_PERM_SAVE', 'Save');
define('_ADMIN_GROUP_SUBMIT_NOTE', 'Only applies if the \'User Submissions\' option is set to \'Groups\'');
define('_ADMIN_GROUP_CAT_LABEL', 'Category Assignments: ');
define('_ADMIN_GROUP_CAT_EXPLANATION',
   'Categories can be assigned to groups; in which case only group members can see events in those categories. ' .
   'If a category is not assigned to any group, it is visible to all. ' .
   'Multiple groups can be assigned to a category (shift- or ctrl-click the groups).');
define('_ADMIN_GROUP_CAT_COMBO', 'Category:');
define('_ADMIN_GROUP_CAT_GROUPS', 'Assigned Groups:');
define('_ADMIN_GROUP_CAT_SAVE', 'Update Category');
?>