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

class seoNews extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'News';
		$this->sql_col_id            = 'sid';
		$this->sql_col_title         = 'title';
		$this->sql_col_desc          = 'hometext';
		$this->sql_col_desc2         = 'bodytext';
		$this->sql_col_time          = 'time';
		$this->sql_col_catid         = 'catid';
		$this->sql_col_author        = 'aid';
		$this->sql_table_with_prefix = $prefix.'_stories';
		$this->sql_where_cols        = array
                                   (
                                      'title', 
                                      'hometext', 
                                      'bodytext'
                                   );
    // Pending stories are stored in the nuke_queue table - all news in the stories table is active
    $this->activeWhere           = '';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular',
                                      'rated' => 'rated'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'sid DESC',
                                      'popular' => 'counter DESC',
                                      'rated' => 'score DESC'
                                   );
		$this->levelArray            = array
                                   (
                                      'topic' => 'topic',	
                                      'category' => 'category'
                                   );
		$this->levelSQLArray         = array(
                                      'topic' => 'topic',
                                      'category' => 'catid',
                                   );
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=News&file=article&sid='.$id;
  }
}
?>