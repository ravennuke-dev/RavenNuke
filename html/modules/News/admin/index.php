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
/************************************************************************/
//########################################################################
//
// nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
// kses developed by Ulf Harnhammar              http://kses.sf.net
// kses ideas contributed by sixonetonoffun      http://netflake.com
// FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
// Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
//
//########################################################################

if ( !defined('ADMIN_FILE') ) {
	die ('Access Denied');
}

// global $prefix, $db, $admin_file;
$module_name = basename(dirname(dirname(__FILE__)));
$radminsuper = false;  // tried to dispense with this variable but it is just simpler to have it here once at the top
// than to be running is_mod_admin in a bunch of functions
if (is_mod_admin('admin')) {
	$radminsuper = true;
}
if ($radminsuper || is_mod_admin($module_name)) {
		if (!isset($sid)) $sid = '';
		if (!isset($ok)) $ok = '';
		if (!isset($op)) $op = '';
		if (!isset($cat)) $cat = '';
		if (!isset($catid)) $catid = '';
		if (!isset($newcat)) $newcat = '';
		if (!isset($ctitle)) $ctitle = '';
		if (!isset($alanguage)) $alanguage = '';
		if (!isset($qid)) $qid = '';
		if (!isset($pollTitle)) $pollTitle = '';
		if (!isset($optionText)) $optionText = '';
		if (!isset($assotop)) { $assotop = ''; }
		switch($op) {

		case 'EditCategory':
			EditCategory($catid);
			break;

		case 'subdelete':
			csrf_check();
			subdelete();
			break;

		case 'DelCategory':
			DelCategory($cat);
			break;

		case 'YesDelCategory':
			csrf_check();
			YesDelCategory($catid);
			break;

		case 'NoMoveCategory':
			NoMoveCategory($catid, $newcat);
			break;

		case 'SaveEditCategory':
			csrf_check();
			SaveEditCategory($catid, $ctitle);
			break;

		case 'SelectCategory':
			SelectCategory($cat);
			break;

		case 'AddCategory':
			AddCategory();
			break;

		case 'SaveCategory':
			csrf_check();
			SaveCategory($ctitle);
			break;

		case 'DisplayStory':
			displayStory($qid);
			break;

		case 'PreviewAgain':
			previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $tags, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'PostStory':
			csrf_check();
			postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $tags, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'EditStory':
			editStory($sid);
			break;

		case 'RemoveStory':
			removeStory($sid, $ok);
			break;

		case 'ChangeStory':
			csrf_check();
			changeStory($sid, $subject, $hometext, $bodytext, $tags, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop);
			break;

		case 'DeleteStory':
			csrf_check();
			deleteStory($qid);
			break;

		case 'adminStory':
			adminStory($sid);
			break;

		case 'PreviewAdminStory':
			previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $notes, $tags, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'PostAdminStory':
			csrf_check();
			postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $notes, $tags, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'autoDelete':
			csrf_check();
			autodelete($anid);
			break;

		case 'autoEdit':
			autoEdit($anid);
			break;

		case 'autoSaveEdit':
			csrf_check();
			autoSaveEdit($anid, $year, $day, $month, $hour, $min, $story_title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm);
			break;

		case 'submissions':
			submissions();
			break;

		case 'newsedit':
			newsedit();
			break;

		case 'tonSave':
			csrf_check();
			tonSave ($xnewsrows, $xbookmark, $xrblocks, $xlinklocation, $xarticlelink, $xartview, $xTON_useTitleLink, $xTON_usePDF, $xTON_useRating, $xTON_useSendToFriend, $xshowtags, $xTON_useCharLimit, $xTON_CharLimit, $xtopadact, $xtopad, $xbottomadact, $xbottomad, $xusedisqus, $xshortname, $xgooglapi, $xusegooglsb, $xusegooglart);
			break;
		}
	} else {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center"><span class="thick">'._ERROR.'</span><br /><br />You do not have administration permission for module \''.$module_name.'\'</div>';
		CloseTable();
		include_once 'footer.php';
}
die();

/*********************************************************/
/* Story/News Functions                                  */
/*********************************************************/

function puthome($ihome, $acomm) {
	echo '<br /><span class="thick">'._PUBLISHINHOME.'</span>&nbsp;&nbsp;';
	if (($ihome == 0) OR (empty($ihome))) {
		$sel1 = 'checked="checked"';
		$sel2 = '';
	}
	if ($ihome == 1) {
		$sel1 = '';
		$sel2 = 'checked="checked"';
	}
	echo '<input type="radio" name="ihome" value="0" '.$sel1.' />'._YES.'&nbsp;'
		.'<input type="radio" name="ihome" value="1" '.$sel2.' />'._NO
		.'&nbsp;&nbsp;<span class="content">[ '._ONLYIFCATSELECTED.' ]</span><br />';

	echo '<br /><span class="thick">'._ACTIVATECOMMENTS.'</span>&nbsp;&nbsp;';
	if (($acomm == 0) OR (empty($acomm))) {
		$sel1 = 'checked="checked"';
		$sel2 = '';
	}
	if ($acomm == 1) {
		$sel1 = '';
		$sel2 = 'checked="checked"';
	}
	echo '<input type="radio" name="acomm" value="0" '.$sel1.' />'._YES.'&nbsp;'
	.'<input type="radio" name="acomm" value="1" '.$sel2.' />'._NO.'<br /><br />';
}

function deleteStory($qid) {
	global $prefix, $db, $admin_file;
	$result = $db->sql_query('delete from '.$prefix.'_queue where qid=\''.$qid.'\'');
	if (!$result) {
		return;
		die();
	}
	$result = $db->sql_query('SELECT qid FROM '.$prefix.'_queue');
	if ($db->sql_numrows($result) == 0) {
		 Header('Location: '.$admin_file.'.php?op=adminMain');
		}
		else {
		Header('Location: '.$admin_file.'.php?op=submissions');
		}
}

function SelectCategory($cat) {
	global $prefix, $db, $admin_file;
	$sel = '';
	$selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat order by title');
	echo '<span class="thick">'._CATEGORY.'</span> ';
	echo '<select name="catid">';
	if ($cat == 0 OR empty($cat)) {
		echo '<option value="0" selected="selected">'._ARTICLES.'</option>';
	}
	else {
		echo '<option value="0">'._ARTICLES.'</option>';
	}
	while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
		if ($catid == $cat) {
			$sel = 'selected="selected"';
		}
		else {
			$sel = '';
		}
		echo '<option value="'.$catid.'"'. $sel.'>'.$ctitle.'</option>';
	}
	echo '</select> [ <a href="'.$admin_file.'.php?op=AddCategory">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=EditCategory">'
		._EDIT.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=DelCategory&amp;cat='.$catid.'">'._DELETE.'</a> ]';
	}

function putpoll($pollTitle, $optionText) {
	//OpenTable();
	echo '<div class="text-center"><span class="title">'._ATTACHAPOLL.'<br /><br /></span>'
		.'<span class="tiny">'._LEAVEBLANKTONOTATTACH
		.'<br /><br />'._POLLTITLE.': <input type="text" name="pollTitle" size="50" maxlength="100" value="'.$pollTitle.'" /><br /><br /></span>'
		.'<span class="content">'._POLLEACHFIELD.'</span>'
		.'<ul>';
	if (!is_array($optionText)) $optionText = array();
	 for($i = 1; $i <= 12; $i++) {
		if (!isset($optionText[$i])) { $optionText[$i] = ''; }
		echo '<li style="list-style:none">'._OPTION.' '.$i.': <input type="text" name="optionText['.$i.']" size="50" maxlength="50" value="'.$optionText[$i].'" /></li>';
	}
	echo '</ul></div>';
	//CloseTable();
}

function AddCategory () {
	global $admin_file;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._CATEGORIESADMIN.'<br /><br />';
	echo '<div class="option"><span class="thick">'._CATEGORYADD.'</span><br /><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<span class="thick">'._CATNAME.': </span>'
		.'<input type="text" name="ctitle" size="22" maxlength="20" /> '
		.'<input type="hidden" name="op" value="SaveCategory" />'
		.'<input type="submit" value="'._SAVE.'" />'
		.'</form></div></div>';
	CloseTable();
	include_once 'footer.php';
}

function EditCategory($catid) {
	global $prefix, $db, $admin_file;
	$catid = intval($catid);
	$result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
	list($ctitle) = $db->sql_fetchrow($result);
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._CATEGORIESADMIN.'<br /><br />';
	echo '<div class="option"><span class="thick">'._EDITCATEGORY.'</span><br />';
	if ($catid==0) {
		$selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat WHERE catid>0');
		echo '<form action="'.$admin_file.'.php" method="post">';
		echo '<span class="thick">'._ASELECTCATEGORY.' </span>';
		echo '<select name="catid">';
		while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
			echo '<option value="'.$catid.'">'.$ctitle.'</option>';
		}
		echo '</select>';
		echo '<input type="hidden" name="op" value="EditCategory" />';
		echo '<input type="submit" value="'._EDIT.'" /><br /><br />';
		echo '<span class="option">('._NOARTCATEDIT.')</span>';
	} else {
		echo '<form action="'.$admin_file.'.php" method="post">';
		echo '<span class="title">'._CATEGORYNAME.':</span> ';
		echo '<input type="text" name="ctitle" size="22" maxlength="20" value="'.$ctitle.'" /> ';
		echo '<input type="hidden" name="catid" value="'.$catid.'" />';
		echo '<input type="hidden" name="op" value="SaveEditCategory" />';
		echo '<input type="submit" value="'._SAVECHANGES.'" /><br /><br />';
		echo '<span class="option">('._NOARTCATEDIT.')</span>';
	}
	echo '</form>';
	echo '</div></div>';
	CloseTable();
	include_once 'footer.php';
}

function DelCategory($cat) {
	global $prefix, $db, $admin_file;
	$result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$cat.'\'');
	list($ctitle) = $db->sql_fetchrow($result);
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="title">'._CATEGORIESADMIN.'</span>';
	echo '<br /><br />';
	echo '<span class="option thick">'._DELETECATEGORY.'</span><br /><br />';
	if (!$cat) {
		$selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat');
		echo '<form action="'.$admin_file.'.php" method="post">'
				.'<span class="thick">'._SELECTCATDEL.': </span>'
				.'<select name="cat">';
		while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
				echo '<option value="'.$catid.'">'.$ctitle.'</option>';
		}
		echo '</select>'
				.'<input type="hidden" name="op" value="DelCategory" />'
				.'<input type="submit" value="Delete" />'
				.'</form>';
	} else {
		csrf_check();
		$result2 = $db->sql_query('select * from '.$prefix.'_stories where catid=\''.$cat.'\'');
		$numrows = $db->sql_numrows($result2);
		if ($numrows == 0) {
			$db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$cat.'\'');
				echo '<br /><br />'._CATDELETED.'<br /><br />'.'[ <a href="'.$admin_file.'.php?op=adminStory">'._GOTOADMIN.'</a> ]';
		} else {
				echo '<br /><br /><span class="thick">'._WARNING.':</span> '._THECATEGORY.' <span class="thick">'.$ctitle.'</span> '._HAS.' <span class="thick">'.$numrows.'</span> '._STORIESINSIDE.'<br />'
					._DELCATWARNING1.'<br />'
					._DELCATWARNING2.'<br /><br />'
					._DELCATWARNING3.'<br /><br />'
					.'<span class="thick">[ <a class="rn_csrf" href="'.$admin_file.'.php?op=YesDelCategory&amp;catid='.$cat.'">'._YESDEL.'</a> | '
					.'<a href="'.$admin_file.'.php?op=NoMoveCategory&amp;catid='.$cat.'">'._NOMOVE.'</a> ]</span>';
		}
	}
	echo '</div>';
	CloseTable();
	include_once 'footer.php';
}

function YesDelCategory($catid) {
	global $prefix, $db, $admin_file;
	$db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
	$result = $db->sql_query('select sid from '.$prefix.'_stories where catid=\''.$catid.'\'');
	while(list($sid) = $db->sql_fetchrow($result)) {
		$db->sql_query('delete from '.$prefix.'_stories where catid=\''.$catid.'\'');
		$db->sql_query('delete from '.$prefix.'_comments where sid=\''.$sid.'\'');
	}
	Header('Location: '.$admin_file.'.php');
}

function NoMoveCategory($catid, $newcat) {
	global $prefix, $db, $admin_file;
	$result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
	list($ctitle) = $db->sql_fetchrow($result);
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._CATEGORIESADMIN.'</div>';
	echo '<div class="text-center option thick">'._MOVESTORIES.'</div><br /><br />';
	if (!$newcat) {
		echo _ALLSTORIES.' <span class="thick">'.$ctitle.'</span> '._WILLBEMOVED.'<br /><br />';
		$selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat');
		echo '<form action="'.$admin_file.'.php" method="post">';
		echo '<span class="thick">'._SELECTNEWCAT.':</span> ';
		echo '<select name="newcat">';
		echo '<option value="0">'._ARTICLES.'</option>';
		while(list($newcat, $ctitle) = $db->sql_fetchrow($selcat)) {
			echo '<option value="'.$newcat.'">'.$ctitle.'</option>';
		}
		  echo '</select>';
		echo '<input type="hidden" name="catid" value="'.$catid.'" />';
		echo '<input type="hidden" name="op" value="NoMoveCategory" />';
		echo '<input type="submit" value="'._OK.'" />';
		echo '</form>';
	} else {
		csrf_check();
		$resultm = $db->sql_query('select sid from '.$prefix.'_stories where catid=\''.$catid.'\'');
		while(list($sid) = $db->sql_fetchrow($resultm)) {
				$db->sql_query('update '.$prefix.'_stories set catid=\''.$newcat.'\' where sid=\''.$sid.'\'');
		}
		$db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
		echo _MOVEDONE;
	}
	CloseTable();
	include_once 'footer.php';
}

function SaveEditCategory($catid, $ctitle) {
	global $prefix, $db, $admin_file;
	$ctitle = $db->sql_escape_string(check_html($ctitle, 'nohtml'));
	$result = $db->sql_query('select catid from '.$prefix.'_stories_cat where title=\''.$ctitle.'\'');
	if ($db->sql_numrows($result) == 1) {
		$what1 = _CATEXISTS;
		$what2 = _GOBACK;
	} else {
		$what1 = _CATSAVED;
		$what2 = '[ <a href="'.$admin_file.'.php?op=adminStory">'._GOTOADMIN.'</a> ]';
		$result = $db->sql_query('update '.$prefix.'_stories_cat set title=\''.$ctitle.'\' where catid=\''.$catid.'\'');
		if (!$result) {
				return;
		}
	}
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._CATEGORIESADMIN.'</div>';
	echo '<br /><br />';
	echo '<div class="text-center content"><span class="thick">'.$what1.'</span><br /><br />';
	echo $what2.'</div>';
	CloseTable();
	include_once 'footer.php';
}

function SaveCategory($ctitle) {
	global $prefix, $db, $admin_file;
	$ctitle = $db->sql_escape_string(check_html($ctitle, 'nohtml'));
	$result = $db->sql_query('select catid from '.$prefix.'_stories_cat where title=\''.$ctitle.'\'');
	if ($db->sql_numrows($result) == 1) {
		$what1 = _CATEXISTS;
		$what2 = _GOBACK;
	} else {
		$what1 = _CATADDED;
		$what2 = _GOTOADMIN;
		$result = $db->sql_query('insert into '.$prefix.'_stories_cat values '."(NULL, '$ctitle', 0)");
		if (!$result) {
			return;
		}
	}
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._CATEGORIESADMIN.'</div>';
	echo '<br /><br />';
	echo '<div class="text-center content">'.$what1.'<br /><br />';
	echo '<a href="'.$admin_file.'.php?op=adminStory">'.$what2.'</a></div>';
	CloseTable();
	include_once 'footer.php';
}

function autodelete($anid) {
	global $prefix, $db, $admin_file;
	$db->sql_query('delete from '.$prefix.'_autonews where anid=\''.$anid.'\'');
	Header('Location: '.$admin_file.'.php?op=adminMain');
}

function autoEdit($anid) {
	global $aid, $bgcolor1, $bgcolor2, $prefix, $db, $multilingual, $admin_file, $language, $radminsuper, $sid;
	$anid_escaped = $db->sql_escape_string(check_html($anid, 'nohtml'));
	$result2 = $db->sql_query('SELECT `aid` FROM `' . $prefix . '_autonews` WHERE `anid` = \'' . $anid_escaped . '\'');
	list($aaid) = $db->sql_fetchrow($result2);
	if ($aaid == $aid OR $radminsuper) {
		include_once 'header.php';
		$result = $db->sql_query('select catid, aid, title, time, hometext, bodytext, topic, informant, notes, ihome, alanguage, acomm from '.$prefix.'_autonews where anid=\''.$anid.'\'');
		list($catid, $aid, $story_title, $time, $hometext, $bodytext, $topic, $informant, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i', $time, $datetime);
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
		$date = date('F d\, Y \@ H\:i\:s');
		echo '<div class="text-center option thick">'._AUTOSTORYEDIT.'</div><br />'
		.'<form action="'.$admin_file.'.php" method="post">';
		$result=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
		list($topicimage) = $db->sql_fetchrow($result);
		echo '<table border="0" width="75%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" class="centered"><tr><td>'
		.'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
		.'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
		themepreview(htmlentities($story_title, ENT_QUOTES), $hometext, $bodytext);
		echo '</td></tr></table></td></tr></table>'
		.'<br /><br /><span class="thick">'._TITLE.'</span><br />'
		.'<input type="text" name="story_title" size="50" value="'.$story_title.'" /><br /><br />'
		.'<span class="thick">'._TOPIC.'</span> <select name="topic">';
		$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
		echo '<option value=\'\'>'._ALLTOPICS.'</option>'."\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			if ($topicid==$topic) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		}
		echo '</select><br /><br />';
		$cat = $catid;
		SelectCategory($cat);
		echo '<br />';
		puthome($ihome, $acomm);
		if ($multilingual == 1) {
			$lang_content = lang_select_list('alanguage', $alanguage);
			echo $lang_content;
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
		echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
		wysiwyg_textarea('hometext', $hometext, 'PHPNukeAdmin', 50, 12);
		echo '<br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
		wysiwyg_textarea('bodytext', $bodytext, 'PHPNukeAdmin', 50, 12);
		echo '<span class="content">'._ARESUREURL.'</span><br /><br />';
		if ($aid != $informant) {
			echo '<br /><br /><span class="thick">'._NOTES.'</span><br />';
			wysiwyg_textarea('notes', $notes, 'PHPNukeAdmin', 50, 6);
		}
		echo '<br /><br /><br /><span class="thick">'._CHNGPROGRAMSTORY.'</span><br /><br />'
		._NOWIS.': '.$date.'<br /><br />';
		$xday = 1;
		echo _DAY.': <select name="day">';
		while ($xday <= 31) {
			if ($xday == $datetime[3]) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.'>'.$xday.'</option>';
			$xday++;
		}
		echo '</select>';
		$xmonth = 1;
		echo _UMONTH.': <select name="month">';
		while ($xmonth <= 12) {
			if ($xmonth == $datetime[2]) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.'>'.$xmonth.'</option>';
			$xmonth++;
		}
		echo '</select>';
		echo _YEAR.': <input type="text" name="year" value="'.$datetime[1].'" size="5" maxlength="4" />';
		echo '<br />'._HOUR.': <select name="hour">';
		$xhour = 0;
		while ($xhour <= 23) {
			$dummy = $xhour;
			if ($xhour < 10) {
				$xhour = '0'.$xhour;
			}
			if ($xhour == $datetime[4]) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.'>'.$xhour.'</option>';
			$xhour = $dummy;
			$xhour++;
		}
		echo '</select>';
		echo ': <select name="min">';
		$xmin = 0;
		while ($xmin <= 59) {
			if (($xmin == 0) OR ($xmin == 5)) {
				$xmin = '0'.$xmin;
			}
			if ($xmin == $datetime[5]) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.'>'.$xmin.'</option>';
			$xmin = $xmin + 5;
		}
		echo '</select>';
		echo ': 00<br /><br />
		<input type="hidden" name="anid" value="'.$anid.'" />
		<input type="hidden" name="op" value="autoSaveEdit" />
		<input type="submit" value="'._SAVECHANGES.'" />
		</form>';
		CloseTable();
		include_once 'footer.php';
	} else {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
		echo '<div class="text-center"><span class="thick">'._NOTAUTHORIZED1.'</span><br /><br />'
		._NOTAUTHORIZED2.'<br /><br />'
		._GOBACK.'</div>';
		CloseTable();
		include_once 'footer.php';
	}
}

function autoSaveEdit($anid, $year, $day, $month, $hour, $min, $story_title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm) {
	global $aid, $ultramode, $prefix, $db, $admin_file, $radminsuper;
	$result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
	list($aaid) = $db->sql_fetchrow($result2);
	if ($aaid == $aid OR $radminsuper) {
		if ($day < 10) {
			$day = '0'.$day;
		}
		if ($month < 10) {
			$month = '0'.$month;
		}
		$date = $year.'-'.$month.'-'.$day.' '. $hour.':'.$min. ':00';
		$story_title = $db->sql_escape_string(html_entity_decode(check_html($story_title, 'nohtml')));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		$result = $db->sql_query('update '.$prefix.'_autonews set '."catid='$catid', title='$story_title', time='$date', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm'".' where anid=\''.$anid.'\'');
		if (!$result) {
			exit();
		}
		Header('Location: '.$admin_file.'.php?op=adminMain');
	} else {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">' , _ARTICLEADMIN , '<br />'
			, '<span class="thick">' , _NOTAUTHORIZED1 , '</span><br /><br />'
			, _NOTAUTHORIZED2 , '<br /><br />'
			, _GOBACK
			, '</div>';
		CloseTable();
		include_once 'footer.php';
	 }
}

function displayStory($qid) {
	global $user, $subject, $story, $bgcolor1, $bgcolor2, $anonymous, $db, $user_prefix, $prefix, $multilingual, $admin_file, $language;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._SUBMISSIONSADMIN.'</div>';

	$result = $db->sql_query('SELECT qid, uid, uname, subject, story, storyext, topic, alanguage FROM '.$prefix.'_queue where qid=\''.$qid.'\'');
	list($qid, $uid, $uname, $subject, $story, $storyext, $topic, $alanguage) = $db->sql_fetchrow($result);
	$date = date('F d\, Y \@ H\:i\:s');
	$subject = htmlentities($subject, ENT_QUOTES);
	echo '<form action="'.$admin_file.'.php" method="post">';
	 echo '<div class="content thick">'._NAME.'</div>'
	.'<input type="text" name="author" size="25" value="'.$uname.'" />';
	if ($uname != $anonymous) {
		$res = $db->sql_query('select user_email from '.$user_prefix.'_users where username=\''.$uname.'\'');
		list($email) = $db->sql_fetchrow($res);
		echo '&nbsp;&nbsp;[ <a href="mailto:'.$email.'?Subject=Re:%20 '.urlencode($subject).'"><span class="content">'._EMAILUSER.'</span></a> | <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname.'"><span class="content">'._USERPROFILE.'</span></a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$uid.'"><span class="content">'._SENDPM.'</span></a> ]';
	}
	echo '<br /><br /><span class="thick">'._TITLE.'</span><br />'
	.'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />';
	if (empty($topic)) {
		$topic = 1;
	}
	$result = $db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
	list($topicimage) = $db->sql_fetchrow($result);
	echo '<table border="0" width="70%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" class="centered"><tr><td>'
		.'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
		.'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
	themepreview($subject, $story. '<br /><br />'.$storyext);
	echo '</td></tr></table></td></tr></table>'
		.'<br /><span class="thick">'._TOPIC.'</span> <select name="topic">';
	$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	echo '<option value="">'._SELECTTOPIC.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		if ($topicid == $topic) {
			$sel = ' selected="selected "';
		} else {
			$sel = '';
		}
		echo '<option' . $sel . ' value="' . $topicid . '">' . $topics . '</option>' . "\n";
	}
	echo '</select>';
	echo '<br /><br />';
	echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><span class="thick">'._ASSOTOPIC.'</span></td><td width="100%">'
		.'<table border="1" cellspacing="3" cellpadding="8"><tr>';
	$a = 0;
	$sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		if ($a == 3) {
			echo '</tr><tr>';
			$a = 0;
		}
		echo '<td><input type="checkbox" name="assotop[]" value="'.$row['topicid'].'" />'.$row['topictext'].'</td>';
		$a++;
	}
	 echo '</tr></table></td></tr></table><br /><br />';
	if (!isset($cat)) {$cat = '';  }
	SelectCategory($cat);
	if (!isset($ihome)) {$ihome = ''; }
	if (!isset($acomn)) {$acomm = ''; }
	echo '<br />';
	puthome($ihome, $acomm);
	if ($multilingual == 1) {
		echo '<p><span class="thick">'._LANGUAGE.'</span><br />';
		$lang_content = lang_select_list('alanguage', $alanguage);
			echo $lang_content .'</p>';
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
	echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
	wysiwyg_textarea('hometext', $story, 'PHPNukeAdmin', 50, 15);
	echo '<br /><br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
	wysiwyg_textarea('bodytext', $storyext, 'PHPNukeAdmin', 50, 15);
	echo '<br /><span class="content">'._AREYOUSURE.'</span><br /><br />'
		.'<span class="thick">'._NOTES.'</span><br />';
	wysiwyg_textarea('notes', '', 'PHPNukeAdmin', 50, 6);
//tag cloud start
	if ($result = $db->sql_query("SELECT tag FROM ".$prefix."_tags_temp WHERE whr=6 AND cid='$qid'")) {
		$ntags = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$ntags[] = htmlentities($row['tag'], ENT_QUOTES);
		}
		$ntags = implode(',',$ntags);
		} else {
			$ntags = "";
		}
	echo '<br />' ._TAGSCLOUD. ':<br /><input type="text" name="tags" value="'.htmlentities($ntags, ENT_QUOTES).'" size="40" maxlength="255" />
	 <span style="font-size:9px">('._SEPARATEDBYCOMMAS.')</span><br /><br />';
// tag cloud end
	 echo '<input type="hidden" name="qid" size="50" value="'.$qid.'" />'
		.'<input type="hidden" name="uid" size="50" value="'.$uid.'" />'
		.'<br /><span class="thick">'._PROGRAMSTORY.'</span>&nbsp;&nbsp;'
		.'<input type="radio" name="automated" value="1" />'._YES.' &nbsp;&nbsp;'
		.'<input type="radio" name="automated" value="0" checked="checked" />'._NO.'<br /><br />'
		._NOWIS.': '.$date.'<br /><br />';
	$day = 1;
	$tday = date('j');
	$tmon = date('n');
	$year = date('Y');
	echo _DAY.': <select name="day">';
	while ($day <= 31) {
		if ($tday==$day) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$day.'</option>';
		$day++;
	}
	echo '</select>';
	$month = 1;
	echo _UMONTH.': <select name="month">';
	while ($month <= 12) {
		if ($tmon==$month) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$month.'</option>';
		$month++;
	}
	echo '</select>';
	echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
	echo '<br />'._HOUR.': <select name="hour">';
	$hour = 0;
	$cero = 0;
	while ($hour <= 23) {
		$dummy = $hour;
		if ($hour < 10) {
			 $hour = $cero.$hour;
		}
		echo '<option>'.$hour.'</option>';
		$hour = $dummy;
		$hour++;
	}
	echo '</select>';
	echo ': <select name="min">';
	$min = 0;
	while ($min <= 59) {
		if (($min == 0) OR ($min == 5)) {
		$min = '0'. $min;
		}
		echo '<option>'.$min.'</option>';
		$min = $min + 5;
	}
	echo '</select>';
	echo ': 00<br /><br />'
		.'<select name="op">'
		.'<option value="DeleteStory">'._DELETESTORY.'</option>'
		.'<option value="PreviewAgain" selected="selected">'._PREVIEWSTORY.'</option>'
		.'<option value="PostStory">'._POSTSTORY.'</option>'
		.'</select>'
		.'<input type="submit" value="'._OK.'" />&nbsp;&nbsp;[ <a class="rn_csrf" href="'.$admin_file.'.php?op=DeleteStory&amp;qid='.$qid.'">'._DELETE.'</a> ]';


	echo '<br />';
	if (!isset($pollTitle)) {$pollTitle = '';  }
	if (!isset($optionText)) {$optionText = ''; }
	putpoll($pollTitle, $optionText);
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
}

function previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $tags, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
	global $user, $boxstuff, $anonymous, $bgcolor1, $bgcolor2, $db, $user_prefix, $prefix, $multilingual, $admin_file, $language;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
	$date = date('F d\, Y \@ H\:i\:s');
	$subject = htmlentities(check_html($subject, 'nohtml'),ENT_QUOTES);
	$hometext = check_html($hometext, '');
	$bodytext = check_html($bodytext, '');
	$notes = check_html($notes, '');
// tag cloud start
	$tags = check_html($tags,'nohtml');
//tag cloud end
	echo '<form action="'.$admin_file.'.php" method="post">';
 echo '<span class="content thick">'
 .''._NAME.'</span><br />'
		.'<input type="text" name="author" size="25" value="'.$author.'" />';
	if ($author != $anonymous) {
		$res = $db->sql_query('select user_id, user_email from '.$user_prefix.'_users where username=\''.$author.'\'');
		list($pm_userid, $email) = $db->sql_fetchrow($res);
		echo '&nbsp;&nbsp;[ <a href="mailto:'.$email.'?Subject=Re:%20'.urlencode($subject).'"><span class="content">'._EMAILUSER.'</span></a> | <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$author.'"><span class="content">'._USERPROFILE.'</span></a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$uid.'"><span class="content">'._SENDPM.'</span></a> ]';
	}
	echo '<br /><br /><span class="thick">'._TITLE.'</span><br />'
		.'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />';
	$result = $db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
	list($topicimage) = $db->sql_fetchrow($result);
	echo '<table width="70%" bgcolor="'.$bgcolor2.'" cellpadding="0" cellspacing="1" border="0" class="centered"><tr><td>'
		.'<table width="100%" bgcolor="'.$bgcolor1.'" cellpadding="8" cellspacing="1" border="0"><tr><td>'
		.'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
	themepreview($subject, $hometext, $bodytext, $notes);
	echo '</td></tr></table></td></tr></table>'
		.'<br /><span class="thick">'._TOPIC.'</span> <select name="topic">';
	$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	echo '<option value="">'._ALLTOPICS.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		if ($topicid == $topic) {
			$sel = ' selected="selected "';
		} else {
			$sel = '';
		}
		echo '<option' , $sel , ' value="' , $topicid , '">' . $topics. '</option>' , "\n";
	}
	echo '</select>';
	echo '<br /><br />';
	$associated = '';
	if (!empty($assotop)) {
		$j = sizeof($assotop);
		for ($i=0; $i<$j; ++$i) {
				$associated .= $assotop[$i].'-';
		}
		$asso_t = explode('-', $associated);
	} else {
		$asso_t = '';
	}
	echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><span class="thick">'._ASSOTOPIC.'</span></td><td width="100%">'
		.'<table border="1" cellspacing="3" cellpadding="8"><tr>';
	$a = 0;
	$sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$checked = '';
		if ($a == 3) {
				echo '</tr><tr>';
				$a = 0;
		}
		if (!empty($asso_t)) {
				for ($i=0; $i<sizeof($asso_t); $i++) {
					if ($asso_t[$i] == $row['topicid']) {
					$checked = 'checked="checked"';
					break;
					}
				}
		}
		echo '<td><input type="checkbox" name="assotop[]" value="'.$row['topicid'].'"'. $checked .'/>'.$row['topictext'].'</td>';

		$a++;
	}
	echo '</tr></table></td></tr></table><br /><br />';
	$cat = $catid;
	SelectCategory($cat);
	echo '<br />';
	puthome($ihome, $acomm);
	if ($multilingual == 1) {
		echo '<p><span class="thick">'._LANGUAGE.'</span><br />';
		$lang_content = lang_select_list('alanguage', $alanguage);
			echo $lang_content .'</p>';
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
	echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
	wysiwyg_textarea('hometext', $hometext, 'PHPNukeAdmin', 50, 7);
	echo '<br /><br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
	wysiwyg_textarea('bodytext', $bodytext, 'PHPNukeAdmin', 50, 10);
	echo '<br /><span class="content">'._AREYOUSURE.'</span><br /><br />'
		.'<span class="thick">'._NOTES.'</span><br />';
	wysiwyg_textarea('notes', $notes, 'PHPNukeAdmin', 50, 6);
// tag cloud start
	echo '<br />' ._TAGSCLOUD. ': <input type="text" name="tags" value="'.htmlentities($tags, ENT_QUOTES).'" size="40" maxlength="255" /> <span style="font-size:9px">('._SEPARATEDBYCOMMAS.')</span><br /><br />';
// tag cloud end
	 echo '<br /><br /><input type="hidden" name="qid" size="50" value="'.$qid.'" />'
		  .'<input type="hidden" name="uid" size="50" value="'.$uid.'" />';
	if ($automated == 1) {
		  $sel1 = 'checked="checked"';
		  $sel2 = '';
	} else {
		  $sel1 = '';
		  $sel2 = 'checked="checked"';
	}
	echo '<span class="thick">'._PROGRAMSTORY.'</span>&nbsp;&nbsp;'
		.'<input type="radio" name="automated" value="1" '.$sel1.' />'._YES.' &nbsp;&nbsp;'
		.'<input type="radio" name="automated" value="0" '.$sel2.' />'._NO.'<br /><br />'
		._NOWIS.': '.$date.'<br /><br />';
	$xday = 1;
	echo _DAY.': <select name="day">';
	while ($xday <= 31) {
		if ($xday == $day) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xday.'</option>';
		$xday++;
	}
	echo '</select>';
	$xmonth = 1;
	echo _UMONTH.': <select name="month">';
	while ($xmonth <= 12) {
		if ($xmonth == $month) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xmonth.'</option>';
		$xmonth++;
	}
	echo '</select>';
	echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
	echo '<br />'._HOUR.': <select name="hour">';
	$xhour = 0;
	$cero = 0;
	 while ($xhour <= 23) {
		$dummy = $xhour;
		if ($xhour < 10) {
			$xhour = $cero.$xhour;
		}
		if ($xhour == $hour) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xhour.'</option>';
		$xhour = $dummy;
		$xhour++;
	}
	echo '</select>';
	echo ': <select name="min">';
	$xmin = 0;
	while ($xmin <= 59) {
		if (($xmin == 0) OR ($xmin == 5)) {
			$xmin = '0'.$xmin;
		}
		if ($xmin == $min) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xmin.'</option>';
		$xmin = $xmin + 5;
	}
	echo '</select>';
	echo ': 00<br /><br />'
	.'<select name="op">'
	.'<option value="DeleteStory">'._DELETESTORY.'</option>'
	.'<option value="PreviewAgain" selected="selected">'._PREVIEWSTORY.'</option>'
	.'<option value="PostStory">'._POSTSTORY.'</option>'
	.'</select>'
	.'<input type="submit" value="'._OK.'" />';

	echo '<br />';
	putpoll($pollTitle, $optionText);
        echo '</form>';
        CloseTable();
	include_once 'footer.php';
}

function postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $tags, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
	global $aid, $ultramode, $prefix, $db, $user_prefix, $admin_file;
	$associated = '';
	if (!empty($assotop)) {
		$j = sizeof($assotop);
		for ($i=0; $i<$j; ++$i) {
			$associated .= $assotop[$i].'-';
		}
	}
	if ($automated == 1) {
		if ($day < 10) {
			$day = '0'.$day;
		}
		if ($month < 10) {
			$month = '0'.$month;
		}
		if ($hour < 10) {
			$hour = '0'.$hour;
		}
		if ($min == 5) {
			$min = '0'.$min;
		}
		$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
		if ($uid == 1) $author = '';
		if ($hometext == $bodytext) $bodytext = '';
		$subject = $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'),ENT_QUOTES));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		$result = $db->sql_query('insert into '.$prefix.'_autonews values '."(NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
		if (!$result) {
			return;
		}
		// tag cloud start
		if ($tags!="") {
			$sql_row_autonews_tag = $db->sql_fetchrow($db->sql_query("SELECT anid FROM ".$prefix."_autonews WHERE aid='$aid' AND title='$subject' LIMIT 1"));
			$lastid = $sql_row_autonews_tag['anid'];
			$tags = explode(",",$tags);
			foreach ($tags as $tag) {
				$tag = $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml')));
				if($lastid>0) {
					Header("Location: ".$admin_file.".php?op=submissions");
				}
				$db->sql_query("INSERT INTO ".$prefix."_tags_temp (tag,cid,whr) VALUES ('".trim($tag)."','$lastid','5')");
				$db->sql_query("DELETE FROM ".$prefix."_tags_temp where cid='$lastid' AND whr='6'");
				}
			}
// tag cloud end
		  if ($uid != 1) {
				$db->sql_query('update '.$user_prefix.'_users set counter=counter+1 where user_id=\''.$uid.'\'');
				$row = $db->sql_fetchrow($db->sql_query('SELECT points FROM '.$prefix.'_groups_points where id=\'4\''));
				$db->sql_query('UPDATE '.$user_prefix.'_users SET points=points+'.$row['points'].' where user_id=\''.$uid.'\'');
		}
		$db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
		$db->sql_query('delete from '.$prefix.'_queue where qid=\''.$qid.'\'');
		Header('Location: '.$admin_file.'.php?op=submissions');
	} else {
		if ($uid == 1) $author = '';
		if ($hometext == $bodytext) $bodytext = '';
		$subject = $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'),ENT_QUOTES));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) {
			$haspoll = 1;
			$timeStamp = time();
			$pollTitle = $db->sql_escape_string($pollTitle);
			if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_desc '."VALUES (NULL, '$pollTitle', '$timeStamp', 0, '$alanguage', 0)")) {
				return;
			}
			$object = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc where pollTitle=\''.$pollTitle.'\''));
			$id = $object['pollID'];
			for($i = 1; $i <= sizeof($optionText); $i++) {
				if ($optionText[$i] != '') {
					$optionText[$i] = $db->sql_escape_string($optionText[$i]);
				}
				if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_data (pollID, optionText, optionCount, voteID) '."VALUES ('$id', '$optionText[$i]', 0, '$i')")) {
					return;
				}
			}
		} else {
			$haspoll = 0;
			$id = 0;
		}
		$result = $db->sql_query('insert into '.$prefix.'_stories '."values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', 0, 0, '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', 0, 0, '$associated')");
		$result = $db->sql_query('select sid from '.$prefix.'_stories where title=\''.$subject.'\' order by time DESC limit 0,1');
		list($artid) = $db->sql_fetchrow($result);
		$db->sql_query('UPDATE '.$prefix.'_poll_desc SET artid=\''.$artid.'\' where pollID=\''.$id.'\'');
		if (!$result) {
			return;
		}
		// tag cloud start
		if ($tags!="") {
			$row = $db->sql_fetchrow($db->sql_query("SELECT sid FROM ".$prefix."_stories WHERE catid='$catid' AND aid='$aid' AND title='$subject'"));
			$lastid = intval($row['sid']);
			$tags = explode(",",$tags);
			foreach ($tags as $tag) {
				$tag = $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml'), ENT_QUOTES));
				$db->sql_query("INSERT INTO ".$prefix."_tags (tag,cid,whr) VALUES ('".trim($tag)."','$lastid','3')");
				$db->sql_query("DELETE FROM ".$prefix."_tags_temp where cid='$qid' AND whr=6");
			}
		}
		// tag cloud end
		if ($uid != 1) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT points FROM '.$prefix.'_groups_points where id=\'4\''));
			$db->sql_query('UPDATE '.$user_prefix.'_users SET points=points+'.$row['points'].' where user_id=\''.$uid.'\'');
			$db->sql_query('update '.$user_prefix.'_users set counter=counter+1 where user_id=\''.$uid.'\'');
		}
		$db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
		deleteStory($qid);
	}
}

function editStory($sid) {
	global $user, $bgcolor1, $bgcolor2, $aid, $prefix, $db, $multilingual, $language, $admin_file, $radminsuper;
	if (!isset($checked)) $checked = '';
	if (!isset($a)) $a = 0;
	$sel = '';
	$result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
	list($aaid) = $db->sql_fetchrow($result2);
	if ($aaid == $aid OR $radminsuper) {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
		CloseTable();
		echo '<br />';
		$result = $db->sql_query('SELECT catid, title, hometext, bodytext, topic, notes, ihome, alanguage, acomm FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
		list($catid, $subject, $hometext, $bodytext, $topic, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
		$result2=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
		list($topicimage) = $db->sql_fetchrow($result2);
		$subject = htmlentities($subject, ENT_QUOTES);
		OpenTable();
		echo '<div class="text-center option"><span class="thick">'._EDITARTICLE.'</span></div>'
		.'<table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" class="centered"><tr><td>'
		.'<table width="100%" border="0" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
		.'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
		themepreview($subject, $hometext, $bodytext, $notes);
		echo '</td></tr></table></td></tr></table><br /><br />'
		.'<form action="'.$admin_file.'.php" method="post">'
		.'<span class="thick">'._TITLE.'</span><br />'
		.'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />'
		.'<span class="thick">'._TOPIC.'</span> <select name="topic">';
		$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
		echo '<option value="">'._ALLTOPICS.'</option>'."\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			if ($topicid==$topic) { $sel = 'selected="selected "'; }
			echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
			$sel = '';
		}
		echo '</select>';
		echo '<br /><br />';
		$asql = 'SELECT associated FROM '.$prefix.'_stories where sid=\''.$sid.'\'';
		$aresult = $db->sql_query($asql);
		$arow = $db->sql_fetchrow($aresult);
		$asso_t = explode('-', $arow['associated']);
		echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><span class="thick">'._ASSOTOPIC.'</span></td><td width="100%">'
		.'<table border="1" cellspacing="3" cellpadding="8"><tr>';
		$sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			if ($a == 3) {
				echo '</tr><tr>';
				$a = 0;
			}
			for ($i=0; $i<sizeof($asso_t); $i++) {
				if ($asso_t[$i] == $row['topicid']) {
					$checked = 'checked="checked"';
					break;
				}
			}
			echo '<td><input type="checkbox" name="assotop[]" value="'.$row['topicid'].'" '.$checked.' />'.$row['topictext'].'</td>';
			$checked = '';
			$a++;
		}
		echo '</tr></table></td></tr></table><br /><br />';
		$cat = $catid;
		SelectCategory($cat);
		echo '<br />';
		puthome($ihome, $acomm);
		if ($multilingual == 1) {
			echo '<p><span class="thick">'._LANGUAGE.'</span><br />';
			$lang_content = lang_select_list('alanguage', $alanguage);
			echo $lang_content .'</p>';
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
		echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
		wysiwyg_textarea('hometext', $hometext, 'PHPNukeAdmin', 50, 17);
		echo '<br /><br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
		wysiwyg_textarea('bodytext', $bodytext, 'PHPNukeAdmin', 50, 10);
		echo '<br /><span class="content">'._AREYOUSURE.'</span><br /><br />'
		.'<span class="thick">'._NOTES.'</span><br />';
		wysiwyg_textarea('notes', "$notes", 'PHPNukeAdmin', 50, 6);
		// tag cloud start
		if ($result = $db->sql_query("SELECT tag FROM ".$prefix."_tags WHERE whr=3 AND cid='$sid'")) {
			$ntags = array();
			while ($row = mysqli_fetch_assoc($result)) {
				$ntags[] = htmlentities($row['tag'], ENT_QUOTES);
			}
			$ntags = implode(",",$ntags);
		} else {
			$ntags = "";
		}
		echo '<br />' ._TAGSCLOUD. ': <input type="text" name="tags" value="'.$ntags.'" size="40" maxlength="255" /> <span style="font-size:9px">('._SEPARATEDBYCOMMAS.')</span><br />';
		// tag cloud end
		echo '<br /><br /><input type="hidden" name="sid" size="50" value="'.$sid.'" />'
		.'<input type="hidden" name="op" value="ChangeStory" />'
		.'<input type="submit" value="'._SAVECHANGES.'" />'
		.'</form>';
		CloseTable();
		include_once 'footer.php';
	} else {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
		echo '<br />';
		echo '<div class="text-center title">'._NOTAUTHORIZED1.'<br />'
		._NOTAUTHORIZED2.'<br /><br />'
		._GOBACK.'</div>';
		CloseTable();
		include_once 'footer.php';
	}
}

function removeStory($sid, $ok=0) {
	global $ultramode, $aid, $prefix, $db, $admin_file, $radminsuper, $counter;
	$counter = intval($counter);
	$result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
	list($aaid) = $db->sql_fetchrow($result2);
	if ($aaid == $aid OR $radminsuper == 1) {
		if ($ok) {
			csrf_check();
			$counter--;
			$db->sql_query('DELETE FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
			$db->sql_query('DELETE FROM '.$prefix.'_comments where sid=\''.$sid.'\'');
			$db->sql_query('update '.$prefix.'_poll_desc set artid=0 where artid=\''.$sid.'\'');
			$result = $db->sql_query('update '.$prefix.'_authors set counter=\''.$counter.'\' where aid=\''.$aid.'\'');
			$db->sql_query("DELETE FROM ".$prefix."_tags WHERE whr=3 AND cid='$sid'");
			Header('Location: '.$admin_file.'.php');
		} else {
			include_once 'header.php';
			GraphicAdmin();
			OpenTable();
			echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
			echo '<br />';
			echo '<div class="text-center title">'._REMOVESTORY.' '.$sid.' '._ANDCOMMENTS.'</div>';
			echo '<div class="text-center"><br />[ <a href="'.$admin_file.'.php">'._NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'&amp;ok=1">'._YES.'</a> ]</div>';
			CloseTable();
			include_once 'footer.php';
		}
	} else {
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title">'._ARTICLEADMIN.'<br />';
		echo _NOTAUTHORIZED1.'<br /><br />'
		._NOTAUTHORIZED2.'<br /><br />'
		._GOBACK.'</div>';
		CloseTable();
		include_once 'footer.php';
	}
}

function changeStory($sid, $subject, $hometext, $bodytext, $tags, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop) {
	global $aid, $ultramode, $prefix, $db, $admin_file, $radminsuper;
	$associated = '';
	if ($assotop != '') {
		$j = sizeof($assotop);
		for ($i=0; $i<$j; ++$i) {
			$associated .= "$assotop[$i]-";
		}
	}
	$result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
	list($aaid) = $db->sql_fetchrow($result2);
	if ($aaid == $aid OR $radminsuper == 1) {
		$subject = $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'),ENT_QUOTES));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		$db->sql_query('update '.$prefix.'_stories set '."catid='$catid', title='$subject', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm', associated='$associated'".' where sid=\''.$sid.'\'');
		// tag cloud start
		if ($tags!="") {
			$db->sql_query("DELETE FROM ".$prefix."_tags WHERE whr=3 AND cid='$sid'");
			$tags = explode(",",$tags);
			foreach ($tags as $tag) {
				$tag = $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml'),ENT_QUOTES));
				$db->sql_query("INSERT INTO ".$prefix."_tags (tag,cid,whr) VALUES ('".trim($tag)."','$sid','3')");
			}
		}
		// tag cloud end
		Header('Location: '.$admin_file.'.php?op=adminMain');
	}
}

function adminStory() {
	global $prefix, $db, $language, $multilingual, $admin_file;
	include_once 'header.php';
	GraphicAdmin();
	$sel = '';
	OpenTable();
	echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
	echo '<br />';
	$date = date('F d\, Y \@ H\:i\:s');
	echo '<form action="'.$admin_file.'.php" method="post">';
	echo '<div class="text-center option">'._ADDARTICLE.'</div><br />'
	.'<span class="thick">'._TITLE.' </span>'
	.'<input type="text" name="subject" size="50" /><br /><br />'
	.'<span class="thick">'._TOPIC.' </span>';
	$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	if (!isset($topic)) $topic='';
	echo '<select name="topic">';
	echo '<option value="">'._SELECTTOPIC.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		if ($topicid == $topic) {
			$sel = 'selected="selected "';
		}
		echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		$sel = '';
	}
	echo '</select><br /><br />';
	echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><span class="thick">'._ASSOTOPIC.'</span></td><td width="100%">'
	.'<table border="1" cellspacing="3" cellpadding="8"><tr>';
	$a = 0;
	$sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		if ($a == 3) {
			echo '</tr><tr>';
			$a = 0;
		}
		echo '<td><input type="checkbox" name="assotop[]" value="'.$row['topicid'].'" />'.$row['topictext'].'</td>';
		$a++;
	}
	echo '</tr></table></td></tr></table><br /><br />';
	$cat = 0;
	SelectCategory($cat);
	echo '<br />';
	puthome('', '');
	if ($multilingual == 1) {
		echo '<p><span class="thick">'._LANGUAGE.'</span><br />';
		$lang_content = lang_select_list('alanguage', $language);
			echo $lang_content .'</p>';
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
	echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
	wysiwyg_textarea('hometext', '', 'PHPNukeAdmin', 50, 12);
	echo '<br /><br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
	wysiwyg_textarea('bodytext', '', 'PHPNukeAdmin', 50, 12);
	echo '<br /><span class="content">'._ARESUREURL.'</span>';
	echo '<br /><br /><span class="thick">'._NOTES.'</span><br />';
	wysiwyg_textarea('notes', '', 'PHPNukeAdmin', 50, 6);
	// tag cloud start
	echo'<br />' ._TAGSCLOUD. ': <input type="text" name="tags" size="40" maxlength="255" /> <span style="font-size:9px">
	('._SEPARATEDBYCOMMAS.')</span><br />';
	// tag cloud end
	echo '<br /><br /><span class="thick">'._PROGRAMSTORY.'</span>&nbsp;&nbsp;'
	.'<input type="radio" name="automated" value="1" />'._YES.' &nbsp;&nbsp;'
	.'<input type="radio" name="automated" value="0" checked="checked" />'._NO.'<br /><br />'
	._NOWIS.': '.$date.'<br /><br />';
	$day = 1;
	$tday = date('j');
	$tmon = date('n');
	$year = date('Y');
	echo _DAY.': <select name="day">';
	while ($day <= 31) {
		if ($tday==$day) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$day.'</option>';
		$day++;
	}
	echo '</select>';
	$month = 1;
	echo _UMONTH.': <select name="month">';
	while ($month <= 12) {
		if ($tmon==$month) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$month.'</option>';
		$month++;
	}
	echo '</select>';
	echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />'
	.'<br />'._HOUR.': <select name="hour">';
	$hour = 0;
	while ($hour <= 23) {
		$dummy = $hour;
		if ($hour < 10) {
			$hour = '0'.$hour;
		}
		echo '<option>'.$hour.'</option>';
		$hour = $dummy;
		$hour++;
	}
	echo '</select>'
	.': <select name="min">';
	$min = 0;
	while ($min <= 59) {
		if (($min == 0) OR ($min == 5)) {
			$min = '0'.$min;
		}
		echo '<option>'.$min.'</option>';
		$min = $min + 5;
	}
	echo '</select>';
	echo ': 00<br /><br />'
	.'<select name="op">'
	.'<option value="PreviewAdminStory" selected="selected">'._PREVIEWSTORY.'</option>'
	.'<option value="PostAdminStory">'._POSTSTORY.'</option>'
	.'</select>'
	.'<input type="submit" value="'._OK.'" />';
	echo '<br />';
	if (!isset($pollTitle) OR !isset($optionText)) {
		putpoll('', array_fill(1, 12, ''));
	}
	else {
		putpoll($pollTitle,$optionText);
	}
        echo '</form>';
        CloseTable();
	include_once 'footer.php';
}

function previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $notes, $tags, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
	global $user, $bgcolor1, $bgcolor2, $prefix, $db, $alanguage, $multilingual, $admin_file, $language;
	include_once 'header.php';
	if ($topic<1) {
		$topic = 1;
	}
	$sel = '';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._ARTICLEADMIN.'</div>';
	echo '<br />';
	$date = date('F d\, Y \@ H\:i\:s');
	echo '<form action="'.$admin_file.'.php" method="post">';
	echo '<div class="text-center option thick">'._PREVIEWSTORY.'</div><br />'
	.'<input type="hidden" name="catid" value="'.$catid.'" />';
	$subject = check_html($subject, 'nohtml');
	$hometext = check_html($hometext, '');
	$bodytext = check_html($bodytext, '');
	$result=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
	list($topicimage) = $db->sql_fetchrow($result);
	echo '<table border="0" width="75%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" class="centered"><tr><td>'
	.'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
	.'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
	themepreview($subject, $hometext, $bodytext, $notes);
	echo '</td></tr></table></td></tr></table>'
	.'<br /><br /><span class="thick">'._TITLE.' </span>'
	.'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />'
	.'<span class="thick">'._TOPIC.' </span><select name="topic">';
	$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	echo '<option value="">'._ALLTOPICS.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		if ($topicid==$topic) {
			$sel = 'selected="selected "';
		}
		echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		$sel = '';
	}
	echo '</select><br /><br />';
	$associated = '';
	if (!empty($assotop)) {
		$j = sizeof($assotop);
		for ($i=0; $i<$j; ++$i) {
			$associated .= $assotop[$i].'-';
		}
	}
	$asso_t = explode('-', $associated);
	echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><span class="thick">'._ASSOTOPIC.'</span></td><td width="100%">'
	.'<table border="1" cellspacing="3" cellpadding="8"><tr>';
	$a = 0;
	$sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		if ($a == 3) {
			echo '</tr><tr>';
			$a = 0;
		}
		$checked = '';
		for ($i=0; $i<sizeof($asso_t); $i++) {
			if ($asso_t[$i] == $row['topicid']) {
				$checked = 'checked="checked"';
				break;
			}
		}
		echo '<td><input type="checkbox" name="assotop[]" value="'.$row['topicid'].'" '.$checked.' />'.$row['topictext'].'</td>';
		$a++;
	}
	echo '</tr></table></td></tr></table><br /><br />';
	$cat = $catid;
	SelectCategory($cat);
	echo '<br />';
	puthome($ihome, $acomm);
	if ($multilingual == 1) {
		echo '<p><span class="thick">'._LANGUAGE.'</span><br />';
		$lang_content = lang_select_list('alanguage', $alanguage);
			echo $lang_content .'</p>';
		} else {
			echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
		}
	echo '<br /><br /><span class="thick">'._STORYTEXT.'</span><br />';
	wysiwyg_textarea('hometext', $hometext, 'PHPNukeAdmin', 50, 12);
	echo '<br /><br /><span class="thick">'._EXTENDEDTEXT.'</span><br />';
	wysiwyg_textarea('bodytext', $bodytext, 'PHPNukeAdmin', 50, 12);
	echo '<br /><br /><span class="thick">'._NOTES.'</span><br />';
	wysiwyg_textarea('notes', $notes, 'PHPNukeAdmin', 50, 6);
	// tag cloud start
	echo '<br />' ._TAGSCLOUD. ': <input type="text" name="tags" value="'.htmlentities($tags, ENT_QUOTES).'" size="40" maxlength="255" /> <span style="font-size:9px\">('._SEPARATEDBYCOMMAS.')</span><br />';
	// tag cloud end
	if ($automated == 1) {
		$sel1 = 'checked="checked"';
		$sel2 = '';
	} else {
		$sel1 = '';
		$sel2 = 'checked="checked"';
	}
	echo '<br /><br /><span class="thick">'._PROGRAMSTORY.'</span>&nbsp;&nbsp;'
	.'<input type="radio" name="automated" value="1" '.$sel1.' />'._YES.' &nbsp;&nbsp;'
	.'<input type="radio" name="automated" value="0" '.$sel2.' />'._NO.'<br /><br />'
	._NOWIS.': '.$date.'<br /><br />';
	$xday = 1;
	$tday = date('j');
	$tmonth = date('n');
	$year = date('Y');
	echo _DAY.': <select name="day">';
	while ($xday <= 31) {
		if ($xday == $tday) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xday.'</option>';
		$xday++;
	}
	echo '</select>';
	$xmonth = 1;
	echo _UMONTH.': <select name="month">';
	while ($xmonth <= 12) {
		if ($xmonth == $tmonth) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xmonth.'</option>';
		$xmonth++;
	}
	echo '</select>';
	echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
	echo '<br />'._HOUR.': <select name="hour">';
	$xhour = 0;
	$cero = 0;
	while ($xhour <= 23) {
		$dummy = $xhour;
		if ($xhour < 10) {
			$xhour = $cero.$xhour;
		}
		if ($xhour == $hour) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xhour.'</option>';
		$xhour = $dummy;
		$xhour++;
	}
	echo '</select>';
	echo ': <select name="min">';
	$xmin = 0;
	while ($xmin <= 59) {
		if (($xmin == 0) OR ($xmin == 5)) {
			$xmin ='0'.$xmin;
		}
		if ($xmin == $min) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xmin.'</option>';
		$xmin = $xmin + 5;
	}
	echo '</select>';
	echo ': 00<br /><br />'
	.'<select name="op">'
	.'<option value="PreviewAdminStory" selected="selected">'._PREVIEWSTORY.'</option>'
	.'<option value="PostAdminStory">'._POSTSTORY.'</option>'
	.'</select>'
	.'<input type="submit" value="'._OK.'" />';

	echo '<br />';
	putpoll($pollTitle, $optionText);
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
}

function postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $notes, $tags, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
	global $ultramode, $aid, $db, $prefix, $admin_file;
	$associated = '';
	if (!empty($assotop)) {
		$j = sizeof($assotop);
		for ($i=0; $i<$j; ++$i) {
			$associated .= "$assotop[$i]-";
		}
	}
	if ($automated == 1) {
		if ($day < 10) {
			$day = '0'.$day;
		}
		if ($month < 10) {
			$month = '0'.$month;
		}
		$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
		$author = $aid;
		$subject = $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'),ENT_QUOTES));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		$result = $db->sql_query('insert into '.$prefix.'_autonews '."values (NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
		if (!$result) {
			exit();
		}
		// tag cloud start
		if ($tags!="") {
			$result3 = $db->sql_query("SELECT anid FROM ".$prefix."_autonews WHERE title='$subject' LIMIT 1");
			$row = $db->sql_fetchrow($result3);
			$lastid = $row['anid'];
			$tags = explode(",",$tags);
			foreach ($tags as $tag) {
				$tag = $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml'),ENT_QUOTES));
				if($lastid>0) {
					Header("Location: ".$admin_file.".php?op=submissions");
				}
				$db->sql_query("INSERT INTO ".$prefix."_tags_temp (tag,cid,whr) VALUES ('".trim($tag)."','$lastid','5')");
			}
		}
		// tag cloud end
		$result = $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
		Header('Location: '.$admin_file.'.php?op=adminMain');
	} else {
		$subject = $db->sql_escape_string(html_entity_decode(check_html($subject, 'nohtml'),ENT_QUOTES));
		$hometext = $db->sql_escape_string(check_html($hometext, ''));
		$bodytext = $db->sql_escape_string(check_html($bodytext, ''));
		$notes = $db->sql_escape_string(check_html($notes, ''));
		if (($pollTitle != '') AND ($optionText[1] != '') AND ($optionText[2] != '')) {
			$haspoll = 1;
			$timeStamp = time();
			$pollTitle = $db->sql_escape_string($pollTitle);
			if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_desc '."VALUES (NULL, '$pollTitle', '$timeStamp', 0, '$alanguage', 0)")) {
				return;
			}
			$object = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc where pollTitle=\''.$pollTitle.'\''));
			$id = $object['pollID'];
			$id = intval($id);
			for($i = 1; $i <= sizeof($optionText); $i++) {
				if (!empty($optionText[$i])) {
					$optionText[$i] = $db->sql_escape_string($optionText[$i]);
				}
				if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_data (pollID, optionText, optionCount, voteID) '."VALUES ('$id', '$optionText[$i]', 0, '$i')")) {
					return;
				}
			}
		} else {
			$haspoll = 0;
			$id = 0;
		}
		$result = $db->sql_query('insert into '.$prefix.'_stories '."values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', 0, 0, '$topic', '$aid', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', 0, 0, '$associated')");
		$result = $db->sql_query('select sid from '.$prefix.'_stories where title=\''.$subject.'\' order by time DESC limit 0,1');
		// tag cloud start
		if ($tags!="") {
			$row = $db->sql_fetchrow($db->sql_query("SELECT sid FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 1"));
			$lastid = intval($row['sid']);
			$tags = explode(",",$tags);
			foreach ($tags as $tag) {
				$tag = $db->sql_escape_string(html_entity_decode(check_html($tag, 'nohtml'),ENT_QUOTES));
				$db->sql_query("INSERT INTO ".$prefix."_tags (tag,cid,whr) VALUES ('".trim($tag)."','$lastid','3')");
			}
		}
		// tag cloud end
		list($artid) = $db->sql_fetchrow($result);
		$db->sql_query('UPDATE '.$prefix.'_poll_desc SET artid='.$artid.' where pollID=\''.$id.'\'');
		if (!$result) {
			exit();
		}
		$result = $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
		Header('Location: '.$admin_file.'.php?op=adminMain');
	}
}

function submissions() {
	global $admin, $bgcolor1, $bgcolor2, $prefix, $db, $radminsuper, $anonymous, $multilingual, $admin_file;
	$dummy = 0;
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center title">'._SUBMISSIONSADMIN.'</div><br />';
	$result = $db->sql_query('SELECT qid, uid, uname, subject, timestamp, alanguage FROM '.$prefix.'_queue order by timestamp DESC');
	if ($db->sql_numrows($result) == 0) {
		echo '<table width="100%"><tr><td bgcolor="'.$bgcolor1.'" class="text-center"><span class="thick">'._NOSUBMISSIONS.'</span>'."\n";
	} else {
		echo '<div class="text-center content thick">'._NEWSUBMISSIONS.'</div>';
		echo '<form action="'.$admin_file.'.php" method="post"><table width="100%" border="1" bgcolor="'.$bgcolor2.'"><tr><td><span class="thick">&nbsp;'._TITLE.'&nbsp;</span></td>';
		if ($multilingual == 1) {
			echo '<td><span class="thick">&nbsp;'._LANGUAGE.'&nbsp;</span></td>';
		}
		echo '<td><span class="thick">&nbsp;'._AUTHOR.'&nbsp;</span></td><td><span class="thick">&nbsp;'._DATE.'&nbsp;</span></td><td><span class="thick">&nbsp;'._FUNCTIONS.'&nbsp;</span></td></tr>'."\n";
		while (list($qid, $uid, $uname, $subject, $timestamp, $alanguage) = $db->sql_fetchrow($result)) {

			echo '<tr><td width="100%">'."\n";
			if (empty($subject)) {
				echo '&nbsp;<a href="'.$admin_file.'.php?op=DisplayStory&amp;qid='.$qid.'">'._NOSUBJECT.'</a>'."\n";
			} else {
				echo '&nbsp;<a href="'.$admin_file.'.php?op=DisplayStory&amp;qid='.$qid.'">'.htmlentities($subject, ENT_QUOTES).'</a>'."\n";
			}
			if ($multilingual == 1) {
				if (empty($alanguage)) {
					$alanguage = _ALL;
				}
				echo '</td><td>&nbsp;'.$alanguage.'&nbsp;'."\n";
			}
			if ($uname != $anonymous) {
				echo '</td><td nowrap="nowrap"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname.'">&nbsp;'.$uname.'&nbsp;</a>'."\n";
			} else {
				echo '</td><td nowrap="nowrap">&nbsp;'.$uname.'&nbsp;'."\n";
			}
			$timestamp = explode(" ", $timestamp);
			echo '</td><td align="right" nowrap="nowrap">&nbsp;'.$timestamp[0].'&nbsp;</td><td class="centered"><a class="rn_csrf" href="'.$admin_file.'.php?op=DeleteStory&amp;qid='.$qid.'">&nbsp;'._DELETE.'</a>&nbsp;</td></tr>'."\n";
			$dummy++;
		}
		if ($dummy < 1) {
			echo '<tr><td bgcolor="'.$bgcolor1.'" class="centered"><span class="thick">'._NOSUBMISSIONS.'</span></td></tr>';
		}
	}
	echo '</table></form>'."\n";
	if ($radminsuper) {
		echo '<div class="text-center"><br />'
		 , '[ <a class="rn_csrf" href="' , $admin_file , '.php?op=subdelete">' , _DELETE , '</a> ]</div>';
	}
	CloseTable();
	include_once 'footer.php';
}

function subdelete() {
	 global $prefix, $db, $admin_file;
	 $db->sql_query('delete from '.$prefix.'_queue');
	 Header('Location: '.$admin_file.'.php?op=adminMain');
}

function newsedit() {
	global $prefix, $db, $admin_file, $tnsl_bAutoTapLinks, $tnsl_bUseShortLinks;
	include ('header.php');
	GraphicAdmin();

	$result = $db->sql_query('SELECT `newsrows`, `bookmark`, `rblocks`, `linklocation`, `articlelink`, `artview`, `TON_useTitleLink`, `TON_usePDF`, `TON_useRating`, `TON_useSendToFriend`, `showtags`, `TON_useCharLimit`, `TON_CharLimit`, `topadact`, `topad`, `bottomadact`, `bottomad`, `usedisqus`, `shortname`, `googlapi`, `usegooglsb`, `usegooglart` FROM `' . $prefix . '_ton`');
	list($newsrows, $bookmark, $rblocks, $linklocation, $articlelink, $artview, $TON_useTitleLink, $TON_usePDF, $TON_useRating, $TON_useSendToFriend, $showtags, $TON_useCharLimit, $TON_CharLimit, $topadact, $topad, $bottomadact, $bottomad, $usedisqus, $shortname, $googlapi, $usegooglsb, $usegooglart) = $db->sql_fetchrow($result);
	if ($bookmark){
		$displaybm =''._YES.'';
	}else{
		$displaybm =''._NO.'';
	}
	if ($rblocks){
		$displayrb =''._YES.'';
	}else{
		$displayrb =''._NO.'';
	}
	if ($articlelink){
		$displayal =''._YES.'';
	}else{
		$displayal =''._NO.'';
	}
	if ($TON_useTitleLink){
		$displaytl =''._YES.'';
	}else{
		$displaytl =''._NO.'';
	}
	if ($TON_usePDF){
		$displaypdf =''._YES.'';
	}else{
		$displaypdf =''._NO.'';
	}
	if ($TON_useRating){
		$displayur =''._YES.'';
	}else{
		$displayur =''._NO.'';
	}
	if ($TON_useSendToFriend){
		$displaysf =''._YES.'';
	}else{
		$displaysf =''._NO.'';
	}
	if ($showtags){
		$displayst =''._YES.'';
	}else{
		$displayst =''._NO.'';
	}
	if ($TON_useCharLimit){
		$displaycl =''._YES.'';
	}else{
		$displaycl =''._NO.'';
	}
	if ($topadact){
		$displayta =''._YES.'';
		$prevtad ='<br />'._TONPREVIEW.'<br />'.ads($topad).'<br />';
	}else{
		$displayta =''._NO.'';
		$prevtad = '';
	}
	if ($bottomadact){
		$displayba =''._YES.'';
		$prevbad ='<br />'._TONPREVIEW.'<br />'.ads($bottomad).'<br />';
	}else{
		$displayba =''._NO.'';
		$prevbad = '';
	}
	if ($usedisqus){
		$displaydis =''._YES.'';
	}else{
		$displaydis =''._NO.'';
	}
	if ($usegooglsb){
		$displaygsb =''._YES.'';
	}else{
		$displaygsb =''._NO.'';
	}
	if ($usegooglart){
		$displayga =''._YES.'';
	}else{
		$displayga =''._NO.'';
	}
	OpenTable();
		echo '<div class="text-center title thick">'._TONCONFIG.'</div>';
		echo '<div class="text-center option thick">'._TONSETUP.'</div><br /><br />'
		.'<form action="'.$admin_file.'.php" method="post"><table border="0" class="centered"><tr><td>'
		.''._NEWSROWS.':</td><td><select name="xnewsrows">'
		.'<option>', $newsrows, '</option>';
	if ($newsrows==2) {
		echo '<option>1</option>';
	}else{
		echo '<option>2</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._BOOKMARK.':</td><td><select name="xbookmark">'
		.'<option value="', $bookmark, '">', $displaybm, '</option>';
	if ($bookmark==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._RBLOCKS.':</td><td><select name="xrblocks">'
		.'<option value="', $rblocks, '">', $displayrb, '</option>';
	if ($rblocks==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._LINKLOCATION.':</td><td><select name="xlinklocation">'
		.'<option>', $linklocation, '</option>';
	if ($linklocation=='bottom'){
		echo '<option>top</option>';
	}else{
		echo '<option>bottom</option>';
	}
		echo'</select>'
		.'</td></tr><tr><td>'
		.''._ARTICLELINK.':</td><td><select name="xarticlelink">'
		.'<option value="', $articlelink, '">', $displayal, '</option>';
	if ($articlelink==0) {
		echo '<option value="1">'._YES.'</option>';

	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._ARTVIEW.':</td><td><select name="xartview">'
		.'<option>', $artview, '</option>';
	if ($artview=='old'){
		echo'<option>new</option>';
	}else{
		echo'<option>old</option>';
	}
		echo'</select>'
		.'</td></tr><tr><td>'
		.''._TONUTL.':</td><td><select name="xTON_useTitleLink">'
		.'<option value="', $TON_useTitleLink, '">', $displaytl, '</option>';
	if ($TON_useTitleLink==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONPDF.':</td><td><select name="xTON_usePDF">'
		.'<option value="', $TON_usePDF, '">', $displaypdf, '</option>';
	if ($TON_usePDF==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONUR.':</td><td><select name="xTON_useRating">'
		.'<option value="', $TON_useRating, '">', $displayur, '</option>';
	if ($TON_useRating==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONSTF.':</td><td><select name="xTON_useSendToFriend">'
		.'<option value="', $TON_useSendToFriend, '">', $displaysf, '</option>';
	if ($TON_useSendToFriend==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONSHOWTAGS.':</td><td><select name="xshowtags">'
		.'<option value="', $showtags, '">', $displayst, '</option>';
	if ($showtags==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONUCL.':</td><td><select name="xTON_useCharLimit">'
		.'<option value="', $TON_useCharLimit, '">', $displaycl, '</option>';
	if ($TON_useCharLimit==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONCL.':</td><td><input type="text" name="xTON_CharLimit" value="', $TON_CharLimit, '" size="4" maxlength="7" />'
		.'</td></tr><tr><td>'
		.''._TONTAACT.':</td><td><select name="xtopadact">'
		.'<option value="', $topadact, '">', $displayta, '</option>';
	if ($topadact==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONTA.'<a href="modules/News/docs/ads.html" class="colorbox"><img src="images/news/question.png" alt="Question" /></a>:</td><td><input type="text" name="xtopad" value="', $topad, '" size="2" maxlength="3" />'
		.'</td></tr><tr><td>'
		.$prevtad
		.'</td></tr><tr><td>'
		.''._TONBAACT.':</td><td><select name="xbottomadact">'
		.'<option value="', $bottomadact, '">', $displayba, '</option>';
	if ($bottomadact==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONBA.'<a href="modules/News/docs/ads.html" class="colorbox"><img src="images/news/question.png" alt="Question" /></a>:</td><td><input type="text" name="xbottomad" value="', $bottomad, '" size="2" maxlength="3" />'
		.'</td></tr><tr><td>'
		.$prevbad
		.'</td></tr><tr><td>';
				echo''._TONDIS.':</td><td><select name="xusedisqus">'
		.'<option value="', $usedisqus, '">', $displaydis, '</option>';
	if ($usedisqus==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>';
if ($usedisqus==1 and $tnsl_bAutoTapLinks==false and $tnsl_bUseShortLinks==true){
					  echo '<span class="thick" style="color:red"> '._TONAUTOLINKWARNING.'</span>';
}
		echo'</td></tr><tr><td>'
		.''._TONSN.'<a href="modules/News/docs/disqus.html" class="colorbox"><img src="images/news/question.png" alt="Question" /></a>:</td><td><input type="text" name="xshortname" value="', $shortname, '" size="15" maxlength="25" />'
		.'</td></tr><tr><td>'
		.''._TONGAPI.'<a href="modules/News/docs/GooglKey.html" class="colorbox"><img src="images/news/question.png" alt="Question" /></a>:</td><td><input type="text" name="xgooglapi" value="', $googlapi, '" size="42" maxlength="44" />'
		.'</td></tr><tr><td>'
		.''._TONGSB.':</td><td><select name="xusegooglsb">'
		.'<option value="', $usegooglsb, '">', $displaygsb, '</option>';
	if ($usegooglsb==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td>'
		.''._TONGA.':</td><td><select name="xusegooglart">'
		.'<option value="', $usegooglart, '">', $displayga, '</option>';
	if ($usegooglart==0) {
		echo '<option value="1">'._YES.'</option>';
	}else{
		echo '<option value="0">'._NO.'</option>';
	}
		echo '</select>'
		.'</td></tr><tr><td class="centered">';
		echo '<input type="hidden" name="op" value="tonSave" />'
		.'<input type="submit" value="'._SAVECHANGES.'" />'
		.'</td></tr></table></form>';
	CloseTable();
	include ('footer.php');
}

function tonSave ($xnewsrows, $xbookmark, $xrblocks, $xlinklocation, $xarticlelink, $xartview, $xTON_useTitleLink, $xTON_usePDF, $xTON_useRating, $xTON_useSendToFriend, $xshowtags, $xTON_useCharLimit, $xTON_CharLimit, $xtopadact, $xtopad, $xbottomadact, $xbottomad, $xusedisqus, $xshortname, $xgooglapi, $xusegooglsb, $xusegooglart) {
	 global $prefix, $db, $admin_file;
	 $xTON_CharLimit = check_html($xTON_CharLimit, 'nohtml');
	 $xshortname = check_html($xshortname, 'nohtml');
	 $xgooglapi = check_html($xgooglapi, 'nohtml');
	 $db->sql_query('UPDATE ' .$prefix . '_ton SET newsrows=\'' . $xnewsrows . '\', bookmark=\'' . $xbookmark . '\', rblocks=\'' . $xrblocks . '\', linklocation=\'' . $xlinklocation . '\', articlelink=\'' . $xarticlelink . '\', artview=\'' . $xartview . '\', TON_useTitleLink=\'' . $xTON_useTitleLink . '\', TON_usePDF=\'' . $xTON_usePDF . '\', TON_useRating=\'' . $xTON_useRating . '\', TON_useSendToFriend=\'' . $xTON_useSendToFriend . '\', showtags=\'' . $xshowtags . '\', TON_useCharLimit=\'' . $xTON_useCharLimit . '\', TON_CharLimit=\'' . $xTON_CharLimit . '\', topadact=\'' . $xtopadact . '\', topad=\'' . $xtopad . '\', bottomadact=\'' . $xbottomadact . '\', bottomad=\'' . $xbottomad . '\', usedisqus=\'' . $xusedisqus . '\', shortname=\'' . $xshortname . '\', googlapi=\'' . $xgooglapi . '\', usegooglsb=\'' . $xusegooglsb . '\', usegooglart=\'' . $xusegooglart . '\'');
	 Header('Location: '.$admin_file.'.php?op=newsedit');
}

?>
