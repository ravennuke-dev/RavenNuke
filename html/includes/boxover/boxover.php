<?php
/************************************************************************/
/* nukeSEO
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (is_array($headJS)) addJSToHead('includes/boxover/boxover.js', 'file');
else echo "<script type=\"text/javascript\" language=\"JavaScript\" src=\"includes/boxover/boxover.js\"></script>\n";
?>