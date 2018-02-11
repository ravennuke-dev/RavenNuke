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
if (!defined('YA_ADMIN')){
	header('Location: ../../../index.php');
	die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	if(!isset($ya_config['userealname'])) $ya_config['userealname'] = '3';
	OpenTable();
	echo '<form class="cmxform" action="'.$admin_file.'.php" method="post">';
	echo '<table border="0">';
	echo '<tr><td>'._NICKNAME.': * </td><td><input type="text" name="add_uname" size="30" maxlength="'.$ya_config['nick_max'].'" /></td></tr>';
	if ($ya_config['userealname']>1) {
		echo '<tr><td>'._UREALNAME.':';
		if ($ya_config['userealname']==3 or $ya_config['userealname'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_name" size="30" maxlength="50" /></td></tr>';
	}
	echo '<tr><td>'._EMAIL.': * </td><td><input type="text" name="add_email" size="30" maxlength="60" /></td></tr>';
	echo '<tr><td>'._RETYPEEMAIL.': * </td><td><input type="text" name="add_email2" size="30" maxlength="60" /></td></tr>';
	if ($ya_config['usefakeemail'] >= '1') {
		echo '<tr><td>'._FAKEEMAIL.':';
		if ($ya_config['usefakeemail']==3 or $ya_config['usefakeemail'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_femail" size="30" maxlength="60" /></td></tr>';
	}
	if ($ya_config['usewebsite'] >= '1') {
		echo '<tr><td>'._URL.':';
		if ($ya_config['usewebsite']==3 or $ya_config['usewebsite'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_url" size="30" maxlength="60" /></td></tr>';
	}
	$ya_CustomFields = ya_GetCustomRegFieldsAdmin();
	echo $ya_CustomFields['HTML'];
	if ($ya_config['useinstantmessaim'] >= '1') {
		echo '<tr><td>'._AIM.':';
		if ($ya_config['useinstantmessaim']==3 or $ya_config['useinstantmessaim'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_aim" size="20" maxlength="20" /></td></tr>';
	}
	if ($ya_config['useinstantmessicq'] >= '1') {
		echo '<tr><td>'._ICQ.':';
		if ($ya_config['useinstantmessicq']==3 or $ya_config['useinstantmessicq'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_icq" size="20" maxlength="20" /></td></tr>';
	}
	if ($ya_config['useinstantmessmsn'] >= '1') {
		echo '<tr><td>'._MSNM.':';
		if ($ya_config['useinstantmessmsn']==3 or $ya_config['useinstantmessmsn'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_msnm" size="20" maxlength="20" /></td></tr>';
	}
	if ($ya_config['useinstantmessyim'] >= '1') {
		echo '<tr><td>'._YIM.':';
		if ($ya_config['useinstantmessyim']==3 or $ya_config['useinstantmessyim'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_yim" size="20" maxlength="20" /></td></tr>';
	}
	if ($ya_config['uselocation'] >= '1') {
		echo '<tr><td>'._LOCATION.':';
		if ($ya_config['uselocation']==3 or $ya_config['uselocation'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_from" size="25" maxlength="60" /></td></tr>';
	}
	if ($ya_config['useoccupation'] >= '1') {
		echo '<tr><td>'._OCCUPATION.':';
		if ($ya_config['useoccupation']==3 or $ya_config['useoccupation'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_occ" size="25" maxlength="60" /></td></tr>';
	}
	if ($ya_config['useinterests'] >= '1') {
		echo '<tr><td>'._INTERESTS.':';
		if ($ya_config['useinterests']==3 or $ya_config['useinterests'] == 5) echo ' *';
		echo ' </td><td><input type="text" name="add_user_interest" size="25" maxlength="255" /></td></tr>';
	}
	if ($ya_config['usenewsletter'] >= '1') {
		echo '<tr><td>'._NEWSLETTER.':';
		if ($ya_config['usenewsletter']==3 or $ya_config['usenewsletter'] == 5) echo ' *';
		echo ' </td><td><input type="radio" name="add_newsletter" value="1" checked="checked" /> '._YES.' <input type="radio" name="add_newsletter" value="0" /> '._NO.'</td></tr>';
	}
	if ($ya_config['useviewemail'] >= '1') {
		echo '<tr><td>' . _ALLOWUSERS . ':';
		if ($ya_config['useviewemail']==3 or $ya_config['useviewemail'] == 5) echo ' *';
		echo ' </td><td><input type="radio" name="add_user_viewemail" value="1" /> '._YES.' <input type="radio" name="add_user_viewemail" value="0" checked="checked" /> '._NO.'</td></tr>';
	}
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td valign="top">'._SIGNATURE.':';
		if ($ya_config['usesignature']==3 or $ya_config['usesignature'] == 5) echo ' *';
		echo ' </td><td><textarea name="add_user_sig" rows="6" cols="45"></textarea></td></tr>';
	}
	if ($ya_config['usepoints'] >= '1' ) echo '<tr><td>'._YA_POINTS.': </td><td><input type="text" name="add_points" value="0" /></td></tr>';
	echo '<tr><td>'._PASSWORD.': * </td><td><input type="text" name="add_pass" size="12" maxlength="'.$ya_config['pass_max'].'" /></td></tr>';
	echo '<tr><td>'._RETYPEPASSWORD.': * </td><td><input type="text" name="add_pass2" size="12" maxlength="'.$ya_config['pass_max'].'" /></td></tr>';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="'._ADDUSERBUT.'" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="add_avatar" value="gallery/blank.gif" />';
	echo '<input type="hidden" name="op" value="yaAddUserConf" />';
	if (isset($min)) echo '<input type="hidden" name="min" value="'.$min.'" />';
	if (isset($xop)) echo '<input type="hidden" name="xop" value="'.$xop.'" />';
	echo csrf_rn_token('input');
	echo '</form>';
	echo '<form action="#" method="post">';
	echo '<input type="button" value="'._CANCEL.'" onclick="history.go(-1)" />';
	echo '</form>';
	CloseTable();
}

?>