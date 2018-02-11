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
*/

$statstable = '
<td bgcolor="#d3e2ea">
	<img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="5" height="1" border="0" alt="" />
</td>
<td valign="top" align="right" width="138" bgcolor="d3e2ea">
	<table border="0" align="center" width="138" cellpadding="0" cellspacing="0">
		<tr>
			<td class="titlebar" width="138" height="20">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><b>Site Statistics</b></font>
			</td>
		</tr>
		<tr>
			<td>
				<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="100%" height="3" />
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" width="138">
		<tr>
			<td width="138" bgcolor="#000000">
				<table border="0" cellpadding="1" cellspacing="1" width="138">
					<tr>
						<td width="138" bgcolor="#ffffff">
							<table width="100%" align="center">
								<tr>
									<td width="75%">
										Total Page Hits:
									</td>
									<td width="25%" align="left">
										{PAGEHITS}
									</td>
								</tr>
								<tr>
									<td width="75%">
										Total Members:
									</td>
									<td width="25%" align="left">
										{MEMBERS}
									</td>
								</tr>
								<tr>
									<td width="75%">
										Total News Items:
									</td>
									<td width="25%" align="left">
										{NEWSITEMS}
									</td>
								</tr>
								<tr>
									<td width="75%">
										Total Downloads:
									</td>
									<td width="25%" align="left">
										{DOWNLOADS}
									</td>
								</tr>
								<tr>
									<td width="75%">
										Total Web Links:
									</td>
									<td width="25%" align="left">
										{WEBLINKS}
									</td>
								</tr>
								<tr>
									<td width="75%">
										Total Forum Posts:
									</td>
									<td width="25%" align="left">
										{FORUMPOSTS}
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
<td bgcolor="#d3e2ea">
	<img src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="6" height="1" border="0" alt="" />
</td>';

$latestnewstop = '
<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="16" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif" width="16" height="20" />
		</td>
		<td class="title" width="100%" height="20">
			<font color="#FFFFFF"><b>Our {AMOUNT} latest news items.</b></font>
		</td>
		<td width="25" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif" width="25" height="20" />
		</td>
	</tr>
	<tr>
		<td>
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="100%" height="3" />
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
	<tr>
		<td width="100%" bgcolor="#000000">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr>
					<td width="100%" bgcolor="#ffffff">
						<table width="100%" align="center">
							<tr>
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
							</tr>';

$latestnewsrow = '
<tr>
	<td>
		<a href="{SITEURL}/modules.php?name=News&amp;file=article&amp;sid={NEWSID}&amp;mode=&amp;order=0&amp;thold=0">
			{ROWNUMBER}
		</a>
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
</tr>';

$latestnewsend = '
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />';

$latestdownloadtop = '
<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="16" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif" width="16" height="20" />
		</td>
		<td class="title" width="100%" height="20">
			<font color="#FFFFFF"><b>Our {AMOUNT} latest downloads.</b></font>
		</td>
		<td width="25" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif" width="25" height="20" />
		</td>
	</tr>
	<tr>
		<td>
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="100%" height="3" />
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
	<tr>
		<td width="100%" bgcolor="#000000">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr>
					<td width="100%" bgcolor="#ffffff">
						<table width="100%" align="center">
							<tr>
								<td width="5%">
								</td>
								<td>
									Title
								</td>
								<td width="10%">
									Hits
								</td>
							</tr>';

$latestdownloadrow = '
<tr>
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
</tr>';

$latestdownloadend = '
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />';

$latestweblinktop = '
<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="16" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif" width="16" height="20" />
		</td>
		<td class="title" width="100%" height="20">
			<font color="#FFFFFF"><b>Our {AMOUNT} latest web links.</b></font>
		</td>
		<td width="25" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif" width="25" height="20" />
		</td>
	</tr>
	<tr>
		<td>
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="100%" height="3" />
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
	<tr>
		<td width="100%" bgcolor="#000000">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr>
					<td width="100%" bgcolor="#ffffff">
						<table width="100%" align="center">
							<tr>
								<td width="5%">
								</td>
								<td>
									Title
								</td>
								<td width="10%">
									Hits
								</td>
							</tr>';

$latestweblinkrow = '
<tr>
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
</tr>';

$latestweblinkend = '
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />';

$latestforumtop = '
<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="16" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif" width="16" height="20" />
		</td>
		<td class="title" width="100%" height="20">
			<font color="#FFFFFF"><b>Our {AMOUNT} latest forum posts.</b></font>
		</td>
		<td width="25" height="20">
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif" width="25" height="20" />
		</td>
	</tr>
	<tr>
		<td>
			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" width="100%" height="3" />
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
	<tr>
		<td width="100%" bgcolor="#000000">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr>
					<td width="100%" bgcolor="#ffffff">
						<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
							<tr>
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
							</tr>';

$latestforumrow = '
	<tr>
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
</tr>';

$latestforumend = '
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />';

// Sorry, but I am only going to support Fancy Content template with future enhancements.
// I will only "fix" PHP warnings or failures on the older templates.
// Hence why the following three lines have no content as Reviews was added later.
$latestreviewsrow = '';
$latestreviewstop = '';
$latestreviewsend  = '';

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

	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>{SITENAME} Email</title>
	<style type="text/css">

	<!--

	td {font-family: verdana,helvetica; font-size: 11px}
	body {font-family: verdana,helvetica; font-size: 11px}
	a:link {background: none; color: #000000; font-size: 11px; font-family: verdana, helvetica; text-decoration: underline}
	a:active {background: none; color: #000000; font-size: 11px; font-family: verdana, helvetica; text-decoration: underline}
	a:visited {background: none; color: #000000; font-size: 11px; font-family: verdana, helvetica; text-decoration: underline}
	a:hover {background: none; color: #000000; font-size: 11px; font-family: verdana, helvetica; text-decoration: underline}
	.option {background: none; color: #000000; font-size: 13px; font-weight: bold; font-family: verdana, helvetica; text-decoration: none}
	.tiny {background: none; color: #000000; font-size: 10px; font-weight: normal; font-family: verdana, helvetica; text-decoration: none}
	.footmsg {background: none; color: #cccccc; font-size: 8px; font-weight: normal; font-family: verdana, helvetica; text-decoration: none}
	td.titlebar {background: transparent url({siteurl}/modules/html_newsletter/templates/{templatename}/table-title.gif) no-repeat; color: #ffffff; font-family: verdana, helvetica, sans-serif }
	td.title {background: transparent url({siteurl}/modules/html_newsletter/templates/{templatename}/table-title_02.gif) repeat; color: #ffffff; font-family: verdana, helvetica, sans-serif }

	-->

	</style>

	</head>

	<body bgcolor="#0E3259" text="#000000" link="0000ff">
	<br />
	<table border="0" cellpadding="0" cellspacing="0" width="840" align="center">
		<tr>
			<td width="100%">
				<table border="0" cellpadding="0" cellspacing="0" width="840">
					<tr>
						<td width="100%">
							<table border="0" cellpadding="0" cellspacing="0" width="840">
								<tr>
									<td width="100%" height="88" bgcolor="#FFFFFF">
										<table border="0" width="100%" cellpadding="0" cellspacing="0">
											<tr>
												<td align="left">
													<a href="{SITEURL}/index.php">
														<img border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/logo.gif" alt="Welcome to $sitename!" hspace="20" />
													</a>
												</td>
												<td align="right">
													<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/logo-graphic.gif" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#000000" height="19" valign="bottom">
										<a href="{SITEURL}/index.php">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/home.gif" width="140" height="18" />
										</a>
										<a href="{SITEURL}/modules.php?name=Your_Account">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/account.gif" width="140" height="18" />
										</a>
										<a href="{SITEURL}/modules.php?name=Downloads">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/downloads.gif" width="140" height="18" />
										</a>
										<a href="{SITEURL}/modules.php?name=Submit_News">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/submit.gif" width="140" height="18" />
										</a>
										<a href="{SITEURL}/modules.php?name=Topics">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/topics.gif" width="140" height="18" />
										</a>
										<a href="{SITEURL}/modules.php?name=Top">
											<img alt="" border="0" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/top10.gif" width="140" height="18" />
										</a>
									</td>
								</tr>
								<tr>
									<td width="100%" height="10" bgcolor="#d3e2ea">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<table width="100%" cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td bgcolor="#d3e2ea">
										<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
											<tr>
												<td bgcolor="#000000">
													<table border="0" cellpadding="0" cellspacing="1" width="100%">
														<tr>
															<td bgcolor="#FFFFFF">
																<table border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tr>
																		<td bgcolor="#FFFFFF">
																			<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/dot.gif" border="0" />
																		</td>
																		<td width="100%" bgcolor="#FFFFFF">
																			<font class="option">
																				<b>
																					&nbsp;{EMAILTOPIC}
																				</b>
																			</font>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" bgcolor="#FFFFFF">
																			<br />
																			<table>
																				<tr>
																					<td>
																						{TEXTBODY}
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																	<br />
															</td>
														</tr>
														<tr>
															<td bgcolor="#FFFFFF" align="center">
																<font class="tiny">
																	Sent By: {SENDER} on {DATE}
																</font>
																<img alt="" src="{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif" border="0" height="3" />
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
										{STATS}
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#d3e2ea">
							<br />
							{NEWS}
							{DOWNLOADS}
							{WEBLINKS}
							{FORUMS}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
	<br />
	<center>{BANNER}</center>
	<hr />
	!!
	<center><font class="footmsg">
	You received this email because you are a registered user of {SITENAME}, if you dont want to receive mail from {SITENAME}, please let us know by following this <a href="mailto:{ADMINEMAIL}?subject=Newsletter">link</a>.
	</font></center>
	!!
	<hr />
			</td>
		</tr>
	</table>
	</body>
	</html>
EOD;

