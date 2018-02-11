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
if ($op == 'nfSaveConfig') 
{
  $xuse_fb         = intval($xuse_fb);
  $xshow_circgraph = intval($xshow_circgraph);
  $xshow_feedcount = intval($xshow_feedcount);
  $xfeedcount_body = strip_tags(html_entity_decode($xfeedcount_body, ENT_QUOTES, _CHARSET));
  $xfeedcount_text = strip_tags(html_entity_decode($xfeedcount_text, ENT_QUOTES, _CHARSET));
  $xfeedburner_url = strip_tags(html_entity_decode($xfeedburner_url, ENT_QUOTES, _CHARSET));
  if(!@get_magic_quotes_gpc())
  {
    $xfeedcount_body  = addslashes($xfeedcount_body);
    $xfeedcount_text  = addslashes($xfeedcount_text);
    $xfeedburner_url  = addslashes($xfeedburner_url);
  }
  seoSaveConfig('Feeds', 'use_fb',$xuse_fb);
  seoSaveConfig('Feeds', 'feedburner_url',$xfeedburner_url);
  seoSaveConfig('Feeds', 'show_circgraph',$xshow_circgraph);
  seoSaveConfig('Feeds', 'show_feedcount',$xshow_feedcount);
  seoSaveConfig('Feeds', 'feedcount_body',$xfeedcount_body);
  seoSaveConfig('Feeds', 'feedcount_text',$xfeedcount_text);
}
if ($op == 'nfDisableMod' or $op == 'nfEnableMod') 
{
  $contentName  = strip_tags(html_entity_decode($contentName, ENT_QUOTES, _CHARSET));
  $module_name  = strip_tags(html_entity_decode($module_name, ENT_QUOTES, _CHARSET));
  if(!@get_magic_quotes_gpc())
  {
    $contentName  = addslashes($contentName);
    $module_name  = addslashes($module_name);
  }
}
if ($op == 'nfDisableMod' and !empty($contentName) and !empty($module_name)) 
{
  $sql = 'INSERT INTO `'.$prefix.'_seo_disabled_modules` (`title`, `seo_module`) VALUES("'.$contentName.'", "'.$module_name.'");';
  $res = $db->sql_query($sql);
}

if ($op == 'nfEnableMod') 
{
  $res = $db->sql_query('DELETE FROM `'.$prefix.'_seo_disabled_modules` WHERE `title`="'.$contentName.'" and `seo_module`="'.$module_name.'"');
}
$seo_config = seoGetConfigs('Feeds');
OpenTable();
echo '<script src="includes/nukeSEO/forms/colorsphere/colorsphere.js" type="text/JavaScript"></script>';
echo '<form action="'.$admin_file.'.php" method="post">';
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
echo '<tr><td align="center" bgcolor="'.$bgcolor2.'" colspan="2"><img src="images/nukeFEED/feedburner.gif" alt="'._nF_FEEDBURNERSETTINGS.'" title="'._nF_FEEDBURNERSETTINGS.'" />&nbsp;<strong>'._nF_FEEDBURNERSETTINGS.'</strong></td></tr>';
echo '<tr><td bgcolor="'.$bgcolor2.'">'.seoHelp('_nF_USE_FEEDBURNER').' '._nF_USE_FEEDBURNER.':</td><td>'.chr(10);
$selusefb1 = $selusefb2 = '';
if($seo_config['use_fb'] == 0) { $selusefb2 = 'selected="selected"'; } else { $selusefb1 = 'selected="selected"'; }
echo '<select name="xuse_fb">'.chr(10).'<option value="1" '.$selusefb1.'>'._nF_YES.'</option>'.chr(10);
echo '<option value="0" '.$selusefb2.'>'._nF_NO.'</option>'.chr(10);
echo '</select></td></tr>';
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top">'.seoHelp('_nF_FEEDBURNER_URL').' '._nF_FEEDBURNER_URL.':</td>'.chr(10).'<td>';
echo '<input type="text" name="xfeedburner_url" size="50" maxlength="255" value="'.$seo_config['feedburner_url'].'" /></td></tr>';
echo '<tr><td bgcolor="'.$bgcolor2.'">'.seoHelp('_nF_SHOW_CIRCGRAPH').' '._nF_SHOW_CIRCGRAPH.':</td><td>'.chr(10);
$selcircgraph1 = $selcircgraph2 = '';
if($seo_config['show_circgraph'] == 0) { $selcircgraph2 = 'selected="selected"'; } else { $selcircgraph1 = 'selected="selected"'; }
echo '<select name="xshow_circgraph">'.chr(10).'<option value="1" '.$selcircgraph1.'>'._nF_YES.'</option>'.chr(10);
echo '<option value="0" '.$selcircgraph2.'>'._nF_NO.'</option>'.chr(10);
echo '</select></td></tr>';
echo '<tr><td bgcolor="'.$bgcolor2.'">'.seoHelp('_nF_SHOW_FEEDCOUNT').' '._nF_SHOW_FEEDCOUNT.':</td><td>'.chr(10);
$selfeedcount1 = $selfeedcount2 = '';
if($seo_config['show_feedcount'] == 0) { $selfeedcount2 = 'selected="selected"'; } else { $selfeedcount1 = 'selected="selected"'; }
echo '<select name="xshow_feedcount">'.chr(10).'<option value="1" '.$selfeedcount1.'>'._nF_YES.'</option>'.chr(10);
echo '<option value="0" '.$selfeedcount2.'>'._nF_NO.'</option>'.chr(10);
echo '</select></td></tr>';
echo '<tr valign="top"><td bgcolor="'.$bgcolor2.'">'.seoHelp('_nF_FEEDCOUNT_COLORS').' '._nF_FEEDCOUNT_COLORS.':</td><td>'.chr(10);
echo '
<table>
<tr valign="top">
  <td width="160">
    body #<input type="text" name="xfeedcount_body" id="FccB" size="6" maxlength="6" value="'.$seo_config['feedcount_body'].'" ';
echo "onchange=\"changeAttributeColor('FccB','fCCSample', 'background')\" /> <a href=\"javascript:toggle('cpFccB')\" title=\""._nF_TOGGLECOLORSPHERE."\"><img src=\"includes/nukeSEO/forms/colorsphere/media/colorsphere.png\" alt=\""._nF_TOGGLECOLORSPHERE."\" border=\"0\" /></a>";
echo '
    <input type="hidden" id="FccB_disp" value="fCCSample" />
    <input type="hidden" id="FccB_attr" value="background" />
  </td>
  <td width="160">
    text #<input type="text" name="xfeedcount_text" id="FccT" size="6" maxlength="6" value="'.$seo_config['feedcount_text'].'" ';
echo "onchange=\"changeAttributeColor('FccT','fCCSample', 'color')\" /> <a href=\"javascript:toggle('cpFccT')\" title=\""._nF_TOGGLECOLORSPHERE."\"><img src=\"includes/nukeSEO/forms/colorsphere/media/colorsphere.png\" alt=\""._nF_TOGGLECOLORSPHERE."\" border=\"0\" /></a>";
echo '
    <input type="hidden" id="FccT_disp" value="fCCSample" />
    <input type="hidden" id="FccT_attr" value="color" />
  </td>
  <td>
  <div id="fCCSample" style="height: 20px; width: 88px; padding-top: 6px; color: #'.$seo_config['feedcount_text'].'; border: 1px solid #333; text-align: center; font-size: 12px; background: #'.$seo_config['feedcount_body'].';">text</div>
  </td>
</tr>
<tr valign="top">
  <td width="160">
  <div id="cpFccB" onmousedown="coreXY(\'cpFccB\',\'\',event)" style="position:relative; left: 0; top: 0;">
    <div class="north">
      <span id="cpFccB_HEX">FFFFFF</span>
      <div onmousedown="$S(\'cpFccB\').display=\'none\';">X</div>
    </div>
    <div class="south" id="cpFccB_Spec" style="height: 128px; width: 128px;" onmousedown="coreXY(\'cpFccB\',\'_Cur\',event)">
      <div id="cpFccB_Cur" style="top: 86px; left: 68px;"></div>
      <img src="includes/nukeSEO/forms/colorsphere/media/circle.png" onmousedown="return false;" alt="" />
      <img src="includes/nukeSEO/forms/colorsphere/media/resize.gif" id="cpFccB_Size" onmousedown="coreXY(\'cpFccB\',\'_Size\',event); return false;" alt="" />
    </div>
  </div>
  </td>
  <td width="160">
  <div id="cpFccT" onmousedown="coreXY(\'cpFccT\',\'\',event)" style="position:relative; left: 0; top: 0;">
    <div class="north">
      <span id="cpFccT_HEX">FFFFFF</span>
      <div onmousedown="$S(\'cpFccT\').display=\'none\';">X</div>
    </div>
    <div class="south" id="cpFccT_Spec" style="height: 128px; width: 128px;" onmousedown="coreXY(\'cpFccT\',\'_Cur\',event)">
      <div id="cpFccT_Cur" style="top: 86px; left: 68px;"></div>
      <img src="includes/nukeSEO/forms/colorsphere/media/circle.png" onmousedown="return false;" alt="" />
      <img src="includes/nukeSEO/forms/colorsphere/media/resize.gif" id="cpFccT_Size" onmousedown="coreXY(\'cpFccT\',\'_Size\',event); return false;" alt="" />
    </div>
  </div>
  </td>
  <td>&nbsp;</td>
</tr>
</table>
</td></tr>';
echo '<tr><td align="center" colspan="2"><input type="hidden" name="op" value="nfSaveConfig" /><input type="submit" value="'._nF_SAVE.'" /></td></tr>'.chr(10);
echo '</table></form>';
echo '<br />'.chr(10);
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
echo '<tr><td align="center" bgcolor="'.$bgcolor2.'" colspan="2"><strong>'._nF_DISABLEDMODS.'</strong></td></tr>';
echo '<tr><td>&nbsp;</td><td>';
$res = $db->sql_query('SELECT * FROM '.$prefix.'_seo_disabled_modules WHERE `seo_module`="'.$module_name.'"');
while ($i = $db->sql_fetchrow($res))
{
    echo $i['title'].' (<a class="rn_csrf" href="'.$admin_file.'.php?op=nfEnableMod&amp;contentName='.$i['title'].'">'._nF_ENABLE.'</a>)<br />';
}
echo '&nbsp;</td></tr>';
echo '<tr><td>&nbsp;</td><td>';
echo '<form method="post" action="'.$admin_file.'.php?op=nfDisableMod">'.seoHelp('_nF_DISABLE').' '.seoContentList('Select').'<input type="submit" value="'._nF_DISABLE.'" /></form>';
echo '</td></tr></table>';
CloseTable();
?>
