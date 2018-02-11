<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// case.php - This file is part of GCalendar
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
// case.php - Admin case file for GCalendar
///////////////////////////////////////////////////////////////////////

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

switch ($op) {
	case 'gcalendar':
	case 'gcal_about':
	case 'gcal_add':
	case 'gcal_adding_event':
	case 'gcal_cat':
	case 'gcal_config':
	case 'gcal_del_conf':
	case 'gcal_del_event':
	case 'gcal_del_rsvp':
	case 'gcal_del_select':
	case 'gcal_edit':
	case 'gcal_edit_event':
	case 'gcal_edit_rsvp':
	case 'gcal_groups':
	case 'gcal_mod_cat':
	case 'gcal_purge':
	case 'gcal_save_config':
	case 'gcal_update_event':
	case 'gcal_view_event':
		include_once 'modules/GCalendar/admin/index.php';
		break;
}

?>