<?php
/************************************************************************/
/* Tags Module                                                          */
/* Using RavenNuke(tm) v2.4+                                            */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}
$PreferredTagsStyle = 'tags.css';
$ThemeSel = get_theme();
$tagsCssFile = INCLUDE_PATH . 'themes/' . $ThemeSel . '/style/' . $PreferredTagsStyle;
$DefaultTagsStyle = 'modules/Tags/css/' . $PreferredTagsStyle;
if (file_exists($tagsCssFile)) {
	addCSSToHead($tagsCssFile, 'file');
	}else{
	addCSSToHead($DefaultTagsStyle, 'file');
}

?>
