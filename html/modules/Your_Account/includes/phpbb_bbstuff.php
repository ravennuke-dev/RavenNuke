<?php

function parse_bbcode($hometext, $bbcode_uid) {

		$bbcode_tpl = array();
		$bbcode_tpl['b'] = '<span style="font-weight: bold;">';
		$bbcode_tpl['b_close'] = '</span>';
		$bbcode_tpl['i'] = '<span style="font-style: italic;">';
		$bbcode_tpl['i_close'] = '</span>';
		$bbcode_tpl['u'] = '<span style="text-decoration: underline;">';
		$bbcode_tpl['u_close'] = '</span>';
		$bbcode_tpl['size_open'] = '<span style="font-size: $1px; line-height: normal">';
		$bbcode_tpl['size_close'] = '</span>';
		$bbcode_tpl['color_open'] = '<span style="color: $1;">';
		$bbcode_tpl['color_close'] = '</span>';
		$bbcode_tpl['img'] = '<img src="$1" border="0" />';
		$bbcode_tpl['url1'] = '<a href="$1$2" target="_blank" class="postlink">$1$2</a>';
		$bbcode_tpl['url2'] = '<a href="http://$1" target="_blank" class="postlink">$1</a>';
		$bbcode_tpl['url3'] = '<a href="$1$2" target="_blank" class="postlink">$6</a>';
		$bbcode_tpl['url4'] = '<a href="http://$1" target="_blank" class="postlink">$5</a>';
		$bbcode_tpl['email'] = '<a href="mailto:$1" class="postlink">$1</a>';
		$bbcode_tpl['code_open'] = '</span><table width="85%" cellspacing="1" cellpadding="3" border="0" align="center"><tr><td><span class="genmed"><span class="thick">' . _CODE . ':</span></span></td></tr><tr><td class="code">';
		$bbcode_tpl['code_close'] = '</td></tr></table><span class="postbody">';
		$bbcode_tpl['quote_open'] = '</span><table width="85%" cellspacing="1" cellpadding="3" border="0" align="center"><tr><td><span class="genmed"><span class="thick">' . _QUOTE . ':</span></span></td></tr><tr><td class="quote">';
		$bbcode_tpl['quote_close'] = '</td></tr></table><span class="postbody">';
		$bbcode_tpl['quote_username_open'] = '</span><table width="85%" cellspacing="1" cellpadding="3" border="0" align="center"><tr><td><span class="genmed"><span class="thick">$1 ' . _WROTE . ':</span></span></td></tr><tr><td class="quote">';
		$bbcode_tpl['ulist_open'] = '<ul>';
		$bbcode_tpl['ulist_close'] = '</ul>';
		$bbcode_tpl['olist_open'] = '<ol type="$1">';
		$bbcode_tpl['olist_close'] = '</ol>';
		$bbcode_tpl['list_item'] = '<li>';

		$patterns = array();
		$replacements = array();
		$patterns[] = "#\[img:$bbcode_uid\](.*?)\[/img:$bbcode_uid\]#si";
		$replacements[] = $bbcode_tpl['img'];
		$patterns[] = "#\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]#is";
		$replacements[] = $bbcode_tpl['url1'];
		$patterns[] = "#\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url2'];
		$patterns[] = "#\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url3'];
		$patterns[] = "#\[url=(([\w\-]+\.)*?[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\](.*?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url4'];
		$patterns[] = "#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
		$replacements[] = $bbcode_tpl['email'];

		$hometext = preg_replace($patterns, $replacements, $hometext);

		$code_start_html = $bbcode_tpl['code_open'];
		$code_end_html =  $bbcode_tpl['code_close'];

		$match_count = preg_match_all("#\[code:1:$bbcode_uid\](.*?)\[/code:1:$bbcode_uid\]#si", $hometext, $matches);
		for ($i = 0; $i < $match_count; $i++) {
			$before_replace = $matches[1][$i];
			$after_replace = $matches[1][$i];
			$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
			$after_replace = str_replace("  ", " &nbsp;", $after_replace);
			$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);
			$str_to_match = "[code:1:$bbcode_uid]" . $before_replace . "[/code:1:$bbcode_uid]";
			$replacement = $code_start_html;
			$replacement .= $after_replace;
			$replacement .= $code_end_html;
			$hometext = str_replace($str_to_match, $replacement, $hometext);
		}

		$hometext = str_replace("[code:$bbcode_uid]", $code_start_html, $hometext);
		$hometext = str_replace("[/code:$bbcode_uid]", $code_end_html, $hometext);
		$hometext = str_replace("[quote:$bbcode_uid]", $bbcode_tpl['quote_open'], $hometext);
		$hometext = str_replace("[/quote:$bbcode_uid]", $bbcode_tpl['quote_close'], $hometext);
		$hometext = preg_replace("/\[quote:$bbcode_uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $hometext);
		$hometext = str_replace("[list:$bbcode_uid]", $bbcode_tpl['ulist_open'], $hometext);
		$hometext = str_replace("[*:$bbcode_uid]", $bbcode_tpl['list_item'], $hometext);
		$hometext = str_replace("[/list:u:$bbcode_uid]", $bbcode_tpl['ulist_close'], $hometext);
		$hometext = str_replace("[/list:o:$bbcode_uid]", $bbcode_tpl['olist_close'], $hometext);
		$hometext = preg_replace("/\[list=([a1]):$bbcode_uid\]/si", $bbcode_tpl['olist_open'], $hometext);
		$hometext = str_replace("[b:$bbcode_uid]", $bbcode_tpl['b'], $hometext);
		$hometext = str_replace("[/b:$bbcode_uid]", $bbcode_tpl['b_close'], $hometext);
		$hometext = str_replace("[u:$bbcode_uid]", $bbcode_tpl['u'], $hometext);
		$hometext = str_replace("[i:$bbcode_uid]", $bbcode_tpl['i'], $hometext);
		$hometext = str_replace("[/u:$bbcode_uid]", $bbcode_tpl['u_close'], $hometext);
		$hometext = str_replace("[/i:$bbcode_uid]", $bbcode_tpl['i_close'], $hometext);
		$hometext = preg_replace("/\[size=([1-2]?[0-9]):$bbcode_uid\]/si", $bbcode_tpl['size_open'], $hometext);
		$hometext = str_replace("[/size:$bbcode_uid]", $bbcode_tpl['size_close'], $hometext);
		$hometext = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$bbcode_uid\]/si", $bbcode_tpl['color_open'], $hometext);
		$hometext = str_replace("[/color:$bbcode_uid]", $bbcode_tpl['color_close'], $hometext);

		return $hometext;
}

function dss_rand() {
	global $board_config, $db, $dss_seeded, $prefix;

	$val = $board_config['rand_seed'] . microtime();
	$val = md5($val);
	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');

	if($dss_seeded !== true) {
		$sql = "UPDATE " . $prefix . "_bbconfig SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";

		if( !$db->sql_query($sql) ) {
			die('Unable to reseed PRNG');
		}

		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}

?>