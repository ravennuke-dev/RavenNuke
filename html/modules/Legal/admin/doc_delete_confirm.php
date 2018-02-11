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
 * @version     1.0.0
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

/*
 * Start off the page
 */
include_once 'header.php';
lgl_displayMenu();
OpenTable();
/*
 * Cleanse the input data
 */
$lgl_did = (isset($_GET['lgl_did'])) ? intval($_GET['lgl_did']) : '';
$lgl_inputLang = (isset($_GET['lgl_language'])) ? check_html($_GET['lgl_language'], 'nohtml') : '';
/*
 * If no language was passed into the script, then we delete everything related to that document.
 * Otherwise, we only want to remove the one language set of translations.
 */
$lgl_errorMsg = '';
if (empty($lgl_inputLang)) {
	$sql = 'DELETE FROM `' . $prefix . '_legal_text` WHERE `tid` IN (SELECT `tid` FROM `' . $prefix . '_legal_text_map` WHERE `did` = \'' . $lgl_did . '\')';
	if (!$db->sql_query($sql)) $lgl_errorMsg .= $lgl_lang['LGL_ADM_ERR_DBDELETE'] . ' - _legal_text<br />';
	$sql = 'DELETE FROM `' . $prefix . '_legal_text_map` WHERE `did` = \'' . $lgl_did . '\'';
	if (!$db->sql_query($sql)) $lgl_errorMsg .= $lgl_lang['LGL_ADM_ERR_DBDELETE'] . ' - _legal_text_map<br />';
	$sql = 'DELETE FROM `' . $prefix . '_legal_docs` WHERE `did` = \'' . $lgl_did . '\'';
	if (!$db->sql_query($sql)) $lgl_errorMsg .= $lgl_lang['LGL_ADM_ERR_DBDELETE'] . ' - _legal_docs<br />';
} else {
	$sql = 'DELETE FROM `' . $prefix . '_legal_text` WHERE `tid` IN (SELECT `tid` FROM `' . $prefix . '_legal_text_map` WHERE `did` = \'' . $lgl_did . '\' AND `language` = \'' . addslashes($lgl_inputLang) . '\')';
	if (!$db->sql_query($sql)) $lgl_errorMsg .= $lgl_lang['LGL_ADM_ERR_DBDELETE'] . ' - _legal_text<br />';
	$sql = 'DELETE FROM `' . $prefix . '_legal_text_map` WHERE `did` = \'' . $lgl_did . '\' AND `language` = \'' . addslashes($lgl_inputLang) . '\'';
	if (!$db->sql_query($sql)) $lgl_errorMsg .= $lgl_lang['LGL_ADM_ERR_DBDELETE'] . ' - _legal_text_map<br />';
}
/*
 * Check to see if had errors to report
 */
if (!empty($lgl_errorMsg)) {
	lgl_goBack($lgl_errorMsg . '<br />' . $lgl_lang['LGL_ADM_ERR_DBDELETE'], 'legal');

} else {
	lgl_goBack($lgl_lang['LGL_ADM_DOCS_DBDELSUCCESS'], 'legal');
}
/*
 * Finish up the page
 */
CloseTable();
include_once 'footer.php';

?>