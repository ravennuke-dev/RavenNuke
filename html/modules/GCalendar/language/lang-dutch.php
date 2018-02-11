<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Mathijs Lubbertsen dutchnuker@regio-putten.nl
//
// language/lang-dutch.php - This file is part of GCalendar
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
// This is the Dutch language constants file for GCalendar.
//
///////////////////////////////////////////////////////////////////////

// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'januari');
define('_MONTH2_NAME', 'februari');
define('_MONTH3_NAME', 'maart');
define('_MONTH4_NAME', 'april');
define('_MONTH5_NAME', 'mei');
define('_MONTH6_NAME', 'juni');
define('_MONTH7_NAME', 'juli');
define('_MONTH8_NAME', 'augustus');
define('_MONTH9_NAME', 'september');
define('_MONTH10_NAME', 'oktober');
define('_MONTH11_NAME', 'november');
define('_MONTH12_NAME', 'december');

define('_DAY0_NAME', 'zondag');
define('_DAY1_NAME', 'maandag');
define('_DAY2_NAME', 'dinsdag');
define('_DAY3_NAME', 'woensdag');
define('_DAY4_NAME', 'donderdag');
define('_DAY5_NAME', 'vrijdag');
define('_DAY6_NAME', 'zaterdag');

define('_DAY0_ABBREV', 'zo');
define('_DAY1_ABBREV', 'ma');
define('_DAY2_ABBREV', 'di');
define('_DAY3_ABBREV', 'wo');
define('_DAY4_ABBREV', 'do');
define('_DAY5_ABBREV', 'vr');
define('_DAY6_ABBREV', 'za');

define('_DAY0_LETTER', 'z');
define('_DAY1_LETTER', 'm');
define('_DAY2_LETTER', 'd');
define('_DAY3_LETTER', 'w');
define('_DAY4_LETTER', 't');
define('_DAY5_LETTER', 'v');
define('_DAY6_LETTER', 'z');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'Maand:');
define('_HEADER_YEAR', 'Jaar:');
define('_HEADER_TODAYS_DATE', 'Vandaag');
define('_HEADER_SUBMIT_INFO', 'Evenement toevoegen');
define('_HEADER_PRINTABLE', 'Printvriendelijke versie');
define('_HEADER_GOTO_MONTH', 'Ga naar');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Ga naar de huidige maand');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Toon Categorieen:');
define('_SHOW_ALL', 'Toon alle categorieen');
define('_SHOW_NONE', 'Toon geen categorieen');

define('_VIEW_DAY_EVENTS_FOR',   'Alle evenementen voor ');
define('_VIEW_DAY_EVENT_DETAIL', 'Bekijk details van evenement #');
define('_VIEW_DAY_NO_TIME',      '(Geen Tijd)');
define('_VIEW_DAY_TITLE',        'Titel:');
define('_VIEW_DAY_CATEGORY',     'Categorie:');
define('_VIEW_DAY_TIME',         'Tijd:');
define('_VIEW_DAY_LOCATION',     'Lokatie:');
define('_VIEW_DAY_DESC',         'Omschrijving:');
define('_VIEW_DAY_NOTES',        'Notities:');
define('_VIEW_DAY_SUBMITTER',    'Toegevoegd door:');

define('_VIEW_DAY_EVENT_REPEATS', 'Dit evenement wordt herhaald elke');
define('_VIEW_DAY_DAYS',         'dag(en)');
define('_VIEW_DAY_WEEKS',        'we(e)k(en)');
define('_VIEW_DAY_MONTHS',       'maand(en)');
define('_VIEW_DAY_YEARS',        'ja(a)r(en)');
define('_VIEW_DAY_ON',           ' op: ');
define('_VIEW_DAY_EVERY',        'elke');
define('_VIEW_DAY_ENDS_ON',      'Dit evenement eindigt op ');
define('_VIEW_DAY_VIEW_ALL',     'Bekijk alle evenementen op deze dag');
define('_VIEW_DAY_NO_EVENTS',    'Er zijn geen evenementen voor deze dag.');

define('_SUBMIT_FORM_TITLE',     'Nieuw evenement:');

define('_FORM_INSTRUCTIONS',
   'Om een evenement toe te voegen aan de kalender, wilt u aub het formulier <br /> hieronder invullen en wilt u daarna klikken op Voeg evenement toe.');

define('_FORM_SUBMIT',           'Evenement toevoegen');
define('_FORM_TITLE',            'Titel:');
define('_FORM_LOCATION',         'Lokatie:');
define('_FORM_DATE',             'Datum:');
define('_FORM_TIME',             'Tijd:');
define('_FORM_NO_TIME',          'Gehele dag');
define('_FORM_START_TIME',       'Start:');
define('_FORM_END_TIME',         'Eindigt om:');
define('_FORM_CATEGORY',         'Categorie:');
define('_FORM_DETAILS',          'Details:');
define('_FORM_REPEAT',           'Terugkerend:');
define('_FORM_EVERY',            'Elke:');
define('_FORM_END_ON',           'Eindigt op: ');
define('_FORM_NO_END',           'Geen eind datum');
define('_FORM_REPEAT_ON',        'Herhaal op:');
define('_FORM_REPEAT_BY',        'Herhaal door:');
define('_FORM_REPEAT_BY_DAY',    'Dag');
define('_FORM_REPEAT_BY_DATE',   'Datum');
define('_FORM_NO_CATEGORIES',    '(Geen categorieen beschikbaar)');
define('_FORM_SUBMITTER',        'Toegevoegd door:');
define('_FORM_APPROVE',          'Goedgekeurd:');
define('_FORM_DELETE_LABEL',     'Verwijder Evenement');
define('_FORM_DEL_EVENT_CONFIRM','Weet u zeker dat u dit evenement wilt verwijderen?');

define('_FORM_DAYS',             'Dag(en)');
define('_FORM_WEEKS',            'We(e)k(en)');
define('_FORM_MONTHS',           'Maand(en)');
define('_FORM_YEARS',            'Ja(a)r(en)');

define('_REPEAT_NONE',           'Geen');
define('_REPEAT_DAY',            'Dagelijks');
define('_REPEAT_WEEK',           'Wekelijks');
define('_REPEAT_MONTH',          'Maandelijks');
define('_REPEAT_YEAR',           'Jaarlijks');

define('_FORM_BY_DAY_EX', '(b.v. Elke 3e dinsdag van elke maand)');
define('_FORM_BY_DATE_EX', '(b.v. Elke 23e van elke maand)');

define('_ERR_PLEASE_FIX',
   'Een aantal dingen zijn niet juist ingevoerd wilt u dit corrigeren <br />en daarna het evenement opnieuw opslaan.');
define('_ERR_NO_TITLE',       'Titel van het evenement ontbreekt');
define('_ERR_START_DATE',     'Onjuiste startdatum');
define('_ERR_TIME',           'Onjuiste start of eindtijd');
define('_ERR_CATEGORY',       'Onjuiste categorie');
define('_ERR_REPEAT',         'Onjuiste herhalings categorie');
define('_ERR_INTERVAL',       'Onjuiste herhalings interval');
define('_ERR_END_DATE',       'Onjuiste tijd einde evenement');
define('_ERR_NO_LOCATION',    'Locatie van het evenement is niet ingevuld');
define('_ERR_NO_DETAILS',     'Details van het evenement zijn niet ingevuld');

define('_THANKS_SUBMISSION',     'Bedankt voor uw bijdrage aan evenementenkalender!');
define('_APPROVAL_REQUIRED',     'Uw bijdrage wordt beoordeelt en evt goedgekeurd door de sitebeheerder.');
define('_NO_APPROVAL_REQUIRED',  'Uw evenement is toegevoegd aan de evenementenkalender.');
define('_SUBMIT_ERROR',          'Oops, er is een foutje met de database; wilt u aub de sitebeheerder inlichten.');
define('_SUBMIT_DISABLED',       'U heeft geen machtiging om een evenement toe te voegen.');

define('_GCAL_GO_BACK', 'Ga terug');
define('_ADMIN_NAME',   'Admin');

define('_CAL_IMAGE_ALT', 'Het Beeld van de kalender');

define('_VIEW_WEEK_EVENTS_FOR',     'Weergaven van de evenementen in de week van');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Ga naar de huidige week');
define('_VIEW_WEEK_OF',             'Bekijk de week van: ');
define('_GO_WEEK_VIEW',             'Ga naar');

define('_SEND_TO_FRIEND', 'Stuur een Evenement via email naar uw vriend / kennis');
define('_YOU_WILL_SEND_EVENT', 'Er zal een emailbericht met daarin een link naar uw vriend verzonden worden: ');
define('_YOUR_NAME', 'Uw Naam:');
define('_YOUR_EMAIL', 'Uw Emailadres:');
define('_FRIEND_NAME', 'Naam ontvanger:');
define('_FRIEND_EMAIL', 'Emailadres ontvanger:');
define('_SEND_EVENT', 'Verzend bericht');
define('_INVALID_EMAIL', 'Geen geldig Email adres');

define('_FRIEND_EMAIL_SUBJECT', 'Interesant evenement van de kalender van ');
define('_FRIEND_GREETING', 'Hallo ');
define('_FRIEND_GREETING_PUNCT', ':');
define('_FRIEND_YOUR_FRIEND', 'Uw vriend ');
define('_FRIEND_WANTED_TO_SEND', ' wil u op de hoogte brengen van het volgende evenement:');
define('_FRIEND_WAS_SENT_FROM', 'Dit email bericht is verzonden vanaf ');
define('_FRIEND_EVENT_SENT', 'Het evenement is verzonden naar uw vriend, bedankt!');

define('_VIEW_DAY_START_DATE', 'Startdatum:');
define('_UPDATE_EVENT', 'Bewerk Evenement');
define('_FORM_CANCEL_LABEL', 'Annuleer');

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