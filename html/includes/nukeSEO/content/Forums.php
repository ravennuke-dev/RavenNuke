<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../../index.php');
	exit('Access Denied');
}
define('IN_PHPBB',TRUE);

function bbcode2HTML($topic_content, $bbcode_uid, $cid)
{
	global $db, $prefix, $user_ip, $nukeuser, $user_prefix, $theme, $name, $phpbb_root_path, $board_config, $nukeurl, $userdata, $lang, $phpEx;
  $savename = $name;
  $module_name = $name = 'Forums';
  $nuke_root_path = $nukeurl.'modules.php?name='.$module_name;
  $nuke_file_path = $nukeurl.'modules.php?name='.$module_name.'&file=';
  $phpbb_root_path = 'modules/'.$module_name.'/';
  $bbtonukepath = $phpbb_root_path.'includes/';
  $phpbb_root_dir = './../';
  if (!file_exists($bbtonukepath.'bbcode.php')) $bbtonukepath = 'includes/';
  #require_once("modules/".$module_name."/nukebb.php");
  include_once($phpbb_root_path.'extension.inc');
  include_once($phpbb_root_path.'common.php');
  include_once($bbtonukepath.'bbcode.php');
  //
  // Start session management
  //
  $userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
  init_userprefs($userdata);
  //
  // End session management
  //
  $name = $savename;
  //
  // Define censored word matches
  //
  $orig_word = array();
  $replacement_word = array();
  obtain_word_list($orig_word, $replacement_word);
  //
  // Censor topic title
  //
  if ( count($orig_word) )
  {
    $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
  }
  $topic_content = bbencode_second_pass($topic_content, $bbcode_uid, $cid);
  $topic_content = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($topic_content, $bbcode_uid, $cid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $topic_content);
  if ( $board_config['allow_smilies']) $topic_content = smilies_pass($topic_content);
  $topic_content = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $topic_content . '<'), 1, -1));
  $topic_content = str_replace("\n", "\n<br />\n", $topic_content);
  return $topic_content;
}

function getusernamefromid($id)
{
	global $db, $user_prefix;
	$res = $db->sql_query('SELECT username FROM '.$user_prefix.'_users WHERE user_id="'.$id.'" LIMIT 1;');
	$res = $db->sql_fetchrow($res);
	return $res['username'];
}

class seoForums extends seocontentclass
{
	function __construct()
  {
		global $prefix, $user_prefix;
    $bbtonukepath = 'modules/Forums/includes/';
    if (!file_exists($bbtonukepath.'constants.php')) $bbtonukepath = 'includes/';
    include_once($bbtonukepath.'constants.php');
		$this->name                  = 'Forums';
		$this->sql_col_id            = 't.topic_last_post_id';
		$this->sql_col_title         = 't.topic_title';
		$this->sql_col_desc          = 'pt.post_text';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 't.topic_time';
		$this->sql_col_author        = 'poster_id';
		$this->sql_table_with_prefix = $prefix.'_bbtopics t, '.$prefix.'_bbforums f, '.$prefix.'_bbposts p, '.$prefix.'_bbposts_text pt';
    // Must check if forum is private
    $this->activeWhere           =  't.forum_id = f.forum_id  AND '.
                                    't.topic_last_post_id = p.post_id AND '.
                                    't.topic_last_post_id = pt.post_id AND '.
                                    '(f.auth_view < 2 or f.auth_read < 2) AND '.
                                    't.topic_type = "' . POST_NORMAL . '"';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'most views',
                                      'active' => 'most replies',
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'topic_last_post_id DESC',
                                      'popular' => 'topic_views DESC',
                                      'active' => 'topic_replies DESC',
                                   );

		$this->levelArray            = array
                                   (
                                      'category' => 'category',
                                      'forum' => 'forum'
                                   );
		$this->levelSQLArray         = array(
                                      'category' => 'f.cat_id',
                                      'forum' => 't.forum_id'
                                   );
  }

  function tablesExist()
  {
    // Returns true if the tables for this module are installed
    // Assumes one table - override if necessary to test multiple
    // 1 = TRUE, 0 = FALSE
    global $db;
    $sql = 'SELECT "1" FROM '.$this->sql_table_with_prefix.' WHERE '.$this->activeWhere;
    $res = $db->sql_query($sql);
    return ($res ? 1 : 0);
  }
  function getItems($level = 'module', $lid = 0, $order = 'recent', $howmany = 10)
  {
    global $db, $prefix, $nukeurl, $board_config;
    // Retrieve items (sort id?, date, content id, title, hometext, bodytext, author, module)
    $sql =  'SELECT t.topic_last_post_id AS `cid`, '.
            't.topic_title AS `title`, '.
            'pt.post_text AS `hometext`, '.
            'p.poster_id AS `author`, ' .
            'p.post_time AS `time`, '.
            'pt.bbcode_uid  AS `bbcode_uid`'.
            'FROM '. $this->getFrom() .
            $this->getWhere($level, $lid) .
            ' ORDER BY '. $this->getOrderBy($order) .
            ' LIMIT '. $howmany;
    $items = array();
    $result = $db->sql_query($sql);

    while($item = $db->sql_fetchrow($result))
    {
      $cid = $item['cid'];
		  $item['author'] = getusernamefromid($item['author']);
      if ($item['hometext'] > '')
      {
        $item['hometext'] = bbcode2HTML($item['hometext'], $item['bbcode_uid'], $cid);
      }
      $items[$cid] = $item;
    }
    return $items;
  }

	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=Forums&file=viewtopic&p='.$id.'#'.$id;
  }
}
?>
