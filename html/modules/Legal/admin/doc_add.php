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
 * Get list of available languages
 */
$lgl_langList = lgl_getLangList();
/*
 * Set up the page content and main document list table
 */
echo '<div align="center"><p class="title">' , $lgl_lang['LGL_ADM_COM_ADDDOC']
	, '</p><form name="lgl_frm" method="post" action="' , $admin_file , '.php">'
	, '<input type="hidden" name="op" value="legal" />';
echo '<table ' , LGL_STYLE_TBL , ' cellpadding="2" cellspacing="4"><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_DOCNAME'] , ':</td>'
	, '<td align="left"><input type="text" name="lgl_doc_name" size="32" maxlength="32" value="" />'
	, '&nbsp;&nbsp;' , $lgl_lang['LGL_ADM_DOCS_ADDNAMEHINT'] , '</td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_STATUS'] , ':</td>'
	, '<td align="left"><input type="radio" name="lgl_doc_status" value="0" checked="checked" />'
	, $lgl_lang['LGL_ADM_DOCS_INACTIVE'] , '<input type="radio" name="lgl_doc_status" value="1" />'
	, $lgl_lang['LGL_ADM_DOCS_ACTIVE'] , '</td></tr><tr><td colspan="2"><hr noshade="noshade" /></td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_LANGS'] , ':</td><td align="left">'
	, lgl_getLangSelect($lgl_langList) , '</td></tr><tr>'
	, '<td ' , LGL_STYLE_CELLHDR , '>' , $lgl_lang['LGL_ADM_DOCS_DOCTITLE'] , ':</td>'
	, '<td align="left"><input type="text" name="lgl_doc_title" size="40" maxlength="100" value="" /></td>'
	, '</tr><tr><td colspan="2" ' , LGL_STYLE_CELLHDR , '><div align="center">'
	, $lgl_lang['LGL_ADM_DOCS_DOCBODY']
	, '</div></td></tr><tr><td colspan="2" align="center"><strong>' . $lgl_lang['LGL_ADM_COM_EDITEMBED']
	. '</strong></td></tr><tr><td colspan="2">';
wysiwyg_textarea('lgl_doc_text', '', 'PHPNukeAdmin', '120', '30');
echo '</td></tr></table><br />';
echo lgl_getButtonHTML('add_apply');
echo '</form></div>';
/*
 * Finish up the page
 */
CloseTable();
include_once 'footer.php';

?>