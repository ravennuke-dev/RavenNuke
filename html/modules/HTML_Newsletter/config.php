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
if (!defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE')) {
	die('Illegal File Access');
}
global $admin_file, $aid, $prefix, $db, $admin, $user;
if (!isset($admin_file) || $admin_file == '') {
	$admin_file = 'admin';
}
/************************************************************************
* Initialization and assignment of key "global" variables and CONSTANTS
************************************************************************/
unset($result);
unset($resultcount);
$msnl_asRec = array();     // Used for capturing cleansed DB field values
$msnl_asHTML = array();    // Used for storing bits of HTML code for later use
$msnl_asHREF = array();    // Used for storing strings of href/src links
$msnl_asTIT = array();     // Used for storing link/graphic alt and title text
$msnl_asERR = array();     // Used for an error message "stack" in validation routines
$msnl_asWARN = array();    // Used for an warning message "stack" in validation routines
$msnl_gasModCfg = array(); // Used to store module configuration data
$msnl_giHeadersSent = 0;
$msnl_gasUserInfo = getusrinfo($user);
$msnl_giUid = $msnl_gasUserInfo['user_id'];
$msnl_gsUserName = $msnl_gasUserInfo['username'];
define('MSNL_OFF', 'OFF');           // Do NOT Change - debugging will break if you do!
define('MSNL_ERROR', 'ERROR');       // Do NOT Change - debugging will break if you do!
define('MSNL_VERBOSE', 'VERBOSE');   // Do NOT Change - debugging will break if you do!
define('MSNL_BOTH', 'BOTH');         // Do NOT Change - debugging will break if you do!
define('MSNL_DISPLAY', 'DISPLAY');   // Do NOT Change - debugging will break if you do!
define('MSNL_LOGFILE', 'LOGFILE');   // Do NOT Change - debugging will break if you do!
define('MSNL_SEPARATOR_MAJOR', '|');
define('MSNL_SEPARATOR_MINOR', '=');
define('MSNL_MAX_STRING', 255);
define('MSNL_DEFAULT_BLOCKLMT', 5);
define('MSNL_SHOW_ALL_ON', 1);
define('MSNL_SHOW_ALL_OFF', 0);
define('MSNL_MAX_BATCH_SIZE', 500);
define('MSNL_MAX_ADHOC_SIZE', 1000);
define('MSNL_ADMINHTML_OVERRIDE', false); // Set this to "true" if you want to bypass checks against AllowableHTML[] array (i.e., anything goes in the body)
define('MSNL_ADMINCSRF_ON', true); // Set this to "false" if you have troubles with CSRF time-outs (just understand you then open yourself up to CSRF exploits)
/************************************************************************
* Get module configuration variables
************************************************************************/
$msnl_gasModCfg = msnl_fGetModCfg();
msnl_fDebugMsg($msnl_gasModCfg);
/************************************************************************
* Determine if the user is logged in as an admin / author.
* Moved to admin/index.php per: MSNL_010301_04
************************************************************************/
/**
 * Determine if PHP is running in CGI mode vs. as an Apache module
 */
if (strpos(strtolower(php_sapi_name()), 'cgi') === true) define('TNNL_PHP_NOT_CGI', false); else define('TNNL_PHP_NOT_CGI', true);
/**
 * Determine if we are running under RavenNuke(tm) - is used later for certain functions/features
 */
if (defined('RAVENNUKE_VERSION') || @file_exists('rnconfig.php')) {
	define('IN_RAVENNUKE', true);
} else {
	define('IN_RAVENNUKE', false);
}
/*
 * If nukeWYSIWYG is installed and enabled, we'll use it.  The following constant is for that purpose
 */
if (!defined('NUKEWYSIWYG_ACTIVE')) {
	if (function_exists('wysiwyg_textarea') && isset($advanced_editor) && 1 == $advanced_editor && $msnl_gasModCfg['wysiwyg_on'] == 1) {
		define('NUKEWYSIWYG_ACTIVE', true);
	} else {
		define('NUKEWYSIWYG_ACTIVE', false);
	}
}

