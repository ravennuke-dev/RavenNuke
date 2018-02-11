<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 */
global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
	Header('Location: ../../../'.$admin_file.'.php');
	die();
}
if (empty($check_username)) $check_username = '';
if (empty($check_email)) $check_email = '';
if (empty($check_ip)) $check_ip = '';
#$seo_config = seoGetConfigs('nukeSPAM');
OpenTable();
echo '<form id="formAddNewRow" action="#" style="width:800px;min-width:800px">', PHP_EOL
	,'<table border="0">', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td style="vertical-align:text-top;"><label for="wltype">Whitelist Type</label></td>', PHP_EOL
	,'<td>', PHP_EOL
	,'<input type="hidden" name="id" id="id" value="DATAROWID" rel="0" />', PHP_EOL
	,'<input type="hidden" name="unused" id="wltype" value="" />', PHP_EOL
	,'<input type="radio" name="wltype" id="wltypeu" value="u" rel="1" class="required" /> <label for="wltypeu">' . _SPAM_USERNAME . '</label><br />', PHP_EOL
	,'<input type="radio" name="wltype" id="wltypee" value="e" rel="1" /> <label for="wltypee">', _SPAM_EMAIL, '</label><br />', PHP_EOL
	,'<input type="radio" name="wltype" id="wltypei" value="i" rel="1" /> <label for="wltypei">', _SPAM_IP, '</label><br />', PHP_EOL
	,'<label for="wltype" class="error">Please select the Whitelist Type</label>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td style="vertical-align:text-top;"><label for="wlvalue">Whitelist Value</label></td>', PHP_EOL
	,'<td>', PHP_EOL
	,'<input type="text" name="wlvalue" id="wlvalue" rel="2" size="45" class="required" /><br />', PHP_EOL
	,'<label for="wlvalue" class="error">Please enter the Whitelist Value</label>', PHP_EOL
	,'</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</table>', PHP_EOL
	,'</form>', PHP_EOL
	,'<table cellpadding="0" cellspacing="0" border="0" class="display" id="nukeSPAMWL">', PHP_EOL
	,'<thead>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<th>id</th>', PHP_EOL
	,'<th width="20%">', _SPAM_WLTYPE, '</th>', PHP_EOL
	,'<th width="80%">', _SPAM_WLVALUE, '</th>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</thead>', PHP_EOL
	,'<tfoot>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td>id</td>', PHP_EOL
	,'<td>', _SPAM_WLTYPE, '</td>', PHP_EOL
	,'<td>', _SPAM_WLVALUE, '</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</tfoot>', PHP_EOL
	,'<tbody>', PHP_EOL
	,'<tr>', PHP_EOL
	,'<td colspan="7" class="dataTables_empty">', _SPAM_LOADING, '</td>', PHP_EOL
	,'</tr>', PHP_EOL
	,'</tbody>', PHP_EOL
	,'</table>', PHP_EOL;
CloseTable();

?>