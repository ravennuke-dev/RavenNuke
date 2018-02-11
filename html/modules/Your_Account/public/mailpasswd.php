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
$username = isset($username) ? check_html(trim($username), 'nohtml') : ''; // RN0001003
$user_email = isset($user_email) ? check_html(trim($user_email), 'nohtml') : ''; // RN0001003
if ($username != '' AND $user_email == '') {
	$sql = 'SELECT username, user_email, user_password, user_level FROM ' . $user_prefix . '_users WHERE username=\'' . addslashes($username) . '\'';
} elseif ($username == '' AND $user_email != '') {
	$sql = 'SELECT username, user_email, user_password, user_level FROM ' . $user_prefix . '_users WHERE user_email=\'' . addslashes($user_email) . '\'';
} else {
	include_once 'header.php';
	// removed by menelaos dot hetnet dot nl
	//title(_USERREGLOGIN);
	Show_YA_menu();
	OpenTable();
	echo '<div class="text-center title">' . _YA_MUSTSUPPLY . '</div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
$result = $db->sql_query($sql);
if ($db->sql_numrows($result) == 0) {
	include_once 'header.php';
	// removed by menelaos dot hetnet dot nl
	//title(_USERREGLOGIN);
	Show_YA_menu();
	OpenTable();
	echo '<div class="text-center title">' . _SORRYNOUSERINFO . '</div>';
	CloseTable();
	include_once 'footer.php';
} else {
	if ($ya_config['servermail'] == 1) {
		$host_name = $_SERVER['REMOTE_ADDR'];
		if(!validIP($host_name)) $host_name = ''; // RN0001003 + tightened it up some with new validIP() function in mainfile.php
		$row = $db->sql_fetchrow($result);
		$user_name = $row['username'];
		$user_email = $row['user_email'];
		$user_password = $row['user_password'];
		$user_level = (int)$row['user_level'];
		if ($user_level > 0) {
			$areyou = substr($user_password, 0, 10);
			if ($areyou == $code) {
				$newpass = YA_MakePass();
				$message = _USERACCOUNT . ' \'' . $user_name . '\' ' . _AT . ' ' . $sitename . ' ' . _HASTHISEMAIL . '  ' . _AWEBUSERFROM . ' ' . $host_name . ' ' . _HASREQUESTED . "\r\n\r\n";
				$message .= _YOURNEWPASSWORD . ' ' . $newpass . "\r\n\r\n ";
				$message .= _YOUCANCHANGE . "\r\n" . $nukeurl . '/modules.php?name=' . $module_name . "\r\n\r\n" . _IFYOUDIDNOTASK;
				$subject = _USERPASSWORD4;
				if ($username != '') {
					$subject .= ' \'' . $user_name . '\'';
				} else if ($user_email != '') {
					$subject .= ' \'' . $user_email . '\'';
				}
				ya_mail($user_email, $subject, $message, '');
				$cryptpass = md5($newpass);
				if ($username != '') {
					$query = 'UPDATE ' . $user_prefix . '_users SET user_password=\'' . $cryptpass . '\' WHERE username=\'' . addslashes($username) . '\'';
				} elseif ($user_email != '') {
					$query = 'UPDATE ' . $user_prefix . '_users SET user_password=\'' . $cryptpass . '\' WHERE user_email=\'' . addslashes($user_email) . '\'';
				}
				include_once 'header.php';
				OpenTable();
				if (!$db->sql_query($query)) {
					echo '<div class="text-center">' . _UPDATEFAILED . '</div><br />';
				}
				echo '<div class="text-center"><strong>' . _PASSWORD4 . ' ';
				if ($username != '') {
					echo '\'' . $user_name . '\'';
				} elseif ($user_email != '') {
					echo '\'' . $user_email . '\'';
				}
				echo ' ' . _MAILED . '</strong><br /><br />' . _GOBACK . '</div>';
				CloseTable();
				include_once 'footer.php';
			} else {
				$areyou = substr($user_password, 0, 10);
				$message = _USERACCOUNT . ' \'' . $user_name . '\' ' . _AT . ' ' . $sitename . ' ' . _HASTHISEMAIL . ' ' . _AWEBUSERFROM . ' ' . $host_name . ' ' . _CODEREQUESTED . "\r\n\r\n";
				$message .= _YOURCODEIS . ' ' . $areyou . "\r\n\r\n";
				$message .= _WITHTHISCODE . "\r\n" . $nukeurl . '/modules.php?name=' . $module_name . "&op=pass_lost\r\n\r\n";
				$message .= _IFYOUDIDNOTASK2;
				$subject = _CODEFOR;
				if ($username != '') {
					$subject .= ' \'' . $user_name . '\'';
				} else if ($user_email != '') {
					$subject .= ' \'' . $user_email . '\'';
				}
				ya_mail($user_email, $subject, $message, '');
				include_once 'header.php';
				OpenTable();
				echo '<div class="text-center"><strong>' . _CODEFOR . ' ';
				if ($username != '') {
					echo '\'' . $user_name . '\'';
				} else if ($user_email != '') {
					echo '\'' . $user_email . '\'';
				}
				echo ' ' . _MAILED . '</strong><br /><br />' . _GOBACK . '</div>';
				CloseTable();
				include_once 'footer.php';
			}
		} elseif ($user_level == 0) {
			include_once 'header.php';
			title(_USERREGLOGIN);
			OpenTable();
			echo '<div class="text-center title">' . _ACCSUSPENDED . '</div>';
			CloseTable();
			include_once 'footer.php';
		} else { // montego - previously had another elseif == -1 but then nothing to handle anything lower - don't like blank pages.
			include_once 'header.php';
			title(_USERREGLOGIN);
			OpenTable();
			echo '<div class="text-center title">' . _ACCDELETED . '</div>';
			CloseTable();
			include_once 'footer.php';
		}
	} else {
		include_once 'header.php';
		title(_USERREGLOGIN);
		OpenTable();
		echo '<div class="text-center">' . _SERVERNOMAIL . '</div>';
		CloseTable();
		include_once 'footer.php';
	}
}
?>