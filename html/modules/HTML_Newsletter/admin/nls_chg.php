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
* FORM variable validation and cleansing
************************************************************************/
if (!isset($_POST['msnl_nid'])) { // Should not get here without a newsletter id set
	opentable();
	msnl_fRaiseAppError(_MSNL_NLS_ERR_INVALIDNID);
}
$msnl_iNID = intval($_POST['msnl_nid']);
if (!isset($_POST['msnl_cid'])) { // Should not get here without a category id set
	opentable();
	msnl_fRaiseAppError(_MSNL_CAT_ERR_INVALIDCID);
}
$msnl_iPrevCID = intval($_POST['msnl_cid']);
/************************************************************************
* Write out the page title, table headers, and set up the input form.
************************************************************************/
opentable();
msnl_fShowSubTitle(_MSNL_NLS_CHG_LAB_NLSCHG);
/************************************************************************
* Build the SQL to bring in the newsletter information to display.
************************************************************************/
$sql = 'SELECT `cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, `filename` FROM `'
	. $prefix . '_hnl_newsletters` WHERE `nid` = \'' . $msnl_iNID . '\'';
$result = msnl_fSQLCall($sql);
/************************************************************************
* Check if there was an error getting the newsletter information and if not,
* write out the fields to the page.
************************************************************************/
if (!$result) {
	msnl_fRaiseAppError(_MSNL_NLS_ERR_DBGETNLS);
} else {
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_nls" />';
	echo '<input type="hidden" name="msnl_nid" value="' . $msnl_iNID . '" />';
	echo '<input type="hidden" name="msnl_prev_cid" value="' . $msnl_iPrevCID . '" />';
	$row = $db->sql_fetchrow($result);
	$msnl_asRec['cid'] = intval($row['cid']);
	$msnl_asRec['topic'] = msnl_fXMLEntities($row['topic']);
	$msnl_asRec['sender'] = msnl_fXMLEntities($row['sender']);
	$msnl_asRec['datesent'] = $row['datesent'];
	$msnl_asRec['view'] = intval($row['view']);
	$msnl_asRec['groups'] = $row['groups'];
	$msnl_asRec['hits'] = intval($row['hits']);
	$msnl_asRec['filename'] = basename(msnl_fXMLEntities($row['filename']));
	/************************************************************************
	* Write out the newsletter information.
	************************************************************************/
	echo '<div id="msnl_div_main">';
	echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
	/*
	 * Newsletter Topic
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_ADM_HLP_TOPIC, _MSNL_ADM_LAB_TOPIC)
		. _MSNL_ADM_LAB_TOPIC . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_topic" size="40" maxlength="100" '
		. 'value="' . $msnl_asRec['topic'] . '" />'
		. '</td></tr>';
	/*
	 * Sender's Name
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_ADM_HLP_SENDER, _MSNL_ADM_LAB_SENDER)
		. _MSNL_ADM_LAB_SENDER . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_sender" size="40" maxlength="40" '
		. 'value="' . $msnl_asRec['sender'] . '" />'
		. '</td></tr>';
	/*
	 * Newsletter Category
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_ADM_HLP_NLSCAT, _MSNL_ADM_LAB_NLSCAT)
		. _MSNL_ADM_LAB_NLSCAT . ':&nbsp;'
		. '</td><td>';
	echo msnl_fGetCategories($msnl_asRec['cid'], MSNL_SHOW_ALL_OFF);
	echo '</td></tr>';
	/*
	 * Date Sent
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_NLS_CHG_HLP_DATESENT, _MSNL_NLS_CHG_LAB_DATESENT)
		. _MSNL_NLS_CHG_LAB_DATESENT . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_datesent" size="20" maxlength="20" '
		. 'value="' . $msnl_asRec['datesent'] . '" />'
		. '</td></tr>';
	/*
	 * Cautionary Note about system assigned values
	 */
	echo '<tr><td colspan="2">&nbsp;</td></tr>';
	echo '<tr><td colspan="2"><strong>' . _MSNL_NLS_CHG_LAB_CAUTION . '</strong></td></tr>';
	echo '<tr><td colspan="2">&nbsp;</td></tr>';
	/*
	 * Who Can View the Newsletter
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_NLS_CHG_HLP_WHOVIEW, _MSNL_NLS_CHG_LAB_WHOVIEW)
		. _MSNL_NLS_CHG_LAB_WHOVIEW . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_view" size="4" maxlength="4" '
		. 'value="' . $msnl_asRec['view'] . '" />'
		. '</td></tr>';
	/*
	 * NSN Groups (If turned on)
	 */
	if ($msnl_gasModCfg['nsn_groups'] == 1) {
		echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
			. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
			. msnl_fShowHelp(_MSNL_NLS_CHG_HLP_NSNGRPS, _MSNL_NLS_CHG_LAB_NSNGRPS)
			. _MSNL_NLS_CHG_LAB_NSNGRPS . ':&nbsp;'
			. '</td><td>'
			. '<input type="text" name="msnl_groups" size="30" maxlength="50" '
			. 'value="' . $msnl_asRec['groups'] . '" />'
			. '</td></tr>';
	}
	/*
	 * Number of Hits
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_NLS_CHG_HLP_NBRHITS, _MSNL_NLS_CHG_LAB_NBRHITS)
		. _MSNL_NLS_CHG_LAB_NBRHITS . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_hits" size="8" maxlength="8" '
		. 'value="' . $msnl_asRec['hits'] . '" />'
		. '</td></tr>';
	/*
	 * Newsletter Filename
	 */
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. msnl_fShowHelp(_MSNL_NLS_CHG_HLP_FILENAME, _MSNL_NLS_CHG_LAB_FILENAME)
		. _MSNL_NLS_CHG_LAB_FILENAME . ':&nbsp;'
		. '</td><td>'
		. '<input type="text" name="msnl_filename" size="32" maxlength="32" '
		. 'value="' . $msnl_asRec['filename'] . '" />'
		. '</td></tr>';
	/************************************************************************
	* End of FORM fields.
	************************************************************************/
	echo '</table>' . '</div>';
	/*
	 * Now show the Save button and close up the form.
	 */
	msnl_fShowBtnSave('msnl_nls_chg_apply');
	echo '</form>';
}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();
// Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

