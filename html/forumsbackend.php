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

if (!defined('INCLUDE_PATH')) define('INCLUDE_PATH', './');
require_once 'config.php';
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
/*
 * IF wrapper added by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
 */
if (isset($tnsl_bUseShortLinks) && $tnsl_bUseShortLinks) {
	header('Location: http://'.$host.$uri.'/feeds-2-rss20.xml');
} else {
	header('Location: http://'.$host.$uri.'/modules.php?name=Feeds&fid=2&type=RSS20');
}
die();

?>