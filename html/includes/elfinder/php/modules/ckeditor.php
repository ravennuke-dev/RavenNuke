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
* ckEditor module for elFinder
*
* If you are developing a module add-on for elFinder this file can be used as a template.
* Everything here is required other than the references to logging and the upload function.
* The upload function is only needed if you want a quick upload feature similar to CKEditor that is outside of elFinder.
* For example if you wanted to add elFinder to the downloads module you would copy this file can name it download.php, any name will work, and
* put it in "./includes/elfinder/php/modules/".  You would then access elFinder with the following URL noting the MODULE name.
* http://localhost/RN25/includes/elfinder/elfinder.php?module=ckeditor
* Of course you need to edit the $opts configuration array or what is the point!
*/

require dirname(__FILE__) . '/../connector.php';

/**
 * Modules level elfinder class
 *
 * This is the default modules level class used for CKEditor
 */
class elFinderMain extends elfinderBase {
	/**
	* Log file name to log uploads etc
	*
	* @var string
	*/
	protected $log = '../../../../rnlogs/elFinder_CK_log';

	/**
	* Configuration settings
	*
	* @var array
	*/
	protected $opts = array(
				/*
				* The log binding must be done in the __construct() below
				*/
				//'bind' => array(
				//	'mkdir mkfile rename duplicate upload rm paste' => array('', 'log'),
				//),
				'debug' => false,
				'roots' => array(
					array(
						'driver' => 'LocalFileSystem',
						'path' => '../../../../uploads/file/',
						'startPath' => '',
						'URL' => '../../uploads/file/',
						'mimeDetect' => 'internal',
						//'mimefile' => '',
						'copyTo' => true,
						'tmbPath' => '.tmb',
						'copyOverwrite' => false,
						'uploadOverwrite' => true,
						'uploadAllow' => array('application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/x-bzip', 'application/x-bzip-compressed-tar', 'application/x-compressed-tar', 'application/x-gzip', 'application/x-rar', 'application/zip zip', 'application/x-7z-compressed', 'text/enriched', 'text/plain', 'text/rdf', 'text/x-comma-separated-values', 'text/x-log', 'text/x-readme', 'text/xml', 'application/x-shockwave-flash', 'application/flash-video', 'application/pdf', 'audio/mpeg', 'audio/x-aiff', 'audio/x-mp3-playlist', 'audio/x-mpeg', 'audio/x-pn-realaudio', 'audio/x-wav', 'image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/tiff', 'image/x-psd', 'video/mpeg', 'video/quicktime', 'video/vnd.rn-realvideo', 'video/x-avi', 'video/x-ms-asf', 'video/x-ms-wmv', 'video/x-msvideo avi', 'video/x-sgi-movie'),
						'uploadDeny' => array(),
						'uploadOrder' => 'deny,allow',
						'dateFormat' => 'j M Y H:i',
						'timeFormat' => 'H:i',
						'disabled' => array(),
						'tmbBgColor' => 'transparent',
						'accessControl' => 'access',
						'attributes' => array(
							//Lets hide script files and the thumb name directory
							array(
								'pattern' => '~/\.|.tmb|.html|.php|.php4|.php5|.asp|.js|.cgi~',
								'read' => false,
								'write' => false,
								'hidden' => true,
								'locked' => false
							),
						),
						'defaults' => array(
							'read' => true,
							'write' => true,
							'locked' => false,
							'hidden' => false
						),
					),
					array(
						'driver' => 'LocalFileSystem',
						'path' => '../../../../uploads/image/',
						'startPath' => '',
						'URL' => '../../uploads/image/',
						'mimeDetect' => 'internal',
						//'mimefile' => '',
						'copyTo' => false,
						'tmbPath' => '.tmb',
						'copyOverwrite' => false,
						'uploadOverwrite' => true,
						'uploadAllow' => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/tiff', 'image/x-psd'),
						'uploadDeny' => array(),
						'uploadOrder' => 'deny,allow',
						'dateFormat' => 'j M Y H:i',
						'timeFormat' => 'H:i',
						'disabled' => array(),
						'tmbBgColor' => 'transparent',
						'accessControl' => 'access',
						'attributes' => array(
							//Lets hide script files and the thumb name directory
							array(
								'pattern' => '~/\.|.tmb|.html|.php|.php4|.php5|.asp|.js|.cgi~',
								'read' => false,
								'write' => false,
								'hidden' => true,
								'locked' => false
							),
						),
						'defaults' => array(
							'read' => true,
							'write' => true,
							'locked' => false,
							'hidden' => false
						),
					),
					array(
						'driver' => 'LocalFileSystem',
						'path' => '../../../../uploads/flash/',
						'startPath' => '',
						'URL' => '../../uploads/flash/',
						'mimeDetect' => 'internal',
						//'mimefile' => '',
						'copyTo' => false,
						'tmbPath' => '.tmb',
						'copyOverwrite' => false,
						'uploadOverwrite' => true,
						'uploadAllow' => array('application/x-shockwave-flash', 'application/flash-video'),
						'uploadDeny' => array(),
						'uploadOrder' => 'deny,allow',
						'dateFormat' => 'j M Y H:i',
						'timeFormat' => 'H:i',
						'disabled' => array(),
						'tmbBgColor' => 'transparent',
						'accessControl' => 'access',
						'attributes' => array(
							//Lets hide script files and the thumb name directory
							array(
								'pattern' => '~/\.|.tmb|.html|.php|.php4|.php5|.asp|.js|.cgi~',
								'read' => false,
								'write' => false,
								'hidden' => true,
								'locked' => false
							),
						),
						'defaults' => array(
							'read' => true,
							'write' => true,
							'locked' => false,
							'hidden' => false
						),
					),
					array(
						'driver' => 'LocalFileSystem',
						'path' => '../../../../uploads/media/',
						'startPath' => '',
						'URL' => '../../uploads/media/',
						'mimeDetect' => 'internal',
						//'mimefile' => '',
						'copyTo' => false,
						'tmbPath' => '.tmb',
						'copyOverwrite' => false,
						'uploadOverwrite' => true,
						'uploadAllow' => array('application/x-shockwave-flash', 'application/flash-video', 'application/pdf', 'audio/mpeg', 'audio/x-aiff', 'audio/x-mp3-playlist', 'audio/x-mpeg', 'audio/x-pn-realaudio', 'audio/x-wav', 'image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/tiff', 'image/x-psd', 'video/mpeg', 'video/quicktime', 'video/vnd.rn-realvideo', 'video/x-avi', 'video/x-ms-asf', 'video/x-ms-wmv', 'video/x-msvideo avi', 'video/x-sgi-movie'),
						'uploadDeny' => array(),
						'uploadOrder' => 'deny,allow',
						'dateFormat' => 'j M Y H:i',
						'timeFormat' => 'H:i',
						'disabled' => array(),
						'tmbBgColor' => 'transparent',
						'accessControl' => 'access',
						'attributes' => array(
							//Lets hide script files and the thumb name directory
							array(
								'pattern' => '~/\.|.tmb|.html|.php|.php4|.php5|.asp|.js|.cgi~',
								'read' => false,
								'write' => false,
								'hidden' => true,
								'locked' => false
							),
						),
						'defaults' => array(
							'read' => true,
							'write' => true,
							'locked' => false,
							'hidden' => false
						),
					)
				)
			);

	/**
	* The class constructor
	*
	* Setsup the logger and calls parent constructor.
	*/
	public function __construct() {
		// If you do not want logging comment out these two lines
		$this->logger = new elFinderSimpleLogger($this->log);
		$this->opts['bind'] = array('mkdir mkfile rename duplicate upload rm paste' => array($this->logger, 'log'));
		parent::__construct();
	}

	/**
	* Upload function
	*
	* This function only parses the data from the parent class upload function.  The returned HTML is specific to CKEditor.
	* If you are developing a new "module" for elFinder this function is not required unless you want a quick upload feature separate from elFinder.
	*/
	function upload() {
		$type = (isset($_GET['type'])) ? $_GET['type'] : '';
		$data = parent::upload();
		$url = (!empty($data['filename'])) ? 'uploads/' . $type . '/' . $data['filename'] : '';
		$message = (!empty($data['message'])) ? $message : '';
		echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("2", "' . $url . '", "' . $message . '");</script>';
	}
}

/*
* Lets start everything in motion.
*/
$elfinder = new elFinderMain();

?>