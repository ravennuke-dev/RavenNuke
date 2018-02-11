<?php
/**
* @category RavenNuke 3.0
* @package Core
* @subpackage elFinder
* @version $Id$
* @copyright (c) 2012 Raven Web Services, LLC
* @link http://www.ravennuke.com
* @license http://www.gnu.org/licenses/gpl.html GNU/GPL 3
*
* PHP connector for elFinder
*/

define('ELFINDER_PATH', dirname(__FILE__) . '/');

require_once ELFINDER_PATH . '../../../mainfile.php';
require_once ELFINDER_PATH . 'elFinderConnector.class.php';
require_once ELFINDER_PATH . 'elFinder.class.php';
require_once ELFINDER_PATH . 'elFinderVolumeDriver.class.php';
require_once ELFINDER_PATH . 'elFinderVolumeLocalFileSystem.class.php';
require_once ELFINDER_PATH . 'elFinderVolumeFTP.class.php';

/**
 * Base elFinder class for RN implementation
 *
 * This abstract class is created so it can be extended by individual modules  so they have their own configuration options.
 */
abstract class elfinderBase {
	/**
	* Logger class object
	*
	* @var object
	*/
	protected $logger;

	/**
	* Log file name.  Must be defined in child class.
	*
	* @var string
	*/
	protected $log;

	/**
	* Configuration settings
	*
	* @var array
	*/
	protected $opts = array();

	/**
	* The class constructor
	*
	* This determines if we are uploading or starting a regular instance.
	*
	* @global admin used to determine if user is an admin
	*/
	public function __construct() {
		global $admin;

		/*
		 * Only admins can access the file manager.  If a user tries to access it it should say no volumes are avaiable.
		*/
		if (is_admin($admin)) {
			$cmd = (!empty($_GET['cmd']) && $_GET['cmd'] == 'upload') ? true : false;
			/*
			* If we are uplaoding
			*/
			if ($cmd) {
				$this->upload();
			} else {
				/*
				* Run elFinder
				*/
				$elfinder = new elFinderConnector(new elFinder($this->opts));
				$elfinder->run();
			}
		} else {
			$this->opts = array();
		}
	}

	/**
	* Upload files to volume
	*
	* This is needed so that ckEditor can jump on the back of elFinder's upload function.
	* Will return error message and filename in an array.
	* This is not perfect, but seemed to be the simplest solution.
	*
	* @global $_FILES contains uploaded files
	*
	* @return array
	*/
	protected function upload() {
		if (isset($_FILES['upload'])) {
			if (is_array($_FILES['upload']) && !is_array($_FILES['upload']['name'])) {
				$tmp['name'] = array($_FILES['upload']['name']);
				$tmp['type'] = array($_FILES['upload']['type']);
				$tmp['tmp_name'] = array($_FILES['upload']['tmp_name']);
				$tmp['error'] = array($_FILES['upload']['error']);
				$tmp['size'] = array($_FILES['upload']['size']);
				unset($_FILES['upload']);
				$_FILES['upload'] = $tmp;
			}
		}

		global $elLanguage;
		if (file_exists(ELFINDER_PATH . 'language/elfinder.' . $this->getDefaultLanguage() . '.php')) {
			include_once ELFINDER_PATH . 'language/elfinder.' . $this->getDefaultLanguage() . '.php';
		} else {
			include_once ELFINDER_PATH . 'language/elfinder.en.php';
		}

		/*
		* Our upload class that extend elFinder
		*/
		$upload = new elupload($this->opts);
		$data = $upload->upload(array('target' => $_GET['target'], 'FILES' => $_FILES));

		$message = '';
		if (array_key_exists('warning', $data)) $message .= $this->processError($message, $data['warning'], $elLanguage);
		if (array_key_exists('error', $data)) $message .= $this->processError($message, $data['error'], $elLanguage);
		$filename = (!empty($data['added'])) ? $data['added'][0]['name'] : '';
		return array('message' => $message, 'filename' => $filename);
	}

	/**
	 * Parse error array
	 *
	 * @param  string $message previous error message
	 * @param  array $errors errors
	 * @param array $language language constants
	 * @return string
	 **/
	public function processError($message, $errors, $langage) {
		$count = count($errors);
		for ($i = 0; $i < $count; $i++) {
			$error = array_key_exists($errors[$i], $langage) ? $langage[$errors[$i]] : $errors[$i];
			if (stristr($error, '%s')) {
				$i++;
				$error = sprintf($error, $errors[$i]);
			}
			$message .= $error . '\n';

		}
		return $message;
	}

	/**
	 * Get Browser Language
	 *
	 * @return string
	 *
	 * @author Darrin Yeager
	 * @copyright 2008
	 * @link http://www.dyeager.org
	 * @license BSD - http://www.dyeager.org/downloads/license-bsd.php
	 **/
	public function getDefaultLanguage() {
		static $languages;
		if (!isset($languages)) {
			if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				$language =  $this->parseDefaultLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			} else {
				$language = $this->parseDefaultLanguage(NULL);
			}
		}
		return $language;
	}

	/**
	 * Parse Browser Language
	 *
	 * @param  string $http_accept HTTP Language Headers
	 * @param  string $deflang default language
	 * @return string
	 *
	 * @author Darrin Yeager
	 * @copyright 2008
	 * @link http://www.dyeager.org
	 * @license BSD - http://www.dyeager.org/downloads/license-bsd.php
	 **/
	public function parseDefaultLanguage($http_accept, $deflang = 'en') {
		if(isset($http_accept) && strlen($http_accept) > 1) {
			// Split possible languages into array
			$x = explode(',', $http_accept);
			foreach ($x as $val) {
				// check for q-value and create associative array. No q-value means 1 by rule
				if(preg_match('/(.*);q=([0-1]{0,1}\.\d{0,4})/i', $val, $matches)) {
					$lang[$matches[1]] = (float)$matches[2];
				} else {
					$lang[$val] = 1.0;
				}
			}

			// return default language (highest q-value)
			$qval = 0.0;
			foreach ($lang as $key => $value) {
				if ($value > $qval) {
					$qval = (float)$value;
					$deflang = $key;
				}
			}
		}
		return strtolower($deflang);
	}
}

/**
* Simple upload class
*
* This extension of the elFinder class is needed to access its uplaod function because it is protected.
*/
class elupload extends elFinder {
	public function __construct($opts) {
		parent::__construct($opts);
	}

	public function upload($args) {
		return parent::upload($args);
	}
}

/**
 * Simple logger function.
 * Demonstrate how to work with elFinder event api.
 *
 * @package elFinder
 * @author Dmitry (dio) Levashov
 **/
class elFinderSimpleLogger {

	/**
	 * Log file path
	 *
	 * @var string
	 **/
	protected $file = '';

	/**
	 * constructor
	 *
	 * @return void
	 * @author Dmitry (dio) Levashov
	 **/
	public function __construct($path) {
		$this->file = $path;
		$dir = dirname($path);
		if (!is_dir($dir)) {
			mkdir($dir);
		}
	}

	/**
	 * Create log record
	 *
	 * @author Dmitry (dio) Levashov
	 *
	 * @param  string   $cmd       command name
	 * @param  array    $result    command result
	 * @param  array    $args      command arguments from client
	 * @param  elFinder $elfinder  elFinder instance
	 *
	 * @global admin used to determine if user is an admin
	 *
	 * @return void|true
	 **/
	public function log($cmd, $result, $args, $elfinder) {
		global $admin;
		if (!is_array($admin)) {
			$admin = base64_decode($admin);
			$admin = addslashes($admin);
			$admin = explode(':', $admin);
		}
		$aid = isset($admin[0]) ? substr($admin[0], 0, 25) : '';

		$log = $cmd.' [' . date('d.m H:s') . '] - ' . $aid . "\n";

		if (!empty($result['error'])) {
			$log .= "\tERROR: " . implode(' ', $result['error']) . "\n";
		}

		if (!empty($result['warning'])) {
			$log .= "\tWARNING: " . implode(' ', $result['warning']) . "\n";
		}

		if (!empty($result['removed'])) {
			foreach ($result['removed'] as $file) {
				$log .= "\tREMOVED: " . $file['realpath'] . "\n";
			}
		}

		if (!empty($result['added'])) {
			foreach ($result['added'] as $file) {
				$log .= "\tADDED: " . $elfinder->realpath($file['hash']) . "\n";
			}
		}

		if (!empty($result['changed'])) {
			foreach ($result['changed'] as $file) {
				$log .= "\tCHANGED: " . $elfinder->realpath($file['hash']) . "\n";
			}
		}

		$this->write($log);
	}

	/**
	 * Write log into file
	 *
	 * @param  string  $log  log record
	 * @return void
	 * @author Dmitry (dio) Levashov
	 **/
	protected function write($log) {
		if (($fp = @fopen($this->file, 'a'))) {
			fwrite($fp, $log . "\n");
			fclose($fp);
		}
	}
}