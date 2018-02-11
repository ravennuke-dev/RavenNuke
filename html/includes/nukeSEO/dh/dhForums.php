<?php
/************************************************************************/
/* nukeSEO
/* http://www.nukeSEO.com
/* Copyright 2008 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
class dhForums extends dhclass {
	function __construct() {
		global $prefix;
/*
 * content = topic + first post
 * subcategory = forum
 * category = forum category 
*/
		$this->content_id        = 't.topic_id';
		$this->content_table     = $prefix.'_bbtopics t, '.$prefix.'_bbposts p, '.$prefix.'_bbposts_text pt';
		$this->contentTitleArray = array('topic_title');
		$this->contentDescArray  = array('post_text');
		$this->contentKeysArray  = array('topic_title','post_subject','post_text');
		$this->cat_id            = 'cat_id';
		$this->cat_table         = $prefix.'_bbcategories';
		$this->catTitleArray     = array('cat_title');
		$this->catDescArray      = array('cat_title');
		$this->catKeysArray      = array('cat_title');
		$this->subcat_id         = 'forum_id';
		$this->subcat_table      = $prefix.'_bbforums';
		$this->subcatTitleArray  = array('forum_name');
		$this->subcatDescArray   = array('forum_desc');
		$this->subcatKeysArray   = array('forum_name', 'forum_desc');
    // If pending content is stored in the same table, inactive content, private content, etc.
    $this->activeWhere       = 't.topic_first_post_id = p.post_id AND t.topic_first_post_id = pt.post_id';
	}
  function getContentID() {
    global $t, $p, $db, $prefix;
		if ($p > 0) {
			$sql =  'SELECT topic_id FROM '. $prefix . '_bbposts WHERE post_id = \'' . $p . '\' LIMIT 1';
			list($t) = $db->sql_fetchrow($db->sql_query($sql));
		}
    return $t; 
  }
  function setContentID() {
		global $t, $p, $dhID;
		$p = 0;
		$t = $dhID;
	}
  function getCatID() { 
    global $c;
    return $c; 
  }
	function setCatID() { 
		global $c, $dhCat;
		$c = $dhCat;
	}
  function getSubCatID() { 
    global $f;
    return $f; 
  }
	function setSubCatID() { 
		global $f, $dhSubCat;
		$f = $dhSubCat;
	}
}
?>