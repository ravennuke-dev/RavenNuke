<?php
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    1.4.0
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 - 2008 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
if (!defined('MSNL_LOADED')) die('Illegal File Access');
/************************************************************************
* Script Initialization
************************************************************************/
opentable();
msnl_fShowSubTitle(_MSNL_ADM_SAVE_LAB_SAVEDRAFT);
/************************************************************************
* Check for user input errors
************************************************************************/
$msnl_asRec = $msnl_asValidFields;
include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_check_post.php';
if (sizeof($msnl_asERR) == 0) { // Had no validation errors so make the NL and provide the link
	/*
	 * Make the temporary newsletter
	 */
	include_once 'modules/' . $msnl_sModuleNm . '/admin/admin_make_nls.php';
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
* Save a draft of the newsletter fields based upon user input so can
* bring it back upon returning back to the Create Newsletter screen.
************************************************************************/
/*
 * Save a draft of the newsletter based upon the preview
 */
$msnl_asRec['status'] = 1;
if (!msnl_fSaveNLDraft($msnl_asRec)) {
	echo '<p ><strong>' . _MSNL_COM_ERR_SAVEDRAFT . '</strong></p>';
}

/************************************************************************
* Display the GO BACK button that is really a submit button for the form
************************************************************************/
echo '<form method="post" action="' . $admin_file . '.php" name="msnl_frm">';
echo '<input type="hidden" name="op" value="msnl_admin" />';
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<input type="hidden" name="msnl_nid" value="' . $msnl_iNID . '" />'
	. '<input type="submit" value="' . _MSNL_COM_LAB_GOBACK . '" />'
	. '</p>';
echo '</form>';
/************************************************************************
* Close up the page
************************************************************************/
closetable();
?>