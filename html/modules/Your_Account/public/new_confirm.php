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
$errormsg = '';
include_once 'header.php';
$ya_username = check_html($ya_username, 'nohtml');
ya_userCheck($ya_username);
$stop = str_replace('<div class="text-center">', '', $stop);
$stop = str_replace('</div>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
if (!isset($user_viewemail)) $user_viewemail = '0';
$ya_user_email = strtolower(check_html($ya_user_email, 'nohtml'));
if ($ya_config['userealname'] < '2') {
	$ya_realname = '';
}
if ($ya_realname == '' && ($ya_config['userealname'] == 3 or $ya_config['userealname'] == '5')) {
	$errormsg .= _YA_NOREALNAME . '<br />';
}
if ($ya_config['doublecheckemail'] == 0) {
	$ya_user_email2 == $ya_user_email;
} else {
	$ya_user_email2 = strtolower($ya_user_email2);
	if ($ya_user_email != $ya_user_email2) {
		$errormsg .= _EMAILDIFFERENT . '<br />';
	}
}
ya_mailCheck($ya_user_email);
// BEGIN:  nukeSPAM(tm)
if (function_exists('nukeSPAM') and empty($errormsg) and empty($stop)) {
	$nukeSPAM = nukeSPAM($ya_username, $ya_user_email);
	$errormsg = $nukeSPAM;
} else {
	$nukeSPAM = array();
}
// END:  nukeSPAM(tm)
$femail = (isset($femail)) ? check_html($femail, 'nohtml') : '';
$user_website = (isset($user_website)) ? check_html($user_website) : '';
$user_aim = (isset($user_aim)) ? check_html($user_aim, 'nohtml') : '';
$user_icq = (isset($user_icq)) ? check_html($user_icq, 'nohtml') : '';
$user_msnm = (isset($user_msnm)) ? check_html($user_msnm, 'nohtml') : '';
$user_yim = (isset($user_yim)) ? check_html($user_yim, 'nohtml') : '';
$user_from = (isset($user_from)) ? check_html($user_from, 'nohtml') : '';
$user_occ = (isset($user_occ)) ? check_html($user_occ, 'nohtml') : '';
$user_interests = (isset($user_interests)) ? check_html($user_interests, 'nohtml') : '';
$newsletter = (isset($newsletter)) ? intval($newsletter) : 0;
$user_viewemail = (isset($user_viewemail)) ? intval($user_viewemail) : 0;
$user_allow_viewonline = (isset($user_allow_viewonline)) ? intval($user_allow_viewonline) : 1;
$user_sig = (isset($user_sig)) ? str_replace('<br />', "\r\n", $user_sig) : '';
$bio = (isset($bio)) ? str_replace('<br />', "\r\n", $bio) : '';
if ($femail == '' && ($ya_config['usefakeemail'] == '3' or $ya_config['usefakeemail'] == '5')) $errormsg .= _UFAKEMAIL . ' ' . _REQUIRED . '<br />';
if (!empty($user_website)) {
	if (!preg_match('#^http[s]?:\/\/#i', $user_website)) $user_website = 'http://' . $user_website;
	if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $user_website)) $errormsg .= _ERRORHOMEPAGE.'<br />';
}
if ($user_website == '' && ($ya_config['usewebsite'] == '3' or $ya_config['usewebsite'] == '5')) $errormsg .= _YOURHOMEPAGE . ' ' . _REQUIRED . '<br />';
if ($user_aim == '' && ($ya_config['useinstantmessaim'] == '3' or $ya_config['useinstantmessaim'] == '5')) $errormsg .= _YAIM . ' ' . _REQUIRED . '<br />';
if ($user_icq == '' && ($ya_config['useinstantmessicq'] == '3' or $ya_config['useinstantmessicq'] == '5')) $errormsg .= _YICQ . ' ' . _REQUIRED . '<br />';
if ($user_msnm == '' && ($ya_config['useinstantmessmsn'] == '3' or $ya_config['useinstantmessmsn'] == '5')) $errormsg .= _YMSNM . ' ' . _REQUIRED . '<br />';
if ($user_yim == '' && ($ya_config['useinstantmessyim'] == '3' or $ya_config['useinstantmessyim'] == '5')) $errormsg .= _YYIM . ' ' . _REQUIRED . '<br />';
if ($user_from == '' && ($ya_config['uselocation'] == '3' or $ya_config['uselocation'] == '5')) $errormsg .= _YLOCATION . ' ' . _REQUIRED . '<br />';
if ($user_occ == '' && ($ya_config['useoccupation'] == '3' or $ya_config['useoccupation'] == '5')) $errormsg .= _YOCCUPATION . ' ' . _REQUIRED . '<br />';
if ($user_interests == '' && ($ya_config['useinterests'] == '3' or $ya_config['useinterests'] == '5')) $errormsg .= _YINTERESTS . ' ' . _REQUIRED . '<br />';
if ($newsletter == '' && ($ya_config['usenewsletter'] == '3' or $ya_config['usenewsletter'] == '5')) $errormsg .= _RECEIVENEWSLETTER . ' ' . _REQUIRED . '<br />';
if ($user_viewemail == '' && ($ya_config['useviewemail'] == '3' or $ya_config['useviewemail'] == '5')) $errormsg .= _ALWAYSSHOWEMAIL . ' ' . _REQUIRED . '<br />';
if ($user_allow_viewonline == '' && ($ya_config['usehideonline'] == '3' or $ya_config['usehideonline'] == '5')) $errormsg .= _HIDEONLINE . ' ' . _REQUIRED . '<br />';
if ($user_sig == '' && ($ya_config['usesignature'] == '3' or $ya_config['usesignature'] == '5')) $errormsg .= _SIGNATURE . ' ' . _REQUIRED . '<br />';
if ($bio == '' && ($ya_config['useextrainfo'] == '3' or $ya_config['useextrainfo'] == '5')) $errormsg .= _EXTRAINFO . ' ' . _REQUIRED . '<br />';
$stop = str_replace('<div class="text-center">', '', $stop);
$stop = str_replace('</div>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
$datekey = date('F j');
// fkelly 6/11/2008 took random num out and put check for gfx_chk being set in
// not sure where random num is supposed to be posted from and gfx check will throw an error if it is not set
$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $datekey));
// $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
$code = substr($rcode, 2, $ya_config['codesize']);
/*
 * montego - usegfxcheck is not configurable for RN and only the RN captcha security
 * code should be used.  Therefore, to avoid conflicts, following code is being commented out.
 *
if (isset($gfx_check)) {
	if (extension_loaded('gd') AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 1 OR $ya_config['usegfxcheck'] == 3)) {
		$errormsg .= _SECCODEINCOR . '<br />';
	}
}
*/
if ($user_password == '' AND $user_password2 == '') {
	$user_password = YA_MakePass();
} elseif ($user_password != $user_password2) {
	$errormsg .= _PASSDIFFERENT . '<br />';
} elseif ($user_password == $user_password2 AND (strlen($user_password) < $ya_config['pass_min'] OR strlen($user_password) > $ya_config['pass_max'])) {
	$errormsg .= _YA_PASSLENGTH . '<br />';
}
if (empty($nfield)) $nfield = array();
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need = \'3\' ORDER BY pos');
while ($sqlvalue = $db->sql_fetchrow($result)) {
	if (!array_key_exists($sqlvalue['fid'], $nfield) || trim($nfield[$sqlvalue['fid']]) == '') {
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		$errormsg .= _YA_FILEDNEED1 . $name_exit . _YA_FILEDNEED2 . '<br />';
	}
}
if (empty($errormsg)) {
	if ($ya_config['requireadmin'] == 1) {
		$ncTitle = _USERAPPLOGIN;
		$ncNext = _USERAPPFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _WAITAPPROVAL;
	} elseif ($ya_config['useactivate'] == 1) {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _YOUWILLRECEIVE;
	} else {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '';
	}
	title($ncTitle);
	OpenTable();
	echo '<div class="text-center"><strong>' . $ncNext . '</strong><br /><br />' . $ya_username . ', ' . _USERCHECKDATA . '</div><br />';
	echo '<table align="center" border="0">';
	echo '<tr><td width="50%"><strong>' . _USERNAME . ':</strong></td><td align="left">' . $ya_username . '<br /></td></tr>';
	if ($ya_config['userealname'] > 1) echo '<tr><td width="50%"><strong>' . _UREALNAME . ':</strong></td><td align="left">' . $ya_realname . '<br /></td></tr>';
	echo '<tr><td width="50%"><strong>' . _EMAIL . ':</strong></td><td align="left">' . $ya_user_email . '</td></tr>';
	echo '</table><br /><br />';
	echo '<div class="text-center">' . $ncNote;
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	echo security_code(array(3, 4, 6, 7) , 'stacked');
	echo '<input type="hidden" name="random_num" value="' . $random_num . '" />';
	echo '<input type="hidden" name="op" value="new_finish" /><br /><br />';
} else {
	OpenTable();
	echo '<div><form action="modules.php?name=' . $module_name . '&amp;op=new_user" method="post">';
	echo '<div class="text-center title"><strong>' . _ERRORREG . '</strong></div><br /><br />';
	if (function_exists('nukeSPAM')) {
		if (is_array($nukeSPAM)) {
			$check_nukeSPAM = array_keys($nukeSPAM, true);
			if (!empty($check_nukeSPAM)) {
				echo '<div class="text-center title">' . $nukeSPAM['constant'] . $nukeSPAM['constant_ext1'] . $nukeSPAM['jsadress'] . '</div>'
					.'<input type="hidden" name="errormsg" value="' . htmlspecialchars($nukeSPAM['constant'] . $nukeSPAM['constant_ext2'], ENT_QUOTES, _CHARSET) . '" /><br />';
			}
		}
	} else {
		echo '<div class="text-center title">' . $errormsg . '</div>';
		$errormsg = htmlentities($errormsg);
		echo '<input type="hidden" name="errormsg" value="' . $errormsg . '" /><br />';
	}
	echo '<input type="hidden" name="op" value="new_user" />';
}
echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" />';
echo '<input type="hidden" name="ya_realname" value="' . $ya_realname . '" />';
echo '<input type="hidden" name="ya_user_email" value="' . $ya_user_email . '" />';
echo '<input type="hidden" name="ya_user_email2" value="' . $ya_user_email2 . '" />';
echo '<input type="hidden" name="user_password" value="' . $user_password . '" />';
echo '<input type="hidden" name="user_password2" value="' . $user_password2 . '" />';
if (isset($femail)) echo '<input type="hidden" name="femail" value="' . htmlspecialchars($femail, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_website)) echo '<input type="hidden" name="user_website" value="' . htmlspecialchars($user_website, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_icq)) echo '<input type="hidden" name="user_icq" value="' . htmlspecialchars($user_icq, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_aim)) echo '<input type="hidden" name="user_aim" value="' . htmlspecialchars($user_aim, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_yim)) echo '<input type="hidden" name="user_yim" value="' . htmlspecialchars($user_yim, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_msnm)) echo '<input type="hidden" name="user_msnm" value="' . htmlspecialchars($user_msnm, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_from)) echo '<input type="hidden" name="user_from" value="' . htmlspecialchars($user_from, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_occ)) echo '<input type="hidden" name="user_occ" value="' . htmlspecialchars($user_occ, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_interests)) echo '<input type="hidden" name="user_interests" value="' . htmlspecialchars($user_interests, ENT_QUOTES, _CHARSET) . '" />';
if (isset($newsletter)) echo '<input type="hidden" name="newsletter" value="' . intval($newsletter) . '" />';
if (isset($user_viewemail)) echo '<input type="hidden" name="user_viewemail" value="' . htmlspecialchars($user_viewemail, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_allow_viewonline)) echo '<input type="hidden" name="user_allow_viewonline" value="' . intval($user_allow_viewonline) . '" />';
if (isset($user_timezone)) echo '<input type="hidden" name="user_timezone" value="' . htmlspecialchars($user_timezone, ENT_QUOTES, _CHARSET) . '" />';
if (isset($user_dateformat)) echo '<input type="hidden" name="user_dateformat" value="' . htmlspecialchars($user_dateformat, ENT_QUOTES, _CHARSET) . '" />';
if (isset($nfield)) {
	if (count($nfield) > 0) {
		foreach($nfield as $key => $var) {
			echo '<input type="hidden" name="nfield[' . check_html($key, 'nohtml') . ']" value="' . check_html($var, 'nothml') . '" />';
		}
	}
}
if (isset($user_sig)) echo '<input type="hidden" name="user_sig" value="' . htmlspecialchars($user_sig, ENT_QUOTES, _CHARSET) . '" />';
if (isset($bio)) echo '<input type="hidden" name="bio" value="' . htmlspecialchars($bio, ENT_QUOTES, _CHARSET) . '" />';

if (empty($errormsg)) {
	echo '<input type="submit" value="' . _FINISH . '" /> &nbsp;&nbsp;' . _GOBACK . '</form></div>';
} else {
	echo '<div class="text-center"><input type="submit" name="submit" value="' . _YA_GOBACK . '" /></div>';
	echo '</form></div>';
}
CloseTable();
include_once 'footer.php';
?>