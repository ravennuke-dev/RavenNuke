<?php
/**
 * TegoNuke(tm) ShortLinks: Your Account "Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * NOTE: Also compatible with RavenNuke(tm) Your Account module which may also be
 * compatible with CNBYA as it was derived originally from the CNBYA hack.
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
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=avatarsave&amp;category=([a-zA-Z0-9_-]*)&amp;avatar=([\.a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=ShowCookiesRedirect"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=DeleteCookies"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=ShowCookies"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;bypass=1&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"',
'"(?<!/)\?gfx=gfx&amp;random_num=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Journal&amp;file=search&amp;bywhat=([0-9]*)&amp;forwhat=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Journal&amp;file=edit"',
'"(?<!/)modules.php\?name=Members_List"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;thold=([0-9-]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;sid=([0-9]*)([0-9#]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)"',
'"(?<!/)modules.php\?name=Private_Messages(?!&)"',
'"(?<!/)modules.php\?name=Search&amp;type=users"',
'"(?<!/)modules.php\?name=WebMail"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;(t|p)=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=([0-9]+)"', // NOTE: requires code change to RN 2.4.x and below
'"(?<!/)modules.php\?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=([0-9]*)"', // PHP-Nuke Downloads, not NSNGD
'"(?<!/)modules.php\?name=Downloads&amp;op=getit&amp;lid=([0-9]*)"' // TegoNuke(tm)/NSN Downloads - Not PHP-Nuke
);

$urlout = array(
'userinfo-\\1.html',
'account-avatarsave-\\1-\\2.html',
'account-showcookiesredirect.html',
'account-deletecookies.html',
'account-showcookies.html',
'account-bypass-\\1.html',
'account-\\1.html',
'account-gfx-\\1.html',
'account.html',
'journal-search-\\1-\\2.html',
'journal-edit.html',
'members.html',
'article\\1.html',
'article-\\1-\\2-\\3-\\4.html\\5',
'messages-post-\\1.html',
'messages-\\1.html',
'messages.html',
'search-users.html',
'webmail.html',
'forum-\\1.html',
'ftopic\\1-\\2.html',
'viewlinkdetails-\\1.html',
'downloadviewdetails-\\1.html', // PHP-Nuke Downloads, not NSNGD
'download-file-\\1.html' // TegoNuke(tm)/NSN Downloads - Not PHP-Nuke
);

