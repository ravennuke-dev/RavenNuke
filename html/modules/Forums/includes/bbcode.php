<?php
/***************************************************************************
 *                              bbcode.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: bbcode.php,v 1.36.2.41 2006/02/26 17:34:50 grahamje Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define("BBCODE_UID_LEN", 10);

// global that holds loaded-and-prepared bbcode templates, so we only have to do
// that stuff once.

$bbcode_tpl = null;

/**
 * Loads bbcode templates from the bbcode.tpl file of the current template set.
 * Creates an array, keys are bbcode names like "b_open" or "url", values
 * are the associated template.
 * Probably pukes all over the place if there's something really screwed
 * with the bbcode.tpl file.
 *
 * Nathan Codding, Sept 26 2001.
 */
function load_bbcode_template()
{
	global $template;
	$tpl_filename = $template->make_filename('bbcode.tpl');
	$tpl = fread(fopen($tpl_filename, 'r'), filesize($tpl_filename));

	// replace \ with \\ and then ' with \'.
	$tpl = str_replace('\\', '\\\\', $tpl);
	$tpl  = str_replace('\'', '\\\'', $tpl);

	// strip newlines.
	$tpl  = str_replace("\n", '', $tpl);

	// Turn template blocks into PHP assignment statements for the values of $bbcode_tpls..
	$tpl = preg_replace('#<!-- BEGIN (.*?) -->(.*?)<!-- END (.*?) -->#', "\n" . '$bbcode_tpls[\'\\1\'] = \'\\2\';', $tpl);

	$bbcode_tpls = array();

	eval($tpl);

	return $bbcode_tpls;
}


/**
 * Prepares the loaded bbcode templates for insertion into preg_replace()
 * or str_replace() calls in the bbencode_second_pass functions. This
 * means replacing template placeholders with the appropriate preg backrefs
 * or with language vars. NOTE: If you change how the regexps work in
 * bbencode_second_pass(), you MUST change this function.
 *
 * Nathan Codding, Sept 26 2001
 *
 */
function prepare_bbcode_template($bbcode_tpl)
{
	global $lang;

	$bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}', '\\1', $bbcode_tpl['olist_open']);

	$bbcode_tpl['color_open'] = str_replace('{COLOR}', '\\1', $bbcode_tpl['color_open']);

	$bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);

	$bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);

	$bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}', '\\1', $bbcode_tpl['quote_username_open']);

	$bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);

	$bbcode_tpl['img'] = str_replace('{URL}', '\\1', $bbcode_tpl['img']);

	// We do URLs in several different ways..
	$bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);

	$bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

	$bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);

	$bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url4']);

	$bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

/************************************************************************/
/* ================ START Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	$bbcode_tpl['left'] = str_replace('{URL}', '\\1', $bbcode_tpl['left']);
	$bbcode_tpl['right'] = str_replace('{URL}', '\\1', $bbcode_tpl['right']);
	$bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_VIEW}', $lang['BBcode_box_view'], $bbcode_tpl['spoil_open']);
	$bbcode_tpl['align_open'] = str_replace('{ALIGN}', '\\1', $bbcode_tpl['align_open']);
	$bbcode_tpl['stream'] = str_replace('{URL}', '\\1', $bbcode_tpl['stream']);
	$bbcode_tpl['flash'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{URL}', '\\3', $bbcode_tpl['flash']);
	$bbcode_tpl['video'] = str_replace('{URL}', '\\3', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['video']);
	$bbcode_tpl['font_open'] = str_replace('{FONT}', '\\1', $bbcode_tpl['font_open']);
	$bbcode_tpl['class_open'] = str_replace('{FONTCLASS}', '\\1', $bbcode_tpl['class_open']);
	$bbcode_tpl['pre_open'] = str_replace('{PRECLASS}', '\\1', $bbcode_tpl['pre_open']);
	$bbcode_tpl['pre_open'] = str_replace('{ITS_CODE}', $lang['Code'], $bbcode_tpl['pre_open']);
	$bbcode_tpl['pre_open'] = str_replace('{L_SELECT}', $lang['Select'], $bbcode_tpl['pre_open']);
	$bbcode_tpl['pre_open'] = str_replace('{L_EXPAND}', $lang['Expand'], $bbcode_tpl['pre_open']);
	$bbcode_tpl['pre_open'] = str_replace('{L_CONTRACT}', $lang['Contract'], $bbcode_tpl['pre_open']);
	$bbcode_tpl['archive'] = str_replace('{ARCHIVEID}', '\\2', $bbcode_tpl['archive']);
	$bbcode_tpl['archive'] = str_replace('{ARCHIVETYPE}', '\\1', $bbcode_tpl['archive']);
	$bbcode_tpl['youtube'] = str_replace('{YOUTUBEID}', '\\1', $bbcode_tpl['youtube']);
	$bbcode_tpl['newtube'] = str_replace('{NEWTUBEID}', '\\2', $bbcode_tpl['newtube']);
	$bbcode_tpl['newtube'] = str_replace('{NEWTUBESIZE}', '\\1', $bbcode_tpl['newtube']);
	$bbcode_tpl['xfirevideo'] = str_replace('{XFIREID}', '\\1', $bbcode_tpl['xfirevideo']);

	//+MOD: Select Expand BBcodes MOD

	// Replacing BBCode variables, but also adding CR to preserve HTML comment delimiters for JS code.
	$expand_ary1 = array('<!--', '//-->', '{L_SELECT}', '{L_EXPAND}', '{L_CONTRACT}');
	$expand_ary2 = array("\r<!--\r", "\r//-->\r", $lang['Select'], $lang['Expand'], $lang['Contract']);
	$expand_ary3 = array('<!--', '//-->');
	$expand_ary4 = array("\r<!--\r", "\r//-->\r");

	$bbcode_tpl['quote_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_open']);
	$bbcode_tpl['quote_username_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['code_open'] = str_replace($expand_ary1, $expand_ary2, $bbcode_tpl['code_open']);

	$bbcode_tpl['quote_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['quote_close']);
	$bbcode_tpl['code_close'] = str_replace($expand_ary3, $expand_ary4, $bbcode_tpl['code_close']);
	//-MOD: Select Expand BBcodes MOD

/************************************************************************/
/* ================= STOP Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	define("BBCODE_TPL_READY", true);

	return $bbcode_tpl;
}


/**
 * Does second-pass bbencoding. This should be used before displaying the message in
 * a thread. Assumes the message is already first-pass encoded, and we are given the
 * correct UID as used in first-pass encoding.
 */
function bbencode_second_pass($text, $uid)
{
	global $lang, $bbcode_tpl;
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// First: If there isn't a "[" and a "]" in the message, don't bother.
	if (! (strpos($text, "[") && strpos($text, "]")) )
	{
		// Remove padding, return.
		$text = substr($text, 1);
		return $text;
	}

	// Only load the templates ONCE..
	if (!defined("BBCODE_TPL_READY"))
	{
		// load templates from file into array.
		$bbcode_tpl = load_bbcode_template();

		// prepare array for use in regexps.
		$bbcode_tpl = prepare_bbcode_template($bbcode_tpl);
	}

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_second_pass_code($text, $uid, $bbcode_tpl);

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = str_replace("[quote:$uid]", $bbcode_tpl['quote_open'], $text);
	$text = str_replace("[/quote:$uid]", $bbcode_tpl['quote_close'], $text);

	// New one liner to deal with opening quotes with usernames...
	// replaces the two line version that I had here before..
	$text = preg_replace("/\[quote:$uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $text);

	// [list] and [list=x] for (un)ordered lists.
	// unordered lists
	$text = str_replace("[list:$uid]", $bbcode_tpl['ulist_open'], $text);
	// li tags
	$text = str_replace("[*:$uid]", $bbcode_tpl['listitem'], $text);
	// ending tags
	$text = str_replace("[/list:u:$uid]", $bbcode_tpl['ulist_close'], $text);
	$text = str_replace("[/list:o:$uid]", $bbcode_tpl['olist_close'], $text);
	// Ordered lists
	$text = preg_replace("/\[list=([a1]):$uid\]/si", $bbcode_tpl['olist_open'], $text);

	// colours
	$text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['color_open'], $text);
	$text = str_replace("[/color:$uid]", $bbcode_tpl['color_close'], $text);

	// size
	$text = preg_replace("/\[size=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['size_open'], $text);
	$text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);

	// [b] and [/b] for bolding text.
	$text = str_replace("[b:$uid]", $bbcode_tpl['b_open'], $text);
	$text = str_replace("[/b:$uid]", $bbcode_tpl['b_close'], $text);

	// [u] and [/u] for underlining text.
	$text = str_replace("[u:$uid]", $bbcode_tpl['u_open'], $text);
	$text = str_replace("[/u:$uid]", $bbcode_tpl['u_close'], $text);

	// [i] and [/i] for italicizing text.
	$text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
	$text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

	// Patterns and replacements for URL and email tags..
	$patterns = array();
	$replacements = array();

	// [img]image_url_here[/img] code..
	// This one gets first-passed..
	$patterns[] = "#\[img:$uid\]([^?](?:[^\[]+|\[(?!url))*?)\[/img:$uid\]#i";
	$replacements[] = $bbcode_tpl['img'];

	// matches a [url]xxxx://www.phpbb.com[/url] code..
	$patterns[] = "#\[url\]([\w]+?://([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url1'];

	// [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url\]((www|ftp)\.([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url2'];

	// [url=xxxx://www.phpbb.com]phpBB[/url] code..
	$patterns[] = "#\[url=([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url3'];

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url=((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url4'];

	// [email]user@domain.tld[/email] code..
	$patterns[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
	$replacements[] = $bbcode_tpl['email'];

/************************************************************************/
/* ================ START Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	$text = preg_replace_callback(
		"#\[tag:$uid\](.*?)\[/tag:$uid\]#is",
		function ($m) use ($uid, $bbcode_tpl) {
			$bbcode_tpl['search'] = str_replace('{STRING}', $m[1], $bbcode_tpl['search']);
			$bbcode_tpl['search'] = str_replace('{KEYWORD}', urlencode(trim($m[1])), $bbcode_tpl['search']);
			return $bbcode_tpl['search'];
		},
		$text
	);

	// [imgleft]Image URL Here[/imgleft] code..
	$patterns[] = "#\[imgleft:$uid\](.*?)\[/imgleft:$uid\]#si";
	$replacements[] = $bbcode_tpl['left'];

	// [imgright]Image URL Here[/imgleft] code..
	$patterns[] = "#\[imgright:$uid\](.*?)\[/imgright:$uid\]#si";
	$replacements[] = $bbcode_tpl['right'];

	// duckduckgo
	$text = preg_replace_callback(
		"#\[duck:$uid\](.*?)\[/duck:$uid\]#is",
		function ($m) use ($uid, $bbcode_tpl) {
			$bbcode_tpl['duck'] = str_replace('{STRING}', trim($m[1]), $bbcode_tpl['duck']);
			$bbcode_tpl['duck'] = str_replace('{QUERY}', urlencode(trim($m[1])), $bbcode_tpl['duck']);
			return $bbcode_tpl['duck'];
		},
		$text
	);

	// wikipedia
	$text = preg_replace_callback(
		"#\[wiki:$uid\](.*?)\[/wiki:$uid\]#is",
		function ($m) use ($uid, $bbcode_tpl) {
			$bbcode_tpl['wiki_default'] = str_replace('{STRING}', trim($m[1]), $bbcode_tpl['wiki_default']);
			$bbcode_tpl['wiki_default'] = str_replace('{QUERY}', urlencode(str_replace(' ', '_', $m[1])), $bbcode_tpl['wiki_default']);
			return $bbcode_tpl['wiki_default'];
		},
		$text
	);

	$text = preg_replace_callback(
		"#\[wiki=(en|de|fr|nl|it|pl|es|ru|ja|pt|sv|zh|uk|vi|ca|no|fi|cs|hu|ko|id|tr|ro|fa|ar|da|eo|sr|lt|sk|sl|ms|he|bg|kk|eu|vo|war|hr|hi|et|az|gl|nn|simple|th|la|el|new|tl|sh|ka|mk|ht|pms|te|ta|ceb|br|sq|lv|be|jv|mg|cy|lb|mr|is|bs|ya|an|bpy|hy|lmo|fy|sw|bn|ml|io|gu|af|pnb|ne|nds|scn|ku|ur|su|qu|diq|ba|ast|tt|ga|nap|ia):$uid\](.*?)\[/wiki:$uid\]#is",
		function ($m) use ($uid, $bbcode_tpl) {
			$bbcode_tpl['wiki'] = str_replace('{WIKI}', $m[1], $bbcode_tpl['wiki']);
			$bbcode_tpl['wiki'] = str_replace('{STRING}', $m[2], $bbcode_tpl['wiki']);
			$bbcode_tpl['wiki'] = str_replace('{QUERY}', urlencode(str_replace(' ', '_', $m[2])), $bbcode_tpl['wiki']);
			return $bbcode_tpl['wiki'];
		},
		$text
	);

	// [stream]Sound URL[/stream] code..
	$patterns[] = "#\[stream:$uid\](.*?)\[/stream:$uid\]#si";
	$replacements[] = $bbcode_tpl['stream'];

	// [flash width=X height=X]Flash URL[/flash] code..
	$patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/flash:$uid\]#si";
	$replacements[] = $bbcode_tpl['flash'];

	// [video width=X height=X]Video URL[/video] code..
	$patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/video:$uid\]#si";
	$replacements[] = $bbcode_tpl['video'];
	$text = preg_replace($patterns, $replacements, $text);

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("/\[align=(left|right|center|justify):$uid\]/si", $bbcode_tpl['align_open'], $text);
	$text = str_replace("[/align:$uid]", $bbcode_tpl['align_close'], $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
	$text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);

	// [class=font]text[/class] code..
	$text = preg_replace("/\[class:$uid=\"([_a-zA-Z0-9- ]*)\"\]/si", $bbcode_tpl['class_open'], $text);
	$text = str_replace("[/class:$uid]", $bbcode_tpl['class_close'], $text);

	// [pre=php]text[/pre] code..
	// next line needed due to first preg_replace of this function, to support other languages that end with script a similar replace would be needed
	$text = str_replace("pre=javascript:", "pre=javascript:", $text);
	$text = preg_replace("/\[pre=(php|html|python|profile|ruby|perl|scala|go|xml|django|css|javascript|vbscript|lua|delphi|java|cpp|objectivec|vala|cs|rsl|rib|mel|sql|smalltalk|lisp|ini|apache|nginx|diff|dos|bash|cmake|axapta|1c|avrasm|vhdl|parser3|tex|haskell|erlang|erlang_repl):$uid\]/si", $bbcode_tpl['pre_open'], $text);
	$text = str_replace("[/pre:$uid]", $bbcode_tpl['pre_close'], $text);

	// [hr]
	$text = str_replace("[hr:$uid]", $bbcode_tpl['hr'], $text);

	// [sub]Subscrip[/sub] code..
	$text = str_replace("[sub:$uid]", '<sub>', $text);
	$text = str_replace("[/sub:$uid]", '</sub>', $text);

	// [sup]Superscript[/sup] code..
	$text = str_replace("[sup:$uid]", '<sup>', $text);
	$text = str_replace("[/sup:$uid]", '</sup>', $text);

	// [strike]Strikethrough[/strike] code..
	$text = str_replace("[s:$uid]", '<span class="line-through">', $text);
	$text = str_replace("[/s:$uid]", '</span>', $text);

	// [spoil]Spoiler[/spoil] code..
	$text = str_replace("[spoil:$uid]", $bbcode_tpl['spoil_open'], $text);
	$text = str_replace("[/spoil:$uid]", $bbcode_tpl['spoil_close'], $text);

	// [archive]http://www.archive.org/embed/horror_express_ipod[/archive] code..
	$patterns[] = "#\[archive:$uid=\"(video|audio|video-small|video-medium|video-large|video-left|video-right|video-center|audio-left|audio-right|audio-center|video-small-left|video-small-right|video-small-center|video-medium-left|video-medium-right|video-medium-center|video-large-left|video-large-right|video-large-center)\"\]http://(?:www\.)?archive\.org/(?:embed|details)/([\w\#$%~/.\-;:=,?@+]*)[^[]*\[/archive:$uid\]#is";
	$replacements[] = $bbcode_tpl['archive'];
	 
	// [youtube]YouTube URL[/youtube] code.. (for support of old method)
	$patterns[] = "#\[youtube\](?:https?://)?(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%;\w]*(?:['\"][^<>]*>|</a>))[?=&+%;\w]*[^[]*\[/youtube\]#is";
	$replacements[] = $bbcode_tpl['youtube'];
	
	// [youtube]YouTube URL[/youtube] code.. (new method)
	$patterns[] = "#\[youtube:$uid=\"(video|video-small|video-medium|video-large|video-left|video-right|video-center|video-small-left|video-small-right|video-small-center|video-medium-left|video-medium-right|video-medium-center|video-large-left|video-large-right|video-large-center)\"\](?:https?://)?(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%;\w]*(?:['\"][^<>]*>|</a>))[?=&+%;\w]*[^[]*\[/youtube:$uid\]#is";
	$replacements[] = $bbcode_tpl['newtube'];

	// [xfirevideo]XFire URL[/xfirevideo] code..
	$patterns[] = "#\[xfirevideo\]http://(?:www\.)?xfire.com/video/([0-9A-Za-z-_]*)[^[]*\[/xfirevideo\]#is";
	$replacements[] = $bbcode_tpl['xfirevideo'];


/************************************************************************/
/* ================= STOP Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	$text = preg_replace($patterns, $replacements, $text);

	// Remove our padding from the string..
	$text = substr($text, 1);

	return $text;

} // bbencode_second_pass()

// Need to initialize the random numbers only ONCE
mt_srand( (double) microtime() * 1000000);

function make_bbcode_uid()
{
	// Unique ID for this message..

	$uid = dss_rand();
	$uid = substr($uid, 0, BBCODE_UID_LEN);

	return $uid;
}

function bbencode_first_pass($text, $uid)
{
	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');
	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\"]");

	// [list] and [list=x] for (un)ordered lists.
	$open_tag = array();
	$open_tag[0] = "[list]";

	// unordered..
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');

	$open_tag[0] = "[list=1]";
	$open_tag[1] = "[list=a]";

	// ordered.
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');

	// [color] and [/color] for setting text color
	$text = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "[color=\\1:$uid]\\2[/color:$uid]", $text);

	// [size] and [/size] for setting text size
	$text = preg_replace("#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si", "[size=\\1:$uid]\\2[/size:$uid]", $text);

	// [b] and [/b] for bolding text.
	$text = preg_replace("#\[b\](.*?)\[/b\]#si", "[b:$uid]\\1[/b:$uid]", $text);

	// [u] and [/u] for underlining text.
	$text = preg_replace("#\[u\](.*?)\[/u\]#si", "[u:$uid]\\1[/u:$uid]", $text);

	// [i] and [/i] for italicizing text.
	$text = preg_replace("#\[i\](.*?)\[/i\]#si", "[i:$uid]\\1[/i:$uid]", $text);

	// [img]image_url_here[/img] code..
	$text = preg_replace_callback(
		"#\[img\]((http|ftp|https|ftps)://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/img\]#si",
		function ($m) use ($uid) {
			return "[img:$uid]$m[1]" . str_replace(' ', '%20', $m[3]) . "[/img:$uid]";
		},
		$text
	);

/************************************************************************/
/* ================ START Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/
	// strip empty bbcodes
	$text = preg_replace("#\[(wiki|duck|tag|class|align|font|stream|archive|s|spoil|sub|sup|youtube|pre)(?:=((\\\\&quot;)?[_a-zA-Z0-9- ]*(\\\\&quot;)?))?\]\[/\\1\]#si", "", $text);

	// search tags
	$text = preg_replace("#\[tag\](.*?)\[/tag\]#si", "[tag:$uid]\\1[/tag:$uid]", $text);

	// Floating Images
	$text = preg_replace_callback(
		"#\[imgleft\]((http|ftp|https|ftps)://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/imgleft\]#si",
		function ($m) use ($uid) {
			return "[imgleft:$uid]$m[1]" . str_replace(' ', '%20', $m[3]) . "[/imgleft:$uid]";
		},
		$text
	);

	$text = preg_replace_callback(
		"#\[imgright\]((http|ftp|https|ftps)://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/imgright\]#si",
		function ($m) use ($uid) {
			return "[imgright:$uid]$m[1]" . str_replace(' ', '%20', $m[3]) . "[/imgright:$uid]";
		},
		$text
	);

	// DuckDuckGO
	$text = preg_replace("#\[duck\](.*?)\[/duck\]#si", "[duck:$uid]\\1[/duck:$uid]", $text);

	// Wikipedia
	$text = preg_replace("#\[wiki\](.*?)\[/wiki\]#si", "[wiki:$uid]\\1[/wiki:$uid]", $text);
	$text = preg_replace("#\[wiki=(en|de|fr|nl|it|pl|es|ru|ja|pt|sv|zh|uk|vi|ca|no|fi|cs|hu|ko|id|tr|ro|fa|ar|da|eo|sr|lt|sk|sl|ms|he|bg|kk|eu|vo|war|hr|hi|et|az|gl|nn|simple|th|la|el|new|tl|sh|ka|mk|ht|pms|te|ta|ceb|br|sq|lv|be|jv|mg|cy|lb|mr|is|bs|ya|an|bpy|hy|lmo|fy|sw|bn|ml|io|gu|af|pnb|ne|nds|scn|ku|ur|su|qu|diq|ba|ast|tt|ga|nap|ia)\](.*?)\[/wiki\]#si", "[wiki=\\1:$uid]\\2[/wiki:$uid]", $text);

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("#\[align=(left|right|center|justify)\](.*?)\[/align\]#si", "[align=\\1:$uid]\\2[/align:$uid]", $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("#\[font=(.*?)\](.*?)\[/font\]#si", "[font=\\1:$uid]\\2[/font:$uid]", $text);

	// [class="classname classname2"]text[/class] code..
	$text = bbencode_first_pass_pda($text, $uid, '/\[class=\\\\&quot;([_a-zA-Z0-9- ]*)\\\\&quot;\]/is', '[/class]', '', false, '', "[class:$uid=\\\"\\1\\\"]");

	// [pre=php] and [/pre] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '/\[pre=(php|html|python|profile|ruby|perl|scala|go|xml|django|css|javascript|vbscript|lua|delphi|java|cpp|objectivec|vala|cs|rsl|rib|mel|sql|smalltalk|lisp|ini|apache|nginx|diff|dos|bash|cmake|axapta|1c|avrasm|vhdl|parser3|tex|haskell|erlang|erlang_repl)\]/is', '[/pre]', '', false, 'replace_nestedbbcode', "[pre=\\1:$uid]");

	// [stream]Sound URL[/stream] code..
	$text = preg_replace("#\[stream\](.*?)\[/stream\]#si", "[stream:$uid]\\1[/stream:$uid]", $text);

	// [archive]http://www.archive.org/embed/horror_express_ipod[/archive] code..
	$text = preg_replace("#\[archive=\\\\&quot;([_a-zA-Z0-9-]*)\\\\&quot;\](.*?)\[/archive\]#si", "[archive:$uid=\\\"\\1\\\"]\\2[/archive:$uid]", $text);

	// [youtube="class-size"]YouTube URL[/youtube] code..(new method)
	$text = preg_replace("#\[youtube=\\\\&quot;([_a-zA-Z0-9-]*)\\\\&quot;\](.*?)\[/youtube\]#si", "[youtube:$uid=\\\"\\1\\\"]\\2[/youtube:$uid]", $text);

	// [flash width=X height=X]Flash URL[/flash] code..
	$text = preg_replace("#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/flash\]#si","[flash width=\\1 height=\\2:$uid\]\\3[/flash:$uid]", $text);

	// [video width=X height=X]Video URL[/video] code..
	$text = preg_replace("#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/video\]#si","[video width=\\1 height=\\2:$uid\]\\3[/video:$uid]", $text);

	// [hr]
	$text = preg_replace("#\[hr\]#si", "[hr:$uid]", $text);
		
	// [strike]Strikethrough[/strike] code..
	$text = preg_replace("#\[s\](.*?)\[/s\]#si", "[s:$uid]\\1[/s:$uid]", $text);

	// [spoil]Spoiler[/spoil] code..
	$text = preg_replace("#\[spoil\](.*?)\[/spoil\]#si", "[spoil:$uid]\\1[/spoil:$uid]", $text);

	// [sub]Subscript[/sub] code..
	$text = preg_replace("#\[sub\](.*?)\[/sub\]#si", "[sub:$uid]\\1[/sub:$uid]", $text);

	// [sup]Superscript[/sup] code..
	$text = preg_replace("#\[sup\](.*?)\[/sup\]#si", "[sup:$uid]\\1[/sup:$uid]", $text);
	
/************************************************************************/
/* ================= STOP Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	// Remove our padding from the string..
	return substr($text, 1);

} // bbencode_first_pass()

/**
 * $text - The text to operate on.
 * $uid - The UID to add to matching tags.
 * $open_tag - The opening tag to match. Can be an array of opening tags.
 * $close_tag - The closing tag to match.
 * $close_tag_new - The closing tag to replace with.
 * $mark_lowest_level - boolean - should we specially mark the tags that occur
 * 					at the lowest level of nesting? (useful for [code], because
 *						we need to match these tags first and transform HTML tags
 *						in their contents..
 * $func - This variable should contain a string that is the name of a function.
 *				That function will be called when a match is found, and passed 2
 *				parameters: ($text, $uid). The function should return a string.
 *				This is used when some transformation needs to be applied to the
 *				text INSIDE a pair of matching tags. If this variable is FALSE or the
 *				empty string, it will not be executed.
 * If open_tag is an array, then the pda will try to match pairs consisting of
 * any element of open_tag followed by close_tag. This allows us to match things
 * like [list=A]...[/list] and [list=1]...[/list] in one pass of the PDA.
 *
 * NOTES:	- this function assumes the first character of $text is a space.
 *				- every opening tag and closing tag must be of the [...] format.
 */
function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false)
{
	$open_tag_count = 0;

	if (!$close_tag_new || ($close_tag_new == ''))
	{
		$close_tag_new = $close_tag;
	}

	$close_tag_length = strlen($close_tag);
	$close_tag_new_length = strlen($close_tag_new);
	$uid_length = strlen($uid);

	$use_function_pointer = ($func && ($func != ''));

	$stack = array();

	if (is_array($open_tag))
	{
		if (0 == count($open_tag))
		{
			// No opening tags to match, so return.
			return $text;
		}
		$open_tag_count = count($open_tag);
	}
	else
	{
		// only one opening tag. make it into a 1-element array.
		$open_tag_temp = $open_tag;
		$open_tag = array();
		$open_tag[0] = $open_tag_temp;
		$open_tag_count = 1;
	}

	$open_is_regexp = false;

	if ($open_regexp_replace)
	{
		$open_is_regexp = true;
		if (!is_array($open_regexp_replace))
		{
			$open_regexp_temp = $open_regexp_replace;
			$open_regexp_replace = array();
			$open_regexp_replace[0] = $open_regexp_temp;
		}
	}

	if ($mark_lowest_level && $open_is_regexp)
	{
		message_die(GENERAL_ERROR, "Unsupported operation for bbcode_first_pass_pda().");
	}

	// Start at the 2nd char of the string, looking for opening tags.
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($text)))
	{
		$curr_pos = strpos($text, "[", $curr_pos);

		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending tag.
			$found_start = false;
			$which_start_tag = "";
			$start_tag_index = -1;

			for ($i = 0; $i < $open_tag_count; $i++)
			{
				// Grab everything until the first "]"...
				$possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);

				//
				// We're going to try and catch usernames with "[' characters.
				//
				if( preg_match('#\[quote=\\\&quot;#si', $possible_start, $match) && !preg_match('#\[quote=\\\&quot;(.*?)\\\&quot;\]#si', $possible_start) )
				{
					// OK we are in a quote tag that probably contains a ] bracket.
					// Grab a bit more of the string to hopefully get all of it..
					if ($close_pos = strpos($text, '&quot;]', $curr_pos + 14))
					{
						if (strpos(substr($text, $curr_pos + 14, $close_pos - ($curr_pos + 14)), '[quote') === false)
						{
							$possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 7);
						}
					}
				}

				// Now compare, either using regexp or not.
				if ($open_is_regexp)
				{
					$match_result = array();
					if (preg_match($open_tag[$i], $possible_start, $match_result))
					{
						$found_start = true;
						$which_start_tag = $match_result[0];
						$start_tag_index = $i;
						break;
					}
				}
				else
				{
					// straightforward string comparison.
					if (0 == strcasecmp($open_tag[$i], $possible_start))
					{
						$found_start = true;
						$which_start_tag = $open_tag[$i];
						$start_tag_index = $i;
						break;
					}
				}
			}

			if ($found_start)
			{
				// We have an opening tag.
				// Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
				$match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
				array_push($stack, $match);
				//
				// Rather than just increment $curr_pos
				// Set it to the ending of the tag we just found
				// Keeps error in nested tag from breaking out
				// of table structure..
				//
				$curr_pos += strlen($possible_start);
			}
			else
			{
				// check for a closing tag..
				$possible_end = substr($text, $curr_pos, $close_tag_length);
				if (0 == strcasecmp($close_tag, $possible_end))
				{
					// We have an ending tag.
					// Check if we've already found a matching starting tag.
					if (sizeof($stack) > 0)
					{
						// There exists a starting tag.
						$curr_nesting_depth = sizeof($stack);
						// We need to do 2 replacements now.
						$match = array_pop($stack);
						$start_index = $match['pos'];
						$start_tag = $match['tag'];
						$start_length = strlen($start_tag);
						$start_tag_index = $match['index'];

						if ($open_is_regexp)
						{
							$start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
						}

						// everything before the opening tag.
						$before_start_tag = substr($text, 0, $start_index);

						// everything after the opening tag, but before the closing tag.
						$between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

						// Run the given function on the text between the tags..
						if ($use_function_pointer)
						{
							$between_tags = $func($between_tags, $uid);
						}

						// everything after the closing tag.
						$after_end_tag = substr($text, $curr_pos + $close_tag_length);

						// Mark the lowest nesting level if needed.
						if ($mark_lowest_level && ($curr_nesting_depth == 1))
						{
							if ($open_tag[0] == '[code]')
							{
								$code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
								$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
								$between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
							}
							$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
							$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
						}
						else
						{
							if ($open_tag[0] == '[code]')
							{
								$text = $before_start_tag . '&#91;code&#93;';
								$text .= $between_tags . '&#91;/code&#93;';
							}
							else
							{
								if ($open_is_regexp)
								{
									$text = $before_start_tag . $start_tag;
								}
								else
								{
									$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
								}
								$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
							}
						}

						$text .= $after_end_tag;

						// Now.. we've screwed up the indices by changing the length of the string.
						// So, if there's anything in the stack, we want to resume searching just after it.
						// otherwise, we go back to the start.
						if (sizeof($stack) > 0)
						{
							$match = array_pop($stack);
							$curr_pos = $match['pos'];
//							bbcode_array_push($stack, $match);
//							++$curr_pos;
						}
						else
						{
							$curr_pos = 1;
						}
					}
					else
					{
						// No matching start tag found. Increment pos, keep going.
						++$curr_pos;
					}
				}
				else
				{
					// No starting tag or ending tag.. Increment pos, keep looping.,
					++$curr_pos;
				}
			}
		}
	} // while

	return $text;

} // bbencode_first_pass_pda()

/**
 * Does second-pass bbencoding of the [code] tags. This includes
 * running htmlspecialchars() over the text contained between
 * any pair of [code] tags that are at the first level of
 * nesting. Tags at the first level of nesting are indicated
 * by this format: [code:1:$uid] ... [/code:1:$uid]
 * Other tags are in this format: [code:$uid] ... [/code:$uid]
 */
function bbencode_second_pass_code($text, $uid, $bbcode_tpl)
{
	global $lang;

	$code_start_html = $bbcode_tpl['code_open'];
	$code_end_html =  $bbcode_tpl['code_close'];

	// First, do all the 1st-level matches. These need an htmlspecialchars() run,
	// so they have to be handled differently.
	$match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);

	for ($i = 0; $i < $match_count; $i++)
	{
		$before_replace = $matches[1][$i];
		$after_replace = $matches[1][$i];

		// Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
		$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
		// now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
		$after_replace = str_replace("  ", " &nbsp;", $after_replace);

		// Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
		$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

		// now Replace space occurring at the beginning of a line
		$after_replace = preg_replace("/^ {1}/m", '&nbsp;', $after_replace);

		$str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";

		$replacement = $code_start_html;
		$replacement .= $after_replace;
		$replacement .= $code_end_html;

		$text = str_replace($str_to_match, $replacement, $text);
	}

	// Now, do all the non-first-level matches. These are simple.
	$text = str_replace("[code:$uid]", $code_start_html, $text);
	$text = str_replace("[/code:$uid]", $code_end_html, $text);

	return $text;

} // bbencode_second_pass_code()

/**
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 * 	to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 * 	to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *		to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable($text)
{
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

/************************************************************************/
/* ================ START Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	# look for youtube urls and create video embeds from them (by ridgerunner)
	# https://stackoverflow.com/questions/5830387/how-do-i-find-all-youtube-video-ids-in-a-string-using-a-regex
	# ** modified for use in forums
	$ret = preg_replace('~
	# Match non-linked youtube URL in the wild. (Rev:20160125_1800)
	(^|[\n ])         # match space or newline at start**
	(?:https?://)?    # URL scheme. Either http or https.**
	(?:[0-9A-Z-]+\.)? # Optional subdomain.
	(?:               # Group host alternatives.
	  youtu\.be/      # Either youtu.be,
	| youtube\.com    # or youtube.com followed by
	(?:-nocookie)?    # youtube-nocookie.com
	\.com             # followed by
	  \S*?            # Allow anything up to VIDEO_ID,
	  [^\w\-\s]       # but char before ID is non-ID char.
	)                 # End host alternatives.
	([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
	(?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
	(?!               # Assert URL is not pre-linked.
	  [?=&+%;\w.-]*   # Allow URL (query) remainder.**
	  (?:             # Group pre-linked alternatives.
		[\'"][^<>]*>  # Either inside a start tag,
	  | </a>          # or inside <a> element text contents.
	  )               # End recognized pre-linked alts.
	)                 # End negative lookahead assertion.
	[?=&+%\w.-]*      # Consume any URL (query) remainder.**
	~ix', 
	'\\1<div class="forumvideo video"><iframe src="https://www.youtube.com/embed/\\2" style="border:0 none" allowfullscreen></iframe>
<div class="forumvideotagline"><a class="postlink youtu ficon" href="https://youtu.be/\\2" target="_blank">youtu.be/\\2</a></div></div>',
	$ret);

	# Regex Vimeo Parser
	# http://www.patricktalmadge.com/2011/12/17/regex-vimeo-parser/
	# ** modified for use in forums
	$ret = preg_replace('~
	# Match Vimeo link and embed code
	(^|[\n ])                  # match space or newline at start**
	(?:                        # Group vimeo url
	    https?:\/\/            # Either http or https
	    (?:[\w]+\.)*           # Optional subdomains
	    vimeo\.com             # Match vimeo.com
	    (?:[\/\w]*\/videos?)?  # Optional video sub directory this handles groups links also
	    \/                     # Slash before Id
	    ([0-9]+)               # $1: VIDEO_ID is numeric
	    [^\s]*                 # Not a space
	)                          # End group
	~ix',
	'\\1<div class="forumvideo video"><iframe src="https://player.vimeo.com/video/\\2?title=0&amp;byline=0&amp;portrait=0" style="border:0 none" allowfullscreen></iframe>
<div class="forumvideotagline"><a class="postlink vimeo ficon" href="https://vimeo.com/\\2" target="_blank">vimeo.com/\\2</a></div></div>',
	$ret);

/************************************************************************/
/* ================= STOP Advanced BBCode Box MOD ===================== */
/*************************version RN2.5.2********************************/

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
	// xxxx can only be alpha characters.
	// yyyy is anything up to the first space, newline, comma, double quote or <
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" class=\"postlink\" target=\"_blank\">\\2</a>", $ret);

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-"
	// zzzz is optional.. will contain everything up to the first space, newline,
	// comma, double quote or <.
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" class=\"postlink\" target=\"_blank\">\\2</a>", $ret);

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a class=\"postlink ficon femail\" href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}

/**
 * This is used to strip bbcode from with [pre=lang][/pre] tags
 * as they are not run through the same process as [code][/code]
 * tags.  Also needed to keep emoticons from appearing in code 
 * samples. Used within function bbencode_first_pass_pda().
 */
function replace_nestedbbcode($text, $uid)
{
	$stripuid = array(":1:$uid", ":u:$uid", ":o:$uid", ":$uid");
	$text = str_replace($stripuid, '', $text);
	$code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
	$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
	$text = preg_replace($code_entities_match, $code_entities_replace, $text);
	return $text;
}

/**
 * Nathan Codding - Feb 6, 2001
 * Reverses the effects of make_clickable(), for use in editpost.
 * - Does not distinguish between "www.xxxx.yyyy" and "http://aaaa.bbbb" type URLs.
 *
 */
function undo_make_clickable($text)
{
	$text = preg_replace("#<!-- BBCode auto-link start --><a href=\"(.*?)\" target=\"_blank\">.*?</a><!-- BBCode auto-link end -->#i", "\\1", $text);
	$text = preg_replace("#<!-- BBcode auto-mailto start --><a href=\"mailto:(.*?)\">.*?</a><!-- BBCode auto-mailto end -->#i", "\\1", $text);

	return $text;

}

/**
 * Nathan Codding - August 24, 2000.
 * Takes a string, and does the reverse of the PHP standard function
 * htmlspecialchars().
 */
function undo_htmlspecialchars($input)
{
	$input = preg_replace("/&gt;/i", ">", $input);
	$input = preg_replace("/&lt;/i", "<", $input);
	$input = preg_replace("/&quot;/i", "\"", $input);
	$input = preg_replace("/&amp;/i", "&", $input);

	return $input;
}

/**
 * This is used to change a [*] tag into a [*:$uid] tag as part
 * of the first-pass bbencoding of [list] tags. It fits the
 * standard required in order to be passed as a variable
 * function into bbencode_first_pass_pda().
 */
function replace_listitems($text, $uid)
{
	$text = str_replace("[*]", "[*:$uid]", $text);

	return $text;
}

/**
 * Escapes the "/" character with "\/". This is useful when you need
 * to stick a runtime string into a PREG regexp that is being delimited
 * with slashes.
 */
function escape_slashes($input)
{
	$output = str_replace('/', '\/', $input);
	return $output;
}

/**
 * This function does exactly what the PHP4 function array_push() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_push(&$stack, $value)
{
   $stack[] = $value;
   return(sizeof($stack));
}

/**
 * This function does exactly what the PHP4 function array_pop() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_pop(&$stack)
{
   $arrSize = count($stack);
   $x = 1;

   while(list($key, $val) = each($stack))
   {
      if($x < count($stack))
      {
	 		$tmpArr[] = $val;
      }
      else
      {
	 		$return_val = $val;
      }
      $x++;
   }
   $stack = $tmpArr;

   return($return_val);
}

//
// Smilies code ... would this be better tagged on to the end of bbcode.php?
// Probably so and I'll move it before B2
//
function smilies_pass($message)
{
	static $orig, $repl;

	if (!isset($orig))
	{
		global $db, $board_config;
		$orig = $repl = array();

		$sql = 'SELECT * FROM ' . SMILIES_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
		}
		$smilies = $db->sql_fetchrowset($result);

		if (count($smilies))
		{
			usort($smilies, 'smiley_sort');
		}

		for ($i = 0; $i < count($smilies); $i++)
		{
			$orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
			$repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
		}
	}

	if (count($orig))
	{
		$message = preg_replace($orig, $repl, ' ' . $message . ' ');
		$message = substr($message, 1, -1);
	}

	return $message;
}

function smiley_sort($a, $b)
{
	if ( strlen($a['code']) == strlen($b['code']) )
	{
		return 0;
	}

	return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

?>