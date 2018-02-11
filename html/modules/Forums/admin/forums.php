<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Link to the phpBB2 forum admin menu                                  */
/*                                                                      */
/* Copyright (c) 2002 by Tom Nitzschner (tom@toms-home.com)             */
/* http://bbtonuke.sourceforge.net                                      */
/* http://www.toms-home.com                                             */
/*									*/
/*   As always, make a backup before messing with anything. All code    */
/*   release by me is considered sample code only. It may be fully      */
/*   functual, but you use it at your own risk, if you break it,        */
/*   you get to fix it too. No waranty is given or implied.             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/* Forum admin files for PHP-Nuke 7.5 by chatserv                       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

global $db, $prefix;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {
	switch($op) {
		case 'forums':
			Header('Location: modules/' . $module_name . '/admin/index.php');
			break;
	}
} else {
    echo 'Access Denied';
}

?>