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
if (!defined('YA_ADMIN')) {
	header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	if (!isset($min)) $min=0;
		$min = intval($min);
	if (!isset($susmin)) $susmin=0;
		$susmin = intval($susmin);
	if (!isset($wmin)) $wmin=0;
		$wmin = intval($wmin);
	if ($listtype == 'w') {
		$titledef = _WAITINGUSERS;
		$usertable = '_users_temp';
		$namefield = 'name';
		$where ='';
		$minamt = $wmin; $minv = 'wmin';
	} else {
		$titledef = _YA_USERS;
		$usertable = '_users';
		$namefield = 'name';
		if ($listtype == '') 	{ $where = "WHERE user_id > '1'"; $minamt = $min; $minv = 'min';}				// Regular
		if ($listtype == "a")	{ $where = "WHERE user_id > '1'"; $minamt = $min; $minv = 'min';}				// Regular
		if ($listtype == "-1")	{ $where = "WHERE user_level = '-1' AND user_id > '1'"; $minamt = $susmin; $minv = 'sumin';}
		if ($listtype == "0")	{ $where = "WHERE user_level = '0' AND user_id > '1'"; $minamt = $susmin; $minv = 'sumin';}	// Suspended
		if ($listtype == "1")	{ $where = "WHERE user_level > '0' AND user_id > '1'"; $minamt = $min; $minv = 'min';}		// Active
	}

	if (!isset($max)) {
		$max=$minamt+$ya_config['perpage'];
	}
	$totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.$usertable.' '.$where));
	if ($totalselected == 0) {
		die();
	}
	if (file_exists('includes/mimetype.php')) include('includes/mimetype.php');
	elseif (file_exists('../includes/mimetype.php')) include('../includes/mimetype.php');
	else {
		header('Content-Type: ' . _MIME . ';charset=' . _CHARSET);
		header('Vary: Accept');
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="en">', "\n";
		echo '<head>', "\n";
		echo '<title>&nbsp;</title>';
	}
	echo '</head>', "\n";
	echo '<body>', "\n";
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td style="color: #000000"><span class="thick">'._USERNAME.' ('._USERID.')</span></td>';
	echo '<td align="center" style="color: #000000"><span class="thick">'._UREALNAME.'</span></td>';
	echo '<td align="center" style="color: #000000"><span class="thick">'._EMAIL.'</span></td>';
	echo '<td align="center" style="color: #000000"><span class="thick">'._REGDATE.'</span></td>';
	if ($listtype == 'w') {
		echo '<td style="color: #000000"><span class="thick">'._FIELDNEED.'</span></td>';
	}
	else {
		echo '<td style="color: #000000"><span class="thick">'._YA_LASTVISIT.'</span></td>';
	}
	echo '<td style="color: #000000"><span class="thick">'._FUNCTIONS.'</span></td>';
	echo '</tr>';
	$result = $db->sql_query('SELECT * FROM '.$user_prefix.$usertable.' '.$where.' ORDER BY username LIMIT '.$minamt.','.$ya_config['perpage']);
	while($chnginfo = $db->sql_fetchrow($result)) {
		echo '<tr>';
		echo '<td style="color: #000000">'.$chnginfo['username'].' ('.$chnginfo['user_id'].')</td>';
		echo '<td align="center" style="color: #000000">'.$chnginfo[$namefield].'</td>';
		echo '<td align="center" style="color: #000000">'.$chnginfo['user_email'].'</td>';
		echo '<td align="center" style="color: #000000">'.$chnginfo['user_regdate'].'</td>';
		if ($listtype == 'w') {
			if ($chnginfo['admin_approve']) {
				echo '<td> '._YA_APPROVE2.'</td>';
			}
			else {
				echo '<td> '._WAITINGAPPROVAL.'</td>';
			}
		}
		else {
			if ($chnginfo['lastsitevisit'] == 0) {
				$last = _YA_NONEXPIRE;
			}
			else {
				$last = date("M d, Y g:i a", $chnginfo['lastsitevisit']);
			}
				echo '<td align="center" style="color: #000000">'.$last.'</td>';
		}
		echo '<td>';
		echo '<form action="'.$admin_file.'.php" method="post">';
		echo '<select name="op">';
		if ($listtype == 'w') {
			echo '<option value="yaDetailTemp">'._DETUSER.'</option>';
			if (!$chnginfo['admin_approve'] && $ya_config['requireadmin']) {
				echo '<option value="yaApproveUserConf">'._YA_APPROVE.'</option>';
			}
			echo '<option value="yaActivateUser">'._YA_ACTIVATE.'</option>';
			echo '<option value="yaModifyTemp">'._MODIFY.'</option>';
			echo '<option value="yaDenyUser">'._DENY.'</option>';
			if ($ya_config['servermail']) {
				echo '<option value="yaResendMail">'._RESEND.'</option>';
			}
			} else {
				echo '<option value="yaDetailsUser">'._DETUSER.'</option>';
				echo '<option value="modifyUser">'._MODIFY.'</option>';
		  // suspended
				if ($chnginfo['user_level'] == 0) { echo '<option value="yaRestoreUser">'._RESTORE.'</option>'; }
		  // deactivated
				if ($chnginfo['user_level'] == -1) { echo '<option value="yaRemoveUser">'._REMOVE.'</option>'; }
		  // active
#        if ($chnginfo['user_level'] > 0 AND $radminsuper == 1) { echo '<option value="yaPromoteUser">'._PROMOTE.'</option>'; }
				if ($chnginfo['user_level'] == 1) { echo '<option value="yaSuspendUser">'._SUSPEND.'</option>'; }
				if ($chnginfo['user_level'] > -1) { echo '<option value="yaDeleteUser">'._YA_DEACTIVATE.'</option>'; }
			}
		echo '</select><input type="submit" value="'._OK.'" />';
		echo '<input type="hidden" name="'.$minv.'" value="'.$minamt.'" />';
		echo '<input type="hidden" name="xop" value="'.$op.'" />';
		if ($listtype == 'w') {
			echo '<input type="hidden" name="apr_uid" value="'.$chnginfo['user_id'].'" />';
			echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'" />';
		}
		echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />';
		echo '<input type="hidden" name="listtype" value="'.$listtype.'" />';
		echo '</form></td></tr>';
	}
	echo '</table>';
	echo '<br />', "\n";
	yapagenums($op, $totalselected, $ya_config['perpage'], $max, '', '', '', $listtype);
	echo '</body></html>', "\n";
}
?>