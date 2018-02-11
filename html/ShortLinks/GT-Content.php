<?php
/**
 * TegoNuke(tm) ShortLinks: Contact Plus module "Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * Developed by SpasticDonkey and provided by Slaytanic for RavenNuke(tm)
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @package     TegoNuke(tm)
 * @subpackage  ShortLinks
 * @category    SEO
 * @category    Usability
 * @author      SpasticDonkey
 * @author      Slaytanic (JEstrella)
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.3.1_398
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Content&amp;pa=print_page&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=print_pdf&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=share_page&amp;op=FriendSend&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=share_page&amp;op=SendPage&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)&amp;order=([0-9]*)&page=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)&amp;order=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=send_page"',
'"(?<!/)modules.php\?name=Content&amp;pa=preview_page"',
'"(?<!/)modules.php\?name=Content&amp;pa=add_page"',
'"(?<!/)modules.php\?name=Content&amp;pa=browse_tag&amp;tag=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;page=([0-9]*)&amp;order=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=browse_tag&amp;tag=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=browse_tag&amp;tag=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)&amp;order=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=browse_tag&amp;tag=([/:\-\'{}()\,\._&a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=browse_tags"',
'"(?<!/)modules.php\?name=Content"'
);

$urlout = array(
'content-print-page-\\1.html',
'content-print-pdf-\\1.html',
'content-share-page-\\1.html',
'content-send-page-\\1.html',
'content-\\1-page\\2.html',
'content-cat-\\1-order-\\2-page-\\3.html',
'content-cat-\\1-order-\\2.html',
'content-cat-\\1-page-\\2.html',
'content-cat-\\1.html',
'content-\\1.html',
'content-send-page.html',
'content-preview-page.html',
'content-add-page.html',
'content-browse-tag-\\1-page-\\2-order-\\3.html',
'content-browse-tag-\\1-page-\\2.html',
'content-browse-tag-\\1-order-\\2.html',
'content-browse-tag-\\1.html',
'content-browse-tags.html',
'content.html'
);

