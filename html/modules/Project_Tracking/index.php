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

if(!defined('MODULE_FILE')) {
	die('Illegal Access Detected!!!');
}

$module_name = basename(dirname(__FILE__));

$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
	// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}

define('NSNPJ_PUBLIC', true);

include_once('modules/' . $module_name . '/includes/nsnpj_func.php');

if(empty($op)) {
	$op = 'PJIndex';
}

switch($op) {
	default:
		include('modules/' . $module_name . '/public/PJIndex.php');
		break;
	case 'PJIndex':
		include('modules/' . $module_name . '/public/PJIndex.php');
		break;
	case 'PJProject':
		include('modules/' . $module_name . '/public/PJProject.php');
		break;
	case 'PJReport':
		include('modules/' . $module_name . '/public/PJReport.php');
		break;
	case 'PJReportCommentInsert':
		csrf_check();
		include('modules/' . $module_name . '/public/PJReportCommentInsert.php');
		break;
	case 'PJReportCommentSubmit':
		include('modules/' . $module_name . '/public/PJReportCommentSubmit.php');
		break;
	case 'PJReportInsert':
		csrf_check();
		include('modules/' . $module_name . '/public/PJReportInsert.php');
		break;
	case 'PJReportMap':
		include('modules/' . $module_name . '/public/PJReportMap.php');
		break;
	case 'PJReportSubmit':
		include('modules/' . $module_name . '/public/PJReportSubmit.php');
		break;
	case 'PJRequest':
		include('modules/' . $module_name . '/public/PJRequest.php');
		break;
	case 'PJRequestCommentInsert':
		csrf_check();
		include('modules/' . $module_name . '/public/PJRequestCommentInsert.php');
		break;
	case 'PJRequestCommentSubmit':
		include('modules/' . $module_name . '/public/PJRequestCommentSubmit.php');
		break;
	case 'PJRequestInsert':
		csrf_check();
		include('modules/' . $module_name . '/public/PJRequestInsert.php');
		break;
	case 'PJRequestMap':
		include('modules/' . $module_name . '/public/PJRequestMap.php');
		break;
	case 'PJRequestSubmit':
		include('modules/' . $module_name . '/public/PJRequestSubmit.php');
		break;
	case 'PJTask':
		include('modules/' . $module_name . '/public/PJTask.php');
		break;
	case 'PJTaskMap':
		include('modules/' . $module_name . '/public/PJTaskMap.php');
		break;
}

?>