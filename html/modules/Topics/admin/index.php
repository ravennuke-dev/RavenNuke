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

if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}

global $prefix, $db, $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {

/*********************************************************/
/* Topics Manager Functions                              */
/*********************************************************/

	function topicsmanager() {
		global $prefix, $db, $admin_file, $tipath;
		$tlist = '';
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">'._TOPICSMANAGER .'</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center title"><span class="thick">'._CURRENTTOPICS .'</span><br />'._CLICK2EDIT . '</div><br />'
		.'<table border="0" width="100%" align="center" cellpadding="2">';
		$count = 0;
		$result = $db->sql_query('SELECT topicid, topicname, topicimage, topictext from ' . $prefix . '_topics order by topicname');
		while ($row = $db->sql_fetchrow($result)) {
			$topicid = intval($row['topicid']);
			$topicname = check_html($row['topicname'], 'nohtml');
			$topicimage = check_html($row['topicimage'], 'nohtml');
			$topictext = check_html($row['topictext'], 'nohtml');
			if ($count==0) echo '<tr>';
			echo '<td align="center">'
			.'<a href="'.$admin_file.'.php?op=topicedit&amp;topicid='.$topicid.'"><img src="'.$tipath.$topicimage.'" border="0" alt="" /></a><br />';
			if (!empty($topictext)) echo '<span class="content thick">'.$topictext.'</span>';
			echo '</td>';
			$count++;
			if ($count == 5) {
				echo '</tr>';
				$count = 0;
			}
		}
		if ($count > 0) {
			echo '</tr>';
		}
		echo '</table>';
		CloseTable();
		echo '<br /><a name="Add"></a>';
		OpenTable();
		echo '<div class="text-center title thick">'._ADDATOPIC . '</div><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<span class="thick">'._TOPICNAME . ':</span><br /><span class="tiny">'._TOPICNAME1 . '<br />'
		._TOPICNAME2 . '</span><br />'
		.'<input type="text" name="topicname" size="20" maxlength="20" /><br /><br />'
		.'<span class="thick">'._TOPICTEXT . ':</span><br /><span class="tiny">'._TOPICTEXT1 . '<br />'
		._TOPICTEXT2 . '</span><br />'
		.'<input type="text" name="topictext" size="40" maxlength="40" /><br /><br />'
		.'<span class="thick">'._TOPICIMAGE . ':</span><br />'
		.'<select name="topicimage">';
		$handle=opendir($tipath);
		while ($file = readdir($handle)) {
		if ( (preg_match('/^([\p{L}\p{N}\-_]*)(.png|.gif|.jpg)$/', $file)) AND $file != 'AllTopics.gif') {
				$tlist .= $file . ' ';
			}
		}
		closedir($handle);
		$tlist = explode(' ', $tlist);
		sort($tlist);
		for ($i=0; $i < sizeof($tlist); $i++) {
			if(!empty($tlist[$i])) {
				echo '<option value="'.$tlist[$i].'">'.$tlist[$i].'</option>'."\n";
			}
		}
		echo '</select><br /><br />'
		.'<input type="hidden" name="op" value="topicmake" />'
		.'<input type="submit" value="'._ADDTOPIC.'" />'
		.'</form>';
		CloseTable();
		include_once('footer.php');
	}

	function topicedit($topicid) {
		global $prefix, $db, $admin_file, $tipath;
		$tlist = '';
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">'._TOPICSMANAGER . '</div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		$topicid = intval($topicid);
		$row = $db->sql_fetchrow($db->sql_query('SELECT topicid, topicname, topicimage, topictext from '.$prefix . '_topics where topicid=\''.$topicid.'\''));
		$topicid = intval($row['topicid']);
		$topicname = check_html($row['topicname'], 'nohtml');
		$topicimage = check_html($row['topicimage'], 'nohtml');
		$topictext = check_html($row['topictext'], 'nohtml');
		echo '<img src="'.$tipath.$topicimage.'" border="0" align="right" alt="'.$topictext.'" />'
		.'<span class="option thick">'._EDITTOPIC . ': '.$topictext.'</span>'
		.'<br /><br />'
		.'<form action="'.$admin_file.'.php" method="post"><br />'
		.'<span class="thick">'._TOPICNAME . ':</span><br /><span class="tiny">'._TOPICNAME1 . '<br />'
		._TOPICNAME2 . '</span><br />'
		.'<input type="text" name="topicname" size="20" maxlength="20" value="'.$topicname.'" /><br /><br />'
		.'<span class="thick">'._TOPICTEXT . ':</span><br /><span class="tiny">'._TOPICTEXT1 . '<br />'
		._TOPICTEXT2 . '</span><br />'
		.'<input type="text" name="topictext" size="40" maxlength="40" value="'.$topictext.'" /><br /><br />'
		.'<span class="thick">'._TOPICIMAGE . ':</span><br />'
		.'<select name="topicimage">';
		$handle=opendir($tipath);
		while ($file = readdir($handle)) {
			if ( (preg_match('/^([\p{L}\p{N}\-_]*)(.png|.gif|.jpg)$/', $file)) AND $file != 'AllTopics.gif') {
				$tlist .= $file . ' ';
			}
		}
		closedir($handle);
		$tlist = explode(' ', $tlist);
		sort($tlist);
		$sel = '';
		for ($i=0; $i < sizeof($tlist); $i++) {
			if(!empty($tlist[$i])) {
				if ($topicimage == $tlist[$i]) {
					$sel = 'selected="selected"';
				} else {
					$sel = '';
				}
				echo '<option value="'.$tlist[$i].'" '.$sel.'>'.$tlist[$i].'</option>'."\n";
			}
		}
		echo '</select><br /><br />'
		.'<span class="thick">'._ADDRELATED . ':</span><br />'
		._SITENAME . ': <input type="text" name="name" size="30" maxlength="30" /><br />'
		._URL . ': <input type="text" name="url" value="http://" size="50" maxlength="200" /><br /><br />'
		.'<span class="thick">'._ACTIVERELATEDLINKS . ':</span><br />'
		.'<table width="100%" border="0">';
		$res = $db->sql_query('SELECT rid, name, url from '.$prefix . '_related where tid=\''.$topicid.'\'');
		$num = $db->sql_numrows($res);
		if ($num == 0) {
			echo '<tr><td><span class="tiny">'._NORELATED . '</span></td></tr>';
		}
		while($row2 = $db->sql_fetchrow($res)) {
			$rid = intval($row2['rid']);
			$name = check_html($row2['name'], 'nohtml');
			$url = check_html($row2['url'], 'nohtml');
			echo '<tr><td align="left"><span class="content"><strong><span class="larger">&middot;</span></strong>&nbsp;&nbsp;<a href="'.$url.'">'.$name.'</a></span></td>'
			.'<td align="center"><span class="content"><a href="'.$url.'">'.$url.'</a></span></td><td align="right"><span class="content">[ <a href="'.$admin_file.'.php?op=relatededit&amp;tid='.$topicid.'&amp;rid='.$rid.'">'._EDIT . '</a> | <a href="'.$admin_file.'.php?op=relateddelete&amp;tid='.$topicid.'&amp;rid='.$rid.'">'._DELETE . '</a> ]</span></td></tr>';
		}
		echo '</table><br /><br />'
		.'<input type="hidden" name="topicid" value="'.$topicid.'" />'
		.'<input type="hidden" name="op" value="topicchange" />'
		.'<input type="submit" value="'._SAVECHANGES.'" /> <span class="content">[ <a href="'.$admin_file.'.php?op=topicdelete&amp;topicid='.$topicid.'">'._DELETE . '</a> ]</span>'
		.'</form>';
		CloseTable();
		include_once('footer.php');
	}

	function relatededit($tid, $rid) {
		global $prefix, $db, $admin_file, $tipath;
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">'._TOPICSMANAGER . '</div>';
		CloseTable();
		echo '<br />';
		$rid = intval($rid);
		$tid = intval($tid);
		$row = $db->sql_fetchrow($db->sql_query('SELECT name, url from '.$prefix . '_related where rid=\''.$rid.'\''));
		$name = check_html($row['name'], 'nohtml');
		$url = check_html($row['url'], 'nohtml');
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT topictext, topicimage from '.$prefix . '_topics where topicid=\''.$tid.'\''));
		$topicimage = check_html($row2['topicimage'], 'nohtml');
		$topictext = check_html($row2['topictext'], 'nohtml');
		OpenTable();
		echo '<div class="text-center">'
		.'<img src="'.$tipath.$topicimage.'" border="0" alt="'.$topictext.'" align="right" />'
		.'<span class="option thick">'._EDITRELATED . '</span><br />'
		.'<span class="thick">'._TOPIC . ':</span> '.$topictext.'</div>'
		.'<form action="'.$admin_file.'.php" method="post">'
		._SITENAME . ': <input type="text" name="name" value="'.$name.'" size="30" maxlength="30" /><br /><br />'
		._URL . ': <input type="text" name="url" value="'.$url.'" size="60" maxlength="200" /><br /><br />'
		.'<input type="hidden" name="op" value="relatedsave" />'
		.'<input type="hidden" name="tid" value="'.$tid.'" />'
		.'<input type="hidden" name="rid" value="'.$rid.'" />'
		.'<input type="submit" value="'._SAVECHANGES.'" /> '._GOBACK
		.'</form>';
		CloseTable();
		include_once('footer.php');
	}

	function relatedsave($tid, $rid, $name, $url) {
		global $prefix, $db, $admin_file;
		$rid = intval($rid);
		$name = check_words(check_html(addslashes($name), 'nohtml'));
		$url = check_words(check_html(addslashes($url), 'nohtml'));
		$db->sql_query('update '.$prefix . '_related set name=\''.$name.'\', url=\''.$url.'\' where rid=\''.$rid.'\'');
		Header('Location: '.$admin_file.'.php?op=topicedit&topicid='.$tid);
	}

	function relateddelete($tid, $rid) {
		global $prefix, $db, $admin_file;
		$rid = intval($rid);
		$db->sql_query('delete from '.$prefix . '_related where rid=\''.$rid.'\'');
		Header('Location: '.$admin_file.'.php?op=topicedit&topicid=\''.$tid.'\'');
	}

	function topicmake($topicname, $topicimage, $topictext) {
		global $prefix, $db, $admin_file;
		$topicname = check_words(check_html(addslashes($topicname), 'nohtml'));
		$topicimage = check_words(check_html(addslashes($topicimage), 'nohtml'));
		$topictext = check_words(check_html(addslashes($topictext), 'nohtml'));
		$db->sql_query('INSERT INTO '.$prefix . "_topics VALUES (NULL,'$topicname','$topicimage','$topictext','0')");
		Header('Location: '.$admin_file.'.php?op=topicsmanager');
	}

	function topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url) {
		global $prefix, $db, $admin_file;
		$topicname = check_words(check_html(addslashes($topicname), 'nohtml'));
		$topicimage = check_words(check_html(addslashes($topicimage), 'nohtml'));
		$topictext = check_words(check_html(addslashes($topictext), 'nohtml'));
		$name = check_words(check_html(addslashes($name), 'nohtml'));
		$url = check_words(check_html(addslashes($url), 'nohtml'));
		$topicid = intval($topicid);
		$db->sql_query('update '.$prefix . "_topics set topicname='$topicname', topicimage='$topicimage', topictext='$topictext' where topicid='$topicid'");
		if (!$name) {
		} else {
			$db->sql_query('insert into '.$prefix . "_related VALUES (NULL, '$topicid','$name','$url')");
		}
		Header('Location: '.$admin_file.'.php?op=topicedit&topicid='.$topicid);
	}

	function topicdelete($topicid, $ok=0) {
		global $prefix, $db, $admin_file, $tipath;
		$topicid = intval($topicid);
		if ($ok==1) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT sid from ' . $prefix . '_stories where topic=\''.$topicid.'\''));
			$sid = intval($row['sid']);
			$db->sql_query('delete from ' . $prefix . '_stories where topic=\''.$topicid.'\'');
			$db->sql_query('delete from ' . $prefix . '_topics where topicid=\''.$topicid.'\'');
			$db->sql_query('delete from ' . $prefix . '_related where tid=\''.$topicid.'\'');
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT sid from ' . $prefix . '_comments where sid=\''.$sid.'\''));
			$sid = intval($row2['sid']);
			$db->sql_query('delete from ' . $prefix . '_comments where sid=\''.$sid.'\'');
			Header('Location: '.$admin_file.'.php?op=topicsmanager');
		} else {
			global $topicimage;
			include_once('header.php');
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center title thick">' . _TOPICSMANAGER . '</div>';
			CloseTable();
			echo '<br />';
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT topicimage, topictext from ' . $prefix . '_topics where topicid=\''.$topicid.'\''));
			$topicimage = check_html($row3['topicimage'], 'nohtml');
			$topictext = check_html($row3['topictext'], 'nohtml');
			OpenTable();
			echo '<div class="text-center"><img src="'.$tipath.$topicimage.'" border="0" alt="'.$topictext.'" /><br /><br />';
			echo '<span class="thick">' . _DELETETOPIC . ' '.$topictext.'</span><br /><br />'._TOPICDELSURE.' <span class="italic">'.$topictext.'</span>?<br />';
			echo _TOPICDELSURE1.'<br /><br />[ <a href="'.$admin_file.'.php?op=topicsmanager">' . _NO . '</a> | ';
                        echo '<a href="'.$admin_file.'.php?op=topicdelete&amp;topicid='.$topicid.'&amp;ok=1">' . _YES . '</a> ]</div><br /><br />';
			CloseTable();
			include_once('footer.php');
		}
	}
	switch ($op) {

		case 'topicsmanager':
		topicsmanager();
		break;

		case 'topicedit':
		topicedit($topicid);
		break;

		case 'topicmake':
		topicmake($topicname, $topicimage, $topictext);
		break;

		case 'topicdelete':
		if (!isset($ok)) $ok=0;
		topicdelete($topicid, $ok);
		break;

		case 'topicchange':
		topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url);
		break;

		case 'relatedsave':
		relatedsave($tid, $rid, $name, $url);
		break;

		case 'relatededit':
		relatededit($tid, $rid);
		break;

		case 'relateddelete':
		relateddelete($tid, $rid);
		break;

	}

} else {
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">'._ERROR.'</span><br /><br />'._NOADMINRIGHTS.' '.$module_name.'</div>';
	CloseTable();
	include_once('footer.php');
}

?>