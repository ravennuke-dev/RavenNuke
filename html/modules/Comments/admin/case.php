<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// admin/case.php - This file is part of Comments
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

if (!defined('ADMIN_FILE'))
{
	die('Access Denied');
}

switch ($op)
{
   case 'rnc_comments':
      include('modules/Comments/admin/index.php');
      break;
}

?>
