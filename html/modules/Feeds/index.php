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

if(!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if (empty($fid)) $fid = 0;
if (empty($type)) $type = '';
if (empty($op)) $op = '';

$fid = intval($fid);
$type = strtoupper($type);

if(!isset($module_file)) $module_file='modules';
$module_name = basename(dirname(__FILE__));

require_once('includes/nukeSEO/nukeFEED.php');
seoGetLang($module_name);

switch($op) {
	case 'nukeFEED':
	case 'nfEditFeed':
	case 'nfSaveFeed':
	case 'nfEditFeedSave':  //not in index?
	case 'nfDeleteFeed':
	case 'nfDeleteConfirm':
	case 'nfConfigMod':
	case 'nfDisableMod':
	case 'nfEnableMod':
	case 'nfDelSubscript':
	case 'nfEditSubscript':
	case 'nfSaveSubscript':
		include("modules/$module_name/admin/index.php");
		break;
}
if ($op == 'map') $type == 'OPML';

$index = 0;
if ($fid > 0 or $op == 'map')
{
  if ($type == 'HTML')
  {
    include_once('header.php');
    title(_FEED_PREVIEW );
    OpenTable();
  }
  //Added by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
  else
  {
    if (defined('TNSL_USE_SHORTLINKS')) {
      global $tnsl_bUseShortLinks, $tnsl_bAutoTapBlocks, $tnsl_bDebugShortLinks, $tnsl_sGTFilePath;
      $_REQUEST['name'] = 'Feeds';
      $GLOBALS['tnsl_asGTFilePath'] = tnsl_fPageTapStart();
    }
  }
  //End of add by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
  output_nukeFEED($fid, $type);
}
else
{
  // BEGIN: Added in v2.40.00 - Mantis Issue 0001043
  if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
  if (defined('INDEX_FILE') AND INDEX_FILE===true) {
  // auto set right blocks for pre patch 3.1 compatibility
    $index = 1;
  }
  // END: Added in v2.40.00 - Mantis Issue 0001043
  include('header.php');
  title($sitename.' '._FEEDS.' <a href="modules.php?name=Feeds&amp;op=map&amp;type=OPML" title="'._nF_FEEDLIST.'"><img border="0" src="images/nukeFEED/opml-icon.png" alt="'._nF_FEEDLIST.'" title="'._nF_FEEDLIST.'" /></a>');
  OpenTable();
  listFeeds();
}
if ($type == 'HTML' or ($fid == 0 and $op != 'map')) { echo '<div align="right"><a href="http://nukeseo.com" title="nukeFEED(tm) (c) nukeSEO.com">&copy;</a></div>';
  CloseTable();
  if ($fid > 0 and $type == 'HTML')
  {
    # Display subscribe link?
    $seo_config = seoGetConfigs('Feeds');
    $subscriptions = getSubscriptions('aggregator');
    $feedURL = getNukeURL().$module_file.'.php?name='.$module_name.'&amp;fid='.$fid;
    $feed = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_seo_feed WHERE fid = '.$fid));
    if (!defined('nf_CONVERTENCODING')) define('nf_CONVERTENCODING',true);
    if ( function_exists('mb_convert_encoding') and nf_CONVERTENCODING )
    {
      $feed['title'] = mb_convert_encoding($feed['title'], 'UTF-8');
      $feed['desc'] = mb_convert_encoding($feed['desc'], 'UTF-8');
    }
    $boxContent = '<br />'.listSubscriptions('single', 'aggregator', $subscriptions, $feed['title'], $feed['desc'], $fid, $feed['feedburner_address'], $seo_config);
    if (is_admin($admin)) $boxContent .= '<br /><a href="'.$admin_file.'.php?op=nukeFEED">'._FEEDS_ADMIN.'</a>';
    themesidebox(_nF_SUBSCRIBE, $boxContent);
  }
  include('footer.php');
}
//Added by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
else
{
  if (defined('TNSL_USE_SHORTLINKS')) {
    tnsl_fPageTapFinish();
  }
}
//End of add by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks

?>