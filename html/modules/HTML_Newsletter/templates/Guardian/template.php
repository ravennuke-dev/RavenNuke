<?PHP
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

/*Placeholders Table Of Contents

**General Place Holders**
{ADMINEMAIL} = This is the Admin's email address.
{AMOUNT} = This is the row counter, mainly used displaying the total number of items.
{BANNER} = This displays the Banners links.
{DATE} = The current date (i.e. January 01 2004).
{DOWNLOADS} = This displays the download information.
{EMAILTOPIC} = This displays the email topic.
{FORUMS} = This displays the forums information.
{HITS} = This is the number of times an Item has been hit. (row specific)
{NEWS} = This displays the News information.
{NEWSLETTERLINK} = This is the link back to the newsletter to view from a browser (in case the mail client cannot read HTML)
{REVIEWS} = This displays the reviews information.
{ROWNUMBER} = This is the row counter, mainly used for numbering the repeating rows. (row specific)
{SENDER} = This is the senders name.
{SITENAME} = This is the name of your site.
{SITEURL} = This is the url of your site.
{STATS} = This displays the site stats information.
{TEMPLATENAME} = This is the template directory where all referenced objects can be found.
{TEXTBODY} = This is the main body of text or the message you wish sent.
{TITLE} = This is the name of the item. (row specific)
{TOPIC} = This is the name of the topic or category. (row specific)
{TOPICID} = This is the topic or category id number needed to do weblinks to the relative topic or category. (row specific)
{USERNAME} = This is the Users name the email will be sent to.
{WEBLINKS} = This displays the web-links information.

**News Specific Placeholders**
{NEWSID} = This is the News id number needed to do weblinks to the news item.
{AUTHOR} = This is the authors name.

**Download Specific Placeholders**
{DOWNLOADID} = This is the id number needed to do weblinks.
{DOWNLOAD_OP} = This is needed in order to get the right variable assigned for the given download module

**Weblink Specific Placeholders**
{LINKID} = This is the Weblink id number needed to do weblinks.

**Forum Specific Placeholders**
{FTOPICID} = This is the Topic id number needed to do weblinks.
{FTOPICLASTPOSTID} = This is the Topic last post id number needed to do weblinks (use with {FTOPICID} to view the last post of that topic).
{FTOPICTITLE} = This displays the Topic title.
{FTOPICREPLIES} = This displays the topic replys.
{FTPUSERID} = This is the user id of the Topic starter needed to do weblinks.
{FTPUSERNAME} = This is the username of the topic starter.
{FVIEWS} = This is the amount of views for the given topic.
{FTIME} = This is the latest post time of given topic.
{FUSERID} = This is the user id of the last poster needed to do weblinks.
{FUSERNAME} = This is the username of the last poster.

**Reviews Specific Placeholders**
{REVIEWID} = This is the Reviews id number needed to do weblinks to the Reviews item.
{REVIEWAUTHOR} = This is the authors name.
{REVIEWDATE} = This is the Review Date of the Reviews item.

**Site Stats Specific Placeholders**
{PAGEHITS} = This is the total page hits.
{MEMBERS} = This is the total members.
{NEWSITEMS} = This is the total news items.
{NEWSCAT} = This is the total news categories.
{DOWNLOADS} = This is the total downloads.
{DOWNLOADCAT} = This is the total download categories.
{WEBLINKS} = This is the total web-links.
{WEBLINKCAT} = This is the total web-links categories.
{FORUMPOSTS} = This is the total forum posts.
{FORUMTOPICS} = This is the total forum topics.

**Newsletter Table of Contents Specific Placeholders**
{TOCLINK} = This is the href name for the bookmark
{TOCLINKTEXT} = This is the link name for the bookmark that the user sees

*/

$newscontentstop = <<< EOD
    <table width="170" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <!-- Main Part of Dynamic Content -->
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td><span class=
                                                            "block-title"><strong>Newsletter Contents</strong></span></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td>
                                                                <table width="100%"
                                                                border="0"
                                                                             cellspacing="0"
                                                                             cellpadding="0">
                                                                    <tr bgcolor="">
                                                                        <td></td>
                                                                    </tr>
EOD;

$newscontentsrow = <<< EOD
    <tr>
        <td width="15"
                align=
                "right">
                <img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/petitrond.gif"
                 border=
                 "0" width="8" height="14" alt=""></td>

        <td>
        &nbsp;<a href="#{TOCLINK}">
        <span class="boxcontent">
        {TOCLINKTEXT}</span></a></td>
    </tr>
EOD;

$newscontentsend = <<< EOD
                                        <tr bgcolor="">
                                                                        <td></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$statstable = <<< EOD
    <a name="Statistics"></a>
    <table width="170" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td><span class=
                                                            "block-title"><strong>Site Statistics</strong></span></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td>
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Hits:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{PAGEHITS}</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Members:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{MEMBERS}</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total News:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{NEWSITEMS} in {NEWSCAT} categories</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Downloads:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{DOWNLOADS} in {DOWNLOADCAT} categories</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Web Links:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{WEBLINKS} in {WEBLINKCAT} categories</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Forum Posts:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{FORUMPOSTS} in {FORUMTOPICS} topics</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                                <table width="100%">
                                                                    <tr>
                                                                        <td align="left">
                                                                            <span class="boxcontent">
                                                                            <small>Total Reviews:</small>
                                                                            </span>
                                                                        </td>
                                                                        <td align="right">
                                                                            <span class="boxcontent">
                                                                            <b>{REVIEWS}</b>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <hr noshade>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$latestnewstop = <<< EOD
    <table width="100%" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td nowrap="nowrap">
                                                                <div align="left">
                                                                    <span class=
                                                                    "storytitle">
                                                                    <b>Our {AMOUNT} Latest News Items</b>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%" align="center">
                                                        <tr class="subtitle">
                                                            <td width="5%">
                                                            </td>
                                                            <td>
                                                                Title
                                                            </td>
                                                            <td width="15%">
                                                                Topic
                                                            </td>
                                                            <td width="15%">
                                                                Author
                                                            </td>
                                                        </tr>
EOD;

$latestnewsrow = <<< EOD
    <tr class="row">
        <td>
            {ROWNUMBER}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=News&amp;file=article&amp;sid={NEWSID}&amp;mode=&amp;order=0&amp;thold=0">
                {TITLE} ({HITS} hits)
            </a>
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=News&amp;new_topic={TOPICID}">
                {TOPIC}
            </a>
        </td>
        <td>
            {AUTHOR}
        </td>
    </tr>
EOD;

$latestnewsend = <<< EOD
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$latestdownloadtop =  <<< EOD
    <table width="100%" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td nowrap="nowrap">
                                                                <div align="left">
                                                                    <span class=
                                                                    "storytitle">
                                                                    <b>Our {AMOUNT} Latest Downloads</b>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%" align="center">
                                                        <tr class="subtitle">
                                                            <td width="5%">
                                                            </td>
                                                            <td>
                                                                Title
                                                            </td>
                                                            <td width="10%">
                                                                Hits
                                                            </td>
                                                        </tr>
EOD;

$latestdownloadrow = <<< EOD
    <tr class="row">
        <td>
            {ROWNUMBER}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=Downloads&amp;{DOWNLOAD_OP}=getit&amp;lid={DOWNLOADID}">
                {TITLE}
            </a>
        </td>
        <td>
            {HITS}
        </td>
    </tr>
EOD;

$latestdownloadend = <<< EOD
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$latestweblinktop = <<< EOD
    <table width="100%" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td nowrap="nowrap">
                                                                <div align="left">
                                                                    <span class=
                                                                    "storytitle">
                                                                    <b>Our {AMOUNT} Latest Web Links</b>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%" align="center">
                                                        <tr class="subtitle">
                                                            <td width="5%">
                                                            </td>
                                                            <td>
                                                                Title
                                                            </td>
                                                            <td width="10%">
                                                                Hits
                                                            </td>
                                                        </tr>
EOD;

$latestweblinkrow = <<< EOD
    <tr class="row">
        <td>
            {ROWNUMBER}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid={LINKID}&amp;ttitle={TITLE}">
                {TITLE}
            </a>
        </td>
        <td>
            {HITS}



        </td>
    </tr>
EOD;

$latestweblinkend = <<< EOD
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$latestforumtop = <<< EOD
    <table width="100%" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td nowrap="nowrap">
                                                                <div align="left">
                                                                    <span class=
                                                                    "storytitle">
                                                                    <b>Our {AMOUNT} Latest Forum Posts</b>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
                                                        <tr class="subtitle">
                                                            <td width="5%">
                                                            </td>
                                                            <td>
                                                                Topic
                                                            </td>
                                                            <td width="7%">
                                                                Answer
                                                            </td>
                                                            <td width="10%">
                                                                Author
                                                            </td>
                                                            <td width="7%">
                                                                Viewed
                                                            </td>
                                                            <td width="23%">
                                                                Latest Poster
                                                            </td>
                                                        </tr>
EOD;

$latestforumrow = <<< EOD
    <tr class="row">
        <td>
            {ROWNUMBER}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=Forums&amp;file=viewtopic&amp;t={FTOPICID}#{FTOPICLASTPOSTID}">
                {FTOPICTITLE}
            </a>
        </td>
        <td>
            {FTOPICREPLIES}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u={FTPUSERID}">
                {FTPUSERNAME}
            </a>
        </td>
        <td>
            {FVIEWS}
        </td>
        <td>
            {FTIME}
            <br />
            <a href="{SITEURL}/modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u={FUSERID}">
                {FUSERNAME}
            </a>
        </td>
    </tr>
EOD;

$latestforumend = <<< EOD
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$latestreviewstop = <<< EOD
    <table width="100%" border="0" cellspacing="0"
    cellpadding="4">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0"
                             cellpadding="1">
                    <tr>
                        <td bgcolor="#006699">
                            <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#FFFFFF">

                                        <table width="100%" border="0"
                                        cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td class="style3">
                                                    <table width="100%"
                                                                 border="0"
                                                                 cellspacing="0"
                                                                 cellpadding="4">
                                                        <tr>
                                                            <td nowrap="nowrap">
                                                                <div align="left">
                                                                    <span class=
                                                                    "storytitle">
                                                                    <b>Our {AMOUNT} Latest Reviews</b>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="#EAEDF4">
                                                    <table width="100%" align="center">
                                                        <tr class="subtitle">
                                                            <td width="5%">
                                                            </td>
                                                            <td>
                                                                Title
                                                            </td>
                                                            <td width="15%">
                                                                Author
                                                            </td>
                                                            <td width="15%">
                                                                Review Date
                                                            </td>
                                                        </tr>
EOD;

$latestreviewsrow = <<< EOD
    <tr class="row">
        <td>
            {ROWNUMBER}
        </td>
        <td>
            <a href="{SITEURL}/modules.php?name=Reviews&rop=showcontent&id={REVIEWID}">
                {TITLE} ({HITS} hits)
            </a>
        </td>
        <td>
            {REVIEWAUTHOR}
        </td>
        <td>
            {REVIEWDATE}
        </td>
    </tr>
EOD;

$latestreviewsend = <<< EOD
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0"
                             cellspacing="0" class="tbl">
                    <tr>
                        <td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>

                        <td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                        alt="" width="8" height="4" /></td>

                        <td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif"
                                 alt="" width="8" height="4" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
EOD;

$emailfile = <<< EOD
	<!--
	It appears that your mail client is not able to read HTML-emails!
	You may also view this newsletter from your web browser using the
	following link: {NEWSLETTERLINK}
	-->
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">

	<html>
	<head>
	  <title>{SITENAME} Email</title>
	  <style type="text/css">
			<!--
			body {font-family: Verdana,Helvetica; font-size: 10px}
			div {font-family: Verdana,Helvetica; font-size: 10px}
			font {font-family: Verdana,Helvetica; font-size: 10px}
			p {font-family: Verdana,Helvetica; font-size: 10px}
			td {font-family: Verdana,Helvetica; font-size: 10px}
			a:link,a:active,a:visited,a.postlink{color:#006699;text-decoration:none}
			a:hover{color:#dd6900}
			body{background:#ecf0f6;color:#cccccc;font:12px Verdana,Arial,Helvetica,sans-serif;margin:6px;padding:0;
			hr{border: 0px solid #ffffff;border-top-width:1px;height:0px}
			img{border:0}
			th{background:#005eb2 url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif);color:#deeef3;font-size:11px;font-weight:bold;height:27px;white-space:nowrap;text-align:center;padding-left:8px;padding-right:8px}
			tr.row { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; text-decoration: none; text-align: top; }
			tr.subtitle { background: #FFFFFF; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 2px 2px 2px 2px; text-decoration: none; }
			.bar { border: 1px solid #000000; margin-bottom: 5px; margin-top: 5px; }
			.block-title {BACKGROUND: none; COLOR: #006699; FONT-SIZE: 11px; FONT-FAMILY: Verdana, Helvetica}
			.bodyline{background:#ffffff;border:1px solid #98aab1}
			.boxcontent {BACKGROUND: none; COLOR: #006699; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica}
			.content {BACKGROUND: none; COLOR: #006699 FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica}
			.storytitle {BACKGROUND: none; COLOR: #DEEEF3; FONT-SIZE: 11px; FONT-WEIGHT: bold; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none}
			.tblbot{background: url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif) repeat-x;width:100%}
			.tbll{background: url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif) no-repeat;width:8px}
			.tblr{background: url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif) no-repeat;width:8px}
			.tbl{border-collapse:collapse;height:4px;width:100%}
			.topbkg{background: #dbe3ee url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/cellpic_bkg.jpg) repeat-x}
			.topnav{font-size:10px;background: #e5ebf3 url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/cellpic_nav.gif) repeat-x;color:#006699;height:21px;white-space:nowrap;border: 0px solid #91a0ae;border-width: 1px 0px 1px 0px}
			div#ltrtitle { background: none; color: #006699; font-family: Verdana, Helvetica, sans-serif; font-size: 24px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 5px 5px; text-align: right; text-decoration: none; white-space:wrap; text-shadow: #D3D3D3; }
			div#unsub { color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 9px; text-decoration: none; }
			.style1 {color: #cccccc}
			.style2 {color: #ffffff}
			.style3 {color: #eaedf4; background: url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif) }
			.style4 {background-color: #02293a; border: #d4d0c8 }
			-->
		</style>
	</head>

	<body>
	  <table class="bodyline" width="800" cellspacing="0"
			 cellpadding="0" border="0">
		<tr>
		  <td align="center" valign="top">
			<table class="topbkg" width="800" cellspacing="0"
			cellpadding="0" border="0">
			  <tr>
				<td width="100%" valign="middle" align="left">
				   <a href="{SITEURL}/index.php"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/logo1.gif"
					 border="0" alt="Welcome to $sitename!"></a></td>

			  </tr>
			</table>

			<table width="100%" border="0" cellspacing="0"
				   cellpadding="2">
			  <tr>
				<td class="topnav" width="70%" nowrap="nowrap">
				  <div align="left">
					<span class="content"><strong>   By: </strong>{SENDER}<strong> Topic: </strong>{EMAILTOPIC}</span>
				  </div>
				</td>

				<td class="topnav" width="30%" nowrap="nowrap">
				  <div align="right">{DATE}</div>
				</td>
			  </tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0"
				   class="tbl">
			  <tr>
				<td class="tbll"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif" alt="" width="8"
					 height="4" /></td>

				<td class="tblbot"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif" alt=""
					 width="8" height="4" /></td>

				<td class="tblr"><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif" alt="" width="8"
					 height="4" /></td>
			  </tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0"
				   border="0" align="center">
			  <tr valign="top">
				<td><img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/back1.gif" width="1" height="1"
					 border="0" alt="" /></td>
			  </tr>
			</table>

			<!-- Main Newsletter Section -->
			<table width="100%" cellpadding="0" cellspacing="0"
				   border="0" align="center">
			  <tr valign="top">
				<td width="7" valign="top" bgcolor="#02293A">

				  <!-- Start of Newsletter Table of Contents Block -->
				  <div class="style2">{TOC}

				  <!-- Start of Site Statistics -->
				  {STATS}</div> </td>

				<td width="100%" valign="top" bgcolor="#2F4F5D">
				  <table width="100%" border="0" cellspacing="0"
				  cellpadding="4">
					<tr>
					  <td>
						<table width="100%" border="0" cellspacing="0"
							   cellpadding="1">
						  <tr>
							<td bgcolor="#006699">
							  <table width="100%" border="0"
							  cellspacing="0" cellpadding="0">
								<tr>
								  <td bgcolor="#FFFFFF">
									<table width="100%" border="0"
									cellspacing="1" cellpadding="0">
									  <tr>
										<td bgcolor="#FFFFFF">
										  <table width="100%"
												 border="0"
												 cellspacing="0"
												 cellpadding="4">
											<tr>
											  <td class="style4">
												<div class="style1">{TEXTBODY}</div></td>
											</tr>
										  </table>
										</td>
									  </tr>
									</table>
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>
						</table>

						<table border="0" cellpadding="0"
							   cellspacing="0" class="tbl">
						  <tr>
							<td class="tbll">&nbsp;</td>

							<td class="tblbot">&nbsp;</td>

							<td class="tblr">&nbsp;</td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>

								<!-- Start of Latest News Articles Section -->
								<a name="LatestNews"></a>
								{NEWS}

								<!-- Start of Latest Downloads Section -->
								<a name="LatestDownloads"></a>
								{DOWNLOADS}

								<!-- Start of Latest Web Links Section -->
								<a name="LatestLinks"></a>
								{WEBLINKS}

								<!-- Start of Latest Posts Section -->
								<a name="LatestPosts"></a>
								{FORUMS}

								<!-- Start of Latest Reviews Section -->
								<a name="LatestReviews"></a>
								{REVIEWS}            </td>
			  </tr>
			</table>
		  </td>
		</tr>
	</table>
	  <p>&nbsp;</p>
	  <p><br />
	  </p>
	  <div id="unsub">You received this email because you are a registered user of {SITENAME}, if you dont want to receive mail from {SITENAME}, please let us know by following this <a href="mailto:{ADMINEMAIL}?subject=Newsletter">link</a>.</div>
		<br />
	</body>
	</html>
EOD;

