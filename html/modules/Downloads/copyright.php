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
/*
 * New module owner copyrights
 */
$new_mod_name = 'TegoNuke&trade; Downloads';
$new_author_email = '';
$new_author_homepage = 'http://montegoscripts.com';
$new_author_name = '<a href="' . $new_author_homepage . '" target="new">Montego Scripts</a>';
$new_license = 'Copyright &copy; 2006-2011 Montego Scripts';
/*
 * Original module copyrights from NSN
 */
$mod_name = 'NSN GR Downloads';
$author_email = '';
$author_homepage = 'http://www.nukescripts.net';
$author_name = '<a href="' . $author_homepage . '" target="new">NukeScripts Network</a>';
$license = 'Copyright &copy; 2000-2005 NukeScripts Network';
/*
 * Display copyrights
 */
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"' . "\n";
echo '  "http://www.w3.org/TR/html4/loose.dtd">' . "\n";
echo '<html>';
echo '<head>';
echo '<title>' . $mod_name . ': Copyright Information</title>';
echo '<style type="text/css">';
echo '<!--';
echo 'body{';
echo 'FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;';
echo 'SCROLLBAR-3DLIGHT-COLOR:#000000;';
echo 'SCROLLBAR-ARROW-COLOR:#e7e7e7;';
echo 'SCROLLBAR-FACE-COLOR:#414141;';
echo 'SCROLLBAR-DARKSHADOW-COLOR:#000000;';
echo 'SCROLLBAR-HIGHLIGHT-COLOR:#9d9d9d;';
echo 'SCROLLBAR-SHADOW-COLOR:#9d9d9d;';
echo 'SCROLLBAR-TRACK-COLOR:#e7e7e7;';
echo '}';
echo '-->';
echo '</style>';
echo '</head>';
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">';
/*
 * New module owner copyright
 */
echo '<div style="text-align:center; font-weight:bold;">Module Copyright &copy; Information</div><hr />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' . $new_mod_name . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' . $new_license . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' . $new_author_name . '<br />';
echo '<hr />';
/*
 * Original owner copyright
 */
echo '<div style="text-align:center; font-weight:bold;">Original Module Copyright &copy; Information</div>';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' . $mod_name . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' . $license . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' . $author_name . '<br />';
echo '<hr />';
echo '<div style="text-align:center;">';
echo '[<a href="#" onclick="javascript:self.close()">Close Window</a>]</div>';
echo '</body>';
echo '</html>';

