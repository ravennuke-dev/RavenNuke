<?php
###############################################################################
# RavenNuke(tm) Stories Archive block  http://trickedoutnews.com
###############################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
###############################################################################
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
 global $prefix, $db, $content;
        $module_name = 'Stories_Archive';
        $result = $db->sql_query('SELECT time from '.$prefix.'_stories order by time DESC');
        $thismonth = '';
$content = '<br />';
    while(list($time) = $db->sql_fetchrow($result)) {
    preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $getdate);
    if ($getdate[2] == '01') { $month = _JANUARY; } elseif ($getdate[2] == '02') { $month = _FEBRUARY; } elseif ($getdate[2] == '03') { $month = _MARCH; } elseif ($getdate[2] == '04') { $month = _APRIL; } elseif ($getdate[2] == '05') { $month = _MAY; } elseif ($getdate[2] == '06') { $month = _JUNE; } elseif ($getdate[2] == '07') { $month = _JULY; } elseif ($getdate[2] == '08') { $month = _AUGUST; } elseif ($getdate[2] == '09') { $month = _SEPTEMBER; } elseif ($getdate[2] == '10') { $month = _OCTOBER; } elseif ($getdate[2] == '11') { $month = _NOVEMBER; } elseif ($getdate[2] == '12') { $month = _DECEMBER; }
    if ($month != $thismonth) {
        $year = $getdate[1];
        $content .= '&rarr;&nbsp;<a href="modules.php?name='.$module_name.'&amp;sa=show_month&amp;year='.$year.'&amp;month='.$getdate[2].'&amp;month_l='.$month.'"><span class="thick">'.$month.'</span>, '.$year.'</a><br />';
        $thismonth = $month;
    }
    }
$content .= '<br />';
?>
