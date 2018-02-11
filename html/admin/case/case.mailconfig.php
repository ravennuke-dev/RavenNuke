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
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @category    Integration
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 - 2010 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0_249
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
switch ($op) {
	case 'MailConfig': // Left here for legacy nukeSEO DH menu operations
	case 'tnmlMailConfig':
	case 'tnmlAbout':
	case 'tnmlMailConfigSave':
		include_once('admin/modules/mailconfig.php');
		break;
}
