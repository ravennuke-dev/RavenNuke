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

global $admin_file, $db, $prefix;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
    Header('Location: ../../../'.$admin_file.'.php');
    die();
}

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {

  // Module Definition
  include_once('includes/nukeSEO/seocontent.class.php');
  include_once('includes/nukeSEO/nukeFEED.php');
  seoCheckInstall();
  // Header stuff:

  $pagetitle = ' - '._nF_ADMIN;
  include('header.php');
  $checktime = strtotime(date("Y-m-d", TIME()));
  $seoModule = 'Feeds';
  $seoConfig = seoGetConfigs($seoModule);
  $nFVersion = $seoConfig['version_newest'];
  $nFVerURL = $seoConfig['version_url'];
  $nFVerNotes = $seoConfig['version_notes'];
  if (nf_ENABLEUPDATECHECK) {
  if($seoConfig['version_check'] < $checktime) {
    $versionInfo = seoGetCurrentVersion('nukeFEED', 0);
    $nFVersion  = $versionInfo['version'];
    $nFVerURL   = $versionInfo['url'];
    $nFVerNotes = addslashes($versionInfo['notes']);
    seoSaveConfig($seoModule, 'version_check', $checktime);
    seoSaveConfig($seoModule, 'version_newest', $nFVersion);
    seoSaveConfig($seoModule, 'version_url', $nFVerURL);
    seoSaveConfig($seoModule, 'version_notes', $nFVerNotes);
  }
  if ($nFVersion > $seoConfig['version_number']) {  
    $seoVersionHTML = seoPopUp(_nF_NEWVER.' - '.$nFVersion, $nFVerNotes).' <strong>'._nF_NEWVER.' - <a href="'.htmlentities($nFVerURL).'" title="'._nF_GETNEWVER.$nFVersion.'">'.$nFVersion.'</a></strong>';
  } else {
    $seoVersionHTML = '<span class="italic">'._nF_CURVER.'</span>';
  }
  } else {
    $seoVersionHTML = '';
  }
  OpenTable();
  echo '<div class="text-center"><h2>'._nukeFEED.' '.$seoConfig['version_number'].'</h2>'.$seoVersionHTML.'</div>
        <table width="100%" border="0">';
  echo '<tr>
          <td>'.seoHelp('_nF_CONFIG').' <a href="'.$admin_file.'.php?op=nfConfigMod">'._nF_CONFIG.'</a></td>
          <td>'.seoHelp('_nF_ADMIN').' <a href="'.$admin_file.'.php?op=nukeFEED">'._nF_ADMIN.'</a></td>
          <td>'.seoHelp('_nF_AGGREGATORS').' <a href="'.$admin_file.'.php?op=nfEditSubscript">'._nF_AGGREGATORS.'</a></td>
          <td>'.seoHelp('_nF_SITEADMIN').' <a href="'.$admin_file.'.php">'._nF_SITEADMIN.'</a></td>
        </tr></table>';
	CloseTable();
	OpenTable();

	switch ($_REQUEST['op']) {
		case 'nukeFEED':
		case 'nfEditFeed':
			include('modules/'.$module_name.'/admin/nukeFeedAdmin.php');
			break;
		case 'nfSaveFeed':
		case 'nfDeleteFeed':
		case 'nfDeleteConfirm':
			csrf_check();
			include('modules/'.$module_name.'/admin/nukeFeedAdmin.php');
			break;
		case 'nfConfigMod':
			include('modules/'.$module_name.'/admin/nfConfig.php');
			break;
		case 'nfSaveConfig':
		case 'nfDisableMod':
		case 'nfEnableMod':
			csrf_check();
			include('modules/'.$module_name.'/admin/nfConfig.php');
			break;
		case 'nfEditSubscript':
			include('modules/'.$module_name.'/admin/nfSubscriptions.php');
			break;
		case 'nfDelSubscript':
		case 'nfSaveSubscript':
			csrf_check();
			include('modules/'.$module_name.'/admin/nfSubscriptions.php');
			break;
	}
} else {
	include('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">'._ERROR.'</span><br /><br />'.$module_name.'</div>';
}

CloseTable();
include('footer.php');

?>