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

if (!defined('ADMIN_FILE')) die ('Access Denied');

$lgl_modName = $module_name = basename(dirname(dirname(__FILE__)));

switch($op) {
	case 'legal':
	case 'rn_lgl_doc_add':
	case 'rn_lgl_doc_add_apply':
	case 'rn_lgl_doc_del':
	case 'rn_lgl_doc_del_confirm':
	case 'rn_lgl_doc_edit':
	case 'rn_lgl_doc_edit_apply':
	case 'rn_lgl_doc_status':
	case 'rn_lgl_doc_view':
	case 'rn_lgl_cfg':
	case 'rn_lgl_cfg_apply':
	include 'modules/'.$lgl_modName.'/admin/index.php';
	break;

}

?>