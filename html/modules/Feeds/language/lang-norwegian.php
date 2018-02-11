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
define('_FEEDS','Feeds');
define('_FEEDS_ADMIN','Administrering av Feeds');
define('_nF_FEEDLIST','Feeds Liste');
define('_FEED_PREVIEW','Forh&aring;ndsvisning av Feed');
define('_nF_SUBSCRIBE','Abonner');
define('_nF_NEWS', 'Nyheter');
define('_nF_FORUMS', 'Forumer');
define('_nF_ADDCONTENT', 'Velg type');
define('_nF_CURVER', 'Du har siste versjon.');
define('_nF_NEWVER', '<strong>En ny versjon er tilgjengelig!</strong>');
define('_nF_GETNEWVER', 'Last ned ny versjon ');
define('_nF_FEEDCIRCDATAFOR', 'Sirkulerende Feed data for');
define('_nF_TOGGLECOLORSPHERE', 'Farge plukker av/p&aring;');

# Admin Menu
define('_nukeFEED','nukeFEED');
define('_nF_CONFIG','Konfigurering');
define('_nF_ADMIN','Feeds');
define('_nF_AGGREGATORS', 'Feedsamlinger');
define('_nF_SITEADMIN','ACP');

# Configuration
define('_nF_FEEDBURNERSETTINGS', 'FeedBurner Innstillinger');
define('_nF_USE_FEEDBURNER', 'Bruke FeedBurner?');
define('_nF_FEEDBURNER_URL', 'FeedBurner standard Feed nettadresse (URL)');
define('_nF_SHOW_CIRCGRAPH', 'Vise FeedBurner statistisk graf?');
define('_nF_SHOW_FEEDCOUNT', 'Vise FeedCount Chicklet?');
define('_nF_FEEDCOUNT_COLORS', 'FeedCount Chicklet farger');
define('_nF_DISABLEMOD', 'Deaktivere modul');
define('_nF_DISABLEDMODS', 'Deaktivere moduler');
define('_nF_DISABLE', 'Deaktivere');
define('_nF_ENABLE', 'Aktivere');

# Feeds
define('_nF_TITLE', 'Feed Tittel');
define('_nF_CONTENT', 'Innholdstype');
define('_nF_CONTENTNAME', 'Navn for innhold');
define('_nF_ORDER', 'Rekkef&oslash;lge');
define('_nF_HOWMANY', 'Antall punkter');
define('_nF_LEVEL', 'Niv&aring;');
define('_nF_LID', 'Niv&aring; ID');
define('_nF_DESC', 'Beskrivelse');
define('_nF_STATUS', 'Status');
define('_nF_FEEDBURNER_FEED_ADDRESS','FeedBurner Feed adresse');

define('_nF_ADD','Legg til Feed');
define('_nF_EDIT','Editere Feed');
define('_nF_DELETE','Slette Feed');
define('_nF_SAVE', 'Ok! Lagre');

# Aggregators
define('_nF_AGGREGATOR', 'FEED samling');
define('_nF_URL', 'Abonnements-adresse (URL)');
define('_nF_URLTEXT', 'Nettadresse (URL) variabler: ');
define('_nF_TAGLINE', 'Abonnementets Tittel/Slagord');
define('_nF_IMAGE', 'Bilde');
define('_nF_ICON', 'Ikon');

define('_nF_ADDAGGREGATOR', 'Legg til FEED samlinger');
define('_nF_EDITAGGREGATOR', 'Editer FEED samlinger');
define('_nF_EDIT_SUB','Editere Abonnement');
define('_nF_DELETE_SUB','Slette Abonnement');

# Selection values
define('_nF_ACTIVE', 'Aktiv');
define('_nF_INACTIVE', 'Ikke aktiv');
define('_nF_YES', 'Ja');
define('_nF_NO', 'Nei');

# Errors
define('_nF_LIDREQUIRED', 'Niv&aring; ID er p&aring;krevd');
define('_nF_TITLEREQUIRED', 'Tittel er p&aring;krevd');
define('_nF_CONTENTREQUIRED', 'Innholdstype er p&aring;krevd');
define('_nF_ORDERREQUIRED', 'Rekkef&oslash;lge er p&aring;krevd');
define('_nF_HOWMANYREQUIRED', 'Antall Feed punkter er p&aring;krevd');
define('_nF_LEVELREQUIRED', 'Niv&aring; er p&aring;krevd');
define('_nF_NAMEREQUIRED', 'Abonnementsnavn er p&aring;krevd');
define('_nF_TAGLINEREQUIRED', 'Emneordlinje er p&aring;krevd');
define('_nF_URLREQUIRED', 'Abonnements-adresse (URL) er p&aring;krevd');

# Help - Menu
define('_nF_CONFIG_HLP', 'Sette opp FeedBurner instillinger og deaktivere moduler for feed skapelse.');
define('_nF_ADMIN_HLP', 'Lag, aktiver og deaktiver feeds for oppf&oslash;lging.');
define('_nF_AGGREGATORS_HLP', 'Definer abonnements-linker til feed samlinger.');
define('_nF_SITEADMIN_HLP', 'Tilbake til RavenNuke(tm)\'s Administrator Control Panel');
# Help - Configuration
define('_nF_USE_FEEDBURNER_HLP', 'FeedBurner.com (n&aring; eid av Google) tilbyr mediadistribusjon
                                  og publikumsdeltagende tjenester for blogger og
                                  RSS feed\'er. Deres web-baserte verkt&oslash;yer hjelper bloggere, podcaster\'ere og
                                  kommersielle annons&oslash;rer &aring; promotere, levere og profittere fra deres
                                  innhold p&aring; nettet. Som en del av Google, tilbyr n&aring; FeedBurner
                                  professjonelle statistikker og MyBrand tjenester helt gratis.<br /><br />
                                  Merk: I tillegg til disse instillingene, m&aring; en FeedBurner addresse (URL)
                                  spesifiseres for feed\'en for at FeedBurner skal kunne bruke den. Feeds som ikke
                                  har en FeedBurner adresse (definert i Feed administreringen)
                                  vil bruke nukeFEED til &aring; vise feed\'en.');
define('_nF_FEEDBURNER_URL_HLP', 'Standard FeedBurner nettadresse (URL) er: http://feeds.feedburner.com<br />
                                  Denne kan gjerne byttes ut med gratis MyBrand tjeneste.<br />
                                  F&oslash;r du endrer denne instillingen m&aring; du forsikre deg om at din MyBrand tjeneste
                                  fungerer korrekt.');
define('_nF_SHOW_CIRCGRAPH_HLP', 'Vise Feed\'s statistikk-graf sammen med forh&aring;ndsvisningen.
                                  <br /><img src="images/nukeFEED/showcircgraph.png" alt="'._nF_SHOW_CIRCGRAPH.'" border="0" />');
define('_nF_SHOW_FEEDCOUNT_HLP', 'Vise FeedCount Chicklet som den nedenfor sammen med abonnements linken? <br /><a href="http://feeds.feedburner.com/nukeSEO"><img src="http://feeds.feedburner.com/~fc/nukeSEO?bg=A6A6A6&amp;fg=000000&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a>');
define('_nF_FEEDCOUNT_COLORS_HLP', 'Spesifiser bakgrunns- og tekstfarge for FeedCount Chicklet\'en.');
define('_nF_DISABLE_HLP', '&Aring; deaktivere en modul vil simpelthen fjerne den fra listen over tilgjengelige
                           innholdstyper. Aktive feeds definert for innholdstyper, f&oslash;r deaktivering av en
                           innholdstype vil forbli aktiv.');
# Help - Feeds
define('_nF_TITLE_HLP', 'Feed\'ens tittel b&oslash;r v&aelig;re kort og konsis med emneord som beskriver
                         innholdet i feed\'en. Tittelen f&aring;r ikke inneholde HTML-koder.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_CONTENT_HLP', 'Innholdstype for feed\'en. Etter &aring; ha valgt innholdstype, kan
                           rekkef&oslash;lge og niv&aring; velges.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_CONTENTNAME_HLP', 'Innholdsnavnet brukes for sortering og beskrivelse av gruppe innhold.
                               content.  Om ikke spesifisert vil den standardiseres til innholdstypen.
                               <br /><img src="images/nukeFEED/contentName.gif" alt="" border="0" />');
define('_nF_ORDER_HLP', 'Feed\'enes rekkef&oslash;lge avhenger av innholdstype, og kan derfor kanskje ikke
                         velges f&oslash;r innholdet er blitt valgt. Mulige sorteringsverdier for Nyheter
                         er nyest, poul&aelig;r og rangert. For forumer er sorteringsverdiene nyest,
                         mest vist og flest besvarelser.<br />
                         <img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_HOWMANY_HLP', 'Denne instillingen kan velges fra boksen, eller tastes inn manuelt,
                          og angir antall punkter inkludert i feed\'en. De fleste feed-leserne
                          har ikke mer enn 20 punkter.<br /><img src="images/nukeFEED/addafeed.gif" alt="" border="0" />');
define('_nF_LEVEL_HLP', 'De forskjellige innholdstypene har forskjellige niv&aring;er eller grupper
                         av innhold, og feed niv&aring;et b&oslash;r ikke velges f&oslash;r det er valgt innholdstype.
                         Noen innholdstyper har kategorier, temaer eller forumer. Alle innholdstyper
                         kan spesifiseres via modul niv&aring;et, og dette er standard instillingen.<br />
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