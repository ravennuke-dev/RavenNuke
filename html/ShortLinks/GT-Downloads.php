<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads ShortLinks "Tap"
 *
 * This is an extra "Tap" for ShortLinks 1.x sites.  Now bundling along
 * with the Download module itself so these documentation comments have
 * been updated to reflect that.
 *
 * NOTE: These "Taps" will NOT work 100% with the original NSN GD Downloads
 * module version 1.0.x and below due to necessary code changes required for
 * the Download search feature.  These will only work 100% with the module
 * as provided.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.2_40
 * @link        http://montegoscripts.com
 */
$urlin = array(
	'"(?<!/)modules.php\?name=Downloads&amp;op=modifydownloadrequest&amp;lid=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=brokendownload&amp;lid=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=NewDownloads&amp;newdownloadshowdays=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=NewDownloadsDate&amp;selectdate=([a-zA-Z0-9+]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=getit&amp;lid=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=(MostPopular)&amp;ratenum=([0-9]*)&amp;ratetype=(num|percent)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=(NewDownloads|MostPopular)"',
	'"(?<!/)modules.php\?name=Downloads&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z0-9+]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;min=([0-9]*)&amp;cid=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=search&amp;query=([/:\-{}()\,\._&amp;a-zA-Z0-9+=]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z0-9+]*)&amp;show=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=search&amp;query=([/:\-{}()\,\._&amp;a-zA-Z0-9+= ]*)&amp;orderby=([a-zA-Z0-9+]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;min=([0-9]*)&amp;op=search&amp;query=([/:\-{}()\,\._&amp;a-zA-Z0-9+= ]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=search"',
	'"(?<!/)modules.php\?name=Downloads&amp;op=gfx&amp;random_num=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads&amp;cid=([0-9]*)"',
	'"(?<!/)modules.php\?name=Downloads"',
	'"(?<!/)modules.php\?name=Submit_Downloads"'
);

$urlout = array(
	'download-mod-\\1.html',
	'download-broken-\\1.html',
	'download-shownew-\\1.html',
	'download-seldate-\\1.html',
	'download-file-\\1.html',
	'download-\\1-\\2-\\3.html',
	'downloads-\\1.html',
	'download-sort-\\1-orderby-\\2.html',
	'download-paging-\\1-\\2.html',
	'download-search-\\1-\\2-\\3-\\4.html',
	'download-search-\\1-\\2.html',
	'download-searchp-\\1-\\2.html',
	'download-search.html',
	'download-gfx-\\1.html',
	'downloads-cat\\1.html',
	'downloads.html',
	'submit-download.html'
);

