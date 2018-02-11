<?php

######################################################
# After you used this file, you can safely delete it.
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser.
######################################################

include("mainfile.php");

// Forums Table Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.13' where config_name='version'");
echo "BBtoNuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>