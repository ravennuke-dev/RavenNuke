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

class seoContent extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'Content';
		$this->sql_col_id            = 'pid';
		$this->sql_col_title         = 'title';
		$this->sql_col_desc          = 'page_header';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 'date';
		$this->sql_col_catid         = 'cid';
		$this->sql_col_author        = '';
		$this->sql_table_with_prefix = $prefix.'_pages';
		$this->sql_where_cols        = array
                                   (
                                      'title', 
                                      'page_header', 
                                      'text', 
                                      'page_footer', 
                                      'signature'
                                   );
    // Pending content is stored in the same table
    $this->activeWhere           = 'active = 1';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'pid DESC',
                                      'popular' => 'counter DESC'
                                   );
		$this->levelArray            = array
                                   (
                                      'category' => 'category'
                                   );
		$this->levelSQLArray         = array(
                                      'category' => 'cid'
                                   );
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=Content&pa=showpage&pid='.$id;		
  }
}
?>