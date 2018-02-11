<?php
// ==================================================================
//  Author: Ted Kappes (pesoto74@soltec.net)
//	Web: 	http://tkap.org/paginator/
//	Name: 	Paginator_html
// 	Desc: 	Class extension for Paginator. Adds pre-made link sets.
//
// 7/21/2003
//
//  Please send me a mail telling me what you think of Paginator
//  and what your using it for. [ pesoto74@soltec.net]
//
// ==================================================================
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/**
 * RavenNuke(tm) Paginator: Extends the Paginator class to produce the HTML
 *
 * This script came from the NukeEvo basic distribution as identified above
 * and was adapted / modified heavily for the RavenNuke(tm) distribution.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE.txt file)
 *
 * @package     RavenNuke(tm)
 * @subpackage  Paginator
 * @category    Usability
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 by RavenPHPScripts and Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.ravenphpscripts.com and http://montegoscripts.com
 * @since       2.20.00
 * @uses        Since this was developed specifically for RavenNuke(tm),
 *              the following additional language defines must be included
 *              within the respective lang-******.php files under the
 *              root/languages directory:  _PAGINATOR_PAGE, _PAGINATOR_TOTALITEMS,
 *              _PAGINATOR_GO, _PAGINATOR_GOTOPAGE, _PAGINATOR_GOTONEXT, _PAGINATOR_GOTOPREV,
 *              _PAGINATOR_GOTOFIRST, and _PAGINATOR_GOTOLAST.
 *              It also uses _OF but that define should already be there.
*/
class Paginator_html extends Paginator {
	/**
	 * Properties used within this class extension.
	 */
	var $sLink;           // @var string  The base URI to use for the links, e.g., 'modules.php?name=News&amp;new_topic=0'
	var $bShowPageOf;     // @var bool    Switch Page # of ## ON/OFF.  Default is ON (true).
	var $bShowTotalItems; // @var bool    Switch (NN total items) ON/OFF.  Default is ON (true).
	var $bShowJumpTo;     // @var bool    Switch Jump to Page ON/OFF.  Default is ON (true).
	var $iJumpType;       // @var integer The method of doing a "Jump To Page".  Default is 0.  See comments for setJumpType() for value descriptions.
	var $bNoFollow;       // @var bool    Switch SE "NO FOLLOW" attributes ON/OFF.  Default is OFF (false).
	var $sQSPage;         // @var string  The Query String parameter to use.  Default is 'pagenum'.
	var $sTotalItems;     // @var string  The text to display for Total Items.  Default is 'total items'.
	/**
	 * Function: setDefaults
	 *
	 * Should be called up front to at least ensure defaults are set.
	 *
	 * @return void  Only sets internal variables
	 */
	function setDefaults($aCfgVals=array()) {
		$this->sLink = '';
		if (isset($aCfgVals['bShowPageOf'])) $this->setShowPageOf($aCfgVals['bShowPageOf']); else $this->setShowPageOf();
		if (isset($aCfgVals['bShowTotalItems'])) $this->setShowTotalItems($aCfgVals['bShowTotalItems']); else $this->setShowTotalItems();
		if (isset($aCfgVals['bShowJumpTo'])) $this->setShowJumpTo($aCfgVals['bShowJumpTo']); else $this->setShowJumpTo();
		if (isset($aCfgVals['iJumpType'])) $this->setJumpType($aCfgVals['iJumpType']); else $this->setJumpType();
		if (isset($aCfgVals['bNoFollow'])) $this->setNoFollow($aCfgVals['bNoFollow']); else $this->setNoFollow();
		if (isset($aCfgVals['sQSPage'])) $this->setQSPage($aCfgVals['sQSPage']); else $this->setQSPage();
		if (isset($aCfgVals['sTotalItems'])) $this->setTotalItems($aCfgVals['sTotalItems']); else $this->setTotalItems();
	}
	/**
	 * Function: getPagerHTML
	 *
	 * Generates the HTML for the paging based upon the options set previously.
	 * There is only one layout option at this time for this class and with all
	 * options set it loks like this:
	 *
	 * Page 1 of 4 [ << | < | 1 2 3 4 5 | > | >> ] ________ Jump
	 *
	 * The "Page 1 of 4" can be toggled ON/OFF.
	 * The "________ Jump" can be toggle ON/OFF.
	 *
	 * @return string  A string of HTML to display back on the page
	 */
	function getPagerHTML() {
		$sHTML = '<br /><div align="center"><form action="' . $this->sLink. '" method="post">';
		/*
		 * Set up the base anchor tag based on NoFollow setting
		 */
		if ($this->bNoFollow) {
			$sAnchorStart = '<a rel="nofollow" href="' . $this->sLink . '&amp;' . $this->sQSPage . '=';
		} else {
			$sAnchorStart = '<a href="' . $this->sLink . '&amp;' . $this->sQSPage . '=';
		}
		/*
		 * Show the "Page n of NN" if turned ON
		 */
		if ($this->bShowPageOf) {
			$sHTML .= _PAGINATOR_PAGE . ' ' . $this->getCurrent() . ' ' . _OF . ' ' . $this->getTotalPages() . ' ';
		}
		/*
		 * Show the "(NN total items)" if turned ON
		 */
		if ($this->bShowTotalItems) {
			$sHTML .= '(' . $this->getTotalItems() . ' ' . $this->sTotalItems . ') ';
		}
		$sHTML .= '[';
		/*
		 * If we are not on page 1, show the First link
		 */
		if ($this->getCurrent() > 1) {
			$sHTML .= ' ' . $sAnchorStart . $this->getFirst() . '" title="' . _PAGINATOR_GOTOFIRST . '">&lt;&lt;</a> |';
		}
		/*
		 * If we are not on page 1, show the Previous link
		 */
		if ($this->getPrevious()) {
			$sHTML .= ' ' . $sAnchorStart . $this->getPrevious() . '" title="' . _PAGINATOR_GOTOPREV . '">&lt;</a> |';
		}
		/*
		 * Display the page numbers, and if not the current page, show links
		 */
		$aiLinks = $this->getLinkArr();
		$iLinksNum = count($aiLinks);
		$i = 0;
		foreach($aiLinks as $iLink) {
			$i++;
			if ($iLink == $this->getCurrent()) {
				$sHTML .= ' ' . $iLink;
			} else {
				$sHTML .= ' ' . $sAnchorStart . $iLink . '" title="' . _PAGINATOR_GOTOPAGE . '">' . $iLink . '</a>';
			}
			if ($i != $iLinksNum) $sHTML .= ' |';
		}
		/*
		 * If we are not on the last page, show the Next link
		 */
		if ($this->getNext()) {
			$sHTML .= ' | ' . $sAnchorStart . $this->getNext() . '" title="' . _PAGINATOR_GOTONEXT . '">&gt;</a>';
		}
		/*
		 * If we are not on the last page, show the Last link
		 */
		if ($this->getLast()) {
			$sHTML .= ' | ' . $sAnchorStart . $this->getLast() . '" title="' . _PAGINATOR_GOTOLAST . '">&gt;&gt;</a>';
		}
		$sHTML .= ' ]';
		/*
		 * Display the "Jump" To Page feature if turned ON
		 */
		if ($this->bShowJumpTo) {
			if ($this->iJumpType) {
				$sHTML .= '&nbsp;&nbsp;<select name="' . $this->sQSPage . '" onchange="this.form.submit()">';
				$totalPages = $this->getTotalPages();
				$currentPage = $this->getCurrent();
				for ($i = 1; $i <= $totalPages; $i++) {
					if ($i == $currentPage)
						$selected = 'selected="selected"';
					else
						$selected = '';
					$sHTML .= '<option ' . $selected . ' value="' . $i .'">' . $i . '</option>';
				}
				$sHTML .= '</select>';

			} else {
				$sHTML .= '&nbsp;&nbsp;'
					. '<input type="text" name="pagenum" size="5" maxlength="10" value="" title="' . _PAGINATOR_GOTOPAGE . '" />&nbsp;'
					. '<input type="submit" value="' . _PAGINATOR_GO . '" title="' . _PAGINATOR_GOTOPAGE . '" />';
			}
		}
		$sHTML .= '</form></div>';
		return $sHTML;
	}
	/**
	 * Function: setLink
	 *
	 * Sets the query string main link.
	 *
	 * @param  string  $sLink  The main query string link to prepend all links with
	 * @return void            Only sets an internal variable
	 */
	function setLink($sLink='') {
		$this->sLink = $sLink;
	}
	/**
	 * Function: setShowPageOf
	 *
	 * Determines whether "Page # of ##" is shown or not, default is "true" which will show it.
	 *
	 * @param  bool  $bShowPageOf  Either of (true|false)
	 * @return void                Only sets an internal variable
	 */
	function setShowPageOf($bShowPageOf=true) {
		$this->bShowPageOf = ($bShowPageOf) ? true : false;
	}
	/**
	 * Function: setShowTotalItems
	 *
	 * Determines whether "out of NNNNN" is shown or not, default is "true" which will show it.
	 *
	 * @param  bool  $bShowTotalItems  Either of (true|false)
	 * @return void                    Only sets an internal variable
	 */
	function setShowTotalItems($bShowTotalItems=true) {
		$this->bShowTotalItems = ($bShowTotalItems) ? true : false;
	}
	/**
	 * Function: setShowJumpTo
	 *
	 * Determines whether the "Jump to Page" is shown or not, default is "true" which will show it.
	 *
	 * @param  bool  $bShowJumpTo  Either of (true|false)
	 * @return void                Only sets an internal variable
	 */
	function setShowJumpTo($bShowJumpTo=true) {
		$this->bShowJumpTo = ($bShowJumpTo) ? true : false;
	}
	/**
	 * Function: setJumpType
	 *
	 * Sets the method used for the "Jump to Page" feature, when the feature is turned ON, as follows:
	 * 0 = User is presented with a text entry field to enter the page number in and a GO button.  This is default behavior.
	 * 1 = User is presented with a drop-down select object instead.
	 *
	 * @param  integer  $iJumpType  One of 0 or 1 for the moment.
	 * @return void                 Only sets an internal variable
	 */
	function setJumpType($iJumpType=0) {
		$iJumpType = intval($iJumpType);
		$this->iJumpType = ($iJumpType >= 0 and $iJumpType <= 1) ? $iJumpType : 0;
	}
	/**
	 * Function: setNoFollow
	 *
	 * Determines whether a "no follow" attribute is added to the links to keep search engines from
	 * following the links.  This really should NOT be a problem as long as the links to the same
	 * page are not different.  But, just in case some pages could be "substantially similar" and
	 * you are concerned with this, these can be turned on.  Default is "false", to not add them.
	 *
	 * @param  bool  $bNoFollow  Either of (true|false)
	 * @return void              Only sets an internal variable
	 */
	function setNoFollow($bNoFollow=false) {
		$this->bNoFollow = ($bNoFollow) ? true : false;
	}
	/**
	 * Function: setQSPage
	 *
	 * Allows for changing the Query String variable of 'pagenum' to really anything that you
	 * need.  However, don't forget to change your module code to pass in the different
	 * global name or parameter (depending upon how you implement this class) as well as what
	 * you pass into the object constructor.
	 *
	 * @param  bool  $sQSPage  Either of (true|false)
	 * @return void            Only sets an internal variable
	 */
	function setQSPage($sQSPage='') {
		$this->sQSPage = (isset($sQSPage) and $sQSPage != '') ? urlencode($sQSPage) : 'pagenum';
	}
	/**
	 * Function: setTotalItems
	 *
	 * Allows for changing the default text to display for the (NN total items) feature.
	 *
	 * @param  bool  $sTotalItems  Text to use instead of "total items" in (NN total items).
	 * @return void                Only sets an internal variable
	 */
	function setTotalItems($sTotalItems='') {
		$this->sTotalItems = (isset($sTotalItems) and $sTotalItems != '') ? $sTotalItems : _PAGINATOR_TOTALITEMS;
	}
}

?>