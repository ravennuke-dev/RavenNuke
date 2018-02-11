<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/* German translation by http://su-s.com                */
/********************************************************/
/*
 * Do not remove the following defined statement.  Make sure this is here
 * also within EVERY translation of this English file.
 */
define('_DL_LANG_MODULE', true);
/*
 * End of key language file define.  You may modify any text in the below
 * lines, but do not change the name of the constant that is being defined!
 */

define('_DL_1WEEK', '1 Woche');
define('_DL_2WEEKS', '2 Wochen');
define('_DL_30DAYS', '30 Tage');
define('_DL_ACCEPT', 'Akzeptiert');
define('_DL_ACTIVATE', 'Aktivieren');
define('_DL_ACTIVE_N', 'Inaktive');
define('_DL_ACTIVE_Y', 'Aktive');
define('_DL_ADD', 'Hinzuf&uuml;gen');
define('_DL_ADDCATEGORY', 'Kategorie hinzuf&uuml;gen');
define('_DL_ADDDOWNLOAD', 'Download hinzuf&uuml;gen');
define('_DL_ADDED', 'Hinzugef&uuml;gt');
define('_DL_ADDEDON', 'Hinzugef&uuml;gt am');
define('_DL_ADDEXTENSION', 'Erweiterung hinzuf&uuml;gen');
define('_DL_ADMADMPERPAGE', '# an Eintr&auml;gen auf jeder Admin Liste');
define('_DL_ADMBLOCKUNREGMODIFY', 'Unregistrierte Benutzer d&uuml;rfen &Auml;nderungen vorschlagen');
define('_DL_ADMIN', 'Nur Administratoren');
define('_DL_ADMMOSTPOPULAR', 'Beliebteste Eintr&auml;ge zu zeigen');
define('_DL_ADMMOSTPOPULARTRIG', 'Zeige Beliebteste als');
define('_DL_ADMPERPAGE', '# an Eintr&auml;gen auf jeder Seite');
define('_DL_ADMPOPULAR', '# an Hits, um als beliebt zu gelten');
define('_DL_ADMRESULTS', '# an Eintr&auml;gen auf jeder Suchseite');
define('_DL_ADMSHOWDOWNLOAD', 'Zeige Downloads allen');
define('_DL_ADMSHOWNUM', 'Zeige # an Eintr&auml;ge f&uuml;r jede Kategorie');
define('_DL_ADMUSEGFX', 'Benutze Sicherheitscode');
define('_DL_ALL', 'Alle Besucher');
define('_DL_ALREADYEXIST', 'existiert bereits!');
define('_DL_ANON', 'Nur anonyme Besucher');
define('_DL_APPROVEDMSG', 'Ihr eingereichter Download wurde angenommen!');
define('_DL_AUTHOR', 'Autor');
define('_DL_BACKTO', 'Zur&uuml;ck zu');
define('_DL_BEPATIENT', '(Bitte gedulden Sie sich)');
define('_DL_BROKENREP', 'Bericht defekter Downloads');
define('_DL_CANBEDOWN', 'Diese Datei kann heruntergeladen werden von');
define('_DL_CANBEVIEW', 'Diese Datei kann angesehen werden von');
define('_DL_CANUPLOAD', 'Erlaube Uploads');
define('_DL_CATEGORIES', 'Kategorien');
define('_DL_CATEGORIESADMIN', 'Kategorien Administration');
define('_DL_CATEGORIESLIST', 'Kategorien Liste');
define('_DL_CATTRANS', 'Kategorie Transfer');
define('_DL_CHECK', 'Check');
define('_DL_CHECKALLDOWNLOADS', '&Uuml;berpr&uuml;fe alle Downloads');
define('_DL_CHECKCATEGORIES', '&Uuml;berpr&uuml;fe Kategorien');
define('_DL_DATE', 'Datum');
define('_DL_DATEADD', 'Hinzugef&uuml;gt am');
define('_DL_DATEFORMAT', 'Datum Format');
define('_DL_DATEMSG', 'Die verwendete Syntax ist identisch zur PHP <a href="http://www.php.net/date" target="_blank">Datum()</a> Funktion');
define('_DL_DAYS', 'Tage');
define('_DL_DBCONFIG', 'Datenbank-Fehler. Bitte informieren Sie den Webmaster, die Download Konfiguration zu &uuml;berpr&uuml;fen!');
define('_DL_DCATLAST2WEEKS', 'Neue Downloads in dieser Kategorie hinzugefügt in den letzten 2 Wochen');
define('_DL_DCATLAST3DAYS', 'Neue Downloads in dieser Kategorie hinzugefügt in den letzten 3 Tagen');
define('_DL_DCATNEWTODAY', 'Neue Downloads in dieser Kategorie heute hinzugefügt');
define('_DL_DCATTHISWEEK', 'Neue Downloads in dieser Kategorie hinzugefügt diese Woche');
define('_DL_DDATE1', 'Datum (&auml;ltere Downloads zuerst gelistet)');
define('_DL_DDATE2', 'Datum (Neue Downloads zuerst gelistet)');
define('_DL_DDELETEINFO', 'L&ouml;sche (L&ouml;scht <span class="thick"><span class="italic">Defekten Download</span></span> und <span class="thick"><span class="italic">Anfrage</span></span> f&uuml;r einen bestimmten Download)');
define('_DL_DEACTIVATE', 'Deaktivieren');
define('_DL_DELETE', 'L&ouml;schen');
define('_DL_DELETEDOWNLOAD', 'Download l&ouml;schen');
define('_DL_DELEZDOWNLOADSCATWARNING', '!!!!WARNUNG!!!!<br />Sind Sie sicher, dass Sie diese Kategorie l&ouml;schen wollen?<br />Sie l&ouml;schen damit ebenfalls alle Sub-Kategorien und beigef&uuml;gten Downloads !');
define('_DL_DENIED', 'Datei Zugriff verweigert');
define('_DL_DIGNOREINFO', 'Ignoriere (L&ouml;scht alle <span class="thick"><span class="italic">Anfragen</span></span> f&uuml;r einen bestimmten Download)');
define('_DL_DIRECTIONS', 'ANWEISUNG:');
define('_DL_DLNOTES1', 'Um die Datei herunterzuladen "');
define('_DL_DLNOTES2', '", m&uuml;ssen Sie den angezeigten Sicherheitscode eingeben und den Button unten klicken.');
define('_DL_DLNOTES3', '", klicken Sie auf den Button unten.');
define('_DL_DLNOTES4', ' In K&uuml;rze werden Sie den Download erhalten oder auf die entsprechende Seite weitergeleitet werden.');
define('_DL_DN', 'Downloads');
define('_DL_DNODOWNLOADSWAITINGVAL', 'Es gibt keine auf &Uuml;berpr&uuml;fung wartende Downloads');
define('_DL_DNOREPORTEDBROKEN', 'Keine defekten Downloads gemeldet.');
define('_DL_DONLYREGUSERSMODIFY', 'Nur registrierte Benutzer k&ouml;nnen &Auml;nderungen an Downloads vorschlagen. Bitte <a href="modules.php?name=Your_Account">Registrieren oder Einloggen</a>.');
define('_DL_DOWNCONFIG', 'Downloads Konfiguration');
define('_DL_DOWNLOAD', 'Download');
define('_DL_DOWNLOADALREADYEXT', 'FEHLER: Diese URL befindet sich bereits in der Datenbank!');
define('_DL_DOWNLOADAPPROVEDMSG', 'Wir haben Ihre Download Einsendung f&uuml;r unser Suchverzeichnis genehmigt.');
define('_DL_DOWNLOADID', 'Dateinummer');
define('_DL_DOWNLOADMODREQUEST', 'Download&auml;nderungen Anfragen');
define('_DL_DOWNLOADNOW', 'Download diese Datei jetzt!');
define('_DL_DOWNLOADOWNER', 'Download Besitzer');
define('_DL_DOWNLOADPROFILE', 'Download Profil');
define('_DL_DOWNLOADSADMIN', 'Downloads Administration');
define('_DL_DOWNLOADSINDB', 'Downloads in unserer Datenbank');
define('_DL_DOWNLOADSLIST', 'Liste Downloads');
define('_DL_DOWNLOADSMAIN', 'Downloads &Uuml;bersicht');
define('_DL_DOWNLOADSMAINCAT', 'Downloads Haupt-Kategorien');
define('_DL_DOWNLOADSMAINTAIN', 'Downloads Wartung');
define('_DL_DOWNLOADSWAITINGVAL', 'Downloads auf Best&auml;tigung wartend');
define('_DL_DOWNLOADVALIDATION', 'Download Best&auml;tigung');
define('_DL_DSCRIPT', 'Download Script');
define('_DL_DTOTALFORLAST', 'Insgesamt neue Downloads der letzten');
define('_DL_DUSERMODREQUEST', 'Benutzeranfrage Download&auml;nderung');
define('_DL_DUSERREPBROKEN', 'Von Benutzer gemeldete defekte Downloads');
define('_DL_EDIT', 'Editieren');
define('_DL_ERROR', 'Fehler');
define('_DL_ERRORNODESCRIPTION', 'FEHLER: Sie m&uuml;ssen eine Beschreibung f&uuml;r ihre URL angeben!');
define('_DL_ERRORNOTITLE', 'FEHLER: Sie m&uuml;ssen einen TITEL f&uuml;r ihre URL eingeben!');
define('_DL_ERRORNOURL', 'FEHLER: Sie m&uuml;ssen eine URL f&uuml;r ihre URL angeben!');
define('_DL_ERRORTHEEXTENSION', 'FEHLER: Erweiterung wird bereits verwendet');
define('_DL_ERRORTHEEXTENSIONTYP', 'FEHLER: Art der Erweiterung darf nicht die gleiche sein');
define('_DL_ERRORTHEEXTENSIONVAL', 'FEHLER: Erweiterung hat ung&uuml;ltiges Format');
define('_DL_ERRORTHESUBCATEGORY', 'FEHLER: Die Sub-Kategorie');
define('_DL_ERRORURLEXIST', 'FEHLER: Diese URL ist bereits in der Datenbank gelistet!');
define('_DL_EXT', 'Extension');
define('_DL_EXTENSION', 'Erweiterung');
define('_DL_EXTENSIONS', 'Erweiterungen');
define('_DL_EXTENSIONSADMIN', 'Administration Erweiterungen');
define('_DL_EXTENSIONSLIST', 'Liste der Erweiterungen');
define('_DL_EZATTACHEDTOCAT', 'unter dieser Kategorie');
define('_DL_EZSUBCAT', 'Sub-Kategorien');
define('_DL_EZTHEREIS', 'Es gibt/sind');
define('_DL_EZTRANSFER', 'Transfer');
define('_DL_EZTRANSFERDOWNLOADS', 'Transferiere alle Downloads von Kategorie');
define('_DL_FAILED', 'Fehlgeschlagen!');
define('_DL_FILE', 'Datei');
define('_DL_FILENAME', 'Dateiname');
define('_DL_FILES', 'Dateien');
define('_DL_FILESDL', 'Dateien heruntergeladen');
define('_DL_FILESIZEVALIDATION', 'Dateigr&ouml;&szlig;e &Uuml;berpr&uuml;fung');
define('_DL_FILETYPE', 'Dateityp');
define('_DL_FLAGGED', 'Dieser Download wurde automatisch gekennzeichnet zur &Uuml;berpr&uuml;fung durch den Webmaster.');
define('_DL_FNF', 'Datei nicht gefunden:');
define('_DL_FNFREASON', 'Es k&ouml;nnte sein, dass die Person, die den Download hostet, die Datei umbenannt oder den Download entfernt hat.');
define('_DL_FROM', 'Von');
define('_DL_FUNCTIONS', 'Funktionen');
define('_DL_GB', 'Gb');
define('_DL_GOGET', 'Los gehts');
define('_DL_HELLO', 'Hallo');
define('_DL_HITS', 'Hits');
define('_DL_ID', 'ID');
define('_DL_IGNORE', 'Ignorieren');
define('_DL_IMAGETYPE', 'Bildtyp');
define('_DL_INCLUDESUBCATEGORIES', 'Sub-Kategorien einschliessen');
define('_DL_INVALIDDOWNLOAD', 'Diese Download ID ist ung&uuml;ltig.');
define('_DL_INVALIDPASS', 'Sie haben einen ung&uuml;ltigen Code eingegeben.');
define('_DL_INVALIDURL', 'Eine ung&uuml;ltige URL wurde eingegeben.');
define('_DL_KB', 'Kb');
define('_DL_LAST30DAYS', 'Letzte 30 Tage');
define('_DL_LASTWEEK', 'Letzte Woche');
define('_DL_LEGEND', 'Legende der Symbole');
define('_DL_LINKSDATESTRING', '%d-%b-%Y');
define('_DL_LOOKTOREQUEST', 'Wir werden Ihre Anfrage in K&uuml;rze pr&uuml;fen.');
define('_DL_MAIN', '&Uuml;bersicht');
define('_DL_MAINADMIN', 'Seiten-Administration');
define('_DL_MB', 'Mb');
define('_DL_MODCATEGORY', 'Kategorie modifizieren');
define('_DL_MODDOWNLOAD', 'Download modifizieren');
define('_DL_MODEXTENSION', 'Erweiterung modifizieren');
define('_DL_MODIFY', 'Modifizieren');
define('_DL_MODREQUEST', '&Auml;nderungsanfragen');
define('_DL_MOSTPOPULAR', 'Beliebteste - Top');
define('_DL_NAME', 'Name');
define('_DL_NEW', 'Neu');
define('_DL_NEWDOWNLOADADDED', 'Neuer Download in die Databank hinzugef&uuml;gt');
define('_DL_NEWDOWNLOADS', 'Neue Downloads');
define('_DL_NEWLAST2WEEKS', 'Letzte 2 Wochen neu');
define('_DL_NEWLAST3DAYS', 'Letzte 3 Tage neu');
define('_DL_NEWSIZE', 'Neue Gr&ouml;sse');
define('_DL_NEWTHISWEEK', 'Diese Woche neu');
define('_DL_NEWTODAY', 'Heute neu');
define('_DL_NEXT', 'N&auml;chste Seite');
define('_DL_NO', 'Nein');
define('_DL_NOCATTRANS', 'Es gibt keine Kategorien in der Datenbank.');
define('_DL_NOMATCHES', 'Keine Treffer gefunden');
define('_DL_NOMODREQUESTS', 'Es gibt keine &Auml;nderungsanfragen im Moment');
define('_DL_NONE', 'Keine');
define('_DL_NONEXT', 'Keine n&auml;chste Seite');
define('_DL_NOPREVIOUS', 'Keine vorige Seite');
define('_DL_NOTFOUND', 'wurde nicht gefunden.');
define('_DL_NOTLIST', 'Nicht gelistet');
define('_DL_NOTLOCAL', 'Nicht lokal');
define('_DL_NUMBER', 'Nummer');
define('_DL_OF', 'von');
define('_DL_OFALL', 'von allen');
define('_DL_OK', 'OK');
define('_DL_OLDSIZE', 'Alte Gr&ouml;sse');
define('_DL_ONLY', 'Nur');
define('_DL_ORIGINAL', 'Original');
define('_DL_OTHERS', 'Andere');
define('_DL_OWNER', 'Besitzer');
define('_DL_PAGE', 'Seite');
define('_DL_PAGES', 'Seiten');
define('_DL_PARENT', 'Bereich');
define('_DL_PASSERR', 'Sicherheitscode Fehler');
define('_DL_PATHHIDE', 'Pfad bleibt verborgen');
define('_DL_PERCENT', 'Prozent');
define('_DL_PERM', 'Rechte');
define('_DL_POPULAR', 'Beliebt');
define('_DL_POPULARDLS', 'Beliebte Downloads');
define('_DL_POPULARITY', 'Beliebtheit');
define('_DL_POPULARITY1', 'Beliebtheit (Unbeliebteste)');
define('_DL_POPULARITY2', 'Beliebtheit (Beliebteste)');
define('_DL_PREVIOUS', 'Vorherige Seite');
define('_DL_PURPOSED', 'Beabsichtigte');
define('_DL_REPORTBROKEN', 'Defekten Link melden');
define('_DL_REQUESTDOWNLOADMOD', 'Anfrage Download&auml;nderung');
define('_DL_RESSORTED', 'Ressourcen derzeit sortiert nach');
define('_DL_RESTRICTED', 'Dateizugriff beschr&auml;nkt');
define('_DL_SAVECHANGES', '&Auml;nderungen speichern');
define('_DL_SEARCH', 'Suche');
define('_DL_SEARCHRESULTS4', 'Suchergebnisse f&uuml;r');
define('_DL_SECURITYBROKEN', 'Benutzername and IP Adresse werden aus Sicherheitsgr&uuml;nden gespeichert.');
define('_DL_SELECTPAGE', 'Seite ausw&auml;hlen');
define('_DL_SENDREQUEST', 'Anfrage senden');
define('_DL_SHOW', 'Zeige');
define('_DL_SHOWTOP', 'Zeige Top');
define('_DL_SORRY', 'Sorry');
define('_DL_SORTDOWNLOADSBY', 'Downloads sortieren nach');
define('_DL_STATUS', 'Status');
define('_DL_SUBMITTER', 'Einsender');
define('_DL_TDN', 'Downloads insgesamt');
define('_DL_TEAM', 'Team.');
define('_DL_THANKS4YOURSUBMISSION', 'Danke für Ihre Einsendung!');
define('_DL_THANKSBROKEN', 'Vielen Dank f&uuml;r Ihre Unterst&uuml;tzung bei der Aufrechterhaltung der Integrit&auml;t dieses Verzeichnisses. ');
define('_DL_THANKSFORINFO', 'Danke f&uuml;r die Information.');
define('_DL_TIMES', 'Mal');
define('_DL_TITLEAZ', 'Titel (A bis Z)');
define('_DL_TITLEZA', 'Titel (Z bis A)');
define('_DL_TO', 'Nach');
define('_DL_TOTALDLCATEGORIES', 'Gesamtzahl Kategorien');
define('_DL_TOTALDLFILES', 'Gesamtzahl Dateien');
define('_DL_TOTALDLSERVED', 'Insgesamt bereitgestellt');
define('_DL_TOTALNEWDOWNLOADS', 'Neue Downloads insgesamt');
define('_DL_TYPEPASS', 'Tippe Sicherheitscode');
define('_DL_UADD', 'Benutzer k&ouml;nnen hinzuf&uuml;gen');
define('_DL_UP', 'Uploads');
define('_DL_UPDIRECTORY', 'Relativer Pfad');
define('_DL_URLERR', 'URL Fehler');
define('_DL_USERS', 'Nur registrierte Benutzer');
define('_DL_USEUPLOAD', 'Benutzt f&uuml;r Datei Uploads');
define('_DL_USUBCATEGORIES', 'Sub-Kategorien');
define('_DL_VALIDATEDOWNLOADS', 'Pr&uuml;fe Downloads');
define('_DL_VALIDATESIZES', 'Pr&uuml;fe Dateigr&ouml;&szlig;en');
define('_DL_VALIDATINGCAT', 'Best&auml;tige Kategorie');
define('_DL_VISIT', 'Besuche');
define('_DL_WAITINGDOWNLOADS', 'Wartende Downloads');
define('_DL_WHOADD', 'Einsendung Rechte');
define('_DL_YES', 'Ja');
define('_DL_YOUCANBROWSEUS', 'Sie können unsere Downloads durchsuchen bei:');
define('_DL_YOURDOWNLOADAT', 'Ihr Download bei');
define('_DL_YOURPASS', 'Ihr Sicherheitscode');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Autor\'s Email');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Autor\'s Name');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'Bytes');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Kategorie');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'Sie haben keine Email Adresse angegeben, aber wir werden Ihren Link baldigst &uuml;berpr&uuml;fen.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Beschreibung');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Downloads');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Download nur einmalig hinzuf&uuml;gen.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Dateigr&ouml;&szlig;e');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'Homepage');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in Bytes');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'IP Einsender');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Titel');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Version');

