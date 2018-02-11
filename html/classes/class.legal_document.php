<?php

/**
 * RavenNuke(tm) Legal Document: Used to Retrieve a Legal Document for Viewing / Editing.
 *
 * This script was created for the re-write of the Legal module for RavenNuke(tm) only.
 * This script can be used within other modules to retrieve any given Legal Document and
 * its Title and Body Text for the provided language.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/**
 * Define key constants and variables for the entire package
 */
if (!defined('LGL_MID_DOC')) define('LGL_MID_DOC', 1);
if (!defined('LGL_MID_TYPE')) define('LGL_MID_TYPE', 2);
if (!defined('LGL_STYLE_DOC')) define('LGL_STYLE_DOC', 'style="padding:4px;width:100%;"');
if (!isset($lgl_lang['LGL_COM_CONTACTMENU'])) {
	global $currentlang, $language;
	$lgl_modPath = 'modules/Legal/';
	$lgl_langS = 'english';
	if (file_exists($lgl_modPath . 'language/lang-' . $currentlang . '.php')) {
		include_once $lgl_modPath . 'language/lang-' . $currentlang . '.php';
		$lgl_langS = $currentlang;
	} elseif (file_exists($lgl_modPath . 'language/lang-' . $language . '.php')) {
		include_once $lgl_modPath . 'language/lang-' . $language . '.php';
		$lgl_langS = $language;
	} elseif (file_exists($lgl_modPath . 'language/lang-english.php')) { // Default module lang
		include_once $lgl_modPath . 'language/lang-english.php';
	}
}
/**
 * Legal Document
 */
class Legal_Document
{
	/**
	 * Main storage for Legal Document data
	 *
	 * @var array
	 */
	var $doc = array(
				'did' => 0,
				'tid_title' => 0,
				'tid_text' => 0,
				'name' => '',
				'status' => '',
				'lang' => '',
				'title' => '',
				'text' => ''
				);
	/**
	 * Various variables needed for normal operations - yes, I am lazy
	 *
	 * @var mixed
	 */
	var $modName = 'Legal';
	var $modFrom = 'Legal';
	var $docCountry = 'The United States of America';
	var $checkActive = true;
	var $haveTxt = false;
	var $inAdmin = false;
	/**
	 * Class constructor
	 *
	 * @param  string  $srcModule is the Module name this object request is for in case its needed for a return link
	 */
	function __construct($srcModule='')
	{
		if (!empty($srcModule)) $this->modFrom = $srcModule;
		if (defined('ADMIN_FILE')) $this->inAdmin = true;
	}

	/**
	 * Retrieves the requested Legal Document data from the database
	 *
	 * @global string  $prefix is the table prefix set in config.php
	 * @global integer $db is the object handle for the SQL layer class
	 * @global string  $sitename is the site name from the site Preferences
	 * @global string  $language is the site preferred language
	 * @global string  $lgl_langS is the actual loaded language (if come from module)
	 * @global array   $lgl_cfg is the Legal Documents module array of configuration values
	 * @param  string|integer $doc is either the document name (type) or `did`
	 * @param  string  $lang is the specific translation we are after
	 */
	function dbGetDocument($doc='', $lang='')
	{
		global $prefix, $db, $sitename, $language, $lgl_langS, $lgl_cfg;
		/*
		 * Determine if passed a `did` or a `doc_name` value
		 */
		if (empty($doc)) return false; // No sense continuing if there is no `did` or `doc_name` passed in
		if (ctype_digit("$doc")) {
			$this->doc['did'] = intval($doc);
			$docSQL = 'a.`did` = \'' . $this->doc['did'] . '\'';
		} else {
			$this->doc['name'] = $doc;
			$docSQL = '`doc_name` = \'' . addslashes($doc) . '\'';
		}
		/*
		 * Determine the language to use - default should be the site preferred
		 */
		if (empty($lang)) {
			if (isset($lgl_langS) && !empty($lgl_langS)) {
				$this->doc['lang'] = $lgl_langS;
			} else {
				$this->doc['lang'] = $language;
			}
		} else {
			$this->doc['lang'] = $lang;
		}
		/*
		 * Determine if need to get the module configuration data, namely the
		 * country field.
		 */
		if (!isset($lgl_cfg)) {
			if (list($country) = $db->sql_fetchrow($db->sql_query('SELECT `country` FROM `' . $prefix . '_legal_cfg`'))) {
				$this->docCountry = $country;
			}
		} else {
			$this->docCountry = $lgl_cfg['country'];
		}
		$sqlBase = 'SELECT a.`did` AS doc_id, `doc_name`, `doc_status`, c.`doc_text` AS doc_text, '
			. 'c.`tid` AS tid_text, e.`doc_text` AS doc_title, e.`tid` AS tid_title FROM `'
			. $prefix . '_legal_docs` a, `'
			. $prefix . '_legal_text_map` b, `'
			. $prefix.'_legal_text` c, `'
			. $prefix . '_legal_text_map` d, `'
			. $prefix.'_legal_text` e '
			. 'WHERE a.`did` = b.`did` AND b.`tid` = c.`tid` AND b.`mid` = '
			. LGL_MID_DOC . ' AND a.`did` = d.`did` AND d.`tid` = e.`tid` AND d.`mid` = '
			. LGL_MID_TYPE;
		if ($this->checkActive) {
			$sqlBase .= ' AND `doc_status` = \'1\'';
		}
		/*
		 * Get the document text from the database and store it for later use.  Return `true` if successful,
		 * `false` if have too many records (as would point to a data integrity issue).  If this query does not
		 * produce the intended results, then most likely no translation has been created and so we just go get
		 * the default english document.
		 */
		$getAttempts = 0;
		while ($getAttempts < 2) {
			$dbNumRows = 0;
			if ($getAttempts == 0) {
				$sql = $sqlBase . ' AND b.`language` = \'' . addslashes($this->doc['lang']) . '\''
					. ' AND d.`language` = \'' . addslashes($this->doc['lang']) . '\''
					. ' AND ' . $docSQL;
				++$getAttempts;
			} else {
				$sql = $sqlBase . ' AND b.`language` = \'english\''
					. ' AND d.`language` = \'english\''
					. ' AND ' . $docSQL;
				++$getAttempts;
			}
			if ($result = $db->sql_query($sql)) {
				$dbNumRows = $db->sql_numrows($result);
				if ($dbNumRows > 1) return false;  // Had too many rows (i.e., more than 1) - definitely a db integrity issue
				if ($dbNumRows == 1) {
					$row = $db->sql_fetchrow($result);
					$this->doc['did'] = intval($row['doc_id']);
					$this->doc['tid_text'] = intval($row['tid_text']);
					$this->doc['tid_title'] = intval($row['tid_title']);
					$this->doc['name'] = $row['doc_name'];
					$this->doc['status'] = (int)$row['doc_status'];
					$this->doc['title'] = $row['doc_title'];
					$this->doc['text'] = $row['doc_text'];
					$this->haveTxt = true;
					return true;
				}
				if ($this->inAdmin) break;
			}
		}
		/*
		 * Ok, so the above did not work, so let us just get the root document information data.
		 */
		$sql = 'SELECT a.`did` AS doc_id, `doc_name`, `doc_status` FROM `' . $prefix . '_legal_docs` a WHERE ' . $docSQL;
		if (!$result = $db->sql_query($sql)) return false; // Document does not exist at all so definitely something is up
		if ($db->sql_numrows($result) != 1) return false;  // Had either no row or too many (i.e., more than 1)
		$row = $db->sql_fetchrow($result);
		$this->doc['did'] = intval($row['doc_id']);
		$this->doc['name'] = $row['doc_name'];
		$this->doc['status'] = (int)$row['doc_status'];
		return true;
	}

	/**
	 * Returns the HTML for the body text for the requested Legal Document
	 *
	 * @global string $sitename is the site name from the site Preferences
	 * @global string $lgl_langS is the actual loaded language (if come from module)
	 * @global array  $lgl_cfg is the Legal Documents module array of configuration values
	 * @global array  $lgl_lang is the language array for this module
	 */
	function html()
	{
		global $sitename, $lgl_langS, $lgl_cfg, $lgl_lang;
		/*
		 * Get the date string to use
		 */
		$today = getdate();
		$month = $today['mon'];
		if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
		$year = $today['year'];
		$dateS = $month . ' ' . $year;
		/*
		 * Make any necessary tag replacements
		 */
		$docText = $this->doc['text'];
		$docText = str_ireplace('[sitename]', $sitename, $docText);
		$docText = str_ireplace('[country]', $this->docCountry, $docText);
		$docText = str_ireplace('[date]', $dateS, $docText);
		if (empty($docText)) $docText = $lgl_lang['LGL_ERRDB_TRANSNOTFOUND'];
		$s = '';
		$s .= '<div><table ' . LGL_STYLE_DOC . '><tr><td>' . $docText . '</td></tr></table></div>';
		return $s;
	}

	/**
	 * Checks to see if had a text translation or not
	 */
	function checkText()
	{
		return $this->haveTxt;
	}

	/**
	 * Sets object state to not consider the status of the document
	 */
	function setNoStatus()
	{
		$this->checkActive = false;
	}

	/**
	 * Gets the Document data as an array
	 *
	 * @return array
	 */
	function getDocData()
	{
		return $this->doc;
	}

	/**
	 * Gets the Document Name (type)
	 *
	 * @return string
	 */
	function getDocName()
	{
		return $this->doc['name'];
	}

	/**
	 * Gets the Document Body Text
	 *
	 * @return string
	 */
	function getDocText()
	{
		return $this->doc['text'];
	}

	/**
	 * Gets the Document Title Text
	 *
	 * @return string
	 */
	function getDocTitle()
	{
		return $this->doc['title'];
	}

	/**
	 * Gets the Document Status
	 *
	 * @return integer
	 */
	function getDocStatus()
	{
		return $this->doc['status'];
	}

	/**
	 * Gets the Document language that was used to retrieve the data
	 *
	 * @return string
	 */
	function getDocLang()
	{
		return $this->doc['lang'];
	}

	/**
	 * Gets the Document Field Text (any)
	 *
	 * @param  string $s is the name of the index to retrieve
	 * @return string|integer
	 */
	function getDocField($s)
	{
		return $this->doc[$s];
	}

}

?>
