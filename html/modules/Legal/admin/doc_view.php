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

$lgl_theme = get_theme();
/*
 * Cleanse the input data
 */
$lgl_did = (isset($_GET['lgl_did'])) ? intval($_GET['lgl_did']) : '';
$lgl_inputLang = (isset($_GET['lgl_language'])) ? check_html($_GET['lgl_language'], 'nohtml') : $language;
/*
 * This is just a slimmed down version of the site, so send the headers... similar to AvantGo module
 */
header('Content-Type: text/html');
include_once('themes/' . $lgl_theme . '/theme.php');
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n".' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html xmlns="http://www.w3.org/1999/xhtml">'."\n"
    .'<head>'."\n"
    .'<title>'."$sitename".' - ' . $lgl_lang['LGL_ADM_COM_MODTITLE'] . '</title>'."\n"
    . '<link rel="StyleSheet" href="themes/' . $lgl_theme . '/style/style.css" type="text/css" />'."\n\n"
    .'</head>'."\n"
    .'<body>'."\n\n";
OpenTable();
/*
 * Get the legal document to show
 */
include_once NUKE_CLASSES_DIR . 'class.legal_document.php';
$objDoc = new Legal_Document();
$objDoc->setNoStatus();
if (!$objDoc->dbGetDocument($lgl_did, $lgl_inputLang)) {
	echo $lgl_lang['LGL_ERRDB_DOCNOTFOUND'];
} else {
	echo '<p class="title" align="center">', $sitename, ' ', $objDoc->getDocTitle(), '</p>';
	echo $objDoc->html();
}

CloseTable();
echo '</body></html>';

?>