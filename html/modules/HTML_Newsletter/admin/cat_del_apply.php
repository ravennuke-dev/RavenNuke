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
* If this script is called "directly", as apposed to from cat_del.php
* we need to do some initialization and HTML formatting.
************************************************************************/
if (!defined('MSNL_APPLY')) {
	/************************************************************************
	* Script Initialization
	************************************************************************/
	opentable();
	/************************************************************************
	* FORM variable validation and cleansing
	************************************************************************/
	if (!isset($_POST['msnl_cid'])) { // Should not get here without a role id set
		msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
	}
	$msnl_iCID = intval($_POST['msnl_cid']);
	/************************************************************************
	* Came from a direct call to script meaning there was impact to existing
	* newsletters.  Must re-assign all newsletters which have this category.
	************************************************************************/
	$sql = 'UPDATE `' . $prefix . '_hnl_newsletters` SET '
		. '`cid` = 							1 '
		. 'WHERE `cid` = \'' . $msnl_iCID . '\'';
	if (!msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN);
	}
}
/************************************************************************
* Perform the delete.
************************************************************************/
$sql = 'DELETE FROM `' . $prefix . '_hnl_categories` '
	. 'WHERE `cid` = \'' . $msnl_iCID . '\'';
if (!msnl_fSQLCall($sql)) {
	msnl_fRaiseAppError(_MSNL_CAT_DEL_APPLY_ERR_DBDELETE);
} else {
	if (!defined('MSNL_APPLY')) { // Have already written out the following
		echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
		echo '<input type="hidden" name="op" value="msnl_cat" />';
	}
	echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<p><span class="title">' . _MSNL_COM_MSG_DELSUCCESS . '</span></p>'
		. '<p>[ <a href="javascript:msnl_FormHandler(\'msnl_cat\');" title="' . _MSNL_LNK_CATEGORYCFG . '">'
		. _MSNL_CAT_MSG_CATBACK
		. '</a> ]</p></div>';
	if (!defined('MSNL_APPLY')) {
		echo '</form>';
	}
}
/************************************************************************
* Close up the web page.
************************************************************************/
if (!defined('MSNL_APPLY')) {
	closetable();
}

