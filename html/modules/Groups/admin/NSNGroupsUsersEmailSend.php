<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

global $sitename, $adminmail;
$aname = $sitename;
$amail = $adminmail;

!empty($_POST['gcontent']) ? $gcontent = check_html($_POST['gcontent'], 'nohtml') : Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersEmail');
!empty($_POST['gsubject']) ? $gsubject = check_html($_POST['gsubject'], 'nohtml') : $gsubject = '';
if (!empty($_POST['gid']) && is_array($_POST['gid'])) {
	$j = count($_POST['gid']);
	for ($i = 0; $i < $j; $i++) {
		$gid[$i] = intval($_POST['gid'][$i]);
	}
} else {
	Header('Location: ' . $admin_file . '.php?op=NSNGroupsUsersEmail');
}

$headers = 'MIME-Version: 1.0' . "\n";

if ($etype < 1) {
	$headers .= 'Content-Type: text/plain; charset=iso-8859-1' . "\n";
	$gcontent .= "\n" . '--------------------' . "\n" . _GR_THANK . ';' . "\n" . $aname . ' <' . $amail . '>';
	$encode = 0;
} else {
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\n";
	$gcontent .= '<hr />' . _GR_THANK . ';<br /><a href="mailto:' . $amail . '">' . $aname . '</a>';
	$encode = 1;
}

$headers .= 'From: ' . $aname . ' <' . $amail . '>' ."\r\n";
$headers .= 'Return-Path: ' . $amail . "\r\n";
$headers .= 'Reply-To: ' . $amail . "\r\n";
$headers .= 'X-Mailer: NSN Groups';

/*
* TegoNuke Mailer added by montego for 2.20.00
*
* Revised following code to batch up emails into an array prior to sending
*/
$mailsuccess = false;
for ($i = 0;$i < $j;$i++) {
	$tnml_asTo = array();
	if ($gid[$i] == 0) {
		$subject = '[' . $sitename . ' ' . _GR_GLET . ']: ' . $gsubject;
		$result = $db->sql_query('SELECT `uid` FROM `' . $prefix . '_nsngr_users`');
		while (list($guid) = $db->sql_fetchrow($result)) {
			list($email, $username) = $db->sql_fetchrow($db->sql_query('SELECT `user_email`, `username` FROM `' . $user_prefix . '_users` WHERE `user_id`=\'' . $guid . '\''));
			$tnml_asTo[] = array($email, $username);
		}
	} else {
		list($gname) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid`=\'' . $gid[$i] . '\''));
		$subject = '[' . $gname . ' ' . _GR_GLET . ']: ' . $gsubject;
		$result = $db->sql_query('SELECT `user_email`, `username` FROM `' . $prefix . '_nsngr_users`, `' . $user_prefix . '_users` WHERE `gid`=\'' . $gid[$i] . '\' AND `user_id` = `uid`');
		while (list($email, $username) = $db->sql_fetchrow($result)) {
			$tnml_asTo[] = array($email, $username);
		}
	}

	if (TNML_IS_ACTIVE) {
		$params = array('html' => $encode, 'batch' => 1);
		$mailsuccess = tnml_fMailer($tnml_asTo, $subject, $gcontent, $amail, $aname, $params);
	} else {
		foreach($tnml_asTo as $to) {
			$to2 = $to[1] . ' <' . $to[0] . '>';
			$mailsuccess = mail($to2, $subject, $gcontent, $headers);
		}
	}
}

if($mailsuccess) {
	Header('Refresh: 6, ' . $admin_file . '.php?op=NSNGroups');
	include('header.php');
	Opentable();
	echo '<div class="text-center"><h3>'._GR_GROUPSEMAIL.'</h3>'.PHP_EOL;
	echo _GR_MAILSENTGR.'<br />'._GR_WAITREDIR.'</div>'.PHP_EOL;
	CloseTable();
	include('footer.php');
} else {
	include('header.php');
	Opentable();
	echo '<div class="text-center"><h3>'._GR_GROUPSEMAIL.'</h3>'.PHP_EOL;
	echo _GR_MAILSENDERROR.'<br /><br />'._GOBACK.'</div>'.PHP_EOL;
	CloseTable();
	include('footer.php');
}
?>