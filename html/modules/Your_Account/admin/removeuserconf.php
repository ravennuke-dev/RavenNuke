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

	list($email, $level) = $db->sql_fetchrow($db->sql_query('SELECT user_email, user_level FROM '.$user_prefix.'_users WHERE user_id=\''.$rem_uid.'\''));
	if ($level > -1 AND $ya_config['servermail'] == 1) {
		$message = _SORRYTO." $sitename "._HASREMOVE;
		$subject = _ACCTREMOVE;
		ya_mail($email, $subject, $message, '');
	}
		
	include_once ('modules/'.$module_name.'/admin/removeuserconf_phpbb.php');
	
	// Add modular logic here to remove other user related info
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users_field_values WHERE uid=\'' . $rem_uid . '\'');
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users WHERE user_id=\'' . $rem_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_field_values');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users');

	$pagetitle = ': ' . _USERADMIN . ' - ' . _ACCTREMOVE;
	include_once 'header.php';
	amain();
	echo '<br />';
	OpenTable();
	echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
	if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
	if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
	echo "<div class='text-center'><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
	echo "<tr><td align='center'><span class='thick'>"._ACCTREMOVE."</span></td></tr>\n";
	echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
	echo "</table></div>\n";
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
}

?>