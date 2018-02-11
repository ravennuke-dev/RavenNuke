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
if (!defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE')) {
	die('Illegal File Access');
}
/************************************************************************
* Define style array values
************************************************************************/
global $bgcolor1, $bgcolor2;
unset($msnl_asCSS);
$msnl_asCSS = array();
$msnl_asCSS['BLOCK_center'] = 'style="text-align:center"';
$msnl_asCSS['BLOCK_right']  = 'style="text-align:right"';
$msnl_asCSS['BLOCK_left']   = 'style="text-align:left"';
$msnl_asCSS['IMG_hlp']      = 'style="cursor:help;border:0px"';
$msnl_asCSS['IMG_def']      = 'style="border:0px"';
$msnl_asCSS['TABLE_lay']    = 'style="border:0px;padding:2px;width:100%"';
$msnl_asCSS['TABLE_adm']    = 'style="border:0px;padding:2px;spacing:4px"';
$msnl_asCSS['TABLE_data']   = 'style="border:0px;padding:2px;background-color:' . $bgcolor2 . ';width:100%"';
$msnl_asCSS['TR_hdr']       = 'style="font-weight:bold;background-color:' . $bgcolor2 . ';text-align:center;white-space:nowrap"';
$msnl_asCSS['TR_rows']      = 'style="background-color:' . $bgcolor1 . ';vertical-align:top"';
$msnl_asCSS['TR_top']       = 'style="vertical-align:top"';
$msnl_asCSS['TR_bottom']    = 'style="vertical-align:bottom"';
$msnl_asCSS['TD_2col50']    = 'style="width:50%"';
$msnl_asCSS['TD_left_nw']   = 'style="text-align:left;white-space:nowrap"';
$msnl_asCSS['TD_center_nw'] = 'style="text-align:center;white-space:nowrap"';
$msnl_asCSS['TD_right_nw']  = 'style="text-align:right;white-space:nowrap"';
$msnl_asCSS['TD_hdr_adm']   = 'style="font-weight:bold;text-align:left;white-space:nowrap;background-color:' . $bgcolor2 . '"';
$msnl_asCSS['INPUT_email']  = 'style="width:100%;height:5em;visibility:visible;display:inline"';

