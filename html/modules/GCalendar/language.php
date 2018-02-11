<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// language.php - This file is part of GCalendar
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
// The get_lang function in many Nukes doesn't fall back to English if it can't
// find the language file it wants. I'd rather do that than make a copy of the English language
// files for each language (as is usually done in Nuke...)
//
function gcalGetLang($module, $admin = false) {
	gcalDoGetLang($module);

	if ($admin) {
		gcalDoGetLang($module . '/admin');
	}
}

function gcalDoGetLang($module) {
	global $currentlang, $language;

	$currLang = 'modules/' . $module. '/language/lang-' . $currentlang . '.php';
	if (file_exists($currLang)) {
		include_once $currLang;
		return;
	}

	$lang = 'modules/' . $module. '/language/lang-' . $language . '.php';
	if (file_exists($lang)) {
		include_once $lang;
		return;
	}

	// fall back to English

	if (file_exists('modules/' . $module. '/language/lang-english.php')) {
		include_once $lang = 'modules/' . $module. '/language/lang-english.php';
	}
}

?>