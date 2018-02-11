<?php

/***********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net) 			*/
/* http://www.nukescripts.net 						*/
/* Copyright © 2000-2005 by NukeScripts Network 			*/
/***********************************************************/
/*"Iñtërnâtiônàlizætiøn"							*/
/* Project Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright © 2013 by RavenNuke™		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

global $admin_file;

define('NSNPJ_ADMIN', true);
define('INDEX_FILE', true);

$module_name = basename(dirname(dirname(__FILE__)));

include_once 'modules/' . $module_name . '/includes/nsnpj_func.php';

if(is_mod_admin($module_name)) {
	switch ($op) {
		default:
		case 'PJMain':
			include('modules/' . $module_name . '/admin/PJMain.php');
			break;
		case 'PJMemberAdd':
			include('modules/' . $module_name . '/admin/PJMemberAdd.php');
			break;
		case 'PJMemberDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberDelete.php');
			break;
		case 'PJMemberEdit':
			include('modules/' . $module_name . '/admin/PJMemberEdit.php');
			break;
		case 'PJMemberInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberInsert.php');
			break;
		case 'PJMemberList':
			include('modules/' . $module_name . '/admin/PJMemberList.php');
			break;
		case 'PJMemberPositionAdd':
			include('modules/' . $module_name . '/admin/PJMemberPositionAdd.php');
			break;
		case 'PJMemberPositionDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberPositionDelete.php');
			break;
		case 'PJMemberPositionEdit':
			include('modules/' . $module_name . '/admin/PJMemberPositionEdit.php');
			break;
		case 'PJMemberPositionFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberPositionFix.php');
			break;
		case 'PJMemberPositionInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberPositionInsert.php');
			break;
		case 'PJMemberPositionList':
			include('modules/' . $module_name . '/admin/PJMemberPositionList.php');
			break;
		case 'PJMemberPositionOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberPositionOrder.php');
			break;
		case 'PJMemberPositionRemove':
			include('modules/' . $module_name . '/admin/PJMemberPositionRemove.php');
			break;
		case 'PJMemberPositionUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberPositionUpdate.php');
			break;
		case 'PJMemberRemove':
			include('modules/' . $module_name . '/admin/PJMemberRemove.php');
			break;
		case 'PJMemberUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJMemberUpdate.php');
			break;
		case 'PJProjectAdd':
			include('modules/' . $module_name . '/admin/PJProjectAdd.php');
			break;
		case 'PJProjectConfig':
			include('modules/' . $module_name . '/admin/PJProjectConfig.php');
			break;
		case 'PJProjectConfigUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectConfigUpdate.php');
			break;
		case 'PJProjectDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectDelete.php');
			break;
		case 'PJProjectEdit':
			include('modules/' . $module_name . '/admin/PJProjectEdit.php');
			break;
		case 'PJProjectFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectFix.php');
			break;
		case 'PJProjectInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectInsert.php');
			break;
		case 'PJProjectList':
			include('modules/' . $module_name . '/admin/PJProjectList.php');
			break;
		case 'PJProjectMembers':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectMembers.php');
			break;
		case 'PJProjectOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectOrder.php');
			break;
		case 'PJProjectPriorityAdd':
			include('modules/' . $module_name . '/admin/PJProjectPriorityAdd.php');
			break;
		case 'PJProjectPriorityDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectPriorityDelete.php');
			break;
		case 'PJProjectPriorityEdit':
			include('modules/' . $module_name . '/admin/PJProjectPriorityEdit.php');
			break;
		case 'PJProjectPriorityFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectPriorityFix.php');
			break;
		case 'PJProjectPriorityInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectPriorityInsert.php');
			break;
		case 'PJProjectPriorityList':
			include('modules/' . $module_name . '/admin/PJProjectPriorityList.php');
			break;
		case 'PJProjectPriorityOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectPriorityOrder.php');
			break;
		case 'PJProjectPriorityRemove':
			include('modules/' . $module_name . '/admin/PJProjectPriorityRemove.php');
			break;
		case 'PJProjectPriorityUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectPriorityUpdate.php');
			break;
		case 'PJProjectRemove':
			include('modules/' . $module_name . '/admin/PJProjectRemove.php');
			break;
		case 'PJProjectReports':
			include('modules/' . $module_name . '/admin/PJProjectReports.php');
			break;
		case 'PJProjectRequests':
			include('modules/' . $module_name . '/admin/PJProjectRequests.php');
			break;
		case 'PJProjectStatusAdd':
			include('modules/' . $module_name . '/admin/PJProjectStatusAdd.php');
			break;
		case 'PJProjectStatusDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectStatusDelete.php');
			break;
		case 'PJProjectStatusEdit':
			include('modules/' . $module_name . '/admin/PJProjectStatusEdit.php');
			break;
		case 'PJProjectStatusFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectStatusFix.php');
			break;
		case 'PJProjectStatusInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectStatusInsert.php');
			break;
		case 'PJProjectStatusList':
			include('modules/' . $module_name . '/admin/PJProjectStatusList.php');
			break;
		case 'PJProjectStatusOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectStatusOrder.php');
			break;
		case 'PJProjectStatusRemove':
			include('modules/' . $module_name . '/admin/PJProjectStatusRemove.php');
			break;
		case 'PJProjectStatusUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectStatusUpdate.php');
			break;
		case 'PJProjectTasks':
			include('modules/' . $module_name . '/admin/PJProjectTasks.php');
			break;
		case 'PJProjectUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJProjectUpdate.php');
			break;
		case 'PJReportCommentDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportCommentDelete.php');
			break;
		case 'PJReportCommentEdit':
			include('modules/' . $module_name . '/admin/PJReportCommentEdit.php');
			break;
		case 'PJReportCommentRemove':
			include('modules/' . $module_name . '/admin/PJReportCommentRemove.php');
			break;
		case 'PJReportCommentUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportCommentUpdate.php');
			break;
		case 'PJReportConfig':
			include('modules/' . $module_name . '/admin/PJReportConfig.php');
			break;
		case 'PJReportConfigUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportConfigUpdate.php');
			break;
		case 'PJReportDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportDelete.php');
			break;
		case 'PJReportEdit':
			include('modules/' . $module_name . '/admin/PJReportEdit.php');
			break;
		case 'PJReportImport':
			include('modules/' . $module_name . '/admin/PJReportImport.php');
			break;
		case 'PJReportImportInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportImportInsert.php');
			break;
		case 'PJReportList':
			include('modules/' . $module_name . '/admin/PJReportList.php');
			break;
		case 'PJReportMembers':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportMembers.php');
			break;
		case 'PJReportPrint':
			include('modules/' . $module_name . '/admin/PJReportPrint.php');
			break;
		case 'PJReportRemove':
			include('modules/' . $module_name . '/admin/PJReportRemove.php');
			break;
		case 'PJReportStatusAdd':
			include('modules/' . $module_name . '/admin/PJReportStatusAdd.php');
			break;
		case 'PJReportStatusDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportStatusDelete.php');
			break;
		case 'PJReportStatusEdit':
			include('modules/' . $module_name . '/admin/PJReportStatusEdit.php');
			break;
		case 'PJReportStatusFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportStatusFix.php');
			break;
		case 'PJReportStatusInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportStatusInsert.php');
			break;
		case 'PJReportStatusList':
			include('modules/' . $module_name . '/admin/PJReportStatusList.php');
			break;
		case 'PJReportStatusOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportStatusOrder.php');
			break;
		case 'PJReportStatusRemove':
			include('modules/' . $module_name . '/admin/PJReportStatusRemove.php');
			break;
		case 'PJReportStatusUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportStatusUpdate.php');
			break;
		case 'PJReportTypeAdd':
			include('modules/' . $module_name . '/admin/PJReportTypeAdd.php');
			break;
		case 'PJReportTypeDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportTypeDelete.php');
			break;
		case 'PJReportTypeEdit':
			include('modules/' . $module_name . '/admin/PJReportTypeEdit.php');
			break;
		case 'PJReportTypeFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportTypeFix.php');
			break;
		case 'PJReportTypeInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportTypeInsert.php');
			break;
		case 'PJReportTypeList':
			include('modules/' . $module_name . '/admin/PJReportTypeList.php');
			break;
		case 'PJReportTypeOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportTypeOrder.php');
			break;
		case 'PJReportTypeRemove':
			include('modules/' . $module_name . '/admin/PJReportTypeRemove.php');
			break;
		case 'PJReportTypeUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportTypeUpdate.php');
			break;
		case 'PJReportUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJReportUpdate.php');
			break;
		case 'PJRequestCommentDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestCommentDelete.php');
			break;
		case 'PJRequestCommentEdit':
			include('modules/' . $module_name . '/admin/PJRequestCommentEdit.php');
			break;
		case 'PJRequestCommentRemove':
			include('modules/' . $module_name . '/admin/PJRequestCommentRemove.php');
			break;
		case 'PJRequestCommentUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestCommentUpdate.php');
			break;
		case 'PJRequestConfig':
			include('modules/' . $module_name . '/admin/PJRequestConfig.php');
			break;
		case 'PJRequestConfigUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestConfigUpdate.php');
			break;
		case 'PJRequestDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestDelete.php');
			break;
		case 'PJRequestEdit':
			include('modules/' . $module_name . '/admin/PJRequestEdit.php');
			break;
		case 'PJRequestImport':
			include('modules/' . $module_name . '/admin/PJRequestImport.php');
			break;
		case 'PJRequestImportInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestImportInsert.php');
			break;
		case 'PJRequestList':
			include('modules/' . $module_name . '/admin/PJRequestList.php');
			break;
		case 'PJRequestMembers':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestMembers.php');
			break;
		case 'PJRequestPrint':
			include('modules/' . $module_name . '/admin/PJRequestPrint.php');
			break;
		case 'PJRequestRemove':
			include('modules/' . $module_name . '/admin/PJRequestRemove.php');
			break;
		case 'PJRequestStatusAdd':
			include('modules/' . $module_name . '/admin/PJRequestStatusAdd.php');
			break;
		case 'PJRequestStatusDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestStatusDelete.php');
			break;
		case 'PJRequestStatusEdit':
			include('modules/' . $module_name . '/admin/PJRequestStatusEdit.php');
			break;
		case 'PJRequestStatusFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestStatusFix.php');
			break;
		case 'PJRequestStatusInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestStatusInsert.php');
			reak;
		case 'PJRequestStatusList':
			include('modules/' . $module_name . '/admin/PJRequestStatusList.php');
			break;
		case 'PJRequestStatusOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestStatusOrder.php');
			break;
		case 'PJRequestStatusRemove':
			include('modules/' . $module_name . '/admin/PJRequestStatusRemove.php');
			break;
		case 'PJRequestStatusUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestStatusUpdate.php');
			break;
		case 'PJRequestTypeAdd':
			include('modules/' . $module_name . '/admin/PJRequestTypeAdd.php');
			break;
		case 'PJRequestTypeDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestTypeDelete.php');
			break;
		case 'PJRequestTypeEdit':
			include('modules/' . $module_name . '/admin/PJRequestTypeEdit.php');
			break;
		case 'PJRequestTypeFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestTypeFix.php');
			break;
		case 'PJRequestTypeInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestTypeInsert.php');
			break;
		case 'PJRequestTypeList':
			include('modules/' . $module_name . '/admin/PJRequestTypeList.php');
			break;
		case 'PJRequestTypeOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestTypeOrder.php');
			break;
		case 'PJRequestTypeRemove':
			include('modules/' . $module_name . '/admin/PJRequestTypeRemove.php');
			break;
		case 'PJRequestTypeUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestTypeUpdate.php');
			break;
		case 'PJRequestUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJRequestUpdate.php');
			break;
		case 'PJTaskAdd':
			include('modules/' . $module_name . '/admin/PJTaskAdd.php');
			break;
		case 'PJTaskConfig':
			include('modules/' . $module_name . '/admin/PJTaskConfig.php');
			break;
		case 'PJTaskConfigUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskConfigUpdate.php');
			break;
		case 'PJTaskDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskDelete.php');
			break;
		case 'PJTaskEdit':
			include('modules/' . $module_name . '/admin/PJTaskEdit.php');
			break;
		case 'PJTaskInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskInsert.php');
			break;
		case 'PJTaskList':
			include('modules/' . $module_name . '/admin/PJTaskList.php');
			break;
		case 'PJTaskMembers':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskMembers.php');
			break;
		case 'PJTaskPriorityAdd':
			include('modules/' . $module_name . '/admin/PJTaskPriorityAdd.php');
			break;
		case 'PJTaskPriorityDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskPriorityDelete.php');
			break;
		case 'PJTaskPriorityEdit':
			include('modules/' . $module_name . '/admin/PJTaskPriorityEdit.php');
			break;
		case 'PJTaskPriorityFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskPriorityFix.php');
			break;
		case 'PJTaskPriorityInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskPriorityInsert.php');
			break;
		case 'PJTaskPriorityList':
			include('modules/' . $module_name . '/admin/PJTaskPriorityList.php');
			break;
		case 'PJTaskPriorityOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskPriorityOrder.php');
			break;
		case 'PJTaskPriorityRemove':
			include('modules/' . $module_name . '/admin/PJTaskPriorityRemove.php');
			break;
		case 'PJTaskPriorityUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskPriorityUpdate.php');
			break;
		case 'PJTaskRemove':
			include('modules/' . $module_name . '/admin/PJTaskRemove.php');
			break;
		case 'PJTaskStatusAdd':
			include('modules/' . $module_name . '/admin/PJTaskStatusAdd.php');
			break;
		case 'PJTaskStatusDelete':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskStatusDelete.php');
			break;
		case 'PJTaskStatusEdit':
			include('modules/' . $module_name . '/admin/PJTaskStatusEdit.php');
			break;
		case 'PJTaskStatusFix':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskStatusFix.php');
			break;
		case 'PJTaskStatusInsert':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskStatusInsert.php');
			break;
		case 'PJTaskStatusList':
			include('modules/' . $module_name . '/admin/PJTaskStatusList.php');
			break;
		case 'PJTaskStatusOrder':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskStatusOrder.php');
			break;
		case 'PJTaskStatusRemove':
			include('modules/' . $module_name . '/admin/PJTaskStatusRemove.php');
			break;
		case 'PJTaskStatusUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskStatusUpdate.php');
			break;
		case 'PJTaskUpdate':
			csrf_check();
			include('modules/' . $module_name . '/admin/PJTaskUpdate.php');
			break;
	}
} else {
	echo 'You can not access this section';
}

?>