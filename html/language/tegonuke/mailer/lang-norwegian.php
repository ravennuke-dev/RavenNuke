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
/* Copyright &copy; 2004-2007 by Jonathan Estrella        */
/*****************************************************/
define('_TNML_MNU_BACK2ADM_LAB', 'ACP');
define('_TNML_MNU_MAILCFG_LAB', 'TegoNuke Mailer Instillinger');
define('_TNML_MNU_ABOUT_LAB', 'Om TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Hold musepilen over disse ikonene for mer detaljert hjelp');
define('_TNML_HLP_LEGEND_HLP', 'Riktig! - s&aring;nn skal det gj&oslash;res!');
define('_TNML_OPTSGENERAL_LAB','General Mailer Options');
define('_TNML_OPTSSMTP_LAB','SMTP Configuration Settings');
define('_TNML_OPTSSENDMAIL_LAB','Sendmail Configuration Settings');
define('_TNML_OFF','OFF');
define('_TNML_ONWITHSEND','ON, WITH SEND');
define('_TNML_ONNOSEND','ON, NO SEND');
define('_TNML_NONE','None');
define('_TNML_PNMACTIVATE_LAB', 'Aktivere TegoNuke Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Aktiverer eller deaktiverer TegoNuke Mailer.<br /><br />Hvis du opplever at ditt RavenNuke(tm)/PHP-Nuke system ikke sender eposter kan det v&aelig;re fordi hosten din har blokkert bruken av PHP mail() funksjonen. Du blir kanskje n&oslash;dt til &aring; bruke authenticated SMTP, og det er her TegoNuke Mailer kommer inn i bildet.<br /><br /><span class="thick">Nei</span> = Funksjonen native PHP mail() blir brukt. Dette er standard.<br /><br /><span class="thick">Ja</span> = Vil aktivere TegoNuke Mailer og lar deg deretter velge <span class="thick">Sende-m&aring;te</span>.<br /><br />(Se hjelpeteksten i pop-up vinduet for Sende-m&aring;te for &aring; se hva du kan konfigure.)');
define('_TNML_SENDMETHOD_LAB', 'Sende-m&aring;te');
define('_TNML_SENDMETHOD_HLP', 'Spesifiserer den valgte m&aring;ten &aring; sende p&aring;.<br /><br />I de fleste tilfellene der du har behov for &aring; bruke TegoNuke Mailer, vil hosten din be deg om &aring; bruke authenticated SMTP.  I s&aring; tilfelle velger du SMTP, og du f&aring;r muligheten til &aring; konfigurere oppsettet for epostserveren.  For &oslash;yeblikket har brukeren f&oslash;lgende muligheter:<br /><br /><span class="thick">Mail()</span> = Dette er standard native PHP mail() functionen.  (Hvis PHP mail() funksjonen fungerer for deg med TegoNuke Mailer deaktiver, s&aring; b&oslash;r du istedet bruke TegoNuke Mailer og f&aring; ekstra rutiner for feilbehandling og batch send prosessering.<br /><br /><span class="thick">SMTP</span> = Velger du dette alternativet vil du f&aring; opp et vindu for videre konfigurering.  Dette vil kanskje v&aelig;re det eneste alternativet &aring; bruke for deg dersom hosten din har deaktivert native PHP mail() funksjonen. (MERK: hvis hosten din krever at du bruker SMTP, m&aring; du ogs&aring; konfigurere SMTP oppsettet i Forum konfigurasjonen din.)<br /><br /><span class="thick">SendMail</span> = Dette valget vil bruke sendmail daemonen.  Det vil for&oslash;vrig v&aelig;re veldig rart om hosten din foretrekker denne framfor authenticated SMTP, men muligheten er n&aring; engang her i tilfelle du skulle trenge den.');
define('_TNML_BOUNCEADDR_LAB', 'Email Bounce Address');
define('_TNML_BOUNCEADDR_HLP', 'Leave this blank if you do not wish to provide a bounce email address; However, having one could help keep you out of a spam blacklist.<br /><br />It is recommended that you create a separate email address to collect bounced emails so that you can keep on top of cleaning up bad/stale email addresses in the user table.  It may also be a good idea to ensure the address is one with your sending domain (again, spam blacklist reasons).');
define('_TNML_DEBUGLEVEL_LAB', 'Debug Level');
define('_TNML_DEBUGLEVEL_HLP', 'The Mailer provides the following debugging options with messages ONLY see by a logged in admin:<br /><br /><strong>OFF</strong> = No Debugging (default)<br /><br /><strong>ON, WITH SEND</strong> = admin ONLY will see debug messages and still send<br /><br /><strong>ON, WITH NO SEND</strong> = admin ONLY will see debug messages, but no mails will be sent (even though the system will behave as if they did)');
define('_TNML_SMTPHOST_LAB', 'Server');
define('_TNML_SMTPHOST_HLP', 'Spesifiser SMTP host navn - f.eks. smtp.yourdomain.tld eller mail.yourdomain.tld.<br /><br />De fleste webhotell-pakkene kommer med en eller annen form for kontrollpanel.  Vi anbefaler at du bruker kontrollpanelet til &aring; opprette en ny epost-konto p&aring; serveren din som KUN skal brukes til sending av eposter (bruk et annet passord enn det du bruker for din hovedkonto).  N&aring;r dette er gjort, eller om du m&aring; bruke ditt webhotells epost-konto, vil kontrollpanelet trolig ha et valg der du kan se hva de p&aring;krevde SMTP connection instillingene er - inkludert the riktige host navnet. Om ikke m&aring; du be hosten din om alle disse SMTP instillingene.');
define('_TNML_SMTPHELO_LAB', 'Helo');
define('_TNML_SMTPHELO_HLP', 'Spesifiser SMTP Helo.<br /><br />Dette er vanligvis det samme som SMTP HOST.  Pr&oslash;v &aring; sette den opp p&aring; samme m&aring;te.  Dersom oppsettet ikke fungerer m&aring; du sp&oslash;rre hosten din etter de riktige innstillingene.');
define('_TNML_SMTPPORT_LAB', 'Port');
define('_TNML_SMTPPORT_HLP', 'Spesifiser SMTP port.<br /><br />Denne er vanligvis 25, men hosten din krever kanskje at du benytter en annen port. <span class="thick">MERK:</span> TegoNuke Mailer har ikke st&oslash;tte for secure (SSL) connections (m&aring; ikke forveksles med authenticated connections)!');
define('_TNML_SMTPAUTH_LAB', 'Authentication');
define('_TNML_SMTPAUTH_HLP', 'Aktiver SMTP authentication.<br /><br />De fleste hostene krever at du oppgir authentication user and password, som vanligvis vil v&aelig;re din epost-adressen og passordet for den nye epost-kontoen du nettopp satte opp, eller muligens epost-adressen og passordet til din hoved epost-konto (ikke &aring; anbefale).');
define('_TNML_SMTPUSER_LAB', 'SMTP Username');
define('_TNML_SMTPUSER_HLP', 'Spesifiser SMTP username.<br /><br />Dette kan v&aelig;re det samme som epost-adressen til epost-kontoen du nettopp satte opp, eller det kan ogs&aring; v&aelig;re forskjellig (avhengig av kontrollpanelet og SMTP serveren.<br /><br />F.eks. - hvis brukeren du satte opp var <span class="thick">bruker</span>, har vi sett flere eksempler p&aring; bruken: <span class="thick">bruker</span>, <span class="thick">bruker@yourdomain.tld</span>, og <span class="thick">bruker+yourdomain.tld</span>.<br /><br />Hvis du ikke klarer &aring; f&aring; det til &aring; virke, blir du n&oslash;dt til &aring; ta kontakt med hosten din.');
define('_TNML_SMTPPASS_LAB', 'SMTP Password');
define('_TNML_SMTPPASS_HLP', 'Spesifiser SMTP password.<br /><br />Skriv det inn akkurat som i epost-kontoen du satte opp.');
define('_TNML_SMTPENCRYPT_LAB', 'Use Encryption?');
define('_TNML_SMTPENCRYPT_HLP', 'If your SMTP service is able to use encrypted sessions, it highly advisable that you use them.  Just make sure the method below is supported and that your SMTP port number above is appropriate as well.');
define('_TNML_SMTPENCRYPTMETHOD_LAB', 'Encryption Method');
define('_TNML_SMTPENCRYPTMETHOD_HLP', 'If encryption is to be used, you have a choice of either ssl or tls.');
define('_TNML_SENDMAIL_LAB', 'Sendmail Path');
define('_TNML_SENDMAIL_HLP', 'Absolutt sti/path (nettadresse) for &aring; kunne kj&oslash;re Sendmail.<br /><br />Det vil v&aelig;re merkelig om hosten din krever at du bruker denne daemon, som i v&aring;r mening er veldig &aring;pen for s&aring;rbarheter om den ikke settes opp skikkelig.  Vel, skulle du trenge den s&aring; er den i alle fall her.  Hvis standard sti/path ikke fungerer m&aring; du be hosten din om &aring; f&aring; de n&oslash;dvendige opplysningene.');
