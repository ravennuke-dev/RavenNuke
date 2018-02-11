<?php

/**********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*													*/
/*********************************************************************/
/* Additional security & Abstraction layer conversion					*/
/*	 2003 chatserv										*/
/*	http://www.nukefixes.com -- http://www.nukeresources.com			*/
/*********************************************************************/
/*********************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and		*/
/* XHTML compliance fixes by Raven and Montego.					*/
/*********************************************************************/
###############################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske	http://nukeseo.com
# kses developed by Ulf Harnhammar			http://kses.sf.net
# kses ideas contributed by sixonetonoffun		http://netflake.com
# FCKeditor by Frederico Caldeira Knabben		 http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen		http://phpnuker.de
#
###############################################

if ( !defined('ADMIN_FILE') ) {
	die ('Access Denied');
}

global $admin_file, $db, $prefix;

if (is_mod_admin('admin')) {

	switch($op) {
		case 'Configure':
			Configure();
		break;

		case 'ConfigSave':
			csrf_check();
			ConfigSave($xsitename,$xnukeurl,$xsite_logo,$xslogan,$xstartdate,$xadminmail,$xanonpost,$xfoot1,$xfoot2,$xfoot3,$xcommentlimit,
			$xanonymous,$xpollcomm,$xarticlecomm,$xbroadcast_msg,$xmy_headlines,$xtop,$xstoryhome,$xuser_news,$xoldnum,$xbanners,$xbackend_title,
			$xbackend_language,$xlanguage,$xlocale,$xmultilingual,$xuseflags,$xnotify,$xnotify_email,$xnotify_subject,$xnotify_message,$xnotify_from,$xmoderate,
			$xadmingraphic,$xCensorMode,$xCensorReplace);
		break;
	}

} else {
	echo 'Access Denied';
}
die();

/***********************************************************/
/* Functions only beyond here							*/
/***********************************************************/

function Configure() {
	global $admin_file, $db, $prefix;
	include_once('header.php');
	GraphicAdmin();
	$sql = 'SELECT sitename, nukeurl, site_logo, slogan, startdate, adminmail, anonpost, foot1, foot2, foot3, '
		.'commentlimit, anonymous, minpass, pollcomm, articlecomm, broadcast_msg, my_headlines, top, storyhome, user_news, '
		.'oldnum, banners, backend_title, backend_language, language, locale, multilingual, useflags, notify, '
		.'notify_email, notify_subject, notify_message, notify_from, moderate, admingraphic, CensorMode, '
		.'CensorReplace from '.$prefix.'_config';
	$row = $db->sql_fetchrow($db->sql_query($sql));
	$sitename = $row['sitename'];
	$nukeurl = $row['nukeurl'];
	$site_logo = $row['site_logo'];
	$slogan = $row['slogan'];
	$startdate = $row['startdate'];
	$adminmail = stripslashes($row['adminmail']);
	$anonpost = $row['anonpost'];
	$foot1 = stripslashes($row['foot1']);
	$foot2 = stripslashes($row['foot2']);
	$foot3 = stripslashes($row['foot3']);
	$commentlimit = intval($row['commentlimit']);
	$anonymous = $row['anonymous'];
	$minpass = intval($row['minpass']);
	$pollcomm = intval($row['pollcomm']);
	$articlecomm = intval($row['articlecomm']);
	$broadcast_msg = intval($row['broadcast_msg']);
	$my_headlines = intval($row['my_headlines']);
	$top = intval($row['top']);
	$storyhome = intval($row['storyhome']);
	$user_news = intval($row['user_news']);
	$oldnum = intval($row['oldnum']);
	$banners = intval($row['banners']);
	$backend_title = $row['backend_title'];
	$backend_language = $row['backend_language'];
	$language = $row['language'];
	$locale = $row['locale'];
	$multilingual = intval($row['multilingual']);
	$useflags = intval($row['useflags']);
	$notify = intval($row['notify']);
	$notify_email = $row['notify_email'];
	$notify_subject = $row['notify_subject'];
	$notify_message = $row['notify_message'];
	$notify_from = $row['notify_from'];
	$moderate = intval($row['moderate']);
	$admingraphic = intval($row['admingraphic']);
	$CensorMode = intval($row['CensorMode']);
	$CensorReplace = $row['CensorReplace'];

	OpenTable();
	echo '<div class="text-center title thick">' . _SITECONFIG . '</div>';
	CloseTable();
	echo '<br />';
	echo '<form action="'.$admin_file.'.php" method="post">';
	OpenTable();
	echo '<div class="text-center option thick">' . _GENSITEINFO . '</div>'
		.'<table border="0"><tr><td>'
		. _SITENAME . ':</td><td><input type="text" name="xsitename" value="'.$sitename.'" size="40" maxlength="255" />'
		.'</td></tr><tr><td>'
		. _SITEURL . ':</td><td><input type="text" name="xnukeurl" value="'.$nukeurl.'" size="40" maxlength="255" />'
		.'</td></tr><tr><td>'
		. _SITELOGO . ':</td><td><input type="text" name="xsite_logo" value="'.$site_logo.'" size="20" maxlength="255" /> <span class="tiny">[ ' . _MUSTBEINIMG . ' ]</span>'
		.'</td></tr><tr><td>'
		. _SITESLOGAN . ':</td><td><input type="text" name="xslogan" value="'.$slogan.'" size="40" maxlength="255" />'
		.'</td></tr><tr><td>'
		. _STARTDATE . ':</td><td><input type="text" name="xstartdate" value="'.$startdate.'" size="20" maxlength="50" />'
		.'</td></tr><tr><td>'
		. _ADMINEMAIL . ':</td><td><input type="text" name="xadminmail" value="'.$adminmail.'" size="30" maxlength="255" />'
		.'</td></tr><tr><td>'
		. _ITEMSTOP . ':</td><td><select name="xtop">'
		.'<option>'.$top.'</option>'
		.'<option>5</option>'
		.'<option>10</option>'
		.'<option>15</option>'
		.'<option>20</option>'
		.'<option>25</option>'
		.'<option>30</option>'
		.'</select>'
		.'</td></tr><tr><td>'
		. _STORIESHOME . ':</td><td><select name="xstoryhome">'
		.'<option>'.$storyhome.'</option>'
		.'<option>6</option>'
		.'<option>10</option>'
		.'<option>16</option>'
		.'<option>20</option>'
		.'<option>26</option>'
		.'<option>30</option>'
		.'</select>'
		.'</td></tr><tr><td>'
		. _OLDSTORIES . ':</td><td><select name="xoldnum">'
		.'<option>'.$oldnum.'</option>'
		.'<option>10</option>'
		.'<option>20</option>'
		.'<option>30</option>'
		.'<option>40</option>'
		.'<option>50</option>'
		.'</select>'
		.'</td></tr><tr><td>' . _ALLOWANONPOST . ' </td><td>';
	if ($anonpost == 1) {
		echo '<input type="radio" name="xanonpost" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xanonpost" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xanonpost" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xanonpost" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>'
		. _SELLANGUAGE . ':</td><td>'
		. lang_select_list('xlanguage', $language, false)
		.'</td></tr><tr><td>'
		. _LOCALEFORMAT . ':</td><td><input type="text" name="xlocale" value="'.$locale.'" size="20" maxlength="40" />'
		.'</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _MULTILINGUALOPT . '</div>'
		.'<table border="0"><tr><td>'
		. _ACTMULTILINGUAL . '</td><td>';
	if ($multilingual==1) {
		echo '<input type="radio" name="xmultilingual" value="1" checked="checked" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xmultilingual" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xmultilingual" value="1" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xmultilingual" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>'
		. _ACTUSEFLAGS . '</td><td>';
	if ($useflags==1) {
		echo '<input type="radio" name="xuseflags" value="1" checked="checked" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xuseflags" value="0" />' . _NO;
		} else {
		echo '<input type="radio" name="xuseflags" value="1" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xuseflags" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr></table>';
	echo '<br />';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _BANNERSOPT . '</div>'
		.'<table border="0"><tr><td>'
		. _ACTBANNERS . '</td><td>';
	if ($banners==1) {
		echo '<input type="radio" name="xbanners" value="1" checked="checked" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xbanners" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xbanners" value="1" />' . _YES . ' &nbsp;'
			.'<input type="radio" name="xbanners" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _FOOTERMSG . '</div>'
		.'<table border="0" width="100%"><tr><td>'
		. _FOOTERLINE1 . ':</td><td>';
	//The following has to be done in order to ensure XHTML compliance when the advanced editor is not being used:
	global $advanced_editor;
	if ($advanced_editor == 0) {
		$foot1 = htmlspecialchars($foot1, ENT_QUOTES, _CHARSET);
		$foot2 = htmlspecialchars($foot2, ENT_QUOTES, _CHARSET);
		$foot3 = htmlspecialchars($foot3, ENT_QUOTES, _CHARSET);
	}
	//End add.
	wysiwyg_textarea('xfoot1', $foot1, 'PHPNukeAdmin', '50', '10');
	echo '</td></tr><tr><td>'
		. _FOOTERLINE2 . ':</td><td>';
	wysiwyg_textarea('xfoot2', $foot2, 'PHPNukeAdmin', '50', '10');
	echo '</td></tr><tr><td>'
		. _FOOTERLINE3 . ':</td><td>';
	wysiwyg_textarea('xfoot3', $foot3, 'PHPNukeAdmin', '50', '10');
	echo '</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _BACKENDCONF . '</div>'
		.'<table border="0"><tr><td>'
		. _BACKENDTITLE . ':</td><td><input type="text" name="xbackend_title" value="'.$backend_title.'" size="40" maxlength="100" />'
		.'</td></tr><tr><td>'
		. _BACKENDLANG . ':</td><td><input type="text" name="xbackend_language" value="'.$backend_language.'" size="10" maxlength="10" />'
		.'</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _MAIL2ADMIN . '</div>'
		.'<table border="0"><tr><td>'
		. _NOTIFYSUBMISSION . '</td><td>';
	if ($notify==1) {
		echo '<input type="radio" name="xnotify" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xnotify" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xnotify" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xnotify" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>'
		. _EMAIL2SENDMSG . ':</td><td><input type="text" name="xnotify_email" value="'.$notify_email.'" size="30" maxlength="100" />'
		.'</td></tr><tr><td>'
		. _EMAILSUBJECT . ':</td><td><input type="text" name="xnotify_subject" value="'.$notify_subject.'" size="40" maxlength="100" />'
		.'</td></tr><tr><td>'
		. _EMAILMSG . ':</td><td><textarea name="xnotify_message" cols="40" rows="8">'.$notify_message.'</textarea>'
		.'</td></tr><tr><td>'
		. _EMAILFROM . ':</td><td><input type="text" name="xnotify_from" value="'.$notify_from.'" size="30" maxlength="100" />'
		.'</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _COMMENTSMOD . '</div>'
		.'<table border="0"><tr><td>'
		. _MODTYPE . ':</td><td>'
		.'<select name="xmoderate">';
	if ($moderate==1) {
		$sel1 = 'selected="selected"';
		$sel2 = '';
		$sel3 = '';
	} elseif ($moderate==2) {
		$sel1 = '';
		$sel2 = 'selected="selected"';
		$sel3 = '';
	} elseif ($moderate==0) {
		$sel1 = '';
		$sel2 = '';
		$sel3 = 'selected="selected"';
	}
	echo '<option value="1" '.$sel1.'>' . _MODADMIN . '</option>'
		.'<option value="2" '.$sel2.'>' . _MODUSERS . '</option>'
		.'<option value="0" '.$sel3.'>' . _NOMOD . '</option>'
		.'</select></td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _COMMENTSOPT . '</div>'
		.'<table border="0"><tr><td>'
		. _COMMENTSLIMIT . ':</td><td><input type="text" name="xcommentlimit" value="'.$commentlimit.'" size="11" maxlength="10" />'
		.'</td></tr><tr><td>'
		. _ANONYMOUSNAME . ':</td><td><input type="text" name="xanonymous" value="'.$anonymous.'" />'
		.'</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _GRAPHICOPT . '</div>'
		.'<table border="0"><tr><td>'
		. _ADMINGRAPHIC . '</td><td>';
	if ($admingraphic==1) {
		echo '<input type="radio" name="xadmingraphic" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xadmingraphic" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xadmingraphic" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xadmingraphic" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _MISCOPT . '</div>'
		.'<table border="0"><tr><td>'
		. _COMMENTSPOLLS . '</td><td>';
	if ($pollcomm==1) {
		echo '<input type="radio" name="xpollcomm" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xpollcomm" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xpollcomm" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xpollcomm" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>'
		. _COMMENTSARTICLES . '</td><td>';
	if ($articlecomm==1) {
		echo '<input type="radio" name="xarticlecomm" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xarticlecomm" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xarticlecomm" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xarticlecomm" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr></table><br /><br />';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _USERSOPTIONS . '</div>'
		.'<table border="0"><tr><td>'
		.'</td></tr><tr><td>' . _BROADCASTMSG . '</td><td>';
	if ($broadcast_msg == 1) {
		echo '<input type="radio" name="xbroadcast_msg" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xbroadcast_msg" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xbroadcast_msg" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xbroadcast_msg" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>' . _MYHEADLINES . '</td><td>';
	if ($my_headlines == 1) {
		echo '<input type="radio" name="xmy_headlines" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xmy_headlines" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xmy_headlines" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xmy_headlines" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr><tr><td>' . _USERSHOMENUM . '</td><td>';
	if ($user_news == 1) {
		echo '<input type="radio" name="xuser_news" value="1" checked="checked" />' . _YES . ' &nbsp;
		<input type="radio" name="xuser_news" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xuser_news" value="1" />' . _YES . ' &nbsp;
		<input type="radio" name="xuser_news" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr></table>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center option thick">' . _CENSOROPTIONS . '</div>'
		.'<table border="0"><tr><td>'
		. _CENSORMODE . '</td><td>';
	if ($CensorMode == 0) {
		$sel0 = 'selected="selected"';
		$sel1 = '';
		$sel2 = '';
		$sel3 = '';
	} elseif ($CensorMode == 1) {
		$sel0 = '';
		$sel1 = 'selected="selected"';
		$sel2 = '';
		$sel3 = '';
	} elseif ($CensorMode == 2) {
		$sel0 = '';
		$sel1 = '';
		$sel2 = 'selected="selected"';
		$sel3 = '';
	} elseif ($CensorMode == 3) {
		$sel0 = '';
		$sel1 = '';
		$sel2 = '';
		$sel3 = 'selected="selected"';
	}
	echo '<select name="xCensorMode">'
		.'<option value="0" '.$sel0.'>' . _NOFILTERING . '</option>'
		.'<option value="1" '.$sel1.'>' . _EXACTMATCH . '</option>'
		.'<option value="2" '.$sel2.'>' . _MATCHBEG . '</option>'
		.'<option value="3" '.$sel3.'>' . _MATCHANY . '</option>'
		.'</select>'
		.'</td></tr><tr><td>' . _CENSORREPLACE . '</td><td>'
		.'<input type="text" name="xCensorReplace" value="'.$CensorReplace.'" size="10" maxlength="10" />'
		.'</td></tr></table><br /><br />';
	echo '<input type="hidden" name="op" value="ConfigSave" />'
		.'<div class="text-center"><input type="submit" value="' . _SAVECHANGES . '" /></div>';
	CloseTable();
	echo '</form>';
	include_once('footer.php');
}

function ConfigSave($xsitename,$xnukeurl,$xsite_logo,$xslogan,$xstartdate,$xadminmail,$xanonpost,$xfoot1,$xfoot2,$xfoot3,$xcommentlimit,
					$xanonymous,$xpollcomm,$xarticlecomm,$xbroadcast_msg,$xmy_headlines,$xtop,$xstoryhome,$xuser_news,$xoldnum,$xbanners,$xbackend_title,
					$xbackend_language,$xlanguage,$xlocale,$xmultilingual,$xuseflags,$xnotify,$xnotify_email,$xnotify_subject,$xnotify_message,$xnotify_from,$xmoderate,
					$xadmingraphic,$xCensorMode,$xCensorReplace) {
	global $admin_file, $db, $prefix;
	$xsitename = htmlspecialchars($xsitename, ENT_QUOTES, _CHARSET);
	$xslogan = htmlspecialchars($xslogan, ENT_QUOTES, _CHARSET);
	$xbackend_title = htmlspecialchars($xbackend_title, ENT_QUOTES, _CHARSET);
	$xnotify_subject = htmlspecialchars($xnotify_subject, ENT_QUOTES, _CHARSET);
	if (@get_magic_quotes_gpc() == 0) { //Magic quotes are not on, so need to escape these text entry fields:
		$xfoot1 = addslashes($xfoot1);
		$xfoot2 = addslashes($xfoot2);
		$xfoot3 = addslashes($xfoot3);
		$xnotify_message = addslashes($xnotify_message);
	}

	$sql = 'UPDATE '.$prefix.'_config SET sitename=\''.$xsitename.'\', nukeurl=\''.$xnukeurl.'\', site_logo=\''
		.$xsite_logo.'\', slogan=\''.$xslogan.'\', startdate=\''.$xstartdate.'\', adminmail=\''.$xadminmail.'\', anonpost=\''
		.$xanonpost.'\', foot1=\''.$xfoot1.'\', foot2=\''.$xfoot2.'\', foot3=\''
		.$xfoot3.'\', commentlimit=\''.$xcommentlimit.'\', anonymous=\''.$xanonymous.'\', minpass=\'8\', pollcomm=\''
		.$xpollcomm.'\', articlecomm=\''.$xarticlecomm.'\', broadcast_msg=\''.$xbroadcast_msg.'\', my_headlines=\''
		.$xmy_headlines.'\', top=\''.$xtop.'\', storyhome=\''.$xstoryhome.'\', user_news=\''.$xuser_news.'\', oldnum=\''
		.$xoldnum.'\', banners=\''.$xbanners.'\', backend_title=\''.$xbackend_title
		.'\', backend_language=\''.$xbackend_language.'\', language=\''.$xlanguage.'\', locale=\''.$xlocale.'\', multilingual=\''
		.$xmultilingual.'\', useflags=\''.$xuseflags.'\', notify=\''.$xnotify.'\', notify_email=\''.$xnotify_email
		.'\', notify_subject=\''.$xnotify_subject.'\', notify_message=\''.$xnotify_message.'\', notify_from=\''
		.$xnotify_from.'\', moderate=\''.$xmoderate.'\', admingraphic=\''.$xadmingraphic.'\', CensorMode=\''.$xCensorMode.'\', CensorReplace=\''.$xCensorReplace.'\'';
	$db->sql_query($sql);

	 Header('Location: '.$admin_file.'.php?op=Configure');
}

?>