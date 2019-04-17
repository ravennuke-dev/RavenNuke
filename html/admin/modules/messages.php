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
/*########################################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
#########################################################################*/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
global $prefix, $db, $admin_file;

if (is_mod_admin('admin')) {
	if (!isset($title)) $title = '';
	if (!isset($msgcontent)) $msgcontent = '';
	if (!isset($mdate)) $mdate = '';
	if (!isset($expire)) $expire = '';
	if (!isset($active)) $active = '';
	if (!isset($view)) $view = '';
	if (!isset($chng_date)) $chng_date = '';
	if (!isset($mlanguage)) $mlanguage = '';
	switch ($op) {
		case 'messages':
			messages();
			break;
		case 'editmsg':
			editmsg($mid, $title, $msgcontent, $mdate, $expire, $active, $view, $chng_date, $mlanguage);
			break;
		case 'addmsg':
			csrf_check();
			if (!isset($add_groups)) $add_groups = '';
			addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage);
			break;
		case 'deletemsg':
			csrf_check();
			if (!isset($ok)) $ok = '';
			deletemsg($mid, $ok);
			break;
		case 'savemsg':
			csrf_check();
			if (!isset($groups)) $groups = '';
			savemsg($mid, $title, $msgcontent, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage);
			break;
		}
} else {
	echo 'Access Denied';
}
die();
/*********************************************************/
/* Messages Functions                                    */
/*********************************************************/
// function MsgDeactive($mid) {  // montego - this function code was removed as nothing is calling it.

function messages() {
	global $admin, $admlanguage, $language, $bgcolor1, $bgcolor2, $prefix, $db, $multilingual, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title thick"> ' . _MESSAGESADMIN . '</div>';
	CloseTable();
	echo '<br />';
	if (empty($admlanguage)) {
		$admlanguage = $language; // This to make sure some language is pre-selected
	}
	OpenTable();
	echo '<div class="text-center"><span class="title thick">' . _ALLMESSAGES . '</span><br /><br />'
		. '<table border="1" width="100%" bgcolor="' . $bgcolor1 . '"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _ID . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _TITLE . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">&nbsp;' . _LANGUAGE . '&nbsp;</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" nowrap="nowrap" class="thick">&nbsp;' . _VIEW . '&nbsp;</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">&nbsp;' . _ACTIVE . '&nbsp;</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">&nbsp;' . _FUNCTIONS . '&nbsp;</td></tr>';
	$result = $db->sql_query('SELECT * from ' . $prefix . '_message');
	while ($row = $db->sql_fetchrow($result)) {
		$groups = $row['groups'];
		$mid = intval($row['mid']);
		$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
		$msgcontent = $row['content'];
		$mdate = $row['date'];
		$expire = intval($row['expire']);
		$active = intval($row['active']);
		$view = intval($row['view']);
		$mlanguage = $row['mlanguage'];
		if ($active == 1) {
			$mactive = _YES;
		} elseif ($active == 0) {
			$mactive = _NO;
		}
		if ($view == 1) {
			$mview = _MVALL;
		} elseif ($view == 2) {
			$mview = _MVANON;
		} elseif ($view == 3) {
			$mview = _MVUSERS;
		} elseif ($view == 4) {
			$mview = _MVADMIN;
		} elseif ($view == 5) {
			$mview = _SUBUSERS;
		} elseif ($view > 5) {
			$mview = _MVGROUPS;
		}
		if (empty($mlanguage)) {
			$mlanguage = _ALL;
		}
		echo '<tr>'
			. '<td align="right" class="thick">' . $mid . '</td>'
			. '<td align="left" width="100%" class="thick">' . $title . '</td>'
			. '<td align="center">' . $mlanguage . '</td>'
			. '<td align="center" nowrap="nowrap">' . $mview . '</td>'
			. '<td align="center">' . $mactive . '</td>'
			. '<td align="right" nowrap="nowrap">(<a href="' . $admin_file . '.php?op=editmsg&amp;mid=' . $mid . '">'
			. _EDIT . '</a>-<a class="rn_csrf" href="' . $admin_file . '.php?op=deletemsg&amp;mid=' . $mid . '">' . _DELETE . '</a>)</td>'
			. '</tr>';
	}
	echo '</table></div><br />';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center title thick">' . _ADDMSG . '</div><br />';
	echo '<form action="' . $admin_file . '.php" method="post">'
		. '<br /><span class="thick">' . _MESSAGETITLE . ':</span><br />'
		. '<input type="text" name="add_title" value="" size="50" maxlength="100" /><br /><br />'
		. '<span class="thick">' . _MESSAGECONTENT . ':</span><br />';
	//  ."<textarea name="add_content" rows="15" wrap="virtual" cols="60"></textarea><br /><br />";
	wysiwyg_textarea('add_content', '', 'PHPNukeAdmin', '60', '15');
	echo '<br /><br />';
	if ($multilingual == 1) {
		echo '<span class="thick">' . _LANGUAGE . ': </span>'
			. lang_select_list('add_mlanguage', $language)
			. '<br /><br />';
	} else {
		echo '<input type="hidden" name="add_mlanguage" value="" />';
	}
	$now = time();
	echo '<span class="thick">' . _EXPIRATION . ':</span> <select name="add_expire">'
		. '<option value="86400" >1 ' . _DAY . '</option>'
		. '<option value="172800" >2 ' . _DAYS . '</option>'
		. '<option value="432000" >5 ' . _DAYS . '</option>'
		. '<option value="1296000" >15 ' . _DAYS . '</option>'
		. '<option value="2592000" >30 ' . _DAYS . '</option>'
		. '<option value="0" >' . _UNLIMITED . '</option>'
		. '</select><br /><br />'
		. '<span class="thick">Active?</span> <input type="radio" name="add_active" value="1" checked="checked" />' . _YES . ' '
		. '<input type="radio" name="add_active" value="0" />' . _NO;
	echo '<br /><br /><span class="thick">' . _VIEWPRIV . '</span> <select name="add_view">'
		. '<option value="1" >' . _MVALL . '</option>'
		. '<option value="2" >' . _MVANON . '</option>'
		. '<option value="3" >' . _MVUSERS . '</option>'
		. '<option value="4" >' . _MVADMIN . '</option>'
		. '<option value="5" >' . _SUBUSERS . '</option>'
		. '<option value="6">' . _MVGROUPS . '</option>'
		. '</select><br /><br />'
		. '<span class="tiny">' . _WHATGRDESC . '</span><br /><table border="0"><tr><td valign="top" class="thick">' . _WHATGROUPS . ': </td>'
		. '<td><select name="add_groups[]" multiple="multiple" size="5">';
	$groupsResult = $db->sql_query('SELECT gid, gname FROM ' . $prefix . '_nsngr_groups');
	while (list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
		echo '<option value="' . $gid . '">' . $gname . '</option>';
	}
	echo '</select></td></tr></table><br />'
		. '<input type="hidden" name="op" value="addmsg" />'
		. '<input type="hidden" name="add_mdate" value="' . $now . '" />'
		. '<input type="submit" value="' . _ADDMSG . '" />'
		. '</form>';
	CloseTable();
	include_once('footer.php');
}

function editmsg($mid) {
	global $admin, $prefix, $db, $multilingual, $admin_file, $advanced_editor;
	include_once('header.php');
	$mid = intval($mid);
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title thick">' , _MESSAGESADMIN , '</div>';
	CloseTable();
	echo '<br />';
	$row = $db->sql_fetchrow($db->sql_query('SELECT * from ' . $prefix . '_message WHERE mid=\'' . $mid . '\''));
	$groups = $row['groups'];
	$title = $row['title'];
	$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
	$msgcontent = $row['content'];
	$mdate = $row['date'];
	$expire = intval($row['expire']);
	$active = intval($row['active']);
	$view = intval($row['view']);
	$mlanguage = $row['mlanguage'];
	OpenTable();
	echo '<div class="text-center title thick">' , _EDITMSG , '</div>';
	if ($active == 1) {
		$asel1 = ' checked="checked"';
		$asel2 = '';
	} elseif ($active == 0) {
		$asel1 = '';
		$asel2 = ' checked="checked"';
	}
	$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = $sel6 = '';
	if ($view == 1) {
		$sel1 = ' selected="selected"';
	} elseif ($view == 2) {
		$sel2 = ' selected="selected"';
	} elseif ($view == 3) {
		$sel3 = ' selected="selected"';
	} elseif ($view == 4) {
		$sel4 = ' selected="selected"';
	} elseif ($view == 5) {
		$sel5 = ' selected="selected"';
	} elseif ($view > 5) {
		$sel6 = ' selected="selected"';
	}
	$esel1 = $esel2 = $esel3 = $esel4 = $esel5 = $esel6 = '';
	if ($expire == 86400) {
		$esel1 = ' selected="selected"';
	} elseif ($expire == 172800) {
		$esel2 = ' selected="selected"';
	} elseif ($expire == 432000) {
		$esel3 = ' selected="selected"';
	} elseif ($expire == 1296000) {
		$esel4 = ' selected="selected"';
	} elseif ($expire == 2592000) {
		$esel5 = ' selected="selected"';
	} elseif ($expire == 0) {
		$esel6 = ' selected="selected"';
	}
	echo '<form action="' . $admin_file . '.php" method="post">'
		. '<br /><span class="thick">' . _MESSAGETITLE . ':</span><br />'
		. '<input type="text" name="title" value="' . $title . '" size="50" maxlength="100" /><br /><br />'
		. '<span class="thick">' . _MESSAGECONTENT . ':</span><br />';
	//  ."<textarea name="content" rows="15" wrap="virtual" cols="60">$content</textarea><br /><br />";
	if (!isset($advanced_editor) || $advanced_editor == 0) {
		$msgcontent = htmlspecialchars($msgcontent, ENT_QUOTES, _CHARSET);
		// Necessary to ensure XHTML compliance if editor is off
	}
	wysiwyg_textarea('msgcontent', $msgcontent, 'PHPNukeAdmin', '60', '15');
	echo '<br /><br />';
	if ($multilingual == 1) {
		echo '<span class="thick">' . _LANGUAGE . ': </span>'
			. lang_select_list('mlanguage', $mlanguage)
			. '<br /><br />';
	} else {
		echo '<input type="hidden" name="mlanguage" value="" />';
	}
	echo '<span class="thick">' . _EXPIRATION . ':</span> <select name="expire">'
		. '<option value="86400"' . $esel1 . '>1 ' . _DAY . '</option>'
		. '<option value="172800"' . $esel2 . '>2 ' . _DAYS . '</option>'
		. '<option value="432000"' . $esel3 . '>5 ' . _DAYS . '</option>'
		. '<option value="1296000"' . $esel4 . '>15 ' . _DAYS . '</option>'
		. '<option value="2592000"' . $esel5 . '>30 ' . _DAYS . '</option>'
		. '<option value="0"' . $esel6 . '>' . _UNLIMITED . '</option>'
		. '</select><br /><br />'
		. '<span class="thick">Active?</span> <input type="radio" name="active" value="1"' . $asel1 . ' />' . _YES . ' '
		. '<input type="radio" name="active" value="0"' . $asel2 . ' />' . _NO;
	if ($active == 1) {
		echo '<br /><br /><span class="thick">' . _CHANGEDATE . '</span>'
			. '<input type="radio" name="chng_date" value="1" />' . _YES . ' '
			. '<input type="radio" name="chng_date" value="0" checked="checked" />' . _NO . '<br /><br />';
	} elseif ($active == 0) {
		echo '<br /><span class="tiny">' . _IFYOUACTIVE . '</span><br /><br />'
			. '<input type="hidden" name="chng_date" value="1" />';
	}
	echo '<span class="thick">' . _VIEWPRIV . '</span> <select name="view">'
		. '<option value="1"' . $sel1 . '>' . _MVALL . '</option>'
		. '<option value="2"' . $sel2 . '>' . _MVANON . '</option>'
		. '<option value="3"' . $sel3 . '>' . _MVUSERS . '</option>'
		. '<option value="4"' . $sel4 . '>' . _MVADMIN . '</option>'
		. '<option value="5"' . $sel5 . '>' . _SUBUSERS . '</option>'
		. '<option value="6"' . $sel6 . '>' . _MVGROUPS . '</option>'
		. '</select><br /><br />'
		. '<span class="tiny">' . _WHATGRDESC . '</span><br /><span class="thick">' . _WHATGROUPS . '</span> <select name="groups[]" multiple="multiple" size="5">';
	$ingroups = explode('-', $groups);
	$groupsResult = $db->sql_query('select gid, gname from ' . $prefix . '_nsngr_groups');
	while (list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
		if (in_array($gid, $ingroups) AND $view > 5) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option value="' . $gid . '"' . $sel . '>' . $gname . '</option>';
	}
	echo '</select><br /><br />'
		. '<input type="hidden" name="mdate" value="' . $mdate . '" />'
		. '<input type="hidden" name="mid" value="' . $mid . '" />'
		. '<input type="hidden" name="op" value="savemsg" />'
		. '<input type="submit" value="' . _SAVECHANGES . '" />'
		. '</form>';
	CloseTable();
	include_once('footer.php');
}

function savemsg($mid, $title, $msgcontent, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage) {
	global $admin_file, $prefix, $db;
	if ($view == 6) {
		$ingroups = implode('-', $groups);
	}
	if ($view < 6) {
		$ingroups = '';
	}
	$mid = intval($mid);
	$title = $db->sql_escape_string(html_entity_decode(check_html($title, 'nohtml'),ENT_QUOTES));
	$msgcontent = $db->sql_escape_string(check_html($msgcontent, ''));
	if ($chng_date == 1) {
		$newdate = time();
	} elseif ($chng_date == 0) {
		$newdate = $mdate;
	}
	$result = $db->sql_query('UPDATE ' . $prefix . '_message SET title=\'' . $title . '\', content=\'' . $msgcontent . '\', date=\'' . $newdate . '\', expire=\'' . $expire . '\', active=\'' . $active . '\', view=\'' . $view . '\', groups=\'' . $ingroups . '\', mlanguage=\'' . $mlanguage . '\' WHERE mid=\'' . $mid . '\'');
	Header('Location: ' . $admin_file . '.php?op=messages');
}

function addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage) {
	global $admin_file, $prefix, $db;
	if ($add_view == 6) {
		$ingroups = implode('-', $add_groups);
	}
	if ($add_view < 6) {
		$ingroups = '';
	}
	$title = $db->sql_escape_string(html_entity_decode(check_html($title, 'nohtml'),ENT_QUOTES));
	$msgcontent = $db->sql_escape_string(check_html($msgcontent, ''));
	$result = $db->sql_query('INSERT INTO ' . $prefix . '_message values (NULL, \'' . $add_title . '\', \'' . $add_content . '\', \'' . $add_mdate . '\', \'' . $add_expire . '\', \'' . $add_active . '\', \'' . $add_view . '\', \'' . $ingroups . '\', \'' . $add_mlanguage . '\')');
	if (!$result) {
		exit();
	}
	Header('Location: ' . $admin_file . '.php?op=messages');
}

function deletemsg($mid, $ok = 0) {
	global $prefix, $db, $admin_file;
	if ($ok) {
		$result = $db->sql_query('DELETE FROM ' . $prefix . '_message WHERE mid=\'' . $mid . '\'');
		if (!$result) {
			return;
		}
		Header('Location: ' . $admin_file . '.php?op=messages');
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center thick" style="font-size: large;">' , _MESSAGESADMIN , '</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center">' . _REMOVEMSG;
		echo '<br /><br />[ <a class="rn_csrf" href="' . $admin_file . '.php?op=deletemsg&amp;mid=' . $mid . '&amp;ok=1">' . _YES . '</a> | <a href="' . $admin_file . '.php?op=messages">' . _NO . '</a> ]</div>';
		CloseTable();
		include_once('footer.php');
	}
}
?>