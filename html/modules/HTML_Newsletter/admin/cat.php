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
msnl_fShowSubTitle(_MSNL_CAT_LAB_CATCFG);
/************************************************************************
* Build the SQL for the categories to display.
************************************************************************/
$sql = 'SELECT * FROM ' . $prefix . '_hnl_categories';
$result = msnl_fSQLCall($sql);
$resultcount = $db->sql_numrows($result);
/************************************************************************
* Check if there was an error getting the categories, and if not, write them
* out to the screen.
************************************************************************/
if (!$result) {
	msnl_fRaiseAppError(_MSNL_CAT_ERR_DBGETCATS);
} else {
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_cat" />';
	echo '<input type="hidden" name="msnl_cid" value="0" />';
	echo '<div ' . $msnl_asCSS['BLOCK_right'] . '>'
		. '<input type="button" value="' . _MSNL_CAT_LAB_ADDCAT . '" title="' . _MSNL_CAT_LNK_ADDCAT . '" '
		. 'onclick="javascript:msnl_FormHandler(\'msnl_cat_add\');" />'
		. '</div>';
	echo '<div id="msnl_div_main"><br />';
	/************************************************************************
	* If we found categories, write them out along with respective actions.
	************************************************************************/
	if ($resultcount < 1) {
		msnl_fRaiseAppError(_MSNL_CAT_ERR_NOCATS);
	} else {
		echo '<table ' . $msnl_asCSS['TABLE_data'] . '>'
			. '<tr ' . $msnl_asCSS['TR_hdr'] . '>'
			. '<td>' . _MSNL_CAT_LAB_CATTITLE . '</td>'
			. '<td>' . _MSNL_CAT_LAB_CATDESC . '</td>'
			. '<td>' . _MSNL_CAT_LAB_CATBLOCKLMT . '</td>'
			. '<td>' . _MSNL_COM_LAB_ACTIONS
			. msnl_fShowHelp(_MSNL_COM_HLP_ACTIONS, _MSNL_COM_LAB_ACTIONS)
			. '</td>'
			. '</tr>';
		/************************************************************************
		* Cycle through the result set.
		************************************************************************/
		while ($row = $db->sql_fetchrow($result)) {
			$msnl_asRec['cid'] = intval($row['cid']);
			$msnl_asRec['ctitle'] = msnl_fXMLEntities($row['ctitle']);
			$msnl_asRec['cdescription'] = msnl_fXMLEntities($row['cdescription']);
			$msnl_asRec['cblocklimit'] = intval($row['cblocklimit']);
			/************************************************************************
			* Write out the list of categories found.
			************************************************************************/
			echo '<tr ' . $msnl_asCSS['TR_rows'] . ' onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'" onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'">'
				. '<td ' . $msnl_asCSS['TD_left_nw'] . '><span class="thick">' . $msnl_asRec['ctitle'] . '</span></td>'
				. '<td>' . $msnl_asRec['cdescription'] . '</td>'
				. '<td ' . $msnl_asCSS['TD_center_nw'] . '>' . $msnl_asRec['cblocklimit'] . '</td>'
				. '<td ' . $msnl_asCSS['TD_center_nw'] . '>';
			if ($msnl_asRec['cid'] > 1) {
				echo '<a href="javascript:msnl_ObjHandler(\'msnl_cat_chg\',\'msnl_cid\',\'' . $msnl_asRec['cid'] . '\');" '
					. 'title="' . _MSNL_CAT_LNK_CATCHG . '">'
					. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/change.png" height="16" width="16" '
					. 'alt="' . _MSNL_CAT_LNK_CATCHG . '" />'
					. '</a>'
					. '&nbsp;&nbsp;'
					. '<a href="javascript:msnl_ObjHandler(\'msnl_cat_del\',\'msnl_cid\',\'' . $msnl_asRec['cid'] . '\');" '
					. 'title="' . _MSNL_CAT_LNK_CATDEL . '">'
					. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/delete.png" height="16" width="16" '
					. 'alt="' . _MSNL_CAT_LNK_CATDEL . '" />'
					. '</a>';
			}
			echo '</td></tr>';
		} //End WHILE loop
		echo '</table>';
	} //End IF for check of no rows
	echo '</div>' . '</form>';
} //End IF for SQL call
/************************************************************************
* Close up the web page.
************************************************************************/
closetable();
//Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

