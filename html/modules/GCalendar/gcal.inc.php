<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// gcal.inc.php - This file is part of GCalendar
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
// gcal.inc.php - contains global constants for GCalendar
//
///////////////////////////////////////////////////////////////////////

// module name; must match the name of the directory under modules/

define('GCAL_MOD_NAME', 'GCalendar');
define('GCAL_MOD_LINK', 'modules.php?name=' . GCAL_MOD_NAME);

// database table names:

define('GCAL_CAT_TABLE', '_gcal_category');
define('GCAL_CONF_TABLE', '_gcal_config');
define('GCAL_EVENT_TABLE', '_gcal_event');
define('GCAL_RSVP_TABLE', '_gcal_rsvp');
define('GCAL_EXCEPT_TABLE', '_gcal_exception');
define('GCAL_CAT_GROUP_TABLE', '_gcal_cat_group');

?>