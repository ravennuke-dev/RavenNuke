<?php

# kses 0.2.2 - HTML/XHTML filter that only allows some elements and attributes
# Copyright (C) 2002, 2003, 2005  Ulf Harnhammar
#
# This program is free software and open source software; you can redistribute
# it and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation; either version 2 of the License,
# or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful, but WITHOUT
# ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
# FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
# more details.
#
# You should have received a copy of the GNU General Public License along
# with this program; if not, write to the Free Software Foundation, Inc.,
# 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  or visit
# http://www.gnu.org/licenses/gpl.html
#
# *** CONTACT INFORMATION ***
#
# E-mail:      metaur at users dot sourceforge dot net
# Web page:    http://sourceforge.net/projects/kses
# Paper mail:  Ulf Harnhammar
#              Ymergatan 17 C
#              753 25  Uppsala
#              SWEDEN
#
# [kses strips evil scripts!]
###############################################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
#########################################################################

/**
 * Filters content and keeps only allowable HTML elements.
 *
 * This function makes sure that only the allowed HTML element names, attribute
 * names and attribute values will occur in $string. You have to remove any slashes
 * from PHP's magic quotes before you call this function.
 *
 * The default allowed protocols are 'http', 'https', 'ftp', 'mailto', 'news',
 * 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'mms', 'rtsp' and 'svn'. This
 * covers all common link protocols, except for 'javascript' which should not
 * be allowed for untrusted users.
 *
 * @param string $string Content to filter through kses
 * @param array $allowed_html List of allowed HTML elements
 * @param array $allowed_protocols Optional. Allowed protocol in links.
 * @return string Filtered content with only allowed HTML elements
 */
function kses($string, $allowed_html, $allowed_protocols = array()) {
	if (empty($allowed_protocols))
		$allowed_protocols = array('http', 'https', 'ftp', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'mms', 'rtsp', 'svn');

	$string = kses_no_null($string);
	$string = kses_js_entities($string);
	$string = kses_normalize_entities($string);
	$string = kses_hook($string);
	$allowed_html_fixed = kses_array_lc($allowed_html);

	return kses_split($string, $allowed_html_fixed, $allowed_protocols);
}


function kses_hook($string)
###############################################################################
# You add any kses hooks here.
###############################################################################
{
  return $string;
} # function kses_hook


function kses_version()
###############################################################################
# This function returns kses' version number.
###############################################################################
{
  return '0.2.2';
} # function kses_version


function kses_split($string, $allowed_html, $allowed_protocols)
###############################################################################
# This function searches for HTML tags, no matter how malformed. It also
# matches stray ">" characters.
###############################################################################
{
  $callback = function ($matches) use ($allowed_html, $allowed_protocols){
    return kses_split2($matches[1], $allowed_html, $allowed_protocols);
  };
  return preg_replace_callback('%(<'.   # EITHER: <
         '[^>]*'. # things that aren't >
         '(>|$)'. # > or end of string
         '|>)%', # OR: just a >
         $callback,
         $string);
} # function kses_split

function kses_split2($string, $allowed_html, $allowed_protocols)
###############################################################################
# This function does a lot of work. It rejects some very malformed things
# like <:::>. It returns an empty string, if the element isn't allowed (look
# ma, no strip_tags()!). Otherwise it splits the tag into an element and an
# attribute list.
###############################################################################
{
  $string = kses_stripslashes($string);

  if (substr($string, 0, 1) != '<')
    return '&gt;';
    # It matched a ">" character

  if (!preg_match('%^<\s*(/\s*)?([a-zA-Z0-9]+)([^>]*)>?$%', $string, $matches))
    return '';
    # It's seriously malformed

  $slash = trim($matches[1]);
  $elem = $matches[2];
  $attrlist = $matches[3];

  if (!@isset($allowed_html[strtolower($elem)]))
    return '';
    # They are using a not allowed HTML element

  if ($slash != '')
    return "<$slash$elem>";
  # No attributes are allowed for closing elements

  return kses_attr("$slash$elem", $attrlist, $allowed_html,
                   $allowed_protocols);
} # function kses_split2

/**
 * Removes all attributes, if none are allowed for this element.
 *
 * If some are allowed it calls kses_hair() to split them further, and then
 * it builds up new HTML code from the data that kses_hair() returns. It also
 * removes "<" and ">" characters, if there are any left. One more thing it does
 * is to check if the tag has a closing XHTML slash, and if it does, it puts one
 * in the returned code as well.  This revised function was taken from Word Press.
 *
 * @param string $element HTML element/tag
 * @param string $attr HTML attributes from HTML element to closing HTML element tag
 * @param array $allowed_html Allowed HTML elements
 * @param array $allowed_protocols Allowed protocols to keep
 * @return string Sanitized HTML element
 */
function kses_attr($element, $attr, $allowed_html, $allowed_protocols) {
	// Is there a closing XHTML slash at the end of the attributes?

	$xhtml_slash = '';
	if (preg_match('%\s*/\s*$%', $attr))
		$xhtml_slash = ' /';

	// Are any attributes allowed at all for this element?
	if ( ! isset($allowed_html[strtolower($element)]) || count($allowed_html[strtolower($element)]) == 0 )
		return "<$element$xhtml_slash>";

	// Split it
	$attrarr = kses_hair($attr, $allowed_protocols);

	// Go through $attrarr, and save the allowed attributes for this element in $attr2
	$attr2 = '';

	$allowed_attr = $allowed_html[strtolower($element)];
	foreach ($attrarr as $arreach) {
		if ( ! isset( $allowed_attr[strtolower($arreach['name'])] ) )
			continue; // the attribute is not allowed

		$current = $allowed_attr[strtolower($arreach['name'])];
		if ( $current == '' )
			continue; // the attribute is not allowed

		if ( strtolower( $arreach['name'] ) == 'style' ) {
			$orig_value = $arreach['value'];
			$value = safecss_filter_attr( $orig_value );

			if ( empty( $value ) )
				continue;

			$arreach['value'] = $value;
			$arreach['whole'] = str_replace( $orig_value, $value, $arreach['whole'] );
		}

		if ( ! is_array($current) ) {
			$attr2 .= ' '.$arreach['whole'];
		// there are no checks

		} else {
			// there are some checks
			$ok = true;
			foreach ($current as $currkey => $currval) {
				if ( ! kses_check_attr_val($arreach['value'], $arreach['vless'], $currkey, $currval) ) {
					$ok = false;
					break;
				}
			}

			if ( $ok )
				$attr2 .= ' '.$arreach['whole']; // it passed them
		} // if !is_array($current)
	} // foreach

	// Remove any "<" or ">" characters
	$attr2 = preg_replace('/[<>]/', '', $attr2);

	return "<$element$attr2$xhtml_slash>";
}

/**
 * Builds an attribute list from string containing attributes.
 *
 * This function does a lot of work. It parses an attribute list into an array
 * with attribute data, and tries to do the right thing even if it gets weird
 * input. It will add quotes around attribute values that don't have any quotes
 * or apostrophes around them, to make it easier to produce HTML code that will
 * conform to W3C's HTML specification. It will also remove bad URL protocols
 * from attribute values. It also reduces duplicate attributes by using the
 * attribute defined first (foo='bar' foo='baz' will result in foo='bar').
 *
 * @param string $attr Attribute list from HTML element to closing HTML element tag
 * @param array $allowed_protocols Allowed protocols to keep
 * @return array List of attributes after parsing
 */
function kses_hair($attr, $allowed_protocols) {
	$attrarr = array();
	$mode = 0;
	$attrname = '';
	$uris = array('xmlns', 'profile', 'href', 'src', 'cite', 'classid', 'codebase', 'data', 'usemap', 'longdesc', 'action');

	// Loop through the whole attribute list
	while (strlen($attr) != 0) {
		$working = 0; // Was the last operation successful?

		switch ($mode) {
			case 0: // attribute name, href for instance
				if (preg_match('/^([-a-zA-Z]+)/', $attr, $match)) {
					$attrname = $match[1];
					$working = $mode = 1;
					$attr = preg_replace('/^[-a-zA-Z]+/', '', $attr);
				}
				break;

			case 1: // equals sign or valueless ("selected")
				if (preg_match('/^\s*=\s*/', $attr)) { // equals sign
					$working = 1;
					$mode = 2;
					$attr = preg_replace('/^\s*=\s*/', '', $attr);
					break;
				}

				if (preg_match('/^\s+/', $attr)) { // valueless
					$working = 1;
					$mode = 0;
					if(false === array_key_exists($attrname, $attrarr)) {
						$attrarr[$attrname] = array ('name' => $attrname, 'value' => '', 'whole' => $attrname, 'vless' => 'y');
					}
					$attr = preg_replace('/^\s+/', '', $attr);
				}
				break;

			case 2: // attribute value, a URL after href= for instance
					if (preg_match('%^"([^"]*)"(\s+|/?$)%', $attr, $match)) { // "value"
					$thisval = $match[1];
					if ( in_array(strtolower($attrname), $uris) )
						$thisval = kses_bad_protocol($thisval, $allowed_protocols);

					if(false === array_key_exists($attrname, $attrarr)) {
						$attrarr[$attrname] = array ('name' => $attrname, 'value' => $thisval, 'whole' => "$attrname=\"$thisval\"", 'vless' => 'n');
					}
					$working = 1;
					$mode = 0;
					$attr = preg_replace('/^"[^"]*"(\s+|$)/', '', $attr);
					break;
				}

					if (preg_match("%^'([^']*)'(\s+|/?$)%", $attr, $match)) { // 'value'
					$thisval = $match[1];
					if ( in_array(strtolower($attrname), $uris) )
						$thisval = kses_bad_protocol($thisval, $allowed_protocols);

					if(false === array_key_exists($attrname, $attrarr)) {
						$attrarr[$attrname] = array ('name' => $attrname, 'value' => $thisval, 'whole' => "$attrname='$thisval'", 'vless' => 'n');
					}
					$working = 1;
					$mode = 0;
					$attr = preg_replace("/^'[^']*'(\s+|$)/", '', $attr);
					break;
				}

					if (preg_match("%^([^\s\"']+)(\s+|/?$)%", $attr, $match)) { // value
					$thisval = $match[1];
					if ( in_array(strtolower($attrname), $uris) )
						$thisval = kses_bad_protocol($thisval, $allowed_protocols);

					if(false === array_key_exists($attrname, $attrarr)) {
						$attrarr[$attrname] = array ('name' => $attrname, 'value' => $thisval, 'whole' => "$attrname=\"$thisval\"", 'vless' => 'n');
					}
						// We add quotes to conform to W3C's HTML spec.
					$working = 1;
					$mode = 0;
					$attr = preg_replace("%^[^\s\"']+(\s+|$)%", '', $attr);
				}

				break;
		} // switch

		if ($working == 0) { // not well formed, remove and try again
			$attr = kses_html_error($attr);
			$mode = 0;
		}
	} // while

	if ($mode == 1 && false === array_key_exists($attrname, $attrarr)) {
		// special case, for when the attribute list ends with a valueless
		// attribute like "selected"
		$attrarr[$attrname] = array ('name' => $attrname, 'value' => '', 'whole' => $attrname, 'vless' => 'y');
	}

	return $attrarr;
}

function kses_check_attr_val($value, $vless, $checkname, $checkvalue)
###############################################################################
# This function performs different checks for attribute values. The currently
# implemented checks are "maxlen", "minlen", "maxval", "minval" and "valueless"
# with even more checks to come soon.
###############################################################################
{
  $ok = true;

  switch (strtolower($checkname))
  {
    case 'maxlen':
    # The maxlen check makes sure that the attribute value has a length not
    # greater than the given value. This can be used to avoid Buffer Overflows
    # in WWW clients and various Internet servers.

      if (strlen($value) > $checkvalue)
        $ok = false;
      break;

    case 'minlen':
    # The minlen check makes sure that the attribute value has a length not
    # smaller than the given value.

      if (strlen($value) < $checkvalue)
        $ok = false;
      break;

    case 'maxval':
    # The maxval check does two things: it checks that the attribute value is
    # an integer from 0 and up, without an excessive amount of zeroes or
    # whitespace (to avoid Buffer Overflows). It also checks that the attribute
    # value is not greater than the given value.
    # This check can be used to avoid Denial of Service attacks.

      if (!preg_match('/^\s{0,6}[0-9]{1,6}\s{0,6}$/', $value))
        $ok = false;
      if ($value > $checkvalue)
        $ok = false;
      break;

    case 'minval':
    # The minval check checks that the attribute value is a positive integer,
    # and that it is not smaller than the given value.

      if (!preg_match('/^\s{0,6}[0-9]{1,6}\s{0,6}$/', $value))
        $ok = false;
      if ($value < $checkvalue)
        $ok = false;
      break;

    case 'valueless':
    # The valueless check checks if the attribute has a value
    # (like <a href="blah">) or not (<option selected>). If the given value
    # is a "y" or a "Y", the attribute must not have a value.
    # If the given value is an "n" or an "N", the attribute must have one.

      if (strtolower($checkvalue) != $vless)
        $ok = false;
      break;
  } # switch

  return $ok;
} # function kses_check_attr_val

/**
 * Sanitize string from bad protocols.
 *
 * This function removes all non-allowed protocols from the beginning of
 * $string. It ignores whitespace and the case of the letters, and it does
 * understand HTML entities. It does its work in a while loop, so it won't be
 * fooled by a string like "javascript:javascript:alert(57)".
 *
 * @param string $string Content to filter bad protocols from
 * @param array $allowed_protocols Allowed protocols to keep
 * @return string Filtered content
 */
function kses_bad_protocol($string, $allowed_protocols) {
	$string = kses_no_null($string);
	$iterations = 0;

	do {
		$original_string = $string;
		$string = kses_bad_protocol_once($string, $allowed_protocols);
	} while ( $original_string != $string && ++$iterations < 6 );

	if ( $original_string != $string )
		return '';

	return $string;
}

function kses_no_null($string)
###############################################################################
# This function removes any NULL characters in $string.
###############################################################################
{
  $string = preg_replace('/\0+/', '', $string);
  $string = preg_replace('/(\\\\0)+/', '', $string);

  return $string;
} # function kses_no_null


function kses_stripslashes($string)
###############################################################################
# This function changes the character sequence  \"  to just  "
# It leaves all other slashes alone. It's really weird, but the quoting from
# preg_replace(//e) seems to require this.
###############################################################################
{
  return preg_replace('%\\\\"%', '"', $string);
} # function kses_stripslashes


function kses_array_lc($inarray)
###############################################################################
# This function goes through an array, and changes the keys to all lower case.
###############################################################################
{
  $outarray = array();

  foreach ($inarray as $inkey => $inval)
  {
    $outkey = strtolower($inkey);
    $outarray[$outkey] = array();
if (is_array($inval)) {
    foreach ($inval as $inkey2 => $inval2)
    {
      $outkey2 = strtolower($inkey2);
      $outarray[$outkey][$outkey2] = $inval2;
    } # foreach $inval
}
  } # foreach $inarray

  return $outarray;
} # function kses_array_lc


function kses_js_entities($string)
###############################################################################
# This function removes the HTML JavaScript entities found in early versions of
# Netscape 4.
###############################################################################
{
  return preg_replace('%&\s*\{[^}]*(\}\s*;?|$)%', '', $string);
} # function kses_js_entities


function kses_html_error($string)
###############################################################################
# This function deals with parsing errors in kses_hair(). The general plan is
# to remove everything to and including some whitespace, but it deals with
# quotes and apostrophes as well.
###############################################################################
{
  return preg_replace('/^("[^"]*("|$)|\'[^\']*(\'|$)|\S)*\s*/', '', $string);
} # function kses_html_error

/**
 * Sanitizes content from bad protocols and other characters.
 *
 * This function searches for URL protocols at the beginning of $string, while
 * handling whitespace and HTML entities.
 *
 * @param string $string Content to check for bad protocols
 * @param string $allowed_protocols Allowed protocols
 * @return string Sanitized content
 */
function kses_bad_protocol_once($string, $allowed_protocols, $count = 1 ) {
	$string2 = preg_split( '/:|&#0*58;|&#x0*3a;/i', $string, 2 );
	if ( isset($string2[1]) && ! preg_match('%/\?%', $string2[0]) ) {
		$string = trim( $string2[1] );
		$protocol = kses_bad_protocol_once2( $string2[0], $allowed_protocols );
		if ( 'feed:' == $protocol ) {
			if ( $count > 2 )
				return '';
			$string = kses_bad_protocol_once( $string, $allowed_protocols, ++$count );
			if ( empty( $string ) )
				return $string;
		}
		$string = $protocol . $string;
	}

	return $string;
}

/**
 * Callback for kses_bad_protocol_once() regular expression.
 *
 * This function processes URL protocols, checks to see if they're in the
 * whitelist or not, and returns different data depending on the answer.
 *
 * @param string $string URI scheme to check against the whitelist
 * @param string $allowed_protocols Allowed protocols
 * @return string Sanitized content
 */
function kses_bad_protocol_once2( $string, $allowed_protocols ) {
	$string2 = kses_decode_entities($string);
	$string2 = preg_replace('/\s/', '', $string2);
	$string2 = kses_no_null($string2);
	$string2 = strtolower($string2);

	$allowed = false;
	foreach ( (array) $allowed_protocols as $one_protocol )
		if ( strtolower($one_protocol) == $string2 ) {
			$allowed = true;
			break;
		}

	if ($allowed)
		return "$string2:";
	else
		return '';
}

function kses_normalize_entities($string)
###############################################################################
# This function normalizes HTML entities. It will convert "AT&T" to the correct
# "AT&amp;T", ":" to ":", "&#XYZZY;" to "&amp;#XYZZY;" and so on.
###############################################################################
{
# Disarm all entities by converting & to &amp;

  $string = str_replace('&', '&amp;', $string);

# Change back the allowed entities in our entity whitelist

  $string = preg_replace('/&amp;([A-Za-z][A-Za-z0-9]{0,19});/',
                         '&\\1;', $string);
  $callback = function (){
    return kses_normalize_entities2("\\1");
  };
  $string = preg_replace_callback('/&amp;#0*([0-9]{1,5});/', $callback, $string);
  $string = preg_replace('/&amp;#([Xx])0*(([0-9A-Fa-f]{2}){1,2});/',
                         '&#\\1\\2;', $string);
  return $string;
} # function kses_normalize_entities

function kses_normalize_entities2($i)
###############################################################################
# This function helps kses_normalize_entities() to only accept 16 bit values
# and nothing more for &#number; entities.
###############################################################################
{
  return (($i > 65535) ? "&amp;#$i;" : "&#$i;");
} # function kses_normalize_entities2


function kses_decode_entities($string)
###############################################################################
# This function decodes numeric HTML entities (&#65; and &#x41;). It doesn't
# do anything with other entities like &auml;, but we don't need them in the
# URL protocol whitelisting system anyway.
###############################################################################
{
  $string = preg_replace('/&#([0-9]+);/e', 'chr("\\1")', $string);
  $string = preg_replace('/&#[Xx]([0-9A-Fa-f]+);/e', 'chr(hexdec("\\1"))',
                         $string);

  return $string;
} # function kses_decode_entities

/**
 * Inline CSS filter
 */
function safecss_filter_attr($css) {
	$css = kses_no_null($css);
	$css = str_replace(array("\n","\r","\t"), '', $css);

	if ( preg_match( '%[\\(&=}]|/\*%', $css ) ) // remove any inline css containing \ ( & } = or comments
		return '';

	$css_array = explode( ';', trim( $css ) );
	$allowed_attr = array( 'text-align', 'margin', 'color', 'float',
	'border', 'background', 'background-color', 'border-bottom', 'border-bottom-color',
	'border-bottom-style', 'border-bottom-width', 'border-collapse', 'border-color', 'border-left',
	'border-left-color', 'border-left-style', 'border-left-width', 'border-right', 'border-right-color',
	'border-right-style', 'border-right-width', 'border-spacing', 'border-style', 'border-top',
	'border-top-color', 'border-top-style', 'border-top-width', 'border-width', 'caption-side',
	'clear', 'cursor', 'direction', 'font', 'font-family', 'font-size', 'font-style',
	'font-variant', 'font-weight', 'height', 'letter-spacing', 'line-height', 'margin-bottom',
	'margin-left', 'margin-right', 'margin-top', 'overflow', 'padding', 'padding-bottom',
	'padding-left', 'padding-right', 'padding-top', 'text-decoration', 'text-indent', 'vertical-align',
	'width');

	if ( empty($allowed_attr) )
		return $css;

	$css = '';
	foreach ( $css_array as $css_item ) {
		if ( $css_item == '' )
			continue;
		$css_item = trim( $css_item );
		$found = false;
		if ( strpos( $css_item, ':' ) === false ) {
			$found = true;
		} else {
			$parts = explode( ':', $css_item );
			if ( in_array( trim( $parts[0] ), $allowed_attr ) )
				$found = true;
		}
		if ( $found ) {
			if( $css != '' )
				$css .= ';';
			$css .= $css_item;
		}
	}

	return $css;
}

?>