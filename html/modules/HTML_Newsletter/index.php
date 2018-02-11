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
/************************************************************************
* Ensure that the module is not being called directly and then set up
* application level define that is used throughout the module to ensure
* no script is called outside of THIS index.php script.
************************************************************************/
if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}
define('MSNL_LOADED', true);
define('NW_HNL_LOADED', true); // This is here for compatibility purposes with v1.2 newsletters
$msnl_sModuleNm = 'HTML_Newsletter'; // If you change the module directory, change every instance of this definition
/************************************************************************
* Initialize and assign key module variables, including language defines.
************************************************************************/
global $index, $msnl_gasModCfg, $currentlang, $language;
if (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-' . $currentlang . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-' . $currentlang . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-' . $language . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-' . $language . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-english.php')) { // Default module lang
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-english.php';
}
require_once 'modules/' . $msnl_sModuleNm . '/functions.php';
require_once 'modules/' . $msnl_sModuleNm . '/config.php';
require_once 'modules/' . $msnl_sModuleNm . '/style.php';
if ($msnl_gasModCfg['show_blocks'] == 1) {
	$index = 1; // Here for compatibility with patches below 3.1
	define('INDEX_FILE', true); // Here for a nuke patched 3.1+

} else {
	$index = 0;
}
require_once 'mainfile.php';
/************************************************************************
* Main "switch" code to control what the module is to do
************************************************************************/
if (!isset($op)) $op = '';
switch ($op) {
	case 'msnl_nls_view':
		include_once('modules/' . $msnl_sModuleNm . '/nls_view.php');
		break;
	case 'msnl_copyright_credits':
		include_once('modules/' . $msnl_sModuleNm . '/copyright_credits.php');
		break;
	default:
		include_once('modules/' . $msnl_sModuleNm . '/nls_list.php');
		break;
}

