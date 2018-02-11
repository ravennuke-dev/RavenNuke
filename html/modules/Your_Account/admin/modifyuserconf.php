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
  $chng_uid = intval($chng_uid); // waraxe - Reflected XSS
	$stop = '';
	if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
	if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
	if ($chng_pass != '' OR $chng_pass2 != '') { ya_passCheck($chng_pass, $chng_pass2); }
	if ($ya_config['userealname'] == '0') $chng_name = '';
	if ($ya_config['usefakeemail'] == '0') $chng_femail = '';
	if ($ya_config['usewebsite'] == '0') $chng_url = '';
	if ($ya_config['useinstantmessaim'] == '0') $chng_user_aim = '';
	if ($ya_config['useinstantmessicq'] == '0') $chng_user_icq = '';
	if ($ya_config['useinstantmessmsn'] == '0') $chng_user_msnm = '';
	if ($ya_config['useinstantmessyim'] == '0') $chng_user_yim = '';
	if ($ya_config['uselocation'] == '0') $chng_user_from = '';
	if ($ya_config['useoccupation'] == '0') $chng_user_occ = '';
	if ($ya_config['useinterests'] == '0') $chng_user_interest = '';
	if ($ya_config['usenewsletter'] == '0') $chng_newsletter = '0';
	if ($ya_config['useviewemail'] == '0') $chng_user_viewemail = '0';
	if ($ya_config['usehideonline'] == '0') $user_allow_viewonline = '1';
	if ($ya_config['usesignature'] == '0') $chng_user_sig = '';
	if ($ya_config['usesignature'] == '0') $user_attachsig = '0';
	if ($ya_config['useextrainfo'] == '0') $chng_bio = '';
	if ($ya_config['usepoints'] == '0' ) $chng_points = '0';
	$chng_uname = ya_fixtext($chng_uname);
	$chng_name = ya_fixtext($chng_name);
	$chng_email = ya_fixtext($chng_email);
	$chng_femail = ya_fixtext($chng_femail);
	$chng_url = ya_fixtext($chng_url);
	$chng_user_icq = ya_fixtext($chng_user_icq);
	$chng_user_aim = ya_fixtext($chng_user_aim);
	$chng_user_yim = ya_fixtext($chng_user_yim);
	$chng_user_msnm = ya_fixtext($chng_user_msnm);
	$chng_user_occ = ya_fixtext($chng_user_occ);
	$chng_user_from = ya_fixtext($chng_user_from);
	$chng_user_interests = ya_fixtext($chng_user_interests);
	$chng_avatar = ya_fixtext($chng_avatar);
	$chng_user_viewemail = intval($chng_user_viewemail);
	// Start - Added to allow bbcode encoding to remain upon saving user  - RN v2.40.00
	$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_html_tags" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path" OR config_name = "rand_seed"');
	while ($rowbc = $db->sql_fetchrow($resultbc)) {
		$board_config[$rowbc['config_name']] = $rowbc['config_value'];
	}
	define('IN_PHPBB', TRUE);
	include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');
	include_once('./modules/Forums/includes/bbcode.php');
	include_once('./modules/Forums/includes/functions_post.php');
	$chng_sig_bbcode_uid = make_bbcode_uid();
	$chng_user_sig = prepare_message($chng_user_sig, $board_config['allow_html'], $board_config['allow_bbcode'], $board_config['allow_smilies'], $chng_sig_bbcode_uid);
	// End
	$chng_user_sig = addslashes(check_html($chng_user_sig, ''));
	//$chng_user_sig = ya_fixtext($chng_user_sig);
	$chng_bio = ya_fixtext($chng_bio);
	$chng_newsletter = intval($chng_newsletter);
	$user_allow_viewonline = intval($user_allow_viewonline);
	$user_lang = addslashes(check_html($user_lang, 'nohtml'));
	$user_dateformat = addslashes(check_html($user_dateformat, 'nohtml'));
	$user_timezone = intval($user_timezone);
	if ($stop == '') {
		if ($chng_pass != '') {
			$cpass = md5($chng_pass);
			$db->sql_query('UPDATE '.$user_prefix.'_users SET username=\'' . $chng_uname . '\', name=\'' . $chng_name . '\', user_email=\'' . $chng_email . '\', femail=\'' . $chng_femail . '\', user_website=\'' . $chng_url . '\', user_icq=\'' . $chng_user_icq . '\', user_aim=\'' . $chng_user_aim . '\', user_yim=\'' . $chng_user_yim . '\', user_msnm=\'' . $chng_user_msnm . '\', user_from=\'' . $chng_user_from . '\', user_occ=\'' . $chng_user_occ . '\', user_interests=\'' . $chng_user_interests . '\', user_viewemail=\'' . $chng_user_viewemail . '\', user_avatar=\'' . $chng_avatar . '\', user_sig=\'' . $chng_user_sig . '\', user_sig_bbcode_uid=\'' . $chng_sig_bbcode_uid . '\', bio=\'' . $chng_bio . '\', user_password=\'' . $cpass . '\', newsletter=\'' . $chng_newsletter . '\', user_attachsig=\'' . $user_attachsig . '\', user_timezone=\'' . $user_timezone . '\', user_lang=\'' . $user_lang . '\', user_dateformat=\'' . $user_dateformat . '\' , user_allowhtml=\'' . $user_allowhtml . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', points=\'' . $chng_points . '\' WHERE user_id=\'' . $chng_uid . '\'');
		} else {
			$db->sql_query('UPDATE '.$user_prefix.'_users SET username=\'' . $chng_uname . '\', name=\'' . $chng_name . '\', user_email=\'' . $chng_email . '\', femail=\'' . $chng_femail . '\', user_website=\'' . $chng_url . '\', user_icq=\'' . $chng_user_icq . '\', user_aim=\'' . $chng_user_aim . '\', user_yim=\'' . $chng_user_yim . '\', user_msnm=\'' . $chng_user_msnm . '\', user_from=\'' . $chng_user_from . '\', user_occ=\'' . $chng_user_occ . '\', user_interests=\'' . $chng_user_interests . '\', user_viewemail=\'' . $chng_user_viewemail . '\', user_avatar=\'' . $chng_avatar . '\', user_sig=\'' . $chng_user_sig . '\', user_sig_bbcode_uid=\'' . $chng_sig_bbcode_uid . '\', bio=\'' . $chng_bio . '\', newsletter=\'' . $chng_newsletter . '\', user_attachsig=\'' . $user_attachsig . '\', user_timezone=\'' . $user_timezone . '\', user_lang=\'' . $user_lang . '\', user_dateformat=\'' . $user_dateformat . '\' , user_allowhtml=\'' . $user_allowhtml . '\', user_allowbbcode=\'' . $user_allowbbcode . '\', user_allowsmile=\'' . $user_allowsmile . '\', user_allow_viewonline=\'' . $user_allow_viewonline . '\', user_notify=\'' . $user_notify . '\', user_notify_pm=\'' . $user_notify_pm . '\', user_popup_pm=\'' . $user_popup_pm . '\', points=\'' . $chng_points . '\' WHERE user_id=\'' . $chng_uid . '\'');
		}
		if (isset($nfield) && count($nfield) > 0) {
			foreach ($nfield as $key => $var) {
				$nfield[$key] = ya_fixtext($nfield[$key]);
				if (($db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users_field_values WHERE fid=\'' . $key . '\' AND uid = \'' . $chng_uid . '\''))) == 0) {
					$sql = 'INSERT INTO '.$user_prefix.'_users_field_values (uid, fid, value) VALUES (\'' . $chng_uid . '\', \'' . $key . '\', \'' . $nfield[$key] . '\')';
					$db->sql_query($sql);
				} else {
					$db->sql_query('UPDATE '.$user_prefix.'_users_field_values SET value=\'' . $nfield[$key] . '\' WHERE fid=\'' . $key . '\' AND uid = \'' . $chng_uid . '\'');
				}
			}
		}
/*
            $subnum = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_subscriptions WHERE userid=\'' . $chng_uid . '\''));
            $row = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_subscriptions WHERE userid=\'' . $chng_uid . '\''));
            $row2 = $db->sql_fetchrow($db->sql_query('SELECT username, user_email FROM '.$user_prefix.'_users WHERE user_id=\'' . $chng_uid . '\''));
            if ($reason == '') {
                $reason = 0;
            }
            if ($subnum == 1) {
                if ($subscription == 0) {
                    $subject = "$sitename "._SUBCANCELLED.'';
                    if ($reason == "0") {
                        if ($subscription_url != '') {
                            $body = _HELLO." ".$row2['username']."!\r\n\r\n"._SUBCANCEL."\r\n\r\n"._SUBNEEDTOAPPLY." $subscription_url\r\n\r\n"._SUBTHANKSATT."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                        } else {
                            $body = _HELLO." ".$row2['username']."!\r\n\r\n"._SUBCANCEL."\r\n\r\n"._SUBTHANKSATT."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                        }
                    } else {
                        if ($subscription_url != '') {
                            $body = _HELLO." ".$row2['username']."!\r\n\r\n"._SUBCANCELREASON."\r\n\r\n$reason\r\n\r\n"._SUBNEEDTOAPPLY." $subscription_url\r\n\r\n"._SUBTHANKSATT."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                        } else {
                            $body = _HELLO." ".$row2['username']."!\r\n\r\n"._SUBCANCELREASON."\r\n\r\n$reason\r\n\r\n"._SUBTHANKSATT."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                        }
                    }
                    $db->sql_query("DELETE FROM ".$prefix."_subscriptions WHERE userid='$chng_uid'");
                    ya_mail($row2['user_email'], $subject, $body, '');
                } elseif ($subscription == 1) {
                    if ($subscription_expire != 0) {
                        $subject	= "$sitename "._SUBUPDATEDSUB.'';
                        $body	= _HELLO." ".$row2['username']."!\r\n\r\n"._SUBUPDATED." $subscription_expire "._SUBYEARSTOACCOUNT."\r\n\r\n"._SUBTHANKSSUPP."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                        $expire	= $subscription_expire*31536000;
                        if ($subnum == 0) {
                            $expire = $expire+time();
                        }
                        $expire = $expire+$row['subscription_expire'];
                        $db->sql_query("UPDATE ".$prefix."_subscriptions SET subscription_expire='$expire' WHERE userid='$chng_uid'");
                        ya_mail($row2['user_email'], $subject, $body, '');
                    }
                }
            } elseif ($subnum == 0 AND $subscription == 1) {
                if ($subscription_expire != 0) {
                    $expire = $subscription_expire*31536000;
                    $expire = $expire+time();
                    $db->sql_query("INSERT INTO ".$prefix."_subscriptions VALUES (NULL, '$chng_uid', '$expire')");
                    $subject = "$sitename "._SUBACTIVATED.'';
                    $body = _HELLO." ".$row2['username']."!\r\n\r\n"._SUBOPENED." $subscription_expire "._SUBOPENED2."\r\n\r\n"._SUBHOPELIKE."\r\n"._SUBTHANKSSUPP2."\r\n\r\n$sitename "._TEAM."\r\n$nukeurl";
                    ya_mail($row2['user_email'], $subject, $body, '');
                }
            }
*/
		$pagetitle = ": "._USERADMIN." - "._ACCTMODIFY;
		include_once 'header.php';
		amain();
		echo '<br />';
		OpenTable();
		echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
#        if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype'>\n"; }
#        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
#        if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
		echo '<div class="text-center"><table align="center" border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="center"><span class="thick">' . _ACCTMODIFY . '</span></td></tr>';
		echo '<tr><td align="center"><input type="submit" value="' . _RETURN2 . '" /></td></tr>';
		echo '</table></div>';
		echo '</form>';
	} else {
		$pagetitle = ': ' . _USERADMIN;
		include_once 'header.php';
		title(_USERADMIN);
		amain();
		echo '<br />';
		OpenTable();
		echo '<span class="thick">' . $stop . '</span>';
	}
	CloseTable();
	include_once 'footer.php';
}
?>