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
/************************************************************************
* Italian Translation by Luca Negrini
* http://www.sportsverona.com
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
define('_MSNL_COM_LAB_GOBACK', 'INDIETRO');
define('_MSNL_COM_LAB_ERRMSG', 'MESSAGGIO D\'ERRORE');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Posiziona il tuo cursore sopra queste icone'
	. ' per un aiuto dettagliato');
define('_MSNL_COM_LNK_GOBACK', 'Clicca per tornare indietro alla pagina precedente');
define('_MSNL_COM_ERR_SQL', 'TROVATO ERRORE NELL\' SQL');
define('_MSNL_COM_ERR_MODULE', 'ERRORE NEL MODULO');
define('_MSNL_COM_ERR_VALMSG', 'I CAMPI CHE SEGUONO HANNO FALLITO LA VALIDAZIONE');
define('_MSNL_COM_ERR_VALWARNMSG', 'I CAMPI CHE SEGUONO AVEVANO DEI WARNINGS');
define('_MSNL_COM_ERR_DBGETCFG', 'Non sono riuscito a recuperare informazioni sulla configurazione del modulo!');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Si, questo &#232; come non dovrebbe essere mai fatto!');
/************************************************************************
* Function: General Use Defines
************************************************************************/
define('_MSNL_COM_LAB_MODULENAME', 'HTML Newsletter');
define('_MSNL_LAB_ADMIN', 'Amministrazione');
//Module Menu Labels and Link Titles
define('_MSNL_LAB_CREATENL', 'Crea&nbsp;una&nbsp;Newsletter');
define('_MSNL_LAB_MAINCFG', 'Configurazione&nbsp;principale');
define('_MSNL_LAB_CATEGORYCFG', 'Configurazione&nbsp;delle&nbsp;categorie');
define('_MSNL_LAB_MAINTAINNLS', 'Gestisci&nbsp;le&nbsp;Newsletter');
define('_MSNL_LAB_SENDTESTED', 'Spediscine&nbsp;una&nbsp;Testata');
define('_MSNL_LAB_SITEADMIN', 'Amministrazione&nbsp;del&nbsp;sito');
define('_MSNL_LAB_NLARCHIVES', 'Archivi');
define('_MSNL_LAB_NLDOCS', 'Documentazione&nbsp;On-Line');
define('_MSNL_LNK_CREATENL', 'Crea una newsletter');
define('_MSNL_LNK_MAINCFG', 'Configura le opzioni del');
define('_MSNL_LNK_CATEGORYCFG', 'Gestisci la lista di categorie di newsletter');
define('_MSNL_LNK_MAINTAINNLS', 'Mantieni le newsletter esistenti');
define('_MSNL_LNK_SENDTESTED', 'Manda l\'ultima newsletter testata');
define('_MSNL_LNK_SITEADMIN', 'Vai al menu amministrazione dell\'intero sito');
define('_MSNL_LNK_NLARCHIVES', 'Vai alla lista degli archivi delle newsletter');
define('_MSNL_LNK_NLDOCS', 'Vai alla documentazione on-line di HTML Newsletter');
define('_MSNL_ERR_NOTAUTHORIZED', 'Non hai le autorizzazioni per amministrare questo modulo');
//Common use Defines
define('_MSNL_COM_LAB_ACTIONS', 'Azioni');
define('_MSNL_COM_LAB_ACTIVE', 'Attivo');
define('_MSNL_COM_LAB_ADD', 'AGGIUNGI');
define('_MSNL_COM_LAB_ALL', 'TUTTI');
define('_MSNL_COM_LAB_GO', 'VAI');
define('_MSNL_COM_LAB_INACTIVE', 'Inattivo');
define('_MSNL_COM_LAB_LANG', 'Linguaggio');
define('_MSNL_COM_LAB_NO', 'No');
define('_MSNL_COM_LAB_PREVIEW', 'Anteprima');
define('_MSNL_COM_LAB_SAVE', 'SALVA');
define('_MSNL_COM_LAB_SHOW_ALL', '**Mostra tutto**');
define('_MSNL_COM_LAB_SEND', 'Manda');
define('_MSNL_COM_LAB_VERSION', 'Versione');
define('_MSNL_COM_LAB_YES', 'Si');
define('_MSNL_COM_LNK_ADD', 'Click per aggiungere i dati sopra');
define('_MSNL_COM_LNK_CANCEL', 'Cancella la transazione');
define('_MSNL_COM_LNK_CONTINUE', 'Continua la transazione');
define('_MSNL_COM_LNK_SAVE', 'Click per salvare i cambiamenti sui dati sopra');
define('_MSNL_COM_LNK_SEND', 'Manda la  newsletter');
define('_MSNL_COM_LNK_PREVIEW', 'Validazione e Anteprima della newsletter');
define('_MSNL_COM_ERR_MSG', 'MSG DI ERRORE');
define('_MSNL_COM_ERR_DBGETCATS', 'Recuper delle categorie di newsletter fallito');
define('_MSNL_COM_ERR_FILENOTEXIST', 'Il file non esiste');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', 'Non si riesce a scrivere il file della newsletter - Controlla che i permessi dul direttorio dell\'archivio siano settati a 777');
define('_MSNL_COM_ERR_DBGETPHPBB', 'Non riesco a recuperare le informazioni sulla configurazione del forum phpBB');
define('_MSNL_COM_ERR_DBGETRECIPIENTS', 'Non riesco a recuperare il numero di destinatari per:');
define('_MSNL_COM_MSG_WARNING', 'Warning!');
define('_MSNL_COM_MSG_UPDSUCCESS', 'Aggiornamento eseguito con successo!');
define('_MSNL_COM_MSG_ADDSUCCESS', 'Aggiunta eseguita con successo!');
define('_MSNL_COM_MSG_DELSUCCESS', 'Cancellazione eseguita con successo!');
define('_MSNL_COM_MSG_REQUIRED', 'I campi richiesti devono avere un valore');
define('_MSNL_COM_MSG_POSNONZEROINT', 'Richiede un valore intero positivo non nullo');
define('_MSNL_COM_HLP_ACTIONS', 'Posiziona il cursore '
	. 'sopra ognuna delle icone qui sotto per vedere quale azione avverr&agrave; se vi si clicca sopra.');
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Visualizza i diritti d\'autore ed i crediti');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/
//Section: Letter
define('_MSNL_ADM_LAB_LETTER', 'Lettera');
define('_MSNL_ADM_LAB_TOPIC', 'Argomento');
define('_MSNL_ADM_LAB_SENDER', 'Nome del mittente');
define('_MSNL_ADM_LAB_NLSCAT', 'Categoria');
define('_MSNL_ADM_LAB_TEXTBODY', 'Testo della Newsletter');
define('_MSNL_ADM_LAB_HTMLOK', '(i tag HTMLsono permessi)');
define('_MSNL_ADM_HLP_TOPIC', 'Questo testo sostituisce il tag {EMAILTOPIC} nel modello selezionato. Siccome questo tag solitamente si trova su una linea assieme ad altri tag, sarebbe preferibile mantenerlo corto, diciamo, al di sotto dei 40 caratteri. Soloi seguenti tag HTML sono permessi in questo campo: & lt;b& gt; & lt;i& gt; & lt;u& gt;.');
define('_MSNL_ADM_HLP_SENDER', 'Questo testo sostituisce il tag {SENDER} nel modello selezionato. Siccome questo tag solitamente si trova su una linea assieme ad altri tag, sarebbe preferibile mantenerlo corto, diciamo, al di sotto dei 20 caratteri. Soloi seguenti tag HTML sono permessi in questo campo: & lt;b& gt; & lt;i& gt; & lt;u& gt;.');
define('_MSNL_ADM_HLP_NLSCAT', 'Semplicemente scegli la categoria nella quale inserire questa newsletter. Le categorie di Newsletter possono essere usate per organizzare le newsletter del sito in specifici argomenti chiave. Le Newsletter possono essere elencate sotto le loro rispettive categorie usando il link di configurazione sotto la funzione di amministrazione \'Configurazione Principale\'.');
define('_MSNL_ADM_HLP_TEXTBODY', 'Questo &egrave; il punto in cui andr&agrave; il testo principale della tua newsletter. La cosa pi&ugrave; opportuna &egrave; quella di scrivere i tuoi contenuti HTML usando un buon editor WYSIWYG finch&egrave; non ottieni quello che desideri, e poi fare un copia-e-incolla del codice HTML all\'interno di questa area di testo. Questo testo HTML andr&agrave; a sostituire il tag {TEXTBODY} nel modello prescelto.<br /><br /> I tag HTML sono permessi, ma sarebbe pi&ugrave; saggio considerare i programmi di posta elettronica dei destinatari ed individuare i browser (per gli archivi) per assicurare il miglior risultato possibile a tutti.<br /><br />Nel caso ci sia un testo lungo nella newsletter, potresti voler usare i tag \'anchor\' per <span class="thick">sottolineare</span> alcune sezioni.  Dai loro nomi descrittivi e poi controlla il checkbox <span class="thick">Includi Tabella dei Contenuti</span> sottostante e queste \'anchor\' diventeranno dei link all\'interno della Tabella dei Contenuti nella tua newsletter!<br /><br />Per esempio, si potrebbe usare: <span class="thick">& lt;a name=\'Sezione Uno\'& gt;& lt;/a& gt;</span>. <span class="thick">NOTA:</span> Deve essere ESATTAMENTE come mostrato con i doppi apici ED il tag \'anchor\' di chiusura! Questo esempio creer&agrave; un link chiamato <span class="thick">Sezione Uno</span> all\'interno della Tabella dei Contenuti e cliccandovi sopra, porter&agrave; il viewer nella corretta posizione all\'interno del testo.');
//Section: Templates
define('_MSNL_ADM_LAB_TEMPLATES', 'Modelli');
define('_MSNL_ADM_LAB_CHOOSETMPLT', 'Scegli un modello');
define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'Clicca per visualizzare un\'immagine dimostrativa del modello');
define('_MSNL_ADM_HLP_TEMPLATES', 'La lista sottostante &egrave; derivata dal set corrente di modelli presenti nel tuo direttorio modules/HTML_Newsletter/templates/. Se decidi di scegliere <span class="thick">Nessun modello</span>, il sistema semplicemente mander&agrave; ai tuoi destinatari una email con il testo da te inserito qui sopra nell\'area di testo <span class="thick">Testo Newsletter</span>.<br /><br />Per creare una newsletter da un modello, selezionane uno dalla lista. Per vedere un esempio di come sar&agrave; la tua newsletter, clicca sull\'icona <span class="thick">Visualizza</span> alla destra del testo con il nome del modello.<br /><br />Puoi anche creare i tuoi modelli ed inserirli nel direttorio dei modelli.  <span class="thick">Suggerimento:</span> basati sul modello Fancy_Content in quanto questo &egrave; l\'unico modello di esempio che l\'autore di questo strumento continuer&agrave; ad aggiornare con le nuove release del modulo <i>HTML Newsletter</i>!');
//Section: Stats and Newsletter Contents
define('_MSNL_ADM_LAB_STATS', 'Statistiche e contenuti della Newsletter');
define('_MSNL_ADM_LAB_INCLSTATS', 'Includi le statistiche del sito');
define('_MSNL_ADM_LAB_INCLTOC', 'Includi la tabella dei contenuti');
define('_MSNL_ADM_HLP_INCLSTATS', 'Questa opzione permette di includere le statistiche principali del tuo sito nei modelli che hanno il tag {STATS} al loro interno. Osserva i modelli d\'esempio per capire quali statistiche saranno mostrate.');
define('_MSNL_ADM_HLP_INCLTOC', 'Questa opzione permette di includere un \'blocco\' Tabella dei Contenuti nei modelli che hanno il tag {TOC} al loro interno - per esempio osserva il modello di esempio per Fancy_Content. Il blocco TOC avr&agrave; dei link ad ognuno dei blocchi <span class="thick">Ultime voci per xxxxxx</span> cos&igrave; come link a tutte le  <span class="thick">ancore</span> incluse all\'interno dell\'area di testo <span class="thick">Testo della Newsletter</span>.');
//Section: Include Latest Items
define('_MSNL_ADM_LAB_INCLLATEST', 'Includi le ultime voci');
define('_MSNL_ADM_LAB_INCLLATESTDLS', 'Ultime voci per "Downloads"');
define('_MSNL_ADM_LAB_INCLLATESTWLS', 'Ultime voci per "Web-Links"');
define('_MSNL_ADM_LAB_INCLLATESTFORS', 'Ultime voci per i "Forum"');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', 'Ultime voci per "Novit&agrave;"');
define('_MSNL_ADM_LAB_INCLLATESTREVS', 'Ultime voci per "Recensioni"');
define('_MSNL_ADM_HLP_INCLLATESTNEWS', 'Controlla il numero degli ultimi articoli da mostrare nella newsletter. Gli articoli saranno in ordine cronologico partendo dal pi&ugrave; recente. Usa un valore pari a 0 (zero) per non mostrare le informazioni sugli Ultimi Articoli nella newsletter. I valori inseriti qui vengono passati da newsletter a newsletter, ma puoi cambiarli in qualsiasi momento e per qualsiasi newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTDLS', 'Controlla il numero degli ultimi download da mostrare nella newsletter. I download saranno in ordine cronologico partendo dal pi&ugrave; recente. Usa un valore pari a 0 (zero) per non mostrare le informazioni sugli Ultimi Download nella newsletter. I valori inseriti qui vengono passati da newsletter a newsletter, ma puoi cambiarli in qualsiasi momento e per qualsiasi newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTWLS', 'Controlla il numero degli ultimi web link da mostrare nella newsletter. I web link saranno in ordine cronologico partendo dal pi&ugrave; recente. Usa un valore pari a 0 (zero) per non mostrare le informazioni sugli Ultimi Web Link nella newsletter. I valori inseriti qui vengono passati da newsletter a newsletter, ma puoi cambiarli in qualsiasi momento e per qualsiasi newsletter.');
define('_MSNL_ADM_HLP_INCLLATESTFORS', 'Controlla il numero degli ultimi post sul forum da mostrare nella newsletter. I post saranno in ordine cronologico partendo dal pi&ugrave; recente. Usa un valore pari a 0 (zero) per non mostrare le informazioni sugli Ultimi Post sul Forum nella newsletter. I valori inseriti qui vengono passati da newsletter a newsletter, ma puoi cambiarli in qualsiasi momento e per qualsiasi newsletter. In aggiunta, verranno mostrati solo i post dei forum pubblici (in lettura).');
define('_MSNL_ADM_HLP_INCLLATESTREVS', 'Controlla il numero delle ultime recensioni da mostrare nella newsletter. Le recensioni saranno in ordine cronologico partendo dalla pi&ugrave; recente. Usa un valore pari a 0 (zero) per non mostrare le informazioni sulle Ultime Recensioni nella newsletter. I valori inseriti qui vengono passati da newsletter a newsletter, ma puoi cambiarli in qualsiasi momento e per qualsiasi newsletter.');
//Section: Sponsors
define('_MSNL_ADM_LAB_SPONSORS', 'Sponsor');
define('_MSNL_ADM_LAB_CHOOSESPONSOR', 'Scegli uno Sponsor');
define('_MSNL_ADM_LAB_NOSPONSOR', 'Nessuno sponsor');
define('_MSNL_ADM_HLP_CHOOSESPONSOR', 'Scegliendo uno sponsor verr&agrave; sostituito il tag {BANNER} nel modello della newsletter con l\'immagine, il link ed il testo alternativo selezionati dal sistema di banner.');
define('_MSNL_ADM_ERR_DBGETBANNERS', 'Non si riesce a recuperare informazioni sul banner dello sponsor');
//Section: Who to Send the Newsletter To
define('_MSNL_ADM_LAB_WHOSNDTO', 'A chi vuoi che sia mandata la Newsletter?');
define('_MSNL_ADM_LAB_CHOOSESENDTO', 'Scegli le opzioni del destinatario/i');
define('_MSNL_ADM_LAB_WHOSNDTONLSUBS', 'Solo ai sottoscrittori della Newsletter');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG', 'A TUTTI gli utenti registrati');
define('_MSNL_ADM_LAB_WHOSNDTOPAID', 'Solo ai sottoscrittori PAGANTI');
define('_MSNL_ADM_LAB_WHOSNDTOANONY', 'A tutti i visitatori del sito - NESSUNA email viene spedita, '
	. 'ma qualsiasi visitatore pu&ograve; vedere la newsletter');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS', 'Uno o pi&ugrave; Gruppi NSN - scegli il gruppo/i sotto');
define('_MSNL_ADM_LAB_WHOSNDTOADM', 'Newsletter di prova (SOLO agli amministratori)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS', 'utenti sottoscrittori');
define('_MSNL_ADM_LAB_USERS', 'Utenti');
define('_MSNL_ADM_LAB_PAIDUSRS', 'utenti paganti');
define('_MSNL_ADM_LAB_NSNGRPUSRS', 'Utenti dei Gruppi NSN');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC', 'Lista di distribuzione di email Ad-Hoc');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV', 'TUTTI i visitatori del sito');
define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', 'Questa opzione permette di mandare la newsletter a tutti gli utenti nuke che hanno scelto di ricevere la newsletter del tuo sito attraverso le preferenze del loro account.');
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', 'Questa opzione permette di mandare la newsletter a tutti gli utenti nuke registrati al sito. Presta attenzione nell\'usare questa opzione in quanto i tuoi utenti potrebbero non apprezzare il fatto di ricevere una newsletter che non hanno richiesto.');
define('_MSNL_ADM_HLP_WHOSNDTOPAID', 'Questa opzione permette di mandare la newsletter a tutti gli utenti nuke che sono sottoscrittori paganti (paid subscribers) - ad esempio quelli con sottoscrizioni attive.');
define('_MSNL_ADM_HLP_NSNGRPUSRS', 'Questa opzione permette di scegliere uno o pi&ugrave; Gruppi NSN qui sotto ai quali spedire la newsletter.');
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', 'Scegliendo questa opzione NON viene spedita una newsletter ma, piuttosto, la newsletter verr&agrave; mostrata all\'interno del blocco e degli archivi.Comunque, devi ricordarti che i permessi sul blocco e sui moduli devono comunque essere impostati come desiderato.');
define('_MSNL_ADM_HLP_WHOSNDTOADM', 'Questa opzione permette di mandare la newsletter a SOLAMENTE A TE, come amministratore del sito. Dopo aver calidato la newsletter puoi spedirla ai destinatari che hai deciso usando il link <span class="thick">Spediscine Una Testata</span> che si trova nella parte superiore di questa pagina.');
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', 'Questa opzione permette di mandare la newsletter ad uno o pi&ugrave; indirizzi di posta elettronica a tua scelta. Devi semplicemente separare ogni indirizzo con una virgola E DEVI assicurarti che gli indirizzi siano validi.');
//Section: NSN Groups
define('_MSNL_ADM_LAB_CHOOSENSNGRP', 'A quali Gruppo/i NSN mandarlo?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', '(la selezione sar&agrave; ignorata se l\'opzione Gruppi NSN  sopra non &egrave; selezionata)');
define('_MSNL_ADM_LAB_WHONSNGRP', 'Scegli uno o pi&ugrave; gruppi');
define('_MSNL_ADM_ERR_DBGETNSNGRPS', 'Non si riesce a recuperare le informazioni sui Gruppi NSN');
define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', 'Scegli uno o pi&ugrave; gruppi qui sotto. La newsletter sar&agrave; mandata a tutti gli utenti nuke che sono nel/i gruppo/i scelto/i. Se un utente &egrave; elencato in pi&ugrave; gruppi, la newsletter gli verr&agrave; inoltrata solamente una volta.');
/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/
define('_MSNL_ADM_PREV_LAB_VALPREVNL', 'Crea una Newsletter - Validazione e Anteprima');
define('_MSNL_ADM_PREV_LAB_PREVNL', 'Anteprima Newsletter');
define('_MSNL_ADM_PREV_MSG_SUCCESS', 'La Newsletter ha superato la fase di validazione ed &egrave; pronta '
	. 'per l\'anteprima sotto');
/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/
define('_MSNL_ADM_LAB_NSNGRPS', 'Gruppi NSN');
define('_MSNL_ADM_VAL_NONSNGRP', 'Hai scelto di mandare ad un Gruppo NSN ma '
	. 'non hai selezionato un gruppo al quale mandarla');
define('_MSNL_ADM_ERR_NOTEMPLATE', 'Possibile tentativo di hack - nessun modello scelto');
define('_MSNL_ADM_VAL_NOSENDTO', 'Nessuna opzione Manda A scelta');
define('_MSNL_ADM_ERR_DBUPDLATEST', 'C\'&egrave; stato un errore nell\'aggiornare \'Le ultime _____\' informazioni sulla configurazione');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/
define('_MSNL_ADM_SEND_LAB_SENDNL', 'Crea una Newsletter - Manda Mail');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM', 'Testa Newsletter da');
define('_MSNL_ADM_SEND_LAB_NLFROM', 'Newsletter da');
define('_MSNL_ADM_SEND_MSG_ANONYMOUS', 'La Newsletter &egrave; stata aggiunta per essere vista da TUTTI i visitatori');
define('_MSNL_ADM_SEND_MSG_LOTSSENT', 'Pi&ugrave; di 500 visitatori riceveranno la '
	. 'newsletter, per questo ci si pu&ograve; impiegare anche pi&ugrave; di 10 minuti and PHP pu&ograve; andare in time-out.');
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Total Emails to Send');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS', 'Le email della Newsletter sono state mandate con successo');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE', 'La spedizione alle email della Newsletter &egrave; fallita');
define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL', 'Non si riesce a trovare il file testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW', 'Inserita una opzione di vista non valida');
define('_MSNL_ADM_SEND_ERR_CREATENL', 'Non &egrave; posibile copiare da testemail '
	. 'al dile della newsletter');
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT', 'Non si riesce ad inserire la newsletter nel database');
define('_MSNL_ADM_SEND_ERR_DBNLSNID', 'Non si riesce a recuperare il NID della newsletter appena inserita');
define('_MSNL_ADM_SEND_ERR_MAIL', 'Errore nella funzione PHP mail - non si riesce a spedire la '
	. 'newsletter a:');
define('_MSNL_ADM_SEND_ERR_DELFILETEST', 'Cancellazione del file testemail.php fallita');
define('_MSNL_ADM_SEND_ERR_DELFILETMP', 'Cancellazione del file tmp.php fallita');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', 'Non si riesce a recuperare le statistiche sul numero di utenti');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', 'Non si riesce a recuperare le statistiche sul numero di hit totali sul sito');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', 'Non si riesce a recuperare le statistiche sul numero di articoli');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', 'Non si riesce a recuperare le statistiche sul numero di categorie sugli articoli');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', 'Non si riesce a recuperare le statistiche sul numero di download');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', 'Non si riesce a recuperare le statistiche sul numero di categorie sui download');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', 'Non si riesce a recuperare le statistiche sul numero di web links');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', 'Non si riesce a recuperare le statistiche sul numero di categorie sui web link');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', 'Non si riesce a recuperare le statistiche sul numero di forum');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', 'Non si riesce a recuperare le statistiche sul numero di post sui forum');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', 'Non si riesce a recuperare le statistiche sul numero di recensioni');
define('_MSNL_ADM_SEND_ERR_DBGETNEWS', 'Non si riesce a recuperare gli ultimi articoli');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', 'Non si riesce a recuperare gli ultimi download');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', 'Non si riesce a recuperare gli ultimi web link');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', 'Non si riesce a recuperare gli ultimi post sui forum');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', 'Non si riesce a recuperare le ultime recensioni');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', 'Non si riesce a recuperare i banner');
/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/
define('_MSNL_ADM_TEST_LAB_PREVNL', 'Anteprima della Newsletter testata da mandare');
/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/
define('_MSNL_CFG_LAB_MAINCFG', 'Configurazione del modulo principale');
//Module Options
define('_MSNL_CFG_LAB_MODULEOPT', 'Opzioni del modulo');
define('_MSNL_CFG_LAB_DEBUGMODE', 'Modalit&agrave; Debug');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', 'OFF');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', 'ERRORE');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', 'TUTTO');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', 'Output del debug');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', 'DISPLAY');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', 'FILE DI LOG');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', 'ENTRAMBI');
define('_MSNL_CFG_LAB_SHOWBLOCKS', 'Mostra i blocchi a destra');
define('_MSNL_CFG_LAB_NSNGRPS', 'Usa i Gruppi NSN');
define('_MSNL_CFG_LAB_DLMODULE', 'Nome del modulo dei download');
define('_MSNL_CFG_LAB_WYSIWYGON', 'Usa l\'editor WYSIWYG');
define('_MSNL_CFG_LAB_WYSIWYGROWS', 'Righe dei contenuti');
define('_MSNL_CFG_HLP_DEBUGMODE', 'Questa opzione permette all\'amministratore del modulo di impostare vari livelli di messaggi di debug cos&igrave; come segue:<br /><strong>OFF</strong> = Solamente messaggi di errore a livello di applicazione, nessun dettaglio verr&agrave; mostrato.<br /><strong>ERRORE</strong> = Errori nell\'applicazione verranno mostrati, insieme a questi anche messaggi di debug. Verranno anche mostrati i messaggi di errore SQL con il relativo codice SQL generato.<br /> <strong>TUTTO</strong> = Attraverso l\'applicazione verranno mostrati messaggi molto dettagliati, inclusi i percorsi dei file (presta attenzione a non lasciare attiva per molto tempo questa opzione in quanto un sacco di informazioni utili ad un hacker!). <span class="thick">NOTA: le email NON saranno spedite quando si usa questa opzione</span> - molto utile per motivi di debug.');
define('_MSNL_CFG_HLP_DEBUGOUTPUT', 'Allo stato attuale questa opzione non viene usata. In futuro servir&agrave; per mostrare i messaggi di debug qui sopra al browser, un file di log, oppure ad entrambi.');
define('_MSNL_CFG_HLP_SHOWBLOCKS', 'L\'avere questa opzione <strong>spuntata</strong> mostrer&agrave; i blocchi a destra all\'interno del modulo. L\'avere questa opzione <strong>non spuntata</strong> nasconder&agrave; i blocchi a destra. Di default questa opzione &egrave; <strong>non spuntata</strong>.');
define('_MSNL_CFG_HLP_NSNGRPS', 'Questa opzione pu&ograve; essere usata solamente se hai installato l\'addon Gruppi NSN. Se vuoi avere la possibilit&agrave; di spedire newsletter ad uno o pi&ugrave; Gruppi NSN, spunta questa opzione.');
define('_MSNL_CFG_HLP_DLMODULE', 'Sostituisci questo testo con la corretta estensione del modulo, per esempio il modulo di default &egrave; \'downloads\' da nuke_<strong>downloads</strong>_downloads. Per il modulo Gruppi NSN, &egrave; \'nsngd\' from nuke_<strong>nsngd</strong>_downloads.');
define('_MSNL_CFG_HLP_WYSIWYGON', 'Spunta questa opzione se vuoi usare l\'editor WYSIWYG per modificare i contenutidella newsletter (corpo del testo). <strong>NOTA:</strong> questa opzione richiede che l\'addon nukeWYSIWYG sia preinstallato.');
define('_MSNL_CFG_HLP_WYSIWYGROWS', 'Questa opzione controlla il numero di righe che sono rese disponibili sulla pagina Crea Newsletter all\'interno del Contenuto della Newsletter (corpo testo). Funziona sia con l\'editor WYSIWYG che senza.');
//Show Options
define('_MSNL_CFG_LAB_SHOWOPT', 'Mostra le opzioni');
define('_MSNL_CFG_LAB_SHOWCATS', 'Mostra le categorie');
define('_MSNL_CFG_LAB_SHOWHITS', 'Mostra gli hit');
define('_MSNL_CFG_LAB_SHOWDATES', 'Mostra le date di spedizione');
define('_MSNL_CFG_LAB_SHOWSENDER', 'Mostra il m ittente');
define('_MSNL_CFG_HLP_SHOWCATS', 'Se spuntata, questa opzione mostrer&agrave; le newsletters sotto le rispettive categorie nel blocco. Le Categorie saranno sempre visualizzate negli Archivi (modulo).');
define('_MSNL_CFG_HLP_SHOWHITS', 'Se spuntata, questa opzione mostrer&agrave; il numero di hit che una newsletter riceve all\'interno del blocco e negli Archivi (modulo).');
define('_MSNL_CFG_HLP_SHOWDATES', 'Se spuntata, questa opzione mostrer&agrave; la data nella quale &egrave; stata spedita ogni newsletter sia nel blocco che negli Archivi (modulo).');
define('_MSNL_CFG_HLP_SHOWSENDER', 'Se spuntata, questa opzione mostrer&agrave; il mittente di ogni newsletter sia nel blocco che negli Archivi (modulo)');
//Block Options
define('_MSNL_CFG_LAB_BLKOPT', 'Blocco opzioni');
define('_MSNL_CFG_LAB_BLKLMT', 'Newsletter da mostrare nel blocco');
define('_MSNL_CFG_LAB_SCROLL', 'Usa il codice per il blocco di Scorrimento');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', 'Altezza dello Scorrimento');
define('_MSNL_CFG_LAB_SCROLLAMT', 'Ammontare dello Scorrimento');
define('_MSNL_CFG_LAB_SCROLLDELAY', 'Ritardo dello Scorrimento');
define('_MSNL_CFG_HLP_BLKLMT', 'Limita il numero TOTALE di newsletter da mostrare nel blocco. Se le categorie sono attivate, il numero di newsletter da mostrare in una particolare categoria &egrave; in una opzione di configurazione separata.');
define('_MSNL_CFG_HLP_SCROLL', 'Questa opzione permette al blocco informazioni di scorrere verso l\'alto nel blocco stesso');
define('_MSNL_CFG_HLP_SCROLLHEIGHT', 'Imposta l\'altezza dell\'area di scorrimento in pixel, il valore di default &egrave; 180. Presta attenzione, se imposti un valore troppo piccolo potresti non vedere nulla.');
define('_MSNL_CFG_HLP_SCROLLAMT', 'Imposta l\'ammontare di scorrimento, rappresenta lo spazio in pixel di cui il testo si muove da un passaggio all\'altro. Il valore di default &egrave; 2.');
define('_MSNL_CFG_HLP_SCROLLDELAY', 'Imposta il ritardo di scorrimento, rappresenta il tempo in millisecondi in cui il testo si blocca prima di muoversi nuovamente. Il valore di default &egrave; 25.');
/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/
define('_MSNL_CFG_APPLY_ERR_DBFAILED', 'Aggiornamento delle informazioni di configurazione fallito');
define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', 'E\' stata inserita una modalit&agrave; Debug non valida - potrebbero '
	. 'esserci problemi con l\'installazione del modulo');
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', 'E\' stata inserita una modalit&agrave; di Output non valida - potrebbero '
	. 'esserci problemi con l\'installazione del modulo');
define('_MSNL_CFG_APPLY_MSG_BACK', 'Torna alla configurazione principale');
/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/
define('_MSNL_CAT_LAB_CATCFG', 'Configurazione delle categorie della Newsletter');
define('_MSNL_CAT_LAB_ADDCAT', 'AGGIUNGI CATEGORIA');
define('_MSNL_CAT_LAB_CATTITLE', 'Titolo della categoria');
define('_MSNL_CAT_LAB_CATDESC', 'Descrizione della categoria');
define('_MSNL_CAT_LAB_CATBLOCKLMT', 'Limite del blocco');
define('_MSNL_CAT_LNK_ADDCAT', 'Aggiungi una nuova categoria di newsletter');
define('_MSNL_CAT_LNK_CATCHG', 'Modifica la categoria della newsletter');
define('_MSNL_CAT_LNK_CATDEL', 'Cancella la categoria della newsletter');
define('_MSNL_CAT_MSG_CATBACK', 'Torna alla lista delle categorie delle Newsletter');
define('_MSNL_CAT_ERR_DBGETCAT', 'Non si riesce a recuperare informazioni sulla categoria della newsletter');
define('_MSNL_CAT_ERR_DBGETCATS', 'Non si riesce a recuperare le categorie della newsletter');
define('_MSNL_CAT_ERR_NOCATS', 'Nessuna categoria trovata - Grossi problemi con l\'installazione');
define('_MSNL_CAT_ERR_INVALIDCID', 'E\' stato indicato un ID di categoria di newsletter non valido');
define('_MSNL_CAT_ERR_DBGETCNT', 'Conteggio delle newsletters incluse fallito');
define('_MSNL_CAT_HLP_CATTITLE', 'Questo campo &egrave; il titolo della categoria che sar&agrave; mostrato sia nel blocco (se abilitato attraverso le opzioni di configurazione) che negli archivi delle newsletter. Poich&egrave; questo &egrave; quello che sar&agrave; usato nel blocco per raggruppare assieme le newsletter dovresti scegliere un titolo non pi&ugrave; lungo di 30 caratteri in modo tale che il blocco venga ben visualizzato.');
define('_MSNL_CAT_HLP_CATDESC', 'Questo &egrave; un campo molto grande. La sola restrizione da assumere &egrave; quella di non inserirvi tag HTML. Ti sar&agrave; permesso farlo, ma questi saranno in seguito eliminati. Inserisci una descrizione accurata di questa categoria delle newsletter.');
define('_MSNL_CAT_HLP_CATBLOCKLMT', 'Questo campo viene utilizzato solamente se l\'opzione di configurazione <span class="thick">mostra categorie</span> &egrave; spuntata e deve essere maggiore di zero. Inserisci il numero di newsletter che si vogliono visualizzare sotto questa categoria nel blocco. <span class="thick">Ne non viene inserito alcun valore, il valore di default sar&agrave; pari a ');
/************************************************************************
* Function: msnl_cat_add
************************************************************************/
define('_MSNL_CAT_ADD_LAB_CATADD', 'Configurazione delle categorie delle Newsletter - Aggiungi categoria');
/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/
define('_MSNL_CAT_ADD_APPLY_DBCATADD', 'Inserimento della categoria della Newsletter non riuscito');
/************************************************************************
* Function: msnl_cat_chg
************************************************************************/
define('_MSNL_CAT_CHG_LAB_CATCHG', 'Configurazione delle categorie delle Newsletter - Cambia categoria');
define('_MSNL_CAT_CHG_MSG_CHGIMPACT', 'La/le Newsletter sar&agrave;/saranno influenzate da questa modifica');
/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/
define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG', 'Aggiornamento della categoria della newsletter non riuscito');
/************************************************************************
* Function: msnl_cat_del
************************************************************************/
define('_MSNL_CAT_DEL_MSG_DELIMPACT', 'La/le Newsletter sar&agrave;/saranno influenzate da questa cancellazione');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', 'Le newsletter modificate saranno riassegnate alla '
	. 'categoria di default delle newsletter non assegnate.  Vuoi continuare con la cancellazione?');
/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/
define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN', 'Riassegnamento delle newsletter non riuscito');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE', 'Cancellazione della categoria delle newsletter non riuscita');
/************************************************************************
* Function: msnl_nls
************************************************************************/
define('_MSNL_NLS_LAB_NLSCFG', 'Gestisci le Newsletter');
define('_MSNL_NLS_LAB_CURRENTCAT', 'Categoria corrente');
define('_MSNL_NLS_LAB_DATESENT', 'Data di spedizione');
define('_MSNL_NLS_LAB_CATEGORY', 'Categoria');
define('_MSNL_NLS_LNK_GETNLS', 'Recupera le newsletter richieste');
define('_MSNL_NLS_LNK_VIEWNL', 'Visualizza la newsletter - si potrebbe aprire una nuova finestra');
define('_MSNL_NLS_LNK_NLSCHG', 'Modifica le unformazioni sulla newsletter');
define('_MSNL_NLS_LNK_NLSDEL', 'Elimina la newsletter');
define('_MSNL_NLS_MSG_NONLSS', 'Non sono state trovate newsletter per questa categoria');
define('_MSNL_NLS_MSG_NLSBACK', 'Torna alla lista delle Newsletter');
define('_MSNL_NLS_ERR_DBGETNLSS', 'Non si riesce a recuperare le newsletter');
define('_MSNL_NLS_ERR_DBGETNLS', 'Non si riesce a recuperare le informazioni della newsletter');
define('_MSNL_NLS_ERR_INVALIDNID', 'E\' stato indicato un ID di newsletter non valido');
define('_MSNL_NLS_ERR_NONLSS', 'Nessuna newsletter trovata - Grossi problemi con l\'installazione');
/************************************************************************
* Function: msnl_nls_chg
************************************************************************/
define('_MSNL_NLS_CHG_LAB_NLSCHG', 'Gestisci le Newsletter - Cambia informazioni sulla Newsletter');
define('_MSNL_NLS_CHG_LAB_DATESENT', 'Data di spedizione');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', 'Chi pu&ograve; vedere la Newsletter');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', 'I Gruppi NSN possono visualizzare la Newsletter');
define('_MSNL_NLS_CHG_LAB_NBRHITS', 'Numero di hit');
define('_MSNL_NLS_CHG_LAB_FILENAME', 'Nome del file della Newsletter');
define('_MSNL_NLS_CHG_LAB_CAUTION', 'Cambia i valori sottostanto SOLO se sai quello che stai facendo');
define('_MSNL_NLS_CHG_HLP_DATESENT', 'Allo stato attuale, la data deve essere inserita nel formato AAAA-MM-GG come mostrato in questo campo. Quando una newsletter viene creata e spedita per la prima volta, questo campo viene popolato con la data corrente di sistema. Le newsletter sono sempre elencate in ordine cronologico con la pi&ugrave; recente nella parte superiore dell\'elenco.');
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 'Questo campo &egrave; assegnato dal sistema - presta attenzione nel '
	. 'cambiarlo!  Valori validi sono:'
	. '<br /><strong> 0</strong> = anonimi - tutti possono vederla'
	. '<br /><strong> 1</strong> = a tutti gli utenti registrati'
	. '<br /><strong> 2</strong> = solo ai sottoscrittori della newsletter'
	. '<br /><strong> 3</strong> = solo ai membri paganti del sito'
	. '<br /><strong> 4</strong> = solo ai Gruppi NSN selezionati'
	. '<br /><strong> 5</strong> = lista di distribuzione ad-hoc'
	. '<br /><strong>99</strong> = solo agli amministratori del sito.');
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 'Richiede che l\'opzione <span class="thick">vista</span> sopra indicata sia impostata a 4 for *solamente per i Gruppi NSN*. Ogni Gruppo NSN ha uno specifico numero ID ad esso associato.  Nel momento in cui viene creata/spedita una newsletter, &egrave; possibile decidere uno o pi&ugrave; Gruppi NSN ai quali spedirla. Nel caso sia indicato solamente un gruppo, questo campo dovrebbe avere solamente l\'ID di gruppo associato. Per pi&ugrave; di un gruppo, ogni ID di gruppo dovrebbe essere separato da un trattino, ad esempio <span class="thick">1-2-3</span>.');
define('_MSNL_NLS_CHG_HLP_NBRHITS', 'Quando una newsletter viene visualizzata dal sito web usando un link al blocco oppure un link all\'archivio, il contatore della newsletter viene incrementato. Il contatore NON viene incrementato se l\'utente &egrave; loggato come amministratore.');
define('_MSNL_NLS_CHG_HLP_FILENAME', 'Questo campo viene assegnato dal sistema. Se lo cambi assicurati che il nome del file esista e che sia formattato per una corretta visualizzazione in questo sistema.');
/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/
define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', 'Il valore deve essere compreso tr 0 e4, oppure 99');
define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', 'Aggiornamento delle informazioni sulla Newsletter fallito');
/************************************************************************
* Function: msnl_nls_del
************************************************************************/
define('_MSNL_NLS_DEL_MSG_DELIMPACT', 'Stai per eliminare in modo definitivo questa newsletter.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', 'Tutte le informazioni relative a questa newsletter saranno '
	. 'cancellate dal database cos&igrave; come il file della newsletter all\'interno del direttorio di archivio. '
	. 'Vuoi continuare con questa eliminazione?');
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/
define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'Non riesco a cancellare il file della newsletter - controlla '
	. 'i permessi del file');
define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL', 'Cancellazione delle informazioni sulla Newsletter fallita');

