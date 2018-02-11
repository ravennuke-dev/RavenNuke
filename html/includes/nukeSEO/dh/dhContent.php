<?php
/************************************************************************/
/* nukeSEO
/* http://www.nukeSEO.com
/* Copyright (c) 2009 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
class dhContent extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'pid';
		$this->content_table     = $prefix.'_pages';
		$this->contentTitleArray = array('title', 'subtitle');
		$this->contentDescArray  = array('page_header');
		$this->contentKeysArray  = array('title', 'subtitle','page_header','text','page_footer','signature');
		$this->cat_id            = 'cid';
		$this->cat_table         = $prefix.'_pages_categories';
		$this->catTitleArray     = array('title');
		$this->catDescArray      = array('description');
		$this->catKeysArray      = array('title','description');
		// If pending content is stored in the same table, inactive content, private content, etc.
		$this->activeWhere       = 'active = 1';
	}
	function getContentID() {
		global $pid;
		return $pid; 
	}
	function setContentID() {
		global $pid, $dhID;
		$pid = $dhID;
	}
	function getCatID() { 
		global $cid;
		return $cid; 
	}
	function setCatID() { 
		global $cid, $dhCat;
		$cid = $dhCat;
	}
}
?>