<?php

/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/

if (!defined('MODULE_FILE')) {
	die ('Access Denied');
}

define('RN_GROUPS', true);

$module_name = basename(dirname(__FILE__));
// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043

require_once ('mainfile.php');
require_once ('./modules/'.$module_name.'/includes/nsngr_module_func.php');

get_lang($module_name);

if(!isset($op) || empty($op)) { $op = 'GRDefault'; }
switch ($op) {
	default :
	case 'GRDefault':
		include_once ('modules/'.$module_name.'/public/GRDefault.php');
		break;
	case 'GRInfo':
		include_once ('modules/'.$module_name.'/public/GRInfo.php');
		break;
	case 'GRJoin':
		csrf_check();
		include_once ('modules/'.$module_name.'/public/GRJoin.php');
		break;
}

?>