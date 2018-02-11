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
###################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske	http://nukeseo.com
# kses developed by Ulf Harnhammar			http://kses.sf.net
# kses ideas contributed by sixonetonoffun		http://netflake.com
# FCKeditor by Frederico Caldeira Knabben		http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
###################################################

if ( !defined('ADMIN_FILE') ) {
	die ('Access Denied');
}

global $prefix, $db, $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {
	/************************************************************/
	/* Faq Admin Function										*/
	/************************************************************/

	function FaqAdmin() {
		global $admin, $admin_file, $bgcolor2, $currentlang, $db, $multilingual, $prefix;
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
			echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center option thick">' , _ACTIVEFAQS , '</div><br />'
			, '<table border="1" width="100%" align="center"><tr>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center" class="thick">' , _ID , '</td>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center" class="thick">' , _CATEGORIES , '</td>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center" class="thick">' , _LANGUAGE , '</td>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center" class="thick">' , _FUNCTIONS , '</td></tr>';
		if (empty($flanguage)) {
			$flanguage = _ALL;
		}
		$result = $db->sql_query('SELECT `id_cat`, `categories`, `flanguage` FROM `' . $prefix . '_faqcategories` ORDER BY `id_cat`');
		while ($row = $db->sql_fetchrow($result)) {
			$id_cat = $row['id_cat'];
			$categories = $row['categories'];
			$flanguage = $row['flanguage'];
			echo '<tr><td align="center">' , $id_cat , '</td>'
				, '<td align="center">' , $categories , '</td>'
				, '<td align="center">' , $flanguage , '</td>'
				, '<td align="center">[ <a href="' , $admin_file , '.php?op=FaqCatGo&amp;id_cat=' , $id_cat , '">' ,  _CONTENT , '</a>'
				, ' | <a href="' , $admin_file , '.php?op=FaqCatEdit&amp;id_cat=' , $id_cat , '">' , _EDIT , '</a>'
				, ' | <a class="rn_csrf" href="' , $admin_file , '.php?op=FaqCatDel&amp;id_cat=' , $id_cat , '&amp;ok=0">' , _DELETE , '</a> ]</td></tr>';
		}
		echo '</table>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center option thick">' , _ADDCATEGORY , '</div><br />'
			, '<form action="' , $admin_file , '.php" method="post">'
			, '<table border="0" width="100%"><tr><td>'
			, _CATEGORIES , ':</td><td><input type="text" name="categories" size="30" /></td>';
		if ($multilingual == 1) {
			echo '<td>' . _LANGUAGE . ':</td><td>'
				. lang_select_list('flanguage', $currentlang, false)
				. '</td>';
		} else {
			echo '<td><input type="hidden" name="flanguage" value="' , $flanguage , '" /></td>';
		}
		echo '</tr></table>'
			, '<input type="hidden" name="op" value="FaqCatAdd" />'
			, '<input type="submit" value="' , _SAVE , '" />'
			, '</form>';
		CloseTable();
		include_once 'footer.php';
	}

	function FaqCatGo($id_cat) {
		global $admin, $admin_file, $bgcolor2, $db, $prefix;

		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center option thick">' , _QUESTIONS , '</div><br />'
			, '<table border="1" width="100%" align="center"><tr>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center">' , _CONTENT , '</td>'
			, '<td bgcolor="' , $bgcolor2 , '" align="center">' , _FUNCTIONS , '</td></tr>';

		$id_cat = intval($id_cat);
		$result = $db->sql_query('SELECT `id`, `question`, `answer` FROM `' . $prefix . '_faqanswer` WHERE `id_cat`="' . $id_cat . '" ORDER BY `id`');
		while ($row = $db->sql_fetchrow($result)) {
			$id = $row['id'];
			$question = $row['question'];
			$answer = $row['answer'];

			echo '<tr><td><span class="italic">' , $question , '</span><br /><br />' , $answer , '</td>'
				, '<td align="center">[ <a href="' , $admin_file , '.php?op=FaqCatGoEdit&amp;id=' , $id , '">' , _EDIT , '</a>'
				, ' | <a class="rn_csrf" href="' , $admin_file , '.php?op=FaqCatGoDel&amp;id=' , $id , '&amp;ok=0">' , _DELETE , '</a> ]</td></tr>';
		}
		echo '</table>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center option thick">' , _ADDQUESTION , '</div><br />'
			, '<form action="' , $admin_file , '.php" method="post">'
			, '<table border="0" width="100%"><tr><td>'
			, _QUESTION , ':</td><td><input type="text" name="question" size="40" /></td></tr><tr><td>'
			, _ANSWER , ' </td><td>';
		wysiwyg_textarea('answer', '', 'PHPNukeAdmin', '60', '10');
		echo '</td></tr></table>'
			, '<input type="hidden" name="id_cat" value="' , $id_cat , '" />'
			, '<input type="hidden" name="op" value="FaqCatGoAdd" />'
			, '<input type="submit" value="' , _SAVE , '" /> ' , _GOBACK
			, '</form>';
		CloseTable();
		include_once 'footer.php';
	}

	function FaqCatEdit($id_cat) {
		global $admin, $admin_file, $db, $multilingual;
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
		CloseTable();
		echo '<br />';

		$id_cat = intval($id_cat);
		$row = $db->sql_fetchrow($db->sql_query('SELECT `categories`, `flanguage` FROM `' . $prefix . '_faqcategories` WHERE `id_cat`="' . $id_cat . '"'));
		$categories = $row['categories'];
		$flanguage = $row['flanguage'];

		OpenTable();
		echo '<div class="text-center option thick">' , _EDITCATEGORY , '</div>'
			, '<form action="' , $admin_file , '.php" method="post">'
			, '<input type="hidden" name="id_cat" value="' , $id_cat , '" />'
			, '<table border="0" width="100%"><tr><td>'
			, _CATEGORIES , ':</td><td><input type="text" name="categories" size="31" value="' , $categories , '" /></td>';
		if ($multilingual == 1) {
			echo '<td>' . _LANGUAGE . ':</td><td>'
				. lang_select_list('flanguage', $flanguage, false)
				. '</td>';
		} else {
			echo '<input type="hidden" name="flanguage" value="' , $flanguage , '" />';
		}

		echo '</tr></table>'
			, '<input type="hidden" name="op" value="FaqCatSave" />'
			, '<input type="submit" value="' , _SAVE , '" />' , _GOBACK
			, '</form>';
		CloseTable();
		include_once 'footer.php';
	}

	function FaqCatGoEdit($id) {
		global $admin, $admin_file, $bgcolor2, $db, $prefix;

		include_once 'header.php';

		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
		CloseTable();
		echo '<br />';

		$id = intval($id);
		$row = $db->sql_fetchrow($db->sql_query('SELECT `question`, `answer` FROM `' . $prefix . '_faqanswer` WHERE `id`="' . $id . '"'));
		$question = $row['question'];
		$answer = $row['answer'];
		OpenTable();
		echo '<div class="text-center option thick">' , _EDITQUESTIONS , '</div>'
			, '<form action="' , $admin_file , '.php" method="post">'
			, '<input type="hidden" name="id" value="' , $id , '" />'
			, '<table border="0" width="100%"><tr><td>'
			, _QUESTION , ':</td><td><input type="text" name="question" size="31" value="' , $question , '" /></td></tr><tr><td>'
			, _ANSWER , ':</td><td>';
		wysiwyg_textarea('answer', $answer, 'PHPNukeAdmin', '60', '10');
		echo '</td></tr></table>'
			, '<input type="hidden" name="op" value="FaqCatGoSave" />'
			, '<input type="submit" value="' , _SAVE , '" />' , _GOBACK
			, '</form>';
		CloseTable();
		include_once 'footer.php';
	}

	function FaqCatSave($id_cat, $categories, $flanguage) {
		global $admin_file, $db, $prefix;
		$categories = stripslashes(FixQuotes($categories));
		$id_cat = intval($id_cat);
		$db->sql_query('UPDATE `' . $prefix . '_faqcategories` SET `categories`="' . $categories . '", `flanguage`="' . $flanguage . '" WHERE `id_cat`="' . $id_cat . '"');
		Header('Location: ' . $admin_file . '.php?op=FaqAdmin');
	}

	function FaqCatGoSave($id, $question, $answer) {
		global $admin_file, $db, $prefix;
		$question = stripslashes(FixQuotes($question));
		$answer = stripslashes(FixQuotes($answer));
		$id = intval($id);
		$db->sql_query('UPDATE `' . $prefix . '_faqanswer` SET `question`="' . $question . '", `answer`="' . $answer . '" WHERE `id`="' . $id . '"');
		Header('Location: ' . $admin_file . '.php?op=FaqAdmin');
	}

	function FaqCatAdd($categories, $flanguage) {
		global $admin_file, $db, $prefix;
		$categories = stripslashes(FixQuotes($categories));
		$db->sql_query('INSERT INTO `' . $prefix . '_faqcategories` VALUES (NULL, "' . $categories . '", "' . $flanguage . '")');
		Header('Location: ' . $admin_file . '.php?op=FaqAdmin');
	}

	function FaqCatGoAdd($id_cat, $question, $answer) {
		global $admin_file, $db, $prefix;
		$question = stripslashes(FixQuotes($question));
		$answer = stripslashes(FixQuotes($answer));
		$db->sql_query('INSERT INTO `' . $prefix . '_faqanswer` VALUES (NULL, "' . $id_cat . '", "' . $question . '", "' . $answer . '")');
		Header('Location: ' . $admin_file . '.php?op=FaqCatGo&id_cat=' . $id_cat);
	}

	function FaqCatDel($id_cat, $ok=0) {
		global $admin_file, $db, $prefix;
		if($ok==1) {
			$id_cat = intval($id_cat);
			$db->sql_query('DELETE FROM `' . $prefix . '_faqcategories` WHERE `id_cat`="' . $id_cat . '"');
			$db->sql_query('DELETE FROM `' . $prefix . '_faqanswer` WHERE `id_cat`="' . $id_cat . '"');
			Header('Location: ' . $admin_file . '.php?op=FaqAdmin');
		} else {
			include_once 'header.php';
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
			CloseTable();
			echo '<br />';
			OpenTable();
			echo '<br /><div class="text-center"><span class="thick">' , _FAQDELWARNING , '</span><br /><br />';
		}
		echo '[ <a class="rn_csrf" href="' , $admin_file , '.php?op=FaqCatDel&amp;id_cat=' , $id_cat , '&amp;ok=1">' , _YES , '</a>'
			, ' | <a href="' , $admin_file , '.php?op=FaqAdmin">' , _NO , '</a> ]</div><br /><br />';
		CloseTable();
		include_once 'footer.php';
	}

	function FaqCatGoDel($id, $ok=0) {
		global $admin_file, $db, $prefix;
		if($ok==1) {
			$id = intval($id);
			$db->sql_query('DELETE FROM `' . $prefix . '_faqanswer` WHERE `id`="' . $id . '"');
			Header('Location: ' . $admin_file . '.php?op=FaqAdmin');
		} else {
			include_once 'header.php';
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center title thick">' , _FAQADMIN , '</div>';
			CloseTable();
			echo '<br />';
			OpenTable();
			echo '<br /><div class="text-center"><span class="thick">' , _QUESTIONDEL , '</span><br /><br />';
		}
		echo '[ <a class="rn_csrf" href="' , $admin_file , '.php?op=FaqCatGoDel&amp;id=' , $id , '&amp;ok=1">' , _YES , '</a>'
			, ' | <a href="' , $admin_file , '.php?op=FaqAdmin">' , _NO , '</a> ]</div><br /><br />';
		CloseTable();
		include_once 'footer.php';
	}

	switch($op) {
		case 'FaqCatSave':
			csrf_check();
			FaqCatSave($id_cat, $categories, $flanguage);
			break;

		case 'FaqCatGoSave':
			csrf_check();
			FaqCatGoSave($id, $question, $answer);
			break;

		case 'FaqCatAdd':
			csrf_check();
			FaqCatAdd($categories, $flanguage);
			break;

		case 'FaqCatGoAdd':
			csrf_check();
			FaqCatGoAdd($id_cat, $question, $answer);
			break;

		case 'FaqCatEdit':
			FaqCatEdit($id_cat);
			break;

		case 'FaqCatGoEdit':
			FaqCatGoEdit($id);
			break;

		case 'FaqCatDel':
			csrf_check();
			FaqCatDel($id_cat, $ok);
			break;

		case 'FaqCatGoDel':
			csrf_check();
			FaqCatGoDel($id, $ok);
			break;

		case 'FaqAdmin':
			FaqAdmin();
			break;

		case 'FaqCatGo':
			FaqCatGo($id_cat);
			break;
	}

} else {
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">' , _ERROR , '</span><br /><br />You do not have administration permission for module ' , $module_name , '</div>';
	CloseTable();
	include_once 'footer.php';
}

?>