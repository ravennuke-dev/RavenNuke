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

global $allowedentitynames;
/**
 * @var string[] $allowedentitynames Array of KSES allowed HTML entitity names.
 * @since 1.0.0
 */
$allowedentitynames = array(
	'nbsp',
	'iexcl',
	'cent',
	'pound',
	'curren',
	'yen',
	'brvbar',
	'sect',
	'uml',
	'copy',
	'ordf',
	'laquo',
	'not',
	'shy',
	'reg',
	'macr',
	'deg',
	'plusmn',
	'acute',
	'micro',
	'para',
	'middot',
	'cedil',
	'ordm',
	'raquo',
	'iquest',
	'Agrave',
	'Aacute',
	'Acirc',
	'Atilde',
	'Auml',
	'Aring',
	'AElig',
	'Ccedil',
	'Egrave',
	'Eacute',
	'Ecirc',
	'Euml',
	'Igrave',
	'Iacute',
	'Icirc',
	'Iuml',
	'ETH',
	'Ntilde',
	'Ograve',
	'Oacute',
	'Ocirc',
	'Otilde',
	'Ouml',
	'times',
	'Oslash',
	'Ugrave',
	'Uacute',
	'Ucirc',
	'Uuml',
	'Yacute',
	'THORN',
	'szlig',
	'agrave',
	'aacute',
	'acirc',
	'atilde',
	'auml',
	'aring',
	'aelig',
	'ccedil',
	'egrave',
	'eacute',
	'ecirc',
	'euml',
	'igrave',
	'iacute',
	'icirc',
	'iuml',
	'eth',
	'ntilde',
	'ograve',
	'oacute',
	'ocirc',
	'otilde',
	'ouml',
	'divide',
	'oslash',
	'ugrave',
	'uacute',
	'ucirc',
	'uuml',
	'yacute',
	'thorn',
	'yuml',
	'quot',
	'amp',
	'lt',
	'gt',
	'apos',
	'OElig',
	'oelig',
	'Scaron',
	'scaron',
	'Yuml',
	'circ',
	'tilde',
	'ensp',
	'emsp',
	'thinsp',
	'zwnj',
	'zwj',
	'lrm',
	'rlm',
	'ndash',
	'mdash',
	'lsquo',
	'rsquo',
	'sbquo',
	'ldquo',
	'rdquo',
	'bdquo',
	'dagger',
	'Dagger',
	'permil',
	'lsaquo',
	'rsaquo',
	'euro',
	'fnof',
	'Alpha',
	'Beta',
	'Gamma',
	'Delta',
	'Epsilon',
	'Zeta',
	'Eta',
	'Theta',
	'Iota',
	'Kappa',
	'Lambda',
	'Mu',
	'Nu',
	'Xi',
	'Omicron',
	'Pi',
	'Rho',
	'Sigma',
	'Tau',
	'Upsilon',
	'Phi',
	'Chi',
	'Psi',
	'Omega',
	'alpha',
	'beta',
	'gamma',
	'delta',
	'epsilon',
	'zeta',
	'eta',
	'theta',
	'iota',
	'kappa',
	'lambda',
	'mu',
	'nu',
	'xi',
	'omicron',
	'pi',
	'rho',
	'sigmaf',
	'sigma',
	'tau',
	'upsilon',
	'phi',
	'chi',
	'psi',
	'omega',
	'thetasym',
	'upsih',
	'piv',
	'bull',
	'hellip',
	'prime',
	'Prime',
	'oline',
	'frasl',
	'weierp',
	'image',
	'real',
	'trade',
	'alefsym',
	'larr',
	'uarr',
	'rarr',
	'darr',
	'harr',
	'crarr',
	'lArr',
	'uArr',
	'rArr',
	'dArr',
	'hArr',
	'forall',
	'part',
	'exist',
	'empty',
	'nabla',
	'isin',
	'notin',
	'ni',
	'prod',
	'sum',
	'minus',
	'lowast',
	'radic',
	'prop',
	'infin',
	'ang',
	'and',
	'or',
	'cap',
	'cup',
	'int',
	'sim',
	'cong',
	'asymp',
	'ne',
	'equiv',
	'le',
	'ge',
	'sub',
	'sup',
	'nsub',
	'sube',
	'supe',
	'oplus',
	'otimes',
	'perp',
	'sdot',
	'lceil',
	'rceil',
	'lfloor',
	'rfloor',
	'lang',
	'rang',
	'loz',
	'spades',
	'clubs',
	'hearts',
	'diams',
	'sup1',
	'sup2',
	'sup3',
	'frac14',
	'frac12',
	'frac34',
	'there4',
);


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

	$string = kses_no_null( $string, array( 'slash_zero' => 'keep' ) );
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


/*
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
*/


function kses_split( $string, $allowed_html, $allowed_protocols ) {
	global $pass_allowed_html, $pass_allowed_protocols;
	$pass_allowed_html      = $allowed_html;
	$pass_allowed_protocols = $allowed_protocols;
	return preg_replace_callback( '%(<!--.*?(-->|$))|(<[^>]*(>|$)|>)%', 'kses_split_callback', $string );
}

/**
 * Helper function listing HTML attributes containing a URL.
 *
 * This function returns a list of all HTML attributes that must contain
 * a URL according to the HTML specification.
 *
 * This list includes URI attributes both allowed and disallowed by KSES.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes
 *
 * @return array HTML attributes that must include a URL.
 */
function kses_uri_attributes() {
	$uri_attributes = array(
		'action',
		'archive',
		'background',
		'cite',
		'classid',
		'codebase',
		'data',
		'formaction',
		'href',
		'icon',
		'longdesc',
		'manifest',
		'poster',
		'profile',
		'src',
		'usemap',
		'xmlns',
	);

	return $uri_attributes;
}


/**
 * Callback for `kses_split()`.
 *
 * @access private
 * @ignore
 *
 * @global array $pass_allowed_html
 * @global array $pass_allowed_protocols
 *
 * @return string
 */
function kses_split_callback( $match ) {
	global $pass_allowed_html, $pass_allowed_protocols;
	return kses_split2( $match[0], $pass_allowed_html, $pass_allowed_protocols );
}
function kses_split2( $string, $allowed_html, $allowed_protocols ) {
	$string = kses_stripslashes( $string );

	// It matched a ">" character.
	if ( substr( $string, 0, 1 ) != '<' ) {
		return '&gt;';
	}

	// Allow HTML comments.
	if ( '<!--' == substr( $string, 0, 4 ) ) {
		$string = str_replace( array( '<!--', '-->' ), '', $string );
		while ( $string != ( $newstring = kses( $string, $allowed_html, $allowed_protocols ) ) ) {
			$string = $newstring;
		}
		if ( $string == '' ) {
			return '';
		}
		// prevent multiple dashes in comments
		$string = preg_replace( '/--+/', '-', $string );
		// prevent three dashes closing a comment
		$string = preg_replace( '/-$/', '', $string );
		return "<!--{$string}-->";
	}

	// It's seriously malformed.
	if ( ! preg_match( '%^<\s*(/\s*)?([a-zA-Z0-9-]+)([^>]*)>?$%', $string, $matches ) ) {
		return '';
	}

	$slash    = trim( $matches[1] );
	$elem     = $matches[2];
	$attrlist = $matches[3];

	if ( ! is_array( $allowed_html ) ) {
		$allowed_html = kses_allowed_html( $allowed_html );
	}

	// They are using a not allowed HTML element.
	if ( ! isset( $allowed_html[ strtolower( $elem ) ] ) ) {
		return '';
	}

	// No attributes are allowed for closing elements.
	if ( $slash != '' ) {
		return "</$elem>";
	}

	return kses_attr( $elem, $attrlist, $allowed_html, $allowed_protocols );
}

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
function kses_hair( $attr, $allowed_protocols ) {
	$attrarr  = array();
	$mode     = 0;
	$attrname = '';
	$uris     = kses_uri_attributes();

	// Loop through the whole attribute list

	while ( strlen( $attr ) != 0 ) {
		$working = 0; // Was the last operation successful?

		switch ( $mode ) {
			case 0:
				if ( preg_match( '/^([-a-zA-Z:]+)/', $attr, $match ) ) {
					$attrname = $match[1];
					$working  = $mode = 1;
					$attr     = preg_replace( '/^[-a-zA-Z:]+/', '', $attr );
				}

				break;

			case 1:
				if ( preg_match( '/^\s*=\s*/', $attr ) ) { // equals sign
					$working = 1;
					$mode    = 2;
					$attr    = preg_replace( '/^\s*=\s*/', '', $attr );
					break;
				}

				if ( preg_match( '/^\s+/', $attr ) ) { // valueless
					$working = 1;
					$mode    = 0;
					if ( false === array_key_exists( $attrname, $attrarr ) ) {
						$attrarr[ $attrname ] = array(
							'name'  => $attrname,
							'value' => '',
							'whole' => $attrname,
							'vless' => 'y',
						);
					}
					$attr = preg_replace( '/^\s+/', '', $attr );
				}

				break;

			case 2:
				if ( preg_match( '%^"([^"]*)"(\s+|/?$)%', $attr, $match ) ) {
					// "value"
					$thisval = $match[1];
					if ( in_array( strtolower( $attrname ), $uris ) ) {
						$thisval = kses_bad_protocol( $thisval, $allowed_protocols );
					}

					if ( false === array_key_exists( $attrname, $attrarr ) ) {
						$attrarr[ $attrname ] = array(
							'name'  => $attrname,
							'value' => $thisval,
							'whole' => "$attrname=\"$thisval\"",
							'vless' => 'n',
						);
					}
					$working = 1;
					$mode    = 0;
					$attr    = preg_replace( '/^"[^"]*"(\s+|$)/', '', $attr );
					break;
				}

				if ( preg_match( "%^'([^']*)'(\s+|/?$)%", $attr, $match ) ) {
					// 'value'
					$thisval = $match[1];
					if ( in_array( strtolower( $attrname ), $uris ) ) {
						$thisval = kses_bad_protocol( $thisval, $allowed_protocols );
					}

					if ( false === array_key_exists( $attrname, $attrarr ) ) {
						$attrarr[ $attrname ] = array(
							'name'  => $attrname,
							'value' => $thisval,
							'whole' => "$attrname='$thisval'",
							'vless' => 'n',
						);
					}
					$working = 1;
					$mode    = 0;
					$attr    = preg_replace( "/^'[^']*'(\s+|$)/", '', $attr );
					break;
				}

				if ( preg_match( "%^([^\s\"']+)(\s+|/?$)%", $attr, $match ) ) {
					// value
					$thisval = $match[1];
					if ( in_array( strtolower( $attrname ), $uris ) ) {
						$thisval = kses_bad_protocol( $thisval, $allowed_protocols );
					}

					if ( false === array_key_exists( $attrname, $attrarr ) ) {
						$attrarr[ $attrname ] = array(
							'name'  => $attrname,
							'value' => $thisval,
							'whole' => "$attrname=\"$thisval\"",
							'vless' => 'n',
						);
					}
					// We add quotes to conform to W3C's HTML spec.
					$working = 1;
					$mode    = 0;
					$attr    = preg_replace( "%^[^\s\"']+(\s+|$)%", '', $attr );
				}

				break;
		} // switch

		if ( $working == 0 ) { // not well formed, remove and try again
			$attr = kses_html_error( $attr );
			$mode = 0;
		}
	} // while

	if ( $mode == 1 && false === array_key_exists( $attrname, $attrarr ) ) {
		// special case, for when the attribute list ends with a valueless
		// attribute like "selected"
		$attrarr[ $attrname ] = array(
			'name'  => $attrname,
			'value' => '',
			'whole' => $attrname,
			'vless' => 'y',
		);
	}

	return $attrarr;
}

/**
 * Finds all attributes of an HTML element.
 *
 * Does not modify input.  May return "evil" output.
 *
 * Based on `kses_split2()` and `_kses_attr()`.
 *
 * @param string $element HTML element.
 * @return array|bool List of attributes found in the element. Returns false on failure.
 */
function kses_attr_parse( $element ) {
	$valid = preg_match( '%^(<\s*)(/\s*)?([a-zA-Z0-9]+\s*)([^>]*)(>?)$%', $element, $matches );
	if ( 1 !== $valid ) {
		return false;
	}

	$begin  = $matches[1];
	$slash  = $matches[2];
	$elname = $matches[3];
	$attr   = $matches[4];
	$end    = $matches[5];

	if ( '' !== $slash ) {
		// Closing elements do not get parsed.
		return false;
	}

	// Is there a closing XHTML slash at the end of the attributes?
	if ( 1 === preg_match( '%\s*/\s*$%', $attr, $matches ) ) {
		$xhtml_slash = $matches[0];
		$attr        = substr( $attr, 0, -strlen( $xhtml_slash ) );
	} else {
		$xhtml_slash = '';
	}

	// Split it
	$attrarr = kses_hair_parse( $attr );
	if ( false === $attrarr ) {
		return false;
	}

	// Make sure all input is returned by adding front and back matter.
	array_unshift( $attrarr, $begin . $slash . $elname );
	array_push( $attrarr, $xhtml_slash . $end );

	return $attrarr;
}

/**
 * Builds an attribute list from string containing attributes.
 *
 * Does not modify input.  May return "evil" output.
 * In case of unexpected input, returns false instead of stripping things.
 *
 * Based on `kses_hair()` but does not return a multi-dimensional array.
 *
 * @param string $attr Attribute list from HTML element to closing HTML element tag.
 * @return array|bool List of attributes found in $attr. Returns false on failure.
 */
function kses_hair_parse( $attr ) {
	if ( '' === $attr ) {
		return array();
	}

	// phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
	$regex =
	'(?:'
	.     '[-a-zA-Z:]+'   // Attribute name.
	. '|'
	.     '\[\[?[^\[\]]+\]\]?' // Shortcode in the name position implies unfiltered_html.
	. ')'
	. '(?:'               // Attribute value.
	.     '\s*=\s*'       // All values begin with '='
	.     '(?:'
	.         '"[^"]*"'   // Double-quoted
	.     '|'
	.         "'[^']*'"   // Single-quoted
	.     '|'
	.         '[^\s"\']+' // Non-quoted
	.         '(?:\s|$)'  // Must have a space
	.     ')'
	. '|'
	.     '(?:\s|$)'      // If attribute has no value, space is required.
	. ')'
	. '\s*';              // Trailing space is optional except as mentioned above.
	// phpcs:enable

	// Although it is possible to reduce this procedure to a single regexp,
	// we must run that regexp twice to get exactly the expected result.

	$validation = "%^($regex)+$%";
	$extraction = "%$regex%";

	if ( 1 === preg_match( $validation, $attr ) ) {
		preg_match_all( $extraction, $attr, $attrarr );
		return $attrarr[0];
	} else {
		return false;
	}
}


/**
 * Performs different checks for attribute values.
 *
 * The currently implemented checks are "maxlen", "minlen", "maxval", "minval",
 * and "valueless".
 *
 * @param string $value      Attribute value.
 * @param string $vless      Whether the attribute is valueless. Use 'y' or 'n'.
 * @param string $checkname  What $checkvalue is checking for.
 * @param mixed  $checkvalue What constraint the value should pass.
 * @return bool Whether check passes.
 */
function kses_check_attr_val( $value, $vless, $checkname, $checkvalue ) {
	$ok = true;

	switch ( strtolower( $checkname ) ) {
		case 'maxlen':
			// The maxlen check makes sure that the attribute value has a length not
			// greater than the given value. This can be used to avoid Buffer Overflows
			// in WWW clients and various Internet servers.

			if ( strlen( $value ) > $checkvalue ) {
				$ok = false;
			}
			break;

		case 'minlen':
			// The minlen check makes sure that the attribute value has a length not
			// smaller than the given value.

			if ( strlen( $value ) < $checkvalue ) {
				$ok = false;
			}
			break;

		case 'maxval':
			// The maxval check does two things: it checks that the attribute value is
			// an integer from 0 and up, without an excessive amount of zeroes or
			// whitespace (to avoid Buffer Overflows). It also checks that the attribute
			// value is not greater than the given value.
			// This check can be used to avoid Denial of Service attacks.

			if ( ! preg_match( '/^\s{0,6}[0-9]{1,6}\s{0,6}$/', $value ) ) {
				$ok = false;
			}
			if ( $value > $checkvalue ) {
				$ok = false;
			}
			break;

		case 'minval':
			// The minval check makes sure that the attribute value is a positive integer,
			// and that it is not smaller than the given value.

			if ( ! preg_match( '/^\s{0,6}[0-9]{1,6}\s{0,6}$/', $value ) ) {
				$ok = false;
			}
			if ( $value < $checkvalue ) {
				$ok = false;
			}
			break;

		case 'valueless':
			// The valueless check makes sure if the attribute has a value
			// (like `<a href="blah">`) or not (`<option selected>`). If the given value
			// is a "y" or a "Y", the attribute must not have a value.
			// If the given value is an "n" or an "N", the attribute must have a value.

			if ( strtolower( $checkvalue ) != $vless ) {
				$ok = false;
			}
			break;
	} // switch

	return $ok;
}

/**
 * Sanitizes a string and removed disallowed URL protocols.
 *
 * This function removes all non-allowed protocols from the beginning of the
 * string. It ignores whitespace and the case of the letters, and it does
 * understand HTML entities. It does its work recursively, so it won't be
 * fooled by a string like `javascript:javascript:alert(57)`.
 *
 * @param string   $string            Content to filter bad protocols from.
 * @param string[] $allowed_protocols Array of allowed URL protocols.
 * @return string Filtered content.
 */
function kses_bad_protocol( $string, $allowed_protocols ) {
	$string = kses_no_null( $string );
	$iterations = 0;

	do {
		$original_string = $string;
		$string = kses_bad_protocol_once( $string, $allowed_protocols );
	} while ( $original_string != $string && ++$iterations < 6 );

	if ( $original_string != $string ) {
		return '';
	}

	return $string;
}

/**
 * Removes any invalid control characters in a text string.
 *
 * Also removes any instance of the `\0` string.
 *
 * @param string $string  Content to filter null characters from.
 * @param array  $options Set 'slash_zero' => 'keep' when '\0' is allowed. Default is 'remove'.
 * @return string Filtered content.
 */
function kses_no_null( $string, $options = null ) {
	if ( ! isset( $options['slash_zero'] ) ) {
		$options = array( 'slash_zero' => 'remove' );
	}

	$string = preg_replace( '/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $string );
	if ( 'remove' == $options['slash_zero'] ) {
		$string = preg_replace( '/\\\\+0+/', '', $string );
	}

	return $string;
}

/**
 * Strips slashes from in front of quotes.
 *
 * This function changes the character sequence `\"` to just `"`. It leaves all other
 * slashes alone. The quoting from `preg_replace(//e)` requires this.
 *
 * @param string $string String to strip slashes from.
 * @return string Fixed string with quoted slashes.
 */
function kses_stripslashes( $string ) {
	return preg_replace( '%\\\\"%', '"', $string );
}

/**
 * Converts the keys of an array to lowercase.
 *
 * @since 1.0.0
 *
 * @param array $inarray Unfiltered array.
 * @return array Fixed array with all lowercase keys.
 */
function kses_array_lc( $inarray ) {
	$outarray = array();

	foreach ( (array) $inarray as $inkey => $inval ) {
		$outkey              = strtolower( $inkey );
		$outarray[ $outkey ] = array();

		foreach ( (array) $inval as $inkey2 => $inval2 ) {
			$outkey2                         = strtolower( $inkey2 );
			$outarray[ $outkey ][ $outkey2 ] = $inval2;
		}
	}

	return $outarray;
}


function kses_js_entities($string)
###############################################################################
# This function removes the HTML JavaScript entities found in early versions of
# Netscape 4.
###############################################################################
{
  return preg_replace('%&\s*\{[^}]*(\}\s*;?|$)%', '', $string);
} # function kses_js_entities

/**
 * Handles parsing errors in `kses_hair()`.
 *
 * The general plan is to remove everything to and including some whitespace,
 * but it deals with quotes and apostrophes as well.
 *
 * @param string $string
 * @return string
 */
function kses_html_error( $string ) {
	return preg_replace( '/^("[^"]*("|$)|\'[^\']*(\'|$)|\S)*\s*/', '', $string );
}

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
 * Callback for `kses_bad_protocol_once()` regular expression.
 *
 * This function processes URL protocols, checks to see if they're in the
 * whitelist or not, and returns different data depending on the answer.
 *
 * @access private
 * @ignore
 *
 * @param string   $string            URI scheme to check against the whitelist.
 * @param string[] $allowed_protocols Array of allowed URL protocols.
 * @return string Sanitized content.
 */
function kses_bad_protocol_once2( $string, $allowed_protocols ) {
	$string2 = kses_decode_entities( $string );
	$string2 = preg_replace( '/\s/', '', $string2 );
	$string2 = kses_no_null( $string2 );
	$string2 = strtolower( $string2 );

	$allowed = false;
	foreach ( (array) $allowed_protocols as $one_protocol ) {
		if ( strtolower( $one_protocol ) == $string2 ) {
			$allowed = true;
			break;
		}
	}

	if ( $allowed ) {
		return "$string2:";
	} else {
		return '';
	}
}

/**
 * Converts and fixes HTML entities.
 *
 * This function normalizes HTML entities. It will convert `AT&T` to the correct
 * `AT&amp;T`, `&#00058;` to `&#58;`, `&#XYZZY;` to `&amp;#XYZZY;` and so on.
 *
 * @param string $string Content to normalize entities.
 * @return string Content with normalized entities.
 */
function kses_normalize_entities( $string ) {
	// Disarm all entities by converting & to &amp;
	$string = str_replace( '&', '&amp;', $string );

	// Change back the allowed entities in our entity whitelist
	$string = preg_replace_callback( '/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'kses_named_entities', $string );
	$string = preg_replace_callback( '/&amp;#(0*[0-9]{1,7});/', 'kses_normalize_entities2', $string );
	$string = preg_replace_callback( '/&amp;#[Xx](0*[0-9A-Fa-f]{1,6});/', 'kses_normalize_entities3', $string );

	return $string;
}

/**
 * Callback for `kses_normalize_entities()` regular expression.
 *
 * This function only accepts valid named entity references, which are finite,
 * case-sensitive, and highly scrutinized by HTML and XML validators.
 *
 * @global array $allowedentitynames
 *
 * @param array $matches preg_replace_callback() matches array.
 * @return string Correctly encoded entity.
 */
function kses_named_entities( $matches ) {
	global $allowedentitynames;

	if ( empty( $matches[1] ) ) {
		return '';
	}

	$i = $matches[1];
	return ( ! in_array( $i, $allowedentitynames ) ) ? "&amp;$i;" : "&$i;";
}

/**
 * Callback for `kses_normalize_entities()` regular expression.
 *
 * This function helps `kses_normalize_entities()` to only accept 16-bit
 * values and nothing more for `&#number;` entities.
 *
 * @access private
 * @ignore
 *
 * @param array $matches `preg_replace_callback()` matches array.
 * @return string Correctly encoded entity.
 */
function kses_normalize_entities2( $matches ) {
	if ( empty( $matches[1] ) ) {
		return '';
	}

	$i = $matches[1];
	if ( valid_unicode( $i ) ) {
		$i = str_pad( ltrim( $i, '0' ), 3, '0', STR_PAD_LEFT );
		$i = "&#$i;";
	} else {
		$i = "&amp;#$i;";
	}

	return $i;
}

/**
 * Callback for `kses_normalize_entities()` for regular expression.
 *
 * This function helps `kses_normalize_entities()` to only accept valid Unicode
 * numeric entities in hex form.
 *
 * @access private
 * @ignore
 *
 * @param array $matches `preg_replace_callback()` matches array.
 * @return string Correctly encoded entity.
 */
function kses_normalize_entities3( $matches ) {
	if ( empty( $matches[1] ) ) {
		return '';
	}

	$hexchars = $matches[1];
	return ( ! valid_unicode( hexdec( $hexchars ) ) ) ? "&amp;#x$hexchars;" : '&#x' . ltrim( $hexchars, '0' ) . ';';
}

/**
 * Determines if a Unicode codepoint is valid.
 *
 * @param int $i Unicode codepoint.
 * @return bool Whether or not the codepoint is a valid Unicode codepoint.
 */
function valid_unicode( $i ) {
	return ( $i == 0x9 || $i == 0xa || $i == 0xd ||
			( $i >= 0x20 && $i <= 0xd7ff ) ||
			( $i >= 0xe000 && $i <= 0xfffd ) ||
			( $i >= 0x10000 && $i <= 0x10ffff ) );
}


/**
 * Converts all numeric HTML entities to their named counterparts.
 *
 * This function decodes numeric HTML entities (`&#65;` and `&#x41;`).
 * It doesn't do anything with named entities like `&auml;`, but we don't
 * need them in the URL protocol whitelisting system anyway.
 *
 * @since 1.0.0
 *
 * @param string $string Content to change entities.
 * @return string Content after decoded entities.
 */
function kses_decode_entities( $string ) {
	$string = preg_replace_callback( '/&#([0-9]+);/', 'kses_decode_entities_chr', $string );
	$string = preg_replace_callback( '/&#[Xx]([0-9A-Fa-f]+);/', 'kses_decode_entities_chr_hexdec', $string );

	return $string;
}

/**
 * Regex callback for `kses_decode_entities()`.
 *
 * @access private
 * @ignore
 *
 * @param array $match preg match
 * @return string
 */
function kses_decode_entities_chr( $match ) {
	return chr( $match[1] );
}

/**
 * Regex callback for `kses_decode_entities()`.
 *
 * @access private
 * @ignore
 *
 * @param array $match preg match
 * @return string
 */
function kses_decode_entities_chr_hexdec( $match ) {
	return chr( hexdec( $match[1] ) );
}

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