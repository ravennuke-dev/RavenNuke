<?php
/**
 * TegoNuke(tm) ShortLinks: Statistics "Tap"
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
'"(?<!/)modules.php\?name=Statistics&amp;op=DailyStats&amp;year=([0-9]*)&amp;month=([0-9]*)&amp;date=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=MonthlyStats&amp;year=([0-9]*)&amp;month=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=YearlyStats&amp;year=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=Stats"',
'"(?<!/)modules.php\?name=Statistics"'
);

$urlout = array(
'stats-\\1-\\2-\\3.html',
'stats-\\1-\\2.html',
'stats-\\1.html',
'advstats.html',
'stats.html'
);

