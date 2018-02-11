<?php

/*********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								 */
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* Based on Journey Links Hack								*/
/* Copyright (c) 2000 by James Knickelbein						*/
/* Journey Milwaukee (http://www.journeymilwaukee.com)				*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*													*/
/*********************************************************************/
/*		 Additional security & Abstraction layer conversion			*/
/*						   2003 chatserv					*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com			*/
/*********************************************************************/

if ( !defined('MODULE_FILE') ) {
	die('You can\'t access this file directly...');
}

if (isset($min)) {
	$min = intval($min);
}

if (isset($show)) {
	$show = intval($show);
}

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
	// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._WEBLINKS;
require_once('modules/Web_Links/l_config.php');

if (!isset($l_op)) { $l_op = ''; }
if (!isset($min)) { $min = ''; }
if (!isset($orderby)) { $orderby = ''; }
if (!isset($show)) { $show = ''; }
if (!isset($newlinkshowdays)) { $newlinkshowdays = ''; }
if (!isset($ratenum)) { $ratenum = ''; }
if (!isset($ratetype)) { $ratetype = ''; }
if (!isset($query)) { $query = ''; }

switch($l_op) {
	case 'AddLink':
		if ($allowlinksadd) AddLink();
		break;

	case 'NewLinks':
		NewLinks($newlinkshowdays);
		break;

	case 'NewLinksDate':
		NewLinksDate($selectdate);
		break;

	case 'TopRated':
		TopRated($ratenum, $ratetype);
		break;

	case 'MostPopular':
		MostPopular($ratenum, $ratetype);
		break;

	case 'RandomLink':
		RandomLink();
		break;

	case 'viewlink':
		viewlink($cid, $min, $orderby, $show);
		break;

	case 'brokenlink':
		brokenlink($lid);
		break;

	case 'modifylinkrequest':
		if ($allowlinksmodify) modifylinkrequest($lid);
		break;

	case 'modifylinkrequestS':
		csrf_check();
		if ($allowlinksmodify) modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter);
		break;

	case 'brokenlinkS':
		csrf_check();
		brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter);
		break;

	case 'visit':
		visit($lid);
		break;

	case 'Add':
		csrf_check();
		Add($title, $url, $auth_name, $cat, $description, $email);
		break;

	case 'search':
		search($query, $min, $orderby, $show);
		break;

	case 'rateinfo':
		rateinfo($lid, $user, $title);
		break;

	case 'ratelink':
		ratelink($lid, $user);
		break;

	case 'addrating':
		csrf_check();
		addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments);
		break;

	case 'viewlinkcomments':
		viewlinkcomments($lid);
		break;

	case 'outsidelinksetup':
		outsidelinksetup($lid);
		break;

	case 'viewlinkeditorial':
		viewlinkeditorial($lid);
		break;

	case 'viewlinkdetails':
		viewlinkdetails($lid);
		break;

	default:
		index();
		break;
}

//Only functions after this line

function getparent($parentid,$title) {
	global $prefix, $db;
	$parentid = intval($parentid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT cid, title, parentid from '.$prefix.'_links_categories where cid=\''.$parentid.'\''));
	$cid = $row['cid'];
	$ptitle = check_html($row['title'], 'nohtml');
	$pparentid = $row['parentid'];
	if (!empty($ptitle)) $title = $ptitle.'/'.$title;
	if ($pparentid!=0) {
		$title=getparent($pparentid,$title);
	}
	return $title;
}

function getparentlink($parentid,$title) {
	global $prefix, $db, $module_name;
	$parentid = intval($parentid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT cid, title, parentid from '.$prefix.'_links_categories where cid=\''.$parentid.'\''));
	$cid = $row['cid'];
	$ptitle = check_html($row['title'], 'nohtml');
	$pparentid = $row['parentid'];
	if (!empty($ptitle)) $title='<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'">'.$ptitle.'</a>/'.$title;
	if ($pparentid!=0) {
		$title=getparentlink($pparentid,$ptitle);
	}
	return $title;
}

function menu($mainlink) {
	global $module_name, $query, $allowlinksadd;
	$query = htmlspecialchars(check_html($query, 'nohtml'), ENT_QUOTES, _CHARSET);
	OpenTable();
	$ThemeSel = get_theme();
	echo '<div class="content" align="center">';
	if (file_exists('themes/'.$ThemeSel.'/images/link-logo.gif')) {
		echo '<br /><a href="modules.php?name='.$module_name.'"><img src="themes/'.$ThemeSel.'/images/link-logo.gif" border="0" alt="" /></a><br /><br />';
	} else {
		echo '<br /><a href="modules.php?name='.$module_name.'"><img src="modules/'.$module_name.'/images/link-logo.gif" border="0" alt="" /></a><br /><br />';
	}
	echo '<form action="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$query.'" method="post">'
		.'<input type="text" size="25" name="query" />&nbsp;<input type="submit" value="'._SEARCH.'" />'
		.'</form><p>';
	echo '[ ';
	if ($mainlink>0) {
		echo '<a href="modules.php?name='.$module_name.'">'._LINKSMAIN.'</a> | ';
	}
	if ($allowlinksadd) echo '<a href="modules.php?name='.$module_name.'&amp;l_op=AddLink">'._ADDLINK.'</a> | ';
	echo '<a href="modules.php?name='.$module_name.'&amp;l_op=NewLinks">'._NEW.'</a>';
	echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular">'._POPULAR.'</a>';
	echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=TopRated">'._TOPRATED.'</a>';
	echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=RandomLink">'._RANDOM.'</a> ]';
	echo '</p>  </div>';
	CloseTable();
}

function linkinfomenu($lid) {
	global $module_name, $user, $allowlinksmodify;
	echo '<br /><span class="content">[ '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._LINKCOMMENTS.'</a>'
		.' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._ADDITIONALDET.'</a>'
		.' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkeditorial&amp;lid='.$lid.'">'._EDITORREVIEW.'</a>';
	if ($allowlinksmodify) echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=modifylinkrequest&amp;lid='.$lid.'">'._MODIFY.'</a>';
	if (is_user($user)) {
		echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=brokenlink&amp;lid='.$lid.'">'._REPORTBROKEN.'</a>';
	}
	echo ' ]</span>';
}

function index() {
	global $prefix, $db;
	include_once('header.php');
	$mainlink = 0;
	menu($mainlink);
	echo '<br />';
	OpenTable();
	echo '<div class="content"><p align="center"><span class="title">'._LINKSMAINCAT.'</span></p>';
	echo '<table border="0" cellspacing="10" cellpadding="0" align="center" width="100%"><tr>';
	$result = $db->sql_query('select cid, title, cdescription from '.$prefix.'_links_categories where parentid=0 order by title');
	$dum = 0;
	$count = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$cid = $row['cid'];
		$title = check_html($row['title'], 'nohtml');
		$cdescription = $row['cdescription'];
		echo '<td valign="top" width="45%"><span class="option"><strong><span class="larger">&middot;</span></strong> <a href="modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid='.$cid.'"><span class="thick">'.$title.'</span></a></span>';
		categorynewlinkgraphic($cid);
		if ($cdescription) {
			echo '<br /><div>' . htmlspecialchars($cdescription, ENT_QUOTES, _CHARSET) . '</div><br />';
		} else {
			echo '<br />';
		}
		$result2 = $db->sql_query('SELECT cid, title from '.$prefix.'_links_categories where parentid=\''.$cid.'\' order by title limit 0,3');
		$space = 0;
		while ($row2 = $db->sql_fetchrow($result2)) {
			$cid = $row2['cid'];
			$stitle = check_html($row2['title'], 'nohtml');
			if ($space>0) {
				echo ',&nbsp;';
			}
			echo '<a href="modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid='.$cid.'">'.$stitle.'</a>';
			$space++;
		}
		if ($count<1) {
			echo '</td><td width="10%">&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$dum = 1;
		}
		$count++;
		if ($count==2) {
			echo '</td></tr><tr>';
			$count = 0;
			$dum = 0;
		}
	}
	if ($dum == 1) {
		echo '</tr></table>';
	} elseif ($dum == 0) {
		echo '<td></td></tr></table>';
	}
	$result3 = $db->sql_query('SELECT * from '.$prefix.'_links_links');
	$numrows = $db->sql_numrows($result3);
	$result4 = $db->sql_query('SELECT * from '.$prefix.'_links_categories');
	$catnum = $db->sql_numrows($result4);
	$numrows = $numrows;
	$catnum = $catnum;
	echo '<br /><br /><div class="text-center">'._THEREARE.' <span class="thick">'.$numrows.'</span> '._LINKS.' '._AND.' <span class="thick">'.$catnum.'</span> '._CATEGORIES.' '._INDB.'</div>'
		. '</div>';
	CloseTable();
	include_once('footer.php');
}

function AddLink() {
	global $prefix, $db, $user, $links_anonaddlinklock, $module_name;
	include_once('header.php');
	$mainlink = 1;
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="text-center title thick">' , _ADDALINK , '</div><br /><br />';
	//montego RN0000571 - Add check for no categories - must have at least one category created prior to attempting a link add
	$result = $db->sql_query('SELECT cid, title, parentid from '.$prefix.'_links_categories order by parentid,title');
	if ($db->sql_numrows($result) < 1) {
		echo '<div class="text-center">'._LINKSNOCATS1.'<br />'
			._LINKSNOCATS2.'</div>';
	} else { //continue on with legacy code
		if (is_user($user) || $links_anonaddlinklock == 1) {  /* 06-24-01 Bug fix : changed $links_anonaddlinklock != 1 to $links_anonaddlinklock == 1 */
			echo '<p class="thick">'._INSTRUCTIONS.':</p><ul>'
				.'<li>'._SUBMITONCE.'</li>'
				.'<li>'._POSTPENDING.'</li>'
				.'<li>'._USERANDIP.'</li>'
				.'</ul><form method="post" action="modules.php?name='.$module_name.'&amp;l_op=Add">'
				.'<span class="thick">'._PAGETITLE.':</span> <input type="text" name="title" size="50" maxlength="100" /><br />'
				.'<span class="thick">'._PAGEURL.':</span> <input type="text" name="url" size="50" maxlength="100" value="http://" /><br />'
				.'<span class="thick">'._CATEGORY.':</span> <select name="cat">';
			while ($row = $db->sql_fetchrow($result)) {
				$cid2 = $row['cid'];
				$ctitle2 = check_html($row['title'], 'nohtml');
				$parentid2 = $row['parentid'];
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
					echo '<option value="'.$cid2.'">'.$ctitle2.'</option>';
			}
			echo '</select><br /><br />'
				.'<span class="thick">'._LDESCRIPTION.'</span><br /><textarea name="description" cols="60" rows="5"></textarea><br /><br />'
				.'<span class="thick">'._YOURNAME.':</span> <input type="text" name="auth_name" size="30" maxlength="60" /><br />'
				.'<span class="thick">'._YOUREMAIL.':</span> <input type="text" name="email" size="30" maxlength="60" /><br /><br />';
			/*****[BEGIN]******************************************
			 [ Base:	GFX Code						   v1.0.0 ]
			 ******************************************************/
			global $modGFXChk;
			echo security_code($modGFXChk[$module_name], 'stacked').'<br />';
			/*****[END]********************************************
			 [ Base:	GFX Code						   v1.0.0 ]
			 ******************************************************/
			echo '<input type="hidden" name="l_op" value="Add" />'
				.'<input type="submit" value="'._ADDURL.'" /> '._GOBACK.'<br /><br />'
				.'</form>';
		} else {
			echo '<div class="text-center">'._LINKSNOTUSER1.'<br />'
				._LINKSNOTUSER2.'<br /><br />'
				._LINKSNOTUSER3.'<br />'
				._LINKSNOTUSER4.'<br />'
				._LINKSNOTUSER5.'<br />'
				._LINKSNOTUSER6.'<br />'
				._LINKSNOTUSER7.'<br /><br />'
				._LINKSNOTUSER8.'</div>';
		}
	} //End add IF by montego
	CloseTable();
	include_once('footer.php');
}

function Add($title, $url, $auth_name, $cat, $description, $email) {
	global $prefix, $db, $user, $links_anonaddlinklock;
	/*****[BEGIN]******************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	 ******************************************************/
	global $modGFXChk, $module_name;
	$submitter = '';
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once 'header.php';
		OpenTable();
		echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
			, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	/*****[END]********************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	if (is_user($user) || $links_anonaddlinklock == 1) { //RN0000530 - Disable anonymous exploits!
		// RN0000999 - moved the following four lines in the code to ensure $url is filtered prior to use
		$title = addslashes(check_html($title, 'nohtml'));
		$url = addslashes(check_html($url, 'nohtml'));
		$description = addslashes(check_html($description, 'html'));
		$auth_name = addslashes(check_html($auth_name, 'nohtml'));
		$result = $db->sql_query('SELECT url from '.$prefix.'_links_links where url=\''.$url.'\'');
		$numrows = $db->sql_numrows($result);
		if ($numrows > 0) {
			include_once('header.php');
			menu(1);
			echo '<br />';
			OpenTable();
			echo '<div class="text-center"><span class="thick">'._LINKALREADYEXT.'</span><br /><br />'
				._GOBACK.'</div>';
			CloseTable();
			include_once('footer.php');
		} else {
			if(is_user($user)) {
				$user2 = base64_decode($user);
				$user2 = addslashes($user2);
				$cookie = explode(':', $user2);
				cookiedecode($user);
				$submitter = $cookie[1];
			}
			// Check if Title exist
			if (empty($title)) {
				include_once('header.php');
				menu(1);
				echo '<br />';
				OpenTable();
				echo '<div class="text-center"><span class="thick">'._LINKNOTITLE.'</span><br /><br />'
					._GOBACK.'</div>';
				CloseTable();
				include_once('footer.php');
				die();
			}
			// Check if URL exist
			if (empty($url)) {
				include_once('header.php');
				menu(1);
				echo '<br />';
				OpenTable();
				echo '<div class="text-center"><span class="thick">'._LINKNOURL.'</span><br /><br />'
					._GOBACK.'</div>';
				CloseTable();
				include_once('footer.php');
				die();
			}
			// Check if Description exist
			if (empty($description)) {
				include_once('header.php');
				menu(1);
				echo '<br />';
				OpenTable();
				echo '<div class="text-center"><span class="thick">'._LINKNODESC.'</span><br /><br />'
					._GOBACK.'</div>';
				CloseTable();
				include_once('footer.php');
				die();
			}
			$cat = explode('-', $cat);
			if (empty($cat[1])) {
				$cat[1] = 0;
			}
			if (!empty($email)) {
				if (($email = validate_mail(stripslashes(check_html($email, 'nohtml')))) === false) {
					$email = '';
					//die();
				}
			}
			$cat[0] = intval($cat[0]);
			$cat[1] = intval($cat[1]);
			$num_new = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_newlink WHERE title=\''.$title.'\' OR url=\''.$url.'\' OR description=\''.$description.'\''));
			if ($num_new == 0) {
				$db->sql_query('insert into '.$prefix.'_links_newlink values (NULL, \''.$cat[0].'\', \''.$cat[1].'\', \''.$title.'\', \''.$url.'\', \''.
				  $description.'\', \''.$auth_name.'\', \''.$email.'\', \''.$submitter.'\')');
			}
			include_once('header.php');
			menu(1);
			echo '<br />';
			OpenTable();
			echo '<div class="text-center"><span class="thick">'._LINKRECEIVED.'</span><br />';
			if (!empty($email)) {
				echo _EMAILWHENADD;
			} else {
				echo _CHECKFORIT;
			}
			echo '</div>';
			CloseTable();
			include_once('footer.php');
		}
	} else { //RN0000530 - Start of Disable anonymous exploits!
		menu(1);
		echo '<br />';
		OpenTable();
		echo '<div class="text-center">'._LINKSNOTUSER1.'<br />'
			._LINKSNOTUSER2.'<br /><br />'
			._LINKSNOTUSER3.'<br />'
			._LINKSNOTUSER4.'<br />'
			._LINKSNOTUSER5.'<br />'
			._LINKSNOTUSER6.'<br />'
			._LINKSNOTUSER7.'<br /><br />'
			._LINKSNOTUSER8.'</div>';
		CloseTable();
		include_once('footer.php');
	} //RN0000530 - End of Disable anonymous exploits!
}

function NewLinks($newlinkshowdays) {
	global $prefix, $db, $module_name;
	include_once('header.php');
	$newlinkshowdays = intval(trim($newlinkshowdays));
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' , _NEWLINKS , '</div><br />';
	$counter = 0;
	$allweeklinks = 0;
	while ($counter <= 7-1){
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkday = date('d-M-Y', $newlinkdayRaw);
		$newlinkView = date('F d, Y', $newlinkdayRaw);
		$newlinkDB = Date('Y-m-d', $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_links WHERE date LIKE \'%'.$newlinkDB.'%\''));
		$counter++;
		$allweeklinks = $allweeklinks + $totallinks;
	}
	$counter = 0;
	$allmonthlinks = 0;
	while ($counter <=30-1){
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkDB = Date('Y-m-d', $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_links WHERE date LIKE \'%'.$newlinkDB.'%\''));
		$allmonthlinks = $allmonthlinks + $totallinks;
		$counter++;
	}
	echo '<div class="text-center"><span class="thick">'._TOTALNEWLINKS.':</span> '._LASTWEEK.' - '.$allweeklinks.' \ '._LAST30DAYS.' - '.$allmonthlinks.'<br />'
		._SHOW.': <a href="modules.php?name='.$module_name.'&amp;l_op=NewLinks&amp;newlinkshowdays=7">'._1WEEK.'</a> - <a href="modules.php?name='.$module_name.'&amp;l_op=NewLinks&amp;newlinkshowdays=14">'._2WEEKS.'</a> - <a href="modules.php?name='.$module_name.'&amp;l_op=NewLinks&amp;newlinkshowdays=30">'._30DAYS.'</a>'
		.'</div><br />';
	/* List Last VARIABLE Days of Links */
	if ($newlinkshowdays <= 0) $newlinkshowdays = 7;
	echo '<br /><div class="text-center"><span class="thick">'._TOTALFORLAST.' '.$newlinkshowdays.' '._DAYS.':</span><br /><br />';
	$counter = 0;
	$allweeklinks = 0;
	while ($counter <= $newlinkshowdays-1) {
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkday = date('d-M-Y', $newlinkdayRaw);
		$newlinkView = date('F d, Y', $newlinkdayRaw);
		$newlinkDB = Date('Y-m-d', $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_links WHERE date LIKE \'%'.$newlinkDB.'%\''));
		$counter++;
		$allweeklinks = $allweeklinks + $totallinks;
		echo '<strong><span class="larger">&middot;</span></strong> <a href="modules.php?name=Web_Links&amp;l_op=NewLinksDate&amp;selectdate='.$newlinkdayRaw.'">'.$newlinkView.'</a>&nbsp;('.$totallinks.')<br />';
	}
	$counter = 0;
	$allmonthlinks = 0;
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function NewLinksDate($selectdate) {
	global $prefix, $db, $module_name, $admin, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$radminsuper = is_mod_admin($module_name);
	$dateDB = (date('d-M-Y', $selectdate));
	$dateView = (date('F d, Y', $selectdate));
	include_once('header.php');
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="content">';
	$newlinkDB = Date('Y-m-d', $selectdate);
	$totallinks = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_links WHERE date LIKE \'%'.$newlinkDB.'%\''));
	echo '<span class="option thick">'.$dateView.' - '.$totallinks.' '._NEWLINKS.'</span>'
		.'<table width="100%" cellspacing="0" cellpadding="10" border="0"><tr><td>';
	$result2 = $db->sql_query('SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where date LIKE \'%'.$newlinkDB.'%\' order by title ASC');
	while ($row2 = $db->sql_fetchrow($result2)) {
		$lid = $row2['lid'];
		$cid = $row2['cid'];
		$sid = $row2['sid'];
		$title = check_html($row2['title'], 'nohtml');
		$description = $row2['description'];
		$time = $row2['date'];
		$hits = $row2['hits'];
		$linkratingsummary = $row2['linkratingsummary'];
		$totalvotes = $row2['totalvotes'];
		$totalcomments = $row2['totalcomments'];
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="new">'.$title.'</a>';
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo '<br /><span class="thick">'._DESCRIPTION.':</span> <div>'.htmlspecialchars($description, ENT_QUOTES, _CHARSET).'</div><br />';
		setlocale (LC_TIME, $locale);
		/* INSERT code for *editor review* here */
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo '<span class="thick">'._ADDEDON.':</span> '.$datetime.' <span class="thick">'._HITS.':</span> '.$hits;
		$transfertitle = str_replace (' ', '_', $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!='0' || $linkratingsummary!='0.0') {
			echo ' <span class="thick">'._RATING.':</span> '.$linkratingsummary.' ('.$totalvotes.' '.$votestring.')';
		}
		echo '<br />';
		if ($radminsuper == 1) {
			echo '<a href="'.$admin_file.'.php?op=LinksModLink&amp;lid='.$lid.'">'._EDIT.'</a> | ';
		}
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATESITE.'</a>';
		if (is_user($user)) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=brokenlink&amp;lid='.$lid.'">'._REPORTBROKEN.'</a>';
		}
		if ($totalvotes != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._DETAILS.'</a>';
		}
		if ($totalcomments != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._SCOMMENTS.' ('.$totalcomments.')</a>';
		}
		detecteditorial($lid);
		echo '<br />';
		$row3 = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_links_categories where cid=\''.$cid.'\''));
		$ctitle = check_html($row3['title'], 'nohtml');
		$ctitle=getparent($cid,$ctitle);
		echo '<span class="thick">'._CATEGORY.':</span> '.$ctitle;
		echo '<br /><br />';
	}
	echo '</td></tr></table></div>';
	CloseTable();
	include_once('footer.php');
}

function TopRated($ratenum, $ratetype) {
	global $prefix, $db, $admin, $module_name, $user, $locale, $mainvotedecimal, $datetime;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="content">';
	if (!empty($ratenum) && !empty($ratetype)) {
		$ratenum = intval($ratenum);
		$ratetype = htmlentities($ratetype);
		$toplinks = $ratenum;
		if ($ratetype == 'percent') {
			$toplinkspercentrigger = 1;
		}
	}
	if ($toplinkspercentrigger == 1) {
		$toplinkspercent = $toplinks;
		$totalratedlinks = $db->sql_numrows($db->sql_query('SELECT * from '.$prefix.'_links_links where linkratingsummary != \'0\''));
		$toplinks = $toplinks / 100;
		$toplinks = $totalratedlinks * $toplinks;
		$toplinks = round($toplinks);
	}
	if ($toplinkspercentrigger == 1) {
		echo '<div class="text-center option thick">'._BESTRATED.' '.$toplinkspercent.'% ('._OF.' '.$totalratedlinks.' '._TRATEDLINKS.')</div><br />';
	} else {
		echo '<div class="text-center option thick">'._BESTRATED.' '.htmlentities($toplinks).' </div><br />';
	}
	echo '<br />'
		.'<div class="text-center">'._NOTE.' '.$linkvotemin.' '._TVOTESREQ.'<br />'
		._SHOWTOP.':  [ <a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=num">10</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=25&amp;ratetype=num">25</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=50&amp;ratetype=num">50</a> | '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=1&amp;ratetype=percent">1%</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=5&amp;ratetype=percent">5%</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=percent">10%</a> ]</div><br /><br />';
	$result = $db->sql_query('SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where linkratingsummary != 0 and totalvotes >= '.$linkvotemin.' order by linkratingsummary DESC limit 0,'.$toplinks);
	while ($row = $db->sql_fetchrow($result)) {
		$lid = $row['lid'];
		$cid = $row['cid'];
		$sid = $row['sid'];
		$title = check_html($row['title'], 'nohtml');
		$description = $row['description'];
		$time = $row['date'];
		$hits = $row['hits'];
		$linkratingsummary = $row['linkratingsummary'];
		$totalvotes = $row['totalvotes'];
		$totalcomments = $row['totalcomments'];
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="new">'.$title.'</a>';
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo '<br />';
		echo '<span class="thick">'._DESCRIPTION.':</span> <div>'.$description.'</div><br />';
		setlocale (LC_TIME, $locale);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo '<span class="thick">'._ADDEDON.':</span> '.$datetime.' <span class="thick">'._HITS.':</span> '.$hits;
		$transfertitle = str_replace (' ', '_', $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!='0' || $linkratingsummary!='0.0') {
			echo ' <span class="thick">'._RATING.':</span> '.$linkratingsummary.' ('.$totalvotes.' '.$votestring.')';
		}
		echo '<br /><a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATESITE.'</a>';
		if (is_user($user)) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=brokenlink&amp;lid='.$lid.'">'._REPORTBROKEN.'</a>';
		}
		if ($totalvotes != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._DETAILS.'</a>';
		}
		if ($totalcomments != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._SCOMMENTS.' ('.$totalcomments.')</a>';
		}
		detecteditorial($lid);
		echo '<br />';
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_links_categories where cid=\''.$cid.'\''));
		$ctitle = $row2['title'];
		$ctitle = getparent($cid,$ctitle);
		echo '<span class="thick">'._CATEGORY.':</span> '.$ctitle;
		echo '<br /><br />';
		echo '<br /><br />';
	}
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function MostPopular($ratenum, $ratetype) {
	global $prefix, $db, $admin, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$radminsuper = is_mod_admin($module_name);
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="content"><div class="text-center">';
	if (!empty($ratenum) && !empty($ratetype)) {
		$ratenum = intval($ratenum);
		$ratetype = htmlentities($ratetype);
		$mostpoplinks = $ratenum;
		if ($ratetype == 'percent') $mostpoplinkspercentrigger = 1;
	}
	if ($mostpoplinkspercentrigger == 1) {
		$toplinkspercent = $mostpoplinks;
		$result2 = $db->sql_query('SELECT * from '.$prefix.'_links_links');
		$totalmostpoplinks = $db->sql_numrows($result2);
		$mostpoplinks = $mostpoplinks / 100;
		$mostpoplinks = $totalmostpoplinks * $mostpoplinks;
		$mostpoplinks = round($mostpoplinks);
	}
	if ($mostpoplinkspercentrigger == 1) {
		echo '<div class="text-center option thick">'._MOSTPOPULAR.' '.$toplinkspercent.'% ('._OFALL.' '.$totalmostpoplinks.' '._LINKS.')</div>';
	} else {
		echo '<div class="text-center option thick">'._MOSTPOPULAR.' '.htmlentities($mostpoplinks).'</div>';
	}
	echo '<br />'._SHOWTOP.': [ <a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=num">10</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=25&amp;ratetype=num">25</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=50&amp;ratetype=num">50</a> | '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=1&amp;ratetype=percent">1%</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=5&amp;ratetype=percent">5%</a> - '
		.'<a href="modules.php?name='.$module_name.'&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=percent">10%</a> ]<br /><br />';
	if(!is_numeric($mostpoplinks)) {
		$mostpoplinks=10;
	}
	$result3 = $db->sql_query('SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links order by hits DESC limit 0,'.$mostpoplinks);
	echo '</div><br /><br /> ';
	while($row3 = $db->sql_fetchrow($result3)) {
		$lid = $row3['lid'];
		$cid = $row3['cid'];
		$sid = $row3['sid'];
		$title = check_html($row3['title'], 'nohtml');
		$description = $row3['description'];
		$time = $row3['date'];
		$hits = $row3['hits'];
		$linkratingsummary = $row3['linkratingsummary'];
		$totalvotes = $row3['totalvotes'];
		$totalcomments = $row3['totalcomments'];
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="new">'.$title.'</a>';
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo '<br />';
		echo '<span class="thick">'._DESCRIPTION.':</span> <div>'.$description.'</div><br />';
		setlocale (LC_TIME, $locale);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$datetime = strftime(''._LINKSDATESTRING.'', mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo '<span class="thick">'._ADDEDON.':</span> '.$datetime.' <span class="thick">'._HITS.':</span> '.$hits;
		$transfertitle = str_replace (' ', '_', $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!='0' || $linkratingsummary!='0.0') {
			echo ' <span class="thick">'._RATING.':</span> '.$linkratingsummary.' ('.$totalvotes.' '.$votestring.')';
		}
		echo '<br />';
		if ($radminsuper == 1) {
			echo '<a href="'.$admin_file.'.php?op=LinksModLink&amp;lid='.$lid.'">'._EDIT.'</a> | ';
		}
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATESITE.'</a>';
		if (is_user($user)) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=brokenlink&amp;lid='.$lid.'">'._REPORTBROKEN.'</a>';
		}
		if ($totalvotes != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._DETAILS.'</a>';
		}
		if ($totalcomments != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._SCOMMENTS.' ('.$totalcomments.')</a>';
		}
		detecteditorial($lid);
		echo '<br />';
		$row4 = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_links_categories where cid=\''.$cid.'\''));
		$ctitle = check_html($row4['title'], 'nohtml');
		$ctitle=getparent($cid,$ctitle);
		echo '<span class="thick">'._CATEGORY.':</span> '.$ctitle;
		echo '<br /><br /><br />';
	}
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function RandomLink() {
	global $prefix, $db, $module_name;
	$result = $db->sql_query('SELECT `lid`, `url` FROM `' . $prefix . '_links_links` ORDER BY RAND() LIMIT 1');
	$numrows = $db->sql_numrows($result);
	if ($numrows < 1) {-
		$url = 'modules.php?name=' . $module_name;
	} else {
		list($lid, $url) = $db->sql_fetchrow($result, SQL_NUM);
		$db->sql_query('UPDATE `' . $prefix . '_links_links` SET `hits`= hits + 1 WHERE `lid`="' . $lid . '"');
	}
	Header('Location: ' . $url);
}

function viewlink($cid, $min, $orderby, $show) {
	global $prefix, $db, $admin, $perpage, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$show = intval($show);
	if (empty($show)) {
		$show = '';
	}
	if (!empty($orderby)) {
		$orderby = htmlspecialchars($orderby, ENT_QUOTES, _CHARSET);
	}
	$radminsuper = is_mod_admin($module_name);
	include_once('header.php');
	if (!isset($min)) $min = 0;
	if (!isset($max)) $max=(int)$min+$perpage;
	if(!empty($orderby)) {
		$orderby = convertorderbyin($orderby);
	} else {
		$orderby = 'title ASC';
	}
	if (!empty($show)) {
		$perpage = $show;
	} else {
		$show=$perpage;
	}
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="content">';
	$cid = intval($cid);
	$row_two = $db->sql_fetchrow($db->sql_query('SELECT title, parentid FROM '.$prefix.'_links_categories WHERE cid=\''.$cid.'\''));
	$title = check_html($row_two['title'], 'nohtml');
	$parentid = $row_two['parentid'];
	$title = getparentlink($parentid,$title);
	$title = '<a href="modules.php?name='.$module_name.'">'._MAIN.'</a>/'.$title.'';
	echo '<div class="text-center option thick">'._CATEGORY.': '.$title.'</div><br />';
	echo '<table border="0" cellspacing="10" cellpadding="0" align="center" width="100%"><tr>';
	$cdescription = '';
	$result2 = $db->sql_query('SELECT cid, title, cdescription from '.$prefix.'_links_categories where parentid=\''.$cid.'\' order by title');
	$dum = 0;
	$count = 0;
	while($row2 = $db->sql_fetchrow($result2)) {
		$cid2 = $row2['cid'];
		$title2 = check_html($row2['title'], 'nohtml');
		$cdescription2 = $row2['cdescription'];
		echo '<td valign="top" width="45%"><span class="option"><strong><span class="larger">&middot;</span></strong> <a href="modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid='.$cid2.'"><span class="thick">'.$title2.'</span></a></span>';
		categorynewlinkgraphic($cid2);
		if ($cdescription) {
			echo '<div>'.$cdescription2.'</div><br />';
		} else {
			echo '<br />';
		}
		$result3 = $db->sql_query('SELECT cid, title from '.$prefix.'_links_categories where parentid=\''.$cid2.'\' order by title limit 0,3');
		$space = 0;
		while($row3 = $db->sql_fetchrow($result3)) {
			$cid3 = $row3['cid'];
			$title3 = check_html($row3['title'], 'nohtml');
			if ($space>0) {
				echo ',&nbsp;';
			}
			echo '<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid3.'">'.$title3.'</a>';
			$space++;
		}
		if ($count<1) {
			echo '</td><td width="10%">&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$dum = 1;
		}
		$count++;
		if ($count==2) {
			echo '</td></tr><tr>';
			$count = 0;
			$dum = 0;
		}
	}
	if ($dum == 1) {
		echo "</tr></table>";
	} elseif ($dum == 0) {
		echo "<td></td></tr></table>";
	}

	echo '<hr noshade="noshade" size="1" />';
	$orderbyTrans = convertorderbytrans($orderby);
	echo '<div class="text-center">'._SORTLINKSBY.': '
		._TITLE.' (<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=titleA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=titleD">D</a>) '
		._DATE.' (<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=dateA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=dateD">D</a>) '
		._RATING.' (<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=ratingA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=ratingD">D</a>) '
		._POPULARITY.' (<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=hitsA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;orderby=hitsD">D</a>)'
		.'<br /><span class="thick">'._SITESSORTED.': '.$orderbyTrans.'</span></div><br /><br />';
	if(!is_numeric($min)){
		$min=0;
	}
	$result4 = $db->sql_query('SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where cid=\''.$cid.'\' order by '.$orderby.' limit '.$min.','.$perpage.'');
	$fullcountresult = $db->sql_query('SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where cid=\''.$cid.'\'');
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
	echo '<table width="100%" cellspacing="0" cellpadding="10" border="0"><tr><td>';
	$x=0;
	while($row4 = $db->sql_fetchrow($result4)) {
		$lid = $row4['lid'];
		$title = check_html($row4['title'], 'nohtml');
		$description = $row4['description'];
		$time = $row4['date'];
		$hits = $row4['hits'];
		$linkratingsummary = $row4['linkratingsummary'];
		$totalvotes = $row4['totalvotes'];
		$totalcomments = $row4['totalcomments'];
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="new"><span class="thick">'.$title.'</span></a>';
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		/* INSERT code for *editor review* here */
		echo '<br />';
		echo '<span class="thick">'._DESCRIPTION.':</span> <div>'.htmlspecialchars($description, ENT_QUOTES, _CHARSET).'</div><br />';
		setlocale (LC_TIME, $locale);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo '<span class="thick">'._ADDEDON.':</span> '.$datetime.' <span class="thick">'._HITS.': </span> '.$hits;
		$transfertitle = str_replace (' ', '_', $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!='0' || $linkratingsummary!='0.0') {
			echo ' <span class="thick">'._RATING.':</span> '.$linkratingsummary.' ('.$totalvotes.' '.$votestring.')';
		}
		echo '<br />';
		if ($radminsuper == 1) {
			echo '<a href="'.$admin_file.'.php?op=LinksModLink&amp;lid='.$lid.'">'._EDIT.'</a> | ';
		}
		echo '<a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATESITE.'</a>';
		if (is_user($user)) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=brokenlink&amp;lid='.$lid.'">'._REPORTBROKEN.'</a>';
		}
		echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._DETAILS.'</a>';
		if ($totalcomments != 0) {
			echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._SCOMMENTS.' ('.$totalcomments.')</a>';
		}
		detecteditorial($lid);
		echo '<br /><br />';
		$x++;
	}
	$orderby = convertorderbyout($orderby);
	/* Calculates how many pages exist. Which page one should be on, etc... */
	$linkpagesint = ($totalselectedlinks / $perpage);
	$linkpageremainder = ($totalselectedlinks % $perpage);
	if ($linkpageremainder != 0) {
		$linkpages = ceil($linkpagesint);
		if ($totalselectedlinks < $perpage) {
			$linkpageremainder = 0;
		}
	} else {
		$linkpages = $linkpagesint;
	}
	/* Page Numbering */
	if ($linkpages!=1 && $linkpages!=0) {
		echo '<br /><br />';
		echo _SELECTPAGE.': ';
		$prev=$min-$perpage;
		if ($prev>=0) {
			echo '&nbsp;&nbsp;<span class="thick">[ <a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;min='.$prev.'&amp;orderby='.$orderby.'&amp;show='.$show.'">';
			echo ' &lt;&lt; '._PREVIOUS.'</a> ]</span> ';
		}
		$counter = 1;
		$currentpage = ($max / $perpage);
		while ($counter<=$linkpages ) {
			$cpage = $counter;
			$mintemp = ($perpage * $counter) - $perpage;
			if ($counter == $currentpage) {
				echo '<span class="thick">'.$counter.'</span>&nbsp;';
			} else {
				echo '<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;min='.$mintemp.'&amp;orderby='.$orderby.'&amp;show='.$show.'">'.$counter.'</a> ';
			}
			$counter++;
		}
		$next=$min+$perpage;
		if ($x>=$perpage) {
			echo '&nbsp;&nbsp;<span class="thick">[ <a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'&amp;min='.$max.'&amp;orderby='.$orderby.'&amp;show='.$show.'">';
			echo ' '._NEXT.' &gt;&gt;</a> ]</span> ';
		}
	}
	echo '</td></tr></table></div>';
	CloseTable();
	include_once('footer.php');
}

function newlinkgraphic($datetime, $time) {
	global $module_name, $locale;
	echo '&nbsp;';
	setlocale (LC_TIME, $locale);
	preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
	$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	// BEGIN: 0001257: Images in Weblinks doesnt display
	$startdate = strftime("%G-%m-%d %T");
	preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $startdate, $daysold);
	$daysold = strftime(_LINKSDATESTRING, mktime(intval($daysold[4]),intval($daysold[5]),intval($daysold[6]),intval($daysold[2]),intval($daysold[3]),intval($daysold[1])));
	$daysold = ucfirst($daysold);
	// END: 0001257: Images in Weblinks doesnt display
	$count = 0;
	while ($count <= 7) {
		if ($daysold == $datetime) {
			if ($count<=1) {
				echo '<img src="modules/'.$module_name.'/images/newred.gif" alt="'._NEWTODAY.'" />';
			}
			if ($count<=3 && $count>1) {
				echo '<img src="modules/'.$module_name.'/images/newgreen.gif" alt="'._NEWLAST3DAYS.'" />';
			}
			if ($count<=7 && $count>3) {
				echo '<img src="modules/'.$module_name.'/images/newblue.gif" alt="'._NEWTHISWEEK.'" />';
			}
		}
		$count++;
		$startdate = (time()-(86400 * $count));
		// BEGIN: 0001257: Images in Weblinks doesnt display
		$startdate = strftime("%G-%m-%d %T",$startdate);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $startdate, $daysold);
		$daysold = strftime(_LINKSDATESTRING, mktime(intval($daysold[4]),intval($daysold[5]),intval($daysold[6]),intval($daysold[2]),intval($daysold[3]),intval($daysold[1])));
		$daysold = ucfirst($daysold);
		// END: 0001257: Images in Weblinks doesnt display
	}
}

function categorynewlinkgraphic($cat) {
	global $prefix, $db, $module_name, $locale;
	$cat = intval(trim($cat));
	$row = $db->sql_fetchrow($db->sql_query('SELECT date from '.$prefix.'_links_links where cid=\''.$cat.'\' order by date desc limit 1'));
	$time = $row['date'];
	echo '&nbsp;';
	setlocale (LC_TIME, $locale);
	if (preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime)) {
		$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
	} else {
		$datetime = array();
	}
	// BEGIN: 0001257: Images in Weblinks doesnt display
	$startdate = strftime("%G-%m-%d %T");
	preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $startdate, $daysold);
	$daysold = strftime(_LINKSDATESTRING, mktime(intval($daysold[4]),intval($daysold[5]),intval($daysold[6]),intval($daysold[2]),intval($daysold[3]),intval($daysold[1])));
	$daysold = ucfirst($daysold);
	// END: 0001257: Images in Weblinks doesnt display
	$count = 0;
	while ($count <= 7) {
		if ($daysold == $datetime) {
			if ($count<=1) {
				echo '<img src="modules/'.$module_name.'/images/newred.gif" alt="'._CATNEWTODAY.'" />';
			}
			if ($count<=3 && $count>1) {
				echo '<img src="modules/'.$module_name.'/images/newgreen.gif" alt="'._CATLAST3DAYS.'" />';
			}
			if ($count<=7 && $count>3) {
				echo '<img src="modules/'.$module_name.'/images/newblue.gif" alt="'._CATTHISWEEK.'" />';
			}
		}
		$count++;
		$startdate = (time()-(86400 * $count));
		// BEGIN: 0001257: Images in Weblinks doesnt display
		$startdate = strftime("%G-%m-%d %T",$startdate);
		preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $startdate, $daysold);
		$daysold = strftime(_LINKSDATESTRING, mktime(intval($daysold[4]),intval($daysold[5]),intval($daysold[6]),intval($daysold[2]),intval($daysold[3]),intval($daysold[1])));
		$daysold = ucfirst($daysold);
		// END: 0001257: Images in Weblinks doesnt display
	}
}

function popgraphic($hits) {
	global $module_name, $popular;
	if ($hits >= $popular) {
		echo '&nbsp;<img src="modules/'.$module_name.'/images/pop.gif" alt="'._POPULAR.'" />';
	}
}

function convertorderbyin($orderby) {
	if ($orderby != 'titleA' AND $orderby != 'dateA' AND $orderby != 'hitsA' AND $orderby != 'ratingA' AND $orderby != 'titleD' AND $orderby != 'dateD' AND $orderby != 'hitsD' AND $orderby != 'ratingD') {
		Header('Location: index.php');
		die();
	}
	if ($orderby == 'titleA') $orderby = 'title ASC';
	if ($orderby == 'dateA') $orderby = 'date ASC';
	if ($orderby == 'hitsA') $orderby = 'hits ASC';
	if ($orderby == 'ratingA') $orderby = 'linkratingsummary ASC';
	if ($orderby == 'titleD') $orderby = 'title DESC';
	if ($orderby == 'dateD') $orderby = 'date DESC';
	if ($orderby == 'hitsD') $orderby = 'hits DESC';
	if ($orderby == 'ratingD') $orderby = 'linkratingsummary DESC';
	return $orderby;
}

function convertorderbytrans($orderby) {
	if ($orderby != 'hits ASC' AND $orderby != 'hits DESC' AND $orderby != 'title ASC' AND $orderby != 'title DESC' AND $orderby != 'date ASC' AND $orderby != 'date DESC' AND $orderby != 'linkratingsummary ASC' AND $orderby != 'linkratingsummary DESC') {
		Header('Location: index.php');
		die();
	}
	if ($orderby == 'hits ASC') $orderbyTrans = _POPULARITY1;
	if ($orderby == 'hits DESC') $orderbyTrans = _POPULARITY2;
	if ($orderby == 'title ASC') $orderbyTrans = _TITLEAZ;
	if ($orderby == 'title DESC') $orderbyTrans = _TITLEZA;
	if ($orderby == 'date ASC') $orderbyTrans = _DATE1;
	if ($orderby == 'date DESC') $orderbyTrans = _DATE2;
	if ($orderby == 'linkratingsummary ASC') $orderbyTrans = _RATING1;
	if ($orderby == 'linkratingsummary DESC') $orderbyTrans = _RATING2;
	return $orderbyTrans;
}

function convertorderbyout($orderby) {
	if ($orderby != 'title ASC' AND $orderby != 'date ASC' AND $orderby != 'hits ASC' AND $orderby != 'linkratingsummary ASC' AND $orderby != 'title DESC' AND $orderby != 'date DESC' AND $orderby != 'hits DESC' AND $orderby != 'linkratingsummary DESC') {
		Header('Location: index.php');
		die();
	}
	if ($orderby == 'title ASC') $orderby = 'titleA';
	if ($orderby == 'date ASC') $orderby = 'dateA';
	if ($orderby == 'hits ASC') $orderby = 'hitsA';
	if ($orderby == 'linkratingsummary ASC') $orderby = 'ratingA';
	if ($orderby == 'title DESC') $orderby = 'titleD';
	if ($orderby == 'date DESC') $orderby = 'dateD';
	if ($orderby == 'hits DESC') $orderby = 'hitsD';
	if ($orderby == 'linkratingsummary DESC') $orderby = 'ratingD';
	return $orderby;
}

function visit($lid) {
	global $prefix, $db;
	$lid = intval($lid);
	$db->sql_query('update '.$prefix.'_links_links set hits=hits+1 where lid=\''.$lid.'\'');
	update_points(14);
	$row = $db->sql_fetchrow($db->sql_query('SELECT url from '.$prefix.'_links_links where lid=\''.$lid.'\''));
	$url = $row['url'];
	Header('Location: '.$url);
}

function search($query, $min, $orderby, $show) {
	global $prefix, $db, $admin, $bgcolor2, $module_name, $locale, $mainvotedecimal, $datetime;
	include('modules/'.$module_name.'/l_config.php');
	include_once('header.php');
	if (!isset($min)) $min=0;
	$min = intval($min);
	if (!isset($max)) $max=$min+$linksresults;
	$max = intval($max);
	if(!empty($orderby)) {
		$orderby = convertorderbyin($orderby);
	} else {
		$orderby = 'title ASC';
	}
	if ($show!='') {
		$linksresults = $show;
	} else {
		$show=$linksresults;
	}
	$query = addslashes(htmlentities(check_html($query, 'nohtml'), ENT_QUOTES));
	if(!is_numeric($linksresults) AND $linksresults==0) {
		$linksresults=10;
	}
	$result = $db->sql_query('SELECT lid, cid, sid, title, url, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where title LIKE \'%'.$query.'%\' OR description LIKE \'%'.$query.'%\' ORDER BY '.$orderby.' LIMIT '.intval($min).','.$linksresults);
	$fullcountresult = $db->sql_query('SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from '.$prefix.'_links_links where title LIKE \'%'.$query.'%\' OR description LIKE \'%'.$query.'%\'');
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
	$nrows = $db->sql_numrows($result);
	$x=0;
	$the_query = stripslashes($query);
	$the_query = str_replace("\'", "'", $the_query);
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="content">';
	if ($query != '') {
		if ($nrows>0) {
			echo '<span class="option">'._SEARCHRESULTS4.': <span class="thick">'.$the_query.'</span></span><br /><br />'
				.'<table width="100%" bgcolor="'.$bgcolor2.'"><tr><td><span class="option"><span class="thick">'._USUBCATEGORIES.'</span></span></td></tr></table>';
			$result2 = $db->sql_query('SELECT cid, title from '.$prefix.'_links_categories where title LIKE \'%'.$query.'%\' ORDER BY title DESC');
			while ($row2 = $db->sql_fetchrow($result2)) {
				$cid = $row2['cid'];
				$stitle = check_html($row2['title'], 'nohtml');
				$res = $db->sql_query('SELECT * from '.$prefix.'_links_links where cid=\''.$cid.'\'');
				$numrows = $db->sql_numrows($res);
				$row3 = $db->sql_fetchrow($db->sql_query('SELECT cid,title,parentid from '.$prefix.'_links_categories where cid=\''.$cid.'\''));
				$cid3 = $row3['cid'];
				$title3 = check_html($row3['title'], 'nohtml');
				$parentid3 = $row3['parentid'];
				if ($parentid3>0) $title3 = getparent($parentid3,$title3);
				$title3 = str_ireplace($query, '<span class="thick">' . $query . '</span>', $title3);
				echo '<strong><span class="larger">&middot;</span></strong>&nbsp;<a href="modules.php?name='.$module_name.'&amp;l_op=viewlink&amp;cid='.$cid.'">'.$title3.'</a> ('.$numrows.')<br />';
			}
			echo '<br /><table width="100%" bgcolor="'.$bgcolor2.'"><tr><td><span class="option"><span class="thick">'._LINKS.'</span></span></td></tr></table>';
			$orderbyTrans = convertorderbytrans($orderby);
			echo '<br /><div class="text-center">'._SORTLINKSBY.': '
				._TITLE.' (<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=titleA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=titleD">D</a>)&nbsp;'
				._DATE.' (<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=dateA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=dateD">D</a>)&nbsp;'
				._RATING.' (<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=ratingA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=ratingD">D</a>)&nbsp;'
				._POPULARITY.' (<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=hitsA">A</a>\<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;orderby=hitsD">D</a>)'
				.'<br /><span class="thick">'._SITESSORTED.': '.$orderbyTrans.'</span></div><br /><br />';
			while($row = $db->sql_fetchrow($result)) {
				$lid = $row['lid'];
				$cid = $row['cid'];
				$sid = $row['sid'];
				$title = check_html($row['title'], 'nohtml');
				$url = $row['url'];
				$description = $row['description'];
				$time = $row['date'];
				$hits = $row['hits'];
				$linkratingsummary = $row['linkratingsummary'];
				$totalvotes = $row['totalvotes'];
				$totalcomments = $row['totalcomments'];
				$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
				$transfertitle = str_replace (' ', '_', $title);
				$title = str_ireplace($query, '<span class="thick">' . $query . '</span>', $title);
				echo '<a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="new">'.$title.'</a>';
				newlinkgraphic($datetime, $time);
				popgraphic($hits);
				echo '<br />';
				$description = str_ireplace($query, '<span class="thick">' . $query . '</span>', $description);
				echo '<span class="thick">'._DESCRIPTION.':</span> <div>'.$description.'</div><br />';
				setlocale (LC_TIME, $locale);
				preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
				$datetime = strftime(_LINKSDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
				$datetime = ucfirst($datetime);
				echo '<span class="thick">'._ADDEDON.':</span> '.$datetime.' <span class="thick">'._HITS.':</span> '.$hits;
				/* voting & comments stats */
				if ($totalvotes == 1) {
					$votestring = _VOTE;
				} else {
					$votestring = _VOTES;
				}
				if ($linkratingsummary!='0' || $linkratingsummary!='0.0') {
					echo ' <span class="thick">'._RATING.':</span> '.$linkratingsummary.' ('.$totalvotes.' '.$votestring.')';
				}
				echo '<br /><a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATESITE.'</a>';
				if ($totalvotes != 0) {
					echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'._DETAILS.'</a>';
				}
				if ($totalcomments != 0) {
					echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkcomments&amp;lid='.$lid.'">'._SCOMMENTS.' ('.$totalcomments.')</a>';
				}
				detecteditorial($lid);
				echo '<br />';
				$row4 = $db->sql_fetchrow($db->sql_query('SELECT cid,title,parentid from '.$prefix.'_links_categories where cid=\''.$cid.'\''));
				$cid3 = $row4['cid'];
				$title3 = check_html($row4['title'], 'nohtml');
				$parentid3 = $row4['parentid'];
				if ($parentid3>0) $title3 = getparent($parentid3,$title3);
				echo '<span class="thick">'._CATEGORY.':</span> '.$title3.'<br /><br />';
				$x++;
			}
			$orderby = convertorderbyout($orderby);
		} else {
			echo '<br /><br /><div class="text-center"><span class="option thick">' , _NOMATCHES , '</span><br /><br />' , _GOBACK , '<br /></div>';
		}
		/* Calculates how many pages exist.  Which page one should be on, etc... */
		$linkpagesint = ($totalselectedlinks / $linksresults);
		$linkpageremainder = ($totalselectedlinks % $linksresults);
		if ($linkpageremainder != 0) {
			$linkpages = ceil($linkpagesint);
			if ($totalselectedlinks < $linksresults) {
				$linkpageremainder = 0;
			}
		} else {
			$linkpages = $linkpagesint;
		}
		/* Page Numbering */
		if ($linkpages!=1 && $linkpages!=0) {
			echo '<br /><br />'
				._SELECTPAGE.': ';
			$prev=$min-$linksresults;
			if ($prev>=0) {
				echo '&nbsp;&nbsp;<span class="thick">[ <a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;min='.$prev.'&amp;orderby='.$orderby.'&amp;show='.$show.'">'
					.' &lt;&lt; '._PREVIOUS.'</a> ]</span> ';
			}
			$counter = 1;
			$currentpage = ($max / $linksresults);
			while ($counter<=$linkpages ) {
				$cpage = $counter;
				$mintemp = ($perpage * $counter) - $linksresults;
				if ($counter == $currentpage) {
					echo '<span class="thick">'.$counter.'</span>&nbsp;';
				} else {
					echo '<a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;min='.$mintemp.'&amp;orderby='.$orderby.'&amp;show='.$show.'">'.$counter.'</a> ';
				}
				$counter++;
			}
			$next=$min+$linksresults;
			if ($x>=$perpage) {
				echo '&nbsp;&nbsp;<span class="thick">[ <a href="modules.php?name='.$module_name.'&amp;l_op=search&amp;query='.$the_query.'&amp;min='.$max.'&amp;orderby='.$orderby.'&amp;show='.$show.'">'
					.' '._NEXT.' &gt;&gt;</a> ]</span>';
			}
		}
		echo '<br /><br /><div class="text-center">'
			._TRY2SEARCH.' <span class="thick">'.$the_query.'</span> '._INOTHERSENGINES.'<br />'
			.'<a target="_blank" href="http://www.altavista.com/web/results?itag=ody&amp;q='.$the_query.'&amp;kgs=1&amp;kls=0">Alta Vista</a> - '
			.'<a target="_blank" href="http://www.hotbot.com/?query='.$the_query.'">HotBot</a> - '
			.'<a target="_blank" href="http://groups.google.com/groups/dir?q='.$the_query.'">Google Groups</a> - '
			.'<a target="_blank" href="http://search.lycos.com/?query='.$the_query.'">Lycos</a> - '
			.'<a target="_blank" href="http://search.yahoo.com/bin/search?p='.$the_query.'">Yahoo</a>'
			.'<br />'
			.'<a target="_blank" href="http://search.1stlinuxsearch.com/default.pk?tsearch='.$the_query.'">1stLinuxSearch</a> - '
			.'<a target="_blank" href="http://www.google.com/search?q='.$the_query.'">Google</a> - '
			.'<a target="_blank" href="http://www.freshmeat.net/search/?q='.$the_query.'&amp;section=projects">Freshmeat</a> - '
			.'<a target="_blank" href="http://search.internet.com/query.php?IC_QueryText='.$the_query.'">JupiterWeb</a>' //montego - the previous entry no longer worked right but came to here
			.'</div>';
	} else {
		echo '<div class="text-center option thick">' , _NOMATCHES , '</div><br /><br />';
	}
	echo '</div>';
	CloseTable();
	include_once 'footer.php';
}

function viewlinkeditorial($lid) {
	global $prefix, $db, $admin, $module_name;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	$lid = intval($lid);
	$result = $db->sql_query('SELECT adminid, editorialtimestamp, editorialtext, editorialtitle FROM '.$prefix.'_links_editorials WHERE linkid = \''.$lid.'\'');
	$recordexist = $db->sql_numrows($result);

	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_links_links WHERE lid=' . $lid));
	$ttitle = htmlentities($row['title']);
	$transfertitle = str_replace ('_', ' ', $ttitle);
	$displaytitle = $transfertitle;
	echo '<br />';
	OpenTable();
	echo '<div class="content" align="center"><span class="option thick">'._LINKPROFILE.': '.check_html($displaytitle,'nohtml').'</span><br />';
	linkinfomenu($lid);
	if ($recordexist != 0) {
		while($row = $db->sql_fetchrow($result)) {
			$adminid = $row['adminid'];
			$editorialtimestamp = $row['editorialtimestamp'];
			$editorialtext = $row['editorialtext'];
			$editorialtitle = check_html($row['editorialtitle'], 'nohtml');
			preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $editorialtimestamp, $editorialtime);
			$timestamp = mktime(0, 0, 0, $editorialtime['2'], $editorialtime['3'], $editorialtime['1']);
			$formatted_date = date('F j, Y', $timestamp);
			echo '<br /><br />';
			OpenTable2();
			echo '<span class="option thick">' , htmlspecialchars($editorialtitle, ENT_QUOTES, _CHARSET) , '</span><br /><br />'
				, '<span class="tiny">' , _EDITORIALBY , ' ' , $adminid , ' - ' , $formatted_date , '</span><br />'
				, '<div>' , htmlspecialchars($editorialtext, ENT_QUOTES, _CHARSET) . '</div>';
			CloseTable2();
		}
	} else {
		echo '<br /><br /><span class="option thick">' , _NOEDITORIAL , '</span>';
	}
	echo '<br /><br />';
	linkfooter($lid);
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function detecteditorial($lid) {
	global $prefix, $db, $module_name;
	$lid = intval($lid);
	$resulted2 = $db->sql_query('SELECT adminid from '.$prefix.'_links_editorials where linkid=\''.$lid.'\'');
	$recordexist = $db->sql_numrows($resulted2);
	if ($recordexist != 0) {
		echo ' | <a href="modules.php?name='.$module_name.'&amp;l_op=viewlinkeditorial&amp;lid='.$lid.'">'._EDITORIAL.'</a>';
	}
}

function viewlinkcomments($lid) {
	global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file, $nukeurl;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	$lid = intval($lid);
	echo '<br />';
	$result = $db->sql_query('SELECT ratinguser, rating, ratingcomments, ratingtimestamp FROM '.$prefix.'_links_votedata WHERE ratinglid = \''.$lid.'\' AND ratingcomments != \'\' ORDER BY ratingtimestamp DESC');
	$totalcomments = $db->sql_numrows($result);

	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_links_links WHERE lid=' . $lid));
	$ttitle = htmlentities($row['title']);
	$transfertitle = str_replace ('_', ' ', $ttitle);
	$displaytitle = $transfertitle;
	OpenTable();
	echo '<div class="content" align="center"><span class="option thick">'._LINKPROFILE.': '.check_html($displaytitle,'nohtml').'</span><br /><br />';
	linkinfomenu($lid);
	echo '<br /><br /><br />'._TOTALOF.' '.$totalcomments.' '._COMMENTS.'<br />';
	if($totalcomments) {
		echo '<table border="0" cellspacing="0" cellpadding="2" width="450">';
		$x=0;
		while($row = $db->sql_fetchrow($result)) {
			$ratinguser = $row['ratinguser'];
			$rating = intval($row['rating']);
			$ratingcomments = $row['ratingcomments'];
			$ratingtimestamp = $row['ratingtimestamp'];
			preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $ratingtimestamp, $ratingtime);
			$timestamp = mktime(0, 0, 0, $ratingtime['2'], $ratingtime['3'], $ratingtime['1']);
			$formatted_date = date('F j, Y', $timestamp);
			/* Individual user information */
			$result2 = $db->sql_query('SELECT rating FROM '.$prefix.'_links_votedata WHERE ratinguser = \''.$ratinguser.'\'');
			$usertotalcomments = $db->sql_numrows($result2);
			$useravgrating = 0;
			while($row2 = $db->sql_fetchrow($result2)) $rating2 = intval($row2['rating']);
			$useravgrating = $useravgrating + $rating2;
			$useravgrating = $useravgrating / $usertotalcomments;
			$useravgrating = number_format($useravgrating, 1);
			echo '<tr><td bgcolor="'.$bgcolor2.'" align="left">'
				.'<span class="thick"> '._USER.': </span><a href="'.$nukeurl.'/modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$ratinguser.'">'.$ratinguser.'</a>'
				.'</td>'
				.'<td bgcolor="'.$bgcolor2.'" align="left">'
				.'<span class="thick">'._RATING.': </span>'.$rating
				.'</td>'
				.'<td bgcolor="'.$bgcolor2.'" align="right">'
				.$formatted_date
				.'</td>'
				.'</tr>'
				.'<tr>'
				.'<td valign="top" align="left">'
				.'<span class="tiny">'._USERAVGRATING.': '.$useravgrating.'</span>'
				.'</td>'
				.'<td valign="top" colspan="2" align="left">'
				.'<span class="tiny">'._NUMRATINGS.': '.$usertotalcomments.'</span>'
				.'</td>'
				.'</tr>'
				.'<tr>'
				.'<td colspan="3" align="left">';
			if (is_admin($admin)) {
				echo '<a href="'.$admin_file.'.php?op=LinksModLink&amp;lid='.$lid.'"><img src="modules/'.$module_name.'/images/editicon.gif" border="0" alt="'._EDITTHISLINK.'" /></a>';
			}
			echo $ratingcomments
				.'<br /><br /><br /></td></tr>';
			$x++;
		}
		echo '</table>';
	}
	echo '<br /><br />';
	linkfooter($lid);
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function viewlinkdetails($lid) {
	global $prefix, $db, $admin, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $module_name, $anonymous;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	$lid = intval($lid);
	$voteresult = $db->sql_query('SELECT rating, ratinguser, ratingcomments FROM '.$prefix.'_links_votedata WHERE ratinglid = \''.$lid.'\'');
	$totalvotesDB = $db->sql_numrows($voteresult);
	$anonvotes = 0;
	$anonvoteval = 0;
	$outsidevotes = 0;
	$outsidevoteeval = 0;
	$regvoteval = 0;
	$topanon = 0;
	$bottomanon = 11;
	$topreg = 0;
	$bottomreg = 11;
	$topoutside = 0;
	$bottomoutside = 11;
	$avv = array(0,0,0,0,0,0,0,0,0,0,0);
	$rvv = array(0,0,0,0,0,0,0,0,0,0,0);
	$ovv = array(0,0,0,0,0,0,0,0,0,0,0);
	$truecomments = $totalvotesDB;
	while($row = $db->sql_fetchrow($voteresult)) {
		$ratingDB = intval($row['rating']);
		$ratinguserDB = $row['ratinguser'];
		$ratingcommentsDB = $row['ratingcomments'];
		if ($ratingcommentsDB=='') $truecomments--;
		if ($ratinguserDB==$anonymous) {
			$anonvotes++;
			$anonvoteval += $ratingDB;
		}
		if ($useoutsidevoting == 1) {
			if ($ratinguserDB=='outside') {
				$outsidevotes++;
				$outsidevoteval += $ratingDB;
			}
		} else {
			$outsidevotes = 0;
		}
		if ($ratinguserDB!=$anonymous && $ratinguserDB!='outside') {
			$regvoteval += $ratingDB;
		}
		if ($ratinguserDB!=$anonymous && $ratinguserDB!='outside') {
			if ($ratingDB > $topreg) $topreg = $ratingDB;
			if ($ratingDB < $bottomreg) $bottomreg = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $rvv[$rcounter]++;
		}
		if ($ratinguserDB==$anonymous) {
			if ($ratingDB > $topanon) $topanon = $ratingDB;
			if ($ratingDB < $bottomanon) $bottomanon = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $avv[$rcounter]++;
		}
		if ($ratinguserDB=='outside') {
			if ($ratingDB > $topoutside) $topoutside = $ratingDB;
			if ($ratingDB < $bottomoutside) $bottomoutside = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $ovv[$rcounter]++;
		}
	}
	$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
	if ($totalvotesDB == 0) {
		$finalrating = 0;
	} else if ($anonvotes == 0 && $regvotes == 0) {
		/* Figure Outside Only Vote */
		$finalrating = $outsidevoteval / $outsidevotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgOU = $outsidevoteval / $totalvotesDB;
		$avgOU = number_format($avgOU, $detailvotedecimal);
	} else if ($outsidevotes == 0 && $regvotes == 0) {
		 /* Figure Anon Only Vote */
		$finalrating = $anonvoteval / $anonvotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgAU = $anonvoteval / $totalvotesDB;
		$avgAU = number_format($avgAU, $detailvotedecimal);
	} else if ($outsidevotes == 0 && $anonvotes == 0) {
		/* Figure Reg Only Vote */
		$finalrating = $regvoteval / $regvotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgRU = $regvoteval / $totalvotesDB;
		$avgRU = number_format($avgRU, $detailvotedecimal);
	} else if ($regvotes == 0 && $useoutsidevoting == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
		/* Figure Reg and Anon Mix */
		$avgAU = $anonvoteval / $anonvotes;
		$avgOU = $outsidevoteval / $outsidevotes;
		if ($anonweight > $outsideweight ) {
			/* Anon is 'standard weight' */
			$newimpact = $anonweight / $outsideweight;
			$impactAU = $anonvotes;
			$impactOU = $outsidevotes / $newimpact;
			$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
			$finalrating = number_format($finalrating, $detailvotedecimal);
		} else {
			/* Outside is 'standard weight' */
			$newimpact = $outsideweight / $anonweight;
			$impactOU = $outsidevotes;
			$impactAU = $anonvotes / $newimpact;
			$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
			$finalrating = number_format($finalrating, $detailvotedecimal);
		}
	} else {
		/* REG User vs. Anonymous vs. Outside User Weight Calutions */
		$impact = $anonweight;
		$outsideimpact = $outsideweight;
		if ($regvotes == 0) {
			$avgRU = 0;
		} else {
			$avgRU = $regvoteval / $regvotes;
		}
		if ($anonvotes == 0) {
			$avgAU = 0;
		} else {
			$avgAU = $anonvoteval / $anonvotes;
		}
		if ($outsidevotes == 0 ) {
			$avgOU = 0;
		} else {
			$avgOU = $outsidevoteval / $outsidevotes;
		}
		$impactRU = $regvotes;
		$impactAU = $impact>0?$anonvotes / $impact:0;
		$impactOU = $outsideimpact>0?$outsidevotes / $outsideimpact:0;
		$finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
		$finalrating = number_format($finalrating, $detailvotedecimal);
	}
	if (!isset($avgOU) || $avgOU == 0 || empty($avgOU)) {
		$avgOU = '';
	} else {
		$avgOU = number_format($avgOU, $detailvotedecimal);
	}
	if (!isset($avgRU) || $avgRU == 0 || empty($avgRU)) {
		$avgRU = '';
	} else {
		$avgRU = number_format($avgRU, $detailvotedecimal);
	}
	if (!isset($avgAU) || $avgAU == 0 || empty($avgAU)) {
		$avgAU = '';
	} else {
		$avgAU = number_format($avgAU, $detailvotedecimal);
	}
	if ($topanon == 0) $topanon = '';
	if ($bottomanon == 11) $bottomanon = '';
	if ($topreg == 0) $topreg = '';
	if ($bottomreg == 11) $bottomreg = '';
	if ($topoutside == 0) $topoutside = '';
	if ($bottomoutside == 11) $bottomoutside = '';
	$totalchartheight = 70;
	$chartunits = $totalchartheight / 10;
	$avvper = array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvper = array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvper = array(0,0,0,0,0,0,0,0,0,0,0);
	$avvpercent = array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvpercent = array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvpercent = array(0,0,0,0,0,0,0,0,0,0,0);
	$avvchartheight = array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvchartheight = array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvchartheight = array(0,0,0,0,0,0,0,0,0,0,0);
	$avvmultiplier = 0;
	$rvvmultiplier = 0;
	$ovvmultiplier = 0;
	for ($rcounter=1; $rcounter<11; $rcounter++) {
		if ($anonvotes != 0) $avvper[$rcounter] = $avv[$rcounter] / $anonvotes;
		if ($regvotes != 0) $rvvper[$rcounter] = $rvv[$rcounter] / $regvotes;
		if ($outsidevotes != 0) $ovvper[$rcounter] = $ovv[$rcounter] / $outsidevotes;
		$avvpercent[$rcounter] = number_format($avvper[$rcounter] * 100, 1);
		$rvvpercent[$rcounter] = number_format($rvvper[$rcounter] * 100, 1);
		$ovvpercent[$rcounter] = number_format($ovvper[$rcounter] * 100, 1);
		if ($avv[$rcounter] > $avvmultiplier) $avvmultiplier = $avv[$rcounter];
		if ($rvv[$rcounter] > $rvvmultiplier) $rvvmultiplier = $rvv[$rcounter];
		if ($ovv[$rcounter] > $ovvmultiplier) $ovvmultiplier = $ovv[$rcounter];
	}
	if ($avvmultiplier != 0) $avvmultiplier = 10 / $avvmultiplier;
	if ($rvvmultiplier != 0) $rvvmultiplier = 10 / $rvvmultiplier;
	if ($ovvmultiplier != 0) $ovvmultiplier = 10 / $ovvmultiplier;
	for ($rcounter=1; $rcounter<11; $rcounter++) {
		$avvchartheight[$rcounter] = ($avv[$rcounter] * $avvmultiplier) * $chartunits;
		$rvvchartheight[$rcounter] = ($rvv[$rcounter] * $rvvmultiplier) * $chartunits;
		$ovvchartheight[$rcounter] = ($ovv[$rcounter] * $ovvmultiplier) * $chartunits;
		if ($avvchartheight[$rcounter]==0) $avvchartheight[$rcounter]=1;
		if ($rvvchartheight[$rcounter]==0) $rvvchartheight[$rcounter]=1;
		if ($ovvchartheight[$rcounter]==0) $ovvchartheight[$rcounter]=1;
	}
	//montego - Adding ability to show the link description!
	$res = $db->sql_query('SELECT title, description FROM '.$prefix.'_links_links WHERE lid=\''.$lid.'\'');
	$row = $db->sql_fetchrow($res);
	$description = $row['description'];
	$ttitle = htmlentities($row['title']);
	$transfertitle = str_replace ('_', ' ', $ttitle);
	$displaytitle = $transfertitle;
	//end montego add
	echo '<br />';
	OpenTable();
	echo '<div class="content" align="center"><span class="option thick">'._LINKPROFILE.': '.check_html($displaytitle,'nohtml').'</span><br /><br />';
	linkinfomenu($lid);
	echo '<br /><br /><span class="thick">'._LINKRATINGDET.'</span><br />'
		.'<span class="thick">'._TOTALVOTES.'</span> '.$totalvotesDB.'<br />'
		.'<span class="thick">'._OVERALLRATING.':</span> '.$finalrating.'<br /><br />'
		.'<div>'.htmlspecialchars($description, ENT_QUOTES, _CHARSET).'</div><br />'
		.'<table align="center" border="0" cellspacing="0" cellpadding="2" width="455">'
		.'<tr><td colspan="2" bgcolor="'.$bgcolor2.'">'
		.'<span class="thick">'._REGISTEREDUSERS.'</span>'
		.'</td></tr>'
		.'<tr>'
		.'<td bgcolor="'.$bgcolor1.'" align="left">'
		.''._NUMBEROFRATINGS.': '.$regvotes
		.'</td>'
		.'<td rowspan="5" width="200">';
	if ($regvotes==0) {
		echo _NOREGUSERSVOTES;
	} else {
		echo '<table border="1" width="200">'
			.'<tr>'
			.'<td valign="top" align="center" colspan="10" bgcolor="'.$bgcolor2.'">'._BREAKDOWNBYVAL.'</td>'
			.'</tr>'
			.'<tr>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[1].' '._LVOTES.' ('.$rvvpercent[1].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[1].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[2].' '._LVOTES.' ('.$rvvpercent[2].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[2].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[3].' '._LVOTES.' ('.$rvvpercent[3].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[3].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[4].' '._LVOTES.' ('.$rvvpercent[4].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[4].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[5].' '._LVOTES.' ('.$rvvpercent[5].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[5].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[6].' '._LVOTES.' ('.$rvvpercent[6].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[6].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[7].' '._LVOTES.' ('.$rvvpercent[7].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[7].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[8].' '._LVOTES.' ('.$rvvpercent[8].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[8].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[9].' '._LVOTES.' ('.$rvvpercent[9].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[9].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$rvv[10].' '._LVOTES.' ('.$rvvpercent[10].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$rvvchartheight[10].'" /></td>'
			.'</tr>'
			.'<tr><td colspan="10" bgcolor="'.$bgcolor2.'">'
			.'<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr>'
			.'<td width="10%" valign="bottom" align="center">1</td>'
			.'<td width="10%" valign="bottom" align="center">2</td>'
			.'<td width="10%" valign="bottom" align="center">3</td>'
			.'<td width="10%" valign="bottom" align="center">4</td>'
			.'<td width="10%" valign="bottom" align="center">5</td>'
			.'<td width="10%" valign="bottom" align="center">6</td>'
			.'<td width="10%" valign="bottom" align="center">7</td>'
			.'<td width="10%" valign="bottom" align="center">8</td>'
			.'<td width="10%" valign="bottom" align="center">9</td>'
			.'<td width="10%" valign="bottom" align="center">10</td>'
			.'</tr></table>'
			.'</td></tr></table>';
	}
	echo '</td>'
		.'</tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LINKRATING.': '.$avgRU.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._HIGHRATING.': '.$topreg.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LOWRATING.': '.$bottomreg.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._NUMOFCOMMENTS.': '.$truecomments.'</td></tr>'
		.'<tr><td></td></tr>'
		.'<tr><td valign="top" colspan="2"><span class="tiny"><br /><br />'._WEIGHNOTE.' '.$anonweight.' '._TO.' 1.</span></td></tr>'
			.'<tr><td colspan="2" bgcolor="'.$bgcolor2.'"><span class="thick">'._UNREGISTEREDUSERS.'</span></td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._NUMBEROFRATINGS.': '.$anonvotes.'</td>'
		.'<td rowspan="5" width="200">';
	if ($anonvotes==0) {
		echo _NOUNREGUSERSVOTES;
	} else {
		echo '<table border="1" width="200">'
			.'<tr>'
			.'<td valign="top" align="center" colspan="10" bgcolor="'.$bgcolor2.'">'._BREAKDOWNBYVAL.'</td>'
			.'</tr>'
			.'<tr>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[1].' '._LVOTES.' ('.$avvpercent[1].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[1].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[2].' '._LVOTES.' ('.$avvpercent[2].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[2].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[3].' '._LVOTES.' ('.$avvpercent[3].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[3].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[4].' '._LVOTES.' ('.$avvpercent[4].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[4].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[5].' '._LVOTES.' ('.$avvpercent[5].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[5].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[6].' '._LVOTES.' ('.$avvpercent[6].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[6].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[7].' '._LVOTES.' ('.$avvpercent[7].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[7].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[8].' '._LVOTES.' ('.$avvpercent[8].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[8].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[9].' '._LVOTES.' ('.$avvpercent[9].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[9].'" /></td>'
			.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$avv[10].' '._LVOTES.' ('.$avvpercent[10].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$avvchartheight[10].'" /></td>'
			.'</tr>'
			.'<tr><td colspan="10" bgcolor="'.$bgcolor2.'">'
			.'<table cellspacing="0" cellpadding="0" border="0" width="200"><tr>'
			.'<td width="10%" valign="bottom" align="center">1</td>'
			.'<td width="10%" valign="bottom" align="center">2</td>'
			.'<td width="10%" valign="bottom" align="center">3</td>'
			.'<td width="10%" valign="bottom" align="center">4</td>'
			.'<td width="10%" valign="bottom" align="center">5</td>'
			.'<td width="10%" valign="bottom" align="center">6</td>'
			.'<td width="10%" valign="bottom" align="center">7</td>'
			.'<td width="10%" valign="bottom" align="center">8</td>'
			.'<td width="10%" valign="bottom" align="center">9</td>'
			.'<td width="10%" valign="bottom" align="center">10</td>'
			.'</tr></table>'
			.'</td></tr></table>';
	}
	echo '</td>'
		.'</tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LINKRATING.': '.$avgAU.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._HIGHRATING.': '.$topanon.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LOWRATING.': '.$bottomanon.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'">&nbsp;</td></tr>';
	if ($useoutsidevoting == 1) {
		echo '<tr><td valign="top" colspan="2"><span class="tiny"><br /><br />'._WEIGHOUTNOTE.' '.$outsideweight.' '._TO.' 1.</span></td></tr>'
			.'<tr><td colspan="2" bgcolor="'.$bgcolor2.'"><span class="thick">'._OUTSIDEVOTERS.'</span></td></tr>'
			.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._NUMBEROFRATINGS.': '.$outsidevotes.'</td>'
			.'<td rowspan="5" width="200">';
		if ($outsidevotes==0) {
			echo _NOOUTSIDEVOTES;
		} else {
			echo '<table border="1" width="200">'
				.'<tr>'
				.'<td valign="top" align="center" colspan="10" bgcolor="'.$bgcolor2.'">'._BREAKDOWNBYVAL.'</td>'
				.'</tr>'
				.'<tr>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[1].' '._LVOTES.' ('.$ovvpercent[1].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[1].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[2].' '._LVOTES.' ('.$ovvpercent[2].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[2].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[3].' '._LVOTES.' ('.$ovvpercent[3].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[3].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[4].' '._LVOTES.' ('.$ovvpercent[4].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[4].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[5].' '._LVOTES.' ('.$ovvpercent[5].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[5].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[6].' '._LVOTES.' ('.$ovvpercent[6].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[6].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[7].' '._LVOTES.' ('.$ovvpercent[7].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[7].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[8].' '._LVOTES.' ('.$ovvpercent[8].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[8].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[9].' '._LVOTES.' ('.$ovvpercent[9].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[9].'" /></td>'
				.'<td bgcolor="'.$bgcolor1.'" valign="bottom"><img border="0" alt="'.$ovv[10].' '._LVOTES.' ('.$ovvpercent[10].'% '._LTOTALVOTES.')" src="images/blackpixel.gif" width="15" height="'.$ovvchartheight[10].'" /></td>'
				.'</tr>'
				.'<tr><td colspan="10" bgcolor="'.$bgcolor2.'">'
				.'<table cellspacing="0" cellpadding="0" border="0" width="200"><tr>'
				.'<td width="10%" valign="bottom" align="center">1</td>'
				.'<td width="10%" valign="bottom" align="center">2</td>'
				.'<td width="10%" valign="bottom" align="center">3</td>'
				.'<td width="10%" valign="bottom" align="center">4</td>'
				.'<td width="10%" valign="bottom" align="center">5</td>'
				.'<td width="10%" valign="bottom" align="center">6</td>'
				.'<td width="10%" valign="bottom" align="center">7</td>'
				.'<td width="10%" valign="bottom" align="center">8</td>'
				.'<td width="10%" valign="bottom" align="center">9</td>'
				.'<td width="10%" valign="bottom" align="center">10</td>'
				.'</tr></table>'
				.'</td></tr></table>';
		}
	echo '</td>'
		.'</tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LINKRATING.': '.$avgOU.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'" align="left">'._HIGHRATING.': '.$topoutside.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor2.'" align="left">'._LOWRATING.': '.$bottomoutside.'</td></tr>'
		.'<tr><td bgcolor="'.$bgcolor1.'">&nbsp;</td></tr>';
	}
	echo '</table><br /><br />';
	linkfooter($lid);
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function linkfooter($lid) {
	global $module_name;
	echo '[ <a href="modules.php?name='.$module_name.'&amp;l_op=visit&amp;lid='.$lid.'" target="_blank">'._VISITTHISSITE.'</a> | <a href="modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATETHISSITE.'</a> ]<br /><br />';
	linkfooterchild($lid);
}

function linkfooterchild($lid) {
	global $module_name, $useoutsidevoting;
	if ($useoutsidevoting = 1) {
		echo '<br />'._ISTHISYOURSITE.' <a href="modules.php?name='.$module_name.'&amp;l_op=outsidelinksetup&amp;lid='.$lid.'">'._ALLOWTORATE.'</a>';
	}
}

function outsidelinksetup($lid) {
	global $module_name, $sitename, $nukeurl;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' , _PROMOTEYOURSITE , '</div><br /><br />'
		, _PROMOTE01 , '<br /><br />
		<span class="thick">1) '._TEXTLINK.'</span><br /><br />
		'._PROMOTE02.'<br /><br />
		<div class="text-center"><a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATETHISSITE.' @ '.$sitename.'</a></div><br /><br />
		<div class="text-center">'._HTMLCODE1.'</div><br />
		<div class="text-center">
		<code>
			&lt;a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'"&gt;'._RATETHISSITE.'&lt;/a&gt;
		</code>
		</div>
		<br /><br />
		'._THENUMBER.' "'.$lid.'" '._IDREFER.'<br /><br />
		<span class="thick">2) '._BUTTONLINK.'</span><br /><br />
		'._PROMOTE03.'<br /><br />
		<div class="text-center">
		<form action="modules.php?name='.$module_name.'" method="post">
		<input type="hidden" name="lid" value="'.$lid.'" />
		<input type="hidden" name="l_op" value="ratelink" />
		<input type="submit" value="'._RATEIT.'" />
		</form>
		</div>
		<div class="text-center">'._HTMLCODE2.'</div><br /><br />
		<table border="0" align="center"><tr><td align="left">
		<code>
			&lt;form action="'.$nukeurl.'/modules.php?name='.$module_name.'" method="post"&gt;<br />
			&nbsp;&nbsp;&lt;input type="hidden" name="lid" value="'.$lid.'"&gt;<br />
			&nbsp;&nbsp;&lt;input type="hidden" name="l_op" value="ratelink"&gt;<br />
			&nbsp;&nbsp;&lt;input type="submit" value="'._RATEIT.'"&gt;<br />
			&lt;/form&gt;
		</code>
		</td></tr></table>
		<br />'._HTMLCODE3.'<br /><br />
		<div class="text-center">
		'._PROMOTE05.'<br /><br />
		- '.$sitename.' '._STAFF.'
		<br /><br /></div>';
	CloseTable();
	include_once('footer.php');
}

function brokenlink($lid) {
	global $prefix, $db, $user, $cookie, $module_name;
	if (is_user($user)) {
		include_once('header.php');
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		menu(1);
		$lid = intval($lid);
		echo '<br />';
		$row = $db->sql_fetchrow($db->sql_query('SELECT cid, title, url, description from '.$prefix.'_links_links where lid=\''.$lid.'\''));
		$cid = $row['cid'];
		$title = check_html($row['title'], 'nohtml');
		$url = $row['url'];
		$description = $row['description'];
		OpenTable();
		echo '<div class="content" align="center"><span class="option thick">' , _REPORTBROKEN , '</span><br /><br /><br />';
		echo '<form action="modules.php?name='.$module_name.'" method="post">';
		echo '<input type="hidden" name="lid" value="'.$lid.'" />';
		echo '<input type="hidden" name="cid" value="'.$cid.'" />';
		echo '<input type="hidden" name="title" value="'.$title.'" />';
		echo '<input type="hidden" name="url" value="'.$url.'" />';
		echo '<input type="hidden" name="description" value="'.htmlentities($description, ENT_QUOTES).'" />';
		echo '<input type="hidden" name="modifysubmitter" value="'.$ratinguser.'" />';
		echo _THANKSBROKEN.'<br /><br />';
		echo '<input type="hidden" name="l_op" value="brokenlinkS" />';
		echo '<input type="submit" value="'._REPORTBROKEN.'" /></form></div>';
		CloseTable();
		include_once('footer.php');
	} else {
		Header('Location: modules.php?name='.$module_name);
	}
}

function brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter) {
	global $prefix, $db, $user, $anonymous, $cookie, $module_name, $user;
	if (is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		$lid = intval($lid);
		$cid = intval($cid);
		// RN0001000 - next three variables were not filtered for XSS - they are now
		// Also removed potential double-escaping
		$title = addslashes(check_html($title, 'nohtml'));
		$url = addslashes(check_html($url, 'nohtml'));
		$description = addslashes(check_html($description, 'html'));
		$db->sql_query('insert into '.$prefix.'_links_modrequest values (NULL, \''.$lid.'\', \''.$cid.'\', \'0\', \''.$title.'\', \''.$url.'\', \''.$description.'\', \''.$ratinguser.'\', \'1\')');
		include_once('header.php');
		menu(1);
		echo '<br />';
		OpenTable();
		echo '<br /><div class="text-center">'._THANKSFORINFO.'<br /><br />'._LOOKTOREQUEST.'</div><br />';
		CloseTable();
		include_once('footer.php');
	} else {
		Header('Location: modules.php?name='.$module_name);
	}
}

function modifylinkrequest($lid) {
	global $prefix, $db, $user, $module_name, $anonymous;
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else {
		$ratinguser = $anonymous;
	}
	menu(1);
	echo '<div class="content"><br />';
	OpenTable();
	$blocknow = 0;
	$lid = intval(trim($lid));
	if ($blockunregmodify == 1 && $ratinguser==$anonymous) {
		echo '<br /><br /><div class="text-center">'._ONLYREGUSERSMODIFY.'</div>';
		$blocknow = 1;
	}
	if ($blocknow != 1) {
		$result = $db->sql_query('SELECT cid, sid, title, url, description from '.$prefix.'_links_links where lid=\''.$lid.'\'');
		echo '<div class="text-center"><span class="option thick">' , _REQUESTLINKMOD , '</span><br /><br />';
		$row = $db->sql_fetchrow($result);
		$cid = $row['cid'];
		$sid = $row['sid'];
		$title = check_html($row['title'], 'nohtml');
		$url = $row['url'];
		$description = htmlentities($row['description'], ENT_QUOTES);
		echo '<span class="thick">'._LINKID.':</span> '.$lid.'</div><br /><br />'
			.'<form action="modules.php?name='.$module_name.'" method="post">'
			.'<span class="thick">'._LINKTITLE.':</span><br /><input type="text" name="title" value="'.$title.'" size="50" maxlength="100" /><br /><br />'
			.'<span class="thick">'._URL.':</span><br /><input type="text" name="url" value="'.$url.'" size="50" maxlength="100" /><br /><br />'
			.'<span class="thick">'._DESCRIPTION.':</span> <br /><textarea name="description" cols="60" rows="10">'.$description.'</textarea><br /><br />';
		echo '<input type="hidden" name="lid" value="'.$lid.'" />'
			.'<input type="hidden" name="modifysubmitter" value="'.$ratinguser.'" />'
			.'<span class="thick">'._CATEGORY.':</span> <select name="cat">';
		$result2 = $db->sql_query('SELECT cid, title, parentid from '.$prefix.'_links_categories order by title');
		while($row2 = $db->sql_fetchrow($result2)) {
			$cid2 = $row2['cid'];
			$ctitle2 = check_html($row2['title'], 'nohtml');
			$parentid2 = $row2['parentid'];
			if ($cid2==$cid) {
				$sel = ' selected="selected"';
			} else {
				$sel = '';
			}
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo '<option value="'.$cid2.'"'.$sel.'>'.$ctitle2.'</option>';
		}
		echo '</select><br /><br />'
			.'<input type="hidden" name="l_op" value="modifylinkrequestS" />'
			.'<input type="submit" value="'._SENDREQUEST.'" /></form>';
	}
	CloseTable();
	echo '</div>';
	include_once('footer.php');
}

function modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter) {
	global $prefix, $db, $user, $module_name, $anonymous;
	include('modules/'.$module_name.'/l_config.php');
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else {
		$ratinguser = $anonymous;
	}
	$blocknow = 0;
	if ($blockunregmodify == 1 && $ratinguser==$anonymous) {
		include_once('header.php');
		menu(1);
		echo '<br />';
		OpenTable();
		echo '<div class="text-center content">' , _ONLYREGUSERSMODIFY , '</div>';
		$blocknow = 1;
		CloseTable();
		include_once('footer.php');
	}
	if ($blocknow != 1) {
		$cat = explode('-', $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		// RN0001000 - modified these lines similar to the brokenlinkS code above
		// Also removed potential double-escaping
		$title = addslashes(check_html($title, 'nohtml'));
		$url = addslashes(check_html($url, 'nohtml'));
		$description = addslashes(check_html($description, 'html'));
		$lid = intval($lid);
		$cat[0] = intval($cat[0]);
		$cat[1] = intval($cat[1]);
		$db->sql_query('insert into '.$prefix.'_links_modrequest values (NULL, \''.$lid.'\', \''.$cat[0].'\', \''.$cat[1].'\', \''.$title.'\', \''.$url.'\', \''.$description.'\', \''.$ratinguser.'\', \'0\')');
		include_once('header.php');
		menu(1);
		echo '<br />';
		OpenTable();
		echo '<div class="text-center content">' , _THANKSFORINFO , ' ' , _LOOKTOREQUEST , '</div>';
		CloseTable();
		include_once('footer.php');
	}
}

function rateinfo($lid) {
	global $prefix, $db;
	$lid = intval($lid);
	$db->sql_query('update '.$prefix.'_links_links set hits=hits+1 where lid=\''.$lid.'\'');
	$row = $db->sql_fetchrow($db->sql_query('SELECT url from '.$prefix.'_links_links where lid=\''.$lid.'\''));
	$url = $row['url'];
	Header('Location: '.$url);
}

function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) {
	global $prefix, $db, $cookie, $user, $module_name, $anonymous;
	/*****[BEGIN]******************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	 ******************************************************/
	global $modGFXChk;
	if(is_user($user)) {
		if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
		if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
			include_once 'header.php';
			OpenTable();
			echo '<div class="text-center"><span class="option thick italic">' , _SECCODEINCOR , '</span><br /><br />'
				, '[ <a href="javascript:history.go(-1)">' , _GOBACK2 , '</a> ]</div>';
			CloseTable();
			include_once 'footer.php';
			die();
		}
	}
	/*****[END]********************************************
	 [ Base:	GFX Code						   v1.0.0 ]
	******************************************************/
	$passtest = 'yes';
	include_once('header.php');
	include('modules/'.$module_name.'/l_config.php');
	$ratinglid = intval($ratinglid);
	completevoteheader();
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else if ($ratinguser=='outside') {
		$ratinguser = 'outside';
	} else {
		$ratinguser = $anonymous;
	}
	$result = $db->sql_query('SELECT title FROM '.$prefix.'_links_links WHERE lid=\''.$ratinglid.'\'');
	while ($row = $db->sql_fetchrow($result)) {
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		/* Make sure only 1 anonymous from an IP in a single day. */
		if(isset($_SERVER['REMOTE_HOST'])) { $ip = $_SERVER['REMOTE_HOST']; }
		if (empty($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if(!validIP($ip)) $ip = ''; // RN0001002 + tightened it up some with new validIP() function in mainfile.php
		/* Check if Rating is Null */
		if ($rating=='--') {
			$error = 'nullerror';
			completevote($error);
			$passtest = 'no';
		}
		/* Check if Link POSTER is voting (UNLESS Anonymous users allowed to post) */
		if ($ratinguser != $anonymous && $ratinguser != 'outside') {
			$result2 = $db->sql_query('SELECT submitter from '.$prefix.'_links_links where lid=\''.$ratinglid.'\'');
			while ($row2 = $db->sql_fetchrow($result2)) {
				$ratinguserDB = $row2['submitter'];
				if ($ratinguserDB == $ratinguser) {
					$error = 'postervote';
					completevote($error);
					$passtest = 'no';
				}
			}
		}
		/* Check if REG user is trying to vote twice. */
		if ($ratinguser != $anonymous && $ratinguser != 'outside') {
			$result3 = $db->sql_query('SELECT ratinguser from '.$prefix.'_links_votedata where ratinglid=\''.$ratinglid.'\'');
			while ($row3 = $db->sql_fetchrow($result3)) {
				$ratinguserDB = $row3['ratinguser'];
				if ($ratinguserDB==$ratinguser) {
					$error = 'regflood';
					completevote($error);
					$passtest = 'no';
				}
			}
		}
		/* Check if ANONYMOUS user is trying to vote more than once per day. */
		if ($ratinguser==$anonymous) {
			$yesterdaytimestamp = (time()-(86400 * $anonwaitdays));
			$ytsDB = Date('Y-m-d H:i:s', $yesterdaytimestamp);
			$result4 = $db->sql_query('SELECT * FROM '.$prefix.'_links_votedata WHERE ratinglid=\''.$ratinglid.'\' AND ratinguser=\''.$anonymous.'\' AND ratinghostname = \''.$ip.'\' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < \''.$anonwaitdays.'\'');
			$anonvotecount = $db->sql_numrows($result4);
			if ($anonvotecount >= 1) {
				$error = 'anonflood';
				completevote($error);
				$passtest = 'no';
			}
		}
		/* Check if OUTSIDE user is trying to vote more than once per day. */
		if ($ratinguser=='outside'){
			$yesterdaytimestamp = (time()-(86400 * $outsidewaitdays));
			$ytsDB = Date('Y-m-d H:i:s', $yesterdaytimestamp);
			$result5 = $db->sql_query('SELECT * FROM '.$prefix.'_links_votedata WHERE ratinglid=\''.$ratinglid.'\' AND ratinguser=\'outside\' AND ratinghostname = \''.$ip.'\' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < \''.$outsidewaitdays.'\'');
			$outsidevotecount = $db->sql_numrows($result5);
			if ($outsidevotecount >= 1) {
				$error = 'outsideflood';
				completevote($error);
				$passtest = 'no';
			}
		}
		/* Passed Tests */
		if ($passtest == 'yes') {
			$ratingcomments = check_html($ratingcomments, 'nohtml');
			if (!empty($ratingcomments)) {
				update_points(16);
			}
			update_points(15);
			/* All is well.  Add to Line Item Rate to DB. */
			$ratinglid = intval($ratinglid);
			$rating = intval($rating);
			if ($rating > 10 || $rating < 1) {
			  header('Location: modules.php?name='.$module_name.'&d_op=ratedownload&lid='.$ratinglid);
			  die();
			}
			 $db->sql_query('INSERT into '.$prefix.'_links_votedata values (NULL,\''.$ratinglid.'\', \''.$ratinguser.'\', \''.$rating.'\', \''.$ip.'\', \''.$ratingcomments.'\', now())');
			/* All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB. */
			/* NOTE: If weight is modified, ALL links need to be refreshed with new weight. */
			/*	 Running a SQL statement with your modded calc for ALL links will accomplish this. */
			$voteresult = $db->sql_query('SELECT rating, ratinguser, ratingcomments FROM '.$prefix.'_links_votedata WHERE ratinglid = \''.$ratinglid.'\'');
			$totalvotesDB = $db->sql_numrows($voteresult);
			include_once('modules/'.$module_name.'/voteinclude.php');
			$ratinglid = intval($ratinglid);
			$db->sql_query('UPDATE '.$prefix.'_links_links SET linkratingsummary=\''.$finalrating.'\',totalvotes=\''.$totalvotesDB.'\',totalcomments=\''.$truecomments.'\' WHERE lid = \''.$ratinglid.'\'');
			$error = 'none';
			completevote($error);
		}
	}
	completevotefooter($ratinglid, $title, $ratinguser);
	include_once('footer.php');
}

function completevoteheader(){
	menu(1);
	echo '<br />';
	OpenTable();
}

function completevotefooter($lid, $ttitle, $ratinguser) {
	global $prefix, $db, $sitename, $module_name;
	$lid = intval($lid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT url FROM '.$prefix.'_links_links WHERE lid=\''.$lid.'\''));
	$url = $row['url'];
	echo '<span class="content">'._THANKSTOTAKETIME.' '.$sitename.'. '._LETSDECIDE.'</span><br /><br /><br />';
	if ($ratinguser=='outside') {
		echo '<div class="text-center content">'.WEAPPREACIATE.' '.$sitename.'!<br /><a href="'.$url.'">'._RETURNTO.' '.$ttitle.'</a></div><br /><br />';
	}
	echo '<div class="text-center">';
	linkinfomenu($lid);
	echo '</div>';
	CloseTable();
}

function completevote($error) {
	global $module_name;
	if ($error == 'none') echo '<div class="text-center content thick">' , _COMPLETEVOTE1 , '</div>';
	if ($error == 'anonflood') echo '<div class="text-center option thick">' , _COMPLETEVOTE2 , '</div><br />';
	if ($error == 'regflood') echo '<div class="text-center option thick">' , _COMPLETEVOTE3 , '</div><br />';
	if ($error == 'postervote') echo '<div class="text-center option thick">' , _COMPLETEVOTE4 , '</div><br />';
	if ($error == 'nullerror') echo '<div class="text-center option thick">' , _COMPLETEVOTE5 , '</div><br />';
	if ($error == 'outsideflood') echo '<div class="text-center option thick">' , _COMPLETEVOTE6 , '</div><br />';
}

function ratelink($lid, $user) {
	global $prefix, $cookie, $datetime, $module_name, $anonymous;
	include_once('header.php');
	menu(1);
	echo '<br />';
	OpenTable();
	if(isset($_SERVER['REMOTE_HOST'])) { $ip = $_SERVER['REMOTE_HOST'];}
	if (empty($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if(!validIP($ip)) $ip = ''; // RN0001002 + tightened it up some with new validIP() function in mainfile.php
	$lid = intval($lid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_links_links WHERE lid=' . $lid));
	$ttitle = $row['title'];

	echo '<div class="content"><span class="thick">'.htmlentities(str_replace('_', ' ', $ttitle)).'</span>'
		.'<ul>'
		.'<li>'._RATENOTE1.'</li>'
		.'<li>'._RATENOTE2.'</li>'
		.'<li>'._RATENOTE3.'</li>'
		.'<li>'._RATENOTE4.'</li>'
		.'<li>'._RATENOTE5.'</li>';
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(':', $user2);
		echo '<li>'._YOUAREREGGED.'</li>'
			.'<li>'._FEELFREE2ADD.'</li>';
		cookiedecode($user);
		$auth_name = $cookie[1];
	} else {
		echo '<li>'._YOUARENOTREGGED.'</li>'
			.'<li>'._IFYOUWEREREG.'</li>';
		$auth_name = $anonymous;
	}
	echo '</ul>'
		.'<form method="post" action="modules.php?name='.$module_name.'">'
		.'<table border="0" cellpadding="1" cellspacing="0" width="100%">'
		.'<tr><td width="25" nowrap="nowrap"></td><td width="550">'
		.'<input type="hidden" name="ratinglid" value="'.$lid.'" />'
		.'<input type="hidden" name="ratinguser" value="'.$auth_name.'" />'
		.'<input type="hidden" name="ratinghost_name" value="'.$ip.'" />'
		._RATETHISSITE
		.'&nbsp;<select name="rating">'
		.'<option>--</option>'
		.'<option>10</option>'
		.'<option>9</option>'
		.'<option>8</option>'
		.'<option>7</option>'
		.'<option>6</option>'
		.'<option>5</option>'
		.'<option>4</option>'
		.'<option>3</option>'
		.'<option>2</option>'
		.'<option>1</option>'
		.'</select>'
		.'&nbsp;&nbsp;<input type="submit" value="'._RATETHISSITE.'" />'
		.'<br /><br />';
	if(is_user($user)) {
		echo '<span class="thick">'._SCOMMENTS.':</span><br /><textarea cols="50" rows="10" name="ratingcomments"></textarea>'
			 .'<br /><br />';
		/*****[BEGIN]******************************************
		 [ Base:	GFX Code						   v1.0.0 ]
		 ******************************************************/
		global $modGFXChk;
		echo security_code($modGFXChk[$module_name], 'stacked').'<br />';
		/*****[END]********************************************
		 [ Base:	GFX Code						   v1.0.0 ]
		 ******************************************************/
	} else {
		echo'<input type="hidden" name="ratingcomments" value="" />';
	}
	echo '</td></tr></table>'
	, '<input type="hidden" name="l_op" value="addrating" /></form>'
	, '<div class="text-center">';
	linkfooterchild($lid);
	echo '</div></div>';
	CloseTable();
	include_once('footer.php');
}

?>