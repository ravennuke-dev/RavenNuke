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
/************************************************************************
* This is a backend RSS/XML feed producer script that is configurable by
* newsletter category.  Since RSS/XML feeds by their very nature are
* "anonymous", ONLY newsletters that are of this type are listed.
************************************************************************/
/***********************************************************************/
/************************************************************************
* CONFIGURE THE NEWSLETTER BACKEND FEED USING THE BELOW VARIABLES
*
* Newsletters will be presented in sorted order of send date. Also comes
* pre-configured to present the two categories which come with the module.
************************************************************************/
/***********************************************************************/

$msnl_iUseCats = 0; //1 = Use category selection, 0 = All categories
$msnl_sCats = ''; //Use an empty string to pull ALL categories
$msnl_iUseGTNG = 0; //1 = Use GT-NextGEn (GoogleTap) URLs, 0 = standard URLs
$msnl_sRSSTitle = 'Newsletters'; //Change this label to whatever you like for your RSS feed

/***********************************************************************/
/************************************************************************
* YOU SHOULD NOT HAVE TO MODIFY ANYTHING BELOW THIS LINE
************************************************************************/
/***********************************************************************/

include_once 'mainfile.php';
global $prefix, $db, $nukeurl;

$result = '';
$row = '';
$msnl_sCats	= str_replace(' ', '', $msnl_sCats);

if ($msnl_iUseCats == 1 && !empty($msnl_sCats)) {
	$sql = 'SELECT `nid`, `topic` FROM `'.$prefix.'_hnl_newsletters` WHERE `cid` IN ('.$msnl_sCats.') AND `view` = 0 ORDER BY `datesent` DESC';
} else {
	$sql = 'SELECT `nid`, `topic` FROM `'.$prefix.'_hnl_newsletters` WHERE `view` = 0 ORDER BY `datesent` DESC';
}

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n\n";
echo '<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN"'."\n";
echo ' "http://my.netscape.com/publish/formats/rss-0.91.dtd">'."\n\n";
echo '<rss version="0.91">'."\n\n";
echo '<channel>'."\n";
echo '<title>'.htmlspecialchars($sitename).'</title>'."\n";
echo '<link>'.$nukeurl.'</link>'."\n";
echo '<description>'.htmlspecialchars($backend_title).' - '.$msnl_sRSSTitle.'</description>'."\n";
echo '<language>'.$backend_language.'</language>'."\n\n";

$result = $db->sql_query($sql);
$resultcount = $db->sql_numrows($result);

if ($result > 0 && $resultcount > 0) { //Had results
	while ($row = $db->sql_fetchrow($result)) {
		$msnl_iNID = intval($row['nid']);
		$msnl_sTopic = stripslashes($row['topic']);
		echo '<item>'."\n";
		echo '<title>'.htmlspecialchars($msnl_sTopic).'</title>'."\n";
		if ($msnl_iUseGTNG == 1) { //Use shortened URLs
			echo '<link>'.$nukeurl.'/html_newsletter-'.$msnl_iNID.'.html</link>'."\n";
		} else { //Use normal URLs
			echo '<link>'.$nukeurl.'/modules.php?name=HTML_Newsletter&amp;op=msnl_nls_view&amp;msnl_nid='.$msnl_iNID.'</link>'."\n";
		}
		echo '<description>'.htmlspecialchars($msnl_sTopic).'</description>'."\n";
		echo '</item>'."\n\n";
	}
} //End IF to check for valid results

echo '</channel>'."\n";
echo '</rss>';

