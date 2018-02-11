<?php
/**************************************************************************/
/* nukeSEO DH: Dynamic HEAD Tags
/* =======================================================================*/
/*
/* Copyright (c) 2009, Kevin Guske  http://nukeseo.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/

if(!defined('NUKE_FILE')) die('Access forbbiden');

/* Mantis 1671
 include_once 'includes/jquery/jquery.php';
 */
addJSToHead('includes/jquery/jquery.colorbox-min.js','file');
addCSSToHead('includes/jquery/css/colorbox.css','file');
addJSToHead('includes/jquery/colorbox-settings.js','file');

?>
