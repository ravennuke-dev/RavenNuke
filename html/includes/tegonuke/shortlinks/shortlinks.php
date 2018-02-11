<?php
/**
 * TegoNuke(tm) ShortLinks: Main script to shorten URLs (Links)
 *
 * This script has the main functions that are called from header.php,
 * footer.php and mainfile.php to "tap" the main module and block links.
 *
 * config.php or rnconfig.php (RavenNuke) holds the "switches" to control
 *   the function behavior.
 * mainfile.php is where the script is included from as well as where the
 *   block taps are called from (the GTB files).
 * header.php is where tnsl_fPageTapStart() function is called from to set
 *   up the output bufferring as well as which module is being "tapped".
 * footer.php is where the tnsl_fPageTapFinish() function is called to
 *   read the bufferred output and shorten the links.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @package     TegoNuke(tm)
 * @subpackage  ShortLinks
 * @category    SEO
 * @category    Usability
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.3.1_398
 * @link        http://montegoscripts.com
 * @tutorial    http://wiki.montegoscripts.com
*/
/**
 * GT-NExtGEn 0.5 by Bill Murrin (Audioslaved) http:// gt.audioslaved.com (c) 2004
 * Original Nukecops GoogleTap done by NukeCops (http:// www.nukecops.com)
 */

if (!defined('TNSL_USE_SHORTLINKS')) {
	die('Access Denied');
}
/*
 * Configuration settings for ShortLinks
 */

$tnsl_sGTFileDir = 'ShortLinks';    // Name of Directory for GoogleTap Files. Should be located in root path with mainfile.php.
$tnsl_asGTFileExclude = array(      // This array is only used while in debug mode if you don't want the admin to be bothered with the "untapped" notices below the footer
	'Resend_Email',                 // This module should only be active for Administrators, so tapping it is unnecessary
	'NukeSentinel',                 // One could tap this, but what is the point?  Should probably only be available to admins anyways
	'UserInfoAddons',               // This module should only be active for Administrators, so tapping it is unnecessary
	'block-Sentinel_Center.php',    // Has no links, so why attempt to tap
	'block-Sentinel_Scrolling.php', // Has no links, so why attempt to tap
	'block-Sentinel_Side.php'       // Has no links, so why attempt to tap, etc...
);
/*
 * End of Configuration Options
 */

$tnsl_asGTFilePath = array(); // <-- Do NOT Touch!
$tnsl_asNoGTFile = array(); // <-- Do NOT Touch!
define('TNSL_DEBUG', ((isset($admin) && is_admin($admin)) && isset($tnsl_bDebugShortLinks) && $tnsl_bDebugShortLinks) ? true : false); // <-- Do NOT Touch!

/**
 * Function: tnsl_fPageTapStart
 *
 * Initiates the page tap for bufferring the output
 *
 * @return array of GT file paths if any
 */
function tnsl_fPageTapStart() {
	global $prefix, $db, $admin, $tnsl_sGTFileDir, $tnsl_bAutoTapLinks, $tnsl_asNoGTFile;
	/*
	 * GT-NExtGEn 0.5 by Bill Murrin (Audioslaved) http:// gt.audioslaved.com (c) 2004
	 * GT-NExtGEn Header Code --- nextGenHead Variable
	 * Modified by montego from http:// montegoscripts.com for RavenNuke(tm) and TegoNuke(tm) ShortLinks
	 */
	$asGTFilePath = array();
	$sGTFilePath = '';
	if (TNSL_DEBUG) {
		echo '[ShortLinks_Function] = Present In Header<br />';
	}
	if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
		$nextGenName = htmlentities(stripslashes($_REQUEST['name']));
		if (TNSL_DEBUG) {
			echo '[ShortLinks_ModuleName] = ' . $nextGenName . '<br />';
		}
	} else {
		$sql = 'SELECT main_module FROM ' . $prefix . '_main';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$mainmod_name = $row['main_module'];
		$nextGenName = $mainmod_name;
		if (TNSL_DEBUG) {
			echo '[ShortLinks_ModuleName] = ' . $nextGenName . ' (Main Module)<br />';
		}
	}
	/*
	 * GT-NExtGEn Files Path --- nextGenPath Variable
	 * Modified by montego from http:// montegoscripts.com for RavenNuke(tm) and TegoNuke(tm) ShortLinks
	 */
	$sGTFilePath = $tnsl_sGTFileDir . '/GT-' . $nextGenName . '.php';
	if (@file_exists($sGTFilePath)) {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_FilePath] = GT File :: ' . $sGTFilePath . ' :: Does Exist<br />';
		}
		ob_start();
		array_push($asGTFilePath, $sGTFilePath);
		define('TNSL_BUFFERED', TRUE);
	} else {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_FilePath] = GT File :: ' . $sGTFilePath . ' :: Does Not Exist!<br />';
		}
		$tnsl_asNoGTFile[] = $sGTFilePath;
	}
	/*
	 * Check for PageLevel tap file
	 */
	$sGTFilePath = $tnsl_sGTFileDir . '/GTZ-PageTap.php';
	if (@file_exists($sGTFilePath)) {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_FilePath] = GT File :: ' . $sGTFilePath . ' :: Does Exist<br />';
		}
		if (!defined('TNSL_BUFFERED')) { // Only buffer the output if it has not already been done
			ob_start();
			define('TNSL_BUFFERED', TRUE);
		}
		array_push($asGTFilePath, $sGTFilePath);
	} else {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_FilePath] = GT File :: ' . $sGTFilePath . ' :: Does Not Exist!<br />';
		}
		$tnsl_asNoGTFile[] = $sGTFilePath;
	}
	/*
	 * If none of the above produces a tap, need to check if debug is on AND if tnsl_bAutoTapLinks is TRUE
	 */
	if (!defined('TNSL_BUFFERED') && TNSL_DEBUG && isset($tnsl_bAutoTapLinks) && $tnsl_bAutoTapLinks) {
		ob_start();
		define('TNSL_BUFFERED', TRUE);
	}
	return $asGTFilePath;
}

/**
 * Function: tnsl_fPageTapFinish
 *
 * Completes the page tap by taking the bufferred output and running through
 * the various ShortLinks files (GT-<<module name>>.php).
 *
 * @return void does not return anything, but does output the final HTML
 */
function tnsl_fPageTapFinish() {
	global $tnsl_bAutoTapLinks, $tnsl_sGTFileDir, $tnsl_asGTFileExclude, $tnsl_asNoGTFile;
	$asGTFilePathTmp = $GLOBALS['tnsl_asGTFilePath'];
	if (defined('TNSL_BUFFERED')) {
		$nextGenContent = ob_get_contents();
		tnsl_fCleanLinks($nextGenContent);
		ob_clean();
	} else {
		return;
	}
	/*
	 * GT-NExtGEn Footer Code --- nextGenFoot Variable
	 * Modified by montego from http:// montegoscripts.com for RavenNuke(tm) and TegoNuke(tm) ShortLinks
	 */
	if (TNSL_DEBUG) {
		echo '<br />[ShortLinks_Function] = Present In Footer<br />';
	}
	/*
	 * GT-NExtGEn Block Code --- nextGenBlock Variable
	 * Modified by montego from http:// montegoscripts.com for RavenNuke(tm) and TegoNuke(tm) ShortLinks
	 * I moved this code out of the blocks, since I already have GTB tap file feature there.  This, if enabled,
	 * will inspect ALL other non-tapped modules.php type links and either attempt to find a GT file to use,
	 * or report back any remaining un-tapped links to the admin if in debug mode.
	 */
	if (isset($tnsl_bAutoTapLinks) && $tnsl_bAutoTapLinks) {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_Function] = Present in AutoTap Links Code<br />';
		}
		if (preg_match_all('(\b[name]{4}=[a-zA-Z0-9_-]+)', $nextGenContent, $asGotGenMatches)) { // Had links to modules
			$sGTFilePath = '';
			$asNoGTFile = array();
			$asNewGotGenMatches = array_unique($asGotGenMatches[0]);
			foreach($asNewGotGenMatches as $newGenMatch) {
				$expGenMatch = explode('=', $newGenMatch);
				$sGTFilePath = $tnsl_sGTFileDir . '/GT-' . $expGenMatch[1] . '.php';
				if (TNSL_DEBUG) {
					echo '[ShortLinks_TapLinks] = Found Links For Module: ' . $expGenMatch[1] . '<br />';
				}
				if (file_exists($sGTFilePath)) {
					array_push($asGTFilePathTmp, $sGTFilePath);
				} else {
					$tnsl_asNoGTFile[] = $sGTFilePath;
				}
				unset($expGenMatch);
			}
		}
	}
	/*
	 * Taps are needed, so run through the ShortLinks GT files
	 */
	if (count($asGTFilePathTmp) > 0) {
		$asGTFilePath = array_unique($asGTFilePathTmp);
		foreach($asGTFilePath as $sGTFilePath) {
			if ($sGTFilePath != '') {
				if (TNSL_DEBUG) {
					echo '[ShortLinks_PerformTap] = Using GT File :: ' . $sGTFilePath . '<br />';
				}
				unset($urlin, $urlout);
				include($sGTFilePath);
				$nextGenContent = preg_replace($urlin, $urlout, $nextGenContent);
			} else {
				if (TNSL_DEBUG) {
					echo '[ShortLinks_PerformTap] = GT File :: ' . $sGTFilePath . ' :: Does Not Exist!<br />';
				}
			}
		}
	}
	/*
	 * If there are still untapped links, if in debug mode, show the admin what modules are left which need GT/GTB files:
	 */
	if (TNSL_DEBUG && count($tnsl_asNoGTFile) > 0) {
		foreach($tnsl_asNoGTFile as $sNoGTFile) {
			if (!in_array($sNoGTFile, $tnsl_asGTFileExclude)) {
				echo '[ShortLinks_UnShortenedLinks] = Consider creating GT/GTB File(s) :: ' . $sNoGTFile . '<br />';
			}
		}
	}
	$sFinishUpContent = ob_get_contents();
	ob_end_clean();
	// meotoo fix: this preg_replace needed to properly handle QSA and/or avoid certain 404's..
	echo preg_replace('#(?!(href|action|src|disqus_url)\=[\'"]?[^>]+?)\.html&amp;#i','.html?',$nextGenContent);
	echo $sFinishUpContent;
	unset($nextGenContent);   // Not really necessary, but why not
	unset($sFinishUpContent); // Not really necessary, but why not
	return;
}

/**
 * Function: tnsl_fShortenBlockURLs
 *
 * Takes the $content from an individual block (called from mainfile.php) and
 * shortens the links using its corresponing GTB-<<block file name>>.php if one exists.
 *
 * @param  string $sBlockfile is the name of the block file that is needing to be "tapped"
 * @param  string $sContents is the block HTML contents to have links shortened
 * @return string the contents of the block with links shortened
 */
function tnsl_fShortenBlockURLs($sBlockfile = '', $sContents = '') {
	global $tnsl_sGTFileDir, $tnsl_asGTFileExclude, $tnsl_asNoGTFile;
	if (!in_array($sBlockfile, $tnsl_asGTFileExclude)) {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_Function] = Present In Block<br />';
		}
		if ($sBlockfile != '') {
			$sGTBlockPath = $tnsl_sGTFileDir . '/GTB-' . $sBlockfile;
			if (@file_exists($sGTBlockPath)) { // Block has been "Tapped"
				if (TNSL_DEBUG) {
					echo '[ShortLinks_FilePath] = GTB File Exists for :: ' . $sBlockfile . '<br />';
				}
				tnsl_fCleanLinks($sContents);
				unset($urlin, $urlout);
				include_once($sGTBlockPath);
				$sContents = preg_replace($urlin, $urlout, $sContents);
			} else {
				if (TNSL_DEBUG) {
					echo '[ShortLinks_FilePath] = GTB File Does NOT Exist for :: ' . $sBlockfile . '<br />';
					$tnsl_asNoGTFile[] = $sGTBlockPath;
				}
			}
		} else {
			if (TNSL_DEBUG) {
				echo '[ShortLinks_Function] = In HTML Block<br />';
			}
		}
	}
	return $sContents;
}
/**
 * Function: tnsl_fCleanLinks
 *
 * In order to find the necessary link patterns, ALL URLs must have a consistent usage
 * of the "&", namely "&amp;".
 *
 * NOTE: ShortLinks is not UTF-8 certified.  If you change the preg_replace function below to use the multi-byte feature of RegEx
 * you will have to also not pass the input string by reference (i.e., remove the "&" in front of the $&getNextGen in the function
 * input parameters).
 *
 * @param string &$getNextGen is passed by reference for speed.  This is for the string of HTML coming into the function.
 * @return void the return is the variable passed by reference
 *
 * @author      MeoToo with the original "stub" approach using preg_replace with the 'e' option
 * @author......Palbin with a revised (simplified) approach
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com> with a revised approach using preg_replace_callback as was uncomfortable
 *                 with the security profile of the "e" option (it eval()'s the string which could open up a security issue).  Also decided to
 *                 do a little quote cleansing...
 */
function tnsl_fCleanLinks(&$getNextGen) {
	$getNextGen = preg_replace_callback('#(href|action|src|disqus_url)(\s*=\s*[\'"])([a-zA-Z0-9/&;:=\#\?\._-]*)(["\'])#i', 'tnsl_fCleanLinksStub', $getNextGen);
	return;
}
/**
 * Function: tnsl_fCleanLinksStub
 *
 * This is a call-back function used in a preg_replace_callback() function call from tnsl_fCleanLinks().
 * This is the function which actually does the "cleansing" while the calling preg_replace() is ensuring
 * replacement occurs only with valid src, href, and action "links".
 *
 * @param array $matches will be the array of matches that we will formulate a cleansed link from
 *
 * @author      MeoToo with the original "stub" approach using preg_replace with the 'e' option.
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com> with a revised approach
 */
function tnsl_fCleanLinksStub($matches) {
	$link = $matches[3];
	if (strpos($link, '&') !== false) {
		if (TNSL_DEBUG) {
			echo '[ShortLinks_CleanLink] = Found Link to Clean (Before) :: ' . htmlspecialchars($link, ENT_QUOTES, _CHARSET) . '<br />';
		}
		$link = str_replace(array('&#','&amp;','&','<<#>>'), array('<<#>>','&','&amp;','&#'), $link);
		if (TNSL_DEBUG) {
			echo '[ShortLinks_CleanLink] = Found Link to Clean (After) &nbsp;&nbsp;:: ' . htmlspecialchars($link, ENT_QUOTES, _CHARSET) . '<br />';
		}
	}
	return $matches[1] . $matches[2] . $link . $matches[4];
}

