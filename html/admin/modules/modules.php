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
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if (!defined('ADMIN_FILE')) die ('Access Denied');
global $prefix, $db, $admin_file;
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT radminsuper FROM '. $prefix .'_authors WHERE aid=\''.$aid.'\''));
if ($row['radminsuper'] == 1) {
	switch ($op){

		case 'modules':
		modules();
		break;

		case 'module_status':
		csrf_check();
		isset($_GET['mid']) ? $mid = intval($_GET['mid']) : header('Location: ' . $admin_file . '.php?op=modules');
		isset($_GET['active']) ? $active = intval($_GET['active']) : header('Location: ' . $admin_file . '.php?op=modules'); //Should be 0 or 1
		module_status($mid, $active);
		break;

		case 'module_edit':
		isset($_GET['mid']) ? $mid = intval($_GET['mid']) : header('Location: ' . $admin_file . '.php?op=modules');
		module_edit($mid);
		break;

		case 'module_edit_save':
		csrf_check();
		isset($_POST['mid']) ? $mid = intval($_POST['mid']) : header('Location: ' . $admin_file . '.php?op=modules');
		isset($_POST['custom_title']) ? $custom_title = addslashes(check_html($_POST['custom_title'], 'nohtml')) : header('Location: ' . $admin_file . '.php?op=modules');
		isset($_POST['view']) ? $view = intval($_POST['view']) : $view = 0; //Should be 0 or 1
		if(isset($_POST['groups']) && is_array($_POST['groups'])) {
			$j = count($groups);
			for ($i = 0; $i < $j; $i++) {
				$groups[$i] = intval($groups[$i]);
			}
		} else {
			$groups = array();
		}
		isset($_POST['inmenu']) ? $inmenu = intval($_POST['inmenu']) : $inmenu = 0; //Should be 0 or 1
		isset($_POST['mod_group']) ? $mod_group = intval($_POST['mod_group']) : $mod_group = 0;
		module_edit_save($mid, $custom_title, $view, $groups, $inmenu, $mod_group);
		break;

		case 'home_module':
		csrf_check();
		isset($_GET['mid']) ? $mid = intval($_GET['mid']) : header('Location: ' . $admin_file . '.php?op=modules');
		isset($_GET['ok']) ? $ok = intval($_GET['ok']) : $ok = 0; //Should be 0 or 1
		home_module($mid, $ok);
		break;

	}

} else {
	echo 'Access Denied';
}
die();
// Only functions beyond this point
/*********************************************************/
/* Modules Functions                                     */
/*********************************************************/
function modules() {
	global $prefix, $db, $multilingual, $bgcolor2, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title thick">' . _MODULESADMIN . '</div>';
	CloseTable();
// Begin - Add new modules
	$handle=opendir('modules');
	//$groupsLoaded = file_exists('modules/Groups')?TRUE:FALSE; //RN0000476
	$modlist = array ();
	while ($file = readdir($handle)) {
		if (stristr($file, '.')) continue 1;  //RN0000515
		$modlist[] = $file;
	}
	closedir($handle);
	$numFiles = sizeof($modlist);
	for ($i=0; $i < $numFiles; $i++) {
		if (empty($modlist[$i])) continue 1;
		if ($db->sql_fetchrow($db->sql_query('SELECT mid FROM '.$prefix.'_modules WHERE title=\''.$modlist[$i].'\''))) continue 1;

      $db->sql_query('INSERT INTO '.$prefix.'_modules VALUES (NULL, \''.$modlist[$i].'\', \''.str_replace('_', ' ', $modlist[$i]).'\', 0, 0, \'\', 0, 0, \'\')');
	}
// End - Add new modules
//
// Begin - Delete removed modules
	$result2 = $db->sql_query('SELECT title from ' . $prefix . '_modules');
	while ($row2 = $db->sql_fetchrow($result2)) {
		$title = $row2['title'];
		$a = 0;
		$handle=opendir('modules');
		while ($file = readdir($handle)) {
			if ($file == $title) {
				$a = 1;
			}
		}
		closedir($handle);
		if ($a == 0) {
			$db->sql_query('DELETE FROM ' . $prefix . '_modules WHERE title=\''.$title.'\'');
		}
	}
// End - Delete removed modules

   echo '<br />';
	OpenTable();
	echo '<br /><div class="text-center"><span class="option">' . _MODULESADDONS . '</span><br /><br />'
		.'<span class="content">' . _MODULESACTIVATION . '</span><br /><br />'
		.'' . _MODULEHOMENOTE . '<br /><br />' . _NOTINMENU . '<br /><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<table border="1" align="center" width="90%"><tr><td align="center" bgcolor="'.$bgcolor2.'" class="thick">'
		.''._TITLE.'</td><td align="center" bgcolor="'.$bgcolor2.'" class="thick">'._CUSTOMTITLE.'</td><td align="center" bgcolor="'
		.$bgcolor2.'" class="thick">'._STATUS.'</td><td align="center" bgcolor="'.$bgcolor2.'" class="thick">'._VIEW
		.'</td><td align="center" bgcolor="'.$bgcolor2.'" class="thick">'._UGROUPS.'</td><td align="center" bgcolor="'
		.$bgcolor2.'" class="thick">'._FUNCTIONS.'</td></tr>';
	$main_m = $db->sql_fetchrow($db->sql_query('SELECT main_module from ' . $prefix . '_main'));
	$main_module = $main_m['main_module'];
	$result3 = $db->sql_query('SELECT mid, title, custom_title, active, view, groups, inmenu, mod_group FROM ' . $prefix . '_modules ORDER BY title ASC');// RN 1489
	while ($row3 = $db->sql_fetchrow($result3)) {
		$mid = intval($row3['mid']);
		$title = $row3['title'];
		$custom_title = $row3['custom_title'];
		$active = intval($row3['active']);
		$view = intval($row3['view']);
      $groups = intval($row3['groups']); // RN 1489
		$inmenu = intval($row3['inmenu']);
		$mod_group = intval($row3['mod_group']);
		if (empty($custom_title)) {
			$custom_title = str_replace('_',' ',$title);
			$db->sql_query('UPDATE ' . $prefix . '_modules SET custom_title=\''.$custom_title.'\' WHERE mid=\''.$mid.'\'');
		}
		if ($active == 1) {
			$active = _ACTIVE;
			$change = _DEACTIVATE;
			$act = 0;
		} else {
			$active = '<span class="italic">' . _INACTIVE . '</span>';
			$change = _ACTIVATE;
			$act = 1;
		}
		if (empty($custom_title)) {
			$custom_title = str_replace('_', ' ', $title);
		}
		if ($view == 0) {
			$who_view = _MVALL;
		} elseif ($view == 1) {
			$who_view = _MVUSERS;
		} elseif ($view == 2) {
			$who_view = _MVADMIN;
		} elseif ($view == 3) {
			$who_view = _SUBUSERS;
		} elseif ($view > 3) {
			 $who_view = _MVGROUPS;
		}
		if ($title != $main_module AND $inmenu == 0) {
			$title = '[ <span class="larger"><strong>&middot;</strong></span> ] '.$title;
		}
		if ($title == $main_module) {
			$title = '<span class="thick">'.$title.'</span>';
			$custom_title = '<span class="thick">'.$custom_title.'</span>';
			$active = '<span class="thick">'.$active.' (' . _INHOME . ')</span>';
			$who_view = '<span class="thick">'.$who_view.'</span>';
			$puthome = '<span class="italic">' . _PUTINHOME . '</span>';
			$change_status = '<span class="italic">'.$change.'</span>';
			$background = 'bgcolor="'.$bgcolor2.'"';
		} else {
			$puthome = '<a class="rn_csrf" href="'.$admin_file.'.php?op=home_module&amp;mid='.$mid.'">' . _PUTINHOME . '</a>';
			$change_status = '<a class="rn_csrf" href="'.$admin_file.'.php?op=module_status&amp;mid='.$mid.'&amp;active='.$act.'">'.$change.'</a>';
			$background = '';
		}

      // RN 1489 (G)
      if ($mod_group <=0) {
         $mod_group = _NONE;
      } else {
         $grp = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_groups WHERE id=\''.$mod_group.'\''));
			$mod_group = $grp['name'];
         echo $grp['name'];
      }

   echo '<tr><td '.$background.'>&nbsp;'.$title.'</td><td align="center" '.$background.'>'.$custom_title
			.'</td><td align="center" '.$background.'>'.$active.'</td><td align="center" '.$background.'>'.$who_view
			.'</td><td align="center" '.$background.'>'.$mod_group.'</td><td align="center" '.$background
			.' nowrap="nowrap">[ <a href="'.$admin_file.'.php?op=module_edit&amp;mid='.$mid.'">'._EDIT.'</a> | '.$change_status
			.' | '.$puthome.' ]</td></tr>';
	}
	echo '</table></form></div>';
	CloseTable();
	include_once('footer.php');
}

function home_module($mid, $ok=0) {
	global $prefix, $db, $admin_file;
	if ($ok == 0) {
		include_once('header.php');
		GraphicAdmin();
		title('' . _HOMECONFIG . '');
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query('SELECT title from ' . $prefix . '_modules WHERE mid=\''.$mid.'\''));
		$new_m = $row['title'];
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT main_module from ' . $prefix . '_main'));
		$old_m = $row2['main_module'];
		echo '<div class="text-center"><span class="thick">' . _DEFHOMEMODULE . '</span><br /><br />'
			.'' . _SURETOCHANGEMOD . ' <span class="thick">'.$old_m.'</span> ' . _TO . ' <span class="thick">'.$new_m.'</span>?<br /><br />'
			.'[ <a class="rn_csrf" href="'.$admin_file.'.php?op=home_module&amp;mid='.$mid
			.'&amp;ok=1">' . _YES . '</a> | <a href="'.$admin_file.'.php?op=modules">' . _NO . '</a> ]</div>';
		CloseTable();
		include_once('footer.php');
	} else {
		$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_modules WHERE mid=\''.$mid.'\''));
		$title = $row3['title'];
		$active = 1;
		$view = 0;
		$res = $db->sql_query('UPDATE ' . $prefix . '_main SET main_module=\''.$title.'\'');
		$res2 = $db->sql_query('UPDATE ' . $prefix . '_modules SET active=\''.$active.'\', view=\''.$view.'\' where mid=\''.$mid.'\'');
		Header('Location: '.$admin_file.'.php?op=modules');
	}
}

function module_status($mid, $active) {
	global $prefix, $db, $admin_file;
	$db->sql_query('UPDATE ' . $prefix . '_modules SET active=\''.$active.'\' WHERE mid=\''.$mid.'\'');
	Header('Location: '.$admin_file.'.php?op=modules');
}

function module_edit($mid) {
	global $prefix, $db, $admin_file;
	$main_m = $db->sql_fetchrow($db->sql_query('SELECT main_module FROM ' . $prefix . '_main'));
	$main_module = $main_m['main_module'];
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_modules WHERE mid=\''.$mid.'\''));
	$groups = $row['groups'];
	$title = $row['title'];
	$custom_title = $row['custom_title'];
	$view = intval($row['view']);
	$inmenu = intval($row['inmenu']);
	$mod_group = intval($row['mod_group']);
	include_once('header.php');
	GraphicAdmin();
	title(_MODULEEDIT);
	OpenTable();
	$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = '';
	if ($view == 0) {
		$sel1 = ' selected="selected"';
	} elseif ($view == 1) {
		$sel2 = ' selected="selected"';
	} elseif ($view == 2) {
		$sel3 = ' selected="selected"';
	} elseif ($view == 3) {
		$sel4 = ' selected="selected"';
	} elseif ($view > 3) {
		$sel5 = ' selected="selected"';
	}
	if ($title == $main_module) {
		$a = ' - ' . _INHOME . '';
	} else {
		$a = '';
	}
	if ($inmenu == 1) {
		$insel1 = ' checked="checked"';
		$insel2 = '';
	} elseif ($inmenu == 0) {
		$insel1 = '';
		$insel2 = ' checked="checked"';
	}
	echo '<div class="text-center"><span class="thick">' . _CHANGEMODNAME . '</span><br />('.$title.$a.')</div><br /><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<table border="0"><tr><td>'
		.'' . _CUSTOMMODNAME . '</td><td>'
		.'<input type="text" name="custom_title" value="'.$custom_title.'" size="50" /></td></tr>';
	if ($title == $main_module) {
		echo '<input type="hidden" name="view" value="0" />'
			.'<input type="hidden" name="inmenu" value="'.$inmenu.'" />'
			.'</table><br /><br />';
	} else {
		echo '<tr><td>' . _VIEWPRIV . '</td><td><select name="view">'
			.'<option value="0"'.$sel1.'>' . _MVALL . '</option>'
			.'<option value="1"'.$sel2.'>' . _MVUSERS . '</option>'
			.'<option value="2"'.$sel3.'>' . _MVADMIN . '</option>'
			.'<option value="3"'.$sel4.'>' . _SUBUSERS . '</option>'
			.'<option value="4"'.$sel5.'>'._MVGROUPS.'</option>'
			.'</select></td></tr>';
		echo '<tr><td valign="top" class="thick">'._WHATGROUPS.':</td><td><span class="tiny">'._WHATGRDESC.'</span><br /><select name="groups[]" multiple="multiple" size="5">';
		$ingroups = explode('-',$groups);
		$groupsResult = $db->sql_query('SELECT gid, gname FROM '.$prefix.'_nsngr_groups');
		while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
			if(in_array($gid,$ingroups)) { $sel = ' selected="selected"'; } else { $sel = ''; }
			echo '<option value="'.$gid.'"'.$sel.'>'.$gname.'</option>';
		}
		echo '</select></td></tr>';
		$numrow = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_groups'));
		if ($numrow > 0) {
			echo '<tr><td>' . _UGROUPS . '</td><td><select name="mod_group">';
			$result2 = $db->sql_query('SELECT id, name FROM ' . $prefix . '_groups');
			$dummy = 0;
			while ($row2 = $db->sql_fetchrow($result2)) {
				if ($row2['id'] == $mod_group) { $gsel = ' selected="selected"'; } else { $gsel = ''; }
				if ($dummy != 1) {
					if ($mod_group == 0) { $ggsel = ' selected="selected"'; } else { $ggsel = ''; }
					echo '<option value="0"'.$ggsel.'>' . _NONE . '</option>';
					$dummy = 1;
				}
				echo '<option value="'.intval($row2['id']).'"'.$gsel.'>'.$row2['name'].'</option>';
				$gsel = '';
			}
			echo '</select>&nbsp;<span class="italic">(' . _VALIDIFREG . ')</span></td></tr>';
		} else {
			echo '<tr><td><input type="hidden" name="mod_group" value="0" /></td></tr>';
		}
		echo '<tr><td>'._SHOWINMENU.'</td><td>'
			.'<input type="radio" name="inmenu" value="1"'.$insel1.' /> ' . _YES
			.' &nbsp;&nbsp; <input type="radio" name="inmenu" value="0"'.$insel2.' /> ' . _NO . ''
			.'</td></tr></table><br /><br />';
	}
//RavenNuke76 2.10.00 Montego - have no idea why this is here (not there in core code either)
//    if ($title != $main_module) {
//
//    }
	echo '<input type="hidden" name="mid" value="'.$mid.'" />'
		.'<input type="hidden" name="op" value="module_edit_save" />'
		.'<input type="submit" value="' . _SAVECHANGES . '" />'
		.'</form>'
		.'<br /><br /><div class="text-center">' . _GOBACK . '</div>';
	CloseTable();
	include_once('footer.php');
}

function module_edit_save($mid, $custom_title, $view, $groups, $inmenu, $mod_group) {
	global $prefix, $db, $admin_file;
	if ($view == 4) { $ingroups = implode('-',$groups); }
	if ($view < 4) { $ingroups = ''; }
	if ($view != 1) { $mod_group = 0; }
	$result = $db->sql_query('UPDATE ' . $prefix . '_modules SET custom_title=\''.$custom_title.'\', view=\''.$view.'\', groups=\''.$ingroups.'\', inmenu=\''.$inmenu.'\', mod_group=\''.$mod_group.'\' WHERE mid=\''.$mid.'\'');
	Header('Location: '.$admin_file.'.php?op=modules');
}

?>