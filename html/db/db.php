<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id$
 * @copyright 2013 by RavenNuke(tm)
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

if (defined('NUKE_BASE_DIR')) {
	define('DB_PATH', NUKE_BASE_DIR . '/db/');
} else {
	define('DB_PATH', dirname(__FILE__) . '/');
}

switch($dbtype) {
	default:
	case 'MySQLI':
		include_once DB_PATH . 'mysqli.php';
		break;
}

$db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);

if ($db->connectionError || $db->dbError || $db->errorConfigTableMissing || $db->dbVersionCompare) {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
		, '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
		, '<html>'
		, '<head>'
		, '<title>Raven Web Hosting &copy; - Quality Web Hosting For All PHP Applications.</title>'
		, '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
		, '<style type="text/css">'
		, '/*<![CDATA[*/'
		, 'div.c1 {text-align: center; font-weight: bold; color: red; border: dotted red; border-width: 2px; padding: 2em; border-collapse: collapse;}'
		, 'div.c2 {text-align: center;}'
		, 'p.d1 {font-weight: bold;}'
		, 'p.d2,span.d2 {text-decoration: none; text-align: center; font-weight: bold; color: red;}'
		, '/*]]>*/'
		, '</style>'
		, '</head>'
		, '<body>'
		, '<br /><br />'
		, '<div class="c2">'
		, '<img src="images/logo.gif" alt="MySQL Error" />';

	if ($db->connectionError) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem connecting to the server.</p>'
			, '<div class="c1"><p class="d2">';
		if ($display_errors) {
			echo $db->connectionError , '<br /><br />';
		}
		echo 'Check with the System Administrator for the server status.</p>'
			, '</div>';
	}

	if ($db->dbError) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem connecting to the database.</p>'
			, '<div class="c1">'
			, '<p class="d2">Check with the System Administrator for the server status, or if you are the System Administrator and installing this for the first time,<br />'
			, 'did you remember to create your database first?</p>'
			, '</div>';
	}

	if ($db->errorConfigTableMissing) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem with the System Configuration Table - it\'s missing.</p>'
			, '<div class="c1">'
			, 'If you are the System Administrator and installing this for the first time,<br />did you remember to run the '
			, '<a href="INSTALLATION/installSQL.php">INSTALLATION/installSQL.php file</a>?'
			, '</div>';
	}

	if ($db->dbVersionCompare) {
		echo $db->dbVersionCompare;
	}

	echo '<p>&nbsp;</p><p class="d1">If you are not the System Administrator, please report this to the Administrator and/or Web Master ASAP.</p>'
		, '<p class="d1">We will be back as soon as possible.</p>'
		, '</div>'
		, '</body></html>';
	exit();
}

?>