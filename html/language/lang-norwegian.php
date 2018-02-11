<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id: lang-norwegian.php 3956 2013-02-09 05:02:12Z palbin $
 * @copyright (c) 2013 Raven Web Services, LLC
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This is the language module with all the system messages
 * If you make a translation, please go to: http://www.ravenphpscripts.com and post your translation in our forums
 *
 * You need to change the second quoted phrase, not the capitalised one!
 *
 * If you need to use double quotes (") remember to add a backslash (\),
 * so your entry will look like: This is \"double quoted\" text.
 * And, if you use HTML code, please double check it.
*/

// Used in mainfile.php for RavenNuke(tm)
if(!defined('_RNINSTALLFILESFOUND')) { define('_RNINSTALLFILESFOUND','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>RavenNuke&trade; Setup/Configuration Tool</title><meta name="rating" content="general"><meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2013 by http://www.ravenphpscripts.com"></head><body><br /><br /><div class="text-center"><a href="http://www.ravenphpscripts.com" title="Raven Web Service: Quality Web Hosting And Web Support"><img src="images/RavenWebServices_Banner.gif" border="0" alt="" /></a>&trade;<br /><br /><table width="75%" border="1"><tr><td align="center" style="color:blue;font-weight:bold;">INSTALLATION folder detected - To continue would expose your site to damage.<br /><br />Either delete the INSTALLATION folder or rename it in order to proceed.</td></tr></table></div>'); }
// for Anagram, Milo and Karate theme support (header)
if(!defined('_TOPICS')) { define('_TOPICS','Temaer'); }
if(!defined('_ALLTOPICS')) { define('_ALLTOPICS','Alle Temaer'); }
if(!defined('_HELLO')) { define('_HELLO','Hallo'); }
// for fisubice
define('_FSIADMINMENU','ACP');
define('_FSIYOURACCOUNT','Din Brukerkonto');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED', 'Nektet Adgang');
define('_ACTIVEBUTNOTSEE','(Aktiv men usynlig link)');
define('_ADD','Legg til');
define('_ADDAHOME','Legg til en Modul p&aring; F&oslash;rstesiden');
define('_ADDITIONALYGRP','Denne Modulen tilh&oslash;rer Brukergruppen');
define('_ADMIN','Adminisrator');
define('_ADMNOTSUB','Bruker er IKKE Abonnent');
define('_ADMSUB','Abonnerende Bruker!');
define('_ADMSUBEXPIREIN','Abonnementet utl&oslash;per om:');
if (!defined('_ALL')) define('_ALL','Alle');
define('_ALLCATEGORIES','Alle Kategorier');
define('_ALLOWEDHTML','Tillatte HTML-koder:');
define('_APRIL','April');
define('_AREYOUSURE','<span class="italic">Har du lagt inn nett-adresser (URL\'er) i teksten? V&aelig;r i s&aring; fall vennlig &aring; sjekke at de er riktig skrevet og at linkene virker.</span>');
define('_ASREGISTERED','Har du ikke Brukerkonto p&aring; siden v&aring;r? Det er helt gratis &aring; <a href="modules.php?name=Your_Account&amp;op=new_user">Registrere</a> seg, og du f&aring;r dessuten tilgang til alt som er utilgjengelig for annonyme bes&oslash;kende. Du kan f.eks. sende inn artikkler, poste egne innlegg, laste ned filer, delta aktivt i Forumer - pluss mye mye mer...');
define('_ASSOTOPIC','Tilknyttede Temaer');
define('_AUGUST','August');
define('_BANTHIS','Utesteng denne IP-adressen');
define('_BBFORUMS','Forumer');
if (!defined('_BCHGTHEME')) define('_BCHGTHEME','Bytte Utseende');
define('_BIGSTORY','Dagens mest leste Artikkel:');
define('_BLATEST','Siste');
define('_BLOCKPROBLEM','<div class="text-center">Det er et problem med denne Blokken for &oslash;yeblikket.</div>');
define('_BLOCKPROBLEM2','<div class="text-center">Det er ikke noe innhold for denne Blokken for &oslash;yeblikket.</div>');
define('_BMEM','Medlemmer');
define('_BMEMP','Medlemskap');
define('_BON','Innlogget n&aring;');
define('_BOVER','Totalt');
define('_BPM','Private Meldinger');
if (!defined('_BPREFS')) define('_BPREFS','Preferanser');
define('_BREAD','Leste');
define('_BREG','Registrer ny Bruker');
define('_BROADCAST','Publiser Offentlig Melding');
define('_BROADCASTFROM','Offentlig Melding fra');
define('_BROKENDOWN','Brutte Filnedlastinger');
define('_BROKENLINKS','Brutte Linker');
define('_BTD','Nye idag');
define('_BTT','Totalt');
define('_BUNREAD','Uleste');
define('_BVIS','Bes&oslash;kende');
define('_BVISIT','P&aring; siden n&aring;');
define('_BWEL','Velkommen');
define('_BY','av');
define('_BYD','Nye ig&aring;r');
if (!defined('_CANCEL')) define('_CANCEL','Avbryt');
if (!defined('_CATEGORY')) define('_CATEGORY','Kategori');
define('_COMMENTS','kommentarer');
define('_CONTRIBUTEDBY','Bidragsyter');
define('_CURRENTLY','Det er for &oslash;yeblikket,');
if (!defined('_DATE')) define('_DATE','Dato');
define('_DATESTRING','%A %d %B - %Y (kl. %H:%M');
define('_DATESTRING2','%A %d %B - %Y');
define('_DECEMBER','Desember');
define('_DELETE','Slette');
define('_EDIT','Editere');
define('_EXPIREIN','Utl&oslash;per om');
define('_EXPIRELESSHOUR','Utl&oslash;per om mindre enn 1 time');
define('_FEBRUARY','Februar');
define('_FORADMINTESTS','(for Admin tester)');
define('_GCALENDAR_EVENTS', 'Kalender-evenementer');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Tilbake</a> ]');
define('_GOBACK2','Tilbake');
define('_GUESTS','gjest(er) og');
define('_HASEXPIRED','har n&aring; utl&oslash;pt.');
define('_HERE','her');
define('_HOME','Hjem');
define('_HOMEPROBLEM','Det er et stort problem her: vi har ikke noen Hjemmeside!!!');
define('_HOMEPROBLEMUSER','Det er et problem med Hjemmesiden for &oslash;yeblikket. Vennligst sjekk igjen om en liten stund.');
define('_HOPESERVED','H&aring;per &aring; ha gitt deg en tilfredsstillende service...');
define('_HOUR','Time');
define('_HOURS','Timer');
define('_HREADMORE','Les hele Artikkelen...');
define('_HTTPREFERERS','HTTP henvisninger');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Sikkerhetskoden er feil. Vennligst g&aring; tilbake og gjenta koden n&oslash;yaktig slik den vises...');
define('_IN','i'); //0000960
define('_INVISIBLEMODULES','Usynlige Moduler');
define('_JANUARY','Januar');
define('_JOURNAL','Journal');
define('_JSWARN','Denne siden fungerer best med <a href="http://www.activatejavascript.org">Javascript</a>.');
define('_JULY','Juli');
define('_JUNE','Juni');
if (!defined('_LANGUAGE')) define('_LANGUAGE','Språk');
define('_LASTIP','Siste Brukers IP:');
define('_LOGIN','Logg inn');
define('_LOGOUT','Logg ut');
define('_MARCH','Mars');
define('_MAY','Mai');
define('_MEMBERS','medlem(mer) Online.');
define('_MENUFOR','Meny for');
define('_MODREQDOWN','Moderer Filnedlastinger');
define('_MODREQLINKS','Moderer Linker');
define('_MODULENOTACTIVE','Beklager, denne Modulen er ikke aktiv!');
define('_MODULESADMINS', 'Vi beklager, denne delen av siden v&aring;r er kun for <span class="italic">Administratorer</span>.<br /><br />');
define('_MODULESSUBSCRIBER','Vi beklager, denne delen av siden v&aring;r er kun for <span class="italic">Abonnerende Brukere</span>.');
define('_MODULEUSERS', 'Vi beklager, denne delen av siden v&aring;r er kun for <span class="italic">Registrerte Brukere</span>.<br /><br />Du kan registrere deg gratis ved &aring; klikke <a href="modules.php?name=Your_Account&amp;op=new_user">her</a>, og da f&aring;r du<br />ubegrenset tilgang til denne og tilh&oslash;rende sider. Takk.<br /><br />');
define('_MORENEWS','Mere i Nyhetsseksjonen');
define('_MULTILINGUALOFF','We\'re sorry but there are no language translations available. Please contact the Webmaster for further help.');
define('_MVIEWADMIN','Vis: Kun Administartorer');
define('_MVIEWALL','Vis: Alle Bes&oslash;kende');
define('_MVIEWANON','Vis: Kun Annonyme Brukere');
define('_MVIEWSUBUSERS','Vis: Kun Abonnerende Brukere');
define('_MVIEWUSERS','Vis: Kun Registrerte Brukere');
define('_NEWPMSG','Nye Private Meldinger');
define('_NICKNAME','Brukernavn');
define('_NO','Nei');
define('_NOACTIVEMODULES','Inaktive Moduler');
define('_NOBIGSTORY','Det finnes ingen St&oslash;rste Nyhet for idag, enn&aring;...');
define('_NONE','Ingen');
define('_NOTE','Merk:');
define('_NOTSUB','Du Abonnerer ikke p&aring;');
define('_NOVEMBER','November');
define('_NOW','n&aring;!');
define('_OCTOBER','Oktober');
if (!defined('_OF')) define('_OF','av');
define('_OLDERARTICLES','Eldre Artikkler');
define('_ON','den');
define('_OR','eller');
define('_PAGEGENERATION','Sidegenerering:');
define('_PAGESVIEWS','sidevisninger siden');
define('_PAGINATOR_TOTALITEMS','antall temaer');
define('_PAGINATOR_PAGE','Side');
define('_PAGINATOR_PAGES','Sider');
define('_PAGINATOR_GO','G&aring;');
define('_PAGINATOR_GOTOPAGE','G&aring; til side');
define('_PAGINATOR_GOTONEXT','Neste side');
define('_PAGINATOR_GOTOPREV','Forrige side');
define('_PAGINATOR_GOTOFIRST','F&oslash;rste side');
define('_PAGINATOR_GOTOLAST','Siste side');
define('_PASSWORD','Passord');
define('_PASSWORDLOST','Mistet Passordet?');
define('_PASTARTICLES','Tidligere Artikkler');
define('_PCOMMENTS','Kommentarer:');
define('_POLLS','Avstemminger');
define('_POSTEDBY','Postet av');
define('_POSTEDON','Postet den');
define('_PREVIEW','Preview');
define('_PRIVATEMSG','private melding(er).');
define('_READMYJOURNAL','Les Journalen min');
define('_READS','lesninger');
define('_REGISTERED','Registrerte');
define('_RESTRICTEDAREA', 'Du pr&oslash;ver &aring; f&aring; tilgang til en side som er tilgjengelig kun for Registrerte Brukere eller en bestemt Brukergruppe.');
define('_RESULTS','Resultater');
define('_RN_FOOTER_CREDITS','<div class="text-center"><br /><span class="small">:: fisubice phpbb2 style by <a href="http://www.forumimages.com/">Daz</a> :: PHP-Nuke theme by <a href="http://www.nukemods.com">www.nukemods.com</a> ::</span></div>'.'<div class="text-center"><span class="small">:: fisubice Theme Recoded To 100% W3C CSS &amp; HTML 4.01 Transitional &amp; XHTML 1.0 Transitional Compliance by RavenNuke&amp;trade; TEAM :: </span></div>'.'<div class="text-center"><br /><span class="small">:: <a href="http://jigsaw.w3.org/css-validator/" target="_blank" title="W3C CSS Compliance Validation"><img src="themes/fisubice/images/w3c_css.gif" width="62" height="22" border="0" alt="W3C CSS Compliance Validation" /></a> :: <a href="http://validator.w3.org/" title="W3C HTML 4.01 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xxx.gif" alt="W3C HTML 4.01 Transitional Compliance Validation" width="62" height="22" border="0" /></a> :: <a href="http://validator.w3.org/" title="W3C XHTML 1.0 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xhtml.gif" alt="W3C XHTML 1.0 Transitional Compliance Validation" width="62" height="22" border="0" /></a> ::</span></div>'.'<br />'."\n");
define('_RSSPROBLEM','Det er for &oslash;yeblikket problemer med Overskriftene fra denne siden');
define('_SBDAYS','dager');
define('_SBHOURS','timer');
define('_SBMINUTES','minutter');
define('_SBSECONDS','sekunder');
define('_SBYEAR','&aring;r');
define('_SBYEARS','&aring;r');
define('_SEARCH','S&oslash;k');
define('_SECONDS','Sekunder');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Sikkerhetskode');
define('_SELECTGUILANG','Velg Spr&aring;k:');
define('_SELECTLANGUAGE','Velg Spr&aring;k');
define('_SEPTEMBER','September');
define('_SUBEXPIRED','Ditt Abonnement har utl&oslash;pt');
define('_SUBEXPIREIN','Ditt Abonnement utl&oslash;per om:');
define('_SUBFROM','Du kan Abonnere herfra');
define('_SUBMISSIONS','Innsendte bidrag');
define('_SUBRENEW','Hvis du vil fornye ditt Abonnement v&aelig;r vennlig &aring; g&aring; til:');
define('_SUBSCRIBER','abonnent');
define('_SUBSCRIPTIONAT','Dette er en automatisert melding for &aring; gj&oslash;re deg oppmerksom p&aring; at ditt Abonnement p&aring;');
define('_SURVEY','Sp&oslash;rreunders&oslash;kelse');
define('_TOPIC','Tema');
define('_TURNOFFMSG','Sl&aring; av Offentlige Meldinger');
define('_TYPESECCODE','Gjenta koden');
define('_UDOWNLOADS','Filnedlastinger');
define('_UMONTH','M&aring;ned');
define('_UNLIMITED','Ubegrenset');
define('_USERS','Brukere');
define('_VOTE','Stem');
define('_VOTES','Stemmer');
define('_WAITINGCONT','Ventende innhold');
define('_WELCOMETO','Velkommen til');
define('_WERECEIVED','Vi har hatt');
define('_WLINKS','Ventende Linker');
define('_WREVIEWS','Ventende Anmeldelser');
define('_WRITES','skriver');
define('_YEAR','&Aring;r');
define('_YES','Ja');
define('_YOUARE','Er du sikker');
define('_YOUAREANON','Du er en Annonym Bruker. Du kan registrere deg gratis <a href="modules.php?name=Your_Account&amp;op=new_user">her</a>!');
define('_YOUARELOGGED','Du er logget inn som');
define('_YOUHAVE','Du har');
define('_YOUHAVEONEMSG','Du har 1 ny Privat Melding');
define('_YOUHAVEPOINTS','Poeng du har opptjent ved &aring; delta med innhold til siden:');

define('_RWS_WIW_UNABLECONNECTSERVER','Klarer ikke &aring; kopple opp mot Server. ');
define('_RWS_WIW_UNABLECONNECTDB','Klarer ikke &aring; kopple opp mot Databasen. ');
define('_RWS_WIW_UNABLETOREMOVE','Klarer ikke &aring; Fjerne.');
define('_RWS_WIW_UNABLETOINSERT','Klarer ikke &aring; Sette inn');
define('_RWS_WIW_MYSQLSAID','MySQL rapporterer');
define('_RWS_WIW_TITLE','Hvem er Hvor');
define('_RWS_WIW_GUESTSONLINE','Gjest(er) Online');
define('_RWS_WIW_GUESTS','gjest(er)');
define('_RWS_WIW_HOME','Hjem');
define('_RWS_WIW_USERSONLINE','Bruker(e) Online');
define('_RWS_WIW_REFRESH','oppdateringsintervall i sekunder');
////
/*****************************************************/
/* Function to translate Datestrings                 */
/*****************************************************/

function translate($phrase) {
	 switch($phrase) {
	case 'xdatestring':  $tmp = '%A, %B %d @ %T %Z'; break;
	case 'linksdatestring': $tmp = '%d-%b-%Y'; break;
	case 'xdatestring2': $tmp = '%A, %B %d'; break;
	default:    $tmp = '$phrase'; break;
	 }
	 return $tmp;
}

?>