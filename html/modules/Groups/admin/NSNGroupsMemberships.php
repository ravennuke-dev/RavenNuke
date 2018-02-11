<?php
/*
 * NSNGroups: Memberships addon
 * 2018.01.07 neralex
 * http://www.ravenphpscripts.com/ftopicp-165692.html#165692
*/
if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}
if(!isset($op)) $op = '';
if(!isset($yauserid)) $yauserid = '';

if(is_mod_admin($module_name)) {
	$result = $db->sql_query('SELECT * FROM `' . $user_prefix . '_users` WHERE `user_level` > \'0\' AND `user_id` > \'1\' ORDER BY `username` ASC');
	$pagetitle = _GR_ADMIN . ': ' . _GR_MEMBERSHIPS;
	include_once('header.php');
	title($pagetitle);
	NSNGroupsAdmin();
	echo '<br />';
	OpenTable();
	echo '<form action="' , $admin_file , '.php" method="get">'
		,'<input type="hidden" name="op" value="', $op, '" />';
	if($db->sql_numrows($result) > 0) {
		echo '<select name="yauserid" id="yauserid">';
		while ($yauser = $db->sql_fetchrow($result)) {
			echo '<option value="', $yauser['user_id'], '"', ($yauser['user_id'] == $yauserid ? ' selected="selected"' : ''), '>', $yauser['username'], '</option>';
		} # end of while
		echo '</select>'
			,'&nbsp;<input value="Submit" type="submit" /><br />';
		echo csrf_rn_token('input');
	} else {
		echo '<div class="thick">Nothing found!</div>';
	}
	echo '</form><br /><br />';
	if (is_numeric($yauserid) && $yauserid > 1) {
		csrf_check();
		$result11 = $db->sql_query('SELECT g.`gid`, g.`gname`, g.`muid`, u.`uid` FROM `' . $prefix . '_nsngr_users` u LEFT JOIN `' . $prefix . '_nsngr_groups` g ON g.`gid` = u.`gid` WHERE u.`uid` = \'' . $yauserid . '\' ORDER BY g.`gid`');
		if (($db->sql_numrows($result11) > 0)) {
			$nameqry = $db->sql_query('SELECT `username` FROM `'.$user_prefix.'_users` WHERE `user_id` = \'' . $yauserid . '\'');
			list($username) = $db->sql_fetchrow($nameqry);
			echo '<strong>', $username, '\'s ', _MEMBERGROUPS, ':</strong><ul>';
			while (list($gid, $gname, $muid, $uid) = $db->sql_fetchrow($result11)) {
				list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid` = \'' . $gid . '\''));
				echo '<li><a href="' , $admin_file , '.php?op=NSNGroupsUsersAdd&amp;gid=', $gid, '">', $gname, ' (', $gid, ')</a>';
				list($edate) = $db->sql_fetchrow($db->sql_query('SELECT `edate` FROM `' . $prefix . '_nsngr_users` WHERE `uid` = \'' . $yauserid . '\' AND `gid` = \'' . $gid . '\''));
				if ($edate != 0) {
					echo '&nbsp;&nbsp;- <span class="italic">', _EXPIRES, ' ', date('d F Y', $edate), '</span>';
				} else {
					echo '&nbsp;&nbsp;- <span class="italic">', _NOTSET, '</span>';
				}
				if ($muid == $uid) {
					echo '&nbsp;(', _GR_BBMODERATOR, ')';
				}
				echo '</li>';
			} #end of while
			echo '</ul>';
		} else {
			echo '<div class="thick">Nothing found!</div>';
		}
	}
	CloseTable();
	include_once('footer.php');
}