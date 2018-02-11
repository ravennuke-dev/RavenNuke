<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Migration to RavenNuke &trade; v2.3</title>
<Link Rev="made" href="mailto:webmaster@code-authors.com" />
<meta name="keywords" content="RavenNuke Migration Tool" />
<meta name="description" content="Assists in analysing files for migration to RavenNuke &trade; v2.3" />
<meta name="author" content="John Haywood a.k.a. Guardian">
<meta name="robots" content="NONE">
</head>
<body>



<?php
define('INTRO','This file is to help you locate files which are not longer required.<br /> It is important to remember that we are referencing a default RavenNuke &trade; v2.3.x installation,
so if you have modified that, for example, updated Nuke Sentinel &trade; you should keep in mind that such modifications will affect the results of this script.');
define('REASON','This file might be on your site because it was used in phpNuke or in RavenNuke &trade; prior to RN2.3.');
define('REASON1','This file was left over from a previous phpNuke version.');
define('REASON2','This file is left over from a previous version of RavenNuke &trade;');
define('REASON3','This theme has been restructured so this file is no longer required');
define('REASON4','In some server operating systems or configurations, leaving this file here may cause issues with the WYSIWYG Editor image/file upload operations.'); 

define('SEVEN','First appeared in phpNuke 7.7');
define('EIGHT_ONE','First appeared in phpNuke 8.1');
define ('FILE','The file ');
define('REMNANT',' is not required and should be removed to ensure the smooth operation of your site.');
define('REMNANT_AUTO',' may be a remnant from phpNuke 8.1 unless you have specifically addd the \'AutoTheme\' third party module.');
define('SEC',' should be removed as it poses a security risk to your site.');
define('DIR','The directory ');
define('PATH',' in the path ');
define('DIR_NS','The following directory is for IP2C updates for Nuke Sentinel &trade; which you may not need ');
define('DIR_FCK','<b>IMPORTANT!!</b> This directory may have been used in pre RN2.3 versions to hold media like images etc for news items etc. DO NOT delete this directory if this is the cae - check first!!');
define('DIR_SPLATT','This directory has not been used since phpNuke 5.6 when nuke used the Splatt forums.');
define('DIR_RNYA','This directory is no longer used as we have a custom Your Account module.');
define('DIR_ODYSSEY','This theme is no longer used in RavenNuke &trade; and is not supported.'); 

echo '<center><b>'.INTRO.'</b></center><br /><br />';

//ROOT
$filename = 'banners.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'basic.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'changes.txt';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'readme.txt';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'upgrade.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'upgradedb.sql';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'versions.txt';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = '400.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = '401.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = '402.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = '403.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = '404.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = '500.shtml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'sample.ftaccess';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'sample.htaccess';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'sample.staccess';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$dirname = 'install';
if (is_dir($dirname)) echo ''.DIR.'<b>install</b>'.PATH.' '.$dirname.''.REMNANT.''.SEVEN.'<b>install</b>'.SEC.'<br /><br />';
$dirname = '';

// ADMIN
$filename = 'admin/case/case.authotheme.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT_AUTO.'<br /><br />';

$filenane = 'admin/case/case.banners.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/case/case.moderation.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'admin/case/case.newsletter.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/case/case.referers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'admin/links/links.autotheme.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT_AUTO.'<br /><br />';

$filename = 'admin/links/links.banners.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/links/links.httpreferers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'admin/links/links.moderation.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'admin/links/links.newsletter.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/modules/banners.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/modules/moderation.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'admin/modules/newsletter.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'admin/modules/referers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'admin/modules/nukesentinel/ABAuthListScan.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABBlockedIP.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABBlockedOverlapCheck.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABBlockedRange.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABDBMaintence.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABImport.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABImportBlockedRange.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABImportIP2Country.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABIP2Country.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedIP.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedIPView.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedRange.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedRangeView.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintExcludedList.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintExcludedView.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintProtectedList.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintProtectedView.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTracked.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedAgents.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedAgentsPages.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedPages.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedRefers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedRefersPages.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedUsers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedUsersPages.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABSearchResults.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTracked.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTrackedAgents.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTrackedDeleteUser.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTrackedDeleteUserIP.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTrackedRefers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'admin/modules/nukesentinel/ABTrackedUsers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

// BLOCKS
$filename = 'blocks/block-Last_Referers.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

// DB
$filename = 'db/sqlite.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

// IMAGES
$filename = 'images/add.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/code_bg_little.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/delete_x.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/edit_x.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/key.gif/';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/key_x.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/unban.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/view_x.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/admin/autotheme.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT_AUTO.'<br /><br />';


$filename = 'images/admin/ephemerids.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'images/admin/moderation.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'<br /><br />';

$filename = 'images/admin/sections.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$dirname = 'images/karma/';
if (is_dir($dirname)) echo ''.DIR.'<b>karma</b>'.PATH.' '.$dirname.''.REMNANT.''.SEVEN.'<br /><br />';
$dirname = '';

$filename = 'images/nukesentinel/countries/xe.png';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'images/nukesentinel/countries/xs.png';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'images/nukesentinel/countries/xw.png';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

// NS - IMPORT
$dirname = 'import';
if (is_dir($dirname)) echo ''.DIR_NS.' <b>'.$dirname.'</b><br /><br />';
$dirname = '';

// INCLUDES

$dirname = 'includes/tiny_mce/';
if (is_dir($dirname)) echo ''.DIR.' <b>tiny_mce</b>'.PATH.''.$dirname.''.REMNANT.'<br />tiny_mce '.SEC.' '.SEVEN.'<br /><br />';
$dirname = '';

$filename = 'includes/auth.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/bbcode.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/constants.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/emailer.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$dirname = 'includes/FCKeditor/editor/_source/';
if (is_dir($dirname)) echo ''.DIR.'<b>_source</b>'.PATH.' '.$dirname.''.REMNANT.'';
$dirname = '';

$filename = 'includes/FCKeditor/editor/css/behaviors/hiddenfield.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';
 
$filename = 'includes/FCKeditor/editor/css/behaviors/hiddenfield.htc';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';
 
$filename = 'includes/FCKeditor/editor/dialog/common/fcknumericfield.htc';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';
 
$filename = 'includes/FCKeditor/editor/dialog/common/moz-bindings.xml';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';
 
$filename ='includes/FCKeditor/editor/dialog/fck_about/lgpl.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/00.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/data.js';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/diacritic.js';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/dialogue.js';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/fck_universalkey.css';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/keyboard_layout.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/multihexa.js';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_find.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/basexml.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/commands.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/config.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/connector.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/io.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/util.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/config.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><b>config.php </b>'.SEC.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/upload.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><b>upload.php </b>'.SEC.'<br /><br />';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/util.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/lang/_getfontformat.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$filename = 'includes/FCKeditor/editor/fckblank.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.'<br /><br />';

$dirname = 'includes/FCKeditor/upload/File/';
if (is_dir($dirname)) echo ''.DIR.'<b>File</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_FCK.'<br /><br />';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Flash/';
if (is_dir($dirname)) echo ''.DIR.'<b>Flash</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_FCK.'<br /><br />';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Image/'; 
if (is_dir($dirname)) echo ''.DIR.'<b>Image</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_FCK.'<br /><br />';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Media/';
if (is_dir($dirname)) echo ''.DIR.'<b>Media</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_FCK.'<br /><br />';
$dirname = '';

$filename = 'includes/functions.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_admin.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_nuke.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_post.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_search.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_selects.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/functions_validates.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/page_header.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/page_header_review.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/page_tail.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/page_tail_review.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/prune.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/sessions.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/smtp.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/sql_parse.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/template.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/topic_review.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_activate.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_avatar.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_email.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_register.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_sendpasswd.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'includes/usercp_viewprofile.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

// MODULES

$dirname = 'modules/AutoTheme/';
if (is_dir($dirname)) echo ''.DIR.'<b>AutoTheme</b>'.PATH.' '.$dirname.''.REMNANT.''.SEVEN.'<br /><br />';
$dirname = '';

$filename = 'modules/ErrorDocuments/.htaccess';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$dirname = 'modules/Forums/admin/language/';
if (is_dir($dirname)) echo ''.DIR.'<b>language</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_SPLATT.'<br /><br />';
$dirname = '';

$filename = 'modules/Forums/language/lang_english/email/admin_welcome_activated.tpl0000644';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$dirname = 'modules/Forums/language/lang_russian/';
if (is_dir($dirname)) echo ''.DIR.'<b>lang_russian</b>'.PATH.' '.$dirname.''.REMNANT.'<br /><br />';
$dirname = '';

$filename = 'modules/Forums/update_to_205.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/update_to_206.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/update_to_207.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/update_to_209.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/update_to_210.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/usercp_confirm.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Forums/templates/subSilver/install.tpl';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><b>'.FILE.''.$filename.''.SEC.'</b><br /><br />';

$filename = 'modules/Forums/templates/subSilver/images/lang_english/icon_search.gif0000644';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'modules/Forums/templates/subSilver/images/lang_english/msg_newpost.gif0000644';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$dirname = 'modules/Journal/docs/';	
if (is_dir($dirname)) echo ''.DIR.'<b>docs</b>'.PATH.' '.$dirname.''.REMNANT.'<br /><br />';
$dirname = '';

$dirname = 'modules/Journal/popups/';
if (is_dir($dirname)) echo ''.DIR.'<b>popups</b>'.PATH.' '.$dirname.''.REMNANT.'<br /><br />';
$dirname = '';

$dirname = 'modules/Journal/styles/';
if (is_dir($dirname)) echo ''.DIR.'<b>styles</b>'.PATH.' '.$dirname.''.REMNANT.'<br /><br />';
$dirname = '';

$filename = 'modules/Journal/editor.js';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'modules/Journal/header.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'modules/Journal/kses.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'modules/News/associates.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$dirname = 'modules/Your_Account/admin/language/';
if (is_dir($dirname)) echo ''.DIR.'<b>language</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_RNYA.'<br /><br />';
$dirname = '';

$filename = 'modules/Your_Account/admin/ya_javascript.php';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><b>'.$filename.'</b> '.SEC.'<br /><br />';

$filename = 'modules/Your_Account/images/comments.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/exit.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/home.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/info.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/journal.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/mail.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/messages.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

$filename = 'modules/Your_Account/images/themes.gif';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON.'<br /><br />';

// THEMES
$filename = 'themes/fisubice/x-header.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'themes/fisubice/x-story_home.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'theme/fisubice/x-footer.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'themes/fisubice/forums/glance_body.tpl';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'themes/fisubice/forums/quick_reply.tpl';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON1.'<br /><br />';

$filename = 'themes/NukeNews/blocks.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/center_right.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/footer.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/header.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/left_center.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/story_home.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$filename = 'theme/NukeNews/story_page.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON3.'<br /><br />';

$dirname = 'themes/Odyssey/';
if (is_dir($dirname)) echo ''.DIR.'<b>Odyssey</b>'.PATH.' '.$dirname.''.REMNANT.'<br />'.DIR_ODYSSEY.'<br /><br />';

// Uploads dir
$filename = 'uploads/file/index.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.''.REASON4.'<br /><br />';

$filename = 'uploads/flash/index.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.''.REASON4.'<br /><br />';

$filename = 'uploads/image/index.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.''.REASON4.'<br /><br />';

$filename = 'uploads/media/index.html';
if (file_exists($filename)) echo ''.FILE.' <b>'.$filename.'</b> '.REMNANT.'<br />'.REASON2.''.REASON4.'<br /><br />';

$dirname = '';
$filenme = '';
?>
</body>
</html>