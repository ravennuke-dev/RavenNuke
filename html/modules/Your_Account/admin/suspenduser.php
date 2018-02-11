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

    list($uname) = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='$chng_uid'"));
    $pagetitle = ": "._USERADMIN." - "._SUSPENDUSER;
    include("header.php");
    title(_USERADMIN." - "._SUSPENDUSER);
    amain();
    echo '<br />';
    OpenTable();
    echo '<div class="text-center"><form action="'.$admin_file.'.php" method="post">';
    if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<input type='hidden' name='op' value='yaSuspendUserConf' />\n";
    echo "<input type='hidden' name='sus_uid' value='$chng_uid' />\n";
    echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'>"._SURE2SUSPEND." <span class='thick'>$uname<span class='italic'>($chng_uid)</span></span>?</td></tr>\n";
    if ($ya_config['servermail'] == 1) {
        echo "<tr><td align='center'>"._SUSPENDREASON."<br /><textarea name='suspendreason' rows='5' cols='40'></textarea></td></tr>\n";
    }
    echo "<tr><td align='center'><input type='submit' value='"._SUSPENDUSER."' /></td></tr>\n";
    echo '</table>';
    echo '</form>';
    echo "<form action='#' method='post'>\n";
    echo "<input type='button' value='"._CANCEL."' onclick=\"history.go(-1)\" />\n";
    echo "</form></div>\n";
    CloseTable();
    include('footer.php');

}

?>