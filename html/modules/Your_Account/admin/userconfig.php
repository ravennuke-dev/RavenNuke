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
		header('Location: ../../../index.php');
		die();
	}
	if (($radminsuper == 1) OR ($radminuser == 1)) {
		$pagetitle = ': ' . _USERSCONFIG;
		include_once 'header.php';
		title(_USERSCONFIG);
		amain();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center"><form action="' . $admin_file . '.php" method="post">';
		echo '<div style="height: 31px; padding: 0px 10px;">';
		echo '<ul id="usertabs" class="shadetabs">
		<li><a href="#" rel="usertab7"><span class="left">&nbsp;</span>' . _COOKIECONFIG . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab6"><span class="left">&nbsp;</span>' . _YA_LMTOPTIONS . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab5"><span class="left">&nbsp;</span>' . _YA_EXPOPTIONS . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab4"><span class="left">&nbsp;</span>' . _YA_GRAPOPTIONS . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab3"><span class="left">&nbsp;</span>' . _YA_MAILOPTIONS . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab2"><span class="left">&nbsp;</span>' . _YA_DEFLTFIELDS . '<span class="right">&nbsp;</span></a></li>
		<li><a href="#" rel="usertab1" class="selected"><span class="left">&nbsp;</span>' . _YA_REGOPTIONS . '<span class="right">&nbsp;</span></a></li>
		</ul>';
		echo '</div>';
		echo '<div style="background: white; border:1px solid gray; width:97%; margin-top:0; margin-bottom: 1em; padding: 10px">';
		echo '<div id="usertab1" class="tabcontent">';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="center" colspan="2"><strong>' . _YA_REGOPTIONS . '</strong></td></tr>';
		// Allow users to register
		echo '<tr><td align="right">' . _ACTALLOWREG . '</td><td align="left">' . askYN('allowuserreg') . '</td></tr>';
		// Use Email Activation
		echo '<tr><td align="right">' . _USEACTIVATE . '<br />' . _YA_SERVERMAILNOTE . '</td><td align="left">' . askYN('useactivate') . '</td></tr>';
		// require admins approval
		echo '<tr><td align="right">' . _REQUIREADMIN . '</td><td align="left">' . askYN('requireadmin') . '</td></tr>';
		// force user to enter email address twice on registration
		echo '<tr><td align="right">' . _DOUBLECHECKEMAIL . '</td><td align="left">' . askYN('doublecheckemail') . ' &nbsp;(' . _DOUBLECHECKEMAILNOTE . ')</td></tr>';
		// use COPPA
		echo '<tr><td align="right">' . _ACTIVATECOPPA . '</td><td align="left">' . askYN('coppa') . ' &nbsp;(' . _ACTIVATECOPPANOTE . ')</td></tr>';
		// turn on TOS for new users
		echo '<tr><td align="right">' . _ACTIVATETOS . '</td><td align="left">' . askYN('tos') . '  &nbsp;(' . _ACTIVATETOSNOTE . ')</td></tr>';
		// turn on TOS for new users
		#    if (is_active('Legal')) {
		global $multilingual, $currentlang;
		if ($multilingual == 1 && isset($currentlang)) {
			$lang = $currentlang;
		} else {
			$lang = '';
		}
		include_once NUKE_CLASSES_DIR . 'class.legal_doctypes.php';
		$objDocTypes = new Legal_DocTypes('', $lang);
		echo '<tr><td align="right">' . _YA_LEGAL_TOS . '</td><td align="left">';
		if ($objDocTypes->numTypes > 0) {
			echo '<select name="xlegal_did_TOS">';
			echo '<option value="0"';
			if ($ya_config['legal_did_TOS'] == 0) {
				echo ' selected="selected"';
			}
			echo '>&nbsp;</option>';
			foreach($objDocTypes->docTypes as $key => $value) {
				echo '<option value="' . $key . '"';
				if ($ya_config['legal_did_TOS'] == $key) {
					echo ' selected="selected"';
				}
				echo '>' . $value . '</option>';
			}
			echo '</select>';
		} else {
		}
		echo ' &nbsp;[&nbsp;<a href="', $admin_file . '.php?op=rn_lgl_doc_edit&amp;lgl_did=', $ya_config['legal_did_TOS'], '&amp;lgl_language=', $lgl_langS, '">', _TOSDOCEDITNOTE, '</a>&nbsp;]</td></tr>';
		// force all users to agree to TOS
		echo '<tr><td align="right">' . _ACTIVATETOSALL . '</td><td align="left">' . askYN('tosall') . ' &nbsp;(' . _ACTIVATETOSALLNOTE . ')</td></tr>';
		// display "As Registered User..."
		echo '<tr><td align="right">' . _ACTALLOWASREGUSER . '</td><td align="left">' . askYN('useasreguser') . '</td></tr>';
		echo '</table>';
		echo '</div>';
		echo '<div id="usertab2" class="tabcontent">';
		echo '<table border="0" cellpadding="1" cellspacing="1"><tr><td>';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="right">' . _ACTREQREALNAME . '</td><td align="left">';
		askregfield('userealname');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWFAKE . '</td><td align="left">';
		askregfield('usefakeemail');
		echo '</td></tr>';
		/*
		echo '<tr><td align="right">'._YA_USEGENDER.':</td><td align="left">';
		askregfield2('usegender');
		echo '</td></tr>';
		echo '<tr><td align="right">'._YA_USEBIRTHDAY.':</td><td align="left">';
		askregfield2('usebirthdate');
		echo '</td></tr>';
		*/
		echo '<tr><td align="right">' . _ACTALLOWURL . '</td><td align="left">';
		askregfield('usewebsite');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWIMAIM . '</td><td align="left">';
		askregfield('useinstantmessaim');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWIMICQ . '</td><td align="left">';
		askregfield('useinstantmessicq');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWIMMSN . '</td><td align="left">';
		askregfield('useinstantmessmsn');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWIMYIM . '</td><td align="left">';
		askregfield('useinstantmessyim');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWLOC . '</td><td align="left">';
		askregfield('uselocation');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWOCC . '</td><td align="left">';
		askregfield('useoccupation');
		echo '</td></tr>';
		echo '</table></td><td>';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="right">' . _ACTALLOWINTRSTS . '</td><td align="left">';
		askregfield('useinterests');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWNEWSLETTER . '</td><td align="left">';
		askregfield('usenewsletter');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWVIEWEMAIL . '</td><td align="left">';
		askregfield('useviewemail');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTHIDEONLINE . '</td><td align="left">';
		askregfield('usehideonline');
		echo '</td></tr>';
		#	echo '<tr><td align="right">' . _ACTALLOWFORUMNOTIFYOPTIONS . '</td><td align="left">';
		#	askregfield2('useforumnotifyoptions');
		#	echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWSIG . '</td><td align="left">';
		askregfield('usesignature');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWEXTRAINFO . '</td><td align="left">';
		askregfield('useextrainfo');
		echo '</td></tr>';
		echo '<tr><td align="right">' . _ACTALLOWPOINTS . '</td><td align="left">';
		askregfield2('usepoints');
		echo '</td></tr>';
		echo '</table>';
		echo '</td></tr>';
		echo '</table>';
		echo '</div>';
		echo '<div id="usertab3" class="tabcontent">';
		////////////////////////////////////////////////////////////////////
		//////  EMAIL OPTION S  /////////////////////////////
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="center" colspan="2"><strong>' . _YA_MAILOPTIONS . '</strong></td></tr>';
		// Can server send mail?
		echo '<tr><td align="right">' . _SERVERMAIL . '</td><td align="left">' . askYN('servermail') . '</td></tr>';
		// Notify admin when use registers?
		echo '<tr><td align="right">' . _ACTNOTIFYADD . '<br />' . _YA_SERVERMAILNOTE . '</td><td align="left">' . askYN('sendaddmail') . '</td></tr>';
		// Notify admin when use deletes?
		echo '<tr><td align="right">' . _ACTNOTIFYDELETE . '<br />' . _YA_SERVERMAILNOTE . '</td><td align="left">' . askYN('senddeletemail') . '</td></tr>';
		// Validate email change?
		echo '<tr><td align="right">' . _EMAILVALIDATE . '<br />' . _YA_SERVERMAILNOTE . '</td><td align="left">' . askYN('emailvalidate') . '</td></tr>';
		echo '</table>';
		echo '</div>';
		////////////////////////////////////////////////////
		///   PERMISSIONS   /////
		echo '<div id="usertab4" class="tabcontent">';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="center" colspan="2"><strong>' . _YA_GRAPOPTIONS . '</strong></td></tr>';
		// allow user to change email address
		echo '<tr><td align="right">' . _ACTALLOWMAIL . '</td><td align="left">' . askYN('allowmailchange') . '</td></tr>';
		// allow user to delete account
		echo '<tr><td align="right">' . _ACTALLOWDELETE . '</td><td align="left">' . askYN('allowuserdelete') . '</td></tr>';
		// allow user to change themes
		echo '<tr><td align="right">' . _ACTALLOWTHEME . '</td><td align="left">' . askYN('allowusertheme') . '</td></tr>';

		echo '</table>';
		echo '</div>';
		/////////////////////////////////////////////////
		///   ACCOUNT EXPIRATION OPTIONS
		echo '<div id="usertab5" class="tabcontent">';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		//    echo '<tr><td align="center" colspan="2">&nbsp;</td></tr>';
		echo '<tr><td align="center" colspan="2"><strong>' . _YA_EXPOPTIONS . '</strong></td></tr>';
		echo '<tr><td align="right" valign="top">' . _AUTOSUSPEND . '</td><td align="left"><select name="xautosuspend">';
		echo '<option value="0"';
		if ($ya_config['autosuspend'] == 0) {
			echo ' selected="selected"';
		}
		echo '>0 ' . _YA_NONEXPIRE . '</option>';
		$i = 1;
		while ($i <= 52) {
			$k = $i*604800;
			echo '<option value="' . $k . '"';
			if ($ya_config['autosuspend'] == $k) echo ' selected="selected"';
			echo '>' . $i;
			if ($i == 1) {
				echo _YA_WEEK;
			} else {
				echo _YA_WEEKS;
			}
			echo '</option>';
			$i++;
		}
		echo '</select><br />(' . _AUTOSUSNOTE . ')</td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_EXPIRING . '</td><td align="left"><select name="xexpiring">';
		echo '<option value="0"';
		if ($ya_config['expiring'] == 0) echo ' selected="selected"';
		echo '>0 ' . _YA_NONEXPIRE . '</option>';
		$i = 1;
		while ($i <= 30) {
			$k = $i*86400;
			echo '<option value="' . $k . '"';
			if ($ya_config['expiring'] == $k) echo ' selected="selected"';
			echo '>' . $i;
			if ($i == 1) {
				echo _YA_DAY;
			} else {
				echo _YA_DAYS;
			}
			echo '</option>';
			$i++;
		}
		echo '</select><br />(' . _YA_EXPIRINGNOTE . ')</td></tr>';
		echo '<tr><td align="right">' . _AUTOSUSPENDMAIN . '<br />(' . _YA_AUTOSUSPENDMAINNOTE . ')</td><td align="left">' . askYN('autosuspendmain') . '</td></tr>';
		echo '<tr><td align="center" colspan="2">&nbsp;</td></tr>';
		echo '</table>';
		echo '</div>';
		////////////////////////////////////////////////////////////////
		//////   Account creation limit options (password length, email addresses allowed etc   ///
		echo '<div id="usertab6" class="tabcontent">';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td align="center" colspan="2"><strong>' . _YA_LMTOPTIONS . '</strong></td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_PERPAGE . '</td><td align="left"><select name="xperpage">';
		$i = 1;
		while ($i <= 10) {
			$k = $i*50;
			echo '<option value="' . $k . '"';
			if ($ya_config['perpage'] == $k) echo ' selected="selected"';
			echo '>' . $k . ' ' . _YA_USERS . '</option>';
			$i++;
		}
		echo '</select><br />(' . _YA_PERPAGENOTE . ')</td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_BADNICK . ':</td><td align="left"><textarea name="xbad_nick" rows="5" cols="40">' . $ya_config['bad_nick'] . '</textarea><br />' . _YA_1PERLINE . '</td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_BADMAIL . ':</td><td align="left"><textarea name="xbad_mail" rows="5" cols="40">' . $ya_config['bad_mail'] . '</textarea><br />' . _YA_1PERLINE . '</td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_NICKMIN . ':</td><td align="left"><select name="xnick_min">';
		for ($i = 3;$i <= 24;$i++) {
			echo '<option value="' . $i . '"';
			if ($ya_config['nick_min'] == $i) echo ' selected="selected"';
			echo '>' . $i . ' ' . _YA_CHARS . '</option>';
		}
		echo '</select></td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_NICKMAX . ':</td><td align="left"><select name="xnick_max">';
		for ($i = 4;$i <= 25;$i++) {
			echo '<option value="' . $i . '"';
			if ($ya_config['nick_max'] == $i) echo ' selected="selected"';
			echo '>' . $i . ' ' . _YA_CHARS . '</option>';
		}
		echo '</select></td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_PASSMIN . ':</td><td align="left"><select name="xpass_min">';
		for ($i = 3;$i <= 24;$i++) {
			echo '<option value="' . $i . '"';
			if ($ya_config['pass_min'] == $i) echo ' selected="selected"';
			echo '>' . $i . ' ' . _YA_CHARS . '</option>';
		}
		echo '</select></td></tr>';
		echo '<tr><td align="right" valign="top">' . _YA_PASSMAX . ':</td><td align="left"><select name="xpass_max">';
		for ($i = 4;$i <= 25;$i++) {
			echo '<option value="' . $i . '"';
			if ($ya_config['pass_max'] == $i) echo ' selected="selected"';
			echo '>' . $i . ' ' . _YA_CHARS . '</option>';
		}
		echo '</select></td></tr>';
		echo '</table>';
		echo '</div>';
		////////////////////////////////////////////////////////////
		///  COOKIE OPTIONS   ////
		echo '<div id="usertab7" class="tabcontent">';
		echo '<table border="0" cellpadding="2" cellspacing="2">';
		echo '<tr>';
		echo '<td align="center" colspan="2"><strong>' . _YA_COOKIECONFIG . '</strong></td></tr>';
		echo '<tr><td align="center" colspan="2">&nbsp;</td></tr>';
		// menelaos: enables the cookiecheck routines to see if the users browser is cookieenabled
		echo '<tr><td align="right" valign="top">' . _COOKIECHECKNOTE1 . '</td><td align="left">' . askYN('cookiecheck') . ' &nbsp;(' . _COOKIECHECKNOTE2 . ')</td></tr>';
		// menelaos: enables admins to enable or disable the option for users to delete their cookies
		echo '<tr><td align="right" valign="top">' . _COOKIECLEANERNOTE1 . '</td><td align="left">' . askYN('cookiecleaner') . ' &nbsp;(' . _COOKIECLEANERNOTE2 . ')</td></tr>';
		echo '<tr><td align="right" valign="top">' . _COOKIETIMELIFE . '</td><td align="left"><select name="xcookietimelife">';
		echo '<option value="-"';
		if ($ya_config['cookietimelife'] == '-') echo ' selected="selected"';
		echo '>- ' . _YA_COOKIELOGOUTPAG . '</option>';
		echo '<option value="0"';
		if ($ya_config['cookietimelife'] == '0') echo ' selected="selected"';
		echo '>0 ' . _YA_COOKIEAUTOLOGOUT . '</option>';
		echo '<option value="30"';
		if ($ya_config['cookietimelife'] == 30) echo ' selected="selected"';
		echo '>30 ' . _YA_SECONDS . '</option>';
		echo '<option value="60"';
		if ($ya_config['cookietimelife'] == 60) echo ' selected="selected"';
		echo '>1 ' . _YA_MINUTE . '</option>';
		echo '<option value="300"';
		if ($ya_config['cookietimelife'] == 300) echo ' selected="selected"';
		echo '>5 ' . _YA_MINUTES . '</option>';
		echo '<option value="900"';
		if ($ya_config['cookietimelife'] == 900) echo ' selected="selected"';
		echo '>15 ' . _YA_MINUTES . '</option>';
		echo '<option value="1800"';
		if ($ya_config['cookietimelife'] == 1800) echo ' selected="selected"';
		echo '>30 ' . _YA_MINUTES . '</option>';
		echo '<option value="2700"';
		if ($ya_config['cookietimelife'] == 2700) echo ' selected="selected"';
		echo '>45 ' . _YA_MINUTES . '</option>';
		echo '<option value="3600"';
		if ($ya_config['cookietimelife'] == 3600) echo ' selected="selected"';
		echo '>1 ' . _YA_HOUR . '</option>';
		echo '<option value="7200"';
		if ($ya_config['cookietimelife'] == 7200) echo ' selected="selected"';
		echo '>2 ' . _YA_HOURS . '</option>';
		echo '<option value="10800"';
		if ($ya_config['cookietimelife'] == 10800) echo ' selected="selected"';
		echo '>3 ' . _YA_HOURS . '</option>';
		echo '<option value="14400"';
		if ($ya_config['cookietimelife'] == 14400) echo ' selected="selected"';
		echo '>4 ' . _YA_HOURS . '</option>';
		echo '<option value="18000"';
		if ($ya_config['cookietimelife'] == 18000) echo ' selected="selected"';
		echo '>5 ' . _YA_HOURS . '</option>';
		echo '<option value="36000"';
		if ($ya_config['cookietimelife'] == 36000) echo ' selected="selected"';
		echo '>10 ' . _YA_HOURS . '</option>';
		echo '<option value="72000"';
		if ($ya_config['cookietimelife'] == 72000) echo 'selected="selected"';
		echo '>20 ' . _YA_HOURS . '</option>';
		echo '<option value="86400"';
		if ($ya_config['cookietimelife'] == 86400) echo ' selected="selected"';
		echo '>1 ' . _YA_DAY . '</option>';
		echo '<option value="172800"';
		if ($ya_config['cookietimelife'] == 172800) echo ' selected="selected"';
		echo '>2 ' . _YA_DAYS . '</option>';
		echo '<option value="259200"';
		if ($ya_config['cookietimelife'] == 259200) echo ' selected="selected"';
		echo '>3 ' . _YA_DAYS . '</option>';
		echo '<option value="345600"';
		if ($ya_config['cookietimelife'] == 345600) echo ' selected="selected"';
		echo '>4 ' . _YA_DAYS . '</option>';
		echo '<option value="432000"';
		if ($ya_config['cookietimelife'] == 432000) echo ' selected="selected"';
		echo '>5 ' . _YA_DAYS . '</option>';
		echo '<option value="518400"';
		if ($ya_config['cookietimelife'] == 518400) echo ' selected="selected"';
		echo '>6 ' . _YA_DAYS . '</option>';
		echo '<option value="604800"';
		if ($ya_config['cookietimelife'] == 604800) echo ' selected="selected"';
		echo '>1 ' . _YA_WEEK . '</option>';
		echo '<option value="1209600"';
		if ($ya_config['cookietimelife'] == 1209600) echo ' selected="selected"';
		echo '>2 ' . _YA_WEEKS . '</option>';
		echo '<option value="1814400"';
		if ($ya_config['cookietimelife'] == 1814400) echo ' selected="selected"';
		echo '>3 ' . _YA_WEEKS . '</option>';
		echo '<option value="2592000"';
		if ($ya_config['cookietimelife'] == 2592000) echo ' selected="selected"';
		echo '>1 ' . _YA_MONTH . '</option>';
		for ($i = 2;$i <= 12;$i++) {
			$k = $i * 2592000;
			echo '<option value="' . $k . '"';
			if ($ya_config['cookietimelife'] == $k) echo ' selected="selected"';
			echo '>' . $i . ' ' . _YA_MONTHS . '</option>';
		}
		echo '</select><br />(' . _COOKIETIMELIFENOTE . ')</td></tr>';
		echo '<tr><td align="right">' . _COOKIEPATH . '<br />(' . _COOKIEPATHNOTE1 . ')</td><td align="left">';
		echo '<input type="text" name="xcookiepath" size="39" value="' . $ya_config['cookiepath'] . '" /><br />(' . _COOKIEPATHNOTE2 . ')</td></tr>';
		echo '<tr><td align="right" valign="top">' . _COOKIEINACTIVITY . '</td><td align="left"><select name="xcookieinactivity">';
		echo '<option value="-"';
		if ($ya_config['cookieinactivity'] == '-') echo ' selected="selected"';
		echo '>- ' . _YA_COOKIEINACTNOTUSER . '</option>';
		echo '<option value="0"';
		if ($ya_config['cookieinactivity'] == '0') echo ' selected="selected"';
		echo '>0 ' . _YA_COOKIEDELCOOKIE . '</option>';
		echo '<option value="30"';
		if ($ya_config['cookieinactivity'] == 30) echo ' selected="selected"';
		echo '>30 ' . _YA_SECONDS . '</option>';
		echo '<option value="60"';
		if ($ya_config['cookieinactivity'] == 60) echo ' selected="selected"';
		echo '>1  ' . _YA_MINUTE . '</option>';
		echo '<option value="120"';
		if ($ya_config['cookieinactivity'] == 120) echo ' selected="selected"';
		echo '>2  ' . _YA_MINUTES . '</option>';
		echo '<option value="180"';
		if ($ya_config['cookieinactivity'] == 180) echo ' selected="selected"';
		echo '>3  ' . _YA_MINUTES . '</option>';
		echo '<option value="240"';
		if ($ya_config['cookieinactivity'] == 240) echo ' selected="selected"';
		echo '>4  ' . _YA_MINUTES . '</option>';
		echo '<option value="300"';
		if ($ya_config['cookieinactivity'] == 300) echo ' selected="selected"';
		echo '>5  ' . _YA_MINUTES . '</option>';
		echo '<option value="900"';
		if ($ya_config['cookieinactivity'] == 900) echo ' selected="selected"';
		echo '>15 ' . _YA_MINUTES . '</option>';
		echo '<option value="1800"';
		if ($ya_config['cookieinactivity'] == 1800) echo ' selected="selected"';
		echo '>30 ' . _YA_MINUTES . '</option>';
		echo '<option value="2700"';
		if ($ya_config['cookieinactivity'] == 2700) echo ' selected="selected"';
		echo '>45 ' . _YA_MINUTES . '</option>';
		echo '<option value="3600"';
		if ($ya_config['cookieinactivity'] == 3600) echo ' selected="selected"';
		echo '>1  ' . _YA_HOUR . '</option>';
		echo '</select></td></tr>';
		echo '</table>';
		echo '</div>';
		echo '</div>';
		echo '<div class="text-center"><input type="hidden" name="op" value="yaUsersConfigSave" />';
		echo '<input type="submit" value="' . _SAVECHANGES . '" /></div>';
		echo '</form></div>';
		echo '<script type="text/javascript">
		var usercfg=new ddtabcontent("usertabs")
		usercfg.setpersist(true)
		usercfg.setselectedClassTarget("link")
		usercfg.init()
		</script>';
		CloseTable();
		include_once 'footer.php';
	}
	function askYN($regfield) {
		global $ya_config;
		$askYNhtml = $ck1 = $ck2 = '';
		if ($ya_config[$regfield]==1) $ck1 = ' checked="checked"';
		else $ck2 = ' checked="checked"';
		$askYNhtml  =  '<input type="radio" name="x'.$regfield.'" value="1"'.$ck1.' />'._YES.' &nbsp;';
		$askYNhtml .= '<input type="radio" name="x'.$regfield.'" value="0"'.$ck2.' />'._NO;
		return $askYNhtml;
	}
	function askregfield($regfield) {
		global $ya_config;
		echo '<select name="x' . $regfield . '">';
		$sel0 = $sel1 = $sel2 = $sel3 = $sel4 = $sel5 = '';
		if ($ya_config[$regfield] == '') $ya_config[$regfield] = 1;
		if ($ya_config[$regfield] == 1) $sel1 = ' selected="selected"';
		if ($ya_config[$regfield] == 2) $sel2 = ' selected="selected"';
		if ($ya_config[$regfield] == 3) $sel3 = ' selected="selected"';
		if ($ya_config[$regfield] == 4) $sel4 = ' selected="selected"';
		if ($ya_config[$regfield] == 5) $sel5 = ' selected="selected"';
		if ($ya_config[$regfield] == 0) $sel0 = ' selected="selected"';
		echo '<option value="1"' . $sel1 . '>' . _YA_NEED1_ACTIVENOTE . '</option>';
		echo '<option value="2"' . $sel2 . '>' . _YA_NEED2_OPTIONALNOTE . '</option>';
		echo '<option value="3"' . $sel3 . '>' . _YA_NEED3_REQUIREDNOTE . '</option>';
		echo '<option value="4"' . $sel4 . '>' . _YA_NEED4_OPTIONALONLY . '</option>';
		echo '<option value="5"' . $sel5 . '>' . _YA_NEED5_REQUIREDONLY . '</option>';
		echo '<option value="0"' . $sel0 . '>' . _YA_NEED0_DISABLED . '</option>';
		echo '</select>';
	}
	function askregfield2($regfield) {
		global $ya_config;
		$sel0 = $sel1 = $sel2 = '';
		echo '<select name="x' . $regfield . '">';
		if ($ya_config[$regfield] != 0) $ya_config[$regfield] = 1;
		if ($ya_config[$regfield] == 1) $sel1 = ' selected="selected"';
		if ($ya_config[$regfield] == 0) $sel0 = ' selected="selected"';
		echo '<option value="1"' . $sel1 . '>' . _NEED1 . '</option>';
		echo '<option value="0"' . $sel0 . '>' . _NEED0 . '</option>';
		echo '</select>';
	}
?>