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
if (!isset($_POST['msnl_prev_cid'])) { // Should not get here without a previous category id set
	opentable();
	msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
}
$msnl_iPrevCID = intval($_POST['msnl_prev_cid']);
/************************************************************************
* Validate Newsletter Input Data
************************************************************************/
/*
 * Newsletter ID - Ensure that it is set AND an integer value.
 */
if (!isset($_POST['msnl_nid'])) {
	msnl_fRaiseAppError(_MSNL_NLS_ERR_INVALIDNID);
}
$msnl_iNID = intval($_POST['msnl_nid']);
/*
 * Validate the newsletter ID AND get the current category id.
 */
$sql = 'SELECT `cid` FROM `'
	. $prefix . '_hnl_newsletters` WHERE `nid` = \'' . $msnl_iNID . '\'';
$result = msnl_fSQLCall($sql);
$resultcount = $db->sql_numrows($result);
if (!$result || $resultcount < 1) {
	msnl_fRaiseAppError(_MSNL_NLS_ERR_DBGETNLS);
} else {
	$row = $db->sql_fetchrow($result);
	$msnl_iCurrCID = intval($row['cid']);
}
/*
 * Newsletter Topic - remove HTML tags
 */
if (!isset($_POST['msnl_topic']) || empty($_POST['msnl_topic'])) {
	msnl_fSetValErr(_MSNL_ADM_LAB_TOPIC, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['topic'] = tnnlFilter($_POST['msnl_topic'], 'nohtml');
}
/*
 * Sender's Name - remove HTML tags
 */
if (!isset($_POST['msnl_sender']) || empty($_POST['msnl_sender'])) {
	msnl_fSetValErr(_MSNL_ADM_LAB_SENDER, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['sender'] = tnnlFilter($_POST['msnl_sender'], 'nohtml');
}
/*
 * Newsletter Category
 */
if (!isset($_POST['msnl_cid'])) { // Should not get here without a category id set
	msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
}
$msnl_asRec['cid'] = intval($_POST['msnl_cid']);
/*
 * Date Sent
 */
if (!isset($_POST['msnl_datesent']) || empty($_POST['msnl_datesent'])) {
	msnl_fSetValErr(_MSNL_NLS_CHG_LAB_DATESENT, _MSNL_COM_MSG_REQUIRED);
} else {
	$msnl_asRec['datesent'] = tnnlFilter($_POST['msnl_datesent'], 'nohtml');
}
/*
 * Who Can View the Newsletter - Must be one of 0 - 4 or 99
 */
if (isset($_POST['msnl_view']) && $_POST['msnl_view'] != '' && is_numeric($_POST['msnl_view'])
		&& (($_POST['msnl_view'] >= 0 && $_POST['msnl_view'] <= 5) || $_POST['msnl_view'] == 99)) {
	$msnl_asRec['view'] = intval($_POST['msnl_view']);
} else {
	msnl_fSetValErr(_MSNL_NLS_CHG_LAB_WHOVIEW, _MSNL_NLS_CHG_APPLY_MSG_WHOVIEW);
}
/*
 * NSN Groups (If turned on)
 */
if ($msnl_gasModCfg['nsn_groups'] == 1) {
	$msnl_asRec['groups'] = tnnlFilter($_POST['msnl_groups'], 'nohtml');
} else {
	$msnl_asRec['groups'] = '';
}
/*
 * Number of Hits - Must be a numeric, integer value (if real, it will truncate it)
 */
if (isset($_POST['msnl_hits']) && $_POST['msnl_hits'] != '' && is_numeric($_POST['msnl_hits']) && $_POST['msnl_hits'] >= 0) {
	$msnl_asRec['hits'] = intval($_POST['msnl_hits']);
} else {
	msnl_fSetValErr(_MSNL_NLS_CHG_LAB_NBRHITS, _MSNL_COM_MSG_POSNONZEROINT);
}
/*
 * Newsletter Filename
 */
$msnl_asRec['filename'] = basename(tnnlFilter($_POST['msnl_filename'], 'nohtml'));
$msnl_sFilePath = './modules/' . $msnl_sModuleNm . '/archive/' . $msnl_asRec['filename'];
if (!@file_exists($msnl_sFilePath)) {
	msnl_fSetValErr(_MSNL_NLS_CHG_LAB_FILENAME, _MSNL_COM_ERR_FILENOTEXIST);
}
/************************************************************************
* If had validation errors, write them out to the page, otherwise,
* update the database.
************************************************************************/
if (msnl_fShowValErr()) {
	msnl_fShowBtnGoBack();
} else {
	$sql = 'UPDATE `' . $prefix . '_hnl_newsletters` SET '
		. '`topic` = \'' . addslashes($msnl_asRec['topic']) . '\', '
		. '`sender` = \'' . addslashes($msnl_asRec['sender']) . '\', '
		. '`cid` = \'' . $msnl_asRec['cid'] . '\', '
		. '`datesent` = \'' . addslashes($msnl_asRec['datesent']) . '\', '
		. '`view` = \'' . $msnl_asRec['view'] . '\', '
		. '`hits` = \'' . $msnl_asRec['hits'] . '\', '
		. '`groups` = \'' . addslashes($msnl_asRec['groups']) . '\', '
		. '`filename` = \'' . addslashes($msnl_asRec['filename']) . '\' '
		. 'WHERE `nid` = \'' . $msnl_iNID . '\'';
	if (!msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG);
	} else {
		echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
		echo '<input type="hidden" name="op" value="msnl_nls" />';
		if ($msnl_asRec['cid'] != $msnl_iCurrCID) { // Category was changed
			echo '<input type="hidden" name="msnl_cid" value="' . $msnl_asRec['cid'] . '" />';
		} else { // Category was not changed, so retain the originally selected category for nls listing
			echo '<input type="hidden" name="msnl_cid" value="' . $msnl_iPrevCID . '" />';
		}
		echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
			. '<p><span class="title">' . _MSNL_COM_MSG_UPDSUCCESS . '</span></p><p>'
			. '[ <a href="javascript:msnl_FormHandler(\'msnl_nls\');" title="' . _MSNL_LNK_MAINTAINNLS . '">'
			. _MSNL_NLS_MSG_NLSBACK
			. '</a> ] </p></div>';
		echo '</form>';
	}

}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();

