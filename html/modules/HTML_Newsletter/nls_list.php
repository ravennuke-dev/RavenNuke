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
* Start displaying module content
************************************************************************/
include_once 'header.php';
$msnl_giHeadersSent = 1;
msnl_fPrintHTML('BEGIN');
require_once 'modules/' . $msnl_sModuleNm . '/javascript.php';
echo '<div id="msnl_div_title">';
opentable();
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<span class="title">'
	. _MSNL_NLS_LST_LAB_ARCHTITL
	. '</span>';
if (is_admin($admin)) { // Show link to administration if an admin is logged on
	echo '<br />'
		. '[ <a href="' . $admin_file . '.php?op=msnl_admin" title="' . _MSNL_NLS_LST_LNK_ADMNLS
		. '">' . _MSNL_NLS_LST_LAB_ADMNLS . '</a> ]';
}
echo '</p>';
closetable();
echo '<br /></div>' . "\n";
opentable();
/************************************************************************
* Get Newsletter List
************************************************************************/
$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, '
	. '`hits`, `ctitle`, `cblocklimit`, `filename`  FROM `'
	. $prefix . '_hnl_newsletters` nl, `'
	. $prefix . '_hnl_categories` nc '
	. 'WHERE nl.`cid` = nc.`cid` ORDER BY `ctitle` ASC, `datesent` DESC';
$result = msnl_fSQLCall($sql);
/************************************************************************
* If call was successful, list the newsletters.
************************************************************************/
if (!$result) { // Bad SQL call
	msnl_fRaiseAppError(_MSNL_NLS_LST_MSG_NONLS);
} else { // Successful SQL call
	echo '<div id="msnl_div_listnls">';
	opentable();
	$idx_tot_nls = 0; //Index for total number of newsletters displayed
	$idx_nl_nbr = 1; // Index for number of newsletters displayed within a category
	$prev_category = ''; // For determining category breaks
	while ($row = $db->sql_fetchrow($result)) {
		$nid = intval($row['nid']);
		$cid = intval($row['cid']);
		$topic = msnl_fXMLEntities($row['topic']);
		$sender = msnl_fXMLEntities($row['sender']);
		$datesent = $row['datesent'];
		$view = intval($row['view']);
		$groups = $row['groups'];
		$hits = intval($row['hits']);
		$ctitle = msnl_fXMLEntities($row['ctitle']);
		$cblocklimit = intval($row['cblocklimit']);
		$filename = $row['filename'];
		if (msnl_fIsViewable($view, $cid, $groups)) { // Is the newsletter viewable by the user?
			if ($ctitle != $prev_category) { // Do we need to write out a new category heading?
				if ($idx_nl_nbr != 1) {
					CloseTable();
					echo '<br />';
					OpenTable();
				}
				echo '<p ' . $msnl_asCSS['BLOCK_center'] . '><strong>' . $ctitle . '</strong></p>';
				$prev_category = $ctitle;
				$idx_nl_nbr = 1;
			} // End of show new category title
			$mod_row = msnl_fGetBlockRow($idx_nl_nbr, $nid, $topic, $sender, $hits, $datesent, $filename);
			if (!empty($mod_row)) {
				echo '<p>' . $mod_row . '</p>';
				$idx_nl_nbr++;
				$idx_tot_nls++;
			}
		} // End of msnl_fIsViewable IF

	} // End of while loop for list of newsletters
	if ($idx_tot_nls == 0) {
		echo _MSNL_NLS_LST_MSG_NONLS;
	}
	CloseTable();
	echo '</div>' . "\n";
} // End If of check for successful DB call
CloseTable();
msnl_fPrintHTML('END');
include_once 'footer.php';

