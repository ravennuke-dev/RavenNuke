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
$lid = isset($lid) ? intval($lid) : 0;
$checkpass = isset($checkpass) ? $checkpass : '';
$lidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid));
$priv = $lidinfo['sid'] - 2;
/*
 * First make sure that anonymous or logged in user is allowed to download the file.  If not, do
 * not let them do it and give them a message.
 * Enhanced in 1.1.0 at the request of Palbin to allow an admin to always be able to download
 */
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) || ($lidinfo['sid'] == 2 AND is_admin($admin)) || ($lidinfo['sid'] > 2 AND of_group($priv)) || is_admin($admin)) {
	if (!empty($lidinfo['url'])) {
		$datekey = date('F j');
		$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $checkpass . $datekey));
		$code = substr($rcode, 2, 8);
		global $modGFXChk, $module_name;
		if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check'];
		else $gfx_check = '';
		/*
		 * Perform the appropriate security check code depending upon what CMS and graphical capabilities we are running
		 */
		$passedSecurityCheck = false;
		if ($dl_config['usegfxcheck'] == 1) { // Check if Captcha is in use
			if (defined('RAVENNUKE_VERSION')) { // Check if using RavenNuke(tm) in order to use its Captcha
				if (security_code_check($gfx_check, $modGFXChk[$module_name])) $passedSecurityCheck = true;
			} elseif (extension_loaded('gd')) { // Not using RavenNuke(tm), but am using the GD extension
				if ($code == $passcode) $passedSecurityCheck = true;
			} else {
				if ($checkpass == $passcode) $passedSecurityCheck = true;
			}
		} else {
			$passedSecurityCheck = true;
		}
		if ($passedSecurityCheck) {
			$sub_ip = gdGetIP(); // Get the submitter's IP address if we can
			$uinfo = getusrinfo($user);
			$username = $uinfo['username'];
			if (empty($username)) $username = $sub_ip;
			if (stristr($lidinfo['url'], 'http://') || stristr($lidinfo['url'], 'https://') || stristr($lidinfo['url'], 'ftp://') || stristr($lidinfo['url'], 'sftp://') || @file_exists($lidinfo['url'])) {
				include_once 'includes/counter.php';
				$db->sql_query('UPDATE `' . $prefix . '_nsngd_downloads` SET `hits` = `hits` + 1 WHERE `lid` = ' . $lid);
				if (!is_admin($admin)) {
					$sql = 'SELECT * FROM `' . $prefix . '_nsngd_accesses` WHERE `username` = \'' . addslashes($username) . '\'';
					$result = $db->sql_numrows($db->sql_query($sql));
					if ($result < 1) {
						$sql = 'INSERT INTO `' . $prefix . '_nsngd_accesses` VALUES (\'' . addslashes($username) . '\', 1, 0)';
						$db->sql_query($sql);
					} else {
						$sql = 'UPDATE `' . $prefix . '_nsngd_accesses` SET `downloads` = `downloads` + 1 WHERE `username` = \''
							. addslashes($username) . '\'';
						$db->sql_query($sql);
					}
				}
				/*
				 * Anti-leaching approach starts here.  Rather than presenting a direct re-direct link to the browser (i.e., essentially
				 * allowing ANY GET link from any site to do the same and by-pass all download controls), we essentially stream the binary
				 * back to the browser.  NOTE: Anti-leaching will ONLY work where you host the file on your local web server beneath the
				 * same directory structure as your RavenNuke(tm)/PHP-Nuke site.
				 *
				 * HOW TO USE:
				 * 1.  Place a .htaccess file at the root directory of where you store your download files and have it have only
				 *     the following one line in it:
				 *
				 *     deny from all
				 *
				 * 2.  Next, each download you host must NOT have a URL of HTTP, HTTPS, FTP or FTPS.  You must use a direct
				 *     relative path to the file (i.e., starting from your root web - where your top level modules.php script is.
				 *
				 * @todo Down the road, will need to make this feature more configurable and flexible.
				 */
				if (stristr($lidinfo['url'], 'http://') || stristr($lidinfo['url'], 'https://') || stristr($lidinfo['url'], 'ftp://') || stristr($lidinfo['url'], 'sftp://')) {
					// Download is hosted elsewhere, therefore, will not stream
					Header('Location: ' . $lidinfo['url']);
				} else {
					// Download is hosted here, so go get it and stream it to the browser.
					// @todo Should improve configurability and/or bullet-proofness over time
					/*
					 * Opera has an issue with MIME type of "octet-stream" and requires "octetstream" instead!
					 */
					if (preg_match('#Opera(/| )([0-9].[0-9]{1,2})#i', getenv('HTTP_USER_AGENT'))) {
						$cType = 'application/octetstream';
					} else {
						$cType = 'application/octet-stream';
					}
					header('Content-Description: File Transfer');
					header('Content-Type: ' . $cType);
					header('Content-Disposition: attachment; filename="' . basename($lidinfo['url']) . '"');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private', false);
					header('Pragma: public');
					/*
					 * If the web server is compressing the output, it can mess up the content length.  It may pass its own
					 * content header so we should try not pasing our own.  Different browsers seem to handle things differently,
					 * so just going to try this for now and it may need some tweaking as we learn how this behaves
					 */
					if (!(isset($do_gzip_compress) && $do_gzip_compress)) {
						header('Content-Length: ' . filesize($lidinfo['url']));
					}
					// If output bufferring was used, need to ensure to clean it out
					@ob_clean();
					@flush();
					@set_time_limit(0); // May not be allowed or even desired, but choosing simple for first go-around
					readfile($lidinfo['url']); // Ok, go get it... and hope it doesn't consume all the PHP memory!
				}
				die();
			} else {
				$date = date('M d, Y g:i:a');
				$sql = 'INSERT INTO `' . $prefix . '_nsngd_mods` VALUES (NULL, ' . $lid . ', 0, 0, \'\', \'\', \'\', \''
					. _DL_DSCRIPT . '<br />' . $date . '\', \'' . addslashes($sub_ip) . '\', 1, \'\', \'\', \'\', \'\', \'\')';
				$db->sql_query($sql);
				include_once 'header.php';
				$lidinfo['title'] = htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);
				title(_DL_FNF . ' ' . $lidinfo['title']);
				OpenTable();
				echo '<div align="center"><p>' . _DL_SORRY . ' ' . $username . ', <strong>' . $lidinfo['title'] . '</strong> '
					. _DL_NOTFOUND . '</p><p>' . _DL_FNFREASON . '</p><p>';
				echo _DL_FLAGGED . '</p>';
				echo '<p>[ <a href="modules.php?name=' . $module_name . '">' . _DL_BACKTO . ' ' . $module_name . '</a> ]</p></div>';
				CloseTable();
				include_once 'footer.php';
			}
		} else {
			include_once 'header.php';
			title(_DL_PASSERR);
			OpenTable();
			echo '<div align="center"><p>' . _DL_INVALIDPASS . '</p>';
			echo '<p>' . _GOBACK . '</p></div>';
			CloseTable();
			include_once 'footer.php';
			die();
		}
	} else {
		include_once 'header.php';
		title(_DL_URLERR);
		OpenTable();
		echo '<div align="center"><p>' . _DL_INVALIDURL . '</p>';
		echo '<p>' . _GOBACK . '</p></div>';
		CloseTable();
		include_once 'footer.php';
	}
} else {
	include_once 'header.php';
	title(_DL_RESTRICTED);
	OpenTable();
	restricted($lidinfo['sid']);
	CloseTable();
	include_once 'footer.php';
}

