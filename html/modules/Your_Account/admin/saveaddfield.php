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

if (isset($field_name) && count($field_name) > 0) {
  foreach ($field_name as $key => $var) {
    $field_size[$key] = intval($field_size[$key]);
    $field_pos[$key] = intval($field_pos[$key]);
    $field_name[$key] = addslashes($field_name[$key]);
    $field_value[$key] = addslashes($field_value[$key]);
    //$result = $db -> sql_query("SELECT '".$field_name[$key]."' FROM ".$user_prefix."_users");
    //$num = $db -> sql_numrows($result);
    $db->sql_query("UPDATE ".$user_prefix."_users_fields SET name='$field_name[$key]', value='$field_value[$key]',size='$field_size[$key]',need='$field_need[$key]',pos='$field_pos[$key]', public='$field_public[$key]' WHERE fid='$key'");
  }
}
if ($mfield_name != "") {
  $mfield_size = intval($mfield_size);
	$mfield_pos = intval($mfield_pos);
  $mfield_name = addslashes($mfield_name);
	$mfield_value = addslashes($mfield_value);
  //$result = $db -> sql_query("SELECT '".$mfield_name."' FROM ".$user_prefix."_users");
  //$num = $db -> sql_numrows($result);
	$db->sql_query("INSERT INTO ".$user_prefix."_users_fields (name, value, size, need, pos, public) VALUES ('$mfield_name','$mfield_value','$mfield_size','$mfield_need','$mfield_pos','$mfield_public')");
}
    Header('Location: '.$admin_file.'.php?op=yaCustomFields');
}

?>