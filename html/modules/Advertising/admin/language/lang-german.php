<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to my website and send to me      */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
define('_ADCLASS','Klasse hinzuf&uuml;gen');
define('_ADCODE','Javascript/HTML Code');
define('_ADDADVERTISINGPLAN','Werbeangebot hinzuf&uuml;gen');
define('_ADDEDDATE','Datum hinzugef&uuml;gt');
define('_ADDNEWPLAN','Neues Angebot hinzuf&uuml;gen');
define('_ADDNEWPOSITION','Werbe Position hinzuf&uuml;gen');
define('_ADDPLANERROR','<span class="thick">Error:</span> Ein oder mehrere Felder sind leer. Bitte geh zur&uuml;ck und korregiere das Problem.');
define('_ADDPOSITION','Position hinzuf&uuml;gen');
define('_ADFLASH','Flash');
define('_ADIMAGE','Bild');
define('_ADINFOINCOMPLETE','<span class="thick">Error:</span> Banner Informationen sind unvollst&auml;ndig!');
define('_ADPOSITIONS','Position der Werbung');
define('_ADSMODULEINACTIVE','[ Warnung: Das Werbungs-Modul ist inaktiv! ]');
define('_ADSNOCLIENT','<span class="thick">Error:</span> Es gibt keinen Werbe-Kunden.<br />Bitte erstelle einen neuen Kunden bevor du einen Banner hinzuf&uuml;gst.');
define('_ADVERTISINGPLANEDIT','Werbe-Angebot bearbeiten');
define('_ADVERTISINGPLANS','Werbe-Angebote');
define('_ASSIGNEDADS','Zweckgebundene Werbung');
define('_BANNERNAME','Banner Name');
define('_CANTDELETEPOSITION','<span class="thick">Error:</span> Du kannst nicht alle Positionen l&oumL,schen. Zumindest sollte es in der Datenbank vorhanden sein.<br />Bearbeite die Positionen, &auml;ndere sie oder f&uuml;ge eine neue hinzu.');
define('_CLASS','Klasse');
define('_CLASSNOTE','Wenn deine Klasse die du hinzuf&uuml;gst Javascript/HTML Code ist werden die n&auml;chsten 4 Felder ignoriert und nur der Code im unteren Bereich ben&ouml;tigt. Wenn die hinzugef&uuml;gte Klasse Flash sein soll musst du die komplette .SWF URL in in das n&auml;chste Feld einf&uuml;gen, und die Weite und H&ouml;he des Flash Films eingeben (Klicke URL und Alternative Textfelder werden ignoriert).');
define('_CLIENT','Kunde');
define('_COUNTRYNAME','Dein Land');
define('_CURRENTPOSITIONS','Derzeitige Werbe Position');
define('_DELETEALLADS','L&ouml;sche alle Banner');
define('_DELETEPLAN','Werbe-Angebot l&ouml;schen');
define('_DELETEPOSITION','Werbe Position l&ouml;schen');
define('_DELIVERY','Liefer-Art');
define('_DELIVERYQUANTITY','Liefer-Menge');
define('_DELIVERYTYPE','Lieferungs-Art');
define('_EDITPOSITION','Werbe Position bearbeiten');
define('_EDITTERMS','Benutzungsbestimmungen bearbeiten');
define('_FLASHFILEURL','Flash Datei URL');
define('_FLASHSIZE','Flash Film Gr&ouml;sse');
define('_HEIGHT','H&ouml;he');
define('_IMAGESIZE','Bild-Gr&ouml;sse');
define('_IMAGESWFURL','Bild oder Flash Datei URL');
define('_IMPMADE','Verbrauchte Imressionen');
define('_IMPPURCHASED','Impressionen Erworben');
define('_INITIALSTATUS','Initial Status');
define('_INPIXELS','(Gr&ouml;sse in Pixel)');
define('_MOVEADS','Verschiebe die Anzeige nach');
define('_MOVEDADSSTATUS','Neuer Status der verschobenen Anzeigen');
define('_NOCHANGES','Keine &Auml;nderungen');
define('_PDAYS','Tage');
define('_PLANBUYLINKS','Links kaufen');
define('_PLANDESCRIPTION','Angebots Beschreibung');
define('_PLANNAME','Angebots-Name');
define('_PLANSNOTE','Die Angebote dienen nur als Referenz und werden im Werbungs-Modul ver&ouml;ffentlicht, damit deine Kunden wissen, was du ihnen anbieten kannst, die Bedingungen, die Preise und einen Link was sie f&uuml;r deine Dienstleistung zu zahlen haben.');
define('_PLANSPRICES','Angebote & Preise');
define('_PMONTHS','Monate');
define('_POSEXAMPLE','Wirf einen Blick in die Datei <span class="italic">/blocks/block-Advertising.php</span> und <span class="italic">/header.php</span> wo du ein Beispiel siehst wie du es auf deine Seite implementieren kannst.');
define('_POSINFOINCOMPLETE','<span class="thick">Error:</span> Werbe Positions Namensfeld darf nicht leer sein.');
define('_POSITIONHASADS','Der Anzeige Position die du zum l&ouml;schen ausgew&auml;hlt hast sind Banner zugewiesen.<br />Bitte w&auml;hle eine neue Position um sie dort hin zu verschieben.');
define('_POSITIONNAME','Name der Position');
define('_POSITIONNOTE','Um die Position zu verwenden musst du den Code: <span class="italic"> ads(position);</span> in deine Theme Datei einf&uuml;gen, dabei ist "position" die Anzahl der gew&uuml;nschten Position die du in der Werbefl&auml;che nutzen m&ouml;chtest.');
define('_POSITIONNUMBER','Anzahl der Positionen');
define('_PRICE','Preis');
define('_PYEARS','Jahre');
define('_SAVEPOSITION','Speichern');
define('_SITENAMEADS','(Um den Seitennamen im Text einzuf&uuml;gen verwende [sitename] und um den L&auml;ndernamen einzuf&uuml;gen verwende [country] im Text. Das wird vom Modul selbst umgeneriert)');
define('_SURETODELPLAN','Du bist dabei ein Werbe-Angebot zu l&ouml;schen. Bist du sicher das du das tun m&ouml;chtest?');
define('_SURETODELPOSITION','Du bist dabei die Werbe Position zu l&ouml;schen. Bist du sicher das du das m&ouml;chtest?');
if (!defined('_TERMS')) define('_TERMS','Bestimmungen');
define('_TERMSNOTE','&Uuml;berpr&uuml;fe sorgf&auml;ltig die Nutzungsbedingungen. &Auml;ndere die Richtlinien nach der Politik deiner Werbeangebote. Das wird im Werbe Modul angezeigt.');
define('_TERMSOFSERVICEBODY','Nutzungsbedingungen-Bereich');
define('_WIDTH','Weite');
define('_XFORUNLIMITED','schreibe X f&uuml;r unlimitiert');

?>