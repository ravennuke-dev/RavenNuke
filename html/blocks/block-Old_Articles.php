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

global $locale, $oldnum, $storynum, $storyhome, $cookie, $categories, $cat, $prefix, $multilingual, $currentlang, $db, $new_topic, $user_news, $userinfo, $user;
if (!isset($see)) {$see = ''; } // added by Guardin as variable wasnt defined
if (!isset($dummy)) { $dummy = ''; } // add by Guardian as variable was not defined
if (!isset($articlecomm)) { $articlecomm = ''; } // add by fkelly as variable was not defined
if (!isset($time2)) { $time2 = ''; } // add by fkelly as variable was not defined

$content = '';
getusrinfo($user);
if ($multilingual == 1) {
    if ($categories == 1) {
        $querylang = 'where catid=\'' . intval($cat) . '\' AND (alanguage=\'' . $currentlang . '\' OR alanguage=\'\')';
    } else {
        $querylang = 'where (alanguage=\'' . $currentlang . '\' OR alanguage=\'\')';
        if ($new_topic != 0) {
            $querylang .= ' AND topic=\'' . intval($new_topic) . '\'';
        }
    }
} else {
    if ($categories == 1) {
        $querylang = 'where catid=\'' . intval($cat) . '\'';
    } else {
        $querylang = '';
        if ($new_topic != 0) {
            $querylang = 'WHERE topic=\'' . intval($new_topic) . '\'';
        }
    }
}
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
}
if (isset($userinfo['storynum']) AND $user_news == 1) {
    $storynum = $userinfo['storynum'];
} else {
    $storynum = $storyhome;
}
$boxstuff = '<div class="' . $ListClass . ' block-old_articles"><ul class="rn-list">';
$boxTitle = _PASTARTICLES;
$sql = 'SELECT sid, title, time, comments FROM ' . $prefix . '_stories ' . $querylang . ' ORDER BY time DESC LIMIT ' . $storynum . ', ' . $oldnum;
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);
$vari = 0;
$a = 0;
$n = 1;
if ($numrows == 0 AND $multilingual == 1) {
	$sql = 'SELECT sid, title, time, comments FROM ' . $prefix . '_stories ORDER BY time DESC LIMIT ' . $storynum . ', ' . $oldnum;
	$result = $db->sql_query($sql);
}
while (list($sid, $title, $time, $comments) = $db->sql_fetchrow($result)) {
    $sid = intval($sid);
    $title = stripslashes($title);
    $see = 1;
    setlocale(LC_TIME, $locale);
    preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime2);
    $datetime2 = strftime(_DATESTRING2, mktime($datetime2[4],$datetime2[5],$datetime2[6],$datetime2[2],$datetime2[3],$datetime2[1]));
    $datetime2 = ucfirst($datetime2);
    if ($articlecomm == 1) {
        $comments = '(' . $comments . ')';
    } else {
        $comments = '';
    }
    if($time2==$datetime2) {
        $boxstuff .= '<li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '" title="' . $title . '">' . $title . '</a> ' . $comments . '</li>';
    } else {
		if ($a==0){
			if ($n > 1 AND $n % 2){$column = ' li-odd';} else if ($n > 1) {$column = ' li-even';} else {$column = ' li-first';}
			$boxstuff .= '<li class="rn-list' . $column . '"><span class="small-caps">' . $datetime2 . '</span>
			<ul class="rn-ul"><li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '" title="' . $title . '">' . $title . '</a> ' . $comments . '</li>';
			$time2 = $datetime2;
			$a = 1;
			++$n;
		} else {
			if ($n > 1 AND $n % 2){$column = ' li-odd';} else if ($n > 1) {$column = ' li-even';} else {$column = ' li-first';}
			$boxstuff .= '</ul></li><li class="rn-list' . $column . '"><span class="small-caps">' . $datetime2 . '</span>
			<ul class="rn-ul"><li><a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '" title="' . $title . '">' . $title . '</a> ' . $comments . '</li>';
			$time2 = $datetime2;
			++$n;
		}
    }
    $vari++;
    if ($vari==$oldnum) {
        $min = $oldnum + $storynum;
        $dummy = 1;
    }
}

if ($dummy == 1 AND is_active('Stories_Archive')) {
    if ($n > 1 AND $n % 2){$column = ' li-odd';} else if ($n > 1) {$column = ' li-even';} else {$column = ' li-first';}
	$boxstuff .= '</ul></li><li class="rn-list' . $column . '"><span class="small-caps"><a href="modules.php?name=Stories_Archive" title="' . _OLDERARTICLES . '">' . _OLDERARTICLES . '</a></span></li></ul>';
} else {
    $boxstuff .= '</ul></li></ul>';
}
    $boxstuff .= '</div>';
	// make sure content does not float outside the block  
    $boxstuff .= '<div class="block-spacer">&nbsp;</div>';
if ($n > 1) {
    $content = $boxstuff;
} else {
	$content = _BLOCKPROBLEM2;
}
?>