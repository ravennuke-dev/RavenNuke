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
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: index.php');
	exit('Access Denied');
}
/**
 * enter your domain name here to add an extra layer of protection or leave blank.
 * example shows how to use this with a subdomain
 * define("RNYA_DOMAINNAME", "wwww.yourdomain.com");
 * no www or http just the domain name
 * remove the '//' from the next two lines and insert your domain name for additional security
 * (don't put 'http://' in front of it, your domain name only!
 */

// define('RNYA_DOMAINNAME', '');
// if (($_SERVER['SERVER_NAME'] != RNYA_DOMAINNAME OR $_SERVER['SERVER_NAME'] != RNYA_DOMAINNAME) AND RNYA_DOMAINNAME != '') {exit();}
define('RNYA', true);
?>