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

	list($uname) = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='$chng_uid'"));
	$pagetitle = ": "._USERADMIN." - "._DELETEUSER;
	include('header.php');
	title(_USERADMIN." - "._DELETEUSER);
	amain();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><form action="'.$admin_file.'.php" method="post">';
	if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
	if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
	echo '<input type="hidden" name="op" value="yaDeleteUserConf" />'."\n";
	echo '<input type="hidden" name="del_uid" value="'.$chng_uid.'" />'."\n";
	echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";

	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_bbgroups WHERE group_moderator = \'' . $chng_uid . '\'');
	if ($db->sql_numrows($result) >= 1) {
		echo '<tr><td align="center"><span class="thick">'.$uname.'<span class="italic">('.$chng_uid.')</span></span> '._IS_MODERATOR.'  '._NEED_NEW_MODERATOR.'</td></tr>'."\n";
		while ($row = $db->sql_fetchrow($result)) {
			echo '<tr><td align="center"><span class="thick">'.$row['group_name'].'<span class="italic">('.$row['group_id'].')</span></span></td></tr>'."\n";
		}
		} else {
			echo '<tr><td align="center">'._SURE2DELETE.' <span class="thick">'.$uname.'<span class="italic">('.$chng_uid.')</span></span>?</td></tr>'."\n";
		if ($ya_config['servermail'] == 1) {
			echo '<tr><td align="center">'._DELETEREASON.'<br /><textarea name="deletereason" rows="5" cols="40"></textarea></td></tr>'."\n";
		}
		echo '<tr><td align="center"><input type="submit" value="'._DELETEUSER.'"/></td></tr>'."\n";
	}

	echo '</table>';
	echo '</form>';
	echo '<form action="#" method="post">'."\n";
	echo '<input type="button" value="'._CANCEL.'" onclick=".history.go(-1)" />'."\n";
	echo '</form></div>'."\n";
	CloseTable();
	include('footer.php');
}
?>