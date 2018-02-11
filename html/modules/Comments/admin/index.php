<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// admin/index.php - This file is part of Comments
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

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

global $prefix, $db, $admin_file, $currentlang;

$module_name = basename(dirname(dirname(__FILE__)));
$adminlangFile = 'modules/' . $module_name . '/admin/language/lang-' . $currentlang . '.php';
if (file_exists($adminlangFile)) {
	include_once $adminlangFile;
} else {
	include_once 'modules/' . $module_name . '/admin/language/lang-english.php';
}

$langFile = 'modules/' . $module_name . '/language/lang-' . $currentlang . '.php';
if (!file_exists($langFile)) {
	$langFile = 'modules/' . $module_name . '/language/lang-english.php';
}

if (is_mod_admin($module_name)) {
	$modPath = 'modules/' . $module_name . '/';
	include_once $langFile;
	require_once $modPath . 'FormFactory.php';
	require_once $modPath . 'Combo.php';
	require_once $modPath . 'HtmlList.php';

	///////////////////////////////////////////////////////////////////////

	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="title" align="center">' . _RNC_MODULE_TITLE . '</div>';
	CloseTable();
	echo '<br />';
	OpenTable();

	$source = isset($_POST['source']) ? $_POST['source'] : 'news';
	$factory = new RNComm_FormFactory($modPath);
	$form = $factory->create($source);
	$form->setFormAction($admin_file . '.php?op=rnc_comments');
	$form->enableAdmin();
	$form->display();

	CloseTable();
	include_once 'footer.php';
} else { // not authorized for admin access
	include 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center thick">' . _RNC_ADMIN_DENIED . '</div>';
	CloseTable();
	include 'footer.php';
}

?>
