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
/*********************************************************************/
/*********************************************************************/
/* WhoIsWhere Block by Gaylen Fraley (aka Raven) 					*/
/* http://www.ravenwebhosting.com								*/
/* http://www.ravenphpscripts.com								*/
/*********************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: index.php');
	die();
}

//set the refresh rate for the block ( 1000 = 1 second)
$refreshRate = 60000;

global $currentlang;

$content = '<script type="text/javascript">
function ajax_update() {
	$("#RWSWhoIsWhere").load("includes/RWS_WhoIsWhere/wiw.php", {"language": "' . $currentlang . '", "refreshRate": "' . $refreshRate . '"});
	setTimeout("ajax_update()", ' . $refreshRate . ');
}
$(document).ready(function(){
	ajax_update();
});
</script>
<div id="RWSWhoIsWhere" style="overflow:auto;width:100"></div>';

?>