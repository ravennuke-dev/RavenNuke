<?php
/**
 * TegoNuke(tm) ShortLinks: Reviews "Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @package     TegoNuke(tm)
 * @subpackage  ShortLinks
 * @category    SEO
 * @category    Usability
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.3.1_398
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Reviews&amp;rop=write_review"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=preview_review"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=postcomment&amp;id=([0-9]*)&amp;title=([/:\-\'{}()\._&amp;a-zA-Z0-9+=\?\% ]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=postcomment&amp;id=([0-9]*)"', // Added for RavenNuke 2.20.00
'"(?<!/)modules.php\?name=Reviews&amp;rop=del_review&amp;id_del=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=mod_review&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=del_comment&amp;cid=([0-9]*)&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=([a-zA-Z0-9]*)&amp;field=([a-z]*)&amp;order=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Reviews"'
);

$urlout = array(
'reviews-new.html',
'reviews-preview.html',
'reviews-\\1-page\\2.html',
'reviews-\\1.html',
'reviews-comment-\\1-\\2.html',
'reviews-comment-\\1.html',
'reviews-\\1-delete.html',
'reviews-\\1-edit.html',
'reviews-\\1-delcomment-\\2.html',
'reviews-\\1-orderby-\\2-\\3.html',
'reviews-sortby-\\1.html',
'reviews.html'
);

