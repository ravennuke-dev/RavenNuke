<?php

########################################################################
# PHP-Nuke Block: Total Hits v0.1                                      #
#                                                                      #
# Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  #
#                                                                      #
########################################################################
# This program is free software. You can redistribute it and/or modify #
# it under the terms of the GNU General Public License as published by #
# the Free Software Foundation; either version 2 of the License.       #
########################################################################
#         Additional security & Abstraction layer conversion           #
#                           2003 chatserv                              #
#      http://www.nukefixes.com -- http://www.nukeresources.com        #
########################################################################
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}

global $prefix, $startdate, $db;

$sql = 'SELECT count FROM '.$prefix.'_counter WHERE type=\'total\' AND var=\'hits\'';
$result = $db->sql_query($sql);
list($hits) = $db->sql_fetchrow($result);
$hits = intval($hits);
$content = '<div class="text-center"><div class="tiny">'._WERECEIVED.'</div><div class="large"><a href="modules.php?name=Statistics">'.$hits.'</a></div>
<div class="tiny">'._PAGESVIEWS.'<div class="tiny">'.$startdate.'</div></div></div>';
?>