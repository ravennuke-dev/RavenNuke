<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// admin language/lang-spanish.php - This file is part of GCalendar
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
// Admin language file; spanish.  Translation by Juan Cabezas Moreno.
// 
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'Panel de administraci&oacute;n de GCalendar');
define('_ADMIN_DENIED',       'No tienes permisos para administrar este m&oacute;dulo.');
define('_ADMIN_APPROVE',      'Eventos pendietnes de aprobaci&oacute;n ');
define('_ADMIN_ADD_EVENT',    'A&ntilde;adir evento ');
define('_ADMIN_EDIT_CONFIG',  'Opciones');
define('_ADMIN_EDIT_CAT',     'Categor&iacute;as');
define('_ADMIN_EDIT_EVENTS',  'Editar eventos');

define('_CONF_YES',  'Si');
define('_CONF_NO',   'No');
define('_NONE_SELECTED',      'No has seleccionado envento/s para eliminar');
define('_CONFIRM_DELETE',     '&iquest;Realmente quieres borrar los eventos seleccionados?');
define('_EVENTS_DEL_ERR',     'Se produjo un error al eliminas el/los evento(s)!');

define('_NO_PENDING_EVENTS',  'No hay ning&uacute;n evento que necesite aprobaci&oacute;n en este momento.');
define('_NO_EVENTS',          'Ning&uacute;n evento aprobado en este momento.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Fecha de inicio');
define('_EVENT_TITLE',        'T&iacute;tulo');
define('_EVENT_SUBMITTER',    'Enviado por');
define('_EVENT_ACTIONS',      'Acciones');
define('_EVENT_SELECT',       'Seleccionar');

define('_VIEW_TITLE',         'Ver evento');
define('_EDIT_TITLE',         'Editar/Aprobar evento');
define('_DEL_SELECTED',       'Eliminar eventos seleccionados');
define('_SELECT_ALL',         'Seleccionar todos');
define('_SELECT_NONE',        'No seleccionar ninguno');
define('_SORT_BY_TITLE',      'tecleo a la clase por esta columna');

define('_ADMIN_FORM_EDIT_TITLE', 'Editar evento: ');
define('_ADMIN_FORM_ADD_TITLE',  'A&ntilde;adir evento: ');

define('_ADMIN_SUBMIT_LABEL', 'Actualizar evento');
define('_ADMIN_ADD_LABEL',    'A&ntilde;adir evento');

define('_ADMIN_VIEW_EVENT',   'Viendo evento n&uacute;mero: ');
define('_ADMIN_EDIT_EVENT',   'Editando evento n&uacute;mero: ');
define('_ADMIN_UPDATE_EVENT', 'Actualizando evento n&uacute;mero: ');
define('_ADMIN_CONFIRM_DEL',  '&iquest;Est&aacute;s realmente seguro de eliminar evento/s? #%d?');
define('_ADMIN_DELETE_OK',    'Se eliminaron correctamente los eventos se&ntilde;alados #');
define('_ADMIN_DELETE_ERR',   'Error al eliminar eventos/s #');
define('_ADMIN_UPDATE_ERR',   'Error al actualizar evento #');
define('_ADMIN_ADD_OK',       'El evento se a&ntilde;adi&oacute; correctamente');
define('_ADMIN_ADD_ERR',      'Error al a&ntilde;adir el evento');

define('_CURRENT_CATS',       'Lista de categor&iacute;as existentes: ');
define('_MODIFY_BUTTON',      'Modificar categir&iacute;a seleccionada: ');
define('_DELETE_BUTTON',      'Eliminar categor&iacute;a seleccionada: ');
define('_ADD_BUTTON',         'A&ntilde;adir categor&iacute;a ');
define('_CONFIRM_DELETE_CAT', '&iquest;Realmente deseas eliminar esta categor&iacute;a? ');
define('_NO_ADD_TEXT',        'Especifica el nombre de la categor&iacute;a ');

define('_ADMIN_PURGE_RESULTS',   'Se elimnaron eventos caducados ');
define('_PURGE_BUTTON_TEXT',  'Eliminar eventos caducados ');
define('_PURGE_CONFIRM_HELP', 
   '&iquest;Realmente deseas eliminar acontecimientos caducados?. Esto borrar&aacute; de la base de datos todos los acontecimientos sin repetici&oacute;n aprobados hasta la fecha de hoy.' .
   ' * * * ');
define('_ADMIN_DB_OK',     'Correcto');
define('_ADMIN_DB_ERR',    'Error de la base de datos');

define('_ADMIN_CONFIG_FORM_TITLE',  'Editar opciones de configuraci&oacute;n : ');
define('_ADMIN_CONFIG_TITLE',       'T&iacute;tulo: ');
define('_ADMIN_CONFIG_IMAGE',       'Imagen: ');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Opcional; ruta de la imagen que se utilizar&aacute; para el calendario');
define('_ADMIN_CONFIG_MIN_YEAR',    'A&ntilde;o de inicio del calendario:          ');
define('_ADMIN_CONFIG_MAX_YEAR',    'A&ntilde;o de de finalizaci&oacute;n del calendario: ');
define('_ADMIN_CONFIG_UPDATE',      'Guardar opciones');
define('_ADMIN_CONFIG_YEAR_TIP',    'Rango seguro: 1902-2037 para servidores Unix; 1970-2037 para servidores Windows');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Permisos de uso: ');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Control para env&iacute;o de eventos');
define('_ADMIN_CONFIG_REQ_APP',     '&iquest;Los eventos enviados requieren aprobaci&oacute;n?: ');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Formato de fecha corto:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Formato de fecha regular:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Formato de fecha largo:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Leer el manual)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Primer d&iacute;a de la semana:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Formato de Tiempo:');
define('_ADMIN_CONFIG_TAGS',        'Permitido HTML Tags:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Introduce los nombres separados por comas para HTML tags');
define('_ADMIN_CONFIG_ATTRS',       'Permitido HTML Tag atributos:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Introduce los nombres separados por comas para HTML tag atributos');
define('_ADMIN_CONFIG_AUTO_LINK',   'habilitar Enlaces Autom&aacute;ticos:');
define('_ADMIN_CONFIG_LOC_REQ',     'Campo Lugar del Evento Requerido:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Campo Detalles del Evento Requerido:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Notificaci&oacute;n por correo de nuevos eventos:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Enviar un correo a las direcciones:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Separe cada elemento de la lista de correos con una coma');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Direcci&oacute;n de Correo del Remitente:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Asunto del Correo:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Mensaje del Correo:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Mostrar Leyenda de Categor&iacute;a:');

define('_SUBMIT_OFF',      'Nadie');
define('_SUBMIT_MEMBERS',  'Miembros solamente');
define('_SUBMIT_ANYONE',   'Cualquiera');

define('_ADMIN_EDIT_EVENT_LINK', 'Editar este evento');

define('_CATEGORY_ID', 'ID d3e la Categor&iacute;a:');

define('_ADMIN_CONFIG_WYSIWYG', 'Usear el Editor de RavenNuke:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Usuarios Pueden Actualizar sus Eventos:');

define('_ADMIN_GOTO_MODULE', 'Ir al M&oacute;dulo GCalendar');
define('_RSVP_OFF',        'Deshabilitado');
define('_RSVP_ON',         'Habilitado');
define('_RSVP_ON_EMAIL',   'Habilitado con notificaci&oacute;n por correo');
define('_ADMIN_CONFIG_RSVP',  'RSVP:');
define('_ADMIN_CONFIG_RSVP_SUBJECT', 'Asunto del Correo de RSVP:');
define('_GCAL_RSVP_ADMIN_TITLE', 'Editar RSVP');
define('_GCAL_ADMIN_EDIT_RSVP', 'Editar Informaci&oacute;n del RSVP para el Evento #');
define('_GCAL_DEL_RSVP', 'Eliminar los Usuarios Seleccionados de la lista RSVP');
define('_GCAL_EMPTY_RSVP_LIST', 'No hay nadie en la lista RSVP');
define('_GCAL_DEL_RSVP_CONFIRM', '&iquest;Est&aacute;s seguro que quieres eliminar los usuarios seleccionados de la lista RSVP?');
define('_GCAL_ADMIN_ABOUT', 'Acerca de');
define('_GCAL_ADMIN_ABOUT_TEXT', 'GCalendar is Copyright &copy; 2007 by Brian Neal');
define('_GCAL_ADMIN_ABOUT_TEXT2', 'GCalendar is free software released under the GNU GPL. See the file COPYING ' .
   'in the GCalender distribution archive.');
define('_GCAL_ADMIN_ABOUT_TEXT3', 
   'Please read the included manual for instructions, a full list of credits, and licensing information.<br />' .
   'For support, please visit the <a href="http://sourceforge.net/projects/gcalendar-nuke/">GCalendar for PHP-Nuke' .
   ' Support Website</a>.');
define('_GCAL_ADMIN_ABOUT_TEXT4', 'If you find GCalender useful, please consider making a donation!');
define('_GCAL_ADMIN_DONATE', 'Donate to GCalendar');

define('_SUBMIT_GROUPS',   'Grupos');
define('_ADMIN_GROUPS',    'Grupos');
define('_ADMIN_NO_GROUPS', 'Usted no tiene NSN Groups instalado o no tiene ning&uacute;n grupo todav&iacute;a.');
define('_ADMIN_GROUP_PERM_LABEL', 'Permisos de Grupo: ');
define('_ADMIN_GROUP_PERM_GROUP', 'Grupo');
define('_ADMIN_GROUP_PERM_SUBMIT', 'Pueden Enviar Eventos');
define('_ADMIN_GROUP_PERM_APPROV', 'Eventos no requieren aprobaci&oacute;n');
define('_ADMIN_GROUP_PERM_SAVE', 'Guardar');
define('_ADMIN_GROUP_SUBMIT_NOTE', 'S&oacute;lo se aplica si la opci&oacute;n \'Envios de Usuario\' est&aacute; establecida a \'Grupos\'');
define('_ADMIN_GROUP_CAT_LABEL', 'Category Assignments: ');
define('_ADMIN_GROUP_CAT_EXPLANATION', 
   'Las categor&iacute;as pueden ser asignadas a grupos, en cuyo caso s&oacute;lo los miembros del grupo pueden ver los eventos en dichas categor&iacute;as. ' .
   'Si una categor&iacute;a no est&aacute; asignada a ning&uacute;n grupo, estar&aacute; visible para todos. ' .
   'M&uacute;ltiples grupos pueden ser asignados a una categor&iacute;a (shift- o ctrl-click en los grupos).');
define('_ADMIN_GROUP_CAT_COMBO', 'Categor&iacute;a:');
define('_ADMIN_GROUP_CAT_GROUPS', 'Grupos Asignados:');
define('_ADMIN_GROUP_CAT_SAVE', 'Actualizar Categor&iacute;a');
?>