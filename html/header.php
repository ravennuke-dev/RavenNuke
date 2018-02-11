<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}
if (!defined('NUKE_HEADER')) define('NUKE_HEADER', true);
require_once 'mainfile.php';
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
global $tnsl_bUseShortLinks, $tnsl_bAutoTapBlocks, $tnsl_bAutoTapLinks, $tnsl_bDebugShortLinks, $tnsl_sGTFilePath;
if (defined('TNSL_USE_SHORTLINKS')) {
	$GLOBALS['tnsl_asGTFilePath'] = tnsl_fPageTapStart();
}
/*
 * Include some common header for HTML generation
 */
function head() {
	global $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle, $name, $db, $prefix, $nukeNAV;
	// Initialize CSS and JS arrays
	$headCSS = array();
	// Post 138905 Step 3
	addCSSToHead('themes/ravennuke.css', 'file');
	$headJS  = array();  // added inside HEAD tags
	$bodyJS  = array(); // added at bottom of page, before </BODY>
	$ThemeSel = get_theme();
	// Post 138905 Step 1
	include_once NUKE_THEMES_DIR . $ThemeSel . '/theme.php';
	// Tolerant baseURL Hack - VinDSL (Lenon.com)
	$base_url = $_SERVER['HTTP_HOST'];
	//include_once 'includes/meta.php';
	// nukeSEO Dynamic HEAD - load HTML, HEAD tags
	include_once NUKE_INCLUDE_DIR . 'nukeSEO/nukeSEOdh.php';
	// Post 138905 Step 2
	if (defined('THEME_FAVICON'))
		echo '<link rel="shortcut icon" href="themes/', $ThemeSel, '/images/favicon.ico" type="image/x-icon" />', "\n";
	else if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/favicon.ico')) {
		echo '<link rel="shortcut icon" href="themes/' , $ThemeSel , '/images/favicon.ico" type="image/x-icon" />', "\n";
	}
	// Post 138905 Step 4
	addCSSToHead('themes/' . $ThemeSel . '/style/style.css','file');

	//
	// Support custom CSS on a per-module basis (RN0000391)
	// Module authors need to define RN_MODULE_CSS to name the external style sheet they want to load
	// and we will add a link to their stylesheet file automatically.
	// KG: The only example of using module-specific, theme CSS is Forums - do any themes actually use this?
	if (defined('RN_MODULE_CSS')) {
		$modCssFile = 'themes/' . $ThemeSel . '/style/' . RN_MODULE_CSS;
		if (file_exists($modCssFile)) {
			addCSSToHead($modCssFile, 'file');
		}
	}
	// Post 138905 Step 5
	include_once NUKE_INCLUDE_DIR . 'javascript.php';
	// Post 138905 Step 6
	include_once NUKE_INCLUDE_DIR . 'jquery/jquery.php';
	include_once NUKE_INCLUDE_DIR . 'jquery/jquery.colorbox.php';
	include_once NUKE_INCLUDE_DIR . 'tabcontent/tabcontent.php';
	include_once NUKE_INCLUDE_DIR . 'ajaxtabs/ajaxtabs.php';
	include_once NUKE_INCLUDE_DIR . 'custom_files/nukeSEO/nukePIEhdr.php';
	include_once NUKE_INCLUDE_DIR . 'custom_files/nukeSEO/nukeFEEDhdr.php';
	// nukeNAV(tm)
	include_once NUKE_INCLUDE_DIR . 'jquery/nukeNAV.php';
	// Post 138905 Step 7
	$addons = readDIRtoArray(NUKE_INCLUDE_DIR . 'addons', '/^head\-(.+)\.php/');
	foreach ($addons as $addon) {
		include_once NUKE_INCLUDE_DIR . 'addons/'.$addon;
	}
	$addons = readDIRtoArray(NUKE_INCLUDE_DIR . 'addons', '/^body\-(.+)\.php/');
	foreach ($addons as $addon) {
		include_once NUKE_INCLUDE_DIR . 'addons/'.$addon;
	}
	// Post 138905 Step 8 - RN_MODULE_HEAD should contain the file to include, with a path relative to the module folder
	if (defined('RN_MODULE_HEAD')) include_once NUKE_MODULES_DIR . $name . '/' . RN_MODULE_HEAD;
	writeHEAD();
	// Post 138905 Step 9
	if (file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_head.php')) {
		include_once NUKE_INCLUDE_DIR . 'custom_files/custom_head.php';
	}
	echo "\n\n", '</head>', "\n";
	if (file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_header.php')) {
		include_once NUKE_INCLUDE_DIR . 'custom_files/custom_header.php';
	}
	global $ab_config;
	if ($ab_config['site_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<div class="text-center"><img src="images/nukesentinel/disabled.png" alt="' . _AB_SITEDISABLED . '" title="' . _AB_SITEDISABLED . '" border="0" /></div><br />';
	}
	if ($ab_config['disable_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<div class="text-center"><img src="images/nukesentinel/inactive.png" alt="' . _AB_NSDISABLED . '" title="' . _AB_NSDISABLED . '" border="0" /></div><br />';
	}
	if ($ab_config['test_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<div class="text-center"><img src="images/nukesentinel/testmode.png" alt="' . _AB_TESTMODE . '" title="' . _AB_TESTMODE . '" border="0" /></div><br />';
	}
	themeheader();
}
online();
head();
include_once NUKE_INCLUDE_DIR . 'counter.php';
if (defined('HOME_FILE')) {
	blocks('t');
	message_box();
	blocks('c');
}

?>