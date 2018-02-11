<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// submit.php - This file is part of GCalendar
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
// submit.php - responsible for user submission of events
///////////////////////////////////////////////////////////////////////

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
require_once 'modules/' . $module_name . '/language.php';
gcalGetLang($module_name);

require_once 'modules/' . $module_name . '/gcal.inc.php';
require_once 'modules/' . $module_name . '/class.combo.php';
require_once 'modules/' . $module_name . '/common.inc.php';
require_once 'modules/' . $module_name . '/class.eventForm.php';
require_once 'modules/' . $module_name . '/gcInputFilter.php';

///////////////////////////////////////////////////////////////////////

include 'header.php';
OpenTable();

$config = getConfig();
if (gcalCanSubmit($config['user_submit'], $config['groups_submit'])) {
	$postLink = GCAL_MOD_LINK . '&amp;file=submit&amp;op=submit';
	printTitle($config['image'], $config['title']);
	if (empty($op)) {
		$y = isset($y) ? intval($y) : 0;
		$m = isset($m) ? intval($m) : 0;
		$d = isset($d) ? intval($d) : 0;

		$forDate = toSqlDate($y, $m, $d);
		$eventForm = new EventForm($postLink, _SUBMIT_FORM_TITLE, _FORM_SUBMIT, $config, $forDate);
		if (is_admin($admin)) {
			$eventForm->enableAdmin(true);
		}
		$eventForm->display();
	} else if (isset($op) && $op == 'submit') {
		csrf_check();
		$eventForm = new EventForm($postLink, _SUBMIT_FORM_TITLE, _FORM_SUBMIT, $config);
		$isAdmin = is_admin($admin);
		if ($isAdmin) {
			$eventForm->enableAdmin(true);
		}
		$eventForm->post('new');
		if ($eventForm->errorCount() > 0) {
			$eventForm->display(true);
		} else {
			$success = $eventForm->save();
			if (($config['req_approval'] && !gcalNeedsNoApproval($config['groups_no_approval'])) || !$eventForm->approved) {
				$reqApproval = true;
			} else {
				$reqApproval = false;
			}
			//$reqApproval = $config['req_approval'] && !gcalNeedsNoApproval($config['groups_no_approval']) && !$eventForm->approved;

			if ($success) {
				echo '<div class="text-center"><span class="thick">' . _THANKS_SUBMISSION . '</span><br /><br />';
				echo $reqApproval ? _APPROVAL_REQUIRED : _NO_APPROVAL_REQUIRED;
				echo '</div><br /><br />';

				if ($config['email_notify']) {
					gcalEmail($config['email_to'],
								 $config['email_from'],
								 $config['email_subject'],
								 $config['email_msg']);
				}
			} else {
				echo '<div class="text-center">' . _SUBMIT_ERROR . '</div><br /><br />';
			}
			echo '<div class="text-center"><a href="' . GCAL_MOD_LINK . '">' . $config['title'] . '</a></div><br /><br />';
		}
	}
} else {
	echo '<div class="text-center">' . _SUBMIT_DISABLED . '</div><br /><br />';
}

CloseTable();
include 'footer.php';

///////////////////////////////////////////////////////////////////////

?>