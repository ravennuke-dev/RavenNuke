<?php
/****************************************************************************************/
/* DISQUS POPULAR WIDGET for RavenNuke (tm)                                             */
/****************************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $db, $prefix;

/****************************************************************************************/
/* DISQUS POPULAR WIDGET SETTINGS                                                       */
/****************************************************************************************/
$disqus_items = 5; // number of items 1-20
/****************************************************************************************/

include_once 'includes/jquery/disqus.php';

$result = $db->sql_query('SELECT shortname FROM ' . $prefix . '_ton');
list($shortname) = $db->sql_fetchrow($result);
$content = '<div class="padrtl-box">' . disqusMD($shortname, $disqus_items) . '</div>';

?>
