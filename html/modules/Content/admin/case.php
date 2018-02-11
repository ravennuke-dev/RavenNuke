<?php
/*      Content Plus for RavenNuke(tm): /admin/case.php
 *      Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 * 		Join me at http://slaytanic.sourceforge.net
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if (!defined('ADMIN_FILE')) { die ('Access Denied'); }
$module_name = basename(dirname(dirname(__FILE__)));

if(file_exists(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$currentlang.'.php')) {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$currentlang.'.php');
} elseif(file_exists(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$language.'.php')) {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$language.'.php');
} else {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-english.php');
}

switch($op) {
    case 'ContentPlus':
    case 'CPListPages':
    case 'CPListCats':
    case 'CPListPagesCat':
    case 'CPAddCategory':
    case 'CPAddPage':
    case 'CPPagesWaiting':
    case 'CPEdit':
    case 'CPDelete':
    case 'CPNewPageDelete':
    case 'content_review':
    case 'CPSave':
    case 'CPSaveEdit':
    case 'CPChangeStatus':
    case 'CPNewPageChangeStatus':
    case 'CPCategoryAddSave':
    case 'CPAddNewPage':
    case 'CPEditCat':
    case 'CPSaveCat':
    case 'CPDeleteCat':
    case 'CPFeat':
    case 'CPFeatSave':
	case 'CPAbout':
	case 'content':
	case 'CPShowCatImages':
    include('modules/'.$module_name.'/admin/index.php');
    break;
}
?>