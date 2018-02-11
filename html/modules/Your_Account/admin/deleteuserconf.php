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
if (!defined('YA_ADMIN')) {
	die ('Illegal File Access');
}

if (($radminsuper==1) OR ($radminuser==1)) {

	list($email) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_id='$del_uid'"));
	if ($ya_config['servermail'] == 1) {
		$message = _SORRYTO." $sitename "._HASDELETE;
		if ($deletereason > '') {
			$deletereason = stripslashes($deletereason);
			$message .= "\r\n\r\n"._DELETEREASON."\r\n$deletereason";
		  }
/*        $subject = _ACCTDELETE;
		  ya_mail($email, $subject, $message, ''); */
	}
	$db->sql_query("UPDATE ".$user_prefix."_users SET name='"._MEMDEL."', user_password='', user_website='', user_sig='', user_level='-1', user_active='0', user_allow_pm='0', points='0' WHERE user_id='$del_uid'");
	// Delete NSN Group Info
	$db->sql_query('DELETE FROM ' . $prefix . '_nsngr_users WHERE uid = \'' . $del_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_nsngr_users');
	include_once ('modules/'.$module_name.'/admin/deleteuserconf_phpbb.php');
	$pagetitle = ": "._USERADMIN." - "._ACCTDELETE;
	include('header.php');
	amain();
	echo '<br />';
	OpenTable();
	echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
	if (isset($listtype)) { echo '<input type="hidden" name="listtype" value="'.$listtype.'" />'."\n"; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
	echo '<div class="text-center"><table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
	echo '<tr><td align="center"><span class="thick">'._ACCTDELETE.'</span></td></tr>'."\n";
	echo '<tr><td align="center"><input type="submit" value="'._RETURN2.'" /></td></tr>'."\n";
	echo '</table></div>'."\n";
	echo '</form>';
	CloseTable();
	include('footer.php');
}
?>