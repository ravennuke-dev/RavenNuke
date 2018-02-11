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
if (!defined('ADMIN_FILE')) die('Illegal File Access');
$msnl_sModuleNm = 'HTML_Newsletter';
switch($op) {
	case 'msnl_admin':
	case 'msnl_admin_preview':
	case 'msnl_admin_send_mail':
	case 'msnl_admin_send_tested':
	case 'msnl_cfg':
	case 'msnl_cfg_apply':
	case 'msnl_cat':
	case 'msnl_cat_add':
	case 'msnl_cat_add_apply':
	case 'msnl_cat_chg':
	case 'msnl_cat_chg_apply':
	case 'msnl_cat_del':
	case 'msnl_cat_del_apply':
	case 'msnl_nls':
	case 'msnl_nls_chg':
	case 'msnl_nls_chg_apply':
	case 'msnl_nls_del':
	case 'msnl_nls_del_apply':
	include_once 'modules/'.$msnl_sModuleNm.'/admin/index.php';
	break;
}

