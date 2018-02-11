<?php

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/************************************************************************/
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/************************************************************************/

if (!defined('ADMIN_FILE')) die ('Access Denied');

require_once 'mainfile.php';
global $prefix, $db, $aid, $admin_file;


$lgl_isAdmin = is_mod_admin($lgl_modName);
if ($lgl_isAdmin) {
	define('LGL_LOADED', true);
} else {
	die('Access Denied');
}
/*
 * Get the module configuration information
 */
$lgl_modName = basename(dirname(dirname(__FILE__)));
$lgl_modPath = 'modules/' . $lgl_modName . '/admin/';
require_once $lgl_modPath . '../config.php';
/*
 * Start of main controller logic
 */
if (!isset($op)) $op = 'legal';

switch($op) {
	case 'rn_lgl_doc_add': include $lgl_modPath . 'doc_add.php'; break;
	case 'rn_lgl_doc_add_apply': csrf_check(); include $lgl_modPath . 'doc_add_apply.php'; break;
	case 'rn_lgl_doc_del': include $lgl_modPath . 'doc_delete.php'; break;
	case 'rn_lgl_doc_del_confirm': csrf_check(); include $lgl_modPath . 'doc_delete_confirm.php'; break;
	case 'rn_lgl_doc_edit': include $lgl_modPath . 'doc_edit.php'; break;
	case 'rn_lgl_doc_edit_apply': csrf_check(); include $lgl_modPath . 'doc_edit_apply.php'; break;
	case 'rn_lgl_doc_status': csrf_check(); include $lgl_modPath . 'doc_status.php'; break;
	case 'rn_lgl_doc_view': include $lgl_modPath . 'doc_view.php'; break;
	case 'rn_lgl_cfg': include $lgl_modPath . 'cfg.php'; break;
	case 'rn_lgl_cfg_apply': csrf_check(); include $lgl_modPath . 'cfg_apply.php'; break;
	case 'legal': include $lgl_modPath . 'doc_list.php'; break;
	default: include $lgl_modPath . 'doc_list.php'; break;
}

die();

/*
 * Commonly used functions are below here.
 */

function lgl_displayMenu()
{
	global $admin_file, $lgl_lang, $lgl_version, $lgl_url;
	OpenTable();
	echo '<div align="center"><span class="title">'.$lgl_lang['LGL_ADM_COM_MODTITLE'].' - ' . $lgl_version . '</span><br /><br />'
		. '[&nbsp;<a href="' . $lgl_url . 'legal">' . $lgl_lang['LGL_ADM_COM_DOCS'].'</a>&nbsp;|'
		. ' <a href="' . $lgl_url . 'rn_lgl_doc_add">' . $lgl_lang['LGL_ADM_COM_ADDDOC'].'</a>&nbsp;|'
		. ' <a href="' . $lgl_url . 'rn_lgl_cfg">' . $lgl_lang['LGL_ADM_COM_GENOPTS'].'</a>&nbsp;|'
		. ' <a href="'.$admin_file.'.php">' . $lgl_lang['LGL_ADM_COM_SITEADMIN'].'</a>&nbsp;]'
		. '</div>';
	CloseTable();
}

function lgl_goBack($message='', $op='')
{
	global $lgl_lang, $admin_file, $lgl_url;
	echo '<p align="center"><strong>' . $message . '</strong><br /><br />';
	if (isset($op[1])) {
		echo '<a href="' . $lgl_url . $op . '">';
	} else {
		echo '<a href="javascript:history.go(-1)">';
	}
	echo $lgl_lang['LGL_ADM_COM_GOBACK'] . '</a></p>';
}

function lgl_getLangList()
{
	global $lgl_langS, $lgl_modPath, $language, $multilingual;
	$langList = array();
	$s = '';
	if ($multilingual == 1) {
		$handle = opendir($lgl_modPath . '../language');
		while ($file = readdir($handle)) {
			if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
				$s .= $matches[1] . ' ';
			}
		}
		closedir($handle);
		$langList = explode(' ', $s);
		sort($langList);
		unset($langList[0]);
	} else {
		$langList[1] = $language;
	}
	return $langList;
}

function lgl_getLangSelect($langList)
{
	global $lgl_langS;
	$j = sizeof($langList);
	$s = '<select name="lgl_language">';
	for ($i = 1; $i <= $j; $i++)
	{
		if ($langList[$i] != '') {
			$s .= '<option value="' . $langList[$i] . '" ';
			if ($langList[$i ] == $lgl_langS) {
				$s .= ' selected="selected"';
			}
			$s .= '>' . ucfirst($langList[$i]) . '</option>';
		}
	}
	$s .= '</select>';
	return $s;
}

function lgl_getButtonHTML($buttonList='', $opPrefix='rn_lgl_doc_')
{
	global $lgl_lang, $lgl_cfg, $lgl_url;
	$s = '';
	$langPrefix = 'LGL_ADM_COM_';
	// Make sure the list is an array
	if (!is_array($buttonList)) {
		$buttonList = array($buttonList);
	}
	// If was passed a valid action button, append it
	foreach ($buttonList as $value)
	{
		if (!in_array($value, $lgl_cfg['lgl_doc_actions'])) continue;
		$langIndex = $langPrefix . strtoupper($value);
		$s .= '<input type="button" value="' . $lgl_lang[$langIndex]
			. '" onclick="javascript:lgl_submitFrm(\'' . $opPrefix . strtolower($value) . '\');" />&nbsp;';
	}
	return $s;
}

function lgl_raiseMsg($msg)
{
	$s = '<p align="center"><strong>' . $msg . '</strong></p>';
	echo $s;
	return;
}

function lgl_raiseError($msg)
{
	lgl_goBack($msg);
	CloseTable();
	include_once 'footer.php';
	die();
}

?>