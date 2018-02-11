<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}
$module_name = basename(dirname(dirname(__FILE__)));
include_once('modules/'.$module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case 'relatedsave':
    case 'relatededit':
    case 'relateddelete':
    case 'topicsmanager':
    case 'topicedit':
    case 'topicmake':
    case 'topicdelete':
    case 'topicchange':
    include_once('modules/'.$module_name.'/admin/index.php');
    break;

}

?>
