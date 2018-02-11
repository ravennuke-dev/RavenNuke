<?php
/***************************************************************************/
/* PHP-NUKE: Web Portal System									*/
/* ===========================									*/
/*														*/
/* Copyright (c) 2002 by Francisco Burzi			*/
/* http://phpnuke.org						*/
/*											*/
/* This program is free software. You can redistribute it and/or modify			*/
/* it under the terms of the GNU General Public License as published by			*/
/* the Free Software Foundation; either version 2 of the License.	 		*/
/***************************************************************************/
/*		 Additional security & Abstraction layer conversion			*/
/*						   2003 chatserv			*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com			*/
/**************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
addCSSToHead('modules/News/css/newslink.css', 'file');
define('INDEX_FILE', true);
$categories = 1;
$catid = intval($catid);
$cat = $catid;
automated_news();
switch ($op) {
	case 'newindex':
		if ($catid == 0 OR $catid == '') {
			Header('Location: modules.php?name=' . $module_name);
		}
		theindex($catid);
		break;
	default:
		Header('Location: modules.php?name=' . $module_name);
}
die();
/*
* Only functions below here
*/
function theindex($catid) {
	global $storyhome, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $db, $articlecomm, $module_name, $userinfo, $user_news, $bookmark;
	$sql_ton = "SELECT bookmark, articlelink, TON_useTitleLink, TON_usePDF, TON_useRating, TON_useSendToFriend, showtags, usedisqus FROM ".$prefix."_ton";
	$result_ton = $db->sql_query($sql_ton);
	$row = $db->sql_fetchrow($result_ton);
	$bookmark = $row['bookmark'];
	$articlelink = $row['articlelink'];
	$TON_useTitleLink = $row['TON_useTitleLink'];
	$TON_usePDF = $row['TON_usePDF'];
	$TON_useRating = $row['TON_useRating'];
	$TON_useSendToFriend = $row['TON_useSendToFriend'];
	$showtags = $row['showtags'];
	$usedisqus = $row['usedisqus'];
	if (is_user($user)) {
		getusrinfo($user);
	}
	if ($multilingual == 1) {
		$querylang = 'AND (alanguage=\'' . $currentlang . '\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
	} else {
		$querylang = '';
	}
	include_once 'header.php';
	if (isset($userinfo['storynum']) AND $user_news == 1) {
		$storynum = $userinfo['storynum'];
	} else {
		$storynum = $storyhome;
	}
	$db->sql_query('UPDATE ' . $prefix . '_stories_cat SET counter=counter+1 WHERE catid=\'' . $catid . '\'');
	$result = $db->sql_query('SELECT sid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ' . $prefix . '_stories where catid=\'' . $catid . '\' ' . $querylang . ' ORDER BY sid DESC limit ' . $storynum);
	while ($row = $db->sql_fetchrow($result)) {
		$s_sid = $row['sid'];
		$aid = $row['aid'];
		$title = $row['title'];
		$time = $row['time'];
		$hometext = $row['hometext'];
		$bodytext = $row['bodytext'];
		$comments = $row['comments'];
		$counter = $row['counter'];
		$topic = $row['topic'];
		$informant = $row['informant'];
		$notes = $row['notes'];
		$acomm = $row['acomm'];
		$score = $row['score'];
		$ratings = $row['ratings'];
		getTopics($s_sid);
		formatTimestamp($time);
		// note ... subject is a field in nuke queue that gets turned into title in nuke_stories
		// probably not even needed here nor used but I'm leaving it in for safety
		// fkelly 12/20/2006
		if (isset($subject)) {
			$subject = $subject;
		} else {
			$subject = '';
		}
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount+$fullcount;
		$c_count = $comments;
		$story_link = '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $s_sid . '">';

		// Start Tags Mod
if ($showtags){
	$taglink = '';
$db_tags_cloud = $db->sql_query("SELECT tag FROM ".$prefix."_tags WHERE whr=3 AND cid='$s_sid'");
	$verifica_esistenza_tag = $db->sql_numrows($db_tags_cloud);
	if($verifica_esistenza_tag>0){
	$taglink = '<div class="tagindex"><img src="images/news/tag.png" alt="Tags" align="left" />&nbsp;';
		while ($row = $db->sql_fetchrow($db_tags_cloud)) {
			$tag = $row['tag'];
			$taglink .= '<a href="modules.php?name=Tags&amp;op=list&amp;tag='.urlencode($tag).'" title="'.$tag.'">'.$tag.'</a> ';
		}
		$taglink .= '</div>';
	}
	$hometext = $taglink.$hometext;
	}
	$articletitle = $title;
// End Tags Mod
if ($TON_useTitleLink) $title = $story_link.$title.'</a>'; // Make the title a link to the story
		if ($articlecomm == 1 AND $acomm == 0) {
			if ($c_count == 0) {
				$commentnum =  _COMMENTSQ . '';
			} elseif ($c_count == 1) {
				$commentnum = $c_count . ' ' . _COMMENT . '';
			} elseif ($c_count > 1) {
				$commentnum = $c_count . ' ' . _COMMENTS . '';
			}
		}

# Tricked Out News
	  $rated = 0;
		if ($score != 0) {
			$rated = substr($score/$ratings, 0, 4);
		}
		$ratetext = '' . _SCORE . ' ' . $rated;
//Start TON Links

		$bottomlink = '<a href="modules.php?name=News&amp;file=print&amp;sid='.$s_sid.'" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon print" src="modules/News/css/images/transparent.gif" border="0" alt="'._PRINTER.'" title="header=['._PRINTER.']body=[]" /></a>';
		if ($TON_usePDF) {
			$bottomlink .= '<a target="_blank" href="modules.php?name=News&amp;file=printpdf&amp;id='.$s_sid.'" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon pdf" src="modules/News/css/images/transparent.gif" border="0" alt="'._PDF.'" title="header=['._PDF.']body=[]" /></a>';

		}
		if ($TON_useSendToFriend) {
			$bottomlink .= '<a href="modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid='.$s_sid.'" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon mail" src="modules/News/css/images/transparent.gif" border="0" alt="'._FRIEND.'" title="header=['._FRIEND.']body=[]" /></a>';

		}
		if ($TON_useRating) {
			$bottomlink .= '&nbsp;<img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon rated" src="modules/News/css/images/transparent.gif" border="0" alt="'._SCORE.'" title="header=['.$ratetext.']body=[]" />';

		}
		if ($articlelink=='1'){
			if ($fullcount > 0) {
				$bottomlink .= '<a class="colorbox3 cboxelement" href="modules.php?name=News&amp;file=articlebox&amp;sid=' . $s_sid . '" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon readmore" src="modules/News/css/images/transparent.gif" alt="' . _READMORE . '" title="header=[' . _READMORE . ']body=[]" /></a>';
			}
		} elseif ($articlelink=='0') {
			if ($fullcount > 0) {
				$bottomlink .= '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $s_sid . '" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon readmore" src="modules/News/css/images/transparent.gif" alt="' . _READMORE . '" title="header=[' . _READMORE . ']body=[]" /></a>';
			}
		}

		if ($articlecomm == 1 AND $acomm == 0 AND $usedisqus == 0) {
			$bottomlink .= '<a href="modules.php?name=News&amp;file=article&amp;sid='.$s_sid.'" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon comment" src="modules/News/css/images/transparent.gif" border="0" alt="'._UCOMMENT.'" title="header=['.$commentnum.']body=[]" /></a>&nbsp;';
			}else{
			$bottomlink .= '<a href="modules.php?name=News&amp;file=article&amp;sid='.$s_sid.'" style="text-decoration: none"> <img style="opacity:0.4;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity=0.4;" class= "newsicon more" src="modules/News/css/images/transparent.gif" border="0" alt="'._MOREABOUT.'" title="header=['._MOREABOUT.']body=[]" /></a>&nbsp;';
		}

		$morelink = $bottomlink;
# Tricked Out News
if ($bookmark=="1"){
# nukeSEO Social Bookmarking Tricked Out News
	require_once("includes/nukeSEO_SB.php");
	global $nukeurl;
	$articleurl = $nukeurl."/modules.php?name=News&file=article&sid=$s_sid";
	//$articletitle = $title;
	$socialbookmarkHTML = getBookmarkHTML($articleurl, $articletitle, "&nbsp;", "small");
	$morelink .= "<br />".$socialbookmarkHTML;
	# nukeSEO Social Bookmarking
}elseif($bookmark=="0")
	echo '';
		$row2 = $db->sql_fetchrow($db->sql_query('select title from ' . $prefix . '_stories_cat where catid=\'' . $catid . '\''));
		$title1 = $row2['title'];
		$title = $title1 . ': ' . $title;
		themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
	}
	include_once 'footer.php';
}
?>