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

class seoEncyclopedia extends seocontentclass 
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'Encyclopedia';
		$this->sql_col_id            = 'tid';
		$this->sql_col_title         = 't.title';
		$this->sql_col_desc          = 't.text';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = '';
		$this->sql_col_author        = '';
		$this->sql_table_with_prefix = $prefix.'_encyclopedia_text t, '.$prefix.'_encyclopedia e';
		$this->sql_where_cols        = array
                                   (
                                      't.title', 
                                      't.text'
                                   );
    // All entries are active, but an encyclopedia may not be
    $this->activeWhere           = 't.eid = e.eid and e.active = 1';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 't.eid DESC',
                                      'popular' => 't.counter DESC'
                                   );
		$this->levelArray            = array
                                   (
                                      'encyclopedia' => 'encyclopedia'
                                   );
		$this->levelSQLArray         = array(
                                      'encyclopedia' => 't.eid'
                                   );
  }

  function getItemFields()
  {
    // Retrieve item fields (sort id?, date, content id, title, hometext, bodytext, author, module)
    $itemFields = '';
    // content ID = cid
    $itemFields .= '`'.$this->sql_col_id.'` AS `cid`, ';
    // title
    $itemFields .= ''.$this->sql_col_title.' AS `title`, ';
    // hometext
    $itemFields .= ''.$this->sql_col_desc.' AS `hometext` ';
    // bodytext
    if ($this->sql_col_desc2 > '') $itemFields .= ', `'.$this->sql_col_desc2.'` AS `bodytext` ';
    // author
    if ($this->sql_col_author > '') $itemFields .= ', `'.$this->sql_col_author.'` AS `author` ';
    // time
    if ($this->sql_col_time > '') $itemFields .= ', `'.$this->sql_col_time.'` AS `time`';
    return $itemFields;
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=Encyclopedia&op=content&tid='.$id;		
  }
}
?>