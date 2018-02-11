<?php
/**********************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0
/* Written by: Jonathan Estrella
/* http://slaytanic.sourceforge.net
/* Copyright (c) 2004-2008 Jonathan Estrella
/**********************************************/
/* Translation by Susann http://su-s.com
/**********************************************/

define('_CP_SEND','Senden');
define('_CP_FUNCTIONS','Funktionen');
define('_CP_YES','Ja');
define('_CP_NO','Nein');
define('_CP_CATEGORY','Kategorie');
define('_CP_SAVECHANGES','&Auml;nderungen speichern');
define('_CP_PAGEBREAK','Wenn Sie mehrere Seiten m&ouml;chten, ben&uuml;tzen Sie <span class="thick">[--pagebreak--]</span> f&uuml;r einen Seitenumbruch.');
define('_CP_SIGNATURE','Signatur');
define('_CP_DESCRIPTION','Beschreibung');
define('_CP_TITLE','Titel');
define('_CP_ACTIVE','Aktiv');
define('_CP_DEACTIVATE','Deaktivieren');
define('_CP_INACTIVE','Inaktive');
define('_CP_ACTIVATE','Aktivieren');
define('_CP_CONTENT','Content');
define('_CP_ADDCATEGORY','Neue Kategorie hinzuf&uuml;gen');
define('_CP_EDITCATEGORY','Kategorie bearbeiten');
define('_CP_ADD','Hinzuf&uuml;gen');
define('_CP_LANGUAGE','Sprache');
define('_CP_CONTENTMANAGER','Content-Zusammenfassung');
define('_CP_DELCONTWARNING','Sind Sie sicher, dass Sie diese Seite l&ouml;schen m&ouml;chten');
define('_CP_DELCONTENT','Seite l&ouml;schen');
define('_CP_CURRENTSTATUS','Derzeitiger Status');
define('_CP_ADDANEWPAGE','Neue Seite hinzuf&uuml;gen');
define('_CP_CSUBTITLE','Untertitel');
define('_CP_HEADERTEXT','Kopftext');
define('_CP_PAGETEXT','Seitentext');
define('_CP_FOOTERTEXT','Footer Text');
define('_CP_ACTIVATEPAGE','Seite aktivieren?');
define('_CP_EDITPAGECONTENT','Bearbeite Seiteninhalt');
define('_CP_DELCONTENTCAT','WARNUNG: Sind Sie sicher, dass Sie diese Kategorie l&ouml;schen m&ouml;chten? Seiten in dieser Kategorie, werden nicht entfernt, falls sie existieren, aber sie werden zu keiner anderen Kategorie angef&uuml;gt .');
define('_CP_DELCATEGORY','Kategorie l&ouml;schen');

define('_CP_PAGESWAITING','Inhaltsseiten, die auf Validierung warten');
define('_CP_AUTHORNAME','Name des Autors');
define('_CP_DATEWRITTEN','Datum geschrieben');
define('_CP_PAGEID','ID der Seite');
define('_CP_ADDPAGE','Seite hinzuf&uuml;gen');
define('_CP_NONEWPAGES','Derzeitig gibts es keine auf validierung wartenden Seiten');
define('_CP_USERNAME','Benutzer');

define('_CP_CONTENTLIST','Content &Uuml;bersicht');
define('_CP_CONTENTEDIT','Bearbeite Inhalt');
define('_CP_CONTENTADDCAT','Kategorie hinzuf&uuml;gen');
define('_CP_CONTENTEDITCAT','Bearbeite Kategorie');
define('_CP_CONTENTADD','Inhalte hinzuf&uuml;gen');
define('_CP_CONTENTWAIT','Wartende Inhalte');
define('_CP_ADMININDEX','Website Verwaltung');
define('_CP_CEDIT','Bearbeiten');
define('_CP_CPIMAGE','Bild der Kategorie');
define('_CP_CPIMAGEWARNING','Muss im Verzeichnis sein');
define('_CP_CPADDERROR','Titel und Text k&ouml;nnen nicht leer sein');
define('_CP_CPSAVESUCCESS','Ihr neuer Inhalt wurde erfolgreich hinzugef&uuml;gt');
define('_CP_CPFEAT','Spezielle Inhalte');
define('_CP_CPSELECTFEAT','W&auml;hlen Sie einen Sonderartikel f&uuml;r jede Kategorie');

// 2.0.5
define('_CP_FILTERBYCAT','Filter-Liste nach Kategorie');
define('_CP_NEXTPAGE','N&auml;chste Seite');
define('_CP_PREVPAGE','Vorige Seite');

// 2.0.7
define('_CP_STATUS','Status');
define('_CP_GOBACK','[ <a href="javascript:history.go(-1)">zur&uuml;ck</a> ]');
define('_CP_EDIT','Bearbeiten');
define('_CP_DELETE','L&ouml;schen');
define('_CP_NONE','Keine');
define('_CP_SAVE','Speichern');

// 2.0.8
define('_CP_PUBLISHEDON','Datum der Ver&ouml;ffentlichung');

// 2.1.1
define('_CP_ERRORUPLOAD','Ein Fehler ist aufgetreten beim Laden der Datei');
define('_CP_ERRORFILEEXIST','Die bestimmte Datei existiert bereits auf dem Server');
define('_CP_ERRORMOVE','Datei konnte nicht in das ausgew&auml;hlte Verzeichnis kopiert werden');
define('_CP_ERRORTYPE','Dateityp wird nicht unterst&uuml;tzt (muss GIF, JPEG oder PNG sein)');
define('_CP_UPLOADNEWIMG','Neues Bild hochladen');
define('_CP_CATADD_ERR','Ein Fehler ist aufgetreten. Titel und/oder Beschreibung d&uuml;rfen nicht leer sein.');

// 2.2.0
define('_CP_TAGS','Tags');
define('_CP_MANAGECONTENT','Verwalte Inhalte');
define('_CP_MANAGECATS','Verwalte Kategorien');
define('_CP_MANAGEWAITING','Verwalte wartende Inhalte');
define('_CP_ABOUT','&Uuml;ber');
define('_CP_ADMINSUMMARY','Zusammenfassung');
define('_CP_TOTALCATS','Kategorien insgesammt');
define('_CP_TOTALPAGES','Seiten insgesammt');
define('_CP_TOTALPAGESWAITING','Wartende Seiten insgesammt');
define('_CP_TOTALACTIVE','Aktive Seiten insgesammt');
define('_CP_TOTALINACTIVE','Inaktive Seiten insgesammt');
define('_CP_TOTALNONCAT','Nicht kategorisierte Seiten insgesammt');
define('_CP_MOSTVIEWED','Meist betrachtete Seite');
define('_CP_LESSVIEWED','Wenig betrachtete Seite');
define('_CP_DATESTRING','%B %d, %Y %I:%M %p %Z');
define('_CP_DATEFIRSTADD','Datum des ersten Beitrags');
define('_CP_DATELASTADD','Datum des letzten Beitrags');
define('_CP_NONEWPAGES2','Sie werden noch weitere Contentseiten hinzuf&uuml;gen wollen, um das zu tun, w&auml;hlen Sie bitte die zust&auml;ndige Option aus dem obigen Men&uuml;.');
define('_CP_ERROR','Fehler');

// 2.2.1
define('_CP_SHOWCATIMAGES','Kategorie-Bilder');
define('_CP_CLOSEWINDOW','Fenster schliessen');
define('_CP_UPLOADWARNING','Beachte, dass das Bilderverzeichnis Schreibrechte haben muss(CHMOD 666 oder 777)');
define('_CP_CURRENTIMG','Derzeitiges Bild');
define('_CP_BROWSE','Durchsuchen');
?>