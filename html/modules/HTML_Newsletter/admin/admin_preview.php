<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('MSNL_LOADED')) die('Illegal File Access');
/************************************************************************
* Script Initialization
************************************************************************/
opentable();
msnl_fShowSubTitle(_MSNL_ADM_PREV_LAB_VALPREVNL);
/************************************************************************
* Check for user input errors
************************************************************************/
include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_check_post.php';
if (sizeof($msnl_asERR) == 0) { // Had no validation errors so make the NL and provide the link
	/*
	 * Make the temporary newsletter file
	 */
	include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_make_nls.php';
	$msnl_sTmpFile = './modules/' . $msnl_sModuleNm . '/archive/tmp.php';
	if (!@touch($msnl_sTmpFile)) {
		msnl_fRaiseAppError(_MSNL_COM_ERR_FILENOTWRITEABLE);
	}
	if (TNNL_PHP_NOT_CGI) @chmod($msnl_sTmpFile, 0766); // Added in case host is running PHP as a CGI
	$msnl_hFile1 = @fopen($msnl_sTmpFile, 'w');
	@fwrite($msnl_hFile1, $msnl_sNewsletter);
	@fclose($msnl_hFile1);
	/*
	 * Provide a link to the just created newsletter file
	 */
	$msnl_sURL = './modules.php?name=' . $msnl_sModuleNm . '&amp;op=msnl_nls_view&amp;msnl_nid=1';
	echo '<div id="msnl_div_preview">'
		. '<span class="thick">' . _MSNL_ADM_PREV_MSG_SUCCESS . '</span><br /><br />'
		. '<a href="' . $msnl_sURL . '" title="' . _MSNL_NLS_LNK_VIEWNL . '" '
		. 'onclick="window.open(this.href, \'ViewNewsletter\'); return false">'
		. _MSNL_ADM_PREV_LAB_PREVNL
		. '</a>'
		. '</div>';
} else {
	msnl_fShowValErr();
}
/************************************************************************
* Reset all the POST variables so do not lose what the user input was
* upon returning back to the Create Newsletter screen.
************************************************************************/
if (!isset($msnl_nsngroupid)) $msnl_nsngroupid = '';
$msnl_sGroups = msnl_fGrpsImplode($msnl_nsngroupid);
msnl_fDebugMsg('msnl_sGroups = ' . $msnl_sGroups);
/*
 * Write out the form and hidden variables, but make sure they are XHTML compliant
 */
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<div id="msnl_div_resetvars">';
echo '<input type="hidden" name="op" value="msnl_admin" />';
echo '<input type="hidden" name="msnl_banner" value="' . $_POST['msnl_banner'] . '" />';
echo '<input type="hidden" name="msnl_cid" value="' . $_POST['msnl_cid'] . '" />';
echo '<input type="hidden" name="msnl_downloads" value="' . $_POST['msnl_downloads'] . '" />';
echo '<input type="hidden" name="msnl_forums" value="' . $_POST['msnl_forums'] . '" />';
echo '<input type="hidden" name="msnl_news" value="' . $_POST['msnl_news'] . '" />';
echo '<input type="hidden" name="msnl_nsngroups" value="' . $msnl_sGroups . '" />';
echo '<input type="hidden" name="msnl_reviews" value="' . $_POST['msnl_reviews'] . '" />';
echo '<input type="hidden" name="msnl_sendemail" value="' . $_POST['msnl_sendemail'] . '" />';
echo '<input type="hidden" name="msnl_sender" value="' . msnl_fXMLEntities($_POST['msnl_sender']) . '" />';
echo '<input type="hidden" name="msnl_stats" value="' . $_POST['msnl_stats'] . '" />';
echo '<input type="hidden" name="msnl_template" value="' . $_POST['msnl_template'] . '" />';
echo '<input type="hidden" name="msnl_textbody" value="' . msnl_fXMLEntities($_POST['msnl_textbody']) . '" />';
echo '<input type="hidden" name="msnl_toc" value="' . $_POST['msnl_toc'] . '" />';
echo '<input type="hidden" name="msnl_topic" value="' . msnl_fXMLEntities($_POST['msnl_topic']) . '" />';
echo '<input type="hidden" name="msnl_emailaddresses" value="' . msnl_fXMLEntities($_POST['msnl_emailaddresses']) . '" />';
echo '<input type="hidden" name="msnl_weblinks" value="' . $_POST['msnl_weblinks'] . '" />';
echo '</div>';
/************************************************************************
* Display the GO BACK button that is really a submit button for the form
************************************************************************/
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<input type="submit" value="' . _MSNL_COM_LAB_GOBACK . '" />'
	. '</p>';
/************************************************************************
* Close up the page
************************************************************************/
echo '</form>';
closetable();

