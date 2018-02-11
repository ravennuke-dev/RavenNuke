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
$eid = isset($eid) ? intval($eid) : 0;
$pagetitle = _DL_EXTENSIONSADMIN;
include_once 'header.php';
title(_DL_EXTENSIONSADMIN);
DLadminmain();
echo '<br />';
OpenTable();
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_extensions` WHERE `eid` = ' . $eid);
if ($db->sql_numrows($result) > 0) {
	$eidinfo = $db->sql_fetchrow($result);
	echo '<form action="' . $admin_file . '.php" method="post">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td align="center" colspan="2"><strong>' . _DL_MODEXTENSION . '</strong></td></tr>';
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_EXT . ':</td><td><input type="text" name="xext" value="' . $eidinfo['ext'] . '" size="10" maxlength="6" /></td></tr>';
	$sel0 = $sel1 = '';
	if ($eidinfo['file'] == 0) {
		$sel0 = ' selected="selected"';
	} elseif ($eidinfo['file'] == 1) {
		$sel1 = ' selected="selected"';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILETYPE . ':</td><td><select name="xfile">';
	echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
	echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
	echo '</select></td></tr>';
	$sel0 = $sel1 = '';
	if ($eidinfo['image'] == 0) {
		$sel0 = ' selected="selected"';
	} elseif ($eidinfo['image'] == 1) {
		$sel1 = ' selected="selected"';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_IMAGETYPE . ':</td><td><select name="ximage">';
	echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
	echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
	echo '</select></td></tr>';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SAVECHANGES . '" /></td></tr></table>';
	echo '<input type="hidden" name="eid" value="' . $eid . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="op" value="ExtensionModifySave" />';
	echo '</form>';
	echo '<form action="admins.php" method="post">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETE . '" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="eid" value="' . $eid . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="op" value="ExtensionDelete" />';
	echo '</form>';
} else {
	echo '<p>', _ACCESSDENIED, '</p>';
}
CloseTable();
include_once 'footer.php';

