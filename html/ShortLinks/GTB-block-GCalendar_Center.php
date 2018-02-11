<?php
/**
 * TegoNuke(tm) ShortLinks: GCalendar Center "Block Tap"
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
'"(?<!/)modules.php\?name=GCalendar&amp;file=(viewday|viewweek)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)&amp;e=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=(submit|viewday|viewweek)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;y=([0-9]*)&amp;m=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar"'
);

$urlout = array(
'eventscalendar-\\1-\\2-\\3-\\4-event\\5.html',
'eventscalendar-\\1-\\2-\\3-\\4.html',
'eventscalendar-\\1-\\2.html',
'eventscalendar.html'
);

