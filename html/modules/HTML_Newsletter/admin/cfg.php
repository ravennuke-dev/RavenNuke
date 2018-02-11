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
msnl_fShowSubTitle(_MSNL_CFG_LAB_MAINCFG);
msnl_fShowHelpLegend();
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<input type="hidden" name="op" value="msnl_cfg_apply" />';
/************************************************************************
* Module Options section of configuration options
************************************************************************/
echo '<div id="msnl_div_module">';
opentable();
echo '<p><strong>' . _MSNL_CFG_LAB_MODULEOPT . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * Debug Mode - OFF = no debug messaging at all; ERROR = only msg upon an error; VERBOSE = msg on everything!
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_DEBUGMODE, _MSNL_CFG_LAB_DEBUGMODE)
	. _MSNL_CFG_LAB_DEBUGMODE
	. ':&nbsp;</td><td>'
	. '&nbsp;<select name="msnl_debug_mode">';
echo '<option value="' . MSNL_OFF . '"';
if ($msnl_gasModCfg['debug_mode'] == MSNL_OFF) {
	echo ' selected="selected"';
}
echo '>' . _MSNL_CFG_LAB_DEBUGMODE_OFF . '</option>';
echo '<option value="' . MSNL_ERROR . '"';
if ($msnl_gasModCfg['debug_mode'] == MSNL_ERROR) {
	echo ' selected="selected"';
}
echo '>' . _MSNL_CFG_LAB_DEBUGMODE_ERR . '</option>';
echo '<option value="' . MSNL_VERBOSE . '"';
if ($msnl_gasModCfg['debug_mode'] == MSNL_VERBOSE) {
	echo ' selected="selected"';
}
echo '>' . _MSNL_CFG_LAB_DEBUGMODE_VER . '</option>';
echo '</select></td></tr>';
/*
 * Show Blocks - 1 = show right-hand blocks; 0 = hide right-hand blocks
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SHOWBLOCKS, _MSNL_CFG_LAB_SHOWBLOCKS)
	. _MSNL_CFG_LAB_SHOWBLOCKS
	. ':&nbsp;</td><td>'
	. '<input type="checkbox" name="msnl_show_blocks" value="yes"';
if ($msnl_gasModCfg['show_blocks'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Use NSN Groups - 1 = use NSN Groups; 0 = Do not use NSN Groups and/or NSN Groups is not installed
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_NSNGRPS, _MSNL_CFG_LAB_NSNGRPS)
	. _MSNL_CFG_LAB_NSNGRPS
	. ':&nbsp;</td><td>'
	. '<input type="checkbox" name="msnl_nsn_groups" value="yes"';
if ($msnl_gasModCfg['nsn_groups'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Download Module name - most download modules model after the core nuke tables, but can have
 * a different table subfix.  E.g., NSN Groups uses nsngd instead of downloads
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_DLMODULE, _MSNL_CFG_LAB_DLMODULE)
	. _MSNL_CFG_LAB_DLMODULE
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_dl_module" size="50" '
	. 'maxlength="50" value="' . $msnl_gasModCfg['dl_module'] . '" />'
	. '</td></tr>';
/*
 * Use nukeWYSIWYG - 1 = use nukeWYSIWYG; 0 = Do not use nukeWYSIWYG and/or NSN Groups is not installed
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_WYSIWYGON, _MSNL_CFG_LAB_WYSIWYGON)
	. _MSNL_CFG_LAB_WYSIWYGON
	. ':&nbsp;</td><td>'
	. '<input type="checkbox" name="msnl_wysiwyg_on" value="yes"';
if ($msnl_gasModCfg['wysiwyg_on'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Number of rows to Show for Textbody Content
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_WYSIWYGROWS, _MSNL_CFG_LAB_WYSIWYGROWS)
	. _MSNL_CFG_LAB_WYSIWYGROWS
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_wysiwyg_rows" size="2" '
	. 'maxlength="2" value="' . $msnl_gasModCfg['wysiwyg_rows'] . '" />'
	. '</td></tr>';
/*
 * Close out this section
 */
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Show Options section of configuration options
************************************************************************/
echo '<div id="msnl_div_show">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_CFG_LAB_SHOWOPT . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * Show Categories - Checked will show newsletter categories in block - Archives always show categories
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SHOWCATS, _MSNL_CFG_LAB_SHOWCATS)
	. _MSNL_CFG_LAB_SHOWCATS
	. ':&nbsp;</td><td>'
	. '&nbsp;<input type="checkbox" name="msnl_show_categories" value="1"';
if ($msnl_gasModCfg['show_categories'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Show Hits - Checked will show newsletter hits in block and in archives
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SHOWHITS, _MSNL_CFG_LAB_SHOWHITS)
	. _MSNL_CFG_LAB_SHOWHITS
	. ':&nbsp;</td><td>'
	. '&nbsp;<input type="checkbox" name="msnl_show_hits" value="1"';
if ($msnl_gasModCfg['show_hits'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Show Dates Sent - Checked will show the date a newsletter was sent on in both block and archives
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SHOWDATES, _MSNL_CFG_LAB_SHOWDATES)
	. _MSNL_CFG_LAB_SHOWDATES
	. ':&nbsp;</td><td>'
	. '&nbsp;<input type="checkbox" name="msnl_show_dates" value="1"';
if ($msnl_gasModCfg['show_dates'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Show Sender - Checked will show the sender of the newsletter in the block and archives
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SHOWSENDER, _MSNL_CFG_LAB_SHOWSENDER)
	. _MSNL_CFG_LAB_SHOWSENDER
	. ':&nbsp;</td><td>'
	. '&nbsp;<input type="checkbox" name="msnl_show_sender" value="1"';
if ($msnl_gasModCfg['show_sender'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Close out this section
 */
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Block Options section of configuration options
************************************************************************/
echo '<div id="msnl_div_block">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_CFG_LAB_BLKOPT . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * Newsletters to Show - The TOTAL number of newsletters to show in the block.
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_BLKLMT, _MSNL_CFG_LAB_BLKLMT)
	. _MSNL_CFG_LAB_BLKLMT
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_blk_lmt" size="2" '
	. 'maxlength="2" value="' . $msnl_gasModCfg['blk_lmt'] . '" />'
	. '</td></tr>';
/*
 * Scrolling Block - Checked will cause the newsletter list in the block to scroll
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SCROLL, _MSNL_CFG_LAB_SCROLL)
	. _MSNL_CFG_LAB_SCROLL
	. ':&nbsp;</td><td>'
	. '&nbsp;<input type="checkbox" name="msnl_scroll" value="1"';
if ($msnl_gasModCfg['scroll'] == '1') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Scrolling Height - The number of pixels for the scrolling height.
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SCROLLHEIGHT, _MSNL_CFG_LAB_SCROLLHEIGHT)
	. _MSNL_CFG_LAB_SCROLLHEIGHT
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_scroll_height" size="2" '
	. 'maxlength="4" value="' . $msnl_gasModCfg['scroll_height'] . '" />'
	. '</td></tr>';
/*
 * Scrolling Amount - The number of pixels to move for each scroll.
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SCROLLAMT, _MSNL_CFG_LAB_SCROLLAMT)
	. _MSNL_CFG_LAB_SCROLLAMT
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_scroll_amt" size="2" '
	. 'maxlength="4" value="' . $msnl_gasModCfg['scroll_amt'] . '" />'
	. '</td></tr>';
/*
 * Scrolling Delay - Number of miliseconds to wait between scrolls.
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CFG_HLP_SCROLLDELAY, _MSNL_CFG_LAB_SCROLLDELAY)
	. _MSNL_CFG_LAB_SCROLLDELAY
	. ':&nbsp;</td><td>'
	. '<input type="text" name="msnl_scroll_delay" size="2" '
	. 'maxlength="4" value="' . $msnl_gasModCfg['scroll_delay'] . '" />'
	. '</td></tr>';
/*
 * Close out this section
 */
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Close up the Form and the web page.
************************************************************************/
msnl_fShowBtnSave('msnl_cfg_apply');
echo '</form>';
closetable();
// Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

