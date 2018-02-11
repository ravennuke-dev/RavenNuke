<?php
/****************************************************************************************/
/* DISQUS TOP COMMENTERS WIDGET for RavenNuke (tm)                                      */
/****************************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $db, $prefix;

/****************************************************************************************/
/* DISQUS TOP COMMENTERS WIDGET SETTINGS                                                */
/****************************************************************************************/
$ni = 5;  // $ni = number of items 1-20
$hm = 0;  // $hm = hide moderators: 0 = show mods in ranking, 1 = hide mods in ranking
$ha = 0;  // $ha = hide avatars: 0 = show avatars, 1 = hide avatars
$as = 24; // $as = avatar size: 24, 32, 48, 92, or 128
/****************************************************************************************/

include_once 'includes/jquery/disqus.php';

$result = $db->sql_query('SELECT shortname FROM ' . $prefix . '_ton');
list($shortname) = $db->sql_fetchrow($result);
$content = '<div class="padrtl-box">' . disqusTC($shortname, $ni, $hm, $ha, $as) . '</div>';

?>