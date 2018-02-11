<?php
/**************************************************************************/
/* RavenNuke(tm): Advanced Content Management System                           */
/**************************************************************************/
define('_ED_REFEREDFROM','Reindirizzato da: ');
define('_ED_YOURIP','Il tuo IP: ');
define('_ED_PAGEREQUESTED','Pagina richiesta: ');
define('_ED_AGENT','Agente: ');
define('_ED_REDIRECTSTATUS','Stato del reindirizzamento : ');
define('_ED_UNKNOWN','Sconosciuto');
define('_ED_HINT','Suggerimento:');

define('_ED_BOXTITLE_400','ERROR: 400 - Richiesta sbagliata');
define('_ED_BOXTITLE_401','ERROR: 401 - Non autorizzato');
define('_ED_BOXTITLE_403','ERROR: 403 - Vietato');
define('_ED_BOXTITLE_404','ERROR: 404 - Pagina non trovata');
define('_ED_BOXTITLE_406','ERROR: 406 - Contenuto non accettabile');
define('_ED_BOXTITLE_500','ERROR: 500 - Errore interno del server');
define('_ED_BOXTITLE_UNKNOWN','ERRORE: ');

define('_ED_HINTTEXT_400','La richiesta non pu&ograve; essere compresa dal server a causa di una sintassi malformata<br />NON DOVRESTI ripetere la richiesta senza averla prima modificata');
define('_ED_HINTTEXT_401','Devi autenticarti come utente per questa richiesta - Il server potrebbe restituire questa risposta per una pagina dopo una autenticazione fallita');
define('_ED_HINTTEXT_403','Il server ha compreso la richiesta, ma si sta rifiutando di soddisfarla<br />L\'autorizzazione non aiuter&agrave; e NON DOVRESTI ripetere la richiesta perch&eacute; rischieresti di essere espulso da sito');
define('_ED_HINTTEXT_404','Verifica che il file esista - I nomi dei file normalmente differiscono per minuscole e maiuscole - Controlla gli errori di ortografia');
define('_ED_HINTTEXT_406',"La pagina richiesta non pu&ograve; rispondere con le caratteristiche richieste di contenuto - Controlla le regole del filtro mod_security");
define('_ED_HINTTEXT_500','Controlla il file .htaccess per errori di sintassi/configurazione');
define('_ED_HINTTEXT_UNKNOWN','');

define('_ED_BOXSHORTDESC_400','La sintassi della richiesta non &egrave; stata compresa dal server');
define('_ED_BOXSHORTDESC_401','Devi autenticarti come utente per questa richiesta');
define('_ED_BOXSHORTDESC_403','Non hai i permessi per accedere al file richiesto');
define('_ED_BOXSHORTDESC_404','Il file richiesto non &egrave; stato trovato');
define('_ED_BOXSHORTDESC_406','Il contenuto/risorsa richiesto non &egrave; in un formato accettabile');
define('_ED_BOXSHORTDESC_500','Errore interno Server');
define('_ED_BOXSHORTDESC_UNKNOWN','E\' avvenuto un errore sconosciuto.');

/** ALL TRANSLATION DEFINES SHOULD GO ABOVE THIS LINE. **/
/** FROM HERE ON DOWN ARE ONLY REFERENCES TO THE ABOVE LANGUAGE DEFINES **/
define('_ED_REFEREDFROM_400',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_401',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_403',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_404',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_406',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_500',_ED_REFEREDFROM);
define('_ED_REFEREDFROM_UNKNOWN',_ED_REFEREDFROM);

define('_ED_YOURIP_400',_ED_YOURIP);
define('_ED_YOURIP_401',_ED_YOURIP);
define('_ED_YOURIP_403',_ED_YOURIP);
define('_ED_YOURIP_404',_ED_YOURIP);
define('_ED_YOURIP_406',_ED_YOURIP);
define('_ED_YOURIP_500',_ED_YOURIP);
define('_ED_YOURIP_UNKNOWN',_ED_YOURIP);

define('_ED_PAGEREQUESTED_400',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_401',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_403',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_404',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_406',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_500',_ED_PAGEREQUESTED);
define('_ED_PAGEREQUESTED_UNKNOWN',_ED_PAGEREQUESTED);

define('_ED_AGENT_400',_ED_AGENT);
define('_ED_AGENT_401',_ED_AGENT);
define('_ED_AGENT_403',_ED_AGENT);
define('_ED_AGENT_404',_ED_AGENT);
define('_ED_AGENT_406',_ED_AGENT);
define('_ED_AGENT_500',_ED_AGENT);
define('_ED_AGENT_UNKNOWN',_ED_AGENT);

define('_ED_REDIRECTSTATUS_400',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_401',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_403',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_404',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_406',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_500',_ED_REDIRECTSTATUS);
define('_ED_REDIRECTSTATUS_UNKNOWN',_ED_REDIRECTSTATUS);
?>