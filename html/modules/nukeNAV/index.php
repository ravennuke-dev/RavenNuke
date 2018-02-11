<?php
/**************************************************************************/
/* nukeNAV(tm)
/*
/* Copyright (c) 2009, Kevin Guske  http://nukeseo.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/**************************************************************************/

if(!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
global $admin_file;
define('MODAL', true);
if(!isset($admin_file)) $admin_file = 'admin';
if (empty($fid)) $fid = 0;
if (empty($type)) $type = '';
if (empty($op)) $op = '';
if(!isset($index)) $index = '';

if ($op == 'deleteSEO' or $op == 'saveSEO' or $op == 'SEO') {
	if (!is_admin($admin)) return _ACCESSDENIED;
	if (($index == 'y' and $op == 'SEO') or ($op != 'SEO' and $dhLevel == 0)) {
		if (!defined('HOME_FILE')) define('HOME_FILE', true);
	}
	seoGetLang('nukeNAV');
}

$fid = intval($fid);
$type = strtoupper($type);

if(!isset($module_file)) $module_file='modules';
$module_name = basename(dirname(__FILE__));

// Popups that don't require JS or CSS go here
switch($op) {
	case 'login':
		echo nukeNAVlogin();
		die();
	case 'search':
		echo nukeNAVsearch();
		die();
}

// Iframe and AJAX popups need to load CSS, JS
$headCSS = array();
$headJS  = array();  // added inside HEAD tags
$bodyJS  = array(); // added at bottom of page, before </BODY>
addCSSToHead(INCLUDE_PATH . 'themes/ravennuke.css', 'file');
addCSSToHead(INCLUDE_PATH . 'modules/' . $module_name . '/nukeSEODH.css','file');
$base_url = $_SERVER['HTTP_HOST'];
include_once INCLUDE_PATH . 'includes/nukeSEO/nukeSEOdh.php';

$nukeNAVhtml = '';
switch($op) {
	case 'deleteSEO':
		$nukeNAVhtml = nukeNAVdeleteSEO();
		$nukeNAVhtml .= nukeNAVSEO();
		break;
	case 'saveSEO':
		$nukeNAVhtml = nukeNAVsaveSEO();
		$nukeNAVhtml .= nukeNAVSEO();
		break;
	case 'SEO':
		$nukeNAVhtml = '<br /><br />';
		$nukeNAVhtml .= nukeNAVSEO();
		break;
	default:
		header('Location: ./');
		die();
}
writeHEAD();
echo "\n", '</head>', "\n";
echo '<body>', "\n";
echo $nukeNAVhtml;
echo '</body></html>';
die();

function nukeNAVlogin() {
	// Copied from /blocks/block-Login.php
	global $admin, $user, $sitekey, $gfx_chk, $admin_file, $ya_config;
	include_once('modules/Your_Account/includes/functions.php');
	if (!isset($ya_config)) $ya_config = ya_get_configs();
	$content  = '<form action="modules.php?name=Your_Account" method="post">';
	$content .= '<div class="text-center content">'._NICKNAME.'&nbsp;<input type="text" name="username" size="15" maxlength="25" /><br />';
	$content .= _PASSWORD.'&nbsp;<input type="password" name="user_password" size="15" maxlength="20" /><br />';
	$content .= security_code(array(2,4,5,7), 'stacked');
	$content .= '<br />';
	$content .= '<input type="hidden" name="op" value="login" alt="login" />';
	$content .= '<input id="login_submit" type="submit" alt="login" value="'._LOGIN.'" /></div></form>';
	return $content;
}

function nukeNAVsearch() {
	// Enhanced from /blocks/block-Search.php
	$content = '<form onsubmit="this.submit.disabled=\'true\'" action="modules.php?name=Search" method="post">';
	$content .= '<br /><div class="text-center"><input type="text" name="query" size="40" />';
	$content .= '&nbsp;<input id="submit" type="submit" value="'._SEARCH.'" /></div><br /></form>';
	return $content;
}

function nukeNAVSEO() {
	if (function_exists('csrf_conf')) csrf_conf('frame-breaker', false);
	global $dhName, $dhID, $dhCat, $dhSubCat, $dhLevel, $index;
	include_once INCLUDE_PATH . 'includes/jquery/jquery.php';
	addCSSToHead('includes/jquery/css/jquery.cluetip-min.css', 'file');
	addJSToHead('includes/jquery/jquery.hoverIntent.minified.js', 'file');
	addJSToHead('includes/jquery/jquery.cluetip.min.yui.js', 'file');
	$clueTipHTMLJS = '<script type="text/javascript">
	$(document).ready(function() {
		$(\'a.seoHelp\').cluetip({  cluetipClass: \'seoHelp\', splitTitle: \'|\'});
	});
</script>';
	addJSToHead($clueTipHTMLJS, 'inline');
	$META = seoGetMETAtags($dhName, 'override');
	$ovrTitle = $ovrDesc = $ovrKeywords = '';
	if (count($META) > 0) $ovrExists = true; else $ovrExists = false;
	if (isset($META['title']) and !empty($META['title'][1])) $ovrTitle = $META['title'][1];
	if (isset($META['DESCRIPTION']) and !empty($META['DESCRIPTION'][1])) $ovrDesc = $META['DESCRIPTION'][1];
	if (isset($META['KEYWORDS']) and !empty($META['KEYWORDS'][1])) $ovrKeywords = $META['KEYWORDS'][1];
	$META = seoGetMETAtags($dhName, 'generated');
	$genTitle = $META['title'][1];
	$genDesc = $META['DESCRIPTION'][1];
	$genKeywords = $META['KEYWORDS'][1];
	$content = '<form action="'.htmlentities($_SERVER['REQUEST_URI']).'" method="post">'."\n";
	$content .= '<br /><div class="text-center"><table width="100%" border="0" cellspacing="0" cellpadding="0">'."\n"
						.'<tr><td align="center">'. _HEAD_TAG . '</td><td align="center">' . seoHelpCT('_NAV_LEVEL') . '&nbsp;' . constant('_LEVEL'.$dhLevel) . ' ' . _OVERRIDE_TAG . '</td><td align="center">' . _GENERATED_TAG . '</td></tr>'."\n"
						.'<tr><td align="left">' . seoHelpCT('_TITLE') . ' ' . _TITLE . '</td>' . "\n" . '<td align="left">' . '<input type="text" name="ovrTitle" value="' . $ovrTitle . '" size="71" maxlength="90" /></td>' . "\n" . '<td align="left"><input type="text" name="genTitle" value="' . $genTitle . '" size="71" readonly="readonly" maxlength="90" /></td></tr>'."\n"
						.'<tr><td align="left" valign="top">' . seoHelpCT('_DESCRIPTION') . ' '  . _DESCRIPTION . '</td>' . "\n" . '<td align="left">' . '<textarea name="ovrDesc" rows="5" cols="68">' . $ovrDesc . '</textarea></td>' . "\n" . '<td align="left"><textarea name="genDesc" rows="5" cols="68" readonly="readonly">' . $genDesc . '</textarea></td></tr>'."\n"
						.'<tr><td align="left" valign="top">' . seoHelpCT('_KEYWORDS') . ' '  . _KEYWORDS . '<br /><br />' . seoHelpCT('_NAV_VARIABLES') . _NAV_VARIABLES . '</td>' . "\n" . '<td align="left">' . '<textarea name="ovrKeywords" rows="3" cols="68">' . $ovrKeywords . '</textarea></td>' . "\n" . '<td align="left"><textarea name="genKeywords" rows="3" cols="68" readonly="readonly">' . $genKeywords . '</textarea></td></tr>' . "\n"
						.'</table>'."\n";
	$content .= '<input id="submit" type="submit" value="'._OVERRIDE_META.'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	if ($dhLevel > 0 and $ovrExists) $content .= '<a href="'.htmlentities($_SERVER['REQUEST_URI']).'&amp;dhLevel=' . $dhLevel . '&amp;op=deleteSEO" title="' . _DELETE_OVERRIDES . '"><img src="images/delete.gif" alt="' . _DELETE_OVERRIDES . '" border="0" /></a>';
	$content .= '<br />'."\n";
	$content .= '<input type="hidden" name="dhName" value="'.$dhName.'" />'."\n"
							.'<input type="hidden" name="dhID" value="'.$dhID.'" />'."\n"
							.'<input type="hidden" name="dhCat" value="'.$dhCat.'" />'."\n"
							.'<input type="hidden" name="dhSubCat" value="'.$dhSubCat.'" />'."\n"
							.'<input type="hidden" name="dhLevel" value="'.$dhLevel.'" />'."\n"
							.'<input type="hidden" name="op" value="saveSEO" />'."\n"
							.'</div></form>'."\n";
	return $content;
}

function nukeNAVsaveSEO() {
	global $dhName, $dhID, $dhCat, $dhSubCat, $dhLevel, $ovrTitle, $ovrDesc, $ovrKeywords;
	if (!empty($ovrTitle)) seoSaveMETAOverride('title', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat, $ovrTitle);
	if (!empty($ovrDesc)) seoSaveMETAOverride('DESCRIPTION', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat, $ovrDesc);
	if (!empty($ovrKeywords)) seoSaveMETAOverride('KEYWORDS', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat, $ovrKeywords);
	return _OVERRIDES_SAVED.'<br /><br />';
}

function nukeNAVdeleteSEO() {
	global $dhName, $dhID, $dhCat, $dhSubCat, $dhLevel;
	seoDeleteMETAOverride('title', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat);
	seoDeleteMETAOverride('DESCRIPTION', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat);
	seoDeleteMETAOverride('KEYWORDS', $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat);
	return _OVERRIDES_DELETED.'<br /><br />';
}
?>