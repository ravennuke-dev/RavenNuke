<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// FormBase.php - This file is part of Comments
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
//
// FormBase.php is the PHP4 base class for all comment displaying form
// classes. It uses the template method design pattern to keep common
// code in this class, while calling into derived classes to do the
// custom work.
//
///////////////////////////////////////////////////////////////////////

class RNComm_FormBase {
	var $selModule; // selected module
	var $modules; // list of other modules we can display
	var $numComments;
	var $commentOpts = array(10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200);
	var $user;
	var $formAction = '';
	var $adminFeatures = false;

	function __construct($selModule, $modules) {
		$this->selModule = $selModule;
		$this->modules = $modules;
		$n = isset($_POST['number']) ? intval($_POST['number']) : 10;
		$this->numComments = in_array($n, $this->commentOpts) ? $n : current($this->commentOpts);
		$this->user = isset($_POST['userName']) ? $_POST['userName'] : '';
		$this->user = str_replace('*', '%', $this->user);  // convert wildcard to MySQL wildcard
	}

	function display() {
		if ($this->adminFeatures && isset($_POST['del']) && is_array($_POST['del'])) {
			csrf_check();
			// ensure all array elements are integers (prevent SQL injection)
			$delArray = array_map('intval', $_POST['del']);
			$this->_processDelete($delArray);
		}

		$this->displayMenu();
		$items = $this->_getItems($this->numComments, addslashes($this->user));
		$itemCount = count($items);

		if ($this->adminFeatures && $this->selModule != 'forums') { // forum deletes not supported yet
			foreach ($items as $key => $value) {
				$items[$key] = '<input type="checkbox" name="del[]" value="' . $key . '" />' . ' ' . $value;
			}
		}

		if ($itemCount > 0) {
			$this->_displayCheckLinks();
			$list = new RNComm_HtmlList($items, true);	// ordered list
			$list->display();
			$this->_displayCheckLinks();
		} else {
			echo '<br /><br /><div class="text-center">' . _RNC_NO_COMMENTS_FOUND . '</div><br />';
		}

		if ($itemCount > 0 && $this->adminFeatures && $this->selModule != 'forums') {
			echo '<div class="text-center"><input type="submit" name="delete" value="' . _RNC_DELETE .
				'" onclick="document.rncPressed = this.name" /></div>';
		}
		echo '</form><br />';
	}

	function displayMenu() {
		echo '<form action="' . $this->formAction . '" method="post" name="rncComments" '
			.'onsubmit="return rncDeleteSubmit()">';
		$this->_javascript();
		echo '<div class="text-center"><span class="title">';
		$numCombo = new RNComm_Combo('number', $this->commentOpts, $this->numComments);
		echo _RNC_DISPLAY_LAST . '</span>' . $numCombo->html();
		$modCombo = new RNComm_Combo('source', $this->modules, $this->selModule);
		echo '<span class="title">' . _RNC_COMMENTS_FROM . '</span>' . $modCombo->html();
		echo '<br /><span class="title">' . _RNC_COMMENTS_USER . '</span>'
			.'<input type="text" name="userName" value="' . htmlspecialchars(str_replace('%', '*', $this->user), ENT_QUOTES, _CHARSET)
			.'" size="16" maxlength="25" title="' . _RNC_USER_BLANK . '" />';
		echo ' <input type="submit" name="go" value="' . _RNC_GO . '" onclick="document.rncPressed = this.name" />';
		echo '</div>';
		// the form is closed in the display() function
	}

	function setFormAction($action) {
		$this->formAction = $action;
	}

	function enableAdmin() {
		$this->adminFeatures = true;
	}

	// This is a protected function that derived classes can call to generate a Your_Account link
	// to a user. It handles the Anonymous user case. In PHP5 this would be static as well.
	function _userLink($username) {
		global $anonymous;
		if ($username == $anonymous)
		{
			return $username;
		}
		return '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' .
			$username . '" title="' . _RNC_VIEW_USER . '">' . $username . '</a>';
	}

	// This is a private function that derived classes override.
	// The $user name will have been addslash'ed.
	//
	function _getItems($n, $user) {
		return array();
	}

	// This is a private function that derived classes override to perform comment
	// delete operations. The $del parameter is an array of comment ID's that are to be
	// deleted.

	function _processDelete($del) {

	}

	// private static function to output this form's javascript
	function _javascript() {
		if ($this->adminFeatures) {
			$confirmText = _RNC_CONFIRM_DELETE;
			echo <<<END_SCRIPT
<script language="Javascript" type="text/javascript">
//<![CDATA[
	function rncSelect(status) {
		for (i = 0; i < document.rncComments.length; ++i) {
			if (document.rncComments.elements[i].type == 'checkbox') {
				document.rncComments.elements[i].checked = status;
			}
		}
	}
	function rncDeleteSubmit() {
		if (document.rncPressed == 'delete') {
			count = 0;
			for (i = 0; i < document.rncComments.length; ++i) {
				if (document.rncComments.elements[i].type == 'checkbox' &&
					 document.rncComments.elements[i].checked) {
						++count;
					}
				}
			return count > 0 && confirm('$confirmText');
		}
		return true;
	}
//]]>
</script>
END_SCRIPT;
		}
	}

	// private static function to display the "check all/none" javascript enabled links
	function _displayCheckLinks() {
		if ($this->adminFeatures && $this->selModule != 'forums') {
			echo '<a href="javascript:rncSelect(true);">' . _RNC_CHECK_ALL . '</a> | ' .
				'<a href="javascript:rncSelect(false);">' . _RNC_CHECK_NONE . '</a>';
		}
	}
}

?>