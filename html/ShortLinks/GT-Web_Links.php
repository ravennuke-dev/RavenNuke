<?php
/**
 * TegoNuke(tm) ShortLinks: Search "Tap"
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
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkcomments&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.+&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkcomments&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkeditorial&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkeditorial&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=modifylinkrequest&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=brokenlink&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=outsidelinksetup&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=(MostPopular|TopRated)&amp;ratenum=([0-9]+)&amp;ratetype=(num|percent)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=NewLinks&amp;newlinkshowdays=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=NewLinksDate&amp;selectdate=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=(AddLink|MostPopular|NewLinks|RandomLink|TopRated)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=ratelink&amp;lid=([0-9]*)&amp;ttitle=([/:\-\'\,(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=ratelink&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=visit&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z0-9]*)&amp;show=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z]*)&amp;show=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;orderby=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Web_Links"'
);

$urlout = array(
'viewlinkcomments-\\1-\\2.html',
'viewlinkcomments-\\1.html',
'viewlinkdetails-\\1-\\2.html',
'viewlinkdetails-\\1.html',
'vieweditorial-\\1-\\2.html',
'vieweditorial-\\1.html',
'modifylink-\\1.html',
'brokenlink-\\1.html',
'outsidelink-\\1.html',
'linkop-\\1-\\2-\\3.html',
'newlinks-\\1.html',
'linksnew-\\1.html',
'linkop-\\1.html',
'ratelink-\\1-\\2.html',
'ratelink-\\1.html',
'viewlink-\\1.html',
'links-\\1-\\2.html',
'links-\\1-\\2-\\3-\\4.html',
'link-\\1.html',
'links-search-\\1-\\2-orderby-\\3-\\4.html',
'links-search-\\1-orderby-\\2.html',
'links-search-\\1.html',
'links.html'
);

