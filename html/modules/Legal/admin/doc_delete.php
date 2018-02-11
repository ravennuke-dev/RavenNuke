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
$lgl_did = (isset($_GET['lgl_did'])) ? intval($_GET['lgl_did']) : '';
$lgl_inputLang = (isset($_GET['lgl_language'])) ? check_html($_GET['lgl_language'], 'nohtml') : '';

/*
 * Start off the page
 */
include_once 'header.php';
lgl_displayMenu();
OpenTable();

echo '<div class="text-center"><h3>'.$lgl_lang['LGL_ADM_COM_MODTITLE'].'</h3>'.PHP_EOL;
echo '<span class="thick">'.$lgl_lang['LGL_ADM_DOCS_DBDELCONFIRM'].'</span><br /><br />'.PHP_EOL;
echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=rn_lgl_doc_del_confirm&amp;lgl_did='.$lgl_did.'&amp;lgl_language='.$lgl_inputLang.'">'._YES.'</a>'.PHP_EOL;
echo '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$admin_file.'.php?op=legal">'._NO.'</a></div>'.PHP_EOL;

/*
 * Finish up the page
 */
CloseTable();
include_once 'footer.php';

?>