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

include_once 'header.php';
lgl_displayMenu();
OpenTable();
echo '<div align="center"><p class="title">' . $lgl_lang['LGL_ADM_COM_GENOPTS'] . '</p>'
	. '<form method="post" action="' . $admin_file . '.php">'
	. '<table border="0" cellpadding="2" cellspacing="2">'
	. '<tr><td><strong>' . $lgl_lang['LGL_ADM_CFG_CONADDRESS'] . ':</strong></td>'
	. '<td><input type="text" name="contact_email" value="' . $lgl_cfg['contact_email'] . '" size="30" maxlength="255" /></td></tr>'
	. '<tr><td><strong>' . $lgl_lang['LGL_ADM_CFG_CONEMAILSUBJ'] . ':</strong></td>'
	. '<td><input type="text" name="contact_subject" value="' . $lgl_cfg['contact_subject'] . '" size="30" maxlength="255" /></td></tr>'
	. '<tr><td><strong>' . $lgl_lang['LGL_ADM_CFG_COUNTRY'] . ':</strong></td>'
	. '<td><input type="text" name="country" value="' . $lgl_cfg['country'] . '" size="30" maxlength="255" /></td></tr>'
	. '</table><br />'
	. '<input type="hidden" name="op" value="rn_lgl_cfg_apply" /><br />'
	. '<input type="submit" value="' . $lgl_lang['LGL_ADM_COM_SAVE'] . '" /></form></div>';
CloseTable();
include_once 'footer.php';

?>