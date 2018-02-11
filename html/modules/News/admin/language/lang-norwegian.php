<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation go to the my web site and send to me         */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
define('_ACTIVATECOMMENTS','Aktivere kommentarer for denne artikkelen?');
define('_ADDARTICLE','Legg til ny artikkel');
define('_ALLSTORIES','Alle artikkler under');
define('_ANDCOMMENTS','og alle dens kommenatrer?');
define('_ARESUREURL','(Om du inkluderte noen nettadresser (URL\'er), vennligst sjekk dem for skrivefeil og s&oslash;rg for at de virker.)');
if (!defined('_AREYOUSURE')) define('_AREYOUSURE','Are you sure you included a URL? Did you test them for typos?');
define('_ARTICLEADMIN','Administrering av Nyheter/artikkler');
define('_ASELECTCATEGORY','Velg kategori');
define('_ATTACHAPOLL','Aktivere avstemming for denne artikkelen');
define('_AUTOSTORYEDIT','Editere automatisert/programmert artikkel');
define('_CATADDED','Ny kategori er lagt til!');
define('_CATDELETED','Kategorien er blitt slettet!');
define('_CATEGORIESADMIN','Administrering av kategorier');
define('_CATEGORYADD','Legg til en ny kategori');
define('_CATEGORYNAME','Kategorinavn');
define('_CATEXISTS','Denne kategorien finnes allerede!');
define('_CATNAME','Kategorinavn');
define('_CATSAVED','Kategorien er lagret!');
define('_CHNGPROGRAMSTORY','Velg en ny dato for denne artikkelen:');
define('_DELCATWARNING1','Du kan slette hele denne kategorien samt alle dens artikkler og kommentarer');
define('_DELCATWARNING2','eller du kan flytte alle artikklene til en ny/annen kategori.');
define('_DELCATWARNING3','Hva &oslash;nsker du &aring; gj&oslash;re?');
define('_DELETECATEGORY','Slette kategori');
define('_DELETESTORY','Slette artikkel');
define('_EDITARTICLE','Editere artikkel');
define('_EMAILUSER','Sende epost til Brukeren');
define('_EXTENDEDTEXT','Utvidet tekst');
define('_GOTOADMIN','G&aring; til Admin seksjonen');
define('_HAS','har');
define('_LEAVEBLANKTONOTATTACH','(La st&aring; blank for &aring; poste artikkelen uten avstemming)<br />(MERK: Automatiserte/programmerte artikkler kan ikke ha avstemminger)');
define('_MOVEDONE','Ok! Flyttingen ble vellykket gjennomf&oslash;rt!');
define('_MOVESTORIES','Flytte artikkler til en ny/annen kategori');
define('_NEWSUBMISSIONS','Nye innsendte artikkler');
define('_NOARTCATEDIT','Du kan ikke editere <span class="italic">Artikkel</span> Kategorien');
define('_NOMOVE','Nei! Flytt artikklene mine');
define('_NOSUBJECT','Ingen Overskrift/tittel');
define('_NOSUBMISSIONS','Ingen nye innsendelser');
define('_NOTAUTHORIZED1','Du har ikke tilgang til &aring; r&oslash;re denne artikkelen!');
define('_NOTAUTHORIZED2','Du kan ikke editere eller slette artikkler som andre har publisert');
define('_NOTES','Notater');
define('_NOWIS','N&aring; er');
define('_ONLYIFCATSELECTED','Gjelder bare hvis <span class="italic">Artikkelkategori</span> ikke er valgt');
if(!defined('_OPTION')) define('_OPTION','Valg');
define('_POLLEACHFIELD','(Skriv inn sp&oslash;rsm&aring;lene dine i feltene nedenfor - du bestemmer selv hvor mange, og er alts&aring; ikke n&oslash;dt til &aring; fylle ut alle 12 feltene.)');
define('_POLLTITLE','Avstemmingens tittel');
define('_POSTSTORY','Send inn artikkelen');
define('_PREVIEWSTORY','Forh&aring;ndsvis artikkelen');
define('_PROGRAMSTORY','&Oslash;nsker du &aring; programmere denne artikkelen?');
define('_PUBLISHINHOME','Publiseres p&aring; f&oslash;rstesiden?');
define('_REMOVESTORY','Er du sikker p&aring; du vil fjerne artikkel ID #');
define('_SELECTCATDEL','Velg Kategorien som skal slettes');
define('_SELECTNEWCAT','Vennligst velg den nye Kategorien');
define('_SELECTTOPIC','Velg Tema');
define('_SENDPM','Send Privat Melding');
define('_STORIESINSIDE','artikkler totalt');
define('_STORYTEXT','Artikkelens innholstekst');
define('_SUBMISSIONSADMIN','Administrering av innsendte Artikkler');
define('_THECATEGORY','Kategorien');
define('_USERPROFILE','Brukerprofil');
define('_WILLBEMOVED','vil bli flyttet.');
define('_YESDEL','Ja! Slett alle!');
if (!defined('_CATEGORY')) {define('_CATEGORY','Kategori'); }
define('_TONCONFIG','Tricked Out News Control Panel');
define('_TONSETUP','Control the features of Tricked Out News');
define('_NEWSROWS','News columns display on index page');
define('_BOOKMARK','Display Bookmarks on index?');
define('_RBLOCKS','Display right block for articles?');
define('_LINKLOCATION','Index Link locations');
define('_ARTICLELINK','Display Readmore in a colorbox?');
define('_ARTVIEW','View articles old style or new?');
define('_TONUTL','Link title to article?');
define('_TONPDF','Display PDF?');
define('_TONUR','Display User Rating?');
define('_TONSTF','Display Send to Friend?');
define('_TONUCL','Use character count on index?');
define('_TONCL','If so, how many characters do you want displayed?');
define('_TONTAACT','Activate Top Ads?');
define('_TONBAACT','Activate Bottom Ads?');
define('_TONDIS','Use Disqus?');
define('_TONSN','Disqus Short Name');
define('_TONTA','To insert an ad above the article, enter the ads position number here ');
define('_TONBA','To insert an ad below the article, enter the ads position number here ');
define('_TONGAPI','Goo.gl API Key');
define('_TONGSB','Use Goo.gl short url for social bookmarks?');
define('_TONGA','Display Goo.gl short url at bottom of article?');
define('_TONPREVIEW','Preview Ad:');
define('_TONSHOWTAGS','Show tags on article and index?');
define('_TAGSCLOUD','Tag Cloud');
define('_SEPARATEDBYCOMMAS','Separate by commas');
define('_TONMAIN','Admin Main');
define('_TONAUTOLINKWARNING','You need to set $tnsl_bAutoTapLinks to true in rnconfig');
?>
