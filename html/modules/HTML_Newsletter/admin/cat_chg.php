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
/************************************************************************
* FORM variable validation and cleansing
************************************************************************/
if (!isset($_POST['msnl_cid'])) { // Should not get here without a category id set
	opentable();
	msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
}
$msnl_iCID = intval($_POST['msnl_cid']);
/************************************************************************
* Write out the page title, table headers, and set up the input form.
************************************************************************/
opentable();
msnl_fShowSubTitle(_MSNL_CAT_CHG_LAB_CATCHG);
/************************************************************************
* Get how many newsletters will be impacted by this change.
************************************************************************/
$sql = 'SELECT COUNT(`nid`) as msnl_cnt FROM `'
	. $prefix . '_hnl_newsletters` WHERE `cid` = \'' . $msnl_iCID . '\'';
$result = msnl_fSQLCall($sql);
if (!$result) {
	msnl_fRaiseAppError(_MSNL_CAT_ERR_DBGETCNT);
} else {
	$row = $db->sql_fetchrow($result);
	$msnl_iCnt = intval($row['msnl_cnt']);
}
/************************************************************************
* Build the SQL to bring in the Role information to display.
************************************************************************/
$sql = 'SELECT `ctitle`, `cdescription`, `cblocklimit` FROM `'
	. $prefix . '_hnl_categories` WHERE `cid` = \'' . $msnl_iCID . '\'';
$result1 = msnl_fSQLCall($sql);
/************************************************************************
* Check if there was an error getting the role information and if not,
* write out the fields to the page.
************************************************************************/
if (!$result1) {
	msnl_fRaiseAppError(_MSNL_CAT_ERR_DBGETCAT);
} else {
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_cat_chg_apply" />';
	echo '<input type="hidden" name="msnl_cid" value="' . $msnl_iCID . '" />';
	$row1 = $db->sql_fetchrow($result1);
	$msnl_asRec['ctitle'] = $row1['ctitle'];
	$msnl_asRec['cdescription'] = $row1['cdescription'];
	$msnl_asRec['cblocklimit'] = intval($row1['cblocklimit']);
	/************************************************************************
	* Write out the newsletter category information.
	************************************************************************/
	echo '<div id="msnl_div_main">';
	echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
	/*
	 * Category Title
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_CAT_HLP_CATTITLE, _MSNL_CAT_LAB_CATTITLE)
		. _MSNL_CAT_LAB_CATTITLE . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_ctitle" size="50" maxlength="50" '
		. 'value="' . msnl_fXMLEntities($msnl_asRec['ctitle']) . '" />'
		. '</td></tr>';
	/*
	 * Category Description
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_CAT_HLP_CATDESC, _MSNL_CAT_LAB_CATDESC)
		. _MSNL_CAT_LAB_CATDESC . ':&nbsp;'
		. '</td><td>'
		. '<textarea name="msnl_cdescription" cols="50" rows="10">'
		. msnl_fXMLEntities($msnl_asRec['cdescription'])
		. '</textarea>'
		. '</td></tr>';
	/*
	 * Block Limit
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_CAT_HLP_CATBLOCKLMT . MSNL_DEFAULT_BLOCKLMT . '</b>.', _MSNL_CAT_LAB_CATBLOCKLMT)
		. _MSNL_CAT_LAB_CATBLOCKLMT . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_cblocklimit" size="2" '
		. 'maxlength="4" value="' . $msnl_asRec['cblocklimit'] . '" />'
		. '</td></tr>';
	/*
	 * End of form fields
	 */
	echo '</table></div>';
	/*
	 * Show how many newsletters will be impacted by this change.
	 */
	echo '<p><strong>' . $msnl_iCnt . ' ' . _MSNL_CAT_CHG_MSG_CHGIMPACT . '</strong></p>';
	/*
	 * Now show the Save button and close up the form.
	 */
	msnl_fShowBtnSave('msnl_cat_chg_apply');
	echo '</form>';
}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();
// Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

