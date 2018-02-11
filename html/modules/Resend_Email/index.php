<?php
/*
 * Raven-Nuke: Web Portal System
 * ===========================
 *
* Copyright (c) 2008-2013 by Raven Web Services LLC
* http://www.ravenphpscripts.com
* http://www.ravennuke.com
*
* This program is free software. You can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License.
*
*
* Module by Gaylen Fraley
* http://www.ravenphpscripts.com
* http://www.ravenwebhosting.com
* For use with nuke 6.5+
* Change History
* 07/23/2009 - Version 2.1.2
*            - Result of Mantis issue # 0001460: DNSStuff IP look ups no longer FREE
*              with current link structure. Just a tweak to the $requestor variable
*              from www.dnsstuff.com/tools/whois.ch/?ip=
*              to   www.dnsstuff.com/tools/whois/?ip=
*              Credit Warren-The-Ape & SexyCoder
*              http://www.ravenphpscripts.com/postx17793-0-0.html
* 02/16/2009 - Version 2.1.1
*            - Security fix for extract() function
*            - This module is depricated as RNYA now covers most if not all of the functionality
* 04/24/2008 - Modified $prefix to $user_prefix - 0000962: Re-send Email module uses $prefix for users and not $user_prefix
* 11/10/2006 - Version 2.1.0 Released
*            - Maded XHTML compliant
*            - Made some security enhancements
* 06/25/2005 - Version 2.0.2 Released
*            - Fixed bug: the resend password was empty
* 06/24/2005 - Version 2.0.1 Released
*            - Fixed bug: the buttons were not language independent
*            - German language translation added (Susan)
*              Thanks to Susann for discovering the bug!
* 06/12/2005 - Version 2.0.0 Released
*            - Converted to new sql layer
*            - Converted & to &amp; where appropriate
*            - Efficiency modifications
*            - Added auto-refresh code to redirect where appropriate
*            - Added date and timestamp added to the Waiting screen
*            - Added language defines
*            - Miscellaneous other tweaks
* 05/19/2003 - Added Modification facility to allow the Admin to make
*              selected modifications to the temporary record.
* 05/18/2003 - Fixed password display in email and added hyperlink
*              to the display to allow the Admin to activate the user
*              right from the module. The password will now be changed
*              when resending the email.
* 05/09/2003 - Released
*/

require_once('mainfile.php');
include('header.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$userpage = 1;
OpenTable();
title("$sitename".':<br />'._PENDINGREGISTRATIONS);

if(!defined('MODULE_FILE') AND realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	echo '<div class="text-center thick">'._NOACCESS._SPACE1._RDHOME._SPACE1._TWO._SPACE1._SECONDS.'</div><br />';
	CloseTable();
	header('Refresh: '._TWO.'; URL=index.php');
	include('footer.php');
	exit();
}

function endit($msg) {
	global $db;
	echo $msg . $db->error;
	CloseTable();
	include('footer.php');
	exit();
}

if (!is_admin($admin)) endit(_ACCESSDENIED);

if ($db->sql_numrows($db->sql_query('select user_id from '.$user_prefix.'_users_temp'))==0) {
	echo '<div class="text-center thick">'._NOWAITING._SPACE1._RDHOME._SPACE1._TWO._SPACE1._SECONDS.'</div><br />';
	CloseTable();
	header('Refresh: '._TWO.'; URL=index.php');
	include('footer.php');
	exit();
}

extract($_POST, EXTR_SKIP); //Raven v2.30.01 per Janek Vind
if (!isset($rsid)) $rsid=0; //Raven 6/28/2007
$rsid = intval($rsid); //Added by montego

if (isset($submit) && htmlentities($submit) == _LBLBTNRESEND) {
	csrf_check();
	for ($x=0; $x < 6; $x++) {
		mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr(_CONS, mt_rand(0, strlen(_CONS)-1), 1);
		$voc[$x] = substr(_VOWELS, mt_rand(0, strlen(_VOWELS)-1), 1);
	}
	$makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
	$result = $db->sql_query('select user_id, username, user_email, user_password, user_regdate, check_num, time from '.$user_prefix.'_users_temp where user_id=\''.$rsid.'\'');
	if(!$result) endit(_ERROR);
	list($user_id, $username, $user_email, $user_password, $user_regdate, $check_num, $time) = $db->sql_fetchrow($result);
	$finishlink = $nukeurl.'/modules.php?name=Your_Account&op=activate&username='.$username.'&amp;check_num='.$check_num;
	$message = _WELCOMETO.' $sitename!'."\n\n"._YOUUSEDEMAIL. '('.$user_email.') ' ._TOREGISTER.' '. $sitename."\n\n "._TOFINISHUSER."\n\n". $finishlink."\n\n "._FOLLOWINGMEM."\n\n"._UNICKNAME. $username."\n"._UPASSWORD. $makepass;
	$subject = _ACTIVATIONSUB;
	$from = $adminmail;
	/*
	  * TegoNuke Mailer added by montego for 2.20.00
	  */
	$rc_email = 0;
	if (TNML_IS_ACTIVE) {
		$to = array(array($user_email, $username));
		$rc_email = tnml_fMailer($to, $subject, $message, $adminmail, $sitename);
	} else {
		$rc_email = mail($user_email, $subject, $message, 'From: '.$sitename.' <'.$from.'>'."\r\nX-Mailer: PHP/" . phpversion());
	}
	/*
	  * end of TegoNuke Mailer add
	  */
	if (0!==$rc_email) {
		echo _ACTMSGSENTLEFT._SPACE1.$username._SPACE1._ACTMSGSENTRIGHT;
		$result = $db->sql_query('update '.$user_prefix.'_users_temp set user_password=\''.md5($makepass).'\' where user_id='.$rsid);
		echo '<form method="post" action="modules.php?name='.$module_name.'"><input type="submit" value="'._LBLBTNBACK.'" /></form>';
	}
	else echo _SENDMAILERROR;
} elseif (isset($delete) && htmlentities($delete) == _LBLBTNDELETE) {
	csrf_check();
	$result = $db->sql_query('delete from '.$user_prefix.'_users_temp where user_id=\''.$rsid.'\'');
	if(!$result) endit(_ERROR);
	echo '<div class="text-center thick">'._TEMPRECDELRD._SPACE1._TWO._SPACE1._SECONDS.'</div><br />';
	CloseTable();
	header('Refresh: '._TWO.'; URL=modules.php?name='.$module_name);
	include('footer.php');
	exit();
} elseif (isset($update) && htmlentities($update) == _LBLBTNUPDATE) {
	csrf_check();
	$result = $db->sql_query('update '.$user_prefix.'_users_temp set '."username='$username', user_email='$user_email', user_regdate='$user_regdate', check_num='$check_num', time='$time' where user_id=$rsid");
	if(!$result) endit(_ERROR);
	echo '<div class="text-center thick">'._TEMPRECMODRD._SPACE1._TWO._SPACE1._SECONDS.'</div><br />';
	CloseTable();
	header('Refresh: '._TWO.'; URL=modules.php?name='.$module_name);
	include('footer.php');
	exit();
} elseif (isset($modify) && htmlentities($modify) == _LBLBTNMODIFY) {
	$result = $db->sql_query('select user_id, username, user_email, user_password, user_regdate, check_num, time, requestor from '.$user_prefix.'_users_temp where user_id=\''.$rsid.'\'');
	if(!$result) endit(_ERROR);
	list($user_id, $username, $user_email, $user_password, $user_regdate, $check_num, $time) = $db->sql_fetchrow($result);
	$formTable = '';
	$formTable .= '<form method="post" action="modules.php?name='.$module_name.'&amp;file=index&amp;action=modify&amp;rsid='.$user_id.'" name="modifyform'.$rsid.'">';
	$formTable .= '<table width="50%">';
	$formTable .= '<tr><td align="right">'._LBLUSERID.'</td><td>'.$user_id.'</td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSERNAME.'</td><td><input name="username" value="'.$username.'" /></td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSEREMAIL.'</td><td><input name="user_email" value="'.$user_email.'" /></td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSERPASSWORD.'</td><td>'.$user_password.'</td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSERREGDATE.'</td><td><input name="user_regdate" value="'.$user_regdate.'" /></td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSERCHECKNUM.'</td><td><input name="check_num" value="'.$check_num.'" /></td></tr>';
	$formTable .= '<tr><td align="right">'._LBLUSERTIME.'</td><td><input name="time" value="'.$time.'" /></td></tr>';
	$formTable .= '<tr><td colspan="2"><input type="submit" name="update" value="'._LBLBTNUPDATE.'" /></td></tr>';
	$formTable .= '</table></form>';
	echo $formTable;
} else {
	$result = $db->sql_query('select user_id, username, user_email, user_password, user_regdate, check_num, time, requestor from '.$user_prefix.'_users_temp');
	if(!$result) endit(_ERROR);
	while (list($user_id, $username, $user_email, $user_password, $user_regdate, $check_num, $time, $requestor) = $db->sql_fetchrow($result)) {
		$req = explode(':',$requestor);
		$rsid = intval($user_id);
		$requestor = '<a href="http://www.dnsstuff.com/tools/whois/?ip='.$req[0].'" title="'.$req[0].'" target="_blank">'."$requestor".'</a>';
		$finishlink = '<a href="'.$nukeurl.'/modules.php?name=Your_Account&amp;op=activate&amp;username='."$username".'&amp;check_num='.$check_num.'" target="_blank">'.$nukeurl.'/modules.php?name=Your_Account&amp;op=activate&amp;username='."$username".'&amp;check_num='.$check_num.'</a>';
		echo '<form method="post" action="modules.php?name='.$module_name.'&amp;file=index&amp;action=resend&amp;rsid='.$rsid.'" name="resendform'.$rsid.'">';
		echo '<table width="100%"><tr><td>'._LBLUSERNAME.'</td><td>'.$username.'</td></tr><tr><td>'._LBLUSEREMAIL.'</td><td>'.$user_email.'</td></tr><tr><td>'._LBLUSERREGDATE.'</td><td>'.date('F d, Y h:i:s A',$time).'</td></tr><tr><td>'._REQUESTOR.'</td><td>'.$requestor.'</td></tr><tr><td>'._ACTLINK.'</td><td>'.$finishlink.'</td></tr><tr><td colspan="3"><input type="submit" name="submit" value="'._LBLBTNRESEND.'" />&nbsp;&nbsp;<input type="submit" name="modify" value="'._LBLBTNMODIFY.'" />&nbsp;&nbsp;<input type="submit" name="delete" value="'._LBLBTNDELETE.'" /></td></tr></table>';
		echo '</form>';
	}
}
CloseTable();
include('footer.php');
?>