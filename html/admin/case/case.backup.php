<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Save the database of a PHPNuke web site                              */
/*                                                                      */
/* Copyright (c) 2001 by Thomas Rudant (thomas.rudant@grunk.net)        */
/* http://www.grunk.net                                                 */
/* http://www.securite-internet.org                                     */
/*									*/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
switch ($op) {
	case 'backup':
	case 'dobackup':
		include_once('admin/modules/backup.php');
		break;
}
?>