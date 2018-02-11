<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Migration to RavenNuke &trade; v2.4</title>
<link rev="made" href="mailto:webmaster@code-authors.com" />
<meta name="keywords" content="RavenNuke Migration Tool" />
<meta name="description" content="Assists in analysing files for migration to RavenNuke &trade; v2.4" />
<meta name="author" content="John Haywood a.k.a. Guardian" />
<meta name="robots" content="NONE" />
</head>
<body>

<?php
define('INTRO','This audit report is to help you locate files which are not longer required.<br /> It is important to remember that we are referencing a default RavenNuke &trade; v2.4.x installation,<br />
so if you have modified that, for example, updated Nuke Sentinel &trade;,<br /> you should keep in mind that such modifications will affect the results of this script.');
define('REASON','This file might be on your site because it was used in phpNuke or in RavenNuke &trade; prior to RN2.4.');
define('REASON1','This file was left over from a previous phpNuke version.');
define('REASON2','This file is left over from a previous version of RavenNuke &trade; ');
define('REASON3','This theme has been restructured so this file is no longer required');
define('REASON4','In some server operating systems or configurations, leaving this file here may cause issues with the WYSIWYG Editor image/file upload operations.');

define('SEVEN','First appeared in phpNuke 7.7');
define('EIGHT_ONE','First appeared in phpNuke 8.1');
define('RN24',' This file/dir is no longer required and is not included in the RavenNuke &trade; v2.4.x distribution.');
define('RN24MOVED',' This file has been moved to a different location so it must be removed from your site.');

define ('FILE','The file ');
define('FUNCTION_NO_SUPPORT','Functionality associated with this file is no longer supported');
define('REMNANT',' is not required and should be removed to ensure the smooth operation of your site.');
define('REMNANT_AUTO',' may be a remnant from phpNuke 8.1 unless you have specifically addd the \'AutoTheme\' third party module.');
define('SEC',' should be removed as it poses a security risk to your site.');
define('DIR','The directory ');
define('PATH',' in the path ');
define('DIR_NS','The following directory is for IP2C updates for Nuke Sentinel &trade; which you may not need ');
define('DIR_FCK','<strong>IMPORTANT!!</strong> This directory may have been used in pre RN2.3 versions to hold media like images etc for news items etc. DO NOT delete this directory if this is the case - check first!!');
define('DIR_SPLATT','This directory has not been used since phpNuke 5.6 when nuke used the Splatt forums.');
define('DIR_RNYA','This directory is no longer used as we have a custom Your Account module.');
define('DIR_ODYSSEY','This theme is no longer used in RavenNuke &trade; and is not supported.');
define('DIR_NSNGROUPS','This directory has been moved to a new location (as of RN version 2.4.x). You must remove this directory to ensure your site runs smoothly');
echo '<div align="center"><strong>'.INTRO.'</strong></div>';
echo '<div>';
echo '<hr />';
//ROOT
$filename = 'banners.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'basic.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'changes.txt';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'readme.txt';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'upgrade.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'upgradedb.sql';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'versions.txt';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = '400.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = '401.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = '402.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = '403.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = '404.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = '500.shtml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'sample.ftaccess';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'sample.htaccess';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'sample.staccess';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'ultramode.txt';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'</p>';

$dirname = 'install';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>install</strong>'.PATH.' '.$dirname.REMNANT.SEVEN.'<strong>install</strong>'.SEC.'</p>';
$dirname = '';

// ADMIN
$filename = 'admin/case/case.authotheme.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT_AUTO.'</p>';

$filenane = 'admin/case/case.banners.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/case/editgroups.php';
if(file_exists($filename)) if (file_exists($filename)) echo '<p>'.FILE.'<strong>'.$filename.'</strong>'.REMNANT.'<br />'.REASON.' '.RN24MOVED.'</p>';

$filename = 'admin/case/case.moderation.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'admin/case/case.newsletter.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/case/case.referers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'admin/links/links.autotheme.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT_AUTO.'</p>';

$filename = 'admin/links/links.banners.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/links/links.editgroups.php';
if(file_exists($filename)) if (file_exists($filename)) echo '<p>'.FILE.'<strong>'.$filename.'</strong> '.REASON.'<br />'.RN24MOVED.'</p>';

$filename = 'admin/links/links.httpreferers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'admin/links/links.moderation.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'admin/links/links.newsletter.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/modules/banners.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/modules/editgroups.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24MOVED.'</p>';

$filename = 'admin/modules/moderation.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'admin/modules/newsletter.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'admin/modules/referers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$dirname = 'admin/modules/nsngroups';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>nsngroups</strong>'.PATH.' '.$dirname.REMNANT.'</p>';
$dirname = '';

$filename = 'admin/modules/nukesentinel/ABAccessError.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'</p>';

$filename = 'admin/modules/nukesentinel/ABAuthListScan.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABBlockedIP.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABBlockedOverlapCheck.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABBlockedRange.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABDBMaintence.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABImport.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABImportBlockedRange.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABImportIP2Country.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABIP2Country.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedIP.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedIPView.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedRange.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintBlockedRangeView.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintExcludedList.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintExcludedView.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintProtectedList.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintProtectedView.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTracked.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedAgents.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedAgentsPages.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedPages.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedRefers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedRefersPages.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedUsers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABPrintTrackedUsersPages.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABSearchResults.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTracked.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTrackedAgents.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTrackedDeleteUser.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTrackedDeleteUserIP.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTrackedRefers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'admin/modules/nukesentinel/ABTrackedUsers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

// BLOCKS
$filename = 'blocks/block-Last_Referers.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

// DB
$filename = 'db/sqlite.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'db/db2.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename = 'db/msaccess.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename ='db/mssql_odbc.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename = 'db/mssql.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename = 'db/mysql4.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename = 'db/oracle.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';

$filename = 'db/postgres7.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'<br />'.FUNCTION_NO_SUPPORT.'</p>';


// IMAGES
$filename = 'images/add.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/code_bg_little.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/delete_x.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/edit_x.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/key.gif/';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/key_x.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/unban.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/view_x.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/admin/autotheme.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT_AUTO.'</p>';


$filename = 'images/admin/ephemerids.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'images/admin/moderation.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br />'.SEVEN.'</p>';

$filename = 'images/admin/sections.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$dirname = 'images/karma/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>karma</strong>'.PATH.' '.$dirname.REMNANT.SEVEN.'</p>';
$dirname = '';

$filename = 'images/nukesentinel/countries/xe.png';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'images/nukesentinel/countries/xs.png';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'images/nukesentinel/countries/xw.png';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

// NS - IMPORT
$dirname = 'import';
if (is_dir($dirname)) echo DIR_NS.' <strong>'.$dirname.'</strong></p>';
$dirname = '';

// INCLUDES

$dirname = 'includes/tiny_mce/';
if (is_dir($dirname)) echo '<p>'.DIR.' <strong>tiny_mce</strong>'.PATH.$dirname.REMNANT.'<br />tiny_mce '.SEC.' '.SEVEN.'</p>';
$dirname = '';

$filename = 'includes/auth.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/bbcode.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/constants.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/dynamic_titles.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24.'</p>';

$filename = 'includes/emailer.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$dirname = 'includes/FCKeditor';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>FCKeditor</strong>should be in all lowercase letters, please check. <br />';
$dirname = '';

$dirname = 'includes/FCKeditor/editor/_source/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>_source</strong>'.PATH.' '.$dirname.REMNANT;
$dirname = '';

$filename = 'includes/FCKeditor/editor/css/behaviors/hiddenfield.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/css/behaviors/hiddenfield.htc';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/common/fcknumericfield.htc';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/common/moz-bindings.xml';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename ='includes/FCKeditor/editor/dialog/fck_about/lgpl.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/00.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/data.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/diacritic.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/dialogue.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/fck_universalkey.css';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/keyboard_layout.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey/multihexa.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_find.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/dialog/fck_universalkey.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/basexml.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/commands.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/config.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/connector.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/io.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/util.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/config.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br /><strong>config.php </strong>'.SEC.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/upload.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br /><strong>upload.php </strong>'.SEC.'</p>';

$filename = 'includes/FCKeditor/editor/filemanager/upload/php/util.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/lang/_getfontformat.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$filename = 'includes/FCKeditor/editor/fckblank.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'</p>';

$dirname = 'includes/FCKeditor/upload/File/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>File</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_FCK.'</p>';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Flash/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>Flash</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_FCK.'</p>';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Image/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>Image</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_FCK.'</p>';
$dirname = '';

$dirname = 'includes/FCKeditor/upload/Media/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>Media</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_FCK.'</p>';
$dirname = '';

$filename = 'includes/functions.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_admin.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_nuke.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_post.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_search.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_selects.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/functions_validate.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/jquery/jquery.css';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'<br />'.RN24MOVED.'</p>';

$filename = 'includes/meta.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24.'</p>';

$filename = 'includes/nsngr_func.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24.'</p>';

$filename = 'includes/nukesentinel5.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24.'</p>';

$filename = 'includes/nukesentinel6.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.RN24.'</p>';

$filename = 'includes/page_header.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/page_header_review.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/page_tail.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/page_tail_review.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/prune.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/sessions.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/smtp.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/sql_parse.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/template.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/topic_review.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_activate.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_avatar.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_confirm.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_email.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_register.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_sendpasswd.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'includes/usercp_viewprofile.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$dirname = 'language/groups';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>install</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.RN24.'</p>';
$dirname = '';

// MODULES

$dirname = 'modules/AutoTheme/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>AutoTheme</strong>'.PATH.' '.$dirname.REMNANT.SEVEN.'</p>';
$dirname = '';

$filename = 'modules/ErrorDocuments/.htaccess';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Content/admin/panel.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.RN24.'</p>';

$dirname = 'modules/Forums/admin/language/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>language</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_SPLATT.'</p>';
$dirname = '';

$filename = 'modules/Forums/language/lang_english/email/admin_welcome_activated.tpl0000644';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$dirname = 'modules/Forums/language/lang_russian/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>lang_russian</strong>'.PATH.' '.$dirname.REMNANT.'</p>';
$dirname = '';

$filename = 'modules/Forums/update_to_205.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/update_to_206.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/update_to_207.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/update_to_209.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/update_to_210.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/usercp_confirm.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Forums/templates/subSilver/install.tpl';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'<br /><strong>'.FILE.$filename.SEC.'</strong></p>';

$filename = 'modules/Forums/templates/subSilver/images/lang_english/icon_search.gif0000644';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'modules/Forums/templates/subSilver/images/lang_english/msg_newpost.gif0000644';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$dirname = 'modules/Forums/templates/Sunset/';
if (is_dir($dirname)) echo '<p>'.DIR.' <strong>Sunset</strong> '.PATH.' '.$dirname.' '.REMNANT.'<br />'.RN24.'</p>';
$dirname = '';

$dirname = 'modules/Journal/docs/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>docs</strong>'.PATH.' '.$dirname.REMNANT.'</p>';
$dirname = '';

$dirname = 'modules/Journal/popups/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>popups</strong>'.PATH.' '.$dirname.REMNANT.'</p>';
$dirname = '';

$dirname = 'modules/Journal/styles/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>styles</strong>'.PATH.' '.$dirname.REMNANT.'</p>';
$dirname = '';

$filename = 'modules/Journal/editor.js';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'modules/Journal/header.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'modules/Journal/kses.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'modules/News/associates.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$dirname = 'modules/RWS_WhoIsWhere/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>RWS_WhoIsWhere</strong>'.PATH.' '.$dirname.RN24.'</p>';
$dirname = '';

$dirname = 'modules/Your_Account/admin/language/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>language</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_RNYA.'</p>';
$dirname = '';

$filename = 'modules/Your_Account/admin/ya_javascript.php';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'<br />'.FILE.'<strong>'.$filename.'</strong> '.SEC.'</p>';

$filename = 'modules/Your_Account/images/comments.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/exit.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/home.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/info.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/journal.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/mail.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/messages.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

$filename = 'modules/Your_Account/images/themes.gif';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON.'</p>';

// THEMES
$filename = 'themes/fisubice/x-header.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'themes/fisubice/x-story_home.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'theme/fisubice/x-footer.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'themes/fisubice/forums/glance_body.tpl';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'themes/fisubice/forums/quick_reply.tpl';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON1.'</p>';

$filename = 'themes/NukeNews/blocks.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/center_right.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/footer.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/header.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/left_center.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/story_home.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$filename = 'theme/NukeNews/story_page.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON3.'</p>';

$dirname = 'themes/Odyssey/';
if (is_dir($dirname)) echo '<p>'.DIR.'<strong>Odyssey</strong>'.PATH.' '.$dirname.REMNANT.'<br />'.DIR_ODYSSEY.'</p>';
$dirname = '';

// Uploads dir
$filename = 'uploads/file/index.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.REASON4.'</p>';

$filename = 'uploads/flash/index.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.REASON4.'</p>';

$filename = 'uploads/image/index.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.REASON4.'</p>';

$filename = 'uploads/media/index.html';
if (file_exists($filename)) echo '<p>'.FILE.' <strong>'.$filename.'</strong> '.REMNANT.'<br />'.REASON2.'<br />'.REASON4.'</p>';

$dirname = '';
$filenme = '';

echo '<strong>*** END OF REPORT ***</strong>';
echo '</div>';
?>
</body>
</html>