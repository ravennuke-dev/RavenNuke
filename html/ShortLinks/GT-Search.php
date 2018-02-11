<?php
/**
 * TegoNuke(tm) ShortLinks: RavenNuke(tm) Search module "Tap"
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
'"(?<!/)modules.php\?name=Search&amp;author=([a-zA-Z0-9]*)&amp;topic=([0-9]*)&amp;min=([0-9]*)&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;type=([a-zA-Z]*)&amp;category=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;author=([a-zA-Z0-9]*)&amp;topic=([0-9]*)&amp;min=([0-9]*)&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;type=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;author=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=&amp;topic=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;type=users"',
'"(?<!/)modules.php\?name=Search&amp;type=comments&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Search"',
'"(?<!/)modules.php\?name=Downloads&amp;d_op=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"', // For PHP-Nuke ONLY, not TegoNuke(tm)/NSN Downloads
'"(?<!/)modules.php\?name=Downloads&amp;op=search&amp;query=([a-zA-Z0-9\-_\,]*)"', // For TegoNuke(tm)/NSN Downloads ONLY, not PHP-Nuke
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;op=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;op=mod_review&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews.php&amp;op=del_review&amp;id_del=([0-9]*)"'
);

$urlout = array(
'search-\\1-\\2-\\3-\\4-\\5-\\6.html',
'search-\\1-\\2-\\3-\\4-\\5.html',
'search-\\1-\\2.html',
'search-\\1.html',
'search-users.html',
'search-comments-\\1.html',
'search.html',
'download-search-\\1.html', // For PHP-Nuke ONLY, not TegoNuke(tm)/NSN Downloads
'download-search-\\1-titleA.html', // For TegoNuke(tm)/NSN Downloads ONLY, not PHP-Nuke
'encyclopedia-search-\\1.html',
'links-search-\\1.html',
'article\\1.html',
'userinfo-\\1.html',
'reviews-\\1.html',
'reviews-\\1-edit.html',
'reviews-\\1-delete.html'
);

