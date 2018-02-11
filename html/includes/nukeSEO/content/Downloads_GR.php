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

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'Downloads_GR.php')) {
    Header('Location: ../../../index.php');
    die();
}

class seoDownloads_GR extends seocontentclass
{
	function __construct()
  {
		global $prefix;
		$this->name                  = 'Downloads';
		$this->sql_col_id            = 'lid';
		$this->sql_col_title         = 'title';
		$this->sql_col_desc          = 'description';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 'date';
		$this->sql_col_catid         = 'cid';
		$this->sql_col_author        = 'name';
		$this->sql_table_with_prefix = $prefix.'_nsngd_downloads';
		$this->sql_where_cols        = array
                                   (
                                      'title',
                                      'description'
                                   );
    // Pending downloads are stored in the _nsngd_new table - all downloads in the _nsngd_downloads table are active
    $this->activeWhere           = '';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'lid DESC',
                                      'popular' => 'hits DESC'
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
		return getNukeURL().'modules.php?name=Downloads&op=getit&lid='.$id;
  }
}

