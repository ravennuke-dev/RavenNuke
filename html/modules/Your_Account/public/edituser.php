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
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
getusrinfo($user);
$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig');
while ($rowbc = $db->sql_fetchrow($resultbc)) {
	$board_config[$rowbc['config_name']] = $rowbc['config_value'];
}
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once 'header.php';
	title(_PERSONALINFO);
	OpenTable();
	nav();
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form name="Register" action="modules.php?name=' . $module_name . '" method="post">';
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td><strong>' . _USRNICKNAME . '</strong>:</td><td><strong>' . $userinfo['username'] . '</strong></td></tr>';
	if ($ya_config['userealname'] >= '1') {
		echo '<tr><td><strong>' . _UREALNAME . '</strong>:';
		if ($ya_config['userealname'] == '3' or $ya_config['userealname'] == '5') echo '<br />' . _REQUIRED;
		echo '</td><td>';
		$readonly = '';
		if ($ya_config['userealname'] == '5') $readonly = ' readonly="readonly"';
		echo '<input type="text" name="realname" value="' . $userinfo['name'] . '" size="50" maxlength="60" ' . $readonly . ' /></td></tr>';
	}
	echo '<tr><td><strong>' . _UREALEMAIL . ':</strong><br />' . _REQUIRED . '</td><td>';
	if ($ya_config['allowmailchange'] == 1) {
		echo '<input type="text" name="user_email" value="' . $userinfo['user_email'] . '" size="50" maxlength="255" /><br />' . _EMAILNOTPUBLIC;
	} else {
		echo $userinfo['user_email'] . '<input type="hidden" name="user_email" value="' . $userinfo['user_email'] . '" />';
	}
	echo '</td></tr>';
	if ($ya_config['usefakeemail'] >= '1') {
		echo '<tr><td><strong>' . _UFAKEMAIL . ':</strong>';
		if ($ya_config['usefakeemail'] == '3' or $ya_config['usefakeemail'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['usefakeemail'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="femail" value="' . $userinfo['femail'] . '" size="50" maxlength="255" ' . $readonly . ' /><br />' . _EMAILPUBLIC . '</td></tr>';
	}
	if ($ya_config['usewebsite'] >= '1') {
		$user_website_tmp = $userinfo['user_website']; // RN v2.30.01
		if (!preg_match('#^http[s]?:\/\/#i', $userinfo['user_website'])) {
			$userinfo['user_website'] = 'http://' . $userinfo['user_website'];
			$user_website_tmp = $userinfo['user_website']; // RN v2.30.01
		}
		if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $userinfo['user_website'])) {
			$userinfo['user_website'] = '';
		}

		if (!empty($user_website_tmp)) { // RN v2.30.01
			$tmpWebSitePart = explode('/', $user_website_tmp); // RN v2.30.01
			if ($tmpWebSitePart[2]=='localhost') $userinfo['user_website']=$user_website_tmp; // RN v2.30.01
		} // RN v2.30.01

		echo '<tr><td><strong>' . _YOURHOMEPAGE . ':</strong>';
		if ($ya_config['usewebsite'] == '3' or $ya_config['usewebsite'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['usewebsite'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_website" value="' . $userinfo['user_website'] . '" size="50" maxlength="255" ' . $readonly . ' /></td></tr>';
	}
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" ORDER BY pos');
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = (int)$sqlvalue['fid'];
		list($value) = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_field_values WHERE fid =\'' . $t . '\' AND uid = \'' . $userinfo['user_id'] . '\''));
		$value2 = explode('::', $sqlvalue['value']);
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		echo '<tr><td><strong>' . $name_exit . '</strong>';
		if (($sqlvalue['need']) == 3) echo '<br />' . _REQUIRED;
		echo '</td><td>';
		if (count($value2) == 1) {
			$size = 60;
			if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
			echo '<input type="text" name="nfield[' . $t . ']" value="' . htmlspecialchars($value) . '" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" />';
		} else {
			echo '<select name="nfield[' . $t . ']">';
			$j = count($value2);
			for ($i = 0;$i < $j;++$i) {
				if (trim($value) == trim($value2[$i])) $sel = ' selected="selected"';
				else $sel = '';
				echo '<option value="' . trim($value2[$i]) . '"' . $sel . '>' . $value2[$i] . '</option>';
			}
			echo '</select>';
		}
		echo '</td></tr>';
	}
	if ($ya_config['useinstantmessaim'] >= '1') {
		echo '<tr><td><strong>' . _YAIM . ':</strong>';
		if ($ya_config['useinstantmessaim'] == '3' or $ya_config['useinstantmessaim'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useinstantmessaim'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_aim" value="' . $userinfo['user_aim'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['useinstantmessicq'] >= '1') {
		if (!preg_match('/^[0-9]+$/', $userinfo['user_icq'])) { $userinfo['user_icq'] = ''; }
		echo '<tr><td><strong>' . _YICQ . ':</strong>';
		if ($ya_config['useinstantmessicq'] == '3' or $ya_config['useinstantmessicq'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useinstantmessicq'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_icq" value="' . $userinfo['user_icq'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['useinstantmessmsn'] >= '1') {
		echo '<tr><td><strong>' . _YMSNM . ':</strong>';
		if ($ya_config['useinstantmessmsn'] == '3' or $ya_config['useinstantmessmsn'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useinstantmessmsn'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_msnm" value="' . $userinfo['user_msnm'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['useinstantmessyim'] >= '1') {
		echo '<tr><td><strong>' . _YYIM . ':</strong>';
		if ($ya_config['useinstantmessyim'] == '3' or $ya_config['useinstantmessyim'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useinstantmessyim'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_yim" value="' . $userinfo['user_yim'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['uselocation'] >= '1') {
		echo '<tr><td><strong>' . _YLOCATION . ':</strong>';
		if ($ya_config['uselocation'] == '3' or $ya_config['uselocation'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['uselocation'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_from" value="' . $userinfo['user_from'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['useoccupation'] >= '1') {
		echo '<tr><td><strong>' . _YOCCUPATION . ':</strong>';
		if ($ya_config['useoccupation'] == '3' or $ya_config['useoccupation'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useoccupation'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_occ" value="' . $userinfo['user_occ'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['useinterests'] >= '1') {
		echo '<tr><td><strong>' . _YINTERESTS . ':</strong>';
		if ($ya_config['useinterests'] == '3' or $ya_config['useinterests'] == '5') echo '<br />' . _REQUIRED;
		$readonly = '';
		if ($ya_config['useinterests'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><input type="text" name="user_interests" value="' . $userinfo['user_interests'] . '" size="30" maxlength="100" ' . $readonly . ' /></td></tr>';
	}
	if ($ya_config['usenewsletter'] >= '1') {
		echo '<tr><td><strong>' . _RECEIVENEWSLETTER . '</strong>';
		if ($ya_config['usenewsletter'] == '3' or $ya_config['usenewsletter'] == '5') echo '<br />' . _REQUIRED;
		$ck1 = $ck2 = '';
		echo '</td><td>';
		if ($ya_config['usenewsletter'] == '5') {
			if ($userinfo['newsletter'] == 1) echo _YES;
			else echo _NO;
			echo '<input type="hidden" name="newsletter" value="' . $userinfo['newsletter'] . '" />';
		} else {
			if ($userinfo['newsletter'] == 1) $ck1 = ' selected="selected"';
			else $ck2 = ' selected="selected"';
			echo '<select name="newsletter"><option value="1"' . $ck1 . '>' . _YES . '</option>';
			echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select>';
		}
		echo '</td></tr>';
	}
	if ($ya_config['useviewemail'] >= '1') {
		echo '<tr><td><strong>' . _ALLOWUSERS . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_viewemail'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_viewemail"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	if ($ya_config['usehideonline'] >= '1') {
		echo '<tr><td><strong>' . _HIDEONLINE . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_allow_viewonline'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_allow_viewonline"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td><strong>' . _REPLYNOTIFY . ':</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _REPLYNOTIFYMSG . '</td></tr>';
	echo '<tr><td><strong>' . _PMNOTIFY . ':</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify_pm'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _POPPM . ':</strong></td><td>';
	if ($userinfo['user_popup_pm'] == 1) {
		$ck1 = ' selected="selected"';
		$ck2 = '';
	} else {
		$ck1 = '';
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_popup_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _POPPMMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td><strong>' . _ATTACHSIG . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_attachsig'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_attachsig"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td><strong>' . _ALLOWBBCODE . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowbbcode'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowbbcode"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _ALLOWHTMLCODE . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowhtml'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowhtml"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _ALLOWSMILIES . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowsmile'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowsmile"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _FORUMSLANG . '</strong></td><td>';
	echo '<select name="user_lang">';
	$dirname = 'modules/Forums/language';
	$dir = opendir($dirname);
	$lang = array();
	while ( $file = readdir($dir) ) {
		if ( preg_match('/^lang_/', $file) && !is_file($dirname . '/' . $file) && !is_link($dirname . '/' . $file) ) {
			$filename = trim(str_replace('lang_', '', $file));
			$displayname = preg_replace('/^(.*?)_(.*)$/', '\\1 [ \\2 ]', $filename);
			$displayname = preg_replace('/\[(.*?)_(.*)\]/', '[ \\1 - \\2 ]', $displayname);
			$lang[$displayname] = $filename;
		}
	}
	closedir($dir);
	asort($lang);
	reset($lang);
	if (in_array(strtolower($userinfo['user_lang']), $lang)) {
		$form_lang = $userinfo['user_lang'];
	} else {
		$form_lang = $board_config['default_lang'];
	}
	foreach ($lang as $displayname => $filename) {
	#while ( list($displayname, $filename) = each($lang) ) {
		$selected = ( strtolower($form_lang) == strtolower($filename) ) ? ' selected="selected"' : '';
		echo '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
	}
	echo '</select>';
	echo '</td></tr>';
	echo '<tr><td><strong>' . _FORUMSTIME . '</strong></td><td>';
	echo '<select name="user_timezone">';
	for ($i = -12;$i < 13;$i++) {
		if ($i == 0) {
			$dummy = 'GMT';
		} else {
			if (!strstr($i, '-')) {
				$i = '+' . $i;
			}
			$dummy = 'GMT ' . $i . ' ' . _HOURS;
		}
		if ($userinfo['user_timezone'] == $i) {
			echo '<option value="' . $i . '" selected="selected">' . $dummy . '</option>';
		} else {
			echo '<option value="' . $i . '">' . $dummy . '</option>';
		}
	}
	echo '</select>';
	echo '</td></tr>';
	echo '<tr><td><strong>' . _FORUMSDATE . ':</strong></td><td>';
	echo '<input size="15" maxlength="14" type="text" name="user_dateformat" value="' . $userinfo['user_dateformat'] . '" />';
	echo '<br />' . _FORUMSDATEMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td><strong>' . _SIGNATURE . ':</strong><br />';
		if ($ya_config['usesignature'] == '3' or $ya_config['usesignature'] == '5') echo _REQUIRED;
		$readonly = '';
		if ($ya_config['usesignature'] == '5') $readonly = ' readonly="readonly"';
		$signature = $userinfo['user_sig'];
		$signature = ($userinfo['user_sig_bbcode_uid'] != '') ? preg_replace('/:(([a-z0-9]+:)?)'.$userinfo['user_sig_bbcode_uid'].'(=|\])/si', '\\3', $signature) : $signature;
		echo '</td><td><textarea cols="50" rows="5" name="user_sig">' . $signature . '</textarea><br />' . _255CHARMAX . '</td></tr>';
	}
	if ($ya_config['useextrainfo'] >= '1') {
		echo '<tr><td><strong>' . _EXTRAINFO . ':</strong><br />';
		if ($ya_config['useextrainfo'] == '3' or $ya_config['useextrainfo'] == '5') echo _REQUIRED;
		$readonly = '';
		if ($ya_config['useextrainfo'] == '5') $readonly = ' readonly="readonly"';
		echo '</td><td><textarea cols="50" rows="5" name="bio">' . htmlspecialchars($userinfo['bio'], ENT_QUOTES, _CHARSET) . '</textarea><br />' . _CANKNOWABOUT . '</td></tr>';
	}
	echo '<tr><td><strong>' . _PASSWORD . '</strong>:</td>';
	echo '<td><input type="password" name="user_password" size="22" maxlength="' . $ya_config['pass_max'] . '" />&nbsp;&nbsp;&nbsp;<input type="password" name="vpass" size="22" maxlength="' . $ya_config['pass_max'] . '" /><br />' . _TYPENEWPASSWORD . '</td></tr>';
	echo '<tr><td colspan="2" align="center">';
	echo '<input type="hidden" name="username" value="' . $userinfo['username'] . '" />';
	echo '<input type="hidden" name="user_id" value="' . $userinfo['user_id'] . '" />';
	echo '<input type="hidden" name="op" value="saveuser" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" />';
	echo '</td></tr></table></form>';
	$avatar_category = (!empty($_POST['avatarcategory'])) ? $_POST['avatarcategory'] : '';
	$direktori = $board_config['avatar_gallery_path'];
	$dir = @opendir($direktori);
	$avatar_images = array();
	while ($file = @readdir($dir)) {
		if ($file != '.' && $file != '..' && !is_file($direktori . '/' . $file) && !is_link($direktori . '/' . $file)) {
			$sub_dir = @opendir($direktori . '/' . $file);
			$avatar_row_count = 0;
			$avatar_col_count = 0;
			while ($sub_file = @readdir($sub_dir)) {
				if (preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $sub_file)) {
					$avatar_images[$file][$avatar_row_count][$avatar_col_count] = $file . '/' . $sub_file;
					$avatar_name[$file][$avatar_row_count][$avatar_col_count] = ucfirst(str_replace('_', ' ', preg_replace('/^(.*)\..*$/', '\1', $sub_file)));
					$avatar_col_count++;
					if ($avatar_col_count == 5) {
						$avatar_row_count++;
						$avatar_col_count = 0;
					}
				}
			}
		}
	}
	@closedir($dir);
	@ksort($avatar_images);
	@reset($avatar_images);
	if (empty($category)) {
		foreach($avatar_images as $category => $value);
	}
	@reset($avatar_images);
	$s_categories = '<select name="avatarcategory">';
	foreach ($avatar_images as $key => $value) {
		$selected = ($key == $category) ? ' selected="selected"' : '';
		if (is_array($avatar_images[$key]) && count($avatar_images[$key])) {
			$s_categories.='<option value="' . $key . '"' . $selected . '>' . ucfirst($key) . '</option>';
		}
	}
	$s_categories.='</select>';
	if ($userinfo['user_avatar_type'] == 1) {
		$user_avatar = $board_config['avatar_path'] . '/' . $userinfo['user_avatar'];
	} elseif ($userinfo['user_avatar_type'] == 2) {
		$user_avatar = $userinfo['user_avatar'];
	} else {
		$user_avatar = $board_config['avatar_gallery_path'] . '/' . $userinfo['user_avatar'];
	}
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td colspan="2" align="center">';
	echo '<span class="title">' . _YA_AVCP . '</span><br /></td></tr>';
	echo '<tr><td>' . _YA_AVINF1 . ' ' . $board_config['avatar_max_width'] . ' ' . _YA_AVINF2 . ' ' . $board_config['avatar_max_height'] . ' ' . _YA_AVINF3 . ' ' . YA_CoolSize($board_config['avatar_filesize']) . '.</td>';
	if (stristr($userinfo['user_avatar'], 'http')) {
		//avatarfix by menelaos dot hetnet dot nl
		echo '<td align="center">' . _YA_CURRAV . '<br /><img alt="" src="' . $userinfo['user_avatar'] . '" width="40" height="50" /></td></tr>';
	} elseif ($userinfo['user_avatar']) {
		echo '<td align="center">' . _YA_CURRAV . '<br /><img alt="" src="' . $direktori . '/' . $userinfo['user_avatar'] . '" width="40" height="50" /></td></tr>';
	}
	//echo '<br />';
	if ($board_config['allow_avatar_local']) {
		echo '<tr><td><strong>' . _YA_SELAVGALL . ':</strong></td>';
		echo '<td><form action="modules.php?name=Your_Account&amp;op=avatarlist" method="post">' . $s_categories . '&nbsp;<img src="images/right.gif" align="middle" alt="" />&nbsp;<input class="button" type="submit" value="' . _YA_SHOWGALL . '" /></form></td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_SELAVGALL.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	if ($board_config['allow_avatar_upload']) {
		echo '<tr><td><strong>' . _YA_UPLOADAV . ':</strong></td>';
		echo '<td><a href="modules.php?name=Forums&amp;file=profile&amp;mode=editprofile"><strong>' . _YA_UPLOADFORUM . '</strong></a></td></tr>';
		echo '<tr><td><strong>' . _YA_UPLOADURL . ':</strong><br /><span class="gensmall">' . _YA_AVCOPIED . '</span></td>';
		echo '<td><a href="modules.php?name=Forums&amp;file=profile&amp;mode=editprofile"><strong>' . _YA_UPLOADFORUM . '</strong></a></td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_UPLOADURL.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';
		//echo '<tr><td><strong>'._YA_UPLOADAV.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	if ($board_config['allow_avatar_remote']) {
		echo '<tr><td><strong>' . _YA_OFFSITE . ':</strong><br /><span class="gensmall">' . _YA_SUBMITBUTTON . '</span></td>';
		echo '<td><form action="modules.php?name=Your_Account&amp;op=avatarlinksave" method="post">';
		if ($userinfo['user_avatar_type'] == 2) {
			echo '<input class="post" style="width: 150px" size="25" name="avatar" value="' . $userinfo['user_avatar'] . '" /> &nbsp;&nbsp;<input class="mainoption" type="submit" value="Submit">';
		} else {
			echo '<input class="post" style="width: 150px" size="25" name="avatar" value="http://" /> &nbsp;&nbsp;<input class="mainoption" type="submit" value="Submit" />';
		}
		echo '</form></td></tr>';
		echo '<tr><td colspan="2" align="center">&nbsp;</td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_OFFSITE.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	echo '</table>';
	CloseTable();
	include_once 'footer.php';
} else {
	mmain($user);
}
?>