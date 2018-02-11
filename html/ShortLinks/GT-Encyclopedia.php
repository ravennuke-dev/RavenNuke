<?php
/**
 * TegoNuke(tm) ShortLinks: Encyclopedia "Tap"
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
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;page=([0-9]*)&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=list_content&amp;eid=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=terms&amp;eid=([0-9]*)&amp;ltr=([A-Z]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search"',
'"(?<!/)modules.php\?name=Encyclopedia"'
);

$urlout = array(
'encyclopedia-\\1-page\\2-\\3.html',
'encyclopedia-\\1-page\\2.html',
'encyclopedia-\\1-\\2.html',
'encyclopedia-\\1.html',
'encyclopedia-list-\\1.html',
'encyclopedia-terms\\1-\\2.html',
'encyclopedia-search-\\1.html',
'encyclopedia-search.html',
'encyclopedia.html'
);

