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

    list($email) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_id='$sus_uid'"));
    if ($ya_config['servermail'] == 1) {
        $message = _SORRYTO." $sitename "._HASSUSPEND;
        if ($suspendreason > "") {
            $suspendreason = stripslashes($suspendreason);
            $message .= "\r\n\r\n"._SUSPENDREASON."\r\n$suspendreason";
        }
        $subject = _ACCTSUSPEND;
        ya_mail($email, $subject, $message, '');
    }
    $db->sql_query("UPDATE ".$user_prefix."_users SET user_level='0', user_active='0' WHERE user_id='$sus_uid'");
    $pagetitle = ": "._USERADMIN." - "._ACCTSUSPEND;
    include("header.php");
    amain();
    echo '<br />';
    OpenTable();
    echo '<div class="text-center"><form action="'.$admin_file.'.php?op=yaUsers" method="post">';
    echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'><span class='thick'>"._ACCTSUSPEND."</span></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo '</table>';
    echo "</form></div>\n";
    CloseTable();
    include('footer.php');

}

?>