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
* Write out the page title, table headers, and set up the input form.
************************************************************************/
opentable();
msnl_fShowSubTitle(_MSNL_CAT_ADD_LAB_CATADD);
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<input type="hidden" name="op" value="msnl_cat" />';
/************************************************************************
* Write out the category information data entry fields.
************************************************************************/
echo '<div id="msnl_div_main">';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
//Category Title
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CAT_HLP_CATTITLE, _MSNL_CAT_LAB_CATTITLE)
	. _MSNL_CAT_LAB_CATTITLE . ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_ctitle" size="50" maxlength="50" '
	. 'value="" />'
	. '</td>'
	. '</tr>';
//Category Description
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CAT_HLP_CATDESC, _MSNL_CAT_LAB_CATDESC)
	. _MSNL_CAT_LAB_CATDESC . ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<textarea name="msnl_cdescription" cols="50" rows="10">'
	. '</textarea>'
	. '</td>'
	. '</tr>';
//Block Limit
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_CAT_HLP_CATBLOCKLMT . MSNL_DEFAULT_BLOCKLMT . '</span>.', _MSNL_CAT_LAB_CATBLOCKLMT)
	. _MSNL_CAT_LAB_CATBLOCKLMT . ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_cblocklimit" size="2" '
	. 'maxlength="4" value="5" />'
	. '</td>'
	. '</tr>';
//End of form fields
echo '</table></div>';
/************************************************************************
* Close up the Form and the web page.
************************************************************************/
msnl_fShowBtnAdd('msnl_cat_add_apply');
echo '</form>';
closetable();
//Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';
//Set the focus on the desired form field
echo '<script type="text/javascript">msnl_ObjFocus(\'msnl_ctitle\');</script>';

