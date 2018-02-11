<?php
/************************************************************************/
/* nukeSEO Dynamic HEAD
/* http://www.nukeSEO.com
/* Copyright (c) 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}
global $dhMETA, $dhID, $dhCat, $dhSubCat, $dh, $admin, $name;
seoGetLang('nukeNAV');

$content = '';
$content .= '<fieldset><legend>title</legend>' . $dhMETA['title'][1] . '</fieldset><br />';
$content .= '<fieldset><legend>DESCRIPTION</legend>' . $dhMETA['DESCRIPTION'][1] . '</fieldset><br />';
$content .= '<fieldset><legend>KEYWORDS</legend>' . $dhMETA['KEYWORDS'][1] . '</fieldset>';
// Don't override META tags when on an admin page
if(defined('MODULE_FILE') and is_admin($admin)) {
	$parms = '';
	$dhID = $dh->getContentID();
	if ($dhID > 0) $parms .= '&amp;dhID=' . $dhID;
	$dhCat = $dh->getCatID();
	if ($dhCat > 0) $parms .= '&amp;dhCat=' . $dhCat;
	$dhSubCat = $dh->getSubCatID();
	if ($dhSubCat > 0) $parms .= '&amp;dhSubCat=' . $dhSubCat;
	if (defined('HOME_FILE') and HOME_FILE) $parms .= '&amp;index=y';
	$content .= '<br />
<a href="modules.php?name=nukeNAV&amp;op=SEO&amp;dhName=' . $name . $parms . '" class="colorboxSEO" title="'. _OVERRIDE_TAGS .'">'. _OVERRIDE_TAGS . '</a>
';
}

?>