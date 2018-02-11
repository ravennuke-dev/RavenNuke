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
/* RN Your Account is based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN')) {
	die ('Illegal File Access');
}

if (($radminsuper==1) OR ($radminuser==1)) {

	// Delete other user info before removing user in case there is a problem along the way	
	$db->sql_query('UPDATE ' . $prefix . '_bbposts SET poster_id = 1, post_username = \'' . $rem_uname . '\' WHERE poster_id = \''.$rem_uid.'\'');
	$db->sql_query('UPDATE ' . $prefix . '_bbtopics SET topic_poster = 1 WHERE topic_poster = \''.$rem_uid.'\'');
	$db->sql_query('UPDATE ' . $prefix . '_bbvote_voters SET vote_user_id = 1 WHERE vote_user_id = \''.$rem_uid.'\'');
	
	// Remove other phpbb related info
	$db->sql_query('DELETE FROM ' . $prefix . '_bbtopics_watch WHERE user_id=\''.$rem_uid.'\'');
	$db->sql_query('DELETE FROM ' . $prefix . '_bbbanlist WHERE ban_userid=\''.$rem_uid.'\'');
	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbtopics_watch');
	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbbanlist');
	
	$result3 = $db->sql_query('SELECT privmsgs_id FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_from_userid = \''.$rem_uid.'\' OR privmsgs_to_userid = \''.$rem_uid.'\'');
	if ($db->sql_numrows($result3) > 0) {
		while ( $row_privmsgs = $db->sql_fetchrow($result3) ) {
			$mark_list[] = $row_privmsgs['privmsgs_id'];
		}
		$delete_sql_id = implode(', ', $mark_list);
		$db->sql_query('DELETE FROM ' . $prefix . '_bbprivmsgs_text WHERE privmsgs_text_id IN ('.	$delete_sql_id.')');
		$db->sql_query('DELETE FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_id IN ('.$delete_sql_id.')');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbprivmsgs_text');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbprivmsgs');
	}
}

?>