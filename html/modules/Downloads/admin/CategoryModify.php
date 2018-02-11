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
$pagetitle = _DL_CATEGORIESADMIN;
/*
 * Just do some simple initial sanity checks:
 * 1. Check for valid category id.
 * 2. Does that ID exist in the database.
 * If not, out-of-here.  I know, I know, if you can't trust your admins...
 */
$cid = isset($cid) ? intval($cid) : 0;
$sql = 'SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $cid;
if ($cid == 0 || !($cidinfo = $db->sql_fetchrow($db->sql_query($sql)))) {
	$min = isset($min) ? intval($min) : 0;
	Header('Location: ' . $admin_file . '.php?op=Categories&min=' . $min);
}
/*
 * Ok, all set to continue
 */
include_once 'header.php';
title(_DL_CATEGORIESADMIN);
DLadminmain();
echo '<br />';
OpenTable();
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><strong>' . _DL_MODCATEGORY . '</strong></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_NAME . ':</td><td><input type="text" name="title" value="' . htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="50" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><textarea name="cdescription" cols="50" rows="10">' . htmlspecialchars($cidinfo['cdescription'], ENT_QUOTES, _CHARSET) . '</textarea></td></tr>';
$sel0 = $sel1 = $sel2 = $sel3 = '';
if ($cidinfo['whoadd'] == -1) {
	$sel0 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 0) {
	$sel1 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 1) {
	$sel2 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 2) {
	$sel3 = ' selected="selected"';
}
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_WHOADD . ':</td><td><select name="whoadd">';
echo '<option value="-1"' . $sel0 . '>' . _DL_NONE . '</option>';
echo '<option value="0"' . $sel1 . '>' . _DL_ALL . '</option>';
echo '<option value="1"' . $sel2 . '>' . _DL_USERS . '</option>';
echo '<option value="2"' . $sel3 . '>' . _DL_ADMIN . '</option>';
$gresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while ($gidinfo = $db->sql_fetchrow($gresult)) {
	$gidinfo['gid'] = $gidinfo['gid'] + 2;
	if ($gidinfo['gid'] == $cidinfo['whoadd']) {
		$selected = ' selected="selected"';
	} else {
		$selected = '';
	}
	echo '<option value="' . $gidinfo['gid'] . '"' . $selected . '>' . htmlspecialchars($gidinfo['gname'], ENT_QUOTES, _CHARSET)
		. ' ' . _DL_ONLY . '</option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_UPDIRECTORY . ':</td><td><input type="text" name="uploaddir" value="'
	. htmlspecialchars($cidinfo['uploaddir'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="255" /></td></tr>';
$sel0 = $sel1 = '';
if ($cidinfo['canupload'] == 0) {
	$sel0 = ' selected="selected"';
} elseif ($cidinfo['canupload'] == 1) {
	$sel1 = ' selected="selected"';
}
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CANUPLOAD . ':</td><td><select name="canupload">';
echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SAVECHANGES . '" /></td></tr></table>';
echo '<input type="hidden" name="cid" value="' . $cid . '" />';
echo '<input type="hidden" name="op" value="CategoryModifySave" /></form>';
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETE . '" /></td></tr></table>';
echo '<input type="hidden" name="cid" value="' . $cid . '" />';
echo '<input type="hidden" name="op" value="CategoryDelete" /></form>';
CloseTable();
include_once 'footer.php';

