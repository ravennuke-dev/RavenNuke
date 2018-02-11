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

    list($username, $email, $check_num) = $db->sql_fetchrow($db->sql_query("SELECT username, user_email, check_num FROM ".$user_prefix."_users_temp WHERE user_id='$rsn_uid'"));
    if ($ya_config['servermail'] == 1) {
        $time = time();
        $finishlink = "$nukeurl/modules.php?name=$module_name&op=activate&username=$username&check_num=$check_num";
        $message = _WELCOMETO." $sitename!\r\n\r\n";
        $message .= _YOUUSEDEMAIL." ($email) "._TOREGISTER." $sitename.\r\n\r\n";
        $message .= _TOFINISHUSER."\r\n\r\n$finishlink";
        $subject = _ACTIVATIONSUB;
        ya_mail($email, $subject, $message, '');
    }
    $db->sql_query("UPDATE ".$user_prefix."_users_temp SET time='$time' WHERE user_id='$rsn_uid'");
    $pagetitle = ": "._USERADMIN." - "._RESENTMAIL;
    include("header.php");
    amain();
    echo '<br />';
    OpenTable();
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
#    if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
#    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
    echo "<div class='text-center'><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'><span class='thick'>"._RESENTMAIL."</span></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo "</table></div>\n";
    echo '</form>';
    CloseTable();
    include('footer.php');

}

?>