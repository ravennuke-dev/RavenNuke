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

define('_MONTH1_NAME', 'Januar');
define('_MONTH2_NAME', 'Februar');
define('_MONTH3_NAME', 'Mars');
define('_MONTH4_NAME', 'April');
define('_MONTH5_NAME', 'Mai');
define('_MONTH6_NAME', 'Juni');
define('_MONTH7_NAME', 'Juli');
define('_MONTH8_NAME', 'August');
define('_MONTH9_NAME', 'September');
define('_MONTH10_NAME', 'Oktober');
define('_MONTH11_NAME', 'November');
define('_MONTH12_NAME', 'Desember');

define('_DAY0_NAME', 'S&oslash;ndag');
define('_DAY1_NAME', 'Mandag');
define('_DAY2_NAME', 'Tirsdag');
define('_DAY3_NAME', 'Onsdag');
define('_DAY4_NAME', 'Torsdag');
define('_DAY5_NAME', 'Fredag');
define('_DAY6_NAME', 'L&oslash;rdag');

define('_DAY0_ABBREV', 'S&oslash;n');
define('_DAY1_ABBREV', 'Man');
define('_DAY2_ABBREV', 'Tirs');
define('_DAY3_ABBREV', 'Ons');
define('_DAY4_ABBREV', 'Tors');
define('_DAY5_ABBREV', 'Fre');
define('_DAY6_ABBREV', 'L&oslash;r');

define('_DAY0_LETTER', 'S');
define('_DAY1_LETTER', 'M');
define('_DAY2_LETTER', 'T');
define('_DAY3_LETTER', 'O');
define('_DAY4_LETTER', 'T');
define('_DAY5_LETTER', 'F');
define('_DAY6_LETTER', 'L');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'M&aring;ned:');
define('_HEADER_YEAR', '&Aring;r:');
define('_HEADER_TODAYS_DATE', 'Dagens dato:');
define('_HEADER_SUBMIT_INFO', 'Legg inn Begivenhet');
define('_HEADER_PRINTABLE', 'Utskriftsvennlig versjon');
define('_HEADER_GOTO_MONTH', 'G&aring; til');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'G&aring; til n&aring;v&aelig;rende m&aring;ned');
define('_VIEW_MONTH_BULLET', '&amp;bull; ');
define('_CAT_TABLE_LEGEND', 'Vis Kategorier:');
define('_SHOW_ALL', 'Sjekk alle');
define('_SHOW_NONE', 'Sjekk ingen');

define('_VIEW_DAY_EVENTS_FOR',   'Alle begivenheter for ');
define('_VIEW_DAY_EVENT_DETAIL', 'Viser begivenhet #');
define('_VIEW_DAY_NO_TIME',      '(ingen tidsbestemmelse)');
define('_VIEW_DAY_TITLE',        'Tittel:');
define('_VIEW_DAY_CATEGORY',     'Kategori:');
define('_VIEW_DAY_TIME',         'Tidspunkt:');
define('_VIEW_DAY_LOCATION',     'Sted:');
define('_VIEW_DAY_DESC',         'Beskrivelse:');
define('_VIEW_DAY_NOTES',        'Notater:');
define('_VIEW_DAY_SUBMITTER',    'Lagt til av:');

define('_VIEW_DAY_EVENT_REPEATS', 'Denne begivenheten repeteres hver(t) ');
define('_VIEW_DAY_DAYS',         'dag(er)');
define('_VIEW_DAY_WEEKS',        'uke(r)');
define('_VIEW_DAY_MONTHS',       'm&aring;ned(er)');
define('_VIEW_DAY_YEARS',        '&aring;r');
define('_VIEW_DAY_ON',           ' den: ');
define('_VIEW_DAY_EVERY',        'hver');
define('_VIEW_DAY_ENDS_ON',      'Denne begivenheten avsluttes den ');
define('_VIEW_DAY_VIEW_ALL',     'Vis alle begivenhetene for denne dagen');
define('_VIEW_DAY_NO_EVENTS',    'Der er ingen begivenheter for denne dagen.');

define('_SUBMIT_FORM_TITLE',     'Ny begivenhet:');

define('_FORM_INSTRUCTIONS',
   'For &aring; legge inn en begivenhet i kalenderen, vennligst fyll ut skjemaet nedenfor og klikk p&aring; Send inn knappen.');

define('_FORM_SUBMIT',           'Legg inn begivenhet');
define('_FORM_TITLE',            'Tittel:');
define('_FORM_LOCATION',         'Sted:');
define('_FORM_DATE',             'Dato:');
define('_FORM_TIME',             'Tidspunkt:');
define('_FORM_NO_TIME',          'ingen tidsbestemmelse');
define('_FORM_START_TIME',       'Starter:');
define('_FORM_END_TIME',         'Avslutter:');
define('_FORM_CATEGORY',         'Kategori:');
define('_FORM_DETAILS',          'Beskrivelse:');
define('_FORM_REPEAT',           'Repeter:');
define('_FORM_EVERY',            'Hver:');
define('_FORM_END_ON',           'Avsluttes den: ');
define('_FORM_NO_END',           'ingen avsluttingsdato');
define('_FORM_REPEAT_ON',        'Repetering p&aring;:');
define('_FORM_REPEAT_BY',        'Repeater hver:');
define('_FORM_REPEAT_BY_DAY',    'Dag');
define('_FORM_REPEAT_BY_DATE',   'Dato');
define('_FORM_NO_CATEGORIES',    '(Ingen Kategorier tilgjengelig)');
define('_FORM_SUBMITTER',        'Sendt inn av:');
define('_FORM_APPROVE',          'Godkjennt:');
define('_FORM_DELETE_LABEL',     'Slette begivenhet');
define('_FORM_DEL_EVENT_CONFIRM','Er du sikker p&aring; at du vil slette denne begivenheten?');

define('_FORM_DAYS',             'Dag(er)');
define('_FORM_WEEKS',            'Uke(r)');
define('_FORM_MONTHS',           'M&aring;ned(er)');
define('_FORM_YEARS',            '&Aring;r');

define('_REPEAT_NONE',           'Ingen');
define('_REPEAT_DAY',            'Daglig');
define('_REPEAT_WEEK',           'Ukentlig');
define('_REPEAT_MONTH',          'M&aring;nedlig');
define('_REPEAT_YEAR',           '&Aring;rlig');

define('_FORM_BY_DAY_EX', '(f.eks. Den 3dje tordagen i hver m&aring;ned)');
define('_FORM_BY_DATE_EX', '(f.eks. Den 23dje hver m&aring;ned)');

define('_ERR_PLEASE_FIX',
   'Det er oppdaget feil ved denne begivenheten; vennligst rett opp problemet og send inn p&aring; nytt.');
define('_ERR_NO_TITLE',       'Mangler Tema/tittel for begivenheten');
define('_ERR_START_DATE',     'Ugyldig startdato');
define('_ERR_TIME',           'Ugyldig tidspunkt for begynnelse eller avsluttning');
define('_ERR_CATEGORY',       'Ugyldig Kategori');
define('_ERR_REPEAT',         'Ugyldig repetisjonstype');
define('_ERR_INTERVAL',       'Ugyldig repetisjonsintervall');
define('_ERR_END_DATE',       'Ugyldig dato for avsluttning');
define('_ERR_NO_LOCATION',    'Mangler sted for begivenheten');
define('_ERR_NO_DETAILS',     'Mangler beskrivelse for begivenheten');

define('_THANKS_SUBMISSION',     'Takk for at du har lagt inn en begivenhet i kalenderen v&aring;r!');
define('_APPROVAL_REQUIRED',     'Din begivenhet vil avvente godkjennelse av administrator, og vil bli lagt inn i kalenderen i l&oslash;pet av kort tid.');
define('_NO_APPROVAL_REQUIRED',  'Din begivenhet er blitt lagt inn i kalenderen.');
define('_SUBMIT_ERROR',          'OBS; Det oppstod en feil i databasen, vennligst informer nettsidens administrator.');
define('_SUBMIT_DISABLED',       'Du har ikke tillatelse til &aring; legge inn begivenheter i kalenderen.');

define('_GCAL_GO_BACK', 'Tilbake');
define('_ADMIN_NAME',   'Administrator');

define('_CAL_IMAGE_ALT', 'Kalenderbilde');

define('_VIEW_WEEK_EVENTS_FOR',     'Viser begivenheter for uken');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'G&aring; til n&aring;v&aelig;rende uke');
define('_VIEW_WEEK_OF',             'Vis uken: ');
define('_GO_WEEK_VIEW',             'G&aring;');

define('_SEND_TO_FRIEND', 'Send begivenheten per epost til en venn');
define('_YOU_WILL_SEND_EVENT', 'Du vil sende en link for denne begivenheten til en venn: ');
define('_YOUR_NAME', 'Ditt navn:');
define('_YOUR_EMAIL', 'Din epost-adresse:');
define('_FRIEND_NAME', 'Din venn\'s navn:');
define('_FRIEND_EMAIL', 'Din venn\'s epost-adresse:');
define('_SEND_EVENT', 'Send begivenhet');
define('_INVALID_EMAIL', 'Ugyldig epost-adresse');

define('_FRIEND_EMAIL_SUBJECT', 'Interessant begivenhet fra kalenderen p&aring; ');
define('_FRIEND_GREETING', 'Hallo ');
define('_FRIEND_GREETING_PUNCT', ':');
define('_FRIEND_YOUR_FRIEND', 'Din venn ');
define('_FRIEND_WANTED_TO_SEND', ' &oslash;nsker &aring; gj&oslash;re deg oppmerksom p&aring; denne begivenheten:');
define('_FRIEND_WAS_SENT_FROM', 'Denne begivenheten ble sendt fra ');
define('_FRIEND_EVENT_SENT', 'Takk. Begivenheten har blitt sendt til din venn.');

define('_VIEW_DAY_START_DATE', 'Startdato:');
define('_UPDATE_EVENT', 'Oppdater begivenhet');
define('_FORM_CANCEL_LABEL', 'Kanseller');

define('_HEADER_GOTO_ADMIN', 'GCalendar Admin');
define('_FORM_RSVP_LABEL',    'RSVP:');
define('_FORM_RSVP_OFF',      'Ingen RSVP');
define('_FORM_RSVP_ON',       'Tillat RSVP');
define('_FORM_RSVP_EMAIL',    'Tillat RSVP og send meg en epost');

define('_VIEW_DAY_RSVP',            'RSVP liste:');
define('_GCAL_RSVP_EVENT',          'RSVP til denne begivenheten');
define('_GCAL_CANCEL_RSVP_EVENT',   'Kanseller RSVP');
define('_VIEW_DAY_EVENT_NUM',       'Begivenhet #');
define('_GCAL_RSVP_GREETING',       'Kj&aelig;re ');
define('_GCAL_RSVP_END_GREETING',   ':');
define('_GCAL_RSVP_MESSAGE',        'Noen har oppdatert sin RSVP status for en av dine begivenheter.');
define('_GCAL_RSVP_USER',           'Bruker: ');
define('_GCAL_RSVP_ACTION',         'Handling: ');
define('_GCAL_RSVP_RSVP',           'RSVP godkjent');
define('_GCAL_RSVP_CANCEL',         'RSVP avsl&aring;tt');
define('_GCAL_RSVP_EVENT_LINK',     'Link til begivenhet: ');

define('_GCAL_REPEAT_OPTIONS',         'Dette er en repeterende begivenhet; &oslash;nsker du &aring; editere den:');
define('_GCAL_REPEAT_THIS_ONLY',       'Kun denne forekomsten');
define('_GCAL_REPEAT_THIS_FUTURE',     'Denne og alle kommende forekomster');
define('_GCAL_REPEAT_ALL_SAME_START',  'Alle forekomster, men behold original start dato ');
define('_GCAL_REPEAT_ALL_NEW_START',   'Alle forekomster, og endre start dato til datoen ovenfor');
define('_GCAL_REPEAT_NO_BRANCH_DATE',  'Detter er en repeterende begivenhet; alle endringer vil gjelde alle forekomster');
?>