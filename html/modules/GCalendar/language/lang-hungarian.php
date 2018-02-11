<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// language/lang-english.php - This file is part of GCalendar
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
// This is the English language constants file for GCalendar.
//
///////////////////////////////////////////////////////////////////////

// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'January');
define('_MONTH2_NAME', 'February');
define('_MONTH3_NAME', 'March');
define('_MONTH4_NAME', 'April');
define('_MONTH5_NAME', 'May');
define('_MONTH6_NAME', 'June');
define('_MONTH7_NAME', 'July');
define('_MONTH8_NAME', 'August');
define('_MONTH9_NAME', 'September');
define('_MONTH10_NAME', 'October');
define('_MONTH11_NAME', 'November');
define('_MONTH12_NAME', 'December');

define('_DAY0_NAME', 'Sunday');
define('_DAY1_NAME', 'Monday');
define('_DAY2_NAME', 'Tuesday');
define('_DAY3_NAME', 'Wednesday');
define('_DAY4_NAME', 'Thursday');
define('_DAY5_NAME', 'Friday');
define('_DAY6_NAME', 'Saturday');

define('_DAY0_ABBREV', 'Sun');
define('_DAY1_ABBREV', 'Mon');
define('_DAY2_ABBREV', 'Tue');
define('_DAY3_ABBREV', 'Wed');
define('_DAY4_ABBREV', 'Thu');
define('_DAY5_ABBREV', 'Fri');
define('_DAY6_ABBREV', 'Sat');

define('_DAY0_LETTER', 'S');
define('_DAY1_LETTER', 'M');
define('_DAY2_LETTER', 'T');
define('_DAY3_LETTER', 'W');
define('_DAY4_LETTER', 'T');
define('_DAY5_LETTER', 'F');
define('_DAY6_LETTER', 'S');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'Month:');
define('_HEADER_YEAR', 'Year:');
define('_HEADER_TODAYS_DATE', 'Today\'s Date:');
define('_HEADER_SUBMIT_INFO', 'Submit Event Info');
define('_HEADER_PRINTABLE', 'Printable Version');
define('_HEADER_GOTO_MONTH', 'Go');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Go To Current Month');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Show Categories:');
define('_SHOW_ALL', 'Check All');
define('_SHOW_NONE', 'Check None');

define('_VIEW_DAY_EVENTS_FOR',   'All Events For ');
define('_VIEW_DAY_EVENT_DETAIL', 'Viewing Event #');
define('_VIEW_DAY_NO_TIME',      '(No Time)');
define('_VIEW_DAY_TITLE',        'Title:');
define('_VIEW_DAY_CATEGORY',     'Category:');
define('_VIEW_DAY_TIME',         'Time:');
define('_VIEW_DAY_LOCATION',     'Location:');
define('_VIEW_DAY_DESC',         'Description:');
define('_VIEW_DAY_NOTES',        'Notes:');
define('_VIEW_DAY_SUBMITTER',    'Added By:');

define('_VIEW_DAY_EVENT_REPEATS', 'This event repeats every ');
define('_VIEW_DAY_DAYS',         'day(s)');
define('_VIEW_DAY_WEEKS',        'week(s)');
define('_VIEW_DAY_MONTHS',       'month(s)');
define('_VIEW_DAY_YEARS',        'year(s)');
define('_VIEW_DAY_ON',           ' on: ');
define('_VIEW_DAY_EVERY',        'every');
define('_VIEW_DAY_ENDS_ON',      'This event ends on ');
define('_VIEW_DAY_VIEW_ALL',     'View All Events On This Day');
define('_VIEW_DAY_NO_EVENTS',    'There are no events on this day.');

define('_SUBMIT_FORM_TITLE',     'New Event:');

define('_FORM_INSTRUCTIONS', 
   'To submit an event for the calendar, please fill out the form below and click the Submit Event button.');

define('_FORM_SUBMIT',           'Submit Event');
define('_FORM_TITLE',            'Title:');
define('_FORM_LOCATION',         'Location:');
define('_FORM_DATE',             'Date:');
define('_FORM_TIME',             'Time:');
define('_FORM_NO_TIME',          'No Time');
define('_FORM_START_TIME',       'Start:');
define('_FORM_END_TIME',         'End:');
define('_FORM_CATEGORY',         'Category:');
define('_FORM_DETAILS',          'Details:');
define('_FORM_REPEAT',           'Repeat:');
define('_FORM_EVERY',            'Every:');
define('_FORM_END_ON',           'End On: ');
define('_FORM_NO_END',           'No End Date');
define('_FORM_REPEAT_ON',        'Repeat On:');
define('_FORM_REPEAT_BY',        'Repeat By:');
define('_FORM_REPEAT_BY_DAY',    'Day');
define('_FORM_REPEAT_BY_DATE',   'Date');
define('_FORM_NO_CATEGORIES',    '(No categories available)');
define('_FORM_SUBMITTER',        'Submitted By:');
define('_FORM_APPROVE',          'Approved:');
define('_FORM_DELETE_LABEL',     'Delete Event');
define('_FORM_DEL_EVENT_CONFIRM','Are you sure you want to delete this event?');

define('_FORM_DAYS',             'Day(s)');
define('_FORM_WEEKS',            'Week(s)');
define('_FORM_MONTHS',           'Month(s)');
define('_FORM_YEARS',            'Year(s)');

define('_REPEAT_NONE',           'None');
define('_REPEAT_DAY',            'Daily');
define('_REPEAT_WEEK',           'Weekly');
define('_REPEAT_MONTH',          'Monthly');
define('_REPEAT_YEAR',           'Yearly');

define('_FORM_BY_DAY_EX', '(E.g. The 3rd Tuesday of every month)');
define('_FORM_BY_DATE_EX', '(E.g. The 23rd of every month)');

define('_ERR_PLEASE_FIX',     
   'Some errors were detected with your event; please correct the problems listed below and re-submit.');
define('_ERR_NO_TITLE',       'Missing event title');
define('_ERR_START_DATE',     'Invalid start date');
define('_ERR_TIME',           'Invalid start or ending time');
define('_ERR_CATEGORY',       'Invalid category');
define('_ERR_REPEAT',         'Invalid repeat type');
define('_ERR_INTERVAL',       'Invalid repeat interval');
define('_ERR_END_DATE',       'Invalid end date');
define('_ERR_NO_LOCATION',    'Missing location');
define('_ERR_NO_DETAILS',     'Missing details');

define('_THANKS_SUBMISSION',     'Thank-you for submitting an event to our calendar!');
define('_APPROVAL_REQUIRED',     'Your event will be added pending approval by the site admins.');
define('_NO_APPROVAL_REQUIRED',  'Your event has been added to the calendar.');
define('_SUBMIT_ERROR',          'Oops, a database error has occured; please inform the site admin.');
define('_SUBMIT_DISABLED',       'You don\'t have permission to submit an event.');

define('_GCAL_GO_BACK', 'Go Back');
define('_ADMIN_NAME',   'Admin');

define('_CAL_IMAGE_ALT', 'Calendar Image');

define('_VIEW_WEEK_EVENTS_FOR',     'Viewing events for the week of');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Go To Current Week');
define('_VIEW_WEEK_OF',             'View Week Of: ');
define('_GO_WEEK_VIEW',             'Go');

define('_SEND_TO_FRIEND', 'Email Event To Friend');
define('_YOU_WILL_SEND_EVENT', 'You will send a link to a friend for this event: ');
define('_YOUR_NAME', 'Your Name:');
define('_YOUR_EMAIL', 'Your Email:');
define('_FRIEND_NAME', 'Your Friend\'s Name:');
define('_FRIEND_EMAIL', 'Your Friend\'s Email:');
define('_SEND_EVENT', 'Send Event');
define('_INVALID_EMAIL', 'Invalid Email Address');

define('_FRIEND_EMAIL_SUBJECT', 'Interesting event from the calendar of ');
define('_FRIEND_GREETING', 'Hello ');
define('_FRIEND_GREETING_PUNCT', ':');
define('_FRIEND_YOUR_FRIEND', 'Your friend ');
define('_FRIEND_WANTED_TO_SEND', ' wanted you to know about this event:');
define('_FRIEND_WAS_SENT_FROM', 'This event was sent from ');
define('_FRIEND_EVENT_SENT', 'The event was sent to your friend, thanks!');

define('_VIEW_DAY_START_DATE', 'Start Date:');
define('_UPDATE_EVENT', 'Update Event');
define('_FORM_CANCEL_LABEL', 'Cancel');

define('_HEADER_GOTO_ADMIN', 'GCalendar Admin');
define('_FORM_RSVP_LABEL',    'RSVP:');
define('_FORM_RSVP_OFF',      'No RSVP');
define('_FORM_RSVP_ON',       'Allow RSVP');
define('_FORM_RSVP_EMAIL',    'Allow RSVP and email me');

define('_VIEW_DAY_RSVP',            'RSVP List:');
define('_GCAL_RSVP_EVENT',          'RSVP to this event');
define('_GCAL_CANCEL_RSVP_EVENT',   'Cancel RSVP');
define('_VIEW_DAY_EVENT_NUM',       'Event #');
define('_GCAL_RSVP_GREETING',       'Dear ');
define('_GCAL_RSVP_END_GREETING',   ':');
define('_GCAL_RSVP_MESSAGE',        'Someone has updated their RSVP status to an event of yours.');
define('_GCAL_RSVP_USER',           'User: ');
define('_GCAL_RSVP_ACTION',         'Action: ');
define('_GCAL_RSVP_RSVP',           'RSVP Accepted');
define('_GCAL_RSVP_CANCEL',         'RSVP Canceled');
define('_GCAL_RSVP_EVENT_LINK',     'Event Link: ');

define('_GCAL_REPEAT_OPTIONS',         'This is a repeating event; do you want to modify:');
define('_GCAL_REPEAT_THIS_ONLY',       'This occurrence only');
define('_GCAL_REPEAT_THIS_FUTURE',     'This occurrence and all future ones');
define('_GCAL_REPEAT_ALL_SAME_START',  'All occurrences but keep original start date of ');
define('_GCAL_REPEAT_ALL_NEW_START',   'All occurrences and change start date as above');
define('_GCAL_REPEAT_NO_BRANCH_DATE',  'This is a repeating event; any changes will apply to all occurrences');
?>