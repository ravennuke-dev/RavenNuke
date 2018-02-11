<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('MSNL_LOADED')) die('Illegal File Access');
/************************************************************************
* Script Initialization
************************************************************************/
opentable();
/************************************************************************
* Validate Configuration Input Data
************************************************************************/
/*
 * DebugMode - If it is not one of the defined values, error out, otherwise set it
 */
if ($_POST['msnl_debug_mode'] != MSNL_OFF && $_POST['msnl_debug_mode'] != MSNL_ERROR && $_POST['msnl_debug_mode'] != MSNL_VERBOSE) {
	msnl_fRaiseAppError(_MSNL_CFG_APPLY_VAL_DEBUGMODE);
} else {
	$msnl_asRec['debug_mode'] = $_POST['msnl_debug_mode'];
}
/*
 * Show Blocks - 1 = show right-hand blocks; 0 = hide right-hand blocks
 */
if (isset($_POST['msnl_show_blocks'])) {
	$msnl_asRec['show_blocks'] = '1';
} else {
	$msnl_asRec['show_blocks'] = '0';
}
/*
 * Use NSN Groups - 1 = use NSN Groups; 0 = Do not use NSN Groups and/or NSN Groups is not installed
 */
if (isset($_POST['msnl_nsn_groups'])) {
	$msnl_asRec['nsn_groups'] = '1';
} else {
	$msnl_asRec['nsn_groups'] = '0';
}
/*
 * Download Module name - most download modules model after the core nuke tables, but can have
 * a different table subfix.  E.g., NSN Groups uses nsngd instead of downloads
 */
if (!isset($_POST['msnl_dl_module']) || empty($_POST['msnl_dl_module'])) {
	msnl_fSetValErr(_MSNL_CFG_LAB_DLMODULE, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['dl_module'] = tnnlFilter($_POST['msnl_dl_module'], 'nohtml');
}
/*
 * Use nukeWYSIWYG - 1 = use nukeWYSIWYG; 0 = Do not use nukeWYSIWYG and/or NSN Groups is not installed
 */
if (isset($_POST['msnl_wysiwyg_on'])) {
	$msnl_asRec['wysiwyg_on'] = '1';
} else {
	$msnl_asRec['wysiwyg_on'] = '0';
}
/*
 * Number of rows to Show for Textbody Content
 */
if (isset($_POST['msnl_wysiwyg_rows'])) {
	$msnl_asRec['wysiwyg_rows'] = intval($_POST['msnl_wysiwyg_rows']);
} else {
	$msnl_asRec['wysiwyg_rows'] = '30';
}
/*
 * Show Categories - Checked will show newsletter categories in block - Archives always show categories
 */
if (isset($_POST['msnl_show_categories'])) {
	$msnl_asRec['show_categories'] = '1';
} else {
	$msnl_asRec['show_categories'] = '0';
}
/*
 * Show Hits - Checked will show newsletter hits in block and in archives
 */
if (isset($_POST['msnl_show_hits'])) {
	$msnl_asRec['show_hits'] = '1';
} else {
	$msnl_asRec['show_hits'] = '0';
}
/*
 * Show Dates Sent - Checked will show the date a newsletter was sent on in both block and archives
 */
if (isset($_POST['msnl_show_dates'])) {
	$msnl_asRec['show_dates'] = '1';
} else {
	$msnl_asRec['show_dates'] = '0';
}
/*
 * Show Sender - Checked will show the sender of the newsletter in the block and archives
 */
if (isset($_POST['msnl_show_sender'])) {
	$msnl_asRec['show_sender'] = '1';
} else {
	$msnl_asRec['show_sender'] = '0';
}
/*
 * Newsletters to Show - The TOTAL number of newsletters to show in the block.
 */
if (isset($_POST['msnl_blk_lmt'])) {
	$msnl_asRec['blk_lmt'] = intval($_POST['msnl_blk_lmt']);
} else {
	$msnl_asRec['blk_lmt'] = '10';
}
/*
 * Scrolling Block - Checked will cause the newsletter list in the block to scroll
 */
if (isset($_POST['msnl_scroll'])) {
	$msnl_asRec['scroll'] = '1';
} else {
	$msnl_asRec['scroll'] = '0';
}
/*
 * Scrolling Height - The number of pixels for the scrolling height.
 */
if (isset($_POST['msnl_scroll_height'])) {
	$msnl_asRec['scroll_height'] = intval($_POST['msnl_scroll_height']);
} else {
	$msnl_asRec['scroll_height'] = '180';
}
/*
 * Scrolling Amount - The number of pixels to move for each scroll.
 */
if (isset($_POST['msnl_scroll_amt'])) {
	$msnl_asRec['scroll_amt'] = intval($_POST['msnl_scroll_amt']);
} else {
	$msnl_asRec['scroll_amt'] = '180';
}
/*
 * Scrolling Delay - Number of miliseconds to wait between scrolls.
 */
if (isset($_POST['msnl_scroll_delay'])) {
	$msnl_asRec['scroll_delay'] = intval($_POST['msnl_scroll_delay']);
} else {
	$msnl_asRec['scroll_delay'] = '100';
}
/************************************************************************
* If had validation errors, write them out to the page, otherwise,
* update the database.
************************************************************************/
if (msnl_fShowValErr()) {
	msnl_fShowBtnGoBack();
} else {
	foreach($msnl_asRec as $key => $value) {
		if ($msnl_gasModCfg[$key] <> $value) {
			$sql = 'UPDATE `' . $prefix . '_hnl_cfg` '
				. 'SET `cfg_val` = \'' . addslashes($value) . '\' '
				. 'WHERE `cfg_nm` = \'' . $key . '\'';
			if (!msnl_fSQLCall($sql)) {
				msnl_fRaiseAppError(_MSNL_CFG_APPLY_ERR_DBFAILED . ' for "' . $key . '"');
			}
		}

	}
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_cfg" />';
	echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<p><span class="title">' . _MSNL_COM_MSG_UPDSUCCESS . '</span></p>'
		. '<p>'
		. '[ <a href="' . $admin_file . '.php?op=msnl_cfg" title="' . _MSNL_LNK_MAINCFG . '">'
		. _MSNL_CFG_APPLY_MSG_BACK
		. '</a> ] </p></div>';
	echo '</form>';
}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();

