<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

global $prefix, $db, $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

if (is_mod_admin($module_name)) {
	if (!isset($ok)) $ok = '';
	if (!isset($active)) $active = '';
	if (!isset($name)) $name = '';
	$c_num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner_clients'));
	if ($c_num == 0) {
		$cli = '<span class="italic">' . _ADDNEWBANNER . '</span>';
	} else {
		$cli = '<a href="' . $admin_file . '.php?op=add_banner">' . _ADDNEWBANNER . '</a>';
	}
	$act = $db->sql_fetchrow($db->sql_query('SELECT active FROM ' . $prefix . '_modules WHERE title=\'Advertising\''));
	if ($act['active'] == 0) {
		$act = '<br /><div style="text-align: center;">' . _ADSMODULEINACTIVE . '</div>';
	} else {
		$act = '';
	}
	$ad_admin_menu_main = '<div class="text-center title"><span class="thick">' . _ADVERTISINGADMIN . '</span><br /><br />[ <a href="'
		. $admin_file . '.php?op=ad_positions">' . _ADPOSITIONS . '</a> - ' . $cli . ' - <a href="'
		. $admin_file . '.php?op=add_client">' . _ADDCLIENT . '</a> - <a class="rn_csrf" href="'
		. $admin_file . '.php?op=ad_terms">' . _TERMS . '</a> - <a href="'
		. $admin_file . '.php?op=ad_plans">' . _PLANSPRICES . '</a> ]</div>' . $act;
	$ad_admin_menu = '<div class="text-center title"><span class="thick">' . _ADVERTISINGADMIN . '</span><br /><br />[ <a href="'
		. $admin_file . '.php?op=AdvertisingAdmin">' . _ADVERTISING . '</a> - <a href="'
		. $admin_file . '.php?op=ad_positions">' . _ADPOSITIONS . '</a> - ' . $cli . ' - <a href="'
		. $admin_file . '.php?op=add_client">' . _ADDCLIENT . '</a> - <a class="rn_csrf" href="'
		. $admin_file . '.php?op=ad_terms">' . _TERMS . '</a> - <a href="'
		. $admin_file . '.php?op=ad_plans">' . _PLANSPRICES . '</a> ]</div>' . $act;
	switch ($op) {
		case 'AdvertisingAdmin':
			AdvertisingAdmin();
			break;
		case 'BannersAdd':
			csrf_check();
			BannersAdd($name, $cid, $adname, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height);
			break;
		case 'BannerAddClient':
			csrf_check();
			BannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo);
			break;
		case 'BannerDelete':
			csrf_check();
			BannerDelete($bid, $ok);
			break;
		case 'BannerEdit':
			BannerEdit($bid);
			break;
		case 'BannerChange':
			csrf_check();
			BannerChange($bid, $cid, $adname, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade);
			break;
		case 'BannerClientDelete':
			csrf_check();
			BannerClientDelete($cid, $ok);
			break;
		case 'BannerClientEdit':
			BannerClientEdit($cid);
			break;
		case 'BannerClientChange':
			csrf_check();
			BannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd);
			break;
		case 'BannerStatus':
			csrf_check();
			BannerStatus($bid, $status);
			break;
		case 'add_banner':
			add_banner();
			break;
		case 'add_client':
			add_client();
			break;
		case 'ad_positions':
			ad_positions();
			break;
		case 'position_save':
			csrf_check();
			position_save($apid, $ad_position_number, $ad_position_name, $position_new);
			break;
		case 'position_edit':
			position_edit($apid);
			break;
		case 'position_delete':
			csrf_check();
			if (!isset($new_pos)) $new_pos = '';
			position_delete($apid, $ok, $active, $new_pos);
			break;
		case 'ad_terms':
			csrf_check();
			if (!isset($save)) $save = '';
			if (!isset($terms_body)) $terms_body = '';
			if (!isset($country)) $country = '';
			ad_terms($save, $terms_body, $country);
			break;
		case 'ad_plans':
			ad_plans();
			break;
		case 'ad_plans_add':
			csrf_check();
			ad_plans_add($name, $description, $delivery, $type, $price, $buy_links, $status);
			break;
		case 'ad_plans_edit':
			ad_plans_edit($pid);
			break;
		case 'ad_plans_save':
			csrf_check();
			ad_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $status);
			break;
		case 'ad_plans_delete':
			csrf_check();
			ad_plans_delete($pid, $ok);
			break;
		case 'ad_plans_status':
			csrf_check();
			ad_plans_status($pid, $status);
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/*********************************************************/
/* Banners Administration Functions                      */
/*********************************************************/
function AdvertisingAdmin() {
	global $prefix, $db, $bgcolor2, $banners, $admin_file, $ad_admin_menu_main, $bgcolor1;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu_main;
	CloseTable();
	echo '<br />';
	/* Banners List */
	echo '<a name="top"></a>';
	OpenTable();
	echo '<div style="text-align: center;" class="option">' . _ACTIVEBANNERS . '</div><br />'
		. '<table width="100%" border="1" cellpadding="3"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _BANNERNAME . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLIENT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPRESSIONS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPLEFT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKSPERCENT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _POSITION . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLASS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _FUNCTIONS . '</td></tr>';
	$result = $db->sql_query('SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class FROM ' . $prefix . '_banner WHERE active=\'1\' ORDER BY position,bid');
	while ($row = $db->sql_fetchrow($result)) {
		$bid = $row['bid'];
		$cid = $row['cid'];
		$imptotal = $row['imptotal'];
		$impmade = $row['impmade'];
		$clicks = $row['clicks'];
		$imageurl = $row['imageurl'];
		$type = $row['position'];
		$active = $row['active'];
		$bannername = $row['name'];
		$ad_class = $row['ad_class'];
		if ($bannername == '') {
			$bannername = _NONE;
		}
			else {
			if ($ad_class == 'image') {
				$bannername = '<a href="' . $imageurl . '" target="_blank">' . $bannername . '</a>';
			}
		}
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
		$clientname = $row2['name'];
		if ($clientname == '') {
			$clientname = _NONE;
		}
		if ($ad_class == '') {
			$ad_class = 'image';
		}
		if ($impmade == 0) {
			$percent = 0;
		} else {
			$percent = substr(100*$clicks/$impmade, 0, 5);
		}
		if ($imptotal == 0) {
			$left = _UNLIMITED;
		} else {
			$left = $imptotal-$impmade;
		}
		$percent = $percent . '%';
		if ($ad_class == 'code' || $ad_class == 'flash') {
			$clicks = 'N/A';
			$percent = 'N/A';
		}
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT apid, position_name FROM ' . $prefix . '_banner_positions WHERE position_number=\'' . $type . '\''));
		$type = '<a href="' . $admin_file . '.php?op=position_edit&amp;apid=' . $row2['apid'] . '">' . $row2['position_name'] . '</a>';
		if ($active == 1) {
			$t_active = '<img src="images/active.gif" alt="' . _ACTIVE . '" title="' . _ACTIVE . '" border="0" width="16" height="16" />';
			$c_active = '<img src="images/inactive.gif" alt="' . _DEACTIVATE . '" title="' . _DEACTIVATE . '" border="0" width="16" height="16" />';
		} else {
			$t_active = '<img src="images/inactive.gif" alt="' . _INACTIVE . '" title="' . _INACTIVE . '" border="0" width="16" height="16" />';
			$c_active = '<img src="images/active.gif" alt="' . _ACTIVATE . '" title="' . _ACTIVATE . '" border="0" width="16" height="16" />';
		}
		echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center">' . $bannername . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center"><a href="' . $admin_file . '.php?op=BannerClientEdit&amp;cid=' . $row['cid'] . '">' . $clientname . '</a></td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $impmade . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $left . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $clicks . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $percent . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $type . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $ad_class . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">&nbsp;<a href="' . $admin_file . '.php?op=BannerEdit&amp;bid=' . $bid . '"><img src="images/edit.gif" alt="' . _EDIT . '" title="' . _EDIT . '" border="0" width="17" height="17" /></a>  <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerStatus&amp;bid=' . $bid . '&amp;status=' . $active . '">' . $c_active . '</a>  <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerDelete&amp;bid=' . $bid . '&amp;ok=0"><img src="images/delete.gif" alt="' . _DELETE . '" title="' . _DELETE . '" border="0" width="17" height="17" /></a>&nbsp;</td></tr>';
	}
	echo '</table><br />';
	echo '<div style="text-align: center;" class="option">' . _INACTIVEBANNERS . '</div><br />'
		. '<table width="100%" border="1" cellpadding="3"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _BANNERNAME . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLIENT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPRESSIONS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPLEFT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKSPERCENT . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _POSITION . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLASS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _FUNCTIONS . '</td></tr>';
	$result = $db->sql_query('SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class FROM ' . $prefix . '_banner WHERE active=\'0\' ORDER BY position,bid');
	while ($row = $db->sql_fetchrow($result)) {
		$bid = $row['bid'];
		$cid = $row['cid'];
		$imptotal = $row['imptotal'];
		$impmade = $row['impmade'];
		$clicks = $row['clicks'];
		$imageurl = $row['imageurl'];
		$type = $row['position'];
		$active = $row['active'];
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
		$cid = $row2['cid'];
		$bannername = $row['name'];
		$ad_class = $row['ad_class'];
		if ($bannername == '') {
			$bannername = _NONE;
		} else {
			if ($ad_class == 'image') {
				$bannername = '<a href="' . $imageurl . '" target="_blank">' . $bannername . '</a>';
			}
		}
		if ($ad_class == '') {
			$ad_class = 'image';
		}
		$clientname = $row2['name'];
		if ($impmade == 0) {
			$percent = 0;
		} else {
			$percent = substr(100*$clicks/$impmade, 0, 5);
		}
		if ($imptotal == 0) {
			$left = _UNLIMITED;
		} else {
			$left = $imptotal-$impmade;
		}
		$percent = $percent . '%';
		if ($ad_class == 'code' || $ad_class == 'flash') {
			$clicks = 'N/A';
			$percent = 'N/A';
		}
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT apid, position_name FROM ' . $prefix . '_banner_positions where position_number=\'' . $type . '\''));
		$type = '<a href="' . $admin_file . '.php?op=position_edit&amp;apid=' . $row2['apid'] . '">' . $row2['position_name'] . '</a>';
		if ($active == 1) {
			$t_active = '<img src="images/active.gif" alt="' . _ACTIVE . '" title="' . _ACTIVE . '" border="0" width="16" height="16" />';
			$c_active = '<img src="images/inactive.gif" alt="' . _DEACTIVATE . '" title="' . _DEACTIVATE . '" border="0" width="16" height="16" />';
		} else {
			$t_active = '<img src="images/inactive.gif" alt="' . _INACTIVE . '" title="' . _INACTIVE . '" border="0" width="16" height="16" />';
			$c_active = '<img src="images/active.gif" alt="' . _ACTIVATE . '" title="' . _ACTIVATE . '" border="0" width="16" height="16" />';
		}
		echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center">' . $bannername . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center"><a href="' . $admin_file . '.php?op=BannerClientEdit&amp;cid=' . $row['cid'] . '">' . $clientname . '</a></td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $impmade . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $left . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $clicks . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $percent . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $type . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $ad_class . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">&nbsp;<a href="' . $admin_file . '.php?op=BannerEdit&amp;bid=' . $bid . '"><img src="images/edit.gif" alt="' . _EDIT . '" title="' . _EDIT . '" border="0" width="17" height="17" /></a>  <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerStatus&amp;bid=' . $bid . '&amp;status=' . $active . '">' . $c_active . '</a>  <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerDelete&amp;bid=' . $bid . '&amp;ok=0"><img src="images/delete.gif" alt="' . _DELETE . '" title="' . _DELETE . '" border="0" width="17" height="17" /></a>&nbsp;</td></tr>';
	}
	echo '</table>';
	CloseTable();
	echo '<br />';
	/* Clients List */
	OpenTable();
	echo '<div style="text-align: center;" class="option">' . _ADVERTISINGCLIENTS . '</div><br />'
		. '<table width="100%" border="1" cellpadding="3"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLIENTNAME . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _ACTIVEBANNERS2 . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _INACTIVEBANNERS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CONTACTNAME . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CONTACTEMAIL . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _FUNCTIONS . '</td></tr>';
	$result3 = $db->sql_query('SELECT cid, name, contact, email FROM ' . $prefix . '_banner_clients ORDER BY cid');
	while ($row3 = $db->sql_fetchrow($result3)) {
		$cid = $row3['cid'];
		$name = $row3['name'];
		$contact = $row3['contact'];
		$email = $row3['email'];
		$result4 = $db->sql_query('SELECT cid FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\' AND active=\'1\'');
		$numrows = $db->sql_numrows($result4);
		$row4 = $db->sql_fetchrow($result4);
		$rcid = $row4['cid'];
		$numrows2 = $db->sql_numrows($db->sql_query('SELECT cid FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\' AND active=\'0\''));
		echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center">' . $name . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $numrows . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $numrows2 . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $contact . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="left"><a href="mailto:' . $email . '">' . $email . '</a></td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center" nowrap="nowrap">&nbsp;<a href="' . $admin_file . '.php?op=BannerClientEdit&amp;cid=' . $cid . '"><img src="images/edit.gif" alt="' . _EDIT . '" title="' . _EDIT . '" border="0" width="17" height="17" /></a>  <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerClientDelete&amp;cid=' . $cid . '"><img src="images/delete.gif" alt="' . _DELETE . '" title="' . _DELETE . '" border="0" width="17" height="17" /></a>&nbsp;</td></tr>';
	}
	echo '</table>';
	CloseTable();
	include_once('footer.php');
}
function add_banner() {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $AllowableHTML, $advanced_editor;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	OpenTable();
	$imageurl = 'http://';
	$clickurl = 'http://';
	$alttext = '';
	$ad_width = '';
	$ad_height = '';
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner_clients');
	$numrows = $db->sql_numrows($result);
	if ($numrows > 0) {
		if (isset($_POST['ad_class'])) {
			$ad_class = $_POST['ad_class'];
			$addmsg = _ADDBANNER;
			$step2flag = TRUE;
			$opset = 'BannersAdd';
			if (isset($_POST['adname'])) {
				$adname = check_html($_POST['adname'], 'nohtml');
			}
			else {
				$adname = '';
			}
			if (isset($_POST['imptotal'])) {
				$imptotal = intval($_POST['imptotal']);
			}
			else {
				$imptotal = '0';
			}
			if (isset($_POST['imageurl'])) {
				$imageurl = check_html($_POST['imageurl'],'nohtml');
			}
			if (isset($_POST['clickurl'])) {
				$clickurl = check_html($_POST['clickurl'],'nohtml');
			}
			if (isset($_POST['ad_width'])) {
				$ad_width = intval($_POST['ad_width']);
			}
			if (isset($_POST['ad_height'])) {
				$ad_height = intval($_POST['ad_height']);
			}
			if (isset($_POST['alttext'])) {
				$alttext = check_html($_POST['alttext'],'nohtml');
			}
		}
			else {
				$addmsg = 'CONTINUE';
				$ad_class = '';
				$step2flag = FALSE;
				$imptotal = '0';
				$adname = '';
				$opset = 'add_banner';
			}
		echo '<div style="text-align:center;" class="title">' . _ADDNEWBANNER . '<br /><br />';
			if (isset($_POST['errormsg'])) {
				$errormsg = check_html($_POST['errormsg'], '');
				echo ' There were errors on your previous input:<br />  '. $errormsg . '<br /><br />';
			}
			echo '</div>';
			echo '<form action="' . $admin_file . '.php?op='.$opset. '" method="post">'
			. '<table border="0"><tr><td>'
			. _CLIENTNAME . ':</td>'
			. '<td><select name="cid">';
		$result = $db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients ORDER BY name');
		while ($row = $db->sql_fetchrow($result)) {
			$cid = intval($row['cid']);
			$name = $row['name'];
			echo '<option value="' . $cid . '">' . $name . '</option>';
		}
		echo '</select></td></tr>'
			. '<tr><td nowrap="nowrap">' . _BANNERNAME . ' : </td>'
			.'<td><input type="text" name="adname" size="12" maxlength="50" value = "'.$adname.'" />';
			echo '</td></tr><tr><td nowrap="nowrap">' . _PURCHASEDIMPRESSIONS . ':</td><td><input type="text" name="imptotal" size="12" maxlength="11" value= "'.$imptotal.'" /> 0=' . _UNLIMITED;;
			echo '</td></tr>';
			if (!$step2flag) {
				echo
			'<tr><td>' . _ADCLASS . ':</td><td><select name="ad_class">'
			. '<option value="image">' . _ADIMAGE . '</option>'
			. '<option value="code">' . _ADCODE . '</option>'
			. '<option value="flash">' . _ADFLASH . '</option>'
			. '</select></td></tr>'
			. '<tr><td>&nbsp;</td><td><span class="italic">Select One of the Three Ad Classes, then proceed to fill out the appropriate information about each class.</span></td></tr>';
			}
			else {
				echo '<tr><td>' . _ADCLASS . ' : ' . $ad_class . '<input type="hidden" name="ad_class" value = "'.$ad_class.'" /></td></tr>';
			}
			if ($step2flag) {
				if ($ad_class == 'image' || $ad_class == 'flash') {

				echo  '<tr><td>' . _IMAGESWFURL . ':</td><td><input type="text" name="imageurl" size="50" maxlength="100" value="'.$imageurl.'" /></td></tr>'
			. '<tr><td>' . _IMAGESIZE . ':</td><td>' . _WIDTH . ': <input type="text" name="ad_width" size="4" maxlength="4" value="'.$ad_width.'"/> &nbsp; ' . _HEIGHT . ': <input type="text" name="ad_height" size="4" maxlength="4" value="'.$ad_height.'" /> &nbsp; ' . _INPIXELS . '<input type="hidden" name="ad_code" value = "" /></td></tr>';
				if ($ad_class == 'image') {
					echo '<tr><td>' . _CLICKURL . '</td><td><input type="text" name="clickurl" size="50" maxlength="200" value="'.$clickurl.'" /></td></tr>'
			. '<tr><td>' . _ALTTEXT . ':</td><td><input type="text" name="alttext" size="50" maxlength="255" value="'.$alttext.'" /></td></tr>';
				}
			}
			else {
				echo '<tr><td><input type="hidden" name="imageurl" value="" /><input type="hidden" name="clickurl" value="" /><input type="hidden" name="ad_width" value="" /><input type="hidden" name="ad_height" value="" /><input type="hidden" name="alttext" value="" />' . _ADCODE . ':</td><td><div>';
					wysiwyg_textarea('ad_code', '', 'PHPNukeAdmin', 70, 12);
					echo '</div></td></tr>';
					echo '<tr><td colspan="2">'._AREYOUSURE.'</td></tr>';
					//echo '<tr><td colspan="2"> . '_ALLOWEDHTML . '</td></tr><tr><td colspan="2">';
					//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
					//echo '</td></tr>';
			}
			echo '<tr><td>' . _TYPE . ':</td><td><select name="position">';
		$result = $db->sql_query('SELECT position_number, position_name FROM ' . $prefix . '_banner_positions ORDER BY position_number');
		while ($row = $db->sql_fetchrow($result)) {
			echo '<option value="' . $row['position_number'] . '">' . $row['position_number'] . ' - ' . $row['position_name'] . '</option>';
		}
		echo '</select></td></tr><tr><td>&nbsp;</td><td>' . _POSITIONNOTE . '</td></tr>'
			. '<tr><td>' . _ACTIVATE . ':</td><td><input type="radio" name="active" value="1" checked="checked" />' . _YES . '&nbsp;&nbsp;<input type="radio" name="active" value="0" />' . _NO . '</td></tr>';
		}
		echo '<tr><td>&nbsp;</td><td><input type="hidden" name="op" value="'.$opset.'" />'
			. '<input type="submit" value="' . $addmsg . '" />'
			. '</td></tr></table></form>';
	}
	else {
		echo '<div class="text-center"><span class="title thick">' . _ADDNEWBANNER . '</span><br /><br />'
			. _ADSNOCLIENT . '<br /><br />' . _GOBACK . '</div>';
	}
	CloseTable();
	include_once('footer.php');
}
function add_client() {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $AllowableHTML, $advanced_editor;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	OpenTable();
	$cl_pass = makePass();
	echo '<div style="text-align: center;" class="title">' . _ADDCLIENT . '</div><br /><br />'
		. '<form action="' . $admin_file . '.php?op=BannerAddClient" method="post">'
		. '<table border="0" width="100%">'
		. '<tr><td>' . _CLIENTNAME . ':</td><td><input type="text" name="name" size="30" maxlength="60" /></td></tr>'
		. '<tr><td>' . _CONTACTNAME . ':</td><td><input type="text" name="contact" size="30" maxlength="60" /></td></tr>'
		. '<tr><td>' . _CONTACTEMAIL . ':</td><td><input type="text" name="email" size="30" maxlength="60" /></td></tr>'
		. '<tr><td>' . _CLIENTLOGIN . ':</td><td><input type="text" name="login" size="12" maxlength="10" /></td></tr>'
		. '<tr><td>' . _CLIENTPASSWD . ':</td><td><input type="text" name="passwd" size="12" maxlength="10" value="' . $cl_pass . '" /></td></tr>'
		. '<tr><td>' . _EXTRAINFO . ':</td><td><div>';
		wysiwyg_textarea('extrainfo', '', 'PHPNukeAdmin', 70, 12);
		echo '</div></td></tr>';
		echo '<tr><td colspan="2">'._AREYOUSURE.'</td></tr><tr><td colspan="2">';
		// ._ALLOWEDHTML.'</td></tr>
		//<tr><td colspan="2">';
		//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
		echo '</td></tr>'
		. '<tr><td>&nbsp;</td><td><input type="hidden" name="op" value="BannerAddClient" />'
		. '<input type="submit" value="' . _ADDCLIENT2 . '" />'
		. '</td></tr></table></form>';
	CloseTable();
	include_once ('footer.php');
}
function BannerStatus($bid, $status) {
	global $prefix, $db, $admin_file;
	if ($status == 1) {
		$active = 0;
	} else {
		$active = 1;
	}
	$bid = intval($bid);
	$db->sql_query('UPDATE ' . $prefix . '_banner SET active=\'' . $active . '\' WHERE bid=\'' . $bid . '\'');
	Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
}
function BannersAdd($name, $cid, $adname, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height) {
	global $prefix, $db, $admin_file, $ad_admin_menu;
	$cid = intval($cid);
	$imptotal = intval($imptotal);
	$active = intval($active);
	$errormsg = '';
	$ad_class = strtolower($ad_class);  // leaving this in in case any legacy data has upper case
	if ($ad_class == 'image' OR $ad_class == 'flash') {
		if ($imageurl == 'http://' OR $imageurl == '') {
			$errormsg .= ' a url is required for your image <br /><br />';
		}
		if ($ad_class == 'flash') {
			if (!is_numeric($ad_width) || !is_numeric($ad_height)) {
				$errormsg .= ' a numeric image height and width is required for your flash file <br /><br />';
				$ad_width = '';
				$ad_height = '';
			}
		} elseif ($ad_class == 'image') {
			if (!is_numeric($ad_width) || !is_numeric($ad_height)) {
				$ad_width = '';
				$ad_height = '';
			}
			if ($alttext == '' OR $clickurl == '') {
				$errormsg .= 'alttext and clickurl are required for images <br /><br />';
			}
		}
	}
	if ($ad_width == '' || $ad_height == '') {
		$ad_width = 'NULL';
		$ad_height = 'NULL';
	} else {
		$ad_width = '\'' . $ad_width . '\'';
		$ad_height = '\'' . $ad_height . '\'';
	}
	if (($ad_class == 'code') and ($ad_code == '')) {
		$errormsg .= 'you must input data for your ad code <br />';
	}
	if ($errormsg != '') {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div style="text-align: center;">';
		echo '<form action="' . $admin_file . '.php?op=add_banner" method="post">' . _ADINFOINCOMPLETE . '<br /><br />';
		echo '<input type="submit" value="Return to Input screen" />';
		echo '<input type="hidden" name="name" value = "'.$name.'" />';
		echo '<input type="hidden" name="cid" value = "'.$cid.'" />';
		echo '<input type="hidden" name="adname" value = "'.$adname.'" />';
		echo '<input type="hidden" name="imptotal" value = "'.$imptotal.'" />';
		echo '<input type="hidden" name="imageurl" value = "'.$imageurl.'" />';
		echo '<input type="hidden" name="clickurl" value = "'.$clickurl.'" />';
		echo '<input type="hidden" name="alttext" value = "'.$alttext.'" />';
		echo '<input type="hidden" name="position" value = "'.$position.'" />';
		echo '<input type="hidden" name="active" value = "'.$active.'" />';
		echo '<input type="hidden" name="ad_class" value = "'.$ad_class.'" />';
		echo '<input type="hidden" name="ad_code" value = "'.$ad_code.'" />';
		echo '<input type="hidden" name="ad_width" value = "'.$ad_width.'" />';
		echo '<input type="hidden" name="ad_height" value = "'.$ad_height.'" />';
		echo '<input type="hidden" name="errormsg" value = "'.$errormsg.'" />';
		echo '</form>';
		echo '</div>';
		CloseTable();
		include_once('footer.php');
	}
	$adname = $db->sql_escape_string(check_html($adname, 'nohtml'));
	$alttext = $db->sql_escape_string(check_html($alttext, 'nohtml'));
	$ad_code = $db->sql_escape_string(check_html($ad_code, 'nocheck'));
	$clickurl = $db->sql_escape_string(check_html($clickurl, 'nohtml'));
	$imageurl = $db->sql_escape_string(check_html($imageurl, 'nohtml'));
		$db->sql_query('INSERT INTO ' . $prefix . '_banner VALUES (NULL, \'' . $cid . '\', \'' . $adname . '\', \'' . $imptotal . '\', \'1\', \'0\', \'' . $imageurl . '\', \'' . $clickurl . '\', \'' . $alttext . '\', now(), NULL, \'' . $position . '\', \'' . $active . '\', \'' . $ad_class . '\', \'' . $ad_code . '\', ' . $ad_width . ', ' . $ad_height . ')');
	Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
}
function BannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo) {
	global $prefix, $db, $admin_file;
	$name = $db->sql_escape_string(check_html($name, 'nohtml'));
	$contact = $db->sql_escape_string(check_html($contact, 'nohtml'));
	$email = $db->sql_escape_string(check_html($email, 'nohtml'));
	$login = $db->sql_escape_string(check_html($login, 'nohtml'));
	$passwd = $db->sql_escape_string(check_html($passwd, 'nohtml'));
	$extrainfo = $db->sql_escape_string(check_html($extrainfo, 'nocheck'));
	$db->sql_query('INSERT INTO ' . $prefix . '_banner_clients VALUES (NULL, \'' . $name . '\', \'' . $contact . '\', \'' . $email . '\', \'' . $login . '\', \'' . $passwd . '\', \'' . $extrainfo . '\')');
	Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
}
function BannerDelete($bid, $ok = 0) {
	global $prefix, $db, $admin_file, $bgcolor1, $bgcolor2, $ad_admin_menu;
	$bid = intval($bid);
	if ($ok == 1) {
		$db->sql_query('DELETE FROM ' . $prefix . '_banner where bid=\'' . $bid . '\'');
		Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		$bannername = '';
		$clientname = '';
		$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE bid=\'' . $bid . '\''));
		$bannername = check_html($row['name'], 'nohtml');
		if ($bannername == '') {
			$bannername = _NONE;
		}
		$cid = $row['cid'];
		$imptotal = $row['imptotal'];
		$impmade = $row['impmade'];
		$clicks = $row['clicks'];
		$alttext = $row['alttext'];
		$imageurl = $row['imageurl'];
		$clickurl = $row['clickurl'];
		$ad_class = $row['ad_class'];
		$ad_code = $row['ad_code'];
		$ad_width = $row['ad_width'];
		$ad_height = $row['ad_height'];
		OpenTable();
		echo '<div style="text-align: center;" class="title">' . _DELETEBANNER . '</div><br /><br />';
		if ($ad_class == 'code') {
			echo '<table border="0" align="center"><tr><td>' . $ad_code . '</td></tr></table><br /><br />';
		} elseif ($ad_class == 'flash') {
			echo '<div style="text-align: center;">
				<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
				codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
				WIDTH="' . $ad_width . '" HEIGHT="' . $ad_height . '" id="' . $bid . '">
				<PARAM NAME=movie VALUE="' . $imageurl . '">
				<PARAM NAME=quality VALUE=high>
				<EMBED src="' . $imageurl . '" quality=high WIDTH="' . $ad_width . '" HEIGHT="' . $ad_height . '"
				NAME="' . $bid . '" ALIGN="" TYPE="application/x-shockwave-flash"
				PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
				</EMBED>
				</OBJECT>
				</div><br /><br />';
		} else {
			echo '<div style="text-align: center;"><img src="' . $imageurl . '" border="1" alt="' . $alttext . '" title="' . $alttext . '" width="' . $ad_width . '" height="' . $ad_height . '" /></div><br /><br />';
		}
		echo '<table width="100%" border="1"><tr>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _BANNERNAME . '</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPRESSIONS . '</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _IMPLEFT . '</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKS . '</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLICKSPERCENT . '</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _CLIENTNAME . '</td></tr>';
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
		$cid = $row2['cid'];
		$clientname = $row2['name'];
		$percent = substr(100*$clicks/$impmade, 0, 5);
		if ($imptotal == 0) {
			$left = _UNLIMITED;
		} else {
			$left = $imptotal-$impmade;
		}
		echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center">' . $bannername . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $impmade . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $left . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $clicks . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $percent . '%</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $clientname . '</td></tr>';
	}
	echo '</table><br /><div style="text-align: center;">'
		. _SURETODELBANNER . '<br /><br />'
		. '[ <a href="' . $admin_file . '.php?op=AdvertisingAdmin">' . _NO . '</a> | <a class="rn_csrf" href="' . $admin_file . '.php?op=BannerDelete&amp;bid=' . $bid . '&amp;ok=1">' . _YES . '</a> ]</div><br />';
	CloseTable();
	include_once('footer.php');
}
function BannerEdit($bid) {
	global $prefix, $db, $admin_file, $ad_admin_menu, $AllowableHTML, $advanced_editor;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	$bid = intval($bid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, alttext, date, position, active, ad_class, ad_code, ad_width, ad_height FROM ' . $prefix . '_banner WHERE bid=\'' . $bid . '\''));
	$cid = $row['cid'];
	$imptotal = $row['imptotal'];
	$impmade = $row['impmade'];
	$clicks = $row['clicks'];
	$imageurl = $row['imageurl'];
	$clickurl = $row['clickurl'];
	$alttext = $row['alttext'];
	$date = $row['date'];
	$date = explode(' ', $date);
	$date = $date[0] . ' @ ' . $date[1];
	$position = $row['position'];
	$active = $row['active'];
	$ad_class = $row['ad_class'];
	$ad_code = $row['ad_code'];
	$ad_width = $row['ad_width'];
	$ad_height = $row['ad_height'];
	$bannername = $row['name'];
	OpenTable();
	echo '<div style="text-align: center;" class="title">' . _EDITBANNER . '</div><br /><br />';
	if ($ad_class == 'code') {
		echo '<table border="0" align="center"><tr><td>' . $ad_code . '</td></tr></table><br /><br />';
	} elseif ($ad_class == 'flash') {
		echo '<div style="text-align: center;">
			<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
			WIDTH="' . $ad_width . '" HEIGHT="' . $ad_height . '" id="' . $bid . '">
			<PARAM NAME=movie VALUE="' . $imageurl . '">
			<PARAM NAME=quality VALUE=high>
			<EMBED src="' . $imageurl . '" quality=high WIDTH="' . $ad_width . '" HEIGHT="' . $ad_height . '"
			NAME="' . $did . '" ALIGN="" TYPE="application/x-shockwave-flash"
			PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
			</EMBED>
			</OBJECT>
			</div><br /><br />';
	} else {
		echo '<div style="text-align: center;"><img src="' . $imageurl . '" style="border: 0 none;' . ($ad_width != '' ? ' width: ' . $ad_width . 'px;' : '') . ($ad_height != '' ? ' height: ' . $ad_height . 'px;' : '') . '" alt="' . $alttext . '" title="' . $alttext . '" /></div><br /><br />';
	}
	echo '<form action="' . $admin_file . '.php?op=BannerChange" method="post">';
	echo '<table width="100%">';
	 echo '<tr><td width="20%">'._CLIENTNAME . ':</td><td>'
		. '<select name="cid">';
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
	$cid = $row2['cid'];
	$clientname = $row2['name'];
	echo '<option value="' . $cid . '" selected="selected">' . $clientname . '</option>';
	$result3 = $db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients');
	while ($row3 = $db->sql_fetchrow($result3)) {
		$ccid = $row3['cid'];
		$clientname = $row3['name'];
		if ($cid != $ccid) {
			echo '<option value="' . $ccid . '">' . $clientname . '</option>';
		}
	}
	echo '</select></td></tr>';
	if ($imptotal == 0) {
		$impressions = _UNLIMITED;
	} else {
		$impressions = $imptotal;
	}
	if ($active == 1) {
		$check1 = ' checked="checked"';
		$check2 = '';
	} else {
		$check1 = '';
		$check2 = ' checked="checked"';
	}
	if ($imptotal != 0) {
		$unl = '<span class="italic">(' . _XFORUNLIMITED . ')</span>';
	} else {
		$unl = '';
	}
	echo '<tr><td>' . _BANNERNAME . ':</td><td><input type="text" name="adname" size="20" maxlength="50" value="' . $row['name'] . '" /></td></tr>';
	echo '<tr><td>' . _ADDEDDATE . ':</td><td>' . $date . '</td></tr>';
	echo '<tr><td>' . _IMPPURCHASED . ':</td><td class="thick">' . $impressions . '</td></tr>';
	echo '<tr><td>' . _IMPMADE . ':</td><td class="thick">' . $impmade . '</td></tr>';
	echo '<tr><td>' . _ADDIMPRESSIONS . ':</td><td><input type="text" name="impadded" size="12" maxlength="11" value="0" /> ' . $unl . '</td></tr>';
	echo '<tr><td>' . _ADCLASS . ':</td><td class="thick">' . ucFirst($ad_class) . '</td></tr>';
	if ($ad_class == 'code') {

			echo '<tr><td colspan="2" style="text-align:center;">' . _ADCODE . ':</td></tr><tr><td colspan="2"><div>';
			if (!isset($advanced_editor) || $advanced_editor == 0) {
					$ad_code = htmlentities($ad_code, ENT_QUOTES);
			}
		 wysiwyg_textarea('ad_code', $ad_code, 'PHPNukeAdmin', 70, 15);
		 echo '</div></td></tr>';
			echo '<tr><td colspan="2">'._AREYOUSURE.'</td></tr>';
		//echo <tr><td colspan="2"> . _ALLOWEDHTML . '</td></tr><tr><td colspan="2">';
		//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
		//echo '</td></tr>';
		 echo '<tr><td>'
			. '<input type="hidden" name="imageurl" value="' . $imageurl . '" />'
			. '<input type="hidden" name="ad_width" value="' . $ad_width . '" />'
			. '<input type="hidden" name="ad_height" value="' . $ad_height . '" />'
			. '<input type="hidden" name="clickurl" value="' . $clickurl . '" />'
			. '<input type="hidden" name="alttext" value="' . $alttext . '" /></td><td>&nbsp;</td></tr>';
	} elseif ($ad_class == 'flash') {
		echo '<tr><td>' . _FLASHFILEURL . ':</td><td><input type="text" name="imageurl" size="50" maxlength="255" value="' . $imageurl . '" /> &nbsp; <a href="' . $imageurl . '" target="_blank"><img src="images/view.gif" border="0" alt="' . _SHOW . '" title="' . _SHOW . '" /></a></td></tr>'
			. '<tr><td>' . _FLASHSIZE . ':</td><td>' . _WIDTH . ': <input type="text" name="ad_width" size="4" maxlength="4" value="' . $ad_width . '" /> &nbsp; ' . _HEIGHT . ': <input type="text" name="ad_height" size="4" maxlength="4" value="' . $ad_height . '" /> &nbsp; ' . _INPIXELS
			. '<input type="hidden" name="clickurl" value="' . $clickurl . '" />'
			. '<input type="hidden" name="alttext" value="' . $alttext . '" />'
			. '<input type="hidden" name="ad_code" value="' . $ad_code . '" /></td></tr>';
	} else {
		echo '<tr><td>' . _IMAGEURL . ':</td><td><input type="text" name="imageurl" size="50" maxlength="255" value="' . $imageurl . '" /></td></tr>'
			. '<tr><td>' . _IMAGESIZE . ':</td><td>' . _WIDTH . ': <input type="text" name="ad_width" size="4" maxlength="4" value="' . $ad_width . '" /> &nbsp; ' . _HEIGHT . ': <input type="text" name="ad_height" size="4" maxlength="4" value="' . $ad_height . '" /> &nbsp; ' . _INPIXELS . '</td></tr>'
			. '<tr><td>' . _CLICKURL . ':</td><td><input type="text" name="clickurl" size="50" maxlength="200" value="' . $clickurl . '" /></td></tr>'
			. '<tr><td>' . _ALTTEXT . ':</td><td><input type="text" name="alttext" size="50" maxlength="255" value="' . $alttext . '" />'
			. '<input type="hidden" name="ad_code" value="' . $ad_code . '" /></td></tr>';
	}
	echo '<tr><td>' . _TYPE . ':</td><td><select name="position">';
	$result4 = $db->sql_query('SELECT position_number, position_name FROM ' . $prefix . '_banner_positions ORDER BY position_number');
	while ($row4 = $db->sql_fetchrow($result4)) {
		if ($position == $row4['position_number']) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option value="' . $row4['position_number'] . '"' . $sel . '>' . $row4['position_number'] . ' - ' . $row4['position_name'] . '</option>';
	}
	echo '</select></td></tr>'
		. '<tr><td>' . _ACTIVATE . ':</td><td><input type="radio" name="active" value="1"' . $check1 . ' />' . _YES . '&nbsp;&nbsp;<input type="radio" name="active" value="0"' . $check2 . ' />' . _NO . '</td></tr>'
		. '<tr><td>&nbsp;</td><td><input type="hidden" name="bid" value="' . $bid . '" />'
		. '<input type="hidden" name="imptotal" value="' . $imptotal . '" />'
		. '<input type="hidden" name="impmade" value="' . $impmade . '" />'
		. '<input type="hidden" name="op" value="BannerChange" />'
		. '<input type="submit" value="' . _SAVECHANGES . '" />'
		. '</td></tr></table></form>';
	CloseTable();
	include_once('footer.php');
}
function BannerChange($bid, $cid, $adname, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade) {
	global $prefix, $db, $admin_file, $AllowableHTML, $advanced_editor;
	if (!is_numeric($impadded)) {
		$impadded = strtoupper($impadded);
		if ($impadded == 'X') {
			$imp = 0;
		}
	} else {
		if ($impadded == 0) {
			$imp = $imptotal;
		} else {
			if ($imptotal == 0) {
				$imp = $impmade+$impadded;
			} else {
				$imp = $imptotal+$impadded;
			}
		}
	}
	$alttext = $db->sql_escape_string(check_html($alttext, 'nohtml'));
	$adname = $db->sql_escape_string(check_html($adname , 'nohtml'));
	$ad_code = $db->sql_escape_string(check_html($ad_code , 'nocheck'));
	$clickurl = $db->sql_escape_string(check_html($clickurl , 'nohtml'));
	$imageurl = $db->sql_escape_string(check_html($imageurl , 'nohtml'));
	$position = intval($position);
	if (!is_numeric($ad_width) || !is_numeric($ad_height)) {
		$ad_width = 'NULL';
		$ad_height = 'NULL';
	} else {
		$ad_width = '\'' . intval($ad_width) . '\'';
		$ad_height = '\'' . intval($ad_height) . '\'';
	}
	$cid = intval($cid);
	$imp = intval($imp);
	$active = intval($active);
	$bid = intval($bid);

	$db->sql_query('UPDATE ' . $prefix . '_banner SET cid=\'' . $cid . '\', name=\'' . $adname . '\', imptotal=\'' . $imp . '\', imageurl=\'' . $imageurl . '\', clickurl=\'' . $clickurl . '\', alttext=\'' . $alttext . '\', position=\'' . $position . '\', active=\'' . $active . '\', ad_code=\'' . $ad_code . '\', ad_width=' . $ad_width . ', ad_height=' . $ad_height . ' WHERE bid=\'' . $bid . '\'');
	Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
}
function BannerClientDelete($cid, $ok = 0) {
	global $prefix, $db, $admin_file, $ad_admin_menu;
	$cid = intval($cid);
	if ($ok == 1) {
		$db->sql_query('DELETE FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\'');
		$db->sql_query('DELETE FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\'');
		Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
	} else {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		$row = $db->sql_fetchrow($db->sql_query('SELECT cid, name FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
		$cid = $row['cid'];
		$name = $row['name'];
		OpenTable();
		echo '<div style="text-align: center;"><span class="thick">' . _DELETECLIENT . ': ' . $name . '</span><br /><br />
			' . _SURETODELCLIENT . '<br /><br />';
		$result2 = $db->sql_query('SELECT imageurl, clickurl, alttext FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\'');
		$numrows = $db->sql_numrows($result2);
		if ($numrows == 0) {
			echo _CLIENTWITHOUTBANNERS . '<br /><br />';
		} else {
			echo '<span class="thick">' . _WARNING . '!!!</span><br />'
				. _DELCLIENTHASBANNERS . ':<br /><br />';
		}
		while ($row2 = $db->sql_fetchrow($result2)) {
			$imageurl = htmlentities($row2['imageurl']);
			$clickurl = htmlentities($row2['clickurl']);
			$alttext = $row2['alttext'];
			echo '<a href="' . $clickurl . '"><img src="' . $imageurl . '" border="1" alt="' . $alttext . '" title="' . $alttext . '" /></a><br />'
				. '<a href="' . $clickurl . '">' . $clickurl . '</a><br /><br />';
		}
	}
	echo '[ <a href="' . $admin_file . '.php?op=AdvertisingAdmin#top">' . _NO . '</a> | '
		. '<a class="rn_csrf" href="' . $admin_file . '.php?op=BannerClientDelete&amp;cid=' . $cid . '&amp;ok=1">' . _YES . '</a> ]'
		. '</div><br />';
	CloseTable();
	include_once('footer.php');
}
function BannerClientEdit($cid) {
	global $prefix, $db, $admin_file, $ad_admin_menu, $advanced_editor, $AllowableHTML;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	$cid = intval($cid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT name, contact, email, login, passwd, extrainfo FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
	$name = check_html($row['name'], 'nohtml');
	$contact = check_html($row['contact'], 'nohtml');
	$email = check_html($row['email'], 'nohtml');
	$login = check_html($row['login'], 'nohtml');
	$passwd = check_html($row['passwd'], 'nohtml');
	$extrainfo = $row['extrainfo'];
	OpenTable();
	echo '<div style="text-align: center;" class="title">' . _EDITCLIENT . '</div><br /><br />';
	echo ' <form action="' . $admin_file . '.php?op=BannerClientChange" method="post">';
		echo '<table width="100%"><tr><td width="20%">'
		. _CLIENTNAME . ': </td><td><input type="text" name="name" value="' . $name . '" size="30" maxlength="60" /></td></tr><tr><td>'
		. _CONTACTNAME . ': </td><td><input type="text" name="contact" value="' . $contact . '" size="30" maxlength="60" /></td></tr><tr><td>'
		. _CONTACTEMAIL . ': </td><td><input type="text" name="email" size="30" maxlength="60" value="' . $email . '" /></td></tr><tr><td>'
		. _CLIENTLOGIN . ': </td><td><input type="text" name="login" size="12" maxlength="10" value="' . $login . '" /></td></tr><tr><td>'
		. _CLIENTPASSWD . ': </td><td><input type="text" name="passwd" size="12" maxlength="10" value="' . $passwd . '" /></td></tr><tr><td colspan="2">'
		. _EXTRAINFO . '</td></tr><tr><td colspan="2"><div>';
		if (!isset($advanced_editor) || $advanced_editor == 0) {
			$extrainfo = htmlentities($extrainfo, ENT_QUOTES);
			}
		wysiwyg_textarea('extrainfo', $extrainfo, 'PHPNukeAdmin', 70, 15);
		echo '</div></td></tr>';
		echo '<tr><td colspan="2">'._AREYOUSURE.'</td></tr>';
		//echo '<tr><td colspan="2">' ._ALLOWEDHTML . '</td></tr><tr><td colspan="2">';
	// while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
		//echo '</td></tr>';
		echo '<tr><td>'
		. '<input type="hidden" name="cid" value="' . $cid . '" />'
		. '<input type="hidden" name="op" value="BannerClientChange" />'
		. '<input type="submit" value="' . _SAVECHANGES . '" /></td></tr></table>'
		. '</form>';
	CloseTable();
	include_once('footer.php');
}
function BannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd) {
	global $prefix, $db, $admin_file, $advanced_editor, $AllowableHTML;
	$cid = intval($cid);
	$name = $db->sql_escape_string(check_html($name, 'nohtml'));
	$contact = $db->sql_escape_string(check_html($contact, 'nohtml'));
	$email = $db->sql_escape_string(check_html($email, 'nohtml'));
	$login = $db->sql_escape_string(check_html($login, 'nohtml'));
	$passwd = $db->sql_escape_string(check_html($passwd, 'nohtml'));
	$extrainfo = $db->sql_escape_string(check_html($extrainfo, 'nocheck'));
	$db->sql_query('UPDATE ' . $prefix . '_banner_clients SET name=\'' . $name . '\', contact=\'' . $contact . '\', email=\'' . $email . '\', login=\'' . $login . '\', passwd=\'' . $passwd . '\', extrainfo=\'' . $extrainfo . '\' WHERE cid=\'' . $cid . '\'');
	Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin#top');
}
function ad_positions() {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div style="text-align: center;" class="title">' . _CURRENTPOSITIONS . '</div><br /><br /><table width="100%" border="1"><tr>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _POSITIONNAME . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _POSITIONNUMBER . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _ASSIGNEDADS . '</td>'
		. '<td bgcolor="' . $bgcolor2 . '" align="center" class="thick">' . _FUNCTIONS . '</td></tr>';
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions ORDER BY apid');
	while ($row = $db->sql_fetchrow($result)) {
		$ban_num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\''));
		$position_name = check_html($row['position_name'], 'nohtml');
		echo '<tr><td bgcolor="' . $bgcolor1 . '" align="center">' . $position_name . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $row['position_number'] . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">' . $ban_num . '</td>'
			. '<td bgcolor="' . $bgcolor1 . '" align="center">&nbsp;'
			. '<a href="' . $admin_file . '.php?op=position_edit&amp;apid=' . $row['apid'] . '">'
			. '<img src="images/edit.gif" alt="' . _EDIT . '" title="' . _EDIT . '" border="0" width="17" height="17" /></a>  '
			. '<a class="rn_csrf" href="' . $admin_file . '.php?op=position_delete&amp;apid=' . $row['apid'] . '">'
			. '<img src="images/delete.gif" alt="' . _DELETE . '" title="' . _DELETE . '" border="0" width="17" height="17" /></a>&nbsp;<input type="hidden" name="new_pos" value="0" /></td></tr>';
	}
	echo '</table><br />';
	CloseTable();
	echo '<br />';
	OpenTable();
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions'));
	if ($numrows == 0) {
		$pos_num = 0;
	} else {
		$row = $db->sql_fetchrow($db->sql_query('SELECT position_number FROM ' . $prefix . '_banner_positions ORDER BY position_number DESC LIMIT 0,1'));
		$pos_num = $row['position_number']+1;
	}
	echo '<div style="text-align: center;" class="title">' . _ADDNEWPOSITION . '<br /><br />'
		. '<form method="post" action="' . $admin_file . '.php">'
		. _POSITIONNAME . ': <input type="text" name="ad_position_name" /> ' . _POSITIONNUMBER . ': <span class="thick">'
		. $pos_num . '<input type="hidden" name="ad_position_number" value="'
		. $pos_num . '" /><input type="hidden" name="position_new" value="1" /><input type="hidden" name="apid" value="0" /><input type="hidden" name="op" value="position_save" />'
		. '<br /><br /><input type="submit" value="' . _ADDPOSITION . '" /></span>'
		. '</form></div>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div style="text-align: center;"><span class="thick">' . _NOTE . '</span><br /><br />' . _POSITIONNOTE . '<br />' . _POSEXAMPLE . '</div>';
	CloseTable();
	include_once ('footer.php');
}
function position_save($apid = 0, $ad_position_number, $ad_position_name, $position_new = 0) {
	global $prefix, $db, $admin_file, $ad_admin_menu;
	if ($ad_position_name == '') {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div style="text-align: center;"><span class="title">' . _ADDNEWPOSITION . '</span><br /><br />'
			. _POSINFOINCOMPLETE . '<br /><br />' . _GOBACK . '</div>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	$ad_position_name = $db->sql_escape_string(check_html($ad_position_name, 'nohtml'));
	$ad_position_number = intval($ad_position_number);
	if ($position_new == 1) {
		$db->sql_query('INSERT INTO ' . $prefix . '_banner_positions VALUES (NULL, \'' . $ad_position_number . '\', \'' . $ad_position_name . '\')');
	} else {
		$apid = intval($apid);
		$db->sql_query('UPDATE ' . $prefix . '_banner_positions SET position_name=\'' . $ad_position_name . '\' WHERE apid=\'' . $apid . '\'');
	}
	Header('Location: ' . $admin_file . '.php?op=ad_positions');
}
function position_edit($apid) {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu;
	$apid = intval($apid);
	if ($apid == '' AND $apid == 0) {
		Header('Location: ' . $admin_file . '.php?op=ad_positions');
		die();
	}
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	OpenTable();
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
	$position_name = check_html($row['position_name'], 'nohtml');
	echo '<div style="text-align: center;" class="title">' . _EDITPOSITION . '<br /><br />'
		. '<form method="post" action="' . $admin_file . '.php">'
		. _POSITIONNAME . ': <input type="text" name="ad_position_name" value="' . $position_name . '" /> '
		. _POSITIONNUMBER . ': <span class="thick">' . $row['position_number'] . '</span><input type="hidden" name="ad_position_number" value="'
		. $row['position_number'] . '" /><input type="hidden" name="apid" value="'
		. $apid . '" /><input type="hidden" name="position_new" value="0" /><input type="hidden" name="op" value="position_save" /><br /><br /><input type="submit" value="'
		. _SAVEPOSITION . '" />'
		. '</form></div>';
	CloseTable();
	include_once ('footer.php');
}
function position_delete($apid, $ok = 0, $active = 0, $new_pos = x) {
	global $prefix, $db, $admin_file, $ad_admin_menu;
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions'));
	if ($numrows == 1) {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div style="text-align: center;"><span class="thick">' . _DELETEPOSITION . '</span><br /><br />
				'. _CANTDELETEPOSITION . '<br /><br />' . _GOBACK.'</div>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	if ($ok == 1) {
//	if ($new_pos == 'x' OR $new_post == '') {   new post never referenced
		if ($new_pos == 'x') {
			$db->sql_query('DELETE FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\'');
		} else {
			if ($active == 'same') {
				$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
				$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\'');
				while ($row2 = $db->sql_fetchrow($result)) {
					$db->sql_query('UPDATE ' . $prefix . '_banner SET position=\'' . $new_pos . '\' WHERE bid=\'' . $row2['bid'] . '\'');
				}
				$db->sql_query('DELETE FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\'');
			} elseif ($active == 'active') {
				$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
				$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\'');
				while ($row2 = $db->sql_fetchrow($result)) {
					$db->sql_query('UPDATE ' . $prefix . '_banner SET position=\'' . $new_pos . '\', active=\'1\' WHERE bid=\'' . $row2['bid'] . '\'');
				}
				$db->sql_query('DELETE FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\'');
			} elseif ($active == 'inactive') {
				$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
				$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\'');
				while ($row2 = $db->sql_fetchrow($result)) {
					$db->sql_query('UPDATE ' . $prefix . '_banner SET position=\'' . $new_pos . '\', active=\'0\' WHERE bid=\'' . $row2['bid'] . '\'');
				}
				$db->sql_query('DELETE FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\'');
			} elseif ($active == 'delete_all') {
				$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
				$db->sql_query('DELETE FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\'');
				$db->sql_query('DELETE FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\'');
			}
		}
		Header('Location: ' . $admin_file . '.php?op=ad_positions');
		die();
	} else {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid=\'' . $apid . '\''));
		$row['position_name'] = check_html($row['position_name'], 'nohtml');
		echo '<br /><div class="text-center"><span class="thick">' . _DELETEPOSITION . ': ' . $row['position_name'] . "</span><br /><br />
			" . _SURETODELPOSITION . '<br /><br /></div>';
		$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE position=\'' . $row['position_number'] . '\''));
		if ($numrows != 0) {
			echo _POSITIONHASADS . '<br /><br />';
			echo '<form action="' . $admin_file . '.php" method="post">';
			echo _MOVEADS . ': <select name="new_pos">';
			$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner_positions WHERE apid!=\'' . $apid . '\'');
			while ($row = $db->sql_fetchrow($result)) {
				echo '<option value="' . $row['position_number'] . '">' . $row['position_number'] . ': ' . $row['position_name'] . '</option>';
			}
			echo '</select><br /><br />';
			echo _MOVEDADSSTATUS . ': <select name="active">';
			echo '<option value="same">' . _NOCHANGES . '</option>';
			echo '<option value="active">' . _ACTIVE . '</option>';
			echo '<option value="inactive">' . _INACTIVE . '</option>';
			echo '<option value="delete_all">' . _DELETEALLADS . ' (' . $numrows . ')</option>';
			echo '</select><br /><br />';
			echo '<input type="hidden" name="apid" value="' . $apid . '" /><input type="hidden" name="ok" value="1" />'
				. '<input type="hidden" name="op" value="position_delete" /><input type="submit" value="' . _DELETE . '" />';
			echo '</form>';
		} else {
			echo '<div style="text-align: center;">[ <a href="' . $admin_file . '.php?op=ad_positions">' . _NO . '</a> | <a class="rn_csrf" href="'
				. $admin_file . '.php?op=position_delete&amp;apid=' . $apid . '&amp;ok=1&amp;new_pos=x">' . _YES . '</a> ]</div>';
		}
	}
	CloseTable();
	include_once('footer.php');
}
function ad_terms($save = 0, $terms_body = 0, $country = 0) {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $advanced_editor, $AllowableHTML;
	if ($save != 0) {
		$terms_body = $db->sql_escape_string(check_html($terms_body, 'nocheck'));
		$db->sql_query('UPDATE ' . $prefix . '_banner_terms SET terms_body=\'' . $terms_body . '\', country=\'' . $country . '\'');
		Header('Location: ' . $admin_file . '.php?op=AdvertisingAdmin');
	}
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	OpenTable();
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_terms'));
	$terms_body = $row['terms_body'];
	echo '<div align="center"><span class="title">' . _EDITTERMS . '</span><br /><br /><span class="italic">' . _SITENAMEADS . '</span><br /><br />'
		. '<form method="post" action="' . $admin_file . '.php">' . _TERMSOFSERVICEBODY . ':<br /><br /><div>';
		if (!isset($advanced_editor) || $advanced_editor == 0) {
					$terms_body = htmlentities($terms_body, ENT_QUOTES);
			}
	wysiwyg_textarea('terms_body', $terms_body, 'PHPNukeAdmin', '70', '30');
	echo '</div><br /><br />';
	echo _AREYOUSURE;
	//echo '<br />' . _ALLOWEDHTML . '<br />';
	//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
	echo '<br /><br />';
	echo  _COUNTRYNAME . ':<br /><br /><select name="country">';
	$result = $db->sql_query('SELECT country FROM '.$prefix.'_nsnst_countries WHERE c2c > \'02\'');
	while ($row2 = $db->sql_fetchrow($result)) {
		if ($row['country'] == $row2['country']) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option value="' . htmlspecialchars($row2['country']) . '"' . $sel . '>' . htmlspecialchars($row2['country']) . '</option>';
	}
	echo '</select><br />'
		. '<input type="hidden" name="save" value="1" /><input type="hidden" name="op" value="ad_terms" /><br /><br /><input type="submit" value="' . _SAVECHANGES . '" />'
		. '</form><br /><table border="0" width="80%" align="center"><tr><td align="center"><span class="italic">' . _TERMSNOTE . '</span></td></tr></table></div>';
	CloseTable();
	include_once ('footer.php');
}
function ad_plans() {
	global $prefix, $db, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2, $advanced_editor, $AllowableHTML;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_banner_plans'));
	if ($numrows != 0) {
		OpenTable();
		$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner_plans');
		echo '<div class="text=align: center;"><span class="title">' . _ADVERTISINGPLANS . '</span></div><br />';
		echo '<table border="1" width="100%"><tr><td bgcolor="' . $bgcolor2 . '" class="thick">&nbsp;'
			. _PLANNAME . '</td><td align="center" bgcolor="' . $bgcolor2 . '" class="thick">'
			. _DELIVERY . '</td><td align="center" bgcolor="' . $bgcolor2 . '" class="thick">'
			. _STATUS . '</td><td align="center" bgcolor="' . $bgcolor2 . '" class="thick">'
			. _PRICE . '</td><td align="center" bgcolor="' . $bgcolor2 . '" class="thick">'
			. _FUNCTIONS . '</td></tr>';
		while ($row = $db->sql_fetchrow($result)) {
			if ($row['delivery_type'] == 0) {
				$type = _IMPRESSIONS;
			} elseif ($row['delivery_type'] == 1) {
				$type = _CLICKS;
			} elseif ($row['delivery_type'] == 2) {
				$type = _PDAYS;
			} elseif ($row['delivery_type'] == 3) {
				$type = _PMONTHS;
			} elseif ($row['delivery_type'] == 4) {
				$type = _PYEARS;
			}
			$active = intval($row['active']);
			if ($active == 1) {
				$t_active = '<img src="images/active.gif" alt="' . _ACTIVE . '" title="' . _ACTIVE . '" border="0" width="16" height="16" />';
				$c_active = '<img src="images/inactive.gif" alt="' . _DEACTIVATE . '" title="' . _DEACTIVATE . '" border="0" width="16" height="16" />';
			} else {
				$t_active = '<img src="images/inactive.gif" alt="' . _INACTIVE . '" title="' . _INACTIVE . '" border="0" width="16" height="16" />';
				$c_active = '<img src="images/active.gif" alt="' . _ACTIVATE . '" title="' . _ACTIVATE . '" border="0" width="16" height="16" />';
			}
			echo '<tr><td bgcolor="' . $bgcolor1 . '">&nbsp;' . $row['name'] . '</td>'
				. '<td align="center" bgcolor="' . $bgcolor1 . '">' . $row['delivery'] . ' ' . $type . '</td>'
				. '<td align="center" bgcolor="' . $bgcolor1 . '">' . $t_active . '</td>'
				. '<td align="center" bgcolor="' . $bgcolor1 . '">' . $row['price'] . '</td>'
				. '<td align="center" bgcolor="' . $bgcolor1 . '">&nbsp;<a href="' . $admin_file . '.php?op=ad_plans_edit&amp;pid=' . $row['pid'] . '">'
				. '<img src="images/edit.gif" alt="' . _EDIT . '" title="' . _EDIT . '" border="0" width="17" height="17" /></a>  '
				. '<a class="rn_csrf" href="' . $admin_file . '.php?op=ad_plans_status&amp;pid=' . $row['pid'] . '&amp;status=' . $active . '">' . $c_active . '</a>  '
				. '<a class="rn_csrf" href="' . $admin_file . '.php?op=ad_plans_delete&amp;pid=' . $row['pid'] . '&amp;ok=0">'
				. '<img src="images/delete.gif" alt="' . _DELETE . '" title="' . _DELETE . '" border="0" width="17" height="17" /></a>&nbsp;</td></tr>';
		}
		echo '</table>';
		CloseTable();
		echo '<br />';
	}
	OpenTable();
	echo '<div class="title" style="text-align: center;">' . _ADDADVERTISINGPLAN . '</div><br /><br />';
	echo '<form method="post" action="' . $admin_file . '.php">';
	echo '<table border="0" width="100%">';
	echo '<tr><td colspan="2"><div style="text-align:center;">All fields are required</div></td></tr><tr><td>';
	echo _PLANNAME . ':</td><td><input type="text" size="40" name="name" /></td></tr>';
	echo '<tr><td>' . _PLANDESCRIPTION . ':</td><td><div>';
	wysiwyg_textarea('description', '', 'PHPNukeAdmin', 70, 12);
	echo '</div></td></tr>';
	echo '<tr><td colspan="2">' . _AREYOUSURE . '</td></tr>';
	//echo '<tr><td colspan="2">' . _ALLOWEDHTML . '</td></tr><tr><td colspan="2">';
	//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
	//echo '</td></tr>';
	echo '<tr><td>' . _DELIVERYQUANTITY . ':</td><td><input type="text" size="10" name="delivery" /> A number to go with the delivery mode below</td></tr>';
	echo '<tr><td>' . _DELIVERYTYPE . ':</td><td><select name="type">'
		. '<option value="0">' . _IMPRESSIONS . '</option>'
		. '<option value="1">' . _CLICKS . '</option>'
		. '<option value="2">' . _PDAYS . '</option>'
		. '<option value="3">' . _PMONTHS . '</option>'
		. '<option value="4">' . _PYEARS . '</option>'
		. '</select></td></tr>';
	echo '<tr><td>' . _PRICE . ':</td><td><input type="text" size="10" name="price" /></td></tr>';
	echo '<tr><td colspan="2">For buy links, if you put in a properly formatted href (link or mailto) the advertiser will be able to click on it, otherwise just put in some text -- your name or a phone number or contact webmaster or whatever you wish. You can also put in a Paypal buy button or other code but please test the results.  An entry is required.</td></tr>';
	echo '<tr><td>' . _PLANBUYLINKS . ':</td><td><div>';
		wysiwyg_textarea('buy_links', '', 'PHPNukeAdmin', 70, 12);
	echo '</div></td></tr>';
	echo '<tr><td>' . _INITIALSTATUS . ':</td><td><input type="radio" name="status" value="1" checked="checked" /> '
		. _ACTIVE . ' &nbsp;&nbsp; <input type="radio" name="status" value="0" /> ' . _INACTIVE . '</td></tr>';
	echo '<tr><td>&nbsp;</td><td><input type="hidden" name="op" value="ad_plans_add" /><input type="submit" value="'
		. _ADDNEWPLAN . '" /></td></tr></table></form><br /><div style="text-align: center;"><span class="italic">' . _PLANSNOTE . '</span></div>';
	CloseTable();
	include_once ('footer.php');
}
function ad_plans_add($name, $description, $delivery, $type, $price, $buy_links, $status) {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu;
	if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($status)) {
		$name = $db->sql_escape_string(check_html($name, 'nohtml'));
		$description = $db->sql_escape_string(check_html($description, 'nocheck'));
		$price = $db->sql_escape_string(check_html($price, 'nohtml'));
		$buy_links = $db->sql_escape_string(check_html($buy_links, 'nocheck'));
		$db->sql_query('INSERT INTO ' . $prefix . '_banner_plans VALUES (NULL, \'' . $status . '\', \'' . $name . '\', \'' . $description . '\', \'' . $delivery . '\', \'' . $type . '\', \'' . $price . '\', \'' . $buy_links . '\')');
		Header('Location: ' . $admin_file . '.php?op=ad_plans');
		die();
	} else {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div style="text-align: center;">' . _ADDPLANERROR . '<br /><br />' . _GOBACK . '</div>';
		CloseTable();
		include_once ('footer.php');
	}
}
function ad_plans_edit($pid) {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $advanced_editor, $AllowableHTML;
	include_once ('header.php');
	GraphicAdmin();
	OpenTable();
	echo $ad_admin_menu;
	CloseTable();
	echo '<br />';
	$description = '';
	OpenTable();
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_plans WHERE pid=\'' . $pid . '\''));
	$description = $row['description'];
	$buy_links = $row['buy_links'];
	echo '<div style="text-align: center;" class="title">' . _ADVERTISINGPLANEDIT . '</div><br /><br />';
	echo '<form method="post" action="' . $admin_file . '.php">';
	echo '<table border="0" width="100%"><tr><td colspan="3"><div style="text-align:center;">All Fields are Required</div></td></tr><tr><td>';
	echo _PLANNAME . ':</td><td colspan="2"><input type="text" size="40" name="name" value="' . $row['name'] . '" /></td></tr>';
	echo '<tr><td>' . _PLANDESCRIPTION . ':</td><td colspan="2"><div>';
	if (!isset($advanced_editor) || $advanced_editor == 0) {
		$description = htmlentities($description, ENT_QUOTES);
		$buy_links = htmlentities($buy_links, ENT_QUOTES);
	}
	wysiwyg_textarea('description', $description, 'PHPNukeAdmin', 70, 12);
	echo '</div></td></tr>';
	echo '<tr><td colspan="2">' . _AREYOUSURE . '</td></tr>';
	//echo '<tr><td colspan="2">' ._ALLOWEDHTML . '</td></tr><tr><td colspan="2">';
	//while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
	//echo '</td></tr>';
	echo '<tr><td>' . _DELIVERYQUANTITY . ':</td><td><input type="text" size="10" name="delivery" value="' . $row['delivery'] . '" /> A number to go with the delivery mode below</td></tr>';
	$sel0 = $sel1 = $sel2 = $sel3 = $sel4 = '';
	if ($row['delivery_type'] == 0) {
		$sel0 = ' selected="selected"';
	}
	if ($row['delivery_type'] == 1) {
		$sel1 = ' selected="selected"';
	}
	if ($row['delivery_type'] == 2) {
		$sel2 = ' selected="selected"';
	}
	if ($row['delivery_type'] == 3) {
		$sel3 = ' selected="selected"';
	}
	if ($row['delivery_type'] == 4) {
		$sel4 = ' selected="selected"';
	}
	echo '<tr><td>' . _DELIVERYTYPE . ':</td><td><select name="type">'
		. '<option value="0"' . $sel0 . '>' . _IMPRESSIONS . '</option>'
		. '<option value="1"' . $sel1 . '>' . _CLICKS . '</option>'
		. '<option value="2"' . $sel2 . '>' . _PDAYS . '</option>'
		. '<option value="3"' . $sel3 . '>' . _PMONTHS . '</option>'
		. '<option value="4"' . $sel4 . '>' . _PYEARS . '</option>'
		. '</select></td></tr>';
	echo '<tr><td>' . _PRICE . ':</td><td><input type="text" size="10" name="price" value="' . $row['price'] . '" /></td></tr>';
	echo '<tr><td>' . _PLANBUYLINKS . ':</td><td><div>';
		wysiwyg_textarea('buy_links', $buy_links, 'PHPNukeAdmin', 70, 12);
		echo '</div></td></tr>';
		if ($row['active'] == 1) {
		$check0 = ' checked="checked"';
		$check1 = '';
	} elseif ($row['active'] == 0) {
		$check0 = '';
		$check1 = ' checked="checked"';
	}
	echo '<tr><td>' . _STATUS . ':</td><td><input type="radio" name="status" value="1"' . $check0 . ' /> '
		. _ACTIVE . ' &nbsp;&nbsp; <input type="radio" name="status" value="0"' . $check1 . ' /> '
		. _INACTIVE . '</td></tr>';
	echo '<tr><td>&nbsp;</td><td><input type="hidden" name="pid" value="' . $pid . '" />'
		. '<input type="hidden" name="op" value="ad_plans_save" />'
		. '<input type="submit" value="' . _SAVECHANGES . '" /></td></tr></table></form>'
		. '<br /><div style="text-align: center;"><span class="italic">' . _PLANSNOTE . '</span></div>';
	CloseTable();
	include_once ('footer.php');
}
function ad_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $status) {
	global $prefix, $db, $banners, $admin_file, $ad_admin_menu;
	if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($status)) {
		$name = $db->sql_escape_string(check_html($name, 'nohtml'));
		$description = $db->sql_escape_string(check_html($description, 'nocheck'));
		$price = $db->sql_escape_string(check_html($price, 'nohtml'));
		$buy_links = $db->sql_escape_string(check_html($buy_links, 'nocheck'));
		$db->sql_query('UPDATE ' . $prefix . '_banner_plans SET active=\'' . $status . '\', name=\'' . $name . '\', description=\'' . $description . '\', delivery=\'' . $delivery . '\', delivery_type=\'' . $type . '\', buy_links=\'' . $buy_links . '\', price=\'' . $price . '\' WHERE pid=\'' . $pid . '\'');
		Header('Location: ' . $admin_file . '.php?op=ad_plans');
		die();
	} else {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<div style="text-align: center;">' . _ADDPLANERROR . '<br /><br />' . _GOBACK . '</div>';
		CloseTable();
		include_once ('footer.php');
	}
}
function ad_plans_delete($pid, $ok = 0) {
	global $prefix, $db, $admin_file, $ad_admin_menu;
	if ($ok == 1) {
		$db->sql_query('DELETE FROM ' . $prefix . '_banner_plans WHERE pid=\'' . $pid . '\'');
		Header('Location: ' . $admin_file . '.php?op=ad_plans');
		die();
	} else {
		include_once ('header.php');
		GraphicAdmin();
		OpenTable();
		echo $ad_admin_menu;
		CloseTable();
		echo '<br />';
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_plans WHERE pid=\'' . $pid . '\''));
		echo '<div style="text-align: center;"><span class="thick">' . _DELETEPLAN . ': ' . $row['name'] . '</span><br /><br />'
			. _SURETODELPLAN . '<br /><br />'
			. '[ <a href="' . $admin_file . '.php?op=ad_plans">' . _NO . '</a> | <a class="rn_csrf" href="' . $admin_file . '.php?op=ad_plans_delete&amp;pid=' . $pid . '&amp;ok=1">' . _YES . '</a> ]</div>';
		CloseTable();
		include_once('footer.php');
	}
}
function ad_plans_status($pid, $status) {
	global $prefix, $db, $admin_file;
	if ($status == 1) {
		$active = 0;
	} else {
		$active = 1;
	}
	$pid = intval($pid);
	$db->sql_query('UPDATE ' . $prefix . '_banner_plans SET active=\'' . $active . '\' WHERE pid=\'' . $pid . '\'');
	Header('Location: ' . $admin_file . '.php?op=ad_plans');
}
?>