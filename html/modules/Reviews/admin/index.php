<?php
/**********************************************************************/
/* PHP-NUKE: Web Portal System  								*/
/* ===========================								*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*********************************************************************/

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

global $admin_file, $db, $prefix;

$module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($module_name)) {
	if (!isset($op)) $op = 'reviews';
	switch ($op) {
		case 'reviews':
			reviews();
			break;
		case 'add_review':
			csrf_check();
			if (!isset($url)) { $url = ''; }
			if (!isset($url_title)) { $url_title = ''; }
			$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
			$text = isset($_POST['text' . $id]) ? $_POST['text' . $id] : '';
			add_review($id, $date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $rlanguage);
			break;
		case 'delete_review':
			csrf_check();
			delete_review($id);
			break;
		case 'mod_main':
			csrf_check();
			mod_main($title, $desc);
			break;
	}
} else {
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">' . _ERROR . '</span><br /><br />You do not have administration permission for module "' . $module_name . '"</div>';
	CloseTable();
	include_once('footer.php');
}

die();

/*********************************************************************/
/* REVIEWS Block Functions									*/
/*********************************************************************/

function mod_main($title, $desc) {
	global $prefix, $db, $admin_file;

	if (@get_magic_quotes_gpc() == 0) {
		$title = addslashes($title);
		$desc = addslashes($desc);
	}
	$db->sql_query('UPDATE ' . $prefix . '_reviews_main SET title=\'' . $title . '\', description=\'' . $desc . '\'');
	Header('Location: ' . $admin_file . '.php?op=reviews');
}

function reviews() {
	global $prefix, $db, $multilingual, $admin_file, $language, $advanced_editor;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">' . _REVADMIN . '</div>';
	CloseTable();
	$resultrm = $db->sql_query('SELECT title, description FROM ' . $prefix . '_reviews_main');
	list($title, $desc) = $db->sql_fetchrow($resultrm);
	OpenTable();
	echo '<div align="center"><form action="' . $admin_file . '.php" method="post">'
		. _REVTITLE . '<br />'
		. '<input type="text" name="title" value="' . $title . '" size="50" maxlength="100" /><br /><br />'
		. _REVDESC . '<br />';
	if (!isset($advanced_editor) || $advanced_editor == 0) $desc = htmlentities($desc, ENT_QUOTES); // montego - necessary for XHMLT compliance
	wysiwyg_textarea('desc', $desc, 'PHPNukeAdmin', '60', '10');
	echo '<br /><br />';
	echo '<input type="hidden" name="op" value="mod_main" />'
		. '<input type="submit" value="' . _SAVECHANGES . '" />'
		. '</form></div>';
	CloseTable();
	OpenTable();
	echo '<div align="center"><p class="option">' . _REVWAITING . '</p>';
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_reviews_add ORDER BY id');
	$numrows = $db->sql_numrows($result);
	if ($numrows > 0) {
		while (list($id, $date, $title, $text, $reviewer, $email, $score, $url, $url_title, $rlanguage) = $db->sql_fetchrow($result)) {
			$id = intval($id);
			$score = intval($score);
			echo '<form action="' . $admin_file . '.php" method="post">'
				. '<hr noshade="noshade" size="1" /><br />'
				. '<input type="hidden" name="id" value="' . $id . '" />'
				. '<table border="0" cellpadding="1" cellspacing="2" width="100%">'
				. '<tr><td><strong>' . _REVIEWID . ':</strong></td><td><strong>' . $id . '</strong></td></tr>'
				. '<tr><td>' . _DATE . ':</td><td><input type="text" name="date" value="' . $date . '" size="11" maxlength="10" /></td></tr>'
				. '<tr><td>' . _PRODUCTTITLE . ':</td><td><input type="text" name="title" value="' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '" size="50" maxlength="60" /></td></tr>';
			if ($multilingual == 1) {
				echo '<tr><td>' . _LANGUAGE . ':</td><td>'
					. lang_select_list('rlanguage', $rlanguage, false)
					. '</td></tr>';
			} else {
				echo '<tr><td><input type="hidden" name="rlanguage" value="' . $language . '" /></td></tr>';
			}
			echo '<tr><td>' . _TEXT . ':</td><td>';
			if (!isset($advanced_editor) || $advanced_editor == 0) $text = htmlentities($text, ENT_QUOTES); // montego - necessary for XHMLT compliance
			wysiwyg_textarea('text' . $id, $text, 'PHPNukeAdmin', '60', '10');
			echo '</td></tr>'
				. '<tr><td>' . _REVIEWER . '</td><td><input type="text" name="reviewer" value="' . $reviewer . '" size="41" maxlength="40" /></td></tr>'
				. '<tr><td>' . _EMAIL . ':</td><td><input type="text" name="email" value="' . $email . '" size="41" maxlength="80" /></td></tr>'
				. '<tr><td>' . _SCORE . '</td><td><input type="text" name="score" value="' . $score . '" size="3" maxlength="2" /></td></tr>';
			if ($url != '') {
				echo '<tr><td>' . _RELATEDLINK . ':</td><td><input type="text" name="url" value="' . $url . '" size="25" maxlength="100" /></td></tr>'
					. '<tr><td>' . _LINKTITLE . ':</td><td><input type="text" name="url_title" value="' . $url_title . '" size="25" maxlength="50" /></td></tr>';
			}
			echo '<tr><td>' . _IMAGE . ':</td><td><input type="text" name="cover" size="41" maxlength="100" /><br /><span class="italic">' . _REVIMGINFO . '</span></td></tr></table>';
			echo '<input type="hidden" name="op" value="add_review" /><input type="submit" value="' . _ADDREVIEW . '" /> - [ <a class="rn_csrf" href="' . $admin_file . '.php?op=delete_review&amp;id=' . $id . '">' . _DELETE . '</a> ]</form>';
		}
	} else {
		echo '<br /><br /><span class="italic">' . _NOREVIEW2ADD . '</span><br /><br />';
	}
	echo '<a href="modules.php?name=Reviews&amp;rop=write_review">' . _CLICK2ADDREVIEW . '</a></div>';
	CloseTable();
	OpenTable();
	echo '<div class="text-center"><span class="option thick">' . _DELMODREVIEW . '</span><br /><br />'
		. _MODREVINFO . '</div>';
	CloseTable();
	include_once('footer.php');
}

function add_review($id, $date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $rlanguage) {
	global $prefix, $db, $admin_file;
	$id = intval($id);
	if (@get_magic_quotes_gpc() == 0) {
		$title = addslashes($title);
		$text = addslashes($text);
		$reviewer = addslashes($reviewer);
		$email = addslashes($email);
	}
	$score = intval($score);
	$db->sql_query('INSERT INTO ' . $prefix . '_reviews VALUES (NULL, \'' . $date . '\', \'' . $title . '\', \'' . $text . '\', \'' . $reviewer . '\', \'' . $email . '\', \'' . $score . '\', \'' . $cover . '\', \'' . $url . '\', \'' . $url_title . '\', \'1\', \'' . $rlanguage . '\')');
	$db->sql_query('DELETE FROM ' . $prefix . '_reviews_add WHERE id = \'' . $id . '\'');
	Header('Location: ' . $admin_file . '.php?op=reviews');
}

function delete_review($id) {
	global $prefix, $db, $admin_file;
	$id = intval($id);
	$db->sql_query('DELETE FROM '.$prefix.'_reviews_add WHERE id = \''.$id.'\'');
	Header('Location: '.$admin_file.'.php?op=reviews');
}

?>