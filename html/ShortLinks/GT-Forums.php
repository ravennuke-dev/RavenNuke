<?php
/**
 * TegoNuke(tm) ShortLinks: Forums "Tap"
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
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;start=([0-9]*)&amp;postdays=([0-9]*)&amp;postorder=(desc|asc)&amp;highlight=([A-Za-z0-9+_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;postdays=([0-9]*)&amp;postorder=(desc|asc)&amp;highlight=([A-Za-z0-9+_-]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;postdays=([0-9]*)&amp;postorder=(desc|asc)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;postdays=([0-9]*)&amp;postorder=(desc|asc)&amp;vote=viewresult"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;view=(previous|next|newest)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;(t|p)=([0-9]*)&amp;highlight=([A-Za-z0-9+_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)&amp;(watch|unwatch)=topic&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;(t|p)=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;(t|p)=([0-9]*)#([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=editprofile"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=register&amp;agreed=true&amp;coppa=true"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=register&amp;agreed=true"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=register"',
'"(?<!/)modules.php\?name=Forums&amp;file=modules&amp;name=Forums&amp;file=posting"',
'"(?<!/)modules.php\?name=Forums&amp;file=faq&amp;mode=bbcode"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=vote&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=newtopic&amp;f=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=reply&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=editpost&amp;p=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=delete&amp;p=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=quote&amp;p=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=smilies&amp;popup=1"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting&amp;mode=topicreview&amp;t=([0-9]*)&amp;popup=1"',
'"(?<!/)modules.php\?name=Forums&amp;file=posting((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=groupcp&amp;g=([0-9]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=groupcp&amp;g=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_id=([0-9]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_id=(unanswered|egosearch|newposts)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;mode=results"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_keywords=([a-zA-Z0-9_\-\+]*)&amp;mode=results"',
'"(?<!/)modules.php\?name=Forums&amp;file=index&amp;c=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=index&amp;mark=forums"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewonline"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)&amp;topicdays=([0-9]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)&amp;start=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)&amp;mark=topics"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=([^index][a-zA-Z0-9_-]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums(?!&)"',
'"(?<!/)modules.php\?name=Members_List&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=newpm&amp;popup=1"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"'
);

$urlout = array(
'ftopic-\\1-\\2-days\\3-order\\4-\\5.html',
'ftopic-\\1-days\\2-order\\3-\\4-\\5.html',
'ftopic-\\1-days\\2-order\\3-\\4.html',
'ftopic-voteresults-\\1-days\\2-order\\3.html',
'ftopic-\\1-\\2.html',
'ftopic-\\1-\\2.html',
'ftopic\\1-\\2-\\3.html',
'ftopic-\\1-\\2-\\3.html',
'ftopic\\1-\\2.html\\3',
'ftopic\\1-\\2.html#\\3\\4',
'forum-editprofile.html',
'forum-userprofile-\\1.html',
'forum-register-coppa.html',
'forum-register-new.html',
'forum-register.html',
'forums-posting.html',
'forum-faq-bbcode.html',
'ftopic-post-\\1.html',
'ftopic-vote-\\1.html',
'ftopic-new-\\1.html',
'ftopic-reply-\\1.html',
'ftopic-edit-\\1.html',
'ftopic-delete-\\1.html',
'ftopic-quote-\\1.html',
'ftopic-smilies.html',
'ftopic-topicreview-\\1.html',
'forum-posting.html\\1',
'forums-group\\1-\\2.html',
'forums-group\\1.html',
'fsearch-author-\\1.html',
'fsearch-\\1-\\2.html',
'fsearch-\\1.html',
'fsearch-results.html',
'hashtag-results-\\1.html',
'forum-c\\1.html',
'forum-mark.html',
'forum-viewonline.html',
'forum-\\1-days\\2-\\3.html',
'forum-\\1-\\2.html',
'forum-\\1-mark.html',
'forum-\\1.html\\2',
'forums-\\1.html\\2',
'forums.html\\1',
'forums.html',
'members.html\\1',
'messages-\\1.html\\2',
'messages-post-\\1.html',
'messages-popup.html',
'messages-post-\\1.html'
);

