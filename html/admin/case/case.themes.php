<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id: case.themes.php 3956 2013-02-09 05:02:12Z palbin $
 * @copyright (c) 2013 Raven Web Services, LLC
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

switch ($op) {
	case 'Themes':
		include 'admin/modules/themes.php';
		break;
}

?>