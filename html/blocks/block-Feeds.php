<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright (c) 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
}
$block_module = 'Feeds';
global $module_file, $fid, $type, $name;
if(!isset($module_file)) $module_file='modules';
if (empty($fid)) $fid = 0;
if (empty($type)) $type = '';
if (!defined('nf_CONVERTENCODING')) define('nf_CONVERTENCODING',true);
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') {
	$ListClass = 'ul-box-center';
	addJSToBody('includes/jquery/haslayout.js', 'file');
	} else {
	$ListClass = 'ul-box';
}
require_once('includes/nukeSEO/nukeFEED.php');
seoGetLang($block_module);
$feeds = getFeeds();
$content = '';
$n = 1;
	if($feeds)
	{
	  $lastcontentname = '';
	  $content .= '<div class="' . $ListClass . ' block-feeds"><ul class="rn-list">';
    foreach ($feeds as $blockFid => $feed)
    {
      if ( $fid>0 and $name == $block_module and $type == 'HTML' and nf_CONVERTENCODING and function_exists('mb_convert_encoding') )
      {
        $feed['title'] = mb_convert_encoding($feed['title'], 'UTF-8');
        $feed['name'] = mb_convert_encoding($feed['name'], 'UTF-8');
        $feed['desc'] = mb_convert_encoding($feed['desc'], 'UTF-8');
      }
      $title        = $feed['title'];
      $contentType  = $feed['content'];
      $contentname  = $feed['name'];
      $order        = $feed['order'];
      $howmany      = $feed['howmany'];
      $level        = $feed['level'];
      $lid          = $feed['lid'];
      $desc         = $feed['desc'];
      $active       = $feed['active'];
      $fBAddress    = $feed['feedburner_address'];
#      $securitycode = $feed['securitycode'];
#      $cachetime    = $feed['cachetime'];
      
      if ($contentname != $lastcontentname)
      {
        if ($lastcontentname != '') $content .= '</ul></li>';
        $lastcontentname = $contentname;
		if ($n > 1 AND $n % 2){$column = ' li-odd';} else if ($n > 1) {$column = ' li-even';} else {$column = ' li-first';}
        $content .= '<li class="rn-list' . $column . '"><span class="thick">' . $contentname . '</span><ul class="rn-ul">';
		++$n;
      }
			if ($title==null || $title=='') $title='&nbsp;';
      $content .= '<li><a href="' . $module_file . '.php?name=' . $block_module . '&amp;fid=' . $blockFid . '&amp;type=HTML" title="' . _FEED_PREVIEW . '">' . $title . '</a></li>';
    }
	  $content .= '</ul></li></ul></div>';
	  // make sure content does not float outside the block  
	  $content .= '<div class="block-spacer">&nbsp;</div>';
	}
?>