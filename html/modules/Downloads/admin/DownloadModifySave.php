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
 * Validate / Cleanse user input
 */
$lid = isset($lid) ? intval($lid) : 0;
$min = isset($min) ? intval($min) : 0;
$cat = (isset($cat)) ? intval($cat) : 0;
$perm = (isset($perm)) ? intval($perm) : 2; // Just in case, default to Administrator only permissions
$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 100) : '';
$url = (isset($url)) ? substr(gdFilter($url, 'nohtml'), 0, 255) : null;
$description = (isset($description)) ? gdFilter($description, '') : '';
$dlname = (isset($dlname)) ? substr(gdFilter($dlname, 'nohtml'), 0, 100) : '';
$hits = (isset($hits)) ? intval($hits) : 0;
$version = (isset($version)) ? substr(gdFilter($version, 'nohtml'), 0, 20) : '';
$homepage = (isset($homepage)) ? substr(gdFilter($homepage, 'nohtml'), 0, 255) : '';
/*
 * @todo Following code to ensure only an integer filesize survives needs to be locale aware due to differences in 1000's separators
 */
$filesize = (isset($filesize)) ? gdFilter($filesize, 'nohtml') : 0;
$filesize = preg_replace('/[,]/', '', $filesize);
$filesize = intval($filesize);
/*
 * If we're in RavenNuke(tm), we can validate the email address (simple form, not fully RFC compliant)
 */
$email = (isset($email)) ? substr(gdFilter($email, 'nohtml'), 0, 100) : '';
if (function_exists('validate_email') && false === validate_email($email)) $email = '';
/*
 * Validate that required fields were entered: title, url, and description
 */
if (empty($title) || empty($url) || empty($description)) {
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center" class="title">';
	if (empty($title)) echo '<p>', _DL_ERRORNOTITLE, '</p>';
	if (empty($url)) echo '<p>', _DL_ERRORNOURL, '</p>';
	if (empty($description)) echo '<p>', _DL_ERRORNODESCRIPTION, '</p>';
	echo '<p>', _GOBACK, '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Validate a fully qualified URL that was passed is valid (note: does not validate local files are present)
 */
if (strstr($url, '://')) {
	if (!preg_match('#^(http(s?))://#i', $url)) {
		include_once 'header.php';
		title($pagetitle);
		DLadminmain();
		echo '<br />';
		OpenTable();
		echo '<div align="center"><p><strong>', _DL_INVALIDURL, '</strong></p>';
		echo '<p>', _GOBACK, '</p></div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
}
/*
 * Validate that URL does not already exist within the database
 */
$sql = 'SELECT `url` FROM `' . $prefix . '_nsngd_downloads` WHERE `url` = \'' . addslashes($url) . '\' AND `lid` != ' . $lid;
$numrows = $db->sql_numrows($db->sql_query($sql));
if ($numrows > 0) {
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p><strong>', _DL_ERRORURLEXIST, '</strong></p>';
	echo '<p>', _GOBACK, '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Time to update the download in the database.
 */
$sql = 'UPDATE `' . $prefix . '_nsngd_downloads` SET `cid` = ' . $cat . ', `sid` = ' . $perm . ', `title` = \''
	. addslashes($title) . '\', `url` = \'' . addslashes($url) . '\', `description` = \'' . addslashes($description)
	. '\', `name` = \'' . addslashes($dlname) . '\', `email` = \'' . addslashes($email) . '\', `hits` = '
	. $hits . ', `filesize` = ' . $filesize . ', `version` = \'' . addslashes($version) . '\', `homepage` = \''
	. addslashes($homepage) . '\' WHERE `lid` = ' . $lid;
$db->sql_query($sql);
Header('Location: ' . $admin_file . '.php?op=Downloads&min=' . $min);

