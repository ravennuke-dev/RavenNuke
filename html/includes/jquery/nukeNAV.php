<?php
/************************************************************************
 * nukeNAV(tm)
 * http://www.nukeSEO.com
 * Copyright 2009 by Kevin Guske
 ************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if(!defined('NUKE_FILE')) die('Access forbbiden');

global $ya_config, $usenukeNAV, $admin, $admin_file;
if (!isset($admin_file)) $admin_file = 'admin'; // may not be defined since this isn't always in admin file
/* Mantis 1671
include_once 'includes/jquery/jquery.php';
 */
addCSSToHead('includes/jquery/css/nukeNAV.css', 'file');
addJSToHead('includes/jquery/jquery.hoverIntent.minified.js', 'file');
addJSToHead('includes/jquery/superfish.js', 'file');
addJSToHead('includes/jquery/supersubs.js', 'file');
addJSToHead('includes/jquery/nukeNAV.js', 'file');
seoGetLang('nukeNAV');

if (file_exists('themes/' . $ThemeSel . '/style/nukeNAV.css'))
	addCSSToHead('themes/' . $ThemeSel . '/style/nukeNAV.css', 'file');
if (!defined('_MAINMODULE')) {
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_main'));
	define('_MAINMODULE', $row['main_module']);
}
$radminsuper = 0;
$radminname = '';

if (!defined('_NUKEMENUMODULES')) define('_NUKEMENUMODULES', 'Modules');
$where = 'WHERE title!=\'' . _MAINMODULE . '\'';
if (!is_admin($admin)) $where .= 'AND active=\'1\' AND inmenu=\'1\'';
$result = $db->sql_query('SELECT * FROM ' . $prefix . '_modules ' . $where . ' ORDER BY active DESC, inmenu DESC, custom_title ASC');
$la = $lim = 1;
$activeModules = $hiddenModules = $inactiveModules = '';
$menuModules = array('Credits', 'Feedback', 'Forums', 'Legal', 'Member_List', 'News', 'nukeNAV', 'Private_Messages', 'Recommend_Us', 'rwsMetAuthors', 'Search', 'Sitemap', 'Statistics', 'Stories_Archive', 'Submit_News', 'Topics', 'Your_Account');
while ($row = $db->sql_fetchrow($result)) {
	$m_title = stripslashes($row['title']);
	$custom_title = $row['custom_title'];
	$view = intval($row['view']);
	$groups = $row['groups'];
	$active = intval($row['active']);
	$inmenu = intval($row['inmenu']);
	$m_title2 = str_replace('_', ' ', $m_title);
	if (in_array($m_title, $menuModules)) continue;  // Module already on menu elsewhere
	if ($custom_title > '') $m_title2 = $custom_title;
	if ($inmenu <> $lim and $active == 1) $hiddenModules = '<li><a>'._INVISIBLEMODULES.'</a>'."\n".'<ul>'."\n"; // Start hidden menu
	if ($active <> $la) {
		if ($lim == 0) $hiddenModules .= '</ul>'."\n".'</li>'."\n";		// Close hidden menu
		$inactiveModules = '<li><a>'._NOACTIVEMODULES.'</a>'."\n".'<ul>'."\n";		// Start inactive menu
	}
	if (($view == 0) or ($view == 1 and is_user($user)) or ($view == 2 and is_admin($admin)) or ($view == 3 and paid()) or ($view > 3 AND in_groups($groups)) ) {
		$menuItem = '<li><a href="modules.php?name='.$m_title.'">'.$m_title2."</a></li>\n";
		if ($inmenu == 0 and $active == 1) $hiddenModules .= $menuItem;
		elseif ($active == 0) $inactiveModules .= $menuItem;
		else $activeModules .= $menuItem;
  }
	$la = $active; $lim = $inmenu;
}
if ($la == 0 or $lim == 0) $inactiveModules .= '</ul></li>';  // Close hidden or inactive menu
$nukeNAV = '<ul id="nukeNAV" class="nukeNAV"><li><a href="./">'._HOME.'</a></li>'."\n";
if (is_active('News')) {
	$nukeNAV .= '
<li><a href="modules.php?name=News" title="">' . _NAV_NEWS . '</a>';
	if (is_active('rwsMetAuthors') or is_active('Stories_Archive') or is_active('Topics') or is_active('Submit_News')) {
		$nukeNAV .= '
  <ul>';
		if (is_active('rwsMetAuthors')) $nukeNAV .= '
  <li><a href="modules.php?name=rwsMetAuthors" title="">' . _NAV_AUTHART . '</a></li>';
		if (is_active('Stories_Archive')) $nukeNAV .= '
  <li><a href="modules.php?name=Stories_Archive" title="">' . _NAV_STORARCH . '</a></li>';
		if (is_active('Topics')) $nukeNAV .= '
  <li><a href="modules.php?name=Topics" title="">' . _NAV_TOPICS . '</a></li>';
		if (is_active('Submit_News') AND is_user($user)) $nukeNAV .= '
  <li><a href="modules.php?name=Submit_News" title="">' . _NAV_SUBMITNEWS . '</a></li>';
		$nukeNAV .= '
  </ul>';
	}
	$nukeNAV .= '
</li>';
}
if (is_active('Forums')) {
	$nukeNAV .= '
<li><a title="">' . _NAV_FORUMS . '</a>
  <ul>
  <li><a href="modules.php?name=Forums" title="">' . _NAV_FORUMS . '</a></li>';
	if (is_user($user)) $nukeNAV .= '
  <li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=newposts" title="">' . _NAV_NEWPOSTS . '</a></li>
  <li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch" title="">' . _NAV_YOURPOSTS . '</a></li>';
	$nukeNAV .= '
  <li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=unanswered" title="">' . _NAV_UNANSWERED . '</a></li>
  </ul>
</li>';
}
$nukeNAV .= '
<li><a>'._NUKEMENUMODULES.'</a><ul>'.$activeModules.'</ul></li>
';
//if ($radminsuper == 1) $nukeNAV .= '
if (is_admin($admin))
	$nukeNAV .= '<li><a title="">' . _NAV_ADMINMODS . '</a><ul>'.$hiddenModules.$inactiveModules.'</ul></li>';
if (is_active('Your_Account')) {
	$nukeNAV .= '<li><a href="modules.php?name=Your_Account" title="">' . _NAV_YOURACCOUNT . '</a>';
	if (!isset($ya_config)) $ya_config = ya_get_configs();
	if (is_user($user)) {
		$nukeNAV .= '<ul>';
		if (is_active('Private_Messages')) $nukeNAV .= '<li><a href="modules.php?name=Private_Messages" title="">' . _NAV_PM . '</a></li>';
		$nukeNAV .= '<li><a href="modules.php?name=Your_Account&amp;op=edituser" title="">' . _NAV_PREFS . '</a></li>';
		if ($ya_config['allowusertheme']=='1') $nukeNAV .= '<li><a href="modules.php?name=Your_Account&amp;op=chgtheme" title="">' . _NAV_CHGTHEME . '</a></li>';
		$nukeNAV .= '<li><a href="modules.php?name=Your_Account&amp;op=logout" title="">' . _LOGOUT . '</a></li></ul>';
	} elseif (is_active('Your_Account')) {
		$nukeNAV .= '
  <ul>';
		if (is_active('nukeNAV')) $nukeNAV .= '
  <li><a href="modules.php?name=nukeNAV&amp;op=login" class="colorbox" title="">' . _LOGIN . '</a></li>';
		else $nukeNAV .= '
  <li><a href="modules.php?name=Your_Account" title="">' . _LOGIN . '</a></li>';
		if ($ya_config['allowuserreg']=='1')$nukeNAV .= '
  <li><a href="modules.php?name=Your_Account&amp;op=new_user" title="">' . _BREG . '</a></li>';
		$nukeNAV .= '
  </ul>';
	}
	$nukeNAV .= '
</li>';
}
if (is_admin($admin) or is_active('Sitemap') or is_active('Feedback') or is_active('Recommend_Us') or is_active('Legal') or is_active('Member_List') or is_active('Statistics')) {
	$nukeNAV .= '
<li><a title="">' . _NAV_SITEINFO . '</a>
  <ul>';
	if (is_active('Sitemap')) $nukeNAV .= '
  <li><a href="modules.php?name=Sitemap" title="">' . _NAV_SITEMAP . '</a></li>';
//  <!--li><a href="#" title="">' . _NAV_CONTACTS . '</a></li-->
	if (is_active('Feedback')) $nukeNAV .= '
  <li><a href="modules.php?name=Feedback" title="">' . _NAV_FEEDBACK . '</a></li>';
	if (is_active('Recommend_Us')) $nukeNAV .= '
  <li><a href="modules.php?name=Recommend_Us" title="">' . _NAV_RECOMMEND . '</a></li>';
	if (is_admin($admin)) $nukeNAV .= '
  <li><a href="http://rnwiki.ravennuke.com/wiki/RNWiki_Home" title="" target="_blank">RavenNuke&trade; Help</a></li>';
	if (is_active('Legal')) $nukeNAV .= '
  <li><a href="modules.php?name=Legal" title="">' . _NAV_LEGAL . '</a></li>';
	if (is_active('Member_List')) $nukeNAV .= '
  <li><a href="modules.php?name=Member_List" title="">' . _NAV_MEMBERS . '</a></li>';
	if (is_active('Statistics') or is_admin($admin)) $nukeNAV .= '
  <li><a href="modules.php?name=Statistics" title="">' . _NAV_STATS . '</a></li>';
//  <!--li><a href="#" title="">' . _NAV_CREDITS . '</a></li-->
	$nukeNAV .= '
  </ul>
</li>';
}
if (is_admin($admin)) {
	$nukeNAV .= '
<li><a title="">' . _NAV_ADMIN . '</a>
  <ul>
  <li><a href="'.$admin_file.'.php" title="">' . _NAV_ACP . '</a></li>
  <li><a title="">' . _NAV_APPEARANCE . '</a>
	 <ul>
	 <li><a href="'.$admin_file.'.php?op=Themes#topconfig" title="">' . _NAV_CHGTHEME . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=BlocksAdmin" title="">' . _NAV_BLOCKS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=messages" title="">' . _NAV_MSGS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=modules" title="">' . _NAV_MODS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=legal" title="">' . _NAV_LGL . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=Configure" title="">' . _NAV_SETTINGS . '</a></li>
	 </ul>
  </li>
  <!--li><a title="">Content Modules</a>
	 <ul>
	 <li><a href="#" title="">Advertising</a></li>
	 <li><a href="#" title="">Calendar</a></li>
	 <li><a href="#" title="">Content</a></li>
	 <li><a href="#" title="">Downloads</a></li>
	 <li><a href="#" title="">Encyclopedia</a></li>
	 <li><a href="#" title="">FAQ</a></li>
	 <li><a href="#" title="">Feeds</a></li>
	 <li><a href="#" title="">Forums</a></li>
	 <li><a href="#" title="">Links</a></li>
	 <li><a href="#" title="">News</a></li>
	 <li><a href="#" title="">Newsletter</a></li>
	 <li><a href="#" title="">Polls</a></li>
	 <li><a href="#" title="">Reviews</a></li>
	 <li><a href="#" title="">xxx</a></li>
	 </ul>
  </li-->
  <li><a title="">' . _USERS . '</a>
	 <ul>
	 <li><a href="'.$admin_file.'.php?op=mod_authors" title="">' . _NAV_ADMINS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=yaAdmin" title="">' . _USERS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=NSNGroups" title="">' . _NAV_GROUPS . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=Groups" title="">' . _NAV_POINTS . '</a></li>
	 </ul>
  </li>
  <li><a href="'.$admin_file.'.php?op=ABMain" title="">' . _NAV_SECURITY . '</a></li>
  <li><a title="">' . _NAV_UTILS . '</a>
	 <ul>
	 <li><a href="'.$admin_file.'.php?op=backup" title="">' . _NAV_BACKUP . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=optimize" title="">' . _NAV_OPTIMIZE . '</a></li>
	 <li><a href="'.$admin_file.'.php?op=MailConfig" title="">' . _NAV_MAILER . '</a></li>
	 </ul>
  </li>
  <!--li><a title="">' . _WAITINGCONT . '</a></li-->
  <li><a href="'.$admin_file.'.php?op=adminStory" title="">' . _NAV_NEWSTORY . '</a></li>
  <li><a href="'.$admin_file.'.php?op=create" title="">' . _NAV_CHGPOLL . '</a></li>
  <li><a href="'.$admin_file.'.php?op=rnc_comments" title="">' . _NAV_COMMENTS . '</a></li>
  <li><a href="'.$admin_file.'.php?op=logout" title="">' . _LOGOUT . '</a></li>
  </ul>
</li>
';
}
// Don't override META tags when on an admin page
if(defined('MODULE_FILE') and is_admin($admin)) {
	$parms = '';
	$dhID = $dh->getContentID();
	if ($dhID > 0) $parms .= '&amp;dhID=' . $dhID;
	$dhCat = $dh->getCatID();
	if ($dhCat > 0) $parms .= '&amp;dhCat=' . $dhCat;
	$dhSubCat = $dh->getSubCatID();
	if ($dhSubCat > 0) $parms .= '&amp;dhSubCat=' . $dhSubCat;
	if (defined('HOME_FILE') and HOME_FILE) $parms .= '&amp;index=y';
	$nukeNAV .= '
<li><a href="modules.php?name=nukeNAV&amp;op=SEO&amp;dhName=' . $name . $parms . '" class="colorboxSEO" title="'. _OVERRIDE_TAGS .'">SEO</a></li>'
;
}
if (is_active('nukeNAV') and is_active('Search')) $nukeNAV .= '
<li><a href="modules.php?name=nukeNAV&amp;op=search" class="colorbox" title="">' . _SEARCH . '</a></li>';
$nukeNAV .= '</ul>';
/*
 * $usenukeNAV =
 *  0 = Do not use
 *  1 = Display for super admin only (e.g. nukeSEO DH)
 *  2 = Display for all visitors
 */
if ($usenukeNAV == 0 or ($usenukeNAV == 1 and !is_admin($admin))) $nukeNAV = '';
?>
