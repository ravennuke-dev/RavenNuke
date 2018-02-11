<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/************************************************************************/
/* Based on php Addon Feedback 1.0                                      */
/* Copyright (c) 2001 by Jack Kozbial                                   */
/* http://www.InternetIntl.com                                          */
/* jack@internetintl.com                                                */
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/* PHP-NUKE Module: Secure Feedback DSL 1.0.8 beta                      */
/* Copyright (c) 2005 by VinDSL (perfect.pecker@lycos.co.uk)            */
/* http://www.Lenon.com                                                 */
/* http://www.Disipal.net                                               */
/* http://www.NukeCops.com                                              */
/* http://www.ravenPhpScripts.com                                           */
/*                                                                      */
/* Original Email Address Validation Code                               */
/* Copyright (c) 2003 - 2005 Dave Child                                 */
/* http://www.ilovejackdaniels.com                                      */
/************************************************************************/

if ( !defined('MODULE_FILE') ) {
	die ('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043

include_once('header.php');
$FB_NO = 'NO';
$cookie[0] = intval($cookie[0]);
if (!empty($cookie[1])) {
	$row = $db->sql_fetchrow($db->sql_query('SELECT name, username, user_email FROM '.$user_prefix.'_users WHERE user_id='.$cookie[0]));
	if (!empty($row['name'])) {
		$sender_name = stripslashes($row['name']);
	} else {
		$sender_name = stripslashes($row['username']);
	}
	$sender_email = stripslashes($row['user_email']);
}
OpenTable();
if (!isset($opi)) $opi = '';
if (!isset($send)) $send = '';
if (!isset($name_err)) $name_err = '';
if (!isset($email_err)) $email_err = '';
if (!isset($subject_err)) $subject_err = '';
if (!isset($sec_err)) $sec_err = '';
if (!isset($message_err)) $message_err = '';
if (!isset($message)) $message = '';
if ($opi != 'ds') {
	form_block();
} elseif ($opi == 'ds') {
	csrf_check();
	if (empty($sender_name)) {
		$name_err = '<span class="option thick italic">' . _FBENTERNAME . '</span><br />';
		$send = $FB_NO;
	}
	if (preg_match('/(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)/i', $sender_name)) {
		$name_err = '<span class="option thick italic">' . _FBINVALIDNAME . '</span><br />';
		$sender_name = '';
		$send = $FB_NO;
	}
	if (empty($sender_email)) {
		$email_err = '<span class="option thick italic">' . _FBENTEREMAIL . '</span><br />';
		$send = $FB_NO;
	}
	if (!check_email_address($sender_email)) {
		$email_err = '<span class="option thick italic">' . _FBRENTEREMAIL . '</span><br />';
		$sender_email = '';
		$send = $FB_NO;
	}
	if (empty($subject)) {
		$subject_err = '<span class="option thick italic">' . _FBENTERSUBJECT . '</span><br />';
		$send = $FB_NO;
	}
	if (preg_match('/(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)/i', $subject)) {
		$subject_err = '<span class="option thick italic">' . _FBINVALIDSUBJECT . '</span><br />';
		$subject = '';
		$send = $FB_NO;
	}
	if (empty($message)) {
		$message_err = '<span class="option thick italic">' . _FBENTERMESSAGE . '</span><br />';
		$send = $FB_NO;
	}
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/
	global $modGFXChk;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		$sec_err = '<span class="option thick italic">' . _SECCODEINCOR . '</span><br />';
		$send = $FB_NO;
	}
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/

	if ($send != $FB_NO) {
		$to = $adminmail;
		$subject = "$sitename - "._FEEDBACK.": $subject\n";
		$subject = stripslashes(FixQuotes(check_html(removecrlf($subject))));
		$sender_name = stripslashes(FixQuotes(check_html(removecrlf($sender_name))));
		$sender_email = stripslashes(FixQuotes(check_html(removecrlf($sender_email))));
		$message = check_html($message, 'nohtml');
		$msg  = "$sitename\n\n";
		$msg .= _SENDERNAME.": $sender_name\n";
		$msg .= _SENDEREMAIL.": $sender_email\n";
		$msg .= _SUBJECT.": $subject\n";
		$msg .= _MESSAGE.": $message\n\n";
		$mailheaders  = "From: $sender_name <$sender_email>\r\n";
		$mailheaders .= "Reply-To: $sender_email\r\n" . 'X-Mailer: PHP/' . phpversion();
		/*
		 * TegoNuke Mailer added by montego for 2.20.00
		 */
		$mailsuccess = false;
		if (TNML_IS_ACTIVE) {
			$mailsuccess = tnml_fMailer($to, $subject, $msg, $sender_email, $sender_name);
		} else {
			$mailsuccess = mail($to, $subject, $msg, $mailheaders);
		}
		if ($mailsuccess) {
			echo '<div class="text-center"><p>'._FBMAILSENT.'</p>'."\n"
				.'<p>'._FBTHANKSFORCONTACT.'</p></div>'."\n";
		} else {
			echo '<div class="text-center"><p>'._FBMAILNOTSENT.'</p></div>'."\n";
		}
		/*
		 * end of TegoNuke Mailer add
		 */
	} elseif ($send == $FB_NO) {
		OpenTable2();
		echo '<div class="text-center">' , $name_err , "\n"
			, $email_err , "\n"
			, $subject_err , "\n"
			, $message_err , "\n"
			, $sec_err , "\n</div>";
		CloseTable2();
		echo '<br />';
		form_block();
	}
}

CloseTable();
include_once('footer.php');
die();

function check_email_address($sender_email) {
	if (!preg_match('/^[^@]{1,64}@[^@]{1,255}$/', $sender_email)) {
		return false;
	}
	$email_array = explode('@', $sender_email);
	$local_array = explode('.', $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
			return false;
		}
	}
	if (!preg_match('/^\[?[0-9\.]+\]?$/', $email_array[1])) {
		$domain_array = explode('.', $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false;
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!preg_match('/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/', $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

function form_block() {
	global $message, $module_name, $sender_email, $sender_name, $sitename, $subject;
	echo '<div align="center"><span class="title thick">' . $sitename . ':&nbsp;' . _FEEDBACKTITLE . '</span>'."\n"
		.'<p><span class="content">'._FEEDBACKNOTE.'</span></p>'."\n"
		.'<form method="post" action="modules.php?name='.$module_name.'">'."\n"
		.'<p><strong>'._YOURNAME.':</strong><br />'."\n"
		.'<input type="text" name="sender_name" value="'.$sender_name.'" size="30" /></p>'."\n"
		.'<p><strong>'._YOUREMAIL.':</strong><br />'."\n"
		.'<input type="text" name="sender_email" value="'.$sender_email.'" size="30" /></p>'."\n"
		.'<p><strong>'._SUBJECT.':</strong><br />'."\n"
		.'<input type="text" name="subject" value="'.$subject.'" size="30" /></p>'."\n"
		.'<p><strong>'._MESSAGE.':</strong><br />'."\n"
		.'<textarea name="message" cols="30" rows="5">'.$message.'</textarea></p>'."\n"
		.'<input type="hidden" name="opi" value="ds" />'."\n";
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	global $modGFXChk;
	echo security_code($modGFXChk[$module_name], 'stacked');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	echo '<p><input type="submit" name="submit" value="'._SEND.'" /></p>'."\n"
		.'</form>'."\n"
		.'<p class="thick">'._ALLFIELDSREQUIRED.'</p></div>'."\n";
}

?>