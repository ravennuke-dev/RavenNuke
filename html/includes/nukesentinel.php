<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

define("NUKESENTINEL_IS_LOADED", TRUE);
unset($nsnst_const);
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}


$ab_config = array();
$blocker_array = array();
$blocker_row = array();
$config = array();

//SEE TECHNOCRAT below
define('REGEX_UNION','#\w?\s?union\s\w*?\s?(select|all|distinct|insert|update|drop|delete)#is');
define('REGEX_IPV4', '/^(1?\d{1,2}|2([0-4]\d|5[0-5]))(\.(1?\d{1,2}|2([0-4]\d|5[0-5]))){3}$/'); // A slightly more restrictive IP check to avoid > 255

// define the INCLUDE PATH
if (defined('NUKE_BASE_DIR')) {
	define('NSINCLUDE_PATH', NUKE_BASE_DIR . '/');
} else {
	define('NSINCLUDE_PATH', dirname(__FILE__) . '/');
}

global $ab_config, $admin_file, $nsnst_const, $nuke_config, $remote;

// Load required configs
$ab_config = abget_configs();

// Load required lang file
if(!isset($lang)) { $lang = $nuke_config['language']; }
if(!stristr($lang, '.') AND file_exists(NSINCLUDE_PATH . 'language/nukesentinel/lang-' . $lang . '.php')) {
	require_once NSINCLUDE_PATH . 'language/nukesentinel/lang-' . $lang . '.php';
} else {
	require_once NSINCLUDE_PATH . 'language/nukesentinel/lang-english.php';
}

// NEW Disable Switch
if($ab_config['disable_switch'] > 0) { return; }

// Load constant vars
//Do not move these around as there are dependencies
$nsnst_const['server_ip'] = get_server_ip();
if(!preg_match(REGEX_IPV4, $nsnst_const['server_ip'])) { $nsnst_const['server_ip'] = 'none'; }
$nsnst_const['client_ip'] = get_client_ip();
if(!preg_match(REGEX_IPV4, $nsnst_const['client_ip'])) { $nsnst_const['client_ip'] = 'none'; }
$nsnst_const['forward_ip'] = get_x_forwarded();
if(!preg_match(REGEX_IPV4, $nsnst_const['forward_ip'])) { $nsnst_const['forward_ip'] = 'none'; }
$nsnst_const['remote_addr'] = get_remote_addr();
if(!preg_match(REGEX_IPV4, $nsnst_const['remote_addr'])) { $nsnst_const['remote_addr'] = 'none'; }
$nsnst_const['remote_ip'] = get_ip();
if(!preg_match(REGEX_IPV4, $nsnst_const['remote_ip'])) { $nsnst_const['remote_ip'] = "none"; }
$nsnst_const['remote_long'] = sprintf('%u', ip2long($nsnst_const['remote_ip']));
$nsnst_const['remote_port'] = get_remote_port();
$nsnst_const['request_method'] = get_request_method();
$nsnst_const['script_name'] = get_script_name();
$nsnst_const['http_host'] = get_http_host();
$nsnst_const['query_string'] = st_clean_string(get_query_string());
$nsnst_const['get_string'] = st_clean_string(get_get_string());
$nsnst_const['post_string'] = st_clean_string(get_post_string());
$nsnst_const['query_string_base64'] = st_clean_string(base64_decode($nsnst_const['query_string']));
$nsnst_const['get_string_base64'] = st_clean_string(base64_decode($nsnst_const['get_string']));
$nsnst_const['post_string_base64'] = st_clean_string(base64_decode($nsnst_const['post_string']));
$nsnst_const['user_agent'] = get_user_agent();
$nsnst_const['referer'] = get_referer();
$nsnst_const['ban_time'] = time();
$nsnst_const['ban_ip'] = '';
if (isset($_COOKIE['user'])) $uinfo = getusrinfo($_COOKIE['user']); else $uinfo = getusrinfo('');
if(is_array($uinfo) && $uinfo['user_id'] > 1 && !empty($uinfo['username'])) {
	$nsnst_const['ban_user_id'] = $uinfo['user_id'];
	$nsnst_const['ban_username'] = $uinfo['username'];
} else {
	$nsnst_const['ban_user_id'] = 1;
	$nsnst_const['ban_username'] = $nuke_config['anonymous'];
}

// Load Blocker Arrays
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blockers` ORDER BY `blocker`');
$num_rows = $db->sql_numrows($result);
for ($i = 0; $i < $num_rows; $i++) { $blocker_array[$i] = $db->sql_fetchrow($result); }
$db->sql_freeresult($result);

// Check for Flood Attack
// CAUTION: This function sometimes can slow your sites load time
$blocker_row = @$blocker_array[11];
if($blocker_row['activate'] > 0) {
	session_start();
	//session_name("NSNST_Flood");
	if(!isset($_SESSION['NSNST_Flood'])){
		$_SESSION['NSNST_Flood'] = time();
		ab_flood($blocker_row);
	}else{
		ab_flood($blocker_row);
		$_SESSION['NSNST_Flood'] = time();
	}
	//session_write_close();
}

// Invalid admin check
if(!empty($aid) AND empty($_COOKIE['admin']) AND $op != 'login') { die(_AB_FALSEADMIN); }

// Stop Santy Worm
if($ab_config['santy_protection'] == 1) {
	$bad_uri_content=array('rush', 'highlight=%', 'perl', 'chr(', 'pillar', 'visualcoder', 'sess_');
	foreach($bad_uri_content as $stid => $uri_content) {
		if(stristr($_SERVER['REQUEST_URI'], $uri_content)) { die(_AB_SANTY); }
	}
}

// Invalid ip check
if ( $ab_config['test_switch'] == 1) {;} //Site is in TEST Mode so skip the ipCheck
elseif (isset($bypassNukeSentinelInvalidIPCheck) AND $bypassNukeSentinelInvalidIPCheck===true) {;} //Site is NOT in TEST mode but $bypassNukeSentinelInvalidIPCheck is set to TRUE so skip the ipCheck
else { //Site is NOT in TEST Mode and $bypassNukeSentinelInvalidIPCheck is either not set or it is set to FALSE so do the ipCheck
	if($nsnst_const['remote_ip'] == 'none') {
		echo abget_template('abuse_invalid.tpl');
		die();
  }
}

// Invalid user agent
if(($nsnst_const['user_agent'] == 'none' AND !stristr($_SERVER['PHP_SELF'], 'backend.php') AND ($nsnst_const['remote_ip'] != $nsnst_const['server_ip'])) || $nsnst_const['user_agent'] == '-') {
	echo abget_template('abuse_invalid2.tpl');
	die();
}

// Invalid request method check
if(strtolower($nsnst_const['request_method']) != 'get' AND strtolower( $nsnst_const['request_method']) != 'head' AND strtolower( $nsnst_const['request_method']) != 'post'
	AND strtolower( $nsnst_const['request_method']) != 'put') { die(_AB_INVALIDMETHOD); }

// DOS Attack Blocker
if( $ab_config['prevent_dos'] == 1 AND !stristr($_SERVER['PHP_SELF'], 'backend.php') AND !stristr( $nuke_config['nukeurl'], $_SERVER['SERVER_NAME'])) {
	if( empty($nsnst_const['user_agent']) || $nsnst_const['user_agent'] == '-' ||  !isset($nsnst_const['user_agent'])) { die(_AB_GETOUT); }
}

// Site Switch Check
if( $ab_config['site_switch'] == 1 AND !stristr($_SERVER['PHP_SELF'], $admin_file . '.php') AND !is_admin($_COOKIE['admin'])) {
	$display_page = abget_template($ab_config['site_reason']);
	$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . '</div>' . "\n" . '</body>', $display_page);
	die($display_page);
}

// Clearing of expired blocks
// CAUTION: This function can slow your sites load time
$clearedtime = strtotime(date('Y-m-d 23:59:59', $nsnst_const['ban_time']));
$cleartime = strtotime(date('Y-m-d 23:59:59', $nsnst_const['ban_time'])) - 86400;
if( $ab_config['self_expire'] == 1 AND $ab_config['blocked_clear'] < $clearedtime) {

	// check if minimum one blocker configured for save in htaccess file
	$htnum = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blockers` WHERE `htaccess`!="0" '));

	// if the value are 0, there is no need to optimize the tables
	$optimize_blocked_ips = 0;
	$optimize_blocked_ranges = 0;

	$clearresult = $db->sql_query('SELECT * FROM `' . $prefix. '_nsnst_blocked_ips` WHERE (`expires` < "' . $clearedtime . '" AND `expires`!="0")');
	while($clearblock = $db->sql_fetchrow($clearresult)) {
		if(!empty($ab_config['htaccess_path']) AND $htnum > 0) {
			$ipfile = file($ab_config['htaccess_path']);
			$ipfile = implode('', $ipfile);
			$i = 1;
			while ($i <= 3) {
				$tip = substr($clearblock['ip_addr'], -2);
				if($tip == '.*') { $clearblock['ip_addr'] = substr($clearblock['ip_addr'], 0, -2); }
				$i++;
			}
			$testip = 'deny from ' . $clearblock['ip_addr'] . "\n";
			$ipfile = str_replace($testip, '', $ipfile);
			$doit = @fopen($ab_config['htaccess_path'], 'w');
			@fwrite($doit, $ipfile);
			@fclose($doit);
			// count the records, to the check if the table should be optimized
			$optimize_blocked_ips++;
		}
		$db->sql_query('DELETE FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr`="' . $clearblock['ip_addr'] . '"');
		#$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsnst_blocked_ips`');
	}
	if ($optimize_blocked_ips > 0) {
		$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsnst_blocked_ips`');
	}

	$clearresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ranges` WHERE (`expires`<"' . $clearedtime . '" AND `expires`!="0")');
	while($clearblock = $db->sql_fetchrow($clearresult)) {
		$old_masscidr = ABGetCIDRs($clearblock['ip_lo'], $clearblock['ip_hi']);
		if(!empty($ab_config['htaccess_path']) AND $htnum > 0) {
			$old_masscidr = explode('||', $old_masscidr);
			for ($i=0, $maxi=sizeof($old_masscidr); $i < $maxi; $i++) {
				if(!empty($old_masscidr[$i])) {
					$old_masscidr[$i] = 'deny from ' . $old_masscidr[$i] . "\n";
				}
			}
			$ipfile = file($ab_config['htaccess_path']);
			$ipfile = implode('', $ipfile);
			$ipfile = str_replace($old_masscidr, '', $ipfile);
			$ipfile = $ipfile;
			$doit = @fopen($ab_config['htaccess_path'], 'w');
			@fwrite($doit, $ipfile);
			@fclose($doit);
			// count the records, to the check if the table should be optimized
			$optimize_blocked_ranges++;
		}
		$db->sql_query('DELETE FROM `' . $prefix . '_nsnst_blocked_ranges` WHERE `ip_lo`="' . $clearblock['ip_lo'] . '" AND `ip_hi`="' . $clearblock['ip_hi'] . '"');
		#$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsnst_blocked_ranges`');
	}
	if ($optimize_blocked_ranges > 0) {
		$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsnst_blocked_ranges`');
	}
	$db->sql_query('UPDATE `' . $prefix . '_nsnst_config` SET `config_value`="' . $clearedtime . '" WHERE `config_name`="blocked_clear"');
}

// Proxy Blocker
if( $ab_config['proxy_switch'] == 1) {
	$proxy0 = $nsnst_const['remote_ip'];
	$proxy1 = $nsnst_const['client_ip'];
	$proxy2 = $nsnst_const['forward_ip'];
	$proxy_host = @getHostByAddr($proxy0);
	//Lite:
	if($ab_config['proxy_switch'] == 1 AND ($proxy1 != 'none' OR $proxy2 != 'none')) {
		$display_page = abget_template($ab_config['proxy_reason']);
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number']
						. ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	}
	//Mild:
	if($ab_config['proxy_switch'] == 2 AND ($proxy1 != "none" OR $proxy2 != 'none' OR stristr($proxy_host, 'proxy'))) {
		$display_page = abget_template($ab_config['proxy_reason']);
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number']
						. ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	}
	//Strong:
	if($ab_config['proxy_switch'] == 3 AND ($proxy1 != 'none' OR $proxy2 != 'none' OR stristr($proxy_host, 'proxy') OR $proxy0 == $proxy_host)) {
		$display_page = abget_template($ab_config['proxy_reason']);
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number']
						. ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	}
}

// Check if ip is blocked
$blocked_row = abget_blocked($nsnst_const['remote_ip']);
if($blocked_row) { blocked($blocked_row); }

// Check if range is blocked
$blockedrange_row = abget_blockedrange($nsnst_const['remote_ip']);
if($blockedrange_row) { blockedrange($blockedrange_row); }

// AUTHOR Protection
$blocker_row = @$blocker_array[5];
if($blocker_row['activate'] > 0) {
	if(isset($op) AND ($op == 'mod_authors' OR $op == 'modifyadmin' OR $op == 'UpdateAuthor' OR $op == 'AddAuthor' OR $op == 'deladmin2' OR $op == 'deladmin'
					OR $op == 'assignstories' OR $op == 'deladminconf') AND !is_god()) {
		block_ip($blocker_row);
	}
} else {
	if(isset($op) AND ($op == 'mod_authors' OR $op == 'modifyadmin' OR $op == 'UpdateAuthor' OR $op == 'AddAuthor' OR $op == 'deladmin2' OR $op == 'deladmin'
					OR $op == 'assignstories' OR $op == 'deladminconf') AND !is_god()) {
		header('Location: ../' . $admin_file . '.php');
	}
}

// ADMIN protection
$blocker_row = @$blocker_array[10];
if($blocker_row['activate'] > 0) {
	if(stristr($_SERVER['PHP_SELF'], $admin_file . '.php') AND (isset($op) AND $op != 'login' AND $op != 'adminMain' AND $op != 'gfx') AND @!is_admin($_COOKIE['admin'])) {
		block_ip($blocker_row);
	}
} else {
	if(stristr($_SERVER['PHP_SELF'], $admin_file . '.php') AND (isset($op) AND $op != 'login' AND $op != 'adminMain' AND $op != 'gfx') AND @!is_admin($_COOKIE['admin'])) {
		header('Location: ../' . $admin_file . '.php');
	}
}

// Check for UNION attack
// Copyright 2004(c) Raven PHP Scripts
$blocker_row = @$blocker_array[1];
if($blocker_row['activate'] > 0 AND (!isset($_COOKIE['admin']) OR !is_admin($_COOKIE['admin']))) {
	if(stristr($nsnst_const['query_string'], '+or+') OR stristr($nsnst_const['query_string'], '*/or/*') OR stristr($nsnst_const['query_string_base64'], '+or+') OR stristr($nsnst_const['query_string_base64'], '*/or/*')) {
		block_ip($blocker_row);
	}
	//TECHNOCRAT
	if(preg_match(REGEX_UNION, $nsnst_const['query_string'])) {
		block_ip($blocker_row);
	}
}

// Check for CLIKE attack
// Copyright 2004(c) Raven PHP Scripts
$blocker_row = @$blocker_array[2];
if($blocker_row['activate'] > 0) {
	if(stristr($nsnst_const['query_string'], '/*') OR stristr($nsnst_const['query_string_base64'], '/*') OR stristr($nsnst_const['query_string'], '*/') OR stristr($nsnst_const['query_string_base64'], '*/')) {
		block_ip($blocker_row);
	}
}

// Check Filters
$blocker_row = @$blocker_array[7];
if($blocker_row['activate'] > 0) {
	// Check for Forum attack
	// Copyright 2004(c) GanjaUK & ChatServ
	if(!stristr($nsnst_const['query_string'], '&file=nickpage') AND stristr($nsnst_const['query_string'], '&user=') AND ($name == 'Private_Messages' || $name == 'Forums' || $name == 'Members_List')) {
		block_ip($blocker_row);
	}
	// Check for News attack
	// Copyright 2004(c) ChatServ
	if(stristr($nsnst_const['query_string'], '%25') AND ($name == 'News' || $name == 'Reviews')) {
		block_ip($blocker_row);
	}
	// Check for XSS attack
	if(!stristr($nsnst_const['query_string'], 'index.php?url=') AND (!isset($_COOKIE['admin']) OR !is_admin($_COOKIE['admin']))) {
		if( (isset($name) AND (stristr($name, 'http://') OR stristr($name, 'https://')))
		OR (isset($file) AND (stristr($file, 'http://') OR stristr($file, 'https://')))
		OR (isset($libpath) AND (stristr($libpath, 'http://') OR stristr($libpath, 'https://')))
		OR stristr($nsnst_const['query_string'], 'http://') OR stristr($nsnst_const['query_string'], 'https://')
		OR stristr($nsnst_const['query_string'], '_SERVER=') OR stristr($nsnst_const['query_string'], '_COOKIE=')
		OR ( stristr($nsnst_const['query_string'], 'cmd=') AND !stristr($nsnst_const['query_string'], '&cmd') )
		OR ( stristr($nsnst_const['query_string'], 'exec') AND !stristr($nsnst_const['query_string'], 'execu') )
		OR stristr($nsnst_const['query_string'], 'concat') AND !stristr($nsnst_const['query_string'], '../') ) {
			block_ip($blocker_row);
		}
	}
}

if (@is_admin($_COOKIE['admin'])==false) {
	// Check for SCRIPTING attack
	// Copyright 2004(c) ChatServ
	$blocker_row = @$blocker_array[4];
	if($blocker_row['activate'] > 0) {
		var_scripting_recursive($_GET, 'get', $blocker_row);
		// BEGIN - Added by Raven 11/19/2007 to exclude Forums and Private_Message Posting blocks
		$qs = $nsnst_const['query_string'];
		$qsName = explode('name=', $qs);
		$qsName = @explode('&', $qsName[1]);
		if (stristr($qs,'name=Forums') !== false && stristr($qs, 'file=posting')!== false && (strtolower($qsName[0]) == 'private_messages' || strtolower($qsName[0]) == 'forums')) {
			// The following code is strictly for testing purposes.
			// Uncomment the lines and change the 2 email address calls (you@your_domain.xxx) in the mail function call to your address to see the posts that are being allowed.
			// Otherwise this code should not be used.
			//$psValue = empty($nsnst_const['post_string']) ? 'None' : htmlspecialchars($nsnst_const['post_string'], ENT_QUOTES, _CHARSET);
			//if ($psValue!=='None' && stristr($psValue,'&amp;post=Submit')!==false) @mail('you@your_domain.xxx','NS Script Blocker Activated - Trapped',"name = $name \n module_name = $module_name \n qs = $qs \n qsName[0] = ".$qsName[0]."\n qsName[1] = ".$qsName[1]."\n\n psValue = $psValue \n","From: you@your_domain.xxx\r\nX-Mailer: "._AB_NUKESENTINEL);
		} else {
			// END - Added by Raven 11/19/2007 to exclude Forums and Private_Message Posting blocks
			var_scripting_recursive($_POST, 'post', $blocker_row);
		}
	}
}

function var_scripting_recursive($array, $type, $blocker_row) {
	foreach ($array as $sec_key => $secvalue) {
		if (is_array($secvalue)) {
			var_scripting_recursive($secvalue, $type, $blocker_row);
		} else {
			if ($type == 'get') {
				if((preg_match('/<[^>]script*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*object*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*iframe*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*applet*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*meta*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]style*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*form*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*img*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]*onmouseover*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/<[^>]body*\"?[^>]*>/i', $secvalue) && !preg_match('/<[^>]tbody*\"?[^>]*>/i', $secvalue)) ||
				(preg_match('/\([^>]*\"?[^)]*\)/i', $secvalue)) ||
				(strstr($secvalue, '\"')) ||
				(stristr($sec_key, 'forum_admin')) ||
				(stristr($sec_key, 'inside_mod'))) {
					block_ip($blocker_row);
				}
			}
			if ($type == 'post'){
				if(( preg_match('/<[^>]*iframe*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]*object*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]*applet*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]*meta*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]*onmouseover*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]script*\"?[^>]*/i', $secvalue)) ||
				( preg_match('/<[^>]body*\"?[^>]*>/i', $secvalue) && !preg_match('/<[^>]tbody*\"?[^>]*>/i', $secvalue)) ||
				( preg_match('/<[^>]style*\"?[^>]*/i', $secvalue))) {
					block_ip($blocker_row);
				}
			}
		}
	}
}

// Check for Referer
$blocker_row = @$blocker_array[6];
if($blocker_row['activate'] > 0) {
	if($ab_config['list_referer'] > '') {
		$RefererList = explode("\r\n", $ab_config['list_referer']);
		for ($i=0, $maxi=count($RefererList); $i < $maxi; $i++) {
			$refered = $RefererList[$i];
			if(!empty($refered) AND stristr($nsnst_const['referer'], $refered)) {
				block_ip($blocker_row, $refered);
			}
		}
	}
}

// Check for Harvester
$blocker_row = @$blocker_array[3];
if($blocker_row['activate'] > 0) {
	if($ab_config['list_harvester'] > '') {
		$HarvesterList = explode("\r\n", $ab_config['list_harvester']);
		for ($i=0, $maxi=count($HarvesterList); $i < $maxi; $i++) {
			$harvest = $HarvesterList[$i];
			if(!empty($harvest) AND stristr($nsnst_const['user_agent'], $harvest)) {
				block_ip($blocker_row, $harvest);
			}
		}
	}
}

// Check for Strings
$blocker_row = @$blocker_array[9];
if($blocker_row['activate'] > 0) {
	if($ab_config['list_string'] > '') {
		$StringList = explode("\r\n", $ab_config['list_string']);
		for ($i=0, $maxi=count($StringList); $i < $maxi; $i++) {
			$stringl = $StringList[$i];
			if(!empty($stringl) AND stristr($nsnst_const['query_string'], $stringl) OR stristr($nsnst_const['get_string'], $stringl) OR stristr($nsnst_const['post_string'], $stringl)) {
				block_ip($blocker_row, $stringl);
			}
		}
	}
}

// Check for Request
$blocker_row = @$blocker_array[8];
if($blocker_row['activate'] > 0) {
	if($blocker_row['list'] > "") {
		$RequestList = explode("\r\n",$blocker_row['list']);
		for ($i=0, $maxi=count($RequestList); $i < $maxi; $i++) {
			$request = $RequestList[$i];
			if(!empty($request) AND stristr($nsnst_const['request_method'], $request)) {
				block_ip($blocker_row, $request);
			}
		}
	}
}

// Force to NUKEURL
if( $ab_config['force_nukeurl'] == 1 AND !stristr($_SERVER['PHP_SELF'], 'backend.php')) {
	$servtemp1 = strtolower(str_replace('http://', '', $nuke_config['nukeurl']));
	if(substr($servtemp1, -1) == '/') { $servtemp1 = substr($servtemp1, 0, strlen($servtemp1) - 1); }
	$servrqst1 = strtolower($_SERVER['HTTP_HOST']);
	$pos = strpos($servtemp1, '/');
	if($pos){ $servtemp1 = substr($servtemp1,0,$pos); }
	if($servrqst1 != $servtemp1 AND (!stristr($_SERVER['REQUEST_URI'], 'modules/Forums/admin/') AND !stristr($_SERVER['REQUEST_URI'], 'abuse/'))) {
		$rphp1 = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$rphp2 = str_replace($servrqst1, $servtemp1, $rphp1);
		$rphp2 = 'http://' . $rphp2;
		header('Location: ' . $rphp2);
	}
}

// IP Tracking
// CAUTION: This function can slow your sites load time
if( $ab_config['track_active'] == 1 AND !is_excluded($nsnst_const['remote_ip'])) {
	if(!empty($nsnst_const['post_string']) && $nsnst_const['post_string'] != 'none') {
		$pg = $nsnst_const['post_string'];
		$mod_check = 0;
		if (isset($name) && !preg_match('/^name=' . $name . '/i', $pg) && stristr($nsnst_const['script_name'], 'modules.php')) { $mod_check = 1; }
		if($mod_check == 1) { $mod_check = 'name=' . $name . '&'; } else { $mod_check = ''; }
		$pg = $mod_check . $pg;
		$pg = preg_replace('/&(password|user_password|upassword|pass|upass|user_pass|vpass|pwd|new_pass|name)2?(confirm)?(_confirm)?=\w*/i', '', $pg);
		$pg = $nsnst_const['script_name'] . '?' . $pg;
	} elseif(!empty($nsnst_const['get_string']) && $nsnst_const['get_string'] != 'none') {
		$pg = $nsnst_const['get_string'];
		$mod_check = 0;
		if (isset($name) && !preg_match('/^name=' . $name . '/i', $pg) && stristr($nsnst_const['script_name'], 'modules.php')) { $mod_check = 1; }
		if($mod_check == 1) { $mod_check = 'name=' . $name . '&'; } else { $mod_check = ''; }
		$pg = $mod_check . $pg;
		$pg = preg_replace('/&(password|user_password|upassword|pass|upass|user_pass|vpass|pwd|new_pass|name)2?(confirm)?(_confirm)?=\w*/i', '', $pg);
		$pg = $nsnst_const['script_name'] . '?' . $pg;
	} elseif(!empty($nsnst_const['query_string']) && $nsnst_const['query_string'] != 'none') {
		$pg = $nsnst_const['query_string'];
		$mod_check = 0;
		if (isset($name) && !preg_match('/^name=' . $name . '/i', $pg) && stristr($nsnst_const['script_name'], 'modules.php')) { $mod_check = 1; }
		if($mod_check == 1) { $mod_check = 'name=' . $name . '&'; } else { $mod_check = ''; }
		$pg = $mod_check . $pg;
		$pg = preg_replace('/&(password|user_password|upassword|pass|upass|user_pass|vpass|pwd|new_pass|name)2?(confirm)?(_confirm)?=\w*/i', '', $pg);
		$pg = $nsnst_const['script_name'] . '?' . $pg;
	} else {
		$pg = $nsnst_const['script_name'];
	}
	if($pg != '/backend.php' AND $pg != '/modules.php' AND !stristr($pg, 'op=gfx') AND !stristr($pg, 'gfx=gfx') AND !stristr($pg, 'gfx=gfx_little')) {
		$c2c = '';
		$tresult = $db->sql_query('SELECT `c2c` FROM `' . $prefix . '_nsnst_ip2country` WHERE `ip_lo`<="' . $nsnst_const['remote_long'] . '" AND `ip_hi`>="' . $nsnst_const['remote_long'] . '" LIMIT 0,1');
		$checkrow = $db->sql_numrows($tresult);
		if($checkrow > 0) {
			list($c2c) = $db->sql_fetchrow($tresult);
		}
		if(!$c2c) { $c2c = '00'; }
		if($nsnst_const['ban_user_id'] == 1) { $nsnst_const['ban_username2'] = ''; } else { $nsnst_const['ban_username2'] = $nsnst_const['ban_username']; }
		$refered_from = htmlentities($nsnst_const['referer']);
		if(!@get_magic_quotes_runtime()) {
			$ban_username2 = addslashes($nsnst_const['ban_username2']);
			$user_agent = addslashes($nsnst_const['user_agent']);
			$pg = addslashes($pg);
			$refered_from = addslashes($refered_from);
		}
		$db->sql_query('INSERT INTO `' . $prefix . '_nsnst_tracked_ips` (`user_id`, `username`, `date`, `ip_addr`, `ip_long`, `page`, `user_agent`, `refered_from`, `x_forward_for`, `client_ip`, `remote_addr`, `remote_port`, `request_method`, `c2c`) VALUES ("' . addslashes($nsnst_const['ban_user_id']) . '", "' . $ban_username2 . '", "' . addslashes($nsnst_const['ban_time']) . '", "' . addslashes($nsnst_const['remote_ip']) . '", "' . addslashes($nsnst_const['remote_long']) .'", "' . $pg . '", "' . $user_agent . '", "' . $refered_from . '", "' . addslashes($nsnst_const['forward_ip']) . '", "' . addslashes($nsnst_const['client_ip']) . '", "' . addslashes($nsnst_const['remote_addr']) . '", "' . addslashes($nsnst_const['remote_port']) . '", "' . addslashes($nsnst_const['request_method']) . '", "' . $c2c . '")');
		$clearedtime = strtotime(date('Y-m-d', $nsnst_const['ban_time']));
		$cleartime = strtotime(date('Y-m-d', $nsnst_const['ban_time']));
		if($ab_config['track_max'] > 0 AND $ab_config['track_clear'] < $cleartime) {
			$ab_config['track_del'] = $cleartime - $ab_config['track_max'];
			$db->sql_query('DELETE FROM `' . $prefix . '_nsnst_tracked_ips` WHERE `date` < ' . $ab_config['track_del']);
			$db->sql_query('UPDATE `' . $prefix . '_nsnst_config` SET `config_value`="' . $clearedtime . '" WHERE `config_name`="track_clear"');
			$db->sql_query('OPTIMIZE TABLE `' . $prefix . '_nsnst_tracked_ips`');
		}
	}
}

/*******************************/
/* BEGIN FUNCTIONS             */
/*******************************/

function get_env($st_var) {
	global $HTTP_SERVER_VARS;
	if(isset($_SERVER[$st_var])) {
		return $_SERVER[$st_var];
	} elseif(isset($_ENV[$st_var])) {
		return $_ENV[$st_var];
	} elseif(isset($HTTP_SERVER_VARS[$st_var])) {
		return $HTTP_SERVER_VARS[$st_var];
	} elseif(getenv($st_var)) {
		return getenv($st_var);
	} elseif(function_exists('apache_getenv') && apache_getenv($st_var, true)) {
		return apache_getenv($st_var, true);
	}
	return '';
}

function get_remote_port() {
	if(get_env('REMOTE_PORT')) {
		return get_env('REMOTE_PORT');
	}
	return 'none';
}

function get_request_method() {
	if(get_env('REQUEST_METHOD')) {
		return get_env('REQUEST_METHOD');
	}
	return 'none';
}

function get_script_name() {
	if(get_env('SCRIPT_NAME')) {
		return get_env('SCRIPT_NAME');
	}
	return 'none';
}

function get_http_host() {
	if(get_env('HTTP_HOST')) {
		return get_env('HTTP_HOST');
	}
	return 'none';
}

function get_query_string() {
	if(get_env('QUERY_STRING')) {
		return str_replace("%09", "%20", get_env('QUERY_STRING'));
	}
	return '';
}

// Copyright 2004(c) Raven PHP Scripts
function st_clean_string($cleanstring) {
	$st_fr1 = array("%00", "%01", "%02", "%03", "%04", "%05", "%06", "%07", "%08", "%09", "%10", "%11", "%12", "%13", "%14", "%15", "%16", "%17", "%18", "%19", "%20", "%21", "%22", "%23", "%24", "%25", "%26", "%27", "%28", "%29", "%30", "%31", "%32", "%33", "%34", "%35", "%36", "%37", "%38", "%39", "%40", "%41", "%42", "%43", "%44", "%45", "%46", "%47", "%48", "%49", "%50", "%51", "%52", "%53", "%54", "%55", "%56", "%57", "%58", "%59", "%60", "%61", "%62", "%63", "%64", "%65", "%66", "%67", "%68", "%69", "%70", "%71", "%72", "%73", "%74", "%75", "%76", "%77", "%78", "%79");
	$st_to1 = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", " ", "!", "\"", "#", "$", "%", "&", "'", "(", ")", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "@", "A", "B", "C", "D", "E", "F", "G", "H", "I", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "`", "a", "b", "c", "d", "e", "f", "g", "h", "i", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y");
	$st_fr2 = array("%0A", "%0B", "%0C", "%0D", "%0E", "%0F", "%1A", "%1B", "%1C", "%1D", "%1E", "%1F", "%2A", "%2B", "%2C", "%2D", "%2E", "%2F", "%3A", "%3B", "%3C", "%3D", "%3E", "%3F", "%4A", "%4B", "%4C", "%4D", "%4E", "%4F", "%5A", "%5B", "%5C", "%5D", "%5E", "%5F", "%6A", "%6B", "%6C", "%6D", "%6E", "%6F", "%7A", "%7B", "%7C", "%7D", "%7E", "%7F", "%0a", "%0b", "%0c", "%0d", "%0e", "%0f", "%1a", "%1b", "%1c", "%1d", "%1e", "%1f", "%2a", "%2b", "%2c", "%2d", "%2e", "%2f", "%3a", "%3b", "%3c", "%3d", "%3e", "%3f", "%4a", "%4b", "%4c", "%4d", "%4e", "%4f", "%5a", "%5b", "%5c", "%5d", "%5e", "%5f", "%6a", "%6b", "%6c", "%6d", "%6e", "%6f", "%7a", "%7b", "%7c", "%7d", "%7e", "%7f");
	$st_to2 = array("", "", "", "", "", "", "", "", "", "", "", "", "*", "+", ",", "-", ".", "/", ":", ";", "<", "=", ">", "?", "J", "K", "L", "M", "N", "O", "Z", "[", "\\", "]", "^", "_", "j", "k", "l", "m", "n", "o", "z", "{", "|", "}", "~", "", "", "", "", "", "", "", "", "", "", "", "", "", "*", "+", ",", "-", ".", "/", ":", ";", "<", "=", ">", "?", "J", "K", "L", "M", "N", "O", "Z", "[", "\\", "]", "^", "_", "j", "k", "l", "m", "n", "o", "z", "{", "|", "}", "~", "");
	$cleanstring = str_replace($st_fr1, $st_to1, $cleanstring);
	$cleanstring = str_replace($st_fr2, $st_to2, $cleanstring);
	return $cleanstring;
}

function get_get_string() {
	global $HTTP_GET_VARS;
	$getstring = '';
	if(isset($_GET)) {
		$ST_GET = $_GET;
	} elseif(isset($HTTP_GET_VARS)) {
		$ST_GET = $HTTP_GET_VARS;
	} elseif(getenv('GET')) {
		$ST_GET = getenv('GET');
	} elseif(function_exists('apache_getenv') && apache_getenv('GET', true)) {
		$ST_GET = apache_getenv('GET', true);
	} else {
		$ST_GET = '';
	}
	$getstring = http_build_query($ST_GET);
	if(!empty($getstring)) {
		$getstring = '&' . $getstring;
	}
	return str_replace("%09", "%20", $getstring);
}

function get_post_string() {
	global $HTTP_POST_VARS;
	$poststring = '';
	if(isset($_POST)) {
		$ST_POST = $_POST;
	} elseif(isset($HTTP_POST_VARS)) {
		$ST_POST = $HTTP_POST_VARS;
	} elseif(getenv('POST')) {
		$ST_POST = getenv('POST');
	} elseif(function_exists('apache_getenv') && apache_getenv('POST', true)) {
		$ST_POST = apache_getenv('POST', true);
	} else {
		$ST_POST = '';
	}
	$poststring = http_build_query($ST_POST);
	if(!empty($poststring)) {
		$poststring = '&' . $poststring;
	}
	return str_replace("%09", "%20", $poststring);
}

if (!function_exists('http_build_query')) {
	function http_build_query($data, $prefix='', $sep='&', $key='') {
		$ret = array();
		foreach ((array)$data as $k => $v) {
			if (is_int($k) && $prefix != null) {
				$k = urlencode($prefix . $k);
			}
			if ((!empty($key)) || ($key === 0)) {
				$k = $key . '[' . urlencode($k) . ']';
			}
			if (is_array($v) || is_object($v)) {
				array_push($ret, http_build_query($v, '', $sep, $k));
			} else {
				array_push($ret, $k . '=' . urlencode($v));
			}
		}
		if (empty($sep)) $sep = ini_get('arg_separator.output');
		return implode($sep, $ret);
	}
}

function get_user_agent() {
	if(get_env('HTTP_USER_AGENT')) {
		return get_env('HTTP_USER_AGENT');
	}
	return 'none';
}

function get_referer() {
	global $nuke_config;
	if(get_env('HTTP_REFERER')) {
	 if(stristr(get_env('HTTP_REFERER'), $nuke_config['nukeurl'])) {
		return 'on site';
	} elseif(stristr(get_env('HTTP_REFERER'), 'http://localhost') || stristr(get_env('HTTP_REFERER'), 'http://127.0.') || stristr(get_env('HTTP_REFERER'), 'http://192.168.') || stristr(get_env('HTTP_REFERER'), 'http://10.') || stristr(get_env('HTTP_REFERER'), 'file://')) {
			return 'local link';
		}
		return get_env('HTTP_REFERER');
	}
	return 'none';
}

function get_ip() {
	global $nsnst_const;
	if($nsnst_const['client_ip'] != 'none' AND !is_reserved($nsnst_const['client_ip'])) {
		$ipaddr = $nsnst_const['client_ip'];
	} else if($nsnst_const['forward_ip'] != 'none' AND !is_reserved($nsnst_const['forward_ip'])) {
		$ipaddr = $nsnst_const['forward_ip'];
	} else if($nsnst_const['remote_addr'] != 'none' AND !is_reserved($nsnst_const['remote_addr'])) {
		$ipaddr = $nsnst_const['remote_addr'];
	} else {
		$ipaddr = 'none';
	}
	return($ipaddr);
}

function get_server_ip () {
	if(get_env('SERVER_ADDR')) {
		return get_env('SERVER_ADDR');
	}
	return 'none';
}

function get_client_ip () {
	if(get_env('HTTP_CLIENT_IP')) {
		return get_env('HTTP_CLIENT_IP');
	} elseif(get_env('HTTP_VIA')) {
		return get_env('HTTP_VIA');
	} elseif(get_env('HTTP_X_COMING_FROM')) {
		return get_env('HTTP_X_COMING_FROM');
	} elseif(get_env('HTTP_COMING_FROM')) {
		return get_env('HTTP_COMING_FROM');
	} else {
		return 'none';
	}
}

function get_x_forwarded () {
	if(get_env('HTTP_X_FORWARDED_FOR')) {
		return get_env('HTTP_X_FORWARDED_FOR');
	} elseif(get_env('HTTP_X_FORWARDED')) {
		return get_env('HTTP_X_FORWARDED');
	} elseif(get_env('HTTP_FORWARDED_FOR')) {
		return get_env('HTTP_FORWARDED_FOR');
	} elseif(get_env('HTTP_FORWARDED')) {
		return get_env('HTTP_FORWARDED');
	} else {
		return 'none';
	}
}

function get_remote_addr () {
	if(get_env('REMOTE_ADDR')) {
		return get_env('REMOTE_ADDR');
	}
	return 'none';
}

function clear_session(){
	global $db, $nsnst_const, $prefix;
	// Clear nuke_session location
	$x_forwarded = $nsnst_const['forward_ip'];
	$client_ip = $nsnst_const['client_ip'];
	$remote_addr = $nsnst_const['remote_addr'];
	$db->sql_query('DELETE FROM `' . $prefix . '_session` WHERE `host_addr`="' . $x_forwarded . '" OR `host_addr`="' . $client_ip . '" OR `host_addr`="' . $remote_addr . '"');
	// Clear nuke_bbsessions location
	$x_f = explode('.', $x_forwarded);
	$x_forwarded = @str_pad(dechex($x_f[0]), 2, '0', STR_PAD_LEFT) . @str_pad(dechex($x_f[1]), 2, '0', STR_PAD_LEFT) . @str_pad(dechex($x_f[2]), 2, '0', STR_PAD_LEFT)
				. @str_pad(dechex($x_f[3]), 2, '0', STR_PAD_LEFT);
	$c_p = explode('.', $client_ip);
	$client_ip = @str_pad(dechex($c_p[0]), 2, '0', STR_PAD_LEFT) . @str_pad(dechex($c_p[1]), 2, '0', STR_PAD_LEFT) . @str_pad(dechex($c_p[2]), 2, '0', STR_PAD_LEFT)
				. @str_pad(dechex($c_p[3]), 2, '0', STR_PAD_LEFT);
	$r_a = explode('.', $remote_addr);
	$remote_addr = str_pad(dechex($r_a[0]), 2, '0', STR_PAD_LEFT) . str_pad(dechex($r_a[1]), 2, '0', STR_PAD_LEFT) . str_pad(dechex($r_a[2]), 2, '0', STR_PAD_LEFT)
				. str_pad(dechex($r_a[3]), 2, '0', STR_PAD_LEFT);
	$db->sql_query('DELETE FROM `' . $prefix . '_bbsessions` WHERE `session_ip`="' . $x_forwarded . '" OR `session_ip`="' . $client_ip . '" OR `session_ip`="' . $remote_addr . '"');
}

function is_excluded($rangeip){
	global $db, $prefix;
	$longip = sprintf('%u', ip2long($rangeip));
	$excludenum = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_excluded_ranges` WHERE `ip_lo`<="' . $longip . '" AND `ip_hi`>="' . $longip . '"'));
	if($excludenum > 0) { return 1; } else { return 0; }
	return 0;
}

function is_protected($rangeip){
	global $db, $prefix;
	$longip = sprintf('%u', ip2long($rangeip));
	$protectnum = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_protected_ranges` WHERE `ip_lo`<="' . $longip . '" AND `ip_hi`>="' . $longip . '"'));
	if($protectnum > 0) { return 1; } else { return 0; }
	return 0;
}

function is_reserved($rangeip) {
	global $db, $prefix;
	$rangelong = sprintf('%u', ip2long($rangeip));
	$rangenum = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_ip2country` WHERE (`ip_lo`<="' . $rangelong . '" AND `ip_hi`>="' . $rangelong . '") AND `c2c`="01"'));
	if($rangenum > 0) { return 1; } else { return 0; }
	return 0;
}

function abget_blocked($remoteip){
	global $prefix, $db;
	$ip = array();
	$ip = explode('.', $remoteip);
	$ip[0] = (isset($ip[0])) ? intval($ip[0]) : '';
	$ip[1] = (isset($ip[1])) ? intval($ip[1]) : '';
	$ip[2] = (isset($ip[2])) ? intval($ip[2]) : '';
	$ip[3] = (isset($ip[3])) ? intval($ip[3]) : '';
	$testip1 = $ip[0] . '.*.*.*';
	$testip2 = $ip[0] . '.' . $ip[1] . '.*.*';
	$testip3 = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.*';
	$testip4 = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.' . $ip[3];
	$blocked_result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr` = "' . $testip1 . '" OR `ip_addr` = "' . $testip2 . '" OR `ip_addr` = "' . $testip3 . '" OR `ip_addr` = "' . $testip4 . '"');
	$blocked_row = $db->sql_fetchrow($blocked_result);
	return $blocked_row;
}

function abget_blockedrange($remoteip){
	global $db, $prefix;
	$longip = sprintf('%u', ip2long($remoteip));
	$blockedrange_result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ranges` WHERE `ip_lo`<="' . $longip . '" AND `ip_hi`>="' . $longip . '"');
	$blockedrange_row = $db->sql_fetchrow($blockedrange_result);
	return $blockedrange_row;
}

function abget_blocker($blocker_name){
	global $db, $prefix;
	$blockerresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blockers` WHERE `block_name`="' . $blocker_name . '"');
	$blocker_row = $db->sql_fetchrow($blockerresult);
	return $blocker_row;
}

function abget_blockerrow($reason){
	global $db, $prefix;
	$blockerresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blockers` WHERE `blocker`="' . $reason . '"');
	$blocker_row = $db->sql_fetchrow($blockerresult);
	return $blocker_row;
}

function abget_admin($author){
	global $db, $prefix;
	$adminresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_admins` WHERE `aid`="' . $author . '"');
	$admin_row = $db->sql_fetchrow($adminresult);
	return $admin_row;
}

function abget_configs(){
	global $config, $db, $prefix;
	$configresult = $db->sql_query('SELECT `config_name`, `config_value` FROM `' . $prefix . '_nsnst_config`');
	while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		$config[$config_name] = $config_value;
	}
	return $config;
}

function abget_reason($reason_id){
	global $db, $prefix;
	$reasonresult = $db->sql_query('SELECT `reason` FROM `' . $prefix . '_nsnst_blockers` WHERE `blocker`="' . $reason_id . '"');
	list($title_long) = $db->sql_fetchrow($reasonresult);
	$reason_value = $title_long;
	return $reason_value;
}

function write_ban($banip, $htip, $blocker_row) {
	global $ab_config, $admin, $blocker_array, $db, $nsnst_const, $nuke_config, $prefix, $user_prefix;
	$a_aid = '';
	if(isset($_COOKIE['admin']) && !empty($_COOKIE['admin'])) {
		$abadmin = st_clean_string(base64_decode($_COOKIE['admin']));
		if (preg_match(REGEX_UNION, $abadmin)) { block_ip($blocker_array[1]); }
		if (preg_match(REGEX_UNION, base64_decode($abadmin))) { block_ip($blocker_array[1]); }
		$abadmin = explode(':', $abadmin);
		$a_aid = addslashes($abadmin[0]);
	}
	$admin_row = abget_admin($a_aid);
	if((!isset($_COOKIE['admin']) || empty($_COOKIE['admin'])) || $admin_row['protected'] < 1) {
	 if(($blocker_row['activate'] > 3 AND $blocker_row['activate'] < 6) OR $blocker_row['activate'] > 7) {
		if($blocker_row['duration'] > 0) {
			$abexpires = $blocker_row['duration'] + $nsnst_const['ban_time'];
		} else {
			$abexpires = 0;
		}
		if(!empty($nsnst_const['query_string']) && $nsnst_const['query_string'] > '') {
			$query_url = $nsnst_const['query_string'];
		} else {
			$query_url = _AB_NOTAVAILABLE;
		}
		if(!empty($nsnst_const['get_string']) && $nsnst_const['get_string'] > '') {
			$get_url = $nsnst_const['get_string'];
		} else {
			$get_url = _AB_NOTAVAILABLE;
		}
		if(!empty($nsnst_const['post_string']) && $nsnst_const['post_string'] > '') {
			$post_url = $nsnst_const['post_string'];
		} else {
			$post_url = _AB_NOTAVAILABLE;
		}
		$addby = _AB_ADDBY . ' ' . _AB_NUKESENTINEL;
		$querystring = base64_encode($query_url);
		$getstring = base64_encode($get_url);
		$poststring = base64_encode($post_url);
		$checkrow = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_ip2country`'));
		if($checkrow > 0) {
			list($c2c) = $db->sql_fetchrow($db->sql_query('SELECT `c2c` FROM `' . $prefix . '_nsnst_ip2country` WHERE `ip_lo`<="' . $nsnst_const['remote_long'] . '" AND `ip_hi`>="' . $nsnst_const['remote_long'] . '"'));
		}
		if(!$c2c) { $c2c = '00'; }
		if(!@get_magic_quotes_runtime()) {
			$addby = addslashes($addby);
			$ban_username = addslashes($nsnst_const['ban_username']);
			$user_agent = addslashes($nsnst_const['user_agent']);
		}
		$bantemp = str_replace('*', '0', $banip);
		$banlong = sprintf('%u', ip2long($bantemp));
		$db->sql_query('INSERT INTO `' . $prefix . '_nsnst_blocked_ips` VALUES ("' . $banip . '", "' . $banlong . '", "' . addslashes($nsnst_const['ban_user_id']) . '", "' . $ban_username . '"
						, "' . $user_agent . '", "' . addslashes($nsnst_const['ban_time']) . '", "' . $addby . '", "' . addslashes($blocker_row['blocker']) . '", "' . $querystring . '"
						, "' . $getstring . '", "' . $poststring . '", "' . addslashes($nsnst_const['forward_ip']) . '", "' . addslashes($nsnst_const['client_ip']) . '"
						, "' . addslashes($nsnst_const['remote_addr']) . '", "' . addslashes($nsnst_const['remote_port']) . '", "' . addslashes($nsnst_const['request_method']) . '"
						, "' . $abexpires . '", "' . $c2c . '")');
		if(!empty($ab_config['htaccess_path']) AND $blocker_row['htaccess'] > 0 AND file_exists($ab_config['htaccess_path'])) {
			$ipfile = file($ab_config['htaccess_path']);
			$ipfile = implode('', $ipfile);
			if(!stristr($ipfile, $htip)) {
				$doit = @fopen($ab_config['htaccess_path'], 'a');
				@fwrite($doit, $htip);
				@fclose($doit);
			}
		}
	 }
	}
}

function write_mail($banip, $blocker_row, $abmatch = '') {
	global $ab_config, $db, $nsnst_const, $nuke_config, $prefix, $user_prefix;
	if($blocker_row['activate'] > 0 AND $blocker_row['activate'] < 6) {
		$admincontact = explode("\r\n", $ab_config['admin_contact']);
		if(!empty($nsnst_const['query_string']) && $nsnst_const['query_string'] > '') {
			$query_url = $nsnst_const['query_string'];
		} else {
			$query_url = _AB_NOTAVAILABLE;
		}
		if(!empty($nsnst_const['get_string']) && $nsnst_const['get_string'] > '') {
			$get_url = $nsnst_const['get_string'];
		} else {
			$get_url = _AB_NOTAVAILABLE;
		}
		if(!empty($nsnst_const['post_string']) && $nsnst_const['post_string'] > '') {
			$post_url = $nsnst_const['post_string'];
		} else {
			$post_url = _AB_NOTAVAILABLE;
		}
		$subject = _AB_BLOCKEDFROM . ' ' . $banip;
		$message = _AB_CREATEDBY . ': ' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number'] . "\n";
		$message .= _AB_DATETIME . ': ' . date('Y-m-d H:i:s T \G\M\T O', $nsnst_const['ban_time']) . "\n";
		$message .= _AB_IPBLOCKED . ': ' . $banip . "\n";
		$message .= _AB_USERID . ': ' . $nsnst_const['ban_username'] . ' (' . $nsnst_const['ban_user_id'] . ")\n";
		$message .= _AB_REASON . ': ' . $blocker_row['reason'] . "\n";
		if($abmatch != '') { $message .= _AB_MATCH . ': ' . $abmatch . "\n"; }
		$message .= '--------------------' . "\n";
		$message .= _AB_REFERER . ': ' . $nsnst_const['referer'] . "\n";
		$message .= _AB_USERAGENT . ': ' . $nsnst_const['user_agent'] . "\n";
		$message .= _AB_HTTPHOST . ': ' . $nsnst_const['http_host'] . "\n";
		$message .= _AB_SCRIPTNAME . ': ' . $nsnst_const['script_name'] . "\n";
		$message .= _AB_QUERY . ': ' . $query_url . "\n";
		$message .= _AB_GET . ': ' . $get_url . "\n";
		$message .= _AB_POST . ': ' . $post_url . "\n";
		$message .= _AB_X_FORWARDED . ': ' . $nsnst_const['forward_ip'] . "\n";
		$message .= _AB_CLIENT_IP . ': ' . $nsnst_const['client_ip'] . "\n";
		$message .= _AB_REMOTE_ADDR . ': ' . $nsnst_const['remote_addr'] . "\n";
		$message .= _AB_REMOTE_PORT . ': ' . $nsnst_const['remote_port'] . "\n";
		$message .= _AB_REQUEST_METHOD . ': ' . $nsnst_const['request_method'] . "\n";
		if($blocker_row['email_lookup'] == 1) {
			$message .= '--------------------' . "\n" . _AB_WHOISFOR . "\n";
			// Copyright 2004(c) Raven PHP Scripts
			$msg = '';
			if(!@file_get_contents('http://ws.arin.net/cgi-bin/whois.pl?queryinput=' . $nsnst_const['remote_ip'])) {
				$msg = ('Unable to query WhoIs information for ' . $nsnst_const['remote_ip'] . '.');
			} else {
				$data = @file_get_contents('http://ws.arin.net/cgi-bin/whois.pl?queryinput=' . $nsnst_const['remote_ip']);
				$data = explode('Search results for: ',$data);
				$data = @explode('#', $data[1]);
				$data = explode('(NET-', strip_tags($data[0]));
				if( empty($data[1])) $msg .= $data[0];
				else {
					$data = explode(')',$data[1]);
					if(!@file_get_contents('http://ws.arin.net/cgi-bin/whois.pl?queryinput=' . "!%20NET-" . strip_tags($data[0]))) {
						$data = 'Unable to query WhoIs information for ' . strip_tags($data[0]) . '.';
					} else {
						$data = @file_get_contents('http://ws.arin.net/cgi-bin/whois.pl?queryinput=' . "!%20NET-" . strip_tags($data[0]));
						$data = explode('Search results for: ',$data);
						$data = explode('Name',$data[1],2);
						$data = explode('# ARIN WHOIS ',$data[1]);
					}
					$msg .= 'OrgName' . nl2br($data[0]);
				}
			}
			$message .= strip_tags($msg);
		} elseif($blocker_row['email_lookup'] == 2) {
			$message .= '--------------------' . "\n";
			// Copyright 2004(c) NukeScripts
			if(!@file_get_contents('http://dnsstuff.com/tools/whois/?ip=' . $nsnst_const['remote_ip'])) {
				$data = 'Unable to query WhoIs information for ' . $nsnst_const['remote_ip'] . '.';
			} else {
				$data = @file_get_contents('http://dnsstuff.com/tools/whois/?email=on&ip=' . $nsnst_const['remote_ip']);
				$data = str_replace('</H1><H5>', '\n', $data);
				$data = str_replace('status = \"Getting WHOIS results...\";', '\n', $data);
				$data = str_replace('status = \"Done!\";', '\n', $data);
			}
			$message .= strip_tags($data);
		}
		$adminmail = $nuke_config['adminmail'];
		if (TNML_IS_ACTIVE) {
			$params = array('batch' => 1);
			tnml_fMailer($admincontact, $subject, $message, $adminmail, '', $params);
		} else {
			for($i=0, $maxi=count($admincontact); $i < $maxi; $i++) {
				@mail($admincontact[$i], $subject, $message, 'From: ' . $adminmail . "\r\nX-Mailer: " . _AB_NUKESENTINEL);
			}
		}
	}
}

function block_ip($blocker_row, $abmatch="") {
	global $ab_config, $db, $prefix, $nsnst_const, $nuke_config, $user_prefix;
	if(!is_protected($nsnst_const['remote_ip'])) {
		$ip = explode('.', $nsnst_const['remote_ip']);
		clear_session();
		$nsnst_const['ban_ip'] = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.' . $ip[3];
		$testip1 = $ip[0] . '.*.*.*';
		$testip1p = 'deny from ' . $ip[0] . "\n";
		$resultag1 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr`="' . $testip1 . '"');
		$numag1 = $db->sql_numrows($resultag1);
		if($numag1 == 0 AND $blocker_row['block_type'] == 3) {
			write_mail($testip1, $blocker_row, $abmatch);
			write_ban($testip1, $testip1p, $blocker_row);
			$nsnst_const['ban_ip'] = $testip1;
		} elseif($numag1 == 0 AND $blocker_row['block_type'] < 3) {
			$testip2 = $ip[0] . '.' . $ip[1] . '.*.*';
			$testip2p = 'deny from ' . $ip[0] . '.' . $ip[1] . "\n";
			$resultag2 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr`="' . $testip2 . '"');
			$numag2 = $db->sql_numrows($resultag2);
			if($numag2 == 0 AND $blocker_row['block_type'] == 2) {
				write_mail($testip2, $blocker_row, $abmatch);
				write_ban($testip2, $testip2p, $blocker_row);
				$nsnst_const['ban_ip'] = $testip2;
			} elseif($numag2 == 0 AND $blocker_row['block_type'] < 2) {
				$testip3 = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.*';
				$testip3p = 'deny from ' . $ip[0] . '.' . $ip[1] . '.' . $ip[2] . "\n";
				$resultag3 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr`="' . $testip3 . '"');
				$numag3 = $db->sql_numrows($resultag3);
				if($numag3 == 0 AND $blocker_row['block_type'] == 1) {
					write_mail($testip3, $blocker_row, $abmatch);
					write_ban($testip3, $testip3p, $blocker_row);
					$nsnst_const['ban_ip'] = $testip3;
				} elseif($numag3 == 0 AND $blocker_row['block_type'] < 1) {
					$testip4 = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.' . $ip[3];
					$testip4p = 'deny from ' . $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.' . $ip[3] . "\n";
					$resultag4 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_blocked_ips` WHERE `ip_addr`="' . $testip4 . '"');
					$numag4 = $db->sql_numrows($resultag4);
					if($numag4 == 0 AND $blocker_row['block_type'] == 0) {
						write_mail($testip4, $blocker_row, $abmatch);
						write_ban($testip4, $testip4p, $blocker_row);
						$nsnst_const['ban_ip'] = $testip4;
					}
				}
			}
		}
		$blocked_row = abget_blocked($nsnst_const['ban_ip']);
		blocked($blocked_row, $blocker_row);
		die();
	} else {
		return;
	}
}

function is_god($axadmin = '') {
	global $db, $prefix, $aname, $blocker_array;
	if (!$axadmin && !empty($_COOKIE['admin'])) {
		$axadmin = $_COOKIE['admin'];
	} elseif (!$axadmin && empty($_COOKIE['admin'])) {
		return 0;
	}
	static $adminSave;
	# combining isset() && !empty() suggested by montego 2017.12.13
	if (isset($adminSave) && !empty($adminSave)) return 1;
	$tmpadm = st_clean_string(base64_decode($axadmin));
	if (preg_match(REGEX_UNION, $tmpadm)) { block_ip($blocker_array[1]); }
	if (preg_match(REGEX_UNION, base64_decode($tmpadm))) { block_ip($blocker_array[1]); }
	$aname = $apwd = '';
	$tmpadm = explode(':', $tmpadm);
	if (isset($tmpadm[0])) $aname = addslashes($tmpadm[0]);
	if (isset($tmpadm[1]))$apwd = addslashes($tmpadm[1]);
	if(!empty($aname) AND !empty($apwd)) {
		$aname = addslashes(trim($aname));
		$apwd = trim($apwd);
		$admrow = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_authors` WHERE `aid`="' . $aname . '"'));
		if(strtolower($admrow['name']) == 'god' AND $admrow['pwd'] == $apwd) { return $adminSave = 1; }
	}
	return $adminSave = 0;
}

if(!function_exists('file_get_contents')) {
	function file_get_contents($filename, $use_include_path = 0) {
		$file = @fopen($filename, 'rb', $use_include_path);
		if($file) {
			while (!feof($file)) $data .= fread($file, 1024);
			@fclose($file);
		}
		return $data;
	}
}

function abget_template($template = '') {
	global $ab_config, $abmatch, $db, $ip, $nsnst_const, $nuke_config, $prefix;
	if(empty($template)) { $template = 'abuse_default.tpl'; }
	$sitename = $nuke_config['sitename'];
	$adminmail = $nuke_config['adminmail'];
	$adminmail = str_replace('@', '(at)', $adminmail);
	$adminmail = str_replace('.', '(dot)', $adminmail);
	$adminmail2 = urlencode($nuke_config['adminmail']);
	$querystring = get_query_string();
	$filename = NUKE_BASE_DIR . 'abuse/' . $template;
	if(!file_exists($filename)) { $filename = NUKE_BASE_DIR . 'abuse/abuse_default.tpl'; }
	$handle = @fopen($filename, 'r');
	$display_page = fread($handle, filesize($filename));
	@fclose($handle);
	$display_page = str_replace('__MATCH__', $abmatch, $display_page);
	$display_page = str_replace('__SITENAME__', $sitename, $display_page);
	$display_page = str_replace('__ADMINMAIL1__', $adminmail, $display_page);
	$display_page = str_replace('__ADMINMAIL2__', $adminmail2, $display_page);
	$display_page = str_replace('__REMOTEPORT__', htmlentities($nsnst_const['remote_port']), $display_page);
	$display_page = str_replace('__REQUESTMETHOD__', htmlentities($nsnst_const['request_method']), $display_page);
	$display_page = str_replace('__SCRIPTNAME__', htmlentities($nsnst_const['script_name']), $display_page);
	$display_page = str_replace('__HTTPHOST__', htmlentities($nsnst_const['http_host']), $display_page);
	$display_page = str_replace('__USERAGENT__', htmlentities($nsnst_const['user_agent']), $display_page);
	$display_page = str_replace('__CLIENTIP__', htmlentities($nsnst_const['client_ip']), $display_page);
	$display_page = str_replace('__FORWARDEDFOR__', htmlentities($nsnst_const['forward_ip']), $display_page);
	$display_page = str_replace('__REMOTEADDR__', htmlentities($nsnst_const['remote_addr']), $display_page);
	// New fields for use in display pages
	$display_page = str_replace('__QUERYSTRING__', htmlentities($nsnst_const['query_string']), $display_page);
	$display_page = str_replace('__GETSTRING__', htmlentities($nsnst_const['get_string']), $display_page);
	$display_page = str_replace('__POSTSTRING__', htmlentities($nsnst_const['post_string']), $display_page);
	$display_page = str_replace('__REFERER__', htmlentities($nsnst_const['referer']), $display_page);
	$display_page = str_replace('__BANTIME__', htmlentities($nsnst_const['ban_time']), $display_page);
	$display_page = str_replace('__BANUSERID__', htmlentities($nsnst_const['ban_user_id']), $display_page);
	$display_page = str_replace('__BANUSERNAME__', htmlentities($nsnst_const['ban_username']), $display_page);
	$display_page = str_replace('__REMOTEIP__', htmlentities($nsnst_const['remote_ip']), $display_page);
	$display_page = str_replace('__REMOTELONG__', htmlentities($nsnst_const['remote_long']), $display_page);

	return $display_page;
}

function blocked($blocked_row = '', $blocker_row = '') {
	global $ab_config, $db, $nsnst_const, $nuke_config, $prefix;
	$ip = explode('.', $nsnst_const['remote_ip']);
	if(!$nsnst_const['ban_time'] OR empty($nsnst_const['ban_time'])) { $nsnst_const['ban_time'] = time(); }
	if(empty($blocked_row)) { $blocked_row = abget_blocked($nsnst_const['remote_ip']); }
	if(empty($blocked_row)) { $blocked_row['reason'] = 0; $blocked_row['date'] = time(); }
	if(empty($blocker_row)) { $blocker_row = abget_blockerrow($blocked_row['reason']); }
	if(($blocker_row['activate'] == 2 OR $blocker_row['activate'] == 4 OR $blocker_row['activate'] == 6 OR $blocker_row['activate'] == 8) AND !empty($blocker_row['forward'])) {
		header('Location: ' . $blocker_row['forward']);
		die();
	} elseif($blocker_row['activate'] == 3 OR $blocker_row['activate'] == 5 OR $blocker_row['activate'] == 7 OR $blocker_row['activate'] == 9) {
		$display_page = abget_template($blocker_row['template']);
		$display_page = str_replace('__TIMEDATE__', date('Y-m-d \@ H:i:s T \G\M\T O', $blocked_row['date']), $display_page);
		if($blocked_row['expires'] > 0) {
			$display_page = str_replace('__DATEEXPIRES__', date('Y-m-d \@ H:i:s T \G\M\T O', $blocked_row['expires']), $display_page);
		} elseif (isset($blocked_row['expires'])) {
			$display_page = str_replace('__DATEEXPIRES__', _AB_PERMENANT, $display_page);
		} else {
			$display_page = str_replace('__DATEEXPIRES__', _AB_UNKNOWN, $display_page);
		}
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number'] . ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	} else {
		$display_page = abget_template();
		$display_page = str_replace('__TIMEDATE__', date('Y-m-d \@ H:i:s T \G\M\T O', time()), $display_page);
		if(@$blocked_row['expires'] > 0) {
			$display_page = str_replace('__DATEEXPIRES__', date('Y-m-d \@ H:i:s T \G\M\T O', $blocked_row['expires']), $display_page);
		} else {
			$display_page = str_replace('__DATEEXPIRES__', _AB_PERMENANT, $display_page);
		}
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number'] . ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	}
}

function blockedrange($blockedrange_row = '') {
	global $ab_config, $db, $nsnst_const, $nuke_config, $prefix;
	$ip = explode('.', $nsnst_const['remote_ip']);
	if(!$nsnst_const['ban_time'] OR empty($nsnst_const['ban_time'])) { $nsnst_const['ban_time'] = time(); }
	if(empty($blockedrange_row)) { $blockedrange_row = abget_blockedrange($nsnst_const['remote_ip']); }
	if(empty($blockedrange_row)) { $blockedrange_row['reason'] = 0; $blockedrange_row['date'] = time(); }
	if(empty($blocker_row)) { $blocker_row = abget_blockerrow($blockedrange_row['reason']); }
	if(($blocker_row['activate'] == 2 OR $blocker_row['activate'] == 4 OR $blocker_row['activate'] == 6) AND !empty($blocker_row['forward'])) {
		header('Location: ' . $blocker_row['forward']);
		die();
	} elseif($blocker_row['activate'] == 3 OR $blocker_row['activate'] == 5 OR $blocker_row['activate'] == 7) {
		$display_page = abget_template($blocker_row['template']);
		$display_page = str_replace('__TIMEDATE__', date('Y-m-d \@ H:i:s T \G\M\T O', $blockedrange_row['date']), $display_page);
		if($blockedrange_row['expires'] > 0) {
			$display_page = str_replace('__DATEEXPIRES__', date('Y-m-d \@ H:i:s T \G\M\T O', $blockedrange_row['expires']), $display_page);
		} elseif(isset($blockedrange_row['expires'])) {
			$display_page = str_replace('__DATEEXPIRES__', _AB_PERMENANT, $display_page);
		} else {
			$display_page = str_replace('__DATEEXPIRES__', _AB_UNKNOWN, $display_page);
		}
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number'] . ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	} else {
		$display_page = abget_template();
		$display_page = str_replace('__TIMEDATE__', date('Y-m-d \@ H:i:s T \G\M\T O', time()), $display_page);
		if($blockedrange_row['expires']>0) {
			$display_page = str_replace('__DATEEXPIRES__', date('Y-m-d \@ H:i:s T \G\M\T O', $blockedrange_row['expires']), $display_page);
		} else {
			$display_page = str_replace('__DATEEXPIRES__', _AB_PERMENANT, $display_page);
		}
		$display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . ' ' . $ab_config['version_number'] . ' ' . _AB_BYNSN . '</div>' . "\n" . '</body>', $display_page);
		die($display_page);
	}
}

function ABGetCIDRs($long_lo, $long_hi) {
	global $db, $masscidr, $prefix;
	$chosts = ($long_hi - $long_lo) + 1;
	$testrst = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_cidrs` ORDER BY `hosts` DESC');
	$cidrs = $hosts = $masks = '';
	while($test = $db->sql_fetchrow($testrst)) {
		if($chosts >= $test['hosts']) {
			$cidrs = $test['cidr'] . '||' . $cidrs;
			$hosts = $test['hosts'] . '||' . $hosts;
			$masks = $test['mask'] . '||' . $masks;
			$chosts = $chosts - $test['hosts'];
		}
	}
	$cidrs = rtrim($cidrs, '||');
	$hosts = rtrim($hosts, '||');
	$masks = rtrim($masks, '||');
	$cidrsary = explode('||', $cidrs);
	$hostsary = explode('||', $hosts);
	$masksary = explode('||', $masks);
	$masscidr = '';
	$nextcidr = $long_lo;
	for($i=0, $maxi=count($cidrsary); $i<$maxi; $i++) {
		$tempcidr = long2ip($nextcidr) . '/' . $cidrsary[$i];
		$masscidr = $masscidr.$tempcidr . '||';
		$nextcidr = $nextcidr + $hostsary[$i];
	}
	$masscidr = rtrim($masscidr, '||');
	return $masscidr;
}

function ab_flood($blocker_row) {
	global $ab_config, $nsnst_const;
	$_sessid = session_id();
	$_sessnm = session_name();
	$currtime = time();
	$floodarray = file($ab_config['ftaccess_path']);
	$floodcount = count($floodarray);
	$floodopen = fopen($ab_config['ftaccess_path'], 'w;');
	foreach($floodarray as $floodwrite){
		if ($floodcount - 10 >= 0) if(!strstr($floodwrite, $floodarray[$floodcount - 10]))
		fputs($floodopen, $floodwrite);
	}
if ($floodcount >= 4) {
	$p1 = explode(' || ', $floodarray[$floodcount - 1]);
	$p2 = explode(' || ', $floodarray[$floodcount - 3]);
	if($p1[2] - $p2[2] <= $ab_config['flood_delay']) {
		if($p1[1] != $p2[1]) {
			if($p1[0] == $p2[0]) {
				if($nsnst_const['remote_ip'] == $p1[0] && $p2[0]) {
					block_ip($blocker_row);
				}
			}
		}
	}
}
	if($_SESSION['NSNST_Flood'] > time() - $ab_config['flood_delay']){
		$floodappend = fopen($ab_config['ftaccess_path'], 'a');
		fwrite($floodappend, $nsnst_const['remote_ip'] . ' || ' . $_sessid . ' || ' . $currtime . ' || ' . $_sessnm . "\n");
	}
	fclose($floodopen);
}

/** From phpMyAdmin v2.6
 * Gets advanced authentication settings
 *
 * @global  string    the username if register_globals is on
 * @global  string    the password if register_globals is on
 * @global  array     the array of server variables if register_globals is
 *                    off
 * @global  array     the array of environment variables if register_globals
 *                    is off
 * @global  string    the username for the ? server
 * @global  string    the password for the ? server
 * @global  string    the username for the WebSite Professional server
 * @global  string    the password for the WebSite Professional server
 * @global  string    the username of the user who logs out
 *
 * @return  boolean   whether we get authentication settings or not
 *
 * @access  public
 */
function PMA_auth_check() {
	global $PHP_AUTH_USER, $PHP_AUTH_PW;
	global $REMOTE_USER, $AUTH_USER, $REMOTE_PASSWORD, $AUTH_PASSWORD;
	global $HTTP_AUTHORIZATION;

	// Grabs the $PHP_AUTH_USER variable whatever are the values of the
	// 'register_globals' and the 'variables_order' directives
	// loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
	if(empty($PHP_AUTH_USER)) {
		if(!empty($_SERVER) && isset($_SERVER['PHP_AUTH_USER'])) {
			$PHP_AUTH_USER = $_SERVER['PHP_AUTH_USER'];
		} else if(isset($REMOTE_USER)) {
			$PHP_AUTH_USER = $REMOTE_USER;
		} else if(!empty($_ENV) && isset($_ENV['REMOTE_USER'])) {
			$PHP_AUTH_USER = $_ENV['REMOTE_USER'];
		} else if(@getenv('REMOTE_USER')) {
			$PHP_AUTH_USER = getenv('REMOTE_USER');
		// Fix from Matthias Fichtner for WebSite Professional - Part 1
		} else if(isset($AUTH_USER)) {
			$PHP_AUTH_USER = $AUTH_USER;
		} else if(!empty($_ENV) && isset($_ENV['AUTH_USER'])) {
			$PHP_AUTH_USER = $_ENV['AUTH_USER'];
		} else if(@getenv('AUTH_USER')) {
			$PHP_AUTH_USER = getenv('AUTH_USER');
		}
	}
	// Grabs the $PHP_AUTH_PW variable whatever are the values of the
	// 'register_globals' and the 'variables_order' directives
	// loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
	if(empty($PHP_AUTH_PW)) {
		if(!empty($_SERVER) && isset($_SERVER['PHP_AUTH_PW'])) {
			$PHP_AUTH_PW = $_SERVER['PHP_AUTH_PW'];
		} else if(isset($REMOTE_PASSWORD)) {
			$PHP_AUTH_PW = $REMOTE_PASSWORD;
		} else if(!empty($_ENV) && isset($_ENV['REMOTE_PASSWORD'])) {
			$PHP_AUTH_PW = $_ENV['REMOTE_PASSWORD'];
		} else if(@getenv('REMOTE_PASSWORD')) {
			$PHP_AUTH_PW = getenv('REMOTE_PASSWORD');
		// Fix from Matthias Fichtner for WebSite Professional - Part 2
		} else if(isset($AUTH_PASSWORD)) {
			$PHP_AUTH_PW = $AUTH_PASSWORD;
		} else if(!empty($_ENV) && isset($_ENV['AUTH_PASSWORD'])) {
			$PHP_AUTH_PW = $_ENV['AUTH_PASSWORD'];
		} else if(@getenv('AUTH_PASSWORD')) {
			$PHP_AUTH_PW = getenv('AUTH_PASSWORD');
		}
		}
		// Gets authenticated user settings with IIS
		if(empty($PHP_AUTH_USER) && empty($PHP_AUTH_PW)
		&& function_exists('base64_decode')) {
		if(!empty($HTTP_AUTHORIZATION)
			&& substr($HTTP_AUTHORIZATION, 0, 6) == 'Basic ') {
			list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr($HTTP_AUTHORIZATION, 6)));
		} else if(!empty($_ENV)
			&& isset($_ENV['HTTP_AUTHORIZATION'])
			&& substr($_ENV['HTTP_AUTHORIZATION'], 0, 6) == 'Basic ') {
			list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr($_ENV['HTTP_AUTHORIZATION'], 6)));
		} else if(@getenv('HTTP_AUTHORIZATION')
			&& substr(getenv('HTTP_AUTHORIZATION'), 0, 6) == 'Basic ') {
			list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr(getenv('HTTP_AUTHORIZATION'), 6)));
		}
	} // end IIS

	// Returns whether we get authentication settings or not
	if(empty($PHP_AUTH_USER)) {
		return FALSE;
	} else {
		if(@get_magic_quotes_runtime()) {
			$PHP_AUTH_USER = stripslashes($PHP_AUTH_USER);
			$PHP_AUTH_PW = stripslashes($PHP_AUTH_PW);
		}
		return TRUE;
	}
} // end of the 'PMA_auth_check()' function

/*********************************************************************************************/
/* HTTP Auth code for ".$admin_file.".php protection.  Tried to make it a function call      */
/* but there are too many variables that would have to be globalized.                        */
/* Copyright 2004(c) Raven                                                                   */
/*********************************************************************************************/
if(@ini_get('register_globals')) {
	$sapi_name = strtolower(php_sapi_name());
	$apass = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_admins` WHERE `password_md5`=""'));
	if($apass > 0 AND $ab_config['http_auth'] == 1) {
		require_once NSINCLUDE_PATH . 'admin/modules/nukesentinel/functions.php';
		absave_config('http_auth', '0');
	}
	if($ab_config['http_auth'] == 1 AND strpos($sapi_name, 'cgi') === FALSE) {
		if(basename($_SERVER['PHP_SELF'], '.php') == $admin_file) {
			$allowPassageToAdmin = FALSE;
			$authresult = $db->sql_query('SELECT `login`, `password_md5` FROM `' . $prefix . '_nsnst_admins`');
			while ($getauth = $db->sql_fetchrow($authresult)) {
				if($PHP_AUTH_USER == $getauth['login'] AND md5($PHP_AUTH_PW) == trim($getauth['password_md5'])) {
				$allowPassageToAdmin = TRUE;
				break;
				}
			}
			if(!$allowPassageToAdmin) {
				header('WWW-Authenticate: Basic realm=Protected by NukeSentinel(tm)');
				header('HTTP/1.0 401 Unauthorized');
				die(_AB_GETOUT);
			}
		}
	}
}

?>