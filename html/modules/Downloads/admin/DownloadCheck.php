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
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION;
include_once 'header.php';
title(_DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION);
DLadminmain();
echo '<br />';
OpenTable();
echo '<div align="center">';
echo '<p><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadValidate&amp;cid=0">' . _DL_CHECKALLDOWNLOADS . '</a></p>';
echo '<p><strong>' . _DL_CHECKCATEGORIES . '</strong><br />' . _DL_INCLUDESUBCATEGORIES . '</p>';
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` ORDER BY `parentid`, `title`');
if ($db->sql_numrows($result) > 0) {
	echo '<ul style="list-style-type:none;padding-left:0;">';
	while ($cidinfo = $db->sql_fetchrow($result)) {
		$cidtitle = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET);
		if ($cidinfo['parentid'] != 0) {
			$cidtitle = getparent($cidinfo['parentid'], $cidtitle);
		}
		echo '<li><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadValidate&amp;cid=' . $cidinfo['cid'] . '">'
			. $cidtitle . '</a></li>';
	}
	echo '</ul>';
}
echo '</div>';
CloseTable();
include_once 'footer.php';

