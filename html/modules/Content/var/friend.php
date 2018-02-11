<?php
/*      Content Plus for RavenNuke(tm): /var/friend.php
 *      Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 * 		Join me at http://slaytanic.sourceforge.net
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if (!defined('IN_CPM')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$pagetitle = '- '._CP_RECOMMEND;

switch($op) {
    case 'SendPage': SendPage($pid); break;
    case 'FriendSend': FriendSend($pid); break;
}

function FriendSend($pid) {
global $user, $cookie, $prefix, $db, $user_prefix, $module_name;
	$pid = intval($pid);
	if(empty($pid)) { exit(); }
	include('header.php');
	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\''));
	$title = $row['title'];
	cpheader();
	OpenTable();
	echo '<div class="text-center"><span class="content thick">'._CP_FRIEND.'</span></div><br /><br />'.PHP_EOL;
	echo _CP_YOUSENDSTORY.' <span class="thick">'.$title.'</span> '._CP_TOAFRIEND.'<br /><br />'.PHP_EOL;
	echo '<form action="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=SendPage&amp;pid='.$pid.'" method="post">'.PHP_EOL;
	if (is_user($user)) {
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, user_email FROM '.$user_prefix.'_users WHERE username=\''.$cookie[1].'\''));
		$yn = $row2['name'];
		$ye = $row2['user_email'];
	} else {
		$yn = '';
		$ye = '';
	}
	echo '<span class="thick">'._CP_FYOURNAME.' </span> <input type="text" name="yname" value="'.$yn.'" /><br /><br />'.PHP_EOL;
	echo '<span class="thick">'._CP_FYOUREMAIL.' </span> <input type="text" name="ymail" value="'.$ye.'" /><br /><br /><br />'.PHP_EOL;
	echo '<span class="thick">'._CP_FFRIENDNAME.' </span> <input type="text" name="fname" /><br /><br />'.PHP_EOL;
	echo '<span class="thick">'._CP_FFRIENDEMAIL.' </span> <input type="text" name="fmail" /><br /><br />'.PHP_EOL;
	echo '<input type="submit" value="'._CP_SEND.'" />'.PHP_EOL;
	echo '</form>'.PHP_EOL;
    CloseTable();
    include('footer.php');
}

function SendPage($pid) {
global $sitename, $slogan, $nukeurl, $prefix, $db, $module_name;
    $fname = removecrlf($_POST['fname']);
    $fmail = removecrlf($_POST['fmail']);
    $yname = removecrlf($_POST['yname']);
    $ymail = removecrlf($_POST['ymail']);
    $pid = intval($pid);

    if(!empty($fname) && !empty($fmail) && !empty($yname) && !empty($yname)) {
    	$mypage = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\''));
   		$mytitle = $mypage['title'];
    	$mytext = $mypage['text'];
    	//$mytext = str_ireplace('<!--pagebreak-->', '<br /><br /<', $mytext);
    	$mytext = str_replace('[--pagebreak--]', '<br /><br />', $mytext);
		$mytext = substr($mytext, 0, 1000);
		$mytext = check_html($mytext, 'nohtml');
    	$subject = _CP_INTERESTING.' '.$sitename;
    	$message = _CP_HELLO.' '.$fname.':<br />'.PHP_EOL;
		$message.= _CP_YOURFRIEND.' '.$yname.' '._CP_CONSIDERED.'<br /><br />'.PHP_EOL;
		$message.= '<span class="thick">'.$mytitle.'</span><br /><br />'.PHP_EOL;
		$message.= $mytext.'...<br /><br />'.PHP_EOL;
		$message.= _CP_CPREADMORE.' (<a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'</a> )<br /><br /><br />'.PHP_EOL;
		$message.= _CP_YOUCANREAD.' '.$sitename.': '.$slogan.'<br /><a href="'.$nukeurl.'">'.$nukeurl.'</a>'.PHP_EOL;
		$xheaders = 'From: '.$yname.' <'.$ymail.'>'.PHP_EOL;
		$xheaders.= 'X-Sender: <'.$ymail.'>'.PHP_EOL;
		$xheaders.= 'X-Mailer: PHP'.PHP_EOL; // mailer
		$xheaders.= 'X-Priority: 6'.PHP_EOL; // Urgent message!
		$xheaders.= 'Content-Type: text/html; charset=iso-8859-1'.PHP_EOL; // Mime type
		$params = array('html'=> 1); // Activate HTML mode for TegoNuke Mailer
    	if(defined('PNM_IS_ACTIVE')) {
			phpnukemail($fmail, $subject, $message, $ymail, $yname, $encode=1);
		} elseif(TNML_IS_ACTIVE) {
			tnml_fMailer($fmail, $subject, $message, $ymail, $yname, $params);
    	} else {
			mail($fmail, $subject, $message, $xheaders);
    	}
    	include('header.php');
   		cpheader();
    	OpenTable();
   		echo '<div class="text-center">'._CP_FSTORY.' <span class="thick">'.$mytitle.'</span>'.PHP_EOL;
		echo ''._CP_HASSENT.' <span class="thick">'.$fname.'</span><br /><br />'.PHP_EOL;
		echo ''._CP_THANKS.'</div><br /><br />'.PHP_EOL;
    	CloseTable();
    	include('footer.php');
	} else {
		include('header.php');
   		cpheader();
    	OpenTable();
   		echo '<div class="text-center">'._CP_FRIENDERROR.'<br /><br />'.PHP_EOL;
   		echo '<a href="javascript:history.go(-1)">'._CP_GOBACK.'</a>'.PHP_EOL;
    	CloseTable();
    	include('footer.php');
	}
}
?>