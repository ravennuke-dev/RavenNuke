<?php

/************************************************************************
 Nuke-Evolution: Evolution Functions
 ============================================
 Filename      : gfx.php
 Author        : The Nuke-Evolution Team
 Version       : 1.0.0
 Date          : 10.17.2006 (mm.dd.yyyy)

 Notes         : GFX functions
 ************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

/***************************************************************************
 * RavenNuke76(tm) v2.10.00 Modifications                                  *
 * Raven - 10/19/2006 - Brought up to W3C standard for XHTML               *
 * Montego - 01/20/2007 - Added "Spam Captcha" control by module           *
 ***************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

function security_code($gfxchk, $size='normal', $force=0) {
	global $gfx_chk, $user, $admin;
	if (!GDSUPPORT) return '';
	if (!$force) {
		if (is_array($gfxchk)) { //login check
			if (!in_array($gfx_chk, $gfxchk)) return '';
		} else {
			$gfxchk = intval($gfxchk);
			if ($gfxchk == 0 or is_admin($admin)) return '';
			if (is_user($user) and $gfxchk != 2 and $gfxchk != 3) return '';
			if (!is_user($user) and $gfxchk != 1 and $gfxchk != 3) return '';
		}
	}
	$code = '';
	if (defined('VISUAL_CAPTCHA')) {
		// montego - added this $imgTrick in order to fake FF 3.5.x into thinking each image is different
		// so it won't pull from cache.  If Mozilla ever fixes this issue, we should rip this back out.
		static $imgID;
		if (!isset($imgID)) $imgID = time();
		$imgTrick = '&amp;imgID=' . $imgID;
		switch($size) {
			case 'large':
				$code .= '<tr><td>' . _SECURITYCODE . ':</td><td><img src="images/captcha.php?size=large' . $imgTrick . '" border="0" width="200" height="60" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /></td></tr>';
				$code .= '<tr><td>'._TYPESECCODE . ':</td><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>';
				$code .= "\n";
				break;
			case 'normal':
				$code .= '<tr><td>' . _SECURITYCODE . ':</td></tr><tr><td><img src="images/captcha.php?size=normal' . $imgTrick . '" border="0" width="140" height="60" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /></td></tr>';
				$code .= '<tr><td>'._TYPESECCODE . ':</td></tr><tr><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>';
				$code .= "\n";
				break;
			case 'small':
				$code .= _SECURITYCODE . ': <img src="images/captcha.php?size=small' . $imgTrick . '" border="0" width="100" height="30" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" />';
				$code .= _TYPESECCODE . ': <input type="text" name="gfx_check" size="10" maxlength="10" />';
				$code .= "\n";
				break;
			case 'stacked':
				$code .= _SECURITYCODE . '<br /><img src="images/captcha.php?size=normal' . $imgTrick . '" border="0" width="140" height="60" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /><br />';
				$code .= _TYPESECCODE . ' <br /><input type="text" name="gfx_check" size="10" maxlength="10" />';
				$code .= '<br />';
				break;
			case 'demo':
				$code .= '<img src="images/captcha.php?size=large' . $imgTrick . '" border="0" width="200" height="60" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" />';
				break;
		}
	} else {
		switch($size) {
			case 'large':
				$code .= '<tr><td>' . _SECURITYCODE . ':</td><td><img src="?gfx=gfx" border="0" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /></td></tr>';
				$code .= '<tr><td>'._TYPESECCODE . ':</td><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>';
				break;
			case 'normal':
				$code .= '<tr><td>' . _SECURITYCODE . ':</td></tr><tr><td><img src="?gfx=gfx" border="0" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /></td></tr>';
				$code .= '<tr><td>'._TYPESECCODE . ':</td></tr><tr><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>';
				break;
			case 'small':
				$code .= _SECURITYCODE . ': <img src="?gfx=gfx" border="0" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" />';
				$code .= _TYPESECCODE . ': <input type="text" name="gfx_check" size="10" maxlength="10" />';
				break;
			case 'stacked':
				$code .= _SECURITYCODE . '<br /><img src="?gfx=gfx" border="0" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" /><br />';
				$code .= _TYPESECCODE . ' <br /><input type="text" name="gfx_check" size="10" maxlength="10" />';
				break;
			case 'demo':
				$code .= '<img src="gfx=gfx" border="0" alt="' . _SECURITYCODE . '" title="' . _SECURITYCODE . '" />';
				break;
		}
	}
	return $code;
}

function security_code_check($gfx_code, $gfxchk,  $force=0) {
	global $gfx_chk, $user, $admin, $oVisualCaptcha;
	//If there is no GD then we did not have a code
	if (!GDSUPPORT) {
		return true;
	}
	//Start the session
	if(!isset($_SESSION)) { session_start(); }

	if (!$force) {
		if (is_array($gfxchk)) {  //login check
			if (!in_array($gfx_chk, $gfxchk)) {
				if (isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
				return true;
			}
		} else {
			$passModChk = FALSE;
			$gfxchk = intval($gfxchk);
			if ($gfxchk == 0 or is_admin($admin)) $passModChk = TRUE;
			if (is_user($user) and $gfxchk != 2 and $gfxchk != 3) $passModChk = TRUE;
			if (!is_user($user) and $gfxchk != 1 and $gfxchk != 3) $passModChk = TRUE;
			if ($passModChk) {
				if (isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
				return true;
			}
		}
	}

	if (defined('VISUAL_CAPTCHA')) {
		require_once NUKE_INCLUDE_DIR . 'class.php-captcha.php';
		if (!is_object($oVisualCaptcha) || !($oVisualCaptcha instanceof PhpCaptcha)) {
			$oVisualCaptcha = new PhpCaptcha(array());
		}
		if ($oVisualCaptcha->Validate($gfx_code)) {
			return true;
		} else {
			return false;
		}
	} else {
		//If there is no session
		if(!isset($_SESSION['GFXCHECK'])) {
			return false;
		}
		//If the code and the session code doesnt match
		if ($gfx_code != $_SESSION['GFXCHECK']) {
			unset($_SESSION['GFXCHECK']);
			return false;
		}
		//Unset the session code so it cannot be reused
		unset($_SESSION['GFXCHECK']);

		return true;
	}
}

?>