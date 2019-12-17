<?php

/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 */

global $admin_file,$db;

if(!isset($admin_file)) { $admin_file = 'admin'; }

if(!defined('ADMIN_FILE')) {
	Header('Location: ../../../'.$admin_file.'.php');
	die();
}

if ($op == 'nukeSPAMSaveConfig') {
	if (!isset($baseMatch)) $baseMatch = '';
	if (!isset($spamTheme)) $spamTheme = '';
	if (!isset($keyfSpamList)) $keyfSpamList = '';
	if (!isset($keyStopForumSpam)) $keyStopForumSpam = '';
	if (!isset($keyBotScout)) $keyBotScout = '';
	if (!isset($keyProjectHoneyPot)) $keyProjectHoneyPot = '';

	$baseMatch = htmlspecialchars_decode(check_html($baseMatch, 'nohtml'), ENT_QUOTES);
	$spamTheme = htmlspecialchars_decode(check_html($spamTheme, 'nohtml'), ENT_QUOTES);
	$keyfSpamList = htmlspecialchars_decode(check_html($keyfSpamList, 'nohtml'), ENT_QUOTES);
	$keyStopForumSpam = htmlspecialchars_decode(check_html($keyStopForumSpam, 'nohtml'), ENT_QUOTES);
	$keyBotScout = htmlspecialchars_decode(check_html($keyBotScout, 'nohtml'), ENT_QUOTES);
	$keyProjectHoneyPot = htmlspecialchars_decode(check_html($keyProjectHoneyPot, 'nohtml'), ENT_QUOTES);

	$use_reg = intval($use_reg);
	$debug = intval($debug);
	$logToDB = intval($logToDB);

#	$logToTextFile = intval($logToTextFile);

	if (!isset($usefSpamList)) $usefSpamList = '0';
	if (!isset($useStopForumSpam)) $useStopForumSpam = '0';
	if (!isset($useBotScout)) $useBotScout = '0';
	if (!isset($useDNSBL)) $useDNSBL = '0';
	if (!isset($useDroneACH)) $useDroneACH = '0';
	if (!isset($useHTTPBLACH)) $useHTTPBLACH = '0';
	if (!isset($useSpamACH)) $useSpamACH = '0';
	if (!isset($useZeusACH)) $useZeusACH = '0';
	if (!isset($useAHBL)) $useAHBL = '0';
	if (!isset($useBLDE)) $useBLDE = '0';
	if (!isset($useProjectHoneyPot)) $useProjectHoneyPot = '0';
	if (!isset($useSorbs)) $useSorbs = '0';
	if (!isset($useSpamHaus)) $useSpamHaus = '0';
	if (!isset($useSpamCop)) $useSpamCop = '0';
	if (!isset($useDroneBL)) $useDroneBL = '0';
	if (!isset($useTornevall)) $useTornevall = '0';
	if (!isset($useEFNet)) $useEFNet = '0';
	if (!isset($useTor)) $useTor = '0';

	$usefSpamList = intval($usefSpamList);
	$useStopForumSpam = intval($useStopForumSpam);
	$useBotScout = intval($useBotScout);
	$useDNSBL = intval($useDNSBL);
	$useDroneACH = intval($useDroneACH);
	$useHTTPBLACH = intval($useHTTPBLACH);
	$useSpamACH = intval($useSpamACH);
	$useZeusACH = intval($useZeusACH);

	$useAHBL = intval($useAHBL);
	$useBLDE = intval($useBLDE);

	$useProjectHoneyPot	= intval($useProjectHoneyPot);

	$useSorbs = intval($useSorbs);
	$useSpamHaus = intval($useSpamHaus);
	$useSpamCop = intval($useSpamCop);
	$useDroneBL = intval($useDroneBL);

	$useTornevall = intval($useTornevall);
	$useEFNet = intval($useEFNet);
	$useTor = intval($useTor);

	if(!@get_magic_quotes_gpc()) {
		if (method_exists($db, 'sql_escape_string')) {
			$baseMatch = $db->sql_escape_string($baseMatch);
			$spamTheme = $db->sql_escape_string($spamTheme);
			$keyfSpamList = $db->sql_escape_string($keyfSpamList);
			$keyStopForumSpam = $db->sql_escape_string($keyStopForumSpam);
			$keyBotScout = $db->sql_escape_string($keyBotScout);
			$keyProjectHoneyPot = $db->sql_escape_string($keyProjectHoneyPot);
		} else {
			$baseMatch = addslashes($baseMatch);
			$spamTheme = addslashes($spamTheme);
			$keyfSpamList = addslashes($keyfSpamList);
			$keyStopForumSpam = addslashes($keyStopForumSpam);
			$keyBotScout = addslashes($keyBotScout);
			$keyProjectHoneyPot = addslashes($keyProjectHoneyPot);
		}
	}
	seoSaveConfig('nukeSPAM', 'baseMatch',$baseMatch);
	seoSaveConfig('nukeSPAM', 'use_reg',$use_reg);
	seoSaveConfig('nukeSPAM', 'debug',$debug);
	seoSaveConfig('nukeSPAM', 'logToDB',$logToDB);
	seoSaveConfig('nukeSPAM', 'theme',$spamTheme);
#	seoSaveConfig('nukeSPAM', 'logToTextFile',$logToTextFile);
	seoSaveConfig('nukeSPAM', 'usefSpamList',$usefSpamList);
	seoSaveConfig('nukeSPAM', 'keyfSpamList',$keyfSpamList);
	seoSaveConfig('nukeSPAM', 'useStopForumSpam',$useStopForumSpam);
	seoSaveConfig('nukeSPAM', 'keyStopForumSpam',$keyStopForumSpam);
	seoSaveConfig('nukeSPAM', 'useBotScout',$useBotScout);
	seoSaveConfig('nukeSPAM', 'keyBotScout',$keyBotScout);
	seoSaveConfig('nukeSPAM', 'useDNSBL',$useDNSBL);
	seoSaveConfig('nukeSPAM', 'useDroneACH',$useDroneACH);
	seoSaveConfig('nukeSPAM', 'useHTTPBLACH',$useHTTPBLACH);
	seoSaveConfig('nukeSPAM', 'useSpamACH',$useSpamACH);
	seoSaveConfig('nukeSPAM', 'useZeusACH',$useZeusACH);
	seoSaveConfig('nukeSPAM', 'useAHBL',$useAHBL);
	seoSaveConfig('nukeSPAM', 'useBLDE',$useBLDE);
	seoSaveConfig('nukeSPAM', 'useProjectHoneyPot',$useProjectHoneyPot);
	seoSaveConfig('nukeSPAM', 'keyProjectHoneyPot',$keyProjectHoneyPot);
	seoSaveConfig('nukeSPAM', 'useSorbs',$useSorbs);
	seoSaveConfig('nukeSPAM', 'useSpamHaus',$useSpamHaus);
	seoSaveConfig('nukeSPAM', 'useSpamCop',$useSpamCop);
	seoSaveConfig('nukeSPAM', 'useDroneBL',$useDroneBL);
	seoSaveConfig('nukeSPAM', 'useTornevall',$useTornevall);
	seoSaveConfig('nukeSPAM', 'useEFNet',$useEFNet);
	seoSaveConfig('nukeSPAM', 'useTor',$useTor);
}


$nsconfjs = '<script type="text/javascript">' . PHP_EOL
.'	$(function() {' . PHP_EOL
.'		$( "#tabs" ).tabs({Cookies:{}});' . PHP_EOL
.'	});' . PHP_EOL
.'</script>' . PHP_EOL;
addJSToBody($nsconfjs, 'inline');

$seo_config = seoGetConfigs('nukeSPAM');

if (!empty($seo_config['baseMatch'])) {
	$baseMatch = $seo_config['baseMatch'];
} else {
	$baseMatch = '';
}

OpenTable();
echo '<form action="', $admin_file, '.php" method="post">', PHP_EOL
	,'<div id="tabs">', PHP_EOL
	,'<ul>', PHP_EOL
	,'<li><a href="#tabs-1">', _SPAM_OPERATIONS, '</a></li>', PHP_EOL
	,'<li><a href="#tabs-2">', _SPAM_DATABASES, '</a></li>', PHP_EOL
	,'<li><a href="#tabs-3">', _SPAM_DNSBL, '</a></li>', PHP_EOL
	,'</ul>', PHP_EOL
	,'<div id="tabs-1">', PHP_EOL
	,'<table align="center" border="0" cellpadding="2" cellspacing="2">', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td>', seoHelp('_SPAM_BASEMATCH'), ' ', _SPAM_BASEMATCH, ':</td>', PHP_EOL
	,'<td>', PHP_EOL, chr(10)
	,'<select name="baseMatch">', chr(10);
$sel = '';
if ($baseMatch == '') $sel = 'selected="selected"';
echo '<option value="" ', $sel, '>', _SPAM_MATCH_ANY, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '2|3') $sel = 'selected="selected"';
echo '<option value="2|3" ', $sel, '>', _SPAM_MATCH_2OR3, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '2,3') $sel = 'selected="selected"';
echo '<option value="2,3" ', $sel, '>', _SPAM_MATCH_23, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,2') $sel = 'selected="selected"';
echo '<option value="1,2" ', $sel, '>', _SPAM_MATCH_12, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,3') $sel = 'selected="selected"';
echo '<option value="1,3" ', $sel, '>', _SPAM_MATCH_13, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,2|1,3') $sel = 'selected="selected"';
echo '<option value="1,2|1,3" ', $sel, '>', _SPAM_MATCH_12OR13, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,2|1,3|2,3') $sel = 'selected="selected"';
echo '<option value="1,2|1,3|2,3" ', $sel, '>', _SPAM_MATCH_12OR13OR23, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,2|2,3') $sel = 'selected="selected"'; 
echo '<option value="1,2|2,3" ' . $sel . '>' . _SPAM_MATCH_12OR23 . '</option>', PHP_EOL . chr(10);
$sel = '';
if ($baseMatch == '1,3|2,3') $sel = 'selected="selected"';
echo '<option value="1,3|2,3" ', $sel, '>', _SPAM_MATCH_13OR23, '</option>', PHP_EOL, chr(10);
$sel = '';
if ($baseMatch == '1,2,3') $sel = 'selected="selected"';
echo '<option value="1,2,3" ', $sel, '>', _SPAM_MATCH_123, '</option>', PHP_EOL, chr(10);
echo '</select>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td valign="top">', seoHelp('_SPAM_USE_REG'), ' ', _SPAM_USE_REG, ':</td>', PHP_EOL, chr(10)
	,'<td>', PHP_EOL;
$selY = $selN = '';
if(empty($seo_config['use_reg'])) {
	$selN = 'selected="selected"';
} else {
	$selY = 'selected="selected"';
}
echo '<select name="use_reg">', chr(10), '<option value="1" ', $selY, '>', _YES, '</option>', PHP_EOL, chr(10)
	,'<option value="0" ', $selN, '>', _NO, '</option>', PHP_EOL, chr(10)
	,'</select>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td valign="top">', seoHelp('_SPAM_DEBUG'), ' ', _SPAM_DEBUG, ':</td>', PHP_EOL, chr(10)
	,'<td>', PHP_EOL;
$selY = $selN = '';
if(empty($seo_config['debug'])) {
	$selN = 'selected="selected"';
} else {
	$selY = 'selected="selected"';
}
echo '<select name="debug">', PHP_EOL, chr(10)
	,'<option value="1" ', $selY, '>', _YES, '</option>', PHP_EOL, chr(10)
	,'<option value="0" ', $selN.'>', _NO, '</option>', PHP_EOL, chr(10)
	,'</select>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td>', seoHelp('_SPAM_LOGTODB'), ' ', _SPAM_LOGTODB, ':</td>', PHP_EOL
	,'<td>', PHP_EOL, chr(10);

$selY = $selN = '';
if(empty($seo_config['logToDB'])) {
	$selN = 'selected="selected"';
} else {
	$selY = 'selected="selected"';
}
echo '<select name="logToDB">', PHP_EOL, chr(10)
	,'<option value="1" ', $selY, '>', _YES, '</option>', PHP_EOL, chr(10)
	,'<option value="0" ', $selN, '>', _NO, '</option>', PHP_EOL, chr(10)
	,'</select>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL;

/*
echo '<tr>', PHP_EOL
	,'<td>', seoHelp('_SPAM_LOGTOTEXTFILE'), ' ', _SPAM_LOGTOTEXTFILE, ':</td>', PHP_EOL
	,'<td>', PHP_EOL, chr(10);
$selY = $selN = '';
if($seo_config['logToTextFile'] == 0) {
	$selN = 'selected="selected"';
} else {
	$selY = 'selected="selected"';
}
echo '<select name="logToTextFile">', PHP_EOL, chr(10)
	,'<option value="1" ', $selY, '>', _YES, '</option>', PHP_EOL, chr(10)
	,'<option value="0" ', $selN, '>', _NO, '</option>', PHP_EOL, chr(10)
	,'</select>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL;
*/

echo '<tr>', PHP_EOL
	,'<td>', seoHelp('_SPAM_THEME'), ' ', _SPAM_THEME, ':</td>', PHP_EOL
	,'<td>', PHP_EOL, chr(10)
	,getUIThemeOptions(), PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</table>', PHP_EOL
	,'</div>', PHP_EOL;

echo '<div id="tabs-2">', PHP_EOL
	,'<table align="center" border="0" cellpadding="2" cellspacing="2">', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td class="text-center" colspan="2"><strong>', _SPAM_DB, '</strong></td>', PHP_EOL
	,'<td class="text-center">&nbsp;</td>', PHP_EOL
	,'<td class="text-center"><strong>', _SPAM_DB_KEY, '</strong></td>', PHP_EOL
	,'<td class="text-center"><strong>', _SPAM_DB_LINK, '</strong></td>', PHP_EOL
	,'</tr>', PHP_EOL, chr(10);
nukeSPAMconfigDB('useBotScout', '_SPAM_BS', 'keyBotScout');
nukeSPAMconfigDB('usefSpamList', '_SPAM_FSL', 'keyfSpamList');
nukeSPAMconfigDB('useStopForumSpam', '_SPAM_SFS', 'keyStopForumSpam');
echo '</table>', PHP_EOL
	,'</div>', PHP_EOL;

echo '<div id="tabs-3">', PHP_EOL
	,'<table align="center" border="0" cellpadding="2" cellspacing="2">', PHP_EOL;
nukeSPAMconfigDB('useDNSBL', '_SPAM_USE_DBL', '');
echo '<tr>', PHP_EOL
	,'<td class="text-center" colspan="2"><strong>', _SPAM_DBL, '</strong></td>', PHP_EOL
	,'<td class="text-center">&nbsp;</td>', PHP_EOL
	,'<td class="text-center"><strong>'._SPAM_DB_KEY.'</strong></td>', PHP_EOL
	,'<td class="text-center"><strong>'._SPAM_DB_LINK.'</strong></td>', PHP_EOL
	,'</tr>', PHP_EOL, chr(10);

nukeSPAMconfigDB('useDroneACH', '_SPAM_DACH', '');
nukeSPAMconfigDB('useHTTPBLACH', '_SPAM_HACH', '');
nukeSPAMconfigDB('useSpamACH', '_SPAM_SACH', '');
nukeSPAMconfigDB('useZeusACH', '_SPAM_ZACH', '');
#nukeSPAMconfigDB('useAHBL', '_SPAM_AHBL', '');
nukeSPAMconfigDB('useBLDE', '_SPAM_BLDE', '');
nukeSPAMconfigDB('useDroneBL', '_SPAM_DRONE', '');
nukeSPAMconfigDB('useEFNet', '_SPAM_EFN', '');
nukeSPAMconfigDB('useProjectHoneyPot', '_SPAM_PHP', 'keyProjectHoneyPot');
nukeSPAMconfigDB('useSorbs', '_SPAM_SB', '');
nukeSPAMconfigDB('useSpamHaus', '_SPAM_SH', '');
nukeSPAMconfigDB('useSpamCop', '_SPAM_SC', '');
nukeSPAMconfigDB('useTornevall', '_SPAM_TVO', '');
nukeSPAMconfigDB('useTor', '_SPAM_TOR', '');

echo '</table>', PHP_EOL
	,'</div>', PHP_EOL
	,'</div>', PHP_EOL;

echo '<input type="hidden" name="op" value="nukeSPAMSaveConfig" />', PHP_EOL
	,'<div class="text-center"><input type="submit" value="', _SPAM_SAVE, '" /></div>', PHP_EOL, chr(10)
	,'</form>', PHP_EOL;

CloseTable();

function getUIThemeOptions() {
	global $seo_config;
	$themedir = 'includes/jquery/css';
	$uiThemes = '';
	$dirfiles = scandir($themedir);
	foreach($dirfiles as $dirname)  { 
		if (stristr($dirname, '.')) continue 1;
		if (is_dir($themedir.'/'.$dirname) and file_exists($themedir.'/'.$dirname.'/jquery-ui.css')) {
			if (!empty($seo_config['theme'])) {
				$seo_config['theme'] == $dirname ? $sel = ' selected="selected"' : $sel = '';
			} else {
				$sel = '';
			}
			$uiThemes .= '<option value="' . $dirname . '"' . $sel . '>' . $dirname . '</option>' . PHP_EOL . chr(10);
		}
	}
	if (!empty($uiThemes)) $uiThemes = '<select name="spamTheme">' . chr(10) . $uiThemes . '</select>' . PHP_EOL . chr(10);
	return $uiThemes;
}

function nukeSPAMconfigDB($config, $desc, $key) {
	global $seo_config;
	$checked = '';
	if(!empty($seo_config[$config]) && $seo_config[$config] == '1') $checked = ' checked="checked"';
	echo '<tr>', PHP_EOL
		,'<td><input name="', $config, '" type="checkbox" value="1"', $checked, ' /> </td>', PHP_EOL
		,'<td>', constant($desc), '</td>', PHP_EOL,chr(10);
	if (defined($desc.'_HLP')) echo '<td>', seoHelp($desc), '</td>', PHP_EOL;
	else echo '<td>&nbsp;</td>', PHP_EOL;
	if (!empty($key) && isset($seo_config[$key])) {
		echo '<td><input name="', $key, '" type="text" value="', $seo_config[$key], '"/></td>', PHP_EOL;
	} else {
		echo '<td>&nbsp;</td>', PHP_EOL;
	}
	if (defined($desc.'_LINK')) echo '<td><a href="', constant($desc.'_LINK'), '" title="', constant($desc), '" target="_blank">', constant($desc.'_LINK'), '</a></td>', PHP_EOL;
	else echo '<td>&nbsp;</td>', PHP_EOL;
	echo '</tr>', PHP_EOL;
}

?>