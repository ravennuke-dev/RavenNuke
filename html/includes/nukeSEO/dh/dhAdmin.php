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

class dhAdmin extends dhclass {
	function __construct() {
	}
	function getModuleTitlePrefix() {
		global $sitename;
		$mtp = 'Administration';
		if (defined('_ADMINISTRATION')) $mtp = _ADMINISTRATION;
		if (!empty($sitename)) $mtp .= ' - '.$sitename;
		return $mtp; 
	}
}
?>
