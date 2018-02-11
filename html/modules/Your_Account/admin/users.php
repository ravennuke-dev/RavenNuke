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
if (!defined('YA_ADMIN'))
{
   header('Location: ../../../index.php');
  die ();
}

// set some vars to stop notice errors
if(!isset($min)) $min = '';
if(!isset($smin)) $smin = '';
if(!isset($susmin)) $susmin = '';
if(!isset($wmin)) $wmin = '';
if(!isset($by)) $by = '';
if(!isset($listtype)) $listtype = '';
if(!isset($find)) $find = '';
if(!isset($what)) $what = '';
if(!isset($match)) $match = '';

if (($radminsuper==1) OR ($radminuser==1))
{
    $pagetitle = ": "._USERADMIN." - "._YA_USERS;
    include_once('header.php');
    title(_USERADMIN.": "._YA_USERS);
    amain();
    echo '<br />';
    $act = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users WHERE user_level>\'0\' AND user_id>\'1\''));
    $sus = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users WHERE user_level=\'0\' AND user_id>\'1\''));
    $del = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users WHERE user_level=\'-1\' AND user_id>\'1\''));
    $nor = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users WHERE user_id>\'1\''));
    $pen = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users_temp'));

    if ($op == 'yaListPending') $listtype = 'w';
    $sela = $selw = '';
    if ($listtype == 'w') {
      $selw = 'class="selected"';
      $persist = 'false';
    }
    else {
      $sela = 'class="selected"';
      $persist = 'true';
    }
    OpenTable();
    echo '<div style="height: 31px; padding: 0px 10px;">';
    echo '<ul id="usertabs" class="shadetabs">';
    if ($pen > 0 or $listtype=='w') echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaListUsers&amp;listtype=w&amp;wmin='.$wmin.'" '.$selw.'><span class="left">&nbsp;</span>'._WAITINGUSERS.' ('.$pen.')<span class="right">&nbsp;</span></a></li>';
    if ($sus > 0) echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaListUsers&amp;listtype=0&amp;sumin='.$susmin.'"><span class="left">&nbsp;</span>'._SUSPENDUSERS.' ('.$sus.')<span class="right">&nbsp;</span></a></li>';
    if ($del > 0) echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaListUsers&amp;listtype=-1&amp;sumin='.$susmin.'"><span class="left">&nbsp;</span>'._DELETEUSERS.' ('.$del.')<span class="right">&nbsp;</span></a></li>';
    echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaListUsers&amp;listtype=a&amp;min='.$min.'"><span class="left">&nbsp;</span>'._NORMALUSERS.' ('.$nor.')<span class="right">&nbsp;</span></a></li>';
    echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaListUsers&amp;listtype=1&amp;min='.$min.'"><span class="left">&nbsp;</span>'._ACTIVEUSERS.' ('.$act.')<span class="right">&nbsp;</span></a></li>';
    echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaSearchUser&amp;smin='.$smin.'&amp;find='.$find.'&amp;what='.$what.'&amp;by='.$by.'&amp;match='.$match.'&amp;listtype='.$listtype.'" '.$sela.'><span class="left">&nbsp;</span>'._SEARCHUSERS.'<span class="right">&nbsp;</span></a></li>';
    echo '<li><a rel="usertabcontainer" href="'.$admin_file.'.php?op=yaAddUser"><span class="left">&nbsp;</span>'._ADDUSER.'<span class="right">&nbsp;</span></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '<div id="usertabcontainer" style="background: white; border:1px solid gray; width:97%; margin-top:0; margin-bottom: 1em; padding: 10px">';
    echo 'Content 1';
    echo '</div>';
    echo '<script type="text/javascript">
          var usercfg=new ddajaxtabs("usertabs", "usertabcontainer")
          usercfg.setpersist('.$persist.')
          usercfg.setselectedClassTarget("link")
          usercfg.init()
          </script>';
    CloseTable();
    include_once('footer.php');

}

?>