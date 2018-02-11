<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// language/lang-german.php - This file is part of GCalendar
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
// This is the formal German language constants file for GCalendar.  Translation by azakow
//
///////////////////////////////////////////////////////////////////////

// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'Januar');
define('_MONTH2_NAME', 'Februar');
define('_MONTH3_NAME', 'M&auml;rz');
define('_MONTH4_NAME', 'April');
define('_MONTH5_NAME', 'Mai');
define('_MONTH6_NAME', 'Juni');
define('_MONTH7_NAME', 'Juli');
define('_MONTH8_NAME', 'August');
define('_MONTH9_NAME', 'September');
define('_MONTH10_NAME', 'Oktober');
define('_MONTH11_NAME', 'November');
define('_MONTH12_NAME', 'Dezember');

define('_DAY0_NAME', 'Sonntag');
define('_DAY1_NAME', 'Montag');
define('_DAY2_NAME', 'Dienstag');
define('_DAY3_NAME', 'Mittwoch');
define('_DAY4_NAME', 'Donnerstag');
define('_DAY5_NAME', 'Freitag');
define('_DAY6_NAME', 'Samstag');

define('_DAY0_ABBREV', 'So');
define('_DAY1_ABBREV', 'Mo');
define('_DAY2_ABBREV', 'Di');
define('_DAY3_ABBREV', 'Mi');
define('_DAY4_ABBREV', 'Do');
define('_DAY5_ABBREV', 'Fr');
define('_DAY6_ABBREV', 'Sa');

define('_DAY0_LETTER', 'S');
define('_DAY1_LETTER', 'M');
define('_DAY2_LETTER', 'D');
define('_DAY3_LETTER', 'M');
define('_DAY4_LETTER', 'D');
define('_DAY5_LETTER', 'F');
define('_DAY6_LETTER', 'S');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  '24h');
define('_TIME_PM',  '24h');

define('_HEADER_MONTH', 'Monat:');
define('_HEADER_YEAR', 'Jahr:');
define('_HEADER_TODAYS_DATE', 'Heutiges Datum');
define('_HEADER_SUBMIT_INFO', 'Neues Ereignis &uuml;bermitteln');
define('_HEADER_PRINTABLE', 'durckbare Version');
define('_HEADER_GOTO_MONTH', 'gehe zu');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'gehe zum aktuellen Monat');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Kategorien anzeigen:');
define('_SHOW_ALL', 'Alle pr&amp;uuml;fen');
define('_SHOW_NONE', 'Nichts pr&amp;uuml;fen');

define('_VIEW_DAY_EVENTS_FOR',   'Alle Ereignisse f&uuml;r ');
define('_VIEW_DAY_EVENT_DETAIL', 'Ereignis #');
define('_VIEW_DAY_NO_TIME',      '(keine Uhrzeit)');
define('_VIEW_DAY_TITLE',        'Titel:');
define('_VIEW_DAY_CATEGORY',     'Kategorie:');
define('_VIEW_DAY_TIME',         'Uhrzeit:');
define('_VIEW_DAY_LOCATION',     'Ort:');
define('_VIEW_DAY_DESC',         'Beschreibung:');
define('_VIEW_DAY_NOTES',        'Notizen:');
define('_VIEW_DAY_SUBMITTER',    'hinzugef&uuml;gt von:');

define('_VIEW_DAY_EVENT_REPEATS', 'Dieses Ereignis wird wiederholt ');
define('_VIEW_DAY_DAYS',         'Tag(e)');
define('_VIEW_DAY_WEEKS',        'Woche(n)');
define('_VIEW_DAY_MONTHS',       'Monat(e)');
define('_VIEW_DAY_YEARS',        'Jahr(e)');
define('_VIEW_DAY_ON',           ' am: ');
define('_VIEW_DAY_EVERY',        'jede');
define('_VIEW_DAY_ENDS_ON',      'Dieses Ereignis endet am: ');
define('_VIEW_DAY_VIEW_ALL',     'Zeige alle Ereignisse an diesem Tag');
define('_VIEW_DAY_NO_EVENTS',    'Keine Ereignisse an diesem Tag.');

define('_SUBMIT_FORM_TITLE',     'Neues Ereignis:');

define('_FORM_INSTRUCTIONS',
   'Bitte f&uuml;llen Sie das Formular aus und bet&auml;tigen Sie den Button "Ereignis &uuml;bermitten", um einen Termin zu melden.');

define('_FORM_SUBMIT',           'Ereignis &uuml;bermitteln');
define('_FORM_TITLE',            'Titel:');
define('_FORM_LOCATION',         'Ort:');
define('_FORM_DATE',             'Datum:');
define('_FORM_TIME',             'Uhrzeit:');
define('_FORM_NO_TIME',          'Keine Uhrzeit');
define('_FORM_START_TIME',       'Anfang:');
define('_FORM_END_TIME',         'Ende:');
define('_FORM_CATEGORY',         'Kategorie:');
define('_FORM_DETAILS',          'Details:');
define('_FORM_REPEAT',           'wiederholt:');
define('_FORM_EVERY',            'jede:');
define('_FORM_END_ON',           'endet am: ');
define('_FORM_NO_END',           'kein Ende');
define('_FORM_REPEAT_ON',        'wiederholt am:');
define('_FORM_REPEAT_BY',        'wiederholt um:');
define('_FORM_REPEAT_BY_DAY',    'Tag');
define('_FORM_REPEAT_BY_DATE',   'Datum');
define('_FORM_NO_CATEGORIES',    '(Keine Kategorien verf&uuml;gbar)');
define('_FORM_SUBMITTER',        '&Uuml;bermittelt von:');
define('_FORM_APPROVE',          'ver&ouml;ffentlicht von:');
define('_FORM_DELETE_LABEL',     'Ereignis l&ouml;schen');
define('_FORM_DEL_EVENT_CONFIRM','Soll das Ereignis gel&ouml;scht werden?');

define('_FORM_DAYS',             'Tag(e)');
define('_FORM_WEEKS',            'Woche(n)');
define('_FORM_MONTHS',           'Monat(e)');
define('_FORM_YEARS',            'Jahr(e)');

define('_REPEAT_NONE',           'keine Wiederholung');
define('_REPEAT_DAY',            't&auml;glich');
define('_REPEAT_WEEK',           'w&ouml;chentlich');
define('_REPEAT_MONTH',          'monatlich');
define('_REPEAT_YEAR',           'j&auml;hrlich');

define('_FORM_BY_DAY_EX', '(z. B. am dritten Dienstag jeden Monats)');
define('_FORM_BY_DATE_EX', '(z. B. am 23. jeden Monats)');

define('_ERR_PLEASE_FIX',     
   'Es wurden Fehler in Ihrer &Uuml;bermittlung ermittelt; Bitte korregieren Sie die aufgelisteten Fehler und &uuml;bermiteln Sie das Ereignis erneut.');
define('_ERR_NO_TITLE',       'kein Titel vorhanden');
define('_ERR_START_DATE',     'ung&uuml;ltiges Startdatum');
define('_ERR_TIME',           'ung&uuml;ltige Anfangs- oder Endezeit');
define('_ERR_CATEGORY',       'ung&uuml;ltige Kategorie');
define('_ERR_REPEAT',         'ung&uuml;ltiger Serientyp');
define('_ERR_INTERVAL',       'ung&uuml;ltiger Serienintervall');
define('_ERR_END_DATE',       'ung&uuml;ltige Endezeit');
define('_ERR_NO_LOCATION',    'Der Ort wurde nicht angegeben.');
define('_ERR_NO_DETAILS',     'Es wurden keine Details angegeben.');

define('_THANKS_SUBMISSION',     'Danke f&uuml;r Ihre &Uuml;bermittlung!');
define('_APPROVAL_REQUIRED',     'Das &uuml;bermittelte Ereignis wird nach der Best&auml;tigung durch einen Administrator dem Kalender hinzugef&uuml;gt.');
define('_NO_APPROVAL_REQUIRED',  'Ihr Ereignis wurde dem Kalender hinzugef&uuml;gt.');
define('_SUBMIT_ERROR',          'Bei der &Uuml;bermittlung ist ein Fehler aufgetreten, bitte informieren Sie den Administrator.');
define('_SUBMIT_DISABLED',       'Sie sind nicht berechtigt ein Ereignis zu &uuml;bermitteln.');

define('_GCAL_GO_BACK', 'Zur&uuml;ck');
define('_ADMIN_NAME',   'Administrator');

define('_CAL_IMAGE_ALT', 'Kalenderbild');

define('_VIEW_WEEK_EVENTS_FOR',     'Viewing events for the week of');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Go To Current Week');
define('_VIEW_WEEK_OF',             'View Week Of: ');
define('_GO_WEEK_VIEW',             'gehe zu');

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