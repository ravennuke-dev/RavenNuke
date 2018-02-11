<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// index.php - This file is part of Comments
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
// index.php is the default module entry point; it displays a form
// to choose comment types and selected comments.
//
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE'))
{
   die('You can\'t access this file directly...');
}
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$modPath = 'modules/' . $module_name . '/';
require_once $modPath . 'FormFactory.php';
require_once $modPath . 'Combo.php';
require_once $modPath . 'HtmlList.php';

///////////////////////////////////////////////////////////////////////

include_once 'header.php';
OpenTable();
echo '<div class="title" align="center">' . _RNC_MODULE_TITLE . '</div>';
CloseTable();
echo '<br />';
OpenTable();

$source = isset($_POST['source']) ? $_POST['source'] : 'news';
$factory = new RNComm_FormFactory($modPath);
$form = $factory->create($source);
$form->setFormAction('modules.php?name=' . $module_name);
$form->display();

CloseTable();
include_once 'footer.php';

?>
