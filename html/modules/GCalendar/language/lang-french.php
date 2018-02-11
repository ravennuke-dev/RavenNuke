<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// language/lang-french.php - This file is part of GCalendar
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
// This is the French language constants file for GCalendar.  Translation by Stéphane Richer.
//
///////////////////////////////////////////////////////////////////////

// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'Janvier');
define('_MONTH2_NAME', 'F&eacute;vrier');
define('_MONTH3_NAME', 'Mars');
define('_MONTH4_NAME', 'Avril');
define('_MONTH5_NAME', 'Mai');
define('_MONTH6_NAME', 'Juin');
define('_MONTH7_NAME', 'Juillet');
define('_MONTH8_NAME', 'Aout');
define('_MONTH9_NAME', 'Septembre');
define('_MONTH10_NAME', 'Octobre');
define('_MONTH11_NAME', 'Novembre');
define('_MONTH12_NAME', 'Decembre');

define('_DAY0_NAME', 'Dimanche');
define('_DAY1_NAME', 'Lundi');
define('_DAY2_NAME', 'Mardi');
define('_DAY3_NAME', 'Mercredi');
define('_DAY4_NAME', 'Jeudi');
define('_DAY5_NAME', 'Vendredi');
define('_DAY6_NAME', 'Samedi');

define('_DAY0_ABBREV', 'Dim');
define('_DAY1_ABBREV', 'Lun');
define('_DAY2_ABBREV', 'Mar');
define('_DAY3_ABBREV', 'Mer');
define('_DAY4_ABBREV', 'Jeu');
define('_DAY5_ABBREV', 'Ven');
define('_DAY6_ABBREV', 'Sam');

define('_DAY0_LETTER', 'D');
define('_DAY1_LETTER', 'L');
define('_DAY2_LETTER', 'M');
define('_DAY3_LETTER', 'M');
define('_DAY4_LETTER', 'J');
define('_DAY5_LETTER', 'V');
define('_DAY6_LETTER', 'S');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'Mois:');
define('_HEADER_YEAR', 'Ann&eacute;e:');
define('_HEADER_TODAYS_DATE', 'Aujourd\'hui:');
define('_HEADER_SUBMIT_INFO', 'Soumettre les infos des activit&eacute;s');
define('_HEADER_PRINTABLE', 'Version imprimable');
define('_HEADER_GOTO_MONTH', 'Aller');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Aller au mois courant');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Voir les cat&eacute;gories:');
define('_SHOW_ALL', 'Cocher toutes');
define('_SHOW_NONE', 'Cocher aucune');

define('_VIEW_DAY_EVENTS_FOR',   'Toutes les activit&eacute;s pour ');
define('_VIEW_DAY_EVENT_DETAIL', 'Voir l\'activit&eacute;s #');
define('_VIEW_DAY_NO_TIME',      '(Pas de dur&eacute;)');
define('_VIEW_DAY_TITLE',        'Titre:');
define('_VIEW_DAY_CATEGORY',     'Categorie:');
define('_VIEW_DAY_TIME',         'Dur&eacute;e:');
define('_VIEW_DAY_LOCATION',     'Endroit:');
define('_VIEW_DAY_DESC',         'Description:');
define('_VIEW_DAY_NOTES',        'Notes:');
define('_VIEW_DAY_SUBMITTER',    'Ajout&eacute; par:');

define('_VIEW_DAY_EVENT_REPEATS', 'Cette activit&eacute; se r&eacute;p&egrave;te tous ');
define('_VIEW_DAY_DAYS',         'jours(s)');
define('_VIEW_DAY_WEEKS',        'semaines(s)');
define('_VIEW_DAY_MONTHS',       'mois(s)');
define('_VIEW_DAY_YEARS',        'ann&eacute;e(s)');
define('_VIEW_DAY_ON',           ' le: ');
define('_VIEW_DAY_EVERY',        'chaque');
define('_VIEW_DAY_ENDS_ON',      'Cette activit&eacute; se termine le ');
define('_VIEW_DAY_VIEW_ALL',     'Voir toutes les activit&eacute;s pour cette journ&eacute;e');
define('_VIEW_DAY_NO_EVENTS',    'Il n\'y a pas d\'activit&eacute;s pour cette journ&eacute;e.');

define('_SUBMIT_FORM_TITLE',     'Nouvelle activit&eacute;:');

define('_FORM_INSTRUCTIONS', 
   'Pour soumettre une activit&eacute;, remplir la forme et cliquer sur le bouton soumettre.');

define('_FORM_SUBMIT',           'Soumettre une activit&eacute;');
define('_FORM_TITLE',            'Titre:');
define('_FORM_LOCATION',         'Endroit:');
define('_FORM_DATE',             'Date:');
define('_FORM_TIME',             'Dur&eacute;e:');
define('_FORM_NO_TIME',          'Pas de dur&eacute;e');
define('_FORM_START_TIME',       'D&eacute;but:');
define('_FORM_END_TIME',         'Fin:');
define('_FORM_CATEGORY',         'Categorie:');
define('_FORM_DETAILS',          'D&eacute;tails:');
define('_FORM_REPEAT',           'R&eacute;p&eacute;ter:');
define('_FORM_EVERY',            'Chaque:');
define('_FORM_END_ON',           'Fin le: ');
define('_FORM_NO_END',           'Pas de date de fin');
define('_FORM_REPEAT_ON',        'R&eacute;p&eacute;ter le:');
define('_FORM_REPEAT_BY',        'R&eacute;p&eacute;ter par:');
define('_FORM_REPEAT_BY_DAY',    'Jour');
define('_FORM_REPEAT_BY_DATE',   'Date');
define('_FORM_NO_CATEGORIES',    '(Pas de cat&eacute;gories de disponible)');
define('_FORM_SUBMITTER',        'Soumis par:');
define('_FORM_APPROVE',          'Approuv&eacute;:');
define('_FORM_DELETE_LABEL',     'Effacer un activit&eacute;');
define('_FORM_DEL_EVENT_CONFIRM','&Ecirc;tes-vous certain de vouloir effacer cette activit&eacute;?');

define('_FORM_DAYS',             'Jour(s)');
define('_FORM_WEEKS',            'Semaine(s)');
define('_FORM_MONTHS',           'Mois(s)');
define('_FORM_YEARS',            'Ann&eacute;es(s)');

define('_REPEAT_NONE',           'Aucun');
define('_REPEAT_DAY',            'Quotidien');
define('_REPEAT_WEEK',           'Hebdomadaire');
define('_REPEAT_MONTH',          'Mensuel');
define('_REPEAT_YEAR',           'Annuel');

define('_FORM_BY_DAY_EX', '(Ex. Le 3e mardi de chaque mois)');
define('_FORM_BY_DATE_EX', '(Ex. le 15 de chaque mois)');

define('_ERR_PLEASE_FIX',     
   'Des erreurs ont &eacute;t&eacute; d&eacute;tect&eacute;es dans votre activit&eacute;; corriger les probl&egrave;mes list&eacute;s plus bas et resoumettre.');
define('_ERR_NO_TITLE',       'Titre manquant');
define('_ERR_START_DATE',     'Date de d&eacute;but invalide');
define('_ERR_TIME',           'Date de d&eacute;but ou de fin invalide');
define('_ERR_CATEGORY',       'Cat&eacute;gorie invalide');
define('_ERR_REPEAT',         'Type de r&eacute;p&eacute;tition invalide');
define('_ERR_INTERVAL',       'Intervale de r&eacute;p&eacute;tition invalide');
define('_ERR_END_DATE',       'Date de fin invalide');
define('_ERR_NO_LOCATION',    'Missing location');
define('_ERR_NO_DETAILS',     'Missing details');

define('_THANKS_SUBMISSION',     'Merci de soumettre une activit&eacute; &agrave; notre calendrier!');
define('_APPROVAL_REQUIRED',     'Votre activit&eacute; sera rajout&eacute;e après l\'approbation des admins.');
define('_NO_APPROVAL_REQUIRED',  'Votre activit&eacute; a &eacute;t&eacute; rajout&eacute;e au calendrier de Reco-Qu&eacute;ebec.');
define('_SUBMIT_ERROR',          'Oops, une erreur de base de donn&eacute;es est survenue.  Contacter l\'admin.');
define('_SUBMIT_DISABLED',       'Vous n\'avez pas la permission de soumettre une activit&eacute;.');

define('_GCAL_GO_BACK', 'Retour');
define('_ADMIN_NAME',   'Admin');

define('_CAL_IMAGE_ALT', 'Image du calendrier');

define('_VIEW_WEEK_EVENTS_FOR',     'Viewing events for the week of');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Go To Current Week');
define('_VIEW_WEEK_OF',             'View Week Of: ');
define('_GO_WEEK_VIEW',             'Aller');

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