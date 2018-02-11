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
if (!defined('YA_ADMIN')) {
	header('Location: ../../../index.php');
	die ();
}

if ($radminsuper == 1 || $radminuser == 1) {
	$pagetitle = ': ' . _USERADMIN . ' - ' . _DELFIELD;
	include_once 'header.php';
	title(_USERADMIN . ' - ' . _DELFIELD);
	amain();
	echo '<br />';
	OpenTable();
	echo '<div class="text-center">'
		,  _CONFIRMDELLFIELD , ' ' , $fid , ' ?<br />'
		, '<form action="' , $admin_file , '.php?op=yaDelFieldConf" method="post">'
		, '<input type="hidden" name="fid" value="' , $fid , '" />'
		, '<input type="submit" value="' , _DELFIELD , '" />'
		, '</form>'
		, '<form action="' , $admin_file , '.php?op=yaCustomFields" method="post">'
		, '<input type="submit" value="' , _CANCEL , '" />'
		, '</form>'
		, '</div>';
	CloseTable();
	include_once 'footer.php'; 
}

?>