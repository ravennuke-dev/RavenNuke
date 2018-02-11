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

    if ($ya_config['autosuspend'] > 0){
        $st = time() - $ya_config['autosuspend'];
        $susresult = $db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE lastsitevisit <= '.$st.' AND user_level > 0');
        while(list($sus_uid) = $db->sql_fetchrow($susresult)) {
          $db->sql_query('UPDATE '.$user_prefix.'_users SET user_level=\'0\', user_active=\'0\' WHERE user_id=\''.$sus_uid.'\'');
        }
    }
    Header('Location: '.$admin_file.'.php?op=yaUsers');
}

?>