<?php
/**
 * TegoNuke(tm) Mailer: Replaces Native PHP Mail
 *
 * Inspired by Nuke-Evolution and PHPNukeMailer.  Uses a re-written PHPNukeMailer
 * admin module for the administration of the mailer functions and Swift Mailer library
 * of classes to perform the actual mail functions.
 *
 * Will be used to replace PHP mail() function throughout RavenNuke(tm) /
 * PHP-Nuke.  This has become necessary as Hosts have started locking down
 * access to the mail() function and requiring SMTP authentication.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Integration
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 - 2010 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright (C) 2004-2007 by Jonathan Estrella      */
/*****************************************************/
define('_TNML_MNU_BACK2ADM_LAB', 'Amministrazione del sito');
define('_TNML_MNU_MAILCFG_LAB', 'Configurazione TegoNuke Mailer');
define('_TNML_MNU_ABOUT_LAB', 'Informazioni su TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Muovi il tuo cursore sopra queste icone per un testo di aiuto dettagliato');
define('_TNML_HLP_LEGEND_HLP', 'Si, &egrave; corretto!');
define('_TNML_OPTSGENERAL_LAB','Opzioni generali Tegonuke Mailer');
define('_TNML_OPTSSMTP_LAB','Impostazioni di configurazione SMTP');
define('_TNML_OPTSSENDMAIL_LAB','Impostazioni di configurazione Sendmail');
define('_TNML_OFF','Disabilitato');
define('_TNML_ONWITHSEND','Abilitato, con invio');
define('_TNML_ONNOSEND','Abilitato, senza invio');
define('_TNML_NONE','Nessuno');
define('_TNML_PNMACTIVATE_LAB', 'Attivo  TegoNuke Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Attivo o disattivo il server di posta elettronica.<br /><br />Se scopri che il tuo sistema RavenNukee(TM) / PHP-Nuke system non spedisce la posta elettronica, allora il tuo servizio di hosting potrebbe aver bloccato l\'uso della funzione \'PHP mail()\'. Potresti usare l\'autenticazione SMTP, da attivare appunto usando TegoNuke Mailer.<br /><br /><span class="thick">No</span> = Di default, viene usata la funzione nativa PHP mail(). Questo &egrave; di default.<br /><br /><span class="thick">Si</span> = Attiver&agrave; TegoNuke Mailer e ti permetter&agrave; poi di scegliere il <span class="thick">Metodo di Spedizione</span>.<br /><br />(Leggi il pop-up di aiuto sul metodo di spedizione per quello che puoi configurare)');
define('_TNML_SENDMETHOD_LAB', 'Metodo di Spedizione');
define('_TNML_SENDMETHOD_HLP', 'Specifica il metodo di spedizione desiderato.<br /><br />Spesso, se hai bisogno di utilizzare TegoNuke Mailer, il tuo host ti chieder&agrave; di usare l\'SMTP autenticato.  In questo caso, seleziona l\'opzione SMTP ed appariranno settaggi di configurazione SMTP aggiuntivi. Attualmente, le opzioni disponibili da usare sono:<br /><br /><span class="thick">Mail()</span> = Questa &egrave; la funzione PHP mail() nativa di default. (Se la funzione PHP mail() è gi&agrave; funzionante nel tuo caso con Tegonuke Mailer disattivato, potresti usare Tegonuke Mailer ed avere le funzioni aggiuntive di una migliore gestione degli errori ed invio programmato della posta.<br /><br /><span class="thick">SMTP</span> = scegliendo questa opzione potrai avere impostazioni aggiuntive da configurare. Questa potrebbe essere la tua sola opzione da usare nel caso il tuo host abbia disabilitato la funzione nativa \'PHP mail()\'. (NOTA: se l\'host ti richiede di usare l\'SMTP, devi anche configurare le impostazioni SMTP all\'interno della configurazione dei Forum)<br /><br /><span class="thick">SendMail</span> = Questa mi permette di usare il demone sendmail. E\' raro per qualsiasi host richiedere questa opzione con l\'SMTP autenticato, ma, solo nel caso tu ne abbia bisogno, &egrave; qui.');
define('_TNML_BOUNCEADDR_LAB', 'Mail \'per rimbalzi\'');
define('_TNML_BOUNCEADDR_HLP', 'Lascialo bianco se non vuoi avere un indirizzo di posta elettronica \'per rimbalzi\'; comunque, averne uno significa mantenerti fuori da una blacklist di spam.<br /><br />E\' preferibile creare un indirizzo di posta elettronica separato per per raccogliere le mail che rimbalzano in modo tale che tu possa essere considerato uno dei migliori nel tener puliti gli indirizzi di posta elettronica non validi nella tabella utenti. Pu&ograve; anche essere una buona idea assicurarsi che l\'indirizzo sia uno del tuo dominio (ancora, per ragioni di spam).');
define('_TNML_DEBUGLEVEL_LAB', 'Livello di debug');
define('_TNML_DEBUGLEVEL_HLP', 'Tegonuke Mailer gestisce le seguenti opzioni di debug i cui messaggi possono essere visti SOLO da un amministratore del sito:<br /><br /><strong>Disabilitato</strong> = Nessun debug (default)<br /><br /><strong>Abilitato, con invio</strong> = SOLO gli amministratori vedranno i messaggi di debug, comunque le mail verranno inviate<br /><br /><strong>Abilitato, senza invio</strong> = SOLO gli amministratori vedranno i messaggi di debug, ma non verr&agrave; spedita nessuna mail (anche se il sistema si comporta come se lo fossero)');
define('_TNML_SMTPHOST_LAB', 'Server');
define('_TNML_SMTPHOST_HLP', 'Specifica il nome dell\'host SMTP - ad esempio smtp.yourdomain.tld o mail.yourdomain.tld.<br /><br />La maggior parte dei servizi di hosting viene data con un qualche tipo di pannello di controllo. Ti raccomandiamo di usare il tuo pannello di controllo per creare un nuovo account di posta elettronica sul tuo server che verr&agrave; usato SOLO per inviare mail (usa una password differente di quella del tuo account principale). Una volta che questo &egrave; impostato, o anche se devi usare l\'account di posta elettronica principale, il tuo pannello di controllo dovrebbe avere un\'opzione che ti mostra quali sono le impostazioni di connessione SMTP richieste, incluso il corretto nome dell\'host. Se non &egrave; cos&igrave; richiedi tutte le impostazioni SMTP necessarie.');
define('_TNML_SMTPHELO_LAB', 'Helo');
define('_TNML_SMTPHELO_HLP', 'Specifica il comando Helo SMTP.<br /><br />Questo &egrave; normalmente lo stesso dell\'HOST SMTP. Prova a mantenerli uguali e se questo non funziona, chiedi al tuo hosting provider quali dovrebbero essere.');
define('_TNML_SMTPPORT_LAB', 'Porta');
define('_TNML_SMTPPORT_HLP', 'Specifica la porta SMTP.<br /><br />Questa &egrave; normalmente la numero 25, ma il tuo provider potrebbe richiederti di usare una porta differente. <span class="thick">NOTA:</span> attualmente Tegonuke Mailer non supporta le connessioni sicure (SSL, da non confondersi con le connessioni autenticate)!');
define('_TNML_SMTPAUTH_LAB', 'Autenticazione');
define('_TNML_SMTPAUTH_HLP', 'Attiva l\'autenticazione SMTP.<br /><br />La maggior parte dei provider ti richiederanno di fornire utente e password autenticati, che dovrebbero essere l\'indirizzo di posta elettronica e la password per il nuovo account che hai appena impostato, oppure puoi usare il tuo account di posta elettronica principale (non raccomandato).');
define('_TNML_SMTPUSER_LAB', 'Nome utente');
define('_TNML_SMTPUSER_HLP', 'Specifica il nome utente SMTP.<br /><br />Questo pu&ograve essere lo stesso del tuo account di posta elettronica che hai impostato, o, a seconda del pannello di controllo e del server SMTP, potrebbe variare leggermente.<br /><br />Per esempio, se l\'utente che hai impostato si chiamasse <span class="thick">user</span>, avremmo le seguenti forme di nome utente: <span class="thick">user</span>, <span class="thick">user@yourdomain.tld</span>, e <span class="thick">user+yourdomain.tld</span>.<br /><br />Se non riesci a farlo funzionare, probabilmente devi chiedere al tuo provider.');
define('_TNML_SMTPPASS_LAB', 'Password');
define('_TNML_SMTPPASS_HLP', 'Specifica la password SMTP.<br /><br />Inseriscila cos&igrave; come la hai impostata.');
define('_TNML_SMTPENCRYPT_LAB', 'Uso la crittografia?');
define('_TNML_SMTPENCRYPT_HLP', 'Se il tuo servizio SMTP ha la possibilit&agrave; di usare le sessioni crittografate, &egrave; altamente consigliato che li usi.  Solamente assicurati che il metodo qui sotto sia supportato e che il tuo numero di porta SMTP sia altrettanto corretto.');
define('_TNML_SMTPENCRYPTMETHOD_LAB', 'Metodo di crittografia');
define('_TNML_SMTPENCRYPTMETHOD_HLP', 'Se deve essere utilizzata la crittografia, hai la scelta tra ssl e tls.');
define('_TNML_SENDMAIL_LAB', 'Percorso di sendmail');
define('_TNML_SENDMAIL_HLP', 'Percorso assoluto per attivare Sendmail.<br /><br />E\' raro il caso in cui il tuo provider ti richieda di usare questo demone; secondo noi pu&ograve; essere facilmente hackerato se non &egrave; correttamente impostato. Ma, se ne hai bisogno, &grave; qui. Se il percorso predefinito non ti funziona potresti dover chiedere al tuo provider cosa si deve fare.');
