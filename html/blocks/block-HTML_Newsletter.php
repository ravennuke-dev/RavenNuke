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
if (!defined('BLOCK_FILE') and !defined('NUKE_FILE')) {
	Header('Location: index.php');
	die();
}
/************************************************************************
* Initialize and assign key block variables.
************************************************************************/
global $db, $prefix, $msnl_gasModCfg, $msnl_asCSS, $currentlang, $language, $msnl_sModuleNm;
$msnl_sModuleNm = 'HTML_Newsletter'; //If you change the module directory, change every instance of this definition
if (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-' . $currentlang . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-' . $currentlang . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-' . $language . '.php')) {
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-' . $language . '.php';
} elseif (file_exists('modules/' . $msnl_sModuleNm . '/language/lang-english.php')) { // Default module lang
	include_once 'modules/' . $msnl_sModuleNm . '/language/lang-english.php';
}
require_once 'modules/' . $msnl_sModuleNm . '/javascript.php';
require_once 'modules/' . $msnl_sModuleNm . '/functions.php';
require_once 'modules/' . $msnl_sModuleNm . '/config.php';
require_once 'modules/' . $msnl_sModuleNm . '/style.php';
/************************************************************************
* Build block content.
************************************************************************/
$content = '<div>';
if ($msnl_gasModCfg['scroll'] == 1) {
	$content .= '<marquee behavior="scroll" align="center" direction="up" '
		. 'height="' . $msnl_gasModCfg['scroll_height'] . '" '
		. 'scrollamount="' . $msnl_gasModCfg['scroll_amt'] . '" '
		. 'scrolldelay="' . $msnl_gasModCfg['scroll_delay'] . '" '
		. 'onmouseover="this.stop()" onmouseout="this.start()">' . "\n";
}
//Get Newsletter List and build the block content
if ($msnl_gasModCfg['show_categories'] == 1) { //Build SQL for displaying categories
	$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, '
		. '`ctitle`, `cblocklimit`, `filename`  FROM `'
		. $prefix . '_hnl_newsletters` as nl, `'
		. $prefix . '_hnl_categories` nc WHERE nl.`cid` = nc.`cid` '
		. 'ORDER BY `ctitle` ASC, `datesent` DESC';
} else { //Build SQL for displaying just date sorted list of newsletters
	$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, '
		. '`ctitle`, `cblocklimit`  FROM `'
		. $prefix . '_hnl_newsletters` as nl, `'
		. $prefix . '_hnl_categories` nc WHERE nl.`cid` = nc.`cid` ORDER BY `datesent` DESC';
}
$msnl_result2 = msnl_fSQLCall($sql);
$msnl_iTotNls = 0; //Index for total number of newsletters displayed
$msnl_iNbrNls = 1; //Index for number of newsletters displayed within a category
$msnl_sPrevCat = ''; //For determining category breaks
$msnl_iMoreNls = 0; //Flag for when to display the "More Newsletters..." link
while ($row = $db->sql_fetchrow($msnl_result2)) {
	$msnl_iNID = intval($row['nid']);
	$msnl_iCID = intval($row['cid']);
	$msnl_sTopic = msnl_fXMLEntities($row['topic']);
	$msnl_sSender = msnl_fXMLEntities($row['sender']);
	$msnl_sDatesent = $row['datesent'];
	$msnl_iView = intval($row['view']);
	$msnl_sGroups = $row['groups'];
	$msnl_iHits = intval($row['hits']);
	$msnl_sCtitle = msnl_fXMLEntities($row['ctitle']);
	$msnl_iCblocklimit = intval($row['cblocklimit']);
	$msnl_filename = $row['filename'];
	if ($msnl_gasModCfg['show_categories'] == 1) { //Need to do more work if we are to place newsletters in categories
		if (msnl_fIsViewable($msnl_iView, $msnl_iCID, $msnl_sGroups)) { //Is the newsletter viewable by the user?
			if ($msnl_iTotNls <= $msnl_gasModCfg['blk_lmt']) { //Can still fit more newsletters in the block?
				if ($msnl_sCtitle <> $msnl_sPrevCat) { //Do we need to write out a new category heading?
					$content .= '<p ' . $msnl_asCSS['BLOCK_center'] . '><strong>'
						. '<a href="modules.php?name=' . $msnl_sModuleNm . '" '
						. 'title="' . _MSNL_NLS_LNK_VIEWNLARCHS . '">' . $msnl_sCtitle . '</a></strong></p>' . "\n";
					$msnl_sPrevCat = $msnl_sCtitle;
					$msnl_iNbrNls = 1;
				}
				if ($msnl_iNbrNls <= $msnl_iCblocklimit) { //Can still fit more newsletters into the category display?
					$mod_row = msnl_fGetBlockRow($msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent, $msnl_filename);
					if (!empty($mod_row)) {
						$content .= '<p ' . $msnl_asCSS['BLOCK_left'] . '>' . $mod_row . '</p>';
						$msnl_iNbrNls++;
						$msnl_iTotNls++;
					}
				} else {
					$msnl_iMoreNls = 1;
				}
			} else { //Have reached the limit on number of newsletters allowed in the block
				$msnl_iMoreNls = 1; //Flag that we still have more viewable newsletters than can fit in the block
				break;
			}
		}
	} else { //No categories
		if (msnl_fIsViewable($msnl_iView, $msnl_gasModCfg['nsn_groups'], $msnl_iCID, $msnl_sGroups)) { //Check if newsletter is viewable by the user
			if ($msnl_iNbrNls <= $msnl_gasModCfg['blk_lmt']) { //Can still fit more newsletters in the block
				$mod_row = msnl_fGetBlockRow($msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent, $msnl_filename);
				if (!empty($mod_row)) {
					$content .= '<p ' . $msnl_asCSS['BLOCK_left'] . '>' . $mod_row . '</p>';
					$msnl_iNbrNls++;
					$msnl_iTotNls++;
				}
			} else { //Have reached the limit on number of newsletters allowed in the block
				$msnl_iMoreNls = 1; //Flag that we still have more viewable newsletters than can fit in the block
				break;
			}
		}
	} //End of showcategories IF

} //End of while loop for list of newsletters
if ($msnl_iTotNls == 0) { //There were no newsletters to view
	$content .= '<p ' . $msnl_asCSS['BLOCK_center'] . '><strong>' . _MSNL_NLS_LST_MSG_NONLS . '</strong></p>';
}
if ($msnl_iMoreNls) {
	$content .= '<p ' . $msnl_asCSS['BLOCK_center'] . '><strong>'
		. '<a href="modules.php?name=' . $msnl_sModuleNm . '" '
		. 'title="' . _MSNL_NLS_LNK_VIEWNLARCHS . '">' . _MSNL_NLS_LAB_MORENLS . '</a></strong></p>';
}
if ($msnl_gasModCfg['scroll'] == 1) {
	$content .= '</marquee>';
}
if ($content == '<div>') {
	$content .= _MSNL_NLS_LST_MSG_NONLS;
}
$content .= '</div>' . "\n";


