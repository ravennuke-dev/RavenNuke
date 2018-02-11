<?php
/**
 * TegoNuke(tm) Mailer: Replaces Native PHP Mail
 *
 * Inspired by Nuke-Evolution and PHPNukeMailer.  Uses a re-written PHPNukeMailer
 * admin module for the administration of the mailer functions and Swift Mailer library
 * of classes to perform the actual mail functions.
 *
 * Will be used to replace PHP mail() function throughout RavenNuke(tm) /
 * PHP-Nuke.  This has become necessary as Hosts have started locking down
 * access to the mail() function and requiring SMTP authentication.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Integration
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 - 2010 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0_249
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
/*
 * Just in case the Mailer wasn't yet properly installed, we need to make
 * sure the mailer function is loaded and it will take care of checking that the
 * tables are created.
 */
if (TNML_IS_ACTIVE) include_once INCLUDE_PATH . 'includes/tegonuke/mailer/mailer.php';
/*
 * Get appropriate language file to use within language/tegonuke/mailer/ directory
 */
if (!defined('NUKE_LANGUAGE_DIR')) define('NUKE_LANGUAGE_DIR', './language/');
global $admin_file, $currentlang, $language;
if (file_exists(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $currentlang . '.php')) {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $currentlang . '.php');
} elseif (file_exists(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $language . '.php')) {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $language . '.php');
} else {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-english.php');
}
/*
 * Make sure the person accessing this administration page is a superuser as this
 * is a system-wide tool.
 */
$aid = addslashes(substr($aid, 0,25));
$row = $db->sql_fetchrow($db->sql_query('SELECT radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
if ($row['radminsuper'] == 1) {
	switch ($op) {
		case 'MailConfig': // Left here for legacy nukeSEO DH menu operations
		case 'tnmlMailConfig':
			addCSSToHead('includes/tegonuke/public/tegonuke.css', 'file');
			tnmlMailConfig();
			break;
		case 'tnmlAbout':
			addCSSToHead('includes/tegonuke/public/tegonuke.css', 'file');
			tnmlAbout();
			break;
		case 'tnmlMailConfigSave':
			csrf_check();
			global $prefix, $db, $admin_file;
			/*
			 * Cleanse user input and save.
			 */
			if (!in_array($xpnm_is_active, array(0, 1))) $xpnm_is_active = 0;
			if (!in_array($xmailer, array(1, 2, 3))) $xmailer = 1;
			$xbounce = (false === validate_mail($xbounce)) ? '' : addslashes(check_html($xbounce, 'nohtml'));
			if (!in_array($xdebug, array(0, 1, 2))) $xdebug = 0;
			$xsmtp_host = addslashes(check_html($xsmtp_host, 'nohtml'));
			$xsmtp_helo = addslashes(check_html($xsmtp_helo, 'nohtml'));
			$xsmtp_port = intval($xsmtp_port);
			$xsmtp_auth = intval($xsmtp_auth);
			$xsmtp_uname = addslashes(check_html($xsmtp_uname, 'nohtml'));
			$xsmtp_passw = addslashes(check_html($xsmtp_passw, 'nohtml'));
			if (!in_array($xsmtp_encrypt, array(0, 1))) $xsmtp_encrypt = 0;
			if (!in_array($xsmtp_encrypt_method, array(0, 1, 2))) $xsmtp_encrypt_method = 0;
			// Next two lines do not allow encryption on/off vs. method mis-matches - just force to
			// certain defaults.
			// @todo Add error messaging to the administration save page.
			if (0 < $xsmtp_encrypt_method && 0 == $xsmtp_encrypt) $xsmtp_encrypt_method = 0;
			if (1 == $xsmtp_encrypt && 0 == $xsmtp_encrypt_method) $xsmtp_encrypt = 0;
			$xsendmail_path = addslashes(check_html($xsendmail_path, 'nohtml'));
			$result = $db->sql_query('UPDATE ' . $prefix . '_mail_config SET active=\'' . $xpnm_is_active
				. '\', mailer=\'' . $xmailer . '\', reply_to=\'' . $xbounce . '\', debug_level=\'' . $xdebug
				. '\', smtp_host=\'' . $xsmtp_host . '\', smtp_helo=\'' . $xsmtp_helo
				. '\', smtp_port=\'' . $xsmtp_port . '\', smtp_auth=\'' . $xsmtp_auth . '\', smtp_uname=\''
				. $xsmtp_uname . '\', smtp_passw=\'' . $xsmtp_passw. '\', smtp_encrypt=\'' . $xsmtp_encrypt
				. '\', smtp_encrypt_method=\'' . $xsmtp_encrypt_method . '\', sendmail_path=\'' . $xsendmail_path
				. '\''
				);
			Header('Location: ' . $admin_file . '.php?op=tnmlMailConfig');
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/**
 * Displays the current Mailer configuration options for the admin to view/change.
 */
function tnmlMailConfig() {
	global $prefix, $db, $admin_file, $textcolor1, $bgcolor2;
	/*
	 * Set up the jQuery ready handler and other code.  No sense pulling this into an
	 * external .js as the code is very small and not heavily used.
	 */
	addJSToHead('includes/jquery/jquery.js', 'file');
	$inlineJS = <<< EOD
		<script type="text/javascript" language="JavaScript">
		jQuery(document).ready(function()
			{
				// Set up function to toggle what is hidden vs. what is shown
				function tnmlShowMe(fieldSet) {
					jQuery('fieldset.tnmlOpts').hide();
					if (fieldSet > 1) {
						fieldSetID ='#tnmlOpts' + fieldSet;
						jQuery(fieldSetID).show();
					}
				}
				// Function to handle the change event on the Mailer type option
				jQuery('#tnmlMailer').change(function() {
						tnmlShowMe(this.value);
					}
				)
				// Fire the change event to set the page options
				jQuery('#tnmlMailer').change();
			}
		);
		</script>
EOD;
	addJSToHead($inlineJS, 'inline');
	include_once ('header.php');
	echo '<div class="tntnWrap">';
	$tnml_asCfg = array();
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_mail_config');
	$tnml_asCfg = $db->sql_fetchrow($result);
	OpenTable();
	echo '<div align="center"><p class="title">', _TNML_MNU_MAILCFG_LAB, '</p>'
		, '[ <a href="', $admin_file, '.php">', _TNML_MNU_BACK2ADM_LAB, '</a> | '
		, '<a href="', $admin_file, '.php?op=tnmlAbout">', _TNML_MNU_ABOUT_LAB, '</a> ]<br />'
		, '<hr /></div>';
	tnmlShowHelpLegend();
	echo '<form action="', $admin_file, '.php" method="post">';
	/*
	 * Firstly, is the Mailer active or now?
	 */
	echo '<fieldset><legend>', tnmlShowHelp(_TNML_PNMACTIVATE_HLP, _TNML_PNMACTIVATE_LAB)
		, _TNML_PNMACTIVATE_LAB, ' </legend>';
	$strX = '<label><input type="radio" name="xpnm_is_active" ';
	if ($tnml_asCfg['active'] == 1) {
		echo $strX, 'value="1" checked="checked" />', _YES, '</label>';
		echo $strX, 'value="0" />', _NO, '</label>';
	} else {
		echo $strX, 'value="1" />', _YES, '</label>';
		echo $strX, 'value="0" checked="checked" />', _NO, '</label>';
	}
	echo '</fieldset>';
	/*
	 * Display General Mailer options such as ON/OFF, Send Method, bounce address and debug setting
	 */
	echo '<fieldset><legend>' . _TNML_OPTSGENERAL_LAB . ': </legend>';
	// First up is the Mailer Activation
	// Send Method
	echo '<p><label for="tnmlMailer">', tnmlShowHelp(_TNML_SENDMETHOD_HLP, _TNML_SENDMETHOD_LAB)
		, _TNML_SENDMETHOD_LAB, '</label> &nbsp;';
	echo '<select id="tnmlMailer" name="xmailer">';
	$mailer1 = $mailer2 = $mailer3 = '';
	$mailerSel = 'mailer' . $tnml_asCfg['mailer'];
	$$mailerSel = ' selected="selected"';
	echo '<option value="2"', $mailer2, '>SMTP</option>';
	echo '<option value="3"', $mailer3, '>SendMail</option>';
	echo '<option value="1"', $mailer1, '>PHP Mail()</option>'; // The default
	echo '</select></p>';
	// Bounce(Reply-To) mail address
	echo '<p><label for="tnmlBounce">', tnmlShowHelp(_TNML_BOUNCEADDR_HLP, _TNML_BOUNCEADDR_LAB)
		, _TNML_BOUNCEADDR_LAB, '</label> &nbsp;';
	echo '<input id="tnmlBounce" type="text" name="xbounce" value="', $tnml_asCfg['reply_to'], '" size="30" /></p>';
	// Debugging option
	echo '<p><label for="tnmlDebug">', tnmlShowHelp(_TNML_DEBUGLEVEL_HLP, _TNML_DEBUGLEVEL_LAB)
		, _TNML_DEBUGLEVEL_LAB, '</label> &nbsp;';
	echo '<select id="tnmlDebug" name="xdebug">';
	$mailer0 = $mailer1 = $mailer2 = '';
	$mailerSel = 'mailer' . $tnml_asCfg['debug_level'];
	$$mailerSel = ' selected="selected"';
	echo '<option value="0"', $mailer0, '>', _TNML_OFF, '</option>';
	echo '<option value="1"', $mailer1, '>', _TNML_ONWITHSEND, '</option>';
	echo '<option value="2"', $mailer2, '>', _TNML_ONNOSEND, '</option>';
	echo '</select></p>';
	// No more General options
	echo '</fieldset>';
	/*
	 * SMTP ONLY Settings
	 */
	echo '<fieldset id="tnmlOpts2" class="tnmlOpts"><legend>' . _TNML_OPTSSMTP_LAB . ': </legend>';
	// SMTP Host URL
	echo '<p><label for="tnmlSmtpHost">', tnmlShowHelp(_TNML_SMTPHOST_HLP, _TNML_SMTPHOST_LAB)
		, _TNML_SMTPHOST_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSmtpHost" type="text" name="xsmtp_host" value="', $tnml_asCfg['smtp_host'], '" size="30" /></p>';
	// SMTP HELO URL
	echo '<p><label for="tnmlSmtpHelo">', tnmlShowHelp(_TNML_SMTPHELO_HLP, _TNML_SMTPHELO_LAB)
		, _TNML_SMTPHELO_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSmtpHelo" type="text" name="xsmtp_helo" value="', $tnml_asCfg['smtp_helo'], '" size="30" /></p>';
	// SMTP Port (usually 25 for standard send and 465 for encrypted send
	echo '<p><label for="tnmlSmtpPort">', tnmlShowHelp(_TNML_SMTPPORT_HLP, _TNML_SMTPPORT_LAB)
		, _TNML_SMTPPORT_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSmtpPort" type="text" name="xsmtp_port" value="', $tnml_asCfg['smtp_port'], '" size="4" maxlength="4" /></p>';

	// Is authentication required?
	echo '<p><label>', tnmlShowHelp(_TNML_SMTPAUTH_HLP, _TNML_SMTPAUTH_LAB)
		, _TNML_SMTPAUTH_LAB, '</label> &nbsp;';
	$strX = '<input type="radio" name="xsmtp_auth" ';
	if ($tnml_asCfg['smtp_auth'] == 1) {
		echo $strX, 'value="1" checked="checked" />', _YES, ' &nbsp;', $strX, 'value="0" />', _NO;
	} else {
		echo $strX, 'value="1" />', _YES, ' &nbsp;', $strX, 'value="0" checked="checked" />', _NO;
	}
	echo '</p>';
	// SMTP username for authentication purposes
	echo '<p><label for="tnmlSmtpUser">', tnmlShowHelp(_TNML_SMTPUSER_HLP, _TNML_SMTPUSER_LAB)
		, _TNML_SMTPUSER_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSmtpUser" type="text" name="xsmtp_uname" value="', $tnml_asCfg['smtp_uname'], '" size="30" /></p>';
	// SMTP password for authentication purposes
	echo '<p><label for="tnmlSmtpPass">', tnmlShowHelp(_TNML_SMTPPASS_HLP, _TNML_SMTPPASS_LAB)
		, _TNML_SMTPPASS_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSmtpPass" type="text" name="xsmtp_passw" value="', $tnml_asCfg['smtp_passw'], '" size="15" /></p>';

	// Is encryption required/desired?
	echo '<p><label>', tnmlShowHelp(_TNML_SMTPENCRYPT_HLP, _TNML_SMTPENCRYPT_LAB)
		, _TNML_SMTPENCRYPT_LAB, '</label> &nbsp;';
	$strX = '<input type="radio" name="xsmtp_encrypt" ';
	if ($tnml_asCfg['smtp_encrypt'] == 1) {
		echo $strX, 'value="1" checked="checked" />', _YES, ' &nbsp;', $strX, 'value="0" />', _NO;
	} else {
		echo $strX, 'value="1" />', _YES, ' &nbsp;', $strX, 'value="0" checked="checked" />', _NO;
	}
	echo '</p>';
	echo '<p><label for="tnmlSmtpMethod">', tnmlShowHelp(_TNML_SMTPENCRYPTMETHOD_HLP, _TNML_SMTPENCRYPTMETHOD_LAB)
		, _TNML_SMTPENCRYPTMETHOD_LAB, '</label> &nbsp;';
	echo '<select id="tnmlSmtpMethod" name="xsmtp_encrypt_method">';
	$mailer0 = $mailer1 = $mailer2 = '';
	$mailerSel = 'mailer' . $tnml_asCfg['smtp_encrypt_method'];
	$$mailerSel = ' selected="selected"';
	echo '<option value="0"', $mailer0, '>', _TNML_NONE, '</option>';
	echo '<option value="1"', $mailer1, '>SSL</option>';
	echo '<option value="2"', $mailer2, '>TLS</option>';
	echo '</select></p>';

	// End of SMTP settings
	echo '</fieldset>';
	/**
	 * SendMail ONLY Settings
	 */
	echo '<fieldset id="tnmlOpts3" class="tnmlOpts"><legend>' . _TNML_OPTSSENDMAIL_LAB . ': </legend>';
	// SMTP Host URL
	echo '<p><label for="tnmlSendMail">', tnmlShowHelp(_TNML_SENDMAIL_HLP, _TNML_SENDMAIL_LAB)
		, _TNML_SENDMAIL_LAB, '</label> &nbsp;';
	echo '<input id="tnmlSendMail" type="text" name="xsendmail_path" value="', $tnml_asCfg['sendmail_path'], '" size="30" /></p>';
	// End of Sendmail settings
	echo '</fieldset>';
	/*
	 * Produce the Save Changes button and close out the form.
	 */
	echo '<br /><hr />';
	echo '<br /><div class="text-center"><input type="hidden" name="op" value="tnmlMailConfigSave" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" /></div>';
	echo '<br /></form>';
	CloseTable();
	echo '</div>';
	echo '<script type="text/javascript" language="JavaScript" src="includes/tegonuke/help/wz_tooltip.js"></script>';
	include_once ('footer.php');
}
/**
 * Displays the Mailer "About" (credits)
 */
function tnmlAbout() {
	include_once('header.php');
	echo '<div class="tntnWrap">';
	OpenTable();
	$currentYear = date('Y');
	echo '<div align="center"><span class="title">TegoNuke&trade; Mailer ', TNML_VERSION, '</span><br /><br />'
		. 'Created and maintained by Rob Herder (aka: montego)<br /><a href="http://montegoscripts.com">montegoscripts.com</a>'
		. '<br />&copy; 2008 - ', $currentYear, '<br /><br /><br />'
		. 'TegoNuke&trade; Mailer uses a heavily modified version of the administration/setup of PHPNukeMailer<br />'
		. 'and the more robust Swift Mailer to do the mailing.<br /><br /><br />'
		. '<span class="title">Original credits</span><br />Please consider donating to these fine projects<br /><br />'
		. '<span class="thick">PHPNukeMailer 1.0.9</span><br />Created by Jonathan Estrella<br />'
		. '<a href="http://www.slaytanic.tk">www.slaytanic.tk</a> || '
		. '<a href="http://www.metalrebelde.net.tc">www.metalrebelde.net.tc</a><br />'
		. '&copy; 2004 - 2008<br /><br />'
		. '<span class="thick">Swift Mailer ', TNML_SWIFT_VERSION, '</span><br />'
		. 'Created by Chris Corbyn<br /><a href="http://www.swiftmailer.org">www.swiftmailer.org</a>'
		. '<br />&copy; ', $currentYear, '<br /><br /><br />'
		. 'This program is free software. You can redistribute it and/or modify it'
		. 'under the terms of the GNU General Public License (GPL) as published by the Free Software Foundation; either '
		. 'version 2 of the License.<br /><br />', _GOBACK, '</div>';
	CloseTable();
	echo '</div>';
	include_once('footer.php');
}
/**
 * Displays the pop-up help text
 *
 * @param   string  $sHelpTxt is the help text to display in the pop-up
 * @param   string  $sFieldNm is the field name to display in bold text
 * @return  string  HTML code for the IMG tag to show the pop-up help icon
 */
function tnmlShowHelp($sHelpTxt='', $sFieldNm='') {
	$sStyle = 'style="cursor:help;border:0px"';
	$sHTMLTmp = '';
	$sHTML = '&nbsp;<img ' . $sStyle . ' src="images/tegonuke/help/question.png" '
		.'height="12" width="12" alt="" '
		.'onmouseover="return escape(\'';
	if ($sFieldNm != '') {
		$sHTMLTmp .= '<strong>'.$sFieldNm.':</strong>&nbsp;';
	}
	$sHTMLTmp .= $sHelpTxt;
	$sHTMLTmp = htmlspecialchars($sHTMLTmp);
	$sHTML .= addslashes($sHTMLTmp) .'\')" />&nbsp;';
	return $sHTML;
}
/**
 * Shows a standard legend for use of the pop-up help icon
 *
 * @return  string  HTML code for the IMG tag to show the pop-up help icon legend
 */
function tnmlShowHelpLegend() {
	$sHTML	= '<p align="center">' . tnmlShowHelp( _TNML_HLP_LEGEND_HLP, '' );
	$sHTML	.= ' = ' . _TNML_HLP_LEGEND_LAB .'</p>';
	echo $sHTML;
	return;
}
