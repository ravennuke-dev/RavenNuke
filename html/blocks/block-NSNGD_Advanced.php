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
/********************************************************/
/* NSN GR Downloads Advanced Downloads Block            */
/* By: NukeCode (adminnukecode.com)                    */
/* http://nukecode.com                                  */
/* Copyright 2003-2005 by NukeCode and NSN Mirror Site  */
/********************************************************/
/********************************************************/
/* This block is intended for use ONLY with NSN GR      */
/* Downloads... Do not attempt to use it with any other */
/* Downloads Module, It will not work properly          */
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
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
}
/**
 * Configuration Options
 */
$blkh  = 10;       // Number of lines high (limit 20)
$blkw  = 0;        // Number of characters wide 0 = unused
$scron = 0;        // Turn scrolling on by setting to 1
$scrdr = 'up';     // Scroll direction ('up', 'down', 'left', or 'right')
$scrhg = 200;      // Scroller height in pixels
$scrwd = 145;      // Scroller width in pixels
$speed = 2;        // Speed Of Scroll
$scrolldelay = 75; // Scroll delay - small the number the smoother the scroll
/*
 * End of Configuration Options
 */
if (!defined('_DL_LANG_MODULE')) get_lang('Downloads');
global $prefix, $db;
$content = '';
/*
 * Total downloads in the database
 */
if (!(list($files) = $db->sql_fetchrow($db->sql_query('SELECT COUNT(`lid`) FROM `' . $prefix . '_nsngd_downloads`')))) $files = 0;
/*
 * Total download categories in the database
 */
if (!(list($cats) = $db->sql_fetchrow($db->sql_query('SELECT COUNT(`cid`) FROM `' . $prefix . '_nsngd_categories`')))) $cats = 0;
/*
 * Total hits across all downloads (including inactives)
 */
if (!(list($total_hits) = $db->sql_fetchrow($db->sql_query('SELECT SUM(`hits`) FROM `' . $prefix . '_nsngd_downloads`')))) $total_hits = 0;
/*
 * Total GB Served
 */
if (!(list($served) = $db->sql_fetchrow($db->sql_query('SELECT SUM(`filesize`*`hits`) AS serv FROM `' . $prefix . '_nsngd_downloads`')))) $served = 0;
$tb = 1024*1024*1024*1024;
$gb = 1024*1024*1024;
$mb = 1024*1024;
$kb = 1024;
if ($served >= $tb) {
	$mysizes = sprintf('%01.2f', $served/$tb) . ' TB';
} elseif ($served >= $gb) {
	$mysizes = sprintf('%01.2f', $served/$gb) . ' GB';
} elseif ($served >= $mb) {
	$mysizes = sprintf('%01.2f', $served/$mb) . ' MB';
} elseif ($served >= $kb) {
	$mysizes = sprintf('%01.2f', $served/$kb) . ' KB';
} else {
	$mysizes = $served . ' B';
}
/*
 * Ok, start building the content.
 */
$content .= '<div class="' . $ListClass . ' block-nsngd_advanced"><ul class="ul-none ul-head">';
$content .= '<li class="li-first">' . _DL_TOTALDLFILES . ': ' . $files . '</li><li class="li-even">' . _DL_TOTALDLCATEGORIES . ': ' . $cats . '</li><li class="li-odd">' . _DL_TDN . ': ' . $total_hits . '</li><li class="li-even">' . _DL_TOTALDLSERVED . ': ' . $mysizes . '</li></ul>';
$content .= '<div class="block-spacer">&nbsp;</div>';
if ($scron == 1) {
	$content .= '<marquee behavior="scroll" direction="' . $scrdr . '" height="' . $scrhg . '" width="' . $scrwd . '" scrollamount="' . $speed . '" scrolldelay="' . $scrolldelay . '" onmouseover="this.stop()" onmouseout="this.start()"><br />';
}
/*
 * Latest Downloads
 */
$content .= '<ul class="rn-list"><li class="rn-list li-first"><span class="thick">' . _DL_NEWDOWNLOADS . '</span>';
$a = 1;
$result = $db->sql_query('SELECT `lid`, `title`, `hits` FROM `' . $prefix . '_nsngd_downloads` ORDER BY `date` DESC LIMIT 0, ' . $blkh);
$numrows = $db->sql_numrows($result);
if ($numrows >= 1) {
	$content .= '<ol class="rn-ol">';
	while (list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
		if ($blkw > 0) {
			if (strlen($title) > $blkw) {
				$title = substr($title, 0, $blkw);
			}
		}
		if ($a > 1 AND $a % 2){$column = ' li-odd';} else if ($a > 1) {$column = ' li-even';} else {$column = ' li-first';}
		$content .= '<li class="ol-num bnum' . $a . $column . '"><a href="modules.php?name=' . $tndlModName . '&amp;op=getit&amp;lid=' . $lid . '">'
			. htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</a><ul class="ul-none"><li>(' . _DL_HITS . ':&nbsp;' . $hits . ')</li></ul></li>';
		$a++;
	}
	$content .= '</ol>';
}
/*
 * Top Downloads
 */
$content .= '</li><li class="rn-list li-even"><span class="thick">' . _DL_POPULARDLS . '</span>';
$a = 1;
$result = $db->sql_query('SELECT `lid`, `title`, `hits` FROM `' . $prefix . '_nsngd_downloads` ORDER BY `hits` DESC LIMIT 0, ' . $blkh);
$numrows = $db->sql_numrows($result);
if ($numrows >= 1) {
	$content .= '<ol class="rn-ol">';
	while (list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
		if ($blkw > 0) {
			if (strlen($title) > $blkw) {
				$title = substr($title, 0, $blkw);
			}
		}
		if ($a > 1 AND $a % 2){$column = ' li-odd';} else if ($a > 1) {$column = ' li-even';} else {$column = ' li-first';}
		$content .= '<li class="ol-num bnum' . $a . $column . '"><a href="modules.php?name=' . $tndlModName . '&amp;op=getit&amp;lid=' . $lid . '">'
			. htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</a><ul class="ul-none"><li>(' . _DL_HITS . ':&nbsp;' . $hits . ')</li></ul></li>';
		$a++;
	}
	$content .= '</ol>';
}
$content .= '</li></ul>';
if ($scron == 1) {
	$content .= '</marquee>';
}
$content .= '</div>';
// make sure content does not float outside the block  
$content .= '<div class="block-spacer">&nbsp;</div>';