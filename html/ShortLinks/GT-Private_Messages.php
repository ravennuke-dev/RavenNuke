<?php
/**
 * TegoNuke(tm) ShortLinks: Private Messages "Tap"
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
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=editprofile"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=([^index][a-zA-Z0-9_-]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums(?!&)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)&amp;mode=read&amp;p=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)&amp;start=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=(reply|quote|edit)&amp;p=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Members_List&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Journal&amp;file=edit"',
'"(?<!/)modules.php\?name=WebMail"'
);

$urlout = array(
'forum-editprofile.html',
'forum-userprofile-\\1.html',
'forums-\\1.html\\2',
'forums.html\\1',
'forums.html',
'messages-\\1.html\\2',
'messages-read-\\1-\\2.html\\3',
'messages-start-\\1-\\2.html\\3',
'messages-\\1-\\2.html\\3',
'messages-post-\\1.html',
'messages-new.html',
'messages-post-\\1.html',
'messages.html\\1',
'members.html\\1',
'account-\\1.html',
'account.html',
'journal-edit.html',
'webmail.html'
);

