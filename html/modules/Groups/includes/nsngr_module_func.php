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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}

function grsave_config($config_name, $config_value) {
	global $prefix, $db;
	$db->sql_query('UPDATE `' . $prefix . '_nsngr_config` SET `config_value`=\'' . $config_value . '\' WHERE `config_name`=\'' . $config_name . '\'');
}

function grget_config($config_name) {
	global $prefix, $db;
	$configresult = $db->sql_query('SELECT `config_value` FROM `' . $prefix . '_nsngr_config` WHERE `config_name`=\'' . $config_name . '\'');
	list($config_value) = $db->sql_fetchrow($configresult);
	return $config_value;
}

function grget_configs() {
	global $prefix, $db;
	$configresult = $db->sql_query('SELECT `config_name`, `config_value` FROM `' . $prefix . '_nsngr_config`');
	while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		$config[$config_name] = $config_value;
	}
	return $config;
}

function NSNGroupsAdmin() {
	global $db, $prefix, $admin_file;
	$grpnum = $db->sql_numrows($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups`'));
	$usrnum = $db->sql_numrows($db->sql_query('SELECT `gid` FROM `' . $prefix . '_nsngr_users`'));
	OpenTable();
	echo '<div class="text-center"><table cellpadding="3"><tr>';
	echo '<td align="center" valign="top" width="150">';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsAdd">' . _GR_GROUPSADD . '</a><br />';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsView">' . _GR_GROUPSVIEW . '</a> (' . $grpnum . ')<br />';
	echo '</td>';
	echo '<td align="center" valign="top" width="150">';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersEmail">' . _GR_GROUPSEMAIL . '</a><br />';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsConfig">' . _GR_GROUPSCONFIG . '</a><br />';
	echo '</td>';
	echo '<td align="center" valign="top" width="150">';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersAdd">' . _GR_GROUPSUSERSADD . '</a><br />';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersView">' . _GR_GROUPSUSERSVIEW . '</a> (' . $usrnum . ')<br />';
	echo '<a href="' . $admin_file . '.php?op=NSNGroupsMemberships">' . _GR_MEMBERSHIPS . '</a><br />';
	echo '</td></tr>';
	echo '<tr><td colspan="3" align="center"><a href="' . $admin_file . '.php">' . _MAINADMINMENU . '</a></td></tr>';
	echo '</table></div>';
	CloseTable();
}

function grpagenums($op, $totalselected, $perpage, $max, $gid) {
	global $admin_file;
	if (!isset($gid)) $gid = 0;
	$pagesint = ($totalselected/$perpage);
	$pageremainder = ($totalselected%$perpage);
	if ($pageremainder != 0) {
		$pages = ceil($pagesint);
		if ($totalselected < $perpage) {
			$pageremainder = 0;
		}
	} else {
		$pages = $pagesint;
	}
	if ($pages != 1 && $pages != 0) {
		$counter = 1;
		$currentpage = ($max/$perpage);
		echo '<br /><div align="center"><form action="' . $admin_file . '.php" method="post">';
		echo '<input type="hidden" name="op" value="' . $op . '" />';
		echo '<input type="hidden" name="gid" value="' . $gid . '" />';
		echo '<span class="thick">' . _GR_SELECTPAGE . ': </span><select name="min">';
		while ($counter <= $pages) {
			$cpage = $counter;
			$mintemp = ($perpage*$counter) -$perpage;
			echo '<option value="' . $mintemp . '"';
			if ($counter == $currentpage) {
				echo ' selected="selected"';
			}
			echo '>' . $counter . '</option>';
			$counter++;
		}
		echo '</select><span class="thick"> ' . _GR_OF . ' ' . $pages . ' ' . _GR_PAGES . '</span> <input type="submit" value="' . _GR_GO . '" />';
		echo '</form></div><br />';
	}
}

function grformcheck($field_r, $field_d) {
	$text  = '';
	$text .= "<script type=\"text/javascript\">\n";
	$text .=  "<!--\n";
	$text .=  "function formCheck(formobj){\n";
	$text .=  "  // name of mandatory fields\n";
	$text .=  "  var fieldRequired = Array(".$field_r.");\n";
	$text .=  "  // field description to appear in the dialog box\n";
	$text .=  "  var fieldDescription = Array(".$field_d.");\n";
	$text .=  "  // dialog message\n";
	$text .=  "  var alertMsg = \"Please complete the following fields:\\n\";\n";
	$text .=  "  var l_Msg = alertMsg.length;\n";
	$text .=  "  for(var i = 0; i < fieldRequired.length; i++){\n";
	$text .=  "    var obj = formobj.elements[fieldRequired[i]];\n";
	$text .=  "    if(obj){\n";
	$text .=  "      switch(obj.type){\n";
	$text .=  "        case \"SELECT-one\":\n";
	$text .=  "          if(obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == \"\"){\n";
	$text .=  "            alertMsg += \" - \" + fieldDescription[i] + \"\\n\";\n";
	$text .=  "          }\n";
	$text .=  "          break;\n";
	$text .=  "        case \"SELECT-multiple\":\n";
	$text .=  "          if(obj.selectedIndex == -1){\n";
	$text .=  "            alertMsg += \" - \" + fieldDescription[i] + \"\\n\";\n";
	$text .=  "          }\n";
	$text .=  "          break;\n";
	$text .=  "        case \"text\":\n";
	$text .=  "        case \"textarea\":\n";
	$text .=  "          if(obj.value == \"\" || obj.value == null){\n";
	$text .=  "            alertMsg += \" - \" + fieldDescription[i] + \"\\n\";\n";
	$text .=  "          }\n";
	$text .=  "          break;\n";
	$text .=  "        default:\n";
	$text .=  "      }\n";
	$text .=  "      if(obj.type == undefined){\n";
	$text .=  "        var blnchecked = false;\n";
	$text .=  "        for(var j = 0; j < obj.length; j++){\n";
	$text .=  "          if(obj[j].checked){\n";
	$text .=  "            blnchecked = true;\n";
	$text .=  "          }\n";
	$text .=  "        }\n";
	$text .=  "        if(!blnchecked){\n";
	$text .=  "          alertMsg += \" - \" + fieldDescription[i] + \"\\n\";\n";
	$text .=  "        }\n";
	$text .=  "      }\n";
	$text .=  "    }\n";
	$text .=  "  }\n";
	$text .=  "  if(alertMsg.length == l_Msg){\n";
	$text .=  "    return true;\n";
	$text .=  "  }else{\n";
	$text .=  "    alert(alertMsg);\n";
	$text .=  "    return false;\n";
	$text .=  "  }\n";
	$text .=  "}\n";
	$text .=  "// -->\n";
	$text .=  "</script>\n";
	echo $text;
}

?>