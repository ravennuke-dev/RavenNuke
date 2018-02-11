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
if (!defined('YA_ADMIN'))
{
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	include_once('header.php');
    list($username, $realname, $email, $check_num) = $db->sql_fetchrow($db->sql_query("SELECT username, name, user_email, check_num FROM ".$user_prefix."_users_temp WHERE user_id='$act_uid'"));

    $pagetitle = ": "._USERADMIN." - "._YA_APPROVEUSER;

    title(_USERADMIN." - "._YA_APPROVEUSER);
    amain();
    echo '<br />';

    OpenTable();
        echo '<div class="text-center">'._SURE2ACTIVATE.':</div><br />';

    OpenTable();
        echo '<table border="0" align="center">';
        echo '<tr><td width="50%"><span class="thick">'._USERNAME.':</span></td><td align="left">'.$username.'<br /></td></tr>';
        echo '<tr><td width="50%"><span class="thick">'._UREALNAME.':</span></td><td align="left">'.$realname.'<br /></td></tr>';
        echo '<tr><td width="50%"><span class="thick">'._EMAIL.':</span></td><td align="left">'.$email.'</td></tr>';
        echo '</table>';
    CloseTable();

    echo '<div class="text-center"><form action="'.$admin_file.'.php" method="post">';
    if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'; }
    if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'; }
    echo '<input type="hidden" name="op" value="yaApproveUserConf" />';
    echo '<input type="hidden" name="apr_uid" value="'.$apr_uid.'" />';
    echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
    echo '<tr><td align="center"><input type="submit" value="'._YA_APPROVEUSER.'" /></td></tr>';
    echo '</table>';
    echo '</form>';
    echo '<form action="#" method="post">';
		echo '<input type="button" value="'._CANCEL.'" onclick="history.go(-1)" />';
    echo '</form></div>';
    CloseTable();
    include_once('footer.php');
}
?>