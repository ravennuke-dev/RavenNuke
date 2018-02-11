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

if ( !defined('MODULE_FILE') )
{
    die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once('header.php');
global $db, $prefix;
if ((isset($query) AND !isset($eid)) AND (!empty($query))) {
	$query = htmlentities(check_html($query, 'nohtml'), ENT_QUOTES);
    $result = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE title LIKE '%".addslashes($query)."%' ORDER BY title");
    $row = $db->sql_fetchrow($result);
    $ency_title = stripslashes(check_html($row['title'], 'nohtml'));
    title($ency_title.': '._SEARCHRESULTS);
    OpenTable();
    echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
    echo '<div class="text-center"><p class="thick">'._SEARCHRESULTSFOR.' <span class="italic">'.$query.'</span></p></div>'
        .'<p class="italic thick">'._RESULTSINTERMTITLE.'</p><p>';
    if ($numrows = $db->sql_numrows($result) == 0) {
        echo _NORESULTSTITLE;
    } else {
        while ($row = $db->sql_fetchrow($result)) {
            $tid = intval($row['tid']);
            $title = stripslashes(check_html($row['title'], 'nohtml'));
            echo "<strong><span class='larger'>&middot;</span></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a><br />";
        }
    }
    $result2 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE text LIKE '%".addslashes($query)."%' ORDER BY title");
    $numrows = $db->sql_numrows($result2);
    echo '</p><p class="italic thick">'._RESULTSINTERMTEXT.'</p><p>';
    if ($numrows == 0) {
        echo _NORESULTSTEXT;
    } else {
        while ($row2 = $db->sql_fetchrow($result2)) {
            $tid = intval($row2['tid']);
            $title = stripslashes(check_html($row2['title'], 'nohtml'));
            echo "<strong><span class='larger'>&middot;</span></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;query=$query\">$title</a><br />";
        }
    }
    if (isset($eid)) { $eid = intval($eid); } else { $eid = ''; }
    echo '</p>'
        .'<div class="text-center"><form action="modules.php?name='.$module_name.'&amp;file=search" method="post">'
        .'<input type="text" size="20" name="query" value="" />&nbsp;&nbsp;'
        .'<input type="hidden" name="eid" value="'.$eid.'" />'
        .'<input type="submit" value="'._SEARCH.'" />'
        .'</form><p>'
        .'[ <a href="modules.php?name='.$module_name.'">'._RETURNTO.' '.$module_name.'</a> ]'
        ._GOBACK.'</p></div>';
    echo '</td></tr></table>';
    CloseTable();
} elseif ((isset($query) AND isset($eid)) AND (!empty($query))) {
	$query = htmlentities(check_html($query, 'nohtml'), ENT_QUOTES);
    $eid = intval($eid);
    $result3 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND title LIKE '%".addslashes($query)."%' ORDER BY title");
    $row4 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
    $ency_title = stripslashes(check_html($row4['title'], 'nohtml'));
    title($ency_title.': '._SEARCHRESULTS);
    OpenTable();
    echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
    echo '<div class="text-center"><p class="thick">'._SEARCHRESULTSFOR.' <span class="italic">'.$query.'</span></p></div>'
        .'<p class="italic thick">'._RESULTSINTERMTITLE.'</p><p>';
    if ($numrows = $db->sql_numrows($result3) == 0) {
        echo _NORESULTSTITLE;
    } else {
        while ($row3 = $db->sql_fetchrow($result3)) {
            $tid = intval($row3['tid']);
            $title = stripslashes(check_html($row3['title'], "nohtml"));
            echo "<strong><span class='larger'>&middot;</span></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a><br />";
        }
    }
    $result5 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND text LIKE '%".addslashes($query)."%' ORDER BY title");
    $numrows = $db->sql_numrows($result5);
    echo '</p><p class="italic thick">'._RESULTSINTERMTEXT.'</p><p>';
    if ($numrows == 0) {
        echo _NORESULTSTEXT;
    } else {
        while ($row5 = $db->sql_fetchrow($result5)) {
            $tid = intval($row5['tid']);
            $title = stripslashes(check_html($row5['title'], 'nohtml'));
  			$query = trim(str_replace(' ', '+', $query)); //0001594: Encyclopedia Search - whitespace in URL 
            echo "<strong><span class='larger'>&middot;</span></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;query=$query\">$title</a><br />";
        }
    }
    echo '</p>'
        .'<div class="text-center"><form action="modules.php?name='.$module_name.'&amp;file=search" method="post">'
        .'<input type="text" size="20" name="query" value="" />&nbsp;&nbsp;'
        .'<input type="hidden" name="eid" value="'.$eid.'" />'
        .'<input type="submit" value="'._SEARCH.'" />'
        .'</form><p>'
        .'[ <a href="modules.php?name='.$module_name.'&amp;op=list_content&amp;eid='.$eid.'">'._RETURNTO.' '.$ency_title.'</a> ]</p><p>'
        .''._GOBACK.'</p></div>';
    echo '</td></tr></table>';
    CloseTable();
} else {
    if (isset($eid)) { $eid = intval($eid); } else { $eid = ''; }
    OpenTable();
    echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
    echo '<div class="text-center"><p>'._SEARCHNOTCOMPLETE.'</p>'
        .'<form action="modules.php?name='.$module_name.'&amp;file=search" method="post">'
        .'<input type="text" size="20" name="query" value="" />&nbsp;&nbsp;'
        .'<input type="hidden" name="eid" value="'.$eid.'" />'
        .'<input type="submit" value="'._SEARCH.'" />'
        .'</form><p>'
        ._GOBACK.'</p></div>';
    echo '</td></tr></table>';
    CloseTable();
}

include_once('footer.php');

?>