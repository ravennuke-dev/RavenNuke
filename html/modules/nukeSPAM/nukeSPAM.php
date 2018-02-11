<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 *
 * Based on "SpamBot Search Tool" version v0.52 by MysteryFCM
 */
global $nukeSPAMrequest, $op;
// What type of request?
// UR = User Registration
// FB = Feedback
// CU = Contact Us
// AC = Admin Check
$nukeSPAMrequest = '';
if (!isset($name)) $name ='';
if ($name == 'Your_Account') $nukeSPAMrequest = 'UR';
if ($name == 'Feedback') $nukeSPAMrequest = 'FB';
if ($name == 'Contact_Us') $nukeSPAMrequest = 'CU';
if ($name == 'Contact_Plus') $nukeSPAMrequest = 'CU';
if ($op == 'nukeSPAMCheck') $nukeSPAMrequest = 'AC';
require_once NUKE_MODULES_DIR . 'nukeSPAM/functions.php';
seoGetLang('nukeSPAM');

// Set our timezone (PHP apparently cries if you've got E_STRICT or E_ALL set)
if (@ini_get('date.timezone') == '') {
	date_default_timezone_set("America/New_York");
}

function nukeSPAM($username, $user_email, $ip = '') {
  global $admin, $adminmail, $db, $nsnst_const, $prefix;
	if (method_exists($db, 'sql_escape_string')) {
		$username = $db->sql_escape_string($username);
	} else {
		$username = addslashes($username);
	}
	$u = urlencode($username);
	$e = urlencode($user_email);
	$aAr = preg_split('/@/',$adminmail);
	$eAdd= $aAr[0];
	$eDom = $aAr[1];
	// Admin may be checking blank or specific IP. If admin is registering, do not use IP
	if (!is_admin($admin)) {
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
		if (!validIP($ip)) $ip = '0.0.0.0';
	}

	// Check Whitelist
	if(strlen($u)==0)$wLu="NULL"; else $wLu = $u; 
	if(strlen($e)==0)$wLe="nobody@example.com"; else $wLe = $e;
	$sql = 'select count(1) as count from ' . $prefix . '_spam_whitelist where wltype = "u" and wlvalue ="' . $wLu . '";';
	$wLthis = $db->sql_fetchrow($db->sql_query($sql));
	if (intval($wLthis['count']) > 0) $u = '';
	$sql = 'select count(1) as count from ' . $prefix . '_spam_whitelist where wltype = "e" and wlvalue ="' . $wLe . '";';
	$wLthis = $db->sql_fetchrow($db->sql_query($sql));
	if (intval($wLthis['count']) > 0) $e = '';
	$sql = 'select count(1) as count from ' . $prefix . '_spam_whitelist where wltype = "i" and wlvalue ="' . $ip . '";';
	$wLthis = $db->sql_fetchrow($db->sql_query($sql));
	if (intval($wLthis['count']) > 0) $ip = '';

	$spambot = '';
	$spambot = checkSpambots($e, $ip, $u);
	if ($spambot === true) {
		$constant = _SPAM_BLOCKED;
		$constant_ext1 = ': ';
		$constant_ext2 = '!';
		$jsadress = '<script type="text/javascript">' . PHP_EOL
				  . '//<![CDATA[' . PHP_EOL
				  . 'eAdd="' . $eAdd . '"' . PHP_EOL
				  . 'eDom = "' . $eDom . '"' . PHP_EOL
				  . 'document.write(\'<a href="mailto:\' + eAdd + \'@\' + eDom + \'">\' + eAdd + \'@\' + eDom + \'<\/a><span style="display:none">\')'
				  . '//]]>' . PHP_EOL
				  . '</script>' . PHP_EOL
				  . '<script type="text/javascript">' . PHP_EOL
				  . '//<![CDATA[' . PHP_EOL
				  . 'document.write(\'<\/span>\')' . PHP_EOL
				  . '//]]>' . PHP_EOL
				  . '</script>' . PHP_EOL
				  . '<br />' . PHP_EOL;

		$return = array(
			'constant' => $constant,
			'constant_ext1' => $constant_ext1,
			'constant_ext2' => $constant_ext2,
			'eAdd' => $eAdd,
			'eDom' => $eDom,
			'jsadress' => $jsadress
		);

	} else {
		$constant = '';
		$constant_ext1 = '';
		$constant_ext2 = '';
		$jsadress = '';
		$return = '';
	}
	return $return;
}

?>