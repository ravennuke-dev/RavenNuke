<?php
/**
 * TegoNuke(tm) ShortLinks: nukeFEED(tm) Feed Creator module "Block Tap"
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
/*
 * NOTE: As you add additional content types you will need to add the respective line(s) within
 * the $urlin and $urlout arrays below as well as add the corresponding RewriteRule statements
 * within your .htaccess file (at the root of your nuke site).
 */

$urlin = array(
'"modules.php\?name=Feeds&amp;fid=([0-9]*)&amp;type=HTML"',
'"modules.php\?name=Feeds"'
);

$urlout = array(
'feeds-\\1.html',
'feeds.html'
);

