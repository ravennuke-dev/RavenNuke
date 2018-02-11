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

class seoWeb_Links extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'Web_Links';
		$this->sql_col_id            = 'lid';
		$this->sql_col_title         = 'title';
		$this->sql_col_desc          = 'description';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 'date';
		$this->sql_col_catid         = 'cid';
		$this->sql_col_author        = 'name';
		$this->sql_table_with_prefix = $prefix.'_links_links';
		$this->sql_where_cols        = array
                                   (
                                      'title', 
                                      'description'
                                   );
    // Pending links are stored in the _links_newlinks table - all links in the _links_links table are active
    $this->activeWhere           = '';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular',
                                      'rated' => 'rated'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'lid DESC',
                                      'popular' => 'hits DESC',
                                      'rated' => 'linkratingsummary DESC, lid DESC'
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
		return getNukeURL().'modules.php?name=Web_Links&l_op=viewlinkdetails&lid='.$id;
  }
}
?>