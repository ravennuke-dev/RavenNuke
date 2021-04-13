<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
define('_1WEEK','1 Uke');
define('_2WEEKS','2 Uker');
define('_30DAYS','30 Dager');
define('_ADDALINK','Legg til en ny Link');
define('_ADDEDON','Lagt til den');
define('_ADDITIONALDET','Tilleggsdetaljer');
define('_ADDLINK','Legg til en ny Link');
define('_ADDURL','Legg til denne nett-adressen (URL\'en)');
define('_ALLOWTORATE','Tillat andre brukere &aring; rangere den fra din nettside!');
define('_AND','og');
define('_BESTRATED','Best rangerte Linker - Topp');
define('_BREAKDOWNBYVAL','Breakdown of Ratings by Value');
define('_BUTTONLINK','Knappe-Link');
define('_CATEGORIES','Kategorier');
if (!defined('_CATEGORY')) define('_CATEGORY','Kategori');
define('_CATLAST3DAYS','Nye Linker i denne Kategorien som er lagt til i l&oslash;pet av de siste 3 dagene');
define('_CATNEWTODAY','Nye Linker i denne Kategorien som er lagt til idag');
define('_CATTHISWEEK','Nye Linker i denne Kategorien som er lagt til i l&oslash;pet av denne uken');
define('_CHECKFORIT','Du oppga ikke noen epost-adresse, men vi vil alikevel sjekke linken din i l&oslash;pet av kort tid.');
define('_COMPLETEVOTE1','Vi setter stor pris p&aring; din stemme.');
define('_COMPLETEVOTE2','Du har allerede stemt p&aring; denne linken - for bare '."$anonwaitdays".' dag(er) siden.');
define('_COMPLETEVOTE3','Stem p&aring; en og samme link kun en gang.<br />Alle stemmene logges og sjekkes.');
define('_COMPLETEVOTE4','Du kan ikke stemme p&aring; en link du selv har sendt inn.<br />Alle stemme logges og sjekkes.');
define('_COMPLETEVOTE5','Ingen rangering er valgt og stemmen ble derfor forkastet');
define('_COMPLETEVOTE6','Kun en stemme per IP adresse er tillat hver '."$outsidewaitdays".' dag(er).');
if (!defined('_DATE')) { define('_DATE','Dato'); }
define('_DATE1','Date (Eldste Linker f&oslash;rst)');
define('_DATE2','Date (Nyeste Linker f&oslash;rst)');
define('_DAYS','dager');
define('_DESCRIPTION','Beskrivelse');
define('_DETAILS','Detaljer');
define('_EDITORIAL','Lederartikkel');
define('_EDITORIALBY','Lederartikkel av');
define('_EDITORREVIEW','Lederartikkel anmeldelse');
define('_EDITTHISLINK','Editere denne Linken');
define('_EMAILWHENADD','Du vil motta en epost n&aring;r Linken er sjekket, godkjent og lagt ut p&aring; nettsiden v&aring;r.');
define('_FEELFREE2ADD','F&oslash;l deg fri til &aring; legge inn en kommentar om denne siden.');
define('_HIGHRATING','H&oslash;y rangering');
define('_HITS','Treff');
define('_HTMLCODE1','Du kan bruke f&oslash;lgende HTML kodercode:');
define('_HTMLCODE2','Kildekoden for knappen ovenfor er:');
define('_HTMLCODE3','Dette skjemaet gj&oslash;r at det kan stemmes p&aring; denne linken av brukerne p&aring; din egen hjemmeside - avstemmingene vil bli lagret i v&aring;r database p&aring; lik linje med stemmene som avgis her p&aring; v&aring;r nettside. Skjemaet ovenfor er ikke aktivisert her, men f&oslash;lgende kode fungerer dersom du klipper-og-limer den inn p&aring; nettsidn din. Kildekoden ser du nedenfor:');
define('_IDREFER','i HTML kodens kildereferanse er din nettside-ID i '."$sitename".' database. Forsikre deg om at dette nummeret er oppf&oslash;rt.');
define('_IFYOUWEREREG','Du kunne skrevet kommentarer p&aring; nettsiden v&aring;r dersom du var registrert.');
define('_INDB','i v&aring;r database');
define('_INOTHERSENGINES','i andres S&oslash;kemotorer');
define('_INSTRUCTIONS','Instruksjoner');
define('_ISTHISYOURSITE','Er dette din kilde?');
define('_LAST30DAYS','Siste 30 dager');
define('_LASTWEEK','Siste uke');
define('_LDESCRIPTION','Beskrivelse (maks 255 tegn):');
define('_LETSDECIDE','Meningsytringer fra brukere som deg selv vil hjelpe andre bes&oslash;kende &aring; avgj&oslash;re hvilke Linker de skal klikke p&aring;.');
define('_LINKALREADYEXT','FEIL: Denne nett-adressen (URL\'en) finnes allerede i databasen v&aring;r!');
define('_LINKCOMMENTS','Kommentarer til Linker');
define('_LINKID','Link-ID');
define('_LINKNODESC','FEIL: Du m&aring; legge inn en beskrivelse for nett-adressen (URL\'en)!');
define('_LINKNOTITLE','FEIL: Du m&aring; legge inn en Tittel for nett-adressen (URL\'en)!');
define('_LINKNOURL','FEIL: Du m&aring; legge inn en nett-adresse (URL) for Linken!');
define('_LINKPROFILE','Link-profil');
define('_LINKRATING','Link-rangeringer');
define('_LINKRATINGDET','Linkens rangerings-detaljer');
define('_LINKRECEIVED','Takk. Vi har mottatt din innsendelse. Linken vil bli sjekket, godkjent og offentliggjort i l&oslash;pet av kort tid!');
define('_LINKS','Linker');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','Linker Hovedside');
define('_LINKSMAINCAT','Linker Hovedkategorier');
define('_LINKSNOCATS1','Det m&aring; v&aelig;re minst &egrave;n Link Kategori satt opp av'); //montego for RN0000571
define('_LINKSNOCATS2','nettsidens Administrator f&oslash;r det kan legges inn Linker.'); //montego for RN0000571
define('_LINKSNOTUSER1','Du er ikke en registrert Bruker, eller du har ikke Logget inn.');
define('_LINKSNOTUSER2','Som registrert Bruker kunne du ha lagt til Linker p&aring; nettsiden v&aring;r.');
define('_LINKSNOTUSER3','Det er raskt, enkelt og helt gratis &aring; registrere seg.');
define('_LINKSNOTUSER4','Hvorfor deler av nettsiden v&aring;r krever registrering?');
define('_LINKSNOTUSER5','F&oslash;rst og fremst handler det om din og v&aring;r sikkerhet. Dernest er det i v&aring;r interesse &aring; gi deg et variert og kvalitetsrikt innhold.');
define('_LINKSNOTUSER6','Alt som legges ut p&aring; nettsiden gjennomg&aring;r en individuell sjekking og godkjenning av teamet v&aring;rt.');
define('_LINKSNOTUSER7','Vi h&aring;per derved &aring; kunne tilby deg b&aring;de interessant og verdifull informasjon.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Lag en Brukerkonto</a>');
define('_LINKTITLE','Link-tittel');
define('_LINKVOTE','Stem!');
define('_LOOKTOREQUEST','Vi vil vurdere din anmodning i l&oslash;pet av kort tid.');
define('_LOWRATING','Lav rangering');
define('_LTOTALVOTES','totalt antall stemmer');
define('_LVOTES','stemmer');
define('_MAIN','Hovedside');
if(!defined('_MODIFY')) define('_MODIFY','Modifisere');
define('_MOSTPOPULAR','Mest popul&aelig;r - Topp');
define('_NEW','Nye Linker');
define('_NEWLAST3DAYS','Nye siste 3 dager');
define('_NEWLINKS','Nye Linker');
define('_NEWTHISWEEK','Nye denne uken');
define('_NEWTODAY','Nye idag');
define('_NEXT','Neste side');
define('_NOEDITORIAL','Det er ingen Lederartikkler tilgjengelig for &oslash;yeblikket.');
define('_NOMATCHES','Det ble ikke funnet noe som matchet dine kriterier');
define('_NOOUTSIDEVOTES','Ingen stemmer fra andre nettsider');
define('_NOREGUSERSVOTES','Ingen stemmer fra registrerte Brukere');
define('_NOUNREGUSERSVOTES','Ingen stemmer fra uregistrerte Brukere');
define('_NUMBEROFRATINGS','Antall rangeringer');
define('_NUMOFCOMMENTS','Antall kommentarer');
define('_NUMRATINGS','# rangeringer');
if (!defined('_OF')) { define('_OF','av'); }
define('_OFALL','av alle');
define('_ONLYREGUSERSMODIFY','Det er kun registrerte Brukere som kan anmode om modifisering av Linker. Vennligst <a href="modules.php?name=Your_Account">Lag Brukerkonto eller Logg inn</a>.');
define('_OUTSIDEVOTERS','Stemmegivere fra andre nettsider');
define('_OVERALLRATING','Rangering totalt');
define('_PAGETITLE','Sidens tittel');
define('_PAGEURL','Sidens nett-adresse (URL)');
define('_POPULAR','Popul&aelig;re Linker');
define('_POPULARITY','Popularitet');
define('_POPULARITY1','Popularitet (f&aelig;rrest til flest treff)');
define('_POPULARITY2','Popularitet (flest til f&aelig;rrest treff)');
define('_POSTPENDING','Alle Linker som sendes inn avventer sjekking og godkjenning av teamet v&aring;rt.');
define('_PREVIOUS','Forrige side');
define('_PROMOTE01','Du er kanskje interessert i en eller flere av v&aring;re \'Ranger en Nettside\' tjenestene vi har tilgjengelig?. Disse gj&oslash;r at du kan plassere et bilde (m/link), eller til og med et rangerings-skjema, p&aring; din nettside - og som gj&oslash;r det mulig for dine brukere &aring; stemme p&aring; dine innsendte linker fra din egen hjemmeside. Vennligst velg en av mulighetene listet nedenfor:');
define('_PROMOTE02','En m&aring;te &aring; rangere fra din egen hjemmeside p&aring; er ved &aring; bruke en helt enkel tekst-link:');
define('_PROMOTE03','En annen m&aring;te er litt mer fancy enn en vanlig tekst - da bruker du istedet en liten knappe-link (bilde m/link):');
define('_PROMOTE04','Tredje m&aring;ten er &aring; rangere Linker via et skjema som du legger inn p&aring; hjemmesiden din. Dersom vi oppdager at du jukser med rangeringene vil vi fjerne linken din. N&aring;r dette er sagt, her ser du hvordan det n&aring;v&aelig;rende rangerings-skjemaet ser ut.');
define('_PROMOTE05','Takk! .. og lykke til med dine rangeringer!');
define('_PROMOTEYOURSITE','Promoter nettsiden din');
define('_RANDOM','Vilk&aring;rlig Link');
define('_RATEIT','Ranger denne Nettsiden!');
define('_RATENOTE1','Vennligst ikke stem p&aring; samme kilde mer enn &egrave;n gang!');
define('_RATENOTE2','Skalaen g&aring;r fra 1 - 10 (der 1 er d&aring;rligst, og 10 er best).');
define('_RATENOTE3','Vennligst v&aelig;r objektiv i stemmegivingen din (bare 1\'ere og/eller 10\'ere gir hverken reelle eller nyttige resultater!)!');
define('_RATENOTE4','Her kan du se listen over <a href="modules.php?name=Web_Links&amp;l_op=TopRated">Topp rangerte Kilder</a>.');
define('_RATENOTE5','Vennligst ikke stem p&aring; din egen eller en konkurrent\'s kilde.');
define('_RATESITE','Ranger denne Nettsiden');
define('_RATETHISSITE','Ranger denne Kilden');
define('_RATING','Rangering');
define('_RATING1','Rangering (f&aelig;rrest til h&oslash;yest stemmer)');
define('_RATING2','Rangering (h&oslash;yest til f&aelig;rrest stemmer)');
define('_REGISTEREDUSERS','Registrerte Brukere');
define('_REMOTEFORM','Rangerings-skjema for bruk p&aring; din egen hjemeside');
define('_REPORTBROKEN','Rapporter brutt Link');
define('_REQUESTLINKMOD','Anmode om modifisering av Link');
define('_RETURNTO','Tilbake til');
define('_SCOMMENTS','Kommentarer');
define('_SEARCHRESULTS4','S&oslash;keresultater for');
define('_SELECTPAGE','Velg side');
define('_SENDREQUEST','Send inn anmodning');
define('_SHOW','Vis');
define('_SHOWTOP','Vis Topp');
define('_SITESSORTED','Linkene er n&aring; sortert etter');
define('_SORTLINKSBY','Sorter Linkene etter');
define('_STAFF','Team');
define('_SUBMITONCE','Send inn en unik Link <span class="thick">kun</span> &egrave;n gang!');
define('_TEXTLINK','Tekst-link');
define('_THANKSBROKEN','Takk for at du hjelper oss &aring; holde denne Kategorien oppdatert.');
define('_THANKSFORINFO','Takk for informasjonen.');
define('_THANKSTOTAKETIME','Takk for at du tar deg tid til &aring; rangere en Nettside her p&aring;');
define('_THENUMBER','Nummeret');
define('_THEREARE','Det er');
define('_TITLE','Tittel');
define('_TITLEAZ','Tittel (A til &Aring;)');
define('_TITLEZA','Tittel (&Aring; to A)');
define('_TO','Til');
define('_TOPRATED','Topp rangerte Linker');
define('_TOTALFORLAST','Nye Linker totalt for siste');
define('_TOTALNEWLINKS','Nye Linker totalt');
define('_TOTALOF','Totalt av');
define('_TOTALVOTES','Antall stemmer totalt:');
define('_TRATEDLINKS','Rangerte Linker totalt');
define('_TRY2SEARCH','Pr&oslash;v &aring; s&oslash;ke...');
define('_TVOTESREQ','minimum antall stemmer som kreves');
define('_UNREGISTEREDUSERS','Uregistrerte Brukere');
define('_URL','Nett-adresse (URL)');
define('_USER','Bruker');
define('_USERANDIP','V&aelig;r vennlig ikke &aring; missbruke systemet v&aring;rt (brukernavn og IP blir loggf&oslash;rt og sjekket).');
define('_USERAVGRATING','Bruker\'s gjennomsnittlige Rangering');
define('_USUBCATEGORIES','Under-kategorier');
define('_VISITTHISSITE','Bes&oslash;k denne Nettsiden');
define('_VOTE4THISSITE','Stem p&aring; denne Nettsiden!');
define('_WEBLINKS','Linker');
define('_WEIGHNOTE','* Merk: Denne kilden veier registrerte Brukeres rangeringer opp mot uregistrerte Brukeres rangeringer');
define('_WEIGHOUTNOTE','* Merk: Denne kilden veier registrerte Brukeres rangeringer opp mot rangeringer gjort fra andre nettsider');
define('_YOUARENOTREGGED','Du er ikke en registrert Bruker, eller du har ikke Logget inn.');
define('_YOUAREREGGED','Du er en registrert Bruker og er Logget inn.');
define('_YOUREMAIL','Din epost-adresse');
define('_YOURNAME','Ditt Brukernavn');
?>