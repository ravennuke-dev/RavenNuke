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
if (!defined('RNYA')) {
	header('Location: ../../../../index.php');
	die();
}
$uid = (int)$usrinfo['user_id'];
if (is_admin($admin)) {
	echo '<br />';
	OpenTable();
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_subscriptions WHERE userid=\'' . $uid . '\'');
	if ($db->sql_numrows($result) != 0) {
		echo '<div class="text-center thick">' . _ADMSUB . '</div><br />';
		$row = $db->sql_fetchrow($result);
		$diff = $row['subscription_expire'] - time();
		$yearDiff = floor($diff/60/60/24/365);
		$diff -= $yearDiff*60*60*24*365;
		if ($yearDiff < 1) {
			$diff = $row[subscription_expire]-time();
		}
		$daysDiff = floor($diff/60/60/24);
		$diff -= $daysDiff*60*60*24;
		$hrsDiff = floor($diff/60/60);
		$diff -= $hrsDiff*60*60;
		$minsDiff = floor($diff/60);
		$diff -= $minsDiff*60;
		$secsDiff = $diff;
		if ($yearDiff < 1) {
			$rest = $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
		} elseif ($yearDiff == 1) {
			$rest = $yearDiff . ' ' . _SBYEAR . ', ' . $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
		} elseif ($yearDiff > 1) {
			$rest = $yearDiff . ' ' . _SBYEARS . ', ' . $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
		}
		echo '<div class="text-center thick">' . _ADMSUBEXPIREIN . '<br /><span style="color:#FF0000">' . $rest . '</span></div>';
	} else {
		echo '<div class="text-center thick">' . _ADMNOTSUB . '</div>';
	}
	CloseTable();
} elseif (paid() && defined('LOGGEDIN_SAME_USER')) {
	echo '<br />';
	OpenTable();
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_subscriptions WHERE userid=\'' . $uid . '\''));
	if ($subscription_url != '') {
		echo '<div class="text-center">' . _YOUARE . ' <a href="' . $subscription_url . '">' . _SUBSCRIBER . '</a> ' . _OF . ' ' . $sitename . '<br />';
	} else {
		echo '<div class="text-center">' . _YOUARE . ' ' . _SUBSCRIBER . ' ' . _OF . ' ' . $sitename . '<br />';
	}
	$diff = $row['subscription_expire'] - time();
	$yearDiff = floor($diff/60/60/24/365);
	$diff -= $yearDiff*60*60*24*365;
	if ($yearDiff < 1) {
		$diff = $row['subscription_expire'] - time();
	}
	$daysDiff = floor($diff/60/60/24);
	$diff -= $daysDiff*60*60*24;
	$hrsDiff = floor($diff/60/60);
	$diff -= $hrsDiff*60*60;
	$minsDiff = floor($diff/60);
	$diff -= $minsDiff*60;
	$secsDiff = $diff;
	if ($yearDiff < 1) {
		$rest = $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
	} elseif ($yearDiff == 1) {
		$rest = $yearDiff . ' ' . _SBYEAR . ', ' . $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
	} elseif ($yearDiff > 1) {
		$rest = $yearDiff . ' ' . _SBYEARS . ', ' . $daysDiff . ' ' . _SBDAYS . ', ' . $hrsDiff . ' ' . _SBHOURS . ', ' . $minsDiff . ' ' . _SBMINUTES . ', ' . $secsDiff . ' ' . _SBSECONDS;
	}
	echo '<span class="thick">' . _SUBEXPIREIN . '<br /><span style="color:#FF0000">' . $rest . '</span></span></div>';
	CloseTable();
} elseif (!paid() && defined('LOGGEDIN_SAME_USER')) {
	echo '<br />';
	OpenTable();
	if ($subscription_url != '') {
		echo '<div class="text-center">' . _NOTSUB . ' ' . $sitename . '. ' . _SUBFROM . ' <a href="' . $subscription_url . '">' . _HERE . '</a> ' . _NOW . '</div>';
	} else {
		echo '<div class="text-center">' . _NOTSUB . ' ' . $sitename . '.</div>';
	}
	CloseTable();
}
?>