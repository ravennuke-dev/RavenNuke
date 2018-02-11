<?php
if (!defined('NUKE_FILE')) die ('You can\'t access this file directly...');
$bgcolor1 = '#cee7fa';
$bgcolor2 = '#cee7fa';
$bgcolor3 = '#cee7fa';
$bgcolor4 = '#cee7fa';
$textcolor1 = '#1e3342';
$textcolor2 = '#1e3342';

/*
* To hide left-hand blocks for a given module, add an element to
* this array with the module name (directory name).  To show the
* blocks, just remove the element from the array.
*/
$hide_blocks_left = array('Forums');
global $name;
if (!isset($name)) $name = '';

function themeheader() {
	global $db, $prefix, $banners, $sitename, $user, $admin, $admin_file, $nukeurl, $slogan, $name, $nukeNAV;
	//Body & Container
	echo '<body class="thrColFixHdr">';
//	echo $nukeNAV;
	if ($banners) {
		$adText = '';
		$adText = ads(0);
		if (!empty($adText)) {
			echo '<div id="banner_pagetop">' . $adText . '</div>';
		}
	};
	echo '<div id="container">';
	//Start CSS
	echo '<div class="navigation">';//Start Navigation
	echo '<div class="navleft"></div>';
	echo '<div class="navmiddle">';
	if (empty($nukeNAV)) {
		$nukeNAV = '<a href="index.php" class="navlinks">Home</a>'
		. '<a href="modules.php?name=Forums" class="navlinks">Forums</a>'
		. '<a href="modules.php?name=Downloads" class="navlinks">Downloads</a>'
		. '<a href="modules.php?name=Your_Account" class="navlinks">Account</a>';
		if(is_admin($admin)) $nukeNAV .= '<a href="'.$admin_file.'.php" class="navlinks">Admin</a>';
	}
	echo '<div class="text-center">'.$nukeNAV.'</div>';
	echo '</div>';
	echo '<div class="navright"></div>';
	echo '</div>';//End Navigation
	echo '<div id="header"></div>';
	if ($banners) {
		echo '<div id="head_ad">';
		echo ads(1);
		echo '</div>';
	};
	global $hide_blocks_left;
	if (!in_array($name, $hide_blocks_left))
	{
		echo '<div id="sidebar1"><!-- left column -->'."\n";
		blocks('l');
		echo "\n".'</div><!-- end left column -->'."\n";
	}
	if(defined('INDEX_FILE') && INDEX_FILE===true) {
		echo '
		<!-- start right column -->
		<div id="sidebar2">
		';
		blocks('r');
		echo '
		</div>
		<!-- end right column -->
		';
	}
	global $hide_blocks_left;
	if (in_array($name, $hide_blocks_left))
	{
		echo '<div id="mainContent_full"><!-- center column -->';
	}
	else
	{
		if(defined('INDEX_FILE') && INDEX_FILE===true) {
			// right blocks are showing
			echo '<div id="mainContent"><!-- center column -->';
		}
		else
		{
			// right blocks are NOT showing
			echo '<div id="mainContent_alt"><!-- center column -->';
		}
	}
}

function themefooter() {
	global $db, $prefix;
	echo '
	<!-- end #mainContent --></div>
	';

	echo '<div class="clearfloat"></div>';//Clear All
	echo '<div id="footer">';//Start Footer
	echo '<div id="footer1">';
	echo '<br />' . LGL_MENU_HTML;
	echo '<div class="footmsg">' . footmsg() . '</div>';
	echo '</div>';
	echo '<div id="footer2">';
	echo '<div class="footimg"><img src="themes/SimplyBlue/images/valid-xhtml10.png" alt="Valid XHTML" width="88" height="31" /></div>';//Just remove this whole line to remove xhtml image these are just examples
	echo '<div class="footimg"><img src="themes/SimplyBlue/images/valid-css.png" alt="Valid CSS" width="88" height="31" /></div>';//Just remove this whole line to remove css image these are just examples
	echo '<div class="footimg"><img src="themes/SimplyBlue/images/clanthemes.gif" alt="Clan Themes" width="88" height="31" /></div>';//Just remove this whole line to remove ct image these are just examples
	echo '</div>';
	//Please consider not removing our copyright, we are working hard to provide you with free quality products.  ~Floppy
	echo '<div id="footer3"><span><a href="http://www.clanthemes.com/shop_category-90-free-phpnuke-themes.html" title="Free Phpnuke Themes" target="_blank"><img src="themes/SimplyBlue/images/footer_06.png" width="119" height="39" alt="Free Phpnuke Themes" /></a></span></div>';
	echo '</div><!-- end #footer -->';
	echo '</div><!-- end #container -->';
}

function OpenTable() {
	echo '<div class="centerblocks">';
	echo '<div class="centertopleft"></div>';
	echo '<div class="centertopright"></div>';
	echo '<div class="centerblockcontent">';
}

function CloseTable() {
	echo '</div>
	<div class="centerbottomleft"></div>
	<div class="centerbottomright"></div>
	</div>
	';
}

function OpenTable2() {
	OpenTable();
}

function CloseTable2() {
	CloseTable();
}

function themesidebox($title, $content) {
	echo '<div class="leftblocks">
	<div class="leftleft"></div>
	<div class="leftmiddle"><span>'.$title.'</span></div>
	<div class="leftright"></div>';
	echo '<div class="clearfloat"></div>';//Clear All
	echo '<div class="blockcontent">
	'.$content.'
	</div>
	<div class="blockbottom"></div>
	</div>';
}

function themecenterbox($title, $content, $bid = '') {
	global $admin, $admin_file;
	echo '<div class="centerblocks">'
		, '<div class="centertopleft"></div>'
		, '<div class="centertopright"></div>'
		, '<div class="centerblockcontent">
		<h2>' , $title , '</h2>'
		, $content;
	if (is_admin($admin) && !empty($bid)) {
		echo '<br /><br /><div class="text-center">[ <a href="' , $admin_file , '.php?op=BlocksEdit&amp;bid=' , $bid , '">' , _EDIT , '</a> ]</div>' , "\n";
	}
	echo '</div>
	<div class="centerbottomleft"></div>
	<div class="centerbottomright"></div>
	</div>';
}

function FormatStory($thetext, $notes, $aid, $informant) {
	global $anonymous;
	$content = '';
	$thetext = '<div>'.$thetext.'</div>';
	if (!empty($notes)) {
		$notes = '<br /><strong>'._NOTE.'</strong>&nbsp;<div>'.$notes.'</div>';
	} else {
		$notes = '';
	}
	if ($aid == $informant) {
		$content = $thetext.$notes;
	} else {
		if(!empty($informant)) {
			global $admin, $user;
			if (is_user($user)||is_admin($admin)) {
				$content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><span class="italic">'.$informant.'</span></a> ';
			} else {
				$content = $informant.' ';
			}
		} else {
			$content = $anonymous.' ';
		}
		$content .= '<span class="italic">'._WRITES.':</span>&nbsp;&nbsp;'.$thetext.$notes;
	}
	echo $content;
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;

	OpenTable();
//modified for tricked out news
	?>
	<h2><?php echo $title; ?></h2>

	<p><?php echo ''._POSTEDON.' '.$time.' '._IN.''; ?> <a href="modules.php?name=News&amp;new_topic=<?php echo $topic; ?>"><?php echo ''.$topictext.'</a> ('. $counter .' '. _READS.') <br />'._BY.' '?><?php formatAidHeader($aid);?></p>

	<div class="entry">
		<?php FormatStory($thetext, $notes, $aid, $informant); ?>
	</div>
	<p class="links">
		<?php

		echo $morelink; //get rid of the ( ) around the $morelink :)
		//echo ' ( '. $counter .' '. _READS.' ) ';
//end mod for tricked out news
		?>
	</p>
	<?php
	CloseTable();
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $tipath;
	OpenTable();
	?>
	<h2><?php echo $title; ?></h2>
	<p><?php echo ''._POSTEDON.' '.$datetime.' '._IN.'';?> <a href="modules.php?name=News&amp;new_topic=<?php echo $topic; ?>"><?php echo ''.$topictext.' </a><br /> '._BY.' '?><?php formatAidHeader($aid); ?></p>
	<div class="entry">
		<?php FormatStory($thetext, $notes, $aid, $informant); ?>
	</div>
	<?php
	CloseTable();
}
?>