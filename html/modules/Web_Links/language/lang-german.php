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
define('_1WEEK','1 Woche');
define('_2WEEKS','2 Wochen');
define('_30DAYS','30 Tage');
define('_ADDALINK','Einen neuen Link hinzuf&uuml;gen');
define('_ADDEDON','Eingetragen am');
define('_ADDITIONALDET','Weitere Details');
define('_ADDLINK','Link melden');
define('_ADDURL','URL einf&uuml;gen');
define('_ALLOWTORATE','Erm&ouml;gliche Deinen Besuchern das Bewerten Deiner Seite!');
define('_AND','und');
define('_BESTRATED','Bestbewerteste Seiten');
define('_BREAKDOWNBYVAL','Breakdown der Stimmen');
define('_BUTTONLINK','Buttonlink');
define('_CATEGORIES','Themen- Bereiche');
if (!defined('_CATEGORY')) define('_CATEGORY','Bereich');
define('_CATLAST3DAYS','In den letzten 3 Tagen neue Links in diesem Bereich');
define('_CATNEWTODAY','Heutige neue Links in diesem Bereich');
define('_CATTHISWEEK','In der letzten Woche in diesem Bereich neu eingef&uuml;gte Links');
define('_CHECKFORIT','Sie brauchen uns keine eMail zu schreiben. Wir werden Ihren Vorschlag baldm&ouml;glichst &uuml;berpr&uuml;fen.');
define('_COMPLETEVOTE1','Ihre Abstimmung wird gesch&auml;tzt.');
define('_COMPLETEVOTE2','Sie haben in den letzten '."$anonwaitdays".' Tagen schon einmal eine Stimme abgegeben.');
define('_COMPLETEVOTE3','Stimmen Sie bitte nur einmal ab.<br />Alle abgegebenen Stimmen werden geloggt und ausgewertet!.');
define('_COMPLETEVOTE4','Sie k&ouml;nnen nicht einen Link bewerten, den Sie selbst eingetragen haben.<br />Alle abgegebenen Stimmen werden geloggt und ausgewertet!.');
define('_COMPLETEVOTE5','Keine Bewertung ausgew&auml;hlt - Keine Stimme gez&auml;hlt');
define('_COMPLETEVOTE6','Nur eine Stimme pro IP-Adresse innerhalb von '."$outsidewaitdays".' Tagen erlaubt.');
if (!defined('_DATE')) { define('_DATE','Datum'); }
define('_DATE1','Datum (erst alte Links)');
define('_DATE2','Datum (erst neue Links)');
define('_DAYS','Tagen');
define('_DESCRIPTION','Beschreibung');
define('_DETAILS','Details');
define('_EDITORIAL','Einleitung');
define('_EDITORIALBY','Einleitung von');
define('_EDITORREVIEW','Editor-Bewertung');
define('_EDITTHISLINK','Diesen Link &auml;ndern');
define('_EMAILWHENADD','Sie werden eine eMail erhalten, sobald Ihr Vorschlag freigeschaltet wurde.');
define('_FEELFREE2ADD','Sind Sie so frei und geben Sie einen Kommentar ein.');
define('_HIGHRATING','H&ouml;chste Bewertung');
define('_HITS','Hits');
define('_HTMLCODE1','Folgenden HTML- Code sollten Sie in diesem Fall auf Ihrer Webseite einf&uuml;gen:');
define('_HTMLCODE2','Folgenden HTML- Code m&uuml;ssen Sie f&uuml;r den Button auf Ihrer Seite einf&uuml;gen:');
define('_HTMLCODE3','Die Benutzung dieses Formulars erlaubt es Ihren Besuchern, direkt von Ihrer Seite aus abzustimmen. Wir erhalten diese Bewertung und f&uuml;gen sie in unsere Datenbank ein. Das obige Beispiel ist deaktiviert, aber auf Ihrer Seite wird es funktionieren, wenn Sie den HTML- Code genau so dort einf&uuml;gen. Hier nun der HTML- Code:');
define('_IDREFER','im Code entspricht Ihrer Seiten- ID in der '."$sitename".'- Datenbank. Bitte achten Sie darauf, dass diese Nummer angegeben ist.');
define('_IFYOUWEREREG','Wenn Sie registriert sind, k&ouml;nnen Sie auf dieser Seite Kommentare eingeben.');
define('_INDB','in unserer Datenbank');
define('_INOTHERSENGINES','in anderen Suchmaschinen');
define('_INSTRUCTIONS','Anleitung');
define('_ISTHISYOURSITE','Ist es von Dir?');
define('_LAST30DAYS','Letzte 30 Tage');
define('_LASTWEEK','Letzte Woche');
define('_LDESCRIPTION','Beschreibung: (maximal 255 Zeichen)');
define('_LETSDECIDE','Eingaben von Teilnehmern wie Ihnen hilft anderen Teilnehmern bei der Entscheidung, welche Links diese anklicken sollten.');
define('_LINKALREADYEXT','FEHLER: Diese URL befindet sich bereits in der Datenbank!');
define('_LINKCOMMENTS','Link- Kommentare');
define('_LINKID','Link ID');
define('_LINKNODESC','FEHLER: F&uuml;r Ihre Homepage fehlt die Beschreibung!');
define('_LINKNOTITLE','FEHLER: Sie m&uuml;ssen Ihrer Homepage einen Namen geben!');
define('_LINKNOURL','FEHLER: Sie m&uuml;ssem f&uuml;r Ihre Homepage eine Adresse angeben!');
define('_LINKPROFILE','Linkprofile');
define('_LINKRATING','Linkbewertung');
define('_LINKRATINGDET','Linkbewertungs- Details');
define('_LINKRECEIVED','Wir haben Ihren Linkvorschlag erhalten. Vielen Dank!');
define('_LINKS','Links');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','Link-Kategorien');
define('_LINKSMAINCAT','Links- Hauptkategorien');
define('_LINKSNOCATS1','Ess muss mindestens eine Linkkategorie durch den'); //montego for RN0000571
define('_LINKSNOCATS2','Seitenadmin erstellt sein, bevor ein Link hinzugef&uuml;gt werden kann.'); //montego for RN0000571
define('_LINKSNOTUSER1','Sie sind kein registrierter Benutzer oder haben Sich nicht eingeloggt.');
define('_LINKSNOTUSER2','Wenn Sie registriert sind, k&ouml;nnen Sie neue Links auf unserer Seite hinzuf&uuml;gen.');
define('_LINKSNOTUSER3','Mitglied zu werden ist ein einfacher und schneller Vorgang.');
define('_LINKSNOTUSER4','Warum ben&ouml;tigen wir Ihre Registration, um Ihnen bestimmte Sachen freizuschalten?');
define('_LINKSNOTUSER5','Nur so k&ouml;nnen wir Ihnen den hohen Qualit&auml;tsstandard anbieten,');
define('_LINKSNOTUSER6','alles wird hier individuell begutachtet und erst dann freigeschaltet.');
define('_LINKSNOTUSER7','Wir hoffen, Ihnen informationsreiche Webseiten zur Verf&uuml;gung stellen zu k&ouml;nnen.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Mitglied werden</a>');
define('_LINKTITLE','Linkbezeichnung');
define('_LINKVOTE','Abstimmen!');
define('_LOOKTOREQUEST','Wir werden uns Ihren Vorschlag baldm&ouml;glichst ansehen.');
define('_LOWRATING','Niedrigste Bewertung');
define('_LTOTALVOTES','Stimmen- insgesamt');
define('_LVOTES','Stimmen');
define('_MAIN','Start');
if(!defined('_MODIFY')) define('_MODIFY','Modifizieren');
define('_MOSTPOPULAR','Beliebteste');
define('_NEW','Neu');
define('_NEWLAST3DAYS','In den letzten 3 Tagen neu');
define('_NEWLINKS','Neue Links');
define('_NEWTHISWEEK','Diese Woche neu');
define('_NEWTODAY','Heute neu');
define('_NEXT','N&auml;chste Seite');
define('_NOEDITORIAL','F&uuml;r diese Webseite ist bisher kein Editorial verf&uuml;gbar');
define('_NOMATCHES','Keine Treffer f&uuml;r diese Anfrage gefunden');
define('_NOOUTSIDEVOTES','Keine Abstimmenden von Extern');
define('_NOREGUSERSVOTES','Keine Stimmen von Mitgliedern');
define('_NOUNREGUSERSVOTES','Keine Stimmen von unregistrierten Teilnehmern');
define('_NUMBEROFRATINGS','Zahl der Stimmen');
define('_NUMOFCOMMENTS','Kommentaranzahl');
define('_NUMRATINGS','# der Stimmen');
if (!defined('_OF')) { define('_OF','von'); }
define('_OFALL','von allen');
define('_ONLYREGUSERSMODIFY','Nur registrierte Mitglieder k&ouml;nnen Link&auml;nderungen vorschlagen. Bitte <a href="modules.php?name=Your_Account">registrieren oder einloggen</a>.');
define('_OUTSIDEVOTERS','Extern abstimmenende');
define('_OVERALLRATING','Ingesamt bewertet');
define('_PAGETITLE','Seitentitel');
define('_PAGEURL','Seitenadresse- URL');
define('_POPULAR','Beliebt');
define('_POPULARITY','Beliebtheit');
define('_POPULARITY1','Beliebtheit (unbeliebteste oben)');
define('_POPULARITY2','Beliebtheit (beliebteste oben)');
define('_POSTPENDING','Alle vorgeschlagenen Links werden von unserem Team vor der Freigabe &uuml;berpr&uuml;ft.');
define('_PREVIOUS','Vorherige Seite');
define('_PROMOTE01','Vielleicht sind Sie ja an verschiedenen \'Bewerten Sie meine Webseite\'- Boxen interessiert, die wir anbieten? Diese erlauben Ihnen das platzieren eines Links, Button oder eines Abstimmformulars direkt auf Ihrer Webseite, um die Anzahl der Stimmen, die Ihre Webseite hier bekommt, zu erh&ouml;hen. Beachten Sie bitte, das wir bei einem begr&uuml;ndeten Betrugsverdacht uns vorbehalten, Ihren Link dauerhaft von unserer Seite zu entfernen. Bitte w&auml;hlen Sie nun aus einer der unten gegebenen M&ouml;glichkeiten eine f&uuml;r Ihre Webseite passende aus:');
define('_PROMOTE02','Eine M&ouml;glichkeit, Bewertungen in unserem System von Ihrer Webseite zu erhalten, ist ein Textlink:');
define('_PROMOTE03','Falls Ihnen der Sinn nach etwas mehr als einem Textlink steht, ist es vielleicht ein Buttonlink, den Sie gerne m&ouml;chten:');
define('_PROMOTE04','So k&ouml;nnte diese Box auf Ihrer Seite aussehen:');
define('_PROMOTE05','Vielen Dank! Und viel Erfolg bei der Linkbewertung!');
define('_PROMOTEYOURSITE','Bewerben Sie ihre Webseite');
define('_RANDOM','Zufall');
define('_RATEIT','Bewerten Sie diese Seite!');
define('_RATENOTE1','Bitte stimmen Sie &uuml;ber einen Link nicht mehrmals ab.');
define('_RATENOTE2','Die Skala reicht von 1 - 10, wobei 1 die schlechteste und 10 die beste Bewertung ist.');
define('_RATENOTE3','Bitte sind Sie objektiv beim Abstimmen. Wenn jeder mit 1 oder 10 abstimmt, sind die Ergebnisse nicht sonderlich aussagekr&auml;ftig.');
define('_RATENOTE4','Sie k&ouml;nnen sich eine &Uuml;bersicht der <a href="modules.php?name=Web_Links&amp;l_op=TopRated">bestbewerteten Seiten</a> anzeigen lassen.');
define('_RATENOTE5','Bitte bewerten Sie nicht Ihre eigene oder die Seite eines direkten Konkurrenten, Sie w&auml;ren ohnehin nicht objektiv.');
define('_RATESITE','Bewerte dieser Seite');
define('_RATETHISSITE','Bewerten');
define('_RATING','Bewertung');
define('_RATING1','Bewertung (erst schlechtbewertete)');
define('_RATING2','Bewertung (erst gutbewertete)');
define('_REGISTEREDUSERS','Registrierte Nutzer');
define('_REMOTEFORM','Externe Abstimmbox');
define('_REPORTBROKEN','Fehlerhaften Link melden');
define('_REQUESTLINKMOD','Link&auml;nderungs- Vorschlag');
define('_RETURNTO','Zur&uuml;ck nach');
define('_SCOMMENTS','Kommentare');
define('_SEARCHRESULTS4','Suche Ergebnisse f&uuml;r');
define('_SELECTPAGE','Seite ausw&auml;hlen');
define('_SENDREQUEST','Vorschlag senden');
define('_SHOW','Zeigen');
define('_SHOWTOP','Zeige Top');
define('_SITESSORTED','Seiten sind aktuell sortiert nach');
define('_SORTLINKSBY','Sortiere Links nach');
define('_STAFF','Die Mitarbeiter');
define('_SUBMITONCE','Bitte den gleichen Link nur einmal melden.');
define('_TEXTLINK','Textlink');
define('_THANKSBROKEN','Vielen Dank f&uuml;r Ihre Hilfe bei der Steigerung der Benutzbarkeit dieses Indexes.');
define('_THANKSFORINFO','Vielen Dank f&uuml;r diese Information.');
define('_THANKSTOTAKETIME','Vielen Dank f&uuml;r die Zeit, die Sie zum Bewerten einer Webseite aufgebracht haben hier auf');
define('_THENUMBER','Die Zahl');
define('_THEREARE','Es gibt');
define('_TITLE','Titel');
define('_TITLEAZ','Name (A nach Z)');
define('_TITLEZA','Name (Z nach A)');
define('_TO','zu');
define('_TOPRATED','Topbewertet');
define('_TOTALFORLAST','Insgesamt neue Links seit');
define('_TOTALNEWLINKS','Ingesamt neue Links');
define('_TOTALOF','von insgesamt');
define('_TOTALVOTES','gesamte Stimmen:');
define('_TRATEDLINKS','insgesamt bewerteten Links');
define('_TRY2SEARCH','Versuche die Suche');
define('_TVOTESREQ','Minimal notwendige Stimmen');
define('_UNREGISTEREDUSERS','Unregistrierte Teilnehmer');
define('_URL','URL');
define('_USER','Leuten');
define('_USERANDIP','Username und IP werden gespeichert, bitte missbrauchen Sie unser System nicht.');
define('_USERAVGRATING','Durchschnittliche Bewertung');
define('_USUBCATEGORIES','Unterkategorien');
define('_VISITTHISSITE','Website besuchen');
define('_VOTE4THISSITE','Bewerten Sie diese Seite!');
define('_WEBLINKS','Links');
define('_WEIGHNOTE','* Achtung: Diese Seite bewertet Stimmen von registrierten und unregistrierten Usern im Verh&auml;ltnis');
define('_WEIGHOUTNOTE','* Achtung: Diese Seite bewertet interne zu externen Stimmen im Verh&auml;ltnis');
define('_YOUARENOTREGGED','Sie sind kein registriertes Mitglied oder aber nicht eingeloggt.');
define('_YOUAREREGGED','Sie sind registriert und angemeldet.');
define('_YOUREMAIL','eMailadresse');
define('_YOURNAME','Dein Name');
?>