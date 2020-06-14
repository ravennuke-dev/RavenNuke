<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2013, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('RNYA')) {
	header('Location: ../../../../index.php');
	die();
}
if (is_active('Private_Messages') && defined('LOGGEDIN_SAME_USER')) {
	$uid = (int)$usrinfo['user_id'];
	echo '<br />';
	OpenTable();
	if (is_active('Members_List')) {
		$mem_list = '<a href="modules.php?name=Members_List">' . _BROWSEUSERS . '</a>';
	} else {
		$mem_list = '';
	}
	if (is_active('Search')) {
		$mod_search = '<a href="modules.php?name=Search&amp;type=users">' . _SEARCHUSERS . '</a>';
	} else {
		$mod_search = '';
	}
	if ($mem_list != '' AND $mod_search != '') {
		$a = ' | ';
	} else {
		$a = '';
	}
	if ($mem_list != '' OR $mod_search != '') {
		$links = '[ ' . $mem_list . ' ' . $a . ' ' . $mod_search . ' ]';
	} elseif ($mem_list == '' AND $mod_search == '') {
		$links = '';
	}

	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type IN (0, 1, 5)');
	list($ya_totpms) = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type = 0');
	list($ya_oldpms) = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type = 1');
	list($ya_newpms) = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type = 2');
	list($ya_outpms) = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type = 4');
	list($ya_savpms) = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT COUNT(*) FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid = ' . $uid . ' AND privmsgs_type = 5');
	list($ya_outpms) = $db->sql_fetchrow($result);

	// menelaos: function changed to reflect the default phpbb2 style icons (in a future version they will show the users phpnuke forum theme icons)
	// montego - modified to remove wasteful SQL calls
	$configresult = $db->sql_query('SELECT config_name, config_value FROM ' . $prefix . '_bbconfig WHERE config_name = \'default_style\'');
	list($bbstyle) = $db->sql_fetchrow($configresult);
	$sql = 'SELECT template_name FROM ' . $prefix . '_bbthemes WHERE themes_id=\'' . addslashes($bbstyle) . '\'';
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	if (isset($row['template_name'])) {
		$bbtheme = $row['template_name'];
	} else {
		$bbtheme = '';
	}
	//escudero: modification to get the theme from nukemods
	if (file_exists('./themes/' . $ThemeSel . '/forums/images/whosonline.gif')) {
		$imagedir = './themes/' . $ThemeSel . '/forums/images';
	} elseif (file_exists('./modules/Forums/templates/' . $bbtheme . '/images/whosonline.gif')) {
		$imagedir = './modules/Forums/templates/' . $bbtheme . '/images';
	} else {
		$imagedir = './modules/Forums/templates/subSilver/images';
	}
	echo '<div align="center"><strong>' . _YAMESSAGES . '</strong>';
	echo '<table border="0"><tr>';
	echo '<td><a href="modules.php?name=Private_Messages"><img src="' . $imagedir . '/whosonline.gif" alt="" /></a></td>';
	echo '<td valign="middle"><a href="modules.php?name=Private_Messages"><strong>' . _YAPM . '&nbsp;: &nbsp;' . $ya_totpms . '</strong></a></td>';
	echo '<td width="10%">&nbsp;</td>';
	echo '<td><a href="modules.php?name=Private_Messages"><img src="' . $imagedir . '/msg_inbox.gif" alt="" /></a></td>';
	echo '<td valign="middle"><a href="modules.php?name=Private_Messages"><strong>&nbsp; ' . _YAUNREAD . ':&nbsp;' . $ya_newpms . '</strong></a></td>';
	echo '<td width="10%">&nbsp;</td>';
	echo '<td><a href="modules.php?name=Private_Messages"><img src="' . $imagedir . '/msg_inbox.gif" alt="" /></a></td>';
	echo '<td valign="middle"><a href="modules.php?name=Private_Messages"><strong>&nbsp; ' . _YAREAD . ':&nbsp;' . $ya_oldpms . '</strong></a></td>';
	echo '<td width="10%">&nbsp;</td>';
	echo '<td><a href="modules.php?name=Private_Messages&amp;file=index&amp;folder=savebox"><img src="' . $imagedir . '/msg_savebox.gif" alt="" /></a></td>';
	echo '<td valign="middle"><a href="modules.php?name=Private_Messages&amp;file=index&amp;folder=savebox"><strong>&nbsp; ' . _YASAVED . ':&nbsp;' . $ya_savpms . '</strong></a></td>';
	echo '<td width="10%">&nbsp;</td>';
	echo '<td><a href="modules.php?name=Private_Messages&amp;file=index&amp;folder=outbox"><img src="' . $imagedir . '/msg_inbox.gif" alt="" /></a></td>';
	echo '<td valign="middle"><a href="modules.php?name=Private_Messages&amp;file=index&amp;folder=outbox"><strong>&nbsp; ' . _YAOUTBOX . ':&nbsp;' . $ya_outpms . '</strong></a></td></tr>';
	echo '</table>';
	echo '<form action="modules.php?name=Private_Messages&amp;mode=post&amp;pm_uname=' . htmlspecialchars($username, ENT_QUOTES, _CHARSET) . '" method="post">';
	echo '<p align="center">' . _USENDPRIVATEMSG . ': <input type="text" name="pm_uname" size="25" />&nbsp;';
	echo '<input type="submit" name="send" value="' . _SEND . '" /><br /><br />' . $links;
	echo '</p></form></div>';
	CloseTable();
}
?>