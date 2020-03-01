<?php
/************************************************************************/
/* nukeSEO
/* http://www.nukeSEO.com
/* Copyright (c) 2009 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
class dhGCalendar extends dhclass {
	function __construct() {
		global $prefix;
		$this->dh_sModSuffix   = '%sitename%';
		$this->content_id        = 'id';
		$this->content_table     = $prefix.'_gcal_event';
		$this->contentTitleArray = array('title');
		$this->contentDescArray  = array('location', 'details');
		$this->contentKeysArray  = array('title','location','details');
		// If pending content is stored in the same table, inactive content, private content, etc.
		$this->activeWhere       = 'approved = 1';
	}
	function getContentID() {
		global $e;
		return $e;
	}
	function setContentID() {
		global $e, $dhID;
		$e = $dhID;
	}
	function getModuleTitlePrefix() {
		global 	$y, $m, $d, $file, $weekSelect;
		list($curYear, $curMonth, $curDay) = explode(',', date('Y,n,j'));
		if (isset($weekSelect)) list($y, $m, $d) = explode('-', $weekSelect);
		$m = intval($m);
		$d = intval($d);
		$y = intval($y);
		require_once 'modules/' . $this->getModuleName() . '/language.php';
		gcalGetLang($this->getModuleName());
		require_once 'modules/' . $this->getModuleName() . '/gcal.inc.php';
		require_once 'modules/' . $this->getModuleName() . '/common.inc.php';
		$config = getConfig();
		$minYear = intval($config['min_year']);
		$maxYear = intval($config['max_year']);
		if ($m < 1 or $m > 12) {
			$m = $curMonth;
		}
		if ($y < $minYear or $y > $maxYear) {
			$y = $curYear;
		}
		$title = $config['title'];
		$mtp = $title;
		switch ($file) {
		case 'viewmonth':
		default:
			$mtp .= ' - '. monthName($m) . ' ' . $y;
			break;
		case 'viewweek':
			$mtp = _VIEW_WEEK_EVENTS_FOR . ' ' . formatDate(toSqlDate($y, $m, $d), $config['long_date_format']);
			break;
		case 'viewday':
			$mtp .= ' - ' . formatDate(toSqlDate($y, $m, $d), $config['long_date_format']);
			break;
		}
		return $mtp;
	}
}
?>