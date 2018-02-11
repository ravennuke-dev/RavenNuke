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
class dhWeb_Links extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'lid';
		$this->content_table     = $prefix.'_links_links';
		$this->contentTitleArray = array('title');
		$this->contentDescArray  = array('description');
		$this->contentKeysArray  = array('title','description');
		$this->cat_id            = 'cid';
		$this->cat_table         = $prefix.'_links_categories';
		$this->catTitleArray     = array('title');
		$this->catDescArray      = array('cdescription');
		$this->catKeysArray      = array('title','cdescription');
		// If pending content is stored in the same table, inactive content, private content, etc.
		$this->activeWhere       = '';
	}
	function getContentID() {
		global $lid;
		return $lid; 
	}
	function setContentID() {
		global $lid, $dhID;
		$lid = $dhID;
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