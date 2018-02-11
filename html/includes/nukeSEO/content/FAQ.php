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

class seoFAQ extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'FAQ';
		$this->sql_col_id            = 'id';
		$this->sql_col_title         = 'question';
		$this->sql_col_desc          = 'answer';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = '';
		$this->sql_col_catid         = 'id_cat';
		$this->sql_col_author        = '';
		$this->sql_table_with_prefix = $prefix.'_faqanswer';
		$this->sql_where_cols        = array
                                   (
                                      'question', 
                                      'answer'
                                   );
    // All FAQs are active
    $this->activeWhere           = '';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'id DESC'
                                   );
		$this->levelArray            = array
                                   (
                                      'category' => 'category'
                                   );
		$this->levelSQLArray         = array(
                                      'category' => 'id_cat'
                                   );
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=FAQ&file=index&myfaq=yes&id_cat='.$catid.'#'.$id;
  }
}
?>