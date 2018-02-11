<?php

define('INTRO', 'This audit report is to help you locate files which are not longer required.<br /> It is important to remember that we are referencing a default RavenNuke &trade; v2.50.00 installation,<br />
so if you have modified that, for example, updated Nuke Sentinel &trade;,<br /> you should keep in mind that such modifications will affect the results of this script.');
define('REASON', 'This file might be on your site because it was used in phpNuke or in RavenNuke &trade; prior to RN2.4.');
define('REASON1', 'This file was left over from a previous phpNuke version.');
define('REASON2', 'This file is left over from a previous version of RavenNuke &trade; ');
define('REASON3', 'This theme has been restructured so this file is no longer required');
define('REASON4', 'In some server operating systems or configurations, leaving this file here may cause issues with the WYSIWYG Editor image/file upload operations.');

define('SEVEN', 'First appeared in phpNuke 7.7');
define('EIGHT_ONE', 'First appeared in phpNuke 8.1');
define('RN24', ' This file/dir is no longer required and is not included in the RavenNuke &trade; v2.4.x distribution.');
define('RN24MOVED', ' This file has been moved to a different location so it must be removed from your site.');
define('RN25', ' This file/dir is no longer required and is not included in the RavenNuke &trade; v2.5.x distribution.');

define ('FILE', 'The file ');
define('FUNCTION_NO_SUPPORT', 'Functionality associated with this file is no longer supported');
define('REMNANT', ' is not required and should be removed to ensure the smooth operation of your site.');
define('REMNANT_AUTO', ' may be a remnant from phpNuke 8.1 unless you have specifically addd the \'AutoTheme\' third party module.');
define('SEC', ' should be removed as it poses a security risk to your site.');
define('DIR', 'The directory ');
define('PATH', ' in the path ');
define('DIR_NS', 'The following directory is for IP2C updates for Nuke Sentinel &trade; which you may not need ');
define('DIR_FCK', '<strong>IMPORTANT!!</strong> This directory may have been used in pre RN2.3 versions to hold media like images etc for news items etc. DO NOT delete this directory if this is the case - check first!!');
define('DIR_SPLATT', 'This directory has not been used since phpNuke 5.6 when nuke used the Splatt forums.');
define('DIR_RNYA', 'This directory is no longer used as we have a custom Your Account module.');
define('DIR_THEME', 'This theme is no longer used in RavenNuke &trade;.  You are free to use it, but it will not be maintained by the RavenNuke &trade; team.');
define('DIR_NSNGROUPS', 'This directory has been moved to a new location (as of RN version 2.4.x). You must remove this directory to ensure your site runs smoothly');
define('MAILER_UPDATE', ' appears to be a lot of remnant files in includes/tegonuke/mailer/.<br />It is recommended that you delete the entire folder, and re-upload the folder from the RN 2.5 package.');
define('DOWNLOADS_UPDATE', ' appears to be a lot of remnant files in includes/modules/Downloads/.<br />It is recommended that you delete the entire folder, and re-upload the folder from the RN 2.5 package.');


echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">' , "\n"
	, '<html xmlns="http://www.w3.org/1999/xhtml">' , "\n"
	, '<head>' , "\n"
	, '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' , "\n"
	, '<title>File Migration to RavenNuke &trade; v2.5</title>' , "\n"
	, '<link rev="made" href="mailto:webmaster@code-authors.com" />' , "\n"
	, '<meta name="keywords" content="RavenNuke Migration Tool" />' , "\n"
	, '<meta name="description" content="Assists in analysing files for migration to RavenNuke &trade; v2.5" />' , "\n"
	, '<meta name="author" content="John Haywood a.k.a. Guardian" />' , "\n"
	, '<meta name="robots" content="NONE" />' , "\n"
	, '</head>' , "\n"
	, '<body>' , "\n"
	, '<div style="text-align: center;"><strong>' , INTRO , '</strong></div>' , "\n"
	, '<div><hr />';

$dropped = array(
/**
* ROOT
*/
array('file', 'banners.php', array(REMNANT, REASON)),
array('file', 'basic.html', array(REMNANT, REASON1)),
array('file', 'changes.txt', array(REMNANT, REASON1)),
array('file', 'readme.txt', array(REMNANT, REASON1)),
array('file', 'upgrade.php', array(REMNANT, REASON1, '<strong>' . FILE . 'upgrade.php' . SEC . '</strong>')),
array('file', 'upgradedb.sql', array(REMNANT, REASON1, '<strong>' . FILE . 'upgradedb.sql' . SEC . '</strong>')),
array('file', 'version.txt', array(REMNANT, REASON1)),
array('file', '400.shtml', array(REMNANT, REASON2)),
array('file', '401.shtml', array(REMNANT, REASON2)),
array('file', '402.shtml', array(REMNANT, REASON2)),
array('file', '403.shtml', array(REMNANT, REASON2)),
array('file', '404.shtml', array(REMNANT, REASON2)),
array('file', '500.shtml', array(REMNANT, REASON2)),
array('file', 'sample.ftaccess', array(REMNANT, REASON2)),
array('file', 'sample.htaccess', array(REMNANT, REASON2)),
array('file', 'sample.staccess', array(REMNANT, REASON2)),
array('file', 'ultramode.txt', array(REMNANT, REASON2, RN24)),
array('dir', 'install/', array(PATH . ' install/' . REMNANT, SEVEN . ' <strong>install</strong>' . SEC)),

/**
* ADMIN
*/
array('file', 'admin/case/case.authotheme.php', array(REMNANT_AUTO)),
array('file', 'admin/case/case.banners.php', array(REMNANT, REASON)),
array('file', 'admin/case/editgroups.php', array(REMNANT, REASON . ' ' . RN24MOVED)),
array('file', 'admin/case/case.moderation.php', array(REMNANT, REASON1, SEVEN)),
array('file', 'admin/case/case.newsletter.php', array(REMNANT, REASON)),
array('file', 'admin/case/case.referers.php', array(REMNANT, REASON, '<strong>' . FILE . 'admin/case/case.referers.php' . SEC . '</strong>')),
array('file', 'admin/links/links.autotheme.php', array(REMNANT_AUTO)),
array('file', 'admin/links/links.banners.php', array(REMNANT, REASON)),
array('file', 'admin/links/links.editgroups.php', array(REMNANT, RN24MOVED)),
array('file', 'admin/links/links.httpreferers.php', array(REMNANT, REASON, '<strong>' . FILE . 'admin/links/links.httpreferers.php' . SEC . '</strong>')),
array('file', 'admin/links/links.moderation.php', array(REMNANT, REASON1, SEVEN)),
array('file', 'admin/links/links.newsletter.php', array(REMNANT, REASON)),
array('file', 'admin/modules/banners.php', array(REMNANT, REASON)),
array('file', 'admin/modules/editgroups.php', array(REMNANT, RN24MOVED)),
array('file', 'admin/modules/moderation.php', array(REMNANT, REASON1, SEVEN)),
array('file', 'admin/modules/newsletter.php', array(REMNANT, REASON)),
array('file', 'admin/modules/referers.php', array(REMNANT, REASON, '<strong>' . FILE . 'admin/modules/referers.php' . SEC . '</strong>')),
array('dir', 'admin/modules/nsngroups/', array(PATH . ' admin/modules/nsngroups/' . REMNANT, SEVEN)),
array('file', 'admin/modules/nukesentinel/ABAccessError.php', array(REMNANT, REASON2, RN24)),
array('file', 'admin/modules/nukesentinel/ABAccessError.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABBlockedIP.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABBlockedOverlapCheck.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABBlockedRange.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABDBMaintence.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABImport.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABImportBlockedRange.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABImportIP2Country.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABIP2Country.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintBlockedIP.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintBlockedIPView.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintBlockedRange.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintBlockedRangeView.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintExcludedList.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintExcludedView.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintProtectedList.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintProtectedView.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTracked.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedAgents.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedAgentsPages.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedPages.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedRefers.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedRefersPages.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedUsers.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABPrintTrackedUsersPages.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABSearchResults.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTracked.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTrackedAgents.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTrackedDeleteUser.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTrackedDeleteUserIP.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTrackedRefers.php', array(REMNANT, REASON2)),
array('file', 'admin/modules/nukesentinel/ABTrackedUsers.php', array(REMNANT, REASON2)),

/**
* BLOCKS
*/
array('file', 'blocks/block-Last_Referers.php', array(REMNANT, REASON1, '<strong>' . FILE . 'blocks/block-Last_Referers.php' . SEC . '</strong>')),

/**
* DB
*/
array('file', 'db/sqlite.php', array(REMNANT, REASON1, FUNCTION_NO_SUPPORT)),
array('file', 'db/db2.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/msaccess.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/mssql_odbc.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/mssql.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/mysql4.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/oracle.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/postgres7.php', array(REMNANT, REASON2, RN24, FUNCTION_NO_SUPPORT)),
array('file', 'db/mysql.php', array(REASON2, RN25, FUNCTION_NO_SUPPORT)),

/**
* IMAGES
*/
array('file', 'images/add.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/code_bg_little.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/delete_x.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/edit_x.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/key.gif/', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/key_x.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/unban.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/view_x.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/admin/autotheme.gif', array(REMNANT_AUTO)),
array('file', 'images/admin/ephemerids.gif', array(REMNANT, REASON)),
array('file', 'images/admin/moderation.gif', array(REMNANT, REASON1, SEVEN)),
array('file', 'images/admin/sections.gif', array(REMNANT, REASON)),
array('dir', 'images/karma/', array(PATH . ' images/karma/' . REMNANT, SEVEN)),
array('file', 'images/nukesentinel/countries/xe.png', array(REMNANT, REASON2)),
array('file', 'images/nukesentinel/countries/xs.png', array(REMNANT, REASON2)),
array('file', 'images/nukesentinel/countries/xw.png', array(REMNANT, REASON)),
array('file', 'images/blocks/arrow-blk.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-blu.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-bnk.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-cyn.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-grn.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-gry.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-pur.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-red.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-sil.gif', array(REASON2, RN25)),
array('file', 'images/blocks/arrow-ylw.gif', array(REASON2, RN25)),
array('file', 'images/blocks/email-c.gif', array(REASON2, RN25)),
array('file', 'images/blocks/email-g.gif', array(REASON2, RN25)),
array('file', 'images/blocks/email-p.gif', array(REASON2, RN25)),
array('file', 'images/blocks/email-r.gif', array(REASON2, RN25)),
array('file', 'images/blocks/email-y.gif', array(REASON2, RN25)),
array('file', 'images/blocks/greenlight.gif', array(REASON2, RN25)),
array('file', 'images/blocks/group-1.gif', array(REASON2, RN25)),
array('file', 'images/blocks/group-2.gif', array(REASON2, RN25)),
array('file', 'images/blocks/group-3.gif', array(REASON2, RN25)),
array('file', 'images/blocks/group-4.gif', array(REASON2, RN25)),
array('file', 'images/blocks/icon_mini_profile.gif', array(REASON2, RN25)),
array('file', 'images/blocks/new.gif', array(REASON2, RN25)),
array('file', 'images/blocks/nopm.gif', array(REASON2, RN25)),
array('file', 'images/blocks/redlight.gif', array(REASON2, RN25)),
array('file', 'images/blocks/space.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-admin.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-anony.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-author.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-guest.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-hiddenmember.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-member.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-moderator.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-registered.gif', array(REASON2, RN25)),
array('file', 'images/blocks/ur-super.gif', array(REASON2, RN25)),
array('file', 'images/blocks/yellowlight.gif', array(REASON2, RN25)),
array('dir', 'images/blocks/tegonuke/mailer/', array(PATH . ' images/blocks/tegonuke/mailer/' . REMNANT, RN25)),

/**
* NS - IMPORT
*/
array('dir', 'import/', array(PATH . ' import/' . DIR_NS)),

/**
* INCLUDES
*/
array('dir', 'includes/tiny_mce/', array(PATH . ' includes/tiny_mce/' . REMNANT, 'tiny_mce ' . SEC . ' ' . SEVEN)),
array('file', 'includes/auth.php', array(REMNANT, REASON)),
array('file', 'includes/bbcode.php', array(REMNANT, REASON)),
array('file', 'includes/constants.php', array(REMNANT, REASON)),
array('file', 'includes/dynamic_titles.php', array(REMNANT, RN24)),
array('file', 'includes/emailer.php', array(REMNANT, REASON)),
array('file', 'includes/nukeSEO/content/Downloads.php', array(REASON2, RN25)),
array('dir', 'includes/FCKeditor/', array(PATH . ' includes/FCKeditor/ should be in all lowercase letters, please check.')),
array('dir', 'includes/FCKeditor/editor/_source/', array(PATH . ' includes/FCKeditor/editor/_source/' . REMNANT)),
array('file', 'includes/FCKeditor/editor/css/behaviors/hiddenfield.gif', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/css/behaviors/hiddenfield.htc', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/common/fcknumericfield.htc', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/common/moz-bindings.xml', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_about/lgpl.html', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/00.gif', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/data.js', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/diacritic.js', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/dialogue.js', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/fck_universalkey.css', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/keyboard_layout.gif', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey/multihexa.js', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_find.html', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/dialog/fck_universalkey.html', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/basexml.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/commands.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/config.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/connector.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/io.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/browser/default/connectors/php/util.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/filemanager/upload/php/config.php', array(REMNANT, REASON2, '<strong>config.php </strong>' . SEC)),
array('file', 'includes/FCKeditor/editor/filemanager/upload/php/upload.php', array(REMNANT, REASON2, '<strong>config.php </strong>' . SEC)),
array('file', 'includes/FCKeditor/editor/filemanager/upload/php/util.php', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/lang/_getfontformat.html', array(REMNANT, REASON2)),
array('file', 'includes/FCKeditor/editor/fckblank.html', array(REMNANT, REASON2)),
array('dir', 'includes/FCKeditor/upload/File/', array(PATH . ' includes/FCKeditor/upload/File/' . REMNANT, DIR_FCK)),
array('dir', 'includes/FCKeditor/upload/Flash/', array(PATH . ' includes/FCKeditor/upload/Flash/' . REMNANT, DIR_FCK)),
array('dir', 'includes/FCKeditor/upload/Image/', array(PATH . ' includes/FCKeditor/upload/Image/' . REMNANT, DIR_FCK)),
array('dir', 'includes/FCKeditor/upload/Media/', array(PATH . ' includes/FCKeditor/upload/Media/' . REMNANT, DIR_FCK)),
array('file', 'includes/functions.php', array(REMNANT, REASON)),
array('file', 'includes/functions_admin.php', array(REMNANT, REASON)),
array('file', 'includes/functions_nuke.php', array(REMNANT, REASON)),
array('file', 'includes/functions_post.php', array(REMNANT, REASON)),
array('file', 'includes/functions_search.php', array(REMNANT, REASON)),
array('file', 'includes/functions_selects.php', array(REMNANT, REASON)),
array('file', 'includes/functions_validate.php', array(REMNANT, REASON)),
array('file', 'includes/jquery/jquery.css', array(REMNANT, REASON, RN24MOVED)),
array('file', 'includes/meta.php', array(REMNANT, RN24)),
array('file', 'includes/nsngr_func.php', array(REMNANT, RN24)),
array('file', 'includes/nukesentinel5.js', array(REMNANT, RN24)),
array('file', 'includes/nukesentinel6.js', array(REMNANT, RN24)),
array('file', 'includes/page_header.php', array(REMNANT, REASON)),
array('file', 'includes/page_header_review.php', array(REMNANT, REASON)),
array('file', 'includes/page_tail.php', array(REMNANT, REASON)),
array('file', 'includes/page_tail_review.php', array(REMNANT, REASON)),
array('file', 'includes/prune.php', array(REMNANT, REASON)),
array('file', 'includes/sessions.php', array(REMNANT, REASON)),
array('file', 'includes/smtp.php', array(REMNANT, REASON)),
array('file', 'includes/sql_parse.php', array(REMNANT, REASON)),
array('file', 'includes/template.php', array(REMNANT, REASON)),
array('file', 'includes/topic_review.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_activate.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_avatar.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_confirm.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_email.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_register.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_sendpasswd.php', array(REMNANT, REASON)),
array('file', 'includes/usercp_viewprofile.php', array(REMNANT, REASON)),
array('file', 'includes/sql_layer.php', array(REASON2, RN25)),
array('dir', 'includes/tegonuke/mailer/Swift/Swift.php', array(MAILER_UPDATE)),

/**
* LANGUAGE
*/
array('dir', 'language/groups/', array(PATH . ' language/groups/' . REMNANT, RN24)),

/**
* MODULES
*/
array('dir', 'modules/AutoTheme/', array(PATH . ' modules/AutoTheme/' . REMNANT, SEVEN)),
array('file', 'modules/ErrorDocuments/.htaccess', array(REMNANT, REASON)),
array('file', 'modules/Content/admin/panel.php', array(REMNANT, REASON2, RN24)),
array('dir', 'modules/Downloads/d_config.php.php', array(DOWNLOADS_UPDATE)),
array('dir', 'modules/Forums/admin/language/', array(PATH . ' modules/Forums/admin/language/' . REMNANT, DIR_SPLATT)),
array('file', 'modules/Forums/language/lang_english/email/admin_welcome_activated.tpl0000644', array(REMNANT, REASON1)),
array('dir', 'modules/Forums/language/lang_russian/', array(PATH . ' modules/Forums/language/lang_russian/' . REMNANT)),
array('file', 'modules/Forums/update_to_205.php', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/update_to_205.php' . SEC . '</strong>')),
array('file', 'modules/Forums/update_to_206.php', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/update_to_206.php' . SEC . '</strong>')),
array('file', 'modules/Forums/update_to_207.php', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/update_to_207.php' . SEC . '</strong>')),
array('file', 'modules/Forums/update_to_209.php', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/update_to_209.php' . SEC . '</strong>')),
array('file', 'modules/Forums/update_to_210.php', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/update_to_210.php' . SEC . '</strong>')),
array('file', 'modules/Forums/usercp_confirm.php', array(REMNANT, REASON)),
array('file', 'modules/Forums/templates/subSilver/install.tpl', array(REMNANT, REASON1, '<strong>' . FILE . 'modules/Forums/templates/subSilver/install.tpl' . SEC . '</strong>')),
array('file', 'modules/Forums/templates/subSilver/images/lang_english/icon_search.gif0000644', array(REMNANT, REASON1)),
array('file', 'modules/Forums/templates/subSilver/images/lang_english/msg_newpost.gif0000644', array(REMNANT, REASON1)),
array('dir', 'modules/Forums/templates/Sunset/', array(PATH . ' modules/Forums/templates/Sunset/' . REMNANT, RN24)),
array('dir', 'modules/Journal/', array(PATH . ' modules/Journal/' . REMNANT, RN25)),
array('file', 'modules/News/associates.php', array(REMNANT, REASON)),
array('dir', 'modules/RWS_WhoIsWhere/', array(PATH . ' modules/RWS_WhoIsWhere/' . RN24)),
array('dir', 'modules/Your_Account/admin/language/', array(PATH . ' modules/Your_Account/admin/language/' . REMNANT, DIR_RNYA)),
array('file', 'modules/Your_Account/admin/ya_javascript.php', array(REMNANT, REASON, '<strong>' . FILE . 'modules/Your_Account/admin/ya_javascript.php' . SEC . '</strong>')),
array('file', 'modules/Your_Account/images/comments.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/exit.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/home.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/info.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/journal.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/mail.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/messages.gif', array(REMNANT, REASON)),
array('file', 'modules/Your_Account/images/themes.gif', array(REMNANT, REASON)),

/**
* SHORTLINKS
*/
array('file', 'ShortLinks/GT-Journal.php', array(REASON2, RN25)),

/**
* THEMES
*/
array('file', 'themes/fisubice/x-header.html', array(REMNANT, REASON1)),
array('file', 'themes/fisubice/x-story_home.html', array(REMNANT, REASON1)),
array('file', 'theme/fisubice/x-footer.html', array(REMNANT, REASON1)),
array('file', 'themes/fisubice/forums/glance_body.tpl', array(REMNANT, REASON1)),
array('file', 'themes/fisubice/forums/quick_reply.tpl', array(REMNANT, REASON1)),
array('dir', 'themes/3D-Fantasy/', array(DIR_THEME, RN25)),
array('dir', 'themes/Anagram/', array(DIR_THEME, RN25)),
array('dir', 'themes/DeepBlue/', array(DIR_THEME, RN25)),
array('dir', 'themes/ExtraLite/', array(DIR_THEME, RN25)),
array('dir', 'themes/Kaput/', array(DIR_THEME, RN25)),
array('dir', 'themes/Karate/', array(DIR_THEME, RN25)),
array('dir', 'themes/Milo/', array(DIR_THEME, RN25)),
array('dir', 'theme/NukeNews/', array(DIR_THEME, RN25)),
array('dir', 'themes/Slash/', array(DIR_THEME, RN25)),
array('dir', 'themes/SlahsOcean/', array(DIR_THEME, RN25)),
array('dir', 'themes/Sunset/', array(DIR_THEME, RN25)),
array('dir', 'themes/Traditional/', array(DIR_THEME, RN25)),
array('dir', 'themes/Blue_Blog/forums/admin/', array(PATH . ' themes/Blue_Blog/forums/admin/' . REMNANT, RN25)),
array('dir', 'themes/CT_RN/forums/admin/', array(PATH . ' themes/CT_RN/forums/admin/' . REMNANT, RN25)),
array('dir', 'themes/fisubice/forums/admin/', array(PATH . ' themes/fisubice/forums/admin/' . REMNANT, RN25)),
array('dir', 'themes/Sand_Journey/modules/', array(PATH . ' themes/Sand_Journey/modules/' . REMNANT, RN25)),

/**
* UPLOADS DIR
*/
array('file', 'uploads/file/index.html', array(REMNANT, REASON2, REASON4)),
array('file', 'uploads/flash/index.html', array(REMNANT, REASON2, REASON4)),
array('file', 'uploads/image/index.html', array(REMNANT, REASON2, REASON4)),
array('file', 'uploads/media/index.html', array(REMNANT, REASON2, REASON4))
);

foreach ($dropped as $key => $value) {
	if (file_exists($value[1])) {
		echo '<p>';
		if ($value[0] == 'dir') {
			echo DIR;
		} else {
			echo FILE;
		}
		echo ' <strong>' . $value[1] . '</strong> ';
		foreach ($value[2] as $reason) {
			echo $reason . '<br />';
		}
		echo '</p>';
	}
}

echo '<strong>*** END OF REPORT ***</strong>'
	, '</div>'
	, '</body>'
	, '</html>';

?>