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
	echo '<br />';
	$sql = 'SELECT * FROM '.$user_prefix.'_users WHERE user_id=\''.$chng_uid.'\'';
	if ($db->sql_numrows($db->sql_query($sql)) > 0) {
		$chnginfo = $db->sql_fetchrow($db->sql_query($sql));
		OpenTable();
		echo '<div class="text-left"><table border="0">';
		echo '<tr><td>' . _USERID . ':</td><td><span class="thick">'.$chnginfo['user_id'].'&nbsp;</span></td></tr>';
		echo '<tr><td>' . _NICKNAME . ':</td><td><span class="thick">'.$chnginfo['username'].'&nbsp;</span></td></tr>';
		if ($ya_config['userealname'] >= '1') echo '<tr><td>'._UREALNAME.':</td><td><span class="thick">'.$chnginfo['name'].'&nbsp;</span></td></tr>';
		echo '<tr><td>' . _EMAIL . ':</td><td><span class="thick"><a href="mailto:'.$chnginfo['user_email'].'">'.$chnginfo['user_email'].'</a></span></td></tr>';
		if ($ya_config['usefakeemail'] >= '1') echo '<tr><td>' . _FAKEEMAIL . ':</td><td><span class="thick">'.$chnginfo['femail'].'&nbsp;</span></td></tr>';
		$chnginfo['user_website'] = strtolower($chnginfo['user_website']);
		$chnginfo['user_website'] = str_replace('http://', '', $chnginfo['user_website']);
		if ($chnginfo['user_website'] == '') $userwebsite = _YA_NA;
		else $userwebsite = '<a href="http://'.$chnginfo['user_website'].'" target="_blank">'.$chnginfo['user_website'].'</a>';
		if ($ya_config['usewebsite'] >= '1') echo '<tr><td>'._WEBSITE.'</td><td><span class="thick">'.$userwebsite.'&nbsp;</span></td></tr>';
		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
			$t = (int)$sqlvalue['fid'];
			list($value) = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_field_values WHERE fid =\'' . $t . '\' AND uid = \'' . $chnginfo['user_id'] . '\''));
			echo '<tr><td>'.$name_exit.'</td><td><span class="thick">'.htmlspecialchars($value, ENT_QUOTES, _CHARSET).'&nbsp;</span></td></tr>';
		}
		if ($ya_config['useinstantmessaim'] >= '1') echo '<tr><td>'._AIM.':</td><td><span class="thick">'.$chnginfo['user_aim'].'&nbsp;</span></td></tr>';
		if ($ya_config['useinstantmessicq'] >= '1') echo '<tr><td>'._ICQ.':</td><td><span class="thick">'.$chnginfo['user_icq'].'&nbsp;</span></td></tr>';
		if ($ya_config['useinstantmessmsn'] >= '1') echo '<tr><td>'._MSNM.':</td><td><span class="thick">'.$chnginfo['user_msnm'].'&nbsp;</span></td></tr>';
		if ($ya_config['useinstantmessyim'] >= '1') echo '<tr><td>'._YIM.':</td><td><span class="thick">'.$chnginfo['user_yim'].'&nbsp;</span></td></tr>';
		if ($ya_config['uselocation'] >= '1') echo '<tr><td>'._LOCATION.':</td><td><span class="thick">'.$chnginfo['user_from'].'&nbsp;</span></td></tr>';
		if ($ya_config['useoccupation'] >= '1') echo '<tr><td>'._OCCUPATION.':</td><td><span class="thick">'.$chnginfo['user_occ'].'&nbsp;</span></td></tr>';
		if ($ya_config['useinterests'] >= '1') echo '<tr><td>'._INTERESTS.':</td><td><span class="thick">'.$chnginfo['user_interests'].'&nbsp;</span></td></tr>';
		if ($ya_config['usenewsletter'] >= '1') {
			if ($chnginfo['newsletter'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
			echo '<tr><td>'._NEWSLETTER.':</td><td><span class="thick">'.$cnl.'</span></td></tr>';
		}
		if ($ya_config['useviewemail'] >= '1') {
			if ($chnginfo['user_viewemail'] ==1) { $cuv = _YES; } else { $cuv = _NO; }
			echo '<tr><td>'._SHOWMAIL.':</td><td><span class="thick">'.$cuv.'</span></td></tr>';
		}
		if ($chnginfo['user_allow_viewonline'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
		if ($ya_config['usehideonline'] > '1') echo '<tr><td>' . _HIDEONLINE . ':</td><td><span class="thick">' . $cnl . '</span></td></tr>'."\n";
		$signature = str_replace("\r\n", "<br />", $chnginfo['user_sig']);
		$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path"');
		while ($rowbc = $db->sql_fetchrow($resultbc)) {
			$board_config[$rowbc['config_name']] = $rowbc['config_value'];
		}
		define('IN_PHPBB', TRUE);
		include_once('./modules/Forums/includes/constants.php');
		include_once('./modules/Forums/includes/bbcode.php');
		include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');

		if ($signature != '') {
			if ( !$board_config['allow_html'] ) {
				$signature = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $signature);
			}

			if ($chnginfo['user_sig_bbcode_uid'] != '') {
				$signature = ($board_config['allow_bbcode']) ? parse_bbcode($signature, $chnginfo['user_sig_bbcode_uid']) : preg_replace("/\:".$chnginfo['user_sig_bbcode_uid']."/si", '', $signature);
			}

			$signature = make_clickable($signature);

			if ($board_config['allow_smilies']) {
				$signature = smilies_pass($signature);
			}

			$signature = str_replace("\n", "\n<br />\n", $signature);
		}
		// End
		if ($ya_config['usesignature'] >= '1') echo '<tr><td valign="top">'._SIGNATURE.':</td><td>'.$signature.'&nbsp;</td></tr>';
		if ($ya_config['useextrainfo'] >= '1') echo '<tr><td>'._EXTRAINFO.'</td><td><span class="thick">'.$chnginfo['bio'].'&nbsp;</span></td></tr>';
		if ($ya_config['usepoints'] >= '1' ) echo '<tr><td>'._YA_POINTS.'</td><td><span class="thick">'.$chnginfo['points'].'&nbsp;</span></td></tr>';
		echo '<tr><td>'._REGDATE.':</td><td><span class="thick">'.$chnginfo['user_regdate'].'&nbsp;</span></td></tr>';
		$chnginfo['lastsitevisit'] = date("d F Y H:i", $chnginfo['lastsitevisit']);
		echo '<tr><td>'._YA_LASTVISIT.'</td><td><span class="thick">'.$chnginfo['lastsitevisit'].'</span></td></tr>';
		$sql2 = 'SELECT uname FROM '.$prefix.'_session WHERE uname=\''.$chnginfo['username'].'\'';
		$result2 = $db->sql_query($sql2);
		$row2 = $db->sql_fetchrow($result2);
		$username_pm = $chnginfo['username'];
		$active_username = $row2['uname'];
		if ($active_username == '') $online = _OFFLINE;
		else $online = _ONLINE;
		echo '<tr><td>'._USERSTATUS.'</td><td><span class="thick">'.$online.'</span></td></tr>';
		echo '</table></div>';
		echo '<form action="'.$admin_file.'.php" method="post">';
		if (isset($min)) echo '<input type="hidden" name="min" value="'.$min.'" />';
		if (isset($xop)) echo '<input type="hidden" name="op" value="'.$xop.'" />';
		echo '<input type="hidden" name="op" value="modifyUser" />';
		echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />';
		echo '<div class="text-center"><input type="submit" value="'._MODIFY.'" /></div>';
		echo '</form>';
		echo '<form action="#" method="post">';
		echo '<div class="text-center"><input type="button" value="'._RETURN.'" onclick="history.go(-1)" /></div>';
		echo '</form>';
		CloseTable();
	} else {
		OpenTable();
		echo '<div class="text-center thick">'._USERNOEXIST.'</div>';
		CloseTable();
	}
	include_once 'footer.php';
}
?>