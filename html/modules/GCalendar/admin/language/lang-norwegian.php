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

define('_ADMIN_TITLE',        'Administrering av GCalendar');
define('_ADMIN_DENIED',       'Du har ikke tillatelse til &aring; administrere denne modulen.');
define('_ADMIN_APPROVE',      'Avventende begivenheter');
define('_ADMIN_ADD_EVENT',    'Legg til begivenhet');
define('_ADMIN_EDIT_CONFIG',  'Konfigurering');
define('_ADMIN_EDIT_CAT',     'Kategorier');
define('_ADMIN_EDIT_EVENTS',  'Editere begivenheter');

define('_CONF_YES',  'Ja');
define('_CONF_NO',   'Nei');
define('_NONE_SELECTED',      'Ingen begivenheter er valgt for sletting');
define('_CONFIRM_DELETE',     'Er du sikker p&aring; at du vil slette valgte begivenheter?');
define('_EVENTS_DEL_ERR',     'Feil ved sletting av begivenhet(er)!');

define('_NO_PENDING_EVENTS',  'Ingen begivenheter venter p&aring; godkjenning for &oslash;yeblikket.');
define('_NO_EVENTS',          'Ingen godkjente begivenheter for &oslash;yeblikket.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Start dato');
define('_EVENT_TITLE',        'Tittel');
define('_EVENT_SUBMITTER',    'Sendt inn av');
define('_EVENT_ACTIONS',      'Handlinger');
define('_EVENT_SELECT',       'Valg');

define('_VIEW_TITLE',         'Vis begivenhet');
define('_EDIT_TITLE',         'Editere/godkjenne begivenhet');
define('_DEL_SELECTED',       'Slette valgte begivenheter');
define('_SELECT_ALL',         'Velg alle');
define('_SELECT_NONE',        'Velg ingen');
define('_SORT_BY_TITLE',      'Klikk for &aring; sortere denne kolonnen');

define('_ADMIN_FORM_EDIT_TITLE', 'Editere begivenhet: ');
define('_ADMIN_FORM_ADD_TITLE',  'Legg til begivenhet: ');

define('_ADMIN_SUBMIT_LABEL', 'Oppdater begivenhet');
define('_ADMIN_ADD_LABEL',    'Legg til begivenhet');

define('_ADMIN_VIEW_EVENT',   'Viser begivenhet #');
define('_ADMIN_EDIT_EVENT',   'Editerer begivenhet #');
define('_ADMIN_UPDATE_EVENT', 'Oppdaterer begivenhet #');
define('_ADMIN_CONFIRM_DEL',  'Er du sikker p&aring; at du vil slette begivenheten #%d?');
define('_ADMIN_DELETE_OK',    'Vellykket sletting av begivenhet #');
define('_ADMIN_DELETE_ERR',   'Feil ved sletting av begivenhet #');
define('_ADMIN_UPDATE_ERR',   'Feil ved oppdatering av begivenhet #');
define('_ADMIN_ADD_OK',       'Begivenhet vellykket lagt til');
define('_ADMIN_ADD_ERR',      'Feil ved tillegging av begivenhet');

define('_CURRENT_CATS',       'N&aring;v&aelig;rende Kategoriliste:');
define('_MODIFY_BUTTON',      'Modifiser valgt Kategori:');
define('_DELETE_BUTTON',      'Slette valgt Kategori');
define('_ADD_BUTTON',         'Legg til Kategori:');
define('_CONFIRM_DELETE_CAT', 'Er du sikker p&aring; at du vil slette Kategorien?');
define('_NO_ADD_TEXT',        'Vennligst spesifiser Kategorinavn');

define('_ADMIN_PURGE_RESULTS',   'Slette utl&oslash;pte begivenhets-resultater');
define('_PURGE_BUTTON_TEXT',  'Slette utl&oslash;pte begivenheter');
define('_PURGE_CONFIRM_HELP',
   'Er du sikker p&aring; at du vil slette utl&oslash;pte begivenheter? Dette vil slette alle godkjente ikke-repeterende begivenheter med startdatoer' .
   ' som er utl&oslash;pt, og alle godkjente repeterende begivenheter med sluttdatoer som er utl&oslash;pt.');
define('_ADMIN_DB_OK',     'Vellykket');
define('_ADMIN_DB_ERR',    'Database Feil!');

define('_ADMIN_CONFIG_FORM_TITLE',  'Editere Konfigureringsvalg: ');
define('_ADMIN_CONFIG_TITLE',       'Tittel:');
define('_ADMIN_CONFIG_IMAGE',       'Bilde:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Valgfritt; sti til bilde som skal brukes i kalendervisningene');
define('_ADMIN_CONFIG_MIN_YEAR',    'Minimum &Aring;r:');
define('_ADMIN_CONFIG_MAX_YEAR',    'Maksimum &Aring;r:');
define('_ADMIN_CONFIG_UPDATE',      'Lagre Valg');
define('_ADMIN_CONFIG_YEAR_TIP',    'Sikkre omr&aring;der: typisk 1902-2037 for Unix servere; 1970-2037 for Windows servere');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Bruker innsendelser:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Kontrollerer hvem som kan sende inn begivenheter');
define('_ADMIN_CONFIG_REQ_APP',     'Begivenhetene krever godkjenning:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Kort datoformat:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Vanlig datoformat:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Langt datoformat:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Se i manualen)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'F&oslash;rste ukedag:');
define('_ADMIN_CONFIG_WEEKENDS',    'Helgedager:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Tidsformat:');
define('_ADMIN_CONFIG_TAGS',        'Tillatte HTML-tag\'er:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Kommategn separerer listen over HTML-tag\'er');
define('_ADMIN_CONFIG_ATTRS',       'Tillatte HTML-tag attributter:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Kommategn separerer listen over HTML-tag attributtene');
define('_ADMIN_CONFIG_AUTO_LINK',   'Aktivere Auto-Linker:');
define('_ADMIN_CONFIG_LOC_REQ',     'Sted for begivenheten (obligatorisk):');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Beskrivelse for begivenheten (obligatorisk):');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Epost-melding om nye begivenheter:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Epost til adressene:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Kommategn separerer listen av epost-adresser');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Epost fra adresse:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Epost Tittel/tema:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Epost Tekst:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Vis Kategori forklaring:');

define('_SUBMIT_OFF',      'Ingen');
define('_SUBMIT_MEMBERS',  'Kun Medlemmer');
define('_SUBMIT_ANYONE',   'Alle');

define('_ADMIN_EDIT_EVENT_LINK', 'Editer denne begivenheten');

define('_CATEGORY_ID', 'Kategori ID:');

define('_ADMIN_CONFIG_WYSIWYG', 'Bruk RavenNuke editor:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Brukere kan oppdatere egne begivenheter:');

define('_ADMIN_GOTO_MODULE', 'GCalendar Modulen');
define('_RSVP_OFF',        'Av');
define('_RSVP_ON',         'P&aring;');
define('_RSVP_ON_EMAIL',   'P&aring; (med epost-meldinger)');
define('_ADMIN_CONFIG_RSVP',  'RSVP:');
define('_ADMIN_CONFIG_RSVP_SUBJECT', 'RSVP epost Tema/tittel:');
define('_GCAL_RSVP_ADMIN_TITLE', 'Editere RSVP');
define('_GCAL_ADMIN_EDIT_RSVP', 'Editere RSVP informasjon for begivenhet #');
define('_GCAL_DEL_RSVP', 'Slette valgte Brukere fra RSVP listen');
define('_GCAL_EMPTY_RSVP_LIST', 'Det er ingen Brukere p&aring; RSVP listen');
define('_GCAL_DEL_RSVP_CONFIRM', 'Er du sikker p&aring; at du vil slette valgte Brukere fra RSVP listen?');
define('_GCAL_ADMIN_ABOUT', 'Om');
define('_GCAL_ADMIN_ABOUT_TEXT', 'GCalendar is Copyright &amp;copy; 2007 by Brian Neal');
define('_GCAL_ADMIN_ABOUT_TEXT2', 'GCalendar is free software released under the GNU GPL. See the file COPYING ' .
   'in the GCalender distribution archive.');
define('_GCAL_ADMIN_ABOUT_TEXT3',
   'Please read the included manual for instructions, a full list of credits, and licensing information.<br />' .
   'For support, please visit the <a href="http://sourceforge.net/projects/gcalendar-nuke/">GCalendar for PHP-Nuke' .
   ' Support Website</a>.');
define('_GCAL_ADMIN_ABOUT_TEXT4', 'If you find GCalender useful, please consider making a donation!');
define('_GCAL_ADMIN_DONATE', 'Donate to GCalendar');

define('_SUBMIT_GROUPS',   'Grupper');
define('_ADMIN_GROUPS',    'Grupper');
define('_ADMIN_NO_GROUPS', 'Du har ikke installert NSN Groups, eller du har ikke satt opp noen Gruppe(r) enn&aring;.');
define('_ADMIN_GROUP_PERM_LABEL', 'Gruppe tillatelser: ');
define('_ADMIN_GROUP_PERM_GROUP', 'Gruppe');
define('_ADMIN_GROUP_PERM_SUBMIT', 'Kan sende inn begivenheter');
define('_ADMIN_GROUP_PERM_APPROV', 'begivenheter trenger ikke godkjenning');
define('_ADMIN_GROUP_PERM_SAVE', 'Lagre');
define('_ADMIN_GROUP_SUBMIT_NOTE', 'Gjelder kun hvis \'Bruker innsendelser\' valget er satt til \'Grupper\'');
define('_ADMIN_GROUP_CAT_LABEL', 'Kategori tildelelser: ');
define('_ADMIN_GROUP_CAT_EXPLANATION',
   'Kategorier kan bare tildeles Grupper; hvilket betyr at kun Gruppemedlemmer kan se begivenhetene i disse Kategoriene. ' .
   'Hvis en Kategori ikke er tildelt noen Gruppe, vil begivenhetene v&aelig;re synlige for alle. ' .
   'Flere Grupper kan tildeles en Kategori (shift- eller ctrl-klikk p&aring; Gruppene).');
define('_ADMIN_GROUP_CAT_COMBO', 'Kategori:');
define('_ADMIN_GROUP_CAT_GROUPS', 'Tildelte Grupper:');
define('_ADMIN_GROUP_CAT_SAVE', 'Oppdater Kategori');
?>