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
	header('Location: ../../../index.php');
	die ();
}
if (($radminsuper==1) OR ($radminuser==1)) {
	$pagetitle = ': '._USERADMIN.' - '._DETUSER;
	include_once 'header.php';
	$chng_uid = intval($chng_uid); // waraxe - Reflected XSS
	title(_USERADMIN.' - '._DETUSER.': <span class="italic">'.$chng_uid.'</span>');
	amain();
	echo '<br />'."\n";
	$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_temp WHERE user_id=\''.$chng_uid.'\'');
	if($db->sql_numrows($result) > 0) {
		$chnginfo = $db->sql_fetchrow($result);
		OpenTable();
		echo '<div class="text-left"><table border="0">'."\n";
		echo '<tr><td>'._USERID.':</td><td><span class="thick"><input type="text" value="'.$chnginfo['user_id'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></span></td></tr>'."\n";
		echo '<tr><td>'._NICKNAME.':</td><td><span class="thick"><input type="text" value="'.$chnginfo['username'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></span></td></tr>'."\n";
		echo '<tr><td>'._UREALNAME.':</td><td><span class="thick"><input type="text" value="'.$chnginfo['name'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></span></td></tr>'."\n";
		echo '<tr><td>'._EMAIL.':</td><td><span class="thick"><a href="mailto:'.$chnginfo['user_email'].'"><input type="text" value="'.$chnginfo['user_email'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></a></span></td></tr>'."\n";
		if ($ya_config['usefakeemail'] > '1') echo '<tr><td>' . _UFAKEMAIL . ':</td><td><b><input type="text" value="'.$chnginfo['femail'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";

		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields WHERE need <> \'0\' ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			$t = $sqlvalue['fid'];
			$result1 = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_temp_field_values WHERE uid=\''.$chng_uid.'\' AND fid=\''.$t.'\'');
			while ($tmpsqlvalue = $db->sql_fetchrow($result1)) {
				$tmp_value=$tmpsqlvalue['value'];
				$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
				echo '<tr><td>'.$name_exit.'</td><td><span class="thick"><input type="text" value="'.$tmp_value.'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></span></td></tr>'."\n";
			}
		}
		if ($ya_config['usewebsite'] > '1') echo '<tr><td>' . _YOURHOMEPAGE . ':</td><td><b><input type="text" value="'.$chnginfo['user_website'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useinstantmessaim'] > '1') echo '<tr><td>' . _YAIM . ':</td><td><b><input type="text" value="'.$chnginfo['user_aim'].'" name="user_aim" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useinstantmessicq'] > '1') echo '<tr><td>' . _YICQ . ':</td><td><b><input type="text" value="'.$chnginfo['user_icq'].'" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useinstantmessmsn'] > '1') echo '<tr><td>' . _YMSNM . ':</td><td><b><input type="text" value="'.$chnginfo['user_msnm'].'" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useinstantmessyim'] > '1') echo '<tr><td>' . _YYIM . ':</td><td><b><input type="text" value="'.$chnginfo['user_yim'].'" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['uselocation'] > '1') echo '<tr><td>' . _YLOCATION . ':</td><td><b><input type="text" value="'.$chnginfo['user_from'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useoccupation'] > '1') echo '<tr><td>' . _YOCCUPATION . ':</td><td><b><input type="text" value="'.$chnginfo['user_occ'].'" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($ya_config['useinterests'] > '1') echo '<tr><td>' . _YINTERESTS . ':</td><td><b><input type="text" value="'.$chnginfo['user_interests'].'" size="30" disabled="disabled" style="color=#000000;background-color: #ffffff" /></b></td></tr>'."\n";
		if ($chnginfo['newsletter'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
		if ($ya_config['usenewsletter'] > '1') echo '<tr><td>' . _RECEIVENEWSLETTER . ':</td><td style="color=#000000;background-color: #ffffff"><b>' . $cnl . '</b></td></tr>'."\n";
		if ($chnginfo['user_viewemail'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
		if ($ya_config['useviewemail'] > '1') echo '<tr><td>' . _ALWAYSSHOWEMAIL . ':</td><td style="color=#000000;background-color: #ffffff"><b>' . $cnl . '</b></td></tr>'."\n";
		if ($chnginfo['user_allow_viewonline'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
		if ($ya_config['usehideonline'] > '1') echo '<tr><td>' . _HIDEONLINE . ':</td><td style="color=#000000;background-color: #ffffff"><b>' . $cnl . '</b></td></tr>'."\n";

		if ($ya_config['usesignature'] > '1') {
			$signature = str_replace("\r\n", "<br />", $chnginfo['user_sig']);
			if (!empty($signature)) {
				$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path"');
				while ($rowbc = $db->sql_fetchrow($resultbc)) {
					$board_config[$rowbc['config_name']] = $rowbc['config_value'];
				}
				define('IN_PHPBB', TRUE);
				include_once('./modules/Forums/includes/constants.php');
				include_once('./modules/Forums/includes/bbcode.php');
				include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');
				if ( !$board_config['allow_html'] ) $signature = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $signature);
				if ($chnginfo['user_sig_bbcode_uid'] != '') $signature = ($board_config['allow_bbcode']) ? parse_bbcode($signature, $chnginfo['user_sig_bbcode_uid']) : preg_replace("/\:".$chnginfo['user_sig_bbcode_uid']."/si", '', $signature);
				$signature = make_clickable($signature);
				if ($board_config['allow_smilies']) $signature = smilies_pass($signature);
				$signature = str_replace("\n", "\n<br />\n", $signature);
			}
			echo '<tr><td>' . _SIGNATURE . ':</td><td><b><textarea disabled="disabled" style="color=#000000;background-color: #ffffff" cols="50" rows="5">'.$signature.'</textarea></b></td></tr>'."\n";
		}
		if ($ya_config['useextrainfo'] > '1') echo '<tr><td>' . _EXTRAINFO . ':</td><td><b><textarea disabled="disabled" style="color=#000000;background-color: #ffffff" cols="50" rows="5">'.$chnginfo['bio'].'</textarea></b></td></tr>'."\n";
		echo '<tr><td>'._REGDATE.':</td><td><input type="text" value="'.$chnginfo['user_regdate'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>'."\n";
		$chnginfo['time'] = date("D M j H:i T Y", $chnginfo['time']);
		echo '<tr><td>'._YA_APPROVE2.':</td><td><input type="text" value="'.$chnginfo['time'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /> </td></tr>'."\n";
		echo '<tr><td>'._CHECKNUM.':</td><td><input type="text" value="'.$chnginfo['check_num'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>';"\n";
		echo '<tr><td colspan="2" align="left"><br />'."\n";
		echo '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';"\n";
		echo '<form action="#" method="post">';"\n";
#		echo '<form action="'.$admin_file.'.php" method="post">';
#		if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#		if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
#		echo "<input type='submit' value='"._RETURN."' /></form></td>\n";
		echo '<input type="button" value="'._RETURN.'" onclick="history.go(-1)" /></form></td>'."\n";
		echo '<td width="3">&nbsp;</td>'."\n";
		echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
		if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
		if (isset($xop)) { echo '<input type="hidden" name="op" value="'.$xop.'" />'."\n"; }
		echo '<input type="hidden" name="op" value="yaModifyTemp" />'."\n";
		echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />'."\n";
		echo '<input type="submit" value="'._MODIFY.'" /></form></td>'."\n";
		echo '<td width="3"></td>'."\n";
		echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
		if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
		if (isset($xop)) { echo '<input type="hidden" name="op" value="'.$xop.'" />'."\n"; }
		echo '<input type="hidden" name="op" value="yaDenyUser" />'."\n";
		echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />'."\n";
		echo '<input type="submit" value="'._DENY.'" /></form></td>'."\n";
		echo '<td width="3"></td>'."\n";
		if ($ya_config['useactivate'] == 1) {
			echo '<td valign="top"><form action="'.$admin_file.'.php" method="post">'."\n";
			if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
			if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
			echo '<input type="hidden" name="op" value="yaApproveUserConf" />'."\n";
			echo '<input type="hidden" name="apr_uid" value="'.$chnginfo['user_id'].'" />'."\n";
			echo '<input type="submit" value="'._YA_APPROVE.'" /></form></td>'."\n";
		 } else {
			echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
			if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
			if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
			echo '<input type="hidden" name="op" value="yaActivateUser" />'."\n";
			echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'" />'."\n";
			echo '<input type="submit" value="'._YA_ACTIVATE.'"></form></td>'."\n";
		}
		echo '</tr></table>'."\n";

		echo '</td></tr><tr><td colspan="2"><span class="thick">'._NOTE.'</span>'."\n";
		echo '</td></tr><tr><td colspan="2"><span class="thick">'._YA_APPROVENOTE.'</span>'."\n";
		echo '</td></tr><tr><td colspan="2"><span class="thick">'._YA_ACTIVATENOTE.'</span>'."\n";
		echo '</td></tr></table></div>'."\n";
		echo '<br />'."\n";
		CloseTable();
	} else {
		OpenTable();
		echo '<div class="text-center thick">'._USERNOEXIST.'</div>'."\n";
		CloseTable();
	}
include_once 'footer.php';
}
?>