<?php
/****************     Blue Blog Theme    ************************/
/*                                                              */
/*        A free theme by Nuken at TickedOutNews.com            */
/*               Based on nonzero blue theme                   */
/***************************************************************/

if (!defined('NUKE_FILE')) {
	die ('You can\'t access this file directly...');
}

$bgcolor1 = "#cccc99";
$bgcolor2 = "#ddddbb";
$bgcolor3 = "#eeeedc";
$bgcolor4 = "#cccc99";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

function OpenTable() {
	echo '<div class="tableline">';
}

function OpenTable2() {
	echo '<div class="tableline">';
}

function CloseTable() {
	echo '</div>';
}

function CloseTable2() {
	echo '</div>';
}

/************************************************************/
/* Function themeheader()                                   */
/* Control the header for your site.                        */
/************************************************************/
function themeheader() {
	global $user, $banners, $sitename, $slogan, $cookie, $prefix, $anonymous, $topic, $name, $sel, $db, $ThemeSel, $nukeNAV, $name;
	cookiedecode($user);

	echo '<body>';

	if (defined('INDEX_FILE')) {
		echo '<div id="header"><div id="header_inner" class="fixed"><div id="logo"><span><img src="themes/' , $ThemeSel , '/images/logo.gif" alt="" border="0" /></span></div>';
		if ($banners) {
			echo '<div id="logo_right">'
				, ads(0)
				, '</div>';
		};
		echo '</div>' , $nukeNAV , '<br style="clear: left" /></div><div id="main"><div id="main_inner" class="fixed"><div id="primaryContent_3columns">';
	} else {
		echo '<div><div id="header"><div id="header_inner" class="fixed"><div id="logo"><span><img src="themes/' , $ThemeSel , '/images/logo.gif" alt="" border="0" /></span></div>';
		if ($banners) {
		echo '<div id="logo_right">'
			, ads(0)
			, '</div>';
		};
		echo '</div>' , $nukeNAV , '<br style="clear: left" /></div><div id="main"><div id="main_inner" class="fixed"><div id="primaryContent_2columns">';
	}

	if (defined('INDEX_FILE')) {
		echo '<div id="columnA_3columns">';
	} else {
		echo '<div id="columnA_2columns">';
	}
}

/************************************************************/
/* Function themefooter()                                   */
/* Control the footer for your site.                        */
/************************************************************/
function themefooter() {
	global $index, $foot1, $foot2, $foot3, $foot4, $name;

	echo '</div></div><div id="secondaryContent_3columns">';

	if (defined('INDEX_FILE')) {
		echo '<div id="secondaryContent_2columns"><div id="columnC_2columns">';
	} else {
		echo '<div id="columnB_3columns">';
	}

	blocks('left');
	echo '</div>';

	if (defined('INDEX_FILE')) {
		echo '<div id="columnC_3columns">';
		blocks('right');
		echo '</div>';
	}

	$footer_message = '<p>' . $foot1 . '</p><p>' . $foot2 . '</p><p>' . $foot3 . '</p><p>' . $foot4 . '</p>';
	echo '</div><br class="clear" /></div></div></div><div id="footer" class="fixed">';
	footmsg();
	echo '</div>';
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage) {
	global $anonymous, $tipath, $topictext, $timezone;

	$ThemeSel = get_theme();
	if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/topics/' . $topicimage)) {
		$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
	} else {
		$t_image = $tipath . $topicimage;
	}

	if (!empty($notes)) {
		$notes = '<span class="thick">' . _NOTE . '</span>' . $notes . "\n";
	} else {
		$notes = '';
	}

	if ($aid == $informant) {
	$content = $thetext . $notes . "\n";
	} else {
		if(!empty($informant)) {
			$content = '<br />&#34;<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $informant . '">' . $informant . '</a> ';
		} else {
			$content = $anonymous . ' ';
		}
		$content .= _WRITES . '&#34; ' . $thetext . $notes;
	}

	$posted = _POSTEDBY . ' ';
	$posted .= get_author($aid);
	$posted .= ' ' . _ON . ' ' . $time . ' ' . $timezone . ' (' . $counter . ' ' . _READS . ')';
	echo '<br class="clear" /><div class="post"><h3>' , $title , '</h3><br /><a href="modules.php?name=News&amp;new_topic=' , $topic , '"><img src="' , $t_image , '" class="floatTR" alt="' , $topictext , '" /></a>'
		, '<ul class="post_info"><li class="date">' , $posted , '</li></ul>' , $content , '<h4>' , $morelink , '</h4>'
		, '</div>';
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic ,$topicname, $topicimage, $topictext) {
	global $admin, $sid, $tipath, $notes;

	$ThemeSel = get_theme();
	if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/topics/' . $topicimage)) {
		$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
	} else {
		$t_image = $tipath . $topicimage;
	}

	$posted = _POSTEDON . ' ' . $datetime . ' ' . _BY . ' ';
	$posted .= get_author($aid);
	if (!empty($notes)) {
		$notes = '<span class="thick">' . _NOTE . '</span>' . $notes . "\n";
	} else {
		$notes = '';
	}

	if ($aid == $informant) {
		$content = $thetext . $notes . "\n";
	} else {
		if(!empty($informant)) {
			$content = '<br />&#34;<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $informant . '">' . $informant . '</a> ';
		} else {
			$content = $anonymous . ' ';
		}
		$content .= _WRITES . '&#34; ' . $thetext . $notes;
	}

	echo '<br class="clear" /><div class="post"><h3>' , $title , '</h3><a href="modules.php?name=News&amp;new_topic=' , $topic , '"><img src="' , $t_image , '" class="floatTR" alt="' , $topictext , '" /></a>'
		, '<ul class="ar_post_info"><li class="ar_date">' , $posted , '</li></ul><br />' , $content , '<h4>&nbsp;</h4></div>';
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/
function themesidebox($title, $content) {
	echo '<h4><span>' , $title , '</span></h4>' , $content;
}

?>