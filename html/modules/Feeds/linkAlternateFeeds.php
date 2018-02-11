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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}

global $db, $prefix, $name, $type, $fid;
include_once('includes/nukeSEO/nukeSEOfunctions.php');
// This function assumes that the module is named Feeds and uses the RSS 2.0 format
$feedModule = 'Feeds';
if (empty($fid)) $fid = 0;
if (defined('MODULE_FILE') and $name=='Feeds' and intval($fid) > 0 and $type=='HTML')
  echo '<link rel="StyleSheet" href="modules/'.$feedModule.'/nukeFEEDhtml.css" type="text/css" />';
if (defined('MODULE_FILE') and $name=='Feeds')
  echo '<link rel="StyleSheet" href="includes/switchicon.css" type="text/css" />';
if (!defined('nf_CONVERTENCODING')) define('nf_CONVERTENCODING',true);

$seo_config = seoGetConfigs('Feeds');
$sql='SELECT * FROM '.$prefix.'_seo_feed WHERE (fid>0 and active = 1) ORDER BY name, title';
$result = $db->sql_query($sql);
if($result)
{
  while($feed = $db->sql_fetchrow($result)) 
  {
    # On Preview page, convert title
    if ( function_exists('mb_convert_encoding') and $fid>0 and nf_CONVERTENCODING and $type=='HTML' )
    {
      $feed['title'] = mb_convert_encoding($feed['title'], 'UTF-8');
    }
    $linkfid      = $feed['fid'];
    $title        = $feed['title'];
    $fBAddress    = $feed['feedburner_address'];
    $feedFormat = '&amp;type=RSS20';
    $sURL = getNukeURL().'modules.php?name='.$feedModule.'&amp;fid='.$linkfid;
    if ($seo_config['use_fb'] and !empty($fBAddress) and !empty($seo_config['feedburner_url']) )
    {
      $sURL = $seo_config['feedburner_url'].'/'.$fBAddress;
      $feedFormat = '';
    }
  
    if($title==null || $title=='') $title='&nbsp;';
    echo '<link rel="alternate" type="application/rss+xml" title="'.$title.'" href="'.$sURL.$feedFormat.'" />'."\n";
  }
}
?>
