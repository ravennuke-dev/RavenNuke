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

global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
    Header('Location: ../../../'.$admin_file.'.php');
    die();
}
# Important for security
if (empty($sid)) $sid = 0;
$sid = intval($sid);

define('_type','aggregator');
$error = '';
if (empty($tagline)) $tagline = '';
if (empty($image)) $image = '';
if (empty($icon)) $icon = '';
if (empty($url)) $url = '';
# Save subscription?
if ($op == 'nfSaveSubscript') 
{
  if ($name == '') $error .= _nF_NAMEREQUIRED.'<br />';
  if ($url == '') $error .= _nF_URLREQUIRED.'<br />';
  if ($tagline == '') $error .= _nF_TAGLINEREQUIRED.'<br />';
  if ($error == '') {
    $name     = strip_tags(html_entity_decode($name, ENT_QUOTES, _CHARSET));
    $tagline  = strip_tags(html_entity_decode($tagline, ENT_QUOTES, _CHARSET));
    $image    = strip_tags(html_entity_decode($image, ENT_QUOTES, _CHARSET));
    $icon     = strip_tags(html_entity_decode($icon, ENT_QUOTES, _CHARSET));
    $url      = strip_tags(html_entity_decode($url, ENT_QUOTES, _CHARSET));
    if(!@get_magic_quotes_gpc()) {
      $name     = addslashes($name);
      $tagline  = addslashes($tagline);
      $image    = addslashes($image);
      $icon     = addslashes($icon);
      $url      = addslashes($url);
      $active   = intval($active);
    }
    if ($sid > 0) 
    {
      $sql = 'UPDATE `'.$prefix.'_seo_subscriptions` SET `name` = "'.$name.'", `tagline` = "'.$tagline.'", `image` = "'.$image.'", `icon` = "'.$icon.'", `url` = "'.$url.'", `active` = "'.$active.'" WHERE sid = '.$sid.';';
    }
    else
    {
      $sql = 'INSERT INTO `'.$prefix.'_seo_subscriptions` (`type`, `name`, `tagline`, `image`, `icon`, `url`, `active`) VALUES("'._type.'", "'.$name.'", "'.$tagline.'","'.$image.'","'.$icon.'","'.$url.'","'.$active.'");';
    }
    $res = $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=nfEditSubscript");
    die();
  }
}

if ($op == 'nfDelSubscript' and $sid > 0) 
{
  $res = $db->sql_query('DELETE FROM `'.$prefix.'_seo_subscriptions` where sid = "'.intval($sid).'";');
  header("Location: ".$admin_file.".php?op=nfEditSubscript");
  die();
}

$inactsel = '';
if ($op == 'nfEditSubscript' and $sid > 0)
{
  $sql = 'SELECT * FROM `'.$prefix.'_seo_subscriptions` WHERE sid = '.$sid.';';
  $subscript  = $db->sql_fetchrow($db->sql_query($sql));
  $name       = $subscript['name'];
  $tagline    = $subscript['tagline'];
  $image      = $subscript['image'];
  $icon       = $subscript['icon'];
  $url        = $subscript['url'];
  $active     = $subscript['active'];
  if (!$active) $inactsel = 'selected="selected"';
}
else
{
  if(!@get_magic_quotes_gpc()) {
    if (strlen($name) > 0)    $name     = stripslashes($name);
    if (strlen($tagline) > 0) $tagline  = stripslashes($tagline);
    if (strlen($image) > 0)   $image    = stripslashes($image);
    if (strlen($icon) > 0)    $icon     = stripslashes($icon);
    if (strlen($url) > 0)     $url      = stripslashes($url);
  }
}
if ($sid > 0)
{
  $addedit = _nF_EDITAGGREGATOR;
  $addedit2= '<a href="'.$admin_file.'.php?op=nfEditSubscript">'._nF_ADDAGGREGATOR.'</a>';
}
else 
{
  $addedit = _nF_ADDAGGREGATOR;
  $addedit2='';
}

$seo_config = seoGetConfigs('Feeds');
listSubscriptions('admin', _type, getSubscriptions(_type), '', '', 0, '', $seo_config);  
if ($error > '') 
{
  echo '<h2 align="center">'.$error.'</h2><br />';
}
echo '<br />  
<form name="editSubscript" action="'.$admin_file.'.php?op=nfSaveSubscript" method="post">
  <table>
  <tr><td><strong>'.$addedit.'</strong></td><td style="text-align: right;">'.$addedit2.'</td></tr>
  <tr>
  <td>'.seoHelp('_nF_AGGREGATOR').' '._nF_AGGREGATOR.'</td>
  <td><input maxlength="60" size="60" name="name" type="text" value="'.$name.'" /></td>
  </tr>
  <tr>
  <td>'.seoHelp('_nF_URL').' '._nF_URL.'</td>
  <td><input maxlength="256" size="60" name="url" type="text" value="'.$url.'" /></td>
  </tr>
  <tr><td>&nbsp;</td><td>'._nF_URLTEXT.'{URL}, {NUKEURL}, {TITLE}</td></tr>
  <tr>
  <td>'.seoHelp('_nF_TAGLINE').' '._nF_TAGLINE.'</td> 
  <td><input maxlength="60" size="60" name="tagline" type="text" value="'.$tagline.'" /></td>
  </tr>
  <tr>
  <td>'.seoHelp('_nF_IMAGE').' '._nF_IMAGE.'</td>
  <td><input maxlength="256" size="60" name="image" type="text" value="'.$image.'" /></td>
  </tr>
  <tr>
  <td>'.seoHelp('_nF_STATUS').' '._nF_STATUS.'</td>
  <td><select name="active"><option value="1">'._nF_ACTIVE.'</option><option value="0" '.$inactsel.'>'._nF_INACTIVE.'</option></select></td>
  </tr>
  </table><input type="hidden" name="sid" value="'.$sid.'" />
  <input type="submit" value="'._nF_SAVE.'" />
</form>  
';

?>