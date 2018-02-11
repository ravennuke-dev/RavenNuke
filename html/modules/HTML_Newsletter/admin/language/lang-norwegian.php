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
/*************************************************************************
* All attempts are made to place defines into the Function and Section
* on the screen where it is used as well as in the order of placement on
* the screen reading left-to-right and then top-down.  In cases where a
* define is used on multiple screens, it may only be defined once, so the
* first Function/Section: will have the define in it.
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/
define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'GO BACK');
define('_MSNL_COM_LAB_ERRMSG', 'ERROR MSG');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Hover your cursor over these icons for detailed '
	. 'help text');
define('_MSNL_COM_LNK_GOBACK', 'Click to go back to previous page');
define('_MSNL_COM_ERR_SQL', 'ST&Oslash;TTE P&Aring; FEIL I SQL');
define('_MSNL_COM_ERR_MODULE', 'FEIL I MODULEN');
define('_MSNL_COM_ERR_VALMSG', 'F&Oslash;LGENDE FELTER FEILET GYLDIGHETSSJEKKEN');
define('_MSNL_COM_ERR_VALWARNMSG', 'F&Oslash;LGENDE FELTER HADDE ADVARSLER');
define('_MSNL_COM_ERR_DBGETCFG', 'FEIL; Klarte ikke &aring; hente inn informasjon om Modul-konfigurasjonen!');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Yes, that is how it is done!');
/************************************************************************
* Function: General Use Defines
************************************************************************/
define('_MSNL_COM_LAB_MODULENAME', 'HTML Nyhetsbrev');
define('_MSNL_LAB_ADMIN', 'Administrering');
//Module Menu Labels and Link Titles
define('_MSNL_LAB_CREATENL', 'Lag&amp;nbsp;Nyhetsbrev');
define('_MSNL_LAB_MAINCFG', 'Hoved-konfigurering');
define('_MSNL_LAB_CATEGORYCFG',		 'Kategori-konfigurering');
define('_MSNL_LAB_MAINTAINNLS', 'Vedlikeholde&amp;nbsp;Nyhetsbrev');
define('_MSNL_LAB_SENDTESTED', 'Sende&amp;nbsp;testet Nyhetsbrev');
define('_MSNL_LAB_SITEADMIN', 'ACP');
define('_MSNL_LAB_NLARCHIVES', 'Arkiver');
define('_MSNL_LAB_NLDOCS', 'Online&amp;nbsp;Dokumentasjon');
define('_MSNL_LNK_CREATENL', 'Sett opp et nytt Nyhetsbrev');
define('_MSNL_LNK_MAINCFG', 'Konfigurere modul-innstillinger');
define('_MSNL_LNK_CATEGORYCFG', 'Konfigurere kategorilisten');
define('_MSNL_LNK_MAINTAINNLS', 'Vedlikeholde eksisterende nyhetsbrev');
define('_MSNL_LNK_SENDTESTED', 'Send ut det sist testede Nyhetsbrevet');
define('_MSNL_LNK_SITEADMIN', 'G&aring; til sidens Administrative Control Panel');
define('_MSNL_LNK_NLARCHIVES', 'G&aring; til Arkivet for alle Nyhetsbrevene');
define('_MSNL_LNK_NLDOCS', 'Les HTML Newsletter\'s online dokumentasjon');
define('_MSNL_ERR_NOTAUTHORIZED', 'Du har ikke adgang til &aring; administrere denne Modulen');
//Common use Defines
define('_MSNL_COM_LAB_ACTIONS', 'Handlinger');
define('_MSNL_COM_LAB_ACTIVE', 'Aktiv');
define('_MSNL_COM_LAB_ADD', 'Legg til');
define('_MSNL_COM_LAB_ALL', 'Alle');
define('_MSNL_COM_LAB_GO', 'G&aring; til');
define('_MSNL_COM_LAB_INACTIVE', 'Inaktiv');
define('_MSNL_COM_LAB_LANG', 'Spr&aring;k');
define('_MSNL_COM_LAB_NO', 'Nei');
define('_MSNL_COM_LAB_PREVIEW', 'Forh&aring;ndsvis');
define('_MSNL_COM_LAB_SAVE', 'Lagre');
define('_MSNL_COM_LAB_SHOW_ALL', '**Vis alle**');
define('_MSNL_COM_LAB_SEND', 'Send');
define('_MSNL_COM_LAB_VERSION', 'Versjon');
define('_MSNL_COM_LAB_YES', 'Ja');
define('_MSNL_COM_LNK_ADD', 'Klikk for &aring; legge til dataene ovenfor');
define('_MSNL_COM_LNK_CANCEL', 'Kanseller overf&oslash;ringen');
define('_MSNL_COM_LNK_CONTINUE', 'Fortsett overf&oslash;ringen');
define('_MSNL_COM_LNK_SAVE', 'Klikk for &aring; lagre endringene i dataene ovenfor');
define('_MSNL_COM_LNK_SEND', 'Send Nyhetsbrev');
define('_MSNL_COM_LNK_PREVIEW', 'Forh&aring;ndsvis og sjekk Nyhetsbrev');
define('_MSNL_COM_ERR_MSG', 'FEILMELDING');
define('_MSNL_COM_ERR_DBGETCATS', 'Var ikke istand til &aring; hente inn Kategorilisten');
define('_MSNL_COM_ERR_FILENOTEXIST', 'Filen eksisterer ikke');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', 'Klarte ikke &aring; lagre Nyhetsbrev-filen. Sjekk at rettighetene til Arkiv-mappen er satt til (CHMOD) 777');
define('_MSNL_COM_ERR_DBGETPHPBB', 'Er ikke istand til &aring; hente inn informasjon om konfigurasjonen til phpBB forumet');
define('_MSNL_COM_ERR_DBGETRECIPIENTS', 'Er ikke istand til &aring; hente inn antall mottakere for:');
define('_MSNL_COM_MSG_WARNING', 'Advarsel!');
define('_MSNL_COM_MSG_UPDSUCCESS', 'Oppdateringen var vellykket!');
define('_MSNL_COM_MSG_ADDSUCCESS', 'Tilleggelsen var vellykket!');
define('_MSNL_COM_MSG_DELSUCCESS', 'Slettingen var vellykket!');
define('_MSNL_COM_MSG_REQUIRED', 'P&aring;krevde felter m&aring; fylles ut');
define('_MSNL_COM_MSG_POSNONZEROINT', 'Krever et positivt heltall (ikke null)');
define('_MSNL_COM_HLP_ACTIONS', 'Hover the cursor '
	. 'over each icon below to see what action is going to be taken if it is clicked.');
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'View copyright and credits');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/
//Section: Letter
define('_MSNL_ADM_LAB_LETTER', 'Nyhetsbrev');
define('_MSNL_ADM_LAB_TOPIC', 'Tema/tittel');
define('_MSNL_ADM_LAB_SENDER', 'Avsenders navn');
define('_MSNL_ADM_LAB_NLSCAT', 'Kategori');
define('_MSNL_ADM_LAB_TEXTBODY', 'Nyhetsbrevets tekst');
define('_MSNL_ADM_LAB_HTMLOK', '(HTML-tag\'er er tillatt)');
define('_MSNL_ADM_HLP_TOPIC', 'Denne teksten erstatter {EMAILTOPIC} tag\'en i den '
	.'valgte malen.Denne tag\'en er vanligvis p&aring; en linje sammen med andre tag\'er, og det vil v&aelig;re '
	.'en god id&egrave; &aring; la den v&aelig;re kort og presis - f.eks. 40 tegn eller mindre.Kun f&oslash;lgende '
	.'HTML-tag\'er er tillatt i dette feltet: &amp; lt;b&amp; gt; &amp; lt;i&amp; gt; &amp; lt;u&amp; gt;.');
define('_MSNL_ADM_HLP_SENDER', 'Denne teksten erstatter {SENDER} tag\'en i den '
	.'valgte malen.Denne tag\'en er vanligvis p&aring; en linje sammen med andre tag\'er, og det vil v&aelig;re '
	.'en god id&egrave; &aring; la den v&aelig;re kort og presis - f.eks. 20 tegn eller mindre.Kun f&oslash;lgende '
	.'HTML-tag\'er er tillatt i dette feltet: &amp; lt;b&amp; gt; &amp; lt;i&amp; gt; &amp; lt;u&amp; gt;.');
define('_MSNL_ADM_HLP_NLSCAT', 'Du kan enkelt velge Nyhetsbrev-kategorien som du vil plassere '
	.'dette Nyhetsbrevet i.Nyhetsbrev-kategorier kan brukes for &aring; organisere nettsidens Nyhetsbrever '
	.'i spesifiserte n&oslash;kkelemne-omr&aring;der.Nyhetsbrever kan listes opp under sine respektive '
	.'kategorier ved &aring; bruke en konfigureringsbryter under adminfunksjonen Hoved-konfigurering.');
define('_MSNL_ADM_HLP_TEXTBODY', 'Det er her hovedinnholdet/teksten i Nyhetsbrevet '
	.'vil v&aelig;re. Det mest fornuftige vil v&aelig;re &aring; skrive HTML innholdet ditt i en god WYSIWYG '
	.'editor, slik at du ser hvordan det blir seende ut, og deretter klippe-og-lime HTML teksten inn i dette tekst-'
	.'omr&aring;det. Denne HTML teksten vil erstatte {TEXTBODY} tag\'en i den valgte malen.<br /><br />'
	.'HTML-tag\'er er tillatt, men det vil v&aelig;re klokt &aring; tenke p&aring; dine mottakeres epost-lesere '
	.'og nettlesere (for arkivene) for &aring; sikre best mulig resultat for alle.<br /><br /> '
	.'N&aring; det gjelder lange Nyhetsbrev, vil det v&aelig;re lurt &aring; ta i bruk anker-tag\'er for &aring; <span class="thick">markere</span> '
	.'f.eks. avsnitt.Gi dem beskrivende navn og sjekk av <span class="thick">Inkludere tabell-innhold</span> '
	.'i sjekkboksen under og disse ankerene vil omgj&oslash;res til linker inne i Tabell-innholdet '
	.'inne i Nyhetsbrevet ditt! <br /><br />Du kan f.eks. bruke: '
	.'<span class="thick">&amp; lt;a name=\'Avsnitt 1\'&amp; gt;&amp; lt;/a&amp; gt;</span>. <span class="thick">MERK:</span> M&aring; v&aelig;re n&oslash;yaktig som vist '
	.'med dobble g&aring;se&oslash;yne og avsluttende anker-tag! Dette eksempelet vil produsere en link med navnet '
	.'<span class="thick">Avsnitt 1</span> inne i tabell-innholdet, og n&aring;r linken klikkes p&aring; vil vedkommende bli f&oslash;rt '
	.'direkte til dette ankeret inne i teksten.');
//Section: Templates
define('_MSNL_ADM_LAB_TEMPLATES', 'Maler');
define('_MSNL_ADM_LAB_CHOOSETMPLT', 'Velg en mal');
define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'Klikk for &aring; se eksempelbilde av malen');
define('_MSNL_ADM_HLP_TEMPLATES', 'Listen nedenfor er opprettet fra de n&aring;v&aelig;rende '
	.'malene som er lagret i modules/HTML_Newsletter/templates/ mappen p&aring; nettsiden din. '
	.'Hvis du velger &aring; bruke <span class="thick">ingen mal</span>, s&aring; vil systemet kun sende en epost til dine mottakere '
	.'med den teksten som du har skrevet inn i <span class="thick">Nyhetsbrevets tekst</span> feltet.<br /><br />'
	.'For &aring; lage et Nyhetsbrev ut fra en av malene, m&aring; du f&oslash;rst velge en mal fra listen.For &aring; se eksempeler p&aring; '
	.'hvordan valgte Nyhetsbrev vil se ut, klikk p&aring; <span class="thick">Vis</span> ikonet til h&oslash;yre for '
	.'malens navnetekst.<br /><br />Du kan ogs&aring; lage dine egne maler og plassere dem i mal-mappen.'
	.'<span class="thick">MERK:</span> Fancy_Content malen vil i fremtiden v&aelig;re den eneste eksempel-malen som forfatteren av '
	.'HTML_Newsletter vil fortsette &aring; oppgradere ved nye utgivelser av av denne Modulen!');
//Section: Stats and Newsletter Contents
define('_MSNL_ADM_LAB_STATS', 'Statistikker og innhold');
define('_MSNL_ADM_LAB_INCLSTATS', 'Inkludere siste statistikker');
define('_MSNL_ADM_LAB_INCLTOC', 'Inkludere tabell-innhold');
define('_MSNL_ADM_HLP_INCLSTATS', 'Dersom du sjekker av for dette valget vil Nyhetsbrevet inkludere '
	.'nettsidens n&oslash;kkel-statistikker i de malene hvor {STATS} tag\'en forekommer.Se eksempel-malene '
	.'ovenfor for &aring; f&aring; en id&egrave; om hvordan statistikkene vil bli vist.');
define('_MSNL_ADM_HLP_INCLTOC', 'N&aring;r du sjekker av her inkluderer du Tabell-innhold '
	.'\'blokken\' i de malene som har {TOC} tag forekomster i seg - se f.eks. Fancy_Content malen.'
	.'TOC blokken vil ha linker til hver av de <span class="thick">Siste xxxxxx</span> blokkene '
	.'i tillegg til eventuelle <span class="thick">anker</span> inkludert i <span class="thick">Nyhetsbrevets tekst</span> felt.');
//Section: Include Latest Items
define('_MSNL_ADM_LAB_INCLLATEST', 'Inkludere Statistikker');
define('_MSNL_ADM_LAB_INCLLATESTDLS', 'Siste Nedlastinger');
define('_MSNL_ADM_LAB_INCLLATESTWLS', 'Siste Nett-linker');
define('_MSNL_ADM_LAB_INCLLATESTFORS', 'Siste Foruminnlegg');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', 'Siste Nyhetsartikkler');
define('_MSNL_ADM_LAB_INCLLATESTREVS', 'Siste Anmeldelser');
define('_MSNL_ADM_HLP_INCLLATESTNEWS', 'Controls the number of latest articles to show in the '
	. 'newsletter.  The articles will be in chronological order starting with the most recent one '
	. 'first. Use a value of 0 (zero) to not show the Latest News information in the newsletter. '
	. 'Values entered here are retained from newsletter to newsletter, but you can change them '
	. 'at any time for any newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTDLS', 'Controls the number of latest downloads to show in the '
	. 'newsletter.  The downloads will be in chronological order starting with the most recent one '
	. 'first. Use a value of 0 (zero) to not show the Latest Downloads information in the newsletter. '
	. 'Values entered here are retained from newsletter to newsletter, but you can change them '
	. 'at any time for any newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTWLS', 'Controls the number of latest web links to show in the '
	. 'newsletter.  The web links will be in chronological order starting with the most recent one '
	. 'first. Use a value of 0 (zero) to not show the Latest Web Links information in the newsletter. '
	. 'Values entered here are retained from newsletter to newsletter, but you can change them '
	. 'at any time for any newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTFORS', 'Controls the number of latest forum posts to show in the '
	. 'newsletter.  The forum posts will be in chronological order starting with the most recent one '
	. 'first. Use a value of 0 (zero) to not show the Latest Forum Posts information in the newsletter. '
	. 'Values entered here are retained from newsletter to newsletter, but you can change them '
	. 'at any time for any newsletter.  In addition, only publically available (read) forums have '
	. 'their posts displayed.');
define('_MSNL_ADM_HLP_INCLLATESTREVS', 'Controls the number of latest reviews to show in the '
	. 'newsletter.  The reviews will be in chronological order starting with the most recent one '
	. 'first. Use a value of 0 (zero) to not show the Latest Reviews information in the newsletter. '
	. 'Values entered here are retained from newsletter to newsletter, but you can change them '
	. 'at any time for any newsletter.');
//Section: Sponsors
define('_MSNL_ADM_LAB_SPONSORS', 'Sponsorer');
define('_MSNL_ADM_LAB_CHOOSESPONSOR', 'Velg en Sponsor');
define('_MSNL_ADM_LAB_NOSPONSOR', 'Ingen Sponsor');
define('_MSNL_ADM_HLP_CHOOSESPONSOR', 'Valg av sponsor vil erstatte {BANNER} tag\'en '
	.'i Nyhetsbrevets mal med det valgte Reklamebanneret, dets link og alternativ tekst fra '
	.'Reklamebanner-systemet');
define('_MSNL_ADM_ERR_DBGETBANNERS', 'FEIL: Klarte ikke &aring; hente sponsorens Reklamebanner-informasjon');
//Section: Who to Send the Newsletter To
define('_MSNL_ADM_LAB_WHOSNDTO', 'Hvem vil du sende dette Nyhetsbrevet til?');
define('_MSNL_ADM_LAB_CHOOSESENDTO', 'Velg mottaker(e)');
define('_MSNL_ADM_LAB_WHOSNDTONLSUBS', 'Kun Brukere som abonnerer p&aring; Nyhetsbrevet');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG', 'Alle Registrerte Brukere');
define('_MSNL_ADM_LAB_WHOSNDTOPAID', 'Kun betalende abonnenter');
define('_MSNL_ADM_LAB_WHOSNDTOANONY', 'Alle bes&oslash;kende (ingen eposter blir sendt, men '
	.'alle bes&oslash;kende kan lese Nyhetsbrevet online');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS', 'En eller flere NSN Grupper - velg gruppe(r) nedenfor');
define('_MSNL_ADM_LAB_WHOSNDTOADM', 'Test epost (sendes kun til Admin)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS', 'abonnerende Brukere');
define('_MSNL_ADM_LAB_USERS', 'Brukere');
define('_MSNL_ADM_LAB_PAIDUSRS', 'betalende Brukere');
define('_MSNL_ADM_LAB_NSNGRPUSRS', 'NSN Gruppe Brukere');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC', 'Ad-Hoc epost distribusjonsliste');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV', 'Alle bes&oslash;kende');
define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', 'Dette valget vil sende Nyhetsbrevet til '
	.'til alle Brukere som har abonnert p&aring; nettsidens Nyhetsbrev via sin Brukerkonto.');
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', 'Dette valget vil sende Nyhetsbrevet til '
	.'alle registrerte Brukere.V&aelig;r forsiktig med &aring; bruke dette valget siden alle brukerne kanskje ikke '
	.'liker &aring; f&aring; tilsendt Nyhetsbrev som de ikke har bedt om.');
define('_MSNL_ADM_HLP_WHOSNDTOPAID', 'Dette valget vil sende Nyhetsbrevet til '
	.'alle betalende abonnenter p&aring; nettsiden din - fortrinnsvis de som for &oslash;yeblikket har aktivt abonnement.');
define('_MSNL_ADM_HLP_NSNGRPUSRS', 'Dette valget gj&oslash;r at du kan velge &aring; sende Nyhetsbrevet til '
	.'en eller flere av NSN Gruppene nedenfor.');
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', 'Dette valget vil IKKE sende ut Nyhetsbrevet, men istedet '
	.'vise Nyhetsbrevet i blokken og arkivet. Husk alikevel p&aring; at blokk- og modulinstillingene m&aring; v&aelig;re '
	.'satt som &oslash;nsket.');
define('_MSNL_ADM_HLP_WHOSNDTOADM', 'Dette valget vil sende en test p&aring; Nyhetsbrevet '
	.'kun til deg - Administrator. N&aring;r du har sjekket og godkjent Nyhetsbrevet er det klart for &aring; bli '
	.'sendt til dine valgte mottakere - bruk valget <span class="thick">Send testet Nyhetsbrev</span> linken &oslash;verst p&aring; siden.');
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', 'Dette valget gj&oslash;r det mulig &aring; sende Nyhetsbrevet til '
	.'en eller flere epost-adresser etter eget valg.Epost-adressene separerer du et komma-tegn, og du M&Aring; s&oslash;rge for '
	.'at alle epost-adressene er gyldige.');
//Section: NSN Groups
define('_MSNL_ADM_LAB_CHOOSENSNGRP', 'Sende til hvilke(n) NSN Gruppe(r)?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', '(vil bli ignorert dersom NSN Gruppe(r) ikke er '
	.'er valgt ovenfor)');
define('_MSNL_ADM_LAB_WHONSNGRP', 'Velg en eller flere Grupper');
define('_MSNL_ADM_ERR_DBGETNSNGRPS', 'FEIL:Er ikke istand til &aring; innhente NSN Grupper informasjon');
define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', 'Velg en eller flere Grupper nedenfor. Nyhetsbrevet vil bli '
	.'sendt til alle Brukerne i valgt(e) Gruppe(r).Selvom en Bruker eksisterer i mer enn &egrave;n Gruppe, '
	.'vil vedkommende alikevel f&aring; tilsendt kun ett Nyhetsbrev.');
/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/
define('_MSNL_ADM_PREV_LAB_VALPREVNL', 'Lag Nyhetsbrev - forh&aring;ndsvis, sjekk og godkjenn');
define('_MSNL_ADM_PREV_LAB_PREVNL', 'Forh&aring;ndsvis Nyhetsbrev');
define('_MSNL_ADM_PREV_MSG_SUCCESS', 'Nyhetsbrevet er sjekket, godkjent og klart '
	.'for forh&aring;ndsvisning nedenfor');
/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/
define('_MSNL_ADM_LAB_NSNGRPS', 'NSN Grupper');
define('_MSNL_ADM_VAL_NONSNGRP', 'Du har valgt &aring; sende til en NSN Gruppe, men '
	.'har ikke valgt en Gruppe &aring; sende til');
define('_MSNL_ADM_ERR_NOTEMPLATE', 'Mulig hacker fors&oslash;k - ingen mal er valgt');
define('_MSNL_ADM_ERR_NOSENDTO', 'Mulig hacker fors&oslash;k - det er ikke valgt noen &aring; sende til');
define('_MSNL_ADM_ERR_DBUPDLATEST', 'Oppdateringen av \'Siste _____\' konfigurasjons-informasjon feilet');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/
define('_MSNL_ADM_SEND_LAB_SENDNL', 'Lag Nyhetsbrev - Send epost');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM', 'Test Nyhetsbrev fra');
define('_MSNL_ADM_SEND_LAB_NLFROM', 'Nyhetsbrev fra');
define('_MSNL_ADM_SEND_MSG_ANONYMOUS', 'Nyhetsbrev som kan vises av alle ble lagt til');
define('_MSNL_ADM_SEND_MSG_LOTSSENT', 'Mer enn 500 Brukere vil motta dette '
	.'Nyhetsbrevet - dette kan ta 10 minutter eller mer, og PHP vil kanskje rapportere \'time-out\'.');
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Antall eposter sendt');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS', 'Sending av eposter med Nyhetsbrevet var vellykket');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE', 'Sending av eposter med Nyhetsbrevet feilet');
define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL', 'Kunne ikke finne testemail.php filen');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW', 'Ugyldige betingelser for visningsvalg');
define('_MSNL_ADM_SEND_ERR_CREATENL', 'Kunne ikke kopiere fra test-epost til '
	.'Nyhetsbrev fil');
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT', 'Klarte ikke &aring; lagre Nyhetsbrevet i databasen.');
define('_MSNL_ADM_SEND_ERR_DBNLSNID', 'Klarte ikke &aring; hente NID\'en for det nylig insatte Nyhetsbrevet.');
define('_MSNL_ADM_SEND_ERR_MAIL', 'PHP mail funksjonen feilet - klarte ikke &aring; sende Nyhetsbrev til:');
define('_MSNL_ADM_SEND_ERR_DELFILETEST', 'Sletting av testemail.php filen feilet');
define('_MSNL_ADM_SEND_ERR_DELFILETMP', 'Sletting av tmp.php filen feilet');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', 'Klarte ikke &aring; lese inn Statistikk for antall Brukere');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', 'Klarte ikke &aring; lese inn Statistikk for totalt antall sidevisninger');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', 'Klarte ikke &aring; lese inn Statistikk for antall Nyhetsartikkler');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', 'Klarte ikke &aring; lese inn Statistikk for antall Nyhetskategorier');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', 'Klarte ikke &aring; lese inn Statistikk for antall Nedlastinger');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', 'Klarte ikke &aring; lese inn Statistikk for antall Nedlastingskategorier');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', 'Klarte ikke &aring; lese inn Statistikk for antall Nettlinker');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', 'Klarte ikke &aring; lese inn Statistikk for antall Nettlinkkategorier');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', 'Klarte ikke &aring; lese inn Statistikk for antall Forumer');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', 'Klarte ikke &aring; lese inn Statistikk for antall Foruminnlegg');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', 'Klarte ikke &aring; lese inn Statistikk for antall Anmeldelser');
define('_MSNL_ADM_SEND_ERR_DBGETNEWS', 'Klarte ikke &aring; lese inn siste Nyhetsartikkler');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', 'Klarte ikke &aring; lese inn siste Nedlastinger');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', 'Klarte ikke &aring; lese inn siste Nettlinker');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', 'Klarte ikke &aring; lese inn siste Foruminnlegg');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', 'Klarte ikke &aring; lese inn siste Anmeldelser');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', 'Klarte ikke &aring; hente inn Reklamebanner');
/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/
define('_MSNL_ADM_TEST_LAB_PREVNL', 'Forh&aring;ndsvis testet Nyhetsbrev som skal sendes');
/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/
define('_MSNL_CFG_LAB_MAINCFG', 'Hoved-modul Konfigurering');
//Module Options
define('_MSNL_CFG_LAB_MODULEOPT', 'Modulvalg');
define('_MSNL_CFG_LAB_DEBUGMODE', 'Feils&oslash;kingsmode');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', 'AV');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', 'FEIL');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', 'OMFATTENDE');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', 'Feils&oslash;kingslogg');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', 'VIS');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', 'LOGGFIL');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', 'BEGGE');
define('_MSNL_CFG_LAB_SHOWBLOCKS', 'Vis h&oslash;yre Blokker');
define('_MSNL_CFG_LAB_NSNGRPS', 'Bruk NSN Grupper');
define('_MSNL_CFG_LAB_DLMODULE', 'Nedlastingsmodulens navn');
define('_MSNL_CFG_LAB_WYSIWYGON', 'Bruk WYSIWYG editor');
define('_MSNL_CFG_LAB_WYSIWYGROWS', 'Antall tekstlinjer i editoren');
define('_MSNL_CFG_HLP_DEBUGMODE', 'Dette valget gj&oslash;r at modul-administartor kan sette forskjellige niv&aring;er p&aring; '
	.'feils&oslash;kingsmeldingene:<br /><strong>AV</strong> = Kun programfeil meldinger '
	.'- ingen detaljerende meldinger vil bli vist.<br /><strong>FEIL</strong> = Programfeil '
	.'meldinger vil bli vist sammen med nyttig informasjon omkring feilen.SQL feil ogs&aring; '
	.'vise den aktueller SQL feilmeldingen og generert SQL.<br /> <strong>OMFATTENDE</strong> '
	.'= Veldig detaljerte feilmeldinger vil bli vist gejnnom hele programkj&oslash;ringen, inklusive navn p&aring; stier '
	.'(husk &aring; sl&aring; av dette valget n&aring;r du er ferdig, siden dette vil samle opp masse informasjon p&aring; en travel nettside - '
	.'og dessuten inneholde masse nyttig informasjon for en eventuell hacker!). <span class="thick">MERK: eposter '
	.'vil IKKE bli sendt n&aring;r dette valget er aktivert</span> - veldig nyttig for feils&oslash;kingsprosesser.');
define('_MSNL_CFG_HLP_DEBUGOUTPUT', 'Dette valget er ikke i bruk for &oslash;yeblikket, men vil i fremtiden '
	.'brukes for &aring; sette hvorvidt feils&oslash;kingsmeldingene skal vises i nettleseren, skrives til en loggfil eller begge deler.');
define('_MSNL_CFG_HLP_SHOWBLOCKS', 'Dersom du <strong>sjekker</strong> av denne boksen vil blokkene '
	.'p&aring; h&oslash;yre side v&aelig;re synlige.Er den <strong>usjekket</strong> vil blokkene p&aring; h&oslash;yre side '
	.'v&aelig;re skjult.Standardinstilling er at boksen er <strong>sjekket</strong>.');
define('_MSNL_CFG_HLP_NSNGRPS', 'Dette valget kan kun brukes dersom du har '
	.'NSN Groups add-on installert.Om du &oslash;nsker &aring; sende Nyhetsbrev til '
	.'en eller flere NSN Grupper skal du sjekke av i denne boksen.');
define('_MSNL_CFG_HLP_DLMODULE', 'Erstatt denne med den riktige/egentlige modul-utvidelsen. '
	.'For RavenNuke(tm) Downloads modul \'downloads\' nuke_<strong>downloads</strong>_downloads. '
	.'For NSN GR Downloads module, it is \'nsngd\', fra nuke_<strong>nsngd</strong>_downloads.');
define('_MSNL_CFG_HLP_WYSIWYGON', 'Sjekk av i denne boksen dersom du &oslash;nsker &aring; bruke WYSIWYG '
	.'editoren for editering av Nyhetsbrevets innhold.<strong>MERK:</strong> dette '
	.'valget krever at nukeWYSIWYG add-on er forh&aring;ndsinstallert.');
define('_MSNL_CFG_HLP_WYSIWYGROWS', 'Dette valget kontrollerer hvor mange tekstlinjer som skal vises '
	.'i WYSIWYG editoren n&aring;r du lager Nyhetsbrev.Virker b&aring;de med og uten WYSIWYG editoren.');
//Show Options
define('_MSNL_CFG_LAB_SHOWOPT', 'Vis valg');
define('_MSNL_CFG_LAB_SHOWCATS', 'Vis Kategorier');
define('_MSNL_CFG_LAB_SHOWHITS', 'Vis treff');
define('_MSNL_CFG_LAB_SHOWDATES', 'Vis sendt datoer');
define('_MSNL_CFG_LAB_SHOWSENDER', 'Vis avsender');
define('_MSNL_CFG_HLP_SHOWCATS', 'Hvis sjekket av vil Nyhetsbrevene vises under '
	.'sine respektive Kategorier i blokken.Kategoriene vil alltid vises '
	.'i Archives (modulen).');
define('_MSNL_CFG_HLP_SHOWHITS', 'Hvis sjekket av vil antall visninger (treff) et Nyhetsbrev '
	.'har hatt vises i b&aring;de blokken og Archives (modulen).');
define('_MSNL_CFG_HLP_SHOWDATES', 'Hvis sjekket av vil datoen for n&aring;r hvert Nyhetsbrev ble sendt '
	.'vises i b&aring;de blokken og Archives (modulen).');
define('_MSNL_CFG_HLP_SHOWSENDER', 'Hvis sjekket av vil avsenderen av hvert enkelt Nyhetsbrev '
	.'vises i b&aring;de blokken og Archives (modulen).');
//Block Options
define('_MSNL_CFG_LAB_BLKOPT', 'Blokk valg');
define('_MSNL_CFG_LAB_BLKLMT', 'Antall Nyhetsbrever som skal vises i blokken');
define('_MSNL_CFG_LAB_SCROLL', 'Bruke Scrolling block kode');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', 'Scrolling code h&oslash;yde');
define('_MSNL_CFG_LAB_SCROLLAMT', 'Scrolling code antall');
define('_MSNL_CFG_LAB_SCROLLDELAY', 'Scrolling code forsinkelse');
define('_MSNL_CFG_HLP_BLKLMT', 'Begrenser totalt antall Nyhetsbrev som '
	.'skal vises i blokken.Dersom Kategorier er skrudd p&aring; vil antall Nyhetsbrev som skal vises '
	.'i en bestemt Kategori ha sin egen separate innstilling.');
define('_MSNL_CFG_HLP_SCROLL', 'Dette valget gj&oslash;r at blokk-informasjonen vil '
	.'rulle oppover i blokken.');
define('_MSNL_CFG_HLP_SCROLLHEIGHT', 'Setter h&oslash;yden p&aring; rulleomr&aring;det i antall piksler - '
	.'standard er 180. V&aelig;r oppmerksom p&aring; at om den settes for lavt vil du kanskje ikke se noe som helst.');
define('_MSNL_CFG_HLP_SCROLLAMT', 'Setter rullehastigheten p&aring; informasjonen i blokken - '
	.'som standard er den satt til 2 (pr&oslash;v deg eventuellt fram litt ang. dette valget og det neste).');
define('_MSNL_CFG_HLP_SCROLLDELAY', 'Dette valget er ogs&aring; med p&aring; &aring; sette rullehastigheten p&aring; informasjonen i blokken - '
	.'som standard er den satt til 25 (pr&oslash;v deg eventuellt fram litt ang. dette valget og det forrige).');
/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/
define('_MSNL_CFG_APPLY_ERR_DBFAILED', 'Oppdatering av konfigurasjons-informasjonen feilet');
define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', 'Ugyldig Feils&oslash;kingsmode er gitt - det er kanskje et '
	.'problem med modul-installasjonen');
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', 'Ugyldig Feils&oslash;kingsrapportering er gitt - det er kanskje et '
	.'problem med modul-installasjonen');
define('_MSNL_CFG_APPLY_MSG_BACK', 'Tilbake til Hoved-konfigureringen');
/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/
define('_MSNL_CAT_LAB_CATCFG', 'Nyhetsbrev Kategorikonfigurering');
define('_MSNL_CAT_LAB_ADDCAT', 'Legg til Kategori');
define('_MSNL_CAT_LAB_CATTITLE', 'Kategoritittel');
define('_MSNL_CAT_LAB_CATDESC', 'Kategoribeskrivelse');
define('_MSNL_CAT_LAB_CATBLOCKLMT', 'Blokkbegrensning');
define('_MSNL_CAT_LNK_ADDCAT', 'Legg til en ny Nyhetsbrev Kategori');
define('_MSNL_CAT_LNK_CATCHG', 'Editere Nyhetsbrev Kategori');
define('_MSNL_CAT_LNK_CATDEL', 'Slette Nyhetsbrev Kategori');
define('_MSNL_CAT_MSG_CATBACK', 'Tilbake til Nyhetsbrev Kategorilisten');
define('_MSNL_CAT_ERR_DBGETCAT', 'Feilet ved innlesing av Nyhetsbrev Kategori-informasjon');
define('_MSNL_CAT_ERR_DBGETCATS', 'Feilet ved innlesing av Nyhetsbrev Kategorier');
define('_MSNL_CAT_ERR_NOCATS', 'Ingen KAtegorier funnet - Stort problem ved installasjonen');
define('_MSNL_CAT_ERR_INVALIDCID', 'Ugyldig Nyhetsbrev Kategori ID ble gitt');
define('_MSNL_CAT_ERR_DBGETCNT', 'Feilet ved innlesing av antall Nyhetsbrev som er ber&oslash;rt');
define('_MSNL_CAT_HLP_CATTITLE', 'Dette feltet er tittelen p&aring; Kategorien som vil vises '
	.'i b&aring;de blokken (hvis sl&aring;tt p&aring; i konfigurasjonsvalgene) og Nyhetsbrev Arkivene. '
	.'Siden dette brukes i blokken til &aring; gruppere Nyhetsbrever, vil det v&aelig;re klokt &aring; begrense tittelen '
	.'til 30 tegn eller mindre s&aring; blokken vil rendre ordentlig.');
define('_MSNL_CAT_HLP_CATDESC', 'Dette feltet er stort. Den eneste begrensningen er at du ikke '
	.'f&aring;r bruke HTML tag\'er i det.Det vil la deg gj&oslash;re det, men vil bli strippet ut senere. '
	.'Gi en god og innf&oslash;rende beskrivelse av Nyhetsbrev Kategorien.');
define('_MSNL_CAT_HLP_CATBLOCKLMT', 'Dette feltet gjelder kun hvis valget <span class="thick">Vis Kategorier</span> '
	.'konfigurasjonen er sjekket og m&aring; v&aelig;re st&oslash;rre en null.Skriv inn antall Nyhetsbrev spm skal vises '
	.'under denne Kategorien i blokken. <span class="thick">Hvis ingen verdi oppgis, vil den automatisk bli satt til ');
/************************************************************************
* Function: msnl_cat_add
************************************************************************/
define('_MSNL_CAT_ADD_LAB_CATADD', 'Konfigurering av Nyhetskategorier - Legg til Kategori');
/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/
define('_MSNL_CAT_ADD_APPLY_DBCATADD', 'Legge til Nyhetsbrev Kategori feilet');
/************************************************************************
* Function: msnl_cat_chg
************************************************************************/
define('_MSNL_CAT_CHG_LAB_CATCHG', 'Konfigurering av Nyhetsbrev Kategorier - Endre Kategori');
define('_MSNL_CAT_CHG_MSG_CHGIMPACT', 'Nyhetsbrev(er) vil bli ber&oslash;rt av denne endringen');
/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/
define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG', 'Oppdatering av Nyhetsbrev Kategorien feilet');
/************************************************************************
* Function: msnl_cat_del
************************************************************************/
define('_MSNL_CAT_DEL_MSG_DELIMPACT', 'Nyhetsbrev(er) vil bli ber&oslash;rt av denne slettingen.');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', 'Ber&oslash;rte Nyhetsbrev(er) vil bli overf&oslash;rt til '
	.'default unassigned newsletter category.Er du sikker p&aring; at du fortsatt &oslash;nsker &aring; slette?');
/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/
define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN', 'Overf&oslash;ringen av Nyhetsbrev(er) feilet');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE', 'Sletting av Nyhetsbrev Kategorien feilet');
/************************************************************************
* Function: msnl_nls
************************************************************************/
define('_MSNL_NLS_LAB_NLSCFG', 'Vedlikeholde Nyhetsbrever');
define('_MSNL_NLS_LAB_CURRENTCAT', 'N&aring;v&aelig;rende Kategori');
define('_MSNL_NLS_LAB_DATESENT', 'Sendt dato');
define('_MSNL_NLS_LAB_CATEGORY', 'Kategori');
define('_MSNL_NLS_LNK_GETNLS', 'Hent de aktuelle Nyhetsbrevene');
define('_MSNL_NLS_LNK_VIEWNL', 'Vis Nyhetsbrev (&aring;pnes kanskje i nytt vindu)');
define('_MSNL_NLS_LNK_NLSCHG', 'Editere Nyhetsbrev-informasjon');
define('_MSNL_NLS_LNK_NLSDEL', 'Slette Nyhetsbrev');
define('_MSNL_NLS_MSG_NONLSS', 'Ingen Nyhetsbrever ble funnet for denne Kategorien');
define('_MSNL_NLS_MSG_NLSBACK', 'Tilbake til Nyhetsbrev-listen');
define('_MSNL_NLS_ERR_DBGETNLSS', 'Innhenting av Nyhetsbrever feilet');
define('_MSNL_NLS_ERR_DBGETNLS', 'Innhenting av Nyhetsbrev-informasjon feilet');
define('_MSNL_NLS_ERR_INVALIDNID', 'Feil Nyhetsbrev ID ble angitt');
define('_MSNL_NLS_ERR_NONLSS', 'Ingen Nyhetsbrever ble funnet - Stort problem med installasjonen');
/************************************************************************
* Function: msnl_nls_chg
************************************************************************/
define('_MSNL_NLS_CHG_LAB_NLSCHG', 'Vedlikeholde Nyhetbrever - Endre Nyhetsbrev-informasjon');
define('_MSNL_NLS_CHG_LAB_DATESENT', 'Sendt dato');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', 'Hvem skal kunne se Nyhetsbrevet');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', 'NSN Grupper kan se Nyhetsbrevet');
define('_MSNL_NLS_CHG_LAB_NBRHITS', 'Antall treff');
define('_MSNL_NLS_CHG_LAB_FILENAME', 'Nyhetsbrevets filnavn');
define('_MSNL_NLS_CHG_LAB_CAUTION', 'Endre verdiene nedenfor KUN hvis du er sikker p&aring; at du vet hva du gj&oslash;r');
define('_MSNL_NLS_CHG_HLP_DATESENT', 'Datoen m&aring; v&aelig;re i formatet DD-MM-YYYY slik det er vist i feltet. '
	.'N&aring;r et Nyhetsbrev f&oslash;rst er lager og sendt, vil dette feltet inneholde n&aring;v&aelig;rende system-dato. Nyhetsbrev blir alltid '
	.'listet opp i dato-rekkef&oslash;lge - med det siste Nyhetsbrevet &oslash;verst p&aring; listen.');
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 'Dette feltet er system-avhengig - v&aelig;r forsiktig med '
	.'endre det! Gyldige verdier er:'
	.'<br /><strong>0</strong> = gjester - kan sees av alle'
	.'<br /><strong>1</strong> = alle registrerte brukere'
	.'<br /><strong>2</strong> = kun nyhetsbrev-abonnenter'
	.'<br /><strong>3</strong> = kun betalende medlemmer/abonnenter'
	.'<br /><strong>4</strong> = kun valgte NSN Grupper'
	.'<br /><strong>5</strong> = ad-hoc distribusjons-liste'
	.'<br /><strong>99</strong> = kun administrator.');
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 'Krever at <span class="thick">vis</span> valget i feltet over '
	.'er satt til 4 (kun valgte NSN Grupper). Hver av NSN Gruppene har spesifikke ID nummer knyttet til seg. '
	.'N&aring;r Nyhetsbrevet lages/sendes kan du velge en eller flere NSN Grupper &aring; sende til. '
	.'Skal du sende til kun en gruppe, legger du bare inn gruppens ID nummer. For flere grupper '
	.'m&aring; du skille gruppene med et bindestrek-tegn (f.eks. <span class="thick">1-2-3</span>).');
define('_MSNL_NLS_CHG_HLP_NBRHITS', 'N&aring;r et Nyhetsbrev vises p&aring; nettet, enten ved &aring; bruke en blokk-link eller '
	.'en arkiv-link, s&aring; vil Nyhetsbrevets antall treff &oslash;ke med 1 (gjelder ikke hvis brukeren er logget inn som administrator.');
define('_MSNL_NLS_CHG_HLP_FILENAME', 'Dette feltet er system-avhengig. Om du endrer det s&aring; m&aring; du v&aelig;re '
	.'sikker p&aring; at filnavnet faktisk eksisterer og er formattert for &aring; vises riktig av dette systemet.');
/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/
define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', 'Verdien m&aring; v&aelig;re fra 0 - 4, eller 99');
define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', 'Oppdatering av Nyhetsbrev-informasjonen feilet');
/************************************************************************
* Function: msnl_nls_del
************************************************************************/
define('_MSNL_NLS_DEL_MSG_DELIMPACT', 'Du er i ferd med &aring; slette dette Nyhetsbrevet.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', 'All informasjon knyttet til dette Nyhetsbrevet vil bli '
	.'slettet fra databasen - Nyhetsbrev-filen slettes ogs&aring; fra arkiv-mappen p&aring; sereveren. '
	.'Er du sikker p&aring; at du vil slette dette Nyhetsbrevet?');
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/
define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'Var ikke istand til &aring; slette Nyhetsbrev-filen - sjekk filens rettigheter.');
define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL', 'Sletting av Nyhetsbrevets informasjon feilet');
