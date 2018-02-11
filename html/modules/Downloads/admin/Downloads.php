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
$pagetitle = _DL_DOWNLOADSADMIN;
include_once 'header.php';
title($pagetitle);
DLadminmain();
echo '<br />';
OpenTable();
$perpage = $dl_config['admperpage'];
$min = isset($min) ? intval($min) : 0;
$max = isset($max) ? intval($max) : $max = $min + $perpage;
$totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads`'));
if ($min > $totalselected) $min = 0; // Protect against malformed requests
pagenums_admin($op, $totalselected, $perpage, $max);
echo '<table style="color:'. $textcolor1 . ';" align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr bgcolor="' . $bgcolor2 . '"><td align="center"><strong>' . _DL_ID . '</strong></td><td><strong>' . _DL_TITLE
	. '</strong></td><td align="right"><strong>' . _DL_FILESIZE . '</strong></td>';
echo '<td align="center"><strong>' . _DL_ADDED . '</strong></td><td align="center"><strong>' . _DL_HITS
	. '</strong></td><td align="center"><strong>' . _DL_FUNCTIONS . '</strong></td></tr>';
$x = 0;
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` ORDER BY `title` LIMIT ' . $min . ',' . $perpage);
while ($lidinfo = $db->sql_fetchrow($result)) {
	echo '<tr bgcolor="' . $bgcolor1 . '">';
	echo '<td align="center">' . $lidinfo['lid'] . '</td>';
	echo '<td>' . htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '</td>';
	echo '<td align="right">' . CoolSize($lidinfo['filesize']) . '</td>';
	echo '<td align="center">' . CoolDate($lidinfo['date']) . '</td>';
	echo '<td align="center">' . $lidinfo['hits'] . '</td>';
	echo '<td align="left"><form method="post" action="' . $admin_file . '.php">';
	echo '<select name="op"><option value="DownloadModify" selected="selected">' . _DL_MODIFY . '</option>';
	if ($lidinfo['active'] == 1) {
		echo '<option value="DownloadDeactivate">' . _DL_DEACTIVATE . '</option>';
	} else {
		echo '<option value="DownloadActivate">' . _DL_ACTIVATE . '</option>';
	}
	echo '<option value="DownloadDelete">' . _DL_DELETE . '</option></select> ';
	echo '<input type="hidden" name="lid" value="' . $lidinfo['lid'] . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="submit" value="' . _DL_OK . '" />';
	echo '</form></td></tr>';
	$x++;
}
echo '</table>';
pagenums_admin($op, $totalselected, $perpage, $max);
CloseTable();
include_once 'footer.php';

