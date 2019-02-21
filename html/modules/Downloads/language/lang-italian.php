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

define('_DL_1WEEK', '1 settimana');
define('_DL_2WEEKS', '2 settimane');
define('_DL_30DAYS', '30 giorni');
define('_DL_ACCEPT', 'Accetta');
define('_DL_ACTIVATE', 'Attiva');
define('_DL_ACTIVE_N', 'Inattivo');
define('_DL_ACTIVE_Y', 'Attivo');
define('_DL_ADD', 'Aggiungi');
define('_DL_ADDCATEGORY', 'Aggiungi Categoria');
define('_DL_ADDDOWNLOAD', 'Aggiungi Download');
define('_DL_ADDED', 'Aggiunto');
define('_DL_ADDEDON', 'Aggiunto il');
define('_DL_ADDEXTENSION', 'Aggiungi estensione');
define('_DL_ADMADMPERPAGE', '# di voci su ogni elenco che deve essere gestito');
define('_DL_ADMBLOCKUNREGMODIFY', 'Utenti non registrati possono suggerire delle modifiche');
define('_DL_ADMIN', 'Solo amministratori');
define('_DL_ADMMOSTPOPULAR', 'Voci pi&ugrave; popolari che devono essere mostrate');
define('_DL_ADMMOSTPOPULARTRIG', 'Mostra le voci pi&ugrave; popolari come');
define('_DL_ADMPERPAGE', '# di voci su ogni pagina');
define('_DL_ADMPOPULAR', '# di visite perch&egrave; sia POPOLARE');
define('_DL_ADMRESULTS', '# di voci su ogni pagina di ricerca');
define('_DL_ADMSHOWDOWNLOAD', 'Mostra i Downloads a tutti');
define('_DL_ADMSHOWNUM', 'Mostra # di voci per ogni categoria');
define('_DL_ADMUSEGFX', 'Usa il codice di sicurezza');
define('_DL_ALL', 'Tutti i visitatori');
define('_DL_ALREADYEXIST', 'esiste gi&agrave;!');
define('_DL_ANON', 'Solo utenti anonimi');
define('_DL_APPROVEDMSG', 'Il download che ci hai sottoposto &grave; stato approvato!');
define('_DL_AUTHOR', 'Autore');
define('_DL_BACKTO', 'Ritorna');
define('_DL_BEPATIENT', '(per favore porta pazienza)');
define('_DL_BROKENREP', 'Rapporto su link non funzionanti');
define('_DL_CANBEDOWN', 'Questo file pu&ograve; essere scaricato solo da');
define('_DL_CANBEVIEW', 'Questo file pu&ograve; essere visualizzato solo da');
define('_DL_CANUPLOAD', 'Permetti gli upload');
define('_DL_CATEGORIES', 'Categorie');
define('_DL_CATEGORIESADMIN', 'Amministratione delle categorie');
define('_DL_CATEGORIESLIST', 'Lista delle categorie');
define('_DL_CATTRANS', 'Spostamenti di categoria');
define('_DL_CHECK', 'Controlla');
define('_DL_CHECKALLDOWNLOADS', 'Controlla TUTTI i Download');
define('_DL_CHECKCATEGORIES', 'Controlla le categorie');
define('_DL_DATE', 'Data');
define('_DL_DATEADD', 'Aggiunto il');
define('_DL_DATEFORMAT', 'Formato data');
define('_DL_DATEMSG', 'La sintassi usata &egrave; identica alla funzione PHP <a href="http://www.php.net/date" target="_blank">date()</a>');
define('_DL_DAYS', 'giorni');
define('_DL_DBCONFIG', 'Errore nel database. Per favore segnala al gestore ddel sito di avviare la configurazione dei downloads!');
define('_DL_DCATLAST2WEEKS', 'Nuovi download in questa categoria aggiunti nelle ultime 2 settimane');
define('_DL_DCATLAST3DAYS', 'Nuovi download in questa categoria aggiunti negli ultimi 3 giorni');
define('_DL_DCATNEWTODAY', 'Nuovi download in questa categoria aggiunti oggi');
define('_DL_DCATTHISWEEK', 'Nuovi download in questa categoria aggiunti questa settimana');
define('_DL_DDATE1', 'Data (vecchi download elencati per primi)');
define('_DL_DDATE2', 'Data (nuovi download elencati per primi)');
define('_DL_DDELETEINFO', 'Elimina (Elimina i <span class="thick"><span class="italic">link a download non funzionanti</span></span> e le <span class="thick"><span class="italic">richieste</span></span> per un dato download)');
define('_DL_DEACTIVATE', 'Disattiva');
define('_DL_DELETE', 'Elimina');
define('_DL_DELETEDOWNLOAD', 'Elimina download');
define('_DL_DELEZDOWNLOADSCATWARNING', '!!!!ATTENZIONE!!!!<br />Sei sicuro di voler eliminare questa categoria?<br />Eliminerai anche tutte le sottocategorieed i download collegati!');
define('_DL_DENIED', 'Accesso al file vietato');
define('_DL_DIGNOREINFO', 'Ignora (Elimina tutte le <span class="thick"><span class="italic">richieste</span></span> per un dato download)');
define('_DL_DIRECTIONS', 'INDICAZIONI:');
define('_DL_DLNOTES1', 'Per scaricare il file "');
define('_DL_DLNOTES2', '", devi digitare nuovamente i codici visualizzati e cliccare sul pulsante qui sotto.');
define('_DL_DLNOTES3', '", clicca sul pulsante qui sotto.');
define('_DL_DLNOTES4', ' Tra poco comparir&agrave; la finestra dei dowload o sarai indirizzato al sito corretto.');
define('_DL_DN', 'Download');
define('_DL_DNODOWNLOADSWAITINGVAL', 'Non ci sono download in attesa di essere convalidati');
define('_DL_DNOREPORTEDBROKEN', 'Non ci sono link a download non funzionanti.');
define('_DL_DONLYREGUSERSMODIFY', 'Solo gli utenti registrati possono suggerire modifiche ai download. Per favore <a href="modules.php?name=Your_Account">registrati od esegui il login</a>.');
define('_DL_DOWNCONFIG', 'Configurazione Downloads');
define('_DL_DOWNLOAD', 'Download');
define('_DL_DOWNLOADALREADYEXT', 'ERRORE: Questo URL &egrave; gi&agrave; elencato nel nostro database!');
define('_DL_DOWNLOADAPPROVEDMSG', 'Abbiamo approvato la tua richiesta di download per il nostro motore di ricerca.');
define('_DL_DOWNLOADID', 'Numero file');
define('_DL_DOWNLOADMODREQUEST', 'Richieste di modifica download');
define('_DL_DOWNLOADNOW', 'Scarica questo file ora!');
define('_DL_DOWNLOADOWNER', 'Proprietario del download');
define('_DL_DOWNLOADPROFILE', 'Profilo del download');
define('_DL_DOWNLOADSADMIN', 'Amministratione dei download');
define('_DL_DOWNLOADSINDB', 'Download nel nostro database');
define('_DL_DOWNLOADSLIST', 'Lista Download');
define('_DL_DOWNLOADSMAIN', 'Pagina principale');
define('_DL_DOWNLOADSMAINCAT', 'Download - categorie principali');
define('_DL_DOWNLOADSMAINTAIN', 'Download - manutenzione');
define('_DL_DOWNLOADSWAITINGVAL', 'Download in attesa di convalida');
define('_DL_DOWNLOADVALIDATION', 'Convalida dei download');
define('_DL_DSCRIPT', 'Script Download');
define('_DL_DTOTALFORLAST', 'Nuovi download per gli ultimi');
define('_DL_DUSERMODREQUEST', 'Richieste di modifica download degli utenti');
define('_DL_DUSERREPBROKEN', 'Download non corretti riportati dagli utenti');
define('_DL_EDIT', 'Modifica');
define('_DL_ERROR', 'Errore');
define('_DL_ERRORNODESCRIPTION', 'ERRORE: devi inserire una DESCRIZIONE per il tuo URL!');
define('_DL_ERRORNOTITLE', 'ERRORE: devi inserire un TITOLO per il tuo URL!');
define('_DL_ERRORNOURL', 'ERRORE: devi inserire un URL per il tuo  URL!');
define('_DL_ERRORTHEEXTENSION', 'ERRORE: l\'estensione &egrave; gi&agrave; usata');
define('_DL_ERRORTHEEXTENSIONTYP', 'ERRORE: i tipi di estensioni non possono essere gli stessi');
define('_DL_ERRORTHEEXTENSIONVAL', 'ERRORE: l\'estensione ha un formato non valido');
define('_DL_ERRORTHESUBCATEGORY', 'ERRORE: la sottocategoria');
define('_DL_ERRORURLEXIST', 'ERRORE: questo URL &egrave; gi&agrave; inserito nel database!');
define('_DL_EXT', 'Estensione');
define('_DL_EXTENSION', 'Estensione');
define('_DL_EXTENSIONS', 'Estensioni');
define('_DL_EXTENSIONSADMIN', 'Amministrazione delle estensioni');
define('_DL_EXTENSIONSLIST', 'Lista delle estensioni');
define('_DL_EZATTACHEDTOCAT', 'sotto questa categoria');
define('_DL_EZSUBCAT', 'sottocategorie');
define('_DL_EZTHEREIS', 'C\'&egrave;/ci sono');
define('_DL_EZTRANSFER', 'Sposta');
define('_DL_EZTRANSFERDOWNLOADS', 'Spostamento di categoria di tutti i download');
define('_DL_FAILED', 'Respinto!');
define('_DL_FILE', 'file');
define('_DL_FILENAME', 'Nome del file');
define('_DL_FILES', 'file');
define('_DL_FILESDL', 'file scaricati');
define('_DL_FILESIZEVALIDATION', 'Convalida della grandezza del file');
define('_DL_FILETYPE', 'Tipo di file');
define('_DL_FLAGGED', 'Questo download &egrave; stato contrassegnato per essere rivisto dall\'amministratore.');
define('_DL_FNF', 'File non trovato:');
define('_DL_FNFREASON', 'Probabilmente chi gestisce il sito dove risiede il file, ha rimosso o rinominato il file stesso.');
define('_DL_FROM', 'Da');
define('_DL_FUNCTIONS', 'Funzioni');
define('_DL_GB', 'Gb');
define('_DL_GOGET', 'Vai e scarica');
define('_DL_HELLO', 'Ciao');
define('_DL_HITS', 'Download eseguiti');
define('_DL_ID', 'ID');
define('_DL_IGNORE', 'Ignora');
define('_DL_IMAGETYPE', 'Tipo di immagine');
define('_DL_INCLUDESUBCATEGORIES', '(Sottocategorie incluse)');
define('_DL_INVALIDDOWNLOAD', 'Questo identificativo di download non &egrave; valido.');
define('_DL_INVALIDPASS', 'Hai inserito un Passcode non valido.');
define('_DL_INVALIDURL', 'E\' stato passato allo script un URL non valido.');
define('_DL_KB', 'Kb');
define('_DL_LAST30DAYS', 'Ultimi 30 giorni');
define('_DL_LASTWEEK', 'Ultima settimana');
define('_DL_LEGEND', 'Legenda dei simboli');
define('_DL_LINKSDATESTRING', '%d-%b-%Y');
define('_DL_LOOKTOREQUEST', 'Esamineremo la tua richiesta a breve.');
define('_DL_MAIN', 'Principale');
define('_DL_MAINADMIN', 'Amministrazione del sito');
define('_DL_MB', 'Mb');
define('_DL_MODCATEGORY', 'Modifica una categoria');
define('_DL_MODDOWNLOAD', 'Modifica un download');
define('_DL_MODEXTENSION', 'Modifica estensione');
define('_DL_MODIFY', 'Modifica');
define('_DL_MODREQUEST', 'Richieste di modifica');
define('_DL_MOSTPOPULAR', 'Most Popular - Top');
define('_DL_NAME', 'Nome');
define('_DL_NEW', 'Nuovo');
define('_DL_NEWDOWNLOADADDED', 'Nuovo download aggiunto al database');
define('_DL_NEWDOWNLOADS', 'Nuovi download');
define('_DL_NEWLAST2WEEKS', 'Nuovi nelle ultime 2 settimane');
define('_DL_NEWLAST3DAYS', 'Nuovi negli ultimi 3 giorni');
define('_DL_NEWSIZE', 'Nuove dimensioni');
define('_DL_NEWTHISWEEK', 'Nuovi questa settimana');
define('_DL_NEWTODAY', 'Nuovi oggi');
define('_DL_NEXT', 'Pagina successiva');
define('_DL_NO', 'No');
define('_DL_NOCATTRANS', 'Non ci sono categorie nel database.');
define('_DL_NOMATCHES', 'Nessun risultato per la tua ricerca');
define('_DL_NOMODREQUESTS', 'There are no modification requests right now');
define('_DL_NONE', 'Nessuna');
define('_DL_NONEXT', 'Nessuna pagina successiva');
define('_DL_NOPREVIOUS', 'Nessuna pagina precedente');
define('_DL_NOTFOUND', 'non trovato.');
define('_DL_NOTLIST', 'Non presente in elenco');
define('_DL_NOTLOCAL', 'Non locale');
define('_DL_NUMBER', 'Numero');
define('_DL_OF', 'di');
define('_DL_OFALL', 'sul totale');
define('_DL_OK', 'OK');
define('_DL_OLDSIZE', 'Vecchie dimensioni');
define('_DL_ONLY', 'Solo');
define('_DL_ORIGINAL', 'Originale');
define('_DL_OTHERS', 'Altro');
define('_DL_OWNER', 'Proprietario');
define('_DL_PAGE', 'Pagina');
define('_DL_PAGES', 'Pagine');
define('_DL_PARENT', 'Categoria superiore');
define('_DL_PASSERR', 'Passcode errato');
define('_DL_PATHHIDE', 'Il percorso rimane nascosto');
define('_DL_PERCENT', 'Percentuale');
define('_DL_PERM', 'Permessi');
define('_DL_POPULAR', 'Popolare');
define('_DL_POPULARDLS', 'Download popolari');
define('_DL_POPULARITY', 'Popolarit&agrave;');
define('_DL_POPULARITY1', 'Popolarit&agrave; (da minori a maggiori visite)');
define('_DL_POPULARITY2', 'Popolarit&agrave; (da maggiori a minori visite)');
define('_DL_PREVIOUS', 'Pagina precedente');
define('_DL_PURPOSED', 'Intenzionato');
define('_DL_REPORTBROKEN', 'Segnala un link non funzionante');
define('_DL_REQUESTDOWNLOADMOD', 'Request Download Modification');
define('_DL_RESSORTED', 'Attualmente ordinati per');
define('_DL_RESTRICTED', 'Accesso al file &egrave; limitato');
define('_DL_SAVECHANGES', 'SALVA MODIFICHE');
define('_DL_SEARCH', 'Cerca');
define('_DL_SEARCHRESULTS4', 'Cerca risultati per');
define('_DL_SECURITYBROKEN', 'Per motivi di sicurezza il tuo nome utente ed il tuo indirizzo IP verranno registrati.');
define('_DL_SELECTPAGE', 'Seleziona pagina');
define('_DL_SENDREQUEST', 'Manda richiesta');
define('_DL_SHOW', 'Mostra');
define('_DL_SHOWTOP', 'Mostra pi&ugrave; scaricati');
define('_DL_SORRY', 'Spiacente');
define('_DL_SORTDOWNLOADSBY', 'Ordina i download per');
define('_DL_STATUS', 'Stato');
define('_DL_SUBMITTER', 'Submitter');
define('_DL_TDN', 'Download totali');
define('_DL_TEAM', 'Squadra.');
define('_DL_THANKS4YOURSUBMISSION', 'Thanks for your submission!');
define('_DL_THANKSBROKEN', 'Thank you for helping to maintain this directory\'s integrity.');
define('_DL_THANKSFORINFO', 'Grazie per l\'informazione.');
define('_DL_TIMES', 'volte');
define('_DL_TITLEAZ', 'Titolo (da A a Z)');
define('_DL_TITLEZA', 'Titolo (da Z ad A)');
define('_DL_TO', 'A');
define('_DL_TOTALDLCATEGORIES', 'Categorie totali');
define('_DL_TOTALDLFILES', 'File totali');
define('_DL_TOTALDLSERVED', 'Totali serviti');
define('_DL_TOTALNEWDOWNLOADS', 'Nuovi download totali');
define('_DL_TYPEPASS', 'Inserisci il Passcode');
define('_DL_UADD', 'Gli utenti possono aggiungere');
define('_DL_UP', 'Upload');
define('_DL_UPDIRECTORY', 'Percorso relativo:');
define('_DL_URLERR', 'Errore nell\'URL');
define('_DL_USERS', 'Solo utenti registrati');
define('_DL_USEUPLOAD', 'usato per gli upload dei file');
define('_DL_USUBCATEGORIES', 'Sottocategorie');
define('_DL_VALIDATEDOWNLOADS', 'Convalida i Download');
define('_DL_VALIDATESIZES', 'Convalida le grandezze dei file');
define('_DL_VALIDATINGCAT', 'Convalida le categorie');
define('_DL_VISIT', 'Visit');
define('_DL_WAITINGDOWNLOADS', 'Download in attesa');
define('_DL_WHOADD', 'Permessi per l\'invio dei file');
define('_DL_YES', 'Si');
define('_DL_YOUCANBROWSEUS', 'Puoi visualizzare il nostro motore dei download su:');
define('_DL_YOURDOWNLOADAT', 'Your Download at');
define('_DL_YOURPASS', 'Il tuo Passcode');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Email dell\'autore');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Nome dell\'autore');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'byte');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Categoria');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'Non hai inserito un indirizzo email, ma controlleremo presto il tuo link.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Descrizione');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Downloads');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Invia il singolo download solo una volta.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Grandezza del file');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'Homepage');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in byte');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'IP di chi invia il file');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Titolo');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Versione');

