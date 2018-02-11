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
	if (file_exists('includes/mimetype.php')) include('includes/mimetype.php');
	elseif (file_exists('../includes/mimetype.php')) include('../includes/mimetype.php');
	else {
		header('Content-Type: ' . _MIME . ';charset=' . _CHARSET);
		header('Vary: Accept');
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="en">', "\n";
		echo '<head>', "\n";
	}
	echo '<title>&nbsp;</title>';
	echo '</head>', "\n";
	echo '<body>', "\n";
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>';
    asearch();
    if (!empty($listtype)) {
      echo '<br />';
      $listtype = str_replace("\"",'',$listtype);
      $listtype = str_replace("\'",'',$listtype);
      if ($find == 'findUser') { $usertable = $user_prefix."_users"; } else { $usertable = $user_prefix."_users_temp"; }
      if ($match == 'equal') { $sign = "='$listtype'"; } else { $sign = "LIKE '%".$listtype."%'"; }
      if (!isset($smin)) $smin=0;
      $smin = intval($smin);
      if (!isset($max)) $max=$smin+$ya_config['perpage'];
      $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM $usertable WHERE $what $sign"));
      if ($totalselected == 0) {
        die();
      }
      echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
      echo '<tr><td style="color: #000000"><span class="thick">'._USERID.'</span></td>';
      echo '<td style="color: #000000"><span class="thick">'._USERNAME.'</span></td>';
      echo '<td align="center" style="color: #000000"><span class="thick">'._UREALNAME.'</span></td>';
      echo '<td align="center" style="color: #000000"><span class="thick">'._EMAIL.'</span></td>';
      echo '<td align="center" style="color: #000000"><span class="thick">'._REGDATE.'</span></td>';
      echo '<td align="center" style="color: #000000"><span class="thick">'._FUNCTIONS.'</span></td></tr>';
      $sql = 'SELECT * FROM '.$usertable.' WHERE '.$what.' '.$sign.' ORDER BY username LIMIT '.$smin.','.$ya_config['perpage'];
      $result = $db->sql_query($sql);
      while($chnginfo = $db->sql_fetchrow($result)) {
        echo '<tr>';
        echo '<td style="color: #000000">'.$chnginfo['user_id'].'</td>';
        echo '<td style="color: #000000">'.$chnginfo['username'].'</td>';
        echo '<td align="center" style="color: #000000">'.$chnginfo['name'].'</td>';
        echo '<td align="center" style="color: #000000">'.$chnginfo['user_email'].'</td>';
        echo '<td align="center" style="color: #000000">'.$chnginfo['user_regdate'].'</td>';
        echo '<td align="center" style="color: #000000">';
        echo '<form action="'.$admin_file.'.php" method="post"><input type="hidden" name="listtype" value="'.$listtype.'" />';
        echo '<input type="hidden" name="find" value="'.$find.'" />';
        echo '<input type="hidden" name="what" value="'.$what.'" />';
        echo '<input type="hidden" name="match" value="'.$match.'" />';
        echo '<input type="hidden" name="smin" value="'.$smin.'" />';
        echo '<input type="hidden" name="xop" value="'.$op.'" />';
        echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />';
        echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'" />';
        echo '<select name="op">';
        if ($find == 'tempUser') {
            echo '<option value="yaDetailTemp">'._DETUSER.'</option>';
            echo '<option value="yaModifyTemp">'._MODIFY.'</option>';
            echo '<option value="yaResendMail">'._RESEND.'</option>';
            echo '<option value="approveUser">'._YA_APPROVE.'</option>';
            echo '<option value="yaActivateUser">'._YA_ACTIVATE.'</option>';
            echo '<option value="yaDenyUser">'._DENY.'</option>';
        } else {
            echo '<option value="yaDetailsUser">'._DETUSER.'</option>';
            echo '<option value="modifyUser">'._MODIFY.'</option>';
            // suspended
            if ($chnginfo['user_level'] == 0) { echo '<option value="yaRestoreUser">'._RESTORE.'</option>'; }
            // deactivated
            if ($chnginfo['user_level'] == -1) { echo '<option value="yaRemoveUser">'._REMOVE.'</option>'; }
            // active
#            if ($chnginfo['user_level'] > 0 AND $radminsuper == 1) { echo '<option value="yaPromoteUser">'._PROMOTE.'</option>'; }
            if ($chnginfo['user_level'] == 1) { echo '<option value="yaSuspendUser">'._SUSPEND.'</option>'; }
            if ($chnginfo['user_level'] > -1) { echo '<option value="yaDeleteUser">'._YA_DEACTIVATE.'</option>'; }
        }
        echo '</select><input type="submit" value="'._OK.'" /></form></td>';
        echo '</tr>';
      }
      echo '</table>';
      echo '<br />', "\n";
      yapagenums($op, $totalselected, $ya_config['perpage'], $max, $find, $what, $match, $listtype);
    }
    echo '</td></tr></table>';
	echo '</body></html>', "\n";
}
?>