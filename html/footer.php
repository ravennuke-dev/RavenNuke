<?php

/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id$
 * @copyright 2013 by RavenNuke(tm)
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}

global $db;

define('NUKE_FOOTER', true);

foot();
/**
* This was causing problems so we commented it out.
* It should not be needed as the connection will be closed when the script ends anyway.
*/
//$db->sql_close();

function footmsg($echoit = true) {
	global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time, $footmsg;

	$mtime = microtime();
	$mtime = explode(' ',$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$end_time = $mtime;
	$total_time = ($end_time - $start_time);
	$total_time = _PAGEGENERATION . ' ' . substr($total_time,0,4) . ' ' . _SECONDS;
	$footmsg = '<div class="footmsg">';

	if (!empty($foot1)) {
		$footmsg .= '<div class="rn-footer" id="rn-foot1" >' . $foot1 . '</div>';
	}
	if (!empty($foot2)) {
		$footmsg .= '<div class="rn-footer" id="rn-foot2" >' . $foot2 . '</div>';
	}
	if (!empty($foot3)) {
		$footmsg .= '<div class="rn-footer" id="rn-foot3" >' . $foot3 . '</div>';
	}

	/**
	* DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
	* IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
	* PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
	*/
	$footmsg .= '<div id="fb-copyright" >' . $copyright . '</div><div id="rn-total-time" >' . $total_time . '</div></div>';
	if ($echoit) {
		echo $footmsg;
	}
}

function foot() {
	global $admin, $db, $loglevel, $name;

	if(defined('HOME_FILE')) {
		blocks('d');
	} else {
		if(defined('MODULE_FILE')) {
			if (file_exists('modules/' . $name . '/copyright.php')) {
				$cpname = str_replace('_', ' ', $name);
				echo '<div align="right"><a href="javascript:openwindow()">' . $cpname . ' &copy;</a></div>';
			}
			if (file_exists('modules/' . $name . '/admin/panel.php') && is_admin($admin)) {
				echo '<br />';
				OpenTable();
				include_once 'modules/' . $name . '/admin/panel.php';
				CloseTable();
			}
		}
	}

	themefooter();

	if (file_exists('includes/custom_files/custom_footer.php')) {
		include_once 'includes/custom_files/custom_footer.php';
	}

	if (defined('TNSL_USE_SHORTLINKS')) {
		tnsl_fPageTapFinish();
	}

	writeBODYJS();

	// This code was contributed by emilacosta and adapted for use with RavenNuke(tm) v2.40.00 by Raven
	if ($loglevel == 3 || $loglevel == 4) {
		if (is_admin($admin)) {
			echo '<br /><br /><br /><br />'
				, '<div id="queries" style="text-align:left; background-color:white;">'
				, ' DB Queries: ' , $db->num_queries
				, '<br /><br />';
			foreach ($db->all_queries as $file => $queries) {
				foreach ($queries as $num => $query) {
					echo  $num , ' - ' , $query , '<hr />';
				}
			}
			echo '</div>';
		}
	}

	echo '</body>' , "\n" , '</html>';
}

?>