<?php
if (!defined('NUKE_FILE')) die ('You can\'t access this file directly...');
/************************************************************/
/* Theme Name: fisubice                                     */
/* Theme Design: coldblooded (www.nukemods.com)             */
/* version 3.0                                              */
/* Theme inspired by the phpbb2 style fisubice by           */
/* Daz (http://www.forumimages.com/)                        */
/*                                                          */
/* Copyright Notice                                         */
/* - Our Package name and link MUST REMAIN in the credit    */
/*   footer of all Nuke generated pages.                    */
/*   Translations are permitted, not renaming.              */
/* - This package CAN NOT be ported without written         */
/*   permission.                                            */
/* - This package CAN NOT be mirrored without written       */
/*   permission.                                            */
/* - Use of this package requires that credits to the       */
/*   original PHPNuke remain in all site generated          */
/*   page footers.                                          */
/*                                                          */
/************************************************************/

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

/************************************************************/
/* Theme Colors Definition                                  */
/*                                                          */
/* bg1 'main cell background'                               */
/* bg2 'cell headers'                                       */
/* bg3 ?                                                    */
/* bg4 ?                                                    */
/* Define colors for your web site. $bgcolor2 is generaly   */
/* used for the tables border as you can see on OpenTable() */
/* function, $bgcolor1 is for the table background and the  */
/* other two bgcolor variables follows the same criteria.   */
/* $texcolor1 and 2 are for tables internal texts           */
/************************************************************/

$bgcolor1 = '#F4F6FB';
$bgcolor2 = '#BBCCDC';
$bgcolor3 = '#F4F6FB';
$bgcolor4 = '#BBCCDC';
$textcolor1 = '#516A88';
$textcolor2 = '#516A88';

$ThemeSel = get_theme();
include_once NUKE_THEMES_DIR . $ThemeSel . '/tables.php';

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
	 global  $showbanners, $admin, $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $nukeurl, $anonymous, $name, $admin_file, $nukeNAV;
	 cookiedecode($user);
	 $username = '';
	 if (count($cookie)>1) $username = $cookie[1];
	 if (empty($username)) {
		  $username = 'Anonymous';
	 }
	echo '<body bgcolor="#FFFFFF" text="#516A88" style="margin: 10px">';
	if ($banners == 1) {
		echo ads(0);
	}
	 if ($username == 'Anonymous') {
		  $theuser = '&nbsp;&nbsp;<a href="modules.php?name=Your_Account">'._LOGIN.'</a> '._OR.' <a href="modules.php?name=Your_Account&amp;op=new_user">'._BREG.'</a>';
	 } else {
		  $theuser = '&nbsp;&nbsp;'._BWEL." $username!";
	 }

	 $datetime = '<script type="text/javascript">'."\n\n"
	 .'<!--   // Array of Month Names'."\n"
	 .'var monthNames = new Array( \''._JANUARY.'\', \''._FEBRUARY.'\', \''._MARCH.'\', \''._APRIL.'\', \''._MAY.'\', \''._JUNE.'\', \''._JULY.'\', \''._AUGUST.'\', \''._SEPTEMBER.'\', \''._OCTOBER.'\', \''._NOVEMBER.'\', \''._DECEMBER.'\');'."\n"
	 .'var now = new Date();'."\n"
	 .'var thisYear = now.getYear();'."\n"
	 .'if(thisYear < 1900) {thisYear += 1900; }' // corrections if Y2K display problem\n
	 .'document.write(monthNames[now.getMonth()] + \' \' + now.getDate() + \', \' + thisYear);'."\n"
	 .'// -->'."\n\n"
	 .'</script>';

	 $public_msg = public_message();
	 $tmpl_file = 'themes/fisubice/header.html';
	 if (is_admin($admin)) $adminMenu='<a href="'.$admin_file.'.php?op=adminMain">'._FSIADMINMENU.'</a>&nbsp;&#8226;&nbsp;';
	 else $adminMenu = '';
	 if (is_user($user)) $logoutMenu='<a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a>&nbsp;&#8226;&nbsp;';
	 else $logoutMenu = '';
	if (empty($nukeNAV))
	 $navMenu = '<span class="content">&nbsp;&#8226;&nbsp;<a href="index.php">'._HOME.'</a>&nbsp;&#8226;&nbsp;<a href="modules.php?name=Downloads">'._UDOWNLOADS.'</a>&nbsp;&#8226;&nbsp;<a href="modules.php?name=Your_Account">'._FSIYOURACCOUNT.'</a>&nbsp;&#8226;&nbsp;<a href="modules.php?name=Forums">'._BBFORUMS.'</a>&nbsp;&#8226;&nbsp;'.$logoutMenu.$adminMenu.'</span>';
	else $navMenu = '<div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div>';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = '$r_file="'."$thefile".'";';
	 eval($thefile);
	 print $r_file;
	 blocks('left');
	 $tmpl_file = 'themes/fisubice/left_center.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = '$r_file="'."$thefile".'";';
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
	 global  $foot1, $foot2, $foot3, $copyright, $totaltime, $footer_message;
	 if (defined('INDEX_FILE') && INDEX_FILE===true) {
		  $tmpl_file = 'themes/fisubice/center_right.html';
		  $thefile = implode('', file($tmpl_file));
		  $thefile = addslashes($thefile);
		  $thefile = '$r_file="'."$thefile".'";';
		  eval($thefile);
		  print $r_file;
		  blocks('right');
	 }

	 echo '</td></tr></table><table width="100%"><tr><td>&nbsp;</td></tr></table>';
	 echo '<div class="text-center">'."\n";
	 echo LGL_MENU_HTML; // Added by montego to "showcase" the use of the new Legal Module
	 echo '<div class="small">';
	 $footer_message = footmsg();
	 echo '</div>';
	 echo '</div></div>'."\n";
// PLEASE DO NOT TOUCH THE NEXT LINE.
// YOU CAN ONLY ADD TO IT IF YOU MODIFY THIS THEME :-)
echo _RN_FOOTER_CREDITS;
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	 global $anonymous, $tipath, $user, $admin;
	 $ThemeSel = get_theme();
	if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/topics/' . $topicimage)) {
		$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
	} else {
		$t_image = $tipath . $topicimage;
	}
	 $content = '';
	 if (!empty($thetext)) $thetext = '<div>'.$thetext.'</div>';
	 if (!empty($notes)) {
		  $notes = '<br /><span class="thick">'._NOTE.'</span>&nbsp;<div>'.$notes.'</div>';
	 } else {
		  $notes = '';
	 }
	 if ($aid == $informant) {
		  $content = $thetext.$notes;
	 } else {
		  if(!empty($informant)) {
				global $admin, $user;
				if (is_user($user)||is_admin($admin)) $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><span class="italic">'.$informant.'</span></a> ';
				else $content = $informant.' ';//Raven 10/16/2005
		  } else {
				$content = $anonymous.' ';
		  }
		  $content .= '<span class="italic">'._WRITES.':</span>&nbsp;&nbsp;'.$thetext.$notes;
	 }
	 $posted = _POSTEDBY.' ';
//    $posted .= get_author($aid);
	 if (is_user($user)||is_admin($admin)) $posted .= '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$aid.'">'.$aid.'</a>';
	 else $posted .= $aid; //Raven 10/16/2005
	 $posted .= ' '._ON.' '.$time.' ('.$counter.' '._READS.')';
	 $tmpl_file = 'themes/fisubice/story_home.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
//  $thefile = '\$r_file="'.$thefile.'";';
	 $thefile = '$r_file="'."$thefile".'";';
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themearticle()                                  */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that 'Read More...' link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {  //montego - added $notes for RavenNuke
	 global $admin, $sid, $tipath;
	 $ThemeSel = get_theme();
	if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/topics/' . $topicimage)) {
		$t_image = 'themes/' . $ThemeSel . '/images/topics/' . $topicimage;
	} else {
		$t_image = $tipath . $topicimage;
	}
	 $thetext = '<div>'.$thetext.'</div>';
	 $posted = _POSTEDON.' '.$datetime.' '._BY.' ';
	 $posted .= get_author($aid);
	 if (!empty($notes)) {
		  $notes = '<br /><span class="thick">'._NOTE.'</span> <div>'.$notes.'</div>';
	 } else {
		  $notes = '';
	 }
	 if ($aid == $informant) {
		  $content = $thetext.$notes;
	 } else {
		  if(!empty($informant)) {
				global $admin, $user;
				if (is_user($user)||is_admin($admin)) $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><span class="italic">'.$informant.'</span></a> ';
				else $content = $informant.' ';//Raven 10/16/2005
		  } else {
				$content = $anonymous.' ';
		  }
		  $content .= '<span class="italic">'._WRITES.'</span> <div>'.$thetext.'</div>'.$notes;
	 }
	 $tmpl_file = 'themes/fisubice/story_page.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
//  $thefile = '\$r_file="'.$thefile.'";';
	 $thefile = '$r_file="'."$thefile".'";';
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
	 $tmpl_file = 'themes/fisubice/blocks.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
//  $thefile = "\$r_file=\"".$thefile."\";";
	 $thefile = '$r_file="'."$thefile".'";';
	 eval($thefile);
	 print $r_file;
}

?>
