<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads ShortLinks "Tap"
 *
 * This is an extra "Tap" for ShortLinks 1.x sites.  Now bundling along
 * with the Download module itself so these documentation comments have
 * been updated to reflect that.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
$urlin = array(
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"'
);

$urlout = array(
'userinfo-\\1.html'
);

