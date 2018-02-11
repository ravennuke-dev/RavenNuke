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
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (stristr($_SERVER['REQUEST_URI'],'mainfile')) {
	Header('Location: modules.php?name='.$module_name.'&file=articlebox&sid='.$sid);
} elseif (empty($sid) && !isset($tid)) {
	Header('Location: index.php');
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
if ($numrows!=1) {
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
# nukeSEO Social Bookmarking added Tricked Out News
require_once('includes/nukeSEO_SB.php');
global $nukeurl, $subject;
$articleurl = $nukeurl.'/modules.php?name=News&file=article&sid='.$sid;
$articletitle = $title;
$socialbookmarkHTML = getBookmarkHTML( $articleurl, $articletitle, "&nbsp;", "small");
# nukeSEO Social Bookmarking
if (empty($aaid)) {
	Header('Location: modules.php?name='.$module_name);
	die();
}
$db->sql_query('UPDATE '.$prefix.'_stories SET counter=counter+1 where sid='.$sid);
$artpage = 1;
$pagetitle = '- '.$title;
$artpage = 0;
formatTimestamp($time);
/* montego - unfortunately, FB wrote articles.php differently than index.php.  In index.php, no he relies
	on the theme to format each article, which is the right way of doing it. Then, for some reason, in
	article.php, he does it differently.  This wreaks havoc with HTML/XHTML compliance. I see that most of
	the core PHP-Nuke themes do formatting in both themeindex() and themearticle(), therefore, I think it
	best to do this the right way, and remove it from here.  Yes, it could break some themes, but if we
	want to be compliant... we'll just have to help folks out.  We will pass $notes as we should.

if (!empty($notes)) {
	 $notes = '<br /><br /><span class="thick">'._NOTE.'</span> <span class="italic">'.$notes.'</span>';
} else {
	 $notes = '';
}
*/
if(empty($bodytext)) {
	 $bodytext = $hometext;
} else {
	 $bodytext = $hometext.''.$bodytext;
}
if (!empty($notes)) {
$bodytext = $bodytext . '<span class="thick">'._NOTE.'</span><br />' . $notes;
}
if(empty($informant)) {
	 $informant = $anonymous;
}
getTopics($sid);
if ($catid != 0) {
	 $row2 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_stories_cat WHERE catid=\''.$catid.'\''));
	 $title1 = $row2['title'];
	 $title = '<a href="modules.php?name='.$module_name.'&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'"><span class="storycat">'.$title1.'</span></a>: '.$title;
}
echo '<table width="100%" border="0"><tr><td valign="top" width="100%">'."\n";
if (is_admin($admin)) {
echo '<div class="text-center centered"><span class="thick">'._ADMIN.'</span><br />[ <a href="'.$admin_file.'.php?op=adminStory">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</div><br />';
}
themearticle($aaid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext, $subject, $notes);
global $multilingual, $currentlang, $admin_file, $user;
if ($multilingual == 1) {
	 $querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
	 $querylang = '';
}
$row9 = $db->sql_fetchrow($db->sql_query('SELECT sid, title FROM '.$prefix.'_stories WHERE topic=\''.$topic."' $querylang".' ORDER BY counter DESC LIMIT 0,1'));
$topstory = $row9['sid'];
$ttitle = $row9['title'];


if ($multilingual == 1) {
	 $querylang = 'AND (blanguage=\''.$currentlang.'\' OR blanguage=\'\')';
} else {
	 $querylang = '';
}
cookiedecode($user);
//RN0000453 - montego - unnecessary include and SQL call
if (!empty($associated)) {
	 OpenTable();
	 echo '<div class="text-center centered"><span class="thick">'._ASSOTOPIC.'</span>';
	 $asso_t = explode('-',$associated);
	 for ($i=0; $i<sizeof($asso_t); $i++) {
		  if (!empty($asso_t[$i])) {
				$query = $db->sql_query('SELECT topicimage, topictext from '.$prefix.'_topics WHERE topicid=\''.(int)$asso_t[$i].'\'');
				list($topicimage, $topictext) = $db->sql_fetchrow($query);
				echo '<a href="modules.php?name='.$module_name.'&amp;new_topic='.(int)$asso_t[$i].'"><img src="'.$tipath.$topicimage.'" border="0" hspace="10" alt="'.$topictext.'" title="'.$topictext.'" /></a>';
		  }
	 }
	 echo '</div>';
	 CloseTable();
}
?>
