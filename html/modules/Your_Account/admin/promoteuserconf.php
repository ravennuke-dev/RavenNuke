<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2013, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN'))
{
	 header('Location: ../../../index.php');
	die ();
}

if ($radminsuper == 1) {
	if (!isset($add_pwd)) $add_pwd = '';
	if (!isset($add_radminsuper)) $add_radminsuper = '';
	if (!isset($add_admlanguage)) $add_admlanguage = '';
	$num = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_authors WHERE aid=\''.$add_aid.'\''));
	if ($num > 0) {
		$pagetitle = ': '._USERADMIN.' - '._PROMOTEUSER;
		include('header.php');
		title(_USERADMIN.' - '._PROMOTEUSER);
		amain();
		echo '<br />'."\n";
		OpenTable();
		echo '<div class="text-center thick">'._NAMEERROR.'</div><br />';
		CloseTable();
		include('footer.php');
	} else {
		$add_pwd = md5($add_pwd);
          if (isset($auth_modules)) {
            for ($i=0; $i < sizeof($auth_modules); $i++) { 
              $row = $db->sql_fetchrow($db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE mid='$auth_modules[$i]'")); 
              $adm = "$row[admins]$add_name"; 
              $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm,' WHERE mid='$auth_modules[$i]'"); 
            } 
          }
          $add_password = check_html($add_password, 'nohtml');
          $add_aid = check_html($add_aid, 'nohtml');
          $add_name = check_html($add_name, 'nohtml');
          $add_url = check_html($add_url, 'nohtml');
          $add_email = check_html($add_email, 'nohtml');
          $add_password = check_html($add_password, 'nohtml');
          $add_radminsuper = intval($add_radminsuper);
          $add_admlanguage = check_html($add_admlanguage, 'nohtml');
          $result = $db->sql_query("insert into " . $prefix . "_authors values ('$add_aid', '$add_name', '$add_url', '$add_email', '$add_password', '0', '$add_radminsuper', '$add_admlanguage')"); 
		$pagetitle = ': '._USERADMIN.' - '._PROMOTEUSER;
		include("header.php");
		title(_USERADMIN.' - '._PROMOTEUSER);
		amain();
		echo '<br />'."\n";
		OpenTable();
		if (!$result) {
			echo '<div class="text-center thick">'._ADDERROR.'</div><br />';
		} else {
				if ($ya_config['servermail'] == 1) {
// START:f2g: added note that httpauth password will be sent if site requires it
//              $message = _SORRYTO." $sitename "._HASPROMOTE;
					$message = _SORRYTO." $sitename "._HASPROMOTE."\r\n\r\n"._IFHTTPAUTH;
// END:f2g:
					$subject = _ACCTPROMOTE;
					$from  = "From: $adminmail\r\n";
					$from .= "Reply-To: $adminmail\r\n";
					$from .= "Return-Path: $adminmail\r\n";
					ya_mail($add_email, $subject, $message, $from);
				}
				echo '"<div class="text-center thick">'._USERPROMOTED.'</div>';
		}
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
	if (isset($listtype)) { echo '<input type="hidden" name="listtype" value="'.$listtype.'" />'."\n"; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
	echo '<div class="text-center">'."\n";
	echo '<input type="submit" value="'._RETURN2.'" />'."\n";
	echo '</div>'."\n";
	echo '</form>'."\n";
	CloseTable();
	include('footer.php');
	if ($add_radminforum == "1") { $db->sql_query('UPDATE '.$user_prefix.'_users SET user_level=\'2\' WHERE user_id=\''.$chng_uid.'\''); }
    }

}else{
header('Location: ../../../index.php');
	die ();
}

?>