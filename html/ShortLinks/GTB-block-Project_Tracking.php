<?php
/**
 * TegoNuke(tm) ShortLinks: Project Tracking "Block Tap"
 *
 * Requires several core file edits (see installation documentation) and the main
 * includes/tegonuke/shortlinks/shortlinks.php script.
 *
 * See original credits below
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @package     TegoNuke(tm)
 * @subpackage  ShortLinks
 * @category    SEO
 * @category    Usability
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.3.1_398
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/
/***********************************************************/
/* Pjorct Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright (c) 2013 by RavenNuke (tm)		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Project_Tracking&amp;op=PJProject&amp;project_id=([0-9]*)"'
);

$urlout = array(
'project-\\1.html'
);

