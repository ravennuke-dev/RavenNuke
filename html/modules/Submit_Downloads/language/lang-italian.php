<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Submit Downloads
 *
 * This module allows end-users, as configured by the admin by download category,
 * to submit new downloads for the admin to review and either accept or
 * ignore/delete.  If the download category configuration allows it, this will
 * also allow for the uploading of files along with the submitted download data.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
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
global $sitename;
define('_DL_ADDADOWNLOAD', 'Aggiungi un nuovo download');
define('_DL_ADDTHISFILE', 'Aggiungi questo file');
define('_DL_ALWEXT', 'Estensioni permesse');
define('_DL_BADEXT', 'Estensione sbagliata!');
define('_DL_CANTADD', 'Non hai i diritti corretti per inserire in questa categoria');
define('_DL_DOWNLOADNODESC', 'ERRORE: devi inserire una DESCRIZIONE per il tuo invio');
define('_DL_DOWNLOADNOTITLE', 'ERRORE: devi inserire un TITOLO per il tuo invio!');
define('_DL_DOWNLOADNOURL', 'ERRORE: devi inserire un URL per il tuo invio!');
define('_DL_DOWNLOADRECEIVED', 'Abbiamo ricevuto il tuo invio di Download. Grazie!');
define('_DL_DOWSUB', 'Invio Download');
define('_DL_DOWSUBREC', 'Invio di download ricevuto');
define('_DL_DPOSTPENDING', 'Tutti i download vengono inseriti in attesa di verifica.');
define('_DL_DUSAGE1', 'Tutti gli invii verranno controllati per i requisiti di appartenenza e contenuti.');
define('_DL_DUSAGE2', 'Se viene richiesta l\'iscrizione al sito la frase seguente verr&agrave; aggiunta all\'invio:');
define('_DL_DUSAGE3', '<span style="color:#ff0000;" class="thick">Nota bene: questo sito richiede l\'iscrizione per accedere a questo link.</span>');
define('_DL_DUSAGE4', 'Se vengono trovati contenuti discutibili la frase seguente verr&agrave; aggiunta all\'invio:');
define('_DL_DUSAGE5', '<span style="color:#0000ff;" class="thick">Nota bene: questo sito contiene contenuti discutibili.</span>');
define('_DL_DUSAGEUP1', 'Inviando il file tu accetti:');
define('_DL_DUSAGEUP2', 'di permettere a <span class="thick">' . $sitename . '</span> di ospitare il file per lo scaricamento per un tempo indeterminato.');
define('_DL_DUSAGEUP3', 'che questo accordo servir&agrave; come consenso "SCRITTO" a <span class="thick">' . $sitename . '</span> per ospitare il download.');
define('_DL_DUSAGEUP4', 'che il proprietario di <span class="thick">' . $sitename . '</span> &egrave; assolto da ogni responsabilit&agrave; derivante dall\'uso del tuo caricamento.');
define('_DL_DUSAGEUP5', 'che non hai usato codice di altri sviluppatori e non ne hai rivendicato la propriet&agrave;.');
define('_DL_DUSAGEUP6', 'se le affermazioni precedenti risultano in seguito essere false alora accetti di essere ritenuto legalmente responsabile per eventuali danni subiti dall\'utilizzo del tuo caricamento.');
define('_DL_EMAILWHENADD', 'Riceverai una mail quando verr&agrave; approvato.');
define('_DL_FILEEXIST', '<span class="thick">ERRORE:</span> questo file esiste gi&agrave; nella nostra struttura di cartelle.');
define('_DL_GONEXT', 'VAI AL PASSO SUCCESSIVO');
define('_DL_INSTRUCTIONS', 'Istruzioni');
define('_DL_NOCATEGORY', 'Non ci sono categorie disponibili per l\'invio');
define('_DL_NOUPLOAD', '<span class="thick">ERRORE:</span> file non caricato.');
define('_DL_TOBIG', '<span class="thick">ERRORE:</span> file troppo grande.');
define('_DL_TOU', 'Termini di Utilizzo');
define('_DL_TOUMUST', '<span class="thick">DEVI</span> accettare i "Termini di Utilizzo"!');
define('_DL_USERANDIP', 'Nome utente ed indirizzo IP vengono registrati, non abusare del sistema.');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Email dell\'autore');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Nome dell\'autore');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'byte');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Categoria');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'Non hai inserito un indirizzo di posta lettronica, controlleremo comnque presto il tuo link.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Descrizione');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Download');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Invia un solo download alla volta.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Grandezza del file');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'Homepage');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in byte');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'Indirizzo IP di chi ha inviato');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Titolo');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Versione');

