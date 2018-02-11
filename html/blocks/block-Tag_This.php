<?php
###############################################################################
# nukeSEO Social Bookmarking Copyright (c) 2006 Kevin Guske  http://nukeSEO.com
###############################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
###############################################################################
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}
global $prefix, $db, $name, $pagetitle, $nukeurl;
include_once 'includes/nukeSEO_SB.php';
$content = '<div class="text-center centered"><br />';

$_SERVER['FULL_URL'] = 'http';
$_SERVER['FULL_URL'] .=  '://';
if($_SERVER['SERVER_PORT']!='80') 
  $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME'];
else
  $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
if($_SERVER['QUERY_STRING']>' ')
{
  $_SERVER['FULL_URL'] .=  '?'.$_SERVER['QUERY_STRING'];
}

$blogurl = $_SERVER['FULL_URL'];
$blogtitle = $pagetitle;
$content .= getBookmarkHTML($blogurl, $blogtitle, "&nbsp;","small");
$content .= '</div>';

?>
