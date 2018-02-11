<?php
/*      Content Plus for RavenNuke(tm): /admin/index.php
 *      Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 * 		Join me at http://slaytanic.sourceforge.net
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if (!defined('ADMIN_FILE')) { die('Access Denied'); }

global $admin;
$module_name = basename(dirname(dirname(__FILE__)));
$ver = '2.2.2';

if (is_admin($admin)) {
define('IN_CPM', true);
require_once('modules/'.$module_name.'/var/cpfunc.php');
/**********************************/
/* Content Plus Manager Functions
/**********************************/
function CPAdminMenu() {
global $admin_file, $db, $prefix, $ver, $module_name;
	OpenTable();
	$bullet = '<img src="modules/'.$module_name.'/images/icons/star_48.png" alt="-" border="0" width="16" style="vertical-align: middle;" />';
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_ADMININDEX.'</div>'.PHP_EOL;
	echo '<table width="90%" style="font-size: 115%; vertical-align: middle; margin-left:auto; margin-right:auto;">'.PHP_EOL;
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPListPages">'._CP_MANAGECONTENT.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPAddPage">'._CP_CONTENTADD.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=ContentPlus">'._CP_CONTENTMANAGER.'</a></td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPListCats">'._CP_MANAGECATS.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPAddCategory">'._CP_CONTENTADDCAT.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php">'._CP_ADMININDEX.'</a></td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPPagesWaiting">'._CP_MANAGEWAITING.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPFeat">'._CP_CPFEAT.'</a></td>'.PHP_EOL;
	echo '		<td>'.$bullet.' <a href="'.$admin_file.'.php?op=CPAbout">'._CP_ABOUT.' Content Plus</a></td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	echo '</table><br />'.PHP_EOL;
	CloseTable();
}

function CPAdmin() {
global $db, $prefix, $ver, $admin_file, $module_name, $locale, $datetime;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	$bullet = '<img src="modules/'.$module_name.'/images/icons/accepted_48.png" alt="-" border="0" width="16" style="vertical-align: middle;" />';
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_ADMINSUMMARY.'</div>'.PHP_EOL;
	echo '<table style="font-size: 110%; width: 90%; margin-left:auto; margin-right:auto;">';
	$total = $db->sql_numrows($db->sql_query('SELECT cid FROM '.$prefix.'_pages_categories'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALCATS.'</span>:</td> <td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$total = $db->sql_numrows($db->sql_query('SELECT pid FROM '.$prefix.'_newpages'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALPAGESWAITING.'</span>:</td><td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$total = $db->sql_numrows($db->sql_query('SELECT pid FROM '.$prefix.'_pages'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALPAGES.'</span>:</td><td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$total = $db->sql_numrows($db->sql_query('SELECT pid FROM '.$prefix.'_pages WHERE active=1'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALACTIVE.'</span>:</td><td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$total = $db->sql_numrows($db->sql_query('SELECT pid FROM '.$prefix.'_pages WHERE active=0'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALINACTIVE.'</span>:</td><td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$total = $db->sql_numrows($db->sql_query('SELECT pid FROM '.$prefix.'_pages WHERE cid=0'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_TOTALNONCAT.'</span>:</td><td>'.$total.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$row = $db->sql_fetchrow($db->sql_query('SELECT pid, title, counter FROM '.$prefix.'_pages ORDER BY counter DESC LIMIT 1'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_MOSTVIEWED.'</span>:</td><td><a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$row['pid'].'">'.$row['title'].'</a> ('.$row['counter'].' Hits)</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$row = $db->sql_fetchrow($db->sql_query('SELECT pid, title, counter FROM '.$prefix.'_pages ORDER BY counter ASC LIMIT 1'));
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_LESSVIEWED.'</span>:</td><td><a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$row['pid'].'">'.$row['title'].'</a> ('.$row['counter'].' Hits)</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$row = $db->sql_fetchrow($db->sql_query('SELECT date FROM '.$prefix.'_pages ORDER BY date ASC LIMIT 1'));
	if (!empty($row['date'])) {
		setlocale (LC_TIME, $locale);
		preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $row['date'], $datetime);
		$datetime = strftime(_CP_DATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
	} else { $datetime = ''; }
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_DATEFIRSTADD.'</span>:</td><td>'.$datetime.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	$row = $db->sql_fetchrow($db->sql_query('SELECT date FROM '.$prefix.'_pages ORDER BY date DESC LIMIT 1'));
	if (!empty($row['date'])) {
		setlocale (LC_TIME, $locale);
		preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $row['date'], $datetime);
		$datetime = strftime(_CP_DATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
	} else { $datetime = ''; }
	echo '	<tr>'.PHP_EOL;
	echo '		<td>'.$bullet.' <span class="thick">'._CP_DATELASTADD.'</span>:</td><td>'.$datetime.'</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	echo '</table>'.PHP_EOL;
	CloseTable();
	include('footer.php');
}

function CPListPages() {
global $admin_file, $db, $prefix, $bgcolor4, $module_name, $page, $ver;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	$show=50;
	$result = $db->sql_query('SELECT * from '.$prefix.'_pages');
	$total = $db->sql_numrows($result);
	if ($total>$show) {
		$pages=ceil($total/$show);
		if ($page > $pages) { $page = $pages; }
		if (!$page) { $page=1; }
		$offset=($page-1)*$show;
	} else {
		$offset=0;
		$pages=1;
		$page=1;
	}
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_CONTENTMANAGER.'</div>'.PHP_EOL;
	$result = $db->sql_query('SELECT cid, title FROM '.$prefix.'_pages_categories ORDER BY title ASC');
	if($db->sql_numrows($result)) {
		echo '<div style="text-align:center;">'._CP_FILTERBYCAT.':';
		echo '<form action="'.$admin_file.'.php">'.PHP_EOL;
		echo '<select name="cid">'.PHP_EOL;
		while(list($cat, $title)=$db->sql_fetchrow($result)) {
			echo '	<option value="'.$cat.'">'.$title.'</option>'.PHP_EOL;
		}
		echo '</select>'.PHP_EOL;
		echo '<input type="hidden" name="op" value="CPListPagesCat" />'.PHP_EOL;
		echo '<input type="submit" value="GO" />'.PHP_EOL;
		echo '</form></div><br />'.PHP_EOL;
	}
    echo '<table border="0" align="center" cellpadding="3" cellspacing="1" style="width: 90%; margin-left:auto; margin-right:auto;">'.PHP_EOL;
    echo '	<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
    echo '		<th>'._CP_TITLE.'</th>'.PHP_EOL;
    echo '		<th>'._CP_STATUS.'</th>'.PHP_EOL;
    echo '		<th>'._CP_CATEGORY.'</th>'.PHP_EOL;
    echo '		<th>'._CP_FUNCTIONS.'</th>'.PHP_EOL;
    echo '	</tr>'.PHP_EOL;
    $result = $db->sql_query('SELECT * from '.$prefix.'_pages ORDER BY pid LIMIT '.$offset.','.$show.'');
    while ($mypages = $db->sql_fetchrow($result)) {
		$mycid = intval($mypages['cid']);
		$myactive = intval($mypages['active']);
		$mypid = intval($mypages['pid']);
		$mytitle = $mypages['title'];
		$myuname = $mypages['uname'];
		if ($mycid == 0 || $mycid == '') {
            $cat_title = _NONE;
        } else {
			$row_res = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_pages_categories where cid='.$mycid.''));
			$cat_title = $row_res['title'];
        }
		if ($myactive == 1) {
            $status = '<img src="modules/'.$module_name.'/images/icons/accepted_48.png" alt="'._CP_ACTIVE.'" title="'._CP_ACTIVE.'" border="0" width="24" height="24" />';
            $status_chng = '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" width="24" height="24" />';
            $active = 1;
        } else {
            $status = '<img src="modules/'.$module_name.'/images/icons/accepted_48_gray.png" alt="'._CP_INACTIVE.'" title="'._CP_INACTIVE.'" border="0" width="24" height="24" />';
            $status_chng = '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" alt="'._CP_ACTIVATE.'" title="'._CP_ACTIVATE.'" border="0" width="24" height="24" />';
            $active = 0;
        }
		echo '<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
		echo '	<td width="60%"><span class="larger">&middot;</span> <a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$mypid.'">'.$mytitle.'</a></td>'.PHP_EOL;
		echo '	<td width="5%" align="center">'.$status.'</td>'.PHP_EOL;
		echo '	<td width="25%" align="center" nowrap="nowrap">'.$cat_title.'</td>'.PHP_EOL;
		echo '	<td width="10%" align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$mypid.'"><img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" width="24" height="24" /></a>'.PHP_EOL;
		echo '		<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$mypid.'&amp;active='.$active.'">'.$status_chng.'</a>'.PHP_EOL;
		echo '		<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$mypid.'"><img src="modules/'.$module_name.'/images/icons/cancel_48.png" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" width="24" height="24" /></a></td>'.PHP_EOL;
		echo '</tr>';
    }
    echo '</table><br /><br />'.PHP_EOL;
	if ($pages > 1) {
		$pcnt=1;
		echo '<table align="center" cellpadding="3" cellspacing="1" border="0"><tr>'.PHP_EOL;
		if ($page > 1) {
			echo '<td align="center" valign="middle"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.($page-1).'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_left_48.png" title="'._CP_PREVPAGE.'" alt="" border="0" /></a></td>'.PHP_EOL;
			echo '<td align="center" valign="middle">'.PHP_EOL;
		} else {
			echo '<td align="center" valign="middle">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_left_48_gray.png" title="" alt="" border="0" /></td>'.PHP_EOL;
			echo '<td align="center" valign="middle">'.PHP_EOL;
		}
		echo '| ';
		while($pcnt < $page) {
			echo '<span style="font-weight: bold;"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.$pcnt.'">'.$pcnt.'</a></span> |'.PHP_EOL;
			$pcnt++;
		}
		echo '<span style="font-weight: bold;">'.$page.'</span> |'.PHP_EOL;
		$pcnt++;
		while($pcnt <= $pages) {
			echo ' <span style="font-weight: bold;"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.$pcnt.'">'.$pcnt.'</a></span> |'.PHP_EOL;
			$pcnt++;
		}
		if ($page < $pages) {
			echo '</td><td align="center" valign="middle"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.($page+1).'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_right_48.png" title="'._CP_NEXTPAGE.'" alt="" border="0" /></a></td>'.PHP_EOL;
		} else {
			echo '</td><td align="center" valign="middle">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_right_48_gray.png" title="" alt="" border="0" /></td>'.PHP_EOL;
		}
		echo '</tr></table><br />'.PHP_EOL;
	}
    CloseTable();
    include('footer.php');
}

function CPListCats() {
global $db, $prefix, $admin_file, $bgcolor4, $ver, $module_name;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_MANAGECATS.'</div>'.PHP_EOL;
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages_categories ORDER BY title ASC');
	if($db->sql_numrows($result)) {
		echo '<table align="center" cellpadding="4" cellspacing="1" border="0" style="width: 90%; margin-left:auto; margin-right:auto;">'.PHP_EOL;
		while($row = $db->sql_fetchrow($result)) {
			$cid = $row['cid']; $title = $row['title']; $description = $row['description']; $cimg = $row['cimg'];
			if (empty($cimg) || !file_exists('modules/'.$module_name.'/images/categories/'.$cimg.'')) {
				$cimg='no_icon.png';
			}
			$cimg = '<img src="modules/'.$module_name.'/images/categories/'.$cimg.'" alt="'.$title.'" title="'.$title.'" border="0" width="48" height="48" />';
			$edit = '<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" width="24" height="24" />';
			$delete = '<img src="modules/'.$module_name.'/images/icons/cancel_48.png" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" width="24" height="24" />';
			echo '	<tr style="background: '.$bgcolor4.';">'.PHP_EOL;
			echo '		<td width="10%" style="text-align: center;">'.$cimg.'</td>'.PHP_EOL;
			echo '		<td width="75%" valign="top"><span class="thick">'.$title.'</span><br />'.substr($description, 0, 255).'...</td>'.PHP_EOL;
			echo '		<td width="15%" style="text-align: center;">'.PHP_EOL;
			echo '			<a href="'.$admin_file.'.php?op=CPEditCat&amp;cid='.$cid.'">'.$edit.'</a>'.PHP_EOL;
			echo '			<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDeleteCat&amp;cid='.$cid.'">'.$delete.'</a>'.PHP_EOL;
			echo '		</td>'.PHP_EOL;
			echo '	</tr>'.PHP_EOL;
		}
		echo '</table><br />'.PHP_EOL;
	}
	echo '<div class="text-center">'._CP_GOBACK.'</div>'.PHP_EOL;
	Closetable();
	include('footer.php');
}

function CPListPagesCat($cid) {
global $admin_file, $db, $prefix, $bgcolor4, $module_name, $page;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	$show=50;
	$result = $db->sql_query('SELECT pid from '.$prefix.'_pages WHERE cid='.$cid.'');
	$total=$db->sql_numrows($result);
	if ($total>$show) {
		$pages=ceil($total/$show);
		if ($page > $pages) { $page = $pages; }
		if (!$page) { $page=1; }
		$offset=($page-1)*$show;
	} else {
		$offset=0;
		$pages=1;
		$page=1;
	}
    echo '<table border="0" align="center" cellpadding="3" cellspacing="1" style="width: 90%; margin-left:auto; margin-right:auto;">'.PHP_EOL;
    echo '<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
    echo '<th><span style="font-weight: bold;">'._CP_TITLE.'</span></th>'.PHP_EOL;
    echo '<th>&nbsp;<span style="font-weight: bold;">'._CP_STATUS.'</span>&nbsp;</th>'.PHP_EOL;
    echo '<th><span style="font-weight: bold;">'._CP_CATEGORY.'</span></th>'.PHP_EOL;
    echo '<th><span style="font-weight: bold;">'._CP_FUNCTIONS.'</span></td></tr>'.PHP_EOL;
    $result = $db->sql_query('SELECT * from '.$prefix.'_pages WHERE cid='.$cid.' ORDER BY pid LIMIT '.$offset.','.$show.'');
    while ($mypages = $db->sql_fetchrow($result)) {
		$mycid = intval($mypages['cid']);
		$myactive = intval($mypages['active']);
		$mypid = intval($mypages['pid']);
		$mytitle = $mypages['title'];
		$myuname = $mypages['uname'];
		if ($mycid == 0 OR $mycid == '') {
            $cat_title = _NONE;
        } else {
			$row_res = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_pages_categories where cid='.$mycid.''));
			$cat_title = $row_res['title'];
        }
		if ($myactive == 1) {
            $status = '<img src="modules/'.$module_name.'/images/icons/accepted_48.png" alt="'._CP_ACTIVE.'" title="'._CP_ACTIVE.'" border="0" width="24" height="24">';
            $status_chng = '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" width="24" height="24">';
            $active = 1;
        } else {
            $status = '<img src="modules/'.$module_name.'/images/icons/accepted_48_gray.png" alt="'._CP_INACTIVE.'" title="'._CP_INACTIVE.'" border="0" width="24" height="24">';
            $status_chng = '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" alt="'._CP_ACTIVATE.'" title="'._CP_ACTIVATE.'" border="0" width="24" height="24">';
            $active = 0;
        }
		echo '<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
		echo '	<td width="60%"><span class="larger">&middot;</span> <a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$mypid.'">'.$mytitle.'</a></td>'.PHP_EOL;
		echo '	<td width="5%" align="center">'.$status.'</td>'.PHP_EOL;
		echo '	<td width="25%" align="center" nowrap="nowrap">'.$cat_title.'</td>'.PHP_EOL;
		echo '	<td width="10%" align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$mypid.'"><img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" width="24" height="24"></a>'.PHP_EOL;
		echo '		<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$mypid.'&amp;active='.$active.'">'.$status_chng.'</a>'.PHP_EOL;
		echo '		<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$mypid.'"><img src="modules/'.$module_name.'/images/icons/cancel_48.png" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" width="24" height="24"></a></td>'.PHP_EOL;
		echo '</tr>';
    }
    echo '</table><br /><br />'.PHP_EOL;
	if ($pages > 1) {
		$pcnt=1;
		echo '<table align="center" cellpadding="3" cellspacing="1" border="0"><tr>'.PHP_EOL;
		if ($page > 1) {
			echo '<td align="center" valign="middle"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.($page-1).'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_left_48.png" title="'._CP_PREVPAGE.'" alt="" border="0" /></a></td>'.PHP_EOL;
			echo '<td align="center" valign="middle">'.PHP_EOL;
		} else {
			echo '<td align="center" valign="middle">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_left_48_gray.png" title="'._CP_NOPREVPAGE.'" alt="" border="0" /></td>'.PHP_EOL;
			echo '<td align="center" valign="middle">'.PHP_EOL;
		}
		echo '| ';
		while($pcnt < $page) {
			echo '<span style="font-weight: bold;"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.$pcnt.'">'.$pcnt.'</a></span> |'.PHP_EOL;
			$pcnt++;
		}
		echo '<span style="font-weight: bold;">'.$page.'</span> |'.PHP_EOL;
		$pcnt++;
		while($pcnt <= $pages) {
			echo ' <span style="font-weight: bold;"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.$pcnt.'">'.$pcnt.'</a></span> |'.PHP_EOL;
			$pcnt++;
		}
		if ($page < $pages) {
			echo '</td><td align="center" valign="middle"><a href="'.$admin_file.'.php?op=CPListPages&amp;page='.($page+1).'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_right_48.png" title="'._CP_NEXTPAGE.'" alt="" border="0" /></a></td>'.PHP_EOL;
		} else {
			echo '</td><td align="center" valign="middle">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/arrow_right_48_gray.png" title="'._CP_NONEXTPAGE.'" alt="" border="0" /></td>'.PHP_EOL;
		}
		echo '</tr></table><br />'.PHP_EOL;
	}
    CloseTable();
    include('footer.php');
}

function CPAddCategory() {
global $admin_file, $module_name, $ver;
	include('header.php');
	echo '<script language="javascript" type="text/javascript">'.PHP_EOL;
	echo '<!--'.PHP_EOL;
	echo 'function popitup(url) {'.PHP_EOL;
	echo '	newwindow=window.open(url,\'\',\'height=480,width=640,top=20,left=0,scrollbars=yes,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no\');'.PHP_EOL;
	echo '	if (window.focus) {newwindow.focus()}'.PHP_EOL;
	echo '	return false;'.PHP_EOL;
	echo '}'.PHP_EOL;
	echo '// -->'.PHP_EOL;
	echo '</script>'.PHP_EOL;
	CPAdminMenu();
    OpenTable();
    echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_ADDCATEGORY.'</div>'.PHP_EOL;
	echo '<form name="cpaddcat" action="'.$admin_file.'.php?op=CPCategoryAddSave" method="post" enctype="multipart/form-data">'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_TITLE.':</span><br />'.PHP_EOL;
	echo '<input type="text" name="cat_title" size="50" /><br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_CPIMAGE.':</span><br />'.PHP_EOL;
	echo '('._CP_CPIMAGEWARNING.' modules/'.$module_name.'/images/categories/):<br />'.PHP_EOL;
	echo '<input type="text" name="input_cimg" size="50" />'.PHP_EOL;
	echo '<input type="button" value="'._CP_BROWSE.'" onclick="popitup(\''.$admin_file.'.php?op=CPShowCatImages\')" /><br /><br />'.PHP_EOL;
	echo '<span class="thick">'._CP_UPLOADNEWIMG.'</span>:<br />'.PHP_EOL;
	echo _CP_UPLOADWARNING.'<br />'.PHP_EOL;
	echo '<input type="hidden" name="MAX_FILE_SIZE" value="512000" />'.PHP_EOL;
	echo '<input type="file" name="cimg" size="50" /><br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_DESCRIPTION.':</span><br />'.PHP_EOL;
	echo '<textarea name="description" rows="10" cols="50"></textarea><br /><br />'.PHP_EOL;
	//.'<input type="hidden" name="op" value="CPCategoryAddSave">'.PHP_EOL;
	echo '<input type="submit" value="'._CP_ADD.'" />'.PHP_EOL;
	echo '</form>'.PHP_EOL;
    CloseTable();
	include('footer.php');
}

function CPAddPage() {
global $admin_file, $db, $prefix, $multilingual, $aid, $language, $ver;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	$res2 = $db->sql_query('SELECT cid, title from '.$prefix.'_pages_categories order by title');
	$numrows2 = $db->sql_numrows($res2);
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_ADDANEWPAGE.'</div>'.PHP_EOL;
	echo '<form action="'.$admin_file.'.php" method="post">'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_TITLE.':</span>  '.PHP_EOL;
	echo '<input type="text" name="title" size="50" maxlength="255" /><br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_CSUBTITLE.'</span>:  '.PHP_EOL;
	echo '<input type="text" name="subtitle" size="50" maxlength="255" /><br /><br />'.PHP_EOL;
    if ($numrows2 > 0) {
		echo '<span style="font-weight: bold;">'._CP_CATEGORY.':</span>&nbsp;&nbsp;'.PHP_EOL;
		echo '<select name="cid">'.PHP_EOL;
		echo '<option value="0" selected="selected">'._CP_NONE.'</option>'.PHP_EOL;
		while ($row_res2 = $db->sql_fetchrow($res2)) {
			$cid = intval($row_res2['cid']);
			$cat_title = $row_res2['title'];
			echo '<option value="'.$cid.'">'.$cat_title.'</option>'.PHP_EOL;
		}
		echo '</select><br /><br />'.PHP_EOL;
	} else {
		echo '<input type="hidden" name="cid" value="0" />'.PHP_EOL;
	}
	echo '<span class="thick">'._CP_TAGS.'</span>:  '.PHP_EOL;
	echo '<input type="text" name="tags" size="50" maxlength="255" /><br /><br />'.PHP_EOL;
	$aaid = substr($aid, 0, 25);
	echo '<span style="font-weight: bold;">'._CP_HEADERTEXT.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('page_header', '', 'PHPNukeAdmin', '100', '15');
	} else {
		echo '<textarea name="page_header" cols="100" rows="15"></textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_PAGETEXT.':</span><br />'.PHP_EOL;
	echo '<span class="tiny">'._CP_PAGEBREAK.'</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('text', '', 'PHPNukeAdmin', '100', '20');
	} else {
		echo '<textarea name="text" cols="100" rows="20"></textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_FOOTERTEXT.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('page_footer', '', 'PHPNukeAdmin', '100', '15');
	} else {
		echo '<textarea name="page_footer" cols="100" rows="15"></textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_SIGNATURE.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('signature', '', 'PHPNukeAdmin', '100', '15');
	} else {
		echo '<textarea name="signature" cols="100" rows="15"></textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_USERNAME.':&nbsp;&nbsp;'.$aaid.'</span><br />'.PHP_EOL;
	echo '<input type="hidden" name="uname" value="'.$aaid.'" />'.PHP_EOL;

	if ($multilingual == 1) {
		echo '<br /><span style="font-weight: bold;">' . _CP_LANGUAGE . ': </span>' . PHP_EOL
			. lang_select_list('clanguage', $language, false) . PHP_EOL
			. '<br /><br />' . PHP_EOL;
	} else {
		echo '<input type="hidden" name="clanguage" value="'.$language.'" />'.PHP_EOL;
	}
	echo '<span style="font-weight: bold;">'._CP_ACTIVATEPAGE.'</span><br />'.PHP_EOL;
	echo '<input type="radio" name="active" value="1" checked="checked" />&nbsp;'._CP_YES.'&nbsp;&nbsp;'.PHP_EOL;
	echo '<input type="radio" name="active" value="0" />&nbsp;'._CP_NO.'<br /><br />'.PHP_EOL;
	echo '<input type="hidden" name="op" value="CPSave" />'.PHP_EOL;
	echo '<input type="submit" value="'._CP_SEND.'" />'.PHP_EOL;
	echo '</form>';
	CloseTable();
	include('footer.php');
}

function CPPagesWaiting() {
global $db,$prefix, $admin_file, $bgcolor4, $module_name, $ver;
	include('header.php');
	CPAdminMenu();
    $result = $db->sql_query('select pid, cid, title, uname from '.$prefix.'_newpages order by pid');
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
		OpenTable();
		echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_CONTENTWAIT.'</div>'.PHP_EOL;
		echo '<table border="0" cellspacing="1" cellpadding="3" width="90%" align="center"><tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
		echo '<th><span style="font-weight: bold;">'._CP_TITLE.'</span></th>'.PHP_EOL;
		echo '<th><span style="font-weight: bold;">'._CP_AUTHORNAME.'</span></th>'.PHP_EOL;
		echo '<th><span style="font-weight: bold;">'._CP_CATEGORY.'</span></th>'.PHP_EOL;
		echo '<th><span style="font-weight: bold;">'._CP_FUNCTIONS.'</span></th></tr>'.PHP_EOL;
		while (list($pid, $cid, $title, $uname) = $db->sql_fetchrow($result)) {
			$uresult = $db->sql_query('SELECT title FROM '.$prefix.'_pages_categories WHERE cid='.$cid.'');
			$urow = $db->sql_fetchrow($uresult);
			$ctitle = $urow['title'];
			echo '<tr style="background-color: '.$bgcolor4.';"><td><span class="larger">&middot;</span> <a href="'.$admin_file.'.php?op=CPAddNewPage&amp;pid='.$pid.'">'.$title.'</a></td><td align="center">'.$uname.'</td>'.PHP_EOL;
			echo '<td align="center">'.$ctitle.'</td>'.PHP_EOL;
			echo '<td align="center"><a href="'.$admin_file.'.php?op=CPAddNewPage&amp;pid='.$pid.'"><img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" alt="'._CP_ACTIVATE.'" title="'._CP_ACTIVATE.'" border="0" width="24" height="24" /></a>'.PHP_EOL;
			echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPNewPageDelete&amp;pid='.$pid.'"><img src="modules/'.$module_name.'/images/icons/cancel_48.png" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" width="24" height="24" /></a></td></tr>'.PHP_EOL;
		}
		echo '</table><br /><br />'.PHP_EOL;
		CloseTable();
    } else {
		OpenTable();
		echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_CONTENTWAIT.'</div>'.PHP_EOL;
		echo '<span class="content">'._CP_NONEWPAGES.'. '._CP_NONEWPAGES2.'</span><br /><br />'.PHP_EOL;
		echo '<div class="text-center">'._CP_GOBACK.'</div>';
		CloseTable();
	}
	include('footer.php');
}

function CPAddNewPage($pid) {
    global $prefix, $db, $admin_file, $multilingual, $currentlang;
    @include('header.php');
    CPAdminMenu();
    title(_CP_CONTENTMANAGER);
	echo '<br />'.PHP_EOL;
    OpenTable();
    echo '<div style="text-align: center;"><span class="option" style="font-weight: bold;">'._CP_PAGESWAITING.'</span></div><br />'.PHP_EOL;
    $row = $db->sql_fetchrow($db->sql_query('select * from '.$prefix.'_newpages WHERE pid='.$pid.''));

	$pid = intval($row['pid']);
	$cid = intval($row['cid']);
    $title = stripslashes(check_html($row['title'], 'nohtml'));
    $subtitle = stripslashes(check_html($row['subtitle'], 'nohtml'));
    $tags = stripslashes(check_html($row['tags'], 'nohtml'));
    $page_header = stripslashes($row['page_header']);
    $text = stripslashes($row['text']);
    $page_footer = stripslashes($row['page_footer']);
    $signature = stripslashes($row['signature']);
    $date = $row['date'];
    $clanguage = $row['clanguage'];
    $uname = $row['uname'];

    $res = $db->sql_query('SELECT title from '.$prefix.'_pages_categories where cid='.$cid.'');
    //while ($row_res = $db->sql_fetchrow($res)) {
    	$row_res = $db->sql_fetchrow($res);
		$cat_title = stripslashes(check_html($row_res['title']));
    //}
	echo '<form action="'.$admin_file.'.php" method="post">'.PHP_EOL;
	echo '<hr noshade="noshade" size="1" /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_USERNAME.'</span>: '.$uname.'<br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_PUBLISHEDON.'</span>: '.$date.'<br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_CATEGORY.'</span>: '.$cat_title.'<br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_PAGEID.'</span>: '.$pid.'<br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_TITLE.'</span>:<br />'.PHP_EOL;
	echo '<input type="text" name="title" value="'.$title.'" size="25" maxlength="255" /><br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_CSUBTITLE.':</span><br />'.PHP_EOL;
	echo '<input type="text" name="subtitle" value="'.$subtitle.'" size="25" maxlength="255" /><br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_TAGS.'</span>:<br />'.PHP_EOL;
	echo '<input type="text" name="tags" value="'.$tags.'" size="25" maxlength="255" /><br /><br />'.PHP_EOL;
	if ($multilingual == 1) {
		echo '<span style="font-weight: bold;">' . _CP_LANGUAGE . ':</span>' . PHP_EOL
			. lang_select_list('clanguage', $clanguage, false) . PHP_EOL
			. '<br /><br />' . PHP_EOL;
	} else {
		//echo '<span class="thick">'._CP_LANGUAGE.': '.ucfirst($clanguage).'</span><br /><br />'.PHP_EOL;
		if($clanguage==0) { $clanguage=$currentlang; }
		echo '<span class="thick">'._CP_LANGUAGE.': '.ucfirst($clanguage).'</span><br /><br />'.PHP_EOL;
		echo '<input type="hidden" name="clanguage" value="'.$clanguage.'" />'.PHP_EOL;
	}
	echo '<span style="font-weight: bold;">'._CP_HEADERTEXT.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('page_header', $page_header, 'PHPNukeAdmin', '100', '10');
	} else {
		echo '<TEXTAREA name="page_header" rows="10" wrap="virtual" cols="100">'.$page_header.'</textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_PAGETEXT.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('text', $text, 'PHPNukeAdmin', '100', '20');
	} else {
		echo '<TEXTAREA name="text" rows="20" wrap="virtual" cols="100">'.$text.'</textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_FOOTERTEXT.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('page_footer', $page_footer, 'PHPNukeAdmin', '100', '10');
	} else {
		echo '<TEXTAREA name="page_footer" rows="10" wrap="virtual" cols="100">'.$page_footer.'</textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<span style="font-weight: bold;">'._CP_SIGNATURE.':</span><br />'.PHP_EOL;
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea('signature', $signature, 'PHPNukeAdmin', '100', '10');
	} else {
		echo '<TEXTAREA name="signature" rows="10" wrap="virtual" cols="100">'.$signature.'</textarea>'.PHP_EOL;
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<input type="hidden" name="pid" value="'.$pid.'" />'.PHP_EOL;
	echo '<input type="hidden" name="cid" value="'.$cid.'" />'.PHP_EOL;
	echo '<input type="hidden" name="uname" value="'.$uname.'" />'.PHP_EOL;
	echo '<input type="hidden" name="date" value="'.$date.'" />'.PHP_EOL;
	echo '<input type="hidden" name="clanguage" value="'.$clanguage.'" />'.PHP_EOL;
	echo '<input type="hidden" name="op" value="CPNewPageChangeStatus" />'.PHP_EOL;
	echo '<input type="submit" value="'._CP_ADDPAGE.'" /> - [ <a class="rn_csrf" href="'.$admin_file.'.php?op=CPNewPageDelete&amp;pid='.$pid.'">'._CP_DELETE.'</a> ]'.PHP_EOL;
	echo '</form><br /><br />'.PHP_EOL;
    CloseTable();
    @include('footer.php');
}

function CPCategoryAddSave() {
global $prefix, $db, $admin_file, $module_name;

	$cat_title = real_escape_content($_POST['cat_title']);
	$input_cimg = $_POST['input_cimg'];
	$description = real_escape_content($_POST['description']);
	$cp_maxfilesize=512000;
	define('CP_UPLOADDIR', 'modules/'.$module_name.'/images/categories/'); // This dir must have permission to write on it (chmod 666 or 777)

	if (empty($cat_title) || empty($description)) { define('CP_ADDERROR', TRUE); } //else { $error = FALSE; }

    if (is_uploaded_file($_FILES['cimg']['tmp_name'])) {
		$cp_filename = $_FILES['cimg']['name'];
		$cp_filetype = $_FILES['cimg']['type'];
		$cp_filesize = $_FILES['cimg']['size'];
		$cp_filerror = $_FILES['cimg']['error'];
		$cp_filetemp = $_FILES['cimg']['tmp_name'];
		$cp_filemove = time() .'_'. $cp_filename;

		if ((($cp_filetype == 'image/gif') || ($cp_filetype == 'image/jpeg') || ($cp_filetype == 'image/pjpeg') || ($cp_filetype == 'image/png')) && ($cp_filesize < $cp_maxfilesize)) {
  			if ($cp_filerror > 0) {define('CP_UPLOAD_ERR', _CP_ERRORUPLOAD);}
  			elseif (file_exists(CP_UPLOADDIR . $cp_filemove)) {define('CP_UPLOAD_ERR', _CP_ERRORFILEEXIST);}
  			elseif (!move_uploaded_file($cp_filetemp, CP_UPLOADDIR . $cp_filemove)) {define('CP_UPLOAD_ERR', _CP_ERRORMOVE);}
  		} else {
  			define('CP_UPLOAD_ERR', _CP_ERRORTYPE);
  		}
	} elseif(!empty($input_cimg)) {
		$cp_filemove = $input_cimg;
	} else {
		$cp_filemove = '';
	}

	if(defined('CP_ADDERROR')) {
		include('header.php');
		OpenTable();
		echo '<div class="text-center">'._CP_CATADD_ERR.'<br /><br />';
		echo _CP_GOBACK.'</div><br /><br />';
		CloseTable();
		include('footer.php');
	} elseif (defined('CP_UPLOAD_ERR')) {
		include('header.php');
		OpenTable();
		echo '<div class="text-center">'.CP_UPLOAD_ERR.'<br /><br />';
		echo _CP_GOBACK.'</div><br /><br />';
		CloseTable();
		include('footer.php');
	}

	if (!defined('CP_UPLOAD_ERR') && !defined('CP_ADDERROR')) {
   		$result = $db->sql_query('INSERT INTO '.$prefix.'_pages_categories VALUES (NULL, \''.$cp_filemove.'\', \''.$cat_title.'\', \''.$description.'\')');
    	header('Location: '.$admin_file.'.php?op=ContentPlus');
	}
}

function CPEditCat() {
    global $prefix, $db, $admin_file, $cid, $module_name, $ver;
    include('header.php');
    echo '<script language="javascript" type="text/javascript">'.PHP_EOL;
	echo '<!--'.PHP_EOL;
	echo 'function popitup(url) {'.PHP_EOL;
	echo '	newwindow=window.open(url,\'\',\'height=480,width=640,top=20,left=0,scrollbars=yes,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no\');'.PHP_EOL;
	echo '	if (window.focus) {newwindow.focus()}'.PHP_EOL;
	echo '	return false;'.PHP_EOL;
	echo '}'.PHP_EOL;
	echo '// -->'.PHP_EOL;
	echo '</script>'.PHP_EOL;
    CPAdminMenu();
    if(!isset($cid)) {
		$rescat = $db->sql_query('SELECT cid, title from '.$prefix.'_pages_categories order by title');
		$numrows = $db->sql_numrows($rescat);
		if ($numrows > 0) {
			echo '<br />';
			OpenTable();
			echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_EDITCATEGORY.'</div>'.PHP_EOL;
			echo '<div style="text-align: center;">'.PHP_EOL;
			echo '<span style="font-weight: bold;">'._CP_EDITCATEGORY.'</span></div><br /><br />'.PHP_EOL;
			echo '<form action="'.$admin_file.'.php" method="post">'.PHP_EOL;
			echo '<span style="font-weight: bold;">'._CP_CATEGORY.':</span> '.PHP_EOL;
			echo '<select name="cid">'.PHP_EOL;
			while ($row_cat = $db->sql_fetchrow($rescat)) {
				$cid = intval($row_cat['cid']);
				$cat_title = stripslashes(check_html($row_cat['title'], 'nohtml'));
				echo '<option value="'.$cid.'">'.$cat_title.'</option>'.PHP_EOL;
			}
			echo '</select>'.PHP_EOL;
			echo '<input type="hidden" name="op" value="CPEditCat">'.PHP_EOL;
			echo '<input type="submit" value="'._CP_EDIT.'">'.PHP_EOL;
			echo '</form>'.PHP_EOL;
			CloseTable();
		}
    } else {
		//CPAdminMenu();
		OpenTable();
		$cid = intval($cid);
		$row = $db->sql_fetchrow($db->sql_query('SELECT cimg, title, description from '.$prefix.'_pages_categories where cid='.$cid.''));
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$cimg = stripslashes(check_html($row['cimg'], 'nohtml'));
		$description = stripslashes(check_html($row['description'], ''));
		//echo '<div style="text-align: center;"><span style="font-weight: bold;">'._CP_EDITCATEGORY.'</span></div><br /><br />'.PHP_EOL;
		echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_EDITCATEGORY.'</div>'.PHP_EOL;
        echo '<form name="cpaddcat" action="'.$admin_file.'.php" method="post" enctype="multipart/form-data">'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_TITLE.':</span><br />'.PHP_EOL;
        echo '<input type="text" name="cat_title" value="'.$title.'" size="50" /><br /><br />'.PHP_EOL;
		//.'('._CP_CPIMAGEWARNING.' modules/'.$module_name.'/images/categories/):<br />'.PHP_EOL;
		if (empty($cimg) || !file_exists('modules/'.$module_name.'/images/categories/'.$cimg.'')) {
			$cimg='no_icon.png';
		}
		echo _CP_CURRENTIMG.': ';
		echo '<img src="modules/'.$module_name.'/images/categories/'.$cimg.'" width="64" alt="" title="" /><br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_CPIMAGE.':</span><br />'.PHP_EOL;
		echo '('._CP_CPIMAGEWARNING.' modules/'.$module_name.'/images/categories/):<br />'.PHP_EOL;
		echo '<input type="text" name="input_cimg" size="50" value="'.$cimg.'" />'.PHP_EOL;
		echo '<input type="button" value="'._CP_BROWSE.'" onclick="popitup(\''.$admin_file.'.php?op=CPShowCatImages\')" /><br /><br />'.PHP_EOL;
		echo '<span class="thick">'._CP_UPLOADNEWIMG.'</span>:<br />'.PHP_EOL;
		echo _CP_UPLOADWARNING.'<br />'.PHP_EOL;
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="512000" />'.PHP_EOL;
		echo '<input type="file" name="cimg" size="50" /><br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_DESCRIPTION.'</span>:<br />'.PHP_EOL;
        echo '<textarea cols="50" rows="10" name="description">'.$description.'</textarea><br /><br />'.PHP_EOL;
        echo '<input type="hidden" name="cid" value="'.$cid.'" />'.PHP_EOL;
        echo '<input type="hidden" name="op" value="CPSaveCat" />'.PHP_EOL;
		echo '<input type="submit" value="'._CP_SAVECHANGES.'" />&nbsp;&nbsp;'.PHP_EOL;
		echo '[ <a class="rn_csrf" href="'.$admin_file.'.php?op=CPDeleteCat&amp;cid='.$cid.'">'._CP_DELETE.'</a> ]'.PHP_EOL;
        echo '</form>';
		CloseTable();
    }
    include('footer.php');
}

function CPSaveCat() {
global $prefix, $db, $admin_file, $module_name;

    $cid = intval($_POST['cid']);
    $cat_title = real_escape_content(check_html($_POST['cat_title'], 'nohtml'));
    $input_cimg = real_escape_content(check_html($_POST['input_cimg'], 'nohtml'));
    $description = real_escape_content(check_html($_POST['description'], ''));
    $cp_maxfilesize=512000;
	define('CP_UPLOADDIR', 'modules/'.$module_name.'/images/categories/'); // This dir must have permission to write on it (chmod 666 or 777)

    if (is_uploaded_file($_FILES['cimg']['tmp_name'])) {
    	$cp_filename = $_FILES['cimg']['name'];
		$cp_filetype = $_FILES['cimg']['type'];
		$cp_filesize = $_FILES['cimg']['size'];
		$cp_filerror = $_FILES['cimg']['error'];
		$cp_filetemp = $_FILES['cimg']['tmp_name'];
		$cp_filemove = time() .'_'. $cp_filename;

		if ((($cp_filetype == 'image/gif') || ($cp_filetype == 'image/jpeg') || ($cp_filetype == 'image/pjpeg') || ($cp_filetype == 'image/png')) && ($cp_filesize < $cp_maxfilesize)) {
			if ($cp_filerror > 0) {define('CP_UPLOAD_ERR', _CP_ERRORUPLOAD);}
			elseif (file_exists(CP_UPLOADDIR . $cp_filemove)) {define('CP_UPLOAD_ERR', _CP_ERRORFILEEXIST);}
  			elseif (!move_uploaded_file($cp_filetemp, CP_UPLOADDIR . $cp_filemove)) {define('CP_UPLOAD_ERR', _CP_ERRORMOVE);}
  		} else {
  			define('CP_UPLOAD_ERR', _CP_ERRORTYPE);
  		}
	}

	if (isset($cp_filetemp) && !defined('CP_UPLOAD_ERR')) {
    	$db->sql_query('UPDATE '.$prefix.'_pages_categories SET cimg=\''.$cp_filemove.'\', title=\''.$cat_title.'\', description=\''.$description.'\' WHERE cid='.$cid.'');
		header('Location: '.$admin_file.'.php?op=ContentPlus');
	} elseif (!empty($input_cimg) && !isset($cp_filetemp)) {
		$db->sql_query('UPDATE '.$prefix.'_pages_categories SET cimg=\''.$input_cimg.'\', title=\''.$cat_title.'\', description=\''.$description.'\' WHERE cid='.$cid.'');
		header('Location: '.$admin_file.'.php?op=ContentPlus');
	} else {
		include('header.php');
		OpenTable();
		echo '<div class="text-center">'.CP_UPLOAD_ERR.'<br /><br />';
		echo _CP_GOBACK.'</div><br /><br />';
		CloseTable();
		include('footer.php');
	}
}

function CPDeleteCat($cid, $ok=0) {
    global $prefix, $db, $admin_file;
    if ($ok==1) {
        $cid = intval($cid);
        $db->sql_query('DELETE from '.$prefix.'_pages_categories WHERE cid='.$cid.'');
		$result = $db->sql_query('SELECT pid from '.$prefix.'_pages WHERE cid='.$cid.'');
		while ($row = $db->sql_fetchrow($result)) {
			$pid = intval($row['pid']);
			$db->sql_query('UPDATE '.$prefix.'_pages set cid=\'0\' WHERE pid='.$pid.'');
		}
        header('Location: '.$admin_file.'.php?op=ContentPlus');
    } else {
        include('header.php');
        CPAdminMenu();
		title(_CP_CONTENTMANAGER);
        $cid = intval($cid);
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_pages_categories where cid='.$cid.''));
		$title = stripslashes(check_html($row2['title'], ''));
        OpenTable();
		echo '<div style="text-align: center;"><span style="font-weight: bold;">'._CP_DELCATEGORY.': '.$title.'</span><br /><br />'.PHP_EOL;
		echo _CP_DELCONTENTCAT.'<br /><br />'.PHP_EOL;
		echo '[ <a href="'.$admin_file.'.php?op=ContentPlus">'._CP_NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=CPDeleteCat&amp;cid='.$cid.'&amp;ok=1">'._CP_YES.'</a> ]</div>'.PHP_EOL;
        CloseTable();
        include('footer.php');
    }
}

function CPEdit($pid) {
	global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	if(!isset($pid)) {
		//OpenTable();
		echo '<form action="'.$admin_file.'.php">'.PHP_EOL;
		echo ''._CP_PAGEID.':<br /><br />'.PHP_EOL;
		echo '<input type="text" name="pid">&nbsp;'.PHP_EOL;
		echo '<input type="hidden" name="op" value="CPEdit">'.PHP_EOL;
		echo '<input type="submit" value="'._CP_CEDIT.'">'.PHP_EOL;
		echo '</form>'.PHP_EOL;
		//CloseTable();
	} else {
		title(_CP_CONTENTMANAGER);
		$pid = intval($pid);
		$mypages = $db->sql_fetchrow($db->sql_query('SELECT * from '.$prefix.'_pages WHERE pid='.$pid.''));
		$mycid = intval($mypages['cid']);
		$myactive = intval($mypages['active']);
		$mytitle = stripslashes(check_html($mypages['title'], 'nohtml'));
		$mysubtitle = stripslashes(check_html($mypages['subtitle'], 'nohtml'));
		$mytags = stripslashes(check_html($mypages['tags'], 'nohtml'));
		$mypage_header = stripslashes($mypages['page_header']);
		$mytext = stripslashes($mypages['text']);
		$mypage_footer = stripslashes($mypages['page_footer']);
		$mysignature = stripslashes($mypages['signature']);
		$myclanguage = stripslashes(check_html($mypages['clanguage'], 'nohtml'));
		if ($myactive == 1) {
			$sel1 = 'checked="checked"';
			$sel2 = '';
		} else {
			$sel1 = '';
			$sel2 = 'checked="checked"';
		}
		//OpenTable();
		echo '<div style="text-align: center;"><span style="font-weight: bold;">'._CP_EDITPAGECONTENT.'</span></div><br /><br />'.PHP_EOL;
		echo '<form action="'.$admin_file.'.php" method="post">'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_TITLE.':</span><br />'.PHP_EOL;
		echo '<input type="text" name="title" size="50" value="'.$mytitle.'" /><br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_CSUBTITLE.':</span><br />'.PHP_EOL;
		echo '<input type="text" name="subtitle" size="50" value="'.$mysubtitle.'" /><br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_TAGS.':</span><br />'.PHP_EOL;
		echo '<input type="text" name="tags" size="50" value="'.$mytags.'" /><br /><br />'.PHP_EOL;
		$res = $db->sql_query('SELECT cid, title from '.$prefix.'_pages_categories');
		$numrows = $db->sql_numrows($res);
		if ($numrows > 0) {
			echo '<span style="font-weight: bold;">'._CP_CATEGORY.':</span>&nbsp;&nbsp;'.PHP_EOL;
			echo '<select name="cid">'.PHP_EOL;
			if ($mycid == 0) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option value="0" '.$sel.'>'._CP_NONE.'</option>'.PHP_EOL;
			while ($row_res = $db->sql_fetchrow($res)) {
				$cid = intval($row_res['cid']);
				$cat_title = $row_res['title'];
				if ($mycid == $cid) {
					$sel = 'selected="selected"';
				} else {
					$sel = '';
				}
				echo '<option value="'.$cid.'" '.$sel.'>'.$cat_title.'</option>'.PHP_EOL;
			}
			echo '</select><br /><br />'.PHP_EOL;
		} else {
			echo '<input type="hidden" name="cid" value="0">'.PHP_EOL;
		}
		echo '<span style="font-weight: bold;">'._CP_HEADERTEXT.':</span><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('page_header', $mypage_header, 'PHPNukeAdmin', '100', '15');
		} else {
			echo '<textarea name="page_header" cols="100" rows="15">'.$mypage_header.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_PAGETEXT.':</span><br />'.PHP_EOL;
		echo '<span class="tiny">'._CP_PAGEBREAK.'</span><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('text', $mytext, 'PHPNukeAdmin', '100', '20');
		} else {
			echo '<textarea name="text" cols="100" rows="20">'.$mytext.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_FOOTERTEXT.':</span><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('page_footer', $mypage_footer, 'PHPNukeAdmin', '100', '15');
		} else {
			echo '<textarea name="page_footer" cols="100" rows="15">'.$mypage_footer.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<span style="font-weight: bold;">'._CP_SIGNATURE.':</span><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('signature', $mysignature, 'PHPNukeAdmin', '100', '15');
		} else {
			echo '<textarea name="signature" cols="100" rows="15">'.$mysignature.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		if ($multilingual == 1) {
			echo '<br /><span style="font-weight: bold;">' . _CP_LANGUAGE . ': </span>' . PHP_EOL
				. lang_select_list('clanguage', $myclanguage, false) . PHP_EOL
				. '<br /><br />' . PHP_EOL;
		} else {
			echo '<input type="hidden" name="clanguage" value="'.$myclanguage.'">';
		}
		echo '<span style="font-weight: bold;">'._CP_ACTIVATEPAGE.'</span><br />'.PHP_EOL;
		echo '<input type="radio" name="active" value="1" '.$sel1.' />&nbsp;'._CP_YES.'&nbsp;&nbsp;<input type="radio" name="active" value="0" '.$sel2.' />&nbsp;'._CP_NO.'<br /><br />'.PHP_EOL;
		echo '<input type="hidden" name="pid" value="'.$pid.'" />'.PHP_EOL;
		echo '<input type="hidden" name="op" value="CPSaveEdit" />'.PHP_EOL;
		echo '<input type="submit" value="'._CP_SAVECHANGES.'" />'.PHP_EOL;
		echo '</form>';
	}
	CloseTable();
	include('footer.php');
}

function CPSave() {
global $prefix, $db, $admin_file;
    $title = real_escape_content(check_html($_POST['title'], 'nohtml'));
    $subtitle = real_escape_content(check_html($_POST['subtitle'], 'nohtml'));
    $tags = real_escape_content(check_html($_POST['tags'], 'nohtml'));
    $page_header = real_escape_content($_POST['page_header']);
    $text = real_escape_content($_POST['text']);
    $page_footer = real_escape_content($_POST['page_footer']);
    $signature = real_escape_content($_POST['signature']);
    $clanguage = real_escape_content(check_html($_POST['clanguage'], 'nohtml'));
    $active = intval($_POST['active']);
    $cid = intval($_POST['cid']);
    $uname = real_escape_content(check_html($_POST['uname'], 'nohtml'));

    $error=0;
    if(empty($title) || empty($text)) {
		$error=1;
    }
    include('header.php');
    CPAdminMenu();
    Opentable();
    echo '<div style="text-align: center;">';
    if ($error) {
		echo '<span style="font-weight: bold;">'._CP_ERROR.'</span>: '._CP_CPADDERROR.'<br /><br />'.PHP_EOL;
		echo ''._CP_GOBACK.'<br />'.PHP_EOL;
    } else {
        $result = $db->sql_query('INSERT INTO '.$prefix.'_pages VALUES (NULL, \''.$cid.'\', \''.$title.'\', \''.$subtitle.'\', \''.$tags.'\', \''.$active.'\', \''.$page_header.'\', \''.$text.'\', \''.$page_footer.'\', \''.$signature.'\', now(), \'0\', \''.$clanguage.'\', \''.$uname.'\')');
		echo ''._CP_CPSAVESUCCESS.'';
		header('Refresh: 4, '.$admin_file.'.php?op=ContentPlus');
    }
    echo '</div>';
    CloseTable();
    include('footer.php');
}

function CPSaveEdit() {
global $prefix, $db, $admin_file;
	$pid = intval($_POST['pid']);
	$title = real_escape_content(check_html($_POST['title'], 'nohtml'));
    $subtitle = real_escape_content(check_html($_POST['subtitle'], 'nohtml'));
    $tags = real_escape_content(check_html($_POST['tags'], 'nohtml'));
    $page_header = real_escape_content($_POST['page_header']);
    $text = real_escape_content($_POST['text']);
    $page_footer = real_escape_content($_POST['page_footer']);
    $signature = real_escape_content($_POST['signature']);
    $clanguage = real_escape_content(check_html($_POST['clanguage'], 'nohtml'));
    $active = intval($_POST['active']);
    $cid = intval($_POST['cid']);
    //$uname = stripslashes(FixQuotes(check_html($_POST['uname'], 'nohtml')));

    $db->sql_query('UPDATE '.$prefix.'_pages SET cid=\''.$cid.'\', title=\''.$title.'\', subtitle=\''.$subtitle.'\', tags=\''.$tags.'\', active=\''.$active.'\', page_header=\''.$page_header.'\', text=\''.$text.'\', page_footer=\''.$page_footer.'\', signature=\''.$signature.'\', clanguage=\''.$clanguage.'\' WHERE pid='.$pid.'');
    header('Location: '.$admin_file.'.php?op=ContentPlus');
}

function CPChangeStatus($pid, $active) {
    global $prefix, $db, $admin_file;
    if ($active == 1) {
        $new_active = 0;
    } elseif ($active == 0) {
        $new_active = 1;
    }
    $pid = intval($pid);
    $db->sql_query('update '.$prefix.'_pages set active=\''.$new_active.'\' WHERE pid='.$pid.'');
    header('Location: '.$admin_file.'.php?op=ContentPlus');
}

function CPNewPageChangeStatus() {
global $user_prefix, $prefix, $db, $admin_file;
	$pid = intval($_POST['pid']);
	$cid = intval($_POST['cid']);
    $title = real_escape_content(check_html($_POST['title'], 'nohtml'));
    $subtitle = real_escape_content(check_html($_POST['subtitle'], 'nohtml'));
    $tags = real_escape_content(check_html($_POST['tags'], 'nohtml'));
    $page_header = real_escape_content(check_html($_POST['page_header']));
    $text = real_escape_content(check_html($_POST['text']));
    $page_footer = real_escape_content(check_html($_POST['page_footer']));
    $signature = real_escape_content(check_html($_POST['signature']));
    $clanguage = real_escape_content(check_html($_POST['clanguage'], 'nohtml'));
    $uname = real_escape_content(check_html($_POST['uname'], 'nohtml'));
    $date = real_escape_content(check_html($_POST['date'], 'nohtml'));

    $db->sql_query('INSERT INTO '.$prefix.'_pages VALUES (NULL, \''.$cid.'\', \''.$title.'\', \''.$subtitle.'\', \''.$tags.'\', \'1\', \''.$page_header.'\', \''.$text.'\', \''.$page_footer.'\', \''.$signature.'\', \''.$date.'\', \'0\', \''.$clanguage.'\', \''.$uname.'\')');
    //$row = $db->sql_fetchrow($db->sql_query('SELECT points FROM '.$prefix.'_groups_points WHERE id=\'23\''));
    //$db->sql_query('UPDATE '.$user_prefix.'_users SET points=points+'.$row['points'].' WHERE username=\''.$uname.'\' && user_id != \'1\'');
    $db->sql_query('DELETE FROM '.$prefix.'_newpages WHERE pid='.$pid.'');
    header('Location: '.$admin_file.'.php?op=ContentPlus');
}

function CPDelete($pid, $ok=0) {
    global $prefix, $db, $admin_file;
    $pid = intval($pid);
    if ($ok==1) {
        $db->sql_query('DELETE FROM '.$prefix.'_pages WHERE pid='.$pid.'');
        header('Location: '.$admin_file.'.php?op=ContentPlus');
    } else {
        include('header.php');
        CPAdminMenu();
		title(_CP_CONTENTMANAGER);
		$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_pages WHERE pid='.$pid.''));
		$title = $row['title'];
        OpenTable();
		echo '<div style="text-align: center;"><span class="thick">'._CP_DELCONTENT.': '.$title.'</span><br /><br />'
	    .''._CP_DELCONTWARNING.' '.$title.'?<br /><br />'
	    .'[ <a href="'.$admin_file.'.php?op=ContentPlus">'._CP_NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'&amp;ok=1">'._CP_YES.'</a> ]</div>';
        CloseTable();
        include('footer.php');
    }
}

function CPNewPageDelete($pid, $ok=0) {
    global $prefix, $db, $admin_file;
    $pid = intval($pid);
    if ($ok==1) {
        $db->sql_query('DELETE FROM '.$prefix.'_newpages WHERE pid='.$pid.'');
        header('Location: '.$admin_file.'.php?op=ContentPlus');
    } else {
        include('header.php');
        CPAdminMenu();
		title(_CP_CONTENTMANAGER);
		$row = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_newpages WHERE pid='.$pid.''));
		$title = $row['title'];
        OpenTable();
		echo '<div style="text-align: center;"><span style="font-weight: bold;">'._CP_DELCONTENT.': '.$title.'</span><br /><br />'
	    ._CP_DELCONTWARNING.' '.$title.'?<br /><br />'
	    .'[ <a href="'.$admin_file.'.php?op=ContentPlus">'._CP_NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=CPNewPageDelete&amp;pid='.$pid.'&amp;ok=1">'._CP_YES.'</a> ]</div>';
        CloseTable();
        include('footer.php');
    }
}

function CPFeat() {
global $db, $prefix, $admin_file, $bgcolor4, $ver;
	include('header.php');
	CPAdminMenu();
	OpenTable();
	echo '<div class="title" style="text-align: center; width:100%;">Content Plus '.$ver.': '._CP_CPFEAT.'</div>'.PHP_EOL;
	echo '<div style="text-align: center;"><span style="font-weight: bold;">'._CP_CPSELECTFEAT.'</span></div><br />'.PHP_EOL;
	echo '<form action="'.$admin_file.'.php" method="post">'.PHP_EOL;
	$result = $db->sql_query('SELECT cid, title FROM '.$prefix.'_pages_categories');
	while(list($cid, $ctitle)=$db->sql_fetchrow($result)) {
		echo '<p><label for="cpfeat_cat'.$cid.'" style="display: block; width: 25em; float: left;">'.$ctitle.'</label>';
		echo '	<select id="cpfeat_cat'.$cid.'" name="cpfeat_cat'.$cid.'" style="display: inline;">'.PHP_EOL;
		echo '		<option value="NULL">'._CP_DEACTIVATE.'</option>'.PHP_EOL;
		$result2 = $db->sql_query('SELECT pid, title FROM '.$prefix.'_pages WHERE cid='.$cid.' ORDER BY title ASC');
		while(list($pid, $title)=$db->sql_fetchrow($result2)) {
			echo '		<option value="'.$pid.'"';
			$result3 = $db->sql_query('SELECT pid FROM '.$prefix.'_pages_feat WHERE cid='.$cid.'');
			while(list($sel)=$db->sql_fetchrow($result3)) {
				if($pid==$sel) {echo ' selected="selected"';}
			}
			echo '>'.$title.'</option>'.PHP_EOL;
		}
		echo '	</select></p>'.PHP_EOL;
	}
	echo '<br />';
	echo '	<input type="hidden" name="op" value="CPFeatSave" />'.PHP_EOL;
	echo '	<div class="text-center"><input type="submit" value="'._CP_SAVE.'" /></div>'.PHP_EOL;
	echo '</form>'.PHP_EOL;
	CloseTable();
	include('footer.php');
}

function CPFeatSave() {
global $admin_file, $db, $prefix;
	$result=$db->sql_query('TRUNCATE TABLE '.$prefix.'_pages_feat');
	$result=$db->sql_query('SELECT cid FROM '.$prefix.'_pages_categories');
	while(list($cid)=$db->sql_fetchrow($result)) {
		$cpfeat = $_POST['cpfeat_cat'.$cid];
		$result3=$db->sql_query('INSERT INTO '.$prefix.'_pages_feat (cid, pid) VALUES ('.$cid.', '.$cpfeat.')');
	}
	header('Location: '.$admin_file.'.php?op=CPFeat');
}

function CPAbout() {
global $ver, $module_name;
include('header.php');
OpenTable();
echo '<p style="text-align: center;"><img src="modules/'.$module_name.'/images/clogo.png" alt="" /><br /><br />
<span class="thick">Content Plus '.$ver.'</span><br />
&copy; 2004 - 2009 by Jonathan Estrella &amp; Contributors<br />
<a href="http://slaytanic.sourceforge.net">http://slaytanic.sourceforge.net</a><br />
</p>
<p>This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or (at your option) any later version.</p>
<p>This program is distributed in the hope that it will be useful, but <em>WITHOUT ANY WARRANTY</em>; without even the implied warranty of
<em>MERCHANTABILITY</em> or <em>FITNESS FOR A PARTICULAR PURPOSE</em>. See the <a href="http://www.gnu.org/licenses/gpl.html" target="new"><span class="thick">GNU General Public License</span></a> for more details.</p>

<p>Special thanks to the following people/entities for their great and valuable input and support. Thank you for helping this happen...</p>

<p>* <span class="thick">Francisco Burzi</span>: Creator of the original module &amp; former PHP-Nuke developer (<a href="http://www.phpnuke.org">www.phpnuke.org</a>)<br />
* <span class="thick">Chatserv</span>: Creator of the Chatserv Content Hack for PHP-Nuke 7.5 (<a href="http://www.nukeresources.com">www.nukeresources.com</a>)<br />
* <span class="thick">Silvestre</span>: Designer of old icons (<a href="http://www.silvestre.com.ar">www.silvestre.com.ar</a>)<br />
* <span class="thick">Trubador</span>: Bugfixing (<a href="http://yrf.org.uk">http://yrf.org.uk</a>)<br />
* <span class="thick">THoTH</span>: Bugfixing and brainstorming (<a href="http://www.book-of-thoth.com">http://www.book-of-thoth.com</a>)<br />
* <span class="thick">Vecchio Joe</span>: Heavy testing, bugfixing, brainstorming and italian translation (<a href="http://vecchiojoe.it">http://vecchiojoe.it</a>)<br />
* <span class="thick">GANYANCI</span>: Heavy testing, bugfixing and turkish translation (<a href="http://alberbalci.com">http://alperbalci.com</a>)<br />
* <span class="thick">Function Design &amp; Development Studio</span>: Creators of the new icon theme (<a href="http://www.wefunction.com">http://www.wefunction.com</a>)<br />
* <span class="thick">RavenNuke Team</span>: For including the module as part of your distro and for your feedback and bug reporting/fixing (<a href="http://www.ravenphpscripts.com">www.ravenphpscripts.com</a>)<br />
* <span class="thick">All Nukers around the world</span>: you are who made this possible</p>
<p style="text-align: center;"><span class="thick">'._CP_GOBACK.'</span></p>';
CloseTable();
include('footer.php');
}

function CPShowCatImages() {
global $db, $prefix, $module_name, $ThemeSel, $ver;
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'.PHP_EOL;
	echo ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
	echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'.PHP_EOL;
	echo '<head>'.PHP_EOL;
	echo '<title>Content Plus '.$ver.': '._CP_SHOWCATIMAGES.'</title>'.PHP_EOL;
	echo '<link rel="StyleSheet" href="themes/'.$ThemeSel.'/style/style.css" type="text/css" />'.PHP_EOL;
	echo '</head>'.PHP_EOL;
	echo '<body>'.PHP_EOL;
	OpenTable();
	echo '<script type="text/javascript" language="javascript">'.PHP_EOL;
	echo '<!--'.PHP_EOL;
	echo '	function InsertImage(code) {'.PHP_EOL;
	echo '		this.code = code;'.PHP_EOL;
	echo '		opener.document.forms["cpaddcat"].input_cimg.value = code;'.PHP_EOL;
	echo '		opener.document.forms["cpaddcat"].input_cimg.focus();'.PHP_EOL;
	echo '	}'.PHP_EOL;
	echo '//-->'.PHP_EOL;
	echo '</script>'.PHP_EOL;

	$handle = opendir('modules/'.$module_name.'/images/categories');
	while (false !== ($file = readdir($handle))) {
		if (preg_match('/([0-9_a-z])*(?i).(gif|jpg|png)(?i)/', $file, $number)) {
			echo '<a href="#" onclick="InsertImage(\''.$file.'\'); javascript:window.close();">';
			echo '<img src="modules/'.$module_name.'/images/categories/'.$file.'" alt="'.$file.'" title="'.$file.'" style="width: 48px; margin: 2em; border: 0;" />';
			echo '</a>'.PHP_EOL;
		}
	}
	echo '<br /><br />'.PHP_EOL;
	echo '<div class="text-center">[ <a href="javascript:window.close();"><span class="thick">'._CP_CLOSEWINDOW.'</span></a> ]</div>'.PHP_EOL;
	CloseTable();
	echo '</body>'.PHP_EOL;
	echo '</html>'.PHP_EOL;
}

if (isset($_GET['op'])) {$op = $_GET['op'];} elseif (isset($_POST['op'])) {$op = $_POST['op'];} else {$op = 'ContentPlus';}
if (isset($_GET['ok'])) {$ok = $_GET['ok'];} elseif (isset($_POST['ok'])) {$ok = $_POST['ok'];} else {$ok = 0;}

switch ($op) {
	case 'ContentPlus': CPAdmin(); break;
	case 'CPListPages': CPListPages(); break;
	case 'CPListCats': CPListCats(); break;
	case 'CPListPagesCat': CPListPagesCat($cid); break;
	case 'CPAddCategory': CPAddCategory(); break;
	case 'CPAddPage': CPAddPage(); break;
	case 'CPPagesWaiting': CPPagesWaiting(); break;
	case 'CPEdit': CPEdit($pid); break;
	case 'CPDelete': csrf_check(); CPDelete($pid, $ok); break;
	case 'CPNewPageDelete': csrf_check(); CPNewPageDelete($pid, $ok); break;
	case 'content_review': content_review($title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active); break;
	case 'CPSave': csrf_check(); CPSave(); break;
	case 'CPSaveEdit': csrf_check(); CPSaveEdit(); break;
	case 'CPChangeStatus': csrf_check(); CPChangeStatus($pid, $active); break;
	case 'CPNewPageChangeStatus': csrf_check(); CPNewPageChangeStatus(); break;
	case 'CPCategoryAddSave': csrf_check(); CPCategoryAddSave(); break;
	case 'CPAddNewPage': CPAddNewPage($pid); break;
	case 'CPEditCat': CPEditCat($cid); break;
	case 'CPSaveCat': csrf_check(); CPSaveCat(); break;
	case 'CPDeleteCat': csrf_check(); CPDeleteCat($cid, $ok); break;
	case 'CPFeat': CPFeat(); break;
	case 'CPFeatSave': csrf_check(); CPFeatSave(); break;
	case 'CPAbout': CPAbout(); break;
	case 'content': CPAdmin(); break;
	case 'CPShowCatImages': CPShowCatImages(); break;
}

} else {
	include('header.php');
	OpenTable();
	echo '<div class="text-center"><span class="thick">'._CP_ERROR.'</span><br /><br />You do not have administration permissions for module "'.$module_name.'"!</div>';
	CloseTable();
	include('footer.php');
}
?>