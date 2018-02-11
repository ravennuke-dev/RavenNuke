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
if (stristr(htmlentities($_SERVER['PHP_SELF']), 'nukeFEED.php')) {
    Header('Location: ../../index.php');
    die();
}

include_once(INCLUDE_PATH.'includes/nukeSEO/nukeSEOfunctions.php');
define('_nf_use_fb', 'use_fb');
define('_nf_fb_url', 'feedburner_url');

function output_nukeFEED($fid, $type) 
{
  global $prefix, $db, $sitename, $name;
  @require_once('includes/feedcreator/feedcreator.class.php');

  switch ($type) {
  case 'ATOM03':
  case 'ATOM0.3':
    $type = 'ATOM0.3';
    break;
  case 'HTML':
    $type = 'HTML';
    break;
  case 'JS':
  case 'JAVASCRIPT':
    $type = 'JS';
    break;
  case 'MBOX':
    $type = 'MBOX';
    break;
  case 'OPML':
    $type = 'OPML';
    break;
  case 'PIE0.1':
    $type = 'PIE0.1';
    break;
  case 'RSS':
  case '.91':
  case '0.91':
  case 'RSS91':
  case 'RSS.91':
  case 'RSS091':
  case 'RSS0.91':
    $type = 'RSS0.91';
    break;
  case '1.0':
  case 'RSS10':
  case 'RSS1.0':
    $type = 'RSS1.0';
    break;
  case '2.0':
  case 'RSS20':
  case 'RSS2.0':
    $type = 'RSS2.0';
    break;
  case 'ATOM10':
  case 'ATOM1.0':
  default:
    $type = 'ATOM';
    break;
  }
  $rss = new UniversalFeedCreator(); 
  //optional
  $rss->descriptionTruncSize = 500;
  $rss->descriptionHtmlSyndicated = true;
  $baseURL = getNukeURL();
  $rss->link = $baseURL;
  $syndicationURL = $baseURL.'modules.php?name=' . $name;
  if ($fid > 0) {
    $syndicationURL .= '&fid=' . $fid;
  }
  if ($type <> '') {
    $syndicationURL .= '&type=' . $type;
  }
  $rss->syndicationURL = $syndicationURL;

  if ($fid >0)
  {
    $feed = $db->sql_fetchrow($db->sql_query('SELECT * FROM `'.$prefix.'_seo_feed` WHERE `active` = 1 AND `fid` = '.$fid));
    if ($feed['content']=='')
    {
#      header('HTTP/1.0 404 Not Found');
#      header('Status: 404 Not Found');
      header('Refresh: 0; url=invalidfeed'.$fid.'.html/', false, 404);
      die('Invalid feed');
    }
    ###$rss->useCached(); // use cached version if age<1 hour
    $feed['title'] = $feed['title'].' - '.html_entity_decode($sitename);
    if (!defined('nf_CONVERTENCODING')) define('nf_CONVERTENCODING',true);
    if ( function_exists('mb_convert_encoding') and nf_CONVERTENCODING )
    {
      $feed['title'] = mb_convert_encoding($feed['title'], 'UTF-8');
      $feed['desc'] = mb_convert_encoding($feed['desc'], 'UTF-8');
    }
    $rss->title = $feed['title']; 
    $rss->description = $feed['desc'];

    $contentType = $feed['content'];
    $level = $feed['level'];
    $lid = $feed['lid'];
    $order = $feed['order'];
    $howmany = $feed['howmany'];
    $fBAddress    = $feed['feedburner_address'];
    # Get class for feed type
    include_once('includes/nukeSEO/seocontent.class.php');
    $file = 'includes/nukeSEO/content/'.$contentType.'.php';
    include_once($file);
    $class = 'seo'.$contentType;
    ${$contentType} = new $class();
    if (${$contentType}->useme())
    {
      $items = ${$contentType}->getItems($level, $lid, $order, $howmany);
      foreach ($items as $cid => $item)
      {
        $cid = intval($item['cid']);
        $title = $item['title'];
        $desc = reltoabs($item['hometext'], $baseURL);
        if (empty($item['author'])) $item['author'] = '';
        $author = $item['author'];
        if (empty($item['catid'])) $item['catid'] = 0;
        $catid = intval($item['catid']);
        $feeditem = new FeedItem();
        if ( function_exists('mb_convert_encoding') )
        {
          $title = mb_convert_encoding($title, 'UTF-8');
          $desc = mb_convert_encoding($desc, 'UTF-8');
        }
        $feeditem->title = $title; 
        $feeditem->link = ${$contentType}->getLink($cid, $catid);
        $feeditem->description = $desc;
        $feeditem->descriptionHtmlSyndicated = 1;
        $feeditem->source = $baseURL; 
        $feeditem->author = $author; 
        $rss->addItem($feeditem); 
      }
    }
  }
  elseif ($fid == 0 and $type == 'OPML')
  {
    // Generate feed list or feed map
    $rss->title = $sitename; 
    $rss->description = '';
    $sql = 'SELECT * FROM '.$prefix.'_seo_feed where active=1 ORDER BY content, title ';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
      $rsid = intval($row['fid']);
      $rtitle = $row['title'];
      $rdesc = $row['desc'];
      $item = new FeedItem(); 
      $item->title = xml_entities_decode($rtitle); 
      $item->link =$baseURL.'modules.php?name=Feeds&amp;fid='.$rsid;
      $item->syndicationURL =$baseURL.'modules.php?name=Feeds&amp;fid='.$rsid;
      $item->description = xml_entities_decode($rdesc); 
      $item->source = $baseURL; 
      $rss->addItem($item); 
    }
  }

  # valid format strings are: ATOM, ATOM10, ATOM0.3, HTML, JS, MBOX, OPML, 
  #   RSS0.91, RSS1.0, RSS2.0, PIE0.1 (deprecated),
  if ($type == '') $type = 'ATOM';
  # echo $rss->saveFeed('RSS1.0', 'news/feed.xml');
  # to generate "on-the-fly"
  $rss->outputFeed($type);
  if ($type == 'HTML' and !empty($fBAddress))
  {
    # Get configuration
    $seo_config = seoGetConfigs('Feeds');
    if (intval($seo_config['use_fb']) == 1 and intval($seo_config['show_circgraph']) == 1)
      echo '<br /><a href="http://www.joostdevalk.nl/code/feedburner-graph/"><img src="http://www.joostdevalk.nl/code/feedburner-graph/?uri='.$fBAddress.'&amp;width=300&amp;timeframe=6m" alt="'._nF_FEEDCIRCDATAFOR.' '.$fBAddress.'" title="'._nF_FEEDCIRCDATAFOR.' '.$fBAddress.'" border="0" /></a>';    
  }
}

function getFeeds()
{
	global $db, $prefix;

	$sql='SELECT * FROM '.$prefix.'_seo_feed WHERE (fid>0';
	
	if(!defined('ADMIN_FILE')) $sql .= ' and active = 1';
#  if($$filter>'') $request=$request.' '.$filter;
  $sql=$sql.') ORDER BY name, title';
#	if($min==null) $min=0;
#	if($paging!=0) $request=$request.' LIMIT '.$min.','.$paging;
	$result = $db->sql_query($sql);

	$feeds = array();
  while($feed = $db->sql_fetchrow($result)) 
  {
    $fid = $feed['fid'];
    $feeds[$fid] = $feed;
  }
  return $feeds;
}

#function listFeeds($subSep, $active = 0, $paging=0, $min=0)
function listFeeds()
{
	global $db, $prefix, $module_file, $module_name, $admin_file;
  if(!isset($module_file)) $module_file='modules';
	
  # Get configuration
  $seo_config = seoGetConfigs('Feeds');
  # Get subscriptions
	$subscriptions = getSubscriptions('aggregator');
	# Get feeds
	$feeds = getFeeds();

	if($feeds)
	{
	  $lastcontentname = '';
    echo '
    <script type="text/javascript" src="includes/switchcontent.js" ></script>
    <script type="text/javascript" src="includes/switchicon.js"></script>
    <table '.((!defined('ADMIN_FILE')) ? 'width="100%" ' : '').'border="0" cellspacing="0" cellpadding="0">';
    foreach ($feeds as $fid => $feed)
    {
      $title        = $feed['title'];
      $content      = $feed['content'];
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
        if(defined('ADMIN_FILE') and $lastcontentname > '') echo '<tr><td colspan="2">&nbsp;</td></tr>'; 
        $lastcontentname = $contentname;
        echo '<tr><td colspan="2"><h3>'.$contentname.'</h3></td></tr>';
      }
			if ($title==null || $title=='') $title='&nbsp;';
      echo '<tr><td valign="top" width="500">';
			if(defined('ADMIN_FILE')) echo '<img src="images/nukeFEED/icon_status_'.(($active) ? 'green':'red').'.gif" alt="'.(($active) ? _nF_ACTIVE:_nF_INACTIVE).'" title="'.(($active) ? _nF_ACTIVE:_nF_INACTIVE).'" />&nbsp;';
      echo '<a href="'.$module_file.'.php?name='.$module_name.'&amp;fid='.$fid.'&amp;type=HTML" title="'._FEED_PREVIEW.'">'.$title.'</a>';
      if(!defined('ADMIN_FILE') and $desc > '') echo '<br /><span class="italic">'.$desc.'</span>';
      echo '</td><td valign="top" width="100" style="text-align: right;">';
      if (!defined('ADMIN_FILE')) 
      {
        listSubscriptions('list','aggregator', $subscriptions, $title, $desc, $fid, $fBAddress, $seo_config);
      }
      else
      {
        echo '
        &nbsp;<a href="'.$admin_file.'.php?op=nfEditFeed&amp;fid='.$fid.'"><img src="images/nukeFEED/edit.png" height="16" width="16" border="0" alt="'._nF_EDIT.'" title="'._nF_EDIT.'" /></a>
        &nbsp;<a class="rn_csrf" href="'.$admin_file.'.php?op=nfDeleteFeed&amp;fid='.$fid.'"><img src="images/nukeFEED/delete.png" height="16" width="16" border="0" alt="'._nF_DELETE.'" title="'._nF_DELETE.'" /></a>
        ';
      }
      echo '</td></tr>';
    }
		echo '</table>';
    echo '
<script type="text/javascript">
var feedsub=new switchicon("icongroup1", "div")
feedsub.setHeader("'._nF_SUBSCRIBE.'", "'._nF_SUBSCRIBE.'")
feedsub.collapsePrevious(true)
feedsub.setPersist(true, 7)
feedsub.init()
</script>
    ';
	}
}

function getSubscriptions($type = 'aggregator')
{
	global $db, $prefix;

	$sql='SELECT * FROM '.$prefix.'_seo_subscriptions WHERE (sid>0 and type ="'.$type.'"';
	if(!defined('ADMIN_FILE')) $sql .= ' and active = 1';
#	if($$filter>'') $request=$request.' '.$filter;
  $sql=$sql.') ORDER BY name';
#	if($min==null) $min=0;
#	if($paging!=0) $request=$request.' LIMIT '.$min.','.$paging;
	$result = $db->sql_query($sql);
	$subscriptions = array();
  while($subscription = $db->sql_fetchrow($result)) 
  {
    $sid = $subscription['sid'];
    $subscriptions[$sid] = $subscription;
  }
  return $subscriptions;
}

# List subscriptions for a feed 'list', a 'single' feed, or subscription 'admin'
function listSubscriptions($listtype = 'Feed List', $type = 'aggregator', $subscriptions, $sTitle = '{TITLE}', $sDesc = '{DESC}', $fid, $fBAddress, $seo_config = array())
{
	global $module_name, $module_file, $admin_file;

  $sURL = getNukeURL().$module_file.'.php?name='.$module_name.'&fid='.$fid;
  $typeATOM10 = '&amp;type=ATOM1.0';
  $typeRSS091 = '&amp;type=RSS0.91';
  $typeRSS20  = '&amp;type=RSS2.0';
  $typeDefault= '&type=RSS2.0';
  if (intval($seo_config['use_fb']) == 1 and !empty($fBAddress) and !empty($seo_config['feedburner_url']) )
  {
    $sURL = $seo_config['feedburner_url'].'/'.$fBAddress;
    $typeATOM10 = $typeRSS091 = $typeRSS20 = $typeDefault = '';
  }
	
  $sep1 = $sep2 = '';
  $sep3 ='&nbsp;';
	switch ($listtype) {
  case 'list':
    $sep1 = '</td></tr><tr><td colspan="2" width="600">';
    $sep2 = '</td></tr><tr><td colspan="2">&nbsp;';
    break;
  case 'single':
    $sep1 = '<br /><br />';
    $sep3 = '<br />';
    break;
  case 'admin':
    $sep3 = '<br />';
    break;
  }
  $subHTML = '';
	if($subscriptions)
	{
    if($listtype == 'list') $subHTML .= '<a><span id="feedsub'.$fid.'-title" class="iconspan" style="{float: right;margin: 3px;cursor:hand;cursor:pointer;font-weight: bold;}"><img src="images/nukeFEED/minus.gif" alt="minus" /></span></a>'.$sep1.'<div id="feedsub'.$fid.'" class="icongroup1">';
    $count = 0; $maxperline = 7;
    foreach ($subscriptions as $sid => $subscription)
    {
      $name         = $subscription['name'];
      $tagline      = $subscription['tagline'];
      $url          = $subscription['url'];
      $image        = $subscription['image'];
      $icon         = $subscription['icon'];
      $active       = $subscription['active'];
      
#			if($title==null || $title=='') $title='&nbsp;';
			if ($url > '') {
        $parms  = array('{URL}', '{TITLE}', '{NUKEURL}');
        $values = array($sURL.$typeDefault, urlencode($sTitle), getNukeURL());
#        $url = htmlentities(str_replace($parms, $values, $url));
        $url = htmlspecialchars(str_replace($parms, $values, $url));
      }
			
      if(defined('ADMIN_FILE')) $subHTML .= '<img src="images/nukeFEED/icon_status_'.(($active) ? 'green':'red').'.gif" alt="'.(($active) ? _nF_ACTIVE:_nF_INACTIVE).'" title="'.(($active) ? _nF_ACTIVE:_nF_INACTIVE).'" />&nbsp;';
      $subHTML .= '<a href="'.$url.'" title="'.$tagline.'" target="_blank">';
      if ($image > '') {
        $subHTML .= '<img src="'.$image.'" border="0" alt="'.$tagline.'" />';
      }
      else
      {
        $subHTML .= $name;
      }
      $subHTML .= '</a>';
      if ($icon > '') {
        $subHTML .= '<a href="'.$url.'" title="'.$tagline.'" target="_blank"><img src="'.$icon.'" border="0" alt="'.$tagline.'" /></a>&nbsp;';
      }
      if(defined('ADMIN_FILE')) 
      {
        $subHTML .= '&nbsp;<a href="'.$admin_file.'.php?op=nfEditSubscript&amp;sid='.$sid.'"><img src="images/nukeFEED/edit.png" height="16" width="16" border="0" alt="'._nF_EDIT_SUB.'" title="'._nF_EDIT_SUB.'" /></a>';
        $subHTML .= '&nbsp;<a class="rn_csrf" href="'.$admin_file.'.php?op=nfDelSubscript&amp;sid='.$sid.'"><img src="images/nukeFEED/delete.png" height="16" width="16" border="0" alt="'._nF_DELETE_SUB.'" title="'._nF_DELETE_SUB.'" /></a>';
      }
      $count = $count + 1; $newline = $count / $maxperline;
      if ($listtype == 'list' and $newline == round($newline,0)) $subHTML .= '<br />';
      $subHTML .= $sep3.chr(10);
    }
    if ($sep3 != '<br />') $subHTML .= '<br />';
	}
  if(defined('ADMIN_FILE')) 
  {
    echo $subHTML;
  }
  else
  {
    $sURL = htmlentities($sURL);
#    $subHTML .= '<a href="'.$sURL.'&amp;type=ATOM0.3" title="'.$sTitle.' in ATOM 0.3 format" target="_blank"><img src="images/nukeFEED/bm-atom03.png" border="0" alt="'.$title.' in ATOM 0.3 format" /></a>'.$sep3;
    $subHTML .= '<a href="'.$sURL.$typeATOM10.'" title="'.$sTitle.' in ATOM 1.0 format" target="_blank"><img src="images/nukeFEED/bm-atom10.png" border="0" alt="'.$sTitle.' in ATOM 1.0 format" /></a>'.$sep3;
    $subHTML .= '<a href="'.$sURL.$typeRSS091.'" title="'.$sTitle.' in RSS 0.91 format" target="_blank"><img src="images/nukeFEED/bm-rss091.png" border="0" alt="'.$sTitle.' in RSS 0.91 format" /></a>'.$sep3;
#    $subHTML .= '<a href="'.$sURL.'&amp;type=RSS1.0" title="'.$sTitle.' in RSS/RDF 1.0 format" target="_blank"><img src="images/nukeFEED/bm-rss10.png" border="0" alt="'.$title.' in RSS/RDF 1.0 format" /></a>'.$sep3;
    $subHTML .= '<a href="'.$sURL.$typeRSS20.'" title="'.$sTitle.' in RSS 2.0 format" target="_blank"><img src="images/nukeFEED/bm-rss20.png" border="0" alt="'.$sTitle.' in RSS 2.0 format" /></a>'.$sep3;
    $subHTML .= seoFeedCountChicklet($fBAddress, $seo_config).'<br />';
    if ($listtype == 'single') $subHTML .= '<br />
            <a href="http://feedvalidator.org/check.cgi?url='.$sURL.$typeATOM10.'"><img src="images/nukeFEED/valid-atom.png" alt="Valid Atom 1.0" title="Validate my Atom 1.0 feed" border="0" /></a><br />
            <a href="http://feedvalidator.org/check.cgi?url='.$sURL.$typeRSS20.'"><img src="images/nukeFEED/valid-rss.png" alt="Valid RSS" title="Validate my RSS feed" border="0" /></a><br />';
    if ($listtype == 'list')
    {
      $subHTML .= '</div>'.$sep2;
      echo $subHTML;
    }
    else
    {
      $subHTML .= $sep2;
      return $subHTML;
    }
  }
}

if ( !function_exists('seoCheckInstall') )
{
  function seoCheckInstall() {
    # table creation is MySQL-specific
    global $prefix, $sitename;
    define('nF_version', '1.1.0');
    # seo config
    $sid = 0; $subscription = array();
    $existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_config` LIMIT 0';
    $subscriptions[$sid] = $subscription;
    $createSQL = array();
    $createSQL[] = 'CREATE TABLE `'.$prefix.'_seo_config` (
      `config_type` varchar(150) NOT NULL,
      `config_name` varchar(150) NOT NULL,
      `config_value` text NOT NULL,
      PRIMARY KEY  (`config_type`,`config_name`)
      ) TYPE=MyISAM;';
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'use_fb', '1');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'feedburner_url', 'http://feeds.feedburner.com');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'version_check', '0');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'version_newest', '".nF_version."');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'version_number', '".nF_version."');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'version_url', 'http://nukeseo.com/modules.php?name=Downloads');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'version_notes', '');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'show_circgraph', '1');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'show_feedcount', '1');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'feedcount_body', 'A6A6A6');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_config` VALUES ('Feeds', 'feedcount_text', '000000');";

    seoCheckCreateTable($existSQL, $createSQL);
    # seo disabled modules
    $existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_disabled_modules` LIMIT 0';
    $createSQL = array();
    $createSQL[] = 'CREATE TABLE `'.$prefix.'_seo_disabled_modules` (
      `title` varchar(255) NOT NULL,
      `seo_module` varchar(255) NOT NULL,
      PRIMARY KEY  (`title`,`seo_module`)
      ) TYPE=MyISAM;';
    seoCheckCreateTable($existSQL, $createSQL);
    # Feeds
    $existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_feed` LIMIT 0';
    $createSQL = array();
    $createSQL[] = 'CREATE TABLE `'.$prefix.'_seo_feed` (
      `fid` int(6) NOT NULL auto_increment,
      `content` varchar(20) NOT NULL,
      `name` varchar(20) NOT NULL,
      `level` varchar(20) NOT NULL,
      `lid` int(6) NOT NULL,
      `title` varchar(50) NOT NULL,
      `desc` text NOT NULL,
      `order` varchar(20) NOT NULL,
      `howmany` char(3) NOT NULL,
      `active` int(1) NOT NULL,
      `desclimit` varchar(5) NOT NULL,
      `securitycode` varchar(50) NOT NULL,
      `cachetime` varchar(6) NOT NULL,
      `feedburner_address` varchar(100) NOT NULL,
      PRIMARY KEY  (`fid`),
      KEY `content` (`content`,`title`)
      ) TYPE=MyISAM;';
    $createSQL[] = "INSERT INTO `".$prefix."_seo_feed` VALUES (1, 'News', '"._nF_NEWS."', 'module', 0, '".$sitename." "._nF_NEWS."', '', 'recent', '10', 1, '', '', '', '');";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_feed` VALUES (2, 'Forums', '"._nF_FORUMS."', 'module', 0, '".$sitename." "._nF_FORUMS."', '', 'recent', '10', 1, '', '', '', '');";
    seoCheckCreateTable($existSQL, $createSQL);
    # Subscriptions
    $existSQL = 'SELECT 1 FROM `'.$prefix.'_seo_subscriptions` LIMIT 0';
    $createSQL = array();
    $createSQL[] = 'CREATE TABLE `'.$prefix.'_seo_subscriptions` (
      `sid` int(6) NOT NULL auto_increment,
      `type` varchar(255) NOT NULL,
      `name` varchar(60) NOT NULL,
      `tagline` varchar(60) NOT NULL,
      `image` varchar(255) NOT NULL,
      `icon` varchar(255) NOT NULL,
      `url` varchar(255) NOT NULL,
      `active` int(1) NOT NULL,
      PRIMARY KEY  (`sid`)
      ) TYPE=MyISAM;';
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (1, 'aggregator', '01 Google Reader', 'Add to Google', 'images/nukeFEED/subscribe/add-to-google-plus.gif', '', 'http://fusion.google.com/add?feedurl={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (2, 'aggregator', '02 My Yahoo!', 'Add to My Yahoo!', 'images/nukeFEED/subscribe/myYahoo.gif', '', 'http://add.my.yahoo.com/rss?url={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (3, 'aggregator', '03 My AOL', 'Add to My AOL', 'images/nukeFEED/subscribe/myAOL.gif', '', 'http://feeds.my.aol.com/add.jsp?url={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (4, 'aggregator', '04 My MSN', 'Add to My MSN', 'images/nukeFEED/subscribe/myMSN.gif', '', 'http://my.msn.com/addtomymsn.armx?id=rss&ut={URL}&ru={NUKEURL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (5, 'aggregator', '05 BlogLines', 'Subscribe with Bloglines', 'images/nukeFEED/subscribe/bloglines.gif', '', 'http://www.bloglines.com/sub/{URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (6, 'aggregator', '06 netvibes', 'Add to netvibes', 'images/nukeFEED/subscribe/netvibes.gif', '', 'http://www.netvibes.com/subscribe.php?url={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (7, 'aggregator', '07 NewsGator', 'Subscribe in NewsGator Online', 'images/nukeFEED/subscribe/newsgator.gif', '', 'http://www.newsgator.com/ngs/subscriber/subext.aspx?url={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (8, 'aggregator', '08 Pageflakes', 'Subscribe with PageFlakes', 'images/nukeFEED/subscribe/pageflakes.gif', '', 'http://www.pageflakes.com/subscribe.aspx?url={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (9, 'aggregator', '09 Rojo', 'Subscribe in Rojo', 'images/nukeFEED/subscribe/addtorojo.gif', '', 'http://www.rojo.com/add-subscription?resource={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (10, 'aggregator', '10 Protopage', 'Add this site to your Protopage', 'images/nukeFEED/subscribe/protopage.gif', '', 'http://www.protopage.com/add-button-site?url={URL}&label={TITLE}&type=feed', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (11, 'aggregator', '11 Newsburst', 'Add to Newsburst', 'images/nukeFEED/subscribe/newsburst.gif', '', 'http://www.newsburst.com/Source/?add={URL}', 1);";
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (12, 'aggregator', '12 NewsAlloy', 'Subscribe in NewsAlloy', 'images/nukeFEED/subscribe/newsalloy.gif', '', 'http://www.newsalloy.com/?rss={URL}', 1);";    
    $createSQL[] = "INSERT INTO `".$prefix."_seo_subscriptions` VALUES (13, 'aggregator', '13 Blogarithm', 'Add to Blogarithm', 'images/nukeFEED/subscribe/blogarithm.gif', '', 'http://www.blogarithm.com/subrequest.php?BlogURL={URL}', 1);";
    seoCheckCreateTable($existSQL, $createSQL);
    $getValueSQL = 'SELECT config_value as value FROM `'.$prefix.'_seo_config` where config_type=\'Feeds\' and config_name = \'version_number\'';
    $updateSQL = array();
    $updateSQL[] = "UPDATE `".$prefix."_seo_config` SET config_value = '".nF_version."' where config_type='Feeds' and config_name = 'version_number';";
    seoCheckUpdateTable($getValueSQL, '".nF_version."', $updateSQL);
  }
}

if ( !function_exists('seoFeedCountChicklet') )
{
  function seoFeedCountChicklet($fBAddress, $seo_config)
  {
    if (empty($seo_config['use_fb'])) $seo_config['use_fb'] = 1;
    if (empty($seo_config['feedcount_body'])) $seo_config['feedcount_body'] = 'A6A6A6';
    if (empty($seo_config['feedcount_text'])) $seo_config['feedcount_text'] = '000000';
    $chickletHTML = '';
    if (intval($seo_config['use_fb']) == 1 and !empty($fBAddress))
    $chickletHTML = '<a href="http://feeds.feedburner.com/'.$fBAddress.'"><img width="88" height="26" src="http://feeds.feedburner.com/~fc/'.$fBAddress.'?bg='.$seo_config['feedcount_body'].'&amp;fg='.$seo_config['feedcount_text'].'&amp;anim=0" style="border: 0pt none ; vertical-align:top;" alt="" /></a>';
    return $chickletHTML;
  }
}

?>
