<?php
/**
 * TegoNuke(tm) ShortLinks: GCalendar module "Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * NOTE: This script also supports the TegoNuke(tm)/NSN GR Downloads module.
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
'"(?<!/)modules.php\?name=GCalendar&amp;file=(viewday|viewweek)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)&amp;e=([0-9]*)&amp;printable=1"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=(submit|viewday|viewweek|friend)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)&amp;e=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=(viewday|viewweek)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)&amp;printable=1"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=(submit|viewday|viewweek)&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=edit&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)&amp;eventId=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=edit&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;d=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=submit&amp;y=([0-9]*)&amp;m=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;y=([0-9]*)&amp;m=([0-9]*)&amp;printable=1"',
'"(?<!/)modules.php\?name=GCalendar&amp;y=([0-9]*)&amp;m=([0-9]*)"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=submit&amp;op=submit"',
'"(?<!/)modules.php\?name=GCalendar&amp;file=(viewweek|rsvp|friend)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=GCalendar"'
);

$urlout = array(
'eventscalendar-\\1-\\2-\\3-\\4-event\\5-print.html',
'eventscalendar-\\1-\\2-\\3-\\4-event\\5.html',
'eventscalendar-\\1-\\2-\\3-\\4-print.html',
'eventscalendar-\\1-\\2-\\3-\\4.html',
'eventscalendar-edit-\\1-\\2-\\3-event\\4.html',
'eventscalendar-edit-\\1-\\2-\\3.html',
'eventscalendar-submit-\\1-\\2.html',
'eventscalendar-\\1-\\2-print.html',
'eventscalendar-\\1-\\2.html',
'eventscalendar-submit.html',
'eventscalendar-\\1.html',
'userinfo-\\1.html',
'eventscalendar.html'
);

