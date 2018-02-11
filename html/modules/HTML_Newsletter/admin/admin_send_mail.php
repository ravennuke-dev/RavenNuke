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
* Initialize and assign key module variables.
************************************************************************/
$msnl_sFileTestEmail = './modules/' . $msnl_sModuleNm . '/archive/testemail.php';
$msnl_sFileTmp = './modules/' . $msnl_sModuleNm . '/archive/tmp.php';
/************************************************************************
* Determine if we're in batch send mode. Does nothing right now!
************************************************************************/
if (isset($_POST['msnl_op']) && $_POST['msnl_op'] == 'hnlnxt') {
	define('MSNL_BATCH_NEXT', true);
}
/************************************************************************
* Make sure incoming POST variables are OK and validate certain conditions
************************************************************************/
include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_check_post.php';
if (sizeof($msnl_asERR) != 0) { // Had validation errors so display them
	opentable();
	msnl_fShowValErr();
	msnl_fShowBtnGoBack();
	closetable();
} else { // Did not have errors so proceed to newsletter send
	opentable();
	msnl_fShowSubTitle(_MSNL_ADM_SEND_LAB_SENDNL);
	/************************************************************************
	* Either get existing file or generate Newsletter file and also key
	* newsletter variables.
	************************************************************************/
	if (defined('MSNL_SENDTESTED')) { // Test newsletter was already created and sent so use it
		if (@file_exists($msnl_sFileTestEmail)) {
			include_once $msnl_sFileTestEmail;
			$msnl_sTopic = $ftopic;
			$msnl_sSender = $fsender;
			$msnl_iCID = intval($fcid);
			$msnl_sEmailText = $emailfile;
		} else {
			msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_NOTESTEMAIL);
		}
	} else { // Had not previously created and sent, so create it
		include_once('modules/' . $msnl_sModuleNm . '/admin/admin_make_nls.php');
	}
	/************************************************************************
	* Determine the proper View settings.
	************************************************************************/
	switch ($_POST['msnl_sendemail']) {
		case 'anonymous': $msnl_iView = 0; break;
		case 'massmail':  $msnl_iView = 1; break;
		case 'newsletter': $msnl_iView = 2; break;
		case 'paidsubscribers': $msnl_iView = 3; break;
		case 'nsngroups': $msnl_iView = 4; break;
		case 'adhoc': $msnl_iView = 5; break;
		case 'testemail': $msnl_iView = 99; break;
		default: msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_INVALIDVIEW);
	}
	msnl_fDebugMsg('msnl_iView = ' . $msnl_iView);
	/************************************************************************
	* If NSN Groups were selected, determine proper groups setting.
	************************************************************************/
	$msnl_sGroups = '';
	if ($msnl_iView == 4) { // Ignore group input if NSN Groups option is not selected
		msnl_fDebugMsg($msnl_nsngroupid);
		$msnl_sGroups = msnl_fGrpsImplode($msnl_nsngroupid);
	}
	msnl_fDebugMsg('msnl_sGroups = ' . $msnl_sGroups);
	/************************************************************************
	* Build datesent and filename strings and write the newsletter file.
	************************************************************************/
	$msnl_sDatesent = date('Y-m-d');
	if ($msnl_iView >= 90) { // Sending testemail to the Admin
		$msnl_sFilename = 'testemail.php';
	} else {
		$msnl_sFilename = time() . '.php';
	}
	$msnl_sFFilename = './modules/' . $msnl_sModuleNm . '/archive/' . $msnl_sFilename;
	msnl_fDebugMsg('msnl_sFFilename = ' . $msnl_sFFilename);
	if (!@file_exists($msnl_sFFilename)) {
		if (!@touch($msnl_sFFilename)) { // Cannot create the file - archive directory permissions probably not correct
			msnl_fRaiseAppError(_MSNL_COM_ERR_FILENOTWRITEABLE);
		}
	}
	if (TNNL_PHP_NOT_CGI) @chmod($msnl_sFFilename, 0766); // Was added to avoid issues with hosts using suExec/phpSuExec
	msnl_fDebugMsg('msnl_sFileTestEmail = ' . $msnl_sFileTestEmail);
	if (defined('MSNL_SENDTESTED')) { // If using existing NL, copy it to new file
		if (@file_exists($msnl_sFileTestEmail)) {
			if (!@copy($msnl_sFileTestEmail, $msnl_sFFilename)) {
				msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_CREATENL);
			}
		} else {
			msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_NOTESTEMAIL);
		}
	} else { // Have to create new file
		if (@file_exists($msnl_sFFilename)) { // File exists already so make sure can write to it
			if (TNNL_PHP_NOT_CGI) @chmod($msnl_sFFilename, 0766); // Was added to avoid issues with hosts using suExec/phpSuExec
		}
		$msnl_oFile = @fopen($msnl_sFFilename, 'w');
		@fwrite($msnl_oFile, $msnl_sNewsletter);
		@fclose($msnl_oFile);
	}
	if (TNNL_PHP_NOT_CGI) @chmod($msnl_sFFilename, 0664); // Was added to avoid issues with hosts using suExec/phpSuExec
	msnl_fDebugMsg('msnl_sFilename = ' . $msnl_sFilename);
	/************************************************************************
	* Add newsletter entry into the database.
	************************************************************************/
	if ($msnl_iView < 90) { // Do not insert if sending testemail to Admin ONLY
		$msnl_iNID = msnl_fAddNls($msnl_iCID, $msnl_sTopic, $msnl_sSender, $msnl_sFilename, $msnl_sDatesent, $msnl_iView, $msnl_sGroups);
	} else {
		$msnl_iNID = 2;
	}
	/************************************************************************
	* Build recipient email SQL string.
	************************************************************************/
	switch ($msnl_iView) {
		case 1:  // All registered users
			$sql = 'SELECT `user_id`, `user_email` FROM `' . $user_prefix . '_users` WHERE `user_email` > \'\' AND `user_active` > 0 '
				. 'ORDER BY `user_id`';
			break;
		case 2:  // Newsletter subscribers
			$sql = 'SELECT `user_id`, `user_email`, `name`, `username` FROM `' . $user_prefix . '_users` '
				. 'WHERE `user_email` > \'\' AND `user_active` > 0 AND `newsletter`=\'1\' ORDER BY `user_id`';
			break;
		case 3:  // Paid subscribers
			$sql = 'SELECT `user_id`, `user_email`, `name`, `username` FROM `'
				. $user_prefix . '_users` a, `'
				. $prefix . '_subscriptions` b '
				. 'WHERE a.`user_id`=b.`userid` AND `user_email` > \'\' AND `user_active` > 0 ORDER BY a.`user_id`';
			break;
		case 4:  // NSN Groups users
			$nsngrpstr = '\'' . str_replace('-', "','", $msnl_sGroups) . '\'';
			$sql = 'SELECT DISTINCT `user_id`, `user_email`, `name`, `username` FROM `'
				. $user_prefix . '_users` a, `'
				. $prefix . '_nsngr_users` b '
				. 'WHERE b.`uid` = a.`user_id` AND `gid` IN (' . $nsngrpstr . ')  AND `user_email` > \'\' AND `user_active` > 0 '
				. 'ORDER BY a.`user_id`';
			break;
		case 5:  // Send to Ad-Hoc email address list
			$sql = 'adhoc';
			break;
		default: // Send to Admin ONLY (99)
			$sql = 'testemail';
	}
	/************************************************************************
	* Send out the newsletter!
	************************************************************************/
	$msnl_sURL = './modules.php?name=' . $msnl_sModuleNm
		. '&amp;op=msnl_nls_view&amp;msnl_nid=' . $msnl_iNID;
	$msnl_sNlsLnk = '<p><a href="' . $msnl_sURL . '" title="' . _MSNL_NLS_LNK_VIEWNL . '" '
		. 'onclick="window.open(this.href, \'ViewNewsletter\'); return false">'
		. $msnl_sTopic . '</a></p>';
	if ($msnl_iView == 0) { // All Visitors - no send of email necessary
		echo '<p>' . _MSNL_ADM_SEND_MSG_ANONYMOUS . '</p>';
	} else {
		$msnl_iUserID = msnl_fSendNls($msnl_sEmailText, $msnl_sSender, $sql, $msnl_asEmailAddresses);
		if ($msnl_iUserID) { // A newsletter was sent!
			echo '<p>' . _MSNL_ADM_SEND_MSG_SENDSUCCESS . '</p>';
		} else { // Newsletter failed to send
			echo '<p>' . _MSNL_ADM_SEND_MSG_SENDFAILURE . '</p>';
		}

	}
	echo $msnl_sNlsLnk;
	/************************************************************************
	* Clean up temporary newsletter files.
	************************************************************************/
	if (defined('MSNL_SENDTESTED')) {
		if (@file_exists($msnl_sFileTestEmail)) {
			if (!@unlink($msnl_sFileTestEmail)) {
				msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DELFILETEST);
			}
		}
	}
	if (@file_exists($msnl_sFileTmp)) {
		if (!@unlink($msnl_sFileTmp)) {
			msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DELFILETMP);
		}
	}
	closetable();
	unset($_POST);
}

