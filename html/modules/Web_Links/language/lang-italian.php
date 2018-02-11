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
define('_1WEEK','1 settimana');
define('_2WEEKS','2 settimane');
define('_30DAYS','30 giorni');
define('_ADDALINK','Aggiungi un nuovo Link');
define('_ADDEDON','Aggiunto il');
define('_ADDITIONALDET','Informazioni aggiuntive');
define('_ADDLINK','Aggiungi link');
define('_ADDURL','Aggiungi questo URL');
define('_ALLOWTORATE','Abilita gli altri utenti a votarla direttamente dalle tue pagine web!!');
define('_AND','e');
define('_BESTRATED','Migliori Link - Top');
define('_BREAKDOWNBYVAL','Analisi Giudizi per Valore');
define('_BUTTONLINK','Pulsante Link');
define('_CATEGORIES','Categorie');
if (!defined('_CATEGORY')) define('_CATEGORY','Categoria');
define('_CATLAST3DAYS','Nuovi link aggiunti negli ultimi 3 giorni in questa categoria');
define('_CATNEWTODAY','Nuovi link aggiunti oggi in questa categoria');
define('_CATTHISWEEK','Nuovi link aggiunti questa settimana in questa categoria');
define('_CHECKFORIT','Non hai inserito una Email. Comunque controlleremo presto il tuo link.');
define('_COMPLETEVOTE1','Il tuo voto &egrave; gradito.');
define('_COMPLETEVOTE2','Hai gi&agrave; votato per questo argomento nei precedenti ' . "$anonwaitdays" . ' giorni.');
define('_COMPLETEVOTE3','Vota per un argomento solo una volta.<br />Tutti i voti sono registrati e valutati.');
define('_COMPLETEVOTE4','Non puoi votare un link inserito da te.<br />Tutti i voti sono registrati e valutati.');
define('_COMPLETEVOTE5','Nessuna valutazione selezionata - Nessun voto espresso');
define('_COMPLETEVOTE6','Solo un voto per indirizzo IP &egrave; permesso ogni ' . "$outsidewaitdays" . ' giorni.');
if (!defined('_DATE')) { define('_DATE','Data'); }
define('_DATE1','Data (Vecchi prima)');
define('_DATE2','Data (Nuovi prima)');
define('_DAYS','giorni');
define('_DESCRIPTION','Descrizione');
define('_DETAILS','Dettagli');
define('_EDITORIAL','Editoriale');
define('_EDITORIALBY','Editoriale di');
define('_EDITORREVIEW','Recensione Editore');
define('_EDITTHISLINK','Modifica questo link');
define('_EMAILWHENADD','Riceverai una Email quando sar&agrave; approvato.');
define('_FEELFREE2ADD','Aggiungi i commenti che vuoi in questo sito.');
define('_HIGHRATING','Maggiore');
define('_HITS','Hit');
define('_HTMLCODE1','Il codice HTML da usare in questo caso &egrave; il seguente:');
define('_HTMLCODE2','Il codice relativo &egrave;:');
define('_HTMLCODE3','Usando questo form si abilitano gli utenti a dare un giudizio direttamente dal proprio sito che viene da noi registrato. Il form sottostante &egrave; disabilitato, ma il seguente codice funziona perfettamente tagliando e incollando sulle proprie pagine il seguente codice:');
define('_IDREFER','nel codice HTML l\'identificativo del tuo sito nel database di ' . "$sitename" . '. Assicurati che questo numero sia presente e corretto.');
define('_IFYOUWEREREG','Quando sarai registrato potrai inviare tutti i commenti che vorrai in questo sito.');
define('_INDB','nel nostro database');
define('_INOTHERSENGINES','in altri motori di ricerca');
define('_INSTRUCTIONS','Istruzioni');
define('_ISTHISYOURSITE','E\' questa la tua risorsa?');
define('_LAST30DAYS','Ultimi 30 giorni');
define('_LASTWEEK','Ultima settimana');
define('_LDESCRIPTION','Descrizione: (255 caratteri max)');
define('_LETSDECIDE','L\'input da te fornito pu&ograve; aiutare gli altri visitatori a decidere pi&ugrave; facilmente su quali link cliccare.');
define('_LINKALREADYEXT','ERRORE: Questo URL &egrave; gi&agrave; presente nel database!');
define('_LINKCOMMENTS','Commenti');
define('_LINKID','ID Link');
define('_LINKNODESC','ERRORE: Devi inserire la DESCRIZIONE!');
define('_LINKNOTITLE','ERRORE: Devi inserire il TITOLO!');
define('_LINKNOURL','ERRORE: Devi inserire l\'URL!');
define('_LINKPROFILE','Profilo Link');
define('_LINKRATING','Dettagli Giudizio Sito');
define('_LINKRATINGDET','Dettagli Giudizio Sito');
define('_LINKRECEIVED','Abbiamo ricevuto la tua segnalazione. Grazie!');
define('_LINKS','Links');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','Indice link');
define('_LINKSMAINCAT','Indice categorie principali');
define('_LINKSNOCATS1','Ci deve essere almeno una categoria di link creata da'); //montego for RN0000571
define('_LINKSNOCATS2','l\'amministratore del sito prima di poter aggiungere un link.'); //montego for RN0000571
define('_LINKSNOTUSER1','Non sembri essere un Utente Registrato, se lo sei gi&agrave; allora devi fare il login.');
define('_LINKSNOTUSER2','Se sei registrato puoi aggiungere links sul nostro sito.');
define('_LINKSNOTUSER3','Registrarsi &egrave; un\'operazione semplice e veloce.');
define('_LINKSNOTUSER4','Perch&egrave; viene richiesta la registrazione per accedere ad alcuni servizi?');
define('_LINKSNOTUSER5','Perch&egrave; solo cos&igrave; possiamo offrire una migliore qualit&agrave; dei contenuti,');
define('_LINKSNOTUSER6','ogni articolo viene rivisto individualmente e approvato dal nostro staff.');
define('_LINKSNOTUSER7','Cerchiamo di offrire solo informazioni di un certo valore che ti possano essere preziose.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Registra il Tuo Account</a>');
define('_LINKTITLE','Titolo Link');
define('_LINKVOTE','Vota!');
define('_LOOKTOREQUEST','Esamineremo presto la tua richiesta.');
define('_LOWRATING','Inferiore');
define('_LTOTALVOTES','voti totali');
define('_LVOTES','voti');
define('_MAIN','Principale');
if(!defined('_MODIFY')) define('_MODIFY','Modifica');
define('_MOSTPOPULAR','Popolari - Top');
define('_NEW','Nuovi');
define('_NEWLAST3DAYS','Nuovo ultimi 3 giorni');
define('_NEWLINKS','Nuovi link');
define('_NEWTHISWEEK','Nuovo questa settimana');
define('_NEWTODAY','Nuovo oggi');
define('_NEXT','Pagina successiva');
define('_NOEDITORIAL','Nessun editoriale disponibile attualmente per questo sito.');
define('_NOMATCHES','Nessun risultato trovato per la tua ricerca');
define('_NOOUTSIDEVOTES','Nessun voto esterno');
define('_NOREGUSERSVOTES','Nessun voto da utenti registrati');
define('_NOUNREGUSERSVOTES','Nessun voto da utenti non registrati');
define('_NUMBEROFRATINGS','Numero di valutazioni');
define('_NUMOFCOMMENTS','Numero di commenti');
define('_NUMRATINGS','# di valutazioni');
if (!defined('_OF')) { define('_OF','di'); }
define('_OFALL','di tutti');
define('_ONLYREGUSERSMODIFY','Solo gli Utenti Registrati possono suggerire modifiche ai link. <a href=\"modules.php?name=Your_Account\">Registrazione/Login</a>.');
define('_OUTSIDEVOTERS','Votanti esterni');
define('_OVERALLRATING','Giudizio globale');
define('_PAGETITLE','Titolo pagina');
define('_PAGEURL','URL pagina');
define('_POPULAR','Popolare');
define('_POPULARITY','Popolarit&agrave;');
define('_POPULARITY1','Popolarit&agrave; (da meno a &ugrave; hit)');
define('_POPULARITY2','Popolarit&agrave; (da &ugrave; a meno hit)');
define('_POSTPENDING','Tutti i links passano la nostra verifica.');
define('_PREVIOUS','Pagina precedente');
define('_PROMOTE01','Se desideri promuovere efficacemente il tuo Sito, probabilmente sarai interessato a uno dei nostri svariati metodi di votazione a distanza che ti mettiamo a disposizione. Questi in pratica abilitano, sistemando una immagine (o un form di votazione) sul tuo sito, gli utenti a votarti direttamente da li incrementando il numero di voti ricevuti e quindi la visibilit&agrave; nella nostra directory con relativo aumento di click ricevuti. Scegli tra uno dei metodi illustrati sotto:');
define('_PROMOTE02','Un modo per linkare il form di votazione &egrave; attraverso un semplice link testuale:');
define('_PROMOTE03','Se vuoi un p&ograve; di pi&ugrave; che un semplice e basilare link testuale, puoi scegliere di inserire un piccolo bottone:');
define('_PROMOTE04','Abusi di questo sistema comportano la rimozione del link dal nostro database. Tienilo presente. Ecco come appare il corrente form di votazione a distanza.');
define('_PROMOTE05','Grazie! e buona fortuna!!');
define('_PROMOTEYOURSITE','Promuovi il tuo sito');
define('_RANDOM','Casuali');
define('_RATEIT','Esprimi un voto su questo sito!');
define('_RATENOTE1','Non votare per la stessa risorsa pi&ugrave; di una volta, grazie.');
define('_RATENOTE2','La scala &egrave; 1 - 10, dove 1 significa pessimo e 10 significa eccellente.');
define('_RATENOTE3','Sii il pi&ugrave; obiettivo possibile nel voto.');
define('_RATENOTE4','Puoi vedere la lista dei <a href="modules.php?name=Web_Links&amp;l_op=TopRated">Siti Top</a>.');
define('_RATENOTE5','Non votare da solo per il tuo sito o per quello dei tuoi concorrenti diretti, grazie');
define('_RATESITE','Vota questo sito');
define('_RATETHISSITE','Vota questa risorsa');
define('_RATING','Giudizio');
define('_RATING1','Giudizio (dai punteggi pi&ugrave; bassi a quelli pi&ugrave; alti)');
define('_RATING2','Giudizio (dai punteggi pi&ugrave; alti a quelli pi&ugrave; bassi)');
define('_REGISTEREDUSERS','Utenti registrati');
define('_REMOTEFORM','Form Votazione Remota');
define('_REPORTBROKEN','Segnala link errato');
define('_REQUESTLINKMOD','Richiesta di modifica al link');
define('_RETURNTO','Ritorna a');
define('_SCOMMENTS','Commenti');
define('_SEARCHRESULTS4','Risultati della ricerca di');
define('_SELECTPAGE','Seleziona pagina');
define('_SENDREQUEST','Invia richiesta');
define('_SHOW','Vedi');
define('_SHOWTOP','Vedi Top');
define('_SITESSORTED','Siti attualmente ordinati per');
define('_SORTLINKSBY','Ordina link per');
define('_STAFF','Staff');
define('_SUBMITONCE','Segnala un solo link alla volta.');
define('_TEXTLINK','Testo del link');
define('_THANKSBROKEN','Grazie per l\'aiuto a mantenere l\'integrit&agrave; di questa directory.');
define('_THANKSFORINFO','Grazie per l\'informazione.');
define('_THANKSTOTAKETIME','Grazie per aver speso un p&ograve; del tuo tempo per aver votato un sito');
define('_THENUMBER','Il numero');
define('_THEREARE','Ci sono');
define('_TITLE','Titolo');
define('_TITLEAZ','Titolo (da A a Z)');
define('_TITLEZA','Title (da Z a A)');
define('_TO','A');
define('_TOPRATED','Top');
define('_TOTALFORLAST','Totale nuovi links negli ultimi');
define('_TOTALNEWLINKS','Totale nuovi links');
define('_TOTALOF','Totale di');
define('_TOTALVOTES','Voti totali:');
define('_TRATEDLINKS','totale links votati');
define('_TRY2SEARCH','Prova a cercare');
define('_TVOTESREQ','minimo voti richiesti');
define('_UNREGISTEREDUSERS','Utenti Non Registrati');
define('_URL','URL');
define('_USER','Utente');
define('_USERANDIP','Il nome utente e l\'IP vengono registrati, quindi non abusare del sistema.');
define('_USERAVGRATING','Giudizio medio utenti');
define('_USUBCATEGORIES','Sotto-Categorie');
define('_VISITTHISSITE','Visita il sito');
define('_VOTE4THISSITE','Vota per questo sito!');
define('_WEBLINKS','Link web');
define('_WEIGHNOTE','* Nota: Questo sito valuta i Voti degli Utenti Registrati con quelli degli Anonimi');
define('_WEIGHOUTNOTE','* Nota: Questo sito valuta i Voti degli Utenti Registrati con quelli dei Votanti Esterni');
define('_YOUARENOTREGGED','Non sei un utente registrato e non sei connesso.');
define('_YOUAREREGGED','Sei un utente registrato e sei connesso.');
define('_YOUREMAIL','La tua Email');
define('_YOURNAME','Il tuo nome');
?>