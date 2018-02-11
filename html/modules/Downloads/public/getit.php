<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
/*
 * Get the download detail data.
 */
$lid = isset($lid) ? intval($lid) : 0;
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid . ' AND `active` > 0');
$lidinfo = $db->sql_fetchrow($result);
$priv = $lidinfo['sid'] - 2;
$pagetitle = '- ' . _DL_DOWNLOADPROFILE . ': ' . htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);
include_once 'header.php';
echo '<div class="content">';
/*
 * Make sure the download is allowed for this user.  Enhanced in 1.1.0 at the request of Palbin to allow an admin to always be able to download
 */
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) || ($lidinfo['sid'] == 2 AND is_admin($admin)) || ($lidinfo['sid'] > 2 AND of_group($priv)) || is_admin($admin)) {
	$userAllowed = true;
} else {
	$userAllowed = false;
}
/*
 * Control who can see what.  A 'show_download' value of '1' means show to anonymous users too.
 */
if ($userAllowed || $dl_config['show_download'] == '1') {
	if ($lidinfo['lid'] == '' OR $lidinfo['active'] == 0) {
		title(_DL_DOWNLOADPROFILE . ': ' . _DL_INVALIDDOWNLOAD);
		OpenTable();
		echo '<p align="center"><strong>' . _DL_INVALIDDOWNLOAD . '</strong></p>';
	} else {
		$fetchid = base64_encode($lidinfo['url']);
		$title = htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);
		title(_DL_DOWNLOADPROFILE . ': ' . $title);
		OpenTable();
		echo '<p class="title">';
		if (is_admin($admin)) {
			$myimage = myimage('edit.png');
			echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModify&amp;lid=' . $lid . '" target="_blank"><img align="middle" src="'
				. $myimage . '" alt="' . _DL_EDIT . '" /></a>&nbsp;';
		} else {
			$myimage = myimage('show.png');
			echo '<img align="middle" src="' . $myimage . '" alt="" />&nbsp;';
		}
		echo _DL_DOWNLOADPROFILE . ': ' . $title . '</p><hr />';
		echo '<div>', $lidinfo['description'], '</div><hr />';
		echo '<strong>' . _DL_VERSION . ':</strong> ' . $lidinfo['version'] . '<br />';
		echo '<strong>' . _DL_FILESIZE . ':</strong> ' . CoolSize($lidinfo['filesize']) . '<br />';
		echo '<strong>' . _DL_ADDEDON . ':</strong> ' . CoolDate($lidinfo['date']) . '<br />';
		echo '<strong>' . _DL_DOWNLOADS . ':</strong> ' . $lidinfo['hits'] . '<br />';
		echo '<strong>' . _DL_HOMEPAGE . ':</strong> ';
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
			echo '<a href="' . $lidinfo['homepage'] . '" target="_blank">' . $lidinfo['homepage'] . '</a>';
		} else {
			echo _DL_NOTLIST;
		}
		echo '<hr />';
		if ($userAllowed) { // Was already determined up above
			echo '<form action="modules.php?name=' . $module_name . '" method="post">';
			echo '<input type="hidden" name="op" value="go" />';
			echo '<input type="hidden" name="lid" value="' . $lidinfo['lid'] . '" />';
			/*
			 * If it is desired to use a captcha to help protect against "bot" access to
			 * the downloads, then we need to determine whether RavenNuke(tm) is being used.
			 * If so, then we use it.  If not, then we use the base NSN GR Download version
			 * coded by its original author.
			 */
			if ($dl_config['usegfxcheck'] == 1) {
				if (is_admin($admin)) {
					echo '<p><strong>' . _DL_DIRECTIONS . '</strong> ' . _DL_DLNOTES1 . '<strong>' . $title . '</strong>' . _DL_DLNOTES3
					. _DL_DLNOTES4 . '</p>';
				} else {
					echo '<p><strong>' . _DL_DIRECTIONS . '</strong> ' . _DL_DLNOTES1 . '<strong>' . $title . '</strong>' . _DL_DLNOTES2 . '</p>';
				}
				echo '<div align="center">';
				if (defined('RAVENNUKE_VERSION')) {
					// RavenNuke(tm) of an appropriate version (i.e., has captcha) is in use
					global $modGFXChk, $module_name;
					echo security_code($modGFXChk[$module_name], 'stacked');
				} else {
					// Not using RavenNuke(tm) so will produce original captcha
					mt_srand((double)microtime() * 1000000);
					$maxran = 1000000;
					$random_num = mt_rand(0, $maxran);
					if (extension_loaded('gd')) {
						echo '<p><strong>', _DL_YOURPASS, ':</strong>&nbsp;<img src="modules.php?name=', $module_name
						, '&amp;op=gfx&amp;random_num=', $random_num, '" height="20" width="80" border="0" alt="', _DL_YOURPASS
						, '" title="', _DL_YOURPASS, '" /></p><p><strong>', _DL_TYPEPASS
						, ':</strong>&nbsp;<input type="text" name="passcode" size="10" maxlength="10" />'
						, '<input type="hidden" name="checkpass" value="', $random_num, '" /></p>';
					} else {
						$datekey = date('F j');
						$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
						$code = substr($rcode, 2, 8);
						$ThemeSel = get_theme();
						if (file_exists('themes/' . $ThemeSel . '/images/downloads/code_bg.png')) {
							$imgpath = 'themes/' . $ThemeSel . '/images';
						} else {
							$imgpath = 'images';
						}
						echo '<table border="0"><tr><td><strong>', _DL_YOURPASS, ':</strong></td><td height="20" width="80" class="storytitle" align="center" '
							, 'style="background:url(\'', $imgpath, '/code_bg.png\')"><strong>', $code, '</strong></td></tr><tr><td><strong>'
							, _DL_TYPEPASS, ':</strong></td><td><input type="text" name="passcode" size="10" maxlength="10" />'
							, '<input type="hidden" name="checkpass" value="', $code, '" /></td></tr></table>';
					}
				}
			} else {
				echo '<p><strong>' . _DL_DIRECTIONS . '</strong> ' . _DL_DLNOTES1 . '<strong>' . $title . '</strong>' . _DL_DLNOTES3
					. _DL_DLNOTES4 . '</p><div align="center">';
			}
			echo '<p><input type="submit" name="' . _DL_GOGET . '" value="' . _DL_GOGET . '" /></p></div>';
			echo '</form>';
			echo '<p align="center">[ <a href="modules.php?name=', $module_name, '&amp;op=modifydownloadrequest&amp;lid=', $lid,
				'" >', _DL_MODIFY, '</a> | <a href="modules.php?name=', $module_name, '&amp;op=brokendownload&amp;lid=', $lid,
				'" >', _DL_REPORTBROKEN, '</a>]</p>';
		} else {
			restricted($lidinfo['sid']);
		}
	}
	CloseTable();
} else {
	OpenTable();
	restricted($lidinfo['sid']);
	CloseTable();
}
echo '</div>';
include_once 'footer.php';

