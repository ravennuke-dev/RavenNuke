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

    list($email) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users_temp WHERE user_id='$dny_uid'"));
    if ($ya_config['servermail'] == 1) {
        $message = _SORRYTO." $sitename "._HASDENY;
        if ($denyreason > "") {
            $denyreason = stripslashes($denyreason);
            $message .= "\r\n\r\n"._DENYREASON."\r\n$denyreason";
        }
        $subject = _ACCTDENY;
        ya_mail($email, $subject, $message, '');
    }
    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE user_id='$dny_uid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp_field_values WHERE uid='$dny_uid'");
	$db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp");
    $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp_field_values");
	$pagetitle = ": "._USERADMIN." - "._ACCTDENY;
    include("header.php");
    amain();
    echo '<br />';
    OpenTable();
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
    if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
    echo "<div class='text-center'><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'><span class='thick'>"._ACCTDENY."</span></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo "</table></div>\n";
    echo '</form>';
    CloseTable();
    include('footer.php');

}

?>