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
class dhReviews extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'id';
		$this->content_table     = $prefix.'_reviews';
		$this->contentTitleArray = array('title');
		$this->contentDescArray  = array('text');
		$this->contentKeysArray  = array('title','text');
		// If pending content is stored in the same table, inactive content, private content, etc.
		$this->activeWhere       = '';
	}
	function getContentID() {
		global $id;
		return $id; 
	}
	function setContentID() {
		global $id, $dhID;
		$id = $dhID;
	}
}
?>
