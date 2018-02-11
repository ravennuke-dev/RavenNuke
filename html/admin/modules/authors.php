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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/************************************************************************/
/*         Portions of program rewritten for efficiency and xhtml       */
/*      compliance by fkelly August 2007 and montego December 2007      */
/*      http://www.ravenphpscripts.com                                  /*
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

global $prefix, $db, $admin_file;
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
if (($row['radminsuper'] == 1) && ($row['name'] == 'God')) {
	switch ($op) {
		case 'mod_authors':
			displayadmins();
			break;
		case 'modifyadmin':
			modifyadmin($chng_aid);
			break;
		case 'UpdateAuthor':
			csrf_check();
			updateadmin();
			break;
		case 'AddAuthor':
			csrf_check();
			$add_aid = substr($_POST['add_aid'], 0, 25);
			$add_name = substr($_POST['add_name'], 0, 25);
			$add_email = $_POST['add_email'];
			$add_pwd = $_POST['add_pwd'];
			// required fields above
			if (!($add_aid && $add_name && $add_email && $add_pwd)) {
				include_once 'header.php';
				GraphicAdmin();
				OpenTable();
				echo '<div class="text-center"><span class="title thick">' . _AUTHORSADMIN . '</span></div>';
				CloseTable();
				echo '<br />';
				OpenTable();
				echo '<div class="text-center"><span class="option thick">' . _CREATIONERROR . '</span><br /><br />'
					. _COMPLETEFIELDS . '<br /><br />'
					. _GOBACK . '</div>';
				CloseTable();
				include_once 'footer.php';
				return;
			}
			$add_adminlanguage = (isset($_POST['add_adminlanguage'])) ? $_POST['add_adminlanguage'] : '';;
			if (isset($_POST['auth_modules'])) {
				$auth_modules = $_POST['auth_modules'];
			} else {
				$auth_modules = '';
			}
			$add_pwd = md5($add_pwd);
			if (isset($_POST['add_radminsuper'])) {
				$add_radminsuper = '1';
			} else {
				$add_radminsuper = '0';
			}
			if ($add_radminsuper == 0 AND $auth_modules != '') {
				for ($i = 0;$i < sizeof($auth_modules);$i++) {
					$row = $db->sql_fetchrow($db->sql_query('SELECT admins FROM ' . $prefix . '_modules WHERE mid=\'' . intval($auth_modules[$i]) . '\''));
					if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
					$adm = $row['admins'] . $add_name;
					$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . ',\' WHERE mid=\'' . intval($auth_modules[$i]) . '\'');
				}
			} // dont want to add to admins field if its a superadmin
			$result = $db->sql_query('insert into ' . $prefix . '_authors values (\'' . $add_aid . '\', \'' . $add_name . '\', \'' . $add_url . '\', \'' . $add_email . '\', \'' . $add_pwd . '\', \'0\', \'' . $add_radminsuper . '\', \'' . $add_admlanguage . '\')');
			if (!$result) {
				return;
			}
			Header('Location: ' . $admin_file . '.php?op=mod_authors');
			break;
		case 'deladmin':
			include_once 'header.php';
			$del_aid = trim($del_aid);
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center"><span class="title thick">' . _AUTHORSADMIN . '</span></div>';
			CloseTable();
			echo '<br />';
			OpenTable();
			echo '<div class="text-center"><span class="option thick">' . _AUTHORDEL . '</span><br /><br />'
				. _AUTHORDELSURE . ' <span class="italic">' . $del_aid . '</span>?<br /><br />';
			echo '[ <a class="rn_csrf" href="' . $admin_file . '.php?op=deladmin2&amp;del_aid=' . $del_aid . '">' . _YES . '</a> | <a href="' . $admin_file . '.php?op=mod_authors">' . _NO . '</a> ]</div>';
			CloseTable();
			include_once 'footer.php';
			break;
		case 'deladmin2':
			csrf_check();
			deladmin2($del_aid);
			break;
		case 'assignstories': // montego - code reworked to be far more efficient in updates - i.e., update only once - but also fix bug in how it blindly chgs the informant too
			csrf_check();
			$del_aid = trim($del_aid);
			$numrows = $db->sql_numrows($db->sql_query('SELECT sid from ' . $prefix . '_stories where aid=\'' . $del_aid . '\''));
			$db->sql_query('UPDATE ' . $prefix . '_stories SET aid=\'' . $newaid . '\' WHERE aid=\'' . $del_aid . '\'');
			$db->sql_query('UPDATE ' . $prefix . '_stories SET informant=\'' . $newaid . '\' WHERE informant=\'' . $del_aid . '\'');
			$db->sql_query('UPDATE ' . $prefix . '_authors SET counter=counter+' . $numrows . ' WHERE aid=\'' . $newaid . '\'');
			deladminconf($del_aid);
			break;
		case 'deladminconf':
			csrf_check();
			deladminconf($del_aid);
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/*********************************************************/
/* Admin/Authors Functions                               */
/*********************************************************/
function displayadmins() {
	global $admin, $prefix, $db, $language, $multilingual, $admin_file;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="title thick">' . _AUTHORSADMIN . '</span></div>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><span class="option thick">' . _EDITADMINS . '</span></div><br />'
		. '<table border="1" align="center">';
	$result = $db->sql_query('SELECT aid, name, admlanguage from ' . $prefix . '_authors');
	while ($row = $db->sql_fetchrow($result)) {
		$a_aid = $row['aid'];
		$name = $row['name'];
		$admlanguage = $row['admlanguage'];
		$a_aid = substr($a_aid, 0, 25);
		$name = substr($name, 0, 50);
		echo '<tr><td align="center">' . $a_aid . '</td>';
		if (empty($admlanguage)) {
			$admlanguage = _ALL;
		}
		echo '<td align="center">' . $admlanguage . '</td>';
		echo '<td><a href="' . $admin_file . '.php?op=modifyadmin&amp;chng_aid=' . $a_aid . '">' . _MODIFYINFO . '</a></td>';
		if ($name == 'God') {
			echo '<td>' . _MAINACCOUNT . '</td></tr>';
		} else {
			echo '<td><a href="' . $admin_file . '.php?op=deladmin&amp;del_aid=' . $a_aid . '">' . _DELAUTHOR . '</a></td></tr>';
		}
	} // end of while
	echo '</table><br /><div class="text-center"><span class="tiny">' . _GODNOTDEL . '</span></div>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><span class="option thick">' . _ADDAUTHOR . '</span></div>'
		. '<form action="' . $admin_file . '.php" method="post">'
		. '<table border="0">'
		. '<tr><td>' . _NAME . ':</td>'
		. '<td colspan="3"><input type="text" name="add_name" size="30" maxlength="50" /> <span class="tiny">' . _REQUIREDNOCHANGE . '</span></td></tr>'
		. '<tr><td>' . _NICKNAME . ':</td>'
		. '<td colspan="3"><input type="text" name="add_aid" size="30" maxlength="25" /> <span class="tiny">' . _REQUIRED . '</span></td></tr>'
		. '<tr><td>' . _EMAIL . ':</td>'
		. '<td colspan="3"><input type="text" name="add_email" size="30" maxlength="60" /> <span class="tiny">' . _REQUIRED . '</span></td></tr>'
		. '<tr><td>' . _URL . ':</td>'
		. '<td colspan="3"><input type="text" name="add_url" size="30" maxlength="60" /></td></tr>';
	if ($multilingual == 1) {
		$languageslist = '';
		echo '<tr><td>' . _LANGUAGE . ':</td><td colspan="3">'
			. '<select name="add_admlanguage">';
		$handle = opendir('language');
		while ($file = readdir($handle)) {
			if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= $langFound . ' ';
			}
		}
		closedir($handle);
		$languageslist = explode(' ', $languageslist);
		sort($languageslist);
		for ($i = 0;$i < sizeof($languageslist);$i++) {
			if (!empty($languageslist[$i])) {
				echo '<option value="' . $languageslist[$i] . '" ';
				if ($languageslist[$i] == $language) {
					echo 'selected = "selected"';
				}
				echo '>' . ucfirst($languageslist[$i]) . '</option>';
			}
		}
		echo '<option value="">' . _ALL . '</option></select></td></tr>';
	} else { // not multilingual
		echo '<tr><td><input type="hidden" name="add_admlanguage" value="" /></td></tr>';
	}
	echo '<tr><td>' . _PERMISSIONS . ':</td>';
	$result = $db->sql_query('SELECT mid, title FROM ' . $prefix . '_modules ORDER BY title ASC');
	$a = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$title = str_replace('_', ' ', $row['title']);
		if (file_exists('modules/' . $row['title'] . '/admin/index.php') AND file_exists('modules/' . $row['title'] . '/admin/links.php') AND file_exists('modules/' . $row['title'] . '/admin/case.php')) {
			echo '<td><input type="checkbox" name="auth_modules[]"
				value="' . intval($row['mid']) . '" />' . $title . '</td>';
			if ($a == 2) {
				echo '</tr><tr><td>&nbsp;</td>';
				$a = 0;
			} else {
				$a++;
			}
		}
	}
	echo '</tr><tr><td>&nbsp;</td>'
		. '<td><input type="checkbox" name="add_radminsuper" value="1" /><span class="thick">' . _SUPERUSER . '</span></td>'
		. '</tr>'
		. '<tr><td>&nbsp;</td><td colspan="3"><span class="tiny italic">' . _SUPERWARNING . '</span></td></tr>'
		. '<tr><td>' . _PASSWORD . '</td>'
		. '<td colspan="3"><input type="password" name="add_pwd" size="12" maxlength="40" /> <span class="tiny">' . _REQUIRED . '</span><input type="hidden" name="op" value="AddAuthor" /></td></tr>'
		. '<tr><td><input type="submit" value="' . _ADDAUTHOR2 . '" /></td></tr>'
		. '</table></form>';
	CloseTable();
	include_once 'footer.php';
}

function modifyadmin($chng_aid) {
	global $admin, $prefix, $db, $multilingual, $admin_file;
	$a = 0;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="title thick">' . _AUTHORSADMIN . '</span></div>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center"><span class="option thick">' . _MODIFYINFO . '</span></div>';
	$adm_aid = $chng_aid;
	$adm_aid = trim($adm_aid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT aid, name, url, email, pwd, radminsuper, admlanguage from ' . $prefix . '_authors where aid=\'' . $chng_aid . '\''));
	$chng_aid = $row['aid'];
	$chng_name = $row['name'];
	$chng_url = stripslashes($row['url']);
	$chng_email = stripslashes($row['email']);
	$chng_pwd = $row['pwd'];
	$chng_radminsuper = intval($row['radminsuper']);
	$chng_admlanguage = $row['admlanguage'];
	$chng_aid = substr($chng_aid, 0, 25);
	$aid = $chng_aid;
	echo '<form action="' . $admin_file . '.php" method="post">'
		. '<table border="0">'
		. '<tr><td>' . _NAME . ':</td>'
		. '<td colspan="3"><span class="thick">' . $chng_name . '</span> <input type="hidden" name="chng_name" value="' . $chng_name . '" /></td></tr>'
		. '<tr><td>' . _NICKNAME . ':</td>'
		. '<td colspan="3"><input type="text" name="chng_aid" value="' . $chng_aid . '" size="30" maxlength="25" /> <span class="tiny">' . _REQUIRED . '</span></td></tr>'
		. '<tr><td>' . _EMAIL . ':</td>'
		. '<td colspan="3"><input type="text" name="chng_email" value="' . $chng_email . '" size="30" maxlength="60" /> <span class="tiny">' . _REQUIRED . '</span></td></tr>'
		. '<tr><td>' . _URL . ':</td>'
		. '<td colspan="3"><input type="text" name="chng_url" value="' . $chng_url . '" size="30" maxlength="60" /></td></tr>';
	if ($multilingual == 1) {
		$languageslist = '';
		echo '<tr><td>' . _LANGUAGE . ':</td><td colspan="3">'
			. '<select name="chng_admlanguage">';
		$handle = opendir('language');
		while ($file = readdir($handle)) {
			if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= $langFound . ' ';
			}
		}
		closedir($handle);
		$languageslist = explode(' ', $languageslist);
		sort($languageslist);
		for ($i = 0;$i < sizeof($languageslist);$i++) {
			if (!empty($languageslist[$i])) {
				echo '<option value="' . $languageslist[$i] . '"';
				if ($languageslist[$i] == $chng_admlanguage) {
					echo ' selected="selected"';
				}
				echo '>' . ucfirst($languageslist[$i]) . '</option>';
			}
		}
		if (empty($chng_admlanguage)) {
			$allsel = ' selected="selected"';
		} else {
			$allsel = '';
		}
		echo '<option value=""' . $allsel . '>' . _ALL . '</option></select></td></tr>';
	} else {
		echo '<tr><td><input type="hidden" name="chng_admlanguage" value="" /></td></tr>';
	}
	if ($row['name'] != 'God') {
		echo '<tr><td>' . _PERMISSIONS . ':</td>';
		$result = $db->sql_query('SELECT mid, title, admins FROM ' . $prefix . '_modules ORDER BY title ASC');
		$numbersel = -1;
		while ($row = $db->sql_fetchrow($result)) {
			$numbersel+$numbersel+1;
			$title = str_replace('_', ' ', $row['title']);
			if (file_exists('modules/' . $row['title'] . '/admin/index.php') AND file_exists('modules/' . $row['title'] . '/admin/links.php') AND file_exists('modules/' . $row['title'] . '/admin/case.php')) {
				if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
				$admins = explode(',', $row['admins']);
				$sel = '';
				for ($i = 0;$i < sizeof($admins);$i++) {
					if ($chng_name == $admins[$i]) {
						$sel = ' checked="checked"';
					}
				}
				// we want to know what the original value is so we can compare later
				$mid = intval($row['mid']);
				if ($sel == ' checked="checked"') {
					$init_admsel = $mid . '=1';
				} else {
					$init_admsel = $mid . '=0';
				}
				echo '<td><input type="hidden" name="init_adm[]" value="' . $init_admsel . '" /><input type="checkbox" name="auth_modules[]" value="' . $mid . '"' . $sel . ' />' . $title . '</td>';
				$sel = '';
				if ($a == 2) {
					echo '</tr><tr><td>&nbsp;</td>';
					$a = 0;
				} else {
					$a++;
				}
			}
		}
		echo '</tr><tr><td>&nbsp;</td>';
		$supersel = '';
		if ($chng_radminsuper == 1) {
			$supersel = ' checked="checked"';
			$init_supersel = 1;
		} else {
			$init_supersel = 0;
		}
		echo '<td><input type="hidden" name="init_super" value="' . $init_supersel . '" /><input type="checkbox" name="chng_radminsuper" value="' . $chng_radminsuper . '"' . $supersel . ' /> <span class="thick">' . _SUPERUSER . '</span></td>';
		echo '</tr><tr><td>&nbsp;</td>';
		echo '<td colspan="3"><span class="tiny"><span class="italic">' . _SUPERWARNING . '</span></span></td></tr>';
		// the else below is that the user being changed is god  we dont want the superuser choice even to be there
	}
	echo '<tr><td>' . _PASSWORD . ':</td>'
		. '<td colspan="3"><input type="password" name="chng_pwd" size="12" maxlength="40" /></td></tr>'
		. '<tr><td>' . _RETYPEPASSWD . ':</td>'
		. '<td colspan="3"><input type="password" name="chng_pwd2" size="12" maxlength="40" /> <span class="tiny">' . _FORCHANGES . '</span><input type="hidden" name="adm_aid" value="' . $adm_aid . '" /><input type="hidden" name="op" value="UpdateAuthor" /></td></tr>'
		. '<tr><td><input type="submit" value="' . _SAVE . '" /> ' . _GOBACK
		. '</td></tr></table></form>';
	CloseTable();
	include_once 'footer.php';
}

function updateadmin() {
	global $admin, $prefix, $db, $admin_file;
	foreach($_POST as $key => $value) {
		$a = $key;
		$$a = $value;
		if (is_Array($a)) {
			foreach($a as $key => $value) {
				$a = $key;
				$$a = $value;
			}
		}
	}
	if (!isset($init_super)) {
		$init_super = '';
	}
	if (!isset($auth_modules)) {
		$auth_modules = '';
	}
	// prevent anything from integers from being in the arrays
	// note: that if equal sign isnt present in init_adm program will bomb but it should
	if ($auth_modules != '') {
		for ($j = 0;$j < sizeof($auth_modules);$j++) {
			$auth_modules[$j] = intval($auth_modules[$j]);
		}
	}
	if (!isset($init_adm)) $init_adm = array();
	for ($j = 0;$j < sizeof($init_adm);$j++) {
		$compare = explode('=', $init_adm[$j]);
		$init_adm[$j] = intval($compare[0]) . '=' . intval($compare[1]);
	}
	if (isset($chng_radminsuper) || $chng_name == 'God') {
		$chng_radminsuper = 1;
	} else {
		$chng_radminsuper = 0;
	}
	$init_super = intval($init_super);
	if ($chng_radminsuper != $init_super) {
		$chng_super = TRUE;
	} else {
		$chng_super = FALSE;
	}
	$chng_pwd_sql = '';
	if (!empty($chng_pwd2)) {
		if ($chng_pwd != $chng_pwd2) {
			include_once 'header.php';
			GraphicAdmin();
			OpenTable();
			echo _PASSWDNOMATCH . '<br /><br /><div class="text-center">' . _GOBACK . '</div>';
			CloseTable();
			include_once 'footer.php';
			exit;
		}
		$chng_pwd = md5($chng_pwd);
		$chng_pwd_sql = 'pwd = \'' . $chng_pwd . '\',';
	} else {
		$chng_pwd_sql = '';
	}
	$chng_aid = substr($chng_aid, 0, 25);
	// do authors table update for all situations
	$sql = 'update ' . $prefix . '_authors set aid=\''. $chng_aid.'\', email= \''. $chng_email.'\', url=\''. $chng_url.'\', radminsuper=\''. $chng_radminsuper.'\','.$chng_pwd_sql.' admlanguage=\''. $chng_admlanguage.'\' where name=\''.$chng_name.'\' AND aid=\''. $adm_aid.'\'' ;
	echo $sql;
	$result = $db->sql_query($sql);
	if ($chng_name != 'God' AND $chng_super AND $init_super == 0) {
		// if you change a normal admin to superadmin then any entries for them in the
		// modules table admins field get deleted
		for ($j = 0;$j < sizeof($init_adm);$j++) {
			$compare = explode('=', $init_adm[$j]);
			if ($compare[1] == '1') {
				$sql = 'SELECT mid, admins FROM ' . $prefix . '_modules WHERE mid = \'' . $compare[0] . '\'';
				$result = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($result)) {
					if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
					$admins = explode(',', $row['admins']);
					$adm = '';
					for ($a = 0;$a < sizeof($admins);$a++) {
						if ($admins[$a] != $chng_name) {
							$adm .= $admins[$a] . ',';
						}
					}
				}
				$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . '\' WHERE mid=\'' . $compare[0] . '\'');
			} // end  superadmin was initially an admin of a module

		} // end of init_admin array

	} // end 'God' AND $chng_super and initially a superuser
	//*******************************************************************
	//  now: if init super = 1 and it's being changed OR its just a normal admin we
	// need to process the auth_modules checkboxes and check the admins fields
	if (($init_super == 1 AND $chng_super) OR ($init_super == 0 AND !$chng_super)) {
		// look for adds ... these will be in auth_modules where corresponding
		// init_adm is zero
		if ($auth_modules != '') {
			for ($i = 0;$i < sizeof($auth_modules);$i++) {
				for ($j = 0;$j < sizeof($init_adm);$j++) {
					$compare = explode('=', $init_adm[$j]);
					if ($compare[0] == $auth_modules[$i]) { // mids match
						if ($compare[1] == '0') { // was not an admin
							$sql = 'SELECT mid, admins FROM ' . $prefix . '_modules WHERE mid = \'' . $compare[0] . '\'';
							$result = $db->sql_query($sql);
							$row = $db->sql_fetchrow($result);
							if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
							$admins = explode(',', $row['admins']);
							$dummy = '';
							for ($a = 0;$a < sizeof($admins);$a++) {
								if ($admins[$a] == $chng_name) {
									$dummy = 1;
								}
							}
							if ($dummy != 1) {
								$adm = $row['admins'] . $chng_name;
								$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . ',\' WHERE mid=\'' . $compare[0] . '\'');
							}
							$dummy = '';
						} // end of the add condition ... init_adm was zero to start
					} // matched module ids
				} // end of init_adm loop
			} // end of auth_modules loop
		} // end that there is at least one auth_module
		// now:  if there are no auth modules (checkboxes) and there are any "1" entries in init_adm ... we need to delete them from admins fields
		if ($auth_modules == '') {
			for ($j = 0;$j < sizeof($init_adm);$j++) {
				$compare = explode('=', $init_adm[$j]);
				if ($compare[1] == '1') {
					$sql = 'SELECT mid, admins FROM ' . $prefix . '_modules WHERE mid = \'' . $compare[0] . '\'';
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result)) {
						if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
						$admins = explode(',', $row['admins']);
						$adm = '';
						for ($a = 0;$a < sizeof($admins);$a++) {
							if ($admins[$a] != $chng_name) {
								$adm .= $admins[$a] . ',';
							}
						}
					}
					$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . '\' WHERE mid=\'' . $compare[0] . '\'');
				} // end that adm was for that module

			} // end for init_adm array

		} // end that auth modules is null (no checkboxes)
		else { // there is something in auth_modules but we need to check for deletes
			for ($j = 0;$j < sizeof($init_adm);$j++) {
				$delflag = TRUE;
				$compare = explode('=', $init_adm[$j]);
				if ($compare[1] == 1) {
					for ($i = 0;$i < sizeof($auth_modules);$i++) {
						if ($compare[0] == $auth_modules[$i]) {
							$delflag = FALSE;
							break;
						}
					}
					if ($delflag) {
						$sql = 'SELECT mid, admins FROM ' . $prefix . '_modules WHERE mid = \'' . $compare[0] . '\'';
						$result = $db->sql_query($sql);
						while ($row = $db->sql_fetchrow($result)) {
							if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
							$admins = explode(',', $row['admins']);
							$adm = '';
							for ($a = 0;$a < sizeof($admins);$a++) {
								if ($admins[$a] != $chng_name) {
									$adm .= $admins[$a] . ',';
								}
							}
						}
						$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . '\' WHERE mid=\'' . $compare[0] . '\'');
					} // end deflag

				} // end compare = 1

			} // end for loop on init_adm

		} // end of else that auth_modules is not null

	} // end $init_super == 1 AND $chng_super OR $init_super == 0 AND !$chng_super
	// the above are where we have to process modules table
	// this is the end of the change password part  cleanup of stories follows if the aid id is changed
	if ($adm_aid != $chng_aid) {
		$result2 = $db->sql_query('SELECT sid, aid, informant from ' . $prefix . '_stories where aid=\'' . $adm_aid . '\'');
		while ($row2 = $db->sql_fetchrow($result2)) {
			$sid = intval($row2['sid']);
			$old_aid = $row2['aid'];
			$old_aid = substr($old_aid, 0, 25);
			$informant = $row2['informant'];
			$informant = substr($informant, 0, 25);
			if ($old_aid == $informant) {
				$db->sql_query('update ' . $prefix . '_stories set informant=\'' . $chng_aid . '\' where sid=\'' . $sid . '\'');
			}
			$db->sql_query('update ' . $prefix . '_stories set aid=\'' . $chng_aid . '\' WHERE sid=\'' . $sid . '\'');
		}
	}
	//removed ?op=mod_authors from redirect so that you don't get banned when changing your own password. - Palbin
	Header('Location: ' . $admin_file . '.php');
	//   include_once 'footer.php';
	// note:  if you comment out the header and uncomment the footer you can dump the
	// arrays to the screen to diagnose any problems ... may have to add some echoes
}

function deladminconf($del_aid) {
	global $admin, $admin_file, $db, $prefix;

	$del_aid = trim($del_aid);

	$row = $db->sql_fetchrow($db->sql_query('SELECT name from ' . $prefix . '_authors where aid=\'' . $del_aid . '\''));
	$del_name = trim($row['name']);

	$db->sql_query('DELETE from ' . $prefix . '_authors WHERE aid=\'' . $del_aid . '\' AND name!=\'God\'');
	$result = $db->sql_query('SELECT mid, admins FROM ' . $prefix . '_modules WHERE admins LIKE \'%' . $del_name . '%\'');
		while ($row2 = $db->sql_fetchrow($result)) {
			if ($row2['admins'] == '0' or $row2['admins'] == '1') $row2['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
			$admins = explode(',', $row2['admins']);
			$adm = '';
			for ($a = 0;$a < sizeof($admins);$a++) {
				if ($admins[$a] != $del_name AND !empty($admins[$a])) {
					$adm .= $admins[$a] . ',';
				}
			}
			$db->sql_query('UPDATE ' . $prefix . '_modules SET admins=\'' . $adm . '\' WHERE mid=\'' . intval($row2['mid']) . '\'');
		}
	Header('Location: ' . $admin_file . '.php?op=mod_authors');
}

function deladmin2($del_aid) {
	global $admin, $admin_file, $db, $prefix;
	$del_aid = substr($del_aid, 0, 25);
//	$auth_user = 0;
//	$radminarticle = 0;
//	$result = $db->sql_query('SELECT admins FROM ' . $prefix . '_modules WHERE title=\'News\'');
//	$row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM ' . $prefix . '_authors WHERE aid=\'' . $del_aid . '\''));
//	while ($row = $db->sql_fetchrow($result)) {
//		if ($row['admins'] == '0' or $row['admins'] == '1') $row['admins'] = ''; // montego - fix due incorrect usage of field by other modules (this is not a boolean on/off field)
//		$admins = explode(',', $row['admins']);
//		$auth_user = 0;
//		for ($i = 0;$i < sizeof($admins);$i++) {
//			if ($row2['name'] == $admins[$i]) {
//				$auth_user = 1;
//			}
//		}
//		if ($auth_user == 1) {
//			$radminarticle = 1;
//		}
//	}
//	if ($radminarticle == 1) {
		$numrows = $db->sql_numrows($db->sql_query('SELECT sid from ' . $prefix . '_stories where aid LIKE \'%' . $del_aid . '%\''));
//		$sid = intval($row2['sid']);
		if ($numrows > 0) {
			include_once 'header.php';
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center"><span class="title thick">' . _AUTHORSADMIN . '</span></div>';
			CloseTable();
			echo '<br />';
			OpenTable();
			echo '<div class="text-center"><span class="option thick">' . _PUBLISHEDSTORIES . '</span><br /><br />' . _SELECTNEWADMIN . ':<br /><br />';
			$result3 = $db->sql_query('SELECT aid from ' . $prefix . '_authors where aid!=\'' . $del_aid . '\'');
			echo '<form name="reassign" action="' . $admin_file . '.php" method="post"><select name="newaid">';
			while ($row3 = $db->sql_fetchrow($result3)) {
				$oaid = $row3['aid'];
				$oaid = substr($oaid, 0, 25);
				echo '<option value="' . $oaid . '">' . $oaid . '</option>';
			}
			echo '</select><input type="hidden" name="del_aid" value="' . $del_aid . '" />'
				. '<input type="hidden" name="op" value="assignstories" />'
				. '<input type="submit" value="' . _OK . '" />'
				. '</form></div>';
			CloseTable();
			include_once 'footer.php';
			return;
		}
//	}
	deladminconf($del_aid);
}
?>