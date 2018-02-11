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
define('MSNL_SENDTESTED', true);
/************************************************************************
* Are we processing the SendMail or are we getting the admin's options?
************************************************************************/
if (isset($_POST['msnl_sendemail']) && $_POST['msnl_sendemail'] != '') { // We are sending the testemail out
	include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_send_mail.php';
} else { // We are displaying the options to the user for sending the tested email out
	opentable();
	msnl_fShowSubTitle(_MSNL_LAB_SENDTESTED);
	msnl_fShowHelpLegend();
	/************************************************************************
	* Provide a link to the Admin to the Tested Newsletter in case they
	* wish to verify what they will be sending.
	************************************************************************/
	$msnl_sURL = './modules.php?name=' . $msnl_sModuleNm . '&amp;op=msnl_nls_view&amp;msnl_nid=2';
	echo '<div id="msnl_div_preview">'
		. '<a href="' . $msnl_sURL . '" title="' . _MSNL_NLS_LNK_VIEWNL . '" '
		. 'onclick="window.open(this.href, \'ViewNewsletter\'); return false">'
		. _MSNL_ADM_TEST_LAB_PREVNL
		. '</a></div>';
	/************************************************************************
	* Get both the Send To options and NSN Groups if it is active
	************************************************************************/
	msnl_fDebugMsg('Start of Build SENDTO HTML');
	$msnl_asHTML['SENDTO'] = msnl_fGetSendTo();
	msnl_fDebugMsg('Start of Build NSNGRPS HTML');
	$msnl_asHTML['NSNGRPS'] = msnl_fGetNSNGroups();
	/************************************************************************
	* Set up form and display the Send Tested options
	************************************************************************/
	echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
	echo '<input type="hidden" name="op" value="msnl_admin_send_tested" />';
	/************************************************************************
	* Display options list for who to send the newsletter to
	************************************************************************/
	echo $msnl_asHTML['SENDTO'];
	/************************************************************************
	* If NSN Groups are to be used, then list the groups in a new section
	************************************************************************/
	echo $msnl_asHTML['NSNGRPS'];
	/************************************************************************
	* Show the GO Button
	************************************************************************/
	echo '<div ' . $msnl_asCSS['BLOCK_center'] . '>'
		. '<input type="hidden" name="msnl_op" value="hnltst" />'
		. '<input type="submit" value="' . _MSNL_COM_LAB_SEND . '" title="' . _MSNL_COM_LNK_SEND . '" />'
		. '</div></form>';
	closetable();
	// Make pop-up HELP available to the page
	echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';
}

