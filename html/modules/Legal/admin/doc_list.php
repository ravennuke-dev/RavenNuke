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

include 'header.php';
lgl_displayMenu();
OpenTable();
/*
 * Set up the page content and main document list table
 */
echo '<div align="center"><p class="title">' . $lgl_lang['LGL_ADM_COM_DOCS'] . '</p>';
echo '<table ' . LGL_STYLE_TBL . ' cellpadding="2" cellspacing="4"><tr ' . LGL_STYLE_TBLHDR . '><td colspan="2">'
	. $lgl_lang['LGL_ADM_DOCS_DOCNAME'] . '</td><td colspan="2">'
	. $lgl_lang['LGL_ADM_DOCS_STATUS'] . '</td><td>'
	. $lgl_lang['LGL_ADM_DOCS_LANGS'];
if ($multilingual == 0) echo '<span style="vertical-align:super;">*</span>';
echo '</td></tr>';
/*
 * Get list of documents and then list out their various translations
 */
$sql = 'SELECT `did`, `doc_name`, `doc_status` FROM `' . $prefix . '_legal_docs`';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	echo '<tr ' . LGL_STYLE_TBLROW. '>';
	/*
	 * Document Name
	 */
	echo '<td align="left">' . $row['doc_name']
		. '</td><td align="right"><a href="' . $lgl_url . 'rn_lgl_doc_edit&amp;lgl_did=' . (int)$row['did'] . '" '
		. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOEDITD'] . '">'
		. '<img src="images/edit.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOEDITD'] . '" /></a>'
		. '&nbsp;<a href="' . $lgl_url . 'rn_lgl_doc_del&amp;lgl_did=' . (int)$row['did'] . '" '
		. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTODELETED'] . '">'
		. '<img src="images/delete.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTODELETED'] . '" /></a></td>';
	/*
	 * Document Status
	 */
	echo '<td align="left">';
	if ($row['doc_status'] == 0) {
		echo $lgl_lang['LGL_ADM_DOCS_INACTIVE']
			. '</td><td align="right"><a class="rn_csrf" href="' . $lgl_url . 'rn_lgl_doc_status&amp;lgl_did=' . (int)$row['did'] . '" '
			. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOACTIVATE'] . '">'
			. '<img src="images/active.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOACTIVATE'] . '" /></a>';
	} else {
		echo $lgl_lang['LGL_ADM_DOCS_ACTIVE']
			. '</td><td align="right"><a class="rn_csrf" href="' . $lgl_url . 'rn_lgl_doc_status&amp;lgl_did=' . (int)$row['did'] . '" '
			. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOINACTIVATE'] . '">'
			. '<img src="images/inactive.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOINACTIVATE'] . '" /></a>';
	}
	echo '</td>';
	/*
	 * Available languages - if the multilingual setting is not set, will default to the site
	 * prefered language.  Also, a note will be added below the document table showing that the
	 * multilingual option is not set as a reminder.
	 */
	echo '<td align="left">';
	/*
	 * Get language list - gets this from the languages files that the end-user would
	 * have available to them - i.e., the available languages for them to choose from.
	 * However, with one caveat: I am not taking the list from the overall RavenNuke(tm)
	 * language files, but from those within the Legal module.  So, if you want to support
	 * multiple languages, you must maintain ones for the Legal module too.  If we are not
	 * running a multilingual site, then only the site prefered language is returned.
	 */
	$lgl_langList = lgl_getLangList();
	$lgl_isFirst = true;
	foreach ($lgl_langList as $value)
	{
		if ($lgl_isFirst) {
			$lgl_isFirst = false;
		} else {
			echo ', ';
		}
		if ($value == $language) {
			echo '<span style="font-weight:bold;" title="' . $lgl_lang['LGL_ADM_DOCS_SITELANG'] . '">'
				. ucfirst($value) . '</span>';
		} else {
			echo ucfirst($value);
		}
		/*
		 * Determine if we have a translation already for a given language.  If we do not
		 * then we show a "cannot view" icon rather than the "view".  Just figured it would
		 * be better than just not showing any icon at all and have the admin "wonder".
		 */
		$sql = 'SELECT COUNT(*) FROM `' . $prefix . '_legal_text_map` WHERE `mid` = \'' . LGL_MID_DOC
			. '\' AND `did` = \'' . (int)$row['did'] . '\' AND `language` = \'' . addslashes($value) . '\'';
		list($lgl_langCount) = $db->sql_fetchrow($db->sql_query($sql));
		if ($lgl_langCount == 0) {
			echo '&nbsp;<img src="images/view_not.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWDNOT']
				. '" title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWDNOT']. '" />';
		} else {
			echo '&nbsp;<a href="' . $lgl_url . 'rn_lgl_doc_view&amp;lgl_did=' . (int)$row['did']
			. '&amp;lgl_language=' . $value . '" '
			. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWD']
			. '" onclick="window.open(this.href, \''. $lgl_lang['LGL_ADM_COM_MODTITLE'] . '\'); return false">'
			. '<img src="images/view.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWD'] . '" /></a>';
		}
		echo '&nbsp;<a href="' . $lgl_url . 'rn_lgl_doc_edit&amp;lgl_did=' . (int)$row['did']
			. '&amp;lgl_language=' . $value . '" '
			. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOEDITT'] . '">'
			. '<img src="images/edit.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTOEDITT'] . '" /></a>';
		if ($lgl_langCount > 0) {
			// Remove the delete from the translation for the site preferred language
			if ($value != $language) {
				echo '&nbsp;<a href="' . $lgl_url . 'rn_lgl_doc_del&amp;lgl_did=' . (int)$row['did']
					. '&amp;lgl_language=' . $value . '" '
					. 'title="' . $lgl_lang['LGL_ADM_DOCS_CLICKTODELETET'] . '">'
					. '<img src="images/delete.gif" alt="' . $lgl_lang['LGL_ADM_DOCS_CLICKTODELETET'] . '" /></a>';
			}
		}
	}
	echo '</td></tr>';
}

echo '</table>';
if ($multilingual == 0) {
	echo '<br /><span style="vertical-align:super;">*</span>' . $lgl_lang['LGL_ADM_DOCS_NOMULTILINGUAL'];
}
echo '</div>';

CloseTable();
include 'footer.php';

?>