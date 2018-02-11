<?php
/**
 * TegoNuke(tm) ShortLinks: RavenNuke(tm) Legal module "Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * NOTE: This module was completely re-written strictly for the RavenNuke(tm) CMS
 * and was never released by montego to the general public.
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
'"(?<!/)modules.php\?name=Legal&amp;op=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=new_user"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Legal"'
);

$urlout = array(
'legal-\\1.html',
'account-new_user.html',
'account.html',
'legal.html'
);

