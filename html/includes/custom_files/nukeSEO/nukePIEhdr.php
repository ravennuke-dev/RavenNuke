<?php
/************************************************************************/
/* nukePIE
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../../index.php');
	exit('Access Denied');
}

global $useBoxoverWithnukePIE;
if($useBoxoverWithnukePIE) include_once('includes/nukeSEO/nukePIECSS.php');
# Load JavaScript, other scripts required in HEAD tag
if($useBoxoverWithnukePIE) include_once('includes/boxover/boxover.php');

?>
