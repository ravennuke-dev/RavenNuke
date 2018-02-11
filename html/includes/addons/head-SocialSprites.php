<?php
/************************************************************************/
/* Example of Site Wide CSS Addon                                       */
/* Using RavenNuke(tm) v2.4+                                            */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'head-SocialSprites.php')) {
	Header('Location: ../../index.php');
	die();
}

	addCSSToHead('modules/News/css/socialicons.css', 'file');
?>