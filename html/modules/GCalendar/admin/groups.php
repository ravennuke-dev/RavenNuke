<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// Admin groups.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
// groups.php - Performs NSN Groups configuration for GCalendar
///////////////////////////////////////////////////////////////////////

if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

function gcalAdminGroupsPermSave(&$config) {
	global $db, $prefix;

	$canSubmit = isset($_POST['groupsCanSubmit']) && is_array($_POST['groupsCanSubmit'])
		? array_keys($_POST['groupsCanSubmit'])
		: array();

	$noApproval = isset($_POST['groupsNoApproval']) && is_array($_POST['groupsNoApproval'])
		? array_keys($_POST['groupsNoApproval'])
		: array();

	$canSubmit = array_map('intval', $canSubmit);
	$noApproval = array_map('intval', $noApproval);

	$config['groups_submit'] = $canSubmit;
	$config['groups_no_approval'] = $noApproval;

	$sql = sprintf('UPDATE %s SET `groups_submit` = \'%s\', `groups_no_approval` = \'%s\'',
		$prefix . GCAL_CONF_TABLE, 
		implode(',', $canSubmit), 
		implode(',', $noApproval));

	$db->sql_query($sql);
}

function gcalAdminGroupsCatSave() {
	global $db, $prefix;

	$catId = intval($_POST['cat']);
	$groups = array();
	if (isset($_POST['gcalGroups']) && is_array($_POST['gcalGroups'])) {
		$groups = array_map('intval', $_POST['gcalGroups']);
	}

	$sql = 'DELETE FROM ' . $prefix . GCAL_CAT_GROUP_TABLE . ' WHERE `cat_id` = ' . $catId;
	$db->sql_query($sql);

	if (count($groups) > 0) {
		foreach ($groups as $group) {
			$sql = 'INSERT INTO ' . $prefix . GCAL_CAT_GROUP_TABLE . " VALUES (NULL, $catId, $group)";
			$db->sql_query($sql);
		}
	} else {
		$sql = 'INSERT INTO ' . $prefix . GCAL_CAT_GROUP_TABLE . " VALUES (NULL, $catId, -1)";
		$db->sql_query($sql);
	}
}

function gcalAdminGroups($config) {
	global $db, $prefix, $admin_file;

	if (isset($_POST['updatePerm'])) {
		gcalAdminGroupsPermSave($config);
	}
	if (isset($_POST['updateCat'])) {
		gcalAdminGroupsCatSave();
	}

	$sql = 'SELECT `gid`, `gname` FROM ' . $prefix . '_nsngr_groups ORDER BY `gname`';
	$result = $db->sql_query($sql);
	$groups = array();
	while ($row = $db->sql_fetchrow($result)) {
		$groups[intval($row['gid'])] = $row['gname'];
	}
	if (count($groups) <= 0) {
		echo '<div class="text-center">' . _ADMIN_NO_GROUPS . '</div><br />';
		return;
	}
	asort($groups);

	// build checkboxes

	$canSubmit = new Checkboxes('groupsCanSubmit');
	$noApproval = new Checkboxes('groupsNoApproval');

	foreach ($groups as $id => $name) {
		$canSubmit->addItem($id, '', in_array($id, $config['groups_submit']));
		$noApproval->addItem($id, '', in_array($id, $config['groups_no_approval']));
	}

	// display group permissions form

	$formAction = $admin_file . '.php?op=gcal_groups';
	echo '<form method="post" name="gcalGroupPermissions" action="' . $formAction . '">';
	echo '<fieldset><legend><span class="thick">' . _ADMIN_GROUP_PERM_LABEL . '</span></legend>';
	echo '<table border="0" cellspacing="5" cellpadding="5">';
	echo '<tr><th>' . _ADMIN_GROUP_PERM_GROUP . '<sup>&nbsp;</sup></th>';
	echo '<th>' . _ADMIN_GROUP_PERM_SUBMIT . '<sup>1</sup></th>';
	echo '<th>' . _ADMIN_GROUP_PERM_APPROV . '<sup>&nbsp;</sup></th></tr>';

	foreach ($groups as $id => $name) {
		echo '<tr><td align="right">' . $name . '</td><td align="center">' . $canSubmit->htmlFor($id) . 
			'</td><td align="center">' . $noApproval->htmlFor($id) . '</td></tr>';
	}
	echo '</table>';
	echo '<br /><sup>1</sup> ' . _ADMIN_GROUP_SUBMIT_NOTE;
	echo '<br /><br /><input type="submit" name="updatePerm" value="' . _ADMIN_GROUP_PERM_SAVE . '" />';
	echo '</fieldset></form><br /><br />';

	// display category / group permissions form

	$catItems = getCategories();
	$categories = array();
	foreach ($catItems as $id => $name) {
		$categories[$id] = array('name' => $name, 'groups' => array());
	}

	$sql = 'SELECT `cat_id`, `group_id` FROM ' . $prefix . GCAL_CAT_GROUP_TABLE;
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$groupId = intval($row['group_id']);
		if ($groupId != -1) {
			$categories[$row['cat_id']]['groups'][] = $groupId;
		}
	}

	if (count($categories) <= 0) {
		return;
	}

	$catCombo = new Combo('cat', $catItems);
	$catCombo->setOnChange('gcalCatChange(this.value)');
	$groupCombo = new Combo('gcalGroups[]', $groups);
	$groupCombo->size(min(50, count($groups)));
	$groupCombo->multiple();

	if (isset($_POST['cat'])) {
		$catId = intval($_POST['cat']);
		if (array_key_exists($catId, $categories)) {
			$catCombo->select($catId);
			$groupCombo->select($categories[$catId]['groups']);
		}
	} else {
		reset($catItems);
		$catId = key($catItems);
		$catCombo->select($catId);
		$groupCombo->select($categories[$catId]['groups']);
	}

	echo '<form method="post" name="gcalCategoryAssignments" action="' . $formAction . '">';
	gcalAdminGroupsJScript($categories, $groups);
	echo '<fieldset><legend><span class="thick">' . _ADMIN_GROUP_CAT_LABEL . '</span></legend>';
	echo '<p>' . _ADMIN_GROUP_CAT_EXPLANATION . '</p>';
	echo '<table border="0" cellspacing="5" cellpadding="5">';
	echo '<tr><th>' . _ADMIN_GROUP_CAT_COMBO . '</th><th>' . _ADMIN_GROUP_CAT_GROUPS . '</th></tr>';
	echo '<tr><td valign="top" align="center">' . $catCombo->html() . 
		'</td><td valign="top" align="center">' . $groupCombo->html() . '</td></tr>';
	echo '<tr><td colspan="2" align="center"><input type="submit" name="updateCat" value="' .
		_ADMIN_GROUP_CAT_SAVE . '" /></td></tr>';
	echo '</table>';
	echo '</fieldset></form><br />';
}

function gcalAdminGroupsJScript($categories, $groups) {
	echo "\n" . '<script type="text/javascript">' . "\n" .
		'//<![CDATA[' . "\n" .
		'var gcalCatGroupMap = new Object();' . "\n";

	$i = 0;
	foreach ($groups as $id => $name) {
		$groups[$id] = $i;
		//echo $id , '=' , $name , '=' , $groups[$id] , "\n";
		$i++;
	}

	foreach ($categories as $id => $info) {
		echo 'gcalCatGroupMap[' , $id , '] = [';
		$group_content = '';
		foreach ($groups as $id => $name) {
			if (in_array($id, $info['groups'])) {
				if ($group_content != '') {
					$group_content .= ',';
				}
				$group_content .= $name;
			}
		}
		echo $group_content , '];' , "\n";
	}

	echo <<<END_SCRIPT
function gcalCatChange(cat) {
	var groups;
	if (document.getElementById) 
	{
		groups = document.getElementById('gcalGroups');
	} 
	else if (document.all) 
	{
		groups = document.all['gcalGroupSelect'];
	}
	else
	{
		return;
	}
	for (var i = 0; i < groups.length; ++i)
	{
		groups.options[i].selected = false;
	}
	for (var i in gcalCatGroupMap[cat])
	{
		groups.options[gcalCatGroupMap[cat][i]].selected = true;
	}
}
END_SCRIPT;

	echo "\n" . '//]]>' . "\n" . '</script>';
}

?>