<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// language/lang-spanish.php - This file is part of GCalendar
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
// This is the spanish language constants file for GCalendar.  Translation by Juan Cabezas Moreno.
// With updates from Jose F Florez  josefflo@informaticaysalud.com
//
///////////////////////////////////////////////////////////////////////
// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'Enero');
define('_MONTH2_NAME', 'Febrero');
define('_MONTH3_NAME', 'Marzo');
define('_MONTH4_NAME', 'Abril');
define('_MONTH5_NAME', 'Mayo');
define('_MONTH6_NAME', 'Junio');
define('_MONTH7_NAME', 'Julio');
define('_MONTH8_NAME', 'Agosto');
define('_MONTH9_NAME', 'Septiembre');
define('_MONTH10_NAME', 'Octubre');
define('_MONTH11_NAME', 'Noviembre');
define('_MONTH12_NAME', 'Diciembre');

define('_DAY0_NAME', 'Domingo');
define('_DAY1_NAME', 'Lunes');
define('_DAY2_NAME', 'Martes');
define('_DAY3_NAME', 'Mi&eacute;rcoles');
define('_DAY4_NAME', 'Jueves');
define('_DAY5_NAME', 'Viernes');
define('_DAY6_NAME', 'S&aacute;bado');

define('_DAY0_ABBREV', 'Dom');
define('_DAY1_ABBREV', 'Lun');
define('_DAY2_ABBREV', 'Mar');
define('_DAY3_ABBREV', 'Mie');
define('_DAY4_ABBREV', 'Jue');
define('_DAY5_ABBREV', 'Vie');
define('_DAY6_ABBREV', 'Sab');

define('_DAY0_LETTER', 'D');
define('_DAY1_LETTER', 'L');
define('_DAY2_LETTER', 'M');
define('_DAY3_LETTER', 'X');
define('_DAY4_LETTER', 'J');
define('_DAY5_LETTER', 'V');
define('_DAY6_LETTER', 'S');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'Mes:');
define('_HEADER_YEAR', 'A&ntilde;o:');
define('_HEADER_TODAYS_DATE', 'Fecha de hoy');
define('_HEADER_SUBMIT_INFO', 'Enviar informaci&oacute;n de evento');
define('_HEADER_PRINTABLE', 'Versi&oacute;n imprimible');
define('_HEADER_GOTO_MONTH', 'Ir');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Ir a l mes actual');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Show Categories:');
define('_SHOW_ALL', 'Check All');
define('_SHOW_NONE', 'Check None');

define('_VIEW_DAY_EVENTS_FOR',   'Todos los eventos del ');
define('_VIEW_DAY_EVENT_DETAIL', 'Visualizando Evento #');
define('_VIEW_DAY_NO_TIME',      '(Sin horario especificado)');
define('_VIEW_DAY_TITLE',        'T&iacute;tulo:');
define('_VIEW_DAY_CATEGORY',     'Categor&iacute;a:');
define('_VIEW_DAY_TIME',         'Horario:');
define('_VIEW_DAY_LOCATION',     'Lugar:');
define('_VIEW_DAY_DESC',         'Descripci&oacute;n:');
define('_VIEW_DAY_NOTES',        'Nota:');
define('_VIEW_DAY_SUBMITTER',    'A&ntilde;adido por:');

define('_VIEW_DAY_EVENT_REPEATS', 'Este evento se repite cada...');
define('_VIEW_DAY_DAYS',         'd&iacute;a(s)');
define('_VIEW_DAY_WEEKS',        'semana(s)');
define('_VIEW_DAY_MONTHS',       'mes(s)');
define('_VIEW_DAY_YEARS',        'a&ntilde;o(s)');
define('_VIEW_DAY_ON',           ' on: ');
define('_VIEW_DAY_EVERY',        'cada');
define('_VIEW_DAY_ENDS_ON',      'Este evento finaliza el ');
define('_VIEW_DAY_VIEW_ALL',     'Ver todos los eventos de este d&iacute;a');
define('_VIEW_DAY_NO_EVENTS',    'No hay enventos para este d&iacute;a.');

define('_SUBMIT_FORM_TITLE',     'Nuevo evento:');

define('_FORM_INSTRUCTIONS', 
   'Para enviar un evento rellena los datos u pulsa la tecla de env&iacute;o.');

define('_FORM_SUBMIT',           'Enviar evento');
define('_FORM_TITLE',            'T&iacute;tulo:');
define('_FORM_LOCATION',         'Lugar:');
define('_FORM_DATE',             'Fecha:');
define('_FORM_TIME',             'Hora:');
define('_FORM_NO_TIME',          'Sin hora especificada, o es todo el d&iacute;a');
define('_FORM_START_TIME',       'Comienza:');
define('_FORM_END_TIME',         'Finaliza:');
define('_FORM_CATEGORY',         'Categor&iacute;a:');
define('_FORM_DETAILS',          'Detalles:');
define('_FORM_REPEAT',           'Repetici&oacute;n:');
define('_FORM_EVERY',            'Cada:');
define('_FORM_END_ON',           'Hasta: ');
define('_FORM_NO_END',           'Sin fecha final');
define('_FORM_REPEAT_ON',        'Aparecer&aacute;:');
define('_FORM_REPEAT_BY',        'Repetido por:');
define('_FORM_REPEAT_BY_DAY',    'D&iacute;a');
define('_FORM_REPEAT_BY_DATE',   'Fecha');
define('_FORM_NO_CATEGORIES',    '(Categor&iacute;a no disponible)');
define('_FORM_SUBMITTER',        'Enviado por:');
define('_FORM_APPROVE',          'Aprobado:');
define('_FORM_DELETE_LABEL',     'Eliminar evento');
define('_FORM_DEL_EVENT_CONFIRM','&iquest;Est&aacute;s seguro de querer borrar este evento?');

define('_FORM_DAYS',             'D&iacute;a(s)');
define('_FORM_WEEKS',            'Semana(s)');
define('_FORM_MONTHS',           'Mes(es)');
define('_FORM_YEARS',            'A&ntilde;o(s)');

define('_REPEAT_NONE',           '&uacute;nico, no se repite');
define('_REPEAT_DAY',            'Diariamente');
define('_REPEAT_WEEK',           'Semanalmente');
define('_REPEAT_MONTH',          'Mensualmente');
define('_REPEAT_YEAR',           'Anualmente');

define('_FORM_BY_DAY_EX', '(Ejemplo: El tercer martes de cada mes.)');
define('_FORM_BY_DATE_EX', '(Ejemplo: El d&iacute;a 23 de cada mes)');

define('_ERR_PLEASE_FIX',     
   'Se detectaron errores al intriducir el evento. Corrige los problemas y vuelve a reenviarlo.');
define('_ERR_NO_TITLE',       'No se puso t&iacute;tulo del evento');
define('_ERR_START_DATE',     'Fecha incorrecta');
define('_ERR_TIME',           'Error en hora de inicio y/o final');
define('_ERR_CATEGORY',       'Error en la categor&iacute;a');
define('_ERR_REPEAT',         'Error en el tipo de repetici&oacute;n');
define('_ERR_INTERVAL',       'Error en el intervalo de la repetici&oacute;n');
define('_ERR_END_DATE',       'Error en la fecha de finalizaci&oacute;n');
define('_ERR_NO_LOCATION',    'Missing location');
define('_ERR_NO_DETAILS',     'Missing details');

define('_THANKS_SUBMISSION',     'Gracias por enviar este evento a nuestro calendario');
define('_APPROVAL_REQUIRED',     'El evento tiene que ser aprobado por el administrador del sitio.');
define('_NO_APPROVAL_REQUIRED',  'El evento se ha a&ntilde;adido a nuestro calendario.');
define('_SUBMIT_ERROR',          'Se ha producido un problema en la base de datos. Informa de esto al administrador. Gracias.');
define('_SUBMIT_DISABLED',       'No est&aacute;s registrado para enviar eventos.');

define('_GCAL_GO_BACK', 'Regresar');
define('_ADMIN_NAME',   'Administrador');

define('_CAL_IMAGE_ALT', 'Imagen del calendario');

define('_VIEW_WEEK_EVENTS_FOR',     'Est‡s viendo eventos para la semana: ');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Ir a a la semana actual');
define('_VIEW_WEEK_OF',             'Ver la semana: ');
define('_GO_WEEK_VIEW',             'Ir');

define('_SEND_TO_FRIEND', 'Enviar el evento por correo-e');
define('_YOU_WILL_SEND_EVENT', 'Enviar un enlace a un amigo de este evento: ');
define('_YOUR_NAME', 'Su nombre:');
define('_YOUR_EMAIL', 'Su correo-e:');
define('_FRIEND_NAME', 'Nombre de tu amigo:');
define('_FRIEND_EMAIL', 'Correo-e de tu amigo:');
define('_SEND_EVENT', 'Enviar Evento');
define('_INVALID_EMAIL', 'Direcci—n de correo-e inv‡lida');

define('_FRIEND_EMAIL_SUBJECT', 'Este es un evento interesante en el calendario de ');
define('_FRIEND_GREETING', 'Hola! ');
define('_FRIEND_GREETING_PUNCT', ':');
define('_FRIEND_YOUR_FRIEND', 'Tu amigo ');
define('_FRIEND_WANTED_TO_SEND', ' quiere que te enteres de este evento:');
define('_FRIEND_WAS_SENT_FROM', 'Este evento fue enviado desde ');
define('_FRIEND_EVENT_SENT', 'El evento ha sido enviado, Gracias!');

define('_VIEW_DAY_START_DATE', 'Fecha de Inicio:');
define('_UPDATE_EVENT', 'Actualizar Evento');
define('_FORM_CANCEL_LABEL', 'Cancelar');

define('_HEADER_GOTO_ADMIN', 'Administraci&oacute;n de GCalendar');
define('_FORM_RSVP_LABEL',    'RSVP:');
define('_FORM_RSVP_OFF',      'No RSVP');
define('_FORM_RSVP_ON',       'Permitir RSVP');
define('_FORM_RSVP_EMAIL',    'Permitir RSVP y enviarme un correo');

define('_VIEW_DAY_RSVP',            'Lista de RSVP:');
define('_GCAL_RSVP_EVENT',          'RSVP para este evento');
define('_GCAL_CANCEL_RSVP_EVENT',   'Cancelar RSVP');
define('_VIEW_DAY_EVENT_NUM',       '# del Evento');
define('_GCAL_RSVP_GREETING',       'Estimado ');
define('_GCAL_RSVP_END_GREETING',   ':');
define('_GCAL_RSVP_MESSAGE',        'Alguien ha actualizado su estado RSVP a un evento de los suyos.');
define('_GCAL_RSVP_USER',           'Usuario: ');
define('_GCAL_RSVP_ACTION',         'Acci&oacute;n: ');
define('_GCAL_RSVP_RSVP',           'RSVP Acceptado');
define('_GCAL_RSVP_CANCEL',         'RSVP Cancelado');
define('_GCAL_RSVP_EVENT_LINK',     'Enlace del Evento: ');

define('_GCAL_REPEAT_OPTIONS',         'Este es un evento repetido; deseas modificar:');
define('_GCAL_REPEAT_THIS_ONLY',       'Solo esta ocurrencia');
define('_GCAL_REPEAT_THIS_FUTURE',     'Esta y todas las futuras ocurrencias');
define('_GCAL_REPEAT_ALL_SAME_START',  'Todas las ocurrencias pero la fecha de inicio original de ');
define('_GCAL_REPEAT_ALL_NEW_START',   'Todos lss ocurrencias y cambiar la fecha de inicio como arriba');
define('_GCAL_REPEAT_NO_BRANCH_DATE',  'Este es un evento repetido; cualquier cambio se aplicar&aacute; a todas las ocurrencias');
?>