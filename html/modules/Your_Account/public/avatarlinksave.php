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
$error = false;
getusrinfo($user);
include_once 'header.php';
title(_YA_AVATARSUCCESS);
OpenTable();
nav();
CloseTable();
echo '<br />';
OpenTable();
//Palbin - added to delete old avatar if uplaoded
$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_path\' OR config_name = \'avatar_filesize\' OR config_name = \'avatar_max_width\' OR config_name = \'avatar_max_height\'');
while ($rowbc = $db->sql_fetchrow($resultbc)) {
	$board_config[$rowbc['config_name']] = $rowbc['config_value'];
}

if ($userinfo['user_avatar_type'] == 1) {
	$avatar_old = basename($userinfo['user_avatar']);
	if (@file_exists('./' . $board_config['avatar_path'] . '/' . $avatar_old) ) {
		@unlink('./' . $board_config['avatar_path'] . '/' . $avatar_old);
	}
}
// montego - was going to adjust the code to eliminate wasted SQL calls, but reviewing
// what follows, there isn't even a need for getting the path!
//$resultbc = $db->sql_query('SELECT config_value FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_gallery_path\'');
//list($direktori) = $db->sql_fetchrow($resultbc);
if (!preg_match('#^http[s]?:\/\/#i', $avatar)) {
	$avatar = 'http://' . $avatar;
}
// montego - added check for valid avatar extension - simply add additional extensions if you wish to allow
// Note, however, that remote avatars can be dangerous as PHP script can be run even if an extension is valid!
if (!preg_match('/(\.gif|\.png|\.jpg|\.jpeg)$/is', $avatar)) {
	$avatar = '';
	$error = true;
	$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . _AVATAR_FORMAT : _AVATAR_FORMAT;
}

// Palbin - skip if empty
if ($avatar != '') {
	//Palbin - Added to make remote avatars comply with file size limits
	$file_check = false;
	if (extension_loaded('curl')) {
		$file_check = true;
		$ch = curl_init($avatar);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
		$data = curl_exec($ch);
		curl_close($ch);
		if ($data === false) {
			$file_check = false;
			$error = true;
			$error_msg = 'cURL failed.';
		}
		if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
			$avatar_filesize = (int)$matches[1];
		} else {
			$file_check = false;
			$error = true;
			$error_msg = 'cURL failed to return Content-Length.';
		}
	} elseif (strnatcmp(phpversion(),'5.1.3') >= 0) {
		$file_check = true;
		$avatar_filesize = array_change_key_case(get_headers($avatar, 1),CASE_LOWER);
		$avatar_filesize = $avatar_filesize['content-length'];
	}

	if ($file_check) {
		$avatar_filesize = round($avatar_filesize / (1024));
		if ( $avatar_filesize > round($board_config['avatar_filesize'] / 1024) ) {
			$l_avatar_size = sprintf(_AVATAR_FILESIZE, round($board_config['avatar_filesize'] / 1024));
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
		}
	}

	//Palbin - Added to make remote avatars comply with width & height limits
	list($width, $height, $type) = @getimagesize($avatar);
	if ( $width > $board_config['avatar_max_width'] || $height > $board_config['avatar_max_height'] ) {
		$l_avatar_size = sprintf(_AVATAR_IMAGESIZE, $board_config['avatar_max_width'], $board_config['avatar_max_height']);
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
	}
}

//Palbin - error check
if ($error) {
	echo '<p class="content" align="center">' . $error_msg . '<br />';
	echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> ]';
} else {
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_avatar=\'' . addslashes($avatar) . '\', user_avatar_type=\'2\' WHERE username=\'' . $cookie[1] . '\'');
	echo '<p class="content" align="center">' . _YA_AVATARFOR . ' ' . $cookie[1] . ' ' . _YA_SAVED . '<br />';
	// montego - given that the above IF forces 'http' to be in the $avatar variable, the following IF statement
	// makes no sense.
	//if (preg_match('/(http)/', $avatar)) {
		echo _YA_NEWAVATAR . ':<br /><img alt="" src="' . $avatar . '" /><br />';
		echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
	//} elseif ($avatar) {
	//	echo _YA_NEWAVATAR . ':<br /><img alt="" src="' . $direktori . '/' . $avatar . '" /><br />';
	//	echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
	//}
}
echo '</p>';
CloseTable();
include_once 'footer.php';

?>