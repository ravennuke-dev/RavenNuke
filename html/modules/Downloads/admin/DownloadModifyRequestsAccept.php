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
$rid = isset($rid) ? intval($rid) : 0;
$sql = 'SELECT `rid`, `lid`, `cid`, `sid`, `title`, `url`, `description`, `name`, `email`, `filesize`, `version`, `homepage` FROM `'
	. $prefix . '_nsngd_mods` WHERE `rid` = ' . $rid;
$result = $db->sql_query($sql);
while (list($rid, $lid, $cid, $sid, $title, $url, $description, $aname, $email, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
	/*
	 * Since the URL is not displayed, it is possible for someone to not enter anything into the URL field
	 * and therefore it ends up blanking out the original URL.  Therefore, check for this condition and just
	 * not update the url field.
	 */
	$sql = 'UPDATE `' . $prefix . '_nsngd_downloads` SET `cid` = ' . (int)$cid . ', `sid` = ' . (int)$sid . ', `title` = \''
		. addslashes($title) . '\', `description` = \'' . addslashes($description) . '\', `name` = \'' . addslashes($aname)
		. '\', `email` = \'' . addslashes($email) . '\', `filesize` = \'' . addslashes($filesize) . '\', `version` = \''
		. addslashes($version) . '\', `homepage` = \'' . addslashes($homepage) . '\'';
	if (!empty($url)) {
		$sql .=  ', `url` = \'' . $url . '\'';
	}
	$sql .=  ' WHERE `lid` = ' . (int)$lid;
	$db->sql_query($sql);
	$db->sql_query('DELETE FROM `' . $prefix . '_nsngd_mods` WHERE `rid` = ' . $rid);
	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngd_mods`');
}
Header('Location: ' . $admin_file . '.php?op=DownloadModifyRequests');

