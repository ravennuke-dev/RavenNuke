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
msnl_fShowSubTitle(_MSNL_LAB_CREATENL);
msnl_fShowHelpLegend();
/************************************************************************
* Get the sponsor banners HTML - placed here to ensure any issues are
* addressed up-front.
************************************************************************/
msnl_fDebugMsg('Start of Build Banner HTML');
$msnl_asHTML['BANNERS'] = '';
if (!isset($_POST['msnl_banner'])) $_POST['msnl_banner'] = '';
$sql = 'SELECT `bid`, `imageurl`, `clickurl`, `alttext` FROM `' . $prefix . '_banner` WHERE `active`=1 AND `imageurl`!=\'\' AND `imageurl`!=\'http://\'';
if (!$result = msnl_fSQLCall($sql)) {
	msnl_fRaiseAppError(_MSNL_ADM_ERR_DBGETBANNERS);
} else {
	while ($row = $db->sql_fetchrow($result)) {
		$msnl_asRec['bid'] = intval($row['bid']);
		$msnl_asRec['imageurl'] = msnl_fFixURL($row['imageurl']);
		$msnl_asRec['clickurl'] = msnl_fFixURL($row['clickurl']);
		$msnl_asRec['alttext'] = $row['alttext'];
		$msnl_asHTML['BANNERS'] .= '<input type="radio" name="msnl_banner" value="' . $msnl_asRec['bid'] . '"';
		if ($_POST['msnl_banner'] == $msnl_asRec['bid']) {
			$msnl_asHTML['BANNERS'] .= ' checked="checked"';
		}
		$msnl_asHTML['BANNERS'] .= ' />'
			. '<a href="' . $msnl_asRec['clickurl'] . '">'
			. '<img ' . $msnl_asCSS['IMG_def'] . ' src="' . $msnl_asRec['imageurl'] . '" alt="' . $msnl_asRec['alttext'] . '" />'
			. '</a><br /><br />';
	}
}
/************************************************************************
* Get both the Send To options and NSN Groups if it is active
************************************************************************/
msnl_fDebugMsg('Start of Build SENDTO HTML');
$msnl_asHTML['SENDTO'] = msnl_fGetSendTo();
msnl_fDebugMsg('Start of Build NSNGRPS HTML');
$msnl_asHTML['NSNGRPS'] = msnl_fGetNSNGroups();
/************************************************************************
* Set up form and display main Letter options such as Topic, Sender,
* Categories and Body Text.
************************************************************************/
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<div id="msnl_div_init">';
echo '<input type="hidden" name="op" value="msnl_admin" />';
echo '</div>';
echo '<div id="msnl_div_letter">';
opentable();
echo '<p><strong>' . _MSNL_ADM_LAB_LETTER . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * Topic - Newsletter topic text
 */
if (isset($_POST['msnl_topic'])) {
	$_POST['msnl_topic'] = tnnlFilter(msnl_fXMLDecode($_POST['msnl_topic']), 'nohtml');
} else {
	$_POST['msnl_topic'] = '';
}
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_TOPIC, _MSNL_ADM_LAB_TOPIC)
	. _MSNL_ADM_LAB_TOPIC
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_topic" size="40" '
	. 'maxlength="50" value="' . msnl_fXMLEntities($_POST['msnl_topic']) . '" />' . ""
	. '</td></tr>';
/*
 * Sender - The friendly name of the sender of the newsletter.
 */
if (isset($_POST['msnl_sender'])) {
	$_POST['msnl_sender'] = tnnlFilter(msnl_fXMLDecode($_POST['msnl_sender']), 'nohtml');
} else {
	$_POST['msnl_sender'] = '';
}
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_SENDER, _MSNL_ADM_LAB_SENDER)
	. _MSNL_ADM_LAB_SENDER
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_sender" size="40" '
	. 'maxlength="40" value="' . msnl_fXMLEntities($_POST['msnl_sender']) . '" />' . ""
	. '</td></tr>';
/*
 * Newsletter Category
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_NLSCAT, _MSNL_ADM_LAB_NLSCAT)
	. _MSNL_ADM_LAB_NLSCAT . ':&nbsp;'
	. '</td>' . ""
	. '<td>';
$_POST['msnl_cid'] = isset($_POST['msnl_cid']) ? intval($_POST['msnl_cid']) : 0;
echo msnl_fGetCategories($_POST['msnl_cid'] , MSNL_SHOW_ALL_OFF);
echo '</td>' . ""
	. '</tr>';
/*
 * Newsletter Body
 */
if (isset($_POST['msnl_textbody'])) {
	$_POST['msnl_textbody'] = tnnlFilter(msnl_fXMLDecode($_POST['msnl_textbody']), '');
} else {
	$_POST['msnl_textbody'] = '';
}
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_TEXTBODY, _MSNL_ADM_LAB_TEXTBODY)
	. _MSNL_ADM_LAB_TEXTBODY . ':&nbsp;'
	. '</td><td>' . _MSNL_ADM_LAB_HTMLOK . '</td></tr>';
if (NUKEWYSIWYG_ACTIVE) {
	echo '</table>';
	wysiwyg_textarea('msnl_textbody', $_POST['msnl_textbody'], 'PHPNukeAdmin', '100', $msnl_gasModCfg['wysiwyg_rows']);
} else {
	echo '<tr ' . $msnl_asCSS['TR_top'] . '>';
	echo '<td colspan="2">';
	echo '<textarea name="msnl_textbody" cols="100" rows="' . $msnl_gasModCfg['wysiwyg_rows'] . '">';
	echo msnl_fXMLEntities($_POST['msnl_textbody']) . '</textarea>';
	echo '</td>' . "" . '</tr>';
	echo '</table>';
}
closetable();
echo '</div>';
/************************************************************************
* Display options list for the Templates
************************************************************************/
echo '<div id="msnl_div_templates">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_ADM_LAB_TEMPLATES . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_TEMPLATES, _MSNL_ADM_LAB_CHOOSETMPLT)
	. _MSNL_ADM_LAB_CHOOSETMPLT
	. ':&nbsp;'
	. '</td>' . ""
	. '<td></td></tr>' . ""
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_left_nw'] . ' colspan="2">';
echo '<input type="radio" name="msnl_template" value="notemplate"';
if (!isset($_POST['msnl_template'])) $_POST['msnl_template'] = '';
if ($_POST['msnl_template'] == 'notemplate' || empty($_POST['msnl_template'])) {
	echo ' checked="checked"';
}
echo ' />&nbsp;No Template<br />';
/*
 * Write out list of template options based on the templates directory folder names
 */
$msnl_sTmpltDir = './modules/' . $msnl_sModuleNm . '/templates/';
if (@is_dir($msnl_sTmpltDir)) {
	if ($msnl_hDir1 = @opendir($msnl_sTmpltDir)) {
		while (($msnl_sFile = @readdir($msnl_hDir1)) !== false) {
			if (substr($msnl_sFile, 0, 1) != '.' && @is_dir($msnl_sTmpltDir . $msnl_sFile)) {
				$msnl_sFileNm = str_replace('_', ' ', $msnl_sFile);
				echo '<input type="radio" name="msnl_template" value="' . $msnl_sFile . '"';
				if ($_POST['msnl_template'] == $msnl_sFile) {
					echo ' checked="checked"';
				}
				echo ' />&nbsp;' . $msnl_sFileNm . '&nbsp;';
				$msnl_sFileImg = './modules/' . $msnl_sModuleNm . '/templates/' . $msnl_sFile . '/ss.jpg';
				if (@file_exists($msnl_sFileImg)) {
					echo '<a href="' . $msnl_sFileImg . '" title="" onclick="window.open(this.href, \'ViewSample\'); return false">'
						. '<img ' . $msnl_asCSS['IMG_def'] . ' src="./modules/' . $msnl_sModuleNm . '/images/view.png" '
						. 'alt="' . _MSNL_ADM_LNK_SHOWTEMPLATE . '" />'
						. '</a>';
					echo '<br />';
				}
			}

		}
		@closedir($msnl_hDir1);
	}
}
echo '</td></tr>';
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Display options list for Statistics and TOC
************************************************************************/
echo '<div id="msnl_div_includes">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_ADM_LAB_STATS . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * Include Site Statistics
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLSTATS, _MSNL_ADM_LAB_INCLSTATS)
	. _MSNL_ADM_LAB_INCLSTATS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="checkbox" name="msnl_stats" value="yes"';
if (isset($_POST['msnl_stats']) && $_POST['msnl_stats'] == 'yes') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
/*
 * Include Table of Contents (TOC)
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLTOC, _MSNL_ADM_LAB_INCLTOC)
	. _MSNL_ADM_LAB_INCLTOC
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="checkbox" name="msnl_toc" value="yes"';
if (isset($_POST['msnl_toc']) && $_POST['msnl_toc'] == 'yes') {
	echo ' checked="checked"';
}
echo ' /></td></tr>';
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Display options list for what to include and how many
************************************************************************/
echo '<div id="msnl_div_latest">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_ADM_LAB_INCLLATEST . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
/*
 * If user didn't enter values into the fields, default to last saved
 */
if (!isset($_POST['msnl_news']) || empty($_POST['msnl_news'])) {
	$_POST['msnl_news'] = $msnl_gasModCfg['latest_news'];
} else {
	$_POST['msnl_news'] = intval($_POST['msnl_news']);
}
if (!isset($_POST['msnl_downloads']) || empty($_POST['msnl_downloads'])) {
	$_POST['msnl_downloads'] = $msnl_gasModCfg['latest_downloads'];
} else {
	$_POST['msnl_downloads'] = intval($_POST['msnl_downloads']);
}
if (!isset($_POST['msnl_weblinks']) || empty($_POST['msnl_weblinks'])) {
	$_POST['msnl_weblinks'] = $msnl_gasModCfg['latest_links'];
} else {
	$_POST['msnl_weblinks'] = intval($_POST['msnl_weblinks']);
}
if (!isset($_POST['msnl_forums']) || empty($_POST['msnl_forums'])) {
	$_POST['msnl_forums'] = $msnl_gasModCfg['latest_forums'];
} else {
	$_POST['msnl_forums'] = intval($_POST['msnl_forums']);
}
if (!isset($_POST['msnl_reviews']) || empty($_POST['msnl_reviews'])) {
	$_POST['msnl_reviews'] = $msnl_gasModCfg['latest_reviews'];
} else {
	$_POST['msnl_reviews'] = intval($_POST['msnl_reviews']);
}
/*
 * Latest News
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLLATESTNEWS, _MSNL_ADM_LAB_INCLLATESTNEWS)
	. _MSNL_ADM_LAB_INCLLATESTNEWS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_news" size="2" '
	. 'maxlength="2" value="' . $_POST['msnl_news'] . '" />' . ""
	. '</td></tr>';
/*
 * Latest Downloads
 */
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLLATESTDLS, _MSNL_ADM_LAB_INCLLATESTDLS)
	. _MSNL_ADM_LAB_INCLLATESTDLS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_downloads" size="2" '
	. 'maxlength="2" value="' . $_POST['msnl_downloads'] . '" />' . ""
	. '</td></tr>';
//Latest Web Links
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLLATESTWLS, _MSNL_ADM_LAB_INCLLATESTWLS)
	. _MSNL_ADM_LAB_INCLLATESTWLS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_weblinks" size="2" '
	. 'maxlength="2" value="' . $_POST['msnl_weblinks'] . '" />' . ""
	. '</td></tr>';
//Latest Web Links
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLLATESTFORS, _MSNL_ADM_LAB_INCLLATESTFORS)
	. _MSNL_ADM_LAB_INCLLATESTFORS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_forums" size="2" '
	. 'maxlength="2" value="' . $_POST['msnl_forums'] . '" />' . ""
	. '</td></tr>';
//Latest Reviews
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_INCLLATESTREVS, _MSNL_ADM_LAB_INCLLATESTREVS)
	. _MSNL_ADM_LAB_INCLLATESTREVS
	. ':&nbsp;'
	. '</td>'
	. '<td>'
	. '<input type="text" name="msnl_reviews" size="2" '
	. 'maxlength="2" value="' . $_POST['msnl_reviews'] . '" />' . ""
	. '</td></tr>';
//Close out this section
echo '</table>';
closetable();
echo '</div>';
/************************************************************************
* Display options list for Site Sponsors
************************************************************************/
echo '<div id="msnl_div_sponsors">';
echo '<br />';
opentable();
echo '<p><strong>' . _MSNL_ADM_LAB_SPONSORS . '</strong></p>';
echo '<table ' . $msnl_asCSS['TABLE_adm'] . '>';
echo '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_hdr_adm'] . '>'
	. msnl_fShowHelp(_MSNL_ADM_HLP_CHOOSESPONSOR, _MSNL_ADM_LAB_CHOOSESPONSOR)
	. _MSNL_ADM_LAB_CHOOSESPONSOR
	. ':&nbsp;'
	. '</td>' . ""
	. '<td></td></tr>' . ""
	. '<tr ' . $msnl_asCSS['TR_top'] . '>'
	. '<td ' . $msnl_asCSS['TD_left_nw'] . ' colspan="2">'
	. '<input type="radio" name="msnl_banner" value="0"';
if (!isset($_POST['msnl_banner']) || empty($_POST['msnl_banner'])) {
	echo ' checked="checked"';
}
echo ' />' . _MSNL_ADM_LAB_NOSPONSOR . '<br /><br />';
echo $msnl_asHTML['BANNERS'];
//Close out this section
echo '</td></tr></table>';
closetable();
echo '</div>';
/************************************************************************
* Display options list for who to send the newsletter to
************************************************************************/
echo $msnl_asHTML['SENDTO'];
/************************************************************************
* If NSN Groups are to be used, then list the groups in a new section
************************************************************************/
echo $msnl_asHTML['NSNGRPS'];
/************************************************************************
* Show the list of valid Submit options and close out the page
************************************************************************/
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<input type="hidden" name="msnl_op" value="hnladm" />' . ""
	. '<input name="msnl_action" type="button" value="' . _MSNL_COM_LAB_PREVIEW . '" title="' . _MSNL_COM_LNK_PREVIEW . '" '
	. 'onclick="javascript:msnl_FormHandler(\'msnl_admin_preview\');" />' . ""
	. '<input name="msnl_action" type="button" value="' . _MSNL_COM_LAB_SEND . '" title="' . _MSNL_COM_LNK_SEND . '" '
	. 'onclick="javascript:msnl_FormHandler(\'msnl_admin_send_mail\');" /></p>';
/************************************************************************
* Close up the form and page
************************************************************************/
echo '</form>';
closetable();
// Make pop-up HELP available to the page
echo '<script type="text/javascript" src="./modules/' . $msnl_sModuleNm . '/wz_tooltip.js"></script>';

