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
$hid = (!isset($hid)) ? 0 : intval($hid);
if (!isset($url)) $url = '';
if ($my_headlines == 1 && defined('LOGGEDIN_SAME_USER')) {
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><strong>' . _MYHEADLINES . '</strong><br /><br />'
		. _SELECTASITE . '<br /><br />'
		. '<form action="modules.php?name=' . $module_name . '" method="post">'
		. '<input type="hidden" name="op" value="userinfo" />'
		. '<input type="hidden" name="username" value="' . $username . '" />'
		. '<input type="hidden" name="bypass" value="' . $bypass . '" />'
		. '<input type="hidden" name="url" value="0" />'
		. '<select name="hid" onchange="submit()">'
		. '<option value="0">' . _SELECTASITE2 . '</option>';
	$sql4 = 'SELECT hid, sitename FROM ' . $prefix . '_headlines ORDER BY sitename';
	$headl = $db->sql_query($sql4);
	while ($row4 = $db->sql_fetchrow($headl)) {
		$nhid = intval($row4['hid']);
		$hsitename = $row4['sitename'];
		if ($hid == $nhid) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option value="' . $nhid . '"' . $sel . '>' . $hsitename . '</option>';
	}
	echo '</select></form>'
		. _ORTYPEURL . '<br /><br />'
		. '<form action="modules.php?name=' . $module_name . '" method="post">'
		. '<input type="hidden" name="op" value="userinfo" />'
		. '<input type="hidden" name="username" value="' . $username . '" />'
		. '<input type="hidden" name="bypass" value="' . $bypass . '" />'
		. '<input type="hidden" name="hid" value="0" />'
		. '<input type="text" name="url" size="40" maxlength="200" value="http://" />&nbsp;&nbsp;'
		. '<input type="submit" value="' . _GO . '" /></form>'
		. '</div><br />';
	if ($hid != 0 OR ($hid == 0 AND $url != '0' AND $url != 'http://') AND $url != '') {
		if ($hid != 0) {
			$sql5 = 'SELECT sitename, headlinesurl FROM ' . $prefix . '_headlines WHERE hid=\'' . $hid . '\'';
			$result5 = $db->sql_query($sql5);
			$row5 = $db->sql_fetchrow($result5);
			$nsitename = $row5['sitename'];
			$url = $row5['headlinesurl'];
			$title = check_html($nsitename, 'nohtml');
			$siteurl = str_ireplace('http://', '', $url);
			$siteurl = explode('/', $siteurl);
		} else {
			if (!stristr($url, 'http://')) {
				$url = 'http://' . $url;
			}
			$siteurl = str_ireplace('http://', '', $url);
			$siteurl = explode('/', $siteurl);
			$title = 'http://' . $siteurl[0];
		}
		$refresh = 3600;
		$content = seoReadFeed($url, $refresh);
		OpenTable2();
		echo '<div class="text-center"><strong>' . _HEADLINESFROM . ' <a href="http://' . $siteurl[0] . '" target="_blank">' . $title . '</a></strong></div><br />';
		echo $content;
		CloseTable2();
		$content = '';
		echo '<br />';
	}
	CloseTable();
}
function ya_superhtmlentities($text) {
	// Thanks to mirrorball_girl for this
	$entities = array(
		128 => 'euro',
		130 => 'sbquo',
		131 => 'fnof',
		132 => 'bdquo',
		133 => 'hellip',
		134 => 'dagger',
		135 => 'Dagger',
		136 => 'circ',
		137 => 'permil',
		138 => 'Scaron',
		139 => 'lsaquo',
		140 => 'OElig',
		145 => 'lsquo',
		146 => 'rsquo',
		147 => 'ldquo',
		148 => 'rdquo',
		149 => 'bull',
		150 => '#45',
		151 => 'mdash',
		152 => 'tilde',
		153 => 'trade',
		154 => 'scaron',
		155 => 'rsaquo',
		156 => 'oelig',
		159 => 'Yuml'
	);
	$new_text = '';
	$j = strlen($text);
	for ($i = 0;$i < $j;++$i) {
		$num = ord($text[$i]);
		if (array_key_exists($num, $entities)) {
			switch ($num) {
				case 150:
					$new_text .= '-';
					break;
				default:
					$new_text .= '&' . $entities[$num] . ';';
			}
		} else if ($num < 127 || $num > 159) {
			$new_text .= htmlentities($text[$i]);
		}
	}
	$new_text = preg_replace('#  +#', ' ', $new_text); // Remove anything greater than one space.
	return $new_text;
}
function ya_doti($str, $len = 500, $dots = '...') {
	// $len=max length of hometext displayed
	if (strlen($str) > $len) {
		// $dot = " whatever you want here ")
		$str = explode('.', $str);
		// Displayed at the end of hometext
		$dotlen = strlen($dots);
		$str = substr_replace($str[0] . $str[1] . $str[2] . $str[3] . $str[4], $dots, $len-$dotlen);
	}
	return $str;
}
?>