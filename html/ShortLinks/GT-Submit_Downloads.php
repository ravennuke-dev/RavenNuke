<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads ShortLinks "Tap"
 *
 * This is an extra "Tap" for ShortLinks 1.x sites.  Now bundling along
 * with the Download module itself so these documentation comments have
 * been updated to reflect that.
 *
 * NOTE: These "Taps" will NOT work 100% with the original NSN GD Downloads
 * module version 1.0.x and below due to necessary code changes required for
 * the Download search feature.  These will only work 100% with the module
 * as provided.
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
 * @version     1.1.2_40
 * @link        http://montegoscripts.com
 */
$urlin = array(
	'"(?<!/)modules.php\?name=Submit_Downloads&amp;op=TermsUse"',
	'"(?<!/)modules.php\?name=Submit_Downloads"'
);

$urlout = array(
	'submit-download-terms.html',
	'submit-download.html'
);

