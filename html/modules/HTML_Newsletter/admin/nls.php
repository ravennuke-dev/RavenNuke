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
if (isset($_POST['msnl_cid'])) {
	$msnl_iCID = intval($_POST['msnl_cid']);
} else {
	$msnl_iCID = 1;
}
opentable();
msnl_fShowSubTitle(_MSNL_NLS_LAB_NLSCFG);
/************************************************************************
* Get the HTML for the SELECT object of categories.
************************************************************************/
$msnl_asHTML['SELECT'] = msnl_fGetCategories($msnl_iCID, MSNL_SHOW_ALL_ON);
/************************************************************************
* Build the SQL for the newsletters to display.
************************************************************************/
$sql = 'SELECT a.`nid`, a.`cid`, b.`ctitle`, `topic`, `sender`, `datesent`, `filename` '
	. 'FROM `' . $prefix . '_hnl_newsletters` a, `' . $prefix . '_hnl_categories` b ';
if ($msnl_iCID == 0) { // Pull all newsletters regardless of category
	$sql.='WHERE a.`cid` = b.`cid` ';
} else { // Pull only newsletters for the selected category
	$sql.='WHERE a.`cid` = \'' . $msnl_iCID . '\' AND a.`cid` = b.`cid` ';
}
$sql .= 'ORDER BY `datesent` DESC';
$result = msnl_fSQLCall($sql);
$resultcount = $db->sql_numrows($result);
/************************************************************************
* Check if there was an error getting the newsletters, and if not, write them
* out to the screen.
************************************************************************/
if (!$result) {
	msnl_fRaiseAppError(_MSNL_NLS_ERR_DBGETNLSS);
} else {
	/************************************************************************
	* If we found newsletters, write them out along with respective actions.
	************************************************************************/
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_nls" />';
	echo '<input type="hidden" name="msnl_nid" value="0" />';
	/*
	 * Write out SELECT object for newsletter categories that was built previously
	 */
	echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
		. _MSNL_NLS_LAB_CURRENTCAT . ':&nbsp;';
	echo $msnl_asHTML['SELECT'];
	echo '<input type="button" value="' . _MSNL_COM_LAB_GO . '" title="' . _MSNL_NLS_LNK_GETNLS . '" '
		. 'onclick="javascript:msnl_FormHandler(\'msnl_nls\');" />'
		. '</div>';
	/*
	 * Write out the table of newsletters
	 */
	echo '<div id="msnl_div_main"><br />';
	echo '<table ' . $msnl_asCSS['TABLE_data'] . '>'
		. '<tr ' . $msnl_asCSS['TR_hdr'] . '>'
		. '<td>' . _MSNL_ADM_LAB_TOPIC . '</td>'
		. '<td>' . _MSNL_ADM_LAB_SENDER . '</td>'
		. '<td>' . _MSNL_NLS_LAB_DATESENT . '</td>'
		. '<td>' . _MSNL_NLS_LAB_CATEGORY . '</td>'
		. '<td>' . _MSNL_COM_LAB_ACTIONS
		. msnl_fShowHelp(_MSNL_COM_HLP_ACTIONS, _MSNL_COM_LAB_ACTIONS)
		. '</td></tr>';
	/************************************************************************
	* Cycle through the result set.
	************************************************************************/
	while ($row = $db->sql_fetchrow($result)) {
		$msnl_asRec['nid'] = intval($row['nid']);
		$msnl_asRec['cid'] = intval($row['cid']);
		$msnl_asRec['ctitle'] = msnl_fXMLEntities($row['ctitle']);
		$msnl_asRec['topic'] = msnl_fXMLEntities($row['topic']);
		$msnl_asRec['sender'] = msnl_fXMLEntities($row['sender']);
		$msnl_asRec['datesent'] = $row['datesent'];
		$msnl_asRec['filename'] = $row['filename'];
		/************************************************************************
		* Write out the list of categories found.
		************************************************************************/
		echo '<tr ' . $msnl_asCSS['TR_rows'] . ' onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'" onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'">'
			. '<td ' . $msnl_asCSS['TD_left_nw'] . '><span class="thick">' . $msnl_asRec['topic'] . '</span></td>'
			. '<td ' . $msnl_asCSS['TD_left_nw'] . '>' . $msnl_asRec['sender'] . '</td>'
			. '<td ' . $msnl_asCSS['TD_center_nw'] . '>' . $msnl_asRec['datesent'] . '</td>'
			. '<td ' . $msnl_asCSS['TD_left_nw'] . '>' . $msnl_asRec['ctitle'] . '</td>'
			. '<td ' . $msnl_asCSS['TD_left_nw'] . '>';
		$msnl_sURL = './modules.php?name=' . $msnl_sModuleNm . '&amp;op=msnl_nls_view&amp;msnl_nid=' . $msnl_asRec['nid'];
		if (@file_exists('modules/' . $msnl_sModuleNm . '/archive/' . $msnl_asRec['filename'])) {
			echo '<a href="' . $msnl_sURL . '" onclick="window.open(this.href, \'ViewNewsletter\'); return false" '
				. 'title="' . _MSNL_NLS_LNK_VIEWNL . '">'
				. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/view.png" height="16" width="16" '
				. 'alt="' . _MSNL_NLS_LNK_VIEWNL . '" />'
				. '</a>&nbsp;';
		}
		if ($msnl_asRec['nid'] > 2) {
			echo '<a href="javascript:msnl_ObjHandler(\'msnl_nls_chg\',\'msnl_nid\',\'' . $msnl_asRec['nid'] . '\');" '
				. 'title="' . _MSNL_NLS_LNK_NLSCHG . '">'
				. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/change.png" height="16" width="16" '
				. 'alt="' . _MSNL_NLS_LNK_NLSCHG . '" />'
				. '</a>'
				. '&nbsp;&nbsp;'
				. '<a href="javascript:msnl_ObjHandler(\'msnl_nls_del\',\'msnl_nid\',\'' . $msnl_asRec['nid'] . '\');" '
				. 'title="' . _MSNL_NLS_LNK_NLSDEL . '">'
				. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/delete.png" height="16" width="16" '
				. 'alt="' . _MSNL_NLS_LNK_NLSDEL . '" />'
				. '</a>'
				. '&nbsp;&nbsp;';
		}
		echo '</td></tr>';
	}
	echo '</table>';
	if ($resultcount < 1) {
		echo '<p class="thick">' . _MSNL_NLS_MSG_NONLSS . '</p>';
	}
	echo '</div>' . '</form>';
}
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();
// Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

