<?php
/***************************************************************************
 *                                profile.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: profile.php,v 1.193.2.7 2006/04/09 16:17:27 grahamje Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}

if ( isset($_GET['mode']) || isset($_POST['mode']) ) {
	$mode = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
	$mode = htmlspecialchars($mode, ENT_COMPAT);
	if ($mode == 'editprofile') {
		addJSToHead('includes/jquery/jquery.js', 'file');
		addJSToHead('includes/jquery/jquery.colorbox-min.js','file');
		addCSSToHead('includes/jquery/css/colorbox.css','file');
		$inlineJS = '
<script>
	$(document).ready(function(){
		if ($("input[name=\"submit\"]").length != 0 && $("input[name=\"reset\"]").length != 0) {
			$.colorbox({ open:true, inline:true, href:"#ya_warning", width:"600px", height:"300px" }); 
		}
		$("a.close").click(function() {
			$.colorbox.close()
		});
		$("input[name=\"username\"],input[name=\"email\"],input[name=\"cur_password\"],input[name=\"new_password\"],input[name=\"password_confirm\"],input[name=\"confirm_code\"],input[name=\"icq\"],input[name=\"aim\"],input[name=\"msn\"],input[name=\"yim\"],input[name=\"website\"],input[name=\"location\"],input[name=\"occupation\"],input[name=\"interests\"],input[name=\"dateformat\"]").attr("readonly", true);
		$("textarea[name=\"signature\"]").attr("readonly", true);
		$("select[name=\"language\"],select[name=\"style\"],select[name=\"timezone\"]").attr("disabled", true);
		$("input[name=\"viewemail\"],input[name=\"hideonline\"],input[name=\"notifyreply\"],input[name=\"notifypm\"],input[name=\"popup_pm\"],input[name=\"attachsig\"],input[name=\"allowbbcode\"],input[name=\"allowhtml\"],input[name=\"allowsmilies\"]").each(function() {
			if (!this.checked) {
				$(this).attr("disabled", true);
			}
		});
	});
</script>';
		addJSToHead($inlineJS, 'inline');
	}
}

if (!isset($popup) OR ($popup != '1')) {
	$module_name = basename(dirname(__FILE__));
	require_once 'modules/' . $module_name . '/nukebb.php';
} else {
	$phpbb_root_path = 'modules/Forums/';
}

define('IN_PHPBB', true);
include_once $phpbb_root_path . 'extension.inc';
include_once $phpbb_root_path . 'common.' . $phpEx;

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PROFILE, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid'])) {
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
} else {
	$sid = '';
}

//
// Set default email variables
//
$script_name = 'modules.php?name=Forums&file=profile';
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
$server_url = $server_protocol . $server_name . $server_port . $script_name;

// -----------------------
// Page specific functions
//
function gen_rand_string($hash) {
	$rand_str = dss_rand();
	return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
}
//
// End page specific functions
// ---------------------------

//
// Start of program proper
//
if ( isset($_GET['mode']) || isset($_POST['mode']) ) {
	$mode = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
	$mode = htmlspecialchars($mode, ENT_COMPAT);
	if ( $mode == 'viewprofile' ) {
		include_once 'modules/' . $module_name . '/includes/usercp_viewprofile.php';
		exit;
	} else if ( $mode == 'editprofile' || $mode == 'register' ) {
		if ( !$userdata['session_logged_in'] && $mode == 'editprofile' ) {
			$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
			header($header_location . append_sid('login.' . $phpEx . '?redirect=profile.' . $phpEx . '&mode=editprofile', true));
			exit;
		}
		//added for RN 2.4 per manits issue #0000082 
		//redirect to RNYA so forum doesn't edit cor tables.
		//Possably remove when tables are seperated..
		//redirect('modules.php?name=Your_Account&amp;op=edituser');
		include_once 'modules/' . $module_name . '/includes/usercp_register.php';
		exit;
	} else if ( $mode == 'confirm' ) {
		// Visual Confirmation
		if ( $userdata['session_logged_in'] ) {
			exit;
		}
		include_once 'modules/' . $module_name . '/includes/usercp_confirm.' . $phpEx;
		exit;
	} else if ( $mode == 'sendpassword' ) {
		include_once 'modules/' . $module_name . '/includes/usercp_sendpasswd.' . $phpEx;
		exit;
	} else if ( $mode == 'activate' ) {
		include_once 'modules/' . $module_name . '/includes/usercp_activate.' . $phpEx;
		exit;
	} else if ( $mode == 'email' ) {
		include_once 'modules/' . $module_name . '/includes/usercp_email.' . $phpEx;
		exit;
	}
}

redirect(append_sid('index.' . $phpEx, true));

?>