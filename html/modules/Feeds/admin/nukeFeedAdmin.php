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
  if (empty($fid)) $fid = 0;
  if (empty($cFLID)) $cFLID = 0;
  if (empty($cFHowMany)) $cFHowMany = 0;
  if (empty($cFContent)) $cFContent = '';
  if (empty($contentName)) $contentName = $cFContent;
  if (empty($cFTitle)) $cFTitle = '';
  if (empty($cFDesc)) $cFDesc = '';
  if (empty($subItems)) $subItems = '';
  if (empty($subItems2)) $subItems2 = '';
  if (empty($fBAddress)) $fBAddress = '';
  $error = '';
  $fid = intval($fid);
  $cFLID = intval($cFLID);
  $cFHowMany = intval($cFHowMany);
  # Get configuration
  $seo_config = seoGetConfigs('Feeds');
  # Save feed?
  if ($op == 'nfSaveFeed') {
    if ($cFTitle == '') $error .= _nF_TITLEREQUIRED.'<br />';
    if ($cFContent == '') $error .= _nF_CONTENTREQUIRED.'<br />';
    if ($subItems == '') $error .= _nF_ORDERREQUIRED.'<br />';
    if (intval($cFHowMany) == 0) $error .= _nF_HOWMANYREQUIRED.'<br />';
    if ($subItems2 == '') $error .= _nF_LEVELREQUIRED.'<br />';
    if ($subItems2 != 'module' and $subItems2 != '' and $cFLID == 0) $error .= _nF_LIDREQUIRED.'<br />';
    if ($error == '') {
      $cFContent  = seoCleanString($cFContent);
      $contentName= seoCleanString($contentName);
      $cFTitle    = seoCleanString($cFTitle);
      $cFDesc     = seoCleanString($cFDesc);
      $subItems   = seoCleanString($subItems);
      $subItems2  = seoCleanString($subItems2);
      $fBAddress    = seoCleanString($fBAddress);
      if ($fid > 0) 
      {
        $sql = 'UPDATE `'.$prefix.'_seo_feed` SET `content` = "'.$cFContent.'", `name` = "'.$contentName.'", `level` = "'.$subItems2.'", `lid` = "'.$cFLID.'", `title` = "'.$cFTitle.'", `desc` = "'.$cFDesc.'", `order` = "'.$subItems.'", `howmany` = '.intval($cFHowMany).', `active` = '.intval($cFactive).', `feedburner_address` = "'.$fBAddress.'" WHERE fid = '.$fid.';';
      }
      else
      {
        $sql = 'INSERT INTO `'.$prefix.'_seo_feed` (`content`, `name`, `level`, `lid`, `title`, `desc`, `order`, `howmany`, `active`, `feedburner_address`) VALUES("'.$cFContent.'", "'.$contentName.'", "'.$subItems2.'", "'.$cFLID.'", "'.$cFTitle.'", "'.$cFDesc.'", "'.$subItems.'",'.intval($cFHowMany).','.intval($cFactive).', "'.$fBAddress.'");';
      }
      $res = $db->sql_query($sql);
      header("Location: ".$admin_file.".php?op=nukeFEED");
      die();
    }
  }
  # Delete feed?
  if ($op == 'nfDeleteFeed' and $fid >0) {
    $res = $db->sql_query('DELETE FROM `'.$prefix.'_seo_feed` where fid = "'.$fid.'";');
    header("Location: ".$admin_file.".php?op=nukeFEED");
    die();
  }
  $cFHMHTML = '';
  $inactsel = '';
  if ($op == 'nfEditFeed' and $fid > 0)
  {
    $sql = 'SELECT * FROM `'.$prefix.'_seo_feed` WHERE fid = '.$fid.';';
    $feed =  $db->sql_fetchrow($db->sql_query($sql));
    $cFTitle    = $feed['title'];
    $cFContent  = $feed['content'];
    $contentName= $feed['name'];
    $subItems   = $feed['order'];
    $cFHowMany  = $feed['howmany'];
    $subItems2  = $feed['level'];
    $cFLID      = $feed['lid'];
    $cFDesc     = $feed['desc'];
    $cFHMHTML   = '<option value="'.$cFHowMany.'" selected="selected">'.$cFHowMany.'</option>';
    $cFactive   = $feed['active'];
    if (!$cFactive) $inactsel = 'selected="selected"';
    $fBAddress  = $feed['feedburner_address'];
#    securitycode
#    cachetime
  }
  else
  {
    if(!@get_magic_quotes_gpc()) {
      if (strlen($cFContent) > 0) $cFContent  = stripslashes($cFContent);
      if (strlen($contentName) > 0) $contentName  = stripslashes($contentName);
      if (strlen($cFTitle) > 0)   $cFTitle    = stripslashes($cFTitle);
      if (strlen($cFDesc) > 0)    $cFDesc     = stripslashes($cFDesc);
      if (strlen($subItems) > 0)  $subItems   = stripslashes($subItems);
      if (strlen($subItems2) > 0) $subItems2  = stripslashes($subItems2);
      if (strlen($fBAddress) > 0) $fBAddress  = stripslashes($fBAddress);
    }
  }
  if ($fid > 0)
  {
    $addedit = _nF_EDIT;
    $addedit2= '<a href="'.$admin_file.'.php?op=nukeFEED">'._nF_ADD.'</a>';
  }
  else 
  {
    $addedit = _nF_ADD;
    $addedit2='';
  }
  listFeeds();

  include_once('includes/nukeSEO/forms/CLinkedSelect.php');
  $values = seoGetContentTypes('Select','Not Available');
  $linkedselect = new CLinkedSelect();
  $linkedselect->formName = 'addFeed';
  $linkedselect->primaryFieldName = 'cFContent';
  $linkedselect->secondaryFieldName = 'subItems';
  $linkedselect->secondaryFieldValue = $subItems;
  $linkedselect->thirdFieldName = 'subItems2';
  $linkedselect->thirdFieldValue = $subItems2;
  $linkedselect->fieldValues = $values;
  
  if ($error > '') 
  {
    echo '<h2 align="center">'.$error.'</h2><br />';
  }

  echo '  
  <script type="text/javascript" src="includes/nukeSEO/forms/dhtmlxCombo/js/dhtmlXCommon.js"></script>
  <script type="text/javascript" src="includes/nukeSEO/forms/dhtmlxCombo/js/dhtmlXCombo.js"></script>
  <script type="text/javascript">dhx_globalImgPath="includes/nukeSEO/forms/dhtmlxCombo/imgs/";</script>
  <form name="addFeed" action="'.$admin_file.'.php?op=nfSaveFeed" method="post">
    <table>
    <tr><td><strong>'.$addedit.'</strong></td><td style="text-align: right;">'.$addedit2.'</td></tr>
    <tr>
    <td>'.seoHelp('_nF_TITLE').' '._nF_TITLE.'</td>
    <td><input maxlength="50" size="30" name="cFTitle" type="text" value="'.$cFTitle.'" /></td>
    </tr>
    <tr>
    <td>'.seoHelp('_nF_CONTENT').' '._nF_CONTENT.'</td><td>'.
    $linkedselect->get_function_js ().
    $linkedselect->get_primary_field ().'
    </td>
    <td>'.seoHelp('_nF_CONTENTNAME').' '._nF_CONTENTNAME.'</td><td>
    <input maxlength="20" size="20" name="contentName" type="text" value="'.$contentName.'" />
    </td>
    </tr>
    <tr>
    <td>'.seoHelp('_nF_ORDER').' '._nF_ORDER.'</td> 
    <td>'.$linkedselect->get_secondary_field ('', '', 'Not Available').'
    </td>
    <td>'.seoHelp('_nF_HOWMANY').' '._nF_HOWMANY.'</td>
    <td><select style="width:50px;" id="combo_zone1" name="cFHowMany">
    '.$cFHMHTML.'
    <option value="1">1</option>
    <option value="3">3</option>
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    </select>
    <script type="text/javascript">var z=dhtmlXComboFromSelect("combo_zone1");</script>
    </td>
    </tr>
    <tr>
    <td>'.seoHelp('_nF_LEVEL').' '._nF_LEVEL.'</td>
    <td>'.$linkedselect->get_third_field ('', '', 'Not Available').'
    </td>
    <td>'.seoHelp('_nF_LID').' '._nF_LID.'</td>
    <td><input maxlength="6" size="5" name="cFLID" type="text" value="'.$cFLID.'" /></td>
    </tr>
    <tr>
    <td valign="top">'.seoHelp('_nF_DESC').' '._nF_DESC.'</td>
    <td colspan="3"><textarea rows="4" cols="60" name="cFDesc">'.$cFDesc.'</textarea></td>
    </tr>
    <tr>
    <td>'.seoHelp('_nF_STATUS').' '._nF_STATUS.'</td>
    <td><select name="cFactive"><option value="1">'._nF_ACTIVE.'</option><option value="0" '.$inactsel.'>'._nF_INACTIVE.'</option></select></td>
    </tr>
    <tr>
    <td>'.seoHelp('_nF_FEEDBURNER_FEED_ADDRESS').' <img src="images/nukeFEED/icon_status_'.(($seo_config['use_fb']) ? 'green':'red').'.gif" alt="'.(($seo_config['use_fb']) ? _nF_ACTIVE:_nF_INACTIVE).'" title="'.(($seo_config['use_fb']) ? _nF_ACTIVE:_nF_INACTIVE).'" />&nbsp;'._nF_FEEDBURNER_FEED_ADDRESS.'</td>
    <td colspan="3">'.((empty($seo_config['feedburner_url'])) ? 'http://feeds.feedburner.com':$seo_config['feedburner_url']).'/<input maxlength="100" size="30" name="fBAddress" type="text" value="'.$fBAddress.'" style="background: #ffffff url(images/nukeFEED/feedburner.gif) no-repeat 4px 50%; padding:2px 2px 2px 28px; border:1px solid;" /></td>
    </tr>
    </table><input type="hidden" name="fid" value="'.$fid.'" />
  <input type="submit" value="'._nF_SAVE.'" />
  </form>  
  ';
?>