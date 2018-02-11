<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

@set_time_limit(600);
//@ini_set('display_errors', 1);
//@ini_set('error_reporting', E_WARNING);
if($ab_config['show_right'] == 1) {
  $index = 1;
  define('INDEX_FILE', TRUE);
}
$advanced_editor = 0;
define('NO_EDITOR', TRUE);
define('NUKESENTINEL_ADMIN', TRUE);
global $admin_file, $dbname;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { header("Location: ../../".$admin_file.".php"); }
if(!defined('NUKESENTINEL_IS_LOADED')) { $op = 'ABLoadError'; }
include('admin/modules/nukesentinel/functions.php');
if (is_mod_admin('admin')) {
  switch ($op) {
    case 'ABAuth':include('admin/modules/nukesentinel/ABAuth.php');break;
    case 'ABAuthEdit':include('admin/modules/nukesentinel/ABAuthEdit.php');break;
    case 'ABAuthEditSave':csrf_check();include('admin/modules/nukesentinel/ABAuthEditSave.php');break;
    case 'ABAuthList':include('admin/modules/nukesentinel/ABAuthList.php');break;
    case 'ABAuthResend':csrf_check();include('admin/modules/nukesentinel/ABAuthResend.php');break;
    case 'ABAuthScan':csrf_check();include('admin/modules/nukesentinel/ABAuthScan.php');break;
    case 'ABBlockedIPAdd':include('admin/modules/nukesentinel/ABBlockedIPAdd.php');break;
    case 'ABBlockedIPAddSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedIPAddSave.php');break;
    case 'ABBlockedIPClear':include('admin/modules/nukesentinel/ABBlockedIPClear.php');break;
    case 'ABBlockedIPClearExpired':csrf_check();include('admin/modules/nukesentinel/ABBlockedIPClearExpired.php');break;
    case 'ABBlockedIPClearSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedIPClearSave.php');break;
    case 'ABBlockedIPDelete':include('admin/modules/nukesentinel/ABBlockedIPDelete.php');break;
    case 'ABBlockedIPDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedIPDeleteSave.php');break;
    case 'ABBlockedIPEdit':include('admin/modules/nukesentinel/ABBlockedIPEdit.php');break;
    case 'ABBlockedIPEditSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedIPEditSave.php');break;
    case 'ABBlockedIPList':include('admin/modules/nukesentinel/ABBlockedIPList.php');break;
    case 'ABBlockedIPListPrint':include('admin/modules/nukesentinel/ABBlockedIPListPrint.php');break;
    case 'ABBlockedIPMenu':include('admin/modules/nukesentinel/ABBlockedIPMenu.php');break;
    case 'ABBlockedIPView':include('admin/modules/nukesentinel/ABBlockedIPView.php');break;
    case 'ABBlockedIPViewPrint':include('admin/modules/nukesentinel/ABBlockedIPViewPrint.php');break;
    case 'ABBlockedRangeAdd':include('admin/modules/nukesentinel/ABBlockedRangeAdd.php');break;
    case 'ABBlockedRangeAddSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedRangeAddSave.php');break;
    case 'ABBlockedRangeClear':include('admin/modules/nukesentinel/ABBlockedRangeClear.php');break;
    case 'ABBlockedRangeClearExpired':csrf_check();include('admin/modules/nukesentinel/ABBlockedRangeClearExpired.php');break;
    case 'ABBlockedRangeClearSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedRangeClearSave.php');break;
    case 'ABBlockedRangeDelete':include('admin/modules/nukesentinel/ABBlockedRangeDelete.php');break;
    case 'ABBlockedRangeDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedRangeDeleteSave.php');break;
    case 'ABBlockedRangeEdit':include('admin/modules/nukesentinel/ABBlockedRangeEdit.php');break;
    case 'ABBlockedRangeEditSave':csrf_check();include('admin/modules/nukesentinel/ABBlockedRangeEditSave.php');break;
    case 'ABBlockedRangeList':include('admin/modules/nukesentinel/ABBlockedRangeList.php');break;
    case 'ABBlockedRangeListPrint':include('admin/modules/nukesentinel/ABBlockedRangeListPrint.php');break;
    case 'ABBlockedRangeMenu':include('admin/modules/nukesentinel/ABBlockedRangeMenu.php');break;
    case 'ABBlockedRangeOverlapCheck':include('admin/modules/nukesentinel/ABBlockedRangeOverlapCheck.php');break;
    case 'ABBlockedRangeView':include('admin/modules/nukesentinel/ABBlockedRangeView.php');break;
    case 'ABBlockedRangeViewPrint':include('admin/modules/nukesentinel/ABBlockedRangeViewPrint.php');break;
    case 'ABCGIAuth':include('admin/modules/nukesentinel/ABCGIAuth.php');break;
    case 'ABCGIBuild':include('admin/modules/nukesentinel/ABCGIBuild.php');break;
    case 'ABConfig':include('admin/modules/nukesentinel/ABConfig.php');break;
    case 'ABConfigAdmin':include('admin/modules/nukesentinel/ABConfigAdmin.php');break;
    case 'ABConfigAuthor':include('admin/modules/nukesentinel/ABConfigAuthor.php');break;
    case 'ABConfigClike':include('admin/modules/nukesentinel/ABConfigClike.php');break;
    case 'ABConfigDefault':include('admin/modules/nukesentinel/ABConfigDefault.php');break;
    case 'ABConfigFilter':include('admin/modules/nukesentinel/ABConfigFilter.php');break;
    case 'ABConfigFlood':include('admin/modules/nukesentinel/ABConfigFlood.php');break;
    case 'ABConfigHarvester':include('admin/modules/nukesentinel/ABConfigHarvester.php');break;
    case 'ABConfigReferer':include('admin/modules/nukesentinel/ABConfigReferer.php');break;
    case 'ABConfigRequest':include('admin/modules/nukesentinel/ABConfigRequest.php');break;
    case 'ABConfigSave':csrf_check();include('admin/modules/nukesentinel/ABConfigSave.php');break;
    case 'ABConfigScript':include('admin/modules/nukesentinel/ABConfigScript.php');break;
    case 'ABConfigString':include('admin/modules/nukesentinel/ABConfigString.php');break;
    case 'ABConfigUnion':include('admin/modules/nukesentinel/ABConfigUnion.php');break;
    case 'ABConfigUpdate':csrf_check();include('admin/modules/nukesentinel/ABConfigUpdate.php');break;
    case 'ABCountryList':include('admin/modules/nukesentinel/ABCountryList.php');break;
    case 'ABDBMaintenance':include('admin/modules/nukesentinel/ABDBMaintenance.php');break;
    case 'ABDBOptimize':csrf_check();include('admin/modules/nukesentinel/ABDBOptimize.php');break;
    case 'ABDBRepair':csrf_check();include('admin/modules/nukesentinel/ABDBRepair.php');break;
    case 'ABDBStructure':csrf_check();include('admin/modules/nukesentinel/ABDBStructure.php');break;
    case 'ABExcludedAdd':include('admin/modules/nukesentinel/ABExcludedAdd.php');break;
    case 'ABExcludedAddSave':csrf_check();include('admin/modules/nukesentinel/ABExcludedAddSave.php');break;
    case 'ABExcludedClear':include('admin/modules/nukesentinel/ABExcludedClear.php');break;
    case 'ABExcludedClearSave':csrf_check();include('admin/modules/nukesentinel/ABExcludedClearSave.php');break;
    case 'ABExcludedDelete':include('admin/modules/nukesentinel/ABExcludedDelete.php');break;
    case 'ABExcludedDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABExcludedDeleteSave.php');break;
    case 'ABExcludedEdit':include('admin/modules/nukesentinel/ABExcludedEdit.php');break;
    case 'ABExcludedEditSave':csrf_check();include('admin/modules/nukesentinel/ABExcludedEditSave.php');break;
    case 'ABExcludedList':include('admin/modules/nukesentinel/ABExcludedList.php');break;
    case 'ABExcludedListPrint':include('admin/modules/nukesentinel/ABExcludedListPrint.php');break;
    case 'ABExcludedMenu':include('admin/modules/nukesentinel/ABExcludedMenu.php');break;
    case 'ABExcludedOverlapCheck':include('admin/modules/nukesentinel/ABExcludedOverlapCheck.php');break;
    case 'ABExcludedView':include('admin/modules/nukesentinel/ABExcludedView.php');break;
    case 'ABExcludedViewPrint':include('admin/modules/nukesentinel/ABExcludedViewPrint.php');break;
    case 'ABHarvesterAdd':include('admin/modules/nukesentinel/ABHarvesterAdd.php');break;
    case 'ABHarvesterAddSave':csrf_check();include('admin/modules/nukesentinel/ABHarvesterAddSave.php');break;
    case 'ABHarvesterDelete':include('admin/modules/nukesentinel/ABHarvesterDelete.php');break;
    case 'ABHarvesterDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABHarvesterDeleteSave.php');break;
    case 'ABHarvesterEdit':include('admin/modules/nukesentinel/ABHarvesterEdit.php');break;
    case 'ABHarvesterEditSave':csrf_check();include('admin/modules/nukesentinel/ABHarvesterEditSave.php');break;
    case 'ABHarvesterList':include('admin/modules/nukesentinel/ABHarvesterList.php');break;
    case 'ABHarvesterListPrint':include('admin/modules/nukesentinel/ABHarvesterListPrint.php');break;
    case 'ABHarvesterMenu':include('admin/modules/nukesentinel/ABHarvesterMenu.php');break;
    case 'ABIP2CountryAdd':include('admin/modules/nukesentinel/ABIP2CountryAdd.php');break;
    case 'ABIP2CountryAddSave':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryAddSave.php');break;
    case 'ABIP2CountryDelete':include('admin/modules/nukesentinel/ABIP2CountryDelete.php');break;
    case 'ABIP2CountryDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryDeleteSave.php');break;
    case 'ABIP2CountryEdit':include('admin/modules/nukesentinel/ABIP2CountryEdit.php');break;
    case 'ABIP2CountryEditSave':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryEditSave.php');break;
    case 'ABIP2CountryList':include('admin/modules/nukesentinel/ABIP2CountryList.php');break;
    case 'ABIP2CountryMenu':include('admin/modules/nukesentinel/ABIP2CountryMenu.php');break;
    case 'ABIP2CountryOverlapCheck':include('admin/modules/nukesentinel/ABIP2CountryOverlapCheck.php');break;
    case 'ABIP2CountryUpdateBlocked':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryUpdateBlocked.php');break;
    case 'ABIP2CountryUpdateBlockedRanges':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryUpdateBlockedRanges.php');break;
    case 'ABIP2CountryUpdateExcludedRanges':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryUpdateExcludedRanges.php');break;
    case 'ABIP2CountryUpdateProtectedRanges':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryUpdateProtectedRanges.php');break;
    case 'ABIP2CountryUpdateTracked':csrf_check();include('admin/modules/nukesentinel/ABIP2CountryUpdateTracked.php');break;
    case 'ABLoadError':include('admin/modules/nukesentinel/ABLoadError.php');break;
    case 'ABMain':include('admin/modules/nukesentinel/ABMain.php');break;
    case 'ABMainSave':csrf_check();include('admin/modules/nukesentinel/ABMainSave.php');break;
    case 'ABProtectedAdd':include('admin/modules/nukesentinel/ABProtectedAdd.php');break;
    case 'ABProtectedAddSave':csrf_check();include('admin/modules/nukesentinel/ABProtectedAddSave.php');break;
    case 'ABProtectedClear':include('admin/modules/nukesentinel/ABProtectedClear.php');break;
    case 'ABProtectedClearSave':csrf_check();include('admin/modules/nukesentinel/ABProtectedClearSave.php');break;
    case 'ABProtectedDelete':include('admin/modules/nukesentinel/ABProtectedDelete.php');break;
    case 'ABProtectedDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABProtectedDeleteSave.php');break;
    case 'ABProtectedEdit':include('admin/modules/nukesentinel/ABProtectedEdit.php');break;
    case 'ABProtectedEditSave':csrf_check();include('admin/modules/nukesentinel/ABProtectedEditSave.php');break;
    case 'ABProtectedList':include('admin/modules/nukesentinel/ABProtectedList.php');break;
    case 'ABProtectedListPrint':include('admin/modules/nukesentinel/ABProtectedListPrint.php');break;
    case 'ABProtectedMenu':include('admin/modules/nukesentinel/ABProtectedMenu.php');break;
    case 'ABProtectedOverlapCheck':include('admin/modules/nukesentinel/ABProtectedOverlapCheck.php');break;
    case 'ABProtectedView':include('admin/modules/nukesentinel/ABProtectedView.php');break;
    case 'ABProtectedViewPrint':include('admin/modules/nukesentinel/ABProtectedViewPrint.php');break;
    case 'ABRefererAdd':include('admin/modules/nukesentinel/ABRefererAdd.php');break;
    case 'ABRefererAddSave':csrf_check();include('admin/modules/nukesentinel/ABRefererAddSave.php');break;
    case 'ABRefererDelete':include('admin/modules/nukesentinel/ABRefererDelete.php');break;
    case 'ABRefererDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABRefererDeleteSave.php');break;
    case 'ABRefererEdit':include('admin/modules/nukesentinel/ABRefererEdit.php');break;
    case 'ABRefererEditSave':csrf_check();include('admin/modules/nukesentinel/ABRefererEditSave.php');break;
    case 'ABRefererList':include('admin/modules/nukesentinel/ABRefererList.php');break;
    case 'ABRefererListPrint':include('admin/modules/nukesentinel/ABRefererListPrint.php');break;
    case 'ABRefererMenu':include('admin/modules/nukesentinel/ABRefererMenu.php');break;
    case 'ABSearch':include('admin/modules/nukesentinel/ABSearch.php');break;
    case 'ABSearchIPPrint':include('admin/modules/nukesentinel/ABSearchIPPrint.php');break;
    case 'ABSearchIPResults':include('admin/modules/nukesentinel/ABSearchIPResults.php');break;
    case 'ABSearchRangePrint':include('admin/modules/nukesentinel/ABSearchRangePrint.php');break;
    case 'ABSearchRangeResults':include('admin/modules/nukesentinel/ABSearchRangeResults.php');break;
    case 'ABStringAdd':include('admin/modules/nukesentinel/ABStringAdd.php');break;
    case 'ABStringAddSave':csrf_check();include('admin/modules/nukesentinel/ABStringAddSave.php');break;
    case 'ABStringDelete':include('admin/modules/nukesentinel/ABStringDelete.php');break;
    case 'ABStringDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABStringDeleteSave.php');break;
    case 'ABStringEdit':include('admin/modules/nukesentinel/ABStringEdit.php');break;
    case 'ABStringEditSave':csrf_check();include('admin/modules/nukesentinel/ABStringEditSave.php');break;
    case 'ABStringList':include('admin/modules/nukesentinel/ABStringList.php');break;
    case 'ABStringListPrint':include('admin/modules/nukesentinel/ABStringListPrint.php');break;
    case 'ABStringMenu':include('admin/modules/nukesentinel/ABStringMenu.php');break;
    case 'ABTemplate':include('admin/modules/nukesentinel/ABTemplate.php');break;
    case 'ABTemplateSource':include('admin/modules/nukesentinel/ABTemplateSource.php');break;
    case 'ABTemplateView':include('admin/modules/nukesentinel/ABTemplateView.php');break;
    case 'ABTrackedAdd':include('admin/modules/nukesentinel/ABTrackedAdd.php');break;
    case 'ABTrackedAddSave':csrf_check();include('admin/modules/nukesentinel/ABTrackedAddSave.php');break;
    case 'ABTrackedAgentsList':include('admin/modules/nukesentinel/ABTrackedAgentsList.php');break;
    case 'ABTrackedAgentsDelete':csrf_check();include('admin/modules/nukesentinel/ABTrackedAgentsDelete.php');break;
    case 'ABTrackedAgentsIPs':include('admin/modules/nukesentinel/ABTrackedAgentsIPs.php');break;
    case 'ABTrackedAgentsListAdd':include('admin/modules/nukesentinel/ABTrackedAgentsListAdd.php');break;
    case 'ABTrackedAgentsListAddSave':csrf_check();include('admin/modules/nukesentinel/ABTrackedAgentsListAddSave.php');break;
    case 'ABTrackedAgentsListPrint':include('admin/modules/nukesentinel/ABTrackedAgentsListPrint.php');break;
    case 'ABTrackedAgentsPages':include('admin/modules/nukesentinel/ABTrackedAgentsPages.php');break;
    case 'ABTrackedAgentsPagesPrint':include('admin/modules/nukesentinel/ABTrackedAgentsPagesPrint.php');break;
    case 'ABTrackedClear':include('admin/modules/nukesentinel/ABTrackedClear.php');break;
    case 'ABTrackedClearSave':csrf_check();include('admin/modules/nukesentinel/ABTrackedClearSave.php');break;
    case 'ABTrackedDelete':include('admin/modules/nukesentinel/ABTrackedDelete.php');break;
    case 'ABTrackedDeleteSave':csrf_check();include('admin/modules/nukesentinel/ABTrackedDeleteSave.php');break;
    case 'ABTrackedList':include('admin/modules/nukesentinel/ABTrackedList.php');break;
    case 'ABTrackedListPrint':include('admin/modules/nukesentinel/ABTrackedListPrint.php');break;
    case 'ABTrackedMenu':include('admin/modules/nukesentinel/ABTrackedMenu.php');break;
    case 'ABTrackedPages':include('admin/modules/nukesentinel/ABTrackedPages.php');break;
    case 'ABTrackedPagesPrint':include('admin/modules/nukesentinel/ABTrackedPagesPrint.php');break;
    case 'ABTrackedRefersList':include('admin/modules/nukesentinel/ABTrackedRefersList.php');break;
    case 'ABTrackedRefersDelete':csrf_check();include('admin/modules/nukesentinel/ABTrackedRefersDelete.php');break;
    case 'ABTrackedRefersIPs':include('admin/modules/nukesentinel/ABTrackedRefersIPs.php');break;
    case 'ABTrackedRefersListAdd':include('admin/modules/nukesentinel/ABTrackedRefersListAdd.php');break;
    case 'ABTrackedRefersListAddSave':csrf_check();include('admin/modules/nukesentinel/ABTrackedRefersListAddSave.php');break;
    case 'ABTrackedRefersListPrint':include('admin/modules/nukesentinel/ABTrackedRefersListPrint.php');break;
    case 'ABTrackedRefersPages':include('admin/modules/nukesentinel/ABTrackedRefersPages.php');break;
    case 'ABTrackedRefersPagesPrint':include('admin/modules/nukesentinel/ABTrackedRefersPagesPrint.php');break;
    case 'ABTrackedUsersList':include('admin/modules/nukesentinel/ABTrackedUsersList.php');break;
    case 'ABTrackedUsersDelete':csrf_check();include('admin/modules/nukesentinel/ABTrackedUsersDelete.php');break;
    case 'ABTrackedUsersIPs':include('admin/modules/nukesentinel/ABTrackedUsersIPs.php');break;
    case 'ABTrackedUsersListPrint':include('admin/modules/nukesentinel/ABTrackedUsersListPrint.php');break;
    case 'ABTrackedUsersPages':include('admin/modules/nukesentinel/ABTrackedUsersPages.php');break;
    case 'ABTrackedUsersPagesPrint':include('admin/modules/nukesentinel/ABTrackedUsersPagesPrint.php');break;
  }
} else {
  echo "Access Denied";
}

?>