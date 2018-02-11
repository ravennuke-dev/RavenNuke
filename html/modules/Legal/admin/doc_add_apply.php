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
 * Start the page
 */
include_once 'header.php';
lgl_displayMenu();
OpenTable();
/*
 * Cleanse the input data - very basic as these are admins for pete's sake
 * Just raise a generic error, if found one, and present a history(-1) link.
 */
$lgl_hadError = false;
$lgl_errorMsg = '';
// Check Document Name
if (isset($_POST['lgl_doc_name'])) {
	$lgl_inputDocName = check_html($_POST['lgl_doc_name'], 'nohtml');
} else {
	$lgl_hadError = true;
}
// Check Document Status
$lgl_inputDocStatus = (isset($_POST['lgl_doc_status']) && $_POST['lgl_doc_status'] == 1) ? 1 : 0;
// Check Primary Translation language
$lgl_inputLang = (isset($_POST['lgl_language'])) ? check_html($_POST['lgl_language'], 'nohtml') : $language;
$lgl_langList = lgl_getLangList();
if (!in_array($lgl_inputLang, $lgl_langList)) $lgl_hadError = true;
// Check Translation Title
if (isset($_POST['lgl_doc_title']) && !empty($_POST['lgl_doc_title'])) {
	$lgl_inputTitle = check_html($_POST['lgl_doc_title'], 'nohtml');
} else {
	$lgl_hadError = true;
}
// Check Translation Body Text
if (isset($_POST['lgl_doc_text']) && !empty($_POST['lgl_doc_text'])) {
	$lgl_inputBody = check_html($_POST['lgl_doc_text'], 'nocheck');
} else {
	$lgl_hadError = true;
}
/*
 * Raise validation error if had one
 */
if ($lgl_hadError) {
	lgl_raiseError($lgl_lang['LGL_ERR_FAILEDVALIDATION']);
}
/*
 * Check to make sure this document doesn't already exist
 */
$sql = 'SELECT `did` FROM `' . $prefix . '_legal_docs` WHERE `doc_name` = \'' . addslashes($lgl_inputDocName) . '\'';
$numRows = $db->sql_numrows($db->sql_query($sql));
if ($numRows != 0) {
	lgl_raiseError($lgl_lang['LGL_ERRDB_DOCEXISTS']);
}
/*
 * Go ahead and add this new document
 */
$sql = 'INSERT INTO `' . $prefix . '_legal_docs` (`did`, `doc_name`, `doc_status`) VALUES '
	. '(NULL, \'' . addslashes($lgl_inputDocName) . '\', \'' . $lgl_inputDocStatus . '\')';
if (!$result = $db->sql_query($sql)) {
	lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_docs');
}
$lgl_did = $db->sql_nextid($result); // Get the auto sequence ID that was assigned to this inserted row
/*
 * Add the Document Title Translation Text and its Mapping
 */
$sql = 'INSERT INTO `' . $prefix . '_legal_text` (`tid`, `doc_text`) VALUES '
	. '(NULL, \'' . addslashes($lgl_inputTitle) . '\')';
if (!$result = $db->sql_query($sql)) {
	lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Title');
}
$lgl_tid = $db->sql_nextid($result); // Get the auto sequence ID that was assigned to this inserted row
$sql = 'INSERT INTO `' . $prefix . '_legal_text_map` (`mid`, `did`, `tid`, `language`) VALUES '
	. '(\'' . LGL_MID_TYPE . '\', \'' . $lgl_did . '\', \'' . $lgl_tid . '\', \'' . addslashes($lgl_inputLang) . '\')';
if (!$result = $db->sql_query($sql)) {
	lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text_map for Title');
}
/*
 * Add the Document Text Translation Text and its Mapping
 */
$sql = 'INSERT INTO `' . $prefix . '_legal_text` (`tid`, `doc_text`) VALUES '
	. '(NULL, \'' . addslashes($lgl_inputBody) . '\')';
if (!$result = $db->sql_query($sql)) {
	lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Body');
}
$lgl_tid = $db->sql_nextid($result);
$sql = 'INSERT INTO `' . $prefix . '_legal_text_map` (`mid`, `did`, `tid`, `language`) VALUES '
	. '(\'' . LGL_MID_DOC . '\', \'' . $lgl_did . '\', \'' . $lgl_tid . '\', \'' . addslashes($lgl_inputLang) . '\')';
if (!$result = $db->sql_query($sql)) {
	lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text_map for Body');
}
/*
 * Finish up the page
 */
lgl_goBack($lgl_lang['LGL_ADM_DOCS_DBSUCCESS'], 'legal');
CloseTable();
include_once 'footer.php';

?>