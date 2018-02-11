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
/* RN Your Account is based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN')){
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	$chng_uid = intval($chng_uid); // waraxe - Reflected XSS
	$stop = '';
	if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
	if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
	if ($ya_config['userealname'] == '0') $chng_realname = '';
	if ($ya_config['usefakeemail'] == '0') $chng_femail = '';
	if ($ya_config['usewebsite'] == '0') $chng_user_website = '';
	if ($ya_config['useinstantmessaim'] == '0') $chng_user_aim = '';
	if ($ya_config['useinstantmessicq'] == '0') $chng_user_icq = '';
	if ($ya_config['useinstantmessmsn'] == '0') $chng_user_msnm = '';
	if ($ya_config['useinstantmessyim'] == '0') $chng_user_yim = '';
	if ($ya_config['uselocation'] == '0') $chng_user_from = '';
	if ($ya_config['useoccupation'] == '0') $chng_user_occ = '';
	if ($ya_config['useinterests'] == '0') $chng_user_interest = '';
	if ($ya_config['usenewsletter'] == '0') $chng_newsletter = '0';
	if ($ya_config['useviewemail'] == '0') $chng_user_viewemail = '0';
	if ($ya_config['usehideonline'] == '0') $chng_user_allow_viewonline = '1';
	if ($ya_config['usesignature'] == '0') $chng_user_sig = '';
	if ($ya_config['useextrainfo'] == '0') $chng_bio = '';
//	if ($ya_config['usesignature'] == '0') $user_attachsig = '0';
//	if ($ya_config['usepoints'] == '0' ) $chng_points = '0';
	$chng_uname = ya_fixtext($chng_uname);
	$chng_realname = ya_fixtext($chng_realname);
	$chng_email = ya_fixtext($chng_email);
	$chng_femail = ya_fixtext($chng_femail);
	$chng_user_website = ya_fixtext($chng_user_website);
	$chng_user_aim = ya_fixtext($chng_user_aim);
	$chng_user_icq = ya_fixtext($chng_user_icq);
	$chng_user_msnm = ya_fixtext($chng_user_msnm);
	$chng_user_yim = ya_fixtext($chng_user_yim);
	$chng_user_from = ya_fixtext($chng_user_from);
	$chng_user_occ = ya_fixtext($chng_user_occ);
	$chng_user_interests = ya_fixtext($chng_user_interests);
	$chng_newsletter = intval($chng_newsletter);
	$chng_user_viewemail = intval($chng_user_viewemail);
	$chng_user_allow_viewonline = intval($chng_user_allow_viewonline);
	$chng_bio = ya_fixtext($chng_bio);
//	$chng_avatar = ya_fixtext($chng_avatar);
	if ($stop == '') {
		// Start - Added to allow bbcode encoding to remain upon saving user
		$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_html_tags" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path" OR config_name = "rand_seed"');
		while ($rowbc = $db->sql_fetchrow($resultbc)) {
			$board_config[$rowbc['config_name']] = $rowbc['config_value'];
		}
		define('IN_PHPBB', TRUE);
		include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');
		include_once('./modules/Forums/includes/bbcode.php');
		include_once('./modules/Forums/includes/functions_post.php');
		$chng_sig_bbcode_uid = make_bbcode_uid();
		$chng_user_sig = prepare_message($chng_user_sig, $board_config['allow_html'], $board_config['allow_bbcode'], $board_config['allow_smilies'], $chng_sig_bbcode_uid);
		// End
		$chng_user_sig = addslashes(check_html($chng_user_sig, ''));
		$db->sql_query('UPDATE '.$user_prefix.'_users_temp SET username=\'' . $chng_uname . '\', name=\'' . $chng_realname . '\', user_email=\'' . $chng_email . '\', femail=\'' . $chng_femail . '\', user_website=\'' .	$chng_user_website . '\', user_icq=\'' . $chng_user_icq . '\', user_aim=\'' . $chng_user_aim . '\', user_yim=\'' . $chng_user_yim . '\', user_msnm=\'' . $chng_user_msnm . '\', user_from=\'' . $chng_user_from . '\', user_occ=\'' . $chng_user_occ . '\', user_interests=\'' . $chng_user_interests . '\', user_viewemail=\'' . $chng_user_viewemail . '\', user_sig=\'' . 		$chng_user_sig . '\', user_sig_bbcode_uid=\'' .	$chng_sig_bbcode_uid . '\', bio=\'' . $chng_bio . '\', newsletter=\'' .	$chng_newsletter . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\' WHERE user_id=\'' . $chng_uid . '\'');

		if (isset($nfield) && count($nfield) > 0) {
			foreach ($nfield as $key => $var) {
				$nfield[$key] = ya_fixtext($nfield[$key]);
				if (($db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users_temp_field_values WHERE fid='$key' AND uid = '$chng_uid'"))) == 0) {
					$sql = "INSERT INTO ".$user_prefix."_users_temp_field_values (uid, fid, value) VALUES ('$chng_uid', '$key','$nfield[$key]')";
					$db->sql_query($sql);
				} else {
					$db->sql_query("UPDATE ".$user_prefix."_users_temp_field_values SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$chng_uid'");
				}
			}
		}
		$pagetitle = ": "._USERADMIN." - "._ACCTMODIFY;
		include("header.php");
		amain();
		echo '<br />';
		OpenTable();
		echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
#		if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
#		if (isset($min))   { echo "<input type='hidden' name='min' value='$min' />\n"; }
#		if (isset($xop))   { echo "<input type='hidden' name='op' value='$xop' />\n"; }
		echo "<div class='text-center'><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
		echo "<tr><td align='center'><span class='thick'>"._ACCTMODIFY."</span></td></tr>\n";
		echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
		echo "</table></div>\n";
		echo '</form>';
		CloseTable();
		include('footer.php');
  } else {
		$pagetitle = ": "._USERADMIN;
		include("header.php");
		title(_USERADMIN);
		amain();
		echo '<br />';
		OpenTable();
		echo "<span class='thick'>$stop</span>\n";
		CloseTable();
		include('footer.php');
		return;
	}
}
?>