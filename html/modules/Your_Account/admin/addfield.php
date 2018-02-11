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
if (!defined('YA_ADMIN')){
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
	$pagetitle = ": "._USERADMIN." - "._ADDFIELD;
	include_once('header.php');
	title(_USERADMIN." - "._ADDFIELD);
	amain();
	echo '<br />';
	OpenTable();
	// set some constants up front
	if(!defined('name')) define('name','name'); //line 47
	if(!defined('value')) define ('value','value'); //line 48
	if(!defined('size')) define ('size','size'); // line 49
	if(!defined('pos')) define('pos','pos'); // line 62

	echo '<form action="'.$admin_file.'.php" method="post">';
	echo '<div class="text-center"><table border="0">';
	echo '<tr><td>ID</td><td>'._FIELDNAME.'*</td><td>'._FIELDVALUE.'**</td><td>'._FIELDSIZE.'</td><td>'._FIELDNEED.'</td><td>'._FIELDVPOS.'</td><td>'._YA_PUBLIC.'</td><td>'._FIELDDEL.'</td></tr>';
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_users_fields ORDER BY pos");
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = $sqlvalue['fid'];
		echo '<tr><td>'.$t.'</td>
			<td><input type="text" name="field_name['.$t.']" value="'.$sqlvalue['name'].'" size="20" maxlength="20" /></td>
			<td><input type="text" name="field_value['.$t.']" value="'.$sqlvalue['value'].'" size="20" maxlength="'.$sqlvalue['size'].'" /></td>
			<td><input type="text" name="field_size['.$t.']" value="'.$sqlvalue['size'].'" size="4" maxlength="4" /></td>
			<td>';
		echo '<select name="field_need['.$t.']">';
		if ($sqlvalue['need'] == 1) $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="1" '.$sel.'>'._NEED1.'</option>';
		if ($sqlvalue['need'] == 2) $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="2" '.$sel.'>'._NEED2.'</option>';
		if ($sqlvalue['need'] == 3) $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="3" '.$sel.'>'._NEED3.'</option>';
		if ($sqlvalue['need'] == 4) $sel = 'selected="selected"'; else $sel = ''; // Displayed during registration only
		echo '<option value="4" '.$sel.'>'._NEED4.'</option>';
		if ($sqlvalue['need'] == 5) $sel = 'selected="selected"'; else $sel = ''; // Required during registration only
		echo '<option value="5" '.$sel.'>'._NEED5.'</option>';
		if ($sqlvalue['need'] == 0) $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="0" '.$sel.'>'._NEED0.'</option>';
		echo '</select>';
		echo '</td><td><input type="text" name="field_pos['.$t.']" value="'.$sqlvalue['pos'].'" size="3" maxlength="3" /></td>';
		echo '<td><select name="field_public['.$t.']">';
		if ($sqlvalue['public'] <> '0') $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="1" '.$sel.'>'._YA_PUBLIC.'</option>';
		if ($sqlvalue['public'] == '0') $sel = 'selected="selected"'; else $sel = '';
		echo '<option value="0" '.$sel.'>'._YA_PRIVATE.'</option>';
		echo '</select></td>';
		echo '<td><a href="'.$admin_file.'.php?op=yaDelField&amp;fid='.$t.'">'._FIELDDEL.'</a></td></tr>';
	}
	echo '<tr><td>&nbsp;</td><td><input type="text" name="mfield_name" size="20" maxlength="20" /></td>
		<td><input type="text" name="mfield_value" size="20" maxlength="255" /></td>
		<td><input type="text" name="mfield_size" size="4" maxlength="4" /></td><td>';
	echo '<select name="mfield_need">';
	echo '<option value="1" selected="selected">'._NEED1.'</option>';
	echo '<option value="2">'._NEED2.'</option>';
	echo '<option value="3">'._NEED3.'</option>';
	echo '<option value="4">'._NEED4.'</option>'; // Displayed during registration only
	echo '<option value="5">'._NEED5.'</option>'; // Required during registration only
	echo '<option value="0">'._NEED0.'</option>';
	echo '</select>';
	echo '</td><td><input type="text" name="mfield_pos" size="3" maxlength="3" /></td>';
	echo '<td><select name="mfield_public">';
	echo '<option value="1" selected="selected">'._YA_PUBLIC.'</option>';
	echo '<option value="0">'._YA_PRIVATE.'</option>';
	echo '</select></td>';
	echo '<td>&nbsp;</td></tr>';
	echo '<tr><td align="center" colspan="8"><br />';
	OpenTable();
	echo _NAMECOMENT.'<br />'._VALUECOMENT;
	CloseTable();
	echo '</td></tr><tr><td align="center" colspan="8">';
	echo '<input type="submit" value="'._ADDFIELD.'" />';
	echo '<input type="hidden" name="op" value="yaSaveFields" />';
	echo '</td></tr>';
//	echo '<form action="'.$admin_file.'.php?op=yaCustomFields' method='post'>\n";
	echo '<tr><td align="center" colspan="8"><input type="submit" value="'._CANCEL.'" /></td></tr>';
	echo '</table>';
	echo '</div></form>';
	CloseTable();
	include_once('footer.php');
}
?>