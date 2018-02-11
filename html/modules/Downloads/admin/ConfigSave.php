<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
gdsave_config('admperpage', intval($xadmperpage));
gdsave_config('blockunregmodify', intval($xblockunregmodify));
gdsave_config('dateformat', addslashes(gdFilter($xdateformat, 'nohtml')));
gdsave_config('mostpopular', intval($xmostpopular));
gdsave_config('mostpopulartrig', intval($xmostpopulartrig));
gdsave_config('perpage', intval($xperpage));
gdsave_config('popular', intval($xpopular));
gdsave_config('results', intval($xresults));
gdsave_config('show_download', intval($xshow_download));
gdsave_config('show_links_num', intval($xshow_links_num));
gdsave_config('usegfxcheck', intval($xusegfxcheck));
Header('Location: ' . $admin_file . '.php?op=DLConfig');

