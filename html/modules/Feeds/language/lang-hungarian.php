<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

# General
define('_FEEDS','Feedek/h&iacute;rmodulok');
define('_FEEDS_ADMIN','Feed Adminisztr&aacute;ci&oacute;');
define('_nF_FEEDLIST','Feed Lista');
define('_FEED_PREVIEW','Feed El&otilde;n&eacute;zet');
define('_nF_SUBSCRIBE','Feliatkoz&aacute;s');
define('_nF_NEWS', 'H&iacute;rek');
define('_nF_FORUMS', 'F&oacute;rumok');
define('_nF_ADDCONTENT', 'V&aacute;lasszon t&iacute;pust');
define('_nF_CURVER', 'Legfrissebb verzi&oacute;.');
define('_nF_NEWVER', '<strong>&Uacute;jabb verzi&oacute; el&eacute;rhet&otilde;!</strong>');
define('_nF_GETNEWVER', 'Let&ouml;lthet&otilde; verzi&oacute;: ');
define('_nF_FEEDCIRCDATAFOR', 'Feed forgalmaz&aacute;si adatok a k&ouml;vetkez&otilde; helyhez:');
define('_nF_TOGGLECOLORSPHERE', 'Sz&iacute;nv&aacute;laszt&oacute;');

# Admin Menu
define('_nukeFEED','nukeFEED');
define('_nF_CONFIG','Configur&aacute;ci&oacute;');
define('_nF_ADMIN','Feeds');
define('_nF_AGGREGATORS', 'Aggregators');
define('_nF_SITEADMIN','Site Administration');

# Configuration
define('_nF_FEEDBURNERSETTINGS', 'FeedBurner Settings');
define('_nF_USE_FEEDBURNER', 'Use FeedBurner?');
define('_nF_FEEDBURNER_URL', 'FeedBurner Base Feed URL');
define('_nF_SHOW_CIRCGRAPH', 'Show Feed Circulation Graph?');
define('_nF_SHOW_FEEDCOUNT', 'Show Feed Count Chicklet?');
define('_nF_FEEDCOUNT_COLORS', 'FeedCount Chicklet Colors');
define('_nF_DISABLEMOD', 'Disable Module');
define('_nF_DISABLEDMODS', 'Disabled Modules');
define('_nF_DISABLE', 'Disable');
define('_nF_ENABLE', 'Enable');

# Feeds
define('_nF_TITLE', 'Feed Title');
define('_nF_CONTENT', 'Content');
define('_nF_CONTENTNAME', 'Content Name');
define('_nF_ORDER', 'Order');
define('_nF_HOWMANY', '# of items');
define('_nF_LEVEL', 'Level');
define('_nF_LID', 'Level ID');
define('_nF_DESC', 'Description');
define('_nF_STATUS', 'Status');
define('_nF_FEEDBURNER_FEED_ADDRESS','FeedBurner Feed Address');

define('_nF_ADD','Add Feed');
define('_nF_EDIT','Edit Feed');
define('_nF_DELETE','Delete Feed');
define('_nF_SAVE', 'Save');

# Aggregators
define('_nF_AGGREGATOR', 'Aggregator');
define('_nF_URL', 'Subscription URL');
define('_nF_URLTEXT', 'URL variables: ');
define('_nF_TAGLINE', 'Subscription Title Tag / Slogan');
define('_nF_IMAGE', 'Image');
define('_nF_ICON', 'Icon');

define('_nF_ADDAGGREGATOR', 'Add Aggregator');
define('_nF_EDITAGGREGATOR', 'Edit Aggregator');
define('_nF_EDIT_SUB','Edit Subscription');
define('_nF_DELETE_SUB','Delete Subscription');

# Selection values
define('_nF_ACTIVE', 'Active');
define('_nF_INACTIVE', 'Inactive');
define('_nF_YES', 'Yes');
define('_nF_NO', 'No');

# Errors
define('_nF_LIDREQUIRED', 'A level ID is required');
define('_nF_TITLEREQUIRED', 'A title is required');
define('_nF_CONTENTREQUIRED', 'A content type is required');
define('_nF_ORDERREQUIRED', 'The order is required');
define('_nF_HOWMANYREQUIRED', 'The number of feed items is required');
define('_nF_LEVELREQUIRED', 'The level is required');
define('_nF_NAMEREQUIRED', 'A subscription name is required');
define('_nF_TAGLINEREQUIRED', 'A tagline is required');
define('_nF_URLREQUIRED', 'A subscription URL is required');

# Help - Menu
define('_nF_CONFIG_HLP', 'Set up FeedBurner settings and disable modules for feed creation.');
define('_nF_ADMIN_HLP', 'Create, activate and deactivate feeds for syndication.');
define('_nF_AGGREGATORS_HLP', 'Define the subscription links to feed aggregators.');
define('_nF_SITEADMIN_HLP', 'Return to PHP-Nuke site administration.');
# Help - Configuration
define('_nF_USE_FEEDBURNER_HLP', 'FeedBurner.com, now owned by Google, provides media
                                  distribution and audience engagement services for blogs and
                                  RSS feeds. Its web-based tools help bloggers, podcasters and
                                  commercial publishers promote, deliver and profit from their
                                  content on the Web. As part of Google, FeedBurner now offers
                                  professional statistics and MyBrand services at no cost.<br /><br />
                                  Note: In addition to this setting, a FeedBurner address must
                                  be specified for a feed to use FeedBurner. Feeds that do not
                                  have a FeedBurner address (defined on Feed administration)
                                  will use nukeFEED to display the feed.');
define('_nF_FEEDBURNER_URL_HLP', 'The default FeedBurner base URL is http://feeds.feedburner.com,
                                  but this can be changed with the free MyBrand service.
                                  Before changing this setting, make sure your MyBrand service
                                  is working correctly.');
define('_nF_SHOW_CIRCGRAPH_HLP', 'Show a feed circulation graph with the feed preview
                                  <br /><img src="images/nukeFEED/showcircgraph.png" alt="'._nF_SHOW_CIRCGRAPH.'" border="0" />');
define('_nF_SHOW_FEEDCOUNT_HLP', 'Show a FeedCount Chicklet like the one below with the subscription links? <br /><a href="http://feeds.feedburner.com/nukeSEO"><img src="http://feeds.feedburner.com/~fc/nukeSEO?bg=A6A6A6&amp;fg=000000&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a>');
define('_nF_FEEDCOUNT_COLORS_HLP', 'Specify the body and text colors used in the FeedCount Chicklet displayed with subscription links.');
define('_nF_DISABLE_HLP', 'Disabling a module simply removes it from the list of available
                           content types. Active feeds defined for content types before
                           disabling a content type will remain active.');
# Help - Feeds
define('_nF_TITLE_HLP', 'The title of the feed should be short and contain important keywords
                         to describe the content of your feed. It may not contain HTML.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_CONTENT_HLP', 'The type of content for the feed.  After selecting the content type,
                           the order and level may be selected.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_CONTENTNAME_HLP', 'The content name is used for sorting and describing groups of
                               content.  If not specified, it will default to the content type.
                               <br /><img src="images/nukeFEED/contentName.gif" alt="" border="0" />');
define('_nF_ORDER_HLP', 'The order of a feed depends on the type of content and may not be
                         selected until the content is selected. Possible order values for news
                         content are recent, popular and rate.  For forums, the order may be
                         recent, most views or most replies.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_HOWMANY_HLP', 'This setting may be selected or entered, and determines the number
                          of items included in the feed.  Most feed readers have no more than
                          20 items.<br /><img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_LEVEL_HLP', 'Different content types have different levels or groups of content,
                         and the feed level may not be selected until the content type is
                         selected. Some content types have categories, topics or forums. All
                         content types may be specified at the module level, and this is the
                         default setting.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_LID_HLP', 'If the selected content level is other than module, an ID that
                       identifies must be specified. This can usually be determined from the
                       content type module. For example, you include only the topics from a
                       specific forum by selecting the forum level and entering the forum ID as
                       the level ID as shown in the example below.  To determine the forum ID,
                       right-click on the forum link to display the properties.<br />
                         <img src="images/nukeFEED/LevelID.png" alt="" border="0" />');
define('_nF_DESC_HLP', 'The feed description is displayed on the list of feeds, but is not
                        required. If specified, it should contain important keywords to
                        describe the content of your feed, like the feed title. Like the feed
                        title, the description may NOT contain HTML.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_STATUS_HLP', 'The status can be used to make feeds and subscriptions active or
                          inactive. Inactive feeds and subscriptions will only be displayed
                          for administrators.');
define('_nF_FEEDBURNER_FEED_ADDRESS_HLP','The FeedBurner feed address is the short name that
                                          uniquely identifies your feed on FeedBurner.com. It
                                          is highlighted in the image below.<br />
                                          <img src="images/nukeFEED/feedburnerAddress.gif" alt="FeedBurner address" />');
# Help - Aggregators
define('_nF_AGGREGATOR_HLP', 'This identifies the name of a feed aggregator and may not have
                              HTML. This name is not displayed, but is used to sort the list of
                              aggregators when displaying subscription links.<br/><br/>
                              An aggregator provides users with a way to display feeds from
                              multiple sources. Most portal sites like Google and Yahoo provide
                              this to registered users.  Feed reader software provides desktop
                              users with the same function.<br/><br/>Although limited to
                              titles with links, PHP-Nuke\'s build-in RSS 0.91 reader allows
                              limited RSS feeds to be displayed in a box.<br/><br/>
                              Social bookmarking sites have increased in popularity, creating
                              additional demand for syndicated feeds.  The list of
                              aggregators installed with nukeFEED is sorted by Google PageRank
                              and Alexa ranking, with only the highest ranking sites included.');
define('_nF_URL_HLP', 'The subscription URL is the link to subscribe to a feed through a
                       web-based aggregator.  It may contain several variables that are
                       replaced by nukeFEED with information from the selected feed including:<br /><ul>
                       <li>{URL} - the URL of the feed, generated by nukeFEED in RSS 2.0 format</li>
                       <li>{NUKEURL} - the site URL defined in administration settings</li>
                       <li>{TITLE} - the title of the feed as defined in nukeFEED</li>
                       </ul>
                       The variables must be CAPITALIZED.  For example, the subscription URL for
                       <img src="images/nukeFEED/subscribe/myMSN.gif" alt="MyMSN" border="0" /> is: http://my.msn.com/addtomymsn.armx?id=rss&amp;ut={URL}&amp;ru={NUKEURL}
                       <br />and for <img src="images/nukeFEED/subscribe/protopage.gif" alt="Protopage" border="0" />
                       is: http://www.protopage.com/add-button-site?url={URL}&amp;label={TITLE}&amp;type=feed');
define('_nF_TAGLINE_HLP', 'The Subscription Title Tag / Slogan is the text that appears in the
                           TITLE tag for the subscription link and ALT tag for the subscription
                           image.  It is usually defined by the aggregator, and may NOT have HTML.');
define('_nF_IMAGE_HLP', 'The link to an image used to represent the aggregator may be relative
                         (if the image file is on the site) or absolute (for external images).
                         The image size should be no larger than 96 pixels wide by 20 pixels high.');
define('_nF_ICON_HLP', 'The icon is used for social bookmarking links.  The image size should
                        be no larger than 20 pixels wide by 20 pixels wide.');

?>