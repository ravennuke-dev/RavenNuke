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
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
getusrinfo($user);
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once('header.php');
	OpenTable();
	echo '<div class="text-center"><span class="title thick">' , _COMMENTSCONFIG , '</span></div>' , "\n";
	CloseTable();
	echo '<br />';
	OpenTable();
	nav();
	CloseTable();
	echo '<br />'."\n";
	OpenTable();
	echo '<form action="modules.php?name='.$module_name.'" method="post">'."\n"
		.'<table cellpadding="8" border="0"><tr><td>'."\n"
		.'<span class="thick">'._DISPLAYMODE.'</span>'."\n"
		.'<select name="umode">';
	echo	'<option value="nocomments" '; if ($userinfo['umode'] == 'nocomments') { echo 'selected="selected"'; } echo '>'._NOCOMMENTS.'</option>';
	echo	'<option value="nested" '; if ($userinfo['umode'] == 'nested') { echo 'selected="selected"'; } echo '>'._NESTED.'</option>';
	echo	'<option value="flat" '; if ($userinfo['umode'] == 'flat') { echo 'selected="selected"'; } echo '>'._FLAT.'</option>';
	echo 	'<option value="thread" '; if (!isset($userinfo['umode']) || (empty($userinfo['umode'])) || $userinfo['umode']=='thread') { echo 'selected="selected"'; } echo '>'._THREAD.'</option>';
	echo '</select>'."\n"
		.'<br /><br />'
		.'<span class="thick">'._SORTORDER.'</span>'."\n"
		.'<select name="uorder">';
	echo	'<option value="0" '; if (!$userinfo['uorder']) { echo 'selected="selected"'; } echo '>'._OLDEST.'</option>';
	echo	'<option value="1" '; if ($userinfo['uorder']==1) { echo 'selected="selected"'; } echo '>'._NEWEST.'</option>';
	echo	'<option value="2" '; if ($userinfo['uorder']==2) { echo 'selected="selected"'; } echo '>'._HIGHEST.'</option>';
	echo '</select>'."\n"
		.'<br /><br />'
		.'<span class="thick">'._THRESHOLD.'</span>'."\n"
		._COMMENTSWILLIGNORED.'<br />'."\n"
		.'<select name="thold">';
	echo	'<option value="-1" '; if ($userinfo['thold']==-1) { echo 'selected="selected"'; } echo '>-1: '._UNCUT.'</option>';
	echo	'<option value="0" '; if ($userinfo['thold']==0) { echo 'selected="selected"'; } echo '>0: '._EVERYTHING.'</option>';
	echo	'<option value="1" '; if ($userinfo['thold']==1) { echo 'selected="selected"'; } echo '>1: '._FILTERMOSTANON.'</option>';
	echo	'<option value="2" '; if ($userinfo['thold']==2) { echo 'selected="selected"'; } echo '>2: '._USCORE.' +2</option>';
	echo	'<option value="3" '; if ($userinfo['thold']==3) { echo 'selected="selected"'; } echo '>3: '._USCORE.' +3</option>';
	echo	'<option value="4" '; if ($userinfo['thold']==4) { echo 'selected="selected"'; } echo '>4: '._USCORE.' +4</option>';
	echo	'<option value="5" '; if ($userinfo['thold']==5) { echo 'selected="selected"'; } echo '>5: '._USCORE.' +5</option>';
	echo '</select><br />'."\n"
		.'<span class="italic">'._SCORENOTE.'</span>'
		.'<br /><br />'."\n";
	echo '<input type="checkbox" name="noscore" '; if ($userinfo['noscore']==1) { echo 'checked="checked"'; } echo '/><span class="thick"> '._NOSCORES.'</span> '._HIDDESCORES
		.'<br /><br />'."\n";
	echo '<span class="thick">'._MAXCOMMENT.'</span> '._TRUNCATES.'<br />'."\n";
	echo '<input type="text" name="commentmax" value="'.intval($userinfo['commentmax']).'" size="11" maxlength="11" /> '._BYTESNOTE
		.'<br /><br />'."\n";
	echo '<input type="hidden" name="username" value="'.$userinfo['username'].'" />'."\n";
	echo '<input type="hidden" name="user_id" value="'.intval($userinfo['user_id']).'" />'."\n";
	echo '<input type="hidden" name="op" value="savecomm" />'."\n";
	echo '<input type="submit" value="'._SAVECHANGES.'" />'."\n";
	echo '</td></tr></table>'."\n";
	echo '</form>'."\n";
	CloseTable();
	echo '<br /><br />'."\n";
	include_once 'footer.php';
} else {
	mmain($user);
}
?>