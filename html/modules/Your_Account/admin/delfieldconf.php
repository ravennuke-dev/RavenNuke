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

    //$pagetitle = ": "._USERADMIN." - "._ACCTDENY;
    //include("header.php");
    //amain();
    //echo '<br />';		echo "tes44te";
    //OpenTable();
    $db->sql_query("DELETE FROM ".$user_prefix."_users_fields WHERE fid='$fid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_users_field_values WHERE fid='$fid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp_field_values WHERE fid='$fid'");
    //CloseTable();
    //include('footer.php');
    Header('Location:'.$admin_file.'.php?op=yaCustomFields');

}

?>