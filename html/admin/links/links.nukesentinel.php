<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) { header("Location: ../../".$admin_file.".php"); }
if (is_mod_admin('admin') AND defined('NUKESENTINEL_IS_LOADED')) {
    adminmenu($admin_file.'.php?op=ABMain', _AB_TITLELINK, 'nukesentinel.png');
}

?>