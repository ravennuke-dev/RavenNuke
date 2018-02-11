<?php
/************************************************************************/
/* Tags Module                                                          */
/* Using RavenNuke(tm) v2.4+                                            */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'head-Tags.php')) {
	Header('Location: ../../index.php');
	die();
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
