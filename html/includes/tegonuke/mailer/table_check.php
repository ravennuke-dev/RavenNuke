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
 * access to the mail() function and requiring SMTP authentication.  This mailer
 * also supports SSL/TLS encrypted connections.
 *
 * IMPORTANT: This script must be included within mainfile.php AFTER the inclusion of
 * the SQL DB object layer (db/db.php) and before any script which depends upon it (such
 * as includes/nukesentinel.php).
 *
 * If the Mailer is activated within the Mailer administration, the constant TNML_IS_ACTIVE
 * will be available to use within your module code to determine if the Mailer is ready for
 * use like so:
 *
 *     if (TNML_IS_ACTIVE) {
 *          <<your code to call the tnml_fMailer() function>>
 *     }
 *
 * See the function comments below for details on how to call this function.
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
 * @version     1.1.0_249
 * @link        http://montegoscripts.com
 */
if (!defined('INCLUDE_PATH')) die('You cannott access this file directly...');
/**
 * This script is included from mailer.php only when the constant TNML_CHECK_TABLE is set to "true".
 * While is does not hurt for this check to be done all the time, once your table is updated to the
 * latest version, it is best to change the define of this constant within mailer.php to "false" to
 * avoid this extra included file and db calls.
 *
 * This script performs a new installation and/or an upgrade to the database table as needed. *
 */
$result = $db->sql_query('SHOW TABLES LIKE \'' . $prefix . '_mail_config\'');
if ($db->sql_numrows($result) > 0) {
	/*
	 * We already have tables, so need to check to see what updates we need to make
	 */
	$result = $db->sql_query('SHOW COLUMNS FROM `' . $prefix . '_mail_config` LIKE \'debug_level\'');
	if ($db->sql_numrows($result) > 0) {
	} else {
		/*
		 * Ok, new field for this version was not found, so need to add all the fields, plus need to drop one.
		 */
		$sql = 'ALTER TABLE `' . $prefix . '_mail_config` ADD `smtp_encrypt` tinyint(4) NOT NULL DEFAULT \'0\' '
			. 'AFTER `sendmail_path`, ADD `smtp_encrypt_method` tinyint(4) NOT NULL DEFAULT \'0\' AFTER `smtp_encrypt`, '
			. 'ADD `reply_to` varchar(255) NOT NULL DEFAULT \'\' AFTER `smtp_encrypt_method`, ADD `debug_level` tinyint(4) '
			. 'NOT NULL DEFAULT \'0\' AFTER `reply_to`, DROP `qmail_path`;';
		$result = $db->sql_query($sql);
	}
} else {
	/*
	 * Ok, first time install so need to create the tables from scratch.
	 */
	$sql = 'CREATE TABLE IF NOT EXISTS `' . $prefix . '_mail_config` (`active` tinyint(1) NOT NULL default \'0\', '
		. '`mailer` tinyint(1) NOT NULL default \'1\', `smtp_host` varchar(255) NOT NULL default \'\', '
		. '`smtp_helo` varchar(255) NOT NULL default \'\', `smtp_port` int(10) NOT NULL default \'25\', '
		. '`smtp_auth` tinyint(1) NOT NULL default \'0\', `smtp_uname` varchar(255) NOT NULL default \'\', '
		. '`smtp_passw` varchar(255) NOT NULL default \'\', `sendmail_path` varchar(255) NOT NULL default \'/usr/sbin/sendmail\', '
		. '`smtp_encrypt` tinyint(4) NOT NULL default \'0\', `smtp_encrypt_method` tinyint(4) NOT NULL default \'0\', '
		. '`reply_to` varchar(255) NOT NULL, `debug_level` tinyint(4) NOT NULL default \'0\', PRIMARY KEY (`mailer`)) '
		. 'TYPE=MyISAM';
	$result = $db->sql_query($sql);
	$sql = 'INSERT INTO `' . $prefix . '_mail_config` (`active`, `mailer`, `smtp_host`, `smtp_helo`, `smtp_port`, `smtp_auth`, '
		. '`smtp_uname`, `smtp_passw`, `sendmail_path`, `smtp_encrypt`, `smtp_encrypt_method`, `reply_to`, `debug_level`) VALUES '
		. '(0, 1, \'yourmaildomain.tld\', \'yourmaildomain.tld\', 25, 0, \'user@youmaildomain.tld\', \'userpass\', '
		. '\'/usr/sbin/sendmail\', 0, 0, \'\', 0);';
	$result = $db->sql_query($sql);
}

