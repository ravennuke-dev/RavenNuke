<?php
if (!defined('NUKE_FILE')) die ('You can\'t access this file directly...');
/********************************************************/
/* Theme Designed and coded by                          */
/* Clan Themes (admin@clanthemes.com)                   */
/* http://www.clanthemes.com                            */
/********************************************************/

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$bgcolor1 = '#330303';
$bgcolor2 = '#330303';
$bgcolor3 = '#330303';
$bgcolor4 = '#330303';
$textcolor1 = '#CCCCCC';
$textcolor2 = '#CCCCCC';

function themeheader() {
	global $module_name, $banners, $admin, $user, $name, $sitename, $index, $admin_file, $nukeurl, $slogan, $nukeNAV;
	echo '<body>';
	if (!empty($nukeNAV)) $nukeNAV = '<span class="left">&nbsp;</span><span class="right">&nbsp;</span>'.$nukeNAV.'';
	else {
		$nukeNAV = '<span class="right">&nbsp;</span><span class="left">&nbsp;</span>
		<a href="./index.php">Home</a>
		<a href="./modules.php?name=Forums">Forum</a>
		<a href="./modules.php?name=Your_Account">Account</a>
		<a href="./modules.php?name=Stories_Archive">News</a>
		<a href="./modules.php?name=Reviews">Reviews</a>
		<a href="./modules.php?name=Advertising">Advertisement</a>
		<a href="./modules.php?name=Downloads">Downloads</a>
		<a href="./modules.php?name=Feedback">Contact</a>';
		if (is_admin($admin)) {
			$nukeNAV .= '<a href="./admin.php">Admin</a>';
		} else {
			$nukeNAV .= '<a href="./modules.php?name=Search">Search</a>';
		}
	}
	echo '
	<div id="container">
	<!-- Navigation -->
	<div id="navigation">';
	echo $nukeNAV;
	echo '</div>
	<div id="themecontainer">
	<!-- Banner -->
	<h1>
	<a href="./"><img src="themes/CT_RN/images/mainbanner.jpg" alt="A Free Theme By www.clanthemes.com" /></a>
	</h1>
	<!-- Spotlight Section -->
	<div id="spotlight">
	<div class="span1"></div><div class="span2"></div>
	<img src="themes/CT_RN/images/small_spotlight.gif" alt="Spotlight" class="overlay" />';

	if($banners == 1){
		echo '<br /><br />';
		echo ads(0);  // the 0 indicates the banner postion change the position via your advertisment admin panel
	}else{
		echo '<img src="themes/CT_RN/images/spotlight.jpg" alt="Advertisment Banner" />';
	}
	echo '</div>';
	if (!is_user($user) AND $name != "Your_Account") {
		echo '<div id="sitebar"><a href="modules.php?name=Your_Account&amp;op=new_user"><img src="themes/CT_RN/images/warn.gif" alt="warning" />&nbsp;&nbsp;Welcome to '.$sitename.', You are not logged in. If you have not registered yet, please click here. Alternativly log into your account now.</a>
		</div>';
	}
	echo '<!-- Content start - Column wrapper -->
	<div id="columns">';
	// Column 1 (left)
	if (($module_name != 'Forums') AND ($module_name !='Your_Account') AND ($module_name !='Journal') AND ($module_name !='Topics') AND ($module_name !='Private_Messages') AND ($module_name !='Members_List')):
	echo '<div class="col1 ct-left">';
	blocks('l');
	echo '<p class="clear" /></div>';
	endif;
	//coloum 2 (center)
	if (empty($index)) { $index = null; }
	if (defined('INDEX_FILE') || ($index == 1)) {
		// right blocks are showing
		echo '<div class="col2">';
	}
	elseif (($module_name != 'Forums') AND ($module_name !='Your_Account') AND ($module_name !='Journal') AND ($module_name !='Topics') AND ($module_name !='Private_Messages') AND ($module_name !='Members_List'))
	{
		// right blocks are NOT showing
		echo '<div class="col2_special">';
	}
	else { echo "<div>"; }
}

function themefooter() {
	global $foot1, $foot2, $foot3, $footer_message, $index;
	echo '<p class="clear" /></div><!-- end center -->';
	if (defined('INDEX_FILE') && INDEX_FILE===true || ($index === 1)) {
		echo '<!-- Column 3 (Right) --><div class="col1 ct-right">';
		blocks('r');
		echo '<p class="clear" /></div>';
	}
	echo '</div><!-- end columns  -->
	<div id="copyright">
	<a target="_blank" href="http://www.clanthemes.com">Clan Template</a> By Clan Themes © Making Clans Look Good';
	echo footmsg();
	echo '</div>
	<div id="footer">
	<span class="right">&nbsp;</span>
	<span class="left"> &nbsp;</span>
	</div>
	</div>
	</div><!-- end container -->';
}

function OpenTable() {
	echo'<div class="block_header maintitle">
	<div class="span1"></div><div class="span2"></div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">';
}

function CloseTable() {
	echo'  					</div>
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>';
}

function OpenTable2() {
	echo "\n".'<!-- table start --><div class="table2">'."\n";
}

function CloseTable2() {
	echo "\n".'</div><!-- table end -->'."\n";
}

function themesidebox($title, $content) {
	echo'			<div class="block_header maintitle">
	<div class="span1">'.$title.'</div><div class="span2"></div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">
	'.$content.'
	</div>
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<p class="clear" />';
}

function themecenterbox($title, $content, $bid = '') {
	global $admin, $admin_file;
	echo'<div class="block_header maintitle">
	<div class="span1">' , $title , '</div><div class="span2"></div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">'
	, $content;
	if (is_admin($admin) && !empty($bid)) {
		echo '<br /><br /><div class="text-center">[ <a href="' , $admin_file , '.php?op=BlocksEdit&amp;bid=' , $bid , '">' , _EDIT , '</a> ]</div>' , "\n";
	}
	echo '</div>
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<p class="clear" />';
}


function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath, $user, $admin, $index;
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
	if (is_user($user)||is_admin($admin)) $posted .= '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$aid.'">'.$aid.'</a>';
	else $posted .= $aid; //Raven 10/16/2005
	$posted .= ' '._ON.' '.$time.' ('.$counter.' '._READS.')';

	echo'			<div class="block_header maintitle">
	<div class="span1">'.$title.'</div><div class="span2"></div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">
	'.$posted.'
	</div>
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">
	'.$content.'
	</div>
	<p class="clear" />
	'.$morelink.'
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<p class="clear" />';
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {  //montego - added $notes for RavenNuke
	global $admin, $sid, $tipath, $index;
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
	echo'			<div class="block_header maintitle">
	<div class="span1">'.$title.'</div><div class="span2"></div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">
	'.$posted.'
	</div>
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<div class="block_content">
	<div class="roundcont">
	<div class="roundtop">
	<div>
	<img src="themes/CT_RN/images/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	<div class="articlecontent">
	'.$content.'
	</div>
	<p class="clear" />
	<div class="roundbottom">
	<img src="themes/CT_RN/images/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
	</div>
	</div>
	</div>
	</div>
	<p class="clear" />';
}

?>