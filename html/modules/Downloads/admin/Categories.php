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
include_once 'header.php';
title($pagetitle);
DLadminmain();
echo '<br />';
OpenTable();
$perpage = $dl_config['admperpage'];
if (!isset($min)) $min = 0;
if (!isset($max)) $max = $min+$perpage;
$totalselected = $db->sql_numrows($db->sql_query('SELECT `cid` FROM `' . $prefix . '_nsngd_categories`'));
if ($min > $totalselected) $min = 0; // Protect against malformed requests
pagenums_admin($op, $totalselected, $perpage, $max);
echo '<table style="color:'. $textcolor1 . ';" align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr bgcolor="' . $bgcolor2 . '"><td align="center"><strong>' . _DL_ID . '</strong></td><td><strong>' . _DL_TITLE . '</strong> (' . _DL_ACTIVE_Y
	. '/' . _DL_ACTIVE_N . ')</td>';
echo '<td align="center"><strong>' . _DL_FUNCTIONS . '</strong></td>' . '</tr>';
$x = 0;
/*
 * This SQL was enhanced significantly to pull all in one shot not only the list of categories, but also the
 * counts of active and inactive downloads for a more complete picture to the admin what is "sitting" underneath
 * each of their download categories.  These are single-level counts.
 */
$sql = 'SELECT a.`cid`, a.`title`, a.`parentid`, a.`active`, b.`acnt`, b.`icnt` FROM `' . $prefix . '_nsngd_categories` a LEFT JOIN '
	. '(SELECT s1.`cid`, SUM(s1.`acnt`) AS acnt, SUM(s1.`icnt`) AS icnt FROM (SELECT `cid`, COUNT(`lid`) AS acnt, 0 AS icnt FROM `'
	. $prefix . '_nsngd_downloads` WHERE `active` > 0 GROUP BY `cid` UNION ALL SELECT `cid`, 0 AS acnt, COUNT(`lid`) AS icnt FROM `'
	. $prefix . '_nsngd_downloads` WHERE `active` = 0 GROUP BY `cid`) s1 GROUP BY s1.`cid`) b ON (a.`cid` = b.`cid`) ORDER BY `parentid`, `title`';
$result = $db->sql_query($sql);
while ($cidinfo = $db->sql_fetchrow($result)) {
	$acnt = empty($cidinfo['acnt']) ? 0 : intval($cidinfo['acnt']);
	$icnt = empty($cidinfo['icnt']) ? 0 : intval($cidinfo['icnt']);
	echo '<tr bgcolor="' . $bgcolor1 . '">';
	$cidtitle = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET);
	$cidtitle = getparent($cidinfo['parentid'], $cidtitle);
	echo '<td align="center">' . $cidinfo['cid'] . '</td>';
	echo '<td>' . $cidtitle . ' (' . $acnt . '/' . $icnt . ')</td>';
	echo '<td align="left">';
	echo '<form method="post" action="' . $admin_file . '.php">';
	echo '<select name="op"><option value="CategoryModify" selected="selected">' . _DL_MODIFY . '</option>';
	if ($cidinfo['active'] == 1) {
		echo '<option value="CategoryDeactivate">' . _DL_DEACTIVATE;
	} else {
		echo '<option value="CategoryActivate">' . _DL_ACTIVATE;
	}
	echo '</option><option value="CategoryDelete">' . _DL_DELETE . '</option></select> ';
	echo '<input type="submit" value="' . _DL_OK . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="cid" value="' . $cidinfo['cid'] . '" />';
	echo '</form></td></tr>';
	$x++;
}
echo '</table>';
pagenums_admin($op, $totalselected, $perpage, $max);
CloseTable();
include_once 'footer.php';

