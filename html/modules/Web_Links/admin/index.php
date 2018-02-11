<?php

/*********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								 */
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* Based on Journey Links Hack								*/
/* Copyright (c) 2000 by James Knickelbein						*/
/* Journey Milwaukee (http://www.journeymilwaukee.com)				*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*													*/
/*********************************************************************/
/*		 Additional security & Abstraction layer conversion			*/
/*						   2003 chatserv					*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com			*/
/*********************************************************************/

if ( !defined('ADMIN_FILE') ) {
	die ("Access Denied");
}

global $admin_file, $db, $prefix;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {
	switch ($op) {
		case 'Links':
			links();
			break;

		case 'LinksDelNew':
			csrf_check();
			LinksDelNew($lid);
			break;

		case 'LinksAddCat':
			csrf_check();
			LinksAddCat($title, $cdescription);
			break;

		case 'LinksAddSubCat':
			csrf_check();
			LinksAddSubCat($cid, $title, $cdescription);
			break;

		case 'LinksAddLink':
			$submitter = isset($_POST['submitter']) ? $_POST['submitter'] : '';
			LinksAddLink($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter);
			break;

		case 'LinksAddEditorial':
			csrf_check();
			LinksAddEditorial($linkid, $editorialtitle, $editorialtext);
			break;

		case 'LinksModEditorial':
			csrf_check();
			LinksModEditorial($linkid, $editorialtitle, $editorialtext);
			break;

		case 'LinksLinkCheck':
			LinksLinkCheck();
			break;

		case 'LinksValidate':
			if (!isset($ttitle)) $ttitle='';
			LinksValidate($cid, $sid, $ttitle);
			break;

		case 'LinksDelEditorial':
			csrf_check();
			LinksDelEditorial($linkid);
			break;

		case 'LinksCleanVotes':
			csrf_check();
			LinksCleanVotes();
			break;

		case 'LinksListBrokenLinks':
			LinksListBrokenLinks();
			break;

		case 'LinksEditBrokenLinks':
			LinksEditBrokenLinks($lid);
			break;

		case 'LinksDelBrokenLinks':
			csrf_check();
			LinksDelBrokenLinks($lid);
			break;

		case 'LinksIgnoreBrokenLinks':
			csrf_check();
			LinksIgnoreBrokenLinks($lid);
			break;

		case 'LinksListModRequests':
			LinksListModRequests();
			break;

		case 'LinksChangeModRequests':
			csrf_check();
			LinksChangeModRequests($requestid);
			break;

		case 'LinksChangeIgnoreRequests':
			csrf_check();
			LinksChangeIgnoreRequests($requestid);
			break;

		case 'LinksDelCat':
			//csrf check in function
			if (!isset($sid)) $sid='';
			if (!isset($ok)) $ok='';
			LinksDelCat($cid, $sid, $sub, $ok);
			break;

		case 'LinksModCat':
			LinksModCat($cat);
			break;

		case 'LinksModCatS':
			csrf_check();
			if (!isset($sid)) $sid='';
			LinksModCatS($cid, $sid, $sub, $title, $cdescription);
			break;

		case 'LinksModLink':
			if (intval($lid)>0) LinksModLink($lid);
			else {
				include_once('header.php');
				GraphicAdmin();
				OpenTable();
				echo '<div class="text-center thick"><span class="thick">'._ERROR.'</span><br /><br />'._LINKID.'</div>';
				CloseTable();
				include_once('footer.php');
			}
			break;

		case 'LinksModLinkS':
			csrf_check();
			LinksModLinkS($lid, $title, $url, $description, $name, $email, $hits, $cat);
			break;

		case 'LinksDelLink':
			csrf_check();
			LinksDelLink($lid);
			break;

		case 'LinksDelVote':
			csrf_check();
			LinksDelVote($lid, $rid);
			break;

		case 'LinksDelComment':
			csrf_check();
			LinksDelComment($lid, $rid);
			break;

		case 'LinksTransfer':
			csrf_check();
			LinksTransfer($cidfrom,$cidto);
			break;

	}
} else {
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<div class="text-center"><span class="thick">'._ERROR.'</span><br /><br />You do not have administration permission for module "'.$module_name.'"</div>';
	CloseTable();
	include_once('footer.php');
}
die();

//Only functions below this line

function getparent($parentid,$title) {
	global $db, $prefix;
	$parentid = intval($parentid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories where cid='$parentid'"));
	$cid = $row['cid'];
	$ptitle = $row['title'];
	$pparentid = $row['parentid'];
	if (!empty($ptitle)) $title=$ptitle."/".$title;
	if ($pparentid!=0) {
		$title=getparent($pparentid,$title);
	}
	return $title;
}

function links() {
	global $admin_file, $db, $prefix;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/link-logo.gif")) {
		echo "<div class='text-center'><a href=\"modules.php?name=Web_Links\"><img src=\"themes/$ThemeSel/images/link-logo.gif\" border=\"0\" alt=\"\" /></a><br /><br />";
	} else {
		echo "<div class='text-center'><a href=\"modules.php?name=Web_Links\"><img src=\"modules/Web_Links/images/link-logo.gif\" border=\"0\" alt=\"\" /></a><br /><br />";
	}
	$result = $db->sql_query("SELECT * from " . $prefix . "_links_links");
	$numrows = $db->sql_numrows($result);
	echo "<span class=\"content\">" . _THEREARE . " <span class='thick'>$numrows</span> " . _LINKSINDB . "</span></div>";
	CloseTable();
	echo "<br />";

	/* Temporarily 'homeless' links functions (to be revised in admin.php breakup) */
	$result2 = $db->sql_query("SELECT requestid,lid,cid,title,url,description,modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='1'");
	$totalbrokenlinks = $db->sql_numrows($result2);
	$result3 = $db->sql_query("SELECT requestid,lid,cid,title,url,description,modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='0'");
	$totalmodrequests = $db->sql_numrows($result3);
	OpenTable();
	echo "<div class='text-center'><span class=\"content\">[ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksCleanVotes\">" . _CLEANLINKSDB . "</a> | "
	."<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">" . _BROKENLINKSREP . " ($totalbrokenlinks)</a> | "
	."<a href=\"".$admin_file.".php?op=LinksListModRequests\">" . _LINKMODREQUEST . " ($totalmodrequests)</a> | "
	."<a href=\"".$admin_file.".php?op=LinksLinkCheck\">" . _VALIDATELINKS . "</a> ]</span></div>";
	CloseTable();
	echo "<br />";

	/* List Links waiting for validation */
	$result4 = $db->sql_query("SELECT lid, cid, sid, title, url, description, name, email, submitter from " . $prefix . "_links_newlink order by lid");
	$numrows = $db->sql_numrows($result4);
	if ($numrows>0) {
		OpenTable();
		echo "<div class='text-center'><span class=\"option thick\">" . _LINKSWAITINGVAL . "</span></div><br /><br />";
		while($row4 = $db->sql_fetchrow($result4)) {
			$lid = $row4['lid'];
			$cid = $row4['cid'];
			$sid = $row4['sid'];
			$title = $row4['title'];
			$url = $row4['url'];
			$description = $row4['description'];
			$name = $row4['name'];
			$email = $row4['email'];
			$submitter = $row4['submitter'];
			if (empty($submitter)) {
				$submitter = _NONE;
			}
			echo "<form action=\"".$admin_file.".php\" method=\"post\">"
				."<span class='thick'>" . _LINKID . ": $lid</span><br /><br />"
				."" . _SUBMITTER . ":  $submitter<br />"
				."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\" /><br />"
				."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\" />&nbsp;[ <a href=\"$url\" target=\"_blank\">" . _VISIT . "</a> ]<br />"
				."" . _DESCRIPTION . ": <br /><textarea name=\"description\" cols=\"60\" rows=\"10\">" , htmlspecialchars($description, ENT_QUOTES, _CHARSET) , "</textarea><br />"
				."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\" />&nbsp;&nbsp;"
				."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\" /><br />";
			echo "<input type=\"hidden\" name=\"new\" value=\"1\" />";
			echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\" />";
			echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\" />";
			echo "" . _CATEGORY . ": <select name=\"cat\">";
			$result5 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
			while ($row5 = $db->sql_fetchrow($result5)) {
				$cid2 = $row5['cid'];
				$ctitle2 = $row5['title'];
				$parentid2 = $row5['parentid'];
				if ($cid2==$cid) {
					$sel = 'selected="selected"';
				} else {
					$sel = '';
				}
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\" $sel>".htmlentities($ctitle2)."</option>";
			}
			echo "</select><input type=\"hidden\" name=\"submitter\" value=\"$submitter\" /><input type=\"hidden\" name=\"op\" value=\"LinksAddLink\" /><input type=\"submit\" value=\"" . _ADD . "\" /> [ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelNew&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br /><hr noshade=\"noshade\" /><br />";
		}
		CloseTable();
		echo "<br />";
	}

	/* Add a New Main Category */
	OpenTable();
	echo "<form method=\"post\" action=\"".$admin_file.".php\">"
		."<span class=\"option thick\">" . _ADDMAINCATEGORY . "</span><br /><br />"
		."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\" /><br />"
		."" . _DESCRIPTION . ":<br /><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea><br />"
		."<input type=\"hidden\" name=\"op\" value=\"LinksAddCat\" />"
		."<input type=\"submit\" value=\"" . _ADD . "\" /><br />"
		."</form>";
	CloseTable();
	echo "<br />";

	// Add a New Sub-Category
	$result6 = $db->sql_query("SELECT * from " . $prefix . "_links_categories");
	$numrows = $db->sql_numrows($result6);
	if ($numrows>0) {
	OpenTable();
	echo "<form method=\"post\" action=\"".$admin_file.".php\">"
		."<span class=\"option thick\">" . _ADDSUBCATEGORY . "</span><br /><br />"
		."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\" />&nbsp;" . _IN . "&nbsp;";
		$result7 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
	echo "<select name=\"cid\">";
	while($row7 = $db->sql_fetchrow($result7)) {
		$cid2 = $row7['cid'];
		$ctitle2 = $row7['title'];
		$parentid2 = $row7['parentid'];
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
		echo "<option value=\"$cid2\">".htmlentities($ctitle2)."</option>";
	}
	echo "</select><br />"
		. _DESCRIPTION . ":<br /><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea><br />"
		."<input type=\"hidden\" name=\"op\" value=\"LinksAddSubCat\" />"
		."<input type=\"submit\" value=\"" . _ADD . "\" /><br />"
		."</form>";
	CloseTable();
	echo "<br />";
	}

	// Add a New Link to Database
	$result8 = $db->sql_query("SELECT cid, title from " . $prefix . "_links_categories");
	$numrows = $db->sql_numrows($result8);
	if ($numrows>0) {
	OpenTable();
	echo "<form method=\"post\" action=\"".$admin_file.".php\">"
		."<span class=\"option thick\">" . _ADDNEWLINK . "</span><br /><br />"
		."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\" /><br />"
		."" . _PAGEURL . ": <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\" /><br />";
		$result9 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
	echo "" . _CATEGORY . ": <select name=\"cat\">";
	while($row9 = $db->sql_fetchrow($result9)) {
		$cid2 = $row9['cid'];
		$ctitle2 = $row9['title'];
		$parentid2 = $row9['parentid'];
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
		echo "<option value=\"$cid2\">".htmlentities($ctitle2)."</option>";
	}
	echo "</select><br /><br /><br />"
		."" . _DESCRIPTION255 . "<br /><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br /><br /><br />"
		."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\" /><br />"
		."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\" /><br /><br />"
		."<input type=\"hidden\" name=\"op\" value=\"LinksAddLink\" />"
		."<input type=\"hidden\" name=\"new\" value=\"0\" />"
		."<input type=\"hidden\" name=\"lid\" value=\"0\" />"
		."<div class='text-center'><input type=\"submit\" value=\"" . _ADDURL . "\" /></div><br />"
		."</form>";
	CloseTable();
	echo "<br />";
	}

	// Modify Category
	$result10 = $db->sql_query("SELECT * from " . $prefix . "_links_categories");
	$numrows = $db->sql_numrows($result10);
	if ($numrows>0) {
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<span class=\"option thick\">" . _MODCATEGORY . "</span><br /><br />";
		$result11 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
		echo "" . _CATEGORY . ": <select name=\"cat\">";
		while($row11 = $db->sql_fetchrow($result11)) {
			$cid2 = $row11['cid'];
			$ctitle2 = $row11['title'];
			$parentid2 = $row11['parentid'];
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\">".htmlentities($ctitle2)."</option>";
		}
		echo "</select>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCat\" />"
			."<input type=\"submit\" value=\"" . _MODIFY . "\" />"
			."</form>";
		CloseTable();
		echo "<br />";
	}

	// Modify Links
	$result12 = $db->sql_query("SELECT * from " . $prefix . "_links_links");
	$numrows = $db->sql_numrows($result12);
	if ($numrows>0) {
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\">"
		."<span class=\"option\"><span class='thick'>" . _MODLINK . "</span><br /><br />"
		."" . _LINKID . ": <input type=\"text\" name=\"lid\" size=\"12\" maxlength=\"11\" />&nbsp;&nbsp;"
		."<input type=\"hidden\" name=\"op\" value=\"LinksModLink\" />"
		."<input type=\"submit\" value=\"" . _MODIFY . "\" />"
		."</span></form>";
		CloseTable();
		echo "<br />";
	}

	// Transfer Categories
	$result13 = $db->sql_query("SELECT * from " . $prefix . "_links_links");
	$numrows = $db->sql_numrows($result13);
	if ($numrows>0) {
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<span class=\"option thick\">" . _EZTRANSFERLINKS . "</span><br /><br />"
			."" . _CATEGORY . ": "
			."<select name=\"cidfrom\">";
			$result14 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
		while($row14 = $db->sql_fetchrow($result14)) {
			$cid2 = $row14['cid'];
			$ctitle2 = $row14['title'];
			$parentid2 = $row14['parentid'];
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\">".htmlentities($ctitle2)."</option>";
		}
		echo "</select><br />"
			."" . _IN . "&nbsp;" . _CATEGORY . ": ";
		$result15 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
		echo "<select name=\"cidto\">";
		while($row15 = $db->sql_fetchrow($result15)) {
			$cid2 = $row15['cid'];
			$ctitle2 = $row15['title'];
			$parentid2 = $row15['parentid'];
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\">".htmlentities($ctitle2)."</option>";
		}
		echo "</select><br />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksTransfer\" />"
			."<input type=\"submit\" value=\"" . _EZTRANSFER . "\" /><br />"
			."</form>";
		CloseTable();
		echo "<br />";
	}

	include_once("footer.php");
}

function LinksTransfer($cidfrom,$cidto) {
	global $admin_file, $db, $prefix;
	// (comment lines to transfer existing datas)
	$db->sql_query("update " . $prefix . "_links_links set cid='$cidto' where cid='$cidfrom'");
	// end new categorie
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksModLink($lid) {
	global $admin_file, $bgcolor1, $bgcolor2, $db, $prefix, $sitename;
	include_once("header.php");
	GraphicAdmin();
	global $anonymous;
	$lid = intval($lid);
	$result = $db->sql_query("SELECT cid, title, url, description, name, email, hits from " . $prefix . "_links_links where lid='$lid'");
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<div class='text-center'><span class=\"option thick\">" . _MODLINK . "</span></div><br /><br />";
	while($row = $db->sql_fetchrow($result)) {
		$cid = $row['cid'];
		$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
		$url = $row['url'];
		$description = htmlspecialchars($row['description'], ENT_QUOTES, _CHARSET);
		$name = $row['name'];
		$email = $row['email'];
		$hits = $row['hits'];
		echo '<form action="'.$admin_file.'.php" method="post">'
			."" . _LINKID . ": <span class='thick'>$lid</span><br />"
			."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\" /><br />"
			."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\" />&nbsp;[ <a href=\"$url\">Visit</a> ]<br />"
			."" . _DESCRIPTION . ":<br /><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea><br />"
			."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"50\" maxlength=\"100\" value=\"$name\" /><br />"
			."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"50\" maxlength=\"100\" value=\"$email\" /><br />"
			."" . _HITS . ": <input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\" /><br />";
		echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\" />"
			."" . _CATEGORY . ": <select name=\"cat\">";
		$result2 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
		while($row2 = $db->sql_fetchrow($result2)) {
			$cid2 = $row2['cid'];
			$ctitle2 = $row2['title'];
			$parentid2 = $row2['parentid'];
			if ($cid2==$cid) {
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\" $sel>".htmlspecialchars($ctitle2, ENT_QUOTES, _CHARSET)."</option>";
		}

		echo "</select>"
		."<input type=\"hidden\" name=\"op\" value=\"LinksModLinkS\" />"
		."<input type=\"submit\" value=\"" . _MODIFY . "\" /> [ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelLink&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br />";
		CloseTable();
		echo "<br />";
		/* Modify or Add Editorial */
		$editorialtext = '';
		$editorialtitle = '';
		$resulted2 = $db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle from " . $prefix . "_links_editorials where linkid='$lid'");
		$recordexist = $db->sql_numrows($resulted2);
		OpenTable();
		/* if returns 'bad query' status 0 (add editorial) */
		if ($recordexist == 0) {
			echo "<div class='text-center'><span class=\"option thick\">" . _ADDEDITORIAL . "</span></div><br /><br />"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<input type=\"hidden\" name=\"linkid\" value=\"$lid\" />"
			."" . _EDITORIALTITLE . ":<br /><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\" /><br />"
			."" . _EDITORIALTEXT . ":<br /><textarea name=\"editorialtext\" cols=\"60\" rows=\"10\">$editorialtext</textarea><br />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksAddEditorial\" /><input type=\"submit\" value=\"Add\" /></form>";
		} else {
			/* if returns 'cool' then status 1 (modify editorial) */
			while($row3 = $db->sql_fetchrow($resulted2)) {
				$adminid = $row3['adminid'];
				//$editorialtimestamp = $row3['editorialtimestamp'];
				$editorialtext = htmlspecialchars($row3['editorialtext'], ENT_QUOTES, _CHARSET);
				$editorialtitle = htmlspecialchars($row3['editorialtitle'], ENT_QUOTES, _CHARSET);
				/*preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $editorialtimestamp, $editorialtime);
				$editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
				$date_array = explode("-", $editorialtime);
				$timestamp = mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]);
				$formatted_date = substr(date("F j, Y", $timestamp);  */
				echo "<div class='text-center'><span class=\"option thick\">Modify Editorial</span></div><br /><br />"
					."<form action=\"".$admin_file.".php\" method=\"post\">"
					."" . _AUTHOR . ": $adminid<br />"
					."" . _DATEWRITTEN . ": " . substr($row3['editorialtimestamp'],0,10) . "<br /><br />"
					."<input type=\"hidden\" name=\"linkid\" value=\"$lid\" />"
					."" . _EDITORIALTITLE . ":<br /><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\" /><br />"
					."" . _EDITORIALTEXT . ":<br /><textarea name=\"editorialtext\" cols=\"60\" rows=\"10\">$editorialtext</textarea><br />"
					."<input type=\"hidden\" name=\"op\" value=\"LinksModEditorial\" /><input type=\"submit\" value=\"" . _MODIFY . "\" /></form> [ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelEditorial&amp;linkid=$lid\">" . _DELETE . "</a> ]";
			}
		}
		CloseTable();
		echo "<br />";
		OpenTable();
		/* Show Comments */
		$result4 = $db->sql_query("SELECT ratingdbid, ratinguser, ratingcomments, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
		$totalcomments = $db->sql_numrows($result4);
		echo '<table width="100%">';
		echo "<tr><td colspan=\"7\"><span class='thick'>Link Comments (total comments: $totalcomments)</span><br /><br /></td></tr>";
		echo "<tr><td width=\"20\" colspan=\"1\"><span class='thick'>User  </span></td><td colspan=\"5\"><span class='thick'>Comment  </span></td><td class='text-center'><span class='thick'>Delete</span></td></tr>";
		if ($totalcomments == 0) echo "<tr><td colspan=\"7\" class='text-center'><span style='color: #cccccc;'>No Comments<br /></span></td></tr>";
		$x = 0;
		$colorswitch = $bgcolor1;
		while($row4 = $db->sql_fetchrow($result4)) {
			$ratingdbid = $row4['ratingdbid'];
			$ratinguser = $row4['ratinguser'];
			$ratingcomments = $row4['ratingcomments'];
			$ratingtimestamp = $row4['ratingtimestamp'];
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
				$formatted_date = date('F j, Y', $timestamp);
				echo '<tr><td valign="top" bgcolor="' , $colorswitch , '">' , $ratinguser , '</td><td valign="top" colspan="5" bgcolor="' , $colorswitch , '">' , $ratingcomments , '</td>'
					, '<td bgcolor="' , $colorswitch , '" class="text-center"><span class="thick"><a class="rn_csrf" href="' , $admin_file , '.php?op=LinksDelComment&amp;lid=' , $lid , '&amp;rid=' , $ratingdbid , '">X</a>'
					, '</span></td></tr>';
			$x++;
			$colorswitch = ($colorswitch == $bgcolor1) ? $bgcolor2 : $bgcolor1;
		}

		// Show Registered Users Votes
		$result5 = $db->sql_query("SELECT ratingdbid, ratinguser, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser != 'outside' AND ratinguser != '$anonymous' ORDER BY ratingtimestamp DESC");
		$totalvotes = $db->sql_numrows($result5);
		echo "<tr><td colspan=\"7\"><br /><br /><span class='thick'>Registered User Votes (total votes: $totalvotes)</span><br /><br /></td></tr>";
		echo "<tr><td><span class='thick'>User  </span></td><td><span class='thick'>IP Address  </span></td><td><span class='thick'>Rating  </span></td><td><span class='thick'>User AVG Rating  </span></td><td><span class='thick'>Total Ratings  </span></td><td><span class='thick'>Date  </span></td><td class='text-center'><span class='thick'>Delete</span></td></tr>";
		if ($totalvotes == 0) echo "<tr><td colspan=\"7\" class='text-center'><span style='color: #cccccc;'>No Registered User Votes</span><br /></td></tr>";
		$x = 0;
		$colorswitch = $bgcolor1;
		while($row5 = $db->sql_fetchrow($result5)) {
			$ratingdbid = $row5['ratingdbid'];
			$ratinguser = $row5['ratinguser'];
			$rating = $row5['rating'];
			$ratinghostname = $row5['ratinghostname'];
			$ratingtimestamp = $row5['ratingtimestamp'];
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
			$formatted_date = date("F j, Y", $timestamp);

			//Individual user information
			$result6 = $db->sql_query("SELECT rating FROM " . $prefix . "_links_votedata WHERE ratinguser = '$ratinguser'");
			$usertotalcomments = $db->sql_numrows($result6);
			$useravgrating = 0;
			//while($row6 = $db->sql_fetchrow($result6)) $useravgrating = $useravgrating + $rating2;
			// 1/1/07 fkelly ... this logic above appears to me to be screwed up
			// i think he wants to accumulate the ratings from the table then divide them by
			// the numrows after the while loop ends
			// of course no braces on the while so its hard to tell the intent; i'll guess
			while($row6 = $db->sql_fetchrow($result6)){
				$useravgrating = $useravgrating + $row6['rating'];
			}
			$useravgrating = $useravgrating / $usertotalcomments;
			$useravgrating = number_format($useravgrating, 1);
			echo '<tr><td bgcolor="' , $colorswitch , '">' , $ratinguser , '</td><td bgcolor="' , $colorswitch , '">' , $ratinghostname , '</td><td bgcolor="' , $colorswitch , '">' , $rating , '</td>'
				, '<td bgcolor="' , $colorswitch . '">' , $useravgrating , '</td><td bgcolor="' , $colorswitch . '">' , $usertotalcomments , '</td><td bgcolor="' , $colorswitch , '">' , $formatted_date , '  </td>'
				, '<td bgcolor="' , $colorswitch , '" class="text-center"><span class="thick"><a class="rn_csrf" href="' , $admin_file , '.php?op=LinksDelVote&amp;lid=' , $lid , '&amp;rid=' , $ratingdbid , '">X</a></span></td></tr>';
			$x++;
			$colorswitch = ($colorswitch == $bgcolor1) ?  $bgcolor2 : $bgcolor1;
		}

		// Show Unregistered Users Votes
		$result7 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser = '$anonymous' ORDER BY ratingtimestamp DESC");
		$totalvotes = $db->sql_numrows($result7);
		echo "<tr><td colspan=\"7\"><span class='thick'><br /><br />Unregistered User Votes (total votes: $totalvotes)</span><br /><br /></td></tr>";
		echo "<tr><td colspan=\"2\"><span class='thick'>IP Address  </span></td><td colspan=\"3\"><span class='thick'>Rating  </span></td><td><span class='thick'>Date  </span></td><td class='text-center'><span class='thick'>Delete</span></td></tr>";
		if ($totalvotes == 0) echo "<tr><td colspan=\"7\" class='text-center'><span style='color: #cccccc;'>No Unregistered User Votes</span><br /></td></tr>";
		$x=0;
		$colorswitch="$bgcolor1";
		while($row7 = $db->sql_fetchrow($result7)) {
			$ratingdbid = $row7['ratingdbid'];
			$rating = $row7['rating'];
			$ratinghostname = $row7['ratinghostname'];
			$ratingtimestamp = $row7['ratingtimestamp'];
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
			$formatted_date = date('F j, Y', $timestamp);
			echo '<td colspan="2" bgcolor="' , $colorswitch , '">' , $ratinghostname , '</td><td colspan="3" bgcolor="' , $colorswitch , '">' , $rating , '</td>'
				, '<td bgcolor="' , $colorswitch , '">' , $formatted_date , '  </td><td bgcolor="' , $colorswitch , '" class="text-center"><span class="thick">'
				, '<a class="rn_csrf" href="' , $admin_file , '.php?op=LinksDelVote&amp;lid=' , $lid , '&amp;rid=' , $ratingdbid , '">X</a></span></td></tr>';
			$x++;
			$colorswitch = ($colorswitch == $bgcolor1) ? $bgcolor2 : $bgcolor1;
		}

		// Show Outside Users Votes
		$result8 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser = 'outside' ORDER BY ratingtimestamp DESC");
		$totalvotes = $db->sql_numrows($result8);
		echo "<tr><td colspan=\"7\"><span class='thick'><br /><br />Outside User Votes (total votes: $totalvotes)</span><br /><br /></td></tr>";
		echo "<tr><td colspan=\"2\"><span class='thick'>IP Address  </span></td><td colspan=\"3\"><span class='thick'>Rating  </span></td><td><span class='thick'>Date  </span></td><td class='text-center'><span class='thick'>Delete</span></td></tr>";
		if ($totalvotes == 0) echo "<tr><td colspan=\"7\" class='text-center'><span style='color: #cccccc;'>No Votes from Outside $sitename<br /></span></td></tr>";
		$x=0;
		$colorswitch="$bgcolor1";
		while($row8 = $db->sql_fetchrow($result8)) {
			$ratingdbid = $row8['ratingdbid'];
			$rating = $row8['rating'];
			$ratinghostname = $row8['ratinghostname'];
			$ratingtimestamp = $row8['ratingtimestamp'];
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
			$formatted_date = date('F j, Y', $timestamp);
			echo '<tr><td colspan="2" bgcolor="' , $colorswitch , '">' , $ratinghostname , '</td><td colspan="3" bgcolor="' , $colorswitch , '">' , $rating , '</td><td bgcolor="' , $colorswitch , '">' , $formatted_date , '  </td>'
				, '<td bgcolor="' , $colorswitch , '" class="text-center"><span class="thick"><a class="rn_csrf" href="' , $admin_file , '.php?op=LinksDelVote&amp;lid=' , $lid , '&amp;rid=' , $ratingdbid , '">X</a>'
				, '</span></td></tr><br />';
			$x++;
			$colorswitch = ($colorswitch == $bgcolor1) ? $bgcolor2 : $bgcolor1;
		}

		echo '<tr><td colspan="6"><br /></td></tr>'
			, '</table>';
	}
	CloseTable();
	echo '<br />';
	include_once 'footer.php';
}

function LinksDelComment($lid, $rid) {
	global $admin_file, $db, $prefix;
	$rid = intval($rid);
	$lid = intval($lid);
	$db->sql_query("UPDATE " . $prefix . "_links_votedata SET ratingcomments='' WHERE ratingdbid = '$rid'");
	$db->sql_query("UPDATE " . $prefix . "_links_links SET totalcomments = (totalcomments - 1) WHERE lid = '$lid'");
	Header("Location: ".$admin_file.".php?op=LinksModLink&lid=$lid");
}

function LinksDelVote($lid, $rid) {
	global $admin_file, $db, $prefix;
	$rid = intval($rid);
	$lid = intval($lid);
	$db->sql_query("delete from " . $prefix . "_links_votedata where ratingdbid='$rid'");
	$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid'");
	$totalvotesDB = $db->sql_numrows($voteresult);
	include_once("voteinclude.php");
	$db->sql_query("UPDATE " . $prefix . "_links_links SET linkratingsummary='$finalrating', totalvotes='$totalvotesDB', totalcomments='$truecomments' WHERE lid = '$lid'");
	Header("Location: ".$admin_file.".php?op=LinksModLink&lid=$lid");
}

function LinksEditBrokenLinks($lid) {
	global $admin_file, $db, $prefix;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"option thick\">" . _EZBROKENLINKS . "</span></div><br /><br />";
	$row = $db->sql_fetchrow($db->sql_query("SELECT requestid, lid, cid, title, url, description, modifysubmitter from " . $prefix . "_links_modrequest where lid=" . $lid));
	$requestid = $row['requestid'];
	$lid = $row['lid'];
	$cid = $row['cid'];
	$title = $row['title'];
	$url = $row['url'];
	$description = $row['description'];
	$modifysubmitter = $row['modifysubmitter'];
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT name,email,hits from " . $prefix . "_links_links where lid='$lid'"));
	$name = $row2['name'];
	$email = $row2['email'];
	$hits = $row2['hits'];
	echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<span class='thick'>" . _LINKID . ": $lid</span><br /><br />"
		."" . _SUBMITTER . ":  $modifysubmitter<br />"
		."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\" /><br />"
		."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\" />&nbsp;[ <a href=\"$url\" target=\"_blank\">" . _VISIT . "</a> ]<br />"
		."" . _DESCRIPTION . ": <br /><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea><br />"
		."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\" />&nbsp;&nbsp;"
		."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\" /><br />";
	echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\" />";
	echo "<input type=\"hidden\" name=\"hits\" value=\"$hits\" />";
	echo "" . _CATEGORY . ": <select name=\"cat\">";
	$result = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
	while ($row = $db->sql_fetchrow($result)) {
		$cid2 = $row['cid'];
		$ctitle2 = $row['title'];
		$parentid2 = $row['parentid'];
		if ($cid2==$cid) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\" $sel>".htmlentities($ctitle2)."</option>";
	}
	echo "</select><input type=\"hidden\" name=\"op\" value=\"LinksModLinkS\" /><input type=\"submit\" value=\"" . _MODIFY . "\" /> [ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelNew&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br />";
	CloseTable();
	echo "<br />";
	include_once("footer.php");
}

function LinksListBrokenLinks() {
	global $admin_file, $bgcolor1, $bgcolor2, $db, $prefix, $user_prefix;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	OpenTable();
	$result = $db->sql_query("SELECT requestid, lid, modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='1' order by requestid");
	$totalbrokenlinks = $db->sql_numrows($result);
	echo "<div class='text-center'><span class=\"option thick\">" . _USERREPBROKEN . " ($totalbrokenlinks)</span></div><br /><br /><div class='text-center'>"
		."" . _IGNOREINFO . "<br />"
		."" . _DELETEINFO . "</div><br /><br /><br />"
		."<table align=\"center\" width=\"450\">";
	if ($totalbrokenlinks==0) {
			echo "<tr><td class='text-center'><span class=\"option\">" . _NOREPORTEDBROKEN . "</span><br /><br /><br /></td></tr>";
	} else {
		$colorswitch = $bgcolor2;
		echo "<tr>"
			."<td><span class='thick'>" . _LINK . "</span></td>"
			."<td><span class='thick'>" . _SUBMITTER . "</span></td>"
			."<td><span class='thick'>" . _LINKOWNER . "</span></td>"
			."<td><span class='thick'>" . _EDIT . "</span></td>"
			."<td><span class='thick'>" . _IGNORE . "</span></td>"
			."<td><span class='thick'>" . _DELETE . "</span></td>"
			."</tr>";
		while($row = $db->sql_fetchrow($result)) {
			$requestid = $row['requestid'];
			$lid = $row['lid'];
			$modifysubmitter = $row['modifysubmitter'];
			$result2 = $db->sql_query("SELECT title, url, submitter from " . $prefix . "_links_links where lid='$lid'");
			if ($modifysubmitter != '$anonymous') {
				$row3 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'"));
				$email = $row3['user_email'];
			}
			$row2 = $db->sql_fetchrow($result2);
			$title = $row2['title'];
			$url = $row2['url'];
			$owner = $row2['submitter'];
			$row4 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'"));
			$owneremail = $row4['user_email'];
			echo "<tr>"
				."<td bgcolor=\"$colorswitch\"><a href=\"$url\">$title</a>"
				."</td>";
			if (empty($email)) {
				echo "<td bgcolor=\"$colorswitch\">$modifysubmitter";
			} else {
				echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$email\">$modifysubmitter</a>";
			}
			echo "</td>";
			if (empty($owneremail)) {
				echo "<td bgcolor=\"$colorswitch\">$owner";
			} else {
				echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$owneremail\">$owner</a>";
			}
			echo "</td>"
				."<td bgcolor=\"$colorswitch\" class='text-center'><a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksEditBrokenLinks&amp;lid=$lid\">X</a>"
				."</td>"
				."<td bgcolor=\"$colorswitch\" class='text-center'><a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksIgnoreBrokenLinks&amp;lid=$lid\">X</a>"
				."</td>"
				."<td bgcolor=\"$colorswitch\" class='text-center'><a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelBrokenLinks&amp;lid=$lid\">X</a>"
				."</td>"
				."</tr>";
			if ($colorswitch == $bgcolor2) {
				$colorswitch = $bgcolor1;
			} else {
				$colorswitch = $bgcolor2;
			}
		}
	}
	echo "</table>";
	CloseTable();
	include_once("footer.php");
}

function LinksDelBrokenLinks($lid) {
	global $admin_file, $db, $prefix;
	$lid = intval($lid);
	$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
	$db->sql_query("delete from " . $prefix . "_links_links where lid='$lid'");
	Header("Location: ".$admin_file.".php?op=");
}

function LinksIgnoreBrokenLinks($lid) {
	global $admin_file, $db, $prefix;
	$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid' and brokenlink='1'");
	Header("Location: ".$admin_file.".php?op=LinksListBrokenLinks");
}

function LinksListModRequests() {
	global  $admin_file, $bgcolor2, $db, $prefix, $user_prefix;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	OpenTable();
	$result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description, modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='0' order by requestid");
	$totalmodrequests = $db->sql_numrows($result);
	echo "<div class='text-center'><span class=\"option thick\">" . _USERMODREQUEST . " ($totalmodrequests)</span></div><br /><br /><br />";
	echo "<table width=\"95%\"><tr><td>";
	while($row = $db->sql_fetchrow($result)) {
		$requestid = $row['requestid'];
		$lid = $row['lid'];
		$cid = $row['cid'];
		$sid = $row['sid'];
		$title = $row['title'];
		$url = $row['url'];
		$description = htmlspecialchars($row['description'], ENT_QUOTES, _CHARSET);
		$modifysubmitter = $row['modifysubmitter'];
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, sid, title, url, description, submitter from " . $prefix . "_links_links where lid='$lid'"));
		$origcid = $row2['cid'];
		$origsid = $row2['sid'];
		$origtitle = $row2['title'];
		$origurl = $row2['url'];
		$origdescription = htmlspecialchars($row2['description'], ENT_QUOTES, _CHARSET);
		$owner = $row2['submitter'];
		$result3 = $db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$cid'");
		$result5 = $db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$origcid'");
		$result7 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'");
		$result8 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'");
		$row3 = $db->sql_fetchrow($result3);
		$cidtitle = htmlspecialchars($row3['title'], ENT_QUOTES, _CHARSET);
		$row5 = $db->sql_fetchrow($result5);
		$origcidtitle = htmlspecialchars($row5['title'], ENT_QUOTES, _CHARSET);
		$row7 = $db->sql_fetchrow($result7);
		$modifysubmitteremail = $row7['user_email'];
		$row8 = $db->sql_fetchrow($result8);
		$owneremail = $row8['user_email'];
		if (empty($owner)) {
		$owner="administration";
		}
		if (empty($origsidtitle)) {
			$origsidtitle= "-----";
		}
		if (empty($sidtitle)) {
			$sidtitle= "-----";
		}
		echo "<table style='border-color: black;' border=\"1\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\" width=\"450\">"
			."<tr>"
			."<td>"
			."<table width=\"100%\" bgcolor=\"$bgcolor2\">"
			."<tr>"
			."<td valign=\"top\" width=\"45%\"><span class='thick'>" . _ORIGINAL . "</span></td>"
			."<td rowspan=\"5\" valign=\"top\" align=\"left\"><span class=\"tiny\"><br />" . _DESCRIPTION . ":<br />$origdescription</span></td>"
			."</tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _TITLE . ": $origtitle</span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _URL . ": <a href=\"$origurl\">$origurl</a></span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _CATEGORY . ": $origcidtitle</span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _SUBCATEGORY . ": $origsidtitle</span></td></tr>"
			."</table>"
			."</td>"
			."</tr>"
			."<tr>"
			."<td>"
			."<table width=\"100%\">"
			."<tr>"
			."<td valign=\"top\" width=\"45%\"><span class='thick'>" . _PROPOSED . "</span></td>"
			."<td rowspan=\"5\" valign=\"top\" align=\"left\"><span class=\"tiny\"><br />" . _DESCRIPTION . ":<br />$description</span></td>"
			."</tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _TITLE . ": $title</span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _URL . ": <a href=\"$url\">$url</a></span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _CATEGORY . ": $cidtitle</span></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><span class=\"tiny\">" . _SUBCATEGORY . ": $sidtitle</span></td></tr>"
			."</table>"
			."</td>"
			."</tr>"
			."</table>"
			."<table align=\"center\" width=\"450\">"
			."<tr>";
		if (empty($modifysubmitteremail)) {
			echo "<td align=\"left\"><span class=\"tiny\">" . _SUBMITTER . ":  $modifysubmitter</span></td>";
		} else {
			echo "<td align=\"left\"><span class=\"tiny\">" . _SUBMITTER . ":  <a href=\"mailto:$modifysubmitteremail\">$modifysubmitter</a></span></td>";
		}
		if (empty($owneremail)) {
			echo "<td align=\"center\"><span class=\"tiny\">" . _OWNER . ":  $owner</span></td>";
		} else {
			echo "<td align=\"center\"><span class=\"tiny\">" . _OWNER . ": <a href=\"mailto:$owneremail\">$owner</a></span></td>";
		}
		echo "<td align=\"right\"><span class=\"tiny\">( <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksChangeModRequests&amp;requestid=$requestid\">" . _ACCEPT . "</a> / <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksChangeIgnoreRequests&amp;requestid=$requestid\">" . _IGNORE . "</a> )</span></td></tr></table>";
	}
	if ($totalmodrequests == 0) {
		echo "<div class='text-center'>" . _NOMODREQUESTS . "</div><br /><br />";
	}
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function LinksChangeModRequests($requestid) {
	global $admin_file, $db, $prefix;
	$requestid = intval($requestid);
	$result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description from " . $prefix . "_links_modrequest where requestid='$requestid'");
	while ($row = $db->sql_fetchrow($result)) {
		$requestid = $row['requestid'];
		$lid = $row['lid'];
		$cid = $row['cid'];
		$sid = $row['sid'];
		$title = $row['title'];
		$url = $row['url'];
		$description = $row['description'];
		$db->sql_query("UPDATE " . $prefix . "_links_links SET cid='$cid', sid='$sid', title='$title', url='$url', description='$description' WHERE lid = '$lid'");
	}
	$db->sql_query("delete from " . $prefix . "_links_modrequest where requestid='$requestid'");
	Header("Location: ".$admin_file.".php?op=LinksListModRequests");
}

function LinksChangeIgnoreRequests($requestid) {
	global $admin_file, $db, $prefix;
	$requestid = intval($requestid);
	$db->sql_query("delete from " . $prefix . "_links_modrequest where requestid='$requestid'");
	Header("Location: ".$admin_file.".php?op=LinksListModRequests");
}

function LinksCleanVotes() {
	global $admin_file, $db, $module_name, $prefix;
	$result = $db->sql_query("SELECT distinct ratinglid FROM " .$prefix  . "_links_votedata");
	while ($row = $db->sql_fetchrow($result)) {
		$lid = $row['ratinglid'];
		$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid'");
		$totalvotesDB = $db->sql_numrows($voteresult);
		include_once NUKE_MODULES_DIR . $module_name . '/voteinclude.php';
		$db->sql_query("UPDATE " . $prefix . "_links_links SET linkratingsummary='$finalrating', totalvotes='$totalvotesDB', totalcomments='$truecomments' WHERE lid = '$lid'");
	}
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksModLinkS($lid, $title, $url, $description, $name, $email, $hits, $cat) {
	global $admin_file, $db, $prefix;
	$cat = explode("-", $cat);
	if (empty($cat[1])) {
		$cat[1] = 0;
	}
	$title = addslashes(check_html($title, 'nohtml'));
	$url = addslashes(check_html($url, 'nohtml'));
	$description = addslashes(check_html($description, 'nohtml'));
	$name = addslashes(check_html($name, 'nohtml'));
	$email = addslashes(check_html($email, 'nohtml'));
	$db->sql_query("update " . $prefix . "_links_links set cid='$cat[0]', sid='$cat[1]', title='$title', url='$url', description='$description', name='$name', email='$email', hits='$hits' where lid='$lid'");
	// Has the link been submitted for modification? we edited it so let's remove it from the modrequest table
	$sql = "SELECT * FROM " . $prefix . "_links_modrequest where lid='$lid'";
	$result = $db->sql_query($sql);
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
	}
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksDelLink($lid) {
	global $admin_file, $db, $prefix;
	$lid = intval($lid);
	$db->sql_query("delete from " . $prefix . "_links_links where lid='$lid'");
	// Has the link been submitted for modification? we deleted it so let's remove it from the modrequest table
	$sql = "SELECT * FROM " . $prefix . "_links_modrequest where lid='$lid'";
	$result = $db->sql_query($sql);
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
	}
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksModCat($cat) {
	global $prefix, $db, $admin_file;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	$cat = explode("-", $cat);
	if (empty($cat[1])) {
		$cat[1] = 0;
	}
	OpenTable();
	echo "<div class='text-center'><span class=\"option thick\">" . _MODCATEGORY . "</span></div><br /><br />";
	if ($cat[1]==0) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT title, cdescription from " . $prefix . "_links_categories where cid='$cat[0]'"));
		$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
		$cdescription = htmlspecialchars($row['cdescription'], ENT_QUOTES, _CHARSET);
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
			."" . _NAME . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"51\" maxlength=\"50\" /><br />"
			."" . _DESCRIPTION . ":<br /><textarea name=\"cdescription\" cols=\"60\" rows=\"10\">$cdescription</textarea><br />"
			."<input type=\"hidden\" name=\"sub\" value=\"0\" />"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCatS\" />"
			."<input type=\"submit\" value=\"" . _SAVECHANGES . "\" />"
			."</form>"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<input type=\"hidden\" name=\"sub\" value=\"0\" />"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksDelCat\" />"
			."<input type=\"submit\" value=\"" . _DELETE . "\" /></form>";
	} else {
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$cat[0]'"));
		$ctitle = $row2['title'];
		$row3 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_links_subcategories where sid='$cat[1]'"));
		$stitle = $row3['title'];
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
			."" . _CATEGORY . ": $ctitle<br />"
			."" . _SUBCATEGORY . ": <input type=\"text\" name=\"title\" value=\"$stitle\" size=\"51\" maxlength=\"50\" /><br />"
			."<input type=\"hidden\" name=\"sub\" value=\"1\" />"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />"
			."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\" />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCatS\" />"
			."<input type=\"submit\" value=\"" . _SAVECHANGES . "\" />"
			."</form>"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<input type=\"hidden\" name=\"sub\" value=\"1\" />"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />"
			."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\" />"
			."<input type=\"hidden\" name=\"op\" value=\"LinksDelCat\" />"
			."<input type=\"submit\" value=\"" . _DELETE . "\" /></form>";
	}
	CloseTable();
	include_once("footer.php");
}

function LinksModCatS($cid, $sid, $sub, $title, $cdescription) {
	global $admin_file, $db, $prefix;
	$cid = intval($cid);
	if ($sub==0) {
		$db->sql_query("update " . $prefix . "_links_categories set title='$title', cdescription='$cdescription' where cid='$cid'");
	} else {
		$db->sql_query("update " . $prefix . "_links_subcategories set title='$title' where sid='$sid'");
	}
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksDelCat($cid, $sid, $sub, $ok=0) {
	global $prefix, $db, $admin_file;
	include_once('header.php');
	$cid = intval($cid);
	if($ok==1) {
		csrf_check();
		if ($sub>0) {
			$db->sql_query('delete from ' . $prefix . '_links_categories where cid=\''.$cid.'\'');
			$db->sql_query('delete from ' . $prefix . '_links_links where cid=\''.$cid.'\'');
		} else {
			$db->sql_query('delete from ' . $prefix . '_links_links where cid=\''.$cid.'\'');
			// suppression des liens de catgories filles
			$result2 = $db->sql_query('SELECT cid from ' . $prefix . '_links_categories where parentid=\''.$cid.'\'');
			while ($row2 = $db->sql_fetchrow($result2)) {
				$cid2 = $row2['cid'];
				$db->sql_query('delete from ' . $prefix . '_links_links where cid=\''.$cid2.'\'');
			}
			$db->sql_query('delete from ' . $prefix . '_links_categories where parentid=\''.$cid.'\'');
			$db->sql_query('delete from ' . $prefix . '_links_categories where cid=\''.$cid.'\'');
		}
		Header('Location: '.$admin_file.'.php?op=Links');
	} else {
		$result = $db->sql_query('SELECT * from ' . $prefix . '_links_categories where parentid=\''.$cid.'\'');
		$nbsubcat = $db->sql_numrows($result);
		$result3 = $db->sql_query('SELECT cid from ' . $prefix . '_links_categories where parentid=\''.$cid.'\'');
		$nblink = 0;
		while ($row3 = $db->sql_fetchrow($result3)) {
			$cid2 = $row3['cid'];
			$result4 = $db->sql_query('SELECT * from ' . $prefix . '_links_links where cid=\''.$cid2.'\'');
			$nblink += $db->sql_numrows($result4);
		}
		GraphicAdmin();
		OpenTable();
		echo '<br /><div><span class="option">';
		echo '<span class="thick">' . _EZTHEREIS . ' '.$nbsubcat.' ' . _EZSUBCAT . ' ' . _EZATTACHEDTOCAT . '</span><br />';
		echo '<span class="thick">' . _EZTHEREIS . ' '.$nblink.' ' . _LINK . ' ' . _EZATTACHEDTOCAT . '</span><br />';
		echo '<span class="thick">' . _DELEZLINKCATWARNING . '</span><br /><br />';
	}
	echo '[ <a class="rn_csrf" href="'.$admin_file.'.php?op=LinksDelCat&amp;cid='.$cid.'&amp;sid='.$sid.'&amp;sub='.$sub.'&amp;ok=1">' . _YES . '</a> | <a href="'.$admin_file.'.php?op=Links">' . _NO . '</a> ]</span></div><br /><br />';
	CloseTable();
	include_once('footer.php');
}

function LinksDelNew($lid) {
	global $admin_file, $db, $prefix;
	$lid = intval($lid);
	$db->sql_query("delete from " . $prefix . "_links_newlink where lid='$lid'");
	Header("Location: ".$admin_file.".php?op=Links");
}

function LinksAddCat($title, $cdescription) {
	global $admin_file, $db, $prefix;
	$parentid=0;
	$result = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where title='$title'");
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
	include_once("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<br /><div class='text-center'><span class=\"option\">"
			."<span class='thick'>" . _ERRORTHECATEGORY . " $title " . _ALREADYEXIST . "</span><br /><br />"
			."" . _GOBACK . "<br /><br /></span></div>";
		CloseTable();
		include_once("footer.php");
	} else {
		$db->sql_query("insert into " . $prefix . "_links_categories values (NULL, '$title', '$cdescription', '$parentid')");
		Header("Location: ".$admin_file.".php?op=Links");
	}
}

function LinksAddSubCat($cid, $title, $cdescription) {
	global $admin_file, $db, $prefix;
	$cid = intval($cid);
	$result = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where title='$title' AND cid='$cid'");
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
		include_once("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<br /><div class='text-center'>";
		echo "<span class=\"option\">"
			."<span class='thick'>" . _ERRORTHESUBCATEGORY . " $title " . _ALREADYEXIST . "</span><br /><br />"
			."" . _GOBACK . "<br /><br /></span></div>";
		include_once("footer.php");
	} else {
		$db->sql_query("insert into " . $prefix . "_links_categories values (NULL, '$title', '$cdescription', '$cid')");
		Header("Location: ".$admin_file.".php?op=Links");
	}
}

function LinksAddEditorial($linkid, $editorialtitle, $editorialtext) {
	global $aid, $prefix, $db, $admin_file;
	$editorialtext = addslashes(check_html($editorialtext, 'nohtml'));
	$db->sql_query("insert into " . $prefix . "_links_editorials values ('$linkid', '$aid', now(), '$editorialtext', '$editorialtitle')");
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><br />"
		."<span class='option'>"
		."" . _EDITORIALADDED . "<br /><br />"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]</span></div>";
	CloseTable();
	include_once("footer.php");
}

function LinksModEditorial($linkid, $editorialtitle, $editorialtext) {
	global $admin_file, $db, $prefix;
	$linkid = intval($linkid);
	$editorialtext = addslashes(check_html($editorialtext, 'nohtml'));
	$db->sql_query("update " . $prefix . "_links_editorials set editorialtext='$editorialtext', editorialtitle='$editorialtitle' where linkid='$linkid'");
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<br /><div class='text-center'>"
		."<span class=\"option\">"
		."" . _EDITORIALMODIFIED . "<br /><br />"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]<br /><br /></span></div>";
	CloseTable();
	include_once("footer.php");
}

function LinksDelEditorial($linkid) {
	global $admin_file, $db, $prefix;
	$linkid = intval($linkid);
	$db->sql_query("delete from " . $prefix . "_links_editorials where linkid='$linkid'");
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<br /><div class='text-center'>"
		."<span class=\"option\">"
		."" . _EDITORIALREMOVED . "<br /><br />"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]<br /><br /></span></div>";
	CloseTable();
	include_once("footer.php");
}

function LinksLinkCheck() {
	global $prefix, $db, $admin_file;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<div class='text-center'><span class=\"option thick\">" . _LINKVALIDATION . "</span></div><br />"
		."<table width=\"100%\" align=\"center\"><tr><td colspan=\"2\" align=\"center\">"
		."<a href=\"".$admin_file.".php?op=LinksValidate&amp;cid=0&amp;sid=0\">" . _CHECKALLLINKS . "</a><br /><br /></td></tr>"
		."<tr><td valign=\"top\" class='text-center'><span class='thick'>" . _CHECKCATEGORIES . "</span><br />" . _INCLUDESUBCATEGORIES . "<br /><br />";
	$result = $db->sql_query("SELECT cid, title from " . $prefix . "_links_categories order by title");
	while ($row = $db->sql_fetchrow($result)) {
		$cid = $row['cid'];
		$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
		$transfertitle = str_replace (" ", "_", $title);
		echo "<span class=\"tiny\"><a href=\"".$admin_file.".php?op=LinksValidate&amp;cid=$cid&amp;sid=0&amp;ttitle=$transfertitle\">$title</a></span><br />";
	}
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function LinksValidate($cid, $sid, $ttitle) {
	global $admin_file ,$bgcolor2, $db, $prefix;
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
	CloseTable();
	echo "<br />";
	OpenTable();
	$transfertitle = str_replace ("_", "", $ttitle);
	/* Check ALL Links */
	echo '<table width="100%" border="0">';
	if ($cid==0 && $sid==0) {
		echo "<tr><td colspan=\"3\" class='text-center'><span class='thick'>" . _CHECKALLLINKS . "</span><br />" . _BEPATIENT . "<br /><br /></td></tr>";
		$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links order by title");
	}
	/* Check Categories & Subcategories */
	if ($cid!=0 && $sid==0) {
		echo "<tr><td colspan=\"3\" class='text-center'><span class='thick'>" . _VALIDATINGCAT . ": $transfertitle</span><br />" . _BEPATIENT . "<br /><br /></td></tr>";
		$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links where cid='$cid' order by title");
	}
	/* Check Only Subcategory */
	if ($cid==0 && $sid!=0) {
		echo "<tr><td colspan=\"3\" class='text-center'><span class='thick'>" . _VALIDATINGSUBCAT . ": $transfertitle</span><br />" . _BEPATIENT . "<br /><br /></td></tr>";
		$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links where sid='$sid' order by title");
	}
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\" width=\"100\"><span class='thick'>" . _STATUS . "</span></td><td bgcolor=\"$bgcolor2\"><span class='thick'>" . _LINKTITLE . "</span></td><td bgcolor=\"$bgcolor2\" align=\"center\" width=\"150\"><span class='thick'>" . _FUNCTIONS . "</span></td></tr>";
	while($row = $db->sql_fetchrow($result)) {
		$lid = $row['lid'];
		$title = htmlspecialchars($row['title'], ENT_QUOTES, _CHARSET);
		$url = $row['url'];
		$vurl = parse_url($row['url']);
		if (!@fsockopen($vurl['host'], 80, $errno, $errstr, 15)) {
			echo "<tr><td align=\"center\"><span class='thick'>&nbsp;&nbsp;" . _FAILED . "&nbsp;&nbsp;</span></td>"
				."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
				."<td align=\"center\"><span class=\"content\">&nbsp;&nbsp;[ <a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">" . _EDIT . "</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=LinksDelLink&amp;lid=$lid\">" . _DELETE . "</a> ]&nbsp;&nbsp;</span>"
				."</td></tr>";
		} else {
			echo "<tr><td align=\"center\">&nbsp;&nbsp;" . _OK . "&nbsp;&nbsp;</td>"
				."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
				."<td align=\"center\"><span class=\"content\">&nbsp;&nbsp;" . _NONE . "&nbsp;&nbsp;</span>"
				."</td></tr>";
		}
	}
	echo "</table>";
	CloseTable();
	include_once("footer.php");
}

function LinksAddLink($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter) {
	global $admin_file, $adminmail, $db, $nukeurl, $prefix, $sitename;
	$result = $db->sql_query("SELECT url from " . $prefix . "_links_links where url='$url'");
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
		include_once("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<div class='text-center'><span class='title thick'>" . _WEBLINKSADMIN . "</span></div>";
		CloseTable();
		echo "<br />";
		OpenTable();
		echo "<br /><div class='text-center'>"
			."<span class=\"option\">"
			."<span class='thick'>" . _ERRORURLEXIST . "</span><br /><br />"
			."" . _GOBACK . "<br /><br /></span></div>";
		CloseTable();
		include_once("footer.php");
	} else {
		/* Check if Title exist */
		if (empty($title)) {
			include_once("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
			CloseTable();
			echo "<br />";
			OpenTable();
			echo "<br /><div class='text-center'>"
				."<span class=\"option\">"
				."<span class='thick'>" . _ERRORNOTITLE . "</span><br /><br />"
				."" . _GOBACK . "<br /><br /></span></div>";
			CloseTable();
			include_once("footer.php");
		}
		/* Check if URL exist */
		if (empty($url)) {
			include_once("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
			CloseTable();
			echo "<br />";
			OpenTable();
			echo "<br /><div class='text-center'>"
				."<span class=\"option\">"
				."<span class='thick'>" . _ERRORNOURL . "</span><br /><br />"
				."" . _GOBACK . "<br /><br /></span></div>";
			CloseTable();
			include_once("footer.php");
		}
		// Check if Description exist
		if (empty($description)) {
			include_once("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<div class='text-center'><span class=\"title thick\">" . _WEBLINKSADMIN . "</span></div>";
			CloseTable();
			echo "<br />";
			OpenTable();
			echo "<br /><div class='text-center'>"
				."<span class=\"option\">"
				."<span class='thick'>" . _ERRORNODESCRIPTION . "</span><br /><br />"
				."" . _GOBACK . "<br /><br /></span></div>";
			CloseTable();
			include_once("footer.php");
		}
		$cat = explode("-", $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		$title = addslashes(check_html($title, 'nohtml'));
		$url = addslashes(check_html($url, 'nohtml'));
		$description = addslashes(check_html($description, 'nohtml'));
		$name = addslashes(check_html($name, 'nohtml'));
		$email = addslashes(check_html($email, 'nohtml'));
		$db->sql_query("insert into " . $prefix . "_links_links values (NULL, '$cat[0]', '$cat[1]', '$title', '$url', '$description', now(), '$name', '$email', '0', '$submitter', '0', '0', '0')");
		global $nukeurl, $sitename;
		include_once("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<br /><div class='text-center'>";
		echo "<span class=\"option\">";
		echo "" . _NEWLINKADDED . "<br /><br />";
		echo "[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]</span></div><br /><br />";
		CloseTable();
		if ($new==1) {
			$db->sql_query("delete from " . $prefix . "_links_newlink where lid='$lid'");
			if ($email) {
				$subject = "" . _YOURLINKAT . " $sitename";
				$message = "" . _HELLO . " $name:\n\n" . _LINKAPPROVEDMSG . "\n\n" . _LINKTITLE . ": $title\n" . _URL . ": $url\n" . _DESCRIPTION . ": $description\n\n\n" . _YOUCANBROWSEUS . " $nukeurl/modules.php?name=Web_Links\n\n" . _THANKS4YOURSUBMISSION . "\n\n$sitename " . _TEAM . "";
				$from = "$sitename<$adminmail>";
				/*
				 * TegoNuke Mailer added by montego for 2.20.00
				 */
				$mailsuccess = false;
				if (TNML_IS_ACTIVE) {
					$to = array(array($email, $name));
					$mailsuccess = tnml_fMailer($to, $subject, $message, $adminmail, $sitename);
				} else {
					$mailsuccess = mail($email, $subject, $message, "From: $from\r\nX-Mailer: PHP/" . phpversion());
				}
				/*
				 * end of TegoNuke Mailer add
				 */
			}
		}
		include_once("footer.php");
	}
}

?>