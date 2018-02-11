<?php
/************************************************************/
/* RickTido Theme for RavenNuke 2.5                         */
/* by Bobby (Nuken)                                         */
/* A Tableless CSS Theme                                    */
/* http://trickedoutnews.com                                */
/************************************************************/

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/

$bgcolor1 = '#f3f3f3';
$bgcolor2 = '#87bed6';
$bgcolor3 = '#efefef';
$bgcolor4 = '#f3f3f3';
$textcolor1 = '#333333';
$textcolor2 = '#003366';

function OpenTable()  { 
echo '<div class="roundeddiv"><div>';  
}
function OpenTable2() {   
echo '<div>';
}    
function CloseTable() {
echo '</div></div>';   
}
function CloseTable2() { 
echo '</div>';  
}
$hide_blocks_left = array('Forums');
global $name;
if (!isset($name)) $name = '';
/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
    global $banners, $sitename, $slogan, $prefix, $nukeNAV, $name, $db, $ThemeSel, $hide_blocks_left;   
include_once'themes/'.$ThemeSel.'/headertext.php';
    echo '<body>';
    $public_msg = public_message();
 $u_agent = $_SERVER['HTTP_USER_AGENT']; 
if(preg_match('/MSIE ([0-7]\.[0-9])/',$u_agent)) {
$searchboxcode ='<div id="searchwrapperie"><form action="modules.php?name=Search" method="post"><input type="text" class="searchboxie" name="query" value="" /><input type="image" src="themes/'.$ThemeSel.'/images/blank.gif" class="searchbox_submitie" value="" /></form></div>';           
   }else{
$searchboxcode ='<div id="searchwrapper"><form action="modules.php?name=Search" method="post"><input type="text" class="searchbox" name="query" value="" /><input type="image" src="themes/'.$ThemeSel.'/images/blank.gif" class="searchbox_submit" value="" /></form></div>';           
   }
   echo '<!-- wrap starts here --><div id="wrap"><!-- header --><div class="header"><img src="themes/'.$ThemeSel.'/images/018.png" alt="" />&nbsp;<a href="index.php"><img class="logo" src="themes/'.$ThemeSel.'/images/logo.png" alt="" /></a>'.$searchboxcode.'</div>';  
     
   echo '<div class="subheader"><div class="subheaderl"><img class="topleft" src="themes/'.$ThemeSel.'/images/topleft.png" alt="" /><div class="subheaderlh1">'.$sitename.'</div><br /><div class="subheaderlh2">'.$headertext.'</div>'.$nukeNAV.'</div><div class="subheaderr text-center"><img class="topright" src="themes/'.$ThemeSel.'/images/topright.png" alt="" />Follow Us:<br /><div class="centered"><a href="http://www.facebook.com/'.$facebookid.'"><img src="themes/'.$ThemeSel.'/images/fb.png" alt="" /></a> <a href="http://twitter.com/'.$twitterid.'"><img src="themes/'.$ThemeSel.'/images/twitter.png" alt="" /></a> <a href="modules.php?name=Feeds"><img src="themes/'.$ThemeSel.'/images/rss.png" alt="" /></a></div></div></div>';
	echo '<div id="mainbodycolor">'; 
	if (!in_array($name, $hide_blocks_left)) {
   	echo '<!-- start sidebar1 --><div class="sidebar">';
    blocks('l'); 
    echo '</div><!-- end sidebar -->';   
   if (defined('INDEX_FILE')) {
		echo '<!-- start content --><div class="rtmain">';
	}else{  
   	echo '<!-- start content --><div class="rtmainnrb">';
	  }
	}else{
echo '<!-- start content --><div class="rtmainnb">';
}

if ($banners) {
echo '<br /><div class="centered">';
echo ads(0);
echo '</div>';
}
}
/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page you're viewing is the Homepage or  */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    global $index, $banners, $foot1, $foot2, $foot3, $foot4, $name, $hide_blocks_left;   
     echo '</div><!-- end content -->';  
	 if (defined('INDEX_FILE')and !in_array($name, $hide_blocks_left)) {

	echo '<!-- start sidebar2 --><div class="sidebarr">';		
	blocks('r');
	echo '</div><!-- end sidebar2 -->';
    }
    $footer_message = ''.$foot1.'<br />'.$foot2.'<br />'.$foot3.'<br />'.$foot4.'';    
  	echo '</div><!-- wrap ends here --></div><!-- footer starts here --><div class="footer">' . LGL_MENU_HTML . '<br />Theme by <a href="http://trickedoutnews.com">Nuken</a>';
  footmsg();
echo'</div>';
  
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
	    $ThemeSel = get_theme();
	 if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage.'')) {
	$t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage.'';
    } else {
	$t_image = $tipath.$topicimage;
    }
    if (!empty($notes)) {
	$notes = '<div class="thick">'._NOTE.'</div><div class="italic">'.$notes.'</div>';
    } else {
	$notes = '';
    }
    if ($aid == $informant) {
	$content = $thetext.$notes;
    } else {
	if(!empty($informant)) {
	    $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>';
	} else {
	    $content = $anonymous;
	}
	$content .= '&nbsp;'._WRITES.'<div class="italic">'.$thetext.'</div>'.$notes.'';
    }
    $posted = ''._POSTEDBY.'&nbsp;';
    $posted .= get_author($aid);
    $posted .= ' '._ON.' '.$time.' ('.$counter.' '._READS.')';
	   echo '<div class="post mainnews newsindent"><div class="newstitle">'.$title.'</div><div class="posted">'.$posted.'</div><div>'.$content.'</div><div class="padded-box">'.$morelink.'</div><div>' . _TOPIC . ': <a href="modules.php?name=News&amp;new_topic='.$topic.'">'.$topictext.'</a></div><div class="mainnewsbottom"></div></div>';
}
/************************************************************/
/* Function themearticle()                                    */
/*                                                          */
/* This function format the articles page,                 */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath;
    $ThemeSel = get_theme();
    if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage.'')) {
	$t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage.'';
    } else {
	$t_image = $tipath.$topicimage;
    }
    $posted = ''._POSTEDON.'&nbsp;'.$datetime.'&nbsp;'._BY.'&nbsp;';
    $posted .= get_author($aid);
    if (!empty($notes)) {
	$notes = '<p class="thick">'._NOTE.'</p>&nbsp;<p class="italic">'.$notes.'</p>';
    } else {
	$notes = '';
    }
    if ($aid == $informant) {
	$content = $thetext.$notes;
    } else {
	if(!empty($informant)) {
	    $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>&nbsp;';
	} else {
	    $content = ''.$anonymous.'&nbsp;';
	}
	$content .= ''._WRITES.'&nbsp;<div class="italic">'.$thetext.'</div>&nbsp;'.$notes.'';
    }
    echo '<div class="post"><h1 class="title">'.$title.'</h1><div class="posted">'.$posted.'</div><div class="entry"><div class="blockquote">'.$content.'<div class="float-right"><img src="themes/'.$ThemeSel.'/images/quotesend.png" alt="" /></div><br /></div></div><div class="thick">' . _TOPIC . ': <a href="modules.php?name=News&amp;new_topic='.$topic.'">'.$topictext.'</a></div></div>';
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
   global $name;
       echo '<h1>'.$title.'</h1><div class="left-box">'.$content.'</div>';

}

?>
