<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}

global $adminmail, $db, $nukeurl, $prefix, $sitename, $user_prefix;

get_lang('Groups');

$currdate = time();
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_users` WHERE (`edate`<\'' . $currdate . '\' AND `edate`!=0) AND `trial`=0');
while ($row = $db->sql_fetchrow($result)) {
	list($phpBB) = $db->sql_fetchrow($db->sql_query('SELECT `phpBB` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $row['gid'] . '\''));
	$db->sql_query('DELETE FROM `' . $prefix . '_nsngr_users` WHERE (`edate`<\'' . $currdate . '\' AND `edate`!=0) AND `trial`=0');
	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsngr_users`');
	$db->sql_query('DELETE FROM `' . $prefix . '_bbuser_group` WHERE `group_id`=\'' . $phpBB . '\' and `user_id`=\'' . $row['uid'] . '\'');
	$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_bbuser_group`');
}

$exprdate = $currdate+604800;

$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_users` WHERE (`edate`<\'' . $exprdate . '\' AND `edate`!=0) AND `notice`=0');
if ($result) require_once NUKE_MODULES_DIR . 'Groups/includes/nsngr_module_func.php';
while ($row = $db->sql_fetchrow($result)) {
	$grsend = grget_config('send_notice');
	if ($grsend > 0) {
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT `username`, `user_email` FROM `' . $user_prefix . '_users` WHERE `user_id`=\'' . $row['uid'] . '\''));
		$row3 = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $row['gid'] . '\''));
		$from = 'From: ' . $sitename . ' <' . $adminmail . ">\r\n";
		$subject = $row3['gname'] . ' ' . _GR_MEMBERSHIP . ' ' . _GR_EXPIRESSOON;
		$body = $row2['username'] . ':' . "\r\r" . _GR_EXPIREEXPLAIN . "\r\r" . $sitename . " \r" . $nukeurl;
		/*
		* TegoNuke Mailer added by montego for 2.20.00
		*/
		$mailsuccess = false;
		if (TNML_IS_ACTIVE) {
			$to = array(
				array($row2['user_email'], $row2['username'])
			);
			$mailsuccess = tnml_fMailer($to, $subject, $body, $adminmail, $sitename);
		} else {
			$mailsuccess = mail($row2['user_email'], $subject, $body, $from);
		}
		/*
		* end of TegoNuke Mailer add
		*/
	}
	$db->sql_query('UPDATE `' . $prefix . '_nsngr_users` SET `notice`=1 WHERE `uid`=\'' . $row['uid'] . '\' AND gid=\'' . $row['gid'] . '\'');
}

/**
 * ONLY Functions beyond this point
 */

function in_group($gid, $admin_bypass=false) {
	global $prefix, $db, $user, $admin, $cookie;
	$gid = intval($gid);
	if (is_admin($admin) && $admin_bypass=false) {
		return 1;
	} elseif (is_user($user)) {
		cookiedecode($user);
		$guid = $cookie[0];
		$currdate = time();
		$ingroup = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $guid . '\' AND (`edate`>\'' . $currdate . '\' OR `edate`=0)')); //RN0000994
		if ($ingroup > 0) {
			return 1;
		}
	}
	return 0;
}

function in_groups($gids) {
	global $prefix, $db, $user, $admin, $cookie;
	if (!is_array($gids)) {
		$gids = explode('-', $gids);
	}
	if (is_admin($admin)) {
		return 1;
	} elseif (is_user($user)) {
		cookiedecode($user);
		$guid = $cookie[0];
		$currdate = time();
		for ($i = 0;$i < count($gids);$i++) {
			$ingroup = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . intval($gids[$i]) . '\' AND `uid`=\'' . $guid . '\' AND (`edate`>\'' . $currdate . '\' OR `edate`=0)')); //RN0000994
			if ($ingroup > 0) {
				return 1;
			}
		}
	}
	return 0;
}

function is_ingroup($guid, $gid) {
	global $prefix, $db;
	$gid = intval($gid);
	$guid = intval($guid);
	$isgroup = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_users` WHERE `gid`=\'' . $gid . '\' AND `uid`=\'' . $guid . '\''));
	if ($isgroup > 0) {
		return 1;
	}
	return 0;
}

?>