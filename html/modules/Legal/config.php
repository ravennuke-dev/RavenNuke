<?php

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/************************************************************************/
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/************************************************************************/

if (!defined('LGL_LOADED')) die ('Access Denied');

$lgl_version = '1.1.0';
/*
 * Key defines used throughout the module
 */
if (!defined('LGL_MID_TYPE')) define('LGL_MID_TYPE', 2);
if (!defined('LGL_MID_DOC')) define('LGL_MID_DOC', 1);
if (defined('ADMIN_FILE')) {
	$lgl_url = $admin_file . '.php?op=';
} else {
	$lgl_url = 'modules.php?name=Legal';
}
/*
 * The styles used within this module are defined below.  At any time, these
 * could be turned into "class" definitions controlled by each theme.
 * Simply change the style="" to a class="" with the class name.
 */
global $bgcolor1, $bgcolor2;
define('LGL_STYLE_DOC', 'style="padding:4px;width:100%;"');
define('LGL_STYLE_TBL', 'style="border:1px solid ' . $bgcolor2 . ';padding:2px;width:100%;"');
define('LGL_STYLE_TBLHDR', 'style="font-weight:bold;background-color:' . $bgcolor2 . ';text-align:center;white-space:nowrap"');
define('LGL_STYLE_TBLROW', 'style="background-color:' . $bgcolor1 . ';vertical-align:top"');
define('LGL_STYLE_CELLHDR', 'style="font-weight:bold;background-color:' . $bgcolor2 . ';white-space:nowrap"');
/*
 * Load the appropriate language file based upon either the logged in user's cookie
 * or the site's primary language preference.
 */
global $currentlang, $language;
$lgl_langS = 'english';
if (file_exists($lgl_modPath . 'language/lang-' . $currentlang . '.php')) {
	include_once $lgl_modPath . 'language/lang-' . $currentlang . '.php';
	$lgl_langS = $currentlang;
} elseif (file_exists($lgl_modPath . 'language/lang-' . $language . '.php')) {
	include_once $lgl_modPath . 'language/lang-' . $language . '.php';
	$lgl_langS = $language;
} elseif (file_exists($lgl_modPath . 'language/lang-english.php')) { // Default module lang
	include_once $lgl_modPath . 'language/lang-english.php';
}
/*
 * Get module configuration values
 */
unset($lgl_cfg);
$lgl_cfg = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_legal_cfg'));
if (!is_array($lgl_cfg)) $lgl_cfg = array();
$lgl_cfg['lgl_doc_actions'] = array('add', 'add_apply', 'del', 'del_apply', 'edit', 'edit_apply', 'view', 'list');

?>