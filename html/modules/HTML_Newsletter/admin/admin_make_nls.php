<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('MSNL_LOADED')) die('Illegal File Access');
/************************************************************************
* Script Initialization
************************************************************************/
/************************************************************************
* Setup the fixed newsletter variables
************************************************************************/
$msnl_sTopic = msnl_fXMLEntities($_POST['msnl_topic']);   // Replaces the {EMAILTOPIC} tag
$msnl_sSender = msnl_fXMLEntities($_POST['msnl_sender']); // Replaces the {SENDER} tag
$msnl_sTextbody = $_POST['msnl_textbody'];                // Replaces the {TEXTBODY} tag
$msnl_sTemplateNm = $_POST['msnl_template'];              // Replaces the {TEMPLATENAME} tag
$msnl_sSendDate = date('F d Y');                          // Replaces the {DATE} tag @todo should make this configurable and locale aware
$msnl_iCID = intval($_POST['msnl_cid']);
/************************************************************************
* Load Template file if one was selected
************************************************************************/
if ($msnl_sTemplateNm != 'notemplate') {
	include_once './modules/' . $msnl_sModuleNm . '/templates/' . $msnl_sTemplateNm . '/template.php';
	$msnl_sEmailText = $emailfile;
} else {
	$msnl_sEmailText = '';
}
/************************************************************************
* Build Statistics if chosen to do so and as long as a template was selected
*  - to replace the {STATS} tag
************************************************************************/
if ($_POST['msnl_stats'] == 'yes' && $msnl_sTemplateNm != 'notemplate') {
	/*
	 * Total Members
	 */
	$sql = 'SELECT `user_id` FROM `' . $user_prefix . '_users` WHERE `username` <> \'Anonymous\'';
	if (!$result = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR);
	} else {
		$msnl_iStatsTotUsr = $db->sql_numrows($result);
	}
	/*
	 * Total Hits
	 */
	$sql = 'SELECT `count` FROM `' . $prefix . '_counter` WHERE `type` = \'total\' AND `var` = \'hits\' LIMIT 1';
	if (!$result1 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS);
	} else {
		$row = $db->sql_fetchrow($result1);
		$msnl_iStatsTotHits = (int)$row['count'];
	}
	/*
	 * Total News Stories
	 */
	$sql = 'SELECT `sid` FROM `' . $prefix . '_stories`';
	if (!$result2 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS);
	} else {
		$msnl_iStatsTotNews = $db->sql_numrows($result2);
	}
	/*
	 * Total News categories
	 */
	$sql = 'SELECT `catid` FROM `' . $prefix . '_stories_cat`';
	if (!$result3 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT);
	} else {
		$msnl_iStatsTotNewsCat = $db->sql_numrows($result3);
	}
	/*
	 * Total Downloads Files
	 */
	$sql = 'SELECT `lid` FROM `' . $prefix . '_' . $msnl_gasModCfg['dl_module'] . '_downloads`';
	if (!$result4 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS);
	} else {
		$msnl_iStatsTotDls = $db->sql_numrows($result4);
	}
	/*
	 * Total Downloads Categories
	 */
	$sql = 'SELECT `cid` FROM `' . $prefix . '_' . $msnl_gasModCfg['dl_module'] . '_categories`';
	if (!$result5 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT);
	} else {
		$msnl_iStatsTotDlsCat = $db->sql_numrows($result5);
	}
	/*
	 * Total Web Links
	 */
	$sql = 'SELECT `lid` FROM `' . $prefix . '_links_links`';
	if (!$result6 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS);
	} else {
		$msnl_iStatsTotLnks = $db->sql_numrows($result6);
	}
	/*
	 * Total Web Links Categories
	 */
	$sql = 'SELECT `cid` FROM `' . $prefix . '_links_categories`';
	if (!$result7 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT);
	} else {
		$msnl_iStatsTotLnksCat = $db->sql_numrows($result7);
	}
	/*
	 * Total Amount of Forum Topics
	 */
	$sql = 'SELECT `topic_id` FROM `' . $prefix . '_bbtopics`';
	if (!$result8 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS);
	} else {
		$msnl_iStatsTotForums = $db->sql_numrows($result8);
	}
	/*
	 * Total Amount of forum Posts
	 */
	$sql = 'SELECT `post_id` FROM `' . $prefix . '_bbposts`';
	if (!$result9 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS);
	} else {
		$msnl_iStatsTotPosts = $db->sql_numrows($result9);
	}
	/*
	 * Total Amount of Reviews
	 */
	$sql = 'SELECT `id` FROM `' . $prefix . '_reviews`';
	if (!$result10 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS);
	} else {
		$msnl_iStatsTotReviews = $db->sql_numrows($result10);
	}
	/*
	 * Replace the stats rows in the template
	 */
	$msnl_sTotStats = $statstable;
	$msnl_sTotStats = str_replace('{PAGEHITS}', $msnl_iStatsTotHits, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{MEMBERS}', $msnl_iStatsTotUsr, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{NEWSITEMS}', $msnl_iStatsTotNews, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{NEWSCAT}', $msnl_iStatsTotNewsCat, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{DOWNLOADS}', $msnl_iStatsTotDls, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{DOWNLOADCAT}', $msnl_iStatsTotDlsCat, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{WEBLINKS}', $msnl_iStatsTotLnks, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{WEBLINKCAT}', $msnl_iStatsTotLnksCat, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{FORUMPOSTS}', $msnl_iStatsTotPosts, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{FORUMTOPICS}', $msnl_iStatsTotForums, $msnl_sTotStats);
	$msnl_sTotStats = str_replace('{REVIEWS}', $msnl_iStatsTotReviews, $msnl_sTotStats);
} else { // Will otherwise not be including Statistics
	$msnl_sTotStats = '';
}
/************************************************************************
* Build the Latest X News Items - to replace the {NEWS} tag
************************************************************************/
if ($_POST['msnl_news'] > 0 && $msnl_sTemplateNm != 'notemplate') {
	$i = 0;
	$msnl_sRows = '';
	$sql = 'SELECT `sid`, `informant`, `title`, `topic`, `topictext`, a.`counter` AS counter FROM `'
		. $prefix . '_stories` a, `'
		. $prefix . '_topics` b '
		. 'WHERE a.`topic` = b.`topicid` '
		. 'ORDER BY `time` DESC LIMIT 0, ' . $_POST['msnl_news'];
	if (!$result11 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DBGETNEWS);
	} else {
		while ($row = $db->sql_fetchrow($result11)) {
			$msnl_iSID = intval($row['sid']);
			$msnl_sNewsAuthor = $row['informant'];
			$msnl_sNewsTitle = $row['title'];
			$msnl_iNewsTopicID = intval($row['topic']);
			$msnl_sNewsTopic = $row['topictext'];
			$msnl_iNewsHits = intval($row['counter']);
			$i = ++$i; // Keep track of row number
			$msnl_sRowTmp = $latestnewsrow;
			$msnl_sRowTmp = str_replace('{NEWSID}', $msnl_iSID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{ROWNUMBER}', $i, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TITLE}', $msnl_sNewsTitle, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPICID}', $msnl_iNewsTopicID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPIC}', $msnl_sNewsTopic, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{AUTHOR}', $msnl_sNewsAuthor, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{HITS}', $msnl_iNewsHits, $msnl_sRowTmp);
			$msnl_sRows .= $msnl_sRowTmp;
		}
		$msnl_sLatestNews = $latestnewstop . $msnl_sRows . $latestnewsend;
		$msnl_sLatestNews = str_replace('{AMOUNT}', $_POST['msnl_news'], $msnl_sLatestNews);
	}
} else {
	$msnl_sLatestNews = '';
}
/************************************************************************
* Build the Latest X Downloads Items - to replace the {DOWNLOADS} tag
************************************************************************/
if ($_POST['msnl_downloads'] > 0 && $msnl_sTemplateNm != 'notemplate') {
	$i = 0;
	$msnl_sRows = '';
	$sql = 'SELECT `lid`, a.`cid` as cid, a.`title` as dtitle, `hits`, b.`title` as ctitle FROM `'
		. $prefix . '_' . $msnl_gasModCfg['dl_module'] . '_downloads` a, `'
		. $prefix . '_' . $msnl_gasModCfg['dl_module'] . '_categories` b '
		. 'WHERE a.`cid` = b.`cid` '
		. 'ORDER BY `lid` DESC LIMIT 0, ' . $_POST['msnl_downloads'];
	if (!$result12 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_SEND_ERR_DBGETDLS);
	} else {
		while ($row = $db->sql_fetchrow($result12)) {
			$msnl_iLID = intval($row['lid']);
			$msnl_iTopicCID = intval($row['cid']);
			$msnl_sDlTitle = $row['dtitle'];
			$msnl_iDlHits = intval($row['hits']);
			$msnl_sDlCat = $row['ctitle'];
			$i = ++$i; // Keep track of row number
			$msnl_sRowTmp = $latestdownloadrow;
			$msnl_sRowTmp = str_replace('{DOWNLOADID}', $msnl_iLID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{ROWNUMBER}', $i, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TITLE}', $msnl_sDlTitle, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPICID}', $msnl_iTopicCID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPIC}', $msnl_sDlCat, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{HITS}', $msnl_iDlHits, $msnl_sRowTmp);
			if ($msnl_gasModCfg['dl_module'] == 'nsngd') {
				$msnl_sRowTmp = str_replace('{DOWNLOAD_OP}', 'op', $msnl_sRowTmp);
			} else {
				$msnl_sRowTmp = str_replace('{DOWNLOAD_OP}', 'd_op', $msnl_sRowTmp);
			}
			$msnl_sRows .= $msnl_sRowTmp;
		}
		$msnl_sLatestDownloads = $latestdownloadtop . $msnl_sRows . $latestdownloadend;
		$msnl_sLatestDownloads = str_replace('{AMOUNT}', $_POST['msnl_downloads'], $msnl_sLatestDownloads);
	}
} else { // Will not be including Latest Downloads
	$msnl_sLatestDownloads = '';
}
/************************************************************************
* Build the Latest X Web Links - to replace the {WEBLINKS} tag
************************************************************************/
if ($_POST['msnl_weblinks'] > 0 && $msnl_sTemplateNm != 'notemplate') {
	$i = 0;
	$msnl_sRows = '';
	$sql = 'SELECT `lid`, a.`cid` as cid, a.`title` as ltitle, b.`title` as ctitle, `hits` FROM `'
		. $prefix . '_links_links` a, `'
		. $prefix . '_links_categories` b '
		. 'WHERE a.`cid` = b.`cid` '
		. 'ORDER BY `lid` DESC LIMIT 0, ' . $_POST['msnl_weblinks'];
	if (!$result13 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETWLS);
	} else {
		while ($row = $db->sql_fetchrow($result13)) {
			$msnl_iLID = intval($row['lid']);
			$msnl_iWlCID = intval($row['cid']);
			$msnl_sWlTitle = $row['ltitle'];
			$msnl_sWlCat = $row['ctitle'];
			$msnl_iWlHits = intval($row['hits']);
			$i = ++$i; // Keep track of row number
			$msnl_sRowTmp = $latestweblinkrow;
			$msnl_sRowTmp = str_replace('{LINKID}', $msnl_iLID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{ROWNUMBER}', $i, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TITLE}', $msnl_sWlTitle, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPICID}', $msnl_iWlCID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOPIC}', $msnl_sWlCat, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{HITS}', $msnl_iWlHits, $msnl_sRowTmp);
			$msnl_sRows.=$msnl_sRowTmp;
		}
		$msnl_sLatestLinks = $latestweblinktop . $msnl_sRows . $latestweblinkend;
		$msnl_sLatestLinks = str_replace('{AMOUNT}', $_POST['msnl_weblinks'], $msnl_sLatestLinks);
	}
} else { // Will not be including Latest Links
	$msnl_sLatestLinks = '';
}
/************************************************************************
* Build the Latest X Forum Posts - to replace the {FORUMS} tag
************************************************************************/
if ($_POST['msnl_forums'] > 0 && $msnl_sTemplateNm != 'notemplate') {
	$i = 0;
	$msnl_sRows = '';
	$msnl_iHideReadOnly = 1; // Do not show read-only forums
	$sql = 'SELECT '
		. 't.`topic_id` AS topic_id, '
		. 't.`forum_id` AS forum_id, '
		. '`topic_last_post_id`, '
		. '`topic_title`, '
		. '`topic_views`, '
		. '`topic_replies`, '
		. '`post_time`, '
		. 'ut.`username` AS ut_username, '
		. 'ut.`user_id` AS ut_user_id, '
		. 'up.`username` AS up_username, '
		. 'up.`user_id` AS up_user_id '
		. 'FROM `'
		. $prefix . '_bbtopics` t, `'
		. $prefix . '_bbforums` f, `'
		. $prefix . '_bbposts` p, `'
		. $user_prefix . '_users` ut, `'
		. $user_prefix . '_users` up '
		. 'WHERE '
		. 'f.`forum_id` = t.`forum_id` '
		. 'AND '
		. '`post_id` = `topic_last_post_id` '
		. 'AND '
		. 'ut.`user_id` = `topic_poster` '
		. 'AND '
		. 'up.`user_id` = `poster_id` ';
	if ($msnl_iHideReadOnly == 1) { // Exclude posts which should be hidden
		$sql .= 'AND `auth_view` = \'0\' AND `auth_read` = \'0\' ';
	}
	$sql .= 'AND `topic_moved_id` = \'0\' '
		. 'ORDER BY `topic_last_post_id` DESC LIMIT 0, ' . $_POST['msnl_forums'];
	if (!$result14 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETPOSTS);
	} else {
		while ($row = $db->sql_fetchrow($result14)) {
			$msnl_iTopicID = intval($row['topic_id']);
			$msnl_iForumID = intval($row['forum_id']);
			$msnl_iPostID = intval($row['topic_last_post_id']);
			$msnl_sTopicTitle = $row['topic_title'];
			$msnl_iTopicViews = intval($row['topic_views']);
			$msnl_iTopicReplies = intval($row['topic_replies']);
			$msnl_sPostTime = msnl_fFormatDate($msnl_asPHPBBCfg['default_dateformat'], $row['post_time'], $msnl_asPHPBBCfg['board_timezone']);
			$msnl_sTopicPosterNm = $row['ut_username'];
			$msnl_iTopicPosterID = intval($row['ut_user_id']);
			$msnl_sLastPosterNm = $row['up_username'];
			$msnl_iLastPosterID = intval($row['up_user_id']);
			$i = ++$i; // Keep track of row number
			$msnl_sRowTmp = $latestforumrow;
			$msnl_sRowTmp = str_replace('{ROWNUMBER}', $i, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTOPICLASTPOSTID}', $msnl_iPostID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTOPICID}', $msnl_iTopicID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTOPICREPLIES}', $msnl_iTopicReplies, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTOPICTITLE}', $msnl_sTopicTitle, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTPUSERID}', $msnl_iTopicPosterID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTPUSERNAME}', $msnl_sTopicPosterNm, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FVIEWS}', $msnl_iTopicViews, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FTIME}', $msnl_sPostTime, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FUSERID}', $msnl_iLastPosterID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{FUSERNAME}', $msnl_sLastPosterNm, $msnl_sRowTmp);
			$msnl_sRows .= $msnl_sRowTmp;
		}
		$msnl_sLatestForums = $latestforumtop . $msnl_sRows . $latestforumend;
		$msnl_sLatestForums = str_replace('{AMOUNT}', $_POST['msnl_forums'], $msnl_sLatestForums);
	}
} else { // Will not be including Latest Forums
	$msnl_sLatestForums = '';
}
/************************************************************************
* Build the Latest X Reviews - to replace the {REVIEWS} tag
************************************************************************/
if ($_POST['msnl_reviews'] > 0 && $msnl_sTemplateNm != 'notemplate') {
	$i = 0;
	$msnl_sRows = '';
	$sql = 'SELECT `id`, `reviewer`, `title`, `hits`, `date` FROM `'
		. $prefix . '_reviews` '
		. 'ORDER BY `id` DESC LIMIT 0, ' . $_POST['msnl_reviews'];
	if (!$result15 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETREVIEWS);
	} else {
		while ($row = $db->sql_fetchrow($result15)) {
			$msnl_iReviewID = intval($row['id']);
			$msnl_sReviewAuthor = $row['reviewer'];
			$msnl_sReviewTitle = $row['title'];
			$msnl_iReviewHits = intval($row['hits']);
			$msnl_sReviewDt = $row['date'];
			$msnl_sReviewDtFormat = trim(preg_replace('%[g\:iabhsu]%i', '', $msnl_asPHPBBCfg['default_dateformat']));
			$msnl_sReviewDt = msnl_fFormatDate($msnl_sReviewDtFormat, strtotime($msnl_sReviewDt) , $msnl_asPHPBBCfg['board_timezone']);
			$i = ++$i;
			$msnl_sRowTmp = $latestreviewsrow;
			$msnl_sRowTmp = str_replace('{ROWNUMBER}', $i, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{REVIEWID}', $msnl_iReviewID, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TITLE}', $msnl_sReviewTitle, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{REVIEWAUTHOR}', $msnl_sReviewAuthor, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{REVIEWDATE}', $msnl_sReviewDt, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{HITS}', $msnl_iReviewHits, $msnl_sRowTmp);
			$msnl_sRows .= $msnl_sRowTmp;
		}
		$msnl_sLatestReviews = $latestreviewstop . $msnl_sRows . $latestreviewsend;
		$msnl_sLatestReviews = str_replace('{AMOUNT}', $_POST['msnl_reviews'], $msnl_sLatestReviews);
	}
} else { // Will not be including Latest Reviews
	$msnl_sLatestReviews = '';
}
/************************************************************************
* Build the Banner Link - to replace {BANNER} tag
************************************************************************/
if ($_POST['msnl_banner'] != '' && $msnl_sTemplateNm != 'notemplate') {
	$sql = 'SELECT `imageurl`, `clickurl`, `alttext` FROM `'
		. $prefix . '_banner` WHERE `bid` = \'' . $_POST['msnl_banner'] . '\'';
	if (!$result16 = msnl_fSQLCall($sql)) {
		msnl_fRaiseAppError(_MSNL_ADM_MAKE_ERR_DBGETBANNER);
	} else {
		$row = $db->sql_fetchrow($result16);
		$msnl_sImageURL = msnl_fFixURL($row['imageurl']);
		$msnl_sClickURL = msnl_fFixURL($row['clickurl']);
		$msnl_sAltText = $row['alttext'];
		$msnl_sBanner = '<a href="' . $msnl_sClickURL . '" title="' . $msnl_sAltText . '">'
			. '<img src="' . $msnl_sImageURL . '" alt="' . $msnl_sAltText . '">'
			. '</a>';
	}
} else { // Will not be including Banners
	$msnl_sBanner = '';
}
/************************************************************************
* Build the Newsletter Table of Contents - to replace {TOC} tag
************************************************************************/
/**
 * @todo  TNML_0000005: montego - change the labels to be multilingual
 */
if ($_POST['msnl_toc'] != '' && $msnl_sTemplateNm != 'notemplate' && isset($newscontentsrow)) {
	$msnl_sRows = '';
	$msnl_sRowTmp = '';
	/*
	 * Check for HTML anchors in the Textbody entry field.  If found, will need to create links to them
	 */
	if (preg_match_all('/<\s*A\s*name="([^\"]+)"\s*><\/A>/i', $msnl_sTextbody, $msnl_asMatches, PREG_SET_ORDER)) { // We found HTML anchors
		foreach($msnl_asMatches as $msnl_sVal) { // Cycle through the anchors and create links
			$msnl_sRowTmp = $newscontentsrow;
			$msnl_sAnchorNm = $msnl_sVal[1];
			$msnl_sRowTmp = str_replace('{TOCLINK}', $msnl_sAnchorNm, $msnl_sRowTmp);
			$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', str_replace('_', ' ', $msnl_sAnchorNm) , $msnl_sRowTmp);
			$msnl_sRows .= $msnl_sRowTmp;
		}
	}
	/*
	 * Create a link to Latest News if it exists
	 */
	if ($_POST['msnl_news'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'LatestNews', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Latest News Articles', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Create a link to Latest Downloads if it exists
	 */
	if ($_POST['msnl_downloads'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'LatestDownloads', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Latest Downloads', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Create a link to Latest Web Links if it exists
	 */
	if ($_POST['msnl_weblinks'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'LatestLinks', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Latest Web Links', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Create a link to Latest Forums if it exists
	 */
	if ($_POST['msnl_forums'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'LatestPosts', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Latest Forum Posts', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Create a link to Latest Reviews if it exists
	 */
	if ($_POST['msnl_reviews'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'LatestReviews', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Latest Reviews', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Create a link to Latest Reviews if it exists
	 */
	if ($_POST['msnl_stats'] > 0) {
		$msnl_sRowTmp = $newscontentsrow;
		$msnl_sRowTmp = str_replace('{TOCLINK}', 'Statistics', $msnl_sRowTmp);
		$msnl_sRowTmp = str_replace('{TOCLINKTEXT}', 'Site Statistics', $msnl_sRowTmp);
		$msnl_sRows .= $msnl_sRowTmp;
	}
	/*
	 * Finalize the TOC "block"
	 */
	$msnl_sNewsletterTOC = $newscontentstop . $msnl_sRows . $newscontentsend;
} else { // TOC was not selected
	$msnl_sNewsletterTOC = '';
}
/************************************************************************
* Replace the newsletter template {} (tags)
************************************************************************/
if ($msnl_sTemplateNm != 'notemplate') {
	/*
	 * Admin/author elected to use a newsletter template
	 */
	$msnl_sEmailText = str_replace('{TOC}', $msnl_sNewsletterTOC, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{NEWS}', $msnl_sLatestNews, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{WEBLINKS}', $msnl_sLatestLinks, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{FORUMS}', $msnl_sLatestForums, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{DOWNLOADS}', $msnl_sLatestDownloads, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{REVIEWS}', $msnl_sLatestReviews, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{STATS}', $msnl_sTotStats, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{EMAILTOPIC}', $msnl_sTopic, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{TEXTBODY}', $msnl_sTextbody, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{DATE}', $msnl_sSendDate, $msnl_sEmailText); // Needs to be localized
	$msnl_sEmailText = str_replace('{SITEURL}', $nukeurl, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{SITENAME}', $sitename, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{BANNER}', $msnl_sBanner, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{SENDER}', $msnl_sSender, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{ADMINEMAIL}', $adminmail, $msnl_sEmailText);
	$msnl_sEmailText = str_replace('{TEMPLATENAME}', $msnl_sTemplateNm, $msnl_sEmailText);
} else {
	/*
	 * Admin/author elected to NOT use a template
	 */
	$msnl_sEmailText = $msnl_sTextbody;
}
/************************************************************************
* Finish building the final Newsletter File content
************************************************************************/
$msnl_sNewsletter = '<?php' . "\n"
	. 'if (!defined(\'MSNL_LOADED\')) die(\'Cannot Access Newsletter Directly\');' . "\n"
	. '$ftopic = \'' . $msnl_sTopic . '\';' . "\n"
	. '$fsender = \'' . $msnl_sSender . '\';' . "\n"
	. '$fcid = \'' . $msnl_iCID . '\';' . "\n"
	. '$emailfile=<<< EOD' . "\n"
	. $msnl_sEmailText
	. "\n" . 'EOD;' . "\n"
	. "\n" . '?>';

