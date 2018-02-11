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
if (!defined('MSNL_LOADED')) {
	die('Illegal File Access');
}
/************************************************************************
* Initialize and assign key module variables.
************************************************************************/
// Get phpBB configuration information to assist with date/time conversions
$msnl_asPHPBBCfg = array();
$sql = 'SELECT `config_name`, `config_value` FROM `' . $prefix . '_bbconfig`';
$result = msnl_fSQLCall($sql);
if (!$result) { // Bad SQL call
	msnl_fRaiseAppError(_MSNL_COM_ERR_DBGETPHPBB);
} else {
	while ($row = $db->sql_fetchrow($result)) {
		$msnl_asPHPBBCfg[$row['config_name']] = $row['config_value'];
	}
}
/************************************************************************
* Function: msnl_fFormatDate
* Inputs:   $format  = TBD
*           $gmepoch = TBD
*           $tz      = TBD
* Returns:  A string with the formatted date
* Usage:    Copied from phpBB functions.php and modified for our use for
*           correct date conversions.
************************************************************************/
function msnl_fFormatDate($format, $gmepoch, $tz) {
	global $msnl_asPHPBBCfg, $lang;
	static $translate;
	return (!empty($translate)) ? strtr(@gmdate($format, $gmepoch+(3600*$tz)), $translate) : @gmdate($format, $gmepoch+(3600*$tz));
}
/************************************************************************
* Function: msnl_fMenuAdm
* Inputs:   None
* Returns:  None
* Usage:    Shows the Administration Main Menu.
************************************************************************/
function msnl_fMenuAdm() {
	global $admin_file, $msnl_sModuleNm, $msnl_gasModCfg, $msnl_asCSS;
	$url = 'http://wiki.montegoscripts.com/w/HTML_Newsletter';
	echo '<div id="msnl_div_adm_menu">';
	opentable();
	echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<span class="title">'
		. ucwords(str_replace('_', ' ', $msnl_sModuleNm)) . ' ' . _MSNL_LAB_ADMIN
		. '</span>'
		. '<br />'
		. '( ' . _MSNL_COM_LAB_VERSION . ' ' . $msnl_gasModCfg['version'] . ' )'
		. '<br /><br />';
	echo '[ <a href="' . $admin_file . '.php?op=msnl_admin" title="' . _MSNL_LNK_CREATENL . '">' . _MSNL_LAB_CREATENL . '</a>';
	if (file_exists('modules/' . $msnl_sModuleNm . '/archive/testemail.php') ||
		(isset($_POST['msnl_sendemail']) && $_POST['msnl_sendemail'] == 'testemail' && $_POST['op'] != 'msnl_admin_preview'
		&& $_POST['op'] != 'msnl_admin')) {
		echo ' | <a class="rn_csrf" href="' . $admin_file . '.php?op=msnl_admin_send_tested" title="' . _MSNL_LNK_SENDTESTED . '">' . _MSNL_LAB_SENDTESTED . '</a>';
	} else {
		echo ' | ' . _MSNL_LAB_SENDTESTED;
	}
	echo ' | <a href="' . $admin_file . '.php?op=msnl_cfg" title="' . _MSNL_LNK_MAINCFG . '">' . _MSNL_LAB_MAINCFG . '</a>'
		. ' | <a href="' . $admin_file . '.php?op=msnl_cat" title="' . _MSNL_LNK_CATEGORYCFG . '">' . _MSNL_LAB_CATEGORYCFG . '</a>'
		. ' | <a href="' . $admin_file . '.php?op=msnl_nls&amp;cid=1" title="' . _MSNL_LNK_MAINTAINNLS . '">' . _MSNL_LAB_MAINTAINNLS . '</a>'
		. ' | <a href="' . $admin_file . '.php" title="' . _MSNL_LNK_SITEADMIN . '">' . _MSNL_LAB_SITEADMIN . '</a>'
		. ' | <a href="modules.php?name=' . $msnl_sModuleNm . '" title="' . _MSNL_LNK_NLARCHIVES . '">' . _MSNL_LAB_NLARCHIVES . '</a>'
		. ' | <a href="' . $url . '" title="' . _MSNL_LNK_NLDOCS . '" onclick="window.open(this.href, \'NewsletterWiki\'); return false">' . _MSNL_LAB_NLDOCS . '</a>'
		. ' ]';
	echo '</p>';
	closetable();
	echo '<br /></div>';
}
/************************************************************************
* Function: msnl_fGetNbrRecipients
* Inputs:   $recipients = the list to send emails to
*           $gid        = the NSN Group number
* Returns:  Nbr of recipients
* Usage:    Centralizes the logic for returning the appropriate number
*           of potential email recipients.
************************************************************************/
function msnl_fGetNbrRecipients($recipients, $gid) {
	global $prefix, $user_prefix, $db;
	$gid = intval($gid);
	switch ($recipients) {
		case 'newsletter': // Newsletter subscribers
			$sql = 'SELECT count(`newsletter`) AS r_cnt FROM `' . $user_prefix . '_users` WHERE `newsletter` = \'1\' '
				. 'AND `user_email` > \'\' AND `user_active` > 0';
			break;
		case 'massmail': // All registered users
			$sql = 'SELECT count(`user_email`) AS r_cnt FROM `' . $user_prefix . '_users` WHERE `user_email` > \'\' '
				. 'AND `user_active` > 0';
			break;
		case 'paidsubscribers': // Only paid subscribers to the web site
			$sql = 'SELECT count(`userid`) AS r_cnt FROM `' . $prefix . '_subscriptions` a, `' . $user_prefix . '_users` b '
				. 'WHERE a.`userid` = b.`user_id` AND `user_email` > \'\' AND b.`user_active` > 0';
			break;
		case 'nsngroups': // For a particular NSN Group
			$sql = 'SELECT count(`uid`) AS r_cnt FROM `' . $prefix . '_nsngr_users` a, `' . $user_prefix . '_users` b '
				. 'WHERE a.`uid` = b.`user_id` AND `gid` = \'' . $gid . '\' AND b.`user_email` > \'\' AND b.`user_active` > 0';
			break;
		default:
			die('Access to function denied!!');
			break;
	}
	$result = msnl_fSQLCall($sql);
	if (!$result) {
		msnl_fRaiseAppError(_MSNL_COM_ERR_DBGETRECIPIENTS . '&nbsp;' . $recipients);
	} else {
		$row = $db->sql_fetchrow($result);
		$nbrusers = intval($row['r_cnt']);
		return $nbrusers;
	}
}
/************************************************************************
* Function: msnl_fGetSendTo
* Inputs:   None
* Returns:  HTML string for:
* Usage:    Shows the options list for "Who to Send the Newsletter To".
************************************************************************/
function msnl_fGetSendTo() {
	global $prefix, $db, $msnl_gasModCfg, $msnl_asCSS, $msnl_asHTML;
	if (!isset($_POST['msnl_sendemail'])) $_POST['msnl_sendemail'] = '';
	if (!isset($_POST['msnl_emailaddresses'])) $_POST['msnl_emailaddresses'] = '';
	$sHTML = '<div id="msnl_div_sendto">'
		. '<br />'
		. $msnl_asHTML['OPEN']
		. '<p><strong>' . _MSNL_ADM_LAB_WHOSNDTO . '</strong></p>'
		. '<table ' . $msnl_asCSS['TABLE_adm'] . ' width="100%">'
		. '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
		. _MSNL_ADM_LAB_CHOOSESENDTO
		. ':&nbsp;'
		. '</td>'
		. '<td></td></tr>'
		. '<tr ' . $msnl_asCSS['TR_top'] . '>'
		. '<td ' . $msnl_asCSS['TD_left_nw'] . ' colspan="2">';
	/*
	 * Current subscribers to the site Newsletter
	 */
	$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTONLSUBS, _MSNL_ADM_LAB_WHOSNDTONLSUBS)
		. '<input type="radio" name="msnl_sendemail" value="newsletter"';
	if ($_POST['msnl_sendemail'] == 'newsletter') {
		$sHTML .= ' checked="checked"';
	}
	$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTONLSUBS . ' ( '
		. msnl_fGetNbrRecipients('newsletter', NULL) . ' '
		. _MSNL_ADM_LAB_SUBSCRIBEDUSRS . ' )<br />';
	/*
	 * All registered users
	 */
	$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTOALLREG, _MSNL_ADM_LAB_WHOSNDTOALLREG)
		. '<input type="radio" name="msnl_sendemail" value="massmail"';
	if ($_POST['msnl_sendemail'] == 'massmail') {
		$sHTML .= ' checked="checked"';
	}
	$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTOALLREG . ' ( '
		. msnl_fGetNbrRecipients('massmail', NULL) . ' ' . _MSNL_ADM_LAB_USERS . ' )<br />';
	/*
	 * Users with paid subscriptions
	 * @todo  montego: need to look into if date is a factor
	 */
	$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTOPAID, _MSNL_ADM_LAB_WHOSNDTOPAID)
		. '<input type="radio" name="msnl_sendemail" value="paidsubscribers"';
	if ($_POST['msnl_sendemail'] == 'paidsubscribers') {
		$sHTML .= ' checked="checked"';
	}
	$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTOPAID . ' ( '
		. msnl_fGetNbrRecipients('paidsubscribers', NULL) . ' '
		. _MSNL_ADM_LAB_PAIDUSRS . ' )<br />';
	/*
	 * Users in a particular NSN Groups group
	 */
	if ($msnl_gasModCfg['nsn_groups'] == 1) {
		$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_NSNGRPUSRS, _MSNL_ADM_LAB_NSNGRPUSRS)
			. '<input type="radio" name="msnl_sendemail" value="nsngroups"';
		if ($_POST['msnl_sendemail'] == 'nsngroups') {
			$sHTML .= ' checked="checked"';
		}
		$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTONSNGRPS . '<br />';
	}
	/*
	 * Post Anonymous Newsletter -- i.e., for ALL to see in the Archives
	 */
	$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTOANONYV, _MSNL_ADM_LAB_WHOSNDTOANONYV)
		. '<input type="radio" name="msnl_sendemail" value="anonymous"';
	if ($_POST['msnl_sendemail'] == 'anonymous') {
		$sHTML .= ' checked="checked"';
	}
	$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTOANONY . '<br />';
	/*
	 * Admin Test Email
	 */
	if (!defined('MSNL_SENDTESTED')) { // Do not show the Admin Only option if sending a tested NL
		$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTOADM, _MSNL_ADM_LAB_WHOSNDTOADM)
			. '<input type="radio" name="msnl_sendemail" value="testemail"';
		if ($_POST['msnl_sendemail'] == 'testemail') {
			$sHTML .= ' checked="checked"';
		} elseif ($_POST['msnl_sendemail'] == '') {
			$sHTML .= ' checked="checked"';
		}
		$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTOADM . '<br />';
	}
	/*
	 * Ad-Hoc Email Distribution List
	 */
	$sHTML .= msnl_fShowHelp(_MSNL_ADM_HLP_WHOSNDTOADHOC, _MSNL_ADM_LAB_WHOSNDTOADHOC)
		. '<input type="radio" name="msnl_sendemail" value="adhoc"';
	if ($_POST['msnl_sendemail'] == 'adhoc') {
		$sHTML .= ' checked="checked"';
	}
	$sHTML .= ' />&nbsp;' . _MSNL_ADM_LAB_WHOSNDTOADHOC . ':<br />'
		. '<textarea name="msnl_emailaddresses" ' . $msnl_asCSS['INPUT_email']  . ' cols="100" rows="6">'
		. tnnlFilter($_POST['msnl_emailaddresses']) . '</textarea>';
	/*
	 * Close out this section
	 */
	$sHTML .= '</td></tr></table>';
	$sHTML .= $msnl_asHTML['CLOSE'];
	$sHTML .= '</div>';
	return $sHTML;
}
/************************************************************************
* Function: msnl_fGetNSNGroups
* Inputs:   None
* Returns:  HTML string for:
* Usage:    Shows the options list for the various NSN Groups.
************************************************************************/
function msnl_fGetNSNGroups() {
	global $prefix, $db, $msnl_gasModCfg, $msnl_nsngroupid, $msnl_asHTML, $msnl_asCSS;
	$asNSNGroups = array();
	if (isset($_POST['msnl_nsngroups'])) {
		$asNSNGroups = msnl_fGrpsExplode($_POST['msnl_nsngroups']);
	}
	$sHTML = '';
	if ($msnl_gasModCfg['nsn_groups'] == 1) {
		$sHTML .= '<div id="msnl_div_nsngrps">'
			. '<br />'
			. $msnl_asHTML['OPEN']
			. '<p><strong>' . _MSNL_ADM_LAB_CHOOSENSNGRP . '</strong><br />'
			. _MSNL_ADM_LAB_CHOOSENSNGRP1
			. '</p>'
			. '<table ' . $msnl_asCSS['TABLE_adm'] . '>'
			. '<tr ' . $msnl_asCSS['TR_top'] . '>'
			. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
			. msnl_fShowHelp(_MSNL_ADM_HLP_CHOOSENSNGRPUSRS, _MSNL_ADM_LAB_NSNGRPUSRS)
			. _MSNL_ADM_LAB_WHONSNGRP
			. ':&nbsp;'
			. '</td>'
			. '<td></td></tr>'
			. '<tr ' . $msnl_asCSS['TR_top'] . '>'
			. '<td ' . $msnl_asCSS['TD_left_nw'] . ' colspan="2">';
		$i = 0;
		$sql = 'SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`';
		$result = msnl_fSQLCall($sql);
		if (!$result) {
			msnl_fRaiseAppError(_MSNL_ADM_ERR_DBGETNSNGRPS);
		} else {
			while ($row = $db->sql_fetchrow($result)) {
				$gid = intval($row['gid']);
				$gname = $row['gname'];
				$sHTML .= '<input type="checkbox" name="msnl_nsngroupid[]" value="' . $gid . '"';
				if (in_array($gid, $asNSNGroups)) {
					$sHTML .= ' checked="checked"';
				}
				$sHTML .= ' />&nbsp;' . $gname . ' ( ' . msnl_fGetNbrRecipients('nsngroups', $gid) . ' '
					. _MSNL_ADM_LAB_NSNGRPUSRS . ' )<br />';
			}

		}
		// Close out this section
		$sHTML .= '</td></tr></table>';
		$sHTML .= $msnl_asHTML['CLOSE'];
		$sHTML .= '</div>';
	}
	return $sHTML;
}
/************************************************************************
* Function: msnl_fAddNls
* Inputs:   Same as the target database fields
* Returns:  $nid = The id number that was assigned to the new newsletter
* Usage:    Adds the newsletter meta-data to the database.
************************************************************************/
function msnl_fAddNls($msnl_iCID, $msnl_sTopic, $sSender, $msnl_sFilename, $msnl_sDatesent, $msnl_iView, $msnl_sGroups) {
	global $prefix, $db;
	$nid = 0;
	$msnl_sTopic = addslashes(msnl_fXMLDecode($msnl_sTopic));
	$sSender = addslashes(msnl_fXMLDecode($sSender));
	$sql = 'INSERT INTO `' . $prefix . '_hnl_newsletters` '
		. 'VALUES ('
		. 'NULL, '
		. '\'' . $msnl_iCID . '\', '
		. '\'' . $msnl_sTopic . '\', '
		. '\'' . $sSender . '\', '
		. '\'' . $msnl_sFilename . '\', '
		. '\'' . $msnl_sDatesent . '\', '
		. '\'' . $msnl_iView . '\', '
		. '\'' . $msnl_sGroups . '\', '
		. '\'0\''
		. ')';
	$result = msnl_fSQLCall($sql);
	if (!$result) { // Bad SQL call
		msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DBNLSINSERT);
	} else {
		// Now get the nid of the newsletter that was just inserted (for batch send purposes)
		$sql = 'SELECT MAX(`nid`) AS nid FROM `' . $prefix . '_hnl_newsletters`';
		$result1 = msnl_fSQLCall($sql);
		if (!$result1) { // Bad SQL call
			msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DBNLSMAXID);
		} else {
			$row = $db->sql_fetchrow($result1);
			$nid = intval($row['nid']);
		}
	}
	return $nid;
}
/**
 * msnl_fSendNls
 * This function is what will send out the newsletter to all the recipients based upon
 * a list of email addresses passed into it.
 *
 * @param string $emailfile is the HTML to send to the recipients
 * @param string $sSender is the sender name string to use for the FROM
 * @param string $sql is the SQL to use to get the list of recipients
 * @param array  $asEmailaddresses is the adhoc list of email addresses if these were provided
 * @return integer 0 = unsuccessful completion, 1 = successful completion, or the user_id that was last sent to
 */
function msnl_fSendNls($emailfile, $sSender, $sql, $asEmailaddresses) {
	global $sitename, $adminmail, $REMOTE_ADDR, $prefix, $db, $admin_file, $msnl_gasModCfg;
	/*
	 * Define the email headers once since they are the same for each send option.
	 */
	$headers = 'MIME-Version: 1.0' . "\n"
		. 'Content-Type: text/html; charset=iso-8859-1' . "\r\n"
		. 'From: ' . $sSender . '<' . $adminmail . '>' . "\r\n"
		. 'Return-Path: ' . $adminmail . "\r\n"
		. 'Reply-To: ' . $adminmail . "\r\n"
		. 'X-Mailer: TNHNL' . "\r\n";
	if(preg_match("/^([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})$/", $REMOTE_ADDR)) {
		$headers .= 'X-Sender-IP: ' . $REMOTE_ADDR . "\r\n";
	}
	$headers .= 'X-Priority: 3' . "\r\n";
	$asEmailTo = array();
	/*
	 * Send newsletter depending on Send To option selected
	 */
	if ($sql == 'testemail') { // Send to Admin ONLY
		$sEmailTitle = _MSNL_ADM_SEND_LAB_TESTNLFROM . ' ' . $sitename;
		$asEmailTo[] = array($adminmail, '');
		$iReturnID = 1;
	} elseif ($sql == 'adhoc') { // Sending to an ad-hoc list of email addresses
		$sEmailTitle = _MSNL_ADM_SEND_LAB_NLFROM . ' ' . $sitename;
		foreach($asEmailaddresses as $user_email) { // Cycle through each ad-hoc email address
			$asEmailTo[] = array($user_email, '');
		}
		$iReturnID = 1;
	} else { // Actually sending to a selected list of recipients
		$result = msnl_fSQLCall($sql);
		$numofusers = $db->sql_numrows($result);
		$numofusers = intval($numofusers);
		if ($numofusers > MSNL_MAX_BATCH_SIZE) {
			echo '<p><span class="thick">' . _MSNL_ADM_SEND_MSG_TOTALSENT . '</span>: ' . $numofusers . '</p>'
				. '<p><span class="thick">' . _MSNL_ADM_SEND_MSG_LOTSSENT . '</span></p>';
		} else {
			echo '<p><span class="thick">' . _MSNL_ADM_SEND_MSG_TOTALSENT . '</span>: ' . $numofusers . '</p>';
		}
		$sEmailTitle = _MSNL_ADM_SEND_LAB_NLFROM . ' ' . $sitename; // MSNL_010301_02
		$iReturnID = 1;
		while ($row = $db->sql_fetchrow($result)) { // Cycle through the recipients and send
			$user_id = intval($row['user_id']);
			$user_email = $row['user_email'];
			$user_name = ($row['name'] == '') ? check_html($row['username'], 'nohtml') : check_html($row['name'], 'nohtml');
			$asEmailTo[] = array($user_email, $user_name);
			$iReturnID = $user_id;
		}
	}
	if (count($asEmailTo) < 1) return 0; // Nothing to send to, return with error
	if ($msnl_gasModCfg['debug_mode'] == MSNL_VERBOSE) { // If in verbose debug mode, no send is to occur
		echo '<p class="thick">' . _MSNL_ADM_SEND_MSG_VERBOSENOSEND . '</p>';
		foreach($asEmailTo as $user_email) {
			msnl_fDebugMsg($user_email[0]);
		}
		return 1;
	}
	/*
	 * Determine if need to personalize with {USERNAME}.  If not, don't perform wasteful search/replace
	 */
	if (strpos($emailfile, '{USERNAME}')) {
		define('TNNL_PERSONALIZE', true);
	} else {
		define('TNNL_PERSONALIZE', false);
		$sendFile = $emailfile;
		unset($emailfile);
	}
	/*
	 * Ok, now ready to send out the newsletters
	 */
	$mailsuccess = 0;
	if (defined('TNML_IS_ACTIVE')) {
		$params = array('html' => 1, 'batch' => 1);
		$mailsuccess = tnml_fMailer($asEmailTo, $sEmailTitle, $sendFile, $adminmail, $sitename, $params);
		if (!$mailsuccess) {
			msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_MAIL); // Need a new define?
		}
	} else {
		foreach($asEmailTo as $user_email) {
			if (TNNL_PERSONALIZE) {
				$replace = (empty($user_mail[1])) ? $user_email[0] : $user_email[1];
				$sendFile = str_replace('{USERNAME}', $replace, $emailfile);
			}
			$mailsuccess = mail($user_email[0], $sEmailTitle, $sendFile, $headers);
			if (!$mailsuccess) {
				msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_MAIL . ' ' . $user_email[0]);
			}
		}
	}
	return $iReturnID;
}
/************************************************************************
* Function: msnl_fGetCategories
* Inputs:   $iCatID   = the default category to have selected in the list.
*           $iInclAll = 1, if should also include the *show ALL* option
*                       0, otherwise
* Returns:  $sHTML    = of HTML for the SELECT object.
* Usage:    Builds an HTML SELECT object of newsletter categories.  If
*           passed a Category ID, then it will have that option selected.
************************************************************************/
function msnl_fGetCategories($iCatID = 0, $iInclAll = MSNL_SHOW_ALL_OFF) {
	global $prefix, $db;
	$sql = 'SELECT `cid`, `ctitle` FROM `' . $prefix . '_hnl_categories` ORDER BY `ctitle`';
	if (!$result = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_COM_ERR_DBGETCATS);
	} else {
		// Setup the SELECT object
		$sHTML = '<select name="msnl_cid">';
		if ($iInclAll == MSNL_SHOW_ALL_ON) { // Include the *Show ALL* option
			$sHTML .= '<option value="0"';
			if ($iCatID == 0) {
				$sHTML .= ' selected="selected"';
			}
			$sHTML .= '>' . _MSNL_COM_LAB_SHOW_ALL . '</option>';
		}
		// Now build the options
		while ($row = $db->sql_fetchrow($result)) {
			$iLstCID = intval($row['cid']);
			$sLstTitle = stripslashes($row['ctitle']);
			$sHTML .= '<option value="' . $iLstCID . '"';
			if ($iLstCID == $iCatID) {
				$sHTML .= ' selected="selected"';
			}
			$sHTML .= '>' . $sLstTitle . '</option>';
		}
		// Close the SELECT object
		$sHTML .= '</select>';
	}
	return $sHTML;
}
/************************************************************************
* Function: msnl_fShowBtnAdd
* Inputs:   $sOP = the operation to perform for a given form.
* Usage:    Shows the ADD Button.
************************************************************************/
function msnl_fShowBtnAdd($sOP) {
	global $msnl_asCSS;
	echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<input type="button" value="' . _MSNL_COM_LAB_ADD . '" title="' . _MSNL_COM_LNK_ADD . '" onclick="javascript:msnl_FormHandler(\'' . $sOP . '\');" />'
		. '</p>';
}
/************************************************************************
* Function: msnl_fShowBtnSave
* Inputs:   $sOP = the operation to perform for a given form.
* Usage:    Shows the SAVE Button.
************************************************************************/
function msnl_fShowBtnSave($sOP) {
	global $msnl_asCSS;
	echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<input type="button" value="' . _MSNL_COM_LAB_SAVE . '" title="' . _MSNL_COM_LNK_SAVE . '" onclick="javascript:msnl_FormHandler(\'' . $sOP . '\');" />'
		. '</p>';
}
/************************************************************************
* Function: msnl_fGrpsExplode
* Inputs:   $sGroups  = the string of groups separated by dashes.
* Returns:  $saGroups = an array of group numbers.
* Usage:    To explore out a string of NSN Groups to an array.
************************************************************************/
function msnl_fGrpsExplode($sGroups) {
	$asNSNGroups = array();
	$asNSNGroups = explode('-', $sGroups);
	return $asNSNGroups;
}
/************************************************************************
* Function: msnl_fGrpsImplode
* Inputs:   $asGroups = the array of NSN groups.
* Returns:  $sGroups  = a string with the groups separated with a dash.
* Usage:    To implode an array of NSN Group numbers into a string with
*           each group number separated with a dash.
************************************************************************/
function msnl_fGrpsImplode($asGroups='') {
	$sGroups = '';
	if (!is_array($asGroups)) return '';
	sort($asGroups);
	for ($i = 0; $i < count($asGroups); $i++) {
		if ($sGroups != '') {
			$sGroups .= '-';
		}
		$sGroups .= $asGroups[$i];
	}
	return $sGroups;
}
/************************************************************************
* Function: msnl_fValidateMail
* Inputs:   $email = the email address to validate.
* Returns:  string or "false"
* Notes:    This was taken from RavenNuke(tm) for email address validation.
************************************************************************/
function msnl_fValidateMail($email) {
	if(strlen($email) < 7 || !preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
		return false;
	} else {
		return $email;
	}
}
/************************************************************************
* Function: msnl_fFixURL
* Inputs:   $sURL = the "URL" to make absolute.
* Returns:  string  a string with the URL that was made absolute if relative
************************************************************************/
function msnl_fFixURL($sURL='') {
	global $domain;
	$asURL = parse_url($sURL);
	$sImageURL = 'http://';
	$sImageURL .= (isset($asURL['host'])) ? $asURL['host'] : $domain;
	$sTmp = (isset($asURL['path'])) ? $asURL['path'] : '';
	$sImageURL .= (isset($sTmp{0}) && $sTmp{0} != '/') ? '/' : '';
	$sImageURL .= $sTmp;
	return $sImageURL;
}

