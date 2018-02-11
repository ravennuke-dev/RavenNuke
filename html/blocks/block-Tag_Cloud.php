<?php

if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
	global $db, $prefix, $dim;
	
	$content = '<div class="text-justify">';
		$result = $db->sql_query("SELECT tag,COUNT(tag) AS tot FROM ".$prefix."_tags GROUP BY tag ORDER BY RAND() LIMIT 50");
		while ($row = $db->sql_fetchrow($result)) {
			$tag = addslashes(check_words(check_html($row['tag'], "nohtml")));
			$num = intval($row['tot']);

			if ($num<=1) { $dim = "class1"; }
			else if ($num<=5) { $dim = "class2"; }
			else if ($num<=20) { $dim = "class3"; }
			else if ($num<=50) { $dim = "class4"; }
			else { $dim = "class5"; }
			
			$content .= '<span style="padding: 0 2px;" class="'.$dim.'"><a href="modules.php?name=Tags&amp;op=list&amp;tag='.urlencode($tag).'" class="'.$dim.'" title="'.$tag.'">'.$tag.'</a></span>'."\n";
		}
	$content .= '</div>';
?>
