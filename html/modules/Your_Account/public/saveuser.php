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
if (!isset($stop)) $stop = ''; // montego - $stop message fix - will allow us to add validation and stop the update process
$user_id = intval($user_id);
$check = $cookie[1];
$check2 = $cookie[2];
$result = $db->sql_query('SELECT user_id, user_password, user_email FROM ' . $user_prefix . '_users WHERE username=\'' . $check . '\'');
$row = $db->sql_fetchrow($result);
$vuid = intval($row['user_id']);
$ccpass = $row['user_password'];
if (($user_id == $vuid) AND ($check2 == $ccpass)) {
	if ($ya_config['userealname'] == '0') $realname = '';
	if ($ya_config['usefakeemail'] == '0') $femail = '';
	if ($ya_config['usewebsite'] == '0') $user_website = '';
	if ($ya_config['useinstantmessaim'] == '0') $user_aim = '';
	if ($ya_config['useinstantmessicq'] == '0') $user_icq = '';
	if ($ya_config['useinstantmessmsn'] == '0') $user_msnm = '';
	if ($ya_config['useinstantmessyim'] == '0') $user_yim = '';
	if ($ya_config['uselocation'] == '0') $user_from = '';
	if ($ya_config['useoccupation'] == '0') $user_occ = '';
	if ($ya_config['useinterests'] == '0') $user_interests = '';
	if ($ya_config['usenewsletter'] == '0') $newsletter = '0';
	if ($ya_config['useviewemail'] == '0') $user_viewemail = '0';
	if ($ya_config['usehideonline'] == '0') $user_allow_viewonline = '1';
	if ($ya_config['usesignature'] == '0') $user_sig = '';
	if ($ya_config['usesignature'] == '0') $user_attachsig = '0';
	if ($ya_config['useextrainfo'] == '0') $bio = '';
	$tuemail = strtolower($row['user_email']);
	// Start - Added to allow bbcode encoding to remain upon saving user  - RN v2.40.00
	$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_html_tags" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path" OR config_name = "rand_seed"');
	while ($rowbc = $db->sql_fetchrow($resultbc)) {
		$board_config[$rowbc['config_name']] = $rowbc['config_value'];
	}
	define('IN_PHPBB', TRUE);
	include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');
	include_once('./modules/Forums/includes/bbcode.php');
	include_once('./modules/Forums/includes/functions_post.php');
	$user_sig_bbcode_uid = make_bbcode_uid();
	$user_sig = prepare_message($user_sig, $board_config['allow_html'], $board_config['allow_bbcode'], $board_config['allow_smilies'], $user_sig_bbcode_uid);
	// End
	$user_sig = addslashes(check_html($user_sig, ''));
	$user_email = strtolower(check_html($user_email, 'nohtml'));
	$femail = addslashes(check_html($femail, 'nohtml'));
	$user_website = check_html($user_website, 'nohtml');
	$user_website_tmp = $user_website; // RN v2.30.01
	if (!empty($user_website)) {
		if (!preg_match('#^http[s]?:\/\/#i', $user_website)) {
			$user_website = 'http://' . $user_website;
			$user_website_tmp = $user_website;
		}
	}
	if (!empty($user_website_tmp)) { // RN v2.30.01
		$tmpWebSitePart = explode('/', $user_website_tmp); // RN v2.30.01
		if ($tmpWebSitePart[2]=='localhost') $user_website=$user_website_tmp; // RN v2.30.01
	} // RN v2.30.01
	$user_website = addslashes($user_website);
	$bio = addslashes(check_words(check_html($bio, 'nohtml')));
	if (function_exists('ctype_digit')) $user_icq = ctype_digit($user_icq)?$user_icq:'';
	else {
		if (preg_match('/^[0-9]+$/', $user_icq)) $user_icq = intval($user_icq);
		else { $user_icq = ''; }
	} // fix by Raven to stop  '0' being stored in DB if field is empty
	$user_aim = addslashes(check_html($user_aim, 'nohtml'));
	$user_yim = addslashes(check_html($user_yim, 'nohtml'));
	$user_msnm = addslashes(check_html($user_msnm, 'nohtml'));
	$user_occ = addslashes(check_html($user_occ, 'nohtml'));
	$user_from = addslashes(check_html($user_from, 'nohtml'));
	$user_interests = addslashes(check_html($user_interests, 'nohtml'));
	$realname = addslashes(check_html($realname, 'nohtml'));
	//$user_avatar = check_html($user_avatar, 'nohtml');
	$user_dateformat = addslashes(check_html($user_dateformat, 'nohtml'));
	$newsletter = intval($newsletter);
	$user_viewemail = intval($user_viewemail);
	$user_allow_viewonline = intval($user_allow_viewonline);
	$user_lang = addslashes(check_html($user_lang, 'nohtml'));
	$user_timezone = intval($user_timezone);
	if ($ya_config['allowmailchange'] == 1) {
		if ($tuemail != $user_email) {
			ya_mailCheck($user_email); // montego - this function will set the global $stop variable with an error message if there is an error
		}
	}
	if ($user_password > '' OR $vpass > '') {
		ya_passCheck($user_password, $vpass); // montego - same comment as immediately above
	}
	if ($realname == '' && ($ya_config['userealname'] == 3 or $ya_config['userealname'] == '5')) $stop .= _YA_NOREALNAME . '<br />';
	if ($femail == '' && ($ya_config['usefakeemail'] == '3' or $ya_config['usefakeemail'] == '5')) $stop .= _UFAKEMAIL . ' ' . _REQUIRED . '<br />';
	if (!empty($user_website) && !preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $user_website)) $stop .= _ERRORHOMEPAGE.'<br />';
	if ($user_website == '' && ($ya_config['usewebsite'] == '3' or $ya_config['usewebsite'] == '5')) $stop .= _YOURHOMEPAGE . ' ' . _REQUIRED . '<br />';
	if ($user_aim == '' && ($ya_config['useinstantmessaim'] == '3' or $ya_config['useinstantmessaim'] == '5')) $stop .= _YAIM . ' ' . _REQUIRED . '<br />';
	if ($user_icq == '' && ($ya_config['useinstantmessicq'] == '3' or $ya_config['useinstantmessicq'] == '5')) $stop .= _YICQ . ' ' . _REQUIRED . '<br />';
	if ($user_msnm == '' && ($ya_config['useinstantmessmsn'] == '3' or $ya_config['useinstantmessmsn'] == '5')) $stop .= _YMSNM . ' ' . _REQUIRED . '<br />';
	if ($user_yim == '' && ($ya_config['useinstantmessyim'] == '3' or $ya_config['useinstantmessyim'] == '5')) $stop .= _YYIM . ' ' . _REQUIRED . '<br />';
	if ($user_from == '' && ($ya_config['uselocation'] == '3' or $ya_config['uselocation'] == '5')) $stop .= _YLOCATION . ' ' . _REQUIRED . '<br />';
	if ($user_occ == '' && ($ya_config['useoccupation'] == '3' or $ya_config['useoccupation'] == '5')) $stop .= _YOCCUPATION . ' ' . _REQUIRED . '<br />';
	if ($user_interests == '' && ($ya_config['useinterests'] == '3' or $ya_config['useinterests'] == '5')) $stop .= _YINTERESTS . ' ' . _REQUIRED . '<br />';
	if ($newsletter == '' && ($ya_config['usenewsletter'] == '3' or $ya_config['usenewsletter'] == '5')) $stop .= _RECEIVENEWSLETTER . ' ' . _REQUIRED . '<br />';
	if ($user_viewemail == '' && ($ya_config['useviewemail'] == '3' or $ya_config['useviewemail'] == '5')) $stop .= _ALWAYSSHOWEMAIL . ' ' . _REQUIRED . '<br />';
	if ($user_allow_viewonline == '' && ($ya_config['usehideonline'] == '3' or $ya_config['usehideonline'] == '5')) $stop .= _HIDEONLINE . ' ' . _REQUIRED . '<br />';
	if ($user_sig == '' && ($ya_config['usesignature'] == '3' or $ya_config['usesignature'] == '5')) $stop .= _SIGNATURE . ' ' . _REQUIRED . '<br />';
	if ($bio == '' && ($ya_config['useextrainfo'] == '3' or $ya_config['useextrainfo'] == '5')) $stop .= _EXTRAINFO . ' ' . _REQUIRED . '<br />';

	if (!isset($nfield) || !is_array($nfield)) $nfield = array();
	if ($stop == '') {
		$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need = \'3\' ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			$t = (int)$sqlvalue['fid'];
			if (!isset($nfield[$t]) || $nfield[$t] == '') {
				include_once 'header.php';
				opentable();
				$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
				echo '<p class="content" align="center"><span class="title thick">' . _ERRORREG . '</span><br /><br />';
				echo _YA_FILEDNEED1 . $name_exit . _YA_FILEDNEED2 . '<br /><br />' . _GOBACK . '</p>';
				closetable();
				include_once 'footer.php';
				die();
			};
		}
		if ($user_password != '') {
			cookiedecode($user);
			$db->sql_query('LOCK TABLES ' . $user_prefix . '_users WRITE, ' . $user_prefix . '_users_field_values WRITE');
			$user_password = md5($user_password);
			if (($ya_config['emailvalidate'] == '0') OR ($tuemail == $user_email)) {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET name=\'' . $realname . '\', user_email=\'' . $user_email . '\', femail=\'' . $femail . '\', user_website=\'' . $user_website . '\', user_password=\'' . $user_password . '\', bio=\'' . $bio . '\', user_icq=\'' . $user_icq . '\', user_occ=\'' . $user_occ . '\', user_from=\'' . $user_from . '\', user_interests=\'' . $user_interests . '\', user_sig=\'' . $user_sig . '\', user_sig_bbcode_uid=\'' . $user_sig_bbcode_uid . '\', user_aim=\'' . $user_aim . '\', user_yim=\'' . $user_yim . '\', user_msnm=\'' . $user_msnm . '\', newsletter=\'' . $newsletter . '\', user_viewemail=\'' . $user_viewemail . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', user_attachsig=\'' . $user_attachsig . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowhtml=\'' . $user_allowhtml . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_lang=\'' . $user_lang . '\', user_timezone=\'' . $user_timezone . '\', user_dateformat=\'' . $user_dateformat . '\' WHERE user_id=\'' . $user_id . '\'');
			} else {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET name=\'' . $realname . '\', femail=\'' . $femail . '\', user_website=\'' . $user_website . '\', user_password=\'' . $user_password . '\', bio=\'' . $bio . '\', user_icq=\'' . $user_icq . '\', user_occ=\'' . $user_occ . '\', user_from=\'' . $user_from . '\', user_interests=\'' . $user_interests . '\', user_sig=\'' . $user_sig . '\', user_sig_bbcode_uid=\'' . $user_sig_bbcode_uid . '\', user_aim=\'' . $user_aim . '\', user_yim=\'' . $user_yim . '\', user_msnm=\'' . $user_msnm . '\', newsletter=\'' . $newsletter . '\', user_viewemail=\'' . $user_viewemail . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', user_attachsig=\'' . $user_attachsig . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowhtml=\'' . $user_allowhtml . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_lang=\'' . $user_lang . '\', user_timezone=\'' . $user_timezone . '\', user_dateformat=\'' . $user_dateformat . '\' WHERE user_id=\'' . $user_id . '\'');
				$datekey = date('F Y');
				$check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($user_email) * hexdec($tuemail)) , 2, 10);
				$finishlink = $nukeurl . '/modules.php?name=' . $module_name . '&op=changemail&id=' . $user_id . '&mail=' . $user_email . '&check_num=' . $check_num;
				$message = _CHANGEMAIL1 . ' ' . $tuemail . ' ' . _CHANGEMAIL2 . ' ' . $user_email . _CHANGEMAIL3 . ' ' . $sitename . "\r\n\r\n";
				$message .= _CHANGEMAILFIN . "\r\n\r\n" . $finishlink . "\r\n\r\n";
				$subject = _CHANGEMAILSUB;
				ya_mail($user_email, $subject, $message, '');
			}
			if (count($nfield) > 0) {
				foreach($nfield as $key => $var) {
					$nfield[$key] = addslashes(check_html($nfield[$key], 'nohtml'));
					if (($db->sql_numrows($db->sql_query('SELECT * FROM ' . $user_prefix . '_users_field_values WHERE fid=\'' . $key . '\' AND uid = \'' . $user_id . '\''))) == 0) {
						$sql = 'INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $user_id . '\', \'' . $key . '\',\'' . $nfield[$key] . '\')';
						$db->sql_query($sql);
					} else {
						$db->sql_query('UPDATE ' . $user_prefix . '_users_field_values SET value=\'' . $nfield[$key] . '\' WHERE fid=\'' . $key . '\' AND uid = \'' . $user_id . '\'');
					}
				}
			}
			$sql = 'SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . $username . '\' AND user_password=\'' . $user_password . '\'';
			$result = $db->sql_query($sql);
			if ($db->sql_numrows($result) == 1) {
				$userinfo = $db->sql_fetchrow($result);
				yacookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $userinfo['umode'], $userinfo['uorder'], $userinfo['thold'], $userinfo['noscore'], $userinfo['ublockon'], $userinfo['theme'], $userinfo['commentmax']);
			} else {
				echo '<div class="text-center">' . _SOMETHINGWRONG . '</div><br />';
			}
			$db->sql_query('UNLOCK TABLES');
		} else {
			$db->sql_query('LOCK TABLES ' . $user_prefix . '_users WRITE, ' . $user_prefix . '_users_field_values WRITE');
			if (($ya_config['emailvalidate'] == '0') OR ($tuemail == $user_email)) {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET name=\'' . $realname . '\', user_email=\'' . $user_email . '\', femail=\'' . $femail . '\', user_website=\'' . $user_website . '\', bio=\'' . $bio . '\', user_icq=\'' . $user_icq . '\', user_occ=\'' . $user_occ . '\', user_from=\'' . $user_from . '\', user_interests=\'' . $user_interests . '\', user_sig=\'' . $user_sig . '\', user_sig_bbcode_uid=\'' . $user_sig_bbcode_uid . '\', user_aim=\'' . $user_aim . '\', user_yim=\'' . $user_yim . '\', user_msnm=\'' . $user_msnm . '\', newsletter=\'' . $newsletter . '\', user_viewemail=\'' . $user_viewemail . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', user_attachsig=\'' . $user_attachsig . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowhtml=\'' . $user_allowhtml . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_lang=\'' . $user_lang . '\', user_timezone=\'' . $user_timezone . '\', user_dateformat=\'' . $user_dateformat . '\' WHERE user_id=\'' . $user_id . '\'');
			} else {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET name=\'' . $realname . '\', femail=\'' . $femail . '\', user_website=\'' . $user_website . '\', bio=\'' . $bio . '\', user_icq=\'' . $user_icq . '\', user_occ=\'' . $user_occ . '\', user_from=\'' . $user_from . '\', user_interests=\'' . $user_interests . '\', user_sig=\'' . $user_sig . '\', user_sig_bbcode_uid=\'' . $user_sig_bbcode_uid . '\', user_aim=\'' . $user_aim . '\', user_yim=\'' . $user_yim . '\', user_msnm=\'' . $user_msnm . '\', newsletter=\'' . $newsletter . '\', user_viewemail=\'' . $user_viewemail . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', user_attachsig=\'' . $user_attachsig . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowhtml=\'' . $user_allowhtml . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_lang=\'' . $user_lang . '\', user_timezone=\'' . $user_timezone . '\', user_dateformat=\'' . $user_dateformat . '\' WHERE user_id=\'' . $user_id . '\'');
				$datekey = date('F Y');
				$check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($user_email) * hexdec($tuemail)) , 2, 10);
				$finishlink = $nukeurl . '/modules.php?name=' . $module_name . '&op=changemail&id=' . $user_id . '&mail=' . $user_email . '&check_num=' . $check_num;
				$message = _CHANGEMAIL1 . ' ' . $tuemail . ' ' . _CHANGEMAIL2 . ' ' . $user_email . _CHANGEMAIL3 . ' ' . $sitename . "\r\n\r\n";
				$message .= _CHANGEMAILFIN . "\r\n\r\n" . $finishlink . "\r\n\r\n";
				$subject = _CHANGEMAILSUB;
				ya_mail($user_email, $subject, $message, '');
			}
			if (count($nfield) > 0) {
				foreach($nfield as $key => $var) {
					$nfield[$key] = addslashes(check_html($nfield[$key], 'nohtml'));
					if (($db->sql_numrows($db->sql_query('SELECT * FROM ' . $user_prefix . '_users_field_values WHERE fid=\'' . $key . '\' AND uid = \'' . $user_id . '\''))) == 0) {
						$sql = 'INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $user_id . '\', \'' . $key . '\',\'' . $nfield[$key] . '\')';
						$db->sql_query($sql);
					} else {
						$db->sql_query('UPDATE ' . $user_prefix . '_users_field_values SET value=\'' . $nfield[$key] . '\' WHERE fid=\'' . $key . '\' AND uid = \'' . $user_id . '\'');
					}
				}
			}
			$db->sql_query('UNLOCK TABLES');
		}
		Header('Location: modules.php?name=' . $module_name);
	} else {
		include_once 'header.php';
		OpenTable();
		echo '<p align="center" class="content"><span class="title thick">' . _ERRORREG . '</span><br /><br />';
		echo $stop . '<br /><br />' . _GOBACK . '</p>';
		CloseTable();
		include_once 'footer.php';
	}
} else {
	include_once 'header.php';
	OpenTable();
		echo '<p align="center" class="content"><span class="title thick">' . _ERRORREG . '</span><br /><br />';
		echo $stop . '<br /><br />' . _GOBACK . '</p>';
	CloseTable();
	include_once 'footer.php';
}
?>