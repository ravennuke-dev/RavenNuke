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
include_once $lgl_modPath . 'javascript.php';
lgl_displayMenu();
OpenTable();
/*
 * Cleanse the input data
 */
$lgl_did = (isset($_GET['lgl_did'])) ? intval($_GET['lgl_did']) : '';
$lgl_inputLang = (isset($_GET['lgl_language'])) ? check_html($_GET['lgl_language'], 'nohtml') : $language;
/**
 * If no language was passed into the script, then we edit the primary site language just as with the "Add".
 * Otherwise, pull up the text for the chosen language from the DB and if not there, just show empty form fields
 * but with the appropriate language display - do NOT let them change the language (not in this version anyway)!
 */
$lgl_errorMsg = '';
/*
 * Get list of available languages
 */
$lgl_langList = lgl_getLangList();
/*
 * Get the primary document information to show
 */
include_once NUKE_CLASSES_DIR . 'class.legal_document.php';
$objDoc = new Legal_Document();
$objDoc->setNoStatus();
if (!$objDoc->dbGetDocument($lgl_did, $lgl_inputLang)) {
	if (!in_array($lgl_inputLang, $lgl_langList)) lgl_raiseError($lgl_lang['LGL_ERRDB_DOCNOTFOUND']);
}
/*
 * Determine which status option should be "checked"
 */
if ($objDoc->getDocStatus() == 1) {
	$lgl_statusActive = ' checked="checked"';
	$lgl_statusInActive = '';
} else {
	$lgl_statusActive = '';
	$lgl_statusInActive = ' checked="checked"';
}
/*
 * The following has to be done in order to ensure XHTML compliance when the advanced editor is not being used:
 */
global $advanced_editor;
if (!isset($advanced_editor) || $advanced_editor == 0) {
	$lgl_bodyText = htmlentities($objDoc->getDocText(), ENT_QUOTES);
} else {
	$lgl_bodyText = $objDoc->getDocText();
}
/*
 * Display the edit form to the user
 */
echo '<div align="center"><p class="title">' , $lgl_lang['LGL_ADM_COM_EDITDOC']
	, '</p><form name="lgl_frm" method="post" action="' , $admin_file , '.php">'
	, '<input type="hidden" name="op" value="rn_lgl_edit_apply" />'
	, '<input type="hidden" name="lgl_did" value="' . $lgl_did . '" />'
	, '<input type="hidden" name="lgl_tid_text" value="' . $objDoc->getDocField('tid_text') . '" />'
	, '<input type="hidden" name="lgl_tid_title" value="' . $objDoc->getDocField('tid_title') . '" />'
	, '<input type="hidden" name="lgl_language" value="' . $lgl_inputLang . '" />';
echo '<table ' , LGL_STYLE_TBL , ' cellpadding="2" cellspacing="4"><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_DOCNAME'] , ':</td>'
	, '<td align="left">' , $objDoc->getDocName(), '</td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_STATUS'] , ':</td>'
	, '<td align="left"><input type="radio" name="lgl_doc_status" value="0"' , $lgl_statusInActive , ' />'
	, $lgl_lang['LGL_ADM_DOCS_INACTIVE'] , '<input type="radio" name="lgl_doc_status" value="1"' , $lgl_statusActive , ' />'
	, $lgl_lang['LGL_ADM_DOCS_ACTIVE'] , '</td></tr><tr><td colspan="2"><hr noshade="noshade" /></td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_LANG'] , ':</td><td align="left">'
	, ucfirst($objDoc->getDocLang()) , '</td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_DOCTITLE'] , ':</td>'
	, '<td align="left"><input type="text" name="lgl_doc_title" size="40" maxlength="100" value="' , $objDoc->getDocTitle(), '" /></td>'
	, '</tr><tr><td colspan="2" ' , LGL_STYLE_CELLHDR , '><div align="center">'
	, $lgl_lang['LGL_ADM_DOCS_DOCBODY']
	, '</div></td></tr><tr><td colspan="2" align="center"><strong>' , $lgl_lang['LGL_ADM_COM_EDITEMBED']
	, '</strong></td></tr><tr><td colspan="2">';
wysiwyg_textarea('lgl_doc_text', $lgl_bodyText, 'PHPNukeAdmin', '120', '30');
echo '</td></tr></table><br />';
echo lgl_getButtonHTML('edit_apply');
echo '</form></div>';
/*
 * Finish up the page
 */
CloseTable();
include_once 'footer.php';

?>