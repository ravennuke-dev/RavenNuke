<?php

/**********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*********************************************************************/
/*		 Additional security & Abstraction layer conversion			*/
/*						   2003 chatserv					*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com			*/
/*********************************************************************/
/* PHP-NUKE Module: Secure Recommend DSL 1.0.8 beta				*/
/* Copyright (c) 2005 by VinDSL (perfect.pecker@lycos.co.uk)			*/
/* http://www.Lenon.com									*/
/* http://www.Disipal.net									*/
/* http://www.NukeCops.com									*/
/* http://www.ravenPhpScripts.com								*/
/*													*/
/* Original Email Address Validation Code							*/
/* Copyright (c) 2003 - 2005 Dave Child							*/
/* http://www.ilovejackdaniels.com								*/
/*********************************************************************/

if ( !defined('MODULE_FILE') ) {
	die ('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
	// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}

include 'header.php';

$cookie[0] = intval($cookie[0]);
if (!empty($cookie[1])) {
	$row = $db->sql_fetchrow($db->sql_query('SELECT `name`, `username`, `user_email` FROM `' . $user_prefix . '_users` WHERE `user_id`="' . $cookie[0] . '"'));
	if (!empty($row['name'])) {
		$sender_name = $row['name'];
	} else {
		$sender_name = $row['username'];
	}
	$sender_email = $row['user_email'];
}

if (!isset($opi)) {$opi = '';}
if (!isset($send)) {$send = '';}
if (!isset($sender_name)) {$sender_name = '';}
if (!isset($sender_email)) {$sender_email = '';}
if (!isset($friend_name)) {$friend_name = '';}
if (!isset($friend_email)) {$friend_email = '';}

OpenTable();
if ($opi != "ds") {
	form_block();
} elseif ($opi == "ds") {
	csrf_check();
	global $modGFXChk;
	$gfx_check = (isset($_POST['gfx_check'])) ? $_POST['gfx_check'] : '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}

	$sender_name_err = $sender_email_err = $friend_name_err = $friend_email_err = '';

	if (empty($sender_name)) {
		$sender_name_err = '<div class="text-center option thick italic">'._ENTERSENDERNAME.'</div><br />';
		$send = _RU_NO;
	}

	if (preg_match("/(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)/i", $sender_name)) {
		$sender_name_err = '<div class="text-center option thick italic">'._INVALIDSENDERNAME.'</div><br />';
		$sender_name = '';
		$send = _RU_NO;
	}

	if (empty($sender_email)) {
		$sender_email_err = '<div class="text-center option thick italic">'._ENTERSENDEREMAIL.'</div><br />';
		$send = _RU_NO;
	}

	if (!check_sender_email_address($sender_email)) {
		$sender_email_err = '<div class="text-center option thick italic">'._ENTERSENDEREMAIL.'</div><br />';
		$sender_email = '';
		$send = _RU_NO;
	}

	if (empty($friend_name)) {
		$friend_name_err = '<div class="text-center option thick italic">'._ENTERFRIENDNAME.'</div><br />';
		$send = _RU_NO;
	}

	if (preg_match("/(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)/i", $friend_name)) {
		$friend_name_err = '<div class="text-center option thick italic">'._INVALIDFRIENDNAME.'</div><br />';
		$friend_name = '';
		$send = _RU_NO;
	}

	if (empty($friend_email)) {
		$friend_email_err = '<div class="text-center option thick italic">'._ENTERFRIENDEMAIL.'</div><br />';
		$send = _RU_NO;
	}

	if (!check_friend_email_address($friend_email)) {
		$friend_email_err = '<div class="text-center option thick italic">'._ENTERFRIENDEMAIL.'</div><br />';
		$friend_email = '';
		$send = _RU_NO;
	}

	if ($send != _RU_NO) {
		$friend_name = FixQuotes(check_html(removecrlf($friend_name)));
		$friend_email = FixQuotes(check_html(removecrlf($friend_email)));
		$sender_name = FixQuotes(check_html(removecrlf($sender_name)));
		$sender_email = FixQuotes(check_html(removecrlf($sender_email)));
		$subject = ""._INTSITE." $sitename";
		$msg  = ""._HELLO." $friend_name,\n\n";
		$msg .= ""._YOURFRIEND." $sender_name ";
		$msg .= ""._OURSITE." $sitename ";
		$msg .= ""._INTSENT."\n\n";
		$msg .= ""._FSITENAME." $sitename\n$slogan\n";
		$msg .= ""._FSITEURL." $nukeurl\n";
		$mailheaders  = "From: $sender_name <$sender_email>\r\n";
		$mailheaders .= "Reply-To: $sender_email\r\n" . 'X-Mailer: PHP/' . phpversion();
		/*
		 * TegoNuke Mailer added by montego for 2.20.00
		 */
		$mailsuccess = false;
		if (TNML_IS_ACTIVE) {
			$to = array(array($friend_email, $friend_name));
			$mailsuccess = tnml_fMailer($to, $subject, $msg, $sender_email, $sender_name);
		} else {
			$mailsuccess = mail($friend_email, $subject, $msg, $mailheaders);
		}
		if ($mailsuccess) {
			echo '<div class="text-center"><p>'._FREFERENCE.'&nbsp;'.$friend_name.'...</p>'."\n";
			echo "<p>"._THANKSREC."</p></div>\n";
		} else {
			echo '<div class="text-center"><p>'._RU_SENDERROR.'</p></div>'."\n";
		}
		/*
		 * end of TegoNuke Mailer add
		 */
		echo "<div align=\"right\"><a href=\"http://www.lenon.com/modules.php?name=Docs&amp;file=terms\"><span style=\"font:10px,Arial\">" . ucfirst(_BY) . "&nbsp;VinDSL&nbsp;&copy;</span>&nbsp;&nbsp;</a></div>\n";
	} elseif ($send == _RU_NO) {
		OpenTable2();
		echo $sender_name_err , "\n"
			, $sender_email_err , "\n"
			, $friend_name_err , "\n"
			, $friend_email_err , "\n";
		CloseTable2();
		echo "<br />";
		form_block();
	}
}

CloseTable();
include('footer.php');
die();

// Only functions after this line

function check_sender_email_address($sender_email) {
	if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $sender_email)) {
		return false;
	}
	$email_array = explode("@", $sender_email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
			return false;
		}
	}
	if (!preg_match('#^\[?[0-9\.]+\]?$#', $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false;
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

function check_friend_email_address($friend_email) {
	if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $friend_email)) {
		return false;
	}
	$email_array = explode("@", $friend_email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
			return false;
		}
	}
	if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false;
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

function form_block() {
	global $friend_email, $friend_name, $module_name, $sender_email, $sender_name, $sitename;
	echo "<div align=\"center\"><span class=\"title thick\">$sitename:&nbsp;"._RECOMMEND."</span>\n";
	echo "<form method=\"post\" action=\"modules.php?name=$module_name\">\n";
	echo "<p><strong>"._FYOURNAME."</strong><br />\n";
	echo "<input type=\"text\" name=\"sender_name\" value=\"$sender_name\" size=\"30\" /></p>\n";
	echo "<p><strong>"._FYOUREMAIL."</strong><br />\n";
	echo "<input type=\"text\" name=\"sender_email\" value=\"$sender_email\" size=\"30\" /></p>\n";
	echo "<p><strong>"._FFRIENDNAME."</strong><br />\n";
	echo "<input type=\"text\" name=\"friend_name\" value=\"$friend_name\" size=\"30\" /></p>\n";
	echo "<p><strong>"._FFRIENDEMAIL."</strong><br />\n";
	echo "<input type=\"text\" name=\"friend_email\" value=\"$friend_email\" size=\"30\" /></p>\n";
	/*****[BEGIN]******************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	 ******************************************************/
	global $modGFXChk;
	echo security_code($modGFXChk[$module_name], 'stacked');
	/*****[END]********************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	 ******************************************************/
	echo "<input type=\"hidden\" name=\"opi\" value=\"ds\" />\n";
	echo "<p><input type=\"submit\" name=\"submit\" value=\""._SEND."\" /></p>\n";
	echo "</form>\n";
	echo "<p>"._ALLFIELDSREQUIRED."</p></div>\n";
	echo "<div align=\"right\"><a href=\"http://www.lenon.com/modules.php?name=Docs&amp;file=terms\"><span style=\"font:10px,Arial\">" . ucfirst(_BY) . "&nbsp;VinDSL&nbsp;&copy;</span>&nbsp;&nbsp;</a></div>\n";
}

?>