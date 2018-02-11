<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id: themes.php 3956 2013-02-09 05:02:12Z palbin $
 * @copyright (c) 2013 Raven Web Services, LLC
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (!defined('ADMIN_FILE')) {
	header('Location: ../../index.php');
	die('Access Denied');
}

if (is_mod_admin('founder')) {
	if ( empty($_POST['themeop']) && empty($_GET['themeop']) ) {
		$themeop = 'Themes';
	} else {
		if (isset($_POST['themeop'])) {
			$themeop = $_POST['themeop'];
		} else {
			$themeop = $_GET['themeop'];
		}
	}
	switch ($themeop) {
		default:
		case 'Themes':
			themes();
			break;
		case 'ThemeSave':
			csrf_check();
			$themes = !empty($_POST['themes']) ? $_POST['themes'] : '';
			$Reg_Theme = !empty($_POST['Reg_Theme']) ? $_POST['Reg_Theme'] : '';
			$Guest_Theme = !empty($_POST['Guest_Theme']) ? $_POST['Guest_Theme'] : '';
			themeSave($themes, $Reg_Theme, $Guest_Theme);
			break;
		case 'scan':
			csrf_check();
			scanCompatibility();
			break;
	}

} else {
	echo 'Access Denied';
}

/**
 * Main function for theme managemnet
 *
 * @param string $status status of save, compatibility test, etc
 *
 * @return string HTML
 */
function themes($status = '') {
	global $admin_file, $db, $Default_Theme, $prefix, $themeop;
	if ($themeop != 'scan') {
		addThemes();
	}

	addCSSToHead('includes/jquery/css/colorbox.css','file');
	addJSToHead('includes/jquery/jquery.js', 'file');
	addJSToHead('includes/jquery/jquery.cookie.js', 'file');
	addJSToHead('includes/jquery/jquery.colorbox-min.js','file');
	$inlineJS = '
	<script type="text/javascript">
	/* <![CDATA[ */
	$(document).ready(function() {
		$(".OptionState").click(function() {
			if($(this).children("img").attr("src") == "images/active.gif") {
				$(this).children("img").attr("src", "images/inactive.gif");
				$(this).siblings("input").attr("value", "0");
			} else {
				$(this).children("img").attr("src", "images/active.gif");
				$(this).siblings("input").attr("value", "1");
			}
			return false;
		});

		var setCookieName = "Theme_Preview"
		var setCookieExpire = "";
		var setCookiePath = "/";
		var setCookieDomain = "";
		var setCookieSecure = false;

		$("a.PreviewTheme").click(function() {
			var theme = $(this).attr("id");
			theme = theme.substr(1);
			var url = $(this).attr("href");
			$.colorbox({
				href: url,
				width:"95%",
				height:"95%",
				iframe:true,
				onOpen:function(){ Cookies.set(setCookieName, theme, { expires: setCookieExpire, path: setCookiePath, domain: setCookieDomain, secure: setCookieSecure }); },
				onCleanup:function(){ Cookies.set(setCookieName, "0", { expires: -1, path: setCookiePath, domain: setCookieDomain, secure: setCookieSecure }); }
			});
			return false;
		});

	});
	/* ]]> */
	</script>';
	addJSToHead($inlineJS, 'inline');

	include 'header.php';

	GraphicAdmin();
	OpenTable();

	echo '<div class="text-center">'
		, '<span class="title"><a name="topconfig"></a>' , _THEMECONFIG , '</span><br /><br />';

	if (!empty($status)) {
		echo '<fieldset class="display-inline"><legend>' , _STATUS , '</legend>' , $status , '</fieldset><br /><br />';
	} else {
		echo '<br />';
	}

	echo '<form method="post" action="' , $admin_file , '.php?op=Themes#topconfig">'
		, _DEFAULTTHEME , ':<br /><br />' , _USERS , ': <select style="margin: 0 1em 0 0;" name="Reg_Theme">';

	$results = $db->sql_query('SELECT `Default_Theme` FROM `' . $prefix . '_config`');
	$config = $db->sql_fetchrow($results, SQL_ASSOC);
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_themes` ORDER BY `themename` ASC');
	$row = $db->sql_fetchrowset($result, SQL_ASSOC);
	foreach($row as $key => $val) {
		if ($val['theme'] == $config['Default_Theme']) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		if ($val['theme'] != '' && $val['themename'] != '') {
			echo '<option value="' , $val['theme'] , '"' , $sel , '>' , $val['themename'] , '</option>';
		}
	}
	echo '</select>';
	echo ucfirst(_RWS_WIW_GUESTS) , ': <select name="Guest_Theme">';

	//$result = $db->sql_query('SELECT * FROM `' . $prefix . '_themes` ORDER BY `themename` ASC');
	//$row = $db->sql_fetchrowset($result, SQL_ASSOC);
	foreach($row as $key => $val) {
		if ($val['guest'] == 1) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		if ($val['theme'] != '' && $val['themename'] != '') {
			echo '<option value="' , $val['theme'] , '"' , $sel , '>' , $val['themename'] , '</option>';
		}
	}
	echo '</select><br /><br />';

	echo '<table class="centered ui-widget" style="width: auto; padding: 4px; border-spacing: 4px;" summary="' . _THEMES . '">'
		, '<caption class="ui-widget-header">' , _THEMES , '</caption>'
		, '<thead class="ui-state-default"><tr>'
		, '<th style="width: 150px;" scope="col">' , _THEMENAME , '</th>'
		, '<th style="width: 150px;" scope="col">' , _THEME , '</th>'
		, '<th style="width: 75px;" scope="col">' , _ACTIVE , '</th>'
		//, '<th style="width: 150px;" scope="col">' , _MOVEBLOCKS , '</th>'
		//, '<th style="width: 150px;" scope="col">' , _COLLAPSEBLOCKS , '</th>'
		, '<th style="width: 75px;" scope="col">' , _PREVIEW , '</th>'
		, '</tr></thead>'
		, '<tbody class="ui-widget-content">';

	foreach($row as $key => $val) {
		echo '<tr><th scope="row"><input name="themes[' . $val['theme'] . '][themename]" value="' , $val['themename'] , '" maxlength="20"/></th>';
			if ($val['theme'] == $config['Default_Theme'] || $val['guest'] == 1) {
				echo '<td><span style="font-weight:bold">' , $val['theme'] , '</span></td>';
			} else {
				echo '<td>' , $val['theme'] , '</td>';
			}
		echo CreateButton('active', $val['active'], $val, $config['Default_Theme']);
		/*if ($val['compatible'] == 1) {
			echo CreateButton('moveableblocks', $val['moveableblocks'], $val)
				, CreateButton('collapsibleblocks', $val['collapsibleblocks'], $val);
		} else {
			echo '<td colspan="2"><a href="' . $admin_file . '.php?op=Themes&amp;themeop=scan&amp;theme=' . $val['theme']
				, '&amp;' . $GLOBALS['csrf']['input-name'] . '=' . $GLOBALS['csrf']['rn_csrf_token'] . '#topconfig">' . _VALIDATE . '</a>'
				, ' | <a href="' . $admin_file . '.php?op=Themes&amp;themeop=scan&amp;' . $GLOBALS['csrf']['input-name'] . '=' . $GLOBALS['csrf']['rn_csrf_token'] . '#topconfig">' . _ALL . '</a></td>';
		}*/
		echo  PreviewButton($val['theme']) , '</tr>';
	}

	echo '</tbody></table>'
		, '<br />'
		, '<input type="hidden" name="themeop" value="ThemeSave" />'
		, '<input type="submit" name="save" value="' . _SUBMIT . '" /></form></div>';
	CloseTable();

	include 'footer.php';
}

/**
 * Reads theme directory and adds themes to Database if they are not already there
 *
 */
function addThemes() {
	global $db, $prefix, $user_prefix;

	$themelist = '';
	$handle = opendir('themes');
	while (($dir = readdir($handle)) !== false) {
		if ((!preg_match('/[.]/', $dir) && file_exists('themes/' . $dir . '/theme.php'))) {
			$themelist .= $dir . ',';
		}
	}
	closedir($handle);
	$themelist = explode(',', $themelist);
	sort($themelist);
	natcasesort($themelist);
	reset($themelist);

	$values_add = false;
	$result = $db->sql_query('SELECT `theme` FROM `' . $prefix . '_themes`');
	$row = $db->sql_fetchrowset($result, SQL_NUM);
	$row = is_array($row) ? $row : array();
	foreach ($themelist as $id => $theme) {
		if ($theme != '') {
			if (!in_array(array($theme), $row)) {
				$theme = addslashes(check_html($theme, 'nohtml'));
				if (!$values_add) {
					$values_add = '("' . $theme . '", "' . $theme . '", "1", "0", "0", "0", "0", "0")';
				} else {
					$values_add .= ',("' . $theme . '", "' . $theme . '", "1", "0", "0", "0", "0", "0")';
				}
			}
		}
	}

	if ($values_add) {
		$sql = 'INSERT INTO `' . $prefix . '_themes` (`theme`, `themename`, `active`, `default`, `guest`, `moveableblocks`, `collapsibleblocks`, `compatible`) VALUES ' . $values_add;
		$db->sql_query($sql);
	}

	$values_del = false;
	$themeCount = count($row);
	for($i = 0;$i < $themeCount; $i++) {
		if(!in_array($row[$i][0],$themelist)) {
			if (!$values_del) {
				$values_del = '"' . $row[$i][0] . '"';
			} else {
				$values_del .= ', "' . $row[$i][0] . '"';
			}
		}
	}

	if ($values_del) {
		$sql = 'DELETE FROM `' . $prefix . '_themes` WHERE `theme` IN (' . $values_del . ')';
		$db->sql_query($sql);
		$sql = 'SELECT `theme` FFROM `' . $prefix . '_themes` WHERE `default`=1';
		$row = $db->sql_fetchrowset($db->query($sql), SQL_ASSOC);
		$sql = 'UPDATE `' . $user_prefix . '_users` SET `theme`="' . $row['theme'] . '" WHERE `theme` IN(' . $values_del . ')';
		$db->sql_query($sql);
	}
}

/**
 * Save theme options in databse
 *
 * @param array $themes an array of themes names and status
 * @param string $reg_theme theme name for registered users
 * @param string $guest_theme theme name for guests

 * @return string status of operation
 */
function themeSave($themes, $reg_theme, $guest_theme) {
	global $db, $prefix, $user_prefix;

	$results = $db->sql_query('SELECT `theme` FROM `' . $prefix . '_themes` WHERE `active`=1');
	$active_array = $db->sql_fetchrowset($results, SQL_NUM);

	if (is_array($themes)) {
		foreach($themes as $key => $val) {
			$active = (int) $val['active'];
			if (isset($val['moveableblocks'])) {
				$moveableblocks = (int) $val['moveableblocks'];
			} else {
				$moveableblocks = 0;
			}
			if (isset($val['collapsibleblocks'])) {
				$collapsibleblocks = (int) $val['collapsibleblocks'];
			} else {
				$collapsibleblocks = 0;
			}
			$theme = addslashes(check_html($key, 'nohtml'));
			if ($val['themename'] != '') {
				$themename = '`themename`="' . addslashes(check_html($val['themename'], 'nohtml')) . '", ';
			} else {
				$themename = '';
			}
			if ($theme == $reg_theme || $theme == $guest_theme) {
				$active = 1;
			}
			if ($theme == $reg_theme) {
				$default = 1;
			} else {
				$default = 0;
			}
			if ($theme == $guest_theme) {
				$guest = 1;
			} else {
				$guest = 0;
			}
			$sql = 'UPDATE `' . $prefix . '_themes` SET ' . $themename . '`active`="' . $active . '", `default`="' . $default . '", `guest`="' . $guest . '"'
				. ', `moveableblocks`="' . $moveableblocks . '", `collapsibleblocks`="' . $collapsibleblocks . '" WHERE `theme`="' . $theme . '"';
			$results = $db->sql_query($sql);
			if ($active == 0 && in_array(array($theme), $active_array)) {
				$sql = 'UPDATE `' . $user_prefix . '_users` SET `theme`="' . addslashes(check_html($reg_theme, 'nohtml')) . '" WHERE `theme`="' . $theme . '"';
				$results = $db->sql_query($sql);
			}
		}
		$sql = 'UPDATE `' . $prefix . '_config` SET `Default_Theme`="' . addslashes(check_html($reg_theme, 'nohtml')) . '"';
		$results = $db->sql_query($sql);
	} else {
		$results = false;
	}

	if ($results) {
		$status = '<span class="thick" style="color: green;">' . _THEMEUPDATEGOOD . '</span>';
	} else {
		$status = '<span class="thick" style="color: red;">' . _THEMEUPDATEFAIL . '</span>';
	}
	themes($status);
}

/**
 * Scan themes to determine if they are compatable with collapsable/moveable blocks

 * @return string status of operation
 */
function scanCompatibility() {
	global $admin_file, $db, $nukeurl, $prefix;

	$results = $db->sql_query('SELECT `theme` FROM `' . $prefix . '_themes`');
	$themes = $db->sql_fetchrowset($results, SQL_NUM);
	$num_themes = count($themes);

	if (isset($_COOKIE['Theme_Preview'])) {
		$key = array_search(array($_COOKIE['Theme_Preview']), $themes);
		if (defined('RN_BLOCKS')) {
			updateTheme($themes, $key);
		}
		$key++;
		if ($key < $num_themes || isset($_GET['theme'])) {
			if (isset($_GET['theme']) && !empty($_GET['theme'])) {
				$theme = check_html($_COOKIE['Theme_Preview'], 'nohtml');
				header('Refresh: 1; URL="' . $nukeurl . '/' .  $admin_file . '.php?op=Themes#topconfig"');
				setcookie('Theme_Preview', '', -1);
				$status = '<span class="thick" style="color: green;">' . $theme . ' 1 ' . _OF . ' 1</span>';
			} else {
				header('Refresh: 1; URL="' . $nukeurl . '/' .  $admin_file . '.php?op=Themes&themeop=scan' . csrf_rn_token() . '#topconfig"');
				setcookie('Theme_Preview', $themes[$key][0]);
				$theme = $key - 1;
				$status = '<span class="thick" style="color: green;">' . $themes[$theme][0] . ' ' . $key . ' ' . _OF . ' ' . $num_themes . '</span>';
			}
			themes($status);
		} else {
			header('Refresh: 1; URL="' . $nukeurl . '/' .  $admin_file . '.php?op=Themes#topconfig"');
			setcookie('Theme_Preview', '', -1);
			$theme = $num_themes - 1;
			$status = '<span class="thick" style="color: green;">' . $themes[$theme][0] . ' ' . $num_themes . ' ' . _OF . ' ' . $num_themes . '</span>';
			themes($status);
		}
	} else {
		if (isset($_GET['theme']) && !empty($_GET['theme'])) {
			$theme = check_html($_GET['theme'], 'nohtml');
			header('Refresh: 1; URL="' . $nukeurl . '/' .  $admin_file . '.php?op=Themes&themeop=scan&theme=' . $theme . csrf_rn_token() . '#topconfig"');
			setcookie('Theme_Preview', $_GET['theme']);
			$status = '<span class="thick" style="color: green;">' . _THEME . ' 0 ' . _OF . ' 1</span>';
			themes($status);
		}
		header('Refresh: 1; URL="' . $nukeurl . '/' .  $admin_file . '.php?op=Themes&themeop=scan' . csrf_rn_token() . '#topconfig"');
		setcookie('Theme_Preview', $themes[0][0]);
		$status = '<span class="thick" style="color: green;">' . _THEME . ' 0 ' . _OF . ' ' . $num_themes . '</span>';
		themes($status);
	}
}

/**
 * Preview them
 *
 * Used in conjunction with jQuery colorbox
 *
 * @param string $theme name of theme

 * @return string status of operation
 */
function PreviewButton($theme) {
	$content = '<td><a id="a' . $theme . '" class="PreviewTheme" href="./"><img title="' . _PREVIEW . '" alt="' . _PREVIEW . '" src="images/view.gif" /></a></td>';
	return $content;
}

/**
 * Create buttons for theme manager
 *
 * @param string $name name of theme
 * @param string $state inactive of active
 * @param array $val array of options for desired theme
 * @param string $def_theme name of default theme (optional)

 * @return string status of operation
 */
function CreateButton($name, $state, $val, $def_theme = '') {
	if ($state) {
		$content = '<td><a class="OptionState" href="#"><img title="' . _ACTIVE . ' (' . _DEACTIVATE . ')" alt="' . _DEACTIVATE . '" src="images/active.gif" /></a>';
	} else {
		$content = '<td><a class="OptionState" href="#"><img title="' . _INACTIVE . ' (' . _ACTIVATE . ')" alt="' . _ACTIVATE . '" src="images/inactive.gif" /></a>';
	}
	if ($name == 'active' && ($val['theme'] == $def_theme || $val['guest'] == 1)) {
		$content = '<td>';
	}
	$content .= '<input type="hidden" name="themes[' . $val['theme'] . '][' . $name . ']" value="' . $val[$name] . '" /></td>';
	return $content;
}

/**
 * Sets theme compatability value in database
 *
 * @param array $themes array of themse
 * @param string|int $key array key of theme to update
 */
function updateTheme($themes, $key) {
	global $db, $prefix;
	$sql = 'UPDATE `' . $prefix . '_themes` SET `compatible`=1 WHERE `theme`="' . addslashes($themes[$key][0]) . '"';
	$results = $db->sql_query($sql);
	return;
}

?>