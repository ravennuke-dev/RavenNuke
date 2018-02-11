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
class dhFAQ extends dhclass {
	function __construct() {
		global $prefix;
		$this->content_id        = 'id';
		$this->content_table     = $prefix.'_faqanswer';
		$this->contentTitleArray = array('question');
		$this->contentDescArray  = array('question');
		$this->contentKeysArray  = array('question','answer');
		$this->cat_id            = 'id_cat';
		$this->cat_table         = $prefix.'_faqcategories';
		$this->catTitleArray     = array('categories');
		$this->catDescArray      = array('categories');
		$this->catKeysArray      = array('categories');
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
  function getCatID() { 
    global $id_cat;
    return $id_cat; 
  }
	function setCatID() { 
		global $id_cat, $dhCat;
		$id_cat = $dhCat;
	}
}
?>