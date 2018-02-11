<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// admin language/lang-french.php - This file is part of GCalendar
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
// Admin language file; French.
// 
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'GCalendar Panneau de d\'administration');
define('_ADMIN_DENIED',       'Vous n\'avez pas la permission d\'administrer ce module.');
define('_ADMIN_APPROVE',      'Activit&eacute;s en attente d\'approbation');
define('_ADMIN_ADD_EVENT',    'Ajouter une activit&eacute;');
define('_ADMIN_EDIT_CONFIG',  'Options');
define('_ADMIN_EDIT_CAT',     'Cat&eacute;gories');
define('_ADMIN_EDIT_EVENTS',  '&Eacute;diter une activit&eacute;');

define('_CONF_YES',  'Oui');
define('_CONF_NO',   'Non');
define('_NONE_SELECTED',      'Aucune activit&eacute; de s&eacute;lectionn&eacute;e &agrave; effacer');
define('_CONFIRM_DELETE',     'Pr&ecirc;t &agrave; effacer cette activit&eacute;?');
define('_EVENTS_DEL_ERR',     'Erreur en effa&ccedil;ant cette(ces) activit&eacute;(s)!');

define('_NO_PENDING_EVENTS',  'Aucune activit&eacute; en attente d\'approbation.');
define('_NO_EVENTS',          'Aucune activit&eacute; approuv&eacute; en ce moment');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Date de d&eacute;but');
define('_EVENT_TITLE',        'Titre');
define('_EVENT_SUBMITTER',    'Soumis par');
define('_EVENT_ACTIONS',      'Actions');
define('_EVENT_SELECT',       'S&eacute;lectionner');

define('_VIEW_TITLE',         'Voir l\'activit&eacute;');
define('_EDIT_TITLE',         '&Eacute;diter ou approuver l\'activit&eacute;');
define('_DEL_SELECTED',       'Effacer l\'activit&eacute; s&eacute;lectionn&eacute;');
define('_SELECT_ALL',         'S&eacute;lectionner toutes');
define('_SELECT_NONE',        'S&eacute;lectionner aucune');
define('_SORT_BY_TITLE',      'Cliquer pour trier par cette colonne');

define('_ADMIN_FORM_EDIT_TITLE', '&Eacute;diter l\'activit&eacute;: ');
define('_ADMIN_FORM_ADD_TITLE',  'Ajouter l\'activit&eacute;: ');

define('_ADMIN_SUBMIT_LABEL', 'Mettre à jour l\'activit&eacute;');
define('_ADMIN_ADD_LABEL',    'Ajouter l\'activit&eacute;');

define('_ADMIN_VIEW_EVENT',   'Voir l\'activit&eacute; #');
define('_ADMIN_EDIT_EVENT',   '&Eacute;diter l\'activit&eacute; #');
define('_ADMIN_UPDATE_EVENT', 'Mettre &agrave; jour l\'activit&eacute; #');
define('_ADMIN_CONFIRM_DEL',  'Voulez vous vraiement supprimet l\'activit&eacute; #%d?');
define('_ADMIN_DELETE_OK',    'L\'activit&eacute; # &agrave; &eacute;t&eacute; correctement supprim&eacute;e');
define('_ADMIN_DELETE_ERR',   'Erreur en supprimant l\'activit&eacute; #');
define('_ADMIN_UPDATE_ERR',   'Erreur dans la mise à jour de l\'activit&eacute; #');
define('_ADMIN_ADD_OK',       'L\'activit&eacute; ajout&eacute; avec succ&egrave;s');
define('_ADMIN_ADD_ERR',      'Erreur dans l\'ajout d\'une activit&eacute;');

define('_CURRENT_CATS',       'Liste des cat&eacute;gories:');
define('_MODIFY_BUTTON',      'Modifier la cat&eacute;gorie s&eacute;lectionn&eacute;e:');
define('_DELETE_BUTTON',      'Effacer la cat&eacute;gorie s&eacute;lectionn&eacute;e');
define('_ADD_BUTTON',         'Ajouter une cat&eacute;gorie:');
define('_CONFIRM_DELETE_CAT', 'Effacer vraiement cette cat&eacute;gorie?');
define('_NO_ADD_TEXT',        'Sp&eacute;cifier le nom de la cat&eacute;gorie');

define('_ADMIN_PURGE_RESULTS',   'Purger les r&eacute;sultats des activit&eacute; expir&eacute;es');
define('_PURGE_BUTTON_TEXT',  'Purger les activit&eacute; expir&eacute;es');
define('_PURGE_CONFIRM_HELP', 
   'Voulez-vous vraiement purger ces activit&eacute;s? Cel&agrave; va effacer les activit&eacute;s approuv&eacute;s qui ne se r&eacute;p&egrave;tent pas' .
   ' pr&eacute;c&eacute;demment et toutes les activit&eacute;s r&eacute;p&eacute;titives d&eacute;j&eagrave; approuv&eacute;es.');
define('_ADMIN_DB_OK',     'Succ&egrave;s');
define('_ADMIN_DB_ERR',    'Erreur de base de donn&eacute;es!');

define('_ADMIN_CONFIG_FORM_TITLE',  '&Eacute;diter les options de configuration: ');
define('_ADMIN_CONFIG_TITLE',       'Titre:');
define('_ADMIN_CONFIG_IMAGE',       'Image:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Optionel; lien avec l\'image à utiliser dans la vue de calendrier');
define('_ADMIN_CONFIG_MIN_YEAR',    'Min. Ann&eacute;e:');
define('_ADMIN_CONFIG_MAX_YEAR',    'Max. Ann&eacute;e:');
define('_ADMIN_CONFIG_UPDATE',      'Options de sauvagarde');
define('_ADMIN_CONFIG_YEAR_TIP',    '&Eacute;cart suffisant: typiquement 1902-2037 pour les serveurs Unix; 1970-2037 pourn les serveurs Windows');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Soumissions des usagers:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Contr&ocirc;ler qui pout soumettre une activit&eacute;');
define('_ADMIN_CONFIG_REQ_APP',     '&Eacute;v&eacute;nement requ&eacute;rant une approbation:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Format de date courte:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Format de date r&eacute;gulier:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Format de date longue:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Voir le manuel)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Premier jour de la semaine:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Format de l\'heure:');
define('_ADMIN_CONFIG_TAGS',        'Permettre le code HTML:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Entrer une liste d\'attributs s&eacute;par&eacute;s par des virgules');
define('_ADMIN_CONFIG_ATTRS',       'Permettre le code HTML:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Entrer une liste d\'attributs s&eacute;par&eacute;s par des virgules');
define('_ADMIN_CONFIG_AUTO_LINK',   'Activer les liens automatiques:');
define('_ADMIN_CONFIG_LOC_REQ',     'L\'endroit de l\activit&eacute; est requis:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Le d&eacute;tail de l\'activit&eacute; est requis:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Courriel de notification d\'une nouvelle activit&eacute;:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Envoyer par courriel aux adresses:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Entrer les adresses de courriel s&eacute;par&eacute;es par une virgule');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Envoyer par courriel &agrave; partir de l\'adresse:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Objet du courriel:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Message du courriel:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Montrer la l&eacute;gende de la cat&eacute;gorie:');

define('_SUBMIT_OFF',      'Personne');
define('_SUBMIT_MEMBERS',  'Membres seulement');
define('_SUBMIT_ANYONE',   'Tout le monde');

define('_ADMIN_EDIT_EVENT_LINK', '&Eacute;diter cete activit&eacute;');

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