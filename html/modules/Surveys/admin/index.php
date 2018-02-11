<?php
/****************************************************************/
/* PHP-NUKE: Web Portal System							*/
/* ===========================							*/
/*												*/
/* Copyright (c) 2002 by Francisco Burzi						*/
/* http://phpnuke.org									*/
/*												*/
/* This program is free software. You can redistribute it and/or modify	*/
/* it under the terms of the GNU General Public License as published by	*/
/* the Free Software Foundation; either version 2 of the License.		*/
/****************************************************************/
/*		 Additional security & Abstraction layer conversion		*/
/*						   2003 chatserv				*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com		*/
/****************************************************************/

if ( !defined('ADMIN_FILE') ) {
   die ("Access Denied");
}

global $prefix, $db, $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {
	/*****************************************************/
	/* Poll/Surveys Functions						*/
	/*****************************************************/

	function puthome($ihome, $acomm) {
		$ihome = intval($ihome);
		$acomm = intval($acomm);
		echo "<br /><span class='thick'>" . _PUBLISHINHOME . "</span>&nbsp;&nbsp;";
		if (($ihome == 0) OR ($ihome == "")) {
			$sel1 = 'checked="checked"';
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}

		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1 />" . _YES . "&nbsp;"
			."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2 />" . _NO . ""
			."&nbsp;&nbsp;<span class=\"content\">[ " . _ONLYIFCATSELECTED . " ]</span><br />";
		echo "<br /><span class='thick'>" . _ACTIVATECOMMENTS . "</span>&nbsp;&nbsp;";

		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = 'checked="checked"';
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1 />" . _YES . "&nbsp;"
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2 />" . _NO . "<br /><br />";
	}

	function SelectCategory($cat) {
		global $prefix, $db, $admin_file;

		$cat = intval($cat);
		$selcat = $db->sql_query("SELECT catid, title from " . $prefix . "_stories_cat order by title");
		$a = 1;

		echo "<span class='thick'>" . _CATEGORY . "</span> ";
		echo "<select name=\"catid\">";

		if ($cat == 0) {
			$sel = 'selected="selected"';
		} else {
			$sel = "";
		}

		echo "<option value=\"0\" $sel>" . _ARTICLES . "</option>";
		while ($row = $db->sql_fetchrow($selcat)) {
			$catid = intval($row['catid']);
			$title = htmlentities(check_html($row['title'], "nohtml"), ENT_QUOTES);
			if ($catid == $cat) {
				$sel = 'selected="selected"';
			} else {
				$sel = "";
			}
			echo "<option value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> [ <a href=\"".$admin_file.".php?op=AddCategory\">" . _ADD . "</a> | <a href=\"".$admin_file.".php?op=EditCategory\">" . _EDIT . "</a> | "
			."<a href=\"".$admin_file.".php?op=DelCategory\">" . _DELETE . "</a> ]";
	}

	function poll_createPoll() {
		global $language, $admin, $multilingual, $prefix, $db, $admin_file;

		include_once('header.php');

		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _POLLSADMIN , '</div>';
		CloseTable();
		OpenTable();
		echo '<div class="text-center"><span class="option thick">' , _CREATEPOLL , '</span><br /><br />'
			."[ <a href=\"".$admin_file.".php?op=remove\">" . _DELETEPOLLS . "</a> | <a href=\"".$admin_file.".php?op=polledit_select\">" . _EDITPOLL . "</a> ]</div><br /><br />"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."" . _POLLTITLE . ": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" /><br /><br />";

		if ($multilingual == 1) {
			echo '<br />' . _LANGUAGE . ': '
				. lang_select_list('planguage', $language, false)
				. '<br /><br />';
		} else {
			echo '<input type="hidden" name="planguage" value="' . $language . '" />'
				. '<br /><br />';
		}

		echo "<span class=\"content\">" . _POLLEACHFIELD . "</span><br />"
			."<table border=\"0\">";
		for($i = 1; $i <= 12; $i++)  {
			echo "<tr>"
				."<td>" . _OPTION . " $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" /></td>"
				."</tr>";
		}
		echo "</table>"
			."<br /><br /><div class='text-center'><hr size=\"1\" noshade=\"noshade\" /><span class=\"option thick\">" . _ANNOUNCEPOLL . "</span><br />"
			."<span class=\"tiny\">" . _LEAVEBLANK . "</span></div>"
			."<br /><br /><span class='thick'>" . _TITLE . ":</span><br />"
			."<input type=\"text\" name=\"title\" size=\"40\" /><br /><br />";
		$cat = 0;
		$ihome = 0;
		$acomm = 0;
		SelectCategory($cat);
		echo "<br />";
		puthome($ihome, $acomm);
		echo "<span class='thick'>" . _TOPIC . "</span> <select name=\"topic\">";
		$toplist = $db->sql_query("SELECT topicid, topictext from " . $prefix . "_topics order by topictext");
		echo "<option value=\"\">" . _SELECTTOPIC . "</option>\n";
		while ($row = $db->sql_fetchrow($toplist)) {
			$topicid = intval($row['topicid']);
			$topics = htmlentities(check_html($row['topictext'], "nohtml"), ENT_QUOTES);
			echo "<option value=\"$topicid\">$topics</option>\n";
		}
		echo '</select>';
		echo '<br /><br /><span class="thick">' , _STORYTEXT , '</span><br />';
		wysiwyg_textarea('hometext', '', 'PHPNukeAdmin', 50, 12);
		echo '<br /><br /><span class="thick">' , _EXTENDEDTEXT , '</span><br />';
		wysiwyg_textarea('bodytext', '', 'PHPNukeAdmin', 50, 12);
		echo '<br /><br /><span class="thick">' , _NOTES , '</span><br />';
		wysiwyg_textarea('notes', '', 'PHPNukeAdmin', 50, 6);
		echo '<br /><span class="content">' , _ARESUREURL , '</span>'
			,'<br /><br />'
			,'<input type="hidden" name="op" value="createPosted" />'
			,'<input type="submit" value="' , _CREATEPOLLBUT , '" />'
			,'</form>';
		CloseTable();
		include_once('footer.php');
	}

	function poll_createPosted($pollTitle, $optionText, $planguage, $title, $hometext, $topic, $bodytext, $catid, $ihome, $acomm, $notes) {
		global $prefix, $db, $aid, $admin_file;

		$timeStamp = time();
		$pollTitle = addslashes(check_words(check_html($pollTitle, "nohtml")));
		if(!$db->sql_query("INSERT INTO " . $prefix . "_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$planguage', '0')")) {
			return;
		}
		$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
		$id = $object['pollID'];
		$id = intval($id);
		for($i = 1; $i <= sizeof($optionText); $i++) {
			if(!empty($optionText[$i])) {
				$optionText[$i] = addslashes(check_words(check_html($optionText[$i], "nohtml")));
			}
			if(!$db->sql_query("INSERT INTO " . $prefix . "_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
				return;
			}
		}
		if ((!empty($title)) AND (!empty($hometext))) {
			$catid = intval($catid);
			$title = addslashes(check_words(check_html($title, "nohtml")));
			$hometext = addslashes(check_words(check_html($hometext, "")));
			$bodytext = addslashes(check_words(check_html($bodytext, "")));
			$topic = intval($topic);
			$ihome = intval($ihome);
			$acomm = intval($acomm);
			$result = $db->sql_query("insert into ".$prefix."_stories values (NULL, '$catid', '$aid', '$title', now(), '$hometext', '$bodytext', '0', '0', '$topic', '$aid', '$notes', "
									."'$ihome', '$planguage', '$acomm', '0', '0', '0', '0', '')");
		}
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function poll_removePoll() {
		global $prefix, $db, $admin_file;

		include_once('header.php');

		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _POLLSADMIN , '</div>';
		CloseTable();
		OpenTable();
		echo '<div class="text-center"><span class="option thick">' , _REMOVEEXISTING , '</span><br /><br />'
			."" . _POLLDELWARNING . "</div><br /><br />"
			."" . _CHOOSEPOLL . "<br />"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<input type=\"hidden\" name=\"op\" value=\"removePosted\" />"
			."<table border=\"0\">";
		$result = $db->sql_query("SELECT pollID, pollTitle, timeStamp, planguage FROM ".$prefix."_poll_desc ORDER BY timeStamp");
		if(!$result) {
			return;
		}
		/* cycle through the descriptions until everyone has been fetched */
		while($object = $db->sql_fetchrow($result)) {
			$pollID = $object['pollID'];
			$pollID = intval($pollID);
			$object['pollTitle'] = check_html($object['pollTitle'], "nohtml");
			echo "<tr><td><input type=\"radio\" name=\"id\" value=\"".$object['pollID']."\" />".$object['pollTitle']." - (".$object['planguage'].")</td></tr>";
		}
		echo "</table>";
		echo "<input type=\"submit\" value=\"" . _DELETE . "\" />";
		echo "</form>";
		CloseTable();
		include_once('footer.php');
	}

	function poll_removePosted() {
		global $id, $prefix, $db, $admin_file;

		$id = intval($id);
		$db->sql_query("DELETE FROM " . $prefix . "_poll_desc WHERE pollID='$id'");
		$db->sql_query("DELETE FROM " . $prefix . "_poll_data WHERE pollID='$id'");
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function polledit_select() {
		global  $admin_file, $db, $prefix;
		include_once 'header.php';
		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _POLLSADMIN , '</div>';
		CloseTable();
		OpenTable();
		echo '<div class="text-center option thick">' , _EDITPOLL , '</div><br /><br />'
			. _CHOOSEPOLLEDIT . '<br />'
			. '<form action="' . $admin_file . '.php" method="post">'
			. '<input type="hidden" name="op" value="polledit" />'
			. '<table border="0">';
		$result = $db->sql_query('SELECT `pollID`, `pollTitle`, `timeStamp`, `planguage` FROM `' . $prefix . '_poll_desc` ORDER BY `timeStamp`');
		if(!$result) {
			return;
		}
		/* cycle through the descriptions until everyone has been fetched */
		$i = 0;
		while($object = $db->sql_fetchrow($result)) {
			$pollID = $object['pollID'];
			$pollID = intval($pollID);
			$object['pollTitle'] = check_html($object['pollTitle'], 'nohtml');
			$i++;
			if($i = 1) {
				$sel = ' checked="checked"';
			} else  {
				$sel = 'checked=""';
			}
			echo '<tr><td><input type="radio" name="pollID" value="' . $object['pollID'] . '"'. $sel . ' />' . $object['pollTitle'] . ' - (' . $object['planguage'] . ')</td></tr>';
		}
		echo '</table>'
			. '<input type="submit" value="' . _EDIT . '" />'
			. '</form>';
		CloseTable();
		include_once 'footer.php';
	}

	function polledit($pollID) {
		global $prefix, $db, $multilingual, $admin_file;

		include_once('header.php');

		GraphicAdmin();
		OpenTable();
		echo '<div class="text-center title thick">' , _POLLSADMIN , '</div>';
		$pollID = intval($pollID);
		$row = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, planguage from " . $prefix . "_poll_desc where pollID='$pollID'"));
		$pollTitle = htmlentities(check_html($row['pollTitle'], "nohtml"), ENT_QUOTES);
		$planguage = check_html($row['planguage'], "nohtml");
		CloseTable();
		OpenTable();
		echo '<div class="text-center thick">' , _POLLEDIT , ' ' , $pollTitle , '</div><br /><br />';
		echo "<form action=\"".$admin_file.".php\" method=\"post\">";
		echo "<table border=\"0\" align=\"center\"><tr><td align=\"right\">";
		echo "<span class='thick'>" . _TITLE . ":</span></td><td colspan=\"2\"><input type=\"text\" name=\"pollTitle\" value=\"$pollTitle\" size=\"40\" maxlength=\"100\" /></td></tr>";
		if ($multilingual == 1) {
			echo '<tr><td><span style="font-weight: bold;">' . _LANGUAGE . ': </span></td><td>'
				. lang_select_list('planguage', $planguage, false)
				. '<br /><br />'
				. '</td></tr>';
		} else {
			echo '<input type="hidden" name="planguage" value="' . $planguage . '" />'
				. '<br /><br />';
		}
		$result2 = $db->sql_query("SELECT optionText, optionCount, voteID from ".$prefix."_poll_data where pollID='$pollID' order by voteID");
		while ($row2 = $db->sql_fetchrow($result2)) {
			$optionText = htmlentities(check_words(check_html($row2['optionText'], "nohtml")), ENT_QUOTES);
			$optionCount = intval($row2['optionCount']);
			$voteID = intval($row2['voteID']);
			echo "<tr><td align=\"right\"><span class='thick'>" . _OPTION . " $voteID:</span></td><td><input type=\"text\" name=\"optiontext[$voteID]\" value=\"$optionText\" "
				."size=\"40\" maxlength=\"50\" /></td><td align=\"right\">$optionCount "._VOTES."</td></tr>";
		}
		echo "</table><input type=\"hidden\" name=\"pollID\" value=\"$pollID\" /><input type=\"hidden\" name=\"op\" value=\"savepoll\" />"
			."<br /><br /><div class='text-center'><input type=\"submit\" value=\"" . _SAVECHANGES . "\" /><br />" . _GOBACK . "</div><br /><br /></form>";
		CloseTable();
		include_once("footer.php");
	}

	function savepoll($pollID, $pollTitle, $planguage, $optiontext) {
		global $prefix, $db, $admin_file;

		$pollID = intval($pollID);
		$pollTitle = addslashes(check_words(check_html($pollTitle, 'nohtml')));

		$result = $db->sql_query('update ' . $prefix . '_poll_desc set pollTitle="' . $pollTitle . '", planguage="' . $planguage . '" where pollID="' . $pollID . '"');

		for ($i=0; $i<12; $i++) {
			$a = $i + 1;
			$optiontext[$a] = addslashes(check_words(check_html($optiontext[$a], 'nohtml')));
			$result = $db->sql_query('update ' . $prefix . '_poll_data set optionText="' . $optiontext[$a] . '" where voteID="' . $a . '" AND pollID="' . $pollID . '"');
		}

		Header('Location: ' . $admin_file . '.php?op=adminMain');
	}

	if (!empty($_POST['pollID']) || !empty($_GET['pollID'])) {
		$pollID = (!empty($_POST['pollID'])) ? (int) $_POST['pollID'] : (int) $_GET['pollID'];
	} else {
		$pollID = 0;
	}

	switch($op) {
		case "create":
			poll_createPoll();
			break;

		case "createPosted":
			csrf_check();
			poll_createPosted($pollTitle, $optionText, $planguage, $title, $hometext, $topic, $bodytext, $catid, $ihome, $acomm, $notes);
			break;

		case "remove":
			poll_removePoll();
			break;

		case "removePosted":
			csrf_check();
			poll_removePosted();
			break;

		case "polledit":
			polledit($pollID);
			break;

		case "savepoll":
			csrf_check();
			savepoll($pollID, $pollTitle, $planguage, $optiontext);
			break;

		case "polledit_select":
			polledit_select();
			break;
	}
} else {
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class='thick'>"._ERROR."</span><br /><br />You do not have administration permission for module \"$module_name\"</div>";
	CloseTable();
	include_once("footer.php");
}

?>