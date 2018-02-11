<?php
/***************************************************************************
 *                              admin_phpinfo.php
 *                            -------------------
 *   begin                : Monday, December 20, 2004
 *   copyright            : (C) 2004 Boreallis.ca
 *   Version              : 1.0.0
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['PHP']['phpInfo'] = "$file";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

phpinfo();

include('./page_footer_admin.'.$phpEx);

?>