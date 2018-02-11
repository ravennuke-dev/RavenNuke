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

adminmenu(''.$admin_file.'.php?op=nukeFEED', 'nukeFEED', 'nukeFEED.gif');

?>