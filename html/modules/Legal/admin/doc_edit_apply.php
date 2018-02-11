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
// Check Doc ID
if (isset($_POST['lgl_did'])) {
	$lgl_did = intval($_POST['lgl_did']);
} else {
	$lgl_hadError = true;
}
// Check Title TID
if (isset($_POST['lgl_tid_title'])) {
	$lgl_tidTitle = intval($_POST['lgl_tid_title']);
} else {
	$lgl_hadError = true;
}
// Check Text Body TID
if (isset($_POST['lgl_tid_text'])) {
	$lgl_tidText = intval($_POST['lgl_tid_text']);
} else {
	$lgl_hadError = true;
}
// Check Translation language
$lgl_langList = lgl_getLangList();
if (isset($_POST['lgl_language']) && in_array($_POST['lgl_language'], $lgl_langList)) {
	$lgl_inputLang = $_POST['lgl_language'];
} else {
	$lgl_hadError = true;
}
// Check Document Status
$lgl_inputDocStatus = (isset($_POST['lgl_doc_status']) && $_POST['lgl_doc_status'] == 1) ? 1 : 0;
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
// If had a validation error, raise an error message - which kills the script
if ($lgl_hadError) {
	lgl_raiseError($lgl_lang['LGL_ERR_FAILEDVALIDATION']);
}
/*
 * Check to see if this document really does exist.  If so, update the status if it has
 * changed.  If not, then must exit this script with an error.
 */
$sql = 'SELECT `doc_status` FROM `' . $prefix . '_legal_docs` WHERE `did` = \'' . $lgl_did . '\'';
if (!$result = $db->sql_query($sql)) lgl_raiseError($lgl_lang['LGL_ERRDB_DOCNOTFOUND']);
if ($db->sql_numrows($result) != 1) lgl_raiseError($lgl_lang['LGL_ERRDB_DOCNOTFOUND']);
$row = $db->sql_fetchrow($result);
if ($lgl_inputDocStatus != $row['doc_status']) {
	$sql = 'UPDATE `' . $prefix . '_legal_docs` SET `doc_status` = \'' . $lgl_inputDocStatus . '\' WHERE `did` = \'' . $lgl_did . '\'';
	if (!$db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ERRDB_DOCFAILEDSTATUS'], 'legal');
	}
}
/*
 * Check to see if this is a new translation for this document or whether just an update of an
 * existing translation.  If this is new, must insert the translation text and mapping, otherwise,
 * we just update the translation text.
 */
if ($lgl_tidText == 0) {
	/*
	 * Add the Document Text Translation Text and its Mapping
	 */
	$sql = 'INSERT INTO `' . $prefix . '_legal_text` (`tid`, `doc_text`) VALUES '
		. '(NULL, \'' . addslashes($lgl_inputBody) . '\')';
	if (!$result = $db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Insert of Body');
	}
	$lgl_tid = $db->sql_nextid($result);
	$sql = 'INSERT INTO `' . $prefix . '_legal_text_map` (`mid`, `did`, `tid`, `language`) VALUES '
		. '(\'' . LGL_MID_DOC . '\', \'' . $lgl_did . '\', \'' . $lgl_tid . '\', \'' . addslashes($lgl_inputLang) . '\')';
	if (!$result = $db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text_map for Insert of Body');
	}
} else {
	$sql = 'UPDATE `' . $prefix . '_legal_text` SET `doc_text` = \'' . addslashes($lgl_inputBody) . '\' WHERE `tid` = \'' . $lgl_tidText . '\'';
	if (!$db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Update of Body');
	}
}
/*
 * Might as well check the Title translation as well and either insert if new or update.
 */
if ($lgl_tidTitle == 0) {
	/*
	 * Add the Document Title Translation Text and its Mapping
	 */
	$sql = 'INSERT INTO `' . $prefix . '_legal_text` (`tid`, `doc_text`) VALUES '
		. '(NULL, \'' . addslashes($lgl_inputTitle) . '\')';
	if (!$result = $db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Insert of Title');
	}
	$lgl_tid = $db->sql_nextid($result); // Get the auto sequence ID that was assigned to this inserted row
	$sql = 'INSERT INTO `' . $prefix . '_legal_text_map` (`mid`, `did`, `tid`, `language`) VALUES '
		. '(\'' . LGL_MID_TYPE . '\', \'' . $lgl_did . '\', \'' . $lgl_tid . '\', \'' . addslashes($lgl_inputLang) . '\')';
	if (!$result = $db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text_map for Insert of Title');
	}
} else {
	$sql = 'UPDATE `' . $prefix . '_legal_text` SET `doc_text` = \'' . addslashes($lgl_inputTitle) . '\' WHERE `tid` = \'' . $lgl_tidTitle . '\'';
	if (!$db->sql_query($sql)) {
		lgl_raiseError($lgl_lang['LGL_ADM_ERR_DBSAVE'] . ' - Table _legal_text for Update of Body');
	}
}
/*
 * Finish up the page
 */
lgl_goBack($lgl_lang['LGL_ADM_DOCS_DBSUCCESS'], 'legal');
CloseTable();
include_once 'footer.php';

?>