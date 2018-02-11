<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_PUBLIC')) {
	header('Location: ../../../index.php');
}
$pagetitle = _AB_NUKESENTINEL . ': ' . _AB_BLOCKEDREFERERS;
include 'header.php';
stmain_menu(_AB_BLOCKEDREFERERS);
echo '<br />' , "\n";
OpenTable();
$perpage = $ab_config['block_perpage'];
if($perpage == 0) $perpage = 25;
if(!isset($min) || !$min || $min == '') $min = 0;
if(!isset($max)) $max = $min + $perpage;
if(!isset($direction) || !$direction || $direction == '') $direction = 'asc';
$selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $seldirection1 = $seldirection2 = $column = '';
$totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_referers`'));
if($totalselected > 0) {
	echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="' , $bgcolor2 , '" width="100%">' , "\n"
		, '<tr bgcolor="' , $bgcolor2 , '">' , "\n"
		, '<td width="100%"><strong>' , _AB_REFERER , '</strong></td>' , "\n"
		, '</tr>' , "\n";
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsnst_referers` ORDER BY `referer` ' . $direction . ' LIMIT ' . $min . ',' . $perpage);
	while($getIPs = $db->sql_fetchrow($result)) {
		echo '<tr onmouseover="this.style.backgroundColor=\'' , $bgcolor2 , '\'" onmouseout="this.style.backgroundColor=\'' , $bgcolor1 , '\'" bgcolor="' , $bgcolor1 , '">' , "\n"
			, '<td>' , $getIPs['referer'] , '</td>' , "\n"
			, '</tr>' , "\n";
	}
	echo '</table>' , "\n";
	stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction);
} else {
	echo '<div class="text-center"><strong>' , _AB_NOREFERERS , '</strong></div>' , "\n";
}
CloseTable();
include 'footer.php';

?>