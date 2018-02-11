<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
switch ($op) {
	case 'RemoveComment':
	case 'removeSubComments':
	case 'removePollSubComments':
	case 'RemovePollComment':
		include_once('admin/modules/comments.php');
		break;
}
?>