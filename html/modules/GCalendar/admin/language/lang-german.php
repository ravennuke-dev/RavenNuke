<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// admin language/lang-german.php - This file is part of GCalendar
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

define('_ADMIN_TITLE',        'GCalendar Verwaltung');
define('_ADMIN_DENIED',       'Sie besitzen nicht die Berechtigung dieses Modul zu verwalten.');
define('_ADMIN_APPROVE',      'Ereignisse Freigeben');
define('_ADMIN_ADD_EVENT',    'Ereignisse Hinzuf&uuml;gen');
define('_ADMIN_EDIT_CONFIG',  'Optionen Bearbeiten');
define('_ADMIN_EDIT_CAT',     'Kategorien Bearbeiten');
define('_ADMIN_EDIT_EVENTS',  'Ereignisse Bearbeiten');

define('_CONF_YES',  'Ja');
define('_CONF_NO',   'Nein');
define('_NONE_SELECTED',      'Es wurde keine Ereignisse zum L&ouml;schen ausgew&auml;hlt.');
define('_CONFIRM_DELETE',     'Sollen die markierten Ereignisse gel&ouml;scht werden?');
define('_EVENTS_DEL_ERR',     'Fehler beim L&ouml;schen der Ereignisse!');

define('_NO_PENDING_EVENTS',  'Keine Ereignisse zur Freigabe vorhanden.');
define('_NO_EVENTS',          'No approved events at this time.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Anfangsdatum');
define('_EVENT_TITLE',        'Titel');
define('_EVENT_SUBMITTER',    '&Uuml;bermittelt von');
define('_EVENT_ACTIONS',      'Aktionen');
define('_EVENT_SELECT',       'Ausw&auml;hlen');

define('_VIEW_TITLE',         'Ereignis Anzeigen');
define('_EDIT_TITLE',         'Ereignis Bearbeiten');
define('_DEL_SELECTED',       'Ereignis L&ouml;schen');
define('_SELECT_ALL',         'Alle Ausw&auml;hlen');
define('_SELECT_NONE',        'Auswahl zur&uuml;cksetzen');
define('_SORT_BY_TITLE',      'Klicken zur Art durch diese Spalte');

define('_ADMIN_FORM_EDIT_TITLE', 'Bearbeiten: ');
define('_ADMIN_FORM_ADD_TITLE',  'Hinzuf&uuml;gen: ');

define('_ADMIN_SUBMIT_LABEL', 'Ereignis &Auml;ndern');
define('_ADMIN_ADD_LABEL',    'Ereignis Hinzuf&uuml;gen');

define('_ADMIN_VIEW_EVENT',   'Anzeige Ereignis #');
define('_ADMIN_EDIT_EVENT',   'Bearbeiten Ereigniss #');
define('_ADMIN_UPDATE_EVENT', '&Auml;ndern Ereignis #');
define('_ADMIN_CONFIRM_DEL',  'Soll das Ereignis #%d? gel&ouml;scht werden?');
define('_ADMIN_DELETE_OK',    'Ereignis gel&ouml;scht #');
define('_ADMIN_DELETE_ERR',   'Fehler beim l&ouml;schend des Ereignis #');
define('_ADMIN_UPDATE_ERR',   'Fehler beim &Auml;ndern des Ereignis #');
define('_ADMIN_ADD_OK',       'Ereignis hinzugef&uuml;gt');
define('_ADMIN_ADD_ERR',      'Fehler beim hinzuf&uuml;gen');

define('_CURRENT_CATS',       'Vorhandene Kategorien:');
define('_MODIFY_BUTTON',      'Gew&auml;hlte Kategorie &Auml;ndern');
define('_DELETE_BUTTON',      'Gew&auml;hlte Kategorie L&ouml;schen');
define('_ADD_BUTTON',         'Neue Kategorie Hinzuf&uuml;gen');
define('_CONFIRM_DELETE_CAT', 'M&ouml;chten die Kategorie l&ouml;schen.');
define('_NO_ADD_TEXT',        'Bitte geben Sie eine Namen f&uuml;r die Kategorie an.');

define('_ADMIN_PURGE_RESULTS',   'Purge Expired Events Results');
define('_PURGE_BUTTON_TEXT',  'Abgelaufene Ereignisse entfernen');
define('_PURGE_CONFIRM_HELP',
   'M&ouml;chten Sie die abgelaufenen Ereignisse entfernen? Diese Funktion wird alle wird alle'.
   ' abgelaufenen Ereignisse entfernen.');
define('_ADMIN_DB_OK',     'Erfolgreich');
define('_ADMIN_DB_ERR',    'Datenbank Fehler!');

define('_ADMIN_CONFIG_FORM_TITLE',  'Optionen Einstellen: ');
define('_ADMIN_CONFIG_TITLE',       'Titel:');
define('_ADMIN_CONFIG_IMAGE',       'Bilddatei:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Optional; Bild das in der allgm. Kalenderansicht angezeigt wird.');
define('_ADMIN_CONFIG_MIN_YEAR',    'Anfangsjahr:');
define('_ADMIN_CONFIG_MAX_YEAR',    'sp&auml;testes Jahr:');
define('_ADMIN_CONFIG_UPDATE',      'Optionen Speichern');
define('_ADMIN_CONFIG_YEAR_TIP',    'Sichere Bereiche: 1902-2037 f&uuml;r Unix Server; 1970-2037 f&uuml;r Windows Server');
define('_ADMIN_CONFIG_USER_SUBMIT', '&Uuml;bermittlungen erlauben:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Wer darf Ereignisse &uuml;bermitteln.');
define('_ADMIN_CONFIG_REQ_APP',     'Freigabe erforderlich:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Kurzes Datumformat:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Regelmäßiges Datumformat:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Langes Datumformat:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Das Handbuch lesen)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Erster Tag der Woche:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Zeit Format:');
define('_ADMIN_CONFIG_TAGS',        'Zul&auml;ssige HTML Tags:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Bitte geben Sie die zul&auml;ssigen Tags durch Komma getrennt an');
define('_ADMIN_CONFIG_ATTRS',       'Zul&auml;ssige HTML Tags Attribute:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Bitte geben Sie die zul&auml;ssigen Attribute durch Komma getrennt an');
define('_ADMIN_CONFIG_AUTO_LINK',   'Auto-Link aktivieren:');
define('_ADMIN_CONFIG_LOC_REQ',     'Ortsangabe muss ausgef&amp;uuml;llt werden:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Details muss ausgef&amp;uuml;llt werden:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Email Benachrichtigung bei neuen Ereignissen:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Benachrichtigung an folgende Adresse(n):');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Bitte die Adressen durch Komma getrennt angeben.');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Absenderadresse:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Betreff:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Nachricht:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Legende f&amp;uuml;r Kategorie anzeigen:');

define('_SUBMIT_OFF',      'niemand (AUS)');
define('_SUBMIT_MEMBERS',  'nur f&uuml;r registriete Benutzer ');
define('_SUBMIT_ANYONE',   'Jeder');

define('_ADMIN_EDIT_EVENT_LINK', 'Dieses Ereignis bearbeiten.');

define('_CATEGORY_ID', 'Kategorie ID:');

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