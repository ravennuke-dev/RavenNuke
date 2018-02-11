<?php
/**
* @category RavenNuke 3.0
* @package Core
* @subpackage elFinder
* @version $Id$
* @copyright (c) 2012 Raven Web Services, LLC
* @link http://www.ravennuke.com
* @license http://www.gnu.org/licenses/gpl.html GNU/GPL 3
*/

/**
 * Base wysiwyg class for RN implementation of editors
 *
 * This abstract class is created so it can be extended by individual editor classes so that core files do not need edited.
 */
abstract class wysiwyg {
	/**
	* Instance of wysiwyg class
	*
	* @var object
	*/
	public static $instance = NULL;

	/**
	* Instance of editor class
	*
	* @var object
	*/
	public $editor = NULL;

	/**
	* Wysiwyg editor in use
	*
	* @var string
	*/
	public static $wysiwyg;

	/**
	* Boolean variable indicating whether created editor should be printed out or returned by a function.
	*
	* @var boolean
	*/
	public static $returnOutput = false;

	/**#@+
	* Configuration values
	*
	* @var string
	*/
	public $height = '300px';
	public $lang = 'en';
	public $name = '';
	public $width = '100%';
	public $toolbar = '';
	public $value = '';
	public static $theme = '';

	/**#@+
	* File browse and upload urls
	*
	* @var string
	*/
	public $filebrowserBrowseUrl;
	public $filebrowserImageBrowseUrl;
	public $filebrowserFlashBrowseUrl;
	public $filebrowserUploadUrl;
	public $filebrowserImageUploadUrl;
	public $filebrowserFlashUploadUrl;

	/**
	* The class constructor
	*
	* Set default configuration options if passed.
	*/
	public function __construct($config = array()) {
		$this->name = isset($config['name']) ? $config['name'] : $this->name;
		$this->value = isset($config['value']) ? $config['value'] : $this->value;
		$this->width = isset($config['width']) ? $config['width'] : $this->width;
		$this->height = isset($config['height']) ? $config['height'] : $this->height;
	}

	/**
	* Set the editor height
	*
	* @param string $height
	*/
	public function setHeight($height) {
		$this->height = $height;
	}

	/**
	* Set the editor width
	*
	* @param string $width
	*/
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	* Set the toolbar configuration
	*
	* @param string $toolbar
	*/
	public function setToolbar($toolbar) {
		$this->toolbar = $toolbar;
	}

	/**
	* Set the file browser urls for the editor
	*
	* @param array $fileBrowser
	*/
	public function setBrowser($fileBrowser) {
		$this->filebrowserBrowseUrl = $fileBrowser . '?module=' . self::$wysiwyg . '&type=file';
		$this->filebrowserImageBrowseUrl = $fileBrowser . '?module=' . self::$wysiwyg . '&type=image';
		$this->filebrowserFlashBrowseUrl = $fileBrowser . '?module=' . self::$wysiwyg . '&type=flash';
	}

	/**
	* Set the file upload url for the editor
	*
	* @param array $uploader
	*/
	public function setUploader($uploader) {
		/*
		* Have to do this becuase elFinder uses DIRECTORY_SEPARATOR in some cases for it hashing.
		*/
		$hash = strtr(base64_encode(DIRECTORY_SEPARATOR), '+/=', '-_.');
		$hash = rtrim($hash, '.');
		$this->filebrowserUploadUrl = $uploader . '?cmd=upload&target=l1_' . $hash . '&type=file';
		$this->filebrowserImageUploadUrl = $uploader . '?cmd=upload&target=l2_' . $hash . '&type=image';
		$this->filebrowserFlashUploadUrl = $uploader . '?cmd=upload&target=l3_' . $hash . '&type=flash';
	}

	/**
	* Generate textarea based on class values
	*
	* @return string HTML
	*/
	public function textArea() {
		return '<textarea id="' . $this->name . '" name="' . $this->name . '" style="wrap:virtual; width: ' . $this->width . '; height: ' . $this->height . '">' . $this->value . '</textarea>';

	}

	/**
	* Generates editor
	*
	* @param string $name
	* @param string $value
	*/
	abstract function editor($name, $value);

	/**
	* Set editor language
	*
	* @param string $lang
	*/
	abstract function setLang($lang);
}

?>