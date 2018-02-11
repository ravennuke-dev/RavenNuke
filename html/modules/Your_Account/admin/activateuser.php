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
if (!defined('YA_ADMIN'))
{
	header('Location: ../../../index.php');
	die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	include_once('header.php');
	list($username, $realname, $email, $check_num, $admin_approve) = $db->sql_fetchrow($db->sql_query("SELECT username, name, user_email, check_num, admin_approve FROM ".$user_prefix."_users_temp WHERE user_id='$act_uid'"));
	$pagetitle = ": "._USERADMIN." - "._YA_ACTIVATEUSER;
	title(_USERADMIN." - "._YA_ACTIVATEUSER);
	amain();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><table align="center" border="0" cellpadding="0" cellspacing="0">';
	echo '<tr><td align="center"><span class="thick">'._SURE2ACTIVATE.':</span></td></tr><tr><td><br />';
	OpenTable();
	echo '<table border="0" align="center">';
	echo '<tr><td width="50%"><span class="thick">'._USERNAME.':</span></td><td align="left">'.$username.'<br /></td></tr>';
	echo '<tr><td width="50%"><span class="thick">'._UREALNAME.':</span></td><td align="left">'.$realname.'<br /></td></tr>';
	echo '<tr><td width="50%"><span class="thick">'._EMAIL.':</span></td><td align="left">'.$email.'</td></tr>';
	echo '</table>';
	CloseTable();

	echo '<br /></td></tr>';
	echo '<tr><td colspan="2" align="center">';
	echo '<table cellspacing="0" cellpadding="0" border="0" align="center"><tr><td width="49%" align="right">';
	echo '<form action="'.$admin_file.'.php" method="post">';
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'; }
	if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'; }
	echo '<input type="hidden" name="op" value="yaActivateUserConf" />';
	echo '<input type="hidden" name="act_uid" value="'.$act_uid.'" />';
	echo '<input type="submit" value="'._YES.'" /></form></td>';
	echo '<td width="10">&nbsp;</td>';
	echo '<td width="49%" align="left"><form action="#" method="post">';
	echo '<input type="button" value="'._NO.'" onclick="history.go(-1)" /></form></td>';
	echo '</tr><tr><td colspan="3" align="center">';
	echo '<br /><span class="thick">'._YA_ACTIVATEWARN1.'</span>';
	if (!$admin_approve) {
		echo '<br /><span class="thick">'._YA_ACTIVATEWARN2.'</span>';
		echo '</td></tr><tr><td colspan="3" align="center">';
		echo '<form action="'.$admin_file.'.php" method="post">';
		if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'; }
		if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'; }
		echo '<input type="hidden" name="op" value="yaApproveUserConf" />';
		echo '<input type="hidden" name="apr_uid" value="'.$act_uid.'" />';
		echo '<input type="submit" value="'._YA_APPROVEUSER.'" /></form>';
	}
	echo '</td></tr></table>';
	echo '</td></tr></table></div>';
	CloseTable();
	include_once('footer.php');
}
?>