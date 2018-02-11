<?php
/**
 * TegoNuke(tm) ShortLinks: Comments Module "Tap"
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
$urlin = array(
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;p=([0-9]*)#([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=comments&amp;sid=([0-9]*)&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Comments"'
);

$urlout = array(
'ftopicp-\\1.html#\\2',
'article-comment-\\1-\\2.html',
'article\\1.html',
'reviews-\\1.html',
'survey-comment-\\1-\\2.html',
'survey-results-\\1.html',
'userinfo-\\1.html',
'comments.html'
);

