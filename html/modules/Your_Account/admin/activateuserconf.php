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
if (!defined('YA_ADMIN')) {
	header('Location: ../../../index.php');
	die ();
}
if (($radminsuper==1) OR ($radminuser==1)) {
	list($uname, $realname, $email, $upass, $ureg, $femail, $user_website, $user_icq, $user_occ, $user_from, $user_interests, $user_sig, $user_viewemail, $user_aim, $user_yim, $user_msnm, $bio, $newsletter, $user_allow_viewonline, $user_sig_bbcode_uid) = $db->sql_fetchrow($db->sql_query('SELECT username, name, user_email, user_password, user_regdate, femail, user_website, user_icq, user_occ, user_from, user_interests, user_sig, user_viewemail, user_aim, user_yim, user_msnm, bio, newsletter, user_allow_viewonline, user_sig_bbcode_uid FROM ' . $user_prefix . '_users_temp WHERE user_id=\'' . $act_uid . '\''));
	if ($ya_config['servermail'] == 1) {
		$message = _SORRYTO .' ' . $sitename . ' ' . _HASAPPROVE;
		$subject = _SORRYTO .' ' . $sitename . ' ' . _HASAPPROVE;
		ya_mail($email, $subject, $message, '');
	}
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id=\'' . $act_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp');
	list($newest_uid) = $db->sql_fetchrow($db->sql_query('SELECT max(user_id) AS newest_uid FROM ' . $user_prefix . '_users'));
	if ($newest_uid == '-1') $new_uid = 1; 
	else $new_uid = $newest_uid+1;
	// Check defaults of newly added fields in case they are not required for registration
	if (empty($user_viewemail) or $user_viewemail != '1') $user_viewemail = '0';
	if (empty($newsletter) or $newsletter != '1') $newsletter = '0';
	if (empty($user_allow_viewonline) or $user_allow_viewonline != '0') $user_allow_viewonline = '1';
	$db->sql_query('INSERT INTO ' . $user_prefix . '_users (user_id, name, username, user_email, user_regdate, user_password, user_level, user_active, user_avatar, user_avatar_type, user_from, agreedtos, femail, user_website, user_icq, user_occ, user_interests, user_sig, user_viewemail, user_aim, user_yim, user_msnm, bio, newsletter, user_allow_viewonline, user_sig_bbcode_uid) VALUES (\'' . $new_uid . '\', \'' . $realname . '\', \'' . $uname . '\', \'' . $email . '\', \'' . $ureg . '\', \'' . $upass . '\', 1, 1, \'gallery/blank.gif\', 3, \'' . $user_from . '\', \'1\', \'' . $femail . '\', \'' . $user_website . '\', \'' . $user_icq . '\', \'' . $user_occ . '\', \'' . $user_interests . '\', \'' . $user_sig . '\', \'' . $user_viewemail . '\', \'' . $user_aim . '\', \'' . $user_yim . '\', \'' . $user_msnm . '\', \'' . $bio . '\', \'' . $newsletter . '\', \'' . $user_allow_viewonline . '\', \'' . $user_sig_bbcode_uid . '\')');
	$res = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $act_uid . '\'');
	while ($sqlvalue = $db->sql_fetchrow($res)) {
		$db->sql_query('INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $new_uid . '\', \'' . $sqlvalue[fid] . '\',\'' . $sqlvalue[value] . '\')');
	}
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid=\'' . $act_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp_field_values');
	$pagetitle = ': ' . _USERADMIN . ' - ' . _YA_ACTIVATED;
	include_once 'header.php';
	amain();
	echo '<br />';
	OpenTable();
	echo '<form action="' . $admin_file . '.php?op=yaUsers" method="post">';
	if (isset($listtype)) { echo '<input type="hidden" name="listtype" value="' . $listtype . '" />'; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="' . $min . '" />'; }
//    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
	echo '<div class="text-center"><table align="center" border="0" cellpadding="2" cellspacing="2">';
	echo '<tr><td align="center"><span class="thick">'._YA_ACTIVATED.'</span></td></tr>';
	echo '<tr><td align="center"><input type="submit" value="'._RETURN2.'" /></td></tr>';
	echo '</table></div>';
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
}
?>