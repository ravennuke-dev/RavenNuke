<?php
/**
 * TegoNuke(tm) ShortLinks: Advertising "Tap"
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
'"(?<!/)modules.php\?name=Advertising&amp;op=(client_report|view_banner)&amp;cid=([0-9]*)&amp;bid=([0-9]*)"',
'"(?<!/)modules.php\?name=Advertising&amp;op=(sitestats|terms|plans|client_home|client_logout|client|logout)"',
'"(?<!/)modules.php\?name=Advertising"'
);

$urlout = array(
'advertising-\\1-\\2-\\3.html',
'advertising-\\1.html',
'advertising.html'
);

