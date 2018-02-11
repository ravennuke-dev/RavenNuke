<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

$xperpage = intval($xperpage);
$xdate_format = addslashes(check_html($xdate_format));
$xsend_notice = intval($xsend_notice);

grsave_config('perpage',$xperpage);
grsave_config('date_format',$xdate_format);
grsave_config('send_notice',$xsend_notice);

Header('Location: '.$admin_file.'.php?op=NSNGroups');

?>