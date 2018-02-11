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
/*
 * If you are certain that the configuration table has been created/upgraded, you may
 * turn off the table check by changing the below "true" to "false" and re-upload
 * this script.
 */
define('TNML_CHECK_TABLE', true);
/**
 * All the configuration should be done with the Mailer administration on-line. Nothing
 * should need to be modified below.
 */
define('TNML_FAILURE', 0);
define('TNML_VERSION', '1.1.0');
define('TNML_SWIFT_VERSION', '4.0.6');

if (TNML_CHECK_TABLE) {
	include NUKE_INCLUDE_DIR . 'tegonuke/mailer/table_check.php';
}
$tnml_asCfg = array();
$result = $db->sql_query('SELECT * FROM ' . $prefix . '_mail_config');
$row = $db->sql_fetchrow($result);
$tnml_asCfg['nm_is_active'] = intval($row['active']);
if ($tnml_asCfg['nm_is_active'] == 1) define('TNML_IS_ACTIVE', true); else define('TNML_IS_ACTIVE', false);

$tnml_asCfg['mailer'] = intval($row['mailer']);         // Which transport is desired - 1 = mail(), 2 = SMTP, 3 = sendmail
$tnml_asCfg['smtp_host'] = $row['smtp_host'];           // SMTP host address
$tnml_asCfg['smtp_port'] = intval($row['smtp_port']);   // SMTP host port - usually 25 for non-encrypted connections
$tnml_asCfg['smtp_helo'] = $row['smtp_helo'];           // Usually the name as SMTP host address
$tnml_asCfg['smtp_auth'] = intval($row['smtp_auth']);   // Is athorization required?  0 = no, 1 = yes
$tnml_asCfg['smtp_uname'] = $row['smtp_uname'];         // The authorized user
$tnml_asCfg['smtp_passw'] = $row['smtp_passw'];         // The authorized user password (sorry, not encrypted)
$tnml_asCfg['sendmail_path'] = $row['sendmail_path'];   // The patch on the server to the sendmail program if that option is chosen (include any sendmail options as well if needed)
$tnml_asCfg['smtp_encrypt'] = $row['smtp_encrypt'];     // 0 = do not encrypt, 1 = use encryption as defined next
$tnml_asCfg['smtp_encrypt_method'] = $row['smtp_encrypt_method']; // 1 = 'ssl', 2 = 'tls'; 0 if smtp_encrypt is "off"
$tnml_asCfg['reply_to'] = $row['reply_to'];             // Email addresses for bounced emails
$tnml_asCfg['debug_level'] = $row['debug_level'];       // 0 = debug off, 1 = debug on, but still send, 2 = debug on, don't send
/*
 * Do not change this next line!  This is just to set a consistent flag to check the debug status with to
 * reduce the number of function calls.  ;-)
 */
if (isset($admin) && $tnml_asCfg['debug_level'] && is_admin($admin)) define('TNML_DEBUG', true); else define('TNML_DEBUG', false);
/**
 * Mailer function which serves as the interface between *nuke and the Swift Mailer Library.
 *
 * The to, cc and bcc addresses are passed in either via a simple string with one email address, or
 * an associative array.  Here is an example of a mixed associative array to demonstrate the proper
 * formatting:
 *
 * $to = array(
 *     'person1@example.org',
 *     'person2@otherdomain.org' => 'Person 2 Name',
 *     'person3@example.org',
 *     'person4@example.org',
 *     'person5@example.org' => 'Person 5 Name'
 * );
 *
 * The underlying Swift Mailer, and this interface, is now defaulted to UTF-8, so the data passed into the
 * Mailer should NOT be encoded with the only exception being if needed htmlspecialcharacters() for proper
 * display of HTML TEXT in am email as apposed to having rendered HTML.
 *
 * The $params variable is an associative array of additional parameters which may be passed into the Mailer
 * to give more configurability over time to the Mailer functions.  Here are the current list of implemented
 * parameters:
 *
 * 'html'     => 0 or not set = 'text/plan', 1 = 'text/html'
 * 'batch'    => 0 or not set = just regular send(), 1 = batchSend().  The Mailer's send() method will send only
 *               one email with all the $to recipients on the To line.  Whereas, batchSend(), will send an
 *               individual mail to each of the $to recipients.
 * 'priority' => 1 (Highest), 2 (High), 3 (Normarl - default), 4 (Low), 5 (Lowest)
 *
 * @param string|array $to is either a single email address string or an associative array of just addresses and/or address/name pairs
 * @param string $subject is the subject line for the email (no HTML should be used)
 * @param string $body is the main body text
 * @param string|array $from is either a single email address string or an associative array of just addresses and/or address/name pairs (NOTE: the FIRST address in the array will be used for the sender address for the return path)
 * @param string $fromname (deprecated) although still allowed, should use an associative array in $from instead go forward
 * @param array $params is an associative array of additional parameters (see above for more details on possible parms)
 * @param string|array $cc (not currently used) is either a single email address string or an associative array of just addresses and/or address/name pairs
 * @param string|array $bcc (not currently used) is either a single email address string or an associative array of just addresses and/or address/name pairs
 * @param tbd $attachment (not currently used)
 */
function tnml_fMailer(&$to, $subject = null, $body = null, $from = null, $fromname = null,
	$params = null, $cc = null, $bcc = null, $attachment = null)
{
	global $tnml_asCfg;
	$sent = TNML_FAILURE;
	/*
	 * Instantiate the Swift Mailer, but should only have to do this once - the first time this function is called.
	 */
	if (TNML_DEBUG) echo '<div class="tntnWrap">';
	tnmlMsgDebug('Instantiating the Mailer...');
	static $mailer, $transport, $logger;
	if (!isset($mailer)) {
		// Load the Swift auto loader
		require dirname(__FILE__) . '/Swift/swift_required.php';
		// Instantiate the appropriate mail transport that is currently configured witin the Mailer admin
		switch ((int)$tnml_asCfg['mailer']) {
			case 1:  // PHP mail() transport
				$transport = Swift_MailTransport::newInstance();
				break;
			case 2:  // SMTP transport
				$transport = Swift_SmtpTransport::newInstance($tnml_asCfg['smtp_host'], $tnml_asCfg['smtp_port'])
					->setUsername($tnml_asCfg['smtp_uname'])
					->setPassword($tnml_asCfg['smtp_passw'])
				;
				if ($tnml_asCfg['smtp_encrypt']) {
					$transport->setEncryption(($tnml_asCfg['smtp_encrypt_method'] = 2) ? 'tls' : 'ssl');
				}
				break;
			case 3:  // sendmail transport
				$transport = Swift_SendmailTransport::newInstance($tnml_asCfg['sendmail_path']);
				break;
			default: // @todo should throw an error
				if (TNML_DEBUG) echo '</div>';
				return TNML_FAILURE;
				break;
		}

		// Instantiate the Mailer object based upon this transport
		$mailer = Swift_Mailer::newInstance($transport);
		tnmlMsgDebug('...Mailer is instantiated');

		// If in debug mode, use the Logger Plug-In to find out what is going on.
		// The current version of the Mailer is configured to only use the "Echo" version
		// which echoes the log info to the page.  At least it will only ever show to a logged
		// in admin.  This should suffice it for now until such time as a more generalized logging
		// utility can be written/used.
		if (TNML_DEBUG) {
			$logger = new Swift_Plugins_Loggers_EchoLogger();
			$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
		}
	}
	/*
	 * If in debug mode, should write out the values of each of the input variables
	 */
	tnmlMsgDebug('$to =', $to);
	tnmlMsgDebug('$from =', $from);
	tnmlMsgDebug('$subject =', $subject);
//	tnmlMsgDebug('$body =', $body); // Will leave this one commented out as the body could be quite large!
/*
	* Validate and cleanse passed parameters
	*/
	if (empty($to) || empty($from) || empty($subject) || empty($body)) {
		if (TNML_DEBUG) echo '</div>';
		return TNML_FAILURE; // Required parms!
	}

	// Validate/cleanse the Recipients ($to) and Senders ($from) address lists to get them into
	// the format required by the Swift Mailer, which is either a string or associative array.
	$recipients = tnmlConvertAddresses($to);

	// Validate/cleanse the Sender(s) ($from)
	// If the $from variable is not an associative array or simple string, convert it
	// HOWEVER: It would be MUCH BETTER use of resources to not have to do this conversion!!!!
	$senders = tnmlConvertAddresses($from, $fromname);

	// $sender is really only necessary when there are multiple $from addresses, but it does not
	// hurt to value.  Right now, this is coded to just take the first address from the $from ($senders) list.
	if (is_array($senders)) {
		$sender = key($senders);
	} else {
		$sender = $senders;
	}

	// If the sendmail path is not set, try and get from the php.ini
	if (empty($tnml_asCfg['sendmail_path'])) {
		$tnml_asCfg['sendmail_path'] = @ini_get('sendmail_path');
	}
	// If the sendmail path is still empty, have no choice but to abort the send
	if (empty($tnml_asCfg['sendmail_path'])) {
		if (TNML_DEBUG) echo '</div>';
		return TNML_FAILURE;
	}

	/*
	 * Evaluate the additional $params passed in
	 */
	$mimeType = 'text/plain';
	$msgPriority = 3;
	if (!empty($params) && count($params) > 0) {
		// Get the appropriate mime type to use
		$mimeType = (isset($params['html']) and $params['html'] == 1) ? 'text/html' : 'text/plain';
		// Get message priority if it exists
		$msgPriority = (isset($params['priority'])) ? (int)$params['priority'] : 3; // Valid options are 1 (Highest) thru 5 (Lowest)
		if ($msgPriority < 1 || $msgPriority > 5) $msgPriority = 3;
	}

	/*
	 * Instantiate the appropriate Message to send
	 */
	$message = Swift_Message::newInstance();
	$message->setSubject($subject);
	$message->setBody($body, $mimeType);
	$message->setPriority($msgPriority);
	// Just in case of dirty recipient addresses, we should try and catch any Message exceptions
	try {
		$message->setTo($recipients);
	}
	catch (Exception $e) {
		$errorMsg = '<div>' . htmlspecialchars($e . ': ' . $e->getMessage()) . '</div>';
		tnmlMsgDebug('Caught Exception with $message->setTo():', $errorMsg);
		if (TNML_DEBUG) echo '</div>';
		return TNML_FAILURE;
	}
	// While the from address(es) should be valid as they are usually set up by the admin, this
	// will not always be the case with the Mailer as sometimes the $from is coming from user input.
	try {
		$message->setFrom($senders);
	}
	catch (Exception $e) {
		$errorMsg = '<div>' . htmlspecialchars($e . ': ' . $e->getMessage()) . '</div>';
		tnmlMsgDebug('Caught Exception with $message->setFrom():', $errorMsg);
		if (TNML_DEBUG) echo '</div>';
		return TNML_FAILURE;
	}
	try {
		$message->setSender($sender);
	}
	catch (Exception $e) {
		$errorMsg = '<div>' . htmlspecialchars($e . ': ' . $e->getMessage()) . '</div>';
		tnmlMsgDebug('Caught Exception with $message->setSender():', $errorMsg);
		if (TNML_DEBUG) echo '</div>';
		return TNML_FAILURE;
	}
	// If have a configured bounce email address, use it!  Highly unlikely for this to be an issue as
	// it is set in the Mailer admin and will be checked for being valid, therefore, not wrapped in try/catch.
	if (!empty($tnml_asCfg['reply_to'])) $message->setReturnPath($tnml_asCfg['reply_to']);

	// If in debug mode let us print out the message headers
	if (TNML_DEBUG) {
		$headers = $message->getHeaders();
		echo '<strong>Message object headers =</strong><br /><div>', nl2br(htmlspecialchars($headers->toString())), '</div>';
	}

	/*
	 * Send the message as long as we're not at debug level 2
	 * $sent will contain the number of successful sends to recipients that we had
	 */
	if (TNML_DEBUG && 2 == $tnml_asCfg['debug_level']) {
		tnmlMsgDebug('Mailer debug setting set to NOT SEND, therefore no mail was sent');
		$sent = count($recipients); // Need to let the calling script think the mail was successful
	} else {
		tnmlMsgDebug('Mailer attempting to send...');
		if (isset($params['batch']) and $params['batch'] == 1) {
			try {
				$sent = $mailer->batchSend($message);
			}
			catch (Exception $e) {
				$errorMsg = '<div>' . htmlspecialchars($e . ': ' . $e->getMessage()) . '</div>';
				tnmlMsgDebug('Caught Exception with $mailer->batchSend():', $errorMsg);
				if (TNML_DEBUG) echo '</div>';
				return TNML_FAILURE;
			}
		} else {
			try {
				$sent = $mailer->send($message);
			}
			catch (Exception $e) {
				$errorMsg = '<div>' . htmlspecialchars($e . ': ' . $e->getMessage()) . '</div>';
				tnmlMsgDebug('Caught Exception with $mailer->send():', $errorMsg);
				if (TNML_DEBUG) echo '</div>';
				return TNML_FAILURE;
			}
		}
		tnmlMsgDebug('...Mailer done sending.');
	}

	/*
	 * Done with the message, so destroy just the Message object and return the number of
	 * successful emails sent back to the calling code.
	 */
	unset($message); // Destroy the Messsage object now that we're done with it.
	if (TNML_DEBUG) echo '</div>';
	return $sent;
}
/**
 * Converts incoming email addresses into proper Swift format
 *
 * @param mixed $convertMe is either a string, an array of email addresses, or compound array of email address/name pairs
 * @param string $name if provided, is the name to use with a single email address
 * @return array of properly formatted address/name pairs
 */
function tnmlConvertAddresses(&$convertMe, $name = null)
{
	global $tnml_asCfg;
	if (is_array($convertMe)) {
		tnmlMsgDebug('We are in tnmlConvertAddresses with $convertMe =', $convertMe);
		if (is_array($convertMe[0])) { // We have an old implementation of TegoNuke(tm) Mailer where array is not associative
			$addresses = array();
			$j = count($convertMe);
			for ($i = 0; $i < $j; $i++) {
				if (is_array($convertMe[$i])) {
					$addresses[$convertMe[$i][0]] = $convertMe[$i][1];
				} else {
					$addresses[$convertMe[$i]] = null;
				}
			}
		} else {
			$addresses = $convertMe;
		}
	} else {
		tnmlMsgDebug('We are in tnmlConvertAddresses with $convertMe = ', $convertMe);
		tnmlMsgDebug('We are in tnmlConvertAddresses with $name =  . ', $name);
		if (empty($name)) {
			$addresses = $convertMe;
		} else {
			$addresses = array($convertMe => $name);
		}
	}

	tnmlMsgDebug('We are in tnmlConvertAddresses and the final conversion  = ', $addresses);
	return $addresses;
}
/**
 * Provides standardized debugging messages if debugging option is turned on. *
 *
 * @param string $msgTxt is the text to display
 * @param mixed $msgDetails is additional display text details such as variable contents
 * @returns string of html output
 */
function tnmlMsgDebug($msgTxt = '', $msgDetails = null)
{
	global $tnml_asCfg;
	if (empty($msgTxt)) return;
	if (TNML_DEBUG) {
		echo '<strong>', $msgTxt, '</strong><br />';
		if (!empty($msgDetails)) {
			if (is_array($msgDetails)) {
				print_r($msgDetails);
			} else {
				echo $msgDetails;
			}
			echo '<br />';
		}
	}
	return;
}
/**
 * Checks for existence of the mail config table and if not there, creates it
 *
 * @return  boolean  true = success, false = failure (not really used as it will just create the table and seed it with default data)
 */
function tnmlTableCheck() {
	global $db, $prefix;
	$result = $db->sql_query('SHOW TABLES LIKE \'' . $prefix . '_mail_config\'');
	if ($db->sql_numrows($result) > 0) {
		/*
		 * We already have tables, so need to check to see what updates we need to make
		 */
		$result = $db->sql_query('SHOW COLUMNS FROM `' . $prefix . '_mail_config` LIKE \'debug_level\'');
		if ($db->sql_numrows($result) > 0) {
			echo "table exists already";
			return true;
		} else {
			/*
			 * Ok, new field for this version was not found, so need to add all the fields, plus need to drop one.
			 */
			$sql = 'ALTER TABLE `' . $prefix . '_mail_config` ADD `smtp_encrypt` tinyint(4) NOT NULL DEFAULT \'0\' '
				. 'AFTER `sendmail_path`, ADD `smtp_encrypt_method` tinyint(4) NOT NULL DEFAULT \'0\' AFTER `smtp_encrypt`, '
				. 'ADD `reply_to` varchar(255) NOT NULL DEFAULT \'\' AFTER `smtp_encrypt_method`, ADD `debug_level` tinyint(4) '
				. 'NOT NULL DEFAULT \'0\' AFTER `reply_to`, DROP `qmail_path`;';
			$result = $db->sql_query($sql);
			return false;
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
		return false;
	}
}
