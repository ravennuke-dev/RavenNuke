<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2004 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

global $bypassNukeSentinelInvalidIPCheck, $db, $prefix;

$ip = $_SERVER['REMOTE_ADDR'];
$ipv4 = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
$ipv6 = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
if(!$ipv4 && (!$ipv6 && !$bypassNukeSentinelInvalidIPCheck)) die('Invalid IP Address!');

$numrow = $db->sql_numrows($db->sql_query('SELECT `id` FROM `' . $prefix . '_banned_ip` WHERE `ip_address`="' . $ip . '"'));
if ($numrow != 0) {
	echo '<br /><br /><div class="text-center"><img src="images/admin/ipban.gif" /><br /><br /><span class="thick">You have been banned by the administrator</span></div>';
	die();
}

if ($ipv4) {
	$ip_class = explode('.', $ip);
	$ip = $ip_class[0] . '.' . $ip_class[1] . '.' . $ip_class[2] . '.*';
	list($ip_address) = $db->sql_fetchrow($db->sql_query('SELECT `ip_address` FROM `' . $prefix . '_banned_ip` WHERE `ip_address`="' . $ip . '"'));
	$ip_class_banned = explode('.', $ip_address);
	if (isset($ip_class_banned[3]) && $ip_class_banned[3] == '*') {
		if ($ip_class[0] == $ip_class_banned[0] && $ip_class[1] == $ip_class_banned[1] && $ip_class[2] == $ip_class_banned[2]) {
			echo '<br /><br /><div class="text-center"><img src="images/admin/ipban.gif" /><br /><br /><span class="thick">You have been banned by the administrator</span></div>';
			die();
		}
	}
}

?>
