<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('ADMIN_FILE')) die('Illegal File Access');
define('MSNL_LOADED', true);
define('NW_MSNL_LOADED', true); // This is here for compatibility purposes with v1.2 newsletters
$msnl_sModuleNm = 'HTML_Newsletter'; // If you change the module directory, change every instance of this definition
if (!isset($_POST['msnl_action']) || empty($_POST['msnl_action'])) $_POST['msnl_action'] = 'msnl_admin';
if (!isset($op)) $op = 'msnl_admin';
/************************************************************************
* Initialize and assign key module variables, including language defines.
************************************************************************/
global $db, $prefix, $currentlang, $language;
if (file_exists('modules/' . $msnl_sModuleNm . '/admin/language/lang-' . $currentlang . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/admin/language/lang-' . $currentlang . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/admin/language/lang-' . $language . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/admin/language/lang-' . $language . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/admin/language/lang-english.php')) { // Default module lang
	include_once 'modules/' . $msnl_sModuleNm . '/admin/language/lang-english.php';
}
require_once './modules/' . $msnl_sModuleNm . '/functions.php';
require_once './modules/' . $msnl_sModuleNm . '/config.php';
require_once './modules/' . $msnl_sModuleNm . '/admin/functions.php';
include_once './modules/' . $msnl_sModuleNm . '/style.php';
/************************************************************************
* Determine if the user is logged in as an admin / author.
* Moved here from ../config.php per: MSNL_010301_04
************************************************************************/
$aid = substr($aid, 0, 25);
$msnl_iAuthUser = false;
$sql = 'SELECT `name`, `radminsuper` FROM `' . $prefix . '_authors` WHERE `aid`=\'' . $aid . '\'';
$result = msnl_fSQLCall($sql);
$row = $db->sql_fetchrow($result);
if ($row['radminsuper'] == 1) { // No need to go any further - we have a super admin
	$msnl_iAuthUser = true;
} else { // Ok, do not have a super admin, so need to check for module admin
	if (defined('MSNL_PRE75_LOADED')) { // Need to do this the "old" way
		$sql = 'SELECT `name`, `radminsuper`, `radminnewsletter` FROM `' . $prefix . '_authors` WHERE `aid`=\'' . $aid . '\'';
		$result1 = msnl_fSQLCall($sql);
		$row1 = $db->sql_fetchrow($result1);
		if ($row1['radminsuper'] == 1 || $row1['radminnewsletter'] == 1) {
			$msnl_iAuthUser = true;
		}
	} else { // Do it the 75 and greater method
		$sql = 'SELECT `title`, `admins` FROM `' . $prefix . '_modules` WHERE `title`=\'' . $msnl_sModuleNm . '\'';
		$result1 = msnl_fSQLCall($sql);
		$row1 = $db->sql_fetchrow($result1);
		$msnl_asAdmins = explode(',', $row1['admins']);
		for ($i = 0;$i < sizeof($msnl_asAdmins);$i++) {
			if ($row['name'] == $msnl_asAdmins[$i] AND $row1['admins'] != '') {
				$msnl_iAuthUser = true;
			}
		}

	}
}
if ($msnl_iAuthUser) define('MSNL_ADMIN', true);
/************************************************************************
* Main "switch" code to control what the module is to do
************************************************************************/
include_once 'header.php';
$msnl_asHTML = msnl_fGetHTML(); //Get OpenTable and CloseTable HTML
$msnl_giHeadersSent = 1;
/*
 * If you are not an admin, no can do! You're outta here...
 */
if (!defined('MSNL_ADMIN')) { // User is not an author/admin, so kick them out of here
	GraphicAdmin();
	opentable();
	msnl_fRaiseAppError(_MSNL_ERR_NOTAUTHORIZED);
} else { // User is an admin, so let them Administer the module!
	msnl_fPrintHTML('BEGIN');
	require_once './modules/' . $msnl_sModuleNm . '/javascript.php';
	msnl_fMenuAdm();
	switch ($op) {
		case 'msnl_admin':
			if ($_POST['msnl_action'] == _MSNL_COM_LAB_SEND) {
				include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_send_mail.php';
			} else {
				include_once 'modules/' . $msnl_sModuleNm . '/admin/admin.php';
			}
			break;
		case 'msnl_admin_preview': include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_preview.php'; break;
		case 'msnl_admin_send_mail':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_send_mail.php';
			break;
		case 'msnl_admin_send_tested':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_send_tested.php';
			break;
		case 'msnl_cfg': include_once 'modules/' . $msnl_sModuleNm . '/admin/cfg.php'; break;
		case 'msnl_cfg_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/cfg_apply.php';
			break;
		case 'msnl_cat': include_once 'modules/' . $msnl_sModuleNm . '/admin/cat.php'; break;
		case 'msnl_cat_add': include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_add.php'; break;
		case 'msnl_cat_add_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_add_apply.php';
			break;
		case 'msnl_cat_chg': include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_chg.php'; break;
		case 'msnl_cat_chg_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_chg_apply.php';
			break;
		case 'msnl_cat_del': include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_del.php'; break;
		case 'msnl_cat_del_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/cat_del_apply.php';
			break;
		case 'msnl_nls': include_once 'modules/' . $msnl_sModuleNm . '/admin/nls.php'; break;
		case 'msnl_nls_chg': include_once 'modules/' . $msnl_sModuleNm . '/admin/nls_chg.php'; break;
		case 'msnl_nls_chg_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/nls_chg_apply.php';
			break;
		case 'msnl_nls_del': include_once 'modules/' . $msnl_sModuleNm . '/admin/nls_del.php'; break;
		case 'msnl_nls_del_apply':
			if (MSNL_ADMINCSRF_ON) csrf_check();
			include_once 'modules/' . $msnl_sModuleNm . '/admin/nls_del_apply.php';
			break;
	}
}
msnl_fPrintHTML('END');
include_once 'footer.php';

