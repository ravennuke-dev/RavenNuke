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
 * NOTE: If you are using nukeFEED either standalone, or embeded within RavenNuke(tm)
 * do not use this backend feed.  Instead, use the NSN GR Download nukeFEED replacement
 * for the original PHP-Nuke Downloads module!  nukeFEED is 100 times better at producing
 * a good quality feed.
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
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

require_once 'mainfile.php';
global $prefix, $db;

$sql = 'SELECT `lid`, `title`, `description` FROM `' . $prefix . '_nsngd_downloads` ORDER BY `lid` DESC LIMIT 10';
$result = $db->sql_query($sql);
define('TNDL_NL', "\n");
define('TNDL_NL2', "\n\n");

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="' . _CHARSET . '"?>', TNDL_NL2;
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">', TNDL_NL2;
echo '<channel>', TNDL_NL;
echo '<title>', htmlspecialchars($sitename, ENT_QUOTES, _CHARSET), '</title>', TNDL_NL;
echo '<link>', $nukeurl, '</link>', TNDL_NL;
echo '<description>', htmlspecialchars($backend_title, ENT_QUOTES, _CHARSET), '</description>', TNDL_NL;
echo '<language>', $backend_language, '</language>', TNDL_NL2;
echo '<atom:link href="', $nukeurl, '/downloadsbackend.php" rel="self" type="application/rss+xml" />', TNDL_NL;
while(list($lid, $title, $description) = $db->sql_fetchrow($result)) {
	$title2 = preg_replace('/ /', '_', $title);
	echo '<item>', TNDL_NL;
	echo '<guid isPermaLink="false">', $title2, '</guid>', TNDL_NL;
	echo '<title>', htmlspecialchars($title, ENT_QUOTES, _CHARSET), '</title>', TNDL_NL;
	if (defined('TNSL_USE_SHORTLINKS')) {
		echo '<link>', $nukeurl, '/download-file-', $lid, '.html</link>', TNDL_NL;
	} else {
		echo '<link>', $nukeurl, '/modules.php?name=Downloads&amp;op=getit&amp;lid=', $lid, '</link>', TNDL_NL;
	}
	echo '<description>', htmlspecialchars($description, ENT_QUOTES, _CHARSET), '</description>', TNDL_NL;
	echo '</item>', TNDL_NL2;
}
echo '</channel>', TNDL_NL;
echo '</rss>', TNDL_NL;

