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
/*************************************************************************************/
// function Show_YA_menu(){ [added by menelaos dot hetnet dot nl]
/*************************************************************************************/
function Show_YA_menu() {
	global $stop, $module_name, $redirect, $mode, $unwatch, $t, $f, $p, $ya_config;
	OpenTable();
	if ($stop) {
		echo '<div class="text-center title thick">' , _LOGININCOR , '</div>';
	} else {
		echo '<div class="text-center title thick">' , _USERREGLOGIN , '</div>';
	}
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="content"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td align="left">';
	echo '[ <a href="modules.php?name=' . $module_name . '" title="' . _LOGIN . '">' . _LOGIN . '</a> ';
	if ($ya_config['allowuserreg'] == '1') {
		echo '| <a href="modules.php?name=' . $module_name . '&amp;op=new_user" title="' . _REGNEWUSER . '">' . _REGNEWUSER . '</a> ';
	}
	echo ']</td><td align="right">';
	if ($ya_config['servermail'] == '1' || $ya_config['cookiecleaner'] == '1') {
		echo '[';
		if ($ya_config['servermail'] == '1') {
			echo ' <a href="modules.php?name=' . $module_name . '&amp;op=pass_lost" title="' . _PASSWORDLOST . '">' . _PASSWORDLOST . '</a> ';
			if ($ya_config['cookiecleaner'] == '1') echo ' |';
		}
		if ($ya_config['cookiecleaner'] == '1') {
			echo ' <a href="modules.php?name=' . $module_name . '&amp;op=ShowCookiesRedirect" title="' . _YA_COOKIEDELALL . '">' . _YA_COOKIEDELALL . '</a> ';
		}
		echo ']';
	} else echo '&nbsp;';
	echo '</td></tr></table></div>';
	CloseTable();
	echo '<br />';
}
function ya_userCheck($username) {
	global $stop, $user_prefix, $db, $ya_config;
	if ((empty($username)) || (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/u', $username))) $stop = '<div class="text-center">' . _ERRORINVNICK . '</div><br />';
	if (strlen($username) > $ya_config['nick_max']) $stop = '<div class="text-center">' . _YA_NICKLENGTH . '</div>';
	if (strlen($username) < $ya_config['nick_min']) $stop = '<div class="text-center">' . _YA_NICKLENGTH . '</div>';
	if ($ya_config['bad_nick'] > '') {
		$BadNickList = explode("\r\n", $ya_config['bad_nick']);
		$j = count($BadNickList);
		for ($i = 0;$i < $j;++$i) {
			if (preg_match('/' . $BadNickList[$i] . '/i', $username)) $stop = '<div class="text-center">' . _NAMERESTRICTED . '</div><br />';
		}
	}
	if (strrpos($username, ' ') > 0) $stop = '<div class="text-center">' . _NICKNOSPACES . '</div>';
	if ($db->sql_numrows($db->sql_query('SELECT username FROM ' . $user_prefix . '_users WHERE username=\'' . addslashes($username) . '\'')) > 0) $stop = '<div class="text-center">' . _NICKTAKEN . '</div><br />';
	if ($db->sql_numrows($db->sql_query('SELECT username FROM ' . $user_prefix . '_users_temp WHERE username=\'' . addslashes($username) . '\'')) > 0) $stop = '<div class="text-center">' . _NICKTAKEN . '</div><br />';
	return ($stop);
}
function ya_userCheckB($username) {
	global $user_prefix, $db, $ya_config;
	$return = 'true';
	if ((empty($username)) || (preg_match('/[^\p{L}\p{N}\p{Pd}\p{Pc}]/', $username))) $return = 'false';
	if (strlen($username) > $ya_config['nick_max']) $return = 'false';
	if (strlen($username) < $ya_config['nick_min']) $return = 'false';
	if ($ya_config['bad_nick'] > '') {
		$BadNickList = explode("\r\n", $ya_config['bad_nick']);
		$j = count($BadNickList);
		for ($i = 0;$i < $j;++$i) {
			if (preg_match('/' . $BadNickList[$i] . '/i', $username)) $return = 'false';
		}
	}
	if (strrpos($username, ' ') > 0) $return = 'false';
	if ($db->sql_numrows($db->sql_query('SELECT username FROM ' . $user_prefix . '_users WHERE username=\'' . addslashes($username) . '\'')) > 0) $return = 'false';
	if ($db->sql_numrows($db->sql_query('SELECT username FROM ' . $user_prefix . '_users_temp WHERE username=\'' . addslashes($username) . '\'')) > 0) $return = 'false';
	return ($return);
}
function ya_mail($emailto, $subject, $message, $emailfrom) {
	global $ya_config, $adminmail, $sitename;
	if ($ya_config['servermail'] == 1) {
		if (trim($emailfrom) == '') {
			$from  = "From: $sitename <$adminmail>\r\n" . "Reply-To: $adminmail\r\n" . "Return-Path: $adminmail\r\n";
			$fromname = $sitename;
			$emailfrom = $adminmail;
		} else {
			$from = "From: $emailfrom\r\n" . "Reply-To: $emailfrom\r\n" . "Return-Path: $emailfrom\r\n";
			$fromname = '';
		}
		/* TegoNuke(tm) Mailer  */
		$mailsuccess = false;
		if (TNML_IS_ACTIVE) {
			$to = array(array($emailto, ''));   // username is unknown
			$mailsuccess = tnml_fMailer($to, $subject, $message, $emailfrom, $fromname);
		} else {
			$mailsuccess = mail($emailto, $subject, $message, $from . 'X-Mailer: PHP/' . phpversion());
		}
		/* end of TegoNuke(tm) Mailer add */
	}
}
function ya_mailCheck($user_email) {
	global $stop, $user_prefix, $db, $ya_config;
	$user_email = strtolower($user_email);
	if (empty($user_email) || (!preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/', $user_email))) {
		$stop = _ERRORINVEMAIL . '<br />';
		return $stop;
	}
	if ((!$user_email) || ($user_email == '') || (!validateEmailFormat($user_email))) $stop = _ERRORINVEMAIL . '<br />';
	if ($ya_config['bad_mail'] > '') {
		$BadMailList = explode("\r\n", $ya_config['bad_mail']);
		$email_parts = explode('@', $user_email);
		$j = count($BadMailList);
		for ($i = 0;$i < $j;++$i) {
			if ($BadMailList[$i] == $email_parts[1]) $stop = _MAILBLOCKED . ' <span class="thick">' . $BadMailList[$i] . '</span><br />';
		}
	}
	if (strrpos($user_email, ' ') > 0) $stop = _ERROREMAILSPACES . '<br />';
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users WHERE user_email=\'' . addslashes($user_email) . '\'')) > 0) $stop = _EMAILREGISTERED . '<br />';
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users WHERE user_email=\'' . md5($user_email) . '\'')) > 0) $stop = _EMAILNOTUSABLE . '<br />';
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users_temp WHERE user_email=\'' . addslashes($user_email) . '\'')) > 0) $stop = _EMAILREGISTERED . '<br />';
	return ($stop);
}
function ya_mailCheckB($user_email) {
	global $user_prefix, $db, $ya_config;
	$user_email = strtolower($user_email);
	$return = 'true';
	if ($ya_config['bad_mail'] > '') {
		$BadMailList = explode("\r\n", $ya_config['bad_mail']);
		$email_parts = explode('@', $user_email);
		$j = count($BadMailList);
		for ($i = 0;$i < $j;++$i) {
			if ($BadMailList[$i] == $email_parts[1]) $return = 'false';
		}
	}
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users WHERE user_email=\'' . addslashes($user_email) . '\'')) > 0) $return = 'false';
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users WHERE user_email=\'' . md5($user_email) . '\'')) > 0) $return = 'false';
	if ($db->sql_numrows($db->sql_query('SELECT user_email FROM ' . $user_prefix . '_users_temp WHERE user_email=\'' . addslashes($user_email) . '\'')) > 0) $return = 'false';
	return $return;
}
function ya_passCheck($user_pass1, $user_pass2) {
	global $stop, $ya_config;
	if (strlen($user_pass1) > $ya_config['pass_max']) $stop = _YA_PASSLENGTH . '<br />';
	if (strlen($user_pass1) < $ya_config['pass_min']) $stop = _YA_PASSLENGTH . '<br />';
	if ($user_pass1 != $user_pass2) $stop = _PASSWDNOMATCH . '<br />';
	return ($stop);
}
function ya_GetCustomFieldDesc($name) {
	if (substr($name,0,1)=='_') {
		if (defined($name)) $name_exit = constant($name);
		else $name_exit = _YA_INVALIDCUSTOMFIELDNAME;
	}
	else $name_exit = $name;
	return $name_exit;
}
function ya_GetCustomRegFields() {
	global $user_prefix, $db;
	$customFieldsRules = '';
	$customFieldsMessages = '';
	$customFieldsHTML = '';
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE (need = \'2\') OR (need = \'3\') OR (need = \'4\') OR (need = \'5\') ORDER BY pos');
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = $sqlvalue['fid'];
		$value2 = explode('::', $sqlvalue['value']);
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		$customFieldsHTML .=' <p><label for="nfield' . $t . '">' . $name_exit . ':';
		// Required
		if (($sqlvalue['need']) == 3 or ($sqlvalue['need']) == 5) {
			$customFieldsHTML .= '&nbsp;*';
			$customFieldsRules .= '"nfield[' . $t . ']": "required",';
			$customFieldsMessages .= '"nfield[' . $t . ']": "' . $name_exit . ' is required",';
		}
		$customFieldsHTML .= '</label>';
		if (count($value2) == 1) {
			$size = 60;
			if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
			$customFieldsHTML .= '<input type="text" name="nfield[' . $t . ']" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" />';
		} else {
			$customFieldsHTML .= '<select id="nfield[' . $t . ']" name="nfield[' . $t . ']">';
			for ($i = 0;$i < count($value2);$i++) {
				$customFieldsHTML .= '<option value="' . trim($value2[$i]) . '">' . trim($value2[$i]) . '</option>';
			}
			$customFieldsHTML .= '</select>';
		}
		$customFieldsHTML .= '</p>';
	}
	$customFields = array(
		'rules' => $customFieldsRules,
		'messages' => $customFieldsMessages,
		'HTML' => $customFieldsHTML
	);
	return $customFields;
}
function ya_GetCustomRegFieldsAdmin() {
	global $user_prefix, $db;
	$customFieldsRules = '';
	$customFieldsMessages = '';
	$customFieldsHTML = '';
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE (need = \'2\') OR (need = \'3\') ORDER BY pos');
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = $sqlvalue['fid'];
		$value2 = explode('::', $sqlvalue['value']);
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		$customFieldsHTML .='<tr><td>' . $name_exit . ':';
		// Required
		if (($sqlvalue['need']) == 3) {
			$customFieldsHTML .= '&nbsp;*';
			$customFieldsRules .= '"nfield[' . $t . ']": "required",';
			$customFieldsMessages .= '"nfield[' . $t . ']": "' . $name_exit . ' is required",';
		}
		$customFieldsHTML .= '</td><td>';
		if (count($value2) == 1) {
			$size = 60;
			if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
			$customFieldsHTML .= '<input type="text" name="nfield[' . $t . ']" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" />';
		} else {
			$customFieldsHTML .= '<select id="nfield[' . $t . ']" name="nfield[' . $t . ']">';
			for ($i = 0;$i < count($value2);$i++) {
				$customFieldsHTML .= '<option value="' . trim($value2[$i]) . '">' . trim($value2[$i]) . '</option>';
			}
			$customFieldsHTML .= '</select>';
		}
		$customFieldsHTML .= '</td></tr>';
	}
	$customFields = array(
		'rules' => $customFieldsRules,
		'messages' => $customFieldsMessages,
		'HTML' => $customFieldsHTML
	);
	return $customFields;
}
function ya_fixtext($ya_fixtext) {
	if ($ya_fixtext == '') return $ya_fixtext;
	$ya_fixtext = stripslashes($ya_fixtext);
	$ya_fixtext = str_replace("\'",'',$ya_fixtext);
	$ya_fixtext = str_replace('&acute;', '', $ya_fixtext);
	$ya_fixtext = str_replace('"', '&quot;', $ya_fixtext);
	$ya_fixtext = strip_tags($ya_fixtext);
	if (!@get_magic_quotes_gpc()) $ya_fixtext = addslashes($ya_fixtext);
	$ya_fixtext = addslashes($ya_fixtext);
	return $ya_fixtext;
}
// function improved by Peter
function ya_save_config($config_name, $config_value, $config_param = '') {
	global $prefix, $db, $user_prefix;
	// montego - unfortunately the following code will not work as check_html() will stripslashes
	//if (!@get_magic_quotes_gpc()) {
	//	$config_value = addslashes($config_value);
	//}
	if ($config_param == 'html') {
		$config_name = check_html($config_name, 'nohtml');
		$config_value = check_html($config_value, 'html');
		$db->sql_query('UPDATE ' . $user_prefix . '_users_config SET config_value=\'' . addslashes($config_value) . '\' WHERE config_name=\'' . addslashes($config_name) . '\'');
	}
	if ($config_param == 'nohtml') {
		$config_name = check_html($config_name, 'nohtml');
		$config_value = ya_fixtext(check_html($config_value, 'nohtml'));
		$db->sql_query('UPDATE ' . $user_prefix . '_users_config SET config_value=\'' . addslashes($config_value) . '\' WHERE config_name=\'' . addslashes($config_name) . '\'');
	} else {
		$config_name = check_html($config_name, 'nohtml');
		$config_value = intval($config_value);
		$db->sql_query('UPDATE ' . $user_prefix . '_users_config SET config_value=\'' . $config_value . '\' WHERE config_name=\'' . addslashes($config_name) . '\'');
	}
}
function ya_get_configs() {
	global $prefix, $db, $user_prefix;
	$configresult = $db->sql_query('SELECT config_name, config_value FROM ' . $user_prefix . '_users_config');
	while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		// montego - following code is not necessary as GPC does not apply to retrieval from the DB
		//if (!@get_magic_quotes_gpc()) {
		//	$config_value = stripslashes($config_value);
		//}
		$config[$config_name] = $config_value;
	}
	return $config;
}
function yacookie($setuid, $setusername, $setpass, $setstorynum, $setumode, $setuorder, $setthold, $setnoscore, $setublockon, $settheme, $setcommentmax) {
	global $ya_config, $db, $prefix, $nsnst_const;
	if (defined('NUKESENTINEL_IS_LOADED')) {
		$ip = (isset($nsnst_const['remote_ip'])) ? $nsnst_const['remote_ip'] : 'none';
	} else {
		if (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
		elseif (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_X_FORWARDED')) $ip = getenv('HTTP_X_FORWARDED');
		elseif (getenv('HTTP_FORWARDED_FOR')) $ip = getenv('HTTP_FORWARDED_FOR');
		elseif (getenv('HTTP_FORWARDED')) $ip = getenv('HTTP_FORWARDED');
		else $ip = getenv('REMOTE_ADDR');
	}
	if (!validIP($ip)) $ip = ''; // RN0001003 + tightened up further using the new validIP() function in mainfile.php
	$result = $db->sql_query('SELECT time FROM ' . $prefix . '_session WHERE uname=\'' . addslashes($setusername) . '\'');
	$ctime = time();
	if ($setusername != '') {
		$uname = substr($setusername, 0, 25);
		$guest = 0;
		if ($row = $db->sql_fetchrow($result)) {
			$db->sql_query('UPDATE ' . $prefix . '_session SET uname=\'' . addslashes($setusername) . '\', time=\'' . $ctime . '\', host_addr=\'' . $ip . '\', guest=\'' . $guest . '\' WHERE uname=\'' . addslashes($uname) . '\'');
		} else {
			$db->sql_query('INSERT INTO ' . $prefix . '_session (uname, time, host_addr, guest) VALUES (\'' . addslashes($uname) . '\', \'' . $ctime . '\', \'' . $ip . '\', \'' . $guest . '\')');
		}
	}
	$info = base64_encode($setuid . ':' . $setusername . ':' . $setpass . ':' . $setstorynum . ':' . $setumode . ':' . $setuorder . ':' . $setthold . ':' . $setnoscore . ':' . $setublockon . ':' . $settheme . ':' . $setcommentmax);
	if ($ya_config['cookietimelife'] != '-') {
		if (trim($ya_config['cookiepath']) != '') setcookie('user', $info, time() + $ya_config['cookietimelife'], $ya_config['cookiepath']);
		else setcookie('user', $info, time() + $ya_config['cookietimelife']);
	} else {
		setcookie('user', $info);
	};
}
function YA_CoolSize($size) {
	$mb = 1024*1024;
	if ($size > $mb) {
		$mysize = sprintf('%01.2f', $size/$mb) . ' MB';
	} elseif ($size >= 1024) {
		$mysize = sprintf('%01.2f', $size/1024) . ' Kb';
	} else {
		$mysize = $size . ' bytes';
	}
	return $mysize;
}
function YA_MakePass() {
	global $ya_config;
	$makepass = '';
	$strs = 'abc2def3ghj4kmn5opq6rst7uvw8xyz9';
	$passLength = ($ya_config['pass_min'] <= 8) ? 8 : $ya_config['pass_min'];
	for ($x = 0; $x < $passLength; ++$x) {
		mt_srand((double)microtime() * 1000000);
		$str[$x] = substr($strs, mt_rand(0, strlen($strs) - 1) , 1);
		$makepass = $makepass . $str[$x];
	}
	return ($makepass);
}
function amain() {
	global $ya_config, $admin_file;
	OpenTable();
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="100%">';
	echo '<tr>';
	echo '<td align="center" width="33%">&nbsp;</td>';
	echo '<td align="center" width="33%"><a href="' . $admin_file . '.php">' . _YA_ADMINISTRATION . '</a></td>';
	echo '<td align="center"><a href="' . $admin_file . '.php?op=yaCredits">' . _CREDITS . '</a></td>';
	echo '<td align="left">&nbsp;</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="33%"><a href="' . $admin_file . '.php?op=yaCustomFields">' . _YA_ADDFIELD . '</a></td>';
	echo '<td align="center" width="33%"><a href="' . $admin_file . '.php?op=yaUsersConfig">' . _USERSCONFIG . '</a></td>';
	echo '<td align="center"><a href="' . $admin_file . '.php?op=yaUsers">' . _YA_USERS . '</a></td>';
	echo '<td align="left">&nbsp;</td>';
	echo '</tr>';
	echo '</table>';
	CloseTable();
}
function asearch() {
	global $find, $what, $match, $listtype, $admin_file;
	echo '<form method="post" action="' . $admin_file . '.php?op=yaUsers">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr>';
	echo '<td align="center"><span class="thick">' . _YA_FIND . ':</span></td>';
	echo '<td align="center"><span class="thick">' . _YA_BY . ':</span></td>';
	echo '<td align="center"><span class="thick">' . _YA_MATCH . ':</span></td>';
	echo '<td align="center"><span class="thick">' . _YA_QUERY . ':</span></td>';
	echo '</tr><tr>';
	$sel1 = $sel2 = '';
	if ($find == 'tempUser') {
		$sel2 = ' selected="selected"';
	} else {
		$sel1 = ' selected="selected"';
	}
	echo '<td align="center"><select name="find">';
	echo '<option value="findUser"' . $sel1 . '>' . _YA_REGLUSER . '</option>';
	echo '<option value="tempUser"' . $sel2 . '>' . _YA_TEMPUSER . '</option>';
	echo '</select></td>';
	$sel1 = $sel2 = $sel3 = $sel4 = '';
	if ($what == 'user_email') {
		$sel4 = ' selected="selected"';
	} elseif ($what == 'user_id') {
		$sel3 = ' selected="selected"';
	} elseif ($what == 'name') {
		$sel2 = ' selected="selected"';
	} else {
		$sel1 = ' selected="selected"';
	}
	echo '<td align="center"><select name="what">';
	echo '<option value="username" ' . $sel1 . '>' . _USERNAME . '</option>';
	echo '<option value="name" ' . $sel2 . '>' . _UREALNAME . '</option>';
	echo '<option value="user_id" ' . $sel3 . '>' . _USERID . '</option>';
	echo '<option value="user_email" ' . $sel4 . '>' . _EMAIL . '</option>';
	echo '</select></td>';
	$sel1 = $sel2 = '';
	if ($match == 'equal') {
		$sel2 = ' selected="selected"';
	} else {
		$sel1 = ' selected="selected"';
	}
	echo '<td align="center"><select name="match">';
	echo '<option value="like" ' . $sel1 . '>' . _YA_LIKE . '</option>';
	echo '<option value="equal" ' . $sel2 . '>' . _YA_EQUAL . '</option>';
	echo '</select></td>';
	echo '<td align="center"><input type="text" name="listtype" value="' . $listtype . '" size="30" maxlength="60" /></td>';
	echo '<td align="center"><input type="submit" value="' . _YA_SEARCH . '" /></td>';
	echo '</tr>';
	echo '</table>';
	echo '</form>';
}
function mmain($user) {
	global $stop, $module_name, $redirect, $mode, $unwatch, $t, $f, $p, $ya_config;
	if (!is_user($user)) {
		include_once 'header.php';
		mt_srand((double)microtime() * 1000000);
		$maxran = 10000000;
		$random_num = mt_rand(0, $maxran);
		Show_YA_menu();
		OpenTable();
		echo '<form action="modules.php?name=' . $module_name . '" method="post">';
		echo '<table border="0">';
		echo '<tr><td>' . _NICKNAME . ':</td><td><input type="text" name="username" size="15" maxlength="25" /></td></tr>';
		echo '<tr><td>' . _PASSWORD . ':</td><td><input type="password" name="user_password" size="15" maxlength="20" /></td></tr>';
		echo '<tr><td colspan="2">' . security_code(array(2, 4, 5, 7) , 'stacked') . '</td></tr>';
		echo '<tr><td>';
		echo '<input type="hidden" name="random_num" value="' . $random_num . '" />';
		echo '<input type="hidden" name="redirect" value="' . $redirect . '" />';
		echo '<input type="hidden" name="mode" value="' . $mode . '" />';
		echo '<input type="hidden" name="unwatch" value="' . $unwatch . '" />';
		echo '<input type="hidden" name="f" value="' . $f . '" />';
		echo '<input type="hidden" name="t" value="' . $t . '" />';
		echo '<input type="hidden" name="p" value="' . $p . '" />';
		echo '<input type="hidden" name="op" value="login" />';
		echo '<input type="submit" value="' . _LOGIN . '" />';
		if ($ya_config['useactivate'] == 1) {
			echo '<br />(' . _BESUREACT . ')';
		}
		echo '</td></tr></table></form><br />';
		CloseTable();
		include_once 'footer.php';
	} elseif (is_user($user)) {
		global $cookie;
		cookiedecode($user);
		Header('Location: modules.php?name=' . $module_name . '&op=userinfo&username=' . $cookie[1]);
	}
}
function yapagenums($op, $totalselected, $perpage, $max, $find, $what, $match, $listtype) {
	global $admin_file;
	$pagesint = ($totalselected/$perpage);
	$pageremainder = ($totalselected%$perpage);
	if ($pageremainder != 0) {
		$pages = ceil($pagesint);
		if ($totalselected < $perpage) {
			$pageremainder = 0;
		}
	} else {
		$pages = $pagesint;
	}
	if ($pages > 1) {
		$counter = 1;
		$currentpage = ($max/$perpage);
		$op = 'yaUsers';
		echo '<form action="' . $admin_file . '.php" method="post">';
		echo '<input type="hidden" name="op" value="' . $op . '" />';
		if ($what > '') echo '<input type="hidden" name="what" value="' . $what . '" />';
		if ($find > '') echo '<input type="hidden" name="find" value="' . $find . '" />';
		if ($match > '') echo '<input type="hidden" name="match" value="' . $match . '" />';
		if ($listtype > '') echo '<input type="hidden" name="listtype" value="' . $listtype . '" />';
		echo '<table align="center" border="0" cellpadding="2" cellspacing="2"><tr>';
		echo '<td align="center"><span class="thick">' . _YA_SELECTPAGE . ': </span><select name="min">';
		while ($counter <= $pages) {
			$cpage = $counter;
			$mintemp = ($perpage * $counter) - $perpage;
			echo '<option value="' . $mintemp . '"';
			if ($counter == $currentpage) echo ' selected="selected"';
			echo '>' . $counter . '</option>';
			$counter++;
		}
		echo '</select><span class="thick"> ' . _YA_OF . ' ' . $pages . ' ' . _YA_PAGES . '</span> <input type="submit" value="' . _YA_GO . '" /></td></tr>';
		echo '</table></form>';
	}
}
function disabled() {
	include_once 'header.php';
	OpenTable();
	echo '<p class="option">' . _ACTDISABLED . '</p>';
	CloseTable();
	include_once 'footer.php';
}
function notuser() {
	include_once 'header.php';
	OpenTable();
	echo '<p class="option">' . _MUSTBEUSER . '</p>';
	CloseTable();
	include_once 'footer.php';
}
# BEGIN:  nukeSPAM(tm)
include_once NUKE_MODULES_DIR . 'nukeSPAM/nukeSPAM.php';
# END:  nukeSPAM(tm)
?>