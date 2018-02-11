<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Mathijs Lubbbertsen dutchnuker@regio-putten.nl
// 
// admin language/lang-dutch.php - This file is part of GCalendar
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
// Admin language file; Dutch.
// 
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'GCalendar Beheerders Menu');
define('_ADMIN_DENIED',       'U heeft beheerders toegang voor deze module.');
define('_ADMIN_APPROVE',      'Goedkeuren van evenementen');
define('_ADMIN_ADD_EVENT',    'Evenement toevoegen');
define('_ADMIN_EDIT_CONFIG',  'Optie\'s');
define('_ADMIN_EDIT_CAT',     'Categorieen');
define('_ADMIN_EDIT_EVENTS',  'Bewerken evenementen');

define('_CONF_YES',  'Ja');
define('_CONF_NO',   'Nee');
define('_NONE_SELECTED',      'Geen evenementen geselecteerd om te verwijderen.');
define('_CONFIRM_DELETE',     'Weet u het zeker dat u deze evenementen wilt verwijderen?');
define('_EVENTS_DEL_ERR',     'Fout bij het verwijderen van de gelecteeerde evenementen!');

define('_NO_PENDING_EVENTS',  'Geen evenementen welke gecontroleerd dienen te worden op dit moment.');
define('_NO_EVENTS',          'Geen gecontroleerde items op dit moment.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Begindatum');
define('_EVENT_TITLE',        'Titel');
define('_EVENT_SUBMITTER',    'Toegevoegd door');
define('_EVENT_ACTIONS',      'Actie\'s');
define('_EVENT_SELECT',       'Selecteer');

define('_VIEW_TITLE',         'Bekijk evenement');
define('_EDIT_TITLE',         'Bewerk / Controleer evenement');
define('_DEL_SELECTED',       'Verwijder geselecteerde evenement');
define('_SELECT_ALL',         'Selecteer alle items');
define('_SELECT_NONE',        'Selecteer geen items');
define('_SORT_BY_TITLE',      'Klik om te sorteren op deze kolom');

define('_ADMIN_FORM_EDIT_TITLE', 'Bewerk evenement: ');
define('_ADMIN_FORM_ADD_TITLE',  'Toevoegen evenement: ');

define('_ADMIN_SUBMIT_LABEL', 'Update Evenement');
define('_ADMIN_ADD_LABEL',    'Toevoegen Evenement');

define('_ADMIN_VIEW_EVENT',   'Bekijk Evenement #');
define('_ADMIN_EDIT_EVENT',   'Bewerken Evenement #');
define('_ADMIN_UPDATE_EVENT', 'Updaten Evenement #');
define('_ADMIN_CONFIRM_DEL',  'Weet u het zeker dat u evenement #%d wilt verwijderen?');
define('_ADMIN_DELETE_OK',    'Verwijderen van Evenement # is gelukt');
define('_ADMIN_DELETE_ERR',   'Fout bij verwijderen van evenement #');
define('_ADMIN_UPDATE_ERR',   'Fout bij updaten van evenement #');
define('_ADMIN_ADD_OK',       'Toevoegen van evement is geslaagd');
define('_ADMIN_ADD_ERR',      'Fout bij toevoegen van evenement');

define('_CURRENT_CATS',       'Huidige Categorie lijst:');
define('_MODIFY_BUTTON',      'Bewerk geselecteerde categorie:');
define('_DELETE_BUTTON',      'Verwijder geselcteerde categorie');
define('_ADD_BUTTON',         'Categorie toevoegen:');
define('_CONFIRM_DELETE_CAT', 'Weet u het zeker dat u de geselecteerde categorie wilt verwijderen?');
define('_NO_ADD_TEXT',        'Wilt u aub de categorienaam invullen');

define('_ADMIN_PURGE_RESULTS',   'Verwijder historische evenementen');
define('_PURGE_BUTTON_TEXT',  'Verwijder historische evenementen');
define('_PURGE_CONFIRM_HELP', 
   'Weet u het zeker dat u de historische / verlopen evenementen wilt verwijderen?  Hiermee verwijderd u alle goedgekeurde niet-terugkerende evenementen met een startdatum  .
    in het verleden en alle goedgekeurde terugkerende evenementen met de einddatum in het verleden.');
define('_ADMIN_DB_OK',     'Database in orde, historische evenmenten zijn verwijderd');
define('_ADMIN_DB_ERR',    'Database Fout!');

define('_ADMIN_CONFIG_FORM_TITLE',  'Bewerk configuratie optie\'s: ');
define('_ADMIN_CONFIG_TITLE',       'Titel:');
define('_ADMIN_CONFIG_IMAGE',       'Image:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Optioneel; pad naar mage welke weergeven wordt bij de kalender weergave');
define('_ADMIN_CONFIG_MIN_YEAR',    'Min. Jaar:');
define('_ADMIN_CONFIG_MAX_YEAR',    'Max. Jaar:');
define('_ADMIN_CONFIG_UPDATE',      'Bewaar Opties');
define('_ADMIN_CONFIG_YEAR_TIP',    'Veilige bereik: typically 1902-2037 voor Unix servers; 1970-2037 voor Windows servers');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Gebruikers Toevoegingen:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Wie mag er evenementen toevoegen');
define('_ADMIN_CONFIG_REQ_APP',     'Goedkeuring na toevoegen evenement verplicht:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Korte datum notatie:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Reguliere datum notatie:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Lange datum notatie:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Lees de handleiding)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Eerste dag van de week:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Tijd formaat:');
define('_ADMIN_CONFIG_TAGS',        'HTML code toegestaan:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Voeg een komma toe om de HTML tags te onderscheiden in de lijst');
define('_ADMIN_CONFIG_ATTRS',       'Toegestane HTML Tag Attributen:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Voeg een komma toe om de HTML tag attributen te onderscheiden in de lijst');
define('_ADMIN_CONFIG_AUTO_LINK',   'Enable Auto-Links:');
define('_ADMIN_CONFIG_LOC_REQ',     'Invullen veld locatie verplicht:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Invullen veld details verplicht:'); 
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Email Notificatie nieuwe Evenementen:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Notificatie email naar:'); 
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Bij meeerdere emailadressen de emailadressen door kommas gescheiden plaatsen'); 
define('_ADMIN_CONFIG_EMAIL_FROM', 'Email van Adres:'); 
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Email Onderwerp:'); 
define('_ADMIN_CONFIG_EMAIL_MSG', 'Email Bericht:'); 
define('_ADMIN_CONFIG_CAT_LEGEND', 'Toon categorie legenda:');

define('_SUBMIT_OFF',      'Niemand');
define('_SUBMIT_MEMBERS',  'Alleen Leden');
define('_SUBMIT_ANYONE',   'Iedereen');

define('_ADMIN_EDIT_EVENT_LINK', 'Bewerk dit evenement');

define('_CATEGORY_ID', 'Categorie ID:');

define('_ADMIN_CONFIG_WYSIWYG', 'Gebruik RavenNuke Editor:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Gebruikers kunnen hun Evenementen bewerken:');

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