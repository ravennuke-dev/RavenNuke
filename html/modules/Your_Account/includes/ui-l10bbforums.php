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
if (!defined('RNYA') || !defined('MODULE_FILE')) {
	header('Location: ../../../../index.php');
	die();
}

if (is_active('Forums')) {
	global $admin, $db, $prefix, $userinfo, $usrinfo, $user_prefix;

	/*
	* We need auth constants to make this easier to understand
	*/
	if(!defined('IN_PHPBB')) define('IN_PHPBB', TRUE);
	require_once NUKE_MODULES_DIR . 'Forums/includes/constants.php';

	if (!function_exists('auth')) {
		function auth($userdata) {
			global $db, $prefix, $user;

			$auth_fields = array('auth_view', 'auth_read');

			/*
			* We need to pull the auth information on the all forums
			*/

			$sql = 'SELECT forum_id, auth_view, auth_read'
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
				$sql = 'SELECT a.forum_id, a.auth_view, a.auth_read, a.auth_mod '
							. 'FROM `' . $prefix . '_bbauth_access` a, `' . $prefix . '_bbuser_group` ug '
							 . 'WHERE ug.user_id = ' . $userdata['user_id']
				 				. ' AND ug.user_pending = 0'
								. ' AND a.group_id = ug.group_id';
				$result = $db->sql_query($sql);

				if ( $row = $db->sql_fetchrow($result) ) {
					do {
						$u_access[$row['forum_id']][] = $row;
					} while( $row = $db->sql_fetchrow($result) );
				}
			}

			/*
			* Is user an admin?
			*/
			$is_admin = (isset($userdata['user_level']) && $userdata['user_level'] == 2) ? TRUE : 0;

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
	* Get access permissions for all forums dependent on the user
	*/
	if (defined('LOGGEDIN_SAME_USER')) {
		$f_permission = auth($usrinfo);
	} else {
		$f_permission = auth($userinfo);
	}

	// Last 10 Forum Topics
	$result = $db->sql_query( 'SELECT t.topic_id, t.forum_id, t.topic_last_post_id, t.topic_title, t.topic_poster, t.topic_views, t.topic_replies, t.topic_moved_id, t.topic_status, f.forum_name'
							. ' FROM `' . $prefix . '_bbtopics` t, `' . $prefix . '_bbforums` f'
							. ' WHERE t.forum_id AND t.forum_id=f.forum_id AND t.topic_poster=\'' . (int) $usrinfo['user_id'] . '\' ORDER BY t.topic_time DESC LIMIT 0, 30');

	if (($db->sql_numrows($result) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . htmlspecialchars($usrinfo['username'], ENT_QUOTES, _CHARSET) . '\'s ' . _LAST10BBTOPIC . ':</strong><ul>';
		$countTopics = 0;
		while( list( $topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_moved_id, $topic_status, $forum_name ) = $db->sql_fetchrow($result, SQL_NUM) ) {
			$skip_display = 0;

			$result1 = $db->sql_query( 'SELECT `auth_view`, `auth_read`, `forum_name`, `cat_id` FROM `' . $prefix . '_bbforums` WHERE `forum_id` = "' . $forum_id . '"');
			list( $auth_view, $auth_read, $forum_name, $cat_id ) = $db->sql_fetchrow($result1, SQL_NUM);

			if ( ( $auth_view != 0 ) || ( $auth_read != 0 ) ) {
				if ($f_permission[$forum_id]['auth_read'] == FALSE) {
					$skip_display = 1;
				}
			}

			if ($topic_moved_id != 0) {
				// Shadow Topic !!
				$skip_display = 1;
			}

			if( $skip_display == 0 || is_admin($admin)) {
				echo '<li><a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '">' . htmlspecialchars($forum_name, ENT_QUOTES, _CHARSET) . '</a> &#187;'
					. ' <a href="modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic_id . '">' . htmlspecialchars($topic_title, ENT_QUOTES, _CHARSET) . '</a></li>';
				$countTopics++;
			}

			if($countTopics == 10) {
				break 1;
			}
		}
		echo '</ul>';
		CloseTable();
	}

	// Last 10 Forum Posts
	$result = $db->sql_query('SELECT p.post_id, r.post_subject, f.forum_name, p.forum_id from `' . $prefix . '_bbposts` p, `' . $prefix . '_bbposts_text` r, `' . $prefix . '_bbforums` f'
							. ' WHERE p.forum_id=f.forum_id AND r.post_id=p.post_id AND p.poster_id=\'' . (int) $usrinfo['user_id'] . '\' ORDER BY p.post_time DESC LIMIT 0, 30');
	if (($db->sql_numrows($result) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . htmlspecialchars($usrinfo['username'], ENT_QUOTES, _CHARSET) . '\'s ' . _LAST10BBPOST . ':</strong><ul>';
		$countPosts = 0;
		while (list($post_id, $post_subject, $forum_name, $forum_id) = $db->sql_fetchrow($result, SQL_NUM)) {
			if ($post_subject == '') {
				$post_subject = '<span class="italic">' . _NOPOSTSUBJECT . '</span>';
			} else {
				$post_subject = htmlspecialchars($post_subject, ENT_QUOTES, _CHARSET);
			}

			$skip_display = 0;

			$result1 = $db->sql_query( 'SELECT `auth_view`, `auth_read`, `forum_name`, `cat_id` FROM `' . $prefix . '_bbforums` WHERE `forum_id` = "' . $forum_id . '"');
			list( $auth_view, $auth_read, $forum_name, $cat_id ) = $db->sql_fetchrow($result1, SQL_NUM);

			if ( ( $auth_view != 0 ) || ( $auth_read != 0 ) ) {
				if ($f_permission[$forum_id]['auth_read'] == FALSE) {
					$skip_display = 1;
				}
			}

			if( $skip_display == 0 ) {
				echo '<li><a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '">' . htmlspecialchars($forum_name, ENT_QUOTES, _CHARSET) . '</a> &#187;'
					. ' <a href="modules.php?name=Forums&amp;file=viewtopic&amp;p=' . $post_id . '#' . $post_id . '">' . $post_subject . '</a></li>';
				$countPosts++;
			}

			if($countPosts == 10) {
				break 1;
			}
		}
		echo '</ul>';
		CloseTable();
	}
}

?>