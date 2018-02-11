<?php
if (!defined('NUKE_FILE')) die ('You can\'t access this file directly...');
$bgcolor1 = '#F4F6FB';
$bgcolor2 = '#BBCCDC';
$bgcolor3 = '#F4F6FB';
$bgcolor4 = '#BBCCDC';
$textcolor1 = '#516A88';
$textcolor2 = '#516A88';

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
	echo '<body>';
	if ($banners) {
		$adText = '';
		$adText = ads(0);
		if (!empty($adText)) {
			echo '<div id="banner_pagetop">' . $adText . '</div>';
		}
	};
	echo '<div class="minmax"><div id="header_wrap">
		<div id="header">
		<div id="head_content">
		<a href="', $nukeurl, '" title="', $sitename, ' - ', $slogan, '"><img src="themes/RavenIce/images/logo.gif" alt="', $sitename, ' - ', $slogan, '" border="0" /></a>
		</div>';
	if ($banners) {
		echo '<div id="head_ad">';
		echo ads(1);
		echo '</div>';
	};
	echo'</div>';
	if (empty($nukeNAV)) {
		echo '<div id="menu">
			<div id="menu_links">
				<ul>
					<li><a href="index.php">'._HOME.'</a></li>
					<li><a href="modules.php?name=Downloads">'._UDOWNLOADS.'</a></li>
					<li><a href="modules.php?name=Your_Account">'._FSIYOURACCOUNT.'</a></li>
					<li><a href="modules.php?name=Forums">'._BBFORUMS.'</a></li>
					'.(is_user($user) ? '<li><a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a></li>' : '').'
					'.(is_admin($admin) ? '<li><a href="'.$admin_file.'.php?op=adminMain">'._FSIADMINMENU.'</a></li>' : '').'
				</ul>
			</div>
		<div id="menu_welcome">';
	} else {
		echo '<div id="menunav">';
		echo $nukeNAV;
		echo '<div id="menu_welcomenav">';
	}
	if (is_user($user)) {
		$uinfo = cookiedecode($user);
		echo _BWEL." ".stripslashes($uinfo[1]);
	} else {
	echo '
		<ul>
			<li>&nbsp;&nbsp;<a href="modules.php?name=Your_Account">'._LOGIN.'</a> '._OR.'</li>
			<li><a href="modules.php?name=Your_Account&amp;op=new_user">'._BREG.'</a></li>
		</ul>';
	}
	echo '</div>
		</div></div>
		<div id="main_content">';

	global $hide_blocks_left;
	if (in_array($name, $hide_blocks_left)) {
		echo '<div id="middle_full"><!-- center column -->';
	} else {
		if(defined('INDEX_FILE') && INDEX_FILE===true) {
			// right blocks are showing
			echo '<div id="middle"><!-- center column -->';
		} else {
			// right blocks are NOT showing
			echo '<div id="middle_alt"><!-- center column -->';
		}
	}
}


function themefooter() {
  global $db, $prefix, $name;
  echo '
	 </div><!-- end center column -->
  </div><!-- end content -->
  ';

  global $hide_blocks_left;
  if (!in_array($name, $hide_blocks_left))
  {
	 echo '<div id="left"><!-- left column -->'."\n";
	 blocks('l');
	 echo "\n".'</div><!-- end left column -->'."\n";
  }
  if(defined('INDEX_FILE') && INDEX_FILE===true) { //display right blocks
	  echo '
	 <!-- start right column with right blocks -->
	 <div id="right">
		';
	  blocks('r');
	  echo '
	 </div>
	 <!-- end right column with right blocks -->
	 ';
  } else { // don't display right blocks
	  echo '
	<!-- start right column no right blocks -->
	<div id="right">
	</div>
	<!-- end right column no right blocks -->
	';
  }

  echo '
  <div style="clear: both"></div>
  <div id="footer">
	 ' . LGL_MENU_HTML . '
	 <p>Theme by: <a href="http://nukecoder.com">nukecoder.com</a></p>
  ';
  footmsg();
  echo '
  </div>
  </div>
  ';
}

$GLOBALS['nest_count'] = 0;
function OpenTable() {
  $GLOBALS['nest_count']++;
  if ($GLOBALS['nest_count'] % 2 == 0)
  {
	 echo '
	 <div class="inv_article">
		<div class="inv_article_top"><div>&nbsp;</div></div>
			 <div class="inv_article_content">
	 ';
  }
  else
  {
	 echo '
	 <div class="article">
		<div class="article_top"><div>&nbsp;</div></div>
		  <div class="article_content">
	 ';
  }
}

function CloseTable() {
  echo '
		  </div>
  ';
  echo ($GLOBALS['nest_count'] % 2 == 0) ? '<div class="inv_article_bot">' : '<div class="article_bot">';
  echo '<div>&nbsp;</div></div>
	 </div>
  ';
  $GLOBALS['nest_count']--;
}

function OpenTable2() {
  OpenTable();
}

function CloseTable2() {
  CloseTable();
}

function themesidebox($title, $content, $bid='') {
  echo '
  <div class="block">
	 <div class="block_gradient">
		<div class="block_top"><div><h3>'.$title.'</h3></div></div>
	 </div>
	 <div class="block_content">
		 '.$content.'
	 </div>
	 <div class="article_bot"><div>&nbsp;</div></div>
  </div>
  ';
}

function themecenterbox($title, $content, $bid = '') {
	global $admin, $admin_file;
	echo '
	<div class="block_center">
		<div class="block_gradient">
		<div class="block_top"><div><h3>'.$title.'</h3></div></div>
	</div>
	<div class="block_content">'
	, $content;
	if (is_admin($admin) && !empty($bid)) {
		echo '<br /><br /><div class="text-center">[ <a href="' , $admin_file , '.php?op=BlocksEdit&amp;bid=' , $bid , '">' , _EDIT , '</a> ]</div>' , "\n";
	}
	echo '</div>
		<div class="article_bot"><div>&nbsp;</div></div>
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

  ?>
  <div class="article">
	 <div class="article_top"><div>&nbsp;</div></div>
		<div class="article_content">
		  <div class="atitle">
			 <h2><?php echo $title; ?></h2>
			 <p><?php echo ''._POSTEDON.' '.$time.' '._IN.''; ?> <a href="modules.php?name=News&amp;new_topic=<?php echo $topic; ?>"><?php echo ''.$topictext.'</a><br />'._BY.' '?><?php formatAidHeader($aid); ?></p>
		  </div>
		  <div class="entry">
			 <blockquote>
				<?php FormatStory($thetext, $notes, $aid, $informant); ?>
			 </blockquote>
		  </div>
		  <p class="links">
			 <?php
                       echo $morelink;
			// echo substr($morelink, 1, strlen($morelink) - 2); //get rid of the ( ) around the $morelink :)
			// echo ' | '. $counter .' '. _READS;
			 ?>
		  </p>
	 </div>
	 <div class="article_bot"><div>&nbsp;</div></div>
  </div><br />
  <?php
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
  global $admin, $sid, $tipath;
  ?>
  <div class="article">
	 <div class="article_top"><div>&nbsp;</div></div>
		<div class="article_content">
		  <div class="atitle">
			 <h2><?php echo $title; ?></h2>
			 <p><?php echo ''._POSTEDON.' '.$datetime.' '._IN.'';?> <a href="modules.php?name=News&amp;new_topic=<?php echo $topic; ?>"><?php echo ''.$topictext.' </a><br /> '._BY.' '?><?php formatAidHeader($aid); ?></p>
		  </div>
		  <div class="entry">
			 <blockquote>
				<?php FormatStory($thetext, $notes, $aid, $informant); ?>
			 </blockquote>
		  </div>
		</div>
	 <div class="article_bot"><div>&nbsp;</div></div>
  </div>
  <?php
}

?>