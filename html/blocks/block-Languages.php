<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $useflags, $currentlang, $languageslist, $multilingual;
if ($multilingual == 1) {
	if ($useflags == 1) {
		$content = '<div align="center"><span class="content">'._SELECTGUILANG.'<br /><br />';
		$langdir = dir('language');
		$menulist = '';
		while($func=$langdir->read()) {
			if(substr($func, 0, 5) == 'lang-') {
				$menulist .= $func.' ';
			}
		}
		closedir($langdir->handle);
		$menulist = explode(' ', $menulist);
		sort($menulist);
		for ($i=0; $i < sizeof($menulist); $i++) {
			if(!empty($menulist[$i])) {
				$tl = str_replace('lang-','',$menulist[$i]);
				$tl = str_replace('.php','',$tl);
				$altlang = ucfirst($tl);
				$content .= '<a href="index.php?newlang='.$tl.'"><img src="images/language/flag-'.$tl.'.png" border="0" alt="'.$altlang.'" title="'.$altlang.'" hspace="3" vspace="3" /></a> ';
			}
		}
		$content .= '</span></div>';
	} else {
		$content = '<div align="center"><span class="content">'._SELECTGUILANG.'<br /><br /></span>'
				. '<form action="index.php" method="get">'
				. lang_select_list('newlang', $currentlang, false, ' onchange="javascript:this.form.submit();"')
				. '</form></div>';
	}
} else {
	if (defined('_MULTILINGUALOFF')) {
		$content = '<div class="text-center">'._MULTILINGUALOFF.'</div>';
	} else {
		$content = '<div class="text-center">We\'re sorry but there is no language translation available. Please contact the Webmaster for further help.</div>';
	}
}
?>