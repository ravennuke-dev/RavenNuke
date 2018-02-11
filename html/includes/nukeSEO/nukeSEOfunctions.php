<?php
/************************************************************************
* nukeFEED, nukePIE, nukeSEO DH
* http://www.nukeSEO.com
* Copyright © 2009 by Kevin Guske
*************************************************************************
* This program is free software. You can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License.
*************************************************************************/

if ( !function_exists('htmlspecialchars_decode') )
{
   function htmlspecialchars_decode($text)
   {
       return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
   }
}

if ( !function_exists('html_entities_decode') )
{
    function html_entities_decode($string) 
    {
        // replace numeric entities
        $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
        $string = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $string);
        // replace literal entities
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        return strtr($string, $trans_tbl);
    }
}

if ( !function_exists('xml_entities_decode') )
{
  function xml_entities_decode($string) 
  {
    $string = strip_tags($string);
    $string = str_replace ( '&nbsp;', ' ', $string);
    $string = str_replace ( '  ', ' ', $string);
    $string = htmlspecialchars_decode($string);
    $string = str_replace ( '&rsquo;', "'", $string);
    return $string;
  }
}

if ( !function_exists('getNukeURL') )
{
    function getNukeURL() 
    {
      global $nukeurl;
      return $nukeurl.((substr($nukeurl, -1, 1) != '/') ? '/' : '');
    }
}

if ( !function_exists('encodeBoxover') )
{
  function encodeBoxover($string) {
    $string = str_replace('[','(', $string);
    $string = str_replace(']',')', $string);
    return $string;
  }
}


if ( !function_exists('xmlentities') )
{
  # Posted on http://www.php.net/htmlentities by send@mail.2aj.net
  function xmlentities($string)
  {
   return str_replace ( array ( '&', '"', "'", '<', '>', '`', '´', '“', '”'), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;', '&apos;', '&apos;', '&quot;', '&quot;' ), $string );    
  }
}

// function reltoabs courtesy Mike Macgirvin  http://macgirvin.com
// http://cr.unchy.com/article/b1c37da1-70c3-dfbd-11ef-a8fbb46a65de
if ( !function_exists('reltoabs') )
{
  function reltoabs($text, $base)
  {  
    if (empty($base))    return $text;  

    //base url needs trailing /  
    if (substr($base, -1, 1) != '/') $base = $base.'/';

    // Replace links  
    $pattern = "/<a([^>]*) href=\"(?!http|ftp|https)([^\"]*)\"/";  
    $replace = "<a\${1} href=\"" . $base . "\${2}\"";  
    $text = preg_replace($pattern, $replace, $text);  

    // Replace images  
    $pattern = "/<img([^>]*) src=\"(?!http|ftp|https)([^\"]*)\"/";  
    $replace = "<img\${1} src=\"" . $base . "\${2}\"";  
    $text = preg_replace($pattern, $replace, $text);

    // Replace link tags  
    $pattern = "/<link([^>]*) href=\"(?!http|ftp|https)([^\"]*)\"/";  
    $replace = "<link\${1} href=\"" . $base . "\${2}\"";
    $text = preg_replace($pattern, $replace, $text); 
    $text = str_replace("../", "", $text);   

    // Done  
    return $text;
  }
}

if ( !function_exists('seoContentList') )
{
  function seoContentList($selText)
  {
    $content = '<select name="contentName"><option value="">'.$selText.'</option>';
    if ($handle = opendir('includes/nukeSEO/content/')) 
    {
      while (false !== ($file = readdir($handle))) {
        if (!is_dir('includes/nukeSEO/content/'.$file)) {
          include_once('includes/nukeSEO/content/'.$file);
          $cname = substr($file,0,-4);
          $cname2 = 'seo'.$cname;
          ${$cname} = new $cname2();
          if (${$cname}->useme()){
            $file = substr($file,0,-4);
            $content .= '<option value="'.$file.'">'.$file.'</option>';
          }
        }
      }
      closedir($handle);
    }
    return $content.'</select>';
  }
}

if ( !function_exists('seoGetContentTypes') )
{
  function seoGetContentTypes($selText, $naText)
  {
    global $cFContent, $subItems, $subItems2;
    $value = array (
        'value' => '', 
        'text' => $selText, 
        'selected' => false, 
        'items' => array (
            '' => $naText
        ),
        'items2' => array (
            '' => $naText
        )
    );
    $values[] = $value;
    if ($handle = opendir('includes/nukeSEO/content/')) 
    {
      while (false !== ($file = readdir($handle))) {
        if (!is_dir('includes/nukeSEO/content/'.$file)) {
          include_once('includes/nukeSEO/content/'.$file);
          $cname = substr($file,0,-4);
          $cname2 = 'seo'.$cname;
          ${$cname} = new $cname2();
          if (${$cname}->useme()){
            $file = substr($file,0,-4);
            $sel = false;
            if ($file == $cFContent) $sel = true;
            $value = array (
   	            'value' => $file, 
                'text' => $file, 
                'selected' => $sel, 
                'items'    => ${$cname}->getOrders($selText),
                'items2'   => ${$cname}->getLevels($selText)
            );
            $values[] = $value;
          }
        }
      }
      closedir($handle);
    }
    return $values;
  }
}

if ( !function_exists('seoCleanString') )
{
  function seoCleanString($str = '') {
    if (strlen($str) > 0) {
      $str = strip_tags(html_entity_decode($str, ENT_QUOTES));
      if(!get_magic_quotes_gpc()) $str = addslashes($str);
    }
    return $str;
  }
}

if ( !function_exists('seoHelp') )
{
  function seoHelp($baseDEF) {
    $hdr = htmlentities(constant($baseDEF));
    $body = htmlentities(constant($baseDEF.'_HLP'));
    $seoHelpHTML = '<a title="cssbody=[seoHelpBody] cssheader=[seoHelpHdr] header=[&lt;img src=\'images/nukeSEO/info.png\' style=\'vertical-align:middle\'&gt;&nbsp;'.$hdr.'] body=['.$body.'] singleclickstop=[on] hideselects=[on]"><img src="images/nukeSEO/info.png" style="vertical-align:middle" width="20" height="20" alt="'.$hdr.'" /></a>';
    return $seoHelpHTML;
  }
}
if ( !function_exists('seoHelpCT') ) {
	function seoHelpCT($baseDEF) {
		$hdr = htmlentities(constant($baseDEF));
		$body = htmlentities(constant($baseDEF.'_HLP'));
#		$seoHelpHTML = '<a class="seoHelp" title="&lt;img src=\'images/nukeSEO/info.png\' style=\'vertical-align:middle\'&gt;&nbsp;'.$hdr.'|'.$body.'"><img src="images/nukeSEO/info.png" style="vertical-align:middle" width="20" height="20" alt="'.$hdr.'" /></a>';
		$seoHelpHTML = '<a class="seoHelp" title="&lt;img src=\'images/nukeSEO/info.png\' style=\'vertical-align:middle\'&gt;&nbsp;'.$hdr.'|'.$body.'"><img src="images/nukeSEO/info.png" style="vertical-align:middle" width="20" height="20" alt="'.$hdr.'" /></a>';
		return $seoHelpHTML;
	}
}

if ( !function_exists('seoPopUp') )
{
  function seoPopUp($hdr, $body) {
    $hdr = htmlentities($hdr);
    $body = htmlentities($body);
    $seoPopUpHTML = '<a title="cssbody=[seoHelpBody] cssheader=[seoHelpHdr] header=[&lt;img src=\'images/nukeSEO/info.png\' style=\'vertical-align:middle\'&gt;&nbsp;'.$hdr.'] body=['.$body.'] singleclickstop=[on] hideselects=[on]"><img src="images/nukeSEO/info.png" style="vertical-align:middle" width="20" height="20" alt="'.$hdr.'" /></a>';
    return $seoPopUpHTML;
  }
}
// ADMIN FUNCTIONS

if ( !function_exists('seoCheckCreateTable') )
{
  function seoCheckCreateTable($existSQL = '', $createSQL = array()) {
    global $db;
    $exists = $db->sql_query($existSQL);
    if ($exists) return true;
    foreach ($createSQL as $sql)
    {
      if(!$db->sql_query($sql)) 
      {
        return false; 
      }
    }
    return true; 
  }
}

if ( !function_exists('seoCheckUpdateTable') )
{
  function seoCheckUpdateTable($getValueSQL = '', $newValue, $updateSQL = array()) {
    global $db;
    $existing = $db->sql_fetchrow($db->sql_query($getValueSQL));
    if ($existing['value'] == $newValue) return true;
    foreach ($updateSQL as $sql)
    {
      if(!$db->sql_query($sql)) 
      {
        return false; 
      }
    }
    return true; 
  }
}

if ( !function_exists('seoGetConfig') )
{
  function seoGetConfig($config_type = 'Feeds', $config_name){
    global $prefix, $db;
    $configresult = $db->sql_query('SELECT `config_value` FROM `'.$prefix.'_seo_config` WHERE config_type = `'.$config_type.'` and `config_name`=`'.$config_name.'`');
    list($config_value) = $db->sql_fetchrow($configresult);
    return $config_value;
  }
}

if ( !function_exists('seoGetConfigs') )
{
  function seoGetConfigs($config_type = 'Feeds'){
    global $prefix, $db;
    $config = array();
    $sql = 'SELECT `config_name`, `config_value` FROM `'.$prefix.'_seo_config` WHERE config_type = \''.$config_type.'\'';
    $configresult = $db->sql_query($sql);
    while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
      $config[$config_name] = $config_value;
    }
    return $config;
  }
}

if ( !function_exists('seoSaveConfig') )
{
  function seoSaveConfig($config_type, $config_name, $config_value){
    global $prefix, $db;
    $resultnum = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_seo_config` WHERE `config_type`='$config_type' and `config_name`='$config_name'"));
    if($resultnum < 1) {
      $db->sql_query("INSERT INTO `".$prefix."_seo_config` (`config_type`, `config_name`, `config_value`) VALUES ('$config_type', '$config_name', '$config_value')");
    } else {
      $db->sql_query("UPDATE `".$prefix."_seo_config` SET `config_value`='$config_value' WHERE `config_type`='$config_type' and `config_name`='$config_name'");
    }
  }
}

if ( !function_exists('seoGetLang') )
{
  function seoGetLang($module) {
    global $currentlang, $language;
#    if ($module == 'admin' AND $module != 'Forums') {
#      if (file_exists('admin/language/lang-'.$currentlang.'.php')) {
#        include_once('admin/language/lang-'.$currentlang.'.php');
#      } elseif (file_exists('admin/language/lang-'.$language.'.php')) {
#        include_once('admin/language/lang-'.$language.'.php');
#      } elseif (file_exists('admin/language/lang-english.php')) {
#        include_once('admin/language/lang-english.php');
#      }
#    } else {
      if (file_exists('modules/'.$module.'/language/lang-'.$currentlang.'.php')) {
        include_once('modules/'.$module.'/language/lang-'.$currentlang.'.php');
      } elseif (file_exists('modules/'.$module.'/language/lang-'.$language.'.php')) {
        include_once('modules/'.$module.'/language/lang-'.$language.'.php');
      } elseif (file_exists('modules/'.$module.'/language/lang-english.php')) {
        include_once('modules/'.$module.'/language/lang-english.php');
      }
#    }
  }
}

if ( !function_exists('seoGetCurrentVersion') )
{
  function seoGetCurrentVersion ($p1, $debug=0) {
    require_once ('includes/xmlrpc/xmlrpc.php');
    $client = new xmlrpc_client('/version.php', 'nukeseo.com', 80);
    $client->return_type = 'xmlrpcvals';
    $client->setDebug($debug);
    $msg = new xmlrpcmsg('script.getCurrentVersion');
    $p1 = new xmlrpcval($p1, 'string');
    $msg->addparam($p1);
    $res =& $client->send($msg, 0, '');
    if ($res->faultcode()) return $res; 
    else return php_xmlrpc_decode($res->value());
  }
}

if ( !function_exists('seoGetMETAtags') ) {
	function seoGetMETAtags ($name, $mode) {
		global $sitename, $slogan, $dh, $dhLevel, $dhID, $dhCat, $dhSubCat, $dhName;
		$dhID = intval($dhID);
		$dhSubCat = intval($dhSubCat);
		$dhCat = intval($dhCat);
		$meta = array();
/*
 * Generate META tags for this module except for modal popups, otherwise use defaults
 */
		if (defined('MODAL') and !empty($dhName)) $name = $dhName;
		if (defined('ADMIN_FILE') and ADMIN_FILE)
			$class = 'dhAdmin';
		elseif (!empty($name) and file_exists('includes/nukeSEO/dh/dh'.$name.'.php')) {
			$class = 'dh'.$name;
		} else {
			$class = 'dhDefault';
/*			$meta['title'][1] = $name . ' - '.$sitename . ' - ' . $slogan;
			$meta['Content-Script-Type'] = array('http-equiv','text/javascript',0);
			$meta['Content-Style-Type'] = array('http-equiv','text/css',0);
			$meta['Expires'] = array('http-equiv','0',0);
			$meta['RESOURCE-TYPE'] = array('name','DOCUMENT',0);
			$meta['DISTRIBUTION'] = array('name','GLOBAL',0);
			$meta['AUTHOR'] = array('name',$sitename,0);
			$meta['COPYRIGHT'] = array('name','Copyright (c) by '.$sitename,0);
			$meta['DESCRIPTION'] = array('name',$slogan,0);
			$meta['KEYWORDS'] = array('name','CMS, cms, Best CMS, best cms, Raven, RavenNuke, Raven Nuke, raven, ravennuke, raven nuke, scripts, PHP, php, MySQL, mysql, SQL, sql, News, news, Technology, technology, Headlines, headlines, Nuke, nuke, PHP-Nuke, phpnuke, php-nuke, Linux, linux, Windows, windows, Software, software, Download, download, Downloads, downloads, Free, FREE, free, Community, community, Forum, forum, Forums, forums, Bulletin, bulletin, Board, board, Boards, boards, Survey, survey, Comment, comment, Comments, comments, Portal, portal, ODP, odp, Open, open, Open Source, OpenSource, Opensource, opensource, open source, Free Software, FreeSoftware, Freesoftware, free software, GNU, gnu, GPL, gpl, License, license, Unix, UNIX, *nix, unix, Database, DataBase, Blogs, blogs, Blog, blog, database, Programming, programming, Web Site, web site, Weblog, WebLog, weblog, ',0);
			$meta['REVISIT-AFTER'] = array('name','1 DAYS',0);
			$meta['RATING'] = array('name','GENERAL',0);
*/
		}
		require_once 'includes/nukeSEO/dh/dh.class.php';
		require_once 'includes/nukeSEO/dh/' . $class . '.php';
		$dh = new $class();
		if ($dhID > 0) $dh->setContentID();
		if ($dhSubCat >0) $dh->setSubCatID();
		if ($dhCat >0) $dh->setCatID();
		$meta = $dh->getHEAD($mode, $name);
		$dhLevel = $dh->getContentLevel();
		return $meta;
	}
}
if ( !function_exists('seoSaveMETAOverride') ) {
	function seoSaveMETAOverride($metaName, $dhLevel, $dhName, $dhID, $dhCat, $dhSubCat, $dhValue){
		global $prefix, $db;
		$dhValue = stripslashes(FixQuotes($dhValue));
		if ($dhID == 0 and $dhSubCat > 0) $dhID = $dhSubCat;
		if ($dhID == 0 and $dhCat > 0) $dhID = $dhCat;
		if ($dhLevel == 0) $dhName = '';		// Site level has no title (module name)
		list($mid) = $db->sql_fetchrow($db->sql_query("SELECT mid FROM `".$prefix."_seo_dh_master` WHERE `name`='$metaName'"));
		if ($mid == 0) die('There is a problem.');
		$resultnum = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_seo_dh` WHERE `levelsort`='$dhLevel' and `title`='$dhName' and `id`='$dhID' and `mid`='$mid'"));
		if($resultnum < 1) {
			$db->sql_query("INSERT INTO `".$prefix."_seo_dh` (`levelsort`, `title`, `id`, `mid`, `metavalue`, `active`) VALUES ('$dhLevel', '$dhName', '$dhID', '$mid', '$dhValue', '1')");
		} else {
			$db->sql_query("UPDATE `".$prefix."_seo_dh` SET `metavalue`='$dhValue' WHERE `levelsort`='$dhLevel' and `title`='$dhName' and `id`='$dhID' and `mid`='$mid'");
		}
	}
}
if ( !function_exists('seoDeleteMETAOverride') ) {
	function seoDeleteMETAOverride($metaName, $dhLevel, $dhName, $dhID, $dhSubCat, $dhCat){
		global $prefix, $db;
		if ($dhID == 0 and $dhSubCat > 0) $dhID = $dhSubCat;
		if ($dhID == 0 and $dhCat > 0) $dhID = $dhCat;
		if ($dhLevel == 0) $dhName = '';		// Site level has no title (module name)
		list($mid) = $db->sql_fetchrow($db->sql_query("SELECT mid FROM `".$prefix."_seo_dh_master` WHERE `name`='$metaName'"));
		if ($mid == 0) die('There is a problem.');
		$resultnum = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_seo_dh` WHERE `levelsort`='$dhLevel' and `title`='$dhName' and `id`='$dhID' and `mid`='$mid'"));
		if($resultnum > 0) {
			$db->sql_query("DELETE FROM `".$prefix."_seo_dh` WHERE `levelsort`='$dhLevel' and `title`='$dhName' and `id`='$dhID' and `mid`='$mid'");
		}
	}
}

?>