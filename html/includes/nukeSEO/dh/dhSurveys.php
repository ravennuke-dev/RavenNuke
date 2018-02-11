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
class dhSurveys extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'pollID';
		$this->content_table     = $prefix.'_poll_desc';
		$this->contentTitleArray = array('pollTitle');
		$this->contentDescArray  = array('pollTitle');
		$this->contentKeysArray  = array('pollTitle');
		// If pending content is stored in the same table, inactive content, private content, etc.
		$this->activeWhere       = '';
	}
	function getContentID() {
		global $pollID;
		return $pollID; 
	}
	function setContentID() {
		global $pollID, $dhID;
		$pollID = $dhID;
	}
}
?>