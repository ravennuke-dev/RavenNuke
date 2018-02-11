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
* FORM variable validation and cleansing
************************************************************************/
if (!isset($_POST['msnl_nid'])) { // Should not get here without a newsletter id set
	msnl_fRaiseAppError(_MSNL_NLS_ERR_INVALIDNID);
}
$msnl_iNID = intval($_POST['msnl_nid']);
if (!isset($_POST['msnl_cid'])) { // Should not get here without a category id selected
	opentable();
	msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
}
$msnl_iCID = intval($_POST['msnl_cid']);
/************************************************************************
* Show confirmation message to ensure they really, really, really want to delete.
************************************************************************/
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<input type="hidden" name="op" value="msnl_nls" />';
echo '<input type="hidden" name="msnl_nid" value="' . $msnl_iNID . '" />';
echo '<input type="hidden" name="msnl_cid" value="' . $msnl_iCID . '" />';
echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<p><span class="title">' . _MSNL_COM_MSG_WARNING . '</span></p>'
	. '<p><strong>' . _MSNL_NLS_DEL_MSG_DELIMPACT . '</strong></p>'
	. '<p>' . _MSNL_NLS_DEL_MSG_DELIMPACT1 . '</p>'
	. '<p>[ '
	. '<a href="javascript:msnl_FormHandler(\'msnl_nls_del_apply\');" '
	. 'title="' . _MSNL_COM_LNK_CONTINUE . '">' . _MSNL_COM_LAB_YES
	. '</a> | '
	. '<a href="javascript:msnl_FormHandler(\'msnl_nls\');" '
	. 'title="' . _MSNL_COM_LNK_CANCEL . '">' . _MSNL_COM_LAB_NO
	. '</a> ]</p></div>';
echo '</form>';
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();

