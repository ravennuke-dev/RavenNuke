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
* Validate Category Input Data
************************************************************************/
/*
 * Category Title - Cleanse it of HTML tags.
 */
if (!isset($_POST['msnl_ctitle']) || empty($_POST['msnl_ctitle'])) {
	msnl_fSetValErr(_MSNL_CAT_LAB_CATTITLE, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['ctitle'] = tnnlFilter($_POST['msnl_ctitle'], 'nohtml');
}
/*
 * Category Description - Cleanse it of HTML tags.
 */
if (!isset($_POST['msnl_cdescription']) || empty($_POST['msnl_cdescription'])) {
	msnl_fSetValErr(_MSNL_CAT_LAB_CATDESC, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['cdescription'] = tnnlFilter($_POST['msnl_cdescription'], 'nohtml');
}
/*
 * Block Limit - Make sure it is an integer value greater than zero.
 */
if (!isset($_POST['msnl_cblocklimit']) || empty($_POST['msnl_cblocklimit'])) {
	$msnl_asRec['cblocklimit'] = MSNL_DEFAULT_BLOCKLMT;
} else {
	if ($_POST['msnl_cblocklimit'] < 1) {
		msnl_fSetValErr(_MSNL_CAT_LAB_CATBLOCKLMT, _MSNL_COM_MSG_POSNONZEROINT);
	} else {
		$msnl_asRec['cblocklimit'] = intval($_POST['msnl_cblocklimit']);
	}
}
/************************************************************************
* If had validation errors, write them out to the page, otherwise,
* update the database.
************************************************************************/
if (msnl_fShowValErr()) {
	msnl_fShowBtnGoBack();
} else {
	$sql = 'INSERT INTO `' . $prefix . '_hnl_categories` ('
		. '`cid`, '
		. '`ctitle`, '
		. '`cdescription`, '
		. '`cblocklimit`'
		. ') '
		. 'VALUES ('
		. '\'\', '
		. '\'' . addslashes($msnl_asRec['ctitle']) . '\', '
		. '\'' . addslashes($msnl_asRec['cdescription']) . '\', '
		. '\'' . $msnl_asRec['cblocklimit'] . '\''
		. ')';
	if (!msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_CAT_ADD_APPLY_DBCATADD);
	} else {
		echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
		echo '<input type="hidden" name="op" value="msnl_cat" />';
		echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
			. '<p><span class="title">' . _MSNL_COM_MSG_ADDSUCCESS . '</span></p>'
			. '<p>[ <a href="javascript:msnl_FormHandler(\'msnl_cat\');" title="' . _MSNL_LNK_CATEGORYCFG . '">'
			. _MSNL_CAT_MSG_CATBACK
			. '</a> ]</p></div>';
		echo '</form>';
	}
}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();

