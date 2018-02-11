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
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
define('_TNML_MNU_BACK2ADM_LAB', 'Amministrazione del sito');
define('_TNML_MNU_MAILCFG_LAB', 'Configurazione TegoNuke Mailer');
define('_TNML_MNU_ABOUT_LAB', 'Informazioni su TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Muovi il tuo cursore sopra queste icone per un testo di aiuto dettagliato');
define('_TNML_HLP_LEGEND_HLP', 'Si, è corretto!');
define('_TNML_OPTSGENERAL_LAB','General Mailer Options');
define('_TNML_OPTSSMTP_LAB','SMTP Configuration Settings');
define('_TNML_OPTSSENDMAIL_LAB','Sendmail Configuration Settings');
define('_TNML_OFF','OFF');
define('_TNML_ONWITHSEND','ON, WITH SEND');
define('_TNML_ONNOSEND','ON, NO SEND');
define('_TNML_NONE','None');
define('_TNML_PNMACTIVATE_LAB', 'Attivo  TegoNuke Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Attivo o disattivo il mail server.<br /><br />Se scopri che il tuo sistema RavenNukee™ / PHP-Nuke system non spedisce la posta elettronica, allora il tuo servizio di hosting potrebbe aver bloccato l\'uso della funzione PHP mail() function. Potresti usare You may to use l\'autenticazione SMTP, da attivare appunto usando TegoNuke Mailer.<br /><br /><span class="thick">No</span> = Di default, viene usata la funzione nativa PHP mail(). Questo è di default.<br /><br /><span class="thick">Si</span> = Attiverà TegoNuke Mailer e ti permetterà poi di scegliere il <span class="thick">Metodo di Spedizione</span>.<br /><br />(Leggi il pop-up di aiuto sul metodo di spedizione per quello che puoi configurare)');
define('_TNML_SENDMETHOD_LAB', 'Metodo di Spedizione');
define('_TNML_SENDMETHOD_HLP', 'Specifica il metodo di spedizione desiderato.<br /><br />Spesso, se hai bisogno di utilizzare TegoNuke Mailer, il tuo host ti chiederà di usare l\'SMTP autenticato.  In questo caso, seleziona l\'opzione SMTP ed appariranno settaggi di configurazione SMTP aggiuntivi. Attualmente, le opzioni disponibili da usare sono:<br /><br /><span class="thick">Mail()</span> = Questa è la funzione PHP mail() nativa di default. (Se la funzione PHP mail() è già funzionante nel tuo caso con il mailer disattivato, you could use the mailer and get the additional features of better error handling and batch send processing.<br /><br /><span class="thick">SMTP</span> = Choosing this option will open up additional settings for you to configure.  This may be your only option to use if your host has disabled the native PHP mail() function. (NOTE: if your host requires you to use SMTP, you must also configure the SMTP settings within the Forums Configuration.)<br /><br /><span class="thick">SendMail</span> = This would use the sendmail daemon.  It would be rare for any host to require this over authenticated SMTP, but just in case you need it, it is here.');
define('_TNML_BOUNCEADDR_LAB', 'Email Bounce Address');
define('_TNML_BOUNCEADDR_HLP', 'Leave this blank if you do not wish to provide a bounce email address; However, having one could help keep you out of a spam blacklist.<br /><br />It is recommended that you create a separate email address to collect bounced emails so that you can keep on top of cleaning up bad/stale email addresses in the user table.  It may also be a good idea to ensure the address is one with your sending domain (again, spam blacklist reasons).');
define('_TNML_DEBUGLEVEL_LAB', 'Debug Level');
define('_TNML_DEBUGLEVEL_HLP', 'The Mailer provides the following debugging options with messages ONLY see by a logged in admin:<br /><br /><strong>OFF</strong> = No Debugging (default)<br /><br /><strong>ON, WITH SEND</strong> = admin ONLY will see debug messages and still send<br /><br /><strong>ON, WITH NO SEND</strong> = admin ONLY will see debug messages, but no mails will be sent (even though the system will behave as if they did)');
define('_TNML_SMTPHOST_LAB', 'Server');
define('_TNML_SMTPHOST_HLP', 'Specify SMTP host name - e.g. smtp.yourdomain.tld or mail.yourdomain.tld.<br /><br />Most hosting packages will come with some form of control panel.  We recommend you use your control panel to create a new email account on your server that will ONLY be used for sending emails (use a different password than that of your main account).  Once this is set up, or even if you have to use your main hosting email account, your control panel should have an option to show you what the required SMTP connection settings are, including the proper host name. If not, ask them for all of these needed SMTP settings.');
define('_TNML_SMTPHELO_LAB', 'Helo');
define('_TNML_SMTPHELO_HLP', 'Specifica il comando Helo SMTP.<br /><br />This is usually the same as SMTP HOST.  Try making them the same and if it does not work, ask your host for what this should be.');
define('_TNML_SMTPPORT_LAB', 'Porta');
define('_TNML_SMTPPORT_HLP', 'Specify SMTP port.<br /><br />This is usually 25, but your host could require you to use a different port. <span class="thick">NOTE:</span> This mailer currently does not support secure (SSL) connections (not to be confused with authenticated connections)!');
define('_TNML_SMTPAUTH_LAB', 'Autenticazione');
define('_TNML_SMTPAUTH_HLP', 'Activate SMTP authentication.<br /><br />Most hosts will require you to provide authentication user and password, which should be the email account and password for the new account you just set up, or could be that of your main email account (not recommended).');
define('_TNML_SMTPUSER_LAB', 'Username');
define('_TNML_SMTPUSER_HLP', 'Specify SMTP username.<br /><br />This one can be the same as your email account user name that you set up, or, depending upon the control panel and SMTP server, it could a bit different.<br /><br />For example, if the user you set up was called <span class="thick">user</span>, we have seen the following forms of username: <span class="thick">user</span>, <span class="thick">user@yourdomain.tld</span>, and <span class="thick">user+yourdomain.tld</span>.<br /><br />If you cannot get it to work, you may have to ask your host.');
define('_TNML_SMTPPASS_LAB', 'Password');
define('_TNML_SMTPPASS_HLP', 'Specify SMTP password.<br /><br />Enter this just as you set up.');
define('_TNML_SMTPENCRYPT_LAB', 'Use Encryption?');
define('_TNML_SMTPENCRYPT_HLP', 'If your SMTP service is able to use encrypted sessions, it highly advisable that you use them.  Just make sure the method below is supported and that your SMTP port number above is appropriate as well.');
define('_TNML_SMTPENCRYPTMETHOD_LAB', 'Encryption Method');
define('_TNML_SMTPENCRYPTMETHOD_HLP', 'If encryption is to be used, you have a choice of either ssl or tls.');
define('_TNML_SENDMAIL_LAB', 'Sendmail Path');
define('_TNML_SENDMAIL_HLP', 'Percorso assoluto per attivare Sendmail.<br /><br />It would be rare that your host would require you to use this daemon as in our opinion, it can be easily exploited if not set up properly.  But, if you need it, it is here.  If the default path does not work for you, you may have to ask your host for what this needs to be.');
