<?php
/**
 * TegoNuke(tm) ShortLinks: RavenNuke(tm) Stories Archive module "Tap"
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
//Bug fix by Brujo - http://www.ravenphpscripts.com/postx15073-0-0.html

$urlin = array(
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=print&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Stories_Archive&amp;sa=show_all&amp;min=([0-9]*)"',
'"(?<!/)modules.php\?name=Stories_Archive&amp;sa=show_all"',
'"(?<!/)modules.php\?name=Stories_Archive&amp;sa=show_month&amp;year=([0-9]*)&amp;month=([0-9]*)&amp;month_l=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Stories_Archive"'
);

$urlout = array(
'article-category-\\1.html',
'article-cat-\\1.html',
'article\\1.html',
'article-print-\\1.html',
'article-friend-\\1.html',
'archive-showall-\\1.html',
'archive-showall.html',
'archive-\\1-\\2-\\3.html',
'archive.html'
);

