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
* Function: Common use defines between module and block
************************************************************************/
define('_MSNL_NLS_LAB_MORENLS', 'Ulteriori Newsletters...');
define('_MSNL_NLS_LAB_HIT', 'hit');
define('_MSNL_NLS_LAB_HITS', 'hit');
define('_MSNL_NLS_LAB_SENTON', 'mandata il');
define('_MSNL_NLS_LAB_SENDER', 'mittente');
define('_MSNL_NLS_LNK_VIEWNL', 'Visualizza la newsletter- si pu&#242; aprire una nuova finestra');
define('_MSNL_NLS_LNK_VIEWNLARCHS', 'Visualizza gli archivi delle newsletter');
/************************************************************************
* Function: msnl_nls_list
************************************************************************/
define('_MSNL_NLS_LST_LAB_ARCHTITL', 'Newsletter archiviata');
define('_MSNL_NLS_LST_LAB_ADMNLS', 'Amministra la newsletter');
define('_MSNL_NLS_LST_LNK_ADMNLS', 'Vai alla sezione Amministrazione del modulo');
define('_MSNL_NLS_LST_MSG_NONLS', 'Nessuna newsletter da visualizzare');
/************************************************************************
* Function: msnl_nls_view
************************************************************************/
define('_MSNL_NLS_VIEW_ERR_DBGETNL', 'Non sono riuscito a recuperare informazioni sulla newsletter');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', 'Non riesco a trovare il file della newsletter selezionata');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', 'Non sei autorizzato a visualizzare questa newsletter '
	. 'o questa newsletter non esiste!');
/************************************************************************
* Function: msnl_copyright_view
************************************************************************/
define('_MSNL_CPY_LAB_COPYTITLE', 'Diritti d\'autore &copy; e crediti del modulo');
define('_MSNL_CPY_LAB_MODULEFOR', 'modulo per');
define('_MSNL_CPY_LAB_COPY', 'Informazioni sui diritti d\'autore');
define('_MSNL_CPY_LAB_CREDITS', 'Informazioni sui crediti');
define('_MSNL_CPY_LAB_MODNAME', 'Nome del modulo');
define('_MSNL_CPY_LAB_MODVER', 'Versione del modulo');
define('_MSNL_CPY_LAB_MODDESC', 'Descrizione del modulo');
define('_MSNL_CPY_LAB_LICENSE', 'Licenza');
define('_MSNL_CPY_LAB_AUTHORNM', 'Nome dell\'autore');
define('_MSNL_CPY_LAB_AUTHOREMAIL', 'Email dell\'autore');
define('_MSNL_CPY_LAB_AUTHORWEB', 'Home Page dell\'autore');
define('_MSNL_CPY_LAB_MODDL', 'Modulo Download');
define('_MSNL_CPY_LAB_DOCS', 'Documentazione per Supporto/Aiuto');
define('_MSNL_CPY_LAB_ORIGAUTHOR', 'Autore iniziale');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', 'Attuale autore');
define('_MSNL_CPY_LAB_TRANSLATIONS', 'Autore/i della traduzione');
define('_MSNL_CPY_LAB_OTHER', 'Ulteriori ringraziamenti');
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Visualizza i diritti d\'autore ed i crediti');
define('_MSNL_CPY_LNK_PHPNUKE', 'Vai al sito di PHP-Nuke - abbandonerai questo sito');
define('_MSNL_CPY_LNK_AUTHORHOME', 'Vai al sito dell\'autore - abbandonerai questo sito');
define('_MSNL_CPY_LNK_DOWNLOAD', 'Vai al sito relativo ai Download - abbandonerai questo sito');
define('_MSNL_CPY_LNK_DOCS', 'Vai al sito relativo alla documentazione - abbandonerai questo sito');

