<?php
/************************************************************************
 * nukeSEO DHT (Dynamic HEAD Tags)
 * http://www.nukeSEO.com
 * Copyright 2009 by Kevin Guske
 ************************************************************************/
/* 
 * Configurable options and some logic copied from:
 * SN Dynamic Titles Addon 
 * Copyright (c) 2003 by Greg Schoper, http://nuke.schoper.net
 * Updated for better SEO results using storebuilders suggestions by
 * sixonetonoffun http://www.netflake.com
 *
 * Additional code changes for integration with RavenNuke, code
 * clean-up, security and speed improvements, etc. by Montego and
 * Raven http://www.ravenphpscripts.com  http://www.ravenwebhosting.com
 * http://montegoscripts.com
 */
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

class dhclass  {
/*
 * Configurable options:
 */
	var $dt_sDelim = ' - ';				// You may change this to whatever you wish to use
	// If a title is generated, the suffix will be preceeded by $dt_sDelim
	var $dh_sModSuffix     = '%module% - %slogan% - %sitename%';
	var $dh_sCatSuffix     = '%sitename%';
	var $dh_sSubCatSuffix  = '%sitename%';
	var $dh_sContentSuffix = '%sitename%';
	var $dh_bLinkCatSubcat = true; // Subcategory is linked to Category, if false subcategory and category are unrelated
	var $dt_iTextSize = 90;				// This will restrict the total size of the Page Title (yes, it will chop off words)
	var $dt_bUseCustNm = true;		// true = will use custom module name - default; false = use regular module name
	var $dt_bUseBBCensor = true;	// true = will use the phpBB word censor pairs for the forum Page Titles

/*
 * Variables:
 */
	var $content_id;
	var $content_table;
	var $contentTitleArray;
	var $contentDescArray;
	var $contentKeysArray;
	var $cat_id;
	var $cat_table;
	var $cat_table_id;
	var $catTitleArray;
	var $catDescArray;
	var $catKeysArray;
	var $subcat_id;
	var $subcat_table;
	var $subcat_table_id;
	var $subcatTitleArray;
	var $subcatDescArray;
	var $subcatKeysArray;
	var $activeWhere;
	var $dt_mod_name;
	var $dt_mod_title;
	
/* 
 * These functions ARE often overriden in the content-specific class
 */
	function getContentID() { return 0; }
	function setContentID() {}
	function getCatID() { return 0; }
	function setCatID() {}
	function getSubCatID() { return 0; }
	function setSubCatID() {}
	function getModuleTitlePrefix() { return ''; }
/* 
 * These functions are NOT often overriden in the content-specific class
 */
/* 
 * function getHEAD has 3 modes:
 *	META = get META tags for current content level
 *	override = override for current content level (used for override maintenance)
 *	generated = exclude override for current content level (for override maintenance) 
 */
	function getHEAD($mode='META', $name) {
		global $db, $prefix, $dhTitle, $dhDesc, $dhKeys, $seocatid, $seosubcatid, $sitename, $slogan;
		$this->setModuleName($name);
		$dhTitle = $dhDesc = $dhKeys = '';
		$contentTDK = $catTDK = array();
		$id = intval($this->getContentID());
		$catidfld = $this->cat_id;
		$seocatid = intval($this->getCatID());
		$subcatidfld = $this->subcat_id;
		$seosubcatid = intval($this->getSubCatID());
		if ($seocatid ==0 and $seosubcatid > 0 and $this->dh_bLinkCatSubcat) $seocatid = $this->getCatIDfromSubcat();
		$level = $this->getContentLevel();
/*
		Get default META tags and overrides - use only the first one found
		Level 4 - content-level override
		Level 3 - subcategory-level override
		Level 2 - category-level override
		Level 1 - module-level override
		Level 0 - index page, site-level default
*/
// First, get overrides
		$sql = 'SELECT * FROM '.$prefix.'_seo_dh d, '.$prefix.'_seo_dh_master m WHERE d.mid = m.mid and d.active = 1 and m.active = 1';
		if ($mode != 'override' or $this->getContentLevel() == 0) $sql .= ' and ((levelsort = 0)';
		if (defined('HOME_FILE') and HOME_FILE) {}
		else {
			// If ID specified and category / subcategory field, but no category / subcategory ID, get category / subcategory ID from content
			if ($id > 0 and (($catidfld > '' and $seocatid == 0) or ($subcatidfld > '' and $seosubcatid == 0))) {
				$where =  ' WHERE ';
				if ($this->activeWhere > '') $where .= $this->activeWhere . ' AND ';
				$where .= $this->content_id . '=' . $id;
				$contentTDK = $this->getTDKfromContent($this->content_table, $where, $this->contentTitleArray, $this->contentDescArray, $this->contentKeysArray,$this->cat_id, $this->subcat_id);
			}
			// Now, get overrides
			if ($mode=='META' or ($mode == 'generated' and $this->getContentLevel() > 1))
				$sql .= ' or (levelsort = 1 and title = "'.$name.'")';
			if ($mode == 'override' and $this->getContentLevel() == 1)
				$sql .= ' and (levelsort = 1 and title = "'.$name.'"';
			if ($seocatid > 0) {
				if ($mode=='META'  or ($mode == 'generated' and $this->getContentLevel() > 2))
					$sql .= ' or (levelsort = 2 and title = "'.$name.'" and id = '.$seocatid.')';
				if ($mode == 'override' and $this->getContentLevel() == 2)
					$sql .= ' and (levelsort = 2 and title = "'.$name.'" and id = '.$seocatid;
			}
			if ($seosubcatid > 0) {
				if ($mode=='META' or ($mode == 'generated' and $this->getContentLevel() > 3))
					$sql .= ' or (levelsort = 3 and title = "'.$name.'" and id = '.$seosubcatid.')';
				if ($mode == 'override' and $this->getContentLevel() == 3)
					$sql .= ' and (levelsort = 3 and title = "'.$name.'" and id = '.$seosubcatid;
			}
			if ($id > 0) {
				if ($mode=='META') 
					$sql .= ' or (levelsort = 4 and title = "'.$name.'" and id = '.$id.')';
				if ($mode == 'override' and $this->getContentLevel() == 4)
					$sql .= ' and (levelsort = 4 and title = "'.$name.'" and id = '.$id;
			}
		}
		$sql .= ') ORDER BY m.order, d.levelsort desc';
		$result = $db->sql_query($sql);
		$lastname = '';
		$meta = array();
		while($item = $db->sql_fetchrow($result)) {
			if ($item['name'] <> $lastname) $meta[$item['name']] = array($item['type'],$item['metavalue'], $item['levelsort']) ;
			$lastname = $item['name'];
		}
		if ($mode == 'override') return $meta;
		$this->setModuleTitle($name);
/*
		Content-level generated tags logic
		If title, desc and / or keys not overridden at content level 4 and content title, desc and / or keys 
			not blank, use category title, desc and / or keys
*/
		if ($id > 0 and ($meta['title'][2]< 4 or $meta['DESCRIPTION'][2] < 4 or $meta['KEYWORDS'][2] < 4)) {
			// If we didn't get $contentTDK above, get it now
			if (count($contentTDK) == 0) {
				$where =  ' WHERE ';
				if ($this->activeWhere > '') $where .= $this->activeWhere . ' AND ';
				$where .= $this->content_id . '=' . $id;
				$contentTDK = $this->getTDKfromContent($this->content_table, $where, $this->contentTitleArray, $this->contentDescArray, $this->contentKeysArray,$this->cat_id, $this->subcat_id);
			}
			if ($contentTDK['title'] > '' and $meta['title'][2]< 4) {
				$metavalue = seoHTMLtoMETA($contentTDK['title'], 'title', $this->dt_iTextSize);
				if ($metavalue > '') $meta['title'] = array('title', $metavalue, 4);
			}
			if ($contentTDK['DESCRIPTION'] > '' and $meta['DESCRIPTION'][2]< 4) {
				$metavalue = seoHTMLtoMETA($contentTDK['DESCRIPTION'], 'DESCRIPTION',1000);
				if ($metavalue > '') $meta['DESCRIPTION'] = array('name', $metavalue, 4);
			}
			if ($contentTDK['KEYWORDS'] > '' and $meta['KEYWORDS'][2]< 4) {
				$metavalue = seoHTMLtoMETA($contentTDK['KEYWORDS'], 'KEYWORDS',255);
				if ($metavalue > '') $meta['KEYWORDS'] = array('name', $metavalue, 4);
      }
		}
/*
 * SubCategory-level generated tags logic:
 * If title, desc and / or keys not overridden at subcategory level 3 (e.g. forum=3) 
 * and category title, desc and / or keys not blank, use category title, desc and / or keys
 */
		if ($seosubcatid > 0 and ($meta['title'][2]< 3 or $meta['DESCRIPTION'][2] < 3 or $meta['KEYWORDS'][2] < 3)) {
			$where = ' WHERE '.$this->subcat_id . '=' . $seosubcatid;
			if (!empty($this->subcat_table_id)) $where = ' WHERE '.$this->subcat_table_id . '=' . $seocatid;
			$subcatTDK = $this->getTDKfromContent($this->subcat_table, $where, $this->subcatTitleArray, $this->subcatDescArray, $this->subcatKeysArray,$this->cat_id, '');
			if ($subcatTDK['title'] > '' and $meta['title'][2]< 3) {
				$metavalue = seoHTMLtoMETA($subcatTDK['title'], 'title', $this->dt_iTextSize);
				if ($metavalue > '') $meta['title'] = array('title', $metavalue, 3);
			}
			if ($subcatTDK['DESCRIPTION'] > '' and $meta['DESCRIPTION'][2]< 3) {
				$metavalue = seoHTMLtoMETA($subcatTDK['DESCRIPTION'], 'DESCRIPTION', 1000);
				if ($metavalue > '') $meta['DESCRIPTION'] = array('name', $metavalue, 3);
			}
			if ($subcatTDK['KEYWORDS'] > '' and $meta['KEYWORDS'][2]< 3) {
				$metavalue = seoHTMLtoMETA($subcatTDK['KEYWORDS'], 'KEYWORDS',255);
				if ($metavalue > '') $meta['KEYWORDS'] = array('name', $metavalue, 3);
			}
		}
/*
 * Category-level generated tags logic:
 * If title, desc and / or keys not overridden at category level 2 (e.g. forum category=2) 
 * and category title, desc and / or keys not blank, use category title, desc and / or keys
 */
		if ($seocatid > 0 and ($meta['title'][2]< 2 or $meta['DESCRIPTION'][2] < 2 or $meta['KEYWORDS'][2] < 2)) {
			$where = ' WHERE '.$this->cat_id . '=' . $seocatid;
			if (!empty($this->cat_table_id)) $where = ' WHERE '.$this->cat_table_id . '=' . $seocatid;
			$catTDK = $this->getTDKfromContent($this->cat_table, $where, $this->catTitleArray, $this->catDescArray, $this->catKeysArray,'', '');
			if ($catTDK['title'] > '' and $meta['title'][2]< 2) {
				$metavalue = seoHTMLtoMETA($catTDK['title'], 'title', $this->dt_iTextSize);
				if ($metavalue > '') $meta['title'] = array('title', $metavalue, 2);
			}
			if ($catTDK['DESCRIPTION'] > '' and $meta['DESCRIPTION'][2]< 2) {
				$metavalue = seoHTMLtoMETA($catTDK['DESCRIPTION'], 'DESCRIPTION', 1000);
				if ($metavalue > '') $meta['DESCRIPTION'] = array('name', $metavalue, 2);
			}
			if ($catTDK['KEYWORDS'] > '' and $meta['KEYWORDS'][2]< 2) {
				$metavalue = seoHTMLtoMETA($catTDK['KEYWORDS'], 'KEYWORDS',255);
				if ($metavalue > '') $meta['KEYWORDS'] = array('name', $metavalue, 2);
			}
		}
/*
 * Module-level generated tags logic:
 * If title, desc and / or keys not overridden at module level 1, use module name for title
 * and category title, desc and / or keys not blank, use category title, desc and / or keys
 */
		if (defined('HOME_FILE') and HOME_FILE) {}
		else {
			if ($meta['title'][2] < 1) {
				$meta['title'] = array('title', '', 1);
			}
			if (empty($meta['title'][1])) $meta['title'][1] = $this->getModuleTitlePrefix();
			if (!defined('ADMIN_FILE'))  {
				$suffix = '';
				switch ($meta['title'][2]) {
				case 4:
					$suffix = $this->dh_sContentSuffix;
					break;
				case 3:
					$suffix = $this->dh_sSubCatSuffix;
					break;
				case 2:
					$suffix = $this->dh_sCatSuffix;
					break;
				case 1:
					$suffix = $this->dh_sModSuffix;
					break;
				}
				if (!empty($meta['title'][1]) and !empty($suffix)) $meta['title'][1] .= $this->dt_sDelim;
				$meta['title'][1] .= $suffix;
			}
		}
		if (count($meta) > 0 and $mode == 'META') 
			foreach ($meta as $key => $metaTag) 
				$meta[$key][1] = $this->replaceVariables($key, $metaTag[1]);
		return $meta;
	}

/*
 * Get current content level
 *	Level 4 - content-level override
 *	Level 3 - subcategory-level override
 *	Level 2 - category-level override
 *	Level 1 - module-level override
 *	Level 0 - index page, site-level default
 */ 
	function getContentLevel() {
		if (defined('HOME_FILE') and HOME_FILE) return 0;
		if ($this->getContentID() > 0) return 4;
		if ($this->getSubCatID() > 0) return 3;
		if ($this->getCatID() > 0) return 2;
		return 1;
	}

/*
 *	Set Module Title (custom or name)
 */ 
	function setModuleTitle($name) {
		global $db, $prefix;
		if ($this->dt_bUseCustNm) {
			$result = $db->sql_query('SELECT custom_title FROM `'.$prefix.'_modules` WHERE `title`=\''.$name.'\'');
			$row = $db->sql_fetchrow($result);
			if (isset($row['template_name'])) {
				$dt_mod_title = $row['custom_title'];
			} else {
				$dt_mod_title = '';
			}
		} else {
			$dt_mod_title = str_replace('_', ' ', $name);
		}
		$this->dt_mod_title = $dt_mod_title;
	}

/*
 *	Set Module Name
 */ 
	function setModuleName($name) {
		$this->dt_mod_name = $name;
	}

/*
 *	Get Module Name
 */ 
	function getModuleName() {
		return $this->dt_mod_name;
	}

	// Replace variables in string (e.g. META tag) with site variables
	function replaceVariables($tag, $value) {
		global $sitename, $slogan;
		$validTags = array('title', 'DESCRIPTION', 'AUTHOR', 'COPYRIGHT');
		$variables = array('%sitename%', '%slogan%', '%module%', '%year%');
		$replace   = array($sitename, $slogan, $this->dt_mod_title, date('Y'));
		if (!empty($value) and in_array($tag, $validTags)) $value = str_replace($variables, $replace, $value);
		return $value;
	}
	// Get category ID from content
	function getCatIDfromSubcat() {
		global $db, $prefix;
		$catid = 0;
		if ($this->cat_id > '') {
			$sql =  'SELECT * FROM '. $this->subcat_table . ' WHERE ' . $this->subcat_id . ' = \'' . $this->getSubCatID() . '\' LIMIT 1';
			$result = $db->sql_query($sql);
			while($subcat = $db->sql_fetchrow($result)) {
				$catid = $subcat[$this->cat_id];
			}
		}
		return $catid;
	}
	// Auto generate Title, Description, Keywords (TDK) from content
	function getTDKfromContent($table, $where, $titleFields, $descFields, $keysFields, $cat_id, $subcat_id) {
		global $db, $seocatid, $seosubcatid;
		$TDK = array();
		$TDK['title'] = $TDK['DESCRIPTION'] = $TDK['KEYWORDS'] = '';
		$sql =  'SELECT * FROM '. $table . $where . ' LIMIT 1';
		$result = $db->sql_query($sql);
		while($item = $db->sql_fetchrow($result)) {
			foreach ($titleFields as $titleField) { $TDK['title'] .= $item[$titleField].' ';}
			foreach ($descFields as $descField) { $TDK['DESCRIPTION'] .= $item[$descField].' ';}
			foreach ($keysFields as $keysField) { $TDK['KEYWORDS'] .= $item[$keysField].' ';}
			// Need to determine link between content category, subcategory and category, subcategory key
			if ($subcat_id > '' and isset($item[$subcat_id])) $seosubcatid = $item[$subcat_id];
			if ($cat_id > '' and isset($item[$cat_id])) $seocatid = $item[$cat_id];
		}
		if ($seocatid ==0 and $seosubcatid > 0 and $this->dh_bLinkCatSubcat) $seocatid = $this->getCatIDfromSubcat();
		return $TDK;
	}
}

function seoGetAutoKeys($content) {
	require_once('includes/class.autokeyword.php');
	$params['content'] = $content;            //page content
	$params['min_word_length'] = 5;           //minimum length of single words
	$params['min_word_occur'] = 2;            //minimum occur of single words
	$params['min_2words_length'] = 3;         //minimum length of words for 2 word phrases
	$params['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases
	$params['min_2words_phrase_occur'] = 2;   //minimum occur of 2 words phrase
	$params['min_3words_length'] = 3;         //minimum length of words for 3 word phrases
	$params['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases
	$params['min_3words_phrase_occur'] = 2;   //minimum occur of 3 words phrase
	$encoding = 'UTF-8';
	if (defined('nf_CONVERTENCODING') and nf_CONVERTENCODING) $encoding = 'iso-8859-1';
	$keyword = new autokeyword($params, $encoding);
	// Get language-specific keywords
	if (defined('_DH_COMMON')) $keyword->common = explode(',', str_replace(' ', '', _DH_COMMON));
	return $keyword->get_keywords();
}

// Strip html and truncate to create a META value.
function seoHTMLtoMETA($str, $type = 'KEYWORDS', $length = 70) {
	require_once 'includes/seo_fns.php';
	$str = preg_replace('/(\[(\S+)\]|&(?![a-zA-Z]{2,6};))/sU', '', $str); // Remove BBCode and chopped off entities
	$str = check_html($str, 'nohtml'); // Remove HTML tags
	$str = preg_replace('/(\s+)/', ' ', $str); // Remove all internal whitepace, replace with single space
	$entities = array('(tm)','&quot;', '&copy;', '&gt;', '&lt;', 
		'&nbsp;', '&trade;', '&reg;', ';', 
		chr(10), chr(13), chr(9));
	$str = html_entity_decode(seo_simple_strip_tags($str), ENT_COMPAT, _CHARSET);
	if ($type == 'DESCRIPTION') $str = str_replace($entities, '', $str);
	$str = htmlspecialchars($str, ENT_COMPAT, _CHARSET);
	// Remove stop words from keyword content, then convert to most popular keywords
	if ($type == 'KEYWORDS' and $str > '') $str = seoGetAutoKeys($str);
	$metavalue = truncate_string($str, $length);
	if (strlen($str) > strlen($metavalue)) $metavalue .= "...";
	return $metavalue;
}
?>