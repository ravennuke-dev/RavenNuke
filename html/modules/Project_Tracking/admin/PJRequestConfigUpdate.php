<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
pjsave_config('admin_request_email', $admin_request_email);
pjsave_config('new_request_position', $new_request_position);
pjsave_config('new_request_status', $new_request_status);
pjsave_config('new_request_type', $new_request_type);
pjsave_config('notify_request_admin', $notify_request_admin);
pjsave_config('notify_request_submitter', $notify_request_submitter);
pjsave_config('request_date_format', $request_date_format);
header("Location: ".$admin_file.".php?op=PJRequestConfig");

?>