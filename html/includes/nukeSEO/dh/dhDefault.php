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
class dhDefault extends dhclass {
	function __construct() {
#		global $prefix;
#		$this->content_id        = 'fid';
#		$this->content_table     = $prefix.'_seo_feed';
#		$this->contentTitleArray = array('title');
#		$this->contentDescArray  = array('desc');
#		$this->contentKeysArray  = array('title','desc');
    // If pending content is stored in the same table, inactive content, private content, etc.
#    $this->activeWhere       = 'active = 1';
  }
  // Override default getHEAD function 
/*  function getHEAD() {
			$meta['title'][1] = $name . ' - '.$sitename . ' - ' . $slogan;
			$meta['Content-Script-Type'] = array('http-equiv','text/javascript',0);
			$meta['Content-Style-Type'] = array('http-equiv','text/css',0);
			$meta['Expires'] = array('http-equiv','0',0);
			$meta['RESOURCE-TYPE'] = array('name','DOCUMENT',0);
			$meta['DISTRIBUTION'] = array('name','GLOBAL',0);
			$meta['AUTHOR'] = array('name',$sitename,0);
			$meta['COPYRIGHT'] = array('name','Copyright (c) by '.$sitename,0);
			$meta['DESCRIPTION'] = array('name',$slogan,0);
			$meta['KEYWORDS'] = array('name','CMS, cms, Best CMS, best cms, Raven, RavenNuke, Raven Nuke, raven, ravennuke, raven nuke, scripts, PHP, php, MySQL, mysql, SQL, sql, News, news, Technology, technology, Headlines, headlines, Nuke, nuke, PHP-Nuke, phpnuke, php-nuke, Linux, linux, Windows, windows, Software, software, Download, download, Downloads, downloads, Free, FREE, free, Community, community, Forum, forum, Forums, forums, Bulletin, bulletin, Board, board, Boards, boards, Survey, survey, Comment, comment, Comments, comments, Portal, portal, ODP, odp, Open, open, Open Source, OpenSource, Opensource, opensource, open source, Free Software, FreeSoftware, Freesoftware, free software, GNU, gnu, GPL, gpl, License, license, Unix, UNIX, *nix, unix, Database, DataBase, Blogs, blogs, Blog, blog, database, Programming, programming, Web Site, web site, Weblog, WebLog, weblog, ',0);
			$meta['REVISIT-AFTER'] = array('name','1 DAYS',0);
			$meta['RATING'] = array('name','GENERAL',0);
  } */
}
?>