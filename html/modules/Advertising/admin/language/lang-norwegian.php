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
define('_ADCLASS','Reklametype');
define('_ADCODE','Javascript/HTML Code');
define('_ADDADVERTISINGPLAN','Legg til Reklamepakke');
define('_ADDEDDATE','Lagt til den');
define('_ADDNEWPLAN','Legg til ny Reklamepakke');
define('_ADDNEWPOSITION','Legg til ny Reklameplassering');
define('_ADDPLANERROR','<span class="thick">FEIL:</span> Ett eller flere felter er tomme. Vennligst g&aring; tilbake og rett opp feilen.');
define('_ADDPOSITION','Ok! Legg til');
define('_ADFLASH','Flash');
define('_ADIMAGE','Bilde');
define('_ADINFOINCOMPLETE','<span class="thick">FEIL:</span> Reklamebanner-informasjonen er ikke komplett!');
define('_ADPOSITIONS','Plasseringer');
define('_ADSMODULEINACTIVE','[ Advarsel: Reklame-modulen er ikke aktivert! ]');
define('_ADSNOCLIENT','<span class="thick">FEIL:</span> Det finnes ingen Reklamekunder.<br />Vennligst legg til en Kunde f&oslash;r du pr&oslash;ver &aring; legge til et Reklamebanner.');
define('_ADVERTISINGPLANEDIT','Editere Reklamepakker');
define('_ADVERTISINGPLANS','Reklamepakker');
define('_ASSIGNEDADS','Tilknyttede annonser');
define('_BANNERNAME','Reklamebannerets navn');
define('_CANTDELETEPOSITION','<span class="thick">FEIL:</span> Du kan ikke slette alle plasseringene!. Det m&aring; v&aelig;re igjen minst &egrave;n i databasen.<br />Endre posisjonen istedet dersom du m&aring; forandre p&aring; den, eller legg til en ny plassering.');
define('_CLASS','Type');
define('_CLASSNOTE','Hvis Reklametype er Javascript/HTML Code vil de neste 4 feltene bli ignorert. Hvis Annonsetype er Flash m&aring; du f&oslash;rst legge inn fullstendig nettadresse (URL) til .SWF filen, samt sette b&aring;de bredde og h&oslash;yde p&aring; Flash videoen. (Feltene for Nettadresse for klikking og for pakke vil bli ignorert).');
define('_CLIENT','Kunde');
define('_COUNTRYNAME','Land');
define('_CURRENTPOSITIONS','N&aring;v&aelig;rende plasseringer');
define('_DELETEALLADS','Slett alle Reklamebannerne');
define('_DELETEPLAN','Slett reklamepakke');
define('_DELETEPOSITION','Slett reklameplassering');
define('_DELIVERY','Reklameringsmetode');
define('_DELIVERYQUANTITY','Reklameringsmengde');
define('_DELIVERYTYPE','Reklameringsmetode');
define('_EDITPOSITION','Endre reklamepossisjon');
define('_EDITTERMS','Endre betingelser');
define('_FLASHFILEURL','Nettadresse (URL) for Flash fil');
define('_FLASHSIZE','St&oslash;rrelse p&aring; Flash fil');
define('_HEIGHT','H&oslash;yde');
define('_IMAGESIZE','Bildest&oslash;rrelse');
define('_IMAGESWFURL','Nettadresse (URL) til Bilde eller Flash fil');
define('_IMPMADE','Visninger til n&aring;');
define('_IMPPURCHASED','Betalte visninger');
define('_INITIALSTATUS','Initial Status');
define('_INPIXELS','(st&oslash;rrelse i piksler)');
define('_MOVEADS','Flytt annonsene til');
define('_MOVEDADSSTATUS','Ny status p&aring; flyttede annonser');
define('_NOCHANGES','Ingen endringer');
define('_PDAYS','Dager');
define('_PLANBUYLINKS','Kj&oslash;p Linker');
define('_PLANDESCRIPTION','Beskrivelse av reklamepakken');
define('_PLANNAME','Reklamepakkens navn');
define('_PLANSNOTE','De forskjellige pakkene er kun ment som referanser og vil bli publisert i Annonseringsmodulen s&aring; Kunden vet hva du har &aring; tilby, betingelser, priser og en link for betaling av tjenesten.');
define('_PLANSPRICES','Pakker &amp; Priser');
define('_PMONTHS','M&aring;neder');
define('_POSEXAMPLE','Du kan ta en titt p&aring; filene <span class="italic">/blocks/block-Advertising.php</span> og <span class="italic">/header.php</span> for eksempler p&aring; hvordan man implementerer disse p&aring; siden.');
define('_POSINFOINCOMPLETE','<span class="thick">FEIL:</span> Feltet for Reklameplassens navn kan ikke v&aelig;re tomt.');
define('_POSITIONHASADS','Reklameplassen du valgte for sletting har Reklamebannere tilknytten den.<br />Vennligst velg en ny plassering for &aring; flytte alle Reklamebannerne.');
define('_POSITIONNAME','Reklameplassens navn');
define('_POSITIONNOTE','For &aring; kunne bruke Reklameplassen m&aring; du bruke koden: <span class="italic"> ads(possisjon);</span> i Theme filen din, der \'possisjon\' er nummeret for hvor du &oslash;nsker &aring; plassere Reklamebanneret.');
define('_POSITIONNUMBER','Reklameplass nummer');
define('_PRICE','Pris i kr.');
define('_PYEARS','&Aring;r');
define('_SAVEPOSITION','Lagre endringer');
define('_SITENAMEADS','(F&aring;r &aring; f&aring; med Nettside-navn i teksten, bruk [sitename] - og [country] for &aring; f&aring; med Land. Disse vil automatisk satt inn riktig av Annonseringsmodulen)');
define('_SURETODELPLAN','Du er iferd med &aring; slette en Reklamepakke. Er du sikker p&aring; at du &oslash;nsker &aring; fortsette?');
define('_SURETODELPOSITION','Du er i ferd med &aring; slette en Raklameplass. Er du sikker p&aring; at du vil fortsette?');
if (!defined('_TERMS')) define('_TERMS','Betingelser');
define('_TERMSNOTE','Vennligst les n&oslash;ye gjennom v&aring;re standard Betingelser. Endre p&aring; hva du m&aring;tte &oslash;nske i henhold til Reklamepakken du har valgt. Dette vil bli publisert via v&aring;r Annonseringsmodul.');
define('_TERMSOFSERVICEBODY','Betingelser for v&aring;re tjenester (Body)');
define('_WIDTH','Bredde');
define('_XFORUNLIMITED','skriv X for ubegrenset');

?>