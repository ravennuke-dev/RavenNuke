<?php

if ( !defined('MODULE_FILE') ) {
    die ('You can\'t access this file directly...');
}
define('INDEX_FILE', true); //comment this out to hide right blocks
if (defined('INDEX_FILE')) { $index = 1; } else {$index = 0; } // auto set right blocks for pre patch 3.1 compatibility
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";
//Data input function (from user)
function inCode($string) {
	if (get_magic_quotes_gpc()) { $string = stripslashes($string); }
	$string = str_replace('<br type="_moz" />','',$string); //FCKeditor 2.5.1 bug fix
	if ($string=="<br />") { $string = ""; } //FCKeditor 2.5.1 bug fix
	$string = htmlspecialchars($string,ENT_QUOTES);
	$string = str_replace("'","&#039;",$string); //2 passes is better than 1 :\
	return addslashes($string);
}

$op = (isset($_GET['op'])) ? inCode($_GET['op']) : "" ;
$tag = (isset($_GET['tag'])) ? inCode($_GET['tag']) : "" ;
	include("header.php");
	OpenTable();	
	switch ($op) {
		case "list":
			getList($tag);
		break;
		default:
			tagList();
		break;
	}
	
	CloseTable();
	include("footer.php");

function tagList() {
	global $db, $prefix, $dim;
	
	
	
	echo '<div align="justify" class="box">';
		$result = $db->sql_query("SELECT tag FROM ".$prefix."_tags GROUP BY tag ORDER BY RAND()");
		while ($row = $db->sql_fetchrow($result)) {
			$tag = addslashes(check_words(check_html($row['tag'], "nohtml")));
			$num = $db->sql_numrows($db->sql_query("SELECT tag FROM ".$prefix."_tags WHERE tag='$tag'"));
			if ($num<=1) { $dim = 'class1'; }
			else if ($num<=5) { $dim = 'class2'; }
			else if ($num<=20) { $dim = 'class3'; }
			else if ($num<=50) { $dim = 'class4'; }
			else { $dim = 'class5'; }			
			echo '<span style="padding: 0 2px;" class="'.$dim.'"><a href="modules.php?name=Tags&amp;op=list&amp;tag='.urlencode($tag).'" title="'.$tag.'">'.$tag.'</a></span>'."\n";
		}
	echo '</div>';
}

function getList($tag) {
	global $db, $prefix, $module_name;	
	

	//News
	if ($result = $db->sql_query("SELECT * FROM ".$prefix."_stories AS nw JOIN ".$prefix."_tags AS tg ON nw.sid=tg.cid WHERE tg.whr=3 AND tg.tag='$tag' ORDER BY sid DESC LIMIT 50")) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT custom_title FROM ".$prefix."_modules WHERE title='News' AND active='1'")); $ptitle = $row['custom_title'];
		echo '<img src="modules/Tags/images/bullet_paper.gif" border="0" alt="Bullet" /> <a href="modules.php?name=News" title="'.$ptitle.'"><span class="thick">'.$ptitle.'</span></a><br />';
		while ($row = $db->sql_fetchrow($result)) {
			$sid = intval($row['sid']);
			$title = addslashes(check_words(check_html($row['title'], "nohtml")));
			echo '&nbsp;&nbsp;- <span class="medium"><a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'" title="'.$title.'">'.$title.'</a></span><br />'."\n";
		}
		echo '<br />';
	}
	
}

?>