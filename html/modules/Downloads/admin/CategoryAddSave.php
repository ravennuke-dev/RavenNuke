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
/*
 * Do some basic data cleansing/validation first
 */
$cid = isset($cid) ? intval($cid) : 0;
$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 50) : '';
$cdescription = (isset($cdescription)) ? addslashes(gdFilter($cdescription, '')) : '';
$whoadd = (isset($whoadd)) ? intval($whoadd) : 0;
// @todo: should we really allow uploads outside a user account? (can you trust your admins?)
$uploaddir = (isset($uploaddir)) ? addslashes(substr(gdFilter($uploaddir, 'nohtml'), 0, 255)) : '';
$canupload = (isset($canupload)) ? intval($canupload) : 0;
/*
 * Then check if the particular sub-category already exists under the parent category.
 */
$sql = 'SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `title` = \'' . addslashes($title) . '\' AND `parentid` = ' . $cid;
$numrows = $db->sql_numrows($db->sql_query($sql));
if ($numrows > 0) {
	$pagetitle = _DL_CATEGORIESADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHESUBCATEGORY . ' ' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . ' '
		. _DL_ALREADYEXIST . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable();
	include_once 'footer.php';
}
$sql = 'INSERT INTO `' . $prefix . '_nsngd_categories` VALUES (NULL, \'' . addslashes($title) . '\', \'' . $cdescription . '\', \''
	. $cid . '\', \'' . $whoadd . '\', \'' . $uploaddir . '\', \'' . $canupload . '\', 1)';
$db->sql_query($sql);
Header('Location: ' . $admin_file . '.php?op=Categories');

