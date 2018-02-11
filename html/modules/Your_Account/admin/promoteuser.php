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
if (!defined('YA_ADMIN'))
{
	header('Location: ../../../index.php');
	die ();
}

if ($radminsuper == 1) {
	list($uname, $rname, $email, $site, $upass) = $db->sql_fetchrow($db->sql_query("SELECT username, name, user_email, user_website, user_password FROM ".$user_prefix."_users WHERE user_id='$chng_uid'"));
	$pagetitle = ': '._USERADMIN.' - '._PROMOTEUSER;
	include('header.php');
	title(_USERADMIN." - "._PROMOTEUSER);
	amain();
	echo '<br />'."\n";
	OpenTable();
   echo '<div class="text-center"><form action="'.$admin_file.'.php" method="post">';
	 if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
	 if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
	 echo '<input type="hidden" name="op" value="yaPromoteUserConf" />'."\n";
	 echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
	 echo '<tr><td align="center">'._SURE2PROMOTE.' <span class="thick">'.$uname.'<span class="italic">('.$chng_uid.')</span></span>?</td></tr>'."\n";
	 echo '<tr><td><table border="0">';
	 echo '<tr><td>'._NAME.':</td><td colspan="3"><input type="text" name="add_name" size="30" maxlength="50" value="'.$rname.'" /> <span class="tiny">'._REQUIREDNOCHANGE.'</span></td></tr>';
	 echo '<tr><td>'._NICKNAME.':</td><td colspan="3"><input type="text" name="add_aid" size="30" maxlength="30" value="'.$uname.'" /> <span class="tiny">'._REQUIRED.'</span></td></tr>';
	 echo '<tr><td>'._EMAIL.':</td><td colspan="3"><input type="text" name="add_email" size="30" maxlength="60" value="'.$email.'" /> <span class="tiny">'._REQUIRED.'</span></td></tr>';
	 echo '<tr><td>'._URL.':</td><td colspan="3"><input type="text" name="add_url" size="30" maxlength="60" value="'.$site.'" /></td></tr>';
	//[vecino398(curt)]  www.vecino398.com -Modification-
	 echo '<tr><td valign="top">' . _PERMISSIONS . ':</td>';
	 $result = $db->sql_query('SELECT mid, title FROM '.$prefix.'_modules ORDER BY title ASC');
	 $a = 0;
	 while ($row = $db->sql_fetchrow($result)) {
		  $title = str_replace('_', ' ', $row['title']);
		  if (file_exists('modules/'.$row['title'].'/admin/index.php') AND file_exists('modules/'.$row['title'].'/admin/links.php') AND file_exists('modules/'.$row['title'].'/admin/case.php')) {
				echo '<td><input type="checkbox" name="auth_modules[]" value="'.$row['mid'].'" />'.$title.'</td>';
				if ($a == 2) {
					 echo '</tr><tr><td>&nbsp;</td>';
					 $a = 0;
				} else {
					 $a++;
				}
		}
	}
	echo '</tr><tr><td>&nbsp;</td>'
		.'<td><input type="checkbox" name="add_radminsuper" value="1" /> <span class="thick">' . _SUPERUSER . '</span></td>'
		  .'</tr>';
	echo '</table></td></tr>';
	echo '<tr><td align="center"><input type="submit" value="'._PROMOTEUSER.'" /></td></tr>'."\n";
	echo '</table>'."\n";
	echo '<input type="hidden" name="add_password" value="'.$upass.'" />';
	echo '</form>'."\n";
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
	if (isset($listtype)) { echo '<input type="hidden" name="listtype" value="'.$listtype.'" />'."\n"; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
	echo '<input type="hidden" name="chng_uid" value="'.$chng_uid.'" />'."\n";
	echo '<input type="button" value="'._CANCEL.'" onclick="history.go(-1)" />'."\n";
	echo '</form>'."\n";
	echo '</div>'."\n";
	CloseTable();
	include('footer.php');
	}else{
header('Location: ../../../index.php');
	 die ();
}
?>