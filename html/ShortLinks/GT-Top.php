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
 * @version     1.1.1_31
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=Sections&amp;op=viewarticle&amp;artid=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=([a-zA-Z0-9_-]*)&amp;author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Downloads&amp;op=getit&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Top&amp;zx=([a-zA-Z0-9+]*)"',
'"(?<!/)modules.php\?name=Topics"', // Must be here in order to not mess up module links for Topics when in the Top module
'"(?<!/)modules.php\?name=Top"'
);

$urlout = array(
'article\\1.html',
'article-category-\\1.html',
'sections-viewarticle-\\1.html',
'userinfo-\\1.html',
'survey-\\1.html',
'search-\\1-\\2.html',
'reviews-\\1.html',
'download-file-\\1.html',
'content-\\1.html',
'top-\\1.html',
'topics.html',  // Must be here in order to not mess up module links for Topics when in the Top module
'top.html'
);

