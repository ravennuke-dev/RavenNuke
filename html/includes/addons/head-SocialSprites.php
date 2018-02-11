<?php
/************************************************************************/
/* Example of Site Wide CSS Addon                                       */
/* Using RavenNuke(tm) v2.4+                                            */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}
addCSSToHead('modules/News/css/socialicons.css', 'file');
?>