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
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;pid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;tid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=Reply&amp;pid=([0-9]*)&amp;pollID=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=Reply&amp;pid=([0-9]*)&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;pollID=([0-9]*)&amp;pid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;pollID=([0-9]*)&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments"',
'"(?<!/)modules.php\?name=Surveys"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"'
);

$urlout = array(
'survey-results-\\1.html',
'survey-results-\\1.html',
'survey-\\1.html',
'survey-comments-\\1-\\2.html',
'survey-comments-\\1-\\2.html',
'survey-comment-\\1-\\2.html',
'survey-comment-\\1-\\2.html',
'survey-commreply-\\1-\\2.html',
'survey-commreply-\\1-\\2.html',
'survey-showreply-\\1-\\2-\\3.html',
'survey-showreply-\\1-\\2-\\3.html',
'survey-showreply-\\1.html',
'survey-showreply-\\1.html',
'survey-comments.html',
'surveys.html',
'messages-post-\\1.html',
'userinfo-\\1.html',
'account-\\1.html'
);

