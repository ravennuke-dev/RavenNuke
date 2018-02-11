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
* Get the Newsletter to view
************************************************************************/
$msnl_iNID = intval($msnl_nid);
$sql = 'SELECT `filename`, `hits`, `view`, `groups`, `cid` FROM `'
	. $prefix . '_hnl_newsletters` '
	. 'WHERE `nid` = \'' . $msnl_iNID . '\'';
$result = msnl_fSQLCall($sql);
$resultcount = $db->sql_numrows($result);
/************************************************************************
* View the newsletter if no errors and the file exists
************************************************************************/
if (!$result || $resultcount < 1) { // Bad SQL call
	msnl_fRaiseAppError(_MSNL_NLS_VIEW_ERR_DBGETNL);
} else { // Successful SQL call
	$row = $db->sql_fetchrow($result);
	$msnl_asRec['hits'] = intval($row['hits']);
	$msnl_asRec['cid'] = intval($row['cid']);
	$msnl_asRec['view'] = intval($row['view']);
	$msnl_asRec['groups'] = $row['groups'];
	$msnl_asRec['filename'] = $row['filename'];
	if (msnl_fIsViewable($msnl_asRec['view'], $msnl_asRec['cid'], $msnl_asRec['groups'])) { // User is allowed to view this newsletter
		if (!is_admin($admin)) { // Increment hits on the newsletter as long as not admin
			$msnl_asRec['hits']++;
			$sql = 'UPDATE `' . $prefix . '_hnl_newsletters` '
				. 'SET `hits` = \'' . $msnl_asRec['hits'] . '\' '
				. 'WHERE `nid` = \'' . $msnl_iNID . '\'';
			$db->sql_query($sql);
		}
		// Get the newsletter file then echo the newsletter
		$msnl_sFilePath = 'modules/' . $msnl_sModuleNm . '/archive/' . $msnl_asRec['filename'];
		if (@file_exists($msnl_sFilePath)) {
			include_once $msnl_sFilePath;
		} else {
			msnl_fRaiseAppError(_MSNL_NLS_VIEW_ERR_CANNOTFIND);
		}
		echo $emailfile;
	} else { // user is not allowed to view this newsletter
		msnl_fRaiseAppError(_MSNL_NLS_VIEW_ERR_NOTAUTH);
	}
}

