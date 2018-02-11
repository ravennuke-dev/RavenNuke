<?PHP

/**********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===================================================================*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify 		*/
/* it under the terms of the GNU General Public License as published by 		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*													*/
/*********************************************************************/
/*		 Additional security & Abstraction layer conversion		 	*/
/*						   2003 chatserv					*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com			*/
/*********************************************************************/

if ( !defined('ADMIN_FILE') ) {
	die ('Access Denied');
}

global $prefix, $db, $admin_file, $ok;

if (is_mod_admin('admin')) {
	switch ($op) {

		case 'RemoveComment':
			//csrf check in function
			removeComment ($tid, $sid, $ok);
			break;

		//Not sure why this is here.  I don't think it used - Palbin
		case 'removeSubComments':
			csrf_check();
			removeSubComments($tid);
			break;

		//Not sure why this is here.  I don't think it used - Palbin
		case 'removePollSubComments':
			csrf_check();
			removePollSubComments($tid);
			break;

		case 'RemovePollComment':
			//csrf check in function
			RemovePollComment($tid, $pollID, $ok);
			break;

	}

} else {
	echo 'Access Denied';
}
die();

// Only functions beyond this point
/************************************************************/
/* Comments Delete Function							  */
/************************************************************/

/* Thanks to Oleg [Dark Pastor] Martos from http://www.rolemancer.ru */
/* to code the comments childs deletion function! */

function removeSubComments($tid, $sid) {
	global $db, $prefix;

	$tid = intval($tid);
	$sid = intval($sid);
	$result = $db->sql_query('SELECT tid from ' . $prefix . '_comments where pid=\''.$tid.'\'');
	$numrows = $db->sql_numrows($result);
	if($numrows>0) {
		while ($row = $db->sql_fetchrow($result)) {
			$stid = intval($row['tid']);
			removeSubComments($stid, $sid);
			$db->sql_query('delete from ' . $prefix . '_comments where tid=\''.$stid.'\'');
		}
	}
	$db->sql_query('delete from ' . $prefix . '_comments where tid=\''.$tid.'\'');
	$db->sql_query('update ' . $prefix . '_stories set comments=comments-1 where sid=\''.$sid.'\'');
}

function removeComment ($tid, $sid, $ok=0) {
	global $admin_file;

	$tid = intval($tid);
	$sid = intval($sid);
	if($ok) {
		/* Call recursive delete function to delete the comment and all its childs */
		csrf_check();
		removeSubComments($tid, $sid);
		Header('Location: modules.php?name=News&file=article&sid='.$sid);
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center"><span class="title thick">' , _REMOVECOMMENTS , '</span></div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center">' , _SURETODELCOMMENTS;
		echo '<br /><br />[ <a href="javascript:history.go(-1)">' , _NO , '</a> | <a class="rn_csrf" href="',$admin_file,'.php?op=RemoveComment&amp;tid=',$tid,'&amp;sid=',$sid,'&amp;ok=1">' , _YES , '</a> ]</div>';
		CloseTable();
		include_once('footer.php');
	}
}

function removePollSubComments($tid) {
	global $db, $prefix;

	$tid = intval($tid);
	$result = $db->sql_query('SELECT tid from ' . $prefix . '_pollcomments where pid=\''.$tid.'\'');
	$numrows = $db->sql_numrows($result);
	if($numrows>0) {
		while ($row = $db->sql_fetchrow($result)) {
			$stid = intval($row['tid']);
			removePollSubComments($stid);
			$db->sql_query('delete from ' . $prefix . '_pollcomments where tid=\''.$stid.'\'');
		}
	}
	$db->sql_query('delete from ' . $prefix . '_pollcomments where tid=\''.$tid.'\'');
}

function RemovePollComment ($tid, $pollID, $ok=0) {
	global $admin_file;

	$tid = intval($tid);
	$pollID = intval($pollID);
	if($ok) {
		csrf_check();
		removePollSubComments($tid);
		Header('Location: modules.php?name=Surveys&op=results&pollID='.$pollID);
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center"><span class="title thick">' , _REMOVECOMMENTS , '</span></div>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div class="text-center">' , _SURETODELCOMMENTS;
		echo '<br /><br />[ <a href="javascript:history.go(-1)">' , _NO , '</a> | <a class="rn_csrf" href="',$admin_file,'.php?op=RemovePollComment&amp;tid=',$tid,'&amp;pollID=',$pollID,'&amp;ok=1">' , _YES , '</a> ]</div>';
		CloseTable();
		include_once('footer.php');
	}
}

?>