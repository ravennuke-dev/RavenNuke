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
/* RN Your Account is based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
if (!isset($avatarcategory)) die();
include_once 'header.php';
$avatarcategory = check_html(basename($avatarcategory),'nohtml');
$avatarcatname = str_replace('_', '&nbsp;', $avatarcategory);
title($avatarcategory . ' ' . _YA_AVATARGALL);
Opentable();
nav();
CloseTable();
echo '<br />';
Opentable();
echo '<div align="center"><span class="title thick">' . _AVAILABLEAVATARS . ' ' . _YA_ONCAT . ' ' . $avatarcatname . '</span><br /><br />';
echo '<span class="thick">' . _YA_TOSELCTAVAT . '</span><br /><br />';
Opentable2();
//avatarfix by menelaos dot hetnet dot nl - adjusted by montego to eliminate wasted SQL calls
$resultbc = $db->sql_query('SELECT config_value FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_gallery_path\'');
list($direktori) = $db->sql_fetchrow($resultbc);
$directory = $direktori . '/' . $avatarcategory;
if (is_dir($directory)) {
	// remote php code execution identified by waraxe
	$patterns = array();
	$replacements = array();
	// montego - moved following code out of while loop as the values never change
	$patterns[0] = '/\.gif/';
	$patterns[1] = '/\.png/';
	$patterns[2] = '/\.jpg/';
	$patterns[3] = '/\.jpeg/';
	$patterns[4] = '/-/';
	$patterns[5] = '/_/';
	$replacements[5] = '';
	$replacements[4] = '&nbsp;';
	$replacements[3] = '';
	$replacements[2] = '';
	$replacements[1] = '';
	$replacements[0] = '';
	ksort($patterns);
	ksort($replacements);
	$itemcount = 1;
	$dh = opendir($directory);
	while (($entry = readdir($dh)) !== false) {
		if (preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $entry)) {
			if ($entry != '.' && $entry != '..' && is_file($directory . '/' . $entry) && !is_link($directory . '/' . $entry)) {
				$entryname = preg_replace($patterns, $replacements, $entry);
				//avatarfix by menelaos dot hetnet dot nl
				echo '<a href="modules.php?name=' . $module_name . '&amp;op=avatarsave&amp;category=' . $avatarcategory
					. '&amp;avatar=' . $entry . '"><img src="' . $directory . '/' . $entry . '" border="0" alt="'
					. $entryname . '" title="' . $entryname . '" hspace="10" vspace="10" /></a>';
			}
			if ($itemcount == 10) {
				echo '<br />';
				$itemcount -= 10;
			}
			++$itemcount;
		}
	}
	closedir($dh);
}
CloseTable2();
echo '<br />' . _GOBACK . '<br /></div>';
CloseTable();
include_once 'footer.php';
?>