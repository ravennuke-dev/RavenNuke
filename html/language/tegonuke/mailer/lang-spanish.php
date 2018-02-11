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
define('_TNML_MNU_BACK2ADM_LAB', 'Administración del Sitio');
define('_TNML_MNU_MAILCFG_LAB', 'Configuración de TegoNuke Mailer');
define('_TNML_MNU_ABOUT_LAB', 'Acerca de TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Sitúe el cursor sobre estos iconos para ayuda adicional');
define('_TNML_HLP_LEGEND_HLP', 'Correcto, así es como se hace!');
define('_TNML_OPTSGENERAL_LAB','General Mailer Options');
define('_TNML_OPTSSMTP_LAB','SMTP Configuration Settings');
define('_TNML_OPTSSENDMAIL_LAB','Sendmail Configuration Settings');
define('_TNML_OFF','OFF');
define('_TNML_ONWITHSEND','ON, WITH SEND');
define('_TNML_ONNOSEND','ON, NO SEND');
define('_TNML_NONE','None');
define('_TNML_PNMACTIVATE_LAB', 'Activar Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Activa o Desactiva el mailer.<br /><br />Si encuentras que tu sistema RavenNuke(tm) / PHP-Nuke no está enviando emails, tu servidor puede haber bloqueado el uso de la función PHP mail(). Puedes usar SMTP autenticado, que es donde este Mailer entra en acción.<br /><br /><span class="thick">No</span> = La función nativa predeterminada PHP mail() será usada.  Este es el valor por defecto.<br /><br /><span class="thick">Si</span> = Activará el Mailer y te permitirá escoger el <span class="thick">Método de Envío</span>.<br /><br />(See help pop-up on Send Method for what you can configure next.)');
define('_TNML_SENDMETHOD_LAB', 'Método de Envío');
define('_TNML_SENDMETHOD_HLP', 'Especificar el método de envío deseado.<br /><br />La mayor parte del tiempo, si se necesita utilizar este Mailer, su servidor le pedirá utilizar SMTP autentificado. En este caso, seleccione la opción SMTP y podrá realizar los ajustes adicionales de su servicio SMTP. Actualmente, las opciones disponibles son:<br /><br /><span class="thick">Mail()</span> = Usar la función mail(). Es la función nativa por defecto de PHP.  (Si la función mail() está funcionando con el mailer desactivado, puede usar este mailer y obtener características adicionales como mejor gestión de errores y procesamiento de envío por lotes.<br /><br /><span class="thick">SMTP</span> = Seleccionando esta opción podrá ajustar algunas configuraciones adicionales. Esta puede ser la única opción a utilizar si su servicio de alojamiento ha desactivado la nativa función mail() de PHP. (NOTA: Si su servidor requiere el uso de SMTP, también debe ajustar la configuración del servidor SMTP dentro de los Foros.)<br /><br /><span class="thick">SendMail</span> = Esta opción usará el demonio sendmail. Sería extraño que algún servidor exija SendMail sobre SMTP autenticado, pero solo en caso de que lo necesite, aquí está.');
define('_TNML_BOUNCEADDR_LAB', 'Email Bounce Address');
define('_TNML_BOUNCEADDR_HLP', 'Leave this blank if you do not wish to provide a bounce email address; However, having one could help keep you out of a spam blacklist.<br /><br />It is recommended that you create a separate email address to collect bounced emails so that you can keep on top of cleaning up bad/stale email addresses in the user table.  It may also be a good idea to ensure the address is one with your sending domain (again, spam blacklist reasons).');
define('_TNML_DEBUGLEVEL_LAB', 'Debug Level');
define('_TNML_DEBUGLEVEL_HLP', 'The Mailer provides the following debugging options with messages ONLY see by a logged in admin:<br /><br /><strong>OFF</strong> = No Debugging (default)<br /><br /><strong>ON, WITH SEND</strong> = admin ONLY will see debug messages and still send<br /><br /><strong>ON, WITH NO SEND</strong> = admin ONLY will see debug messages, but no mails will be sent (even though the system will behave as if they did)');
define('_TNML_SMTPHOST_LAB', 'Servidor');
define('_TNML_SMTPHOST_HLP', 'Especificar el servidor SMTP - ej. smtp.yourdomain.tld o mail.yourdomain.tld.<br /><br />La mayoría de servicios de alojamiento viene con algún tipo de Panel de Control. Le recomendamos utilizar dicho panel de control para crear una nueva cuenta de correo en su servidor, que se utilizará solamente para el envío de mensajes (Utilice una contraseña diferente a la de su cuenta principal). Una vez configurado, o incluso si tienes que utilizar tu cuenta de correo principal, su Panel de Control debería tener la opción de mostrar las opciones de configuración SMTP necesarias, incluso el nombre del servidor. De lo contrario, pregunta por los ajustes necesarios del servidor SMTP.');
define('_TNML_SMTPHELO_LAB', 'SMTP Helo');
define('_TNML_SMTPHELO_HLP', 'Especificar el SMTP Helo.<br /><br />Esto usualmente es igual al Servidor SMTP.  Prueba poniendo lo mismo y si no funciona, consulta tu servicio de alojamiento.');
define('_TNML_SMTPPORT_LAB', 'Puerto');
define('_TNML_SMTPPORT_HLP', 'Especificar puerto SMTP.<br /><br />Usualmente es 25, puede requerir un puerto diferente. <span class="thick">NOTA:</span> Este mailer actualmente no soporta conexiones seguras (SSL), que no deben ser confundidas con conexiones autenticadas!');
define('_TNML_SMTPAUTH_LAB', 'Autenticación');
define('_TNML_SMTPAUTH_HLP', 'Activar autenticación SMTP.<br /><br />La mayoría de servidores requieren que se les proporcione la autenticación de usuario y contraseña, que debería ser la cuenta de correo electrónico y la contraseña de la nueva cuenta que acabas de crear, o podría ser su principal cuenta de correo (no recomiendable).');
define('_TNML_SMTPUSER_LAB', 'Username');
define('_TNML_SMTPUSER_HLP', 'Especificar usuario SMTP.<br /><br />Esto puede ser igual a la cuenta de correo electrónico configurada, o, dependiendo del Panel de Control y el Servidor SMTP, puede ser un poco diferente.<br /><br />Por ejemplo, si el usuario que configuraste se llama <span class="thick">user</span>, se pueden presentar las siguientes formas de nombre de usuario: <span class="thick">user</span>, <span class="thick">user@yourdomain.tld</span>, y <span class="thick">user+yourdomain.tld</span>.<br /><br />Si esto no funciona, puede contactar su servicio de alojamiento.');
define('_TNML_SMTPPASS_LAB', 'Contraseña');
define('_TNML_SMTPPASS_HLP', 'Especicar contraseña del servidor SMTP.<br /><br />Escríbelo tal como lo configuraste.');
define('_TNML_SMTPENCRYPT_LAB', 'Use Encryption?');
define('_TNML_SMTPENCRYPT_HLP', 'If your SMTP service is able to use encrypted sessions, it highly advisable that you use them.  Just make sure the method below is supported and that your SMTP port number above is appropriate as well.');
define('_TNML_SMTPENCRYPTMETHOD_LAB', 'Encryption Method');
define('_TNML_SMTPENCRYPTMETHOD_HLP', 'If encryption is to be used, you have a choice of either ssl or tls.');
define('_TNML_SENDMAIL_LAB', 'Ruta para Sendmail');
define('_TNML_SENDMAIL_HLP', 'Ruta absoluta para usar Sendmail.<br /><br />Sería raro que su servidor requiera usar este demonio porque, en nuestra opinión, puede ser fácilmente explotado si no se configura correctamente. Pero, en caso de necesitarlo, aquí está. Si la ruta por defecto no funciona, puede preguntar a su servicio de alojamiento la ruta correcta.');
