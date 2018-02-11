<?php
/**
 * TegoNuke(tm) ShortLinks: RavenNuke(tm) MetAuthors module "Tap"
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
'"(?<!/)modules.php\?name=Web_Links&amp;file=index&amp;l_op=AddLink"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=write_review"',
'"(?<!/)modules.php\?name=Submit_News"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=rwsMetAuthors"'
);

$urlout = array(
'linkop-AddLink.html',
'reviews-new.html',
'submit.html',
'userinfo-\\1.html',
'article\\1.html',
'metauthors.html'
);

