<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This is a 2 min hack of the old forum block to work with the phpBB2  */
/* port.                                                                */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $admin, $db, $prefix, $nuke_config, $userinfo, $user_prefix;

/*
* We need auth constants to make this easier to understand
*/
if(!defined('IN_PHPBB')) define('IN_PHPBB', TRUE);
require_once NUKE_MODULES_DIR . 'Forums/includes/constants.php';

if (!function_exists('auth')) {
	function auth($userdata) {
		global $db, $prefix, $user;

		$a_sql = 'auth_view, auth_read';
		$auth_fields = array('auth_view', 'auth_read');

		/*
		* We need to pull the auth information on the all forums
		*/

		$sql = 'SELECT forum_id, ' . $a_sql
					. ' FROM `' . $prefix . '_bbforums`';
		$result = $db->sql_query($sql);

		if ( !($f_access = $db->sql_fetchrowset($result)) ) {
			return array();
		}

		/*
		* If the user isn't logged on then all we need do is check if the forum
		* has the type set to ALL, if yes they are good to go, if not then they
		* are denied access
		*/
		$u_access = array();

		if (is_user($user)) {
			$sql = 'SELECT a.forum_id, ' . $a_sql . ', a.auth_mod '
						. 'FROM `' . $prefix . '_bbauth_access` a, `' . $prefix . '_bbuser_group` ug '
						. 'WHERE ug.user_id = ' . $userdata['user_id']
							. ' AND ug.user_pending = 0'
							. ' AND a.group_id = ug.group_id';
			$result = $db->sql_query($sql);

			if ( $row = $db->sql_fetchrow($result) ) {
				do{
						$u_access[$row['forum_id']][] = $row;
				} while( $row = $db->sql_fetchrow($result) );
			}
			/*
			* Is user an admin?
			*/
			$is_admin = ( $userdata['user_level'] == 2 ) ? TRUE : 0;
		} else {
			$is_admin = 0;
		}

		$auth_user = array();
		for($i = 0; $i < count($auth_fields); $i++) {
			$key = $auth_fields[$i];

			/*
			* If the type if ACL, MOD or ADMIN then we need to see if the user has specific permissions
			* to do whatever it is they want to do ... to do this we pull relevant information for the
			* user (and any groups they belong to)
			*
			* Now we compare the users access level against the forums. We assume here that a moderator
			* and admin automatically have access to an ACL forum, similarly we assume admins meet an
			* auth requirement of MOD
			*/
			for($k = 0; $k < count($f_access); $k++) {
				$value = $f_access[$k][$key];
				$f_forum_id = $f_access[$k]['forum_id'];
				$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
				switch( $value ) {
					case AUTH_ALL:
						$auth_user[$f_forum_id][$key] = TRUE;
						break;
					case AUTH_REG:
						$auth_user[$f_forum_id][$key] = TRUE;
						break;
					case AUTH_ACL:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_ACL, $key, $u_access[$f_forum_id], $is_admin);
						break;
					case AUTH_MOD:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
						break;
					case AUTH_ADMIN:
						$auth_user[$f_forum_id][$key] = $is_admin;
						break;
					default:
						$auth_user[$f_forum_id][$key] = 0;
						break;
				}
			}
		}

		/*
		* Is user a moderator?
		*/
		for($k = 0; $k < count($f_access); $k++) {
			$f_forum_id = $f_access[$k]['forum_id'];

			$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
			$auth_user[$f_forum_id]['auth_mod'] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
		}

		return $auth_user;
	}
}

if (!function_exists('auth_check_user')) {
	function auth_check_user($type, $key, $u_access, $is_admin) {
		$auth_user = 0;

		if ( count($u_access) ) {
			for($j = 0; $j < count($u_access); $j++) {
				$result = 0;
				switch($type) {
					case AUTH_ACL:
						$result = $u_access[$j][$key];
					case AUTH_MOD:
						$result = $result || $u_access[$j]['auth_mod'];
					case AUTH_ADMIN:
						$result = $result || $is_admin;
						break;
				}

				$auth_user = $auth_user || $result;
			}
		} else {
			$auth_user = $is_admin;
		}

		return $auth_user;
	}
}

/*
* Get users forum permissions
*/
$f_permission = auth($userinfo);

$sql = 'SELECT t.forum_id, topic_id, topic_title, auth_view, auth_read FROM `' . $prefix . '_bbtopics` AS t, `' . $prefix . '_bbforums` AS f WHERE f.forum_id=t.forum_id ORDER BY topic_time DESC LIMIT 20';
$result = $db->sql_query($sql);
$content = '<br />';
$countTopics = 0;
while (list($forum_id, $topic_id, $topic_title, $auth_view, $auth_read) = $db->sql_fetchrow($result)) {
	$skip_display = 0;
	if ( ( $auth_view != 0 ) || ( $auth_read != 0 ) ) {
		if ($f_permission[$forum_id]['auth_read'] == FALSE) {
			$skip_display = 1;
		}
	}

	if( $skip_display == 0 || is_admin($admin)) {
		$content .= '<img src="images/arrow.gif" border="0" alt="" title="" width="9" height="9" /> <a href="modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic_id . '">' . htmlspecialchars($topic_title, ENT_QUOTES, _CHARSET) . '</a><br />';
		$countTopics++;
	}

	if($countTopics == 10) {
		break 1;
	}
}

$content .= '<br /><div class="text-center"><a href="modules.php?name=Forums"><span class="thick">' . htmlspecialchars($nuke_config['sitename'], ENT_QUOTES, _CHARSET) . ' Forums</span></a><br /><br /></div>';

?>