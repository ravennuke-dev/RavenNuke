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
 * Do some cleansing of input even though module is only accessible via
 * an admin.
 */
$lgl_cfgChanges = array();
$s = '';
$result = '';
// Validate contact_email
if (isset($_POST['contact_email'])) {
	$s = check_html($_POST['contact_email'], 'nohtml');
	$result = validate_mail($s);
	if ($result !== false) $lgl_cfgChanges['contact_email'] = $s;
}
// Cleanse contact_subject
if (isset($_POST['contact_subject'])) {
	$s = check_html(trim($_POST['contact_subject']), 'nohtml');
	$s = substr($s, 0, 254);
	if (isset($s[1])) $lgl_cfgChanges['contact_subject'] = $s;
}
// Cleanse the country
if (isset($_POST['country'])) {
	$s = check_html(trim($_POST['country']), 'nohtml');
	$s = substr($s, 0, 254);
	if (isset($s[1])) $lgl_cfgChanges['country'] = $s;
}
include 'header.php';
lgl_displayMenu();
OpenTable();
echo '<div align="center"><p class="title">' . $lgl_lang['LGL_ADM_COM_GENOPTS'] . '</p>';
/*
 * Save whatever values were found to have valid changes to them
 */
$sql = 'UPDATE `' . $prefix . '_legal_cfg` SET';
$lgl_isFirst = true;
foreach ($lgl_cfgChanges as $key => $value)
{
	if ($lgl_isFirst) {
		$sql .= ' `';
		$lgl_isFirst = false;
	} else{
		$sql .= ', `';
	}
	$sql .= $key . '` = \'' . addslashes($value) . '\'';
}
$sql .= ' WHERE 1';
if (!$db->sql_query($sql)) {
	lgl_goBack($lgl_lang['LGL_ADM_ERR_DBSAVE']);
} else {
	lgl_goBack($lgl_lang['LGL_ADM_CFG_SAVE'], 'rn_lgl_cfg');
}
CloseTable();
include 'footer.php';

?>