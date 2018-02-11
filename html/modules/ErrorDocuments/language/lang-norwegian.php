<?php
/**************************************************************************/
/* RavenNuke(tm): Advanced Content Management System                           */
/**************************************************************************/
define('_ED_REFEREDFROM','Henvist Fra : ');
define('_ED_YOURIP','Din IP : ');
define('_ED_PAGEREQUESTED','Side Du Prøver Å Vise : ');
define('_ED_AGENT','Agent : ');
define('_ED_REDIRECTSTATUS','Omdirigerings Status : ');
define('_ED_UNKNOWN','Ukjent');
define('_ED_HINT','Tips:');

define('_ED_BOXTITLE_400','ERROR: 400 - Ugyldig Henvisning');
define('_ED_BOXTITLE_401','ERROR: 401 - Uautorisert');
define('_ED_BOXTITLE_403','ERROR: 403 - Forbudt');
define('_ED_BOXTITLE_404','ERROR: 404 - Side Ikke Funnet');
define('_ED_BOXTITLE_406','ERROR: 406 - Innholdet Kan Ikke Aksepteres');
define('_ED_BOXTITLE_500','ERROR: 500 - Intern Server Feil');
define('_ED_BOXTITLE_UNKNOWN','FEIL: ');

define('_ED_HINTTEXT_400','Henvisningen ble ikke forstått av Serveren på grunn av ugyldig syntaks<br />Du BØR IKKE repetere henvisningen uten å modifisere den');
define('_ED_HINTTEXT_401','Henvisningen krever godkjenning - Serveren kan svare med denne responsen f.eks. for en side der Innloggingen feilet');
define('_ED_HINTTEXT_403','Serveren forstod henvisningen, men nekter å fullføre den<br />Godkjenning vil ikke hjelpe og du BØR IKKE repetere henvisningen da du kan risikere å bli utestengt');
define('_ED_HINTTEXT_404','Kontroller at filen eksisterer - Filnavn er som oftest følsomme for store og små bokstaver - Sjekk etter stavefeiler');
define('_ED_HINTTEXT_406',"Siden du prøver å vise kan ikke svare med innholds-karakteristikkene det er bedt om - Sjekk mod_security filterets regler");
define('_ED_HINTTEXT_500','Sjekk .htaccess filen for syntax-/konfigurasjonsfeil');
define('_ED_HINTTEXT_UNKNOWN','');

define('_ED_BOXSHORTDESC_400','Anmodningens syntaks ble ikke forstått av Serveren');
define('_ED_BOXSHORTDESC_401','Anmodningen trenger Bruker-godkjenning');
define('_ED_BOXSHORTDESC_403','Du har ikke tillatelse til å aksessere denne filen');
define('_ED_BOXSHORTDESC_404','Filen du har bedt om ble ikke funnet');
define('_ED_BOXSHORTDESC_406','Kilden/innholdet du har bedt om er ikke i et akseptabelt format');
define('_ED_BOXSHORTDESC_500','Intern Server Feil');
define('_ED_BOXSHORTDESC_UNKNOWN','En ukjent feil oppstod.');

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