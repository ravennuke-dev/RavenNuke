<?php
/**
 * TegoNuke(tm) ShortLinks: Collapsing Forums Center Block "Block Tap"
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
 * @author      Block itself: Raven from http://www.ravenphpscripts.com
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.3.1_398
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/

$urlin = array(
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;p=([0-9]*)#([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"'
);

$urlout = array(
'ftopicp-\\1.html#\\2',
'fsearch-author-\\1.html',
'forum-\\1.html',
'ftopict-\\1.html',
'forum-userprofile-\\1.html'
);

