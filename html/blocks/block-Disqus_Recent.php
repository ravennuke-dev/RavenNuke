<?php
/****************************************************************************************/
/* DISQUS RECENT COMMENTS WIDGET for RavenNuke (tm)                                     */
/****************************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $db, $prefix;

/****************************************************************************************/
/* DISQUS RECENT COMMENTS WIDGET SETTINGS                                               */
/****************************************************************************************/
$ni           = 5; // number of items 1-20
$ha           = 0; // 0 = show avatars, 1 = hide avatars
$as           = 24; // $as = avatar size: 24, 32, 48, 92, or 128
$el           = 200; // $el = excerpt length: character limit to truncate at
$st           = false; // show the recent comments title (not recommended for blocks)
/****************************************************************************************/

include_once 'includes/jquery/disqus.php';

$result = $db->sql_query('SELECT shortname FROM ' . $prefix . '_ton');
list($shortname) = $db->sql_fetchrow($result);
$content = '<div class="padrtl-box">' . disqusRC($shortname, $ni, $ha, $as, $el, $st) . '</div>';

?>
