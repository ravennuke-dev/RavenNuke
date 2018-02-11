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
 * Cleanse the input data
 */
$lgl_did = (isset($_GET['lgl_did'])) ? intval($_GET['lgl_did']) : '';
/*
 * This is just a slimmed down version of the site, so send the headers... similar to AvantGo module
 */
include_once 'header.php';
lgl_displayMenu();
OpenTable();
/*
 * Determine what the current status is on the document so can "toggle" it
 */
$sql = 'SELECT `doc_status` FROM `' . $prefix . '_legal_docs` WHERE `did` = \'' . $lgl_did . '\'';
list($lgl_docStatus) = $db->sql_fetchrow($db->sql_query($sql));
$lgl_docStatus = intval($lgl_docStatus);
/*
 * "Toggle" the value
 */
if ($lgl_docStatus > 0) {
	$lgl_docStatus = 0;
} else {
	$lgl_docStatus = 1;
}
/*
 * Write the new status back out to the database
 */
$sql = 'UPDATE `' . $prefix . '_legal_docs` SET `doc_status` = \'' . $lgl_docStatus . '\' WHERE `did` = \'' . $lgl_did . '\'';
if (!$db->sql_query($sql)) {
	lgl_goBack($lgl_lang['LGL_ERRDB_DOCFAILEDSTATUS'], 'legal');
} else {
	lgl_goBack($lgl_lang['LGL_ADM_DOCS_STATUSSUCCESS'], 'legal');
}
CloseTable();
include_once 'footer.php';

?>