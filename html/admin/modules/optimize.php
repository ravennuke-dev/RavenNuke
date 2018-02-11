<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Optimize your database                                               */
/*                                                                      */
/* Copyright (c) 2001 by Xavier JULIE (webmaster@securite-internet.org  */
/* http://www.securite-internet.org                                     */
/*                         */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
global $prefix, $db, $admin_file;
$total_gain = 0;
$histo = 0;
$cpt = 0;
if (is_mod_admin('admin')) {
	include_once('header.php');
	GraphicAdmin();
	title(_DBOPTIMIZATION);
	OpenTable();
	echo '<div class="text-center"><span class="title">' . _OPTIMIZINGDB . ' ' . $dbname . '</span></div><br /><br />'
		. '<table border="1" align="center"><tr><td align="center"><strong>' . _TABLE . '</strong></td>'
		. '<td align="center"><strong>' . _SIZE . '</strong></td>'
		. '<td align="center"><strong>' . _STATUS . '</strong></td>'
		. '<td align="center"><strong>' . _SPACESAVED . '</strong></td></tr>';
	$db_clean = $dbname;
	$tot_data = 0;
	$tot_idx = 0;
	$tot_all = 0;
	$local_query = 'SHOW TABLE STATUS FROM ' . $dbname;
	$result = $db->sql_query($local_query);
	if ($db->sql_numrows($result)) {
		while ($row = $db->sql_fetchrow($result)) {
			$tot_data = $row['Data_length'];
			$tot_idx = $row['Index_length'];
			$total = $tot_data+$tot_idx;
			$total = $total/1024;
			$total = round($total, 3);
			$gain = $row['Data_free'];
			$gain = $gain/1024;
			$total_gain += $gain;
			$gain = round($gain, 3);
			$local_query = 'OPTIMIZE TABLE ' . $row[0];
			$resultat = $db->sql_query($local_query);
			if ($gain == 0) {
				echo '<tr><td>' . $row[0] . '</td>' . '<td>' . $total . ' Kb' . '</td>' . '<td>'
					. _ALREADYOPTIMIZED . '</td><td>0 Kb</td></tr>';
			} else {
				echo '<tr><td class="thick">' . $row[0] . '</td>' . '<td class="thick">' . $total . ' Kb' . '</td>' . '<td class="thick">'
					. _OPTIMIZED . '</td><td class="thick">' . $gain . ' Kb</td></tr>';
			}
		}
	}
	echo '</table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	$total_gain = round($total_gain, 3);
	echo '<div class="text-center"><span class="thick">' . _OPTIMIZATIONRESULTS . '</span><br /><br />'
		. _TOTALSPACESAVED . ' ' . $total_gain . ' Kb<br />';
	$sql_query = 'CREATE TABLE IF NOT EXISTS ' . $prefix . '_optimize_gain(gain decimal(10,3)) ENGINE=MyISAM';
	$result = $db->sql_query($sql_query);
	$sql_query = 'INSERT INTO ' . $prefix . '_optimize_gain (gain) VALUES (\'' . $total_gain . '\')';
	$result = $db->sql_query($sql_query);
	$sql_query = 'SELECT * FROM ' . $prefix . '_optimize_gain';
	$result = $db->sql_query($sql_query);
	while ($row = $db->sql_fetchrow($result)) {
		$histo+=$row[0];
		$cpt+=1;
	}
	echo _YOUHAVERUNSCRIPT . ' ' . $cpt . ' ' . _TIMES . '<br />'
		. $histo . ' ' . _KBSAVED . '</div>';
	CloseTable();
	include_once('footer.php');
} else {
	echo 'Access Denied';
}
?>