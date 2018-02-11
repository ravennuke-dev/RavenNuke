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

class seoReviews extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'Reviews';
		$this->sql_col_id            = 'id';
		$this->sql_col_title         = 'title';
		$this->sql_col_desc          = 'text';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 'date';
		$this->sql_col_catid         = '';
		$this->sql_col_author        = 'reviewer';
		$this->sql_table_with_prefix = $prefix.'_reviews';
		$this->sql_where_cols        = array
                                   (
                                      'title', 
                                      'text'
                                   );
    // Pending reviews are stored in the _reviews_add table - all reviews in the _reviews table are active
    $this->activeWhere           = '';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'id DESC',
                                      'popular' => 'hits DESC'
                                   );
		$this->levelArray            = array
                                   (
                                   );
		$this->levelSQLArray         = array(
                                   );
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=Reviews&rop=showcontent&id='.$id;
  }
}
?>