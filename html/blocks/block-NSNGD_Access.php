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
if (!defined('BLOCK_FILE')) {
	Header('Location: ../index.php');
	die();
}
/**
 * Configuration Options
 */
$blkLmtUploads = 6;   // The number of Uploads to show
$blkLmtDownloads = 6; // The number of Downloads to show
/*
 * End of Configuration Options
 */
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	$CenterBlk = true;
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
	$CenterBlk = false;
}
if (!defined('_DL_LANG_MODULE')) get_lang('Downloads');
global $prefix, $user_prefix, $db;
$content = '<div class="' . $ListClass . ' block-nsngd_access"><ul class="rn-list">';
/*
 * Get uploads from the database and present
 */
$uptime = '<img src="images/blocks/uploads.png" height="16" width="16" alt="" /> <span class="thick">' . _DL_UP . ':</span>';
$sql = 'SELECT `username`, `uploads` FROM `' . $prefix . '_nsngd_accesses` WHERE `uploads` > 0 ORDER BY `uploads` DESC LIMIT 0, '
	. $blkLmtUploads;
$result = $db->sql_query($sql);
$numrowsu = $db->sql_numrows($result);
if ($numrowsu >= 1) {
	$uptime .= '<ol class="rn-ol">';
	$a = 1;
	while (list($uname, $uloads) = $db->sql_fetchrow($result)) {
		$uptime .= '<li class="ol-num bnum' . $a . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . urlencode($uname) . '">'
			. htmlspecialchars($uname, ENT_QUOTES, _CHARSET) . '</a> (' . $uloads . ' ' . (($uloads == 1) ? _DL_FILE : _DL_FILES) . ')</li>';
		$a++;
	}
	$uptime .= '</ol>';
} else {
	if (is_active('Submit_Downloads')) $uptime .= '<ul class="ul-none"><li><a href="modules.php?name=Submit_Downloads">' . _DL_ADDDOWNLOAD . '</a></li></ul>';
}
$uptime .= '</li>';
/*
 * Get downloads from the database and present.
 */
$downtime = '<img src="images/blocks/downloads.png" height="16" width="16" alt="" /> <span class="thick">' . _DL_DN . ':</span>';
$sql = 'SELECT `username`, `downloads` FROM `' . $prefix . '_nsngd_accesses` WHERE `downloads` > 0 ORDER BY `downloads` DESC LIMIT 0, '
	. $blkLmtDownloads;
$result = $db->sql_query($sql);
$numrowsd = $db->sql_numrows($result);
if ($numrowsd >= 1) {
	$downtime .= '<ol class="rn-ol">';
	$a = 1;
	while (list($uname, $dloads) = $db->sql_fetchrow($result)) {
		$unum = $db->sql_numrows($db->sql_query('SELECT `user_id` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($uname) . '\''));
		if ($unum == 0) {
			$uname = 'Anonymous';
		}
		$downtime .= '<li class="ol-num bnum' . $a . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . urlencode($uname) . '">'
			. htmlspecialchars($uname, ENT_QUOTES, _CHARSET) . '</a> (' . $dloads . ' ' . (($dloads == 1) ? _DL_FILE : _DL_FILES) . ') </li>';
		$a++;
	}
	$downtime .= '</ol>';
}
$downtime .= '</li>';
/*
 * montego - got rid of expensive while loop and instead made MySQL do a simple sum of hits and count the rows
 */
$total_hits = 0;
$totdld = 0;
$sql = 'SELECT COUNT(hits), SUM(hits) FROM `' . $prefix . '_nsngd_downloads` WHERE `active` = 1';
if (list($rows, $hits) = $db->sql_fetchrow($db->sql_query($sql))) {
	$total_hits = $hits;
	$totdld = $rows;
}
$content .= '<li class="rn-list li-first">' . (($CenterBlk AND $numrowsu < $numrowsd) ? $downtime : $uptime);
$content .= '<li class="rn-list li-even">' . (($CenterBlk AND $numrowsu < $numrowsd) ? $uptime : $downtime);
if ($CenterBlk AND $numrowsu < $numrowsd) { $column = 'li-even'; } else { $column = 'li-odd'; }
$content .= '<li class="rn-list ' . $column . '"><img src="images/blocks/totals.png" height="16" width="16" alt="" /> <span class="thick">' . _DL_TDN . ':</span>';
$content .= '<ul class="ul-none"><li>' . $totdld . ' ' . _DL_FILESDL . ' ' . $total_hits . ' ' . _DL_TIMES . '</li></ul></li></ul>';
$content .= '</div><div class="block-spacer">&nbsp;</div>';

