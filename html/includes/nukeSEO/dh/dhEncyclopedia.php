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
class dhEncyclopedia extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'tid';
		$this->content_table     = $prefix.'_encyclopedia_text';
		$this->contentTitleArray = array('title');
		$this->contentDescArray  = array('text');
		$this->contentKeysArray  = array('title','text');
		$this->cat_id            = 'eid';
		$this->cat_table         = $prefix.'_encyclopedia';
		$this->catTitleArray     = array('title');
		$this->catDescArray      = array('description');
		$this->catKeysArray      = array('title','description');
    // If pending content is stored in the same table, inactive content, private content, etc.
    $this->activeWhere       = '';
  }
  function getContentID() {
    global $tid;
    return $tid; 
  }
  function setContentID() {
		global $tid, $dhID;
		$tid = $dhID;
	}
  function getCatID() { 
    global $eid;
    return $eid; 
  }
	function setCatID() { 
		global $eid, $dhCat;
		$eid = $dhCat;
	}
}
?>