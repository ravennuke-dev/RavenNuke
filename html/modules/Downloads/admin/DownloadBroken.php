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
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DUSERREPBROKEN;
include_once 'header.php';
$sql = 'SELECT a.`lid` AS lid, `modifier`, a.`name` AS name, a.`sub_ip` AS sub_ip, b.`url` AS url, b.`title` AS title FROM `'
	. $prefix . '_nsngd_mods` a, `' . $prefix . '_nsngd_downloads` b WHERE `brokendownload` = 1 AND a.`lid` = b.`lid` ORDER BY `rid`';
$result = $db->sql_query($sql);
$totalbroken = $db->sql_numrows($result);
title($pagetitle . ' (' . $totalbroken . ')');
DLadminmain();
echo '<br />';
OpenTable();
echo '<p align="center">' . _DL_DIGNOREINFO . '<br />' . _DL_DDELETEINFO . '</p>';
echo '<table align="center" width="80%" cellpadding="2" cellspacing="0">';
if ($totalbroken == 0) {
	echo '<tr><td align="center"><strong>' . _DL_DNOREPORTEDBROKEN . '</strong></td></tr>';
} else {
	$colorswitch = $bgcolor2;
	echo '<tr>';
	echo '<td><strong>' . _DL_DOWNLOAD . '</strong></td>';
	echo '<td><strong>' . _DL_URL . '</strong></td>';
	echo '<td><strong>' . _DL_SUBMITTER . '</strong></td>';
	echo '<td><strong>' . _DL_DOWNLOADOWNER . '</strong></td>';
	echo '<td><strong>' . _DL_SUBIP . '</strong></td>';
	echo '<td><strong>' . _DL_IGNORE . '</strong></td>';
	echo '<td><strong>' . _DL_DELETE . '</strong></td>';
	echo '<td><strong>' . _DL_EDIT . '</strong></td>';
	echo '</tr>';
	while ($ridinfo = $db->sql_fetchrow($result)) {
		list($memail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($ridinfo['modifier']) . '\''));
		list($oemail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($ridinfo['name']) . '\''));
		echo '<tr><td bgcolor="' . $colorswitch . '">' . htmlspecialchars($ridinfo['title'], ENT_QUOTES, _CHARSET)
			. '</td><td bgcolor="' . $colorswitch . '">';
		/*
		 * Do some basic URL checking and only present a link around a truly valid external URL.
		 */
		if (preg_match('#^(http(s?))://#i', $ridinfo['url'])) {
			echo '<a href="' . $ridinfo['url'] . '">' . htmlspecialchars($ridinfo['title'], ENT_QUOTES, _CHARSET) . '</a>';
		} else {
			echo htmlspecialchars($ridinfo['url'], ENT_QUOTES, _CHARSET);
		}
		echo '</td><td bgcolor="' . $colorswitch . '">';
		if (empty($memail)) {
			echo $ridinfo['modifier'];
		} else {
			echo '<a href="mailto:' . $memail . '">' . $ridinfo['modifier'] . '</a>';
		}
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '">';
		if (empty($oemail)) {
			echo $ridinfo['name'];
		} else {
			echo '<a href="mailto:' . $oemail . '">' . $ridinfo['name'] . '</a>';
		}
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '">';
		echo $ridinfo['sub_ip'];
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadBrokenIgnore&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadBrokenDelete&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModify&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '</tr>';
		if ($colorswitch == $bgcolor2) {
			$colorswitch = $bgcolor1;
		} else {
			$colorswitch = $bgcolor2;
		}
	}
}
echo '</table>';
CloseTable();
include_once 'footer.php';

