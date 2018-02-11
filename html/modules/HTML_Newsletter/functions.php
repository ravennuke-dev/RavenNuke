<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE')) {
	die('Illegal File Access');
}
/************************************************************************
* Function: msnl_fGetModCfg
* Inputs:   None
* Returns:  Array of string key/value pairs
* Usage:    Used to grab module configuration data.
************************************************************************/
function msnl_fGetModCfg() {
	global $prefix, $db;
	$asModCfg = array();
	$sql = 'SELECT * FROM `' . $prefix . '_hnl_cfg`';
	$result = msnl_fSQLCall($sql);
	if (!$result) { // DB call was not successful, so raise an application error
		msnl_fRaiseAppError(_MSNL_COM_ERR_DBGETCFG);
	} else {
		while (list($cfg_nm, $cfg_val) = $db->sql_fetchrow($result)) {
			$asModCfg[$cfg_nm] = $cfg_val;
			if ($cfg_nm == 'version') {
				$asversion = explode('.', $cfg_val);
				for ($i = 0; $i <= count($asversion) - 1; $i++) {
					$asversion[$i] = intval($asversion[$i]);
				}
				$asModCfg['version_friendly'] = implode('.', $asversion);
			}
		}
		return $asModCfg;
	}
}
/************************************************************************
* Function: msnl_fSQLCall
* Inputs:   sql = The sql to execute
* Returns:  DB connection handle
* Usage:    Used to wrap the PHP-Nuke SQL calls to add a layer of
*           application level debug messaging.
************************************************************************/
function msnl_fSQLCall($sql) {
	global $msnl_gasModCfg, $db;
	$result = $db->sql_query($sql);
	if ($result) {
		msnl_fDebugMsg( '<span class="thick">' . _MSNL_COM_LAB_SQL . ' = </span>' . msnl_fXMLEntities($sql));
		return $result;
	} else {
		if ($msnl_gasModCfg['debug_mode'] != MSNL_OFF) {
			$sql_error = $db->sql_error();
			echo '<p><span class="thick">' . _MSNL_COM_ERR_SQL . ': </span>' . msnl_fXMLEntities($sql_error['message']) . '</p>';
			echo '<p><span class="thick">' . _MSNL_COM_LAB_SQL . ' = </span>' . msnl_fXMLEntities($sql) . '</p>';
		}
		return $result;
	}
}
/************************************************************************
* Function: msnl_fDebugMsg
* Inputs:   msnl_gasModCfg[] = Array string of module config data
*           sDebugMsg = The message to display
* Usage:    Used to provide more verbose debug messaging if debug mode
*           is turned on.  Is also configurable as to where to write
*           the debug message to.
************************************************************************/
function msnl_fDebugMsg($sDebugMsg) {
	global $msnl_gasModCfg;
	if (isset($msnl_gasModCfg['debug_mode']) and $msnl_gasModCfg['debug_mode'] == MSNL_VERBOSE) {
		//Commented out code below will become future functionality to be able to log output to display,
		//to a logfile, or both.
		//		if ( ($msnl_gasModCfg['DebugOutput'] == MSNL_DISPLAY) || ($msnl_gasModCfg['DebugOutput'] == MSNL_BOTH) ) { //Send back to client
		if (is_array($sDebugMsg)) {
			echo '<p>';
			print_r($sDebugMsg);
			echo '</p>';
		} else {
			echo '<p>';
			echo $sDebugMsg;
			echo '</p>';
		}
		//		} elseif ( ($msnl_gasModCfg['DebugOutput'] == MSNL_LOGFILE) || ($msnl_gasModCfg['DebugOutput'] == MSNL_BOTH) ) { //Write to logfile
		//			echo "Need to write code to log to logfile<br />";
		//		}
	}
}
/************************************************************************
* Function: msnl_fRaiseAppError
* Inputs:   ErrMsg
* Usage:    If an error occurs, build page approprialy but with error msg.
************************************************************************/
function msnl_fRaiseAppError($ErrMsg) {
	global $msnl_sModuleNm, $msnl_giHeadersSent;
	echo '<p><span class="thick">' . _MSNL_COM_ERR_MODULE . ': </span>' . $msnl_sModuleNm . '</p>'
		. '<p><span class="thick">' . _MSNL_COM_LAB_ERRMSG . ': </span>' . msnl_fXMLEntities($ErrMsg) . '</p>';
	if ($msnl_giHeadersSent) {
		closetable();
		echo '<!-- MSNL_END -->';
		include_once 'footer.php';
	}
	die();
}
/************************************************************************
* Function: msnl_fSetValErr
* Inputs:   sFieldNm = The name of the field that had the error
*           sErrMsg = The error string to "push" onto the stack
* Usage:    Pushes an error message onto the error message "stack".
*           Typically called from validation routines where hard errors
*           like msnl_fRaiseAppErr() are not appropriate.
************************************************************************/
function msnl_fSetValErr($sFieldNm = '', $sErrMsg = '') {
	global $msnl_asERR;
	if ($sFieldNm != '' && $sErrMsg != '') {
		array_push($msnl_asERR, array($sFieldNm, $sErrMsg));
	}
}
/************************************************************************
* Function: msnl_fShowValErr
* Inputs:   N/A
* Returns:  0 = Had no validation errors on the "stack"
*           1 = Had errors, so display them.
* Usage:    Displays the "stack" of validation errors provided in the
*           array
************************************************************************/
function msnl_fShowValErr() {
	global $msnl_asERR;
	$iReturn = 0;
	$sHTML = '';
	if (sizeof($msnl_asERR) > 0) {
		$sHTML .= '<p>'
			. '<strong>' . _MSNL_COM_ERR_VALMSG . ':</strong>'
			. '</p>'
			. '<p>';
		foreach($msnl_asERR as $key => $saErr) {
			$sHTML .= '<span class="thick">' . $saErr[0] . '</span>:&nbsp;' . msnl_fXMLEntities($saErr[1]) . '<br />';
		}
		$sHTML .= '</p>';
		$iReturn = 1;
	}
	echo $sHTML;
	return $iReturn;
}
/************************************************************************
* Function: msnl_fSetValWarn
* Inputs:   sWarnMsg = The warning string to "push" onto the stack
* Usage:    Pushes a warning message onto the warning message "stack".
*           Typically called from validation routines where hard errors
*           like msnl_fRaiseAppErr() and msnl_fShowValErr are not
*           appropriate.
************************************************************************/
function msnl_fSetValWarn($sWarnMsg = '') {
	global $msnl_asWARN;
	if ($sWarnMsg != '') {
		array_push($msnl_asWARN, msnl_fXMLEntities($sWarnMsg));
	}
}
/************************************************************************
* Function: msnl_fShowValWarn
* Inputs:   N/A
* Returns:  0 = Had no validation errors on the "stack"
*           1 = Had errors, so display them.
* Usage:    Displays the "stack" of validation warnings provided in the
*           array
************************************************************************/
function msnl_fShowValWarn() {
	global $msnl_asWARN;
	$iReturn = 0;
	$sHTML = '';
	if (sizeof($msnl_asWARN) > 0) {
		$sHTML .= '<p>'
			. '<strong>' . _MSNL_COM_ERR_VALWARNMSG . ':</strong>'
			. '</p>'
			. '<p>';
		$sTmp = implode('<br />', $msnl_asWARN);
		$sHTML .= $sTmp . '</p>';
		$iReturn = 1;
	}
	echo $sHTML;
	return $iReturn;
}
/************************************************************************
* Function: msnl_fGetHTML
* Inputs:   None
* Usage:    Generates and stores key HTML used throughout the tool.
************************************************************************/
function msnl_fGetHTML() {
	$sHTMLArray = array();
	// Get the OpenTable HTML
	ob_start();
	opentable();
	$sHTMLArray['OPEN'] = ob_get_contents();
	ob_clean();
	// Get the CloseTable HTML
	closetable();
	$sHTMLArray['CLOSE'] = ob_get_contents();
	ob_end_clean();
	return $sHTMLArray;
}
/************************************************************************
* Function: msnl_fShowHelp
* Inputs:   sHelpTxt	= The help text to display in the pop-up
*           sFieldNm	= The field name to display in bold text
* Returns:  HTML code for the IMG tag to show the pop-up help icon.
* Usage:    To ensure consistency in showing the help icon throughout.
************************************************************************/
function msnl_fShowHelp($sHelpTxt = '', $sFieldNm = '') {
	global $msnl_sModuleNm, $msnl_asCSS;
	$sHTMLTmp = '';
	$sHTML = '&nbsp;<img ' . $msnl_asCSS['IMG_hlp'] . ' src="modules/' . $msnl_sModuleNm . '/images/question.png" '
		. 'height="12" width="12" alt="" '
		. 'onmouseover="return escape(\'';
	if ($sFieldNm != '') {
		$sHTMLTmp .= '<strong>' . $sFieldNm . ':</strong>&nbsp;';
	}
	$sHTMLTmp .= $sHelpTxt;
	$sHTMLTmp = htmlspecialchars($sHTMLTmp); // Legacy tooltip code requires not using the additional htmlspecialchars() options
//	$sHTMLTmp = str_replace('"', '&quot;', $sHTMLTmp);
//	$sHTMLTmp = str_replace('\'', '&acute;', $sHTMLTmp);
	$sHTML .= addslashes($sHTMLTmp) . '\')" />&nbsp;';
	return $sHTML;
}
/************************************************************************
* Function: msnl_fShowHelpLegend
* Inputs:   None
* Returns:  HTML code for the IMG tag to show the pop-up help icon legend.
* Usage:    Shows a standard legend for use of the pop-up help icon.
************************************************************************/
function msnl_fShowHelpLegend() {
	global $msnl_asCSS, $msnl_sModuleNm;
	$sHTML = '<p>' . msnl_fShowHelp(_MSNL_COM_HLP_HELPLEGENDTXT, '');
	$sHTML .= ' = ' . _MSNL_COM_LAB_HELPLEGENDTXT . '</p>';
	echo $sHTML;
	return;
}
/************************************************************************
* Function: msnl_fShowBtnGoBack
* Inputs:   N/A
* Usage:    Shows the GO BACK Button and link.
************************************************************************/
function msnl_fShowBtnGoBack() {
	global $msnl_asCSS;
	echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<input type="button" value="' . _MSNL_COM_LAB_GOBACK . '" title="' . _MSNL_COM_LNK_GOBACK . '" '
		. 'onclick="javascript:history.go(-1);" />'
		. '</p>';
}
/************************************************************************
* Function: msnl_fPrintHTML()
* Inputs:   sHTML = The option for which HTML string to print
* Usage:    Echos out the provided HTML based on what is passed to it.
************************************************************************/
function msnl_fPrintHTML($sHTML = '') {
	global $msnl_sModuleNm, $msnl_asCSS, $op;
	switch ($sHTML) {
		case 'BEGIN':
			// Write out the start "TAG" for the module as well as pull in common javascript functions
			echo "\n\n" . '<!-- MSNL_BEGIN: http://montegoscripts.com -->' . "\n\n";
			break;
		case 'END':
			// Write out the ending "TAGS" for the module
			if ($op != 'msnl_copyright_credits') {
				echo '<div id="msnl_div_copyright" ' . $msnl_asCSS['BLOCK_right'] . '>'
					. '<br />'
					. '<a href="modules.php?name=' . $msnl_sModuleNm . '&amp;op=msnl_copyright_credits" '
					. 'title="' . _MSNL_CPY_LNK_VIEWCOPYRIGHT . '">'
					. str_replace('_', ' ', $msnl_sModuleNm) . '&nbsp;&copy;</a>'
					. '<br /><br />'
					. '</div>';
			}
			echo "\n\n" . '<!-- MSNL_END -->' . "\n\n";
			break;
		default:
			echo '';
			break;
	}
}
/************************************************************************
* Function: msnl_fIsViewable()
* Inputs:   view = What category of user was sent the newsletter
*           nsngroups = Whether or not NSN Groups are to be used
*           cid = ??
*           groups = The NSN Groups the user has been given access to
* Usage:    Determines if Newsletter should be viewable to the user.
************************************************************************/
function msnl_fIsViewable($view, $cid, $groups) {
	global $admin, $user, $userinfo, $msnl_gasModCfg;
	// NOTE: only Admins should be allowed to see the first category which is reserved for *Unassigned*
	$viewable = 0;
	if ($cid <> 1 AND $view == 0) { // Anonymous
		$viewable = 1;
	} elseif (is_admin($admin)) { // Administrators should see ALL Newsletters
		$viewable = 1;
	} elseif ($cid <> 1 AND $view == 1 AND is_user($user)) { // Registered User
		$viewable = 1;
	} elseif ($cid <> 1 AND $view == 2 AND is_user($user) AND $userinfo[newsletter] == 1) { // Subscribed (Newsletter) User
		$viewable = 1;
	} elseif ($cid <> 1 AND $view == 3 AND is_user($user) AND paid()) { // Paid subscribers
		$viewable = 1;
	} elseif ($cid <> 1 AND $view == 3 AND is_user($user) AND $msnl_gasModCfg['nsn_groups'] == 1) { // NSN Groups Only
		if (in_groups($groups)) {
			$viewable = 1;
		}
	}
	return $viewable;
}
/************************************************************************
* Function: msnl_fGetBlockRow()
* Inputs:   TBD
* Usage:    Produces the row for the block.
************************************************************************/
function msnl_fGetBlockRow($idx_nl_nbr, $nid, $topic, $sender, $hits, $datesent, $filename) {
	global $msnl_sModuleNm, $msnl_gasModCfg;
	$row = '';
	if (@file_exists('modules/' . $msnl_sModuleNm . '/archive/' . $filename)) { // Produce link only if file exists - avoids error message upon pop-up
		$url = 'modules.php?name=' . $msnl_sModuleNm . '&amp;op=msnl_nls_view&amp;msnl_nid=' . $nid;
		$row .= $idx_nl_nbr . '&nbsp;'
			. '<a href="' . $url . '" title="' . _MSNL_NLS_LNK_VIEWNL . '" '
			. 'onclick="window.open(this.href, \'ViewNewsletter\'); return false">' . $topic;
	} else {
		return $row;
	}
	if ($msnl_gasModCfg['show_hits'] == 1) {
		if ($hits == 1) {
			$row .= ' (' . $hits . ' ' . _MSNL_NLS_LAB_HIT . ')';
		} else {
			$row .= ' (' . $hits . ' ' . _MSNL_NLS_LAB_HITS . ')';
		}
	}
	if ($msnl_gasModCfg['show_dates'] == 1) {
		$sentdate = date('D M d, Y', strtotime($datesent));
		$row .= ' (' . _MSNL_NLS_LAB_SENTON . ': ' . $sentdate . ')';
	}
	if ($msnl_gasModCfg['show_sender'] == 1) {
		$row .= ' (' . _MSNL_NLS_LAB_SENDER . ': ' . $sender . ')';
	}
	$row .= '</a>';
	return $row;
}
/************************************************************************
* Function: msnl_fShowSubTitle
* Inputs:   sTitle = The name of the config sub-menu that was selected
* Usage:    Shows a standard format for the chosen sub-menu.
************************************************************************/
function msnl_fShowSubTitle($sTitle = '') {
	global $msnl_gasModCfg, $msnl_asCSS;
	echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<span class="title">'
		. $sTitle
		. '</span>'
		. '</p>';
}
/************************************************************************
* Function: msnl_fXMLEntities
* Inputs:   $string = the string to be "entified".
* Returns:  string  of only a few characters entified.
************************************************************************/
function msnl_fXMLEntities($string) {
	return htmlspecialchars($string, ENT_QUOTES, _CHARSET);
}
/************************************************************************
* Function: msnl_XMLDecode
* Inputs:   $string = the string to be "decoded".
* Returns:  string  of only a few characters decoded.
* Usage:    This is to undo the result of msnl_fXMLEntities.
************************************************************************/
function msnl_fXMLDecode($string) {
	return htmlspecialchars_decode($string, ENT_QUOTES);
}
/**
 * csrf_check
 * This is simply a stub function for CSRF checking to be consistent across the module.
 * RavenNuke(tm) version 2.4 and above have this as a feature that we wish to take full
 * advantage of, but need the stub for compatibility with other *nuke variants.
 */
if (!function_exists('csrf_check')) {
	function csrf_check() {
		return true;
	}
}
/**
 * tnnlFilter
 *
 * This function was added to bridge a temporary gap between PHP-Nuke and the newer and much
 * more secure RavenNuke(tm) systems.  The old PHP-Nuke check_html() function, even with
 * patches from Chatserv, do not sufficiently handle magic quotes being turned on.
 *
 * @param  string  $value string value to validate
 * @param  string  $strip either 'nohtml' to strip all HTML, or '' to apply the AllowableHTML[] array checks
 * @returns string cleansed input string
 */
function tnnlFilter($value = '', $strip = '') {
	if (empty($value) || ('' != $strip && 'nohtml' != $strip)) return '';
	static $doStrip;
	if (!isset($doStrip)) {
		if (IN_RAVENNUKE) {
			$doStrip = false; // RavenNuke(tm)'s check_html() function will take care of stripping if needed so avoid doing it twice
		} else {
			$doStrip = (get_magic_quotes_gpc() == 1) ? true : false; // If not in RavenNuke(tm) and magic quotes are on, definitely need to strip.
		}
	}
	if ($doStrip || (IN_RAVENNUKE && MSNL_ADMINHTML_OVERRIDE && empty($strip))) $value = stripslashes($value); // See below comment regarding the override
	if (MSNL_ADMINHTML_OVERRIDE && empty($strip)) return $value; // This is set in the module config.php with default of "false" - change there if you want to allow the admin to use ANY HTML in the text body
	if (IN_RAVENNUKE) {
		// RavenNuke(tm)'s check_html() function uses kses, which normalizes certain entities.  We
		// don't want these to be saved to the database.  We'll handle them properly upon output.
		return htmlspecialchars_decode(check_html($value, $strip));
	} else {
		// Regular PHP-Nuke with Chatserv patches does not normalize entities, so we don't have to decode.
		return check_html($value, $strip);
	}
}

