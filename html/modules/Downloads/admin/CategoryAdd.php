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
$pagetitle = _DL_CATEGORIESADMIN . ': ' . _DL_ADDCATEGORY;
include_once 'header.php';
title($pagetitle);
DLadminmain();
echo '<br />';
OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_NAME . ':</td><td><input type="text" name="title" size="50" maxlength="50" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PARENT . '</td><td><select name="cid"><option value="0" selected="selected">' . _DL_NONE . '</option>';
$result = $db->sql_query('SELECT `cid`, `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `parentid` = 0 ORDER BY `title`');
while ($cidinfo = $db->sql_fetchrow($result)) {
	$crawled = array($cidinfo['cid']);
	CrawlLevel($cidinfo['cid']);
	$x = 0;
	while ($x <= (sizeof($crawled) -1)) {
		list($title, $parentid) = $db->sql_fetchrow($db->sql_query('SELECT `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = \'' . $crawled[$x] . '\''));
		if ($x > 0) {
			$title = getparent($parentid, $title);
		}
		echo '<option value="' . $crawled[$x] . '">' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</option>';
		$x++;
	}
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><textarea name="cdescription" cols="50" rows="5"></textarea></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_WHOADD . ':</td><td><select name="whoadd">';
echo '<option value="-1">' . _DL_NONE . '</option>';
echo '<option value="0" selected="selected">' . _DL_ALL . '</option>';
echo '<option value="1">' . _DL_USERS . '</option>';
echo '<option value="2">' . _DL_ADMIN . '</option>';
$gresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while ($gidinfo = $db->sql_fetchrow($gresult)) {
	$gidinfo['gid'] = $gidinfo['gid']+2;
	echo '<option value="' . $gidinfo['gid'] . '">' . htmlspecialchars($gidinfo['gname'], ENT_QUOTES, _CHARSET) . ' ' . _DL_ONLY . '</option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_UPDIRECTORY . ':</td><td><input type="text" name="uploaddir" size="50" maxlength="255" /><br />(' . _DL_USEUPLOAD . ')</td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CANUPLOAD . ':</td><td><select name="canupload">';
echo '<option value="0">' . _DL_NO . '</option>';
echo '<option value="1">' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDCATEGORY . '" /></td></tr></table>';
echo '<input type="hidden" name="op" value="CategoryAddSave" />';
echo '</form>';
CloseTable();
include_once 'footer.php';

