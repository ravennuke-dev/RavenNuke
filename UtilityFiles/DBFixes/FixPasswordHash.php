<?php
/**
 * RavenNuke(tm): Fix Password Hash Issue from Release 2.30.00
 *
 * There was a bug introduced with the new RNYA module which was
 * causing new user registrations from not having their passwords
 * hashed.  This script will fix the data in the database.
 *
 * USAGE:
 * 1) Place this script into your RavenNuke(tm) root web directory
 *    (i.e., the same place where mainfile.php is).
 * 2) Make sure you are logged in as admin on your site.
 * 3) Run the script from your browser as such:
 *    http://www.mysite.com/FixPasswordHash.php
 * 4) Delete this script from your server!
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2
 *
 * @package     RavenNuke(tm)
 * @subpackage  Utilities
 * @category    Fix
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://www.montegoscripts.com
 */

include 'mainfile.php';
include 'header.php';
OpenTable();

if (is_admin($admin)) {
	$i = 0;
	$sql = 'SELECT `user_id`, `username`, `user_password` FROM `' . $user_prefix . '_users` WHERE LENGTH(`user_password`) < 32 AND `user_password` != \'\'';
	$result = $db->sql_query($sql);
	$num_users = $db->sql_numrows($result);
	while ($row = $db->sql_fetchrow($result)) {
		$user_id = intval($row['user_id']);
		$username = $row['username'];
		$user_password = $row['user_password'];
		$hashed_pass = md5($user_password);
		$sql = 'UPDATE `' . $user_prefix . '_users` SET `user_password` = \'' . $hashed_pass . '\' WHERE `user_id` = \'' . $user_id . '\'';
		$result2 = $db->sql_query($sql);
		if ($result2 === false) {
			echo 'Oops, problem updating user_id #' . $user_id . '!<br />';
		} else {
			++$i;
			echo 'Successfully modified user: user_id = ' . $user_id . ' | username = ' . $username . ' | hashed_pass = ' . $hashed_pass . '<br />';
		}
	}
	echo '<b>Conversion complete for ' . $i . ' out of ' . $num_users . ' "problem" user(s)</b><br /><br />';
	echo '<b>Please delete this script from your server now.</b><br /><br />';
} else {
	echo '<b>You must be admin to run this script</b><br /><br />';
}

CloseTable();
include 'footer.php';

?>