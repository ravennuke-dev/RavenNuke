<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$xext = gdFilter(strtolower($xext), 'nohtml'); // Note the modification to lower!  Only need the pattern, not exact values.
/*
 * Check the file/image flag settings.  Do not allow both settings to be "No" or "Yes".
 */
$typeOK = true;
if ($xfile != 0 && $xfile != 1) $typeOK = false;
if ($ximage != 0 && $ximage != 1) $typeOK = false;
if ($xfile == $ximage) $typeOK = false;
if (!$typeOK) {
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSIONTYP . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Check for valid extension values
 */
if (!gdValidateExt($xext)) {
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSIONVAL . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Check to make sure the extension does not already exist
 */
$sql = 'SELECT * FROM `' . $prefix . '_nsngd_extensions` WHERE `ext` = \'' . addslashes($xext) . '\'';
$numrows = $db->sql_numrows($db->sql_query($sql));
if ($numrows > 0) {
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSION . ' ' . htmlspecialchars($xext, ENT_QUOTES, _CHARSET) . ' '
		. _DL_ALREADYEXIST . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}

/*
 * Finally add the extension
 */
$db->sql_query('INSERT INTO `' . $prefix . '_nsngd_extensions` VALUES (NULL, \'' . addslashes($xext) . '\', \''
	. $xfile . '\', \'' . $ximage . '\')');

Header('Location: ' . $admin_file . '.php?op=Extensions');

