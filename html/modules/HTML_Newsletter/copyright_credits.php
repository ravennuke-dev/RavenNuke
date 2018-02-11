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
if (!defined('MSNL_LOADED')) {
	die('Illegal File Access');
}
/************************************************************************
* Script Initialization
************************************************************************/
//For Copyright:
$msnl_sAuthorNm = 'Rob Herder (aka: montego)';
$msnl_sAuthorEmail = 'montego _(at)_ montegoscripts {DOT} com';
$msnl_sAuthorURL = 'http://montegoscripts.com';
$msnl_sDocsURL = 'http://wiki.montegoscripts.com';
$msnl_sLicense = 'GNU/GPL - Provided with Download';
$msnl_sDownloadURL = 'http://montegoscripts.com/downloads-cat9.html';
$msnl_sDocsURL = 'http://wiki.montegoscripts.com';
$msnl_sModDesc = 'Allows a Nuke site admin to send out HTML '
	. 'formatted newsletters plus an extensive archiving system. '
	. 'Visit <a href="http://montegoscripts.com" '
	. 'title="Home of the HTML Newsletter for RavenNuke(tm)/PHP-Nuke">'
	. 'Montego Scripts</a> for a full list of features.';
//For Credits:
$msnl_sOrigAuth = 'The original 1.0 version was written by <span class="thick">mangaman</span> from '
	. '<a href="http://www.nukeworks.biz" title=""> NukeWorks</a>. '
	. 'It looks as though it was based on the original PHP-Nuke Newsletter '
	. 'module as well as had some concepts from Fancy Newsletter, but not '
	. '100% sure on that.';
$msnl_sCurrAuth = '<span class="thick">montego</span> from <a href="http://montegoscripts.com" '
	. 'title="Home of the HTML Newsletter for PHP-Nuke">'
	. 'Montego Scripts</a> is the current author.';
$msnl_sTranslations = 'The following translations were done for version 1.3:<br /><br />'
	. '<span class="thick">French</span>: Stefvar from <a href="http://www.stefvar.com" '
	. 'title="http://www.stefvar.com">'
	. 'http://www.stefvar.com</a>.<br /><br />'
	. '<span class="thick">German</span>: Marco Wiesler from <a href="http://www.warp-speed.de" '
	. 'title="http://www.warp-speed.de">'
	. 'http://www.warp-speed.de</a>.<br /><br />'
	. '<span class="thick">Greek</span>: Saxinidis V. Konstantinos.<br /><br />'
	. '<span class="thick">Italian</span>: Luca Negrini from <a href="http://www.sportsverona.com" '
	. 'title="http://www.sportsverona.com">'
	. 'http://www.sportsverona.com</a>.<br /><br />'
	. '<span class="thick">Persian</span>: Izone from <a href="http://www.iranyad.com" '
	. 'title="http://www.iranyad.com">'
	. 'http://www.iranyad.com</a>.<br /><br />'
	. 'As new translations come available, this text will be '
	. 'updated with the appropriate credits and released as a separate '
	. 'update and download as well as included in the main download pack.';
$msnl_sOther = 'Additional thanks go to the following people for their help along the '
	. 'way:<br /><br />'
	. '<span class="thick">Raven</span> from <a href="http://www.ravenphpscripts.com" '
	. 'title="PHP Web Host - Quality Web Hosting and Scripts">'
	. 'http://ravenphpscripts.com</a> for his excellent support '
	. 'site, excellent web hosting and encouragement along the way.<br /><br />'
	. '<span class="thick">Guardian</span> from <a href="http://www.code-authors.com" '
	. 'title="http://www.code-authors.com">'
	. 'http://www.code-authors.com</a> '
	. 'for his constant nagging ( LOL ) for new releases, a few '
	. 'bug fixes, for his Guardian template, for his help in testing, helping '
	. 'to keep an eye on the support forums, and as a contributing editor to the '
	. 'on-line documentation!<br /><br />'
	. '<span class="thick">Kguske</span> from <a href="http://nukeseo.com" '
	. 'title="http://nukeseo.com">'
	. 'http://nukeSEO.com</a> '
	. 'for his excellent integration of the FCKEditor into PHP-Nuke '
	. 'by way of his tool nukeWYSIWYG!<br /><br />'
	. '<span class="thick">Izone</span> from <a href="http://www.iranyad.com" '
	. 'title="www.iranyad.com">'
	. 'http://www.iranyad.com</a> '
	. 'for his modifications to the base distribution to make the '
	. 'module pages and templates display properly in the Persian '
	. 'language.';
// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.
/************************************************************************
* Start displaying copyright and credit information
************************************************************************/
include_once 'header.php';
$msnl_giHeadersSent = 1;
msnl_fPrintHTML('BEGIN');
require_once 'modules/' . $msnl_sModuleNm . '/javascript.php';
echo '<div id="msnl_div_title">';
opentable();
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<span class="title">'
	. _MSNL_CPY_LAB_COPYTITLE
	. '</span><br />'
	. str_replace('_', ' ', $msnl_sModuleNm) . '&nbsp;' . _MSNL_CPY_LAB_MODULEFOR
	. ' <a href="http://phpnuke.org" title="' . _MSNL_CPY_LNK_PHPNUKE . '">PHP-Nuke</a><br /><br />'
	. '</p>';
closetable();
echo '<br /></div>' . "\n";
/************************************************************************
* Show details of the copyright information
************************************************************************/
echo '<div id="msnl_div_copy">';
opentable();
msnl_fShowSubTitle(_MSNL_CPY_LAB_COPY);
echo '<div>'
	. '<table ' . $msnl_asCSS['TABLE_adm'] . '>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_MODNAME . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. str_replace('_', ' ', $msnl_sModuleNm)
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_MODVER . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_gasModCfg['version']
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_MODDESC . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sModDesc
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_LICENSE . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sLicense
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_AUTHORNM . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sAuthorNm
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_AUTHOREMAIL . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sAuthorEmail
	. '</td>'
	. '</tr>'
	. '</table>'
	. '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '[ <a href="' . $msnl_sAuthorURL . '" title="' . _MSNL_CPY_LNK_AUTHORHOME . '">'
	. _MSNL_CPY_LAB_AUTHORWEB . '</a>'
	. '| <a href="' . $msnl_sDownloadURL . '" title="' . _MSNL_CPY_LNK_DOWNLOAD . '">'
	. _MSNL_CPY_LAB_MODDL . '</a>'
	. '| <a href="' . $msnl_sDocsURL . '" title="' . _MSNL_CPY_LNK_DOCS . '">'
	. _MSNL_CPY_LAB_DOCS . '</a>'
	. ']'
	. '</p>'
	. '<br />'
	. '</div>';
closetable();
echo '<br /></div>' . "\n";
/************************************************************************
* Show details of the credit information
************************************************************************/
echo '<div id="msnl_div_credit">';
opentable();
msnl_fShowSubTitle(_MSNL_CPY_LAB_CREDITS);
echo '<div>'
	. '<table ' . $msnl_asCSS['TABLE_adm'] . '>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_ORIGAUTHOR . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sOrigAuth
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_CURRENTAUTHOR . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sCurrAuth
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_TRANSLATIONS . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sTranslations
	. '</td>'
	. '</tr>'
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. '<img src="images/arrow.gif" ' . $msnl_asCSS['IMG_def'] . ' alt="" />'
	. '&nbsp;<span class="thick">' . _MSNL_CPY_LAB_OTHER . ':&nbsp;</span>'
	. '</td>'
	. '<td>'
	. $msnl_sOther
	. '</td>'
	. '</tr>'
	. '</table>'
	. '</div>';
closetable();
echo '<br /></div>' . "\n";
msnl_fShowBtnGoBack();
msnl_fPrintHTML('END');
include_once 'footer.php';

