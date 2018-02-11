<?php
/* nukeNAV(tm)     Copyright 2009 by Kevin Guske         http://www.nukeSEO.com

  This program is free software. You can redistribute it and/or modify it under the terms of the GNU
  General Public License as published by the Free Software Foundation; either version 2 of the License. */
if ( !defined('BLOCK_FILE') ) { Header("Location: ../index.php");	die();}
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'nukeNAV-center nukeNAVmod';
	} else {
	$ListClass = 'nukeNAVmod';
}
$n = 2;
global $prefix, $db, $admin, $user, $ya_config;
$ThemeSel = get_theme();
if (file_exists('themes/' . $ThemeSel . '/module.php')) include('themes/' . $ThemeSel . '/module.php');
if (!defined('_MAINMODULE')) {
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_main'));
	define('_MAINMODULE', $row['main_module']);
}
$content = '<table border="0" cellpadding="0" cellspacing="0"><tr><td><ul class="' . $ListClass . '"><li class="li-first"><a href="./">'._HOME."</a></li>\n";
$where = 'WHERE title != \'' . _MAINMODULE . '\' AND title != \'nukeNAV\'';
if (!is_admin($admin)) $where .= 'AND active=\'1\' AND inmenu=\'1\'';
$result3 = $db->sql_query('SELECT * FROM ' . $prefix . '_modules ' . $where . ' ORDER BY active DESC, inmenu DESC, custom_title ASC');
$la = $lim = 1;
while ($row3 = $db->sql_fetchrow($result3)) {
	$m_title = stripslashes($row3['title']);
	$custom_title = $row3['custom_title'];
	$view = intval($row3['view']);
	$groups = $row3['groups'];
	$active = intval($row3['active']);
	$inmenu = intval($row3['inmenu']);
	$m_title2 = str_replace('_', ' ', $m_title);
	if ($n % 2){$column = 'li-odd';} else if ($n==2) {$column = 'li-even li-next';} else {$column = 'li-even';}
	if ($custom_title > '') $m_title2 = $custom_title;
	if ($inmenu <> $lim and $active == 1) {
		$content .= '<li class="' . $column . '"><a>'._INVISIBLEMODULES."</a>\n".'<ul>'."\n"; // Start hidden menu
		$n++;
	}
	if ($active <> $la) {
		if ($lim == 0) $content .= '</ul>'."\n".'</li>'."\n";		// Close hidden menu
		$content .= '<li class="' . $column . '"><a>'._NOACTIVEMODULES."</a>\n".'<ul>'."\n";		// Start inactive menu
		$n++;
	}
	if (($view == 0) or ($view == 1 and is_user($user)) or ($view == 2 and is_admin($admin)) or ($view == 3 and paid()) or ($view > 3 AND in_groups($groups)) ) {
		if ((!$inmenu and $active == 1) OR ($active == 0)) {
			$content .= '<li><a href="modules.php?name='.$m_title.'">'.$m_title2.'</a>';
			} else {
			$content .= '<li class="' . $column . '"><a href="modules.php?name='.$m_title.'">'.$m_title2.'</a>';
			$n++;
		}
		if ($m_title == 'Your_Account') {
			if (!isset($ya_config)) {
				include_once('modules/Your_Account/includes/functions.php');
				$ya_config = ya_get_configs();
			}
			if (is_user($user)) {
				$content .= '<ul>';
				if (is_active('Private_Messages')) $content .= '<li><a href="modules.php?name=Private_Messages" title="">' . _BPM . '</a></li>';
				$content .= '<li><a href="modules.php?name=Your_Account&amp;op=edituser" title="">'. _BPREFS . '</a></li>';
				if ($ya_config['allowusertheme']=='1') $content .= '<li><a href="modules.php?name=Your_Account&amp;op=chgtheme" title="">' . _BCHGTHEME . '</a></li>';
				$content .= '<li><a href="modules.php?name=Your_Account&amp;op=logout" title="">' . _LOGOUT . '</a></li></ul>';
			} else {
				$content .= '
				<ul>
				<li><a href="modules.php?name=Your_Account" title="">' . _LOGIN . '</a></li>';
				if ($ya_config['allowuserreg']=='1') $content .= '
				<li><a href="modules.php?name=Your_Account&amp;op=new_user" title="">' . _BREG . '</a></li>';
				$content .= '
				</ul>';
			}
		}
		$content .= "</li>\n";
  }
	$la = $active; $lim = $inmenu;
}
if ($la == 0 or $lim == 0) $content .= '</ul></li>';  // Close hidden or inactive menu
$content .= '</ul></td></tr></table>';
/* If you copied a new module is the /modules/ directory, it will be added to the database */
/*  Make this an admin function on the modules admin page??
if (is_admin($admin)) {
	$handle=opendir('modules');
	while ($file = readdir($handle)) {
		if ( (!preg_match("/[.]/", $file)) ) $modlist .= $file . ' ';
	}
	closedir($handle);
	$modlist = explode(" ", $modlist);
	sort($modlist);
	for ($i=0; $i < sizeof($modlist); $i++) {
		if($modlist[$i] != '') {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT mid FROM ' . $prefix . '_modules WHERE title=\''. $modlist[$i] . '\''));
			$mid = intval($row4['mid']);
			$mod_uname = str_replace('_', ' ', $modlist[$i]);
			if ($mid == "") $db->sql_query('INSERT INTO ' . $prefix . '_modules VALUES (NULL, \'' . $modlist[$i] . '\', \'' . $mod_uname . '\', \'0\', \'0\', \'\', \'1\', \'0\', \'\')');		}
	}
}
*/
?>