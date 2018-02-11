<?php 
/////////////////////////////////////////////////////////////////////// 
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0 
// Copyright (C) 2007 Brian Neal 
// Author: Brian Neal bgneal@gmail.com 
//  
// language/lang-italian.php - This file is part of GCalendar 
/////////////////////////////////////////////////////////////////////// 
// 
// This program is free software; you can redistribute it and/or 
// modify it under the terms of the GNU General Public License 
// as published by the Free Software Foundation; either version 2 
// of the License, or (at your option) any later version. 
//  
// This program is distributed in the hope that it will be useful, 
// but WITHOUT ANY WARRANTY; without even the implied warranty of 
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
// GNU General Public License for more details. 
//  
// You should have received a copy of the GNU General Public License 
// along with this program; if not, write to the Free Software 
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA. 
// 
/////////////////////////////////////////////////////////////////////// 
// 
// This is the Italian language constants file for GCalendar. 
// Provided by Gerardo Dassi - Monza - ITALY - dassig@tiscalinet.it 
/////////////////////////////////////////////////////////////////////// 

// names for months and weekdays are provided here in case your server's 
// locale differs from your site's language: 
 
define('_MONTH1_NAME', 'Gennaio'); 
define('_MONTH2_NAME', 'Febbraio'); 
define('_MONTH3_NAME', 'Marzo'); 
define('_MONTH4_NAME', 'Aprile'); 
define('_MONTH5_NAME', 'Maggio'); 
define('_MONTH6_NAME', 'Giugno'); 
define('_MONTH7_NAME', 'Luglio'); 
define('_MONTH8_NAME', 'Agosto'); 
define('_MONTH9_NAME', 'Settembre'); 
define('_MONTH10_NAME', 'Ottobre'); 
define('_MONTH11_NAME', 'Novembre'); 
define('_MONTH12_NAME', 'Dicembre'); 
 
define('_DAY0_NAME', 'Domenica'); 
define('_DAY1_NAME', 'Lunedi\''); 
define('_DAY2_NAME', 'Martedi\''); 
define('_DAY3_NAME', 'Mercoledi\''); 
define('_DAY4_NAME', 'Giovedi\''); 
define('_DAY5_NAME', 'Venerdi\''); 
define('_DAY6_NAME', 'Sabato'); 
 
define('_DAY0_ABBREV', 'Dom'); 
define('_DAY1_ABBREV', 'Lun'); 
define('_DAY2_ABBREV', 'Mar'); 
define('_DAY3_ABBREV', 'Mer'); 
define('_DAY4_ABBREV', 'Gio'); 
define('_DAY5_ABBREV', 'Ven'); 
define('_DAY6_ABBREV', 'Sab'); 
 
define('_DAY0_LETTER', 'D'); 
define('_DAY1_LETTER', 'L'); 
define('_DAY2_LETTER', 'M'); 
define('_DAY3_LETTER', 'M'); 
define('_DAY4_LETTER', 'G'); 
define('_DAY5_LETTER', 'V'); 
define('_DAY6_LETTER', 'S'); 
 
define('_TIME_FORMAT12', '%I:%M %p'); 
define('_TIME_FORMAT24', '%H:%M'); 
 
define('_TIME_SEP', ':'); 
define('_TIME_AM', 'AM'); 
define('_TIME_PM', 'PM'); 
 
define('_HEADER_MONTH', 'Mese:'); 
define('_HEADER_YEAR', 'Anno:'); 
define('_HEADER_TODAYS_DATE', 'Oggi:'); 
define('_HEADER_SUBMIT_INFO', 'Aggiungi informazioni all\'evento'); 
define('_HEADER_PRINTABLE', 'Versione Stampabile'); 
define('_HEADER_GOTO_MONTH', 'Vai'); 
 
define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Vai al mese corrente'); 
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Show Categories:');
define('_SHOW_ALL', 'Check All');
define('_SHOW_NONE', 'Check None');
 
define('_VIEW_DAY_EVENTS_FOR', 'Tutti gli eventi per '); 
define('_VIEW_DAY_EVENT_DETAIL', 'Guarda l\'evento #'); 
define('_VIEW_DAY_NO_TIME', '(Nessun orario)'); 
define('_VIEW_DAY_TITLE', 'Titolo:'); 
define('_VIEW_DAY_CATEGORY', 'Categoria:'); 
define('_VIEW_DAY_TIME', 'Ora:'); 
define('_VIEW_DAY_LOCATION', 'Luogo:'); 
define('_VIEW_DAY_DESC', 'Descrizione:'); 
define('_VIEW_DAY_NOTES', 'Note:'); 
define('_VIEW_DAY_SUBMITTER', 'Aggiunto da:'); 
 
define('_VIEW_DAY_EVENT_REPEATS', 'Questo evento si ripete ogni '); 
define('_VIEW_DAY_DAYS', 'giorno(i)'); 
define('_VIEW_DAY_WEEKS', 'settimana(e)'); 
define('_VIEW_DAY_MONTHS', 'mese(i)'); 
define('_VIEW_DAY_YEARS', 'anno(i)'); 
define('_VIEW_DAY_ON', ' il: '); 
define('_VIEW_DAY_EVERY', 'ogni'); 
define('_VIEW_DAY_ENDS_ON', 'Questo evento termina il '); 
define('_VIEW_DAY_VIEW_ALL', 'Visualizza tutti gli eventi di questo giorno'); 
define('_VIEW_DAY_NO_EVENTS', 'Non ci sono eventi per questo giorno.'); 
 
define('_SUBMIT_FORM_TITLE', 'Nuovo evento:'); 
 
define('_FORM_INSTRUCTIONS',  
'Per aggiungere un evento al calendario, riempire la scheda sottostante e cliccare il pulsante di Aggiungi Evento.'); 
 
define('_FORM_SUBMIT', 'Aggiungi evento'); 
define('_FORM_TITLE', 'Titolo:'); 
define('_FORM_LOCATION', 'Localit&agrave;:'); 
define('_FORM_DATE', 'Data:'); 
define('_FORM_TIME', 'Ora:'); 
define('_FORM_NO_TIME', 'Nessun orario'); 
define('_FORM_START_TIME', 'Inizio:'); 
define('_FORM_END_TIME', 'Fine:'); 
define('_FORM_CATEGORY', 'Categoria:'); 
define('_FORM_DETAILS', 'Dettagli:'); 
define('_FORM_REPEAT', 'Ripete:'); 
define('_FORM_EVERY', 'Ogni:'); 
define('_FORM_END_ON', 'Termina il: '); 
define('_FORM_NO_END', 'Nessuna data di fine'); 
define('_FORM_REPEAT_ON', 'Si ripete il:'); 
define('_FORM_REPEAT_BY', 'Ripete da:'); 
define('_FORM_REPEAT_BY_DAY', 'Giorno'); 
define('_FORM_REPEAT_BY_DATE', 'Data'); 
define('_FORM_NO_CATEGORIES', '(Nessuna categoria disponibile)'); 
define('_FORM_SUBMITTER', 'Inviato da:'); 
define('_FORM_APPROVE', 'Approvato:'); 
define('_FORM_DELETE_LABEL', 'Elimina evento'); 
define('_FORM_DEL_EVENT_CONFIRM','Sei sicuro di voler eliminare questo evento?'); 
 
define('_FORM_DAYS', 'Giorno(i)'); 
define('_FORM_WEEKS', 'Settimana(i)'); 
define('_FORM_MONTHS', 'Mese(i)'); 
define('_FORM_YEARS', 'Anno(i)'); 
 
define('_REPEAT_NONE', 'Nessuno'); 
define('_REPEAT_DAY', 'Giornalmente'); 
define('_REPEAT_WEEK', 'Settimanalmente'); 
define('_REPEAT_MONTH', 'Mensilmente'); 
define('_REPEAT_YEAR', 'Annualmente'); 
 
define('_FORM_BY_DAY_EX', '(Es. Il terzo martedi\' di ogni mese)'); 
define('_FORM_BY_DATE_EX', '(Es. Il 23&deg; di ogni mese)'); 
 
define('_ERR_PLEASE_FIX',  
'Aluni errori sono stati riscontrati nel tuo evento; per favore correggi i problemi segnalati qui sotto e reinvia l\'evento.'); 
define('_ERR_NO_TITLE', 'Manca il titolo dell\'evento'); 
define('_ERR_START_DATE', 'Data di inizio errata'); 
define('_ERR_TIME', 'Data di inizio o di fine errata'); 
define('_ERR_CATEGORY', 'Categoria errata'); 
define('_ERR_REPEAT', 'Tipo di ripetizione errato'); 
define('_ERR_INTERVAL', 'Intervallo di ripetizione errato'); 
define('_ERR_END_DATE', 'Data di fine errata'); 
define('_ERR_NO_LOCATION',    'Missing location');
define('_ERR_NO_DETAILS',     'Missing details');
 
define('_THANKS_SUBMISSION', 'Grazie per aver inviato un evento al nostro calendario!'); 
define('_APPROVAL_REQUIRED', 'Il tuo evento sara\' valutato e aggiunto dall\'amministratore del sito.'); 
define('_NO_APPROVAL_REQUIRED', 'Il tuo evento e\' stato aggiunto al calendario.'); 
define('_SUBMIT_ERROR', 'Oops, si e\' verificato un errore sul database; prego informare l\'amministratore del sito.'); 
define('_SUBMIT_DISABLED', 'Non possiedi le autorizzazioni per inviare un\'evento.'); 
 
define('_GCAL_GO_BACK', 'Indietro'); 
define('_ADMIN_NAME', 'Amministratore'); 
 
define('_CAL_IMAGE_ALT', 'Immagine del calendario'); 

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