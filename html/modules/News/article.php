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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
if (!isset($op)) $op = '';
if (!isset($gfx_check)) $gfx_check = '';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

// theme specific styling: located @ themes/ANY_ACTIVE_THEME/style/news.css
$PreferredStyle = 'news.css';
$ThemeSel = get_theme();
$tonCssFile = INCLUDE_PATH . 'themes/' . $ThemeSel . '/style/' . $PreferredStyle;
$DefaultStyle = 'modules/'.$module_name.'/css/' . $PreferredStyle;
if (file_exists($tonCssFile)) {
	addCSSToHead($tonCssFile, 'file');
	}else{
	addCSSToHead($DefaultStyle, 'file');
}
	addJSToHead('includes/jquery/jquery.js', 'file');
	addJSToBody('modules/'.$module_name.'/js/jquery.rating.js', 'file');
	addJSToBody('modules/'.$module_name.'/js/slidingDiv.js', 'file');
	// TON SETTINGS
	$sql = 'SELECT * FROM '.$prefix.'_ton';
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$rblocks =  $row['rblocks'];
	$artview =  $row['artview'];
	$TON_usePDF =  $row['TON_usePDF'];
	$TON_useRating =  $row['TON_useRating'];
	$TON_useSendToFriend =  $row['TON_useSendToFriend'];
	$showtags = $row['showtags'];
	$topadact =  $row['topadact'];
	$topad =  $row['topad'];
	$bottomadact =  $row['bottomadact'];
	$bottomad =  $row['bottomad'];
	$usedisqus = $row['usedisqus'];
	$shortname = $row['shortname'];
	$googlapi = $row['googlapi'];
	$usegooglsb = $row['usegooglsb'];
	$usegooglart = $row['usegooglart'];

if ($rblocks == '1') {
define('INDEX_FILE', TRUE);
}

if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (stristr($_SERVER['REQUEST_URI'],'mainfile')) {
	Header('Location: modules.php?name='.$module_name.'&file=article&sid='.$sid);
	exit;
} elseif (empty($sid) && !isset($tid)) {
	Header('Location: index.php');
	exit;
}

$mode = $order = $thold = '';
if (isset($user)) {
	cookiedecode($user);
	if (is_user($user)) {
		getusrinfo($user);
		$mode = strtolower($userinfo['umode']);
		$order = (int)$userinfo['uorder'];
		$thold = (int)$userinfo['thold'];
	}
}
if (empty($mode) || ($mode != 'thread' && $mode != 'nested' && $mode != 'flat' && $mode != 'nocomments')) {
	$mode = 'nested';
}
if (empty($order)) {
	$order = 0;
}
if (empty($thold)) {
	$thold = -1;
}
if ($op == 'Reply') {
	Header('Location: modules.php?name='.$module_name.'&file=comments&op=Reply&pid=0&sid='.$sid.$display);
}

	$result = $db->sql_query('SELECT catid, aid, time, title, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings, associated FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
	$numrows = $db->sql_numrows($result);
	if (intval($numrows)!=1) {
		Header('Location: index.php');
		die();
	}
	$row = $db->sql_fetchrow($result);
	$catid = $row['catid'];
	$aaid = $row['aid'];
	$time = $row['time'];
	$title = htmlentities($row['title'], ENT_QUOTES);
	$hometext = $row['hometext'];
	$bodytext = $row['bodytext'];
	$topic = $row['topic'];
	$informant = $row['informant'];
	$notes = $row['notes'];
	$acomm = $row['acomm'];
	$haspoll = $row['haspoll'];
	$pollID = $row['pollID'];
	$score = $row['score'];
	$ratings = $row['ratings'];
	$associated = $row['associated'];
	if (isset($googlapi) AND ($usegooglsb) OR ($usegooglart)) {
		$gooarticleurl = $nukeurl.'/modules.php?name='.$module_name.'&file=article&sid='.$sid;
		$longUrl = $gooarticleurl;
		$apiKey = $googlapi;
		$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
		$jsonData = json_encode($postData);
		$curlObj = curl_init();
		curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		$response = curl_exec($curlObj);
		$json = json_decode($response);
		curl_close($curlObj);
		$goourl = $json->id;
		$endshort = '<div>Short URL: <input value="'.$goourl.'" id="goourl" name="'.$goourl.'" type="text" /></div>'; //Google short url
	}

	# nukeSEO Social Bookmarking added Tricked Out News
	require_once("includes/nukeSEO_SB.php");
	global $nukeurl, $subject;
	//determine what links to use for SB
	if (isset($googlapi) AND ($usegooglsb)) {
		$articleurl = $goourl;
		}elseif (defined('TNSL_USE_SHORTLINKS')){
		$articleurl = $nukeurl.'/article'.$sid.'.html';
		}else{
		$articleurl = $nukeurl.'/modules.php?name='.$module_name.'&amp;file=article&amp;sid='.$sid;
	}
	$articletitle = $title;
	$socialbookmarkHTML = getBookmarkHTML( $articleurl, $articletitle, "&nbsp;", "small");
	# nukeSEO Social Bookmarking
	if (empty($aaid)) {
		 Header('Location: modules.php?name='.$module_name);
		 die();
	}
	$db->sql_query('UPDATE '.$prefix.'_stories SET counter=counter+1 where sid='.$sid.'');
	$artpage = 1;
	$pagetitle = '- '.$title;
	include_once('header.php');
	$artpage = 0;
	formatTimestamp($time);
	if(empty($bodytext)) {
		$bodytext = $hometext;
	} else {
		$bodytext = $hometext.''.$bodytext;
	}
	if (!empty($notes)) {
		$bodytext = $bodytext . '<span class="thick">'._NOTE.'</span><br />' . $notes;
}
	if (isset($googlapi) AND ($usegooglart)) {  //display Google Short Url under article
		$bodytext = $bodytext.'<br />'.$endshort;
	}
/* Determine if the article has attached a poll */
	if ($haspoll == 1) {
	$url = sprintf('modules.php?name=Surveys&amp;op=results&amp;pollID=%d', $pollID);
	$tonpoll = '<br /><div class="text-center"><form action="modules.php?name=Surveys" method="post">';
	$tonpoll .= '<input type="hidden" name="pollID" value="'.$pollID.'" />';
	$tonpoll .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
	$row3 = $db->sql_fetchrow($db->sql_query('SELECT pollTitle, voters FROM '.$prefix.'_poll_desc WHERE pollID=\''.$pollID.'\''));
	$pollTitle = $row3['pollTitle'];
	$voters = $row3['voters'];
	$tonpoll .= _ARTICLEPOLL;
	$tonpoll .= '<br /><div class="content"><span class="thick">'.$pollTitle.'</span></div><br /><br />'."\n";
	$tonpoll .= '<table border="0" width="100%">';
	for($i = 1; $i <= 12; $i++) {
		$result4 = $db->sql_query('SELECT pollID, optionText, optionCount, voteID FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'');
		$row4 = $db->sql_fetchrow($result4);
		$numrows = $db->sql_numrows($result4);
		if($numrows != 0) {
			$optionText = $row4['optionText'];
			if(!empty($optionText)) {
			$tonpoll .= '<tr><td valign="top" width="50%" align="right"><input type="radio" name="voteID" value="'.$i.'" /></td><td width="50%" align="left"><div class="content">'.$optionText.'</div></td></tr>'."\n";
			}
		}
	}
	$tonpoll .= '</table><div class="toncentertxt content"><input type="submit" value="'._VOTE.'" /></div>';
	if (is_user($user)) {
		cookiedecode($user);
	}
	if (!isset($sum)) $sum = 0;
	for($i = 0; $i < 12; $i++) {
		$row5 = $db->sql_fetchrow($db->sql_query('SELECT optionCount FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\''));
		$optionCount = $row5['optionCount'];
		$sum = (int)$sum+$optionCount;
	}
	$tonpoll .= '<br /><div class="content">[ <a href="modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID.'&amp;mode='.$userinfo['umode'].'&amp;order='.$userinfo['uorder'].'&amp;thold='.$userinfo['thold'].'"><span class="thick">'._RESULTS.'</span></a> | <a href="modules.php?name=Surveys"><span class="thick">'._POLLS.'</span></a> ]';

	if ($pollcomm) {
		$result6 = $db->sql_query('SELECT * FROM '.$prefix.'_pollcomments WHERE pollID=\''.$pollID.'\'');
		$numcom = $db->sql_numrows($result6);
		$tonpoll .= '<br />'._VOTES.': <span class="thick">'.$sum.'</span><br />'._PCOMMENTS.' <span class="thick">'.$numcom.'</span>'."\n\n";
	} else {
		$tonpoll .= '<br />'._VOTES.' <span class="thick">'.$sum.'</span>'."\n\n";
	}
	$tonpoll .= '</div></form></div>'."\n\n";
	$bodytext = $bodytext.$tonpoll;  //Places poll under article
}
/* End Determine if the article has attached a poll */
if(empty($informant)) {
	$informant = $anonymous;
}
/* Start Ads in article mod */
if (isset($banners) AND ($topadact)){
	$bodytext = ads($topad).'<br />'.$bodytext;
}
if (isset($banners) AND ($bottomadact)){
	$bodytext= $bodytext.'<br />'.ads($bottomad);
}
/* End Ads in article mod */
getTopics($sid);

if ($catid != 0) {
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_stories_cat WHERE catid=\''.$catid.'\''));
	$title1 = $row2['title'];
	$title = '<a href="modules.php?name='.$module_name.'&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'"><span class="storycat">'.$title1.'</span></a>: '.$title;
}

echo '<table width="100%" border="0"><tr><td valign="top" width="100%">'."\n";
/* Show admin links */
if (is_admin($admin)) {
	Opentable();
	echo '<div class="text-center"><span class="thick">'._ADMIN.'</span><br />[ <a href="'.$admin_file.'.php?op=adminStory">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</div><br />';
	Closetable();
}
themearticle($aaid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext, $subject, $notes);
/* Start show tags mod */
if ($showtags){
	$result = $db->sql_query('SELECT tag FROM '.$prefix.'_tags WHERE cid=\''.$sid.'\'');
	$istag=$db->sql_numrows($result);
	if($istag>0){
	Opentable();
	echo '<div><img src="images/news/tag.png" alt="Tags" align="left" />&nbsp;';
		while ($row = $db->sql_fetchrow($result)) {
			$tag = $row['tag'];
			$num = $db->sql_numrows($db->sql_query('SELECT tag FROM '.$prefix.'_tags WHERE tag=\''.$tag.'\''));
			if ($num<=1) { $dim = 'class1'; }
			else if ($num<=5) { $dim = 'class2'; }
			else if ($num<=20) { $dim = 'class3'; }
			else if ($num<=50) { $dim = 'class4'; }
			else { $dim = 'class5'; }
			echo '<span class="'.$dim.'"><a href="modules.php?name=Tags&amp;op=list&amp;tag='.urlencode($tag).'" title="'.htmlentities($tag, ENT_QUOTES).'">'.htmlentities($tag, ENT_QUOTES).'</a></span> ';
		}
	echo '</div>';
	Closetable();
	}
}
/* End show tags mod */
/* Start generating content for Related, Rate This and Share links */
		  $linkopacity ='opacity:0.4;filter:alpha(opacity=40)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40';
	$bminfo = '<a href="modules.php?name='.$module_name.'&amp;file=print&amp;sid='.$sid.'" class="normal-text"><img style="' . $linkopacity . '" src="images/news/print.gif" alt="'._PRINTER.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._PRINTER.']body=[]" /> </a>';
# Tricked Out News Pdf link and images added to match Social Bookmarking
if ($TON_usePDF) {
	$bminfo .= '<a target="_blank" href="modules.php?name='.$module_name.'&amp;file=printpdf&amp;id='.$sid.'" class="normal-text"><img style="' . $linkopacity . '" src="images/news/pdf.png" alt="'._PDF.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._PDF.']body=[]" /></a>&nbsp;';
}
if (is_user($user) and $TON_useSendToFriend) {
	$bminfo .= '<a href="modules.php?name='.$module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'" class="normal-text"><img style="' . $linkopacity . '" src="images/news/friend.gif" alt="'._FRIEND.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._FRIEND.']body=[]" /></a>&nbsp;';
}
	$bminfo .= '<a href="backend.php" class="normal-text"><img style="' . $linkopacity . '" src="images/news/rss.png" alt="'._RSS.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._RSS.']body=[]" /> </a>';
# nukeSEO Social Bookmarking added Tricked Out News
	$bminfo .=  $socialbookmarkHTML;
# nukeSEO Social Bookmarking
	$moreinfo = '&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Stories_Archive">'._ARCHIVE.'</a><br />'."\n";
	$moreinfo .= '&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Search&amp;topic='.$topic.'">'._MOREABOUT.' '.$topictext.'</a><br />'."\n";
	$moreinfo .= '&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Search&amp;author='.$aaid.'">'._NEWSBY.' '.$aaid.'</a><br />'."\n";
	$moreinfo .= '&nbsp;<strong><big>&middot;</big></strong>&nbsp;'._MOSTREAD.''."\n";

global $multilingual, $currentlang, $admin_file, $user;
if ($multilingual == 1) {
	/* the OR is needed to display stories who are posted to ALL languages */
	$querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
} else {
	$querylang = '';
}
	$row9 = $db->sql_fetchrow($db->sql_query('SELECT sid, title FROM '.$prefix.'_stories WHERE topic=\''.$topic.'\' '.$querylang.' ORDER BY counter DESC LIMIT 0,1'));
	$topstory = $row9['sid'];
	$ttitle = $row9['title'];
	$moreinfo .= '<a href="modules.php?name='.$module_name.'&amp;file=article&amp;sid='.$topstory.'">'.$topictext.'</a>'."\n";
if ($multilingual == 1) {
	$querylang = 'AND (blanguage=\''.$currentlang.'\' OR blanguage=\'\')';
} else {
	$querylang = '';
}
/* Start Rating */
if ($TON_useRating) {
	if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') !== FALSE) or ($artview=='old')) {
		if ($ratings != 0) {
			$rate = substr($score / $ratings, 0, 4);
			$r_image = round($rate);
			if ($r_image == 1) {
					$the_image = '&nbsp;<img src="images/articles/stars-1.gif" border="1" alt="" /></div>&nbsp;';
				} elseif ($r_image == 2) {
					$the_image = '&nbsp;<img src="images/articles/stars-2.gif" border="1" alt="" /></div>&nbsp;';
				} elseif ($r_image == 3) {
					$the_image = '&nbsp;<img src="images/articles/stars-3.gif" border="1" alt="" /></div>&nbsp;';
				} elseif ($r_image == 4) {
					$the_image = '&nbsp;<img src="images/articles/stars-4.gif" border="1" alt="" /></div>&nbsp;';
				} elseif ($r_image == 5) {
					$the_image = '&nbsp;<img src="images/articles/stars-5.gif" border="1" alt="" /></div>';
			}
		} else {
			$rate = 0;
			$the_image = '</div><br />';
		}
OpenTable();
	echo '<br /><div class="text-center">'._RATEARTICLE.'</div><br /><div class="text-center">';
	echo _AVERAGESCORE.': <span class="thick">'.$rate.'</span>&nbsp;&nbsp;'._VOTES.': <span class="thick">'.$ratings.'</span>&nbsp;</div><div class="text-center centered">'.$the_image;
	echo '<div class="text-center centered"><form action="modules.php?name='.$module_name.'" method="post">'._RATETHISARTICLE.'<br /><br />';
	echo '<input type="hidden" name="sid" value="'.$sid.'" />';
	echo '<input type="hidden" name="op" value="rate_article" />';
	echo '<input type="radio" name="score" value="5" /> <img src="images/articles/stars-5.gif" alt="'._EXCELLENT.'" title="'._EXCELLENT.'" />&nbsp;';
	echo '<input type="radio" name="score" value="4" /> <img src="images/articles/stars-4.gif" alt="'._VERYGOOD.'" title="'._VERYGOOD.'" />&nbsp;';
	echo '<input type="radio" name="score" value="3" /> <img src="images/articles/stars-3.gif" alt="'._GOOD.'" title="'._GOOD.'" />&nbsp;';
	echo '<input type="radio" name="score" value="2" /> <img src="images/articles/stars-2.gif" alt="'._REGULAR.'" title="'._REGULAR.'" />&nbsp;';
	echo '<input type="radio" name="score" value="1" /> <img src="images/articles/stars-1.gif" alt="'._BAD.'" title="'._BAD.'" />&nbsp;';
	echo '<br /><br /><input type="submit" value="'._CASTMYVOTE.'" /></form></div>';

	}else{
	if ($ratings != 0) {
		$rate = substr($score/$ratings, 0, 4);
		$r_image = round($rate);
		if ($r_image == 1) {
			$the_image = '<div class="centerstar"><input name="star3" type="radio" class="star" title="'._BAD.'" disabled="disabled" checked="checked" />
	<input name="star3" type="radio" class="star" title="'._BAD.'"  disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._BAD.'"  disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._BAD.'"  disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._BAD.'"  disabled="disabled" /></div><br />';
		} elseif ($r_image == 2) {
			$the_image = '<div class="centerstar"><input name="star3" type="radio" class="star" title="'._REGULAR.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._REGULAR.'" disabled="disabled" checked="checked" />
	<input name="star3" type="radio" class="star" title="'._REGULAR.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._REGULAR.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._REGULAR.'" disabled="disabled" /></div><br />';
		} elseif ($r_image == 3) {
			$the_image = '<div class="centerstar"><input name="star3" type="radio" class="star" title="'._GOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._GOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._GOOD.'" disabled="disabled" checked="checked" />
	<input name="star3" type="radio" class="star" title="'._GOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._GOOD.'" disabled="disabled" /></div><br />';
		} elseif ($r_image == 4) {
			$the_image = '<div class="centerstar"><input name="star3" type="radio" class="star" title="'._VERYGOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._VERYGOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._VERYGOOD.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._VERYGOOD.'" disabled="disabled" checked="checked" />
	<input name="star3" type="radio" class="star" title="'._VERYGOOD.'" disabled="disabled" /></div><br />';
		} elseif ($r_image == 5) {
			$the_image = '<div class="centerstar"><input name="star3" type="radio" class="star" title="'._EXCELLENT.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._EXCELLENT.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._EXCELLENT.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._EXCELLENT.'" disabled="disabled" />
	<input name="star3" type="radio" class="star" title="'._EXCELLENT.'" disabled="disabled" checked="checked" /></div><br />';
		}
	} else {
	$rate = 0;
	$the_image = '';
	}
	$rateinfo = '<div class="text-center">'._RATEARTICLE.'<br />'._RATETHISARTICLE.'<br />';
	$rateinfo .= _AVERAGESCORE.': <span class="thick">'.$rate.'</span>&nbsp;&nbsp;'._VOTES.': <span class="thick">'.$ratings.'</span><br />'.$the_image;
	$rateinfo .= '<form action="modules.php?name='.$module_name.'" method="post">';
	$rateinfo .= '<br /><div class="centerstars"><input type="hidden" name="sid" value="'.$sid.'" />';
	$rateinfo .= '<input type="hidden" name="op" value="rate_article" />';
	$rateinfo .= '<input type="radio" name="score" value="1" class="star" title="'._BAD.'" />';
	$rateinfo .= '<input type="radio" name="score" value="2" class="star" title="'._REGULAR.'" />';
	$rateinfo .= '<input type="radio" name="score" value="3" class="star" title="'._GOOD.'" />';
	$rateinfo .= '<input type="radio" name="score" value="4" class="star" title="'._VERYGOOD.'" />';
	$rateinfo .= '<input type="radio" name="score" value="5" class="star" title="'._EXCELLENT.'" /></div>';
	$rateinfo .= '<br /><br /><input type="submit" value="'._CASTMYVOTE.'" /></form></div>';
	}
} else {
	$rateinfo = '';
}
if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') !== FALSE) or ($artview=='old')) {

	echo '<div class="toncenterdiv toncentertxt">'.$moreinfo.'<br /><br />'.$rateinfo.'<br /><br />'.$bminfo.'</div>';
		CloseTable();
	}else{
	Opentable();
	//Redisigned for 2.6 to work with all themes
	echo '<div class="toncenterdiv toncentertxt"><a style="padding: 2px; text-decoration:none;" onclick="Moreinfo(); return false;" href="#"><img style="padding-top:3px;" src="images/news/click.png" alt="click" />&nbsp;'._TONRELATED.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="slidingDiv1" style="padding: 4px; display:none;">'.$moreinfo.'</div>';
	if ($TON_useRating) echo '<a style="padding: 2px; text-decoration:none;" onclick="Rateinfo(); return false;" href="#"><img style="padding-top:3px;" src="images/news/click.png" alt="click" />&nbsp;'._TONRATETHIS.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="slidingDiv2" style="padding: 4px; display:none;"><br />'.$rateinfo.'</div>';
	echo '<a style="padding: 2px; text-decoration:none;" onclick="Bminfo(); return false;" href="#"><img style="padding-top:3px;" src="images/news/click.png" alt="click" />&nbsp;'._TONSHARE.'</a><div id="slidingDiv3" style="padding: 4px; display:none;">'.$bminfo.'</div>';
	echo '</div>';
	Closetable();
}
/* End generating content for Related, Rate This and Share links */
cookiedecode($user);
if (!empty($associated)) {
	OpenTable();
	echo '<div class="toncenterdiv toncentertxt"><span class="thick">'._ASSOTOPIC.'</span>';
	$asso_t = explode('-',$associated);
	for ($i=0; $i<sizeof($asso_t); $i++) {
		if (!empty($asso_t[$i])) {
			$query = $db->sql_query('SELECT topicimage, topictext from '.$prefix.'_topics WHERE topicid=\''.(int)$asso_t[$i].'\'');
			list($topicimage, $topictext) = $db->sql_fetchrow($query);
			echo '<a href="modules.php?name='.$module_name.'&amp;new_topic='.(int)$asso_t[$i].'"><br /><br /><img src="'.$tipath.$topicimage.'" hspace="10" alt="'.$topictext.'" title="'.$topictext.'" /></a>';
		}
	}
	echo '</div>';
	CloseTable();
}
if ($usedisqus) {
	//Start Disqus
	//if ($anonpost==1 OR (isset($admin) AND (is_admin($admin) AND $acomm == 0)) OR (is_user($user) AND $acomm == 0)) {
	Opentable();
	$ds = $shortname;
	$did = $module_name.'-'.$sid;
	// $pageurl is used inside of javascript - do not use &amp; unless output as html
	// To properly tap $pageurl shortlink users must set $tnsl_bAutoTapLinks = true in rnconfig.php
	$pageurl = $nukeurl.'/modules.php?name='.$module_name.'&file=article&sid='.$sid;
	include_once('includes/jquery/disqus.php');
	echo disqus($ds, $did, $pageurl);
	Closetable();
	// End Disqus
	//}
echo '</td></tr></table>'."\n";
// End Disqus
}else{

// Start Regular Comment Code
if (empty($mode) OR $mode != 'nocomments' OR $acomm == 0 OR $articlecomm == 1) {
		include_once('modules/News/comments.php');

}
}
include_once ('footer.php');
?>