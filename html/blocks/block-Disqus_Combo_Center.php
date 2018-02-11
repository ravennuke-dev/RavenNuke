<?php
/****************************************************************************************/
/* DISQUS COMBINATION WIDGET for RavenNuke (tm)                                         */
/****************************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $db, $prefix;

/****************************************************************************************/
/* DISQUS COMBINATION WIDGET SETTINGS                                                   */
/****************************************************************************************/
$el           = 200; // $el = excerpt length: character limit to truncate at
$ni           = 5; // number of items 1-20
$hm           = 0; // hide moderators: 0 = show mods in ranking, 1 = hide mods in ranking
$dt           = 'recent'; // $dt = default_tab = people, recent, popular
$disqusgreen  = array('Blue_Blog'); // pastel green background
$disqusred    = array('Chely'); // pink background
$disqusorange = array('Example'); // pastel orange background
$disqusblue   = array('AnotherExample', 'SimplyBlue'); // light blue background
/****************************************************************************************/
/* all other themes get grey background - none of these work well with light color text */
/****************************************************************************************/

include_once 'includes/jquery/disqus.php';

$result = $db->sql_query('SELECT shortname FROM ' . $prefix . '_ton');
list($shortname) = $db->sql_fetchrow($result);
$ThemeSel = get_theme();
	if (in_array($ThemeSel, $disqusgreen)) $disquscolor = 'green';
	else if (in_array($ThemeSel, $disqusred)) $disquscolor = 'red';
	else if (in_array($ThemeSel, $disqusorange)) $disquscolor = 'orange';
	else if (in_array($ThemeSel, $disqusblue)) $disquscolor = 'blue';
	else $disquscolor = 'grey';
$content = '<div class="padrtl-box">' . disqusCombo($shortname, $ni, $hm, $disquscolor, $dt, $el) . '</div>';

?>