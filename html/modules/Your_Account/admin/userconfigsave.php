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
//set some vars up front for notice errors
if (!isset($xcodesize)) $xcodesize = '';
if (!isset($xusefakeemail)) $xusefakeemail = '';
if (!isset($xusegfxcheck)) $xusegfxcheck = '';
if (!isset($xusegender)) $xusegender = '';
if (!isset($xusebirthdate)) $xusebirthdate = '';
if (!isset($xuserealname)) $xuserealname = '';
if (!isset($xuseinstantmessmsn)) $xuseinstantmessmsn = '';
if (!isset($xuseinstantmessaim)) $xuseinstantmessaim = '';
if (!isset($xuseinstantmessicq)) $xuseinstantmessicq = '';
if (!isset($xuseinstantmessyim)) $xuseinstantmessyim = '';
if (!isset($xuselocation)) $xuselocation = '';
if (!isset($xuseoccupation)) $xuseoccupation = '';
if (!isset($xuseinterests)) $xuseinterests = '';
if (!isset($xusewebsite)) $xusewebsite = '';
if (!isset($xuseforumnotifyoptions)) $xuseforumnotifyoptions = '';
if (!isset($xuseviewemail)) $xuseviewemail = '';
if (!isset($xusehideonline)) $xusehideonline = '';
if (!isset($xusenewsletter)) $xusenewsletter = '';
if (!isset($xusesignature)) $xusesignature = '';
if (!isset($xuseextrainfo)) $xuseextrainfo = '';
if (!isset($xusepoints)) $xusepoints = '';
if (!isset($xtosall)) $xtosall = '';

if (($radminsuper==1) OR ($radminuser==1)) {

    $tmp_nick = explode("\r\n",$xbad_nick);
    rsort($tmp_nick);
    for ($i=count($tmp_nick)-1; $i > -1; $i--) {
        if ($tmp_nick[$i] == "") { array_pop($tmp_nick); }
    }
    sort($tmp_nick);
    $xbad_nick = implode("\r\n",$tmp_nick);
    $tmp_mail = explode("\r\n",$xbad_mail);
    rsort($tmp_mail);
    for ($i=count($tmp_mail)-1; $i > -1; $i--) {
        if ($tmp_mail[$i] == "") { array_pop($tmp_mail); }
    }
    sort($tmp_mail);
    $xbad_mail = implode("\r\n",$tmp_mail);
    ya_save_config('sendaddmail', $xsendaddmail, 'nohtml');
    ya_save_config('allowuserdelete', $xallowuserdelete);
    ya_save_config('doublecheckemail', $xdoublecheckemail);

    ya_save_config('coppa', $xcoppa);
    ya_save_config('tos', $xtos);
    ya_save_config('tosall', $xtosall);
    ya_save_config('legal_did_TOS', $xlegal_did_TOS);

    ya_save_config('senddeletemail', $xsenddeletemail);
    ya_save_config('allowusertheme', $xallowusertheme);
    ya_save_config('allowuserreg', $xallowuserreg);
    ya_save_config('userealname', $xuserealname);
    ya_save_config('usefakeemail', $xusefakeemail);

    ya_save_config('useinstantmessmsn', $xuseinstantmessmsn);
    ya_save_config('useinstantmessaim', $xuseinstantmessaim);
    ya_save_config('useinstantmessicq', $xuseinstantmessicq);
    ya_save_config('useinstantmessyim', $xuseinstantmessyim);

    ya_save_config('uselocation', $xuselocation);
    ya_save_config('useoccupation', $xuseoccupation);
    ya_save_config('useinterests', $xuseinterests);
    ya_save_config('usewebsite', $xusewebsite);

    ya_save_config('useforumnotifyoptions', $xuseforumnotifyoptions);
    ya_save_config('useviewemail', $xuseviewemail);
    ya_save_config('usehideonline', $xusehideonline);
    ya_save_config('usenewsletter', $xusenewsletter);
    ya_save_config('usesignature', $xusesignature);
    ya_save_config('useextrainfo', $xuseextrainfo);
    ya_save_config('usepoints', $xusepoints);
    ya_save_config('useasreguser', $xuseasreguser);

    ya_save_config('allowmailchange', $xallowmailchange);
    ya_save_config('emailvalidate', $xemailvalidate);
    ya_save_config('requireadmin', $xrequireadmin);
    ya_save_config('servermail', $xservermail);
    ya_save_config('useactivate', $xuseactivate);
    ya_save_config('usegfxcheck', $xusegfxcheck);
    ya_save_config('autosuspend', $xautosuspend);
    ya_save_config('perpage', $xperpage);
    ya_save_config('expiring', $xexpiring);

    ya_save_config('bad_nick', $xbad_nick, 'nohtml');
    ya_save_config('bad_mail', $xbad_mail, 'nohtml');
    ya_save_config('nick_min', $xnick_min);
    ya_save_config('nick_max', $xnick_max);
    ya_save_config('pass_min', $xpass_min);
    ya_save_config('pass_max', $xpass_max);

    ya_save_config('codesize', $xcodesize);
    ya_save_config('autosuspendmain', $xautosuspendmain);

    ya_save_config('cookiecheck', $xcookiecheck);
    ya_save_config('cookiecleaner', $xcookiecleaner);
    ya_save_config('cookietimelife', $xcookietimelife, 'nohtml');
    ya_save_config('cookiepath', $xcookiepath, 'nohtml');
    ya_save_config('cookieinactivity', $xcookieinactivity, 'nohtml');

    $pagetitle = ": "._USERADMIN." - "._YA_USERS;
    include_once('header.php');
    title(_USERADMIN.": "._YA_USERS);
    amain();
    echo '<br />';
    OpenTable();
    echo '<div class="text-center"><h4>'._YACONFIGSAVED.'</h4></div>';
    echo '<table align="center">
	<tr><td>
	<form action="">
	<input type="button" value="'._USERSCONFIG.'" onclick="javascript:location=\''.$admin_file.'.php?op=yaUsersConfig\';" />
	</form></td></tr></table>';
    CloseTable();
    include_once('footer.php');

}

?>