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

if (!defined('MODULE_FILE')) die ('You can\'t access this file directly...');

require_once 'mainfile.php';
define('LGL_LOADED', true);
global $admin_file, $admin;
/*
 * Get the module configuration information
 */
$lgl_modName = basename(dirname(__FILE__));
$lgl_modPath = 'modules/' . $lgl_modName . '/';
require_once $lgl_modPath . 'config.php';
/*
 * Cleanse the $op variable.  If $op not set, set it to empty (then its set).  If the user
 * elected to submit legal feedback then redirect to the Feedback module to handle.  All other
 * $op is to drive which page to display.
 */
if (!isset($op)) $op = '';
if ($op == 'lgl_contact') {
	header('Location: modules.php?name=Feedback&subject=' . $lgl_cfg['contact_subject']);
	die();
}
include_once NUKE_CLASSES_DIR . 'class.legal_doctypes.php';
include_once NUKE_CLASSES_DIR . 'class.legal_document.php';
$objDocTypes = new Legal_DocTypes($lgl_modName, $lgl_langS);
$op = $objDocTypes->validateDocType($op);
/*
 * Present the page to the end-user
 * First the Legal Menu
 */
include 'header.php';
OpenTable();
echo '<div align="center"><span class="title">' . $lgl_lang['LGL_COM_LEGALMENU'] . '</span><br /><br />';
$objDocTypes->setShowContact($lgl_lang['LGL_COM_CONTACTMENU']);
echo $objDocTypes->html();
echo '</div>';
CloseTable();
OpenTable();
/*
 * Get the document text for the right language from the DB.  If the document text is not found
 * return to the user with an error message.  However, first check to see if the default site
 * language is found and at least return that if the other language is not found.
 */
$objDoc = new Legal_Document();
$lgl_did = $objDocTypes->getDocID($op);
if (!$objDoc->dbGetDocument($lgl_did, $lgl_langS)) {
	if (!$objDoc->dbGetDocument($lgl_did, $language)) {
		if (!$objDoc->dbGetDocument($lgl_did, 'english')) {
			echo $lgl_lang['LGL_ERRDB_DOCNOTFOUND'];
			CloseTable();
			include 'footer.php';
			die();
		}
	}
}
/*
 * Display the Document
 */
echo '<p class="title" align="center">', $sitename, ' ', $objDoc->getDocTitle(), '</p>';
echo $objDoc->html();
CloseTable();
include('footer.php');

?>