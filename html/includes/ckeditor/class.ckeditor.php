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
 * Extend base wysiwyg class to implment CKEditor
 */
class rnckeditor extends wysiwyg {
	/**
	* The class constructor
	*
	* Calls parent constructor while also inlcuding ckeditor and making an instance of the editor.
	*/
	public function __construct($config) {
		parent::__construct($config);

		require_once NUKE_INCLUDE_DIR . 'ckeditor/ckeditor.php';
		$this->editor = new CKeditor('includes/ckeditor/');
		self::$theme = (self::$theme == '') ? 'v2' : self::$theme;
	}

	/**
	* Get instnace of class
	*/
	public static function getInstance($config) {
		if (!self::$instance) {
			self::$instance = new self($config);
		}
		return self::$instance;
	}

	/**
	* Display CKEditor
	*
	* This retruns the editor for display.  It also runs the setConfig() mehtod because the configuration values are set after the class is initialized.
	* This can also be used to have multiple editors with different settings.
	*
	* @param string $name
	* @param string $value
	* @return string
	*/
	public function editor($name, $value) {
		$this->name = $name;
		$this->value = $value;
		$this->setConfig();
		if (!empty($this->editor)) {
			return $this->editor->editor($this->name, $this->value);
		} else {
			return $this->textArea();
		}
	}

	/**
	* Set configuration values in editor instance.
	*/
	public function setConfig () {
		$this->editor->config['width'] = $this->width;
		$this->editor->config['height'] = $this->height;
		$this->editor->config['toolbar'] = $this->toolbar;
		$this->editor->config['filebrowserBrowseUrl'] = $this->filebrowserBrowseUrl;
		$this->editor->config['filebrowserImageBrowseUrl'] = $this->filebrowserImageBrowseUrl;
		$this->editor->config['filebrowserFlashBrowseUrl'] = $this->filebrowserFlashBrowseUrl;
		$this->editor->config['filebrowserUploadUrl'] = $this->filebrowserUploadUrl;
		$this->editor->config['filebrowserImageUploadUrl'] = $this->filebrowserImageUploadUrl;
		$this->editor->config['filebrowserFlashUploadUrl'] = $this->filebrowserFlashUploadUrl;
		$this->editor->config['skin'] = self::$theme;
		$this->editor->config['language'] = $this->lang;
		$this->editor->returnOutput = self::$returnOutput;
	}

	/**
	* Set the editor language
	*
	* @param string $lang
	*/
	public function setLang($lang) {
		$language = array(
			'af' => 'Afrikaans',
			'ar' => 'Arabic',
			'eu' => 'Basque',
			'bn' => 'Bengali/Bangla',
			'bs' => 'Bosnian',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'zh-cn' => 'Chinese Simplified',
			'zh' => 'Chinese Traditional',
			'hr' => 'Croatian',
			'cs' => 'Czech',
			'da' => 'Danish',
			'nl' => 'Dutch',
			'en' => 'English',
			'en-au' => 'English (Australia)',
			'en-ca' => 'English (Canadian)',
			'en-gb' => 'English (United Kingdom)',
			'eo' => 'Esperanto',
			'et' => 'Estonian',
			'fo' => 'Faroese',
			'fi' => 'Finnish',
			'fr' => 'French',
			'fr-ca' => 'French (Canada)',
			'gl' => 'Galician',
			'ka' => 'Georgian',
			'de' => 'German',
			'el' => 'Greek',
			'gu' => 'Gujarati',
			'he' => 'Hebrew',
			'hi' => 'Hindi',
			'hu' => 'Hungarian',
			'is' => 'Icelandic',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'km' => 'Khmer',
			'ko' => 'Korean',
			'lv' => 'Latvian',
			'lt' => 'Lithuanian',
			'ms' => 'Malay',
			'mn' => 'Mongolian',
			'no' => 'Norwegian',
			'nb' => 'Norwegian Bokmal',
			'fa' => 'Persian',
			'pl' => 'Polish',
			'pt-br' => 'Portuguese (Brazil)',
			'pt' => 'Portuguese (Portugal)',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sr' => 'Serbian (Cyrillic)',
			'sr-latn' => 'Serbian (Latin)',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'es' => 'Spanish',
			'sv' => 'Swedish',
			'th' => 'Thai',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'vi' => 'Vietnamese',
			'cy' => 'Welsh'
		);

		$langFound = array_search(mb_strtolower($lang), array_map('mb_strtolower', $language));
		if (!empty($langFound)) {
			$lang = $langFound;
		} else {
			$lang = 'en';
		}

		$this->lang = $lang;
	}
}

?>