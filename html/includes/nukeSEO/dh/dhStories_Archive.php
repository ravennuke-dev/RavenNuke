<?php
/************************************************************************
 * nukeSEO DHT (Dynamic HEAD Tags)
 * http://www.nukeSEO.com
 * Copyright 2009 by Kevin Guske
 ************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

class dhStories_Archive extends dhclass {
	function __construct() {
	}
	function getModuleTitlePrefix() {
		global $sa, $month_l, $year;
		$mtp = '';
		if ($sa == 'show_month') $mtp = $month_l . ', ' . $year;
		return $mtp; 
	}
}
?>
