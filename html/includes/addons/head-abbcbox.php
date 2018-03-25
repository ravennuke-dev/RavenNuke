<?php
/************************************************************************/
/* CSS and JS requirements for ABBC MOD                                 */
/* Using RavenNuke(tm) v2.5+ (required!)                                */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}
/************************************************************************/
// SETTINGS - Note that making changes to these settings may require 
// edits or other changes. Please refer to the included documentation
// $LoadABBCcss: only set to false if you are handling your own CSS loads or appending required CSS to your style.css
// $UseCodeHighligher: enables code highlighting
// $use_highlighter: array of modules to use the code highlighter in
// $IE8HighlightFix: true enables loading of conditional ie<9 stylesheet, otherwise ie8 will display code double spaced, comes at cost of code no longer being indented
// $HighlightFixMods: array of modules to use ie8 fix: only needed if BR is used within code samples
/************************************************************************/
$LoadABBCcss       = true;
$UseCodeHighligher = true;
$use_highlighter   = array('Forums','Private_Messages');
$IE8HighlightFix   = true;
$HighlightFixMods  = array('Forums','Private_Messages');
// END SETTINGS
/************************************************************************/
// Only modify below if you know what you are doing :)
/************************************************************************/
// this decides which javascript function will occur when the code button is clicked
if ($UseCodeHighligher){
	define('ABBC_HIGHLIGHT', 'BBCcodetype');
	} else {
	define('ABBC_HIGHLIGHT', 'BBCbasiccode');
}
global $user, $name;
if (!isset($name)) $name = '';
$ThemeSel = get_theme();
if ($LoadABBCcss){
	// only load BBCode Box CSS for Users and when needed
	if ($name =='Forums' OR $name =='Private_Messages') {
		// only load BBCode Box Editor CSS for Users
		if (is_user($user)){
			// include a copy of bbcode_box.css in the the style directory of any desired theme
			$BBCodeCssFile = 'themes/' . $ThemeSel . '/style/bbcode_box.css';
			if (file_exists($BBCodeCssFile)) {
				// theme specific style
				addCSSToHead($BBCodeCssFile, 'file');
			} else {
				// default style
				addCSSToHead('includes/bbcode_box/css/bbcode_box.css', 'file');
			}
		}
		// include a copy of bbcode_addons.css in the the style directory of any desired theme
		$BBUserCssFile = 'themes/' . $ThemeSel . '/style/bbcode_addons.css';
		if (file_exists($BBUserCssFile)) {
			// theme specific style
			addCSSToHead($BBUserCssFile, 'file');
			} else {
			// default style
			addCSSToHead('includes/bbcode_box/css/bbcode_addons.css', 'file');
		}
	}
}
if ($UseCodeHighligher){
	if (in_array($name, $use_highlighter)) {
		// this is the default code highlighting style (if no theme specific style, change as desired)
		$DefaultStyle = 'includes/bbcode_box/js/styles/vs.css';
		// to style by theme, rename to your preferred style to highlight.css, upload to themes/YOUR_THEME/style/
		$CoderCssFile = 'themes/' . $ThemeSel . '/style/highlight.css';
		if (file_exists($CoderCssFile)) {
			addCSSToHead($CoderCssFile, 'file');
			} else {
			addCSSToHead($DefaultStyle, 'file');
		}
		if($IE8HighlightFix AND (in_array($name, $HighlightFixMods))){
			$IE8fix = '<!--[if lt IE 9]><link rel="stylesheet" href="includes/bbcode_box/css/ie8_highlight.css" type="text/css" /><![endif]-->' . PHP_EOL;
			addCSSToHead($IE8fix, 'inline');
		}
		addJSToBody('includes/bbcode_box/js/highlight.pack.js', 'file');
		// this file launches code highlighting for forums, but will work for other modules as long as code is wrapped in <pre><code></code></pre>
		addJSToBody('includes/bbcode_box/js/start-highlight-forums.js', 'file');
	}
}
# moved from posting_body.tpl
global $file, $lang;
if ($name =='Forums' || $name =='Private_Messages') {
	addJSToBody('includes/bbcode_box/js/bbcode_extras.js', 'file');
	if (($name =='Forums' && $file == 'viewtopic') || $name =='Private_Messages') {
		addJSToHead('includes/bbcode_box/js/select_expand_bbcodes.js', 'file');
	}
	if (($name =='Forums' && $file == 'posting') || $name =='Private_Messages') {
		addJSToBody('includes/bbcode_box/js/bbcode_box_english.js', 'file');
		addJSToBody('includes/bbcode_box/js/jscolor.js', 'file');
		addJSToBody('includes/bbcode_box/js/jquery.autogrowtextarea.js', 'file');
		addJSToBody('includes/bbcode_box/js/textarea-settings.js', 'file');
	}
}
?>