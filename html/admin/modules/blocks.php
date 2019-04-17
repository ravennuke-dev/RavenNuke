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
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
# Converted to single quotes and edited for W3C compliance, November 2007
# fkelly
# added max_rss_items capability ... May 2008 fkelly
#########################################################################

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
if (is_mod_admin('admin')) {
	if (!empty($_POST)) {
		$title = !empty($_POST['title']) ? check_html($_POST['title']) : '';
		$content = !empty($_POST['content']) ? check_html($_POST['content'], 'nocheck') : '';
		$url = !empty($_POST['url']) ? check_html($_POST['url']) : '';
		$active = !empty($_POST['active']) ? intval($_POST['active']) : 0;
		$refresh = !empty($_POST['refresh']) ? intval($_POST['refresh']) : '';
		$headline = !empty($_POST['headline']) ? check_html($_POST['headline']) : '';
		$blanguage = !empty($_POST['blanguage']) ? check_html($_POST['blanguage'], 'nohtml') : '';
		$blockfile = !empty($_POST['blockfile']) ? check_html($_POST['blockfile'], 'nohtml') : '';
		$view = !empty($_POST['view']) ? intval($_POST['view']) : 0;
		$groups = !empty($_POST['groups']) ? check_html($_POST['groups'],'nohtml') : '';
		$expire = !empty($_POST['expire']) ? intval($_POST['expire']) : '0';
		if (!empty($_POST['action'])) {
			if($_POST['action'] == 'r') {
				$action = 'r';
			}
			else {
				$action = 'd';
			}
		}
		$subscription = !empty($_POST['subscription']) ? intval($_POST['subscription']) : '0';
		$maxrss = !empty($_POST['maxrss']) ? intval($_POST['maxrss']) : '0';
		$ok =  !empty($_POST['ok']) ? 'ok' : '';
		$op = !empty($_POST['op']) ? check_html($_POST['op'], 'nohtml') : '';
		$bid = !empty($_POST['bid']) ? intval($_POST['bid']) : '0';
		$bkey = !empty($_POST['bkey']) ? check_html($_POST['bkey'], 'nohtml') : '';
		if (!empty($_POST['bposition'])) { // just using $p to save typing
			$p = ($_POST['bposition']);
			if ($p == 'l' OR $p == 'c' OR $p == 'r' OR $p == 'd' OR $p == 't') {
				$bposition = $p;
			}
			else {
				$bposition = '';
			}
			unset($p);
		}
		else {
			$bposition = '';
		}
		if (!empty($_POST['oldposition'])) { // just using $p to save typing
			$p = ($_POST['oldposition']);
			if ($p == 'l' OR $p == 'c' OR $p == 'r' OR $p == 'd' OR $p == 't') {
				$oldposition = $p;
			}
			else {
				$oldposition = '';
			}
			unset($p);
		}
		else {
			$oldpositon = '';
		}
		$hid = !empty($_POST['hid']) ? intval($_POST['hid']) : '';
		$xsitename = !empty($_POST['xsitename']) ? check_html($_POST['xsitename']) : '';
		$headlinesurl = !empty($_POST['headlinesurl']) ? check_html($_POST['headlinesurl']) : '';
		$bidl = !empty($_POST['bidl']) ? $_POST['bidl'] : '';
		$bidc = !empty($_POST['bidc']) ? $_POST['bidc'] : '';
		$bidd = !empty($_POST['bidd']) ? $_POST['bidd'] : '';
		$bidr = !empty($_POST['bidr']) ? $_POST['bidr'] : '';
		$bidt = !empty($_POST['bidt']) ? $_POST['bidt'] : '';
	}
	if (!empty($_GET)) {
		$op = !empty($_GET['op']) ? $_GET['op'] : '';
		$ok = !empty($_GET['ok']) ? $_GET['ok'] : '';
		$bid = !empty($_GET['bid']) ? intval($_GET['bid']) : '';
		}
	switch($op) {
		case 'BlocksAdmin':
		BlocksAdmin();
		break;

		case 'BlocksAdd':
		if (!isset($groups)) $groups = '';
			BlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $maxrss);
		break;

		case 'BlocksEdit':
		BlocksEdit($bid);
		break;

		case 'BlocksEditSave':
		csrf_check();
		BlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $maxrss);
		break;

		case 'ChangeStatus':
		csrf_check();
		ChangeStatus($bid, $ok);  //$de parameter removed by fkelly 11/9/2006
		break;

		case 'BlocksDelete':
		csrf_check();
		BlocksDelete($bid, $ok);
		break;

		case 'HeadlinesDel':
		csrf_check();
		HeadlinesDel($hid, $ok);
		break;

		case 'HeadlinesAdd':
		csrf_check();
		HeadlinesAdd($xsitename, $headlinesurl);
		break;

		case 'HeadlinesSave':
		csrf_check();
		HeadlinesSave($hid, $xsitename, $headlinesurl);
		break;

		case 'HeadlinesAdmin':
		HeadlinesAdmin();
		break;

		case 'HeadlinesEdit':
		HeadlinesEdit($hid);
		break;

		case 'fixweight':
		csrf_check();
		fixweight($bidl, $bidc, $bidd, $bidr, $bidt);
		break;

		case 'block_show':
		block_show($bid);
		break;

	}

} else {
	echo 'Access Denied';
}

function BlocksAdmin() {
global $bgcolor2, $bgcolor4, $prefix, $db, $currentlang, $multilingual, $admin_file, $ordmsg;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._BLOCKSADMIN.'</p>';
	CloseTable();
	OpenTable();
	echo '<br /><table border="0" width="100%"><tr><td><form name="blocks" action="' . $admin_file . '.php" method="post"><table border="1"><tr>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._TITLE.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._POSITION.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._WEIGHT.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._NEWWEIGHT.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._TYPE.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._STATUS.'</span></td>'
		.'<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._VIEW.'</span></td>';
	if ($multilingual == 1) {
		echo '<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._LANGUAGE.'</span></td>';
	}
	echo '<td align="center" bgcolor="'.$bgcolor2.'"><span class="thick">'._FUNCTIONS.'</span></td></tr>';
	$result = $db->sql_query('select bid, bkey, title, url, bposition, weight, active, blanguage, blockfile, view from '.$prefix.'_blocks order by bposition, weight');
	$i = 0;
	$oldbps = '';
	while ($row = $db->sql_fetchrow($result)) {
		$bid[$i] = intval($row['bid']);
		$bkey = $row['bkey'];
		$title = $row['title'];
		$url = $row['url'];
		$bposition = $row['bposition'];
		if (!empty($oldbps)) {
			if ($bposition > $oldbps) {
				echo '<tr><td bgcolor="'.$bgcolor2.'" colspan="9"></td></tr>';

			}
		}
		$oldbps = $bposition;
		$order[$i] = $row['weight'];
		$active = $row['active'];
		$blanguage = $row['blanguage'];
		$blockfile = $row['blockfile'];
		$view = $row['view'];
		if ($bposition == 'l') {
			$bposition=_LEFT;
			$bidarray='bidl[]';
			$dorder = 'new_orderl[]';
			$old_order = 'old_orderl[]';
		}
		 elseif ($bposition == 'r') {
				$bposition = _RIGHT;
				$bidarray='bidr[]';
				$dorder = 'new_orderr[]';
				$old_order = 'old_orderr[]';
		 }
		 elseif ($bposition == 'c') {
				$bposition = _CENTERUP;
				$bidarray='bidc[]';
				$dorder = 'new_orderc[]';
				$old_order = 'old_orderc[]';
		}
		 elseif ($bposition == 'd') {
				$bposition =_CENTERDOWN;
				$bidarray='bidd[]';
				$dorder = 'new_orderd[]';
				$old_order = 'old_orderd[]';
		 }
		 elseif ($bposition == 't') {
				$bposition =_CENTERTOP;
				$bidarray='bidt[]';
				$dorder = 'new_ordert[]';
				$old_order = 'old_ordert[]';
		}
		echo '<tr><td style="border:0px"><input type="hidden" name = "'.$bidarray.'" value="'.$bid[$i].'" /><input type="hidden" name = "'.$old_order.'" value="'.$order[$i].'" /></td></tr>';
echo '<tr><td align="center">'.$title.'</td>';
		echo '<td align="center">'.$bposition.'</td>'
				.'<td align="center">'
				.'&nbsp;'.$order[$i].'&nbsp;</td>';
				echo '<td align="center"><input type="text" name="'.$dorder.'" maxlength="3" size="5" value="'.$order[$i].'" /></td>';
		if (empty($bkey)) {
				if (empty($url)) {
					 $type = 'HTML';
				} elseif (!empty($url)) {
					 $type = 'RSS/RDF';
				}
				if (!empty($blockfile)) {
					 $type = _BLOCKFILE2;
				}
		} elseif (!empty($bkey)) {
				$type = _BLOCKSYSTEM;
		}
		echo '<td align="center">'.$type.'</td>';
		$block_act = $active;
		if ($active == 1) {
				$active = _ACTIVE;
				$change = _DEACTIVATE;
		} elseif ($active == 0) {
				$active = '<span class="italic">'._INACTIVE.'</span>';
				$change = _ACTIVATE;
		}
		echo '<td align="center">'.$active.'</td>';
		if ($view == 0) {
				$who_view = _MVALL;
		} elseif ($view == 1) {
				$who_view = _MVUSERS;
		} elseif ($view == 2) {
				$who_view = _MVADMIN;
		} elseif ($view == 3) {
				$who_view = _MVANON;
		} elseif ($view > 3) {
				$who_view = _MVGROUPS;
		}
		echo '<td align="center">'.$who_view.'</td>';
		if ($multilingual == 1) {
				if (empty($blanguage)) {
					 $blanguage = _ALL;
				} else {
					 $blanguage = ucfirst($blanguage);
				}
				echo '<td align="center">'.$blanguage.'</td>';
		}
		echo '<td align="center">[ <a href="'.$admin_file.'.php?op=BlocksEdit&amp;bid='.$bid[$i].'">'._EDIT.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=ChangeStatus&amp;bid='.$bid[$i].'">'.$change.'</a> | ';
		if ($bkey == "") {
				echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=BlocksDelete&amp;bid='.$bid[$i].'">'._DELETE.'</a> | ';
		} elseif (!empty($bkey)) {
				echo ""._DELETE." | ";
		}
		if ($block_act == 0) {
			echo '<a href="'.$admin_file.'.php?op=block_show&amp;bid='.$bid[$i].'">'._SHOW.'</a> ]</td></tr>';
		} else {
				echo _SHOW.' ]</td></tr>';
		}
		$i++;
	}
		echo '<tr><td style="border:0px"><input type="hidden" name="op" value="fixweight" /></td></tr>';
		echo '<tr><td><input type="submit" name="reorder" value="'._FIXBLOCKS.'" class="title" /></td></tr>';
		echo '</table>';
		echo '</form>';
		echo '</td></tr></table>';

	CloseTable();
	OpenTable();
	echo '<p style="text-align: center;" class="option thick">'._ADDNEWBLOCK.'</p><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<table border="0" width="100%">'
		.'<tr><td>'._TITLE.':</td><td><input type="text" name="title" size="30" maxlength="60" /></td></tr>'
		.'<tr><td>'._RSSFILE.':</td><td><input type="text" name="url" size="50" maxlength="200" />'
		.'<select name="headline">'
		.'<option value="0" selected="selected">&nbsp;'._CUSTOM.'</option>';
	$res3 = $db->sql_query('select hid, sitename from '.$prefix.'_headlines');
	while ($row_res3 = $db->sql_fetchrow($res3)) {
		$hid =$row_res3['hid'];
		$htitle = $row_res3['sitename'];
		echo '<option value="'.$hid.'">'.$htitle.'</option>';
	}
	echo '</select>&nbsp;[ <a href="'.$admin_file.'.php?op=HeadlinesAdmin">Setup</a> ]<br />';
	echo _SETUPHEADLINES.'</td></tr>'
		.'<tr><td>'._FILENAME.':</td><td>'
		.'<select name="blockfile">'
		.'<option value="" selected="selected">'._NONE.'</option>';
	$blocksdir = dir('blocks');
	$blockslist = '';
	while($func=$blocksdir->read()) {
		if(substr($func, 0, 6) == 'block-') {
				$blockslist .= $func . ' ';
		}
	}
	closedir($blocksdir->handle);
	$blockslist = explode(' ', $blockslist);
	sort($blockslist);
	for ($i=0; $i < sizeof($blockslist); $i++) {
		if(!empty($blockslist[$i])) {
				$bl = str_ireplace('block-', '', $blockslist[$i]);
				$bl = str_ireplace('.php', '', $bl);
				$bl = str_replace('_', ' ', $bl);
				$result2 = $db->sql_query('select * from '.$prefix.'_blocks where blockfile=\'' . $blockslist[$i] . '\'');
				$numrows = $db->sql_numrows($result2);
				if ($numrows == 0) {
					 echo '<option value="' . $blockslist[$i] . '">' . $bl . '</option>'."\n";
				}
		}
	}
	echo '</select>&nbsp;&nbsp;'._FILEINCLUDE.'</td></tr>'
		.'<tr><td>'._CONTENT.':</td><td>';
	wysiwyg_textarea('content', '', 'PHPNukeAdmin', '50', '10');
	echo '<br />'._IFRSSWARNING.'</td></tr>'
		.'<tr><td>'._POSITION.':</td><td><select name="bposition"><option value="l">'._LEFT.'</option>'
		.'<option value="c">'._CENTERUP.'</option>'
		.'<option value="d">'._CENTERDOWN.'</option>'
		.'<option value="r">'._RIGHT.'</option>'
		.'<option value="t">'._CENTERTOP.'</option>'
		.'</select></td></tr>';
	if ($multilingual == 1) {
		echo '<tr><td>' , _LANGUAGE , ':</td><td>'
			, lang_select_list('blanguage') , '</td></tr>';
		} else {
			echo '<tr><td><input type="hidden" name="blanguage" value="" /></td></tr>';
		}
	echo '<tr><td>'._ACTIVATE2.'</td><td><input type="radio" name="active" value="1" checked="checked" />'._YES.' &nbsp;&nbsp;'
		.'<input type="radio" name="active" value="0" />'._NO.'</td></tr>'
		.'<tr><td>'._EXPIRATION.':</td><td><input type="text" name="expire" size="4" maxlength="3" value="0" /> '._DAYS.'</td></tr>'
		.'<tr><td>'._AFTEREXPIRATION.':</td><td><select name="action">'
		.'<option value="d">'._DEACTIVATE.'</option>'
		.'<option value="r">'._DELETE.'</option></select></td></tr>'
		.'<tr><td>'._REFRESHTIME.':</td><td><select name="refresh">'
		.'<option value="1800">1/2 '._HOUR.'</option>'
		.'<option value="3600" selected="selected">1 '._HOUR.'</option>'
		.'<option value="18000">5 '._HOURS.'</option>'
		.'<option value="36000">10 '._HOURS.'</option>'
		.'<option value="86400">24 '._HOURS.'</option></select>&nbsp;&nbsp;'._MAXRSS.'&nbsp;<input type="text" name="maxrss" size="4" maxlength="3" value="0" />&nbsp;&nbsp;'._ONLYHEADLINES.'</td></tr>'
		.'<tr><td>'._VIEWPRIV.'</td><td><select name="view">'
		.'<option value="0" >'._MVALL.'</option>'
		.'<option value="1" >'._MVUSERS.'</option>'
		.'<option value="2" >'._MVADMIN.'</option>'
		.'<option value="3" >'._MVANON.'</option>'
		.'<option value="4" >'._MVGROUPS.'</option>'
		.'</select></td></tr><tr><td>'
		.'<span class="thick">'._WHATGROUPS.'</span></td><td>'._WHATGRDESC.'<br /><select name="groups[]" multiple="multiple" size="5">'."\n";
	$groupsResult = $db->sql_query('select gid, gname from '.$prefix.'_nsngr_groups');
	while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) { echo '<option value="'.$gid.'">'.$gname.'</option>'."\n"; }
	echo '</select></td></tr><tr><td>'."\n"
		._SUBVISIBLE.'</td><td><input type="radio" name="subscription" value="0" checked="checked" />'._YES.' &nbsp;&nbsp;<input type="radio" name="subscription" value="1" />'._NO
		.'</td></tr></table><br /><br />'
		.'<input type="hidden" name="op" value="BlocksAdd" />'
		.'<input type="submit" value="'._CREATEBLOCK.'" /></form>';
	CloseTable();
	include_once('footer.php');
}

function block_show($bid) {
	if(!defined('BLOCK_FILE')) {define('BLOCK_FILE', true);}
	global $prefix, $db, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	title(_BLOCKSADMIN);
	OpenTable2();
	$bid = intval($bid);
	$row = $db->sql_fetchrow($db->sql_query('select bid, bkey, title, content, url, bposition, blockfile, max_rss_items from '.$prefix.'_blocks where bid=\''.$bid.'\''));
	$bid = $row['bid'];
	$bkey = $row['bkey'];
	$title = $row['title'];
	$content = $row['content'];
	$url = $row['url'];
	$bposition = $row['bposition'];
	$blockfile = $row['blockfile'];
	$maxrss = $row['max_rss_items'];
	if ($bkey == 'admin') {
		adminblock();
	} elseif ($bkey == 'category') {
		category();
	} elseif ($bkey == 'userbox') {
		userblock();
	} elseif (empty($bkey)) {
		if (empty($url)) {
				if (empty($blockfile)) {
					if ($bposition == 'c') {
						themecenterbox($title, $content);
					} else {
						themesidebox($title, $content);
					}
				} else {
					if ($bposition == 'c') {
						blockfileinc($title, $blockfile, $bposition);
					} else {
						blockfileinc($title, $blockfile, $bposition);
					}
				}
		} else {
				headlines($bid);
		}
	}
	CloseTable2();
	echo '<br />';
	OpenTable();
	echo '<p style="text-align: center;" class="option"><span class="thick">'._BLOCKSADMIN.': '._FUNCTIONS.'</span><br />'
		.'[ <a class="rn_csrf" href="'.$admin_file.'.php?op=ChangeStatus&amp;bid='.$bid.'">'._ACTIVATE.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=BlocksEdit&amp;bid='.$bid.'">'._EDIT.'</a> | ';
	if (empty($bkey)) {
		echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=BlocksDelete&amp;bid='.$bid.'">'._DELETE.'</a> | ';
	} else {
		echo _DELETE.' | ';
	}
	echo '<a href="'.$admin_file.'.php?op=BlocksAdmin">'._BLOCKSADMIN.'</a> ]</p>';
	CloseTable();
	include_once('footer.php');
}

function fixweight($bidl, $bidc, $bidd, $bidr, $bidt) {
	global $prefix, $db, $admin_file;
	include_once('header.php');
	$ordmsg = '';
	$ordmsg2 = '';
	// validate the orders
	if (isset($_POST['new_orderl'])) {
		$orderl = $_POST['new_orderl'];
		$old_orderl = $_POST['old_orderl'];
		$dups = array_unique($orderl);
		if (count($orderl) > count($dups)) {
			$ordmsg2 = _ORDMSG2 .' -- ' ._ORDMSGSIDEL;
		}
		foreach($orderl as $value) {
			if ($value < 1 || $value > 999) {
				$ordmsg = _ORDMSG .' -- ' ._ORDMSGSIDEL;
			}
		}
	}
	else {
		$orderl = '';
	}
	if (isset($_POST['new_orderc'])) {
		$orderc = $_POST['new_orderc'];
		$old_orderc = $_POST['old_orderc'];
		$dups = array_unique($orderc);
		if (count($orderc) > count($dups)) {
			$ordmsg2 = $ordmsg2 = _ORDMSG2 .' -- ' ._ORDMSGSIDEC;
		}
		foreach($orderc as $value) {
			if ($value < 1 || $value > 999) {
				$ordmsg = _ORDMSG .' -- ' ._ORDMSGSIDEC;
			}
		}
	}
	else {
		$orderc = '';
	}
	if (isset($_POST['new_orderd'])) {
		$orderd = $_POST['new_orderd'];
		$old_orderd = $_POST['old_orderd'];
		$dups = array_unique($orderd);
		if (count($orderd) > count($dups)) {
			$ordmsg2 = $ordmsg2 = _ORDMSG2 .' -- ' ._ORDMSGSIDED;
		}
		foreach($orderd as $value) {
			if ($value < 1 || $value > 999) {
				$ordmsg = _ORDMSG .' -- ' ._ORDMSGSIDED;
			}
		}
	}
	else {
		$orderd = '';
	}
	if (isset($_POST['new_orderr'])) {
		$orderr = $_POST['new_orderr'];
		$old_orderr = $_POST['old_orderr'];
		$dups = array_unique($orderr);
		if (count($orderr) > count($dups)) {
			$ordmsg2 = $ordmsg2 = _ORDMSG2 .' -- ' ._ORDMSGSIDER;
		}
		foreach($orderr as $value) {
			if ($value < 1 || $value > 999) {
				$ordmsg = _ORDMSG .' -- ' ._ORDMSGSIDER;
			}
		}
	}
	else {
		$orderr = '';
	}
	if (isset($_POST['new_ordert'])) {
		$ordert = $_POST['new_ordert'];
		$old_ordert = $_POST['old_ordert'];
		$dups = array_unique($ordert);
		if (count($ordert) > count($dups)) {
			$ordmsg2 = $ordmsg2 = _ORDMSG2 .' -- ' ._ORDMSGSIDET;
		}
		foreach($ordert as $value) {
			if ($value < 1 || $value > 999) {
				$ordmsg = _ORDMSG .' -- ' ._ORDMSGSIDET;
			}
		}
	}
	else {
		$ordert = '';
	}

	if (empty($ordmsg) AND empty($ordmsg2)) {
		$ordmsg = _UPDATEGOOD;
		if (!empty($bidl)) {
			asort($bidl, $sort_numeric=true);
			foreach($bidl as $key => $value) {
			if ($old_orderl[$key] != $orderl[$key]) {
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$orderl[$key].'\' where bid=\''.$value.'\'');
			}
		}
	}
	if (!empty($bidc)) {
		foreach($bidc as $key => $value) {
			if ($old_orderc[$key] != $orderc[$key]) {
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$orderc[$key].'\' where bid=\''.$value.'\'');
			}
		}
	}
	if (!empty($bidd)) {
		foreach($bidd as $key => $value) {
			if ($old_orderd[$key] != $orderd[$key]) {
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$orderd[$key].'\' where bid=\''.$value.'\'');
			}
		}
	}
	if (!empty($bidr)) {
		foreach($bidr as $key => $value) {
			if ($old_orderr[$key] != $orderr[$key]) {
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$orderr[$key].'\' where bid=\''.$value.'\'');
			}
		}
		}
	if (!empty($bidt)) {
		foreach($bidt as $key => $value) {
			if ($old_ordert[$key] != $ordert[$key]) {
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$ordert[$key].'\' where bid=\''.$value.'\'');
			}
		}
		}
	}
//	 Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._BLOCKSADMIN.'</p>';
	CloseTable();
	OpenTable();
	echo '<table><tr><td><form name="blocksorder" action="' . $admin_file . '.php" method="post">';
	echo '<table>';
	echo '<tr><td><input type="hidden" name="op" value="BlocksAdmin" /></td></tr>';
	echo '<tr><td>'.$ordmsg.'</td></tr>';
	echo '<tr><td>'.$ordmsg2.'</td></tr>';
	echo '<tr><td><input type="submit" value="'._BLOCKSADMIN.'" /></td></tr></table></form></td></tr></table>';
	CloseTable();
	include_once('footer.php');
}

function rssfail() {
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._BLOCKSADMIN.'</p>';
	CloseTable();
	OpenTable();
	echo '<p style="text-align: center"><span class="thick">'._RSSFAIL.'</span><br />'
		._RSSTRYAGAIN.'<br /><br />'
		._GOBACK.'</p>';
	CloseTable();
	include_once('footer.php');
	die;
}

function BlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $maxrss) {
	global $prefix, $db, $admin_file;
	if($view == 4) { $ingroups = implode('-',$groups); }
	if($view < 4) { $ingroups = ""; }
	if ($headline != 0) {
		$row = $db->sql_fetchrow($db->sql_query('select sitename, headlinesurl from '.$prefix.'_headlines where hid=\''.$headline.'\''));
		$title = $row['sitename'];
		$url = $row['headlinesurl'];
	}
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT weight FROM '.$prefix.'_blocks WHERE bposition=\''.$bposition.'\' ORDER BY weight DESC'));
	$weight = intval($row2['weight']);
	$weight++;
	$title = check_html($title, 'nohtml');
	$content = check_html($content, 'nocheck');
	$bkey = '';
	$btime = '';
	if (!empty($blockfile)) {
		$url = '';
		if (empty($title)) {
				$title = str_ireplace('block-', '', $blockfile);
				$title = str_ireplace('.php', '', $title);
				$title = str_replace('_', ' ', $title);
		}
	}
	if (!empty($url)) {
		$content = '';
		$btime = time();
		if (!stristr($url, 'http://')) {
				$url = 'http://' . $url;
		}
		$rdf = parse_url($url);
		$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
		if (!$fp) {
			rssfail();
			exit;
		}
		if ($fp) {
			$string = '';
			$pagetext = '';
			fclose($fp);
		}
	}
		if ($expire == '') {
			$expire = 0;
		}
		if ($expire != 0) {
			$expire = time() + ($expire * 86400);
		}
		$title = $db->sql_escape_string($title);
		$bkey = $db->sql_escape_string($bkey);
		$content = $db->sql_escape_string($content);
		$url = $db->sql_escape_string($url);
		$blanguage = $db->sql_escape_string($blanguage);
		$blockfile = $db->sql_escape_string($blockfile);
		$bposition = $db->sql_escape_string($bposition);
		$action = $db->sql_escape_string($action);
		$ingroups = $db->sql_escape_string($ingroups);
		$db->sql_query('INSERT INTO '.$prefix.'_blocks VALUES (NULL, \''.$bkey.'\', \''.$title.'\', \''.$content.'\', \''.$url.'\',
		 \''.$bposition.'\', \''.$weight.'\', \''.$active.'\', \''.$refresh.'\', \''.$btime.'\', \''.$blanguage.'\', \''.$blockfile.'\', \''.$view.'\', \''.$ingroups.'\', \''.$expire.'\', \''.$action.'\', \''.$subscription.'\', \''.$maxrss.'\')');
		Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
#   }
}

function BlocksEdit($bid) {
	global $bgcolor2, $bgcolor4, $prefix, $db, $multilingual, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._EDITBLOCK.'</p>';
	CloseTable();
	$bid = intval($bid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\''));
	$groups = $row['groups'];
	$bkey = $row['bkey'];
	$title = $row['title'];
	$content = $row['content'];
	$url = $row['url'];
	$bposition = $row['bposition'];
	$weight = $row['weight'];
	$active = $row['active'];
	$refresh = $row['refresh'];
	$blanguage = $row['blanguage'];
	$blockfile = $row['blockfile'];
	$view = $row['view'];
	$expire = $row['expire'];
	$action = $row['action'];
	$subscription = $row['subscription'];
	$maxrss = $row['max_rss_items'];
	$type = '';
	if ($url != "") {
		$type = _RSSCONTENT;
	} elseif ($blockfile != "") {
		$type = _BLOCKFILE;
	}
	OpenTable();
	echo '<p style="text-align: center;" class="option thick">'._BLOCK.': '.$title.' '.$type.'</p><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<table border="0" width="100%">'
		.'<tr><td>'._TITLE.':</td><td><input type="text" name="title" size="30" maxlength="60" value="'.$title.'" /></td></tr>';
	if (!empty($blockfile)) {
		echo '<tr><td>'._FILENAME.':</td><td>'
		.'<select name="blockfile">';
		$blocksdir = dir('blocks');
		$blockslist = '';
		while($func=$blocksdir->read()) {
			if(substr($func, 0, 6) == 'block-') {
				$blockslist .= $func . ' ';
			}
		}
		closedir($blocksdir->handle);
		$blockslist = explode(' ', $blockslist);
		sort($blockslist);
		for ($i=0; $i < sizeof($blockslist); $i++) {
			if($blockslist[$i]!="") {
				$bl = str_ireplace('block-', '', $blockslist[$i]);
				$bl = str_ireplace('.php', '', $bl);
				$bl = str_replace('_', ' ', $bl);
				echo '<option value="' . $blockslist[$i] . '"';
				if ($blockfile == $blockslist[$i]) { echo ' selected="selected"'; }
				echo '>' . $bl . '</option>' . "\n";
			}
		}
		echo '</select>&nbsp;&nbsp;'._FILEINCLUDE.'</td></tr>';
	} else {
		if ($url != "") {
			echo '<tr><td>'._RSSFILE.':</td><td><input type="text" name="url" size="70" maxlength="200" value="'.htmlentities($url).'" />&nbsp; '._ONLYHEADLINES.'</td></tr>';
		} else {
			echo '<tr><td>'._CONTENT.':</td><td>';
				wysiwyg_textarea('content', $content, 'PHPNukeAdmin', '50', '10');
				echo '</td></tr>';
		}
	}
	$oldposition = $bposition;
	$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = '';
	if ($bposition == 'l') {
		$sel1 = 'selected="selected"';
	} elseif ($bposition == 'c') {
		$sel2 = 'selected="selected"';
	} elseif ($bposition == 'r') {
		$sel3 = 'selected="selected"';
	} elseif ($bposition == 'd') {
		$sel4 = 'selected="selected"';
	} elseif ($bposition == 't') {
		$sel5 = 'selected="selected"';
	}
	echo '<tr><td><input type="hidden" name="oldposition" value="'.$oldposition.'" />'._POSITION.':</td><td><select name="bposition">'
		.'<option value="l" '.$sel1.'>'._LEFT.'</option>'
		.'<option value="c" '.$sel2.'>'._CENTERUP.'</option>'
		.'<option value="d" '.$sel4.'>'._CENTERDOWN.'</option>'
		.'<option value="r" '.$sel3.'>'._RIGHT.'</option>'
		.'<option value="t" '.$sel5.'>'._CENTERTOP.'</option>
		</select></td></tr>';
	if ($multilingual == 1) {
		echo '<tr><td>' , _LANGUAGE , ':</td><td>'
			, lang_select_list('blanguage', $blanguage)
			, '</td></tr>';
	} else {
		echo '<input type="hidden" name="blanguage" value="" />';
	}
	if ($active == 1) {
		$sel1 = 'checked="checked"';
		$sel2 = "";
	} elseif ($active == 0) {
		$sel1 = "";
		$sel2 = 'checked="checked"';
	}
	if ($expire != 0) {
		$oldexpire = $expire;
		$expire = intval(($expire - time()) / 3600);
		$exp_day = $expire / 24;
		$expire = '<input type="hidden" name="expire" value="'.$oldexpire.'" /><span class="thick">'.$expire.' '._HOURS.' ('.substr($exp_day,0,5).' '._DAYS.')</span>';
	} else {
		$expire = '<input type="text" name="expire" value="0" size="4" maxlength="3" /> '._DAYS;
	}
	$selact1 = '';
	$selact2 = '';
	if ($action == 'd') {
		$selact1 = 'selected="selected"';
		$selact2 = '';
	} elseif ($action == 'r') {
		$selact1 = '';
		$selact2 = 'selected="selected"';
	}
	echo '<tr><td>'._ACTIVATE2.'</td><td><input type="radio" name="active" value="1" '.$sel1.' />'._YES.' &nbsp;&nbsp;'
		.'<input type="radio" name="active" value="0" '.$sel2.' />'._NO.'</td></tr>'
		.'<tr><td>'._EXPIRATION.':</td><td>'.$expire.'</td></tr>'
		.'<tr><td>'._AFTEREXPIRATION.':</td><td><select name="action">'
		.'<option value="d" '.$selact1.'>'._DEACTIVATE.'</option>'
		.'<option value="r" '.$selact2.'>'._DELETE.'</option></select></td></tr>';
	if ($url != "") {
		$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
		if ($refresh == 1800) {
			$sel1 = 'selected="selected"';
		} elseif ($refresh == 3600) {
			$sel2 = 'selected="selected"';
		} elseif ($refresh == 18000) {
			$sel3 = 'selected="selected"';
		} elseif ($refresh == 36000) {
			$sel4 = 'selected="selected"';
		} elseif ($refresh == 86400) {
			$sel5 = 'selected="selected"';
		}
		echo '<tr><td>'._REFRESHTIME.':</td><td><select name="refresh"><option value="1800" '.$sel1.'>1/2 '._HOUR.'</option>'
				.'<option value="3600" '.$sel2.'>1 '._HOUR.'</option>'
				.'<option value="18000" '.$sel3.'>5 '._HOURS.'</option>'
				.'<option value="36000" '.$sel4.'>10 '._HOURS.'</option>'
				.'<option value="86400" '.$sel5.'>24 '._HOURS.'</option></select>&nbsp;&nbsp;'._MAXRSS.'&nbsp;<input type="text" name="maxrss" size="4" maxlength="3" value="'.$maxrss.'" />&nbsp;&nbsp;'._ONLYHEADLINES.'</td></tr>';
	}
	$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
	if ($view == 0) {
		$sel1 = 'selected="selected"';
	} elseif ($view == 1) {
		$sel2 = 'selected="selected"';
	} elseif ($view == 2) {
		$sel3 = 'selected="selected"';
	} elseif ($view == 3) {
		$sel4 = 'selected="selected"';
	} elseif ($view > 3) {
		$sel5 = 'selected="selected"';
	}
	if ($subscription == 1) {
		$sub_c1 = "";
		$sub_c2 = 'checked="checked"';
	} else {
		$sub_c1 = 'checked="checked"';
		$sub_c2 = "";
	}
	echo '<tr><td>'._VIEWPRIV.'</td><td><select name="view">'
		.'<option value="0" '.$sel1.'>'._MVALL.'</option>'
		.'<option value="1" '.$sel2.'>'._MVUSERS.'</option>'
		.'<option value="2" '.$sel3.'>'._MVADMIN.'</option>'
		.'<option value="3" '.$sel4.'>'._MVANON.'</option>'
		.'<option value="4" '.$sel5.'>'._MVGROUPS.'</option>'
		.'</select></td></tr><tr><td>'
		.'<span class="thick">'._WHATGROUPS.'</span></td><td>'._WHATGRDESC.'<br /><select name="groups[]" multiple="multiple" size="5">';
	$ingroups = explode('-',$groups);
	$groupsResult = $db->sql_query('select gid, gname from '.$prefix.'_nsngr_groups');
	while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
		if(in_array($gid,$ingroups)) { $sel = ' selected="selected"'; } else { $sel = ""; }
		echo '<option value="'.$gid.'" '.$sel.'>'.$gname.'</option>';
	}
	echo '</select></td></tr><tr><td width="100">'
		._SUBVISIBLE.'</td><td><input type="radio" name="subscription" value="0" '.$sub_c1.' /> '._YES.'&nbsp;&nbsp;<input type="radio" name="subscription" value="1" '.$sub_c2.' /> '._NO
		.'</td></tr></table><br /><br />'
		.'<input type="hidden" name="bid" value="'.$bid.'" />'
		.'<input type="hidden" name="bkey" value="'.$bkey.'" />'
		.'<input type="hidden" name="weight" value="'.$weight.'" />'
		.'<input type="hidden" name="op" value="BlocksEditSave" />'
		.'<input type="submit" value="'._SAVEBLOCK.'" /></form>';
	CloseTable();
	include_once('footer.php');
}

function BlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $maxrss) {
	echo 'in blockseditsave ' . '<br />';
	echo 'bid ' . $bid . '<br />';
	global $prefix, $db, $admin_file;
	$refresh = intval($refresh);
	if($view == 4) { $ingroups = implode('-',$groups); }
	if($view < 4) { $ingroups = ""; }
	# KBG: If title contains HTML content, it might not be saved correctly unless it's "fixed"
	$title = $db->sql_escape_string($title);
	$content = $db->sql_escape_string($content);
	$blanguage = $db->sql_escape_string($blanguage);
	$blockfile = $db->sql_escape_string($blockfile);
	$bposition = $db->sql_escape_string($bposition);
	$ingroups = $db->sql_escape_string($ingroups);
	$bkey = $db->sql_escape_string($bkey);
//	$url = $db->sql_escape_string($url);
	if (!empty($url)) {
		$bkey = '';
		$btime = time();
		if (!stristr($url, 'http://')) {
			$url = 'http://' . $url;
		}
		$rdf = parse_url($url);
		$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
		if (!$fp) {
			rssfail();
			exit;
		}
		if ($fp) {
			fclose($fp);
		}
		$url = html_entity_decode($url);
		# KBG: nukePIE cache's content in /cache directory, therefore $content isn't needed and should be blank
		$content = '';
		if ($oldposition != $bposition) {
			$result = $db->sql_query('SELECT bid FROM '.$prefix.'_blocks WHERE weight>=\''.$weight.'\' AND bposition=\''.$bposition.'\'');
			$fweight = $weight;
			$oweight = $weight;
			while ($row = $db->sql_fetchrow($result)) {
				$nbid = $row['bid'];
				$weight++;
				$db->sql_query('UPDATE '.$prefix.'_blocks SET weight=\''.$weight.'\' WHERE bid=\''.$nbid.'\'');
			}
			$result2 = $db->sql_query('SELECT bid FROM '.$prefix.'_blocks WHERE weight>\''.$oweight.'\' AND bposition=\''.$oldposition.'\'');
			while ($row2 = $db->sql_fetchrow($result2)) {
				$obid = $row2['bid'];
				$db->sql_query('UPDATE '.$prefix.'_blocks SET weight=\''.$oweight.'\' WHERE bid=\''.$obid.'\'');
				$oweight++;
			}
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT weight FROM '.$prefix.'_blocks WHERE bposition=\''.$bposition.'\' ORDER BY WEIGHT DESC LIMIT 0,1'));
			$lastw = $row3['weight'];
			if ($lastw <= $fweight) {
				$lastw++;
				$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', max_rss_items= '$maxrss' where bid='$bid'");
				} else {
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', max_rss_items= '$maxrss' where bid='$bid'");
				}
		} else {
			$db->sql_query('UPDATE `' . $prefix . '_blocks` SET `bkey`="' . $bkey . '", `title`="' . $title . '", `content`="' . $content . '", `url`="' . $url . '", `bposition`="' . $bposition . '", `weight`="' . $weight . '", `active`="' . $active . '", `refresh`="' . $refresh . '", `blanguage`="' . $blanguage . '", `blockfile`="' . $blockfile . '", `view`="' . $view . '", `groups`="' . $ingroups . '", `subscription`="' . $subscription . '", `max_rss_items`="' . $maxrss . '" WHERE `bid`="' . $bid . '"');
		}
		Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
	} else {
		if ($oldposition != $bposition) {
			$result5 = $db->sql_query('select bid from '.$prefix.'_blocks where weight>=\''.$weight.'\' AND bposition=\''.$bposition.'\'');
			$fweight = $weight;
			$oweight = $weight;
			while ($row5 = $db->sql_fetchrow($result5)) {
				$nbid = intval($row5['bid']);
				$weight++;
				$db->sql_query('update '.$prefix.'_blocks set weight=\''.$weight.'\' where bid=\''.$nbid.'\'');
				}
				$result6 = $db->sql_query('select bid from '.$prefix.'_blocks where weight>\''.$oweight.'\' AND bposition=\''.$oldposition.'\'');
				while ($row6 = $db->sql_fetchrow($result6)) {
					$obid = intval($row6['bid']);
					$db->sql_query('update '.$prefix.'_blocks set weight=\''.$oweight.'\' where bid=\''.$obid.'\'');
					$oweight++;
				}
				$row7 = $db->sql_fetchrow($db->sql_query('select weight from '.$prefix.'_blocks where bposition=\''.$bposition.'\' order by weight DESC limit 0,1'));
				$lastw = $row7['weight'];
				if ($lastw <= $fweight) {
					$lastw++;
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', max_rss_items = '$maxrss' where bid='$bid'");
				} else {
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', max_rss_items='$maxrss' where bid='$bid'");
				}
		} else {
			if ($expire == "") {
				$expire = 0;
			}
			if ($expire != 0 AND $expire <= 999) {
					$expire = time() + ($expire * 86400);
			}
			$result8 = $db->sql_query("update ".$prefix."_blocks set bkey='$bkey', title='$title', content='$content', url='$url', bposition='$bposition', weight='$weight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', expire='$expire', action='$action', subscription='$subscription', max_rss_items='$maxrss' where bid='$bid'");
		}
		Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
	}
}

function ChangeStatus($bid, $ok=0) {
	global $prefix, $db, $admin_file;
	$bid = intval($bid);
	$row = $db->sql_fetchrow($db->sql_query('select active from '.$prefix.'_blocks where bid=\''.$bid.'\''));
	$active = intval($row['active']);
	if (($ok) OR ($active == 1)) {
		if ($active == 0) {
			$active = 1;
		} elseif ($active == 1) {
			$active = 0;
		}
		$result2 = $db->sql_query('update '.$prefix.'_blocks set active=\''.$active.'\' where bid=\''.$bid.'\'');
		Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
	} else {
		$row3 = $db->sql_fetchrow($db->sql_query('SELECT title, content, url, bposition FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\''));
		$title = $row3['title'];
		$content = $row3['content'];
		$url = $row3['url'];
		$bposition = $row3['bposition'];
		include_once('header.php');
		GraphicAdmin();
		echo '<br />';
		OpenTable();
		echo '<p style="text-align: center;" class="option thick">'._BLOCKACTIVATION.'</p>';
		CloseTable();
		OpenTable();
		if (!empty($url)) {
		  echo '<p style="text-align: center">'._BLOCKPREVIEW.' <span class="italic">'.$title.'</span></p><br />';
		  headlines($bid, $bposition);
		}
		else {
		  if (!empty($content)) {
			  echo '<p style="text-align: center">'._BLOCKPREVIEW.' <span class="italic">'.$title.'</span></p><br />';
			  themesidebox($title, $content);
		  } else {
			  echo '<p style="text-align: center"><span class="italic">'.$title.'</span></p>';
		  }
		}
		echo '<br /><p style="text-align: center">'._WANT2ACTIVATE.'<br /><br />'
			.'[ <a href="'.$admin_file.'.php?op=BlocksAdmin">'._NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=ChangeStatus&amp;bid='.$bid.'&amp;ok=1">'._YES.'</a> ]'
				.'</p>';
		CloseTable();
		include_once('footer.php');
	}
}

function BlocksDelete($bid, $ok=0) {
	global $prefix, $db, $admin_file;
	$bid = intval($bid);
	if ($ok) {
		$row = $db->sql_fetchrow($db->sql_query('SELECT bposition, weight FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\''));
		$bposition = $row['bposition'];
		$weight = $row['weight'];
		$result2 = $db->sql_query('SELECT bid FROM '.$prefix.'_blocks WHERE weight>\''.$weight.'\' AND bposition=\''.$bposition.'\'');
		while ($row2 = $db->sql_fetchrow($result2)) {
			$nbid = $row2['bid'];
			$db->sql_query('UPDATE '.$prefix.'_blocks SET weight=\''.$weight.'\' WHERE bid=\''.$nbid.'\'');
			$weight++;
		}
		$db->sql_query('DELETE from '.$prefix.'_blocks WHERE bid=\''.$bid.'\'');
		Header('Location: '.$admin_file.'.php?op=BlocksAdmin');
	} else {
		$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\''));
		$title = $row3['title'];
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<p style="text-align: center;" class="title thick">'._BLOCKSADMIN.'</p>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<p style="text-align: center">'._ARESUREDELBLOCK.' <span class="italic">'.$title.'</span>?';
		echo '<br /><br />[ <a href="'.$admin_file.'.php?op=BlocksAdmin">'._NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=BlocksDelete&amp;bid='.$bid.'&amp;ok=1">'._YES.'</a> ]</p>';
		CloseTable();
		include_once('footer.php');
	}
}

function HeadlinesAdmin() {
	global $bgcolor1, $bgcolor2, $prefix, $db, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._HEADLINESADMIN.'</p>';
	CloseTable();
	OpenTable();
	echo '<form action="'.$admin_file.'.php" method="post">'
		.'<table border="1" width="100%" align="center"><tr>'
		.'<td bgcolor="'.$bgcolor2.'" align="center"><span class="thick">'._SITENAME.'</span></td>'
		.'<td bgcolor="'.$bgcolor2.'" align="center"><span class="thick">'._URL.'</span></td>'
		.'<td bgcolor="'.$bgcolor2.'" align="center"><span class="thick">'._FUNCTIONS.'</span></td></tr>';
	$result = $db->sql_query('select hid, sitename, headlinesurl from '.$prefix.'_headlines order by hid');
	while ($row = $db->sql_fetchrow($result)) {
		$hid = $row['hid'];
		$sitename = $row['sitename'];
		$headlinesurl = $row['headlinesurl'];

		echo '<tr><td bgcolor="'.$bgcolor1.'" align="center">'.$sitename.'</td>'
			.'<td bgcolor="'.$bgcolor1.'" align="center"><a href="'.htmlentities($headlinesurl).'" target="new">'.htmlentities($headlinesurl).'</a></td>'
			.'<td bgcolor="'.$bgcolor1.'" align="center">[ <a href="'.$admin_file.'.php?op=HeadlinesEdit&amp;hid='.$hid.'">'._EDIT.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=HeadlinesDel&amp;hid='.$hid.'&amp;ok=0">'._DELETE.'</a> ]</td></tr>';
	}
	echo '</table></form>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<span class="thick">'._ADDHEADLINE.'</span><br /><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<table border="0" width="100%"><tr><td>'
		._SITENAME.':</td><td><input type="text" name="xsitename" size="31" maxlength="30" /></td></tr><tr><td>'
		._RSSFILE.':</td><td><input type="text" name="headlinesurl" size="50" maxlength="200" /></td></tr><tr><td>'
		.'</td></tr></table>'
		.'<input type="hidden" name="op" value="HeadlinesAdd" />'
		.'<input type="submit" value="'._ADD.'" />'
		.'</form>';
	CloseTable();
	include_once('footer.php');
}

function HeadlinesEdit($hid) {
	global $prefix, $db, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<p style="text-align: center;" class="title thick">'._HEADLINESADMIN.'</p>';
	CloseTable();
	$row = $db->sql_fetchrow($db->sql_query('select sitename, headlinesurl from '.$prefix.'_headlines where hid=\''.$hid.'\''));
	$xsitename = $row['sitename'];
	$headlinesurl = $row['headlinesurl'];
	OpenTable();
	echo '<p style="text-align: center;" class="option thick">'._EDITHEADLINE.'</p>
		<form action="'.$admin_file.'.php" method="post">
		<input type="hidden" name="hid" value="'.$hid.'" />
		<table border="0" width="100%"><tr><td>
		'._SITENAME.':</td><td><input type="text" name="xsitename" size="31" maxlength="30" value="'.$xsitename.'" /></td></tr><tr><td>
		'._RSSFILE.':</td><td><input type="text" name="headlinesurl" size="50" maxlength="200" value="'.htmlentities($headlinesurl).'" /></td></tr><tr><td>
		</td></tr></table>
		<input type="hidden" name="op" value="HeadlinesSave" />
		<input type="submit" value="'._SAVECHANGES.'" />
		</form>';
	CloseTable();
	include_once('footer.php');
}

function HeadlinesSave($hid, $xsitename, $headlinesurl) {
	global $prefix, $db, $admin_file;
	$xsitename = str_replace(' ', '', $xsitename);
	$headlinesurl = html_entity_decode($headlinesurl);
	$xsitename = $db->sql_escape_string($xsitename);
	$headlinesurl = $db->sql_escape_string($headlinesurl);
	$db->sql_query('UPDATE '.$prefix.'_headlines SET sitename=\''.$xsitename.'\', headlinesurl=\''.$headlinesurl.'\' WHERE hid=\''.$hid.'\'');
	Header('Location: '.$admin_file.'.php?op=HeadlinesAdmin');
}

function HeadlinesAdd($xsitename, $headlinesurl) {
	global $prefix, $db, $admin_file;
	$xsitename = str_replace(' ', '', $xsitename);
	$db->sql_query("INSERT INTO ".$prefix."_headlines VALUES (NULL, '$xsitename', '$headlinesurl')");
	Header('Location: '.$admin_file.'.php?op=HeadlinesAdmin');
}

function HeadlinesDel($hid, $ok=0) {
	global $prefix, $db, $admin_file;
	if($ok==1) {
		$db->sql_query('DELETE FROM '.$prefix.'_headlines WHERE hid=\''.$hid.'\'');
		Header('Location: '.$admin_file.'.php?op=HeadlinesAdmin');
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<p style="text-align: center;" class="option"><br />';
		echo '<span class="thick">'._SURE2DELHEADLINE.'</span><br /><br />';
	}
	echo '[ <a class="rn_csrf" href="'.$admin_file.'.php?op=HeadlinesDel&amp;hid='.$hid.'&amp;ok=1\">'._YES.'</a> | <a href="'.$admin_file.'.php?op=HeadlinesAdmin">'._NO.'</a> ]<br /><br />';
	echo '</p>';
	CloseTable();
	include_once('footer.php');
}

?>