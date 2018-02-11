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

$pagetitle = '- '._ENCYCLOPEDIA.'';

if (!isset($ltr)) { $ltr = ''; }
if (!isset($page)) { $page = ''; }
if (!isset($query)) {
	$query = '';
} else {
	$query = htmlentities(check_html($query, 'nohtml'), ENT_QUOTES);
}
if (!(isset($op))) { $op = ''; }
switch($op) {

    case 'content':
        content($tid, $ltr, $page, $query);
    break;

    case 'list_content':
        list_content($eid);
    break;

    case 'terms':
        terms($eid, $ltr);
    break;

//montego: does not appear to be used anywhere, but will leave commented out for now.
//    case 'search':
//        search($query, $eid);
//    break;

    default:
        list_themes();
    break;

}
die();

//Only Functions below this line

function encysearch($eid) {
    global $module_name;
    $eid = intval($eid);
    echo '<form action="modules.php?name='.$module_name.'&amp;file=search" method="post">'
        .'<input type="text" size="20" name="query" value="" />&nbsp;&nbsp;'
        .'<input type="hidden" name="eid" value="'.$eid.'" />'
        .'<input type="submit" value="'._SEARCH.'" />'
        .'</form>';
}

function alpha($eid) {
    global $module_name, $prefix, $db;
    echo '<div class="text-center"><p class="thick">'._ENCYSELECTLETTER.'</p>';
    $alphabet = array ('A','B','C','D','E','F','G','H','I','J','K','L','M',
        'N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $num = count($alphabet) - 1;
    echo '<p>[ ';
    $counter = 0;
    $eid = intval($eid);
    while (list(, $ltr) = each($alphabet)) {
        $ltr = substr($ltr, 0, 1);
        $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND UPPER(title) LIKE '$ltr%'"));
        if ($numrows > 0) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=terms&amp;eid=$eid&amp;ltr=$ltr\">$ltr</a>";
        } else {
            echo $ltr;
        }
        if ( $counter == round($num/2) ) {
            echo " ]\n<br />\n[ ";
        } elseif ( $counter != $num ) {
            echo "&nbsp;|&nbsp;\n";
        }
        $counter++;
    }
    echo " ]</p>\n\n\n";
    encysearch($eid);
    echo '<p>'._GOBACK.'</p></div>';
}

function list_content($eid) {
    global $module_name, $prefix, $sitename, $db;
    $eid = intval($eid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT title, description FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
    $title = stripslashes(check_html($row['title'], 'nohtml'));
    $description = stripslashes($row['description']);
    include_once('header.php');
    title($title);
    OpenTable();
    echo '<p align="center" class="thick">'.$title.'</p>'
        .'<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>'
        .'<div align="justify">'.$description.'</div>'
        .'</td></tr></table>';
    CloseTable();
    echo '<br />';
    OpenTable();
    alpha($eid);
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<p align="center" class="tiny">'._COPYRIGHT.' &copy; '._BY.' '.$sitename.'</p>';
    CloseTable();
    include_once('footer.php');
}

function terms($eid, $ltr) {
    global $module_name, $prefix, $sitename, $db, $admin;
    $eid = intval($eid);
    $ltr = substr($ltr,0,1);
    if (preg_match('/[^a-zA-Z0-9]/', $ltr)) {
       die('Invalid letter/digit specified!');
    }
    $row = $db->sql_fetchrow($db->sql_query("SELECT active FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
    $active = intval($row['active']);
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
    $title = stripslashes(check_html($row2['title'], "nohtml"));
    include_once('header.php');
    title($title);
    OpenTable();
    if (($active == 1) OR (is_admin($admin))) {
        if (($active != 1) AND (is_admin($admin))) {
            echo '<div class="text-center"><p>'._YOURADMINENCY.'</p></div>';
        }
        echo '<div class="text-center"><p class="title">' . _EM_LISTOPTION . '</p></div>';
        $result3 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE UPPER(title) LIKE '$ltr%' AND eid='$eid' ORDER BY title");
        $numrows = $db->sql_numrows($result3);
        if ($numrows == 0) {
            echo '<div class="text-center"><p><span class="italic">'._NOCONTENTFORLETTER.' '.htmlentities($ltr).'.</span></p></div>';
        } else {
            echo '<table align="center"><tr><td align="left">';
            while ($row3 = $db->sql_fetchrow($result3)) {
                $tid = intval($row3['tid']);
                $title = stripslashes(check_html($row3['title'], "nohtml"));
                echo "<strong><span class='larger'>&middot;</span></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a><br />";
            }
            echo '</td></tr></table>';
        }
        echo "<br />";
        alpha($eid);
    } else {
        echo '<div class="text-center"><p>'._ENCYNOTACTIVE.'</p><p>'
            ._GOBACK.'</p></div>';
    }
    CloseTable();
    include_once('footer.php');
}

function content($tid, $ltr, $page=0, $query='') {
    global $prefix, $db, $sitename, $admin, $module_name, $admin_file;
    $tid = intval($tid);
    $ltr = strtoupper(substr($ltr, 0, 1));
    include_once('header.php');
    OpenTable();
    $ency = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_encyclopedia_text WHERE tid=\''.$tid.'\''));
    $etid = intval($ency['tid']);
    $eeid = intval($ency['eid']);
    $etitle = stripslashes(check_html($ency['title'], 'nohtml'));
    $etext = stripslashes($ency['text']);
    $ecounter = intval($ency['counter']);
    $row = $db->sql_fetchrow($db->sql_query("SELECT active FROM ".$prefix."_encyclopedia WHERE eid='$eeid'"));
    $active = intval($row['active']);
    echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
    if (($active == 1) OR ($active == 0 AND is_admin($admin))) {
//montego: number of reads should only be made once the entire term text has been read, right?!
//        $db->sql_query("UPDATE ".$prefix."_encyclopedia_text SET counter=counter+1 WHERE tid='$tid'");
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eeid'"));
        $enc_title = $row2['title'];
        echo '<p class="title">'.$etitle.'</p>';
        $contentpages = explode( '<!--pagebreak-->', $etext );
        $pageno = count($contentpages);
        if ( empty($page) || $page < 1 ) $page = 1;
        if ( $page > $pageno ) $page = $pageno;
        $arrayelement = (int)$page;
        $arrayelement --;
        if ($pageno > 1) {
            echo '<p>'._PAGE.": $page/$pageno</p>";
        }
		if (!empty($query)) {
			$contentpages[$arrayelement] = str_ireplace($query, '<span class="thick">' . $query . '</span>', $contentpages[$arrayelement]);
			$fromsearch = '&amp;query=' . $query;
		} else {
			$fromsearch = '';
		}
        echo '<div align="justify">'.nl2br($contentpages[$arrayelement]).'</div>';
        $next_page = '';
        if($page < $pageno) {
            $next_pagenumber = $page + 1;
            if ($page != 1) {
                $next_page .= '- ';
            }
            $next_page .= "<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$next_pagenumber$fromsearch\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\" /></a>";
        }
        if($page <= 1) {
            $previous_page = '';
        } else {
            $previous_pagenumber = $page - 1;
            $previous_page = "<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$previous_pagenumber$fromsearch\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\" /></a> <a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$previous_pagenumber$fromsearch\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
        }
        echo '<div class="text-center">';
        if($page > 1) {
           echo "<p>$previous_page $next_page</p>";
        }
        echo "<p>"._GOBACK."</p></div>";
        if (is_admin($admin)) {
            echo "<p align=\"right\">[ <a href=\"".$admin_file.".php?op=encyclopedia_text_edit&amp;tid=$etid\">"._EDIT."</a> ]</p>";
        }
        echo "<p align=\"right\"><a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eeid\">$enc_title</a></p>";
        if ($page == $pageno) {
            if (!is_admin($admin)) $db->sql_query("UPDATE ".$prefix."_encyclopedia_text SET counter=counter+1 WHERE tid='$tid'");  //Added here by montego - also admin should not boost the reads
            echo "<p align=\"right\">"._COPYRIGHT." &copy; "._BY." $sitename - ($ecounter "._READS.")</p>";
        }
    } else {
        echo "Sorry, This page isn't active...";
    }
    echo '</td></tr></table>';
    CloseTable();
    include_once('footer.php');
}

function list_themes() {
    global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
    include_once('header.php');
    title($sitename.': '._ENCYCLOPEDIA);
    OpenTable();
    echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
    echo '<p class="title" align="center">'._AVAILABLEENCYLIST." $sitename:</p>";
    $result = $db->sql_query("SELECT eid, title, description, elanguage FROM ".$prefix."_encyclopedia WHERE active='1'");
    if ($db->sql_numrows($result)>0) {
       while ($row = $db->sql_fetchrow($result)) {
           $eid = intval($row['eid']);
           $title = stripslashes(check_html($row['title'], "nohtml"));
           $description = stripslashes($row['description']);
           $elanguage = $row['elanguage'];
           if ($multilingual == 1) {
               $the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"\" />";
           } else {
               $the_lang = "";
           }
           if (!empty($subtitle)) {
               $subtitle = "<br />($description)<br /><br />";
           } else {
               $subtitle = "";
           }
           if (is_admin($admin)) {
               echo "<strong><span class='larger'>&middot;</span></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br />$description<br />[ <a href=\"".$admin_file.".php?op=encyclopedia_edit&amp;eid=$eid\">"._EDIT."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_change_status&amp;eid=$eid&amp;active=1\">"._DEACTIVATE."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_delete&amp;eid=$eid\">"._DELETE."</a> ]<br /><br />";
           } else {
               echo "<strong><span class='larger'>&middot;</span></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br /> $description<br /><br />";
           }
       }
    }

    if (is_admin($admin)) {
        $result2 = $db->sql_query("SELECT eid, title, description, elanguage FROM ".$prefix."_encyclopedia WHERE active='0'");
        echo '<p class="content thick" align="center">' , _YOURADMININACTIVELIST , '</p>';
        if ($db->sql_numrows($result2)>0) {
           while ($row2 = $db->sql_fetchrow($result2)) {
               $eid = intval($row2['eid']);
               $title = stripslashes(check_html($row2['title'], "nohtml"));
               $description = stripslashes($row2['description']);
               $elanguage = $row2['elanguage'];
               if ($multilingual == 1) {
                   $the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\" alt=\"\" />";
               } else {
                   $the_lang = "";
               }
           if (!empty($subtitle)) {
                   $subtitle = " ($subtitle) ";
               } else {
                   $subtitle = " ";
               }
               echo "<strong><span class='larger'>&middot;</span></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br />$description<br />[ <a href=\"".$admin_file.".php?op=encyclopedia_edit&amp;eid=$eid\">"._EDIT."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_change_status&amp;eid=$eid&amp;active=0\">"._ACTIVATE."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_delete&amp;eid=$eid\">"._DELETE."</a> ]<br /><br />";
           }
        }
    }
    echo '</td></tr></table>';
    CloseTable();
    include_once('footer.php');
}

?>