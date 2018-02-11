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
/*
 * If you change the name of your module from Download to anything
 * else, you need to also change the below line to match
 */
$tndlModName = 'Downloads';
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ol-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ol-box';
}
/**
 * Configuration Options
 */
$blkh  = 20;       // Number of lines high (limit 20)
$blkw  = 0;        // Number of characters wide 0 = unused
$scron = 0;        // Turn scrolling on by setting to 1 (not recommended)
$scrdr = 'up';     // Scroll direction ('up', 'down', 'left', or 'right')
$scrhg = 200;      // Scroller height in pixels
$scrwd = 145;      // Scroller width in pixels
$speed = 2;        // Speed Of Scroll
$scrolldelay = 75; // Scroll delay - small the number the smoother the scroll
/*
 * End of Configuration Options
 */
global $prefix, $db;
$a = 1;
$content = '<div class="' . $ListClass . ' block-nsngd_hot">';
if ($scron == 1) {
	$content .= '<marquee behavior="scroll" direction="' . $scrdr . '" height="' . $scrhg . '" width="' . $scrwd . '" scrollamount="'
		. $speed . '" scrolldelay="' . $scrolldelay . '" onmouseover="this.stop()" onmouseout="this.start()"><br />';
}
$result = $db->sql_query('SELECT `lid`, `title` FROM `' . $prefix . '_nsngd_downloads` ORDER BY `hits` DESC LIMIT 0, ' . $blkh);
$numrows = $db->sql_numrows($result);
if ($numrows == 0) {
	$content .= _BLOCKPROBLEM2;
	} else {
	$content .= '<ol class="rn-ol">';
	while (list($lid, $title) = $db->sql_fetchrow($result)) {
		if ($blkw > 0) {
			if (strlen($title) > $blkw) {
				$title = substr($title, 0, $blkw);
			}
		}
		if ($a > 1 AND $a % 2){$column = ' li-odd';} else if ($a > 1) {$column = ' li-even';} else {$column = ' li-first';}
		$content .= '<li class="ol-num bnum' . $a . $column . '"><a href="modules.php?name=' . $tndlModName . '&amp;op=getit&amp;lid=' . $lid . '">'
			. htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</a></li>';
		$a++;
	}
	$content .= '</ol>';
}
if ($scron == 1) {
	$content .= '</marquee>';
}
$content .= '</div>';
// make sure content does not float outside the block  
$content .= '<div class="block-spacer">&nbsp;</div>';
