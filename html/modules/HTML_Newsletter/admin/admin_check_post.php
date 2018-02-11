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
* Do Not check certain options if we are sending an already tested email.
************************************************************************/
if (!defined('MSNL_SENDTESTED')) { // Extra checks for untested newsletters
	/************************************************************************
	* Strip and clean input
	************************************************************************/
	if (!isset($_POST['msnl_topic']) || empty($_POST['msnl_topic'])) {
		msnl_fSetValErr(_MSNL_ADM_LAB_TOPIC, _MSNL_COM_MSG_REQUIRED);
	} else {
		$_POST['msnl_topic'] = tnnlFilter($_POST['msnl_topic'], 'nohtml');
	}
	if (!isset($_POST['msnl_sender']) || empty($_POST['msnl_sender'])) {
		msnl_fSetValErr(_MSNL_ADM_LAB_SENDER, _MSNL_COM_MSG_REQUIRED);
	} else {
		$_POST['msnl_sender'] = tnnlFilter($_POST['msnl_sender'], 'nohtml');
	}
	if (!isset($_POST['msnl_textbody']) || empty($_POST['msnl_textbody'])) {
		msnl_fSetValErr(_MSNL_ADM_LAB_TEXTBODY, _MSNL_COM_MSG_REQUIRED);
	} else {
		$_POST['msnl_textbody'] = tnnlFilter($_POST['msnl_textbody'], '');
	}
	if (!isset($_POST['msnl_template']) || empty($_POST['msnl_template'])) {
		msnl_fRaiseAppError(_MSNL_ADM_ERR_NOTEMPLATE);
	} else {
		if (false === strpos($_POST['msnl_template'], '.')) { // Make sure no '.' or '..' entered
			$_POST['msnl_template'] = tnnlFilter($_POST['msnl_template'], 'nohtml');
		} else {
			$_POST['msnl_template'] = 'notemplate';
		}
	}
	if (isset($_POST['msnl_stats'])) {
		$_POST['msnl_stats'] = 'yes';
	} else {
		$_POST['msnl_stats'] = '';
	}
	if (isset($_POST['msnl_toc'])) {
		$_POST['msnl_toc'] = 'yes';
	} else {
		$_POST['msnl_toc'] = '';
	}
	$_POST['msnl_banner'] = intval($_POST['msnl_banner']);
	/************************************************************************
	* Check Latest for values - if none, pull from saved config values
	************************************************************************/
	$msnl_asHadChg = array(); // Used to determine which Latest vars have changed
	if (!isset($_POST['msnl_news']) || empty($_POST['msnl_news'])) {
		$_POST['msnl_news'] = $msnl_gasModCfg['latest_news'];
	} else {
		$_POST['msnl_news'] = intval($_POST['msnl_news']);
		if ($_POST['msnl_news'] != $msnl_gasModCfg['latest_news']) {
			$msnl_asHadChg['latest_news'] = $_POST['msnl_news'];
		}
	}
	if (!isset($_POST['msnl_downloads']) || empty($_POST['msnl_downloads'])) {
		$_POST['msnl_downloads'] = $msnl_gasModCfg['latest_downloads'];
	} else {
		$_POST['msnl_downloads'] = intval($_POST['msnl_downloads']);
		if ($_POST['msnl_downloads'] != $msnl_gasModCfg['latest_downloads']) {
			$msnl_asHadChg['latest_downloads'] = $_POST['msnl_downloads'];
		}
	}
	if (!isset($_POST['msnl_weblinks']) || empty($_POST['msnl_weblinks'])) {
		$_POST['msnl_weblinks'] = $msnl_gasModCfg['latest_links'];
	} else {
		$_POST['msnl_weblinks'] = intval($_POST['msnl_weblinks']);
		if ($_POST['msnl_weblinks'] != $msnl_gasModCfg['latest_links']) {
			$msnl_asHadChg['latest_links'] = $_POST['msnl_weblinks'];
		}
	}
	if (!isset($_POST['msnl_forums']) || empty($_POST['msnl_forums'])) {
		$_POST['msnl_forums'] = $msnl_gasModCfg['latest_forums'];
	} else {
		$_POST['msnl_forums'] = intval($_POST['msnl_forums']);
		if ($_POST['msnl_forums'] != $msnl_gasModCfg['latest_forums']) {
			$msnl_asHadChg['latest_forums'] = $_POST['msnl_forums'];
		}
	}
	if (!isset($_POST['msnl_reviews']) || empty($_POST['msnl_reviews'])) {
		$_POST['msnl_reviews'] = $msnl_gasModCfg['latest_reviews'];
	} else {
		$_POST['msnl_reviews'] = intval($_POST['msnl_reviews']);
		if ($_POST['msnl_reviews'] != $msnl_gasModCfg['latest_reviews']) {
			$msnl_asHadChg['latest_reviews'] = $_POST['msnl_reviews'];
		}
	}
	/************************************************************************
	* Save off Latest xxxxxx values to _hnl_cfg
	************************************************************************/
	foreach($msnl_asHadChg as $msnl_sKey => $msnl_sValue) {
		$sql = 'UPDATE `' . $prefix . '_hnl_cfg` SET `cfg_val` = \'' . $msnl_sValue . '\' '
			. 'WHERE `cfg_nm` = \'' . $msnl_sKey . '\'';
		if (!msnl_fSQLCall($sql)) { //Had an error in the UPDATE
			msnl_fRaiseAppError(_MSNL_ADM_ERR_DBUPDLATEST . ' - ' . $msnl_sLatest);
		}
	}
}
/************************************************************************
* These checks shall be done each and every time
************************************************************************/
/*
 * Validate who to send to
 */
if (!isset($_POST['msnl_sendemail'])) $_POST['msnl_sendemail'] = '';
if (empty($_POST['msnl_sendemail']) || ($_POST['msnl_sendemail'] != 'testemail'
		&& $_POST['msnl_sendemail'] != 'newsletter' && $_POST['msnl_sendemail'] != 'massmail'
		&& $_POST['msnl_sendemail'] != 'anonymous' && $_POST['msnl_sendemail'] != 'paidsubscribers'
		&& $_POST['msnl_sendemail'] != 'nsngroups' && $_POST['msnl_sendemail'] != 'adhoc')) {
	msnl_fSetValErr(_MSNL_ADM_LAB_CHOOSESENDTO, _MSNL_ADM_VAL_NOSENDTO);
}
/*
 * Validate that a NSN Group has been checked IF elected to use them
 */
if ($msnl_gasModCfg['nsn_groups'] == 1 && $_POST['msnl_sendemail'] == 'nsngroups' && !isset($_POST['msnl_nsngroupid'])) {
	msnl_fSetValErr(_MSNL_ADM_LAB_NSNGRPS, _MSNL_ADM_VAL_NONSNGRP);
}
/*
 * Do a little cleansing of the ad-hoc email list (very minimal!)
 * NOTE: This was a quick-fix to a few minor data entry issues... need to be more complete and use
 * a more robust filtering/fixing routine that is not str_replace based.
 */
$msnl_asEmailAddresses = array();
if ($_POST['msnl_sendemail'] == 'adhoc') {
	$_POST['msnl_emailaddresses'] = trim(tnnlFilter($_POST['msnl_emailaddresses'], 'nohtml'));
	$_POST['msnl_emailaddresses'] = str_replace(array(' ', ';', '|'), array(',', ',', ','), $_POST['msnl_emailaddresses']);
	$_POST['msnl_emailaddresses'] = preg_replace('/(,)$/', '', $_POST['msnl_emailaddresses']);
	/*
	 * Validate the email addresses
	 */
	$msnl_asEmailAddresses = explode(',', $_POST['msnl_emailaddresses']);
	foreach($msnl_asEmailAddresses as $user_email) {
		if (msnl_fValidateMail($user_email) === false) {
			msnl_fSetValErr(_MSNL_ADM_LAB_WHOSNDTOADHOC, _MSNL_ADM_VAL_WHOSNDTOADHOC);
			break;
		}
	}
} else {
	$_POST['msnl_emailaddresses'] = '';
}

