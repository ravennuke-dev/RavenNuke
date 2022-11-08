<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id$
 * @copyright (c) 2011 Raven Web Services, LLC
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * PHP-NUKE: Advanced Content Management System
 * Copyright (c) 2002 by Francisco Burzi
 * http://phpnuke.org
 *
 * Additional Security and Code Cleanup for Patched 3.1
 * Commited by the Nuke Patched Development Team 2005
 * chatserv, Evaders99, Quake
 * http://www.nukeresources.com - Download location
 * http://www.nukefixes.com - Development location
 * http://sourceforge.net/projects/nukepatched/ - CVS Last file update: 30/07/05
 *
*/

/**
 * End the transaction
*/
if (!defined('END_TRANSACTION')) {
	define('END_TRANSACTION', 2);
}

/**
 * Get PHP Version
*/
$phpver = phpversion();

/**
 * convert superglobals - Modified by Raven 5/12/2006 - from http://www.php.net/manual/en/language.variables.predefined.php
*/
if (!isset($_SERVER)) {
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
}
$PHP_SELF = $_SERVER['PHP_SELF'];

/**
 * After doing those superglobals we can now use one and check if this file isnt being accessed directly
*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}

if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false && @extension_loaded('zlib') && !headers_sent()) {
	ob_start('ob_gzhandler');
	ob_implicit_flush(0);
}

if (@ini_get('date.timezone') == '') {
	date_default_timezone_set("America/New_York");
}

if (!@ini_get('register_globals')) {
	extract($_GET, EXTR_OVERWRITE);
	extract($_POST, EXTR_OVERWRITE);
	extract($_COOKIE, EXTR_OVERWRITE);
}

/**
 * This block of code makes sure $admin and $user are COOKIES
*/
if ((isset($admin) && $admin != $_COOKIE['admin']) OR (isset($user) && $user != $_COOKIE['user'])) {
	die('Illegal Operation');
}

// We want to use the function stripos,
// but thats only available since PHP5.
// So we cloned the function...
if (!function_exists('stripos')) {
	function stripos_clone($haystack, $needle, $offset=0) {
		$return = strpos(strtoupper($haystack), strtoupper($needle), $offset);
		if ($return === false) {
			return false;
		} else {
			return true;
		}
	}
} else {
	// But when this is PHP5, we use the original function
	function stripos_clone($haystack, $needle, $offset=0) {
		$return = stripos($haystack, $needle, $offset);
		if ($return === false) {
			return false;
		} else {
			return true;
		}
	}
}

/**
 * GFX Code  v1.0.0
*/
define('GDSUPPORT', extension_loaded('gd'));
if (function_exists('imagecreatetruecolor') && function_exists('imageftbbox')) {
	define('VISUAL_CAPTCHA',true);
}

if (isset($admin) && $admin == $_COOKIE['admin']) {
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = base64_encode($admin);
}

if (isset($user) && $user == $_COOKIE['user']) {
	$user = base64_decode($user);
	$user = addslashes($user);
	$user = base64_encode($user);
}

//This isn't used do we need it?
/**
 * Die message for not allowed HTML tags
*/
define('_HTMLTAGSNOTALLOWED','The html tags you attempted to use are not allowed.');
define('_MAINFILEGOBACK','Go Back');
$htmltags  = '<div class="text-center"><img src="images/logo.gif" alt="" /><br /><br /><span class="thick">';
$htmltags .= _HTMLTAGSNOTALLOWED . '</span><br /><br />';
$htmltags .= '[ <a href="javascript:history.go(-1)"><span class="thick">' . _MAINFILEGOBACK . '</span></a> ]</div>';

if (defined('FORUM_ADMIN')) {
	define('INCLUDE_PATH', '../../../');
} elseif (defined('INSIDE_MOD')) {
	define('INCLUDE_PATH', '../../');
} else {
	define('INCLUDE_PATH', './');
}

require_once dirname(__FILE__) . '/config.php';

/**
 * Error reporting, to be set in rnconfig.php
 * Default is error_reporting(E_ALL^E_NOTICE);
*/
error_reporting($error_reporting);
if ($display_errors) {
	@ini_set('display_errors', 1);
} else {
	@ini_set('display_errors', 0);
}

/**
 * Fail if $admin_file is not set or does not exist
*/
define('_ADMINSET','You must set a value for admin_file in config.php');
define('_ADMINNOTEXISTS','The admin_file you defined in config.php does not exist');
if (!defined('FORUM_ADMIN')) {
	if (empty($admin_file)) {
		die (_ADMINSET);
	} elseif (!empty($admin_file) && !file_exists(NUKE_BASE_DIR . $admin_file.'.php')) {
		die (_ADMINNOTEXISTS);
	}
}

require_once NUKE_BASE_DIR . 'db/db.php';

$result = $db->sql_query("SELECT * FROM `" . $prefix . "_config` LIMIT 0,1");
$nuke_config = $db->sql_fetchrow($result);

require_once NUKE_INCLUDE_DIR . 'ipban.php';
if (file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_mainfile.php')) {
	include_once NUKE_INCLUDE_DIR . 'custom_files/custom_mainfile.php';
}

/**
 * TegoNuke(tm) Mailer
 */
include_once NUKE_INCLUDE_DIR . 'tegonuke/mailer/mailer.php';
/*
 * NOTE: NukeSentinel and NSN Groups MUST come after as both use the PHP mail() function for their operations.
 * Actually, any script that could send an email out must be loaded AFTER TegoNuke(tm) Mailer.
 *
 * end of TegoNuke(tm) Mailer add
 */

require_once NUKE_INCLUDE_DIR . 'nukesentinel.php';
/**
 * For RNYA to check for suspended users, TOS, etc.
*/
require_once NUKE_MODULES_DIR . 'Your_Account/includes/mainfileend.php';

if ((isset($name) && isset($file)) && ($name == 'Forums' && $file == 'modcp')) {
} else {
	if (isset($tnsl_bUseShortLinks) && $tnsl_bUseShortLinks && file_exists(NUKE_INCLUDE_DIR . 'tegonuke/shortlinks/shortlinks.php')) {
		define('TNSL_USE_SHORTLINKS', TRUE);
		include_once NUKE_INCLUDE_DIR . 'tegonuke/shortlinks/shortlinks.php';
	}
}

define('NUKE_FILE', true);

$sitename = $nuke_config['sitename'];
$nukeurl = $nuke_config['nukeurl'];
$site_logo = $nuke_config['site_logo'];
$slogan = $nuke_config['slogan'];
$startdate = $nuke_config['startdate'];
$adminmail = $nuke_config['adminmail'];
$anonpost = $nuke_config['anonpost'];
$Default_Theme = $nuke_config['Default_Theme'];
$foot1 = $nuke_config['foot1'];
$foot2 = $nuke_config['foot2'];
$foot3 = $nuke_config['foot3'];
$commentlimit = $nuke_config['commentlimit'];
$anonymous = $nuke_config['anonymous'];
$minpass = $nuke_config['minpass'];
$pollcomm = $nuke_config['pollcomm'];
$articlecomm = $nuke_config['articlecomm'];
$broadcast_msg = $nuke_config['broadcast_msg'];
$my_headlines = $nuke_config['my_headlines'];
$top = $nuke_config['top'];
$storyhome = $nuke_config['storyhome'];
$user_news = $nuke_config['user_news'];
$oldnum = $nuke_config['oldnum'];
$banners = $nuke_config['banners'];
$backend_title = $nuke_config['backend_title'];
$backend_language = $nuke_config['backend_language'];
$language = $nuke_config['language'];
$locale = $nuke_config['locale'];
$multilingual = $nuke_config['multilingual'];
$useflags = $nuke_config['useflags'];
$notify = $nuke_config['notify'];
$notify_email = $nuke_config['notify_email'];
$notify_subject = $nuke_config['notify_subject'];
$notify_message = $nuke_config['notify_message'];
$notify_from = $nuke_config['notify_from'];
$moderate = $nuke_config['moderate'];
$admingraphic = $nuke_config['admingraphic'];
$CensorMode = $nuke_config['CensorMode'];
$CensorReplace = $nuke_config['CensorReplace'];
$copyright = $nuke_config['copyright'];
$Version_Num = $nuke_config['Version_Num'];
$domain = str_replace('http://', '', $nukeurl);
$mtime = microtime();
$mtime = explode(' ',$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;
$pagetitle = '';

/**
 * GFX Code  v1.0.0
*/
include_once NUKE_INCLUDE_DIR . 'gfx_check.php';

/**
 * WYSIWYG class
 *
 * Needs to be before theme is included.
*/
require_once NUKE_CLASSES_DIR . 'class.wysiwyg.php';

if (!defined('FORUM_ADMIN')) {
	$ThemeSel = get_theme();
	include_once 'themes/' . $ThemeSel . '/theme.php';
	if (($multilingual == 1) AND isset($newlang) AND !stristr($newlang,'.')) {
		$newlang = check_html($newlang, 'nohtml');
		if (file_exists('language/lang-' . $newlang . '.php')) {
			setcookie('lang', $newlang, time() + 31536000);
			include_once 'language/lang-' . $newlang . '.php';
			$currentlang = $newlang;
		} else {
			setcookie('lang', $language, time() + 31536000);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} elseif (($multilingual == 1) AND isset($lang) AND !stristr($lang, '.')) {
		$lang = check_html($lang, 'nohtml');
		if (file_exists('language/lang-' . $lang . '.php')) {
			setcookie('lang', $lang, time() + 31536000);
			include_once 'language/lang-' . $lang . '.php';
			$currentlang = $lang;
		} else {
			setcookie('lang', $language, time() + 31536000);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} else {
		setcookie('lang', $language, time() + 31536000);
		include_once 'language/lang-' . $language . '.php';
		$currentlang = $language;
	}
}

// NSN Groups
// This must come after $currentlang is defined
require_once NUKE_MODULES_DIR . 'Groups/includes/nsngr_func.php';

/**
 * CSRF Protection for POST/GET forms and potentially "dangerous" links
 */
require_once NUKE_INCLUDE_DIR . 'csrf-magic.php';

/**
 * Needed for installation script
 */
if (isset($bypassInstallationFolderCheck) && !$bypassInstallationFolderCheck && file_exists('INSTALLATION/')) die(_RNINSTALLFILESFOUND);

if(!function_exists('themepreview')) {
	function themepreview($title, $hometext, $bodytext = '', $notes = '') {
		if (!empty($title)) {
			echo '<span class="thick">' . $title . '</span>';
		}
		echo '<br /><br />' . $hometext;
		if (!empty($bodytext)) {
			echo '<br /><br />' . $bodytext;
		}
		if (!empty($notes)) {
			echo '<br /><br /><span class="thick">' . _NOTE . '</span> ' . $notes;
		}
	}
}

if(!function_exists('themecenterbox')) {
	function themecenterbox($title, $content, $bid = '') {
		global $admin, $admin_file;
		OpenTable();
		echo '<div class="text-center"><span class="option thick">' , $title , '</span></div><br />' , $content;
		if (is_admin($admin) && !empty($bid)) {
			echo '<br /><br /><div class="text-center"><span class="content">[ <a href="' , $admin_file , '.php?op=BlocksEdit&amp;bid=' , $bid , '">' , _EDIT , '</a> ]</span></div>' , "\n";
		}
		CloseTable();
		echo '<br />';
	}
}

if (!defined('ADMIN_FILE') && !file_exists('includes/nukesentinel.php')) {
	$postString = '';
	foreach ($_POST as $postkey => $postvalue) {
		if ($postString > '') {
			# PHP7 issue (2018-03-13, neralex)
			# Notice: Array to string conversion in mainfile.php
			# issue only exists, when $postvalue is an array
			# return value: Array ( [1] => value )
			if (is_array($postvalue)) {
				$postvalue = array();
				$postvalue = implode(',', $postvalue);
			}
			$postString .= '&' . $postkey . '=' . $postvalue;
		} else {
			$postString .= $postkey . '=' . $postvalue;
		}
	}
	str_replace('%09', '%20', $postString);
	$postString_64 = base64_decode($postString);
	if ((!isset($admin) OR (isset($admin) AND !is_admin($admin))) AND (stristr($postString,'%20union%20') OR stristr($postString,'*/union/*') OR stristr($postString,' union ')
	OR stristr($postString_64,'%20union%20') OR stristr($postString_64,'*/union/*') OR stristr($postString_64,' union ') OR stristr($postString_64,'+union+')
	OR stristr($postString,'http-equiv') OR stristr($postString_64,'http-equiv') OR stristr($postString,'alert(') OR stristr($postString_64,'alert(')
	OR stristr($postString,'javascript:') OR stristr($postString_64,'javascript:') OR stristr($postString,'document.cookie') OR stristr($postString_64,'document.cookie')
	OR stristr($postString,'onmouseover=') OR stristr($postString_64,'onmouseover=') OR stristr($postString,'document.location') OR stristr($postString_64,'document.location'))) {
		header('Location: index.php');
		die();
	}
}

/**
 * GFX Code  v1.0.0
*/
if (isset($gfx)){
	switch($gfx) {
		case 'gfx':
			include_once NUKE_INCLUDE_DIR . 'gfx.php';
			break;
	}
}

/**
 * The following section of code is used to create the legal docs
 * menu and set it in a constant so that the constant may be
 * used anywhere within *nuke to show the legal menu links.
 *
 * @version     1.1.0
 *
 * Examples of usage:
 *
 * echo LGL_MENU_HTML;
 * $s = LGL_MENU_HTML;
 * echo $s;
 */
$lgl_legalMenu = '';
if (is_active('Legal')) {
	include_once NUKE_CLASSES_DIR . 'class.legal_doctypes.php';
	$objDocTypes = new Legal_DocTypes('', $lgl_langS);
	$objDocTypes->setShowContact();
	$lgl_legalMenu = '<div class="lgl_menu">' . $objDocTypes->html() . '</div>';
}
if (!defined('LGL_MENU_HTML')) define('LGL_MENU_HTML', $lgl_legalMenu);

/**
 * Check programmed news
*/
automated_news();

/**
 * Since PHP compiles all the functions first, placing all the functions at the end of
 * the logic helps to better organize the code
*/

function get_lang($module) {
	global $currentlang, $language;
	$lang = 'english';
	if ($module == 'admin') {
		if (file_exists(NUKE_ADMIN_DIR . 'language/lang-' . $currentlang . '.php')) {
			include_once NUKE_ADMIN_DIR . 'language/lang-' . $currentlang . '.php';
			$lang = $currentlang;
		} elseif (file_exists(NUKE_ADMIN_DIR . 'language/lang-' . $language . '.php')) {
			include_once NUKE_ADMIN_DIR . 'language/lang-' . $language . '.php';
			$lang = $language;
		} else {  // fall back to English
			include_once NUKE_ADMIN_DIR . 'language/lang-english.php';
		}
	} else {
		if (file_exists(NUKE_MODULES_DIR . $module . '/language/lang-' . $currentlang . '.php')) {
			include_once NUKE_MODULES_DIR . $module . '/language/lang-' . $currentlang . '.php';
			$lang = $currentlang;
		} elseif (file_exists(NUKE_MODULES_DIR . $module . '/language/lang-' . $language . '.php')) {
			include_once NUKE_MODULES_DIR . $module . '/language/lang-' . $language . '.php';
			$lang = $language;
		} elseif (file_exists(NUKE_MODULES_DIR . $module . '/language/lang-english.php')) {  // fall back to English
			include_once NUKE_MODULES_DIR . $module . '/language/lang-english.php';
		}
	}
	return $lang;
}

/**
* Language Select List
*
* Creates a seelct box with a list of avaialbe languages.
*
* @param string $name The name attribute for the select box
* @param string $selected The default language selected
* @param boolean $all  If you want "All" dispalyed as an option
* @param string $attr Other additional attributes for the select box.  Unlike name you will need to include the entire string (id="langSelect").
*/
function lang_select_list($name = 'xlanguage', $selected = '', $all = true, $attr = '') {
	static $languages;
	if (!isset($languages)) {
		$handle = opendir(NUKE_LANGUAGE_DIR);
		while (false !== ($file = readdir($handle))) {
			if (preg_match('/lang-(.*?)\.php/iu', $file, $lang)) {
				$languages[] = $lang[1];
			}
		}
		closedir($handle);
		sort($languages);
	}

	if (!empty($name)) {
		$attr = 'name = "' . $name . '"' . $attr;
	}

	$allsel = ' selected = "selected"';
	$content = '<select ' . $attr . '>';
	$options = '';
	for ($i=0, $count = count($languages); $i < $count; $i++) {
		if(!empty($languages[$i])) {
			$options .= '<option value="' . $languages[$i] . '"';
			$sel = '';
			if($languages[$i] == $selected) {
				$sel = ' selected = "selected"';
				$allsel = '';
			}
			$options .= $sel . '>' . ucwords($languages[$i]) . '</option>' . "\n";
		}
	}
	if ($all) $content .= '<option value=""' . $allsel . '>' . _ALL . '</option>';
	$content .= $options . '</select>';

	return $content;
}

function is_admin($admin) {
	if (!$admin) return 0;
	static $adminSave;
	if (isset($adminSave)) return $adminSave;
	if (!is_array($admin)) {
		$admin = base64_decode($admin);
		$admin = addslashes($admin);
		$admin = explode(':', $admin);
	}
	$aid = isset($admin[0]) ? substr($admin[0], 0, 25) : '';
	$pwd = isset($admin[1]) ? $admin[1] : '';
	if (!empty($aid) && !empty($pwd)) {
		global $db, $prefix;
		$sql = 'SELECT `pwd` FROM `' . $prefix . '_authors` WHERE `aid`=\'' .  $db->sql_escape_string($aid) . '\'';
		$result = $db->sql_query($sql);
		list($rpwd) = $db->sql_fetchrow($result, SQL_NUM);
		if($rpwd == $pwd && !empty($rpwd)) {
			return $adminSave = $aid;
		}
	}
	return $adminSave = 0;
}

function is_mod_admin($module_name = '') {
	global $admin, $db, $prefix;
	static $authmod = array();

	if(!is_admin($admin) || empty($module_name)) return 0;
	if(isset($authmod[$module_name])) {
		return $authmod[$module_name];
	}

	$aid = is_admin($admin);
	$authmod[$module_name] = false;
	$admins = '';
	$radminsuper = 0;

	$query = $db->sql_query('SELECT `name`, `radminsuper` FROM `' . $prefix . '_authors` WHERE `aid`="' . addslashes($aid) . '"');
	list($name, $radminsuper) = $db->sql_fetchrow($query, SQL_NUM);

	if (($radminsuper == 1 && $name == 'God') || ($radminsuper == 1 && $module_name != 'founder')) {
		$authmod[$module_name] = true;
	}

	if ($module_name != 'admin' && $module_name != 'founder' && $radminsuper == 0) {
		$query = $db->sql_query('SELECT `admins` FROM `' . $prefix . '_modules` WHERE `title`="' . addslashes($module_name) . '"');
		if ($query) {
			list($admins) = $db->sql_fetchrow($query, SQL_NUM);
		}

		$admins = explode(',', $admins);
		$count = count($admins);
		for($i=0; $i < $count; $i++) {
			if($name == $admins[$i] && !empty($admins)) {
				$authmod[$module_name] = true;
			}
		}
	}

	return $authmod[$module_name];
}

function is_user($user) {
	if (!$user) return 0;
	static $userSave;
	if (isset($userSave)) return $userSave;
	if (!is_array($user)) {
		$user = base64_decode($user);
		$user = addslashes($user);
		$user = explode(':', $user);
	}
	$uid = isset($user[0]) ? (int) $user[0] : 0;
	$pwd = isset($user[2]) ? $user[2] : '';
	if (!empty($user[0]) && !empty($pwd)) {
		global $db, $user_prefix;
		$sql = 'SELECT `user_password` FROM `' . $user_prefix . '_users` WHERE `user_id`=\'' . $db->sql_escape_string($user[0]) . '\'';
		$result = $db->sql_query($sql);
		list($rpwd) = $db->sql_fetchrow($result, SQL_NUM);
		if ($rpwd == $pwd && !empty($rpwd)) {
			return $userSave = 1;
		}
	}
	return $userSave = 0;
}

function is_group($user, $name) {
	global $cookie, $db, $prefix, $user, $user_prefix;
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$uid = intval($cookie[0]);
		} else {
			$uid = intval($user[0]);
		}
		$result = $db->sql_query('SELECT points FROM ' . $user_prefix . '_users WHERE user_id=\'' . $uid . '\'');
		list($points) = $db->sql_fetchrow($result);
		$result2 = $db->sql_query('SELECT mod_group FROM ' . $prefix . '_modules WHERE title=\'' . $name . '\'');
		list($mod_group) = $db->sql_fetchrow($result2);
		$result3 = $db->sql_query('SELECT points FROM ' . $prefix . '_groups WHERE id=\'' . $mod_group . '\'');
		list($rpoints) = $db->sql_fetchrow($result3);
		if (($points >= 0 AND $points >= $rpoints) OR $mod_group == 0) {
			return 1;
		}
	}
	return 0;
}

function update_points($id) {
	global $db, $prefix, $user, $user_prefix;
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$username = trim($cookie[1]);
		} else {
			$username = trim($user[1]);
		}
		if ($db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_groups')) > '0') {
			$id = intval($id);
			$result = $db->sql_query('SELECT points FROM ' . $prefix . '_groups_points WHERE id=\'' . $id . '\'');
			list($points) = $db->sql_fetchrow($result);
			$db->sql_query('UPDATE ' . $user_prefix.'_users SET points=points+' . $points . ' WHERE username=\'' . $username . '\'');
		}
	}
}

function title($text) {
	OpenTable();
	echo '<div class="text-center"><span class="title">' , $text , '</span></div>';
	CloseTable();
	echo '<br />';
}

function is_active($module) {
	global $db, $prefix;
	static $save;
	if (is_array($save)) {
		if (isset($save[$module])) return ($save[$module]);
		return 0;
	}
	$sql = 'SELECT title FROM ' . $prefix . '_modules WHERE active=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$save[$row[0]] = 1;
	}
	if (isset($save[$module])) return ($save[$module]);
	return 0;
}

function render_blocks($side, $blockfile, $title, $content, $bid, $url) {
	if(!defined('BLOCK_FILE')) {
		define('BLOCK_FILE', true);
	}
	if (empty($url)) {
		if (empty($blockfile)) {
			global $tnsl_bAutoTapBlocks;
			if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
				$content = tnsl_fShortenBlockURLs('', $content);
			}
			//End of GT-NExtGEn / ShortURLs
			if ($side == 'c' || $side == 'd' || $side == 't') {
				themecenterbox($title, $content, $bid);
		} else {
				themesidebox($title, $content, $bid);
			}
		} else {
				blockfileinc($title, $blockfile, $side, $bid);
		}
	} else {
		headlines($bid, $side);
	}
}

function blocks($side) {
	global $admin, $currentlang, $db, $moveableblocks, $multilingual, $prefix, $storynum, $user;

	if ($multilingual == 1) {
		$querylang = 'AND (`blanguage`=\'' . $currentlang . '\' OR `blanguage`=\'\')';
	} else {
		$querylang = '';
	}
	$side = strtolower(substr($side, 0, 1));
	if (!preg_match('/[lrcdt]/', $side)) {
		die('invalid parameter passed to blocks function in mainfile = ' . $side);
	}
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_blocks WHERE bposition=\'' . $side . '\' AND active=1 ' . $querylang . ' ORDER BY weight ASC');
	while($row = $db->sql_fetchrow($result, SQL_ASSOC)) {
		$groups = $row['groups'];
		$bid = $row['bid'];
		$title = $row['title'];
		$content = $row['content'];
		$url = $row['url'];
		$blockfile = $row['blockfile'];
		$view = $row['view'];
		$expire = $row['expire'];
		$action = $row['action'];
		$action = substr($action, 0, 1);
		$now = time();
		$sub = $row['subscription'];
		if ($sub == 0 OR ($sub == 1 AND !paid())) {
			if ($expire != 0 AND $expire <= $now) {
				if ($action == 'd') {
					$db->sql_query('UPDATE `' . $prefix . '_blocks` SET `active`=0, `expire`=\'0\' WHERE `bid`=\'' . $bid . '\'');
					return;
				} elseif ($action == 'r') {
					$db->sql_query('DELETE FROM `' . $prefix . '_blocks` WHERE `bid`=\'' . $bid . '\'');
					return;
				}
			}
			if ($row['bkey'] == 'admin') {
				adminblock();
			} elseif ($row['bkey'] == 'userbox') {
				userblock();
			} elseif (empty($row['bkey'])) {
				if ($view == 0) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 1 AND is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 2 AND is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 3 AND !is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view > 3 AND in_groups($groups)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				}
			}
		}
	}
}

function message_box() {
	global $admin, $admin_file, $bgcolor1, $bgcolor2, $cookie, $currentlang, $db, $multilingual, $prefix, $textcolor2, $user;
	if ($multilingual == 1) {
		$querylang = 'AND (mlanguage=\'' . $currentlang . '\' OR mlanguage=\'\')';
	} else {
		$querylang = '';
	}
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_message WHERE active=1 ' . $querylang);
	if ($numrows = $db->sql_numrows($result) == 0) {
		return;
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$groups = $row['groups'];
			$mid = $row['mid'];
			$title = $row['title'];
			$content = $row['content'];
			$mdate = $row['date'];
			$expire = $row['expire'];
			$view = $row['view'];
			if (!empty($title) && !empty($content)) {
				if ($expire == 0) {
					$remain = _UNLIMITED;
				} else {
					$etime = (($mdate+$expire)-time())/3600;
					$etime = (int)$etime;
					if ($etime < 1) {
						$remain = _EXPIRELESSHOUR;
					} else {
						$remain = _EXPIREIN.' '.$etime.' '._HOURS;
					}
				}
				if ($view > 5 AND in_groups($groups)) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: ' . $textcolor2 . ';">' . $title . '</span></div><br />' . "\n";
					echo '<div class="content">' . $content . '</div>' . "\n";
					if (is_admin($admin)) {
						echo '<br /><br /><div class="text-center"><span class="content">[ ' . _MVIEWGROUPS . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
							. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>' . "\n";
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 5 AND paid()) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: '. $textcolor2 . ';">' . $title . '</span></div><br />' . "\n"
						. '<div class="content">' . $content . '</div>' . "\n";
					if (is_admin($admin)) {
						echo '<br /><br /><div class="text-center"><span class="content">[ ' . _MVIEWSUBUSERS . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
							. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 4 AND is_admin($admin)) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: '. $textcolor2 . ';">' . $title . '</span></div><br />' . "\n"
						. '<div class="content">' . $content . '</div>' . "\n"
						. '<br /><br /><div style="text-align: center;"><span class="content">[ ' . _MVIEWADMIN . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
						. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>';
					CloseTable();
					echo '<br />';
				} elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: '. $textcolor2 . ';">' . $title . '</span></div><br />' . "\n"
						. '<div class="content">' . $content . '</div>' . "\n";
					if (is_admin($admin)) {
						echo '<br /><br /><div class="text-center"><span class="content">[ ' . _MVIEWUSERS . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
							. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: '. $textcolor2 . ';">' . $title . '</span></div><br />' . "\n"
						. '<div class="content">' . $content . '</div>' . "\n";
					if (is_admin($admin)) {
						echo '<br /><br /><div class="text-center"><span class="content">[ ' . _MVIEWANON . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
							. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 1) {
					OpenTable();
					echo '<div class="text-center"><span class="option thick" style="color: '. $textcolor2 . ';">' . $title . '</span></div><br />' . "\n"
						. '<div class="content">' . $content . '</div>' . "\n";
					if (is_admin($admin)) {
						echo '<br /><br /><div class="text-center"><span class="content">[ ' . _MVIEWALL . ' - ' . $remain . ' - <a href="' . $admin_file . '.php?op=editmsg'
							. '&amp;mid=' . $mid . '">' . _EDIT . '</a> ]</span></div>';
					}
					CloseTable();
					echo '<br />';
				}
				if ($expire != 0) {
					$past = time()-$expire;
					if ($mdate < $past) {
						$db->sql_query('UPDATE ' . $prefix . '_message SET active=0 WHERE mid=\'' . $mid . '\'');
					}
				}
			}
		}
	}
}

function online() {
	global $cookie, $db, $nsnst_const, $prefix, $user;
	if (!defined('NUKESENTINEL_IS_LOADED')) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if(!validIP($ip)) $ip = 'none';
	} else {
		$ip = (!isset($nsnst_const['remote_ip'])) ? 'none' : $nsnst_const['remote_ip'];
	}
	$guest = 0;
	if (is_user($user)) {
		cookiedecode($user);
		$uname = $cookie[1];
		if (!isset($uname)) {
			$uname = $ip;
			$guest = 1;
		}
	} else {
		$uname = $ip;
		$guest = 1;
	}
	$uname = $db->sql_escape_string($uname);
	$past = time() - 3600;
	$sql = 'DELETE FROM ' . $prefix . '_session WHERE time < \'' . $past . '\'';
	$db->sql_query($sql);
	$sql = 'SELECT time FROM ' . $prefix . '_session WHERE uname=\'' . $uname . '\'';
	$result = $db->sql_query($sql);
	$ctime = time();
	if (!empty($uname)) {
		$uname = substr($uname, 0, 25);
		$row = $db->sql_fetchrow($result);
		if ($row) {
			$db->sql_query('UPDATE ' . $prefix . '_session SET uname=\'' . $uname . '\', time=\'' . $ctime . '\', host_addr=\'' . $ip . '\', guest=\'' . $guest . '\' WHERE uname=\'' . $uname . '\'');
		} else {
			$db->sql_query('INSERT INTO ' . $prefix . '_session (uname, time, host_addr, guest) VALUES (\'' . $uname . '\', \'' . $ctime . '\', \'' . $ip . '\', \'' . $guest . '\')');
		}
	}
}

function blockfileinc($title, $blockfile, $side, $bid = '') {
	$blockfiletitle = $title;
	$file = file_exists('blocks/'.$blockfile);
	if (!$file) {
		$content = _BLOCKPROBLEM;
	} else {
		include_once NUKE_BLOCKS_DIR . $blockfile;
	}
	if (empty($content)) {
		$content = _BLOCKPROBLEM2;
	} else {
		global $tnsl_bAutoTapBlocks;
		if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
			$content = tnsl_fShortenBlockURLs($blockfile, $content);
		}
	}

	if ($side == 'l' or $side == 'r') {
		themesidebox($blockfiletitle, $content, $bid);
	}
	else {
		themecenterbox($blockfiletitle, $content, $bid);
 }
 }

function cookiedecode($user) {
	global $cookie, $db, $user_prefix;
	static $pass;
	if(!is_array($user)) {
		// PHP8: Deprecated: base64_decode(): Passing null to parameter #1 ($string) of type string is deprecated FIX: added ?? ''
		$user = base64_decode($user ?? '');
		$user = addslashes($user);
		$cookie = explode(':', $user);
	} else {
		$cookie = $user;
	}
	if (!isset($pass) AND isset($cookie[1])) {
		$sql = 'SELECT user_password FROM ' . $user_prefix . '_users WHERE username=\'' . $cookie[1] . '\'';
		$result = $db->sql_query($sql);
		list($pass) = $db->sql_fetchrow($result);
	}
	if (isset($cookie[2]) AND (!empty($pass)) AND ($cookie[2] == $pass)) {
		return $cookie;
	}
}

function getusrinfo($user) {
	global $cookie, $db, $userinfo, $user_prefix;
	if (!$user OR empty($user)) {
		return NULL;
	}
	cookiedecode($user);
	$user = $cookie;
	if (isset($userrow) AND is_array($userrow)) {
		if ($userrow['username'] == $user[1] && $userrow['user_password'] == $user[2]) {
			return $userrow;
		}
	}
	$sql = 'SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . $user[1] . '\' AND user_password=\'' . $user[2] . '\'';
	$result = $db->sql_query($sql);
	if ($db->sql_numrows($result) == 1) {
		static $userrow;
		$userrow = $db->sql_fetchrow($result);
		return $userinfo = $userrow;
	}
	unset($userinfo);
}

function FixQuotes ($what = '') {
	$what = str_replace("'","''",$what);
	while (stripos($what, "\\\\'")) {
		$what = str_replace("\\\\'","'",$what);
	}
	return $what;
}

/**
 * text filter
*/
function check_words($Message = '') {
	global $CensorMode, $CensorReplace, $CensorList;
	$EditedMessage = $Message;
	if ($CensorMode != 0) {
		if (is_array($CensorList)) {
			if ($CensorMode == 1) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = preg_replace("/$CensorList[$i]([^\p{L}\p{N}])/iu", "$CensorReplace\\1", $Message);
				}
			} elseif ($CensorMode == 2) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = preg_replace("/(^|[^\p{L}\p{N}])$CensorList[$i]/iu", "\\1$CensorReplace", $Message);
				}
			} else {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = str_ireplace($CensorList[$i], $CensorReplace, $Message);
				}
			}
		}
	}
	return $EditedMessage;
}

/*
 * As of RN 2.4 this function is not used
*/
function delQuotes($string) {
	/* no recursive function to add quote to an HTML tag if needed */
	/* and delete duplicate spaces between attribs. */
	$tmp = '';    // string buffer
	$result = ''; // result string
	$i = 0;
	$attrib =- 1; // Are us in an HTML attrib ?   -1: no attrib   0: name of the attrib   1: value of the atrib
	$quote = 0;   // Is a string quote delimited opened ? 0=no, 1=yes
	$len = strlen($string);
	while ($i < $len) {
		switch($string[$i]) { // What car is it in the buffer ?
			case '"':  // a quote.
				if ($quote == 0) {
					$quote = 1;
				} else {
					$quote = 0;
					if (($attrib > 0) && ($tmp != '')) $result .= '=\"' . $tmp . '\"';
					$tmp = '';
					$attrib =- 1;
				}
				break;
			case '=':  // an equal - attrib delimiter
				if ($quote == 0) {  // Is it found in a string ?
					$attrib = 1;
					if ($tmp != '') $result .= ' ' . $tmp;
					$tmp = '';
				} else {
					$tmp .= '=';
				}
				break;
			case ' ':  // a blank ?
				if ($attrib > 0) {  // add it to the string, if one opened.
					$tmp .= $string[$i];
				}
				break;
			default:  // Other
				if ($attrib < 0) { // If we weren't in an attrib, set attrib to 0
					$attrib = 0;
				}
				$tmp .= $string[$i];
				break;
		}
		$i++;
	}
	if (($quote != 0) && ($tmp != '')) {
		if ($attrib==1) $result .= '='; // If it is the value of an atrib, add the '='
		$result .= '\"' . $tmp . '\"';  // Add quote if needed (the reason of the function ;-)
	}
	return $result;
}

###############################################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske            http://nukeseo.com
# kses developed by Ulf Harnhammar                      http://kses.sf.net
# kses enhancement ideas contributed by sixonetonoffun  http://netflake.com
# FCKeditor by Frederico Caldeira Knabben               http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen          http://phpnuker.de
#
###############################################################################
/**
 * montego - extended capability to skip the final html check.
 * This is used to allow for content that is posted by an admin to pass through unabated.
 * However, in order to help ensure XHTML compliance, the kses_no_null, kses_js_entities and
 * kses_normalize_entities functions are very useful.
 */
function check_html ($string, $allowed_html = '', $allowed_protocols = array()) {
	include_once NUKE_INCLUDE_DIR . 'kses/kses.php';

	if (stripos_clone($allowed_html, 'nocheck') === true) {
		return $string;
	} else {
		if (stripos_clone($allowed_html, 'nohtml') === false) {
			global $AllowableHTML;
			$allowed_html = $AllowableHTML;
		} else {
			$allowed_html = array('<null>');
		}
		return kses($string, $allowed_html, $allowed_protocols);
	}
}

/**
* Generate WYSISYG Editor
*
* This will echo out the editor.
*
* @param sting $name name attribute of textarea
* @param string $value value of textarea
* @param string $toolbar toolbar to use in editor
* @param int $width width of textarea
* @param int $height height of textarea
*
* @return string
*/
function wysiwyg_textarea($name, $value, $toolbar = 'NukeUser', $width = '100%', $height = '300px') {
	global $admin, $advanced_editor, $currentlang, $language;

	/*
	* Need to following to help with the old cols and rows
	*/
	if (!stripos($height, '%') && !stripos($height, 'px')) {
		$height = '300px';
	}
	if (!stripos($width, '%') && !stripos($width, 'px')) {
		$width = '100%';
	}

	/*
	*  Don't waste bandwidth by loading WYSIWYG editor for crawlers
	*/
	$wysiwyg = 'ckeditor';
	if ($advanced_editor == 0 || empty($wysiwyg) || !isset($_COOKIE)) {
		echo '<textarea id="' . $name . '" name="' . $name . '" style="wrap:virtual; width: ' . $width . '; height: ' . $height . '">' . $value . '</textarea>';
	} else {
		wysiwyg::$wysiwyg = $wysiwyg;
		require_once NUKE_INCLUDE_DIR . $wysiwyg . '/class.' . $wysiwyg . '.php';

		$config = array();
		$editor = call_user_func(array('rn' . $wysiwyg, 'getInstance'), $config);

		/*
		* Editor will not load without a valid toolbar
		*/
		$toolbars = array('PHPNuke', 'NukeUser', 'PHPNukeAdmin');
		$toolbar = (in_array($toolbar, $toolbars)) ? $toolbar : 'NukeUser';
		$editor->setToolbar($toolbar);
		$editor->setHeight($height);
		$editor->setWidth($width);

		$lang = !empty($currentlang) ? $currentlang : $language;
		$editor->setLang($lang);

		if (is_admin($admin)) {
			$editor->setBrowser('includes/elfinder/elfinder.php');
			$editor->setUploader('includes/elfinder/php/modules/' . $wysiwyg . '.php');
		}
		$content = $editor->editor($name, $value);
		wysiwyg::$returnOutput = false;
		return $content;
	}
}

/**
* Generate WYSISYG Editor HTML
*
* This is a clone of wysiwyg_textarea() except it will retrun the editor as HTML
*
* @param sting $name name attribute of textarea
* @param string $value value of textarea
* @param string $toolbar toolbar to use in editor
* @param int $cols width of textarea in columns
* @param int $rows height of textarea in rows
*
* @return string HTML
*/
function wysiwyg_textarea_html($name, $value, $toolbar = 'NukeUser', $width = '100%', $height = '300px') {
	wysiwyg::$returnOutput = true;
	return wysiwyg_textarea($name, $value, $toolbar, $width, $height);
}

function filter_text($Message, $strip='') {
	$EditedMessage = check_words($Message);
	$EditedMessage = check_html($EditedMessage, $strip);
	return $EditedMessage;
}

function filter($what, $strip = '', $save = '', $type = '') {
	if ($strip == 'nohtml') {
		$what = check_html($what, $strip);
		$what = htmlentities(trim($what), ENT_QUOTES, _CHARSET);
		// If the variable $what doesn't come from a preview screen it should be converted
		if ($type != "preview" AND $save != 1) {
			$what = html_entity_decode($what, ENT_QUOTES, _CHARSET);
		}
	}
	if ($save == 1) {
		$what = check_words($what);
		$what = check_html($what, $strip);
		$what = addslashes($what);
	} else {
		$what = stripslashes(FixQuotes($what));
		$what = check_words($what);
		$what = check_html($what, $strip);
	}
	return($what);
}

function formatTimestamp($time) {
	global $datetime, $locale;

	static $localeSet;     // setlocale() can be expensive to call; only need to call it once
	if (!isset($localeSet)) {
		setlocale(LC_TIME, $locale);
		$localeSet = 1;
	}

	if (!is_numeric($time)) {
		preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$time = gmmktime($datetime[4], $datetime[5], $datetime[6], $datetime[2], $datetime[3], $datetime[1]);
	}
	$time -= date('Z');
	$datetime = strftime(_DATESTRING, $time);
	$datetime = ucfirst($datetime);
	return $datetime;
}

function get_author($aid) {
	global $prefix, $db;
	static $users;
	if (isset($users[$aid]) && is_array($users[$aid])) {
		$row = $users[$aid];
	} else {
		$sql = 'SELECT `url`, `email` FROM `' . $prefix . '_authors` WHERE `aid`="' . $db->sql_escape_string($aid) . '"';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result, SQL_ASSOC);
		$users[$aid] = $row;
	}
	$aidurl = $row['url'];
	$aidmail = encode_mail($row['email']);
	if (!empty($aidurl) && $aidurl != 'http://') {
		$content = '<a href="' . $aidurl . '">' . $aid . '</a>';
	} else {
		$content = $aid;
	}
	return $content;
}

function formatAidHeader($aid) {
	$AidHeader = get_author($aid);
	echo $AidHeader;
}

function adminblock() {
	global $admin, $admin_file, $db, $prefix, $user_prefix;
	if (is_admin($admin)) {
		$sql = 'SELECT title, content, bid FROM ' . $prefix . '_blocks WHERE bkey=\'admin\'';
		$result = $db->sql_query($sql);
		while (list($title, $content, $bid) = $db->sql_fetchrow($result)) {
			$content = preg_replace('/\badmin.php/', $admin_file . '.php', $content);
			themesidebox($title, $content, $bid);
		}
		$title = _WAITINGCONT;
		$display = 0;
		$content = '<div class="ul-box"><ul class="rn-ul">';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_queue'));
		$display = $display + $num;
		if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=submissions">' . _SUBMISSIONS . '</a>: ' . $num . '</li>';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_reviews_add'));
		$display = $display + $num;
		if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=reviews">' . _WREVIEWS . '</a>: ' . $num . '</li>';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_links_newlink'));
		$display = $display + $num;
		if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=Links">' . _WLINKS . '</a>: ' . $num . '</li>';
		$modreql = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_links_modrequest WHERE brokenlink=0'));
		$display = $display + $modreql;
		if ($modreql > 0) $content .= '<li><a href="' . $admin_file . '.php?op=LinksListModRequests">' . _MODREQLINKS . '</a>: ' . $modreql . '</li>';
		$brokenl = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_links_modrequest WHERE brokenlink=1'));
		$display = $display + $brokenl;
		if ($brokenl > 0) $content .= '<li><a href="' . $admin_file . '.php?op=LinksListBrokenLinks">' . _BROKENLINKS . '</a>: ' . $brokenl . '</li>';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsngd_new'));
		$display = $display + $num;
		if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=DownloadNew">' . _UDOWNLOADS . '</a>: ' . $num . '</li>';
		$modreqd = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsngd_mods WHERE brokendownload=0'));
		$display = $display + $modreqd;
		if ($modreqd > 0) $content .= '<li><a href="' . $admin_file . '.php?op=DownloadModifyRequests">' . _MODREQDOWN . '</a>: ' . $modreqd . '</li>';
		$brokend = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsngd_mods WHERE brokendownload=1'));
		$display = $display + $brokend;
		if ($brokend > 0) $content .= '<li><a href="' . $admin_file . '.php?op=DownloadBroken">' . _BROKENDOWN . '</a>: ' . $brokend . '</li>';
		$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_gcal_event WHERE approved = 0');
		list($num) = $db->sql_fetchrow($result, SQL_NUM);
		$display = $display + $num;
		if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=gcalendar">' . _GCALENDAR_EVENTS . '</a>: ' . $num . '</li>';
		if (file_exists('modules/Your_Account/credits.html')) {
			$ya_expire = 0;
			$past = 0;
			$configresult = $db->sql_query('SELECT `config_name` , `config_value` FROM `' . $user_prefix . '_users_config` WHERE `config_name`=\'expiring\'');
			$ya_config = $db->sql_fetchrow($configresult);
			$ya_expire = $ya_config['config_value'];
			if ($ya_expire != 0) {
				$past = time() - $ya_expire;
				$res = $db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users_temp WHERE time < \'' . $past . '\'');
				while (list($uid) = $db->sql_fetchrow($res)) {
					$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id = \'' . $uid . '\'');
					$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $uid . '\'');
				}
			}
			$result = $db->sql_query('SELECT COUNT(*) FROM `' . $user_prefix . '_users_temp` WHERE `admin_approve`= 1');
			list($numapproved) = $db->sql_fetchrow($result, SQL_NUM);
			$result = $db->sql_query('SELECT COUNT(*) FROM `' . $user_prefix . '_users_temp` WHERE `admin_approve`= 0');
			list($numneeds) = $db->sql_fetchrow($result, SQL_NUM);
			$num = $numapproved + $numneeds;
			$display = $display + $num;
			if ($num > 0) $content .= '<li><a href="' . $admin_file . '.php?op=yaUsers" title="' . _WAITINGAPPROVAL . ' = '. $numneeds . ' '._WAITINGACTIVATION.' = '. $numapproved . '">' . _USERS . '</a>: ' . $num . '</li>';
		}
		$content .= '</ul></div><div class="block-spacer">&nbsp;</div>';
		if($display > 0) themesidebox($title, $content, $bid);
	}
}

function loginbox($gfx_check) {
	global $user, $gfx_chk;
	if (!is_user($user)) {
		$title = _LOGIN;
		$boxstuff = '<form action="modules.php?name=Your_Account" method="post">';
		$boxstuff .= '<div class="content text-center">' . _NICKNAME . '<br />';
		$boxstuff .= '<input type="text" name="username" size="8" maxlength="25" /><br />';
		$boxstuff .= _PASSWORD . '<br />';
		$boxstuff .= '<input type="password" name="user_password" size="8" maxlength="20" /><br />';
		/**
		 * GFX Code  v1.0.0
		*/
		$boxstuff .= security_code(array(2,4,5,7), 'stacked');
		$boxstuff .= '<input type="hidden" name="op" value="login" />';
		$boxstuff .= '<input type="submit" value="'._LOGIN.'" /></div></form>';
		$boxstuff .= '<div class="text-center content">' . _ASREGISTERED . '</div>';
		themesidebox($title, $boxstuff, 'rn_login_box');
	}
}

function userblock() {
	global $cookie, $db, $user_prefix, $user, $userinfo;
	if(is_user($user)) {
		getusrinfo($user);
		if($userinfo['ublockon']) {
			$sql = 'SELECT ublock FROM ' . $user_prefix . '_users WHERE user_id=\'' . $cookie[0] . '\'';
			$result = $db->sql_query($sql);
			list($ublock) = $db->sql_fetchrow($result);
			$title = _MENUFOR.' '.$cookie[1];
			themesidebox($title, $ublock, 'rn_user_box');
		}
	}
}

//This function should be in news not here.  Will move later.
function getTopics($s_sid) {
	global $db, $prefix, $topicimage, $topicname, $topictext;
	$sid = intval($s_sid);
	$result = $db->sql_query('SELECT t.topicname, t.topicimage, t.topictext FROM ' . $prefix . '_stories s LEFT JOIN ' . $prefix . '_topics t ON t.topicid = s.topic WHERE s.sid = \'' . $sid . '\'');
	$row = $db->sql_fetchrow($result);
	$topicname = $row['topicname'];
	$topicimage = $row['topicimage'];
	$topictext = $row['topictext'];
}

/**
 * nukePIE
 * http://www.nukeSEO.com
 * Copyright 2007 by Kevin Guske
*/
include_once NUKE_INCLUDE_DIR . 'nukeSEO/nukeSEOfunctions.php';

function headlines($bid, $side) {
	global $db, $prefix;
	# Get Feed Information
	$result = $db->sql_query('SELECT title, url, refresh, max_rss_items FROM ' . $prefix . '_blocks WHERE bid=\'' . $bid . '\'');
	list($title, $url, $refresh, $maxrss) = $db->sql_fetchrow($result);
	$content = seoReadFeed($url, $maxrss, $refresh);
	$siteurl = str_ireplace('http://', '', $url);
	$siteurl = explode('/', $siteurl);
	$content .= '<br /><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td><a href="http://'.$siteurl[0].'" title="'.$title.'" target="blank">'
		. '<span class="thick">' . _HREADMORE . '</span></a></td><td align="right"><a href="http://nukeseo.com" title="nukePIE (c) nukeSEO.com">&copy;</a></td></tr></table>';
	if ($side == 'r' or $side == 'l') {
		themesidebox($title, $content, $bid);
	} else {
		themecenterbox($title, $content, $bid);
	}
}

function seoReadFeed ($url = '', $maxrss = 20, $refresh = 3600) {
	global $useBoxoverWithnukePIE;
	include_once NUKE_INCLUDE_DIR . 'SimplePie/simplepie.inc';
	include_once NUKE_INCLUDE_DIR . 'SimplePie/idn/idna_convert.class.php';
	// Create a new instance of the SimplePie object
	$feed = new SimplePie();
	if ($maxrss == 0) $maxrss = 20;
	// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, etc.
	$feed->set_feed_url($url);
	$feed->set_output_encoding(_CHARSET);
	$feed->set_cache_duration($refresh);
	$feed->init();
	$feed->handle_content_type();
	$content = '<div class="content">';
	if (isset($feed->error)) {
		// If errors, display it.
		$content .= htmlspecialchars($feed->error, ENT_QUOTES, _CHARSET);
	} else {
		foreach($feed->get_items(0,$maxrss) as $item) {
			$content .= '&middot;';
			// If the item has a permalink back to the original post, link the item's title to it.
			if ($item->get_permalink()) {
				$content .= '<a href="' . $item->get_permalink() . '" title="';
				$item_desc = $item->get_description();
				if ($useBoxoverWithnukePIE) {
					if ($item_desc == check_html($item_desc, 'nohtml')) $item_desc = nl2br($item_desc);
					$content .= 'cssbody=[nukePIEbody] cssheader=[nukePIEhdr] header=['.encodeBoxover(check_html($item->get_title(), 'nohtml')).'] body=['.encodeBoxover(xmlentities($item_desc)).'] singleclickstop=[On] ';
				} else {
					$content .= check_html($item_desc, 'nohtml');
				}
				$content .= '">';
			}
			$content .= check_html($item->get_title(), 'nohtml');
			if ($item->get_permalink()) {
				$content .= '</a>';
			}
			$content .= '<br />'.chr(10);
		}
	}
	$content .= '&nbsp;</div>';
	return $content;
}

function automated_news() {
	global $currentlang, $db, $multilingual, $prefix;
	if ($multilingual == 1) {
		$querylang = 'WHERE (`alanguage`=\'' . $currentlang . '\' OR `alanguage`=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
	} else {
		$querylang = '';
	}
	$date = date('Y\-m\-d H\:i\:\0\0');
	// date stored in autonews as, for example: 2011-09-14 06:00:00
	$result = $db->sql_query('SELECT `anid`, `time` FROM `' . $prefix . '_autonews` ' . $querylang);
	while (list($anid, $time) = $db->sql_fetchrow($result, SQL_NUM)) {
		if ($time <= $date) {
			$result2 = $db->sql_query('SELECT * FROM `' . $prefix . '_autonews` WHERE `anid`=\'' . $anid . '\'');
			while ($row2 = $db->sql_fetchrow($result2, SQL_ASSOC)) {
				$db->sql_query('INSERT INTO `' . $prefix . '_stories` VALUES (NULL, \'' . $row2['catid'] . '\', \'' . $row2['aid'] . '\', \'' . $db->sql_escape_string($row2['title']) . '\', \'' . $row2['time']
					. '\', \'' . $db->sql_escape_string($row2['hometext']) . '\''. ', \'' . $db->sql_escape_string($row2['bodytext']) . '\', 0, 0, \'' . $db->sql_escape_string($row2['topic'])
					. '\', \'' . $db->sql_escape_string($row2['informant']) . '\', \'' . $db->sql_escape_string($row2['notes']) . '\', \'' . $row2['ihome'] . '\', \'' . $db->sql_escape_string($row2['alanguage'])
					. '\'' . ', \'' . $row2['acomm'] . '\', 0, 0, 0, 0, \'' . $db->sql_escape_string($row2['associated']) . '\')');
				$lastid = $db->sql_nextid();
				$db->sql_query('DELETE FROM `' . $prefix . '_autonews` WHERE `anid`=\'' . $anid . '\'');
				$sql_tags_autonews = $db->sql_query('SELECT `tag` FROM `' . $prefix . '_tags_temp` WHERE `whr`=5 AND `cid`="' . $anid . '"');
				if ($db->sql_numrows($sql_tags_autonews) > 0) {
					while (list($tag) = $db->sql_fetchrow($sql_tags_autonews, SQL_NUM)) {
						$tags[] = $tag;
					}
					$sql = '';
					foreach ($tags as $tag) {
						if (!empty($sql)) $sql .= ', ';
						$sql .= '("' . $db->sql_escape_string($tag) . '", "' . $lastid . '", "3")';
					}
					$db->sql_query('INSERT INTO `' . $prefix . '_tags` (tag,cid,whr) VALUES ' . $sql);
					$db->sql_query('DELETE FROM `' . $prefix . '_tags_temp` WHERE `cid`="' . $anid . '" AND `whr`="5"');
				}
			}
		}
	}
}

function public_message() {
	global $admin, $broadcast_msg, $cookie, $db, $prefix, $p_msg, $user, $user_prefix;
	if ($broadcast_msg == 1) {
		if (is_user($user)) {
			cookiedecode($user);
			$result = $db->sql_query('SELECT broadcast FROM ' . $user_prefix . '_users WHERE username=\'' . $cookie[1] . '\'');
			$row = $db->sql_fetchrow($result);
			$upref = $row['broadcast'];  // broadcast is a tinyint
			if ($upref == 1) {
				$t_off = '<br /><p align="right">[ <a href="modules.php?name=Your_Account&amp;op=edithome">';
				$t_off .= '<span syle="font-size: small;">' . _TURNOFFMSG . '</span></a> ]</p>';
				$pm_show = 1;
			} else {
				$pm_show = 0;
			}
		} else {
			$t_off = '';
		}
		if (!is_user($user) OR (is_user($user) AND ($pm_show == 1))) {
			$c_mid = base64_decode($p_msg);
			$c_mid = addslashes($c_mid);
			$c_mid = intval($c_mid);
			$result2 = $db->sql_query('SELECT mid, content, date, who FROM ' . $prefix . '_public_messages WHERE mid > ' . $c_mid . ' ORDER BY date ASC LIMIT 1');
			$numrows_pm = $db->sql_numrows($result2);
			if ($numrows_pm == 1) {
				$row2 = $db->sql_fetchrow($result2);
				$mid = $row2['mid'];
				$content = $row2['content'];
				$tdate = $row2['date'];
				$who = $row2['who'];
				if ((!isset($c_mid)) OR ($c_mid = $mid)) {
					$public_msg = '<br /><table width="90%" border="1" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF" align="center"><tr><td>';
					$public_msg .= '<table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#FF0000"><tr><td align="left">';
					$public_msg .= '<span style="color: #FFFFFF; font-size: medium; font-weight: bold;">' . _BROADCASTFROM . ' <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $who . '">'
								. '<span style="font-style: italic;">' . $who . '</span></a>: "' . $content . '"</span>';
					$public_msg .= $t_off;
					$public_msg .= '</td></tr></table>';
					$public_msg .= '</td></tr></table>';
					$ref_date = $tdate + 600;
					$actual_date = time();
					if ($actual_date >= $ref_date) {
						$public_msg = '';
						$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_public_messages'));
						if ($numrows == 1) {
							$db->sql_query('DELETE FROM ' . $prefix . '_public_messages');
							$mid = 0;
						} else {
							$db->sql_query('DELETE FROM ' . $prefix . '_public_messages WHERE mid=\'' . $mid . '\'');
						}
					}
					if ($mid == 0 OR empty($mid)) {
						setcookie('p_msg');
					} else {
						$mid = base64_encode($mid);
						$mid = addslashes($mid);
						setcookie('p_msg', $mid, time() + 600);
					}
				}
			}
		}
	} else {
		$public_msg = '';
	}
	if (empty($public_msg)) $public_msg = '';
	return $public_msg;
}

function get_theme($refresh = false) {
	global $admin, $db, $Default_Theme, $prefix, $user;
	static $theme = false;

	/**
	 * Needed for fix to admin theme bug
	 * Can not implement because theme is determined in mainfile.php before admin is logged in
	 */
	//if (!$refresh) {
		if ($theme) {
			return $theme;
		}
	//}

	if (is_admin($admin)) {
		if (isset($_COOKIE['Theme_Preview'])) {
			$theme = check_html($_COOKIE['Theme_Preview'], 'nohtml');
			if(!file_exists('themes/' . $theme . '/theme.php')) {
				$theme = $Default_Theme;
			}
			return $theme;
		} elseif (!is_user($user)) {
			$theme = $Default_Theme;
			return $theme;
		}
	}

	if (!is_user($user)) {
		$results = $db->sql_query('SELECT `theme` FROM `' . $prefix . '_themes` WHERE `guest`=1');
		if ($results) {
			$row = $db->sql_fetchrow($results);
			$theme = $row['theme'];
			if(!file_exists('themes/' . $theme . '/theme.php')) {
				$theme = $Default_Theme;
			}
		} else {
			$theme = $Default_Theme;
		}
		return $theme;
	}

	$user2 = explode(':', base64_decode(addslashes($user)));
	$user_id = intval($user2[0]);
	if($user2[9]) {
		if(!file_exists('themes/' . $user2[9] . '/theme.php')) {
			$theme = $Default_Theme;
		} else {
			$theme = $user2[9];
		}
	} else {
		$theme = $Default_Theme;
	}
	return $theme;
}

function removecrlf($str) {
	return strtr($str, "\015\012", ' ');
}

function validate_mail($email) {
	if(strlen($email) < 7 || !preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
		return false;
	} else {
		return $email;
	}
}

/**
 * Validate various forms of IP address but initially
 * it will only be used to validate simple ipv4.
 * @param string $ip IP address to validate
 * @param string $type eventually will drive what IP format to validate
 * @return boolean will be "true" if a valid IP and "false" otherwise
 */
function validIP($ip, $type='') {
	if (empty($type)) {
		if (defined('REGEX_IPV4')) { // From NukeSentinel(tm)
			$regex = REGEX_IPV4;
		} else {
			$regex = "/^(1?\d{1,2}|2([0-4]\d|5[0-5]))(\.(1?\d{1,2}|2([0-4]\d|5[0-5]))){3}$/";
		}
	} else return false;
	return (preg_match($regex, $ip) == 1) ? true : false;
}

/**
 * [ Base:    function validateEmailFormat ($email) ]
 *
 * Copyright (C) 2001 Ron Harwood and L. Patrick Smallwood
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * File: functions/validateemailformat.php
*/
function validateEmailFormat ($email) {
	// This is based on page 295 of the book 'Mastering Regular Expressions' - the most
	// definitive RFC-compliant email regex.

	// Some shortcuts for avoiding backslashitis
	$esc        = '\\\\';
	$Period      = '\.';
	$space      = '\040';
	$tab         = '\t';
	$OpenBR     = '\[';
	$CloseBR     = '\]';
	$OpenParen  = '\(';
	$CloseParen  = '\)';
	$NonASCII   = '\x80-\xff';
	$ctrl        = '\000-\037';
	$CRlist     = '\n\015';  // note: this should really be only \015.

	// Items 19, 20, 21 -- see table on page 295 of 'Mastering Regular Expressions'
	$qtext = "[^$esc$NonASCII$CRlist\"]";              // for within "..."
	$dtext = "[^$esc$NonASCII$CRlist$OpenBR$CloseBR]"; // for within [...]
	$quoted_pair = " $esc [^$NonASCII] ";              // an escaped character

	// Items 22 and 23, comment.
	// Impossible to do properly with a regex, I make do by allowing at most
	// one level of nesting.
	$ctext = " [^$esc$NonASCII$CRlist()] ";

	// $Cnested matches one non-nested comment.
	// It is unrolled, with normal of $ctext, special of $quoted_pair.
	$Cnested = "";
	$Cnested .= "$OpenParen";                     // (
	$Cnested .= "$ctext*";                        //       normal*
	$Cnested .= "(?: $quoted_pair $ctext* )*";    //       (special normal*)*
	$Cnested .= "$CloseParen";                    //                         )

	// $comment allows one level of nested parentheses
	// It is unrolled, with normal of $ctext, special of ($quoted_pair|$Cnested)
	$comment = "";
	$comment .= "$OpenParen";                     //  (
	$comment .= "$ctext*";                        //     normal*
	$comment .= "(?:";                            //       (
	$comment .= "(?: $quoted_pair | $Cnested )";  //         special
	$comment .= "$ctext*";                        //         normal*
	$comment .= ")*";                             //            )*
	$comment .= "$CloseParen";                    //                )

	// $X is optional whitespace/comments
	$X = "";
	$X .= "[$space$tab]*";                  // Nab whitespace
	$X .= "(?: $comment [$space$tab]* )*";  // If comment found, allow more spaces


	// Item 10: atom
	$atom_char = "[^($space)<>\@,;:\".$esc$OpenBR$CloseBR$ctrl$NonASCII]";
	$atom = "";
	$atom .= "$atom_char+";    // some number of atom characters ...
	$atom .= "(?!$atom_char)"; // ... not followed by something that
	//     could be part of an atom

	// Item 11: doublequoted string, unrolled.
	$quoted_str = "";
	$quoted_str .= "\"";                            // "
	$quoted_str .= "$qtext *";                      //   normal
	$quoted_str .= "(?: $quoted_pair $qtext * )*";  //   ( special normal* )*
	$quoted_str .= "\"";                            //        "


	// Item 7: word is an atom or quoted string
	$word = "";
	$word .= "(?:";
	$word .= "$atom";        // Atom
	$word .= "|";            // or
	$word .= "$quoted_str";  // Quoted string
	$word .= ")";

	// Item 12: domain-ref is just an atom
	$domain_ref = $atom;

	// Item 13: domain-literal is like a quoted string, but [...] instead of "..."
	$domain_lit = "";
	$domain_lit .= "$OpenBR";                        // [
	$domain_lit .= "(?: $dtext | $quoted_pair )*";   //   stuff
	$domain_lit .= "$CloseBR";                       //         ]

	// Item 9: sub-domain is a domain-ref or a domain-literal
	$sub_domain = "";
	$sub_domain .= "(?:";
	$sub_domain .= "$domain_ref";
	$sub_domain .= "|";
	$sub_domain .= "$domain_lit";
	$sub_domain .= ")";
	$sub_domain .= "$X"; // optional trailing comments

	// Item 6: domain is a list of subdomains separated by dots
	$domain = "";
	$domain .= "$sub_domain";
	$domain .= "(?:";
	$domain .= "$Period $X $sub_domain";
	$domain .= ")*";

	// Item 8: a route. A bunch of "@ $domain" separated by commas, followed by a colon.
	$route = "";
	$route .= "\@ $X $domain";
	$route .= "(?: , $X \@ $X $domain )*"; // additional domains
	$route .= ":";
	$route .= "$X"; // optional trailing comments

	// Item 5: local-part is a bunch of $word separated by periods
	$local_part = "";
	$local_part .= "$word $X";
	$local_part .= "(?:";
	$local_part .= "$Period $X $word $X"; // additional words
	$local_part .= ")*";

	// Item 2: addr-spec is local@domain
	$addr_spec = "$local_part \@ $X $domain";

	// Item 4: route-addr is <route? addr-spec>
	$route_addr = "";
	$route_addr .= "< $X";
	$route_addr .= "(?: $route )?"; // optional route
	$route_addr .= "$addr_spec";    // address spec
	$route_addr .= ">";

	// Item 3: phrase........
	$phrase_ctrl = '\000-\010\012-\037'; // like ctrl, but without tab

	// Like atom-char, but without listing space, and uses phrase_ctrl.
	// Since the class is negated, this matches the same as atom-char plus space and tab
	$phrase_char = "[^()<>\@,;:\".$esc$OpenBR$CloseBR$NonASCII$phrase_ctrl]";

	// We've worked it so that $word, $comment, and $quoted_str to not consume trailing
	// $X because we take care of it manually.
	$phrase = "";
	$phrase .= "$word";                            // leading word
	$phrase .= "$phrase_char *";                   // "normal" atoms and/or spaces
	$phrase .= "(?:";
	$phrase .= "(?: $comment | $quoted_str )";     // "special" comment or quoted string
	$phrase .= "$phrase_char *";                   //  more "normal"
	$phrase .= ")*";

	// Item 1: mailbox is an addr_spec or a phrase/route_addr
	$mailbox = "";
	$mailbox .= "$X";                    // optional leading comment
	$mailbox .= "(?:";
	$mailbox .= "$addr_spec";            // address
	$mailbox .= "|";                     // or
	$mailbox .= "$phrase  $route_addr";  // name and address
	$mailbox .= ")";

	// test it and return results
	$isValid = preg_match("/^$mailbox$/xS",$email);

	// Added by Raven 1/14/2007
	if ($isValid) {
		return $email;
	} else {
		return $isValid;
	}
} // END validateEmailFormat

function encode_mail($email) {
	// From RavenPHPScripts
	$strEncodedEmail = '';
	for ($i=0; $i < strlen($email); ++$i) {
		$n = rand(0, 1);
		if ($n) {
			$strEncodedEmail .= '&#x'. sprintf("%X", ord($email[$i])) . ';';
		} else {
			$strEncodedEmail .= '&#' . ord($email[$i]) . ';';
		}
	}
	return $strEncodedEmail;
}

function paid() {
	global $adminmail, $cookie, $db, $nukeurl, $prefix, $sitename, $subscription_url, $user_prefix, $user;
	if (is_user($user)) {
		if (!empty($subscription_url)) {
			$renew = _SUBRENEW . ' ' . $subscription_url;
		} else {
			$renew = '';
		}
		cookiedecode($user);
		$sql = 'SELECT * FROM ' . $prefix . '_subscriptions WHERE userid=\'' . $cookie[0] . '\'';
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		if ($numrows == 0) {
			return 0;
		} elseif ($numrows != 0) {
			$time = time();
			if ($row['subscription_expire'] <= $time) {
				$db->sql_query('DELETE FROM ' . $prefix . '_subscriptions WHERE userid=\'' . $cookie[0] . '\' AND id=\'' . $row['id'] . '\'');
				$from = $sitename . ' <' . $adminmail . '>';
				$subject = $sitename . ': ' . _SUBEXPIRED;
				$body = _HELLO . ' ' . $cookie[1] . ":\n\n" . _SUBSCRIPTIONAT . ' ' . $sitename . ' ' . _HASEXPIRED . "\n" . $renew . "\n\n" . _HOPESERVED . "\n\n" . $sitename . ' ' . _TEAM . "\n" . $nukeurl;
				$row = $db->sql_fetchrow($db->sql_query('SELECT user_email, username FROM ' . $user_prefix . '_users WHERE user_id=\'' . $cookie[0] . '\' AND nickname=\'' . $cookie[1] . '\' AND password=\'' . $cookie[2] . '\''));
				$mailsuccess = false;
				if (TNML_IS_ACTIVE) {
					$to = array(array($row['user_email'], $row['username']));
					$mailsuccess = tnml_fMailer($to, $subject, $body, $adminmail, $sitename);
				} else {
					$mailsuccess = mail($row['user_email'], $subject, $body, "From: $from\r\nX-Mailer: PHP/" . phpversion());
				}
			}
			return 1;
		}
	} else {
		return 0;
	}
}

/*
 * Added for Advertizing module from v7.8
*/
function makePass() {
	$cons = 'bcdfghjklmnpqrstvwxyz';
	$vocs = 'aeiou';
	for ($x=0; $x < 6; $x++) {
		mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr($cons, mt_rand(0, strlen($cons) - 1), 1);
		$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs) - 1), 1);
	}
	mt_srand((double)microtime() * 1000000);
	$num1 = mt_rand(0, 9);
	$num2 = mt_rand(0, 9);
	$makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
	return($makepass);
}

//Should ads() function be in mainfile?
function ads($position) {
	global $admin, $adminmail, $db, $nukeurl, $prefix, $sitename;
	$position = intval($position);
	if (paid()) {
		return;
	}
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=' . $position . ' AND active=\'1\''));
	/* Get a random banner if exist any. */
	if ($numrows > 1) {
		$numrows = $numrows - 1;
		mt_srand((double)microtime() * 1000000);
		$bannum = mt_rand(0, $numrows);
	} else {
		$bannum = 0;
	}
	$sql = 'SELECT bid, impmade, imageurl, clickurl, alttext FROM ' . $prefix . '_banner WHERE position=' . $position . ' AND active=1 LIMIT ' . $bannum . ',1';
	$result = $db->sql_query($sql);
	list($bid, $impmade, $imageurl, $clickurl, $alttext) = $db->sql_fetchrow($result);
	$db->sql_query('UPDATE ' . $prefix . '_banner SET impmade=impmade+1 WHERE bid=\'' . $bid . '\'');
	if($numrows > 0) {
		$sql2 = 'SELECT cid, imptotal, impmade, clicks, date, ad_class, ad_code, ad_width, ad_height FROM ' . $prefix . '_banner WHERE bid=\'' . $bid . '\'';
		$result2 = $db->sql_query($sql2);
		list($cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height) = $db->sql_fetchrow($result2);
		/* Check if this impression is the last one and print the banner */
		if (($imptotal <= $impmade) AND ($imptotal != 0)) {
			$db->sql_query('UPDATE ' . $prefix . '_banner SET active=0 WHERE bid=\'' . $bid . '\'');
			$sql3 = 'SELECT name, contact, email FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\'';
			$result3 = $db->sql_query($sql3);
			list($c_name, $c_contact, $c_email) = $db->sql_fetchrow($result3);
			if (!empty($c_email)) {
				$from = $sitename . ' <' . $adminmail . '>';
				$to = $c_contact . ' <' . $c_email . '>';
				$message = _HELLO . ' ' . $c_contact . ":\n\n";
				$message .= _THISISAUTOMATED . "\n\n";
				$message .= _THERESULTS . "\n\n";
				$message .= _TOTALIMPRESSIONS . ' ' . $imptotal . "\n";
				$message .= _CLICKSRECEIVED . ' ' . $clicks . "\n";
				$message .= _IMAGEURL . ' ' . $imageurl . "\n";
				$message .= _CLICKURL . ' ' . $clickurl . "\n";
				$message .= _ALTERNATETEXT . ' ' . $alttext . "\n\n";
				$message .= _HOPEYOULIKED . "\n\n";
				$message .= _THANKSUPPORT . "\n\n";
				$message .= '- ' . $sitename . ' ' . _TEAM . "\n";
				$message .= $nukeurl;
				$subject = $sitename . ': ' . _BANNERSFINNISHED;

				$mailsuccess = false;
				if (TNML_IS_ACTIVE) {
					$to2 = array(array($c_email, $c_contact));
					$mailsuccess = tnml_fMailer($to2, $subject, $body, $adminmail, $sitename);
				} else {
					$mailsuccess = mail($to, $subject, $message, 'From: ' . "$from\r\n" . 'X-Mailer: PHP/' . phpversion());
				}
			}
		}
		if ($ad_class == 'code') {
			$ads = '<div class="text-center">' . $ad_code . '</div>';
		} elseif ($ad_class == 'flash') {
			$ads = '<div class="text-center">'
				. '<!--[if !IE]> -->'
				. '<object type="application/x-shockwave-flash" data="' . $imagurl . '" name="' . $bid . '" width="' . $ad_width . '" height="' . $ad_height . '">'
				. '<!-- <![endif]-->'
				. '<!--[if IE]>'
				. '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"'
				. ' name="' . $bid . '" width="' . $ad_width . '" height="' . $ad_height . '">'
				. '<param name="movie" value="' . $img_url . '" />'
				. '<!--><!--dgx-->'
				. '<param name="loop" value="true" />'
				. '<param name="menu" value="false" />'
				. '<p><b>Your browser says it supports Flash <br />but doesn\'t seem to have the correct plug-in or it\'s missing.</p>'
				. '</object>'
				. '<!-- <![endif]--></div>';
		} else {
			$ads = '<div class="text-center"><a href="index.php?op=ad_click&amp;bid=' . $bid . '" target="_blank"><img src="' . $imageurl . '" style="border: 0 none;" alt="' . $alttext . '" title="' . $alttext . '" /></a></div>';
		}
	} else {
		$ads = '';
	}
	return $ads;
}

/*
 * functions added to support dynamic and ordered loading of CSS and JS in <HEAD> and before </BODY>
 */
function addCSSToHead($content, $type='file') {
	global $headCSS;
	// Duplicate external file?
	if (($type == 'file') && (is_array($headCSS) && count($headCSS) > 0) && (in_array(array($type, $content), $headCSS))) return;
	$headCSS[] = array($type, $content);
	return;
}

function addJSToHead($content, $type='file') {
	global $headJS;
	// Duplicate external file?
	if (($type == 'file') && (is_array($headJS) && count($headJS) > 0) && (in_array(array($type, $content), $headJS))) return;
	$headJS[] = array($type, $content);
	return;
}

function addJSToBody($content, $type='file') {
	global $bodyJS;
	// Duplicate external file?
	if (($type == 'file') && (is_array($bodyJS) && count($bodyJS) > 0) && (in_array(array($type, $content), $bodyJS))) return;
	$bodyJS[] = array($type, $content);
	return;
}

function writeHEAD() {
	global $headCSS, $headJS;
	if (is_array($headCSS) && count($headCSS) > 0) {
		foreach($headCSS AS $css) {
			if ($css[0]=='file') {
				echo '<link rel="StyleSheet" href="' . $css[1] . '" type="text/css" />' . "\n";
			} else {
				echo $css[1];
			}
		}
	}
	if (is_array($headJS) && count($headJS) > 0) {
		foreach($headJS AS $js) {
			if ($js[0] == 'file') {
				echo '<script type="text/javascript" language="JavaScript" src="' . $js[1] . '"></script>' . "\n";
			} else {
				echo $js[1];
			}
		}
	}
	return;
}

function writeBODYJS() {
	global $bodyJS;
	if (is_array($bodyJS) && count($bodyJS) > 0) {
		foreach($bodyJS AS $js) {
			if ($js[0] == 'file') {
				echo '<script type="text/javascript" language="JavaScript" src="' . $js[1] . '"></script>' . "\n";
			} else {
				echo $js[1];
			}
		}
	}
	return;
}

function readDIRtoArray($dir, $filter) {
	$files = array();
	$handle = opendir($dir);
	while (false !== ($file = readdir($handle))) {
		if (preg_match($filter, $file)) {
			$files[] = $file;
		}
	}
	closedir($handle);
	return $files;
}

?>