<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

switch ($op) {
	case 'NSNGroups':
	case 'NSNGroupsAdd':
	case 'NSNGroupsAddSave':
	case 'NSNGroupsConfig':
	case 'NSNGroupsConfigSave':
	case 'NSNGroupsDelete':
	case 'NSNGroupsDeleteConf':
	case 'NSNGroupsEdit':
	case 'NSNGroupsEditSave':
	case 'NSNGroupsEmpty':
	case 'NSNGroupsEmptyConf':
	case 'NSNGroupsUsersAdd':
	case 'NSNGroupsUsersAddSave':
	case 'NSNGroupsUsersDelete':
	case 'NSNGroupsUsersDeleteConf':
	case 'NSNGroupsUsersEmail':
	case 'NSNGroupsUsersEmailSend':
	case 'NSNGroupsUsersExpire':
	case 'NSNGroupsUsersExpireDone':
	case 'NSNGroupsUsersExpireSave':
	case 'NSNGroupsUsersMove':
	case 'NSNGroupsUsersMoveSave':
	case 'NSNGroupsUsersUpdate':
	case 'NSNGroupsUsersUpdateSave':
	case 'NSNGroupsUsersView':
	case 'NSNGroupsView':
	case 'NSNGroupsMemberships':
		include_once('modules/Groups/admin/index.php');
		break;
}
?>