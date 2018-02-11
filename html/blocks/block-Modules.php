<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}


global $prefix, $db, $admin, $user, $modlist;

if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	} else {
	$ListClass = 'ul-box';
}
$content = '';
$ThemeSel = get_theme();
$row = $db->sql_fetchrow($db->sql_query('SELECT main_module FROM ' . $prefix . '_main'));
$main_module = $row['main_module'];

/* Now we make the Modules block with the correspondent links */

$content .= '<div class="' . $ListClass . ' block-modules"><ul class="rn-ul">
<li><a href="index.php">' . _HOME . '</a></li>';
$result3 = $db->sql_query('SELECT * FROM ' . $prefix . '_modules WHERE active=1 AND inmenu=1 ORDER BY custom_title ASC');
while ($row3 = $db->sql_fetchrow($result3)) {
    $groups = $row3['groups'];
    $m_title = stripslashes($row3['title']);
    $custom_title = $row3['custom_title'];
    $view = intval($row3['view']);
    $m_title2 = str_replace('_', ' ', $m_title);
    if (!empty($custom_title)) {
        $m_title2 = $custom_title;
    }
    if ($m_title != $main_module) {
        if ($view == 0) {
            $content .= '<li><a href="modules.php?name=' . $m_title . '">' . $m_title2 . '</a></li>';
        } elseif ($view == 1 AND ((is_user($user) AND is_group($user, $m_title)) OR is_admin($admin))) {  //RN0000119, RN0000317
            $content .= '<li><a href="modules.php?name=' . $m_title . '">' . $m_title2 . '</a></li>';
        } elseif ($view == 2 AND is_admin($admin)) {
            $content .= '<li><a href="modules.php?name=' . $m_title . '">' . $m_title2 . '</a></li>';
        } elseif ($view == 3 AND (paid() OR is_admin($admin))) {  //RN0000119, RN0000317
            $content .= '<li><a href="modules.php?name=' . $m_title . '">' . $m_title2 . '</a></li>';
        } elseif ($view > 3 AND in_groups($groups)) {
            $content .= '<li><a href="modules.php?name=' . $m_title . '">' . $m_title2 . '</a></li>';
        }
    }
}
$content .= '</ul>';
/* If you're Admin you and only you can see Inactive modules and test it */
/* If you copied a new module is the /modules/ directory, it will be added to the database */

if (is_admin($admin)) {
    $a = 0;
	$InvisiMod = '';
    $result5 = $db->sql_query('SELECT title, custom_title FROM ' . $prefix . '_modules WHERE active=1 AND inmenu=0 ORDER BY custom_title ASC');
    while ($row5 = $db->sql_fetchrow($result5)) {
        $mn_title = stripslashes($row5['title']);
        $custom_title = $row5['custom_title'];
        $mn_title2 = str_replace('_', ' ', $mn_title);
        if (!empty($custom_title)) {
            $mn_title2 = $custom_title;
        }
        if (!empty($mn_title2)) {
            ++$a;
            $InvisiMod .= '<li><a href="modules.php?name=' . $mn_title . '">' . $mn_title2 . '</a></li>';
        }
    }
    if ($a > 0) {
		$content .= '<div class="padded-box text-center clear-both"><span class="thick">' . _INVISIBLEMODULES . '</span> (' . $a . ')<br />';
		$content .= '<span class="tiny">' . _ACTIVEBUTNOTSEE . '</span></div>';
		$content .= '<ul class="rn-ul ul-admin">';
        $content .= $InvisiMod;
		$content .= '</ul>';
    }
	$a = 0;
	$InactiMod = '';
    $result6 = $db->sql_query('SELECT title, custom_title FROM ' . $prefix . '_modules WHERE active=0 ORDER BY custom_title ASC');
    while ($row6 = $db->sql_fetchrow($result6)) {
        $mn_title = stripslashes($row6['title']);
        $custom_title = $row6['custom_title'];
        $mn_title2 = str_replace('_', ' ', $mn_title);
        if (!empty($custom_title)) {
            $mn_title2 = $custom_title;
        }
        if (!empty($mn_title2)) {
            ++$a;
            $InactiMod .= '<li><a href="modules.php?name=' . $mn_title . '">' . $mn_title2 . '</a></li>';
        }
    }
    if ($a > 0) {
		$content .= '<div class="padded-box text-center clear-both"><span class="thick">' . _NOACTIVEMODULES . '</span> (' . $a . ')<br />';
		$content .= '<span class="tiny">' . _FORADMINTESTS . '</span></div>';
		$content .= '<ul class="rn-ul ul-admin">';
        $content .= $InactiMod;
		$content .= '</ul>';
    }
	$InlineJS = '<script type="text/javascript">'."\n";
	$InlineJS .= '$(document).ready(function(){'."\n";
	$InlineJS .= '  $(".block-modules .ul-admin").hide();'."\n";
	$InlineJS .= '  $(".block-modules div.padded-box.text-center.clear-both").css("cursor","pointer");'."\n";
	$InlineJS .= '  $(".block-modules div.padded-box.text-center.clear-both").click(function(){'."\n";
	$InlineJS .= '    $(this).next().slideToggle("slow");'."\n";
	$InlineJS .= '  });'."\n";
	$InlineJS .= '});'."\n";
	$InlineJS .= '</script>'."\n";
	addJSToBody($InlineJS, 'inline');
}
$content .= '</div>';
// make sure content does not float outside the block  
$content .= '<div class="block-spacer">&nbsp;</div>';
?>