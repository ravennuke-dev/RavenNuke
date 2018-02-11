<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if(!defined('ADMIN_FILE') and !defined('MODULE_FILE'))
{
  header('Location: ../../../index.php');
  die();
}
if (is_array($headCSS))   addCSSToHead('includes/nukeSEO/forms/dhtmlxCombo/css/dhtmlXCombo.css', 'file');
else echo '<link rel="STYLESHEET" type="text/css" href="includes/nukeSEO/forms/dhtmlxCombo/css/dhtmlXCombo.css" />'."\n";
?>