<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
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

	// Delete phpbb groups associated with the user
	$result1 = $db->sql_query('SELECT group_id FROM ' . $prefix . '_bbuser_group WHERE user_id = \''.$del_uid.'\'');
	if ($db->sql_numrows($result1) > 0) {
		while ( $row_grouplist = $db->sql_fetchrow($result1) ) {
			$group_list[] = $row_grouplist['group_id'];
		}
		
		$db->sql_query('DELETE FROM ' . $prefix . '_bbuser_group WHERE user_id=\''.$del_uid.'\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbuser_group');
		
		$delete_sql_id = implode(', ', $group_list);
		
		$result2 = $db->sql_query('SELECT group_id FROM ' . $prefix . '_bbgroups WHERE group_moderator = \'0\' AND group_single_user = \'1\' AND group_id IN ('.$delete_sql_id.')');
		if ($db->sql_numrows($result2) >= 1) {
			list($group_id) = $db->sql_fetchrow($result2);
			$db->sql_query('DELETE FROM ' . $prefix . '_bbauth_access WHERE group_id = '.$group_id.'');
			$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbauth_access');
		}
		
		$db->sql_query('DELETE FROM ' . $prefix . '_bbgroups WHERE group_moderator = \'0\' AND group_single_user = \'1\' AND group_id IN ('.$delete_sql_id.')');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbgroups');
	}
}

?>