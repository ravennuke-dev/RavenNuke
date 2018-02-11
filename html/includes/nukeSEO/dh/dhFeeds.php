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
class dhFeeds extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'fid';
		$this->content_table     = $prefix.'_seo_feed';
		$this->contentTitleArray = array('title');
		$this->contentDescArray  = array('desc');
		$this->contentKeysArray  = array('title','desc');
		$this->dh_sContentSuffix = '%module% - %sitename%';
    // If pending content is stored in the same table, inactive content, private content, etc.
    $this->activeWhere       = 'active = 1';
  }
  function getContentID() {
    global $fid;
    return $fid; 
  }
  function setContentID() {
		global $fid, $dhID;
		$fid = $dhID;
	}
}
?>
