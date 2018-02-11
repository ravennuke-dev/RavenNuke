<?php
//#####################################################################
// PHP-NUKE: Advanced Content Management System
// ============================================
//
// Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
// http://phpnuke.org
//
// This module is to configure the main options for your site
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//#####################################################################
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}
//#####################################################################
// Database & System Config
//
// dbhost:            SQL Database Hostname
// dbuname:           SQL Username
// dbpass:            SQL Password
// dbname:            SQL Database Name
// $prefix:           Your Database table prefix
// $user_prefix:      Your Users' Database table prefix (To share it)
// $dbtype:           Your Database Server type. DO NOT CHANGE as only MySQL
//                      is now supported.
// $sitekey:          Security Key. DO CHANGE this from the default so that hackers
//                      do not know your key.  Change it to whatever you want, as long
//                      as you want. Just do not use quotes.
// $gfx_chk:          Controls the graphic security code on every login screen (requires
//                      the GD extension with FreeType support):
//                      0: No check
//                      1: Administrators login only
//                      2: Users login only
//                      3: New users registration only
//                      4: Both, users login and new users registration only
//                      5: Administrators and users login only
//                      6: Administrators and new users registration only
//                      7: Everywhere on all login options (Admins and Users)
//                      NOTE: if you are unsure what to set it to, just leave it at the
//                      default value of '7' for the highest security level.
// $subscription_url: If you manage subscriptions on your site, you must write here the url
//                      of the subscription information/renewal page. This will be sent by
//                      email if set.
// $admin_file:       Administration panel filename. The default of 'admin' is for the
//                      standard admin.php script name.  If NukeSentinel(tm) is configured
//                      properly, there is no need to rename the admin.php script.  If you should
//                      decide to do so, be sure to modify this setting to the new name.
// $tipath:           Path to where the topic images are stored.  Very few sites need to change this.
// $display_errors:   Debug control to see PHP generated errors.
//                      false: Do not show errors (use this for a production site))
//                      true: See all errors (error levels are controlled by $error_reporting setting
//                        within rnconfig.php)
//#####################################################################
$dbhost = 'localhost';
$dbuname = 'rnuser';
$dbpass = 'rnuser';
$dbname = 'ravennuke';
$prefix = 'nuke';
$user_prefix = 'nuke';
$dbtype = 'MySQLI';
$sitekey = 'SdFk*fa2rnv21076~v28367-dm52?6w69.3a2fDS+e9';
$gfx_chk = 7;
$subscription_url = '';
$admin_file = 'admin';
$tipath = 'images/topics/';
$display_errors = false; //This should only be used (set to "true") when testing locally and not in a production environment

/*********************************************************************
 * You are done with the key database/system settings.  Continue with
 * the rest of the Installation Guide steps.  The rest of the settings
 * are optional configuration settings which drive specific RavenNuke(tm)
 * features.  Additional configuration options are available to further
 * control RavenNuke(tm) operational features and are within rnconfig.php.
 *********************************************************************/

require_once dirname(__FILE__) . '/rnconfig.php';

?>