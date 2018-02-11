<?php

/***************************************************************************/
/* PHP-NUKE: Web Portal System									*/
/* ===========================									*/
/*														*/
/* Copyright (c) 2002 by Francisco Burzi								*/
/* http://phpnuke.org											*/
/*														*/
/* ========================									*/
/* Based on PHP-Nuke Add-On										*/
/* Copyright (c) 2001 by Richard Tirtadji AKA King Richard					*/
/*							  (rtirtadji@hotmail.com)			*/
/*							  Hutdik Hermawan AKA hotFix		*/
/*							  (hutdik76@hotmail.com)			*/
/* http://www.nukeaddon.com										*/
/*														*/
/* This program is free software. You can redistribute it and/or modify 			*/
/* it under the terms of the GNU General Public License as published by 			*/
/* the Free Software Foundation; either version 2 of the License.				*/
/*														*/
/***************************************************************************/
/*			Additional security & Abstraction layer conversion			*/
/*									2003 chatserv			*/
/*		http://www.nukefixes.com -- http://www.nukeresources.com			*/
/***************************************************************************/

if ( !defined('MODULE_FILE') ) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '.$module_name;

if (!isset($myfaq)) {
	global $currentlang, $multilingual;
	if ($multilingual == 1) {
		$querylang = 'WHERE flanguage=\''.$currentlang.'\'';
	} else {
		$querylang = '';
	}
	include_once('header.php');
	OpenTable();
	echo '<div class="text-center"><span class="option">'._FAQ2.'</span></div><br /><br />'
		.'<table width="100%" cellpadding="4" cellspacing="0" border="0">'
		.'<tr><td bgcolor="'.$bgcolor2.'" class="option thick">'._CATEGORIES.'</td></tr><tr><td>';
	$result2 = $db->sql_query('SELECT id_cat, categories FROM '.$prefix.'_faqcategories '.$querylang);
	while ($row2 = $db->sql_fetchrow($result2)) {
		$id_cat = intval($row2['id_cat']);
		$categories = stripslashes(check_html($row2['categories'], 'nohtml'));
		$catname = urlencode($categories);
		echo'<strong><span class="larger">&middot;</span></strong>&nbsp;<a href="modules.php?name='.$module_name.'&amp;myfaq=yes&amp;id_cat='.$id_cat.'&amp;categories='.$catname.'">'.$categories.'</a>';
		if (is_admin($admin)) {
			echo ' [ <a href="'.$admin_file.'.php?op=FaqCatEdit&amp;id_cat='.$id_cat.'">'._EDIT.'</a>'
				.' | <a class="rn_csrf" href="'.$admin_file.'.php?op=FaqCatDel&amp;id_cat='.$id_cat.'&amp;ok=0">'._DELETE.'</a> ]';
		}
		echo '<br />';
	}
	echo '</td></tr></table>';
	CloseTable();
	include_once('footer.php');
} else {
	include_once('header.php');
	ShowFaq($id_cat, $categories);
	ShowFaqAll($id_cat);
	CloseTable();
	include_once('footer.php');
}
die();

//Only functions after this line

function ShowFaq($id_cat, $categories) {
	global $bgcolor2, $sitename, $prefix, $db, $module_name, $admin, $admin_file;
	$categories = htmlentities($categories);
	OpenTable();
	echo '<div class="text-center content thick">' , $sitename , ' ' , _FAQ2 , '</div><br /><br />'
		.'<a id="top"></a><br />'
		._CATEGORY.': <a href="modules.php?name='.$module_name.'">'._MAIN.'</a> -&gt; '.$categories
		.'<br /><br />'
		.'<table width="100%" cellpadding="4" cellspacing="0" border="0">'
		, '<tr bgcolor="' , $bgcolor2 , '"><td colspan="2"><span class="option thick">' , _QUESTION , '</span></td></tr><tr><td colspan="2">';
	$id_cat = intval($id_cat);
	$result = $db->sql_query('SELECT id, id_cat, question, answer FROM '.$prefix.'_faqanswer WHERE id_cat=\''.$id_cat.'\'');
	while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		$id_cat = intval($row['id_cat']);
		$question = stripslashes(check_html($row['question'], 'nohtml'));
		$answer = stripslashes($row['answer']);
		echo'<strong><span class="larger">&middot;</span></strong>&nbsp;&nbsp;<a href="#id'.$id.'">'.$question.'</a>';
		if (is_admin($admin)) {
			echo ' [ <a href="'.$admin_file.'.php?op=FaqCatGoEdit&amp;id='.$id.'">'._EDIT.'</a>'
				.' | <a class="rn_csrf" href="'.$admin_file.'.php?op=FaqCatGoDel&amp;id='.$id.'&amp;ok=0">'._DELETE.'</a> ]';
		}
		echo '<br />';
	}
	echo '</td></tr></table><br />';
}

function ShowFaqAll($id_cat) {
	global $bgcolor2, $prefix, $db, $module_name;
	$id_cat = intval($id_cat);
	echo '<table width="100%" cellpadding="4" cellspacing="0" border="0">'
		, '<tr bgcolor="' , $bgcolor2 , '"><td colspan="2"><span class="option thick">' , _ANSWER , '</span></td></tr>';
	$result = $db->sql_query('SELECT id, id_cat, question, answer FROM '.$prefix.'_faqanswer WHERE id_cat=\''.$id_cat.'\'');
	while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		$id_cat = intval($row['id_cat']);
		$question = stripslashes(check_html($row['question'], 'nohtml'));
		$answer = stripslashes($row['answer']);
		echo'<tr><td><a id="id'.$id.'"></a>'
			.'<strong><span class="larger">&middot;</span></strong>&nbsp;&nbsp;<span class="thick">'.$question.'</span>'
			.'<div align="justify">'.$answer.'</div>'
			.'[ <a href="#top">'._BACKTOTOP.'</a> ]'
			.'<br /><br />'
			.'</td></tr>';
	}
	echo '</table><br /><br />'
		.'<div align="center" class="thick">[ <a href="modules.php?name='.$module_name.'">'._BACKTOFAQINDEX.'</a> ]</div>';
}

?>