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
if (stristr(htmlentities($_SERVER['PHP_SELF']) , 'nukeSEOdh.php')) {
	Header('Location: index.php');
	die();
}
global $dhMETA, $dh;
seoGetLang('nukeNAV');
/*
 * Generate META tags for this module except for modal popups, otherwise use defaults
 */ 
$dhMETA = seoGetMETAtags($name, 'META');
// Mantis 0001629: remove ending whitespace in title (and possibly other tags)
if (isset($dhMETA['title'][1])) $dhMETA['title'][1] = trim($dhMETA['title'][1]);
// This will allow everything to function as it has been which is acceptable and still allows for future enhancements
if (file_exists('includes/mimetype.php')) include('includes/mimetype.php');
elseif (file_exists('../includes/mimetype.php')) include('../includes/mimetype.php');
else {
	header('Content-Type: ' . _MIME . ';charset=' . _CHARSET);
	header('Vary: Accept');
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="en">', "\n";
	echo '<head>', "\n";
	if(!isset($dhMETA)) $dhMETA = array('title' => array(1 => ''));
	echo '<title>'.$dhMETA['title'][1].'</title>';
}
$metastring  = '';
$skiptags = array('title', 'GENERATOR', 'Content-Type');
//$metastring .= '<meta http-equiv="Content-Type" content="text/html; charset='._CHARSET.'" />';
foreach ($dhMETA as $tag => $metatag) {
	if (!in_array($tag, $skiptags))
	// Mantis 0001629: remove ending whitespace in title (and possibly other tags)
	$metastring .= '<meta '.$metatag[0].'="'.$tag.'" content="'.trim($metatag[1]).'" />'."\n";
}
$metastring .= '<meta name="GENERATOR" content="RavenNuke(tm) Copyright (c) 2002-2013 by Gaylen Fraley. This is free software, and you may redistribute it under the GPL (http://www.gnu.org/licenses/gpl-2.0.txt). RavenNuke(tm) is supported by the RavenNuke(tm) Team at http://ravenphpscripts.com." />'."\n";

echo $metastring;
?>